<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // --- FUNGSI BARU UNTUK HALAMAN DAFTAR TOKO ---
    
    /**
     * FUNGSI BARU: Menghitung total toko yang disetujui berdasarkan pencarian.
     */
    public function count_all_approved($keyword = null)
    {
        $this->db->from('toko');
        $this->db->where('status_persetujuan', 'disetujui');
        if($keyword){
            $this->db->group_start();
            $this->db->like('nama_toko', $keyword);
            $this->db->or_like('alamat', $keyword);
            $this->db->group_end();
        }
        return $this->db->count_all_results();
    }

    /**
     * FUNGSI BARU: Mengambil daftar toko dengan pagination dan pencarian.
     */
    public function get_all_approved($limit, $start, $keyword = null)
    {
        $this->db->from('toko');
        $this->db->where('status_persetujuan', 'disetujui');
        if($keyword){
             $this->db->group_start();
            $this->db->like('nama_toko', $keyword);
            $this->db->or_like('alamat', $keyword);
            $this->db->group_end();
        }
        $this->db->limit($limit, $start);
        $this->db->order_by('nama_toko', 'ASC');
        return $this->db->get()->result_array();
    }
    
    // --- FUNGSI LAINNYA (TETAP SAMA) ---
    public function insert_toko($data)
    {
        return $this->db->insert('toko', $data);
    }

    public function get_toko_by_user_id($id_user)
    {
        return $this->db->get_where('toko', array('id_user' => $id_user))->row_array();
    }

    /**
     * FUNGSI BARU: Mengambil detail toko beserta informasi pemilik
     */
    public function get_toko_by_id($id)
    {
        $this->db->select('toko.*, users.created_at as tanggal_bergabung, users.nama as nama_pemilik, users.email as email_pemilik');
        $this->db->from('toko');
        $this->db->join('users', 'users.id = toko.id_user', 'left');
        $this->db->where('toko.id', $id);
        return $this->db->get()->row_array();
    }
    
    public function get_approved_toko()
    {
        return $this->db->get_where('toko', array('status_persetujuan' => 'disetujui'))->result_array();
    }

    public function get_all_toko_with_owner()
    {
        $this->db->select('toko.*, users.nama as nama_pemilik');
        $this->db->from('toko');
        $this->db->join('users', 'users.id = toko.id_user');
        return $this->db->get()->result_array();
    }
    
    public function update_status($id, $status)
    {
        $this->db->where('id', $id);
        return $this->db->update('toko', array('status_persetujuan' => $status));
    }

    public function update_toko($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('toko', $data);
    }
    
    /**
     * Mengambil toko berdasarkan status
     */
    public function get_toko_by_status($status)
    {
        $this->db->select('t.*, u.nama as nama_pemilik');
        $this->db->from('toko t');
        $this->db->join('users u', 'u.id = t.id_user', 'left');
        $this->db->where('t.status_persetujuan', $status);
        
        // Ubah created_at dengan id (karena tidak ada kolom created_at)
        // atau gunakan kolom lain yang pasti ada di tabel toko
        $this->db->order_by('t.id', 'DESC');
        
        return $this->db->get()->result_array();
    }
}
