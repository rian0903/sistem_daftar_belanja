<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembeli extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role_id') != 2) {
            redirect('auth/login');
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
        $data['products'] = $this->Product_model->getAll();
        $data['page'] = 'pembeli/dashboard';
        $this->load->view('pembeli/layout/master', $data);
            
    }

    public function barang() {
        $q = $this->input->get('q');
        $kategori = $this->input->get('kategori');

        $this->load->model('Product_model');
        $this->load->model('Category_model');

        $data['categories'] = $this->Category_model->get_all();

        $data['products'] = $this->Product_model->get_filtered($q, $kategori);

        $data['content'] = 'pembeli/barang';
        $data['page'] = 'pembeli/barang';
        $this->load->view('pembeli/layout/master', $data);
    }

    public function tambah_keranjang($id) {
        $data = [
            'user_id' => $this->session->userdata('user_id'),
            'product_id' => $id,
            'quantity' => 1
        ];
        $this->Cart_model->addToCart($data);
        redirect('pembeli/keranjang');
    }

    public function keranjang() {
        $data['title'] = 'Keranjang Belanja';
        $data['keranjang'] = $this->Cart_model->getByUser($this->session->userdata('user_id'));
        $data['content'] = 'pembeli/keranjang';
        $data['page'] = 'pembeli/keranjang';
        $this->load->view('pembeli/layout/master', $data);
    }

    public function keranjang_tambah($cart_id) {
        $this->db->set('quantity', 'quantity + 1', FALSE);
        $this->db->where('id', $cart_id);
        $this->db->update('carts');
        redirect('pembeli/keranjang');
    }

    public function keranjang_kurang($cart_id) {
        $cart = $this->db->get_where('carts', ['id' => $cart_id])->row();
        if ($cart->quantity > 1) {
            $this->db->set('quantity', 'quantity - 1', FALSE);
            $this->db->where('id', $cart_id);
            $this->db->update('carts');
        } else {
            $this->db->delete('carts', ['id' => $cart_id]);
        }
        redirect('pembeli/keranjang');
    }

    public function checkout() {
        $data['title'] = 'Checkout';
        $user_id = $this->session->userdata('user_id');
    
        if ($this->input->post()) {
            // Ambil keranjang
            $keranjang = $this->Cart_model->getByUser($user_id);
        
            if (empty($keranjang)) {
                $this->session->set_flashdata('error', 'Keranjang Anda kosong.');
                redirect('pembeli/keranjang');
                return;
            }
        
            $nominal = $this->input->post('nominal', TRUE);
            if (!is_numeric($nominal) || $nominal <= 0) {
                $this->session->set_flashdata('error', 'Nominal pembayaran tidak valid.');
                redirect('pembeli/checkout');
                return;
            }
        
            // Hitung total
            $total = 0;
            $detail = [];
        
            foreach ($keranjang as $item) {
                $subtotal = $item->price * $item->quantity;
                $total += $subtotal;
                $detail[] = [
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ];
            
                // Update stok produk (kurangi quantity)
                $this->db->set('quantity', 'quantity - ' . (int) $item->quantity, FALSE);
                $this->db->where('id', $item->product_id);
                $this->db->update('products');
            }
        
            // Simpan transaksi
            $transaction = [
                'user_id' => $user_id,
                'status' => 'sudah',
                'total' => $total,
                'payment_amount' => $nominal,
                'created_at' => date('Y-m-d H:i:s')
            ];
        
            $transaction_id = $this->Transaction_model->insert($transaction);
        
            foreach ($detail as &$d) {
                $d['transaction_id'] = $transaction_id;
            }
        
            $this->Transaction_detail_model->insertBatch($detail);
            $this->Cart_model->deleteCart($user_id);
        
            // Load library FPDF
            $this->load->library('fpdf');
            $pdf = new FPDF();
            $pdf->AddPage();
                    
            // Judul Struk
            $pdf->SetFont('Arial','B',16);
            $pdf->Cell(190,10,'Struk Pembelian',0,1,'C');
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(190,10,'Tanggal: '.date('d-m-Y H:i'),0,1,'C');
            $pdf->Ln(5);
                    
            // Header Tabel
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(80,10,'Produk',1);
            $pdf->Cell(30,10,'Qty',1);
            $pdf->Cell(40,10,'Harga',1);
            $pdf->Cell(40,10,'Subtotal',1);
            $pdf->Ln();
                    
            $pdf->SetFont('Arial','',12);
            foreach ($keranjang as $item) {
                $subtotal = $item->price * $item->quantity;
                $pdf->Cell(80,10,$item->name,1);
                $pdf->Cell(30,10,$item->quantity,1);
                $pdf->Cell(40,10,'Rp '.number_format($item->price, 0, ',', '.'),1);
                $pdf->Cell(40,10,'Rp '.number_format($subtotal, 0, ',', '.'),1);
                $pdf->Ln();
            }
            
            // Total
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(150,10,'Total Pembayaran',1);
            $pdf->Cell(40,10,'Rp '.number_format($total, 0, ',', '.'),1);
            $pdf->Ln(10);
            
            // Keterangan pembayaran
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(190,10,'Dibayar: Rp '.number_format($nominal, 0, ',', '.'),0,1);
            $pdf->Cell(190,10,'Kembalian: Rp '.number_format($nominal - $total, 0, ',', '.'),0,1);
            
            // Outputkan PDF ke browser
            $pdf->Output('D', 'Struk_Pembelian_' . date('Ymd_His') . '.pdf');
            exit; // penting supaya tidak lanjut ke redirect
            
        } else {
            // Ambil data keranjang untuk ditampilkan di halaman checkout
            $data['keranjang'] = $this->Cart_model->getByUser($user_id);
            $data['content'] = 'pembeli/checkout';
            $data['page'] = 'pembeli/checkout';
            $this->load->view('pembeli/layout/master', $data);
        }
    }

// Pembeli profile controller
    public function profile() {
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->User_model->getById($this->session->userdata('user_id'));
        $data['content'] = 'pembeli/profile';
        $data['page'] = 'pembeli/profile';
        $this->load->view('pembeli/layout/master', $data);
    }


    public function update_profile()
    {
        $this->load->model('User_model');
        $user_id = $this->session->userdata('user_id');

        $data = [
            'name'  => $this->input->post('name'),
            'email' => $this->input->post('email')
        ];

        $this->User_model->update($user_id, $data);
        $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');

        redirect('pembeli/profile');
    }

    public function reset_password()
    {
        $this->load->model('User_model');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('new_password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            $this->profile(); // atau redirect dengan error
        } else {
            $id = $this->session->userdata('user_id');
            $password = password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);

            $updated = $this->User_model->updatePassword($id, $password);

            if ($updated) {
                $this->session->set_flashdata('success', 'Password berhasil diubah!');
            } else {
                $this->session->set_flashdata('error', 'Password gagal diubah atau tidak ada perubahan.');
            }

            redirect('pembeli/profile');
        }
    }
    
}

