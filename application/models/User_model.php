<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function register($data) {
        return $this->db->insert('users', $data);
    }

    public function login($email) {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    public function getAll() {
        return $this->db->get('users')->result();
    }

    public function getById($id) {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function getUserByEmail($email) {
        return $this->db->get_where('users', ['email' => $email])->row_array();
    }

    public function verifyUser($email) {
        $this->db->set('is_verified', 1);
        $this->db->set('verify_token', null);
        $this->db->where('email', $email);
        $this->db->update('users');
    }

    public function update($id, $data) {
        return $this->db->update('users', $data, ['id' => $id]);
    }
    
    public function updatePassword($id, $password)
    {
        $data = ['password' => $password];
        $this->db->where('id', $id);
        return $this->db->update('users', $data); // atau sesuaikan nama tabelnya
    }
}
