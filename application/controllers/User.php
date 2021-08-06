<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function edit_profil($id)
    {
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $upload = $_FILES['foto'];

        if ($upload) {
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = '1000';
            $config['upload_path'] = './assets/img/auth/user/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $new_foto = $this->upload->data('file_name');
                $this->db->set('foto', $new_foto);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $data = [
            'nama' => htmlspecialchars($nama),
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $this->db->where('id', $id);
        $this->db->update('user', $data);

        $this->session->unset_userdata();
        $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> Data Berhasil di Update, Silahkan melakukan login kembali.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            ');
        redirect('auth');
    }
}
