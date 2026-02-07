<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * FUNGSI BANTUAN (PRIVATE): Untuk menerapkan filter yang sama di fungsi count dan get.
     * Ini adalah inti dari perbaikan agar tidak ada duplikasi kode.
     */
    private function _apply_filters($keyword = null, $kategori_slug = null)
    {
        $this->db->select('produk.*, toko.nama_toko, kategori.nama_kategori, COALESCE(favorit_count.total, 0) as total_favorit');
        $this->db->from('produk');
        $this->db->join('toko', 'toko.id = produk.id_toko');
        $this->db->join('kategori', 'kategori.id = produk.id_kategori');
        
        // Join untuk menghitung favorit
        $this->db->join('(SELECT id_produk, COUNT(*) as total FROM produk_favorit GROUP BY id_produk) as favorit_count', 
                        'favorit_count.id_produk = produk.id', 'left');
        
        $this->db->where('toko.status_persetujuan', 'disetujui');

        if ($keyword) {
            $this->db->like('produk.nama_produk', $keyword);
        }
        if ($kategori_slug) {
            $this->db->where('kategori.slug', $kategori_slug);
        }
    }

    /**
     * FUNGSI BARU: Menghitung total produk berdasarkan filter untuk pagination.
     */
    public function count_all_filtered($keyword = null, $kategori_slug = null)
    {
        $this->_apply_filters($keyword, $kategori_slug);
        // PERBAIKAN UTAMA: Menghapus parameter 'produk' untuk menghindari duplikasi tabel.
        return $this->db->count_all_results();
    }

    /**
     * FUNGSI BARU: Mengambil daftar produk dengan filter, sorting, dan pagination.
     */
    public function get_all_filtered($limit = null, $offset = 0, $keyword = null, $kategori_slug = null, $sort = 'terbaru')
{
    $this->db->select('
        p.*,
        k.nama_kategori,
        t.nama_toko,
        COALESCE(p.rating_rata, 0) as rating_rata,
        COALESCE(p.jumlah_ulasan, 0) as jumlah_ulasan,
        COALESCE(fav.total_favorit, 0) as total_favorit
    ');
    $this->db->from('produk p');
    $this->db->join('kategori k', 'p.id_kategori = k.id', 'left');
    $this->db->join('toko t', 'p.id_toko = t.id', 'left');
    $this->db->join('(SELECT id_produk, COUNT(*) as total_favorit FROM produk_favorit GROUP BY id_produk) fav', 
                    'p.id = fav.id_produk', 'left');
    
    // Filter hanya toko yang disetujui
    $this->db->where('t.status_persetujuan', 'disetujui');
    
    // Filter berdasarkan keyword
    if (!empty($keyword)) {
        $this->db->group_start();
        $this->db->like('p.nama_produk', $keyword);
        $this->db->or_like('p.deskripsi', $keyword);
        $this->db->or_like('t.nama_toko', $keyword);
        $this->db->group_end();
    }
    
    // Filter berdasarkan kategori
    if (!empty($kategori_slug)) {
        $this->db->where('k.slug', $kategori_slug);
    }
    
    // Sorting
    switch ($sort) {
        case 'termurah':
            $this->db->order_by('p.harga', 'ASC');
            break;
        case 'termahal':
            $this->db->order_by('p.harga', 'DESC');
            break;
        case 'rating_tertinggi':
            $this->db->order_by('p.rating_rata', 'DESC');
            $this->db->order_by('p.jumlah_ulasan', 'DESC');
            break;
        case 'terpopuler':
            $this->db->order_by('total_favorit', 'DESC');
            break;
        case 'terbaru':
        default:
            $this->db->order_by('p.created_at', 'DESC');
            break;
    }
    
    if ($limit) {
        $this->db->limit($limit, $offset);
    }
    
    $query = $this->db->get();
    return $query->result_array();
}
    
    // --- FUNGSI LAMA ANDA (TETAP SAMA, TIDAK PERLU DIUBAH) ---

    public function get_produk($id)
{
    $this->db->select('
        p.*,
        k.nama_kategori,
        t.nama_toko,
        t.id as id_toko,
        COALESCE(p.rating_rata, 0) as rating_rata,
        COALESCE(p.jumlah_ulasan, 0) as jumlah_ulasan
    ');
    $this->db->from('produk p');
    $this->db->join('kategori k', 'p.id_kategori = k.id', 'left');
    $this->db->join('toko t', 'p.id_toko = t.id', 'left');
    $this->db->where('p.id', $id);
    $this->db->where('t.status_persetujuan', 'disetujui'); // Hanya toko yang disetujui
    
    $query = $this->db->get();
    return $query->row_array();
}
    
    public function get_produk_by_kategori($id_kategori)
    {
        $this->db->where('produk.id_kategori', $id_kategori);
        return $this->get_produk($id_kategori); 
    }
    
    public function get_produk_by_toko($id_toko)
{
    $this->db->select('
        p.*,
        k.nama_kategori,
        COALESCE(p.rating_rata, 0) as rating_rata,
        COALESCE(p.jumlah_ulasan, 0) as jumlah_ulasan,
        COALESCE(fav.total_favorit, 0) as total_favorit
    ');
    $this->db->from('produk p');
    $this->db->join('kategori k', 'p.id_kategori = k.id', 'left');
    $this->db->join('(SELECT id_produk, COUNT(*) as total_favorit FROM produk_favorit GROUP BY id_produk) fav', 
                    'p.id = fav.id_produk', 'left');
    $this->db->where('p.id_toko', $id_toko);
    $this->db->order_by('p.created_at', 'DESC');
    
    $query = $this->db->get();
    return $query->result_array();
}

    public function insert($data)
    {
        return $this->db->insert('produk', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('produk', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('produk');
    }

    public function count_by_toko($id_toko)
{
    $this->db->where('id_toko', $id_toko);
    return $this->db->count_all_results('produk');
}
}
