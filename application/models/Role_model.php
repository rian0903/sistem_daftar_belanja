<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model {

    public function getAll() {
        return $this->db->get('roles')->result();
    }

    public function getById($id) {
        return $this->db->get_where('roles', ['id' => $id])->row();
    }
}
