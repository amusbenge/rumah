<?php
defined('BASEPATH') or exit('no redirect script allowed');

class Dusun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelAHP');
        is_login();
    }

    public function index() // TAMPIL HALAMAN HOME KEPALA DUSUN
    {
        $data['title'] = 'Beranda';
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);
        $data['periode'] = $this->ModelUser->getPeriode();

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('dusun/index', $data);
        $this->load->view('footer', $data);
    }

    public function kep_keluarga() // TAMPIL HALAMAN HOME KEPALA DUSUN
    {
        $data['title'] = 'Kepala Keluarga';

        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $id_user = $userdata['user']['id'];
        $data['user'] = $this->ModelUser->getUser($username);
        $data['kepkel'] = $this->ModelUser->getKepkelByUser($id_user);

        // echo "<pre>";
        // var_dump($data['kepkel']);
        // echo "</pre>";
        // die();

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('dusun/kep_keluarga', $data);
        $this->load->view('footer', $data);
    }

    public function pengajuan()
    {
        $kk = $this->input->post('no_kk');
        $priode = $this->ModelAHP->getPeriode(['status' => 1])['id'];

        foreach ($kk as $k) {
            $data = [
                'no_kk' => $k,
                'id_periode' => $priode
            ];
            //Cek Data Kalau Belum Ada, Insert
            if (!$this->ModelAHP->dataExists($data, 'alternatif')) {
                $this->db->insert('alternatif', $data);
            }
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kepala Keluarga Berhasil di ajukan.</div>');
        redirect('dusun/kep_keluarga');
    }
}
