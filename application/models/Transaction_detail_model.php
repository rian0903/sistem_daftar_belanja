<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_detail_model extends CI_Model {

    public function insertBatch($data) {
        return $this->db->insert_batch('transaction_details', $data);
    }

    public function getByTransaction($transaction_id) {
        $this->db->select('transaction_details.*, products.name');
        $this->db->from('transaction_details');
        $this->db->join('products', 'products.id = transaction_details.product_id');
        $this->db->where('transaction_id', $transaction_id);
        return $this->db->get()->result();
    }
}
