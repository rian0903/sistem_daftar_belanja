<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    public function get_all() {
        $this->db->select('t.*, u.name as pembeli');
        $this->db->from('transactions t');
        $this->db->join('users u', 'u.id = t.user_id');
        return $this->db->get()->result();
    }

    public function get_by_status($status) {
        $this->db->select('t.*, u.name as pembeli');
        $this->db->from('transactions t');
        $this->db->join('users u', 'u.id = t.user_id');
        $this->db->where('t.status', $status);
        return $this->db->get()->result();
    }

    public function get_total_by_status($status) {
        $this->db->select_sum('t.total');
        $this->db->from('transactions t');
        $this->db->join('users u', 'u.id = t.user_id');
        $this->db->where('t.status', $status);
        return $this->db->get()->row()->total;
    }
}

    // public function getLaporanTransaksi() {
    //     $this->db->select('t.*, u.name as pembeli');
    //     $this->db->from('transactions t');
    //     $this->db->join('users u', 'u.id = t.user_id');
    //     return $this->db->get()->result();
    // }