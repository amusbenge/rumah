<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelUser');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('auth', $data);
        } else {
            $this->login();
        }
    }

    private function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->ModelUser->getUserByUsername($username);

        if ($user) {
            if ($user['aktif'] == "aktif") {
                if (password_verify($password, $user['password'])) {
                    if ($user['tipe'] == "admin") {
                        $data['user'] = $user;
                        $this->session->set_userdata($data);
                        echo 'Selamat Datang ' . $user['username'];
                    } elseif ($user['tipe'] == "operator") {
                        $data['user'] = $user;
                        $this->session->set_userdata($data);
                        echo 'Selamat Datang ' . $user['username'];
                    } else {
                        echo 'Selamat Datang ' . $user['username'];
                    }
                } else {
                    $this->session->set_flashdata('pesan', '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> Password yang Anda Masukan Salah.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    ');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> Akun anda belum aktif.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                ');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> Akun anda belum terdaftar.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            ');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user');
        $this->session->set_flashdata('pesan', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> Anda berhasil keluar.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        ');
        redirect('auth');
    }
}
