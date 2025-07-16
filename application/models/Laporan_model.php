<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    public function getLaporanTransaksi() {
        $this->db->select('t.*, u.name as pembeli');
        $this->db->from('transactions t');
        $this->db->join('users u', 'u.id = t.user_id');
        return $this->db->get()->result();
    }
}
