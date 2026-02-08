<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Cek login dan role
        if (!$this->session->userdata('is_logged_in') || $this->session->userdata('role') != 'admin') {
            redirect('login');
        }
        $this->load->model(array('User_model', 'Toko_model', 'Kategori_model'));
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $data['total_user'] = $this->db->count_all('users');
        $data['total_toko'] = $this->db->count_all('toko');
        $data['toko_menunggu'] = $this->db->where('status_persetujuan', 'menunggu')->count_all_results('toko');
        
        // Menentukan file konten yang akan dimuat
        $data['page_content'] = 'admin/dashboard_content'; 

        // Memuat satu file layout utama
        $this->load->view('layouts/dashboard_layout', $data);
    }

    public function profile()
    {
        $user_id = $this->session->userdata('id');
        $data['title'] = 'Edit Profil Admin';
        $data['user'] = $this->User_model->get_user_by_id($user_id);

        // Aturan validasi dasar
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        
        // Hanya jalankan validasi password jika field password diisi
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password Baru', 'required|trim|min_length[8]');
            $this->form_validation->set_rules('pass_confirm', 'Konfirmasi Password', 'required|trim|matches[password]');
        }

        if ($this->form_validation->run() == FALSE) {
            // Tampilkan halaman form
            $data['page_content'] = 'admin/profile_view';
            $this->load->view('layouts/dashboard_layout', $data);
        } else {
            // Proses update data
            $update_data = ['nama' => $this->input->post('nama')];
            
            // Hanya update password jika diisi dan tidak kosong
            if ($this->input->post('password') && !empty(trim($this->input->post('password')))) {
                $update_data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            
            $this->User_model->update_user($user_id, $update_data);
            $this->session->set_userdata('nama', $update_data['nama']);
            $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
            redirect('admin/profile');
        }
    }

    public function manajemen_pengguna()
    {
        $data['title'] = 'Manajemen Pengguna';
        
        // Ambil parameter filter dari URL
        $role = $this->input->get('role');
        $status_toko = $this->input->get('status_toko');
        
        // Load model dengan filter
        $data['users'] = $this->User_model->get_all_users_with_filter($role, $status_toko);
        
        $data['page_content'] = 'admin/users/index';
        $this->load->view('layouts/dashboard_layout', $data);
    }

    public function manajemen_toko()
    {
        $data['title'] = 'Manajemen Toko';
        
        // Ambil parameter filter jika ada
        $filter = $this->input->get('filter');
        
        // Filter data berdasarkan status jika parameter ada
        if ($filter == 'menunggu') {
            $data['toko'] = $this->Toko_model->get_toko_by_status('menunggu');
            $data['filter_active'] = 'menunggu'; // untuk UI aktif filter
        } 
        // Tambahkan kondisi untuk filter disetujui
        else if ($filter == 'disetujui') {
            $data['toko'] = $this->Toko_model->get_toko_by_status('disetujui');
            $data['filter_active'] = 'disetujui'; // untuk UI aktif filter
        }
        else {
            $data['toko'] = $this->Toko_model->get_all_toko_with_owner();
            $data['filter_active'] = 'semua';
        }

        $data['page_content'] = 'admin/toko/index';
        $this->load->view('layouts/dashboard_layout', $data);
    }

    public function setujui_toko($id_toko)
    {
        $this->Toko_model->update_status($id_toko, 'disetujui');
        $this->session->set_flashdata('success', 'Toko berhasil disetujui.');
        // Ubah ini dari admin/toko ke admin/manajemen_toko
        redirect('admin/manajemen_toko');
    }

    public function tolak_toko($id_toko)
    {
        $this->Toko_model->update_status($id_toko, 'ditolak');
        $this->session->set_flashdata('success', 'Toko berhasil ditolak.');
        // Ubah ini dari admin/toko ke admin/manajemen_toko  
        redirect('admin/manajemen_toko');
    }
    
    public function manajemen_kategori()
    {
        // Aturan validasi untuk form tambah kategori
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim|is_unique[kategori.nama_kategori]');

        if ($this->form_validation->run() == TRUE) {
            // Jika validasi sukses, simpan data baru
            $nama_kategori = $this->input->post('nama_kategori');
            $slug = url_title($nama_kategori, 'dash', TRUE);
            $this->Kategori_model->insert(['nama_kategori' => $nama_kategori, 'slug' => $slug]);
            $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan.');
            redirect('admin/manajemen_kategori');
        }

        // Ambil keyword pencarian
        $keyword = $this->input->get('q');
        
        // Siapkan data untuk view
        $data['title'] = 'Manajemen Kategori';
        $data['kategori'] = $this->Kategori_model->get_all($keyword);
        $data['keyword'] = $keyword;
        
        $data['page_content'] = 'admin/kategori/index';
        $this->load->view('layouts/dashboard_layout', $data);
    }

    /**
     * FUNGSI BARU: Memproses update kategori
     */
    public function update_kategori($id)
    {
        $this->form_validation->set_rules('nama_kategori_edit', 'Nama Kategori', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
            $nama_kategori = $this->input->post('nama_kategori_edit');
            $slug = url_title($nama_kategori, 'dash', TRUE);
            $this->Kategori_model->update($id, ['nama_kategori' => $nama_kategori, 'slug' => $slug]);
            $this->session->set_flashdata('success', 'Kategori berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', validation_errors());
        }
        redirect('admin/manajemen_kategori');
    }

    /**
     * FUNGSI BARU: Memproses hapus kategori
     */
    public function hapus_kategori($id)
    {
        // Cek apakah kategori digunakan oleh produk
        $is_used = $this->db->where('id_kategori', $id)->count_all_results('produk');

        if ($is_used > 0) {
            $this->session->set_flashdata('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh produk.');
        } else {
            $this->Kategori_model->delete($id);
            $this->session->set_flashdata('success', 'Kategori berhasil dihapus.');
        }
        redirect('admin/manajemen_kategori');
    }
    /**
     * ==================================================================
     * PERUBAHAN SELESAI
     * ==================================================================
     */

    /**
     * Nonaktifkan toko (status_persetujuan = 'menunggu')
     */
    public function nonaktifkan_toko($id_toko)
    {
        // Update status toko menjadi 'menunggu' (atau bisa juga 'nonaktif' jika ingin tambah enum baru)
        $this->Toko_model->update_status($id_toko, 'menunggu');
        $this->session->set_flashdata('success', 'Toko berhasil dinonaktifkan sementara.');
        redirect('admin/manajemen_toko');
    }

    /**
     * Hapus toko beserta produk terkait
     */
    public function hapus_toko($id_toko)
    {
        // Hapus toko (produk terkait akan ikut terhapus jika foreign key ON DELETE CASCADE)
        $this->db->where('id', $id_toko)->delete('toko');
        $this->session->set_flashdata('success', 'Toko berhasil dihapus beserta produk terkait.');
        redirect('admin/manajemen_toko');
    }
}
