<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function getAll() {
        $this->db->select('products.*, categories.name as category_name');
        $this->db->from('products');
        $this->db->join('categories', 'categories.id = products.category_id');
        return $this->db->get()->result();
    }

    public function get_product_by_id($id)
    {
        return $this->db->get_where('products', ['id' => $id])->row();
    }

    public function insert($data)
    {
        $this->db->insert('products', $data);
        return $this->db->insert_id(); 
    }

    public function update_product($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function delete($id) {
        return $this->db->delete('products', ['id' => $id]);
    }

    public function searchByQR($qr_code) {
        return $this->db->get_where('products', ['qr_code' => $qr_code])->row();
    }

    public function search($keyword = null, $category = null) {
        if (!empty($keyword)) {
            $this->db->like('products.name', $keyword);
        }
    
        if (!empty($category)) {
            $this->db->where('products.category_id', $category);
        }
    
        return $this->db->get('products')->result();
    }

    public function get_filtered($q = null, $kategori = null)
    {
        $this->db->select('*')->from('products');
        if ($q) {
            $this->db->like('name', $q);
        }
        if ($kategori) {
            $this->db->where('category_id', $kategori);
        }
        return $this->db->get()->result();
    }
    
    
}
