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
    public function survey_calon($id = null)
    {
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $periode = $this->ModelAHP->getPeriode(['status' => 1]);
        if ($periode != null) {
            if ($id == null) {
                $data = [
                    'title' => 'Daftar Calon Penerima Bantuan Periode ' . $periode['periode'],
                    'periode' => $periode,
                    'kep_keluarga' => $this->ModelAHP->getAlternatif($periode['id'])
                ];
                $data['user'] = $this->ModelUser->getUser($username);
                $this->load->view('header', $data);
                $this->load->view('sidebar');
                $this->load->view('topbar');
                $this->load->view('survey/calon_penerima');
                $this->load->view('footer');
            } else {
                $data = [
                    'title' => 'Survey Penerima Bantuan',
                    'periode' => $periode,
                    'kk' => $this->ModelAHP->getAlternatif($periode['id'], $id),
                    'data_kriteria' => $this->ModelAHP->getAllKriteria()
                ];
                $data['user'] = $this->ModelUser->getUser($username);
                $this->load->view('header', $data);
                $this->load->view('sidebar');
                $this->load->view('topbar');
                $this->load->view('survey/survey_penerima');
                $this->load->view('footer');
            }
        } else {
            echo 'Belum ada data periode yang aktif';
        }
    }
    public function insert_survey()
    {
        $id_kriteria = $this->input->post('id_kriteria');
        $id_alternatif = $this->input->post('id_alternatif');
        foreach ($id_kriteria as $kriteria) {
            $data = [
                'id_kriteria' => $kriteria,
                'id_alternatif' => $id_alternatif,
            ];
            if (!$this->ModelAHP->dataExists($data, 'kriteria_alternatif')) {
                $data['deskripsi'] = $this->input->post('deskripsi_' . $kriteria);
                $this->ModelAHP->inputData($data, 'kriteria_alternatif');
            } else {
                $where = $data;
                $data = ['deskripsi' => $this->input->post('deskripsi_' . $kriteria)];
                $this->ModelAHP->updateData($where, $data, 'kriteria_alternatif');
            }
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Dikirim.</div>');
        redirect('surveyor/survey_calon');
    }
}
