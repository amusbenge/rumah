<?php
defined('BASEPATH') or exit('no redirect script allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('ModelUser');
    }

    public function index()
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

    public function users()
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

}