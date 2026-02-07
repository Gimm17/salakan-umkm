<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * PERUBAHAN: Menambahkan fungsionalitas pencarian (search)
     * Mengambil semua kategori, bisa difilter dengan keyword.
     * @param string|null $keyword
     * @return array
     */
    public function get_all($keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama_kategori', $keyword);
        }
        $this->db->order_by('nama_kategori', 'ASC');
        return $this->db->get('kategori')->result_array();
    }
    
    public function insert($data)
    {
        return $this->db->insert('kategori', $data);
    }

    public function get_by_slug($slug)
    {
        return $this->db->get_where('kategori', array('slug' => $slug))->row_array();
    }

    /**
     * FUNGSI BARU: Mengambil satu kategori berdasarkan ID-nya.
     * Diperlukan untuk proses edit.
     * @param int $id
     * @return array|null
     */
    public function get_by_id($id)
    {
        return $this->db->get_where('kategori', ['id' => $id])->row_array();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('kategori', $data);
    }
    
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('kategori');
    }
}
