<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['User_model', 'Favorit_model', 'Ulasan_model', 'Order_model']);
        $this->load->library(['session', 'form_validation', 'upload']);
        $this->load->helper(['url', 'form']);

        // Middleware untuk memastikan pengguna sudah login
        if (!$this->input->is_ajax_request()) {
            if (!$this->session->userdata('is_logged_in') || $this->session->userdata('role') != 'pengguna') {
                $this->session->set_flashdata('error', 'Anda harus login sebagai pengguna untuk mengakses halaman ini.');
                redirect('login');
            }
        }
    }

    public function index()
    {
        $user_id = $this->session->userdata('id');
        $data['title'] = 'Dashboard';
        $data['total_favorit'] = $this->db->where('id_user', $user_id)->count_all_results('produk_favorit');
        $data['total_ulasan'] = $this->db->where('id_user', $user_id)->count_all_results('produk_ulasan');
        $data['total_pesanan'] = $this->db->where('id_user', $user_id)->count_all_results('orders');
        $data['page_content'] = 'user/dashboard_content'; 
        $this->load->view('layouts/dashboard_layout', $data);
    }

    /**
     * PERUBAHAN: Menggabungkan logika lihat, edit, dan update profil ke dalam satu method
     */
    public function profile()
    {
        $user_id = $this->session->userdata('id');
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->User_model->get_user_by_id($user_id);

        // Aturan validasi dasar
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'trim');
        
        // Hanya jalankan validasi password jika field password diisi
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password Baru', 'required|trim|min_length[8]');
            $this->form_validation->set_rules('pass_confirm', 'Konfirmasi Password', 'required|trim|matches[password]');
        }

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal atau halaman diakses pertama kali, tampilkan form
            $data['page_content'] = 'user/profile_view';
            $this->load->view('layouts/dashboard_layout', $data);
        } else {
            // Jika validasi sukses, proses update data
            $update_data = [
                'nama' => $this->input->post('nama'),
                'lokasi' => $this->input->post('lokasi')
            ];
            
            // Hanya update password jika diisi dan tidak kosong
            if ($this->input->post('password') && !empty(trim($this->input->post('password')))) {
                $update_data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            // Handle upload foto
            if (!empty($_FILES['foto_profil']['name'])) {
                $config['upload_path']   = './public/img/profile/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']      = 2048; // 2MB
                $config['encrypt_name']  = TRUE;
                $this->upload->initialize($config);

                if ($this->upload->do_upload('foto_profil')) {
                    $old_photo = $data['user']['foto'];
                    if ($old_photo && file_exists($config['upload_path'] . $old_photo)) {
                        @unlink($config['upload_path'] . $old_photo);
                    }
                    $upload_data = $this->upload->data();
                    $update_data['foto'] = $upload_data['file_name'];
                    
                    // ==================================================================
                    // PERUBAHAN DIMULAI: Update session foto agar langsung tampil di navbar
                    // ==================================================================
                    $this->session->set_userdata('foto', $update_data['foto']);
                    // ==================================================================
                    // PERUBAHAN SELESAI
                    // ==================================================================

                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('user/profile');
                    return;
                }
            }
            
            $this->User_model->update_user($user_id, $update_data);
            $this->session->set_userdata('nama', $update_data['nama']);
            $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
            redirect('user/profile');
        }
    }
    
    public function favorit()
    {
        $data['title'] = 'Produk Favorit';
        $data['produk_favorit'] = $this->Favorit_model->get_favorit_by_user($this->session->userdata('id'));
        $data['page_content'] = 'user/favorit';
        $this->load->view('layouts/dashboard_layout', $data);
    }

    public function toggle_favorit()
    {
       if (!$this->input->is_ajax_request()) { show_404(); return; }
       
       if (!$this->session->userdata('is_logged_in') || $this->session->userdata('role') != 'pengguna') {
           $response = ['status' => 'error', 'message' => 'Sesi Anda telah berakhir. Silakan login kembali.', 'action' => 'reload'];
       } else {
           $userId = (int)$this->session->userdata('id');
           $produkId = (int)$this->input->post('id_produk');

           if ($produkId <= 0) {
                $response = ['status' => 'error', 'message' => 'Produk tidak valid.'];
           } else {
                $isFavorited = $this->Favorit_model->is_favorited($userId, $produkId);
                if ($isFavorited) {
                    if($this->Favorit_model->remove($userId, $produkId)) {
                        $response = ['status' => 'removed', 'message' => 'Produk berhasil dihapus dari favorit.'];
                    } else {
                        $response = ['status' => 'error', 'message' => 'Gagal menghapus favorit dari database.'];
                    }
                } else {
                    if($this->Favorit_model->add($userId, $produkId)) {
                        $response = ['status' => 'added', 'message' => 'Produk berhasil ditambahkan ke favorit!'];
                    } else {
                         $response = ['status' => 'error', 'message' => 'Gagal menambahkan favorit ke database.'];
                    }
                }
           }
       }
       
       $response['csrf_name'] = $this->security->get_csrf_token_name();
       $response['csrf_hash'] = $this->security->get_csrf_hash();
       
       $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function tambah_ulasan()
    {
        if (!$this->input->is_ajax_request()) { show_404(); return; }

        if (!$this->session->userdata('is_logged_in') || $this->session->userdata('role') != 'pengguna') {
            $response = ['status' => 'error', 'message' => 'Sesi Anda telah berakhir. Silakan login kembali.', 'action' => 'reload'];
        } else {
            $id_user = (int)$this->session->userdata('id');
            $id_produk = (int)$this->input->post('id_produk');
            $rating = (int)$this->input->post('rating');
            $komentar = trim($this->input->post('komentar'));

            if ($id_produk <= 0) {
                $response = ['status' => 'error', 'message' => 'Produk tidak valid.'];
            } elseif ($rating < 1 || $rating > 5) {
                $response = ['status' => 'error', 'message' => 'Rating harus antara 1-5.'];
            } else {
                $kuota_ulasan = $this->Ulasan_model->sisa_kuota_ulasan($id_user, $id_produk);
                if ($kuota_ulasan['total_purchased'] == 0) {
                    $response = ['status' => 'error', 'message' => 'Anda harus membeli produk ini terlebih dahulu.'];
                } elseif ($kuota_ulasan['sisa_kuota'] <= 0) {
                    $response = ['status' => 'error', 'message' => 'Batas ulasan Anda untuk produk ini sudah habis.'];
                } else {
                    $data_ulasan = [
                    'id_user' => $id_user,
                    'id_produk' => $id_produk,
                    'rating' => $rating,
                    'komentar' => htmlspecialchars($komentar, ENT_QUOTES, 'UTF-8'),
                    'status' => 'approved'
                ];

                if ($this->Ulasan_model->tambah_ulasan($data_ulasan)) {
                    $response = ['status' => 'success', 'message' => 'Ulasan berhasil ditambahkan! Terima kasih atas feedback Anda.'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Gagal menambahkan ulasan ke database.'];
                }
            }
        }
    }

        $response['csrf_name'] = $this->security->get_csrf_token_name();
        $response['csrf_hash'] = $this->security->get_csrf_hash();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function ulasan_saya()
    {
        $data['title'] = 'Ulasan Saya';
        $id_user = $this->session->userdata('id');
        
        $this->db->select('u.*, p.nama_produk, p.gambar_produk, t.nama_toko');
        $this->db->from('produk_ulasan u');
        $this->db->join('produk p', 'u.id_produk = p.id', 'left');
        $this->db->join('toko t', 'p.id_toko = t.id', 'left');
        $this->db->where('u.id_user', $id_user);
        $this->db->order_by('u.created_at', 'DESC');
        
        $data['ulasan_saya'] = $this->db->get()->result_array();
        $data['page_content'] = 'user/ulasan_saya';
        $this->load->view('layouts/dashboard_layout', $data);
    }

    public function edit_ulasan()
    {
        if (!$this->input->is_ajax_request()) { show_404(); return; }

        if (!$this->session->userdata('is_logged_in') || $this->session->userdata('role') != 'pengguna') {
            $response = ['status' => 'error', 'message' => 'Sesi Anda telah berakhir. Silakan login kembali.', 'action' => 'reload'];
        } else {
            $id_ulasan = (int)$this->input->post('id_ulasan');
            $rating = (int)$this->input->post('rating');
            $komentar = trim($this->input->post('komentar'));
            $id_user = (int)$this->session->userdata('id');

            $ulasan = $this->Ulasan_model->get_ulasan_by_id($id_ulasan);
            
            if (!$ulasan || $ulasan['id_user'] != $id_user) {
                $response = ['status' => 'error', 'message' => 'Ulasan tidak ditemukan atau bukan milik Anda.'];
            } elseif ($rating < 1 || $rating > 5) {
                $response = ['status' => 'error', 'message' => 'Rating harus antara 1-5.'];
            } else {
                $data_update = [
                    'rating' => $rating,
                    'komentar' => htmlspecialchars($komentar, ENT_QUOTES, 'UTF-8'),
                    'status' => 'approved'
                ];

                if ($this->Ulasan_model->update_ulasan($id_ulasan, $data_update)) {
                    $response = ['status' => 'success', 'message' => 'Ulasan berhasil diperbarui!'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Gagal memperbarui ulasan.'];
                }
            }
        }

        $response['csrf_name'] = $this->security->get_csrf_token_name();
        $response['csrf_hash'] = $this->security->get_csrf_hash();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function hapus_ulasan()
    {
        if (!$this->input->is_ajax_request()) { show_404(); return; }

        if (!$this->session->userdata('is_logged_in') || $this->session->userdata('role') != 'pengguna') {
            $response = ['status' => 'error', 'message' => 'Sesi Anda telah berakhir. Silakan login kembali.', 'action' => 'reload'];
        } else {
            $id_ulasan = (int)$this->input->post('id_ulasan');
            $id_user = (int)$this->session->userdata('id');

            $ulasan = $this->Ulasan_model->get_ulasan_by_id($id_ulasan);
            
            if (!$ulasan || $ulasan['id_user'] != $id_user) {
                $response = ['status' => 'error', 'message' => 'Ulasan tidak ditemukan atau bukan milik Anda.'];
            } else {
                if ($this->Ulasan_model->hapus_ulasan($id_ulasan)) {
                    $response = ['status' => 'success', 'message' => 'Ulasan berhasil dihapus!'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Gagal menghapus ulasan.'];
                }
            }
        }

        $response['csrf_name'] = $this->security->get_csrf_token_name();
        $response['csrf_hash'] = $this->security->get_csrf_hash();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    /**
     * ==================================================================
     * FUNGSI GANTI EMAIL via VERIFIKASI EMAIL LAMA (v6 PATCH)
     * ==================================================================
     */

    /**
     * Halaman form untuk request ganti email
     */
    public function email()
    {
        $user_id = $this->session->userdata('id');
        $data['title'] = 'Ganti Email';
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $data['page_content'] = 'user/email_change_form';
        $this->load->view('layouts/dashboard_layout', $data);
    }

    /**
     * Proses request ganti email (kirim token ke email lama)
     */
    public function email_change_request()
    {
        $this->form_validation->set_rules('new_email', 'Email Baru', 'trim|required|valid_email');
        $this->form_validation->set_message('required', '%s wajib diisi.');
        $this->form_validation->set_message('valid_email', 'Format %s tidak valid.');

        if (!$this->form_validation->run()) {
            return $this->email();
        }

        $new_email = strtolower(trim($this->input->post('new_email', TRUE)));
        $user_id = $this->session->userdata('id');
        $user = $this->User_model->get_user_by_id($user_id);

        // Validasi
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('user/email');
            return;
        }

        if ($new_email === strtolower($user['email'])) {
            $this->session->set_flashdata('error', 'Email baru tidak boleh sama dengan email saat ini.');
            redirect('user/email');
            return;
        }

        if (!$this->User_model->is_email_available($new_email)) {
            $this->session->set_flashdata('error', 'Email baru sudah digunakan pengguna lain.');
            redirect('user/email');
            return;
        }

        // Generate token dan 6-digit code
        $token = bin2hex(random_bytes(16));
        $code = (string)random_int(100000, 999999);
        $expires_at = date('Y-m-d H:i:s', time() + 30 * 60); // 30 menit

        $req_id = $this->User_model->start_email_change([
            'user_id'    => $user_id,
            'old_email'  => $user['email'],
            'new_email'  => $new_email,
            'token'      => $token,
            'code'       => $code,
            'expires_at' => $expires_at,
            'ip'         => $this->input->ip_address(),
            'user_agent' => substr($this->input->user_agent(), 0, 250),
        ]);

        // Kirim email ke email lama
        $this->load->library('email');
        $link = site_url('user/email_change_verify/' . $token);
        
        $message = "
            <h2>Verifikasi Perubahan Email</h2>
            <p>Halo {$user['nama']},</p>
            <p>Kami menerima permintaan untuk mengubah email akun Anda dari <strong>{$user['email']}</strong> menjadi <strong>{$new_email}</strong>.</p>
            <p>Gunakan kode verifikasi berikut:</p>
            <h1 style='font-size: 36px; letter-spacing: 5px; background: #f0f0f0; padding: 10px 20px; border-radius: 8px; display: inline-block;'>{$code}</h1>
            <p>Atau klik tautan berikut:</p>
            <p><a href='{$link}'>{$link}</a></p>
            <p><strong>Kode ini berlaku selama 30 menit.</strong></p>
            <p>Jika Anda tidak meminta perubahan ini, abaikan email ini.</p>
        ";

        $this->email->from($this->config->item('smtp_user') ?: 'no-reply@umkmsalakan.com', 'UMKM Salakan');
        $this->email->to($user['email']);
        $this->email->subject('Verifikasi Perubahan Email - UMKM Salakan');
        $this->email->message($message);
        $ok = @$this->email->send();

        if (!$ok) {
            $this->User_model->delete_email_change($req_id);
            log_message('error', 'Email change send failed: ' . $this->email->print_debugger());
            $this->session->set_flashdata('error', 'Gagal mengirim kode verifikasi ke email lama.');
            redirect('user/email');
            return;
        }

        $this->session->set_flashdata('success', 'Kode verifikasi telah dikirim ke email lama Anda.');
        redirect('user/email_verify');
    }

    /**
     * Halaman input kode verifikasi
     */
    public function email_verify()
    {
        $data['title'] = 'Verifikasi Perubahan Email';
        $data['page_content'] = 'user/email_change_verify';
        $this->load->view('layouts/dashboard_layout', $data);
    }

    /**
     * Verifikasi token/kode dan update email
     */
    public function email_change_verify($token = NULL)
    {
        $user_id = $this->session->userdata('id');
        
        if (!$token) {
            // Verifikasi via kode yang diinput
            $code = trim($this->input->post('code', TRUE));
            if (!$code) {
                redirect('user/email_verify');
                return;
            }
            $rec = $this->User_model->get_email_change_by_code($user_id, $code);
        } else {
            // Verifikasi via link token
            $rec = $this->User_model->get_email_change_by_token($token);
        }

        if (!$rec || (int)$rec['user_id'] !== (int)$user_id) {
            $this->session->set_flashdata('error', 'Token/Kode tidak valid.');
            redirect('user/email');
            return;
        }
        if ($rec['used_at'] !== NULL) {
            $this->session->set_flashdata('error', 'Permintaan ini sudah digunakan.');
            redirect('user/email');
            return;
        }
        if (strtotime($rec['expires_at']) < time()) {
            $this->session->set_flashdata('error', 'Token/Kode sudah kedaluwarsa.');
            redirect('user/email');
            return;
        }

        // Lakukan update email
        $this->db->trans_start();
        $this->User_model->update_email($user_id, strtolower($rec['new_email']));
        $this->User_model->mark_email_change_used($rec['id']);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('error', 'Gagal memperbarui email.');
            redirect('user/email');
            return;
        }

        // Update session
        $this->session->set_userdata('email', strtolower($rec['new_email']));
        $this->session->set_flashdata('success', 'Email berhasil diperbarui!');
        redirect('user/profile');
    }

    /**
     * Halaman Histori / Riwayat Pembelian User
     */
    public function orders()
    {
        $user_id = $this->session->userdata('id');
        $filter  = $this->input->get('status', TRUE) ?: 'all';

        $this->db->select('o.*, t.nama_toko');
        $this->db->from('orders o');
        $this->db->join('toko t', 'o.id_toko = t.id', 'left');
        $this->db->where('o.id_user', $user_id);
        if ($filter !== 'all') {
            $this->db->where('o.status', $filter);
        }
        $this->db->order_by('o.id', 'DESC');
        $orders = $this->db->get()->result_array();

        // Sertakan items masing-masing order
        foreach ($orders as &$order) {
            $order['items'] = $this->Order_model->items_by_order_id($order['order_id']);
        }
        unset($order);

        $data['title']         = 'Riwayat Pembelian';
        $data['orders']        = $orders;
        $data['active_filter'] = $filter;
        $data['page_content']  = 'user/orders';
        $this->load->view('layouts/dashboard_layout', $data);
    }

    /**
     * Detail satu pesanan (modal/standalone jika diperlukan)
     */
    public function order_detail($order_id = '')
    {
        $user_id = $this->session->userdata('id');
        if (!$order_id) { show_404(); return; }

        $order = $this->Order_model->find_by_order_id($order_id);
        if (!$order || (int)$order['id_user'] !== (int)$user_id) { show_404(); return; }

        $order['items'] = $this->Order_model->items_by_order_id($order_id);
        $toko = $this->db->get_where('toko', ['id' => $order['id_toko']])->row_array();

        $data['title']        = 'Detail Pesanan #' . $order_id;
        $data['order']        = $order;
        $data['order_items']  = $order['items'];
        $data['toko']         = $toko;
        $data['page_content'] = 'user/order_detail';
        $this->load->view('layouts/dashboard_layout', $data);
    }
}
