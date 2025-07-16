<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembeli extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role_id') != 2) {
            redirect('index.php/auth/login');
        }

        $this->load->model([
            'Product_model',
            'Cart_model',
            'Transaction_model',
            'Transaction_detail_model',
            'Category_model',
            'User_model'
        ]);
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['content'] = 'pembeli/dashboard';
        $this->load->view('pembeli/layout/master', $data);
            
    }

    public function barang() {
        $keyword = $this->input->get('q');
        $kategori = $this->input->get('kategori');
        $data['title'] = 'Lihat Barang';
        $data['products'] = $this->Product_model->search($keyword, $kategori);
        $data['categories'] = $this->Category_model->getAll();
        $data['content'] = 'pembeli/barang';
        $this->load->view('pembeli/layout/master', $data);
    }

    public function tambah_keranjang($id) {
        $data = [
            'user_id' => $this->session->userdata('user_id'),
            'product_id' => $id,
            'quantity' => 1
        ];
        $this->Cart_model->addToCart($data);
        redirect('index.php/pembeli/keranjang');
    }

    public function keranjang() {
        $data['title'] = 'Keranjang Belanja';
        $data['keranjang'] = $this->Cart_model->getByUser($this->session->userdata('user_id'));
        $data['content'] = 'pembeli/keranjang';
        $this->load->view('pembeli/layout/master', $data);
    }

    public function checkout() {
        $data['title'] = 'Checkout';
        if ($this->input->post()) {
            $user_id = $this->session->userdata('user_id');
            $keranjang = $this->Cart_model->getByUser($user_id);

            $total = 0;
            $detail = [];
            foreach ($keranjang as $item) {
                $total += ($item->price * $item->quantity);
                $detail[] = [
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ];
            }

            $transaction = [
                'user_id' => $user_id,
                'status' => 'sudah',
                'total' => $total,
                'payment_amount' => $this->input->post('nominal')
            ];

            $transaction_id = $this->Transaction_model->insert($transaction);
            foreach ($detail as &$d) {
                $d['transaction_id'] = $transaction_id;
            }

            $this->Transaction_detail_model->insertBatch($detail);
            $this->Cart_model->deleteCart($user_id);
            redirect('index.php/pembeli');
        } else {
            $data['content'] = 'pembeli/checkout';
            $this->load->view('pembeli/layout/master', $data);
        }
    }

    public function profile() {
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->User_model->getById($this->session->userdata('user_id'));
        $data['content'] = 'pembeli/profile';
        $this->load->view('pembeli/layout/master', $data);
    }
}
