<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ambil user berdasarkan email
     *
     * @param string $email
     * @return object|null
     */
    public function get_by_email($email)
    {
        $query = $this->db->get_where('users', ['email' => $email]);
        return $query->row(); // mengembalikan satu baris (object) atau null
    }

    /**
     * Simpan user baru
     *
     * @param string $email
     * @param string $hashed_password
     * @return bool
     */
    public function insert_user($email, $hashed_password)
    {
        return $this->db->insert('users', [
            'email'    => $email,
            'password' => $hashed_password
        ]);
    }
}
