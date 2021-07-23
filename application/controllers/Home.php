<?php
defined('BASEPATH') or exit('no redirect script allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('ModelUser');
    }

    public function index()
    {
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['title'] = 'Home';
        $data['user'] = $this->ModelUser->getUserByUsername($username);
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('home/index', $data);
        $this->load->view('footer', $data);
    }
}
