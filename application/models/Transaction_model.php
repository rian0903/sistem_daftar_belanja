<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {

    public function insert($data) {
        $this->db->insert('transactions', $data);
        return $this->db->insert_id();
    }

    public function getAll() {
        $this->db->select('transactions.*, users.name as user_name');
        $this->db->from('transactions');
        $this->db->join('users', 'users.id = transactions.user_id');
        return $this->db->get()->result();
    }

    public function getByStatus($status = 'belum') {
        $this->db->where('status', $status);
        return $this->getAll();
    }

    public function updateStatus($id, $data) {
        return $this->db->update('transactions', $data, ['id' => $id]);
    }

    public function getTotalTransaksi() {
        $this->db->select_sum('total');
        return $this->db->get('transactions')->row()->total;
    }
}
