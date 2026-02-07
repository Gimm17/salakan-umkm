<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ulasan_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Menambahkan ulasan baru
     */
    public function tambah_ulasan($data)
    {
        $this->db->insert('produk_ulasan', $data);
        $this->_update_product_rating_stats($data['id_produk']); // TAMBAHKAN INI
        return true; // Beri return true agar konsisten
    }

    /**
     * Mengecek apakah user sudah memberikan ulasan untuk produk tertentu
     */
    public function sudah_mengulas($id_user, $id_produk)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('id_produk', $id_produk);
        $query = $this->db->get('produk_ulasan');
        return $query->num_rows() > 0;
    }

    /**
     * Mendapatkan semua ulasan untuk produk tertentu
     */
    public function get_ulasan_produk($id_produk, $limit = null, $offset = 0, $status = 'approved')
    {
        $this->db->select('
            u.id,
            u.rating,
            u.komentar,
            u.created_at,
            us.nama as nama_user,
            us.foto as foto_user
        ');
        $this->db->from('produk_ulasan u');
        $this->db->join('users us', 'u.id_user = us.id', 'left');
        $this->db->where('u.id_produk', $id_produk);
        
        if ($status) {
            $this->db->where('u.status', $status);
        }
        
        $this->db->order_by('u.created_at', 'DESC');
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Menghitung total ulasan untuk produk
     */
    public function count_ulasan_produk($id_produk, $status = 'approved')
    {
        $this->db->where('id_produk', $id_produk);
        if ($status) {
            $this->db->where('status', $status);
        }
        return $this->db->count_all_results('produk_ulasan');
    }

    /**
     * Mendapatkan statistik rating untuk produk
     */
    public function get_rating_stats($id_produk)
    {
        $this->db->select('
            COUNT(*) as total_ulasan,
            ROUND(AVG(rating), 1) as rating_rata,
            SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as bintang_5,
            SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as bintang_4,
            SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as bintang_3,
            SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as bintang_2,
            SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as bintang_1
        ');
        $this->db->where('id_produk', $id_produk);
        $this->db->where('status', 'approved');
        $query = $this->db->get('produk_ulasan');
        return $query->row_array();
    }

    /**
     * Mendapatkan ulasan berdasarkan ID
     */
    public function get_ulasan_by_id($id)
    {
        $this->db->select('
            u.*,
            us.nama as nama_user,
            p.nama_produk
        ');
        $this->db->from('produk_ulasan u');
        $this->db->join('users us', 'u.id_user = us.id', 'left');
        $this->db->join('produk p', 'u.id_produk = p.id', 'left');
        $this->db->where('u.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    /**
     * Update status ulasan (untuk admin/seller)
     */
    public function update_status_ulasan($id, $status)
    {
        $ulasan = $this->get_ulasan_by_id($id); // Dapatkan id_produk sebelum update
        if ($ulasan) {
            $data = [
                'status' => $status,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $this->db->where('id', $id);
            $this->db->update('produk_ulasan', $data);
            $this->_update_product_rating_stats($ulasan['id_produk']); // TAMBAHKAN INI
            return true;
        }
        return false;
    }

    /**
     * Update ulasan (untuk user yang mengulas)
     */
    public function update_ulasan($id, $data)
    {
        $ulasan = $this->get_ulasan_by_id($id); // Dapatkan id_produk sebelum update
        if ($ulasan) {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $this->db->where('id', $id);
            $this->db->update('produk_ulasan', $data);
            $this->_update_product_rating_stats($ulasan['id_produk']); // TAMBAHKAN INI
            return true;
        }
        return false;
    }
    /**
     * Hapus ulasan
     */
    public function hapus_ulasan($id)
    {
        $ulasan = $this->get_ulasan_by_id($id); // Dapatkan id_produk sebelum hapus
        if ($ulasan) {
            $this->db->where('id', $id);
            $this->db->delete('produk_ulasan');
            $this->_update_product_rating_stats($ulasan['id_produk']); // TAMBAHKAN INI
            return true;
        }
        return false;
    }

    /**
     * Mendapatkan ulasan user untuk produk tertentu
     */
    public function get_ulasan_user_produk($id_user, $id_produk)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('id_produk', $id_produk);
        $query = $this->db->get('produk_ulasan');
        return $query->row_array();
    }

    /**
     * Mendapatkan semua ulasan untuk admin/seller
     */
    public function get_all_ulasan($limit = null, $offset = 0, $id_toko = null)
    {
        $this->db->select('
            u.*,
            us.nama as nama_user,
            p.nama_produk,
            t.nama_toko
        ');
        $this->db->from('produk_ulasan u');
        $this->db->join('users us', 'u.id_user = us.id', 'left');
        $this->db->join('produk p', 'u.id_produk = p.id', 'left');
        $this->db->join('toko t', 'p.id_toko = t.id', 'left');
        
        if ($id_toko) {
            $this->db->where('p.id_toko', $id_toko);
        }
        
        $this->db->order_by('u.created_at', 'DESC');
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Menghitung total ulasan untuk admin/seller
     */
    public function count_all_ulasan($id_toko = null)
    {
        if ($id_toko) {
            $this->db->join('produk p', 'produk_ulasan.id_produk = p.id');
            $this->db->where('p.id_toko', $id_toko);
        }
        return $this->db->count_all_results('produk_ulasan');
    }

    /**
     * Menghitung total ulasan untuk toko tertentu
     */
    public function count_ulasan_toko($toko_id)
    {
        $this->db->join('produk', 'produk_ulasan.id_produk = produk.id');
        $this->db->where('produk.id_toko', $toko_id);
        return $this->db->count_all_results('produk_ulasan');
    }

    /**
     * PRIVATE: Menghitung ulang dan memperbarui statistik rating di tabel produk.
     * @param int $id_produk
     */
    private function _update_product_rating_stats($id_produk)
    {
        // 1. Dapatkan statistik terbaru (hanya untuk ulasan yang disetujui)
        $this->db->select('COUNT(*) as total_ulasan, ROUND(AVG(rating), 1) as rating_rata');
        $this->db->where('id_produk', $id_produk);
        $this->db->where('status', 'approved');
        $stats = $this->db->get('produk_ulasan')->row();

        // 2. Siapkan data untuk diupdate ke tabel 'produk'
        $data_update = [
            'jumlah_ulasan' => $stats ? (int)$stats->total_ulasan : 0,
            'rating_rata'   => $stats ? (float)$stats->rating_rata : 0
        ];
        
        // 3. Lakukan update
        $this->db->where('id', $id_produk);
        $this->db->update('produk', $data_update);
    }
}