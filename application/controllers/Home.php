<?php
defined('BASEPATH') or exit('no redirect script allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelUser');
    }

    public function index()
    {
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUserByUsername($username);
        
        $this->load->view('home/index');
    }
}
