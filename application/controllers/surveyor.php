<?php
defined('BASEPATH') or exit('no redirect script allowed');

class Surveyor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_login();
    }

    public function index() // TAMPIL HALAMAN HOME SURVEYOR
    {
        $data['title'] = 'Home';
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('survey/index', $data);
        $this->load->view('footer', $data);
    }

    public function perbandingan()
    {
        $data['title'] = 'Perbandingan';
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);
        $data['kriteria'] = $this->ModelAHP->getAllKriteria();
        $data['keluarga'] = $this->ModelAHP->getAllKepalaKeluarga();

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('survey/perbandingan', $data);
        $this->load->view('footer', $data);
    }

    public function hasil()
    {
        $data['title'] = 'Hasil';
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('survey/hasil', $data);
        $this->load->view('footer', $data);
    }
}
