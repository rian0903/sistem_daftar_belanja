<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role_id') != 1) {
            redirect('index.php/auth/login');
        }

        $this->load->model([
            'Product_model',
            'Category_model',
            'Transaction_model',
            'Transaction_detail_model',
            'User_model'
        ]);
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['content'] = 'admin/dashboard';
        $this->load->view('admin/layout/master', $data);

    }

    public function stock_barang() {
        $data['title'] = 'Stock Barang';
        $data['products'] = $this->Product_model->getAll();
        $data['content'] = 'admin/stock_barang';
        $this->load->view('admin/layout/master', $data);
    }

    public function input_barang() {
        $data['title'] = 'Input Barang';
        $data['categories'] = $this->Category_model->getAll();
        $data['content'] = 'admin/input_barang';
        $this->load->view('admin/layout/master', $data);
    }

    public function save_barang() {
        $data = [
            'name' => $this->input->post('name'),
            'category_id' => $this->input->post('category'),
            'price' => $this->input->post('price'),
            'quantity' => $this->input->post('quantity'),
            'expired_date' => $this->input->post('expired'),
            'image' => 'default.jpg', // upload nanti
            'qr_code' => 'auto_generated.png'
        ];
        $this->Product_model->insert($data);
        redirect('index.php/admin/stock_barang');
    }

    public function pesanan() {
        $data['title'] = 'Daftar Pesanan';
        $data['pesanan'] = $this->Transaction_model->getByStatus('belum');
        $data['content'] = 'admin/pesanan';
        $this->load->view('admin/layout/master', $data);
    }

    public function laporan() {
        $data['title'] = 'Laporan Transaksi';
        $data['laporan'] = $this->Transaction_model->getAll();
        $data['total'] = $this->Transaction_model->getTotalTransaksi();
        $data['content'] = 'admin/laporan';
        $this->load->view('admin/layout/master', $data);
    }

    public function profile() {
        $data['title'] = 'Profil Admin';
        $data['user'] = $this->User_model->getById($this->session->userdata('user_id'));
        $data['content'] = 'admin/profile';
        $this->load->view('admin/layout/master', $data);
    }
}
