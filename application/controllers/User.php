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
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);

        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $upload = $_FILES['foto'];
        $data = [
            'nama' => htmlspecialchars($nama),
            'username' => $username,
        ];
        if ($upload) {
            $config['allowed_types'] = 'jpeg|jpg|png|gif';
            $config['max_size'] = '3000';
            $config['upload_path'] = './assets/img/auth/user/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $old_image = $data['user']['foto'];
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . './assets/img/auth/user/' . $old_image);
                }

                $new_foto = $this->upload->data('file_name');
                // $this->db->set('foto', $new_foto);
                $data['foto'] = $new_foto;
            } else {
                echo $this->upload->display_errors();
            }
        }
        if ($password != null) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }



        $this->db->where('id', $id);
        $this->db->update('user', $data);

        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> Data Anda Berhasil Dirubah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            ');
        redirect('admin');
    }
}
