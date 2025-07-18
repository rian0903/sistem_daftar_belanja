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
            $password = $this->input->post('password');

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

            if ($user->is_verified != 1) {
                $this->session->set_flashdata('error', 'Akun belum diverifikasi. Silakan cek email kamu.');
                redirect('auth/login');
                return;
            }

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

        $this->load->view('auth/login');
    }

    public function register() {
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $token = bin2hex(random_bytes(32));

            $data = [
                'name' => $this->input->post('name'),
                'email' => $email,
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_verified' => 0,
                'verify_token' => $token
            ];

            $this->User_model->register($data);
            $this->_sendEmail($email, $token, 'verify');

            redirect('auth/email_verification_waiting');
        }

        $this->load->view('auth/register');
    }

    private function _sendEmail($email, $token, $type) {
        $this->load->library('email');

        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'nandariansyah54321@gmail.com',
            'smtp_pass' => 'jkbu fuig jzag fkre', // App Password Gmail
            'smtp_port' => 465,
            'smtp_crypto' => 'ssl',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->email->initialize($config);
        $this->email->from('nandariansyah54321@gmail.com', 'SmartList');
        $this->email->to($email);

        if ($type == 'verify') {
            $this->email->subject('Verifikasi Akun');
            $this->email->message('Klik link berikut untuk verifikasi akunmu: <br><br> 
                <a href="' . base_url() . 'auth/verify?token=' . $token . '">Verifikasi Sekarang</a>');
        }

        if (!$this->email->send()) {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function email_verification_waiting() {
        $this->load->view('auth/email_verification_waiting');
    }

    public function verify() {
        $token = $this->input->get('token');

        if (!$token) {
            $data['status'] = 'invalid';
            return $this->load->view('auth/email_verification_result', $data);
        }

        $user = $this->db->get_where('users', ['verify_token' => $token])->row();

        if ($user) {
            if ($user->is_verified == 1) {
                $data['status'] = 'already';
            } else {
                $this->db->where('id', $user->id);
                $this->db->update('users', ['is_verified' => 1, 'verify_token' => null]);

                // Auto-login setelah verifikasi
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'role_id' => $user->role_id,
                    'user_name' => $user->name,
                    'logged_in' => TRUE
                ]);

                redirect($user->role_id == 1 ? 'admin/dashboard' : 'pembeli');
                return;
            }
        } else {
            $data['status'] = 'invalid';
        }

        $this->load->view('auth/email_verification_result', $data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('landing');
    }

    public function forgotPassword()
    {
        if ($this->input->post()) {
            $email = $this->input->post('email', true);
            $user = $this->db->get_where('users', ['email' => $email])->row();

            if ($user) {
                $token = bin2hex(random_bytes(32));
                $this->db->insert('password_resets', [
                    'email' => $email,
                    'token' => $token,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $reset_link = base_url("reset-password/$token");

                // KIRIM EMAIL (ganti dengan fungsi email kamu)
                $this->sendResetEmail($email, $reset_link);

                $this->session->set_flashdata('success', 'Link reset telah dikirim ke email kamu.');
            } else {
                $this->session->set_flashdata('error', 'Email tidak ditemukan.');
            }

            redirect('forgot-password');
        }

        $this->load->view('auth/forgotpassword');
    }


    public function resetPassword($token = null)
    {
        $reset = $this->db->get_where('password_resets', ['token' => $token])->row();

        if (!$reset) {
            show_error("Link tidak valid atau kadaluarsa.");
        }

        if ($this->input->post()) {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $this->db->where('email', $reset->email)->update('users', ['password' => $password]);

            // Hapus token agar tidak bisa digunakan ulang
            $this->db->delete('password_resets', ['email' => $reset->email]);

            $this->session->set_flashdata('success', 'Password berhasil direset.');
            redirect('auth/login');
        }

        $data['token'] = $token;
        $this->load->view('auth/reset_password', $data);
    }

    private function sendResetEmail($email, $reset_link)
    {
        $this->load->library('email');

        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'nandariansyah54321@gmail.com', // Ganti
            'smtp_pass' => 'jkbu fuig jzag fkre',   // Gunakan App Password jika Gmail
            'smtp_crypto' => 'tls',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        );

        $this->email->initialize($config);

        $this->email->from('nandariansyah54321@gmail.com', 'SmartList');
        $this->email->to($email);
        $this->email->subject('Reset Password');
        $this->email->message("
            <p>Hai,</p>
            <p>Kamu meminta reset password. Klik link berikut untuk reset password kamu:</p>
            <p><a href='$reset_link'>$reset_link</a></p>
            <br>
            <p>Abaikan email ini jika kamu tidak meminta reset password.</p>
        ");

        if (!$this->email->send()) {
            log_message('error', $this->email->print_debugger());
            return false;
        }

        return true;
    }


}
