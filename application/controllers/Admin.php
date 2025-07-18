<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') != 1) {
            redirect('auth/login');
        }

        $this->load->model([
            'Product_model',
            'Category_model',
            'Transaction_model',
            'Transaction_detail_model',
            'User_model'
        ]);

        $this->load->library('ciqrcode');
        $this->load->helper(['url', 'download']);
    }

    public function index()
    {
        $data['title']    = 'Dashboard';
        $data['products'] = $this->Product_model->getAll();
        $data['content']  = 'admin/dashboard';
        $data['page']     = 'admin/dashboard';
        $this->load->view('admin/layout/master', $data);
    }

    public function stock_barang()
    {
        $data['title']    = 'Stock Barang';
        $data['products'] = $this->Product_model->getAll();
        $data['content']  = 'admin/stock_barang';
        $data['page']     = 'admin/stock_barang';
        $this->load->view('admin/layout/master', $data);
    }

    public function input_barang()
    {
        $data['title']      = 'Input Barang';
        $data['categories'] = $this->Category_model->getAll();
        $data['content']    = 'admin/input_barang';
        $data['page']       = 'admin/input_barang';
        $this->load->view('admin/layout/master', $data);
    }

    public function save_barang()
    {
        $name     = $this->input->post('name');
        $category = $this->input->post('category');
        $price    = $this->input->post('price');
        $quantity = $this->input->post('quantity');
        $expired  = $this->input->post('expired');

        // ======== Upload Gambar ========
        $config['upload_path']   = './public/image/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        $image_name = 'default.jpg';
        if ($this->upload->do_upload('image')) {
            $uploadData = $this->upload->data();
            $image_name = $uploadData['file_name'];
        }

        $data = [
            'name'         => $name,
            'category_id'  => $category,
            'price'        => $price,
            'quantity'     => $quantity,
            'expired_date' => $expired,
            'image'        => $image_name,
            'qr_code'      => ''
        ];
        $id = $this->Product_model->insert($data);

        // ======== Generate QR Code ========
        $qr_content  = "Name: $name\nQuantity: $quantity\nPrice: Rp. $price";
        $qr_filename = 'qrcode_' . $id . '.png';
        $qr_path     = FCPATH . 'public/assets/qrcode/' . $qr_filename;

        $params['data']     = $qr_content;
        $params['level']    = 'H';
        $params['size']     = 10;
        $params['savename'] = $qr_path;
        $this->ciqrcode->generate($params);

        // Update nama file QR ke DB
        $this->Product_model->update_product($id, ['qr_code' => $qr_filename]);

        // Auto-download QR
        force_download($qr_path, NULL);

        redirect('admin/stock_barang');
    }

    public function edit_barang($id)
    {
        $product = $this->Product_model->get_product_by_id($id);
        if (!$product) {
            show_404();
        }

        $data['product'] = $product;
        $data['page']    = 'admin/edit_barang';
        $data['content'] = $this->load->view('admin/edit_barang', $data, true);
        $this->load->view('admin/layout/master', $data);
    }

    public function update_product()
    {
        $id       = $this->input->post('id');
        $product  = $this->Product_model->get_product_by_id($id);
        if (!$id || !$product) show_404();

        $data = [
            'name'     => $this->input->post('name'),
            'quantity' => $this->input->post('quantity'),
            'price'    => $this->input->post('price')
        ];

        // Cek jika ada gambar baru
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path']   = './public/image/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = 2048;
            $config['file_name']     = uniqid();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                // Hapus gambar lama
                if (!empty($product->image) && file_exists('./public/image/' . $product->image)) {
                    unlink('./public/image/' . $product->image);
                }
                $upload_data   = $this->upload->data();
                $data['image'] = $upload_data['file_name'];
            }
        }

        // Hapus QR lama
        if (!empty($product->qr_code) && file_exists('./public/assets/qrcode/' . $product->qr_code)) {
            unlink('./public/assets/qrcode/' . $product->qr_code);
        }

        // Buat ulang QR baru
        $qr_content  = "Name: " . $data['name'] . "\nQuantity: " . $data['quantity'] . "\nPrice: Rp. " . $data['price'];
        $qr_filename = 'qrcode_' . $id . '.png';
        $qr_path     = FCPATH . 'public/assets/qrcode/' . $qr_filename;

        $params['data']     = $qr_content;
        $params['level']    = 'H';
        $params['size']     = 10;
        $params['savename'] = $qr_path;
        $this->ciqrcode->generate($params);

        $data['qr_code'] = $qr_filename;

        $this->Product_model->update_product($id, $data);
        $this->session->set_flashdata('success', 'Produk berhasil diperbarui.');

        force_download($qr_path, NULL);

        redirect('admin/stock_barang');
    }

    public function delete($id)
    {
        $product = $this->Product_model->get_product_by_id($id);
        if (!$product) show_404();

        // Hapus gambar
        if (!empty($product->image) && file_exists('./public/image/' . $product->image)) {
            unlink('./public/image/' . $product->image);
        }

        // Hapus QR
        if (!empty($product->qr_code) && file_exists('./public/assets/qrcode/' . $product->qr_code)) {
            unlink('./public/assets/qrcode/' . $product->qr_code);
        }

        // Hapus detail transaksi terkait
        $this->db->where('product_id', $id);
        $this->db->delete('transaction_details');

        $this->Product_model->delete($id);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        redirect('admin/stock_barang');
    }

    public function pesanan() {
        $data['title'] = 'Daftar Pesanan';
        $data['pesanan'] = $this->Transaction_model->getByStatus('belum');
        $data['content'] = 'admin/pesanan';
        $data['page'] = 'admin/pesanan';
        $this->load->view('admin/layout/master', $data);
    }

    public function laporan() 
    {
        $this->load->model('Laporan_model');

        $data = [
            'page' => 'admin/laporan',
            'semua' => $this->Laporan_model->get_all(),
            'sukses' => $this->Laporan_model->get_by_status('sudah'),
            'pending' => $this->Laporan_model->get_by_status('belum'),
            'total_sukses' => $this->Laporan_model->get_total_by_status('sudah'),
            'total_pending' => $this->Laporan_model->get_total_by_status('belum'),
        ];

        $this->load->view('admin/layout/master', $data); // hanya panggil master, view akan include otomatis
    }

    public function laporan_pdf()
    {
        $this->load->helper('fpdf');
        $this->load->model('Laporan_model');

        $status = 'sudah'; // kamu bisa ganti sesuai kebutuhan
        $data = $this->Laporan_model->get_by_status($status);
        $total = $this->Laporan_model->get_total_by_status($status);

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        $pdf->Cell(0, 10, 'Laporan Transaksi', 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(10, 10, 'No', 1);
        $pdf->Cell(50, 10, 'Pembeli', 1);
        $pdf->Cell(50, 10, 'Tanggal', 1);
        $pdf->Cell(40, 10, 'Total', 1);
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 12);
        $no = 1;
        foreach ($data as $row) {
            $pdf->Cell(10, 10, $no++, 1);
            $pdf->Cell(50, 10, $row->pembeli, 1);
            $pdf->Cell(50, 10, $row->created_at, 1);
            $pdf->Cell(40, 10, 'Rp ' . number_format($row->total, 0, ',', '.'));
            $pdf->Ln();
        }

        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(150, 10, 'Total Transaksi', 1);
        $pdf->Cell(40, 10, 'Rp ' . number_format($total, 0, ',', '.'));

        if (ob_get_length()) ob_end_clean();
        $pdf->Output('I', 'laporan_transaksi.pdf');
    }



    public function laporan_excel()
    {
        $this->load->model('Laporan_model');
        $data['transaksi'] = $this->Laporan_model->get_all();

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=laporan_transaksi.xls");
        $this->load->view('admin/laporan_excel', $data);
    }
    // Admin profile controller
    public function profile() {
        $data['title'] = 'Profil Admin';
        $data['user'] = $this->User_model->getById($this->session->userdata('user_id'));
        $data['content'] = 'admin/profile';
        $data['page'] = 'admin/profile';
        $this->load->view('admin/layout/master', $data);
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

        redirect('admin/profile');
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

            redirect('admin/profile');
        }
    }

}
