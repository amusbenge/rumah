<?php
defined('BASEPATH') or exit('no redirect script allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index() //FUNGSI TAMPIL HALAMAN HOME
    {
        $data['title'] = 'Home';
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('footer', $data);
    }

    public function users() //FUNGSI TAMPIL HALAMAN USERS
    {
        $data['title'] = 'Users';
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);
        $data['users'] = $this->ModelUser->getAllUser();

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('admin/users', $data);
        $this->load->view('footer', $data);
    }

    public function tmbh_user() // FUNGSI TAMBAH USER
    {
        $this->form_validation->set_rules('username', 'username', 'is_unique[user.username]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username sudah ada. Coba dengan Username berbeda.</div>');
            redirect('admin/users');
        } else {
            $tipe = $this->input->post('tipe');

            if ($tipe == "Admin") {
                $role_id = 1;
            } elseif ($tipe == "Surveyor") {
                $role_id = 2;
            } else {
                $role_id = 3;
            }
            
            $foto   = $_FILES['foto'];

            if ($foto = '') {
            } else {
                $config['allowed_types']    = 'jpeg|gif|jpg|png';
                $config['max_size']         = '2048';
                $config['upload_path']      = './assets/img/auth/user/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {
                    $foto = $this->upload->data('file_name');
                } else {
                    echo "Foto Gagal Di-Upload!";
                }
            }

            $data = [
                'nama'      => htmlspecialchars($this->input->post('nama', true)),
                'jk'        => $this->input->post('jk'),
                'username'  => htmlspecialchars($this->input->post('username', true)),
                'foto'      => $foto,
                'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'tipe'      => $tipe,
                'aktif'     => "aktif",
                'role_id'   => $role_id
            ];

            $this->ModelUser->tmbhUser($data, 'user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User berhasil ditambahkan.</div>');
            redirect('admin/users');
        }
    }

    public function hapus_user($id)
    {
        $this->ModelUser->hapusUser('user', $id);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User berhasil dihapus.</div>');
        redirect('admin/users');
    }

}