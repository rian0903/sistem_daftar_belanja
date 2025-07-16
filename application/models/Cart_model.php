<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {

    public function getByUser($user_id) {
        $this->db->select('carts.*, products.name, products.price, products.image');
        $this->db->from('carts');
        $this->db->join('products', 'products.id = carts.product_id');
        $this->db->where('carts.user_id', $user_id);
        return $this->db->get()->result();
    }

    public function addToCart($data) {
        return $this->db->insert('carts', $data);
    }

    public function deleteCart($user_id) {
        return $this->db->delete('carts', ['user_id' => $user_id]);
    }
}
