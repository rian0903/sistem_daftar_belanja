<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
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

        $this->load->library('qrcode_lib'); 
    }

    public function index() {
        $data['title'] = 'Dashboard';
        $data['content'] = 'admin/dashboard';
        $data['products'] = $this->Product_model->getAll();
        $data['page'] = 'admin/dashboard';
        $this->load->view('admin/layout/master', $data);
    }

    public function stock_barang() {
        $data['title'] = 'Stock Barang';
        $data['products'] = $this->Product_model->getAll();
        $data['content'] = 'admin/stock_barang';
        $data['page'] = 'admin/stock_barang';
        $this->load->view('admin/layout/master', $data);
    }

    public function input_barang() {
        $data['title'] = 'Input Barang';
        $data['categories'] = $this->Category_model->getAll();
        $data['content'] = 'admin/input_barang';
        $data['page'] = 'admin/input_barang';
        $this->load->view('admin/layout/master', $data);
    }

    public function save_barang() {
        $name       = $this->input->post('name');
        $category   = $this->input->post('category');
        $price      = $this->input->post('price');
        $quantity   = $this->input->post('quantity');
        $expired    = $this->input->post('expired');

        // ======== Upload Gambar ========
        $config['upload_path']   = './public/image/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        $image_name = 'default.jpg'; // default jika gagal upload
        if ($this->upload->do_upload('image')) {
            $uploadData = $this->upload->data();
            $image_name = $uploadData['file_name'];
        }

        // ======== Simpan Data ke DB ========
        $data = [
            'name'         => $name,
            'category_id'  => $category,
            'price'        => $price,
            'quantity'     => $quantity,
            'expired_date' => $expired,
            'image'        => $image_name,
            'qr_code'      => '' // Masih disiapkan untuk QR Code nanti
        ];
        $this->Product_model->insert($data);

        redirect('admin/stock_barang');
    }

    public function edit_barang($id)
    {
        $this->load->model('Product_model');

        // Cek apakah ID valid dan produk ditemukan
        $product = $this->Product_model->get_product_by_id($id);
        if (!$product) {
            show_error('ID produk tidak ditemukan.', 404);
        }

        // Jika form disubmit
        if ($this->input->post()) {
            $data = [
                'name'     => $this->input->post('name'),
                'quantity' => $this->input->post('quantity'),
                'price'    => $this->input->post('price'),
                // 'description' => $this->input->post('description'), // Hapus ini jika tidak ada kolom description
            ];

            // Validasi minimal
            if (empty($data['name']) || empty($data['price'])) {
                $data['error'] = 'Nama dan harga harus diisi.';
            } else {
                $this->Product_model->update_product($id, $data);
                redirect('admin/barang'); // Ganti dengan path yang sesuai
            }
        } else {
            $data = ['product' => $product];
        }
        $data['page'] = 'admin/edit_barang';
        $data['content'] = $this->load->view('admin/edit_barang', $data, true);
        $this->load->view('admin/layout/master', $data);
    }

    public function update_product()
    {
        $this->load->model('Product_model');

        $id = $this->input->post('id');

        if (!$id) {
            show_error("ID produk tidak ditemukan.");
        }

        $data = [
            'name' => $this->input->post('name'),
            'quantity' => $this->input->post('quantity'),
            'price' => $this->input->post('price')
        ];

        // Cek jika ada upload image baru
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path']   = './public/image/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = 2048;
            $config['file_name']     = uniqid();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $upload_data = $this->upload->data();
                $data['image'] = $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/edit_barang/' . $id);
            }
        }

        $this->Product_model->update_product($id, $data);

        $this->session->set_flashdata('success', 'Data produk berhasil diperbarui.');
        redirect('admin/stock_barang'); // atau ke halaman dashboard, sesuaikan
    }


    public function delete($id)
    {
        $this->load->model('Product_model');

        // Ambil data produk berdasarkan ID
        $product = $this->Product_model->get_product_by_id($id);

        if (!$product) {
            show_404();
            return;
        }

        // Hapus foto jika ada
        if (!empty($product->photo) && file_exists('./uploads/' . $product->photo)) {
            unlink('./uploads/' . $product->photo);
        }

        // Hapus data dari database
        $this->Product_model->delete_product($id);

        // Redirect kembali ke halaman list produk
        $this->session->set_flashdata('success', 'Data produk berhasil dihapus.');
        redirect('admin/stock_barang'); // ganti dengan nama route/list view kamu
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
        $this->load->model('Laporan_model');
        $data['transaksi'] = $this->Laporan_model->get_all();

        $this->load->library('pdf');
        $this->pdf->load_view('admin/laporan_pdf', $data, true);
        $this->pdf->loadHtml($html);
        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->render();
        $this->pdf->stream("laporan_transaksi.pdf", array("Attachment" => 1));
    }

    public function laporan_excel()
    {
        $this->load->model('Laporan_model');
        $data['transaksi'] = $this->Laporan_model->get_all();

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=laporan_transaksi.xls");
        $this->load->view('admin/laporan_excel', $data);
    }

    public function profile() {
        $data['title'] = 'Profil Admin';
        $data['user'] = $this->User_model->getById($this->session->userdata('user_id'));
        $data['content'] = 'admin/profile';
        $data['page'] = 'admin/profile';
        $this->load->view('admin/layout/master', $data);
    }
    // Admin.php (Controller)
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
