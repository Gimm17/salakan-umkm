<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Mengambil data user berdasarkan email
     */
    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', array('email' => $email))->row_array();
    }

    /**
     * Menyimpan data user baru
     */
    public function insert_user($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    /**
     * Mengambil semua user beserta data tokonya (jika ada)
     */
    public function get_all_users_with_toko()
    {
        $this->db->select('users.*, toko.id as id_toko, toko.nama_toko, toko.status_persetujuan');
        $this->db->from('users');
        $this->db->join('toko', 'toko.id_user = users.id', 'left');
        return $this->db->get()->result_array();
    }

    /**
     * Mengambil data user berdasarkan ID
     */
    public function get_user_by_id($id)
    {
        return $this->db->get_where('users', array('id' => $id))->row_array();
    }

    /**
     * FUNGSI BARU: Mengupdate data user
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    /**
     * ==================================================================
     * FUNGSI BARU UNTUK LUPA PASSWORD
     * ==================================================================
     */
    public function set_reset_token($email, $token)
    {
        $expires = new DateTime('+1 hour');
        $data = [
            'reset_token' => $token,
            'reset_token_expires_at' => $expires->format('Y-m-d H:i:s')
        ];
        $this->db->where('email', $email);
        return $this->db->update('users', $data);
    }

    public function get_user_by_valid_token($token)
    {
        $this->db->where('reset_token', $token);
        $this->db->where('reset_token_expires_at >', date('Y-m-d H:i:s'));
        return $this->db->get('users')->row_array();
    }

    public function clear_reset_token($user_id)
    {
        $data = ['reset_token' => null, 'reset_token_expires_at' => null];
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }

    /**
     * Mengambil semua user dengan filter berdasarkan role dan status toko
     */
    public function get_all_users_with_filter($role = null, $status_toko = null)
    {
        $this->db->select('u.*, t.nama_toko, t.status_persetujuan');
        $this->db->from('users u');
        $this->db->join('toko t', 'u.id = t.id_user', 'left');
        
        // Filter berdasarkan role
        if (!empty($role)) {
            $this->db->where('u.role', $role);
        }
        
        // Filter berdasarkan status toko
        if (!empty($status_toko)) {
            if ($status_toko == 'tidak_ada') {
                // Pengguna yang tidak punya toko (toko.id_user is NULL)
                $this->db->where('t.id_user IS NULL');
            } else {
                // Filter berdasarkan status persetujuan toko
                $this->db->where('t.status_persetujuan', $status_toko);
            }
        }
        
        return $this->db->get()->result_array();
    }

    /**
     * ==================================================================
     * FUNGSI UNTUK GANTI EMAIL (v6 PATCH)
     * ==================================================================
     */
    
    /**
     * Cek apakah email tersedia (belum digunakan user lain)
     */
    public function is_email_available($email)
    {
        return $this->db->where('LOWER(email)', strtolower($email))
                        ->count_all_results('users') === 0;
    }

    /**
     * Update email user
     */
    public function update_email($user_id, $new_email)
    {
        return $this->db->where('id', (int)$user_id)
                        ->update('users', ['email' => strtolower($new_email)]);
    }

    /**
     * Mulai proses ganti email (simpan request ke tabel user_email_change)
     */
    public function start_email_change($data)
    {
        $row = [
            'user_id'    => (int)$data['user_id'],
            'old_email'  => $data['old_email'],
            'new_email'  => strtolower($data['new_email']),
            'token'      => $data['token'],
            'code'       => $data['code'],
            'expires_at' => $data['expires_at'],
            'used_at'    => NULL,
            'created_at' => date('Y-m-d H:i:s'),
            'ip'         => isset($data['ip']) ? $data['ip'] : NULL,
            'user_agent' => isset($data['user_agent']) ? $data['user_agent'] : NULL,
        ];
        $this->db->insert('user_email_change', $row);
        return $this->db->insert_id();
    }

    /**
     * Hapus request email change
     */
    public function delete_email_change($id)
    {
        $this->db->delete('user_email_change', ['id' => (int)$id]);
    }

    /**
     * Ambil data email change berdasarkan token
     */
    public function get_email_change_by_token($token)
    {
        return $this->db->get_where('user_email_change', ['token' => $token])->row_array();
    }

    /**
     * Ambil data email change berdasarkan user_id dan code
     */
    public function get_email_change_by_code($user_id, $code)
    {
        return $this->db->get_where('user_email_change', [
            'user_id' => (int)$user_id,
            'code'    => (string)$code
        ])->row_array();
    }

    /**
     * Tandai email change sudah digunakan
     */
    public function mark_email_change_used($id)
    {
        return $this->db->where('id', (int)$id)
                        ->update('user_email_change', ['used_at' => date('Y-m-d H:i:s')]);
    }
}
