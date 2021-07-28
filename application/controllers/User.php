<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function edit($id)
    {

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[3]|max_length[25]|');
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]|max_length[10]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'trim|required|min_length[5]|max_length[10]|matches[password1]');

        if($this->form_validation->run() == false){

        }else {
            
        }

        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');

        $data = [
            'nama' => $nama,
            'username' => $username
        ];

        $upload = $_FILES['foto']['name'];

        if ($upload) {
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = '1000';
            $config['upload_path'] = './assets/img/auth/user';

            $this->load->library('upload', $config);
        }
    }
}
