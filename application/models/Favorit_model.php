<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favorit_model extends CI_Model {

    private $table = 'produk_favorit';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Cek apakah sebuah produk sudah difavoritkan oleh user.
     * @param int $userId ID Pengguna
     * @param int $produkId ID Produk
     * @return bool
     */
    public function is_favorited($userId, $produkId)
    {
        $this->db->where('id_user', (int)$userId);
        $this->db->where('id_produk', (int)$produkId);
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }

    /**
     * Menambahkan produk ke daftar favorit.
     * @param int $userId ID Pengguna
     * @param int $produkId ID Produk
     * @return bool
     */
    public function add($userId, $produkId)
    {
        $data = [
            'id_user' => (int)$userId,
            'id_produk' => (int)$produkId
        ];
        return $this->db->insert($this->table, $data);
    }
    
    /**
     * Menghapus produk dari daftar favorit.
     * @param int $userId ID Pengguna
     * @param int $produkId ID Produk
     * @return bool
     */
    public function remove($userId, $produkId)
    {
        $this->db->where('id_user', (int)$userId);
        $this->db->where('id_produk', (int)$produkId);
        return $this->db->delete($this->table);
    }
    
    /**
     * Mengambil semua produk favorit dari seorang user.
     * @param int $userId
     * @return array
     */
    public function get_favorit_by_user($userId)
    {
        $this->db->select('produk.*, toko.nama_toko, kategori.nama_kategori');
        $this->db->from($this->table);
        $this->db->join('produk', 'produk.id = produk_favorit.id_produk');
        $this->db->join('toko', 'toko.id = produk.id_toko');
        $this->db->join('kategori', 'kategori.id = produk.id_kategori');
        $this->db->where('produk_favorit.id_user', (int)$userId);
        return $this->db->get()->result_array();
    }
}
