<?php
defined('BASEPATH') or exit('no redirect script allowed');

class AHP extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model(array('ModelUser', 'ModelAHP'));
    }

    public function index() // FUNGSI UNTUK TAMPILKAN KRITERIA
    {
        $data['title'] = 'Kriteria';
        
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);
        $data['kriteria'] = $this->ModelAHP->getAllKriteria();

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('ahp/kriteria', $data);
        $this->load->view('footer', $data);
    }

    public function tmbh_kriteria() //FUNGSI UTK TAMBAH KRITERIA
    {
        $this->form_validation->set_rules('kriteria', 'Kriteria', 'is_unique[kriteria.kriteria]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Kriteria sudah ada.</div>');
            redirect('ahp');
        } else {
            $data = [
                'kriteria' => htmlspecialchars($this->input->post('kriteria', true))
            ];

            $this->ModelAHP->inputKriteria($data, 'kriteria');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil tambahkan kriteria.</div>');
            redirect('ahp');
        }
    }

}
