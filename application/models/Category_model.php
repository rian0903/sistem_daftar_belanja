<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function getAll() {
        return $this->db->get('categories')->result();
    }

    public function getById($id) {
        return $this->db->get_where('categories', ['id' => $id])->row();
    }

    public function insert($data) {
        return $this->db->insert('categories', $data);
    }

    public function update($id, $data) {
        return $this->db->update('categories', $data, ['id' => $id]);
    }

    public function delete($id) {
        return $this->db->delete('categories', ['id' => $id]);
    }
}
