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
        $data['periode'] = $this->ModelUser->getPeriode();

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('survey/index', $data);
        $this->load->view('footer', $data);
    }

    // public function perbandingan()
    // {
    //     $data['title'] = 'Perbandingan';
    //     $userdata = $this->session->userdata();
    //     $username = $userdata['user']['username'];
    //     $data['user'] = $this->ModelUser->getUser($username);
    //     $data['kriteria'] = $this->ModelAHP->getAllKriteria();
    //     $data['keluarga'] = $this->ModelAHP->getAllKepalaKeluarga();

    //     $this->load->view('header', $data);
    //     $this->load->view('sidebar', $data);
    //     $this->load->view('topbar', $data);
    //     $this->load->view('survey/perbandingan', $data);
    //     $this->load->view('footer', $data);
    // }

    // public function hasil()
    // {
    //     $data['title'] = 'Hasil';
    //     $userdata = $this->session->userdata();
    //     $username = $userdata['user']['username'];
    //     $data['user'] = $this->ModelUser->getUser($username);

    //     $this->load->view('header', $data);
    //     $this->load->view('sidebar', $data);
    //     $this->load->view('topbar', $data);
    //     $this->load->view('survey/hasil', $data);
    //     $this->load->view('footer', $data);
    // }
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
    public function perbandingan($id_dusun = null, $id_kriteria = null)
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
        // var_dump($sum_);
        // die();
        //Panggil ARRAY Perbandingan
        // echo 'here';
        $perbandingan = $this->ModelAHP->getPerbandingan($id_dusun, $id_kriteria);
        foreach ($perbandingan as $i => $banding) {
            $perbandingan[$i]['sum_norm'] = 0;
            foreach ($banding['banding'] as $j => $pembanding) {
                $normalisasi = $pembanding['bobot'] / $sum_[$j]['bobot'];
                $perbandingan[$i]['banding'][$j]['normalisasi'] = $normalisasi;
                $perbandingan[$i]['sum_norm'] += $normalisasi;
                $where2['id'] = $pembanding['id'];
                $data2['normalisasi'] = $normalisasi;
                $this->ModelAHP->updateData($where2, $data2, 'perbandingan_alternatif');
                // echo $pembanding['bobot'] . '/';
                // echo $sum_[$j]['bobot'] . '<br>';
            }
            $data['eigen'] = $perbandingan[$i]['sum_norm'] / count($perbandingan[$i]['banding']);
            $data['lamda'] = $data['eigen'] * $sum_[$i]['bobot'];
            $where['id'] = $banding['id'];
            // var_dump($data);
            // die();

            $this->ModelAHP->updateData($where, $data, 'kriteria_alternatif');
            // echo $data['eigen'] . '<br>';
        }
        redirect('surveyor/perbandingan/' . $id_dusun);
    }
}
