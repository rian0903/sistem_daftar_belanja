<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Role_model');
    }

    public function login() {
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password'); // plain text dari form
        
            $user = $this->User_model->login($email);
        
            if (!$user) {
                $this->session->set_flashdata('error', 'Email tidak ditemukan.');
                redirect('auth/login');
                return;
            }
        
            if (!password_verify($password, $user->password)) {
                $this->session->set_flashdata('error', 'Password salah.');
                redirect('auth/login');
                return;
            }
        
            // ✅ Login berhasil
            $this->session->set_userdata([
                'user_id' => $user->id,
                'role_id' => $user->role_id,
                'user_name' => $user->name,
                'logged_in' => TRUE
            ]);
        
            if ($user->role_id == 1) {
                redirect('admin/dashboard');
            } else {
                redirect('pembeli');
            }
        }
    
        // Form belum dikirim (GET request)
        $this->load->view('auth/login');
    }

    public function register() {
        if ($this->input->post()) {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'role_id' => 2, // default pembeli
                'is_verified' => 0
            ];
            $this->User_model->register($data);
            $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
            redirect('auth/login');
        }
        $this->load->view('auth/register');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('landing');
    }

    public function reset_password() {
        $this->load->view('auth/reset_password');
    }
}
