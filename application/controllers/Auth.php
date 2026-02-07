<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    // application/controllers/Auth.php
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Toko_model');
        $this->load->library('email');
        $this->load->helper(['url', 'form', 'string']); // <-- TAMBAHKAN 'string' DI SINI
    }

    public function login()
    {
        if ($this->session->userdata('is_logged_in')) {
            $this->_redirect_user();
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login';
            $data['page_content'] = 'auth/login';
            $this->load->view('layouts/public_layout', $data);
        } else {
            $this->_proses_login();
        }
    }

    private function _proses_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_model->get_user_by_email($email);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['role'] == 'penjual') { // Perbaikan: 'penjual' bukan 'seller'
                $toko = $this->Toko_model->get_toko_by_user_id($user['id']);
                if (!$toko || $toko['status_persetujuan'] != 'disetujui') {
                    $this->session->set_flashdata('error', 'Akun penjual Anda belum aktif atau disetujui oleh Admin.');
                    redirect('login');
                }
            }
            // --- PERUBAHAN DIMULAI: Menambahkan 'foto' ke session ---
            $session_data = array(
                'id'            => $user['id'],
                'nama'          => $user['nama'],
                'email'         => $user['email'],
                'role'          => $user['role'],
                'foto'          => $user['foto'], // <-- Tambahkan baris ini
                'is_logged_in'  => TRUE
            );
            $this->session->set_userdata($session_data);
            // --- PERUBAHAN SELESAI ---
            
            $this->_redirect_user();
        } else {
            $this->session->set_flashdata('error', 'Email atau Password salah!');
            redirect('login');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
        $this->form_validation->set_rules('pass_confirm', 'Konfirmasi Password', 'required|trim|matches[password]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Register';
            $data['page_content'] = 'auth/register';
            $this->load->view('layouts/public_layout', $data);
        } else {
            $userData = array(
                'nama' => htmlspecialchars($this->input->post('nama', TRUE)),
                'email' => htmlspecialchars($this->input->post('email', TRUE)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => $this->input->post('role')
            );
            
            $user_id = $this->User_model->insert_user($userData);

            if ($this->input->post('role') == 'penjual') { // Perbaikan: 'penjual'
                $tokoData = array(
                    'id_user' => $user_id,
                    'nama_toko' => 'Toko ' . $this->input->post('nama'),
                    'status_persetujuan' => 'menunggu'
                );
                $this->Toko_model->insert_toko($tokoData);
            }

            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    private function _redirect_user()
    {
        $role = $this->session->userdata('role');
        switch ($role) {
            case 'admin':
                redirect('admin');
                break;
            case 'penjual': // Perbaikan: 'penjual'
                redirect('seller');
                break;
            case 'pengguna': // Perbaikan: 'pengguna'
                redirect('user');
                break;
            default:
                redirect('/');
                break;
        }
    }

    public function forgot_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Lupa Password';
            $data['page_content'] = 'auth/forgot_password';
            $this->load->view('layouts/public_layout', $data);
        } else {
            $email = $this->input->post('email');
            $user = $this->User_model->get_user_by_email($email);

            if ($user) {
                $token = random_string('numeric', 6);
                $this->User_model->set_reset_token($email, $token);
                $this->_send_reset_email($email, $token);
                
                $this->session->set_flashdata('success', 'Kode reset telah dikirim ke email Anda. Silakan cek folder inbox atau spam.');
                redirect('auth/reset_password/' . $token);
            } else {
                $this->session->set_flashdata('error', 'Email tidak terdaftar di sistem kami.');
                redirect('auth/forgot_password');
            }
        }
    }

    public function reset_password($token = null)
    {
        if (!$token) { show_404(); }

        // Cukup periksa apakah token ada di URL, verifikasi nanti setelah form disubmit
        $this->form_validation->set_rules('otp', 'Kode OTP', 'required|trim');
        $this->form_validation->set_rules('password', 'Password Baru', 'required|trim|min_length[8]');
        $this->form_validation->set_rules('pass_confirm', 'Konfirmasi Password', 'required|trim|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Reset Password';
            $data['token'] = $token;
            $data['page_content'] = 'auth/reset_password';
            $this->load->view('layouts/public_layout', $data);
        } else {
            $otp_input = $this->input->post('otp');
            $user = $this->User_model->get_user_by_valid_token($otp_input);
            
            if ($user) {
                $new_password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $this->User_model->update_user($user['id'], ['password' => $new_password]);
                $this->User_model->clear_reset_token($user['id']);

                $this->session->set_flashdata('success', 'Password Anda berhasil direset! Silakan login dengan password baru.');
                redirect('login');
            } else {
                $this->session->set_flashdata('error', 'Kode OTP salah, tidak valid, atau sudah kedaluwarsa.');
                redirect('auth/reset_password/' . $token);
            }
        }
    }

    private function _send_reset_email($email_penerima, $token)
    {
        // Konfigurasi email akan otomatis dimuat dari application/config/email.php
        $this->email->from('no-reply@umkmsalakan.com', 'Admin UMKM Salakan');
        $this->email->to($email_penerima);
        $this->email->subject('Reset Password Akun UMKM Salakan');
        $this->email->message("
            <h2>Lupa Password?</h2>
            <p>Kami menerima permintaan untuk mereset password akun Anda.</p>
            <p>Gunakan kode OTP di bawah ini untuk melanjutkan. Kode ini hanya berlaku selama 1 jam.</p>
            <h1 style='font-size: 36px; letter-spacing: 5px; background: #f0f0f0; padding: 10px 20px; border-radius: 8px;'>$token</h1>
            <p>Jika Anda tidak merasa meminta reset password, abaikan email ini.</p>
        ");

        if (!$this->email->send()) {
            log_message('error', 'Email Gagal Terkirim: ' . $this->email->print_debugger());
        }
    }
}
