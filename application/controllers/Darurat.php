<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Darurat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function reset_admin()
    {
        $this->form_validation->set_rules('password', 'Password', 'required');
        if (!$this->form_validation->run()) {
            $this->load->view('darurat/reset_admin');
        } else {
            $password = $this->input->post('password');
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            $this->db->where('role_id', 1);
            $this->db->update('user', $data);
            echo 'Password Admin : 12345';
        }
    }
}
