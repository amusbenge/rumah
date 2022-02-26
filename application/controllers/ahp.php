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

            $this->ModelAHP->inputData($data, 'kriteria');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil tambahkan kriteria.</div>');
            redirect('ahp');
        }
    }

    public function skala()
    {
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data = [
            'title' => 'Skala Perbandingan',
            'user' => $this->ModelUser->getUser($username),
            'data_skala' => $this->ModelAHP->getSkala()
        ];
        $this->load->view('header', $data);
        $this->load->view('sidebar');
        $this->load->view('topbar');
        $this->load->view('ahp/skala');
        $this->load->view('footer');
    }

    public function tmbh_skala()
    {
        $this->form_validation->set_rules('nama_skala', 'Nama Skala', 'is_unique[skala.nama_skala]');
        if ($this->form_validation->run() == TRUE) {
            $data = $this->input->post();
            $this->ModelAHP->inputData($data, 'skala');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil tambahkan skala.</div>');
            redirect('ahp/skala');
        } else {
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            $this->session->set_flashdata('message', $this->form_validation->error_string());
            redirect('ahp/skala');
        }
    }


    public function perhitungan($id_dusun = null, $id_kriteria = null)
    {
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $user = $this->ModelUser->getUser($username);
        $periode = $this->ModelAHP->getPeriode(['status' => 1]);
        if ($id_dusun == null && $id_kriteria == null && $periode != null) { //Halaman Menampilkan dusun untuk dipilih.
            $data = [
                'title' => 'Daftar Dusun',
                'data_dusun' => $this->ModelAHP->getAHPDusun(),
                'user' => $user,
                'periode' => $periode
            ];
            $this->load->view('header', $data);
            $this->load->view('sidebar');
            $this->load->view('topbar');
            $this->load->view('ahp/daftar_dusun');
            $this->load->view('footer');
        } elseif ($id_dusun != null && $id_kriteria == null && $periode != null) { // Pilih kriteria Perhitungan
            $data = [
                'title' => 'Perbandingan Berdasarkan Kriteria',
                'data_kriteria' => $this->ModelAHP->getAHPDusun($id_dusun),
                'user' => $user,
                'dusun' => $this->ModelUser->getAllDusun($id_dusun),
                'periode' => $periode
            ];
            $this->load->view('header', $data);
            $this->load->view('sidebar');
            $this->load->view('topbar');
            $this->load->view('ahp/daftar_kriteria');
            $this->load->view('footer');
        } elseif ($id_dusun != null && $id_kriteria != null && $periode != null) { //Form Perbandingan
            $kriteria = $this->ModelAHP->getSingleKriteria($id_kriteria);
            // var_dump($kriteria);
            // die();
            $data = [
                'title' => 'Perbandingan Berdasarkan Kriteria ' . $kriteria['kriteria'],
                // 'alternatif' => $this->ModelAHP->getAHPForm($id_dusun, $id_kriteria, $periode['id']),
                'user' => $user,
                'dusun' => $this->ModelUser->getAllDusun($id_dusun),
                'periode' => $periode,
                'skala' => $this->ModelAHP->getSkala(),
                'kriteria' => $kriteria
            ];
            $countPerbandingan = $this->ModelAHP->getCountPerbandingan($id_dusun, $id_kriteria, $periode['id']);
            if ($countPerbandingan['jumlah'] == 0) {
                $data['alternatif'] = $this->ModelAHP->getAHPForm($id_dusun, $id_kriteria, $periode['id']);
                $this->load->view('header', $data);
                $this->load->view('sidebar');
                $this->load->view('topbar');
                $this->load->view('ahp/perhitungan');
                $this->load->view('footer');
            } else {
                $data['alternatif'] = $this->ModelAHP->getAHPEditForm($id_dusun, $id_kriteria, $periode['id']);
                $this->load->view('header', $data);
                $this->load->view('sidebar');
                $this->load->view('topbar');
                $this->load->view('ahp/edit_perhitungan');
                $this->load->view('footer');
            }
        }
    }
    public function insert_perhitungan()
    {
        //Hanya mau simpan data sa begini panjang ni... 
        // $alternatif = $this->input->post('id_alternatif');
        $kriteria = $this->input->post('id_kriteria');
        $id_dusun = $this->input->post('id_dusun');
        $id_kriteria_alternatif = $this->input->post('id_kriteria_alternatif');
        foreach ($id_kriteria_alternatif as $j => $k_alt) {
            // $kriteria_alternatif = $id_kriteria_alternatif[$j];
            $data = [
                'id_kriteria_alternatif' => $k_alt,
                'id_alternatif' => $this->input->post('id_alternatif_' . $k_alt),
            ];
            if ($this->ModelAHP->dataExists($data, 'perbandingan_alternatif')) {
                $where = $data;
                $data['id_skala'] = 1;
                $this->ModelAHP->updateData($where, $data, 'perbandingan_alternatif');
            } else {
                $data['id_skala'] = 1;
                $this->ModelAHP->inputData($data, 'perbandingan_alternatif');
            }
            $banding = $this->input->post('banding_' . $k_alt);
            if ($banding != null) {
                foreach ($banding as $alter) {
                    $cek = $this->input->post('cek_' . $k_alt . '_' . $alter);
                    $id_skala = $this->input->post('skala_' . $k_alt . '_' . $alter);
                    $alt = $this->input->post('alt_' . $k_alt . '_' . $alter);
                    $alt2 = $this->input->post('alt2_' . $k_alt . '_' . $alter);
                    if ($cek == 'alt') {
                        $alternatif = $alt2;
                        $id_k_alt = $k_alt;
                    } else {
                        $id_k_alt = $this->ModelAHP->findIDKAlternatif($alt2, $kriteria);
                        $alternatif = $alt;
                    }
                    //simpan data perbandingan
                    $data1 = [
                        'id_kriteria_alternatif' =>  $id_k_alt,
                        'id_alternatif' => $alternatif,
                    ];
                    //Data perbandingan invers
                    $kriteria_alt = $this->ModelAHP->getSingleKAlternatif(['id' => $id_k_alt]);
                    $data2 = [
                        'id_kriteria_alternatif' =>  $this->ModelAHP->findIDKAlternatif($alternatif, $kriteria),
                        'id_alternatif' => $kriteria_alt['id_alternatif'],
                    ];
                    // var_dump($data1);
                    // echo '<br>';
                    // var_dump($data2);
                    // die();
                    if ($this->ModelAHP->dataExists($data1, 'perbandingan_alternatif')) {
                        $where = $data1;
                        $data1['id_skala'] = $id_skala;
                        $data1['skala_inverse'] = 0;
                        $this->ModelAHP->updateData($where, $data1, 'perbandingan_alternatif');
                    } else {
                        $data1['id_skala'] = $id_skala;
                        $this->ModelAHP->inputData($data1, 'perbandingan_alternatif');
                    }
                    if ($this->ModelAHP->dataExists($data2, 'perbandingan_alternatif')) {
                        $where = $data2;
                        $data2['id_skala'] = $id_skala;
                        $data2['skala_inverse'] = 1;
                        $this->ModelAHP->updateData($where, $data2, 'perbandingan_alternatif');
                    } else {
                        $data2['id_skala'] = $id_skala;
                        $data2['skala_inverse'] = 1;
                        $this->ModelAHP->inputData($data2, 'perbandingan_alternatif');
                    }
                }
            }
            // echo $alt . '<br>';
        }
        //Hitung su.
        $this->hitung($id_kriteria_alternatif, $kriteria, $id_dusun);
    }
    public function hitung($id_kriteria_alternatif, $id_kriteria, $id_dusun)
    {
        //Sum per kriteria_alternarif
        $sum_ = $this->ModelAHP->sumAlternatif($id_kriteria_alternatif);
        //Panggil ARRAY Perbandingan
        // echo 'here';
        $perbandingan = $this->ModelAHP->getPerbandingan($id_dusun, $id_kriteria);
        $sum_norm = [];
        foreach ($perbandingan as $i => $banding) {
            $perbandingan[$i]['sum_norm'] = 0;
            foreach ($banding['banding'] as $j => $pembanding) {
                $normalisasi = $pembanding['bobot'] / $sum_[$j]['bobot'];
                $perbandingan[$i]['banding'][$j]['normalisasi'] = $normalisasi;
                $perbandingan[$i]['sum_norm'] += $normalisasi;
            }
            $data['eigen'] = $perbandingan[$i]['sum_norm'] / count($perbandingan[$i]['banding']);
            $data['lamda'] = $data['eigen'] * $sum_[$i]['bobot'];
            $where['id'] = $banding['id'];
            // var_dump($data);
            // die();

            $this->ModelAHP->updateData($where, $data, 'kriteria_alternatif');
        }
        redirect('ahp/perhitungan/' . $id_dusun);
    }
    public function hasil() // FUNGSI UNTUK TAMPILKAN HASIL
    {
        $data['title'] = 'Hasil';

        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('ahp/hasil', $data);
        $this->load->view('footer', $data);
    }
}
