<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller extends CI_Controller {

    private $toko_id;

    public function __construct() {
        parent::__construct();
        // --- Memastikan semua model yang dibutuhkan sudah dimuat ---
        $this->load->model(['Toko_model', 'Produk_model', 'Ulasan_model', 'Kategori_model', 'User_model']);
        $this->load->library('upload');
        
        // Mengambil ID toko milik penjual yang sedang login
        $toko = $this->Toko_model->get_toko_by_user_id($this->session->userdata('id'));
        $this->toko_id = $toko ? $toko['id'] : NULL;

        // Auth Guard - pastikan user login sebagai penjual dengan toko disetujui
        if (!$this->session->userdata('is_logged_in') || $this->session->userdata('role') !== 'penjual') {
            redirect('login');
        }
        if (!$this->toko_id) {
            $this->session->set_flashdata('error', 'Toko Anda belum disetujui admin.');
            redirect('login');
        }
    }

    /**
     * Halaman utama Dasbor Penjual
     */
    public function index()
    {
        $data['title'] = 'Dasbor Penjual';
        $toko = $this->Toko_model->get_toko_by_user_id($this->session->userdata('id'));
        $toko_id = $toko ? $toko['id'] : 0;
        $data['total_produk'] = $this->Produk_model->count_by_toko($toko_id);
        $data['total_ulasan_produk'] = $this->Ulasan_model->count_ulasan_toko($toko_id);

        $pending_count = 0;
        if ($toko) {
            $pending_count = $this->db->where('status', 'pending')
                ->join('produk', 'produk_ulasan.id_produk = produk.id')
                ->where('produk.id_toko', $toko['id'])
                ->count_all_results('produk_ulasan');
        }
        $data['pending_count'] = $pending_count;
        
        $data['page_content'] = 'seller/dashboard_content'; 
        $this->load->view('layouts/dashboard_layout', $data);
    }
    
    /**
     * FUNGSI BARU: Menampilkan dan memproses halaman edit profil penjual.
     */
    public function profile()
    {
        $user_id = $this->session->userdata('id');
        $data['title'] = 'Edit Profil Penjual';
        $data['user'] = $this->User_model->get_user_by_id($user_id);

        // --- PERUBAHAN VALIDASI DIMULAI ---
        // Aturan validasi dasar untuk nama
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        
        // Hanya jalankan validasi password jika field password diisi
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password Baru', 'required|trim|min_length[8]');
            $this->form_validation->set_rules('pass_confirm', 'Konfirmasi Password', 'required|trim|matches[password]');
        }
        // --- PERUBAHAN VALIDASI SELESAI ---

        if ($this->form_validation->run() == FALSE) {
            $data['page_content'] = 'seller/profile_view';
            $this->load->view('layouts/dashboard_layout', $data);
        } else {
            $update_data = ['nama' => $this->input->post('nama')];

            // --- PERUBAHAN LOGIKA UPDATE DIMULAI ---
            // Hanya update password jika field password diisi dan tidak kosong
            if ($this->input->post('password') && !empty(trim($this->input->post('password')))) {
                $update_data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            // --- PERUBAHAN LOGIKA UPDATE SELESAI ---

            $this->User_model->update_user($user_id, $update_data);
            $this->session->set_userdata('nama', $update_data['nama']);
            $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
            redirect('seller/profile');
        }
    }
    
    /**
     * Halaman untuk menampilkan semua produk milik penjual
     */
    public function produk()
    {
        $data['title'] = 'Katalog Produk';
        $data['produk'] = $this->Produk_model->get_produk_by_toko($this->toko_id);
        
        $data['page_content'] = 'seller/produk/index';
        $this->load->view('layouts/dashboard_layout', $data);
    }

    /**
     * Halaman form dan proses untuk menambah produk baru
     */
    public function tambah_produk() {
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Produk';
            $data['kategori'] = $this->Kategori_model->get_all();
            
            $data['page_content'] = 'seller/produk/create';
            $this->load->view('layouts/dashboard_layout', $data);
        } else {
            $upload_path = FCPATH . 'public/img/produk/';

            if (!is_dir($upload_path) || !is_writable($upload_path)) {
                $this->session->set_flashdata('error', 'Error: Direktori upload tidak valid. Pastikan folder <strong>public/img/produk/</strong> sudah ada dan memiliki izin tulis (writable).');
                redirect('seller/produk/tambah');
                return;
            }
            
            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size']      = 2048; // 2MB
            $config['encrypt_name']  = TRUE;
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('gambar_produk')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('seller/produk/tambah');
            } else {
                $upload_data = $this->upload->data();
                
                $data_insert = [
                    'id_toko'       => $this->toko_id,
                    'nama_produk'   => $this->input->post('nama_produk'),
                    'id_kategori'   => $this->input->post('id_kategori'),
                    'deskripsi'     => $this->input->post('deskripsi'),
                    'harga'         => $this->input->post('harga'),
                    'status_produk' => $this->input->post('status_produk'),
                    'gambar_produk' => $upload_data['file_name'],
                    'link_whatsapp' => $this->input->post('enable_link_whatsapp') ? $this->input->post('link_whatsapp') : NULL,
                    'link_gofood'   => $this->input->post('enable_link_gofood') ? $this->input->post('link_gofood') : NULL,
                    'link_grabfood' => $this->input->post('enable_link_grabfood') ? $this->input->post('link_grabfood') : NULL,
                    'link_shopeefood' => $this->input->post('enable_link_shopeefood') ? $this->input->post('link_shopeefood') : NULL,
                    'link_maxim'    => $this->input->post('enable_link_maxim') ? $this->input->post('link_maxim') : NULL,
                ];
                $this->Produk_model->insert($data_insert);
                $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
                redirect('seller/produk');
            }
        }
    }
    
    /**
     * Halaman form dan proses untuk mengedit produk
     */
    public function edit_produk($id)
    {
        $produk = $this->Produk_model->get_produk($id);
        if (!$produk || $produk['id_toko'] != $this->toko_id) {
            show_404();
        }

        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Produk';
            $data['produk'] = $produk;
            $data['kategori'] = $this->Kategori_model->get_all();

            $data['page_content'] = 'seller/produk/edit';
            $this->load->view('layouts/dashboard_layout', $data);
        } else {
            $data_update = [
                'nama_produk'   => $this->input->post('nama_produk'),
                'id_kategori'   => $this->input->post('id_kategori'),
                'deskripsi'     => $this->input->post('deskripsi'),
                'harga'         => $this->input->post('harga'),
                'status_produk' => $this->input->post('status_produk'),
                'link_whatsapp' => $this->input->post('enable_link_whatsapp') ? $this->input->post('link_whatsapp') : NULL,
                'link_gofood'   => $this->input->post('enable_link_gofood') ? $this->input->post('link_gofood') : NULL,
                'link_grabfood' => $this->input->post('enable_link_grabfood') ? $this->input->post('link_grabfood') : NULL,
                'link_shopeefood' => $this->input->post('enable_link_shopeefood') ? $this->input->post('link_shopeefood') : NULL,
                'link_maxim'    => $this->input->post('enable_link_maxim') ? $this->input->post('link_maxim') : NULL,
            ];

            if (!empty($_FILES['gambar_produk']['name'])) {
                $upload_path = FCPATH . 'public/img/produk/';
                $config['upload_path']   = $upload_path;
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']      = 2048;
                $config['encrypt_name']  = TRUE;
                $this->upload->initialize($config);

                if ($this->upload->do_upload('gambar_produk')) {
                    if ($produk['gambar_produk'] != 'default_produk.jpg') {
                        @unlink(FCPATH . 'public/img/produk/' . $produk['gambar_produk']);
                    }
                    $upload_data = $this->upload->data();
                    $data_update['gambar_produk'] = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('seller/produk/edit/' . $id);
                }
            }

            $this->Produk_model->update($id, $data_update);
            $this->session->set_flashdata('success', 'Produk berhasil diperbarui.');
            redirect('seller/produk');
        }
    }

    /**
     * Proses untuk menghapus produk
     */
    public function hapus_produk($id)
    {
        $produk = $this->Produk_model->get_produk($id);
        if (!$produk || $produk['id_toko'] != $this->toko_id) {
            show_404();
        }

        if ($produk['gambar_produk'] != 'default_produk.jpg') {
            @unlink(FCPATH . 'public/img/produk/' . $produk['gambar_produk']);
        }

        $this->Produk_model->delete($id);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        redirect('seller/produk');
    }

    /**
     * Halaman dan proses untuk pengaturan profil toko
     */
    public function pengaturan_toko()
    {
        $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = 'Pengaturan Toko';
            $data['toko'] = $this->Toko_model->get_toko_by_id($this->toko_id);
            
            $data['page_content'] = 'seller/toko/index';
            $this->load->view('layouts/dashboard_layout', $data);
        }
        else
        {
            $data_update = [
                'nama_toko' => $this->input->post('nama_toko'),
                'deskripsi' => $this->input->post('deskripsi'),
                'alamat' => $this->input->post('alamat'),
                'jam_operasional' => $this->input->post('jam_operasional')
            ];

            if (!empty($_FILES['logo']['name'])) {
                $upload_path = FCPATH . 'public/img/logo/';
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0777, TRUE);
                }
                
                $config['upload_path']   = $upload_path;
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size']      = 1024; // 1MB
                $config['encrypt_name']  = TRUE;
                $this->upload->initialize($config);

                if ($this->upload->do_upload('logo')) {
                    $toko = $this->Toko_model->get_toko_by_id($this->toko_id);
                    if ($toko['logo'] != 'default_logo.jpg') {
                        @unlink(FCPATH . 'public/img/logo/' . $toko['logo']);
                    }
                    $upload_data = $this->upload->data();
                    $data_update['logo'] = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('seller/toko');
                }
            }
            
            $this->Toko_model->update_toko($this->toko_id, $data_update);
            $this->session->set_flashdata('success', 'Profil toko berhasil diperbarui.');
            redirect('seller/toko');
        }
    }

    /**
     * Tambahkan method ini ke Seller.php controller yang sudah ada
     * Letakkan setelah method pengaturan_toko()
     */

    /**
     * Halaman untuk melihat semua ulasan produk dari toko
     */
    public function ulasan()
    {
        $data['title'] = 'Ulasan Produk';
        $data['ulasan_toko'] = $this->Ulasan_model->get_all_ulasan(null, 0, $this->toko_id);
        
        $data['page_content'] = 'seller/ulasan/index';
        $this->load->view('layouts/dashboard_layout', $data);
    }

    /**
     * Menyetujui ulasan (jika ingin sistem approval)
     */
    public function setujui_ulasan($id_ulasan)
    {
        // Cek apakah ulasan milik toko ini
        $ulasan = $this->Ulasan_model->get_ulasan_by_id($id_ulasan);
        if (!$ulasan) {
            $this->session->set_flashdata('error', 'Ulasan tidak ditemukan.');
            redirect('seller/ulasan');
        }
        
        // Cek apakah produk milik toko ini
        $produk = $this->Produk_model->get_produk($ulasan['id_produk']);
        if (!$produk || $produk['id_toko'] != $this->toko_id) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses untuk ulasan ini.');
            redirect('seller/ulasan');
        }
        
        if ($this->Ulasan_model->update_status_ulasan($id_ulasan, 'approved')) {
            $this->session->set_flashdata('success', 'Ulasan berhasil disetujui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyetujui ulasan.');
        }
        
        redirect('seller/ulasan');
    }

    /**
     * Menolak ulasan
     */
    public function tolak_ulasan($id_ulasan)
    {
        // Cek apakah ulasan milik toko ini
        $ulasan = $this->Ulasan_model->get_ulasan_by_id($id_ulasan);
        if (!$ulasan) {
            $this->session->set_flashdata('error', 'Ulasan tidak ditemukan.');
            redirect('seller/ulasan');
        }
        
        // Cek apakah produk milik toko ini
        $produk = $this->Produk_model->get_produk($ulasan['id_produk']);
        if (!$produk || $produk['id_toko'] != $this->toko_id) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses untuk ulasan ini.');
            redirect('seller/ulasan');
        }
        
        if ($this->Ulasan_model->update_status_ulasan($id_ulasan, 'rejected')) {
            $this->session->set_flashdata('success', 'Ulasan berhasil ditolak.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menolak ulasan.');
        }
        
        redirect('seller/ulasan');
    }

    /**
     * Hapus ulasan (jika diperlukan)
     */
    public function hapus_ulasan($id_ulasan)
    {
        // Cek apakah ulasan milik toko ini
        $ulasan = $this->Ulasan_model->get_ulasan_by_id($id_ulasan);
        if (!$ulasan) {
            $this->session->set_flashdata('error', 'Ulasan tidak ditemukan.');
            redirect('seller/ulasan');
        }
        
        // Cek apakah produk milik toko ini
        $produk = $this->Produk_model->get_produk($ulasan['id_produk']);
        if (!$produk || $produk['id_toko'] != $this->toko_id) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses untuk ulasan ini.');
            redirect('seller/ulasan');
        }
        
        if ($this->Ulasan_model->hapus_ulasan($id_ulasan)) {
            $this->session->set_flashdata('success', 'Ulasan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus ulasan.');
        }
        
        redirect('seller/ulasan');
    }
}

/* End of file Seller.php */
/* Location: ./application/controllers/Seller.php */
