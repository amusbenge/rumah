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

    public function update_kriteria()
    {
        $id_kriteria = $this->input->post('id_kriteria');
        $kriteria = $this->input->post('kriteria');
        $jumlah = $this->input->post('jumlah');
        if ($this->input->post('punya_sub')) {
            $punya_sub = 1;
        } else {
            $punya_sub = 0;
            $this->db->where('id_kriteria', $id_kriteria);
            $this->db->delete('sub_kriteria');
        }
        $data = [
            'kriteria' => $kriteria,
            'punya_sub' => $punya_sub
        ];
        $this->db->where('id', $id_kriteria);
        $this->db->update('kriteria', $data);
        if ($jumlah > 0) {
            $this->tambah_sub_kriteria($id_kriteria, $jumlah);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil update kriteria.</div>');
        }
    }

    public function sub_kriteria($id_kriteria)
    {
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        if (!$this->form_validation->run()) {
            $data['title'] = 'Sub Kriteria';
            $data['kriteria'] = $this->ModelAHP->getSingleKriteria($id_kriteria);
            $data['sub_kriteria'] = $this->ModelAHP->getSubKriteria($id_kriteria);
            $userdata = $this->session->userdata();
            $username = $userdata['user']['username'];
            $data['user'] = $this->ModelUser->getUser($username);
            $this->load->view('header', $data);
            $this->load->view('sidebar');
            $this->load->view('topbar');
            $this->load->view('ahp/sub_kriteria');
            $this->load->view('footer');
        } else {
            $jumlah = $this->input->post('jumlah');
            $this->tambah_sub_kriteria($id_kriteria, $jumlah);
        }
    }

    public function delete_sub_kriteria($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('sub_kriteria');
        redirect('ahp/sub_kriteria/' . $id);
    }

    public function tambah_sub_kriteria($id, $jumlah)
    {
        $data['title'] = 'Sub Kriteria';
        $data['kriteria'] = $this->ModelAHP->getSingleKriteria($id);
        $data['jumlah'] = $jumlah;
        $data['id'] = $id;
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);
        $this->load->view('header', $data);
        $this->load->view('sidebar');
        $this->load->view('topbar');
        $this->load->view('ahp/tambah_sub_kriteria');
        $this->load->view('footer');
    }

    public function simpan_sub_kriteria()
    {
        $id_kriteria = $this->input->post('id_kriteria');
        $sub_kriteria = $this->input->post('sub_kriteria');

        foreach ($sub_kriteria as $key => $nama_sub) {
            $data = [
                'id_kriteria' => $id_kriteria,
                'nama_sub' => $nama_sub
            ];
            if (!$this->ModelAHP->dataExists($data, 'sub_kriteria')) {
                $this->db->insert('sub_kriteria', $data);
            }
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil tambahkan kriteria dan sub Kriteria.</div>');

        redirect('ahp');
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

    public function perhitungan() // FUNGSI UNTUK TAMPILKAN HASIL
    {

        $data['title'] = 'Hasil';

        $periode = $this->ModelAHP->getPeriode(['status' => 1]);
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);
        $data['data_dusun'] = $this->ModelAHP->getHitungDusun($periode['id']);

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('ahp/daftar_dusun_hasil', $data);
        $this->load->view('footer', $data);
    }
    public function hasil($id_dusun)
    {
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $user = $this->ModelUser->getUser($username);
        $periode = $this->ModelAHP->getPeriode(['status' => 1]);
        $dusun = $this->ModelAHP->getDusun($id_dusun);
        $data = [
            'title' => 'Hasil Rangking Calon Penerima Bantuan di ' . $dusun['nama_dusun'],
            'user' => $user,
            'alternatif' => $this->ModelAHP->getHasilAkhirPerDusun($id_dusun, $periode['id']),
            'periode' => $periode,
        ];
        $this->load->view('header', $data);
        $this->load->view('sidebar');
        $this->load->view('topbar');
        $this->load->view('ahp/hasil');
        $this->load->view('footer');
    }
    public function hitung_hasil_akhir()
    {
        $id_dusun = $this->input->post('id_dusun');
        $periode = $this->ModelAHP->getPeriode(['status' => 1]);
        $data_hasil = $this->ModelAHP->getHasilPerKriteria($id_dusun, $periode['id']);

        foreach ($data_hasil as $hasil) {
            $total = 0;
            foreach ($hasil['kriteria'] as $kriteria) {
                $total += $kriteria['eigen'] * $kriteria['bobot'];
            }
            $where['id'] = $hasil['id'];
            $data['hasil'] = $total;
            $this->ModelAHP->updateData($where, $data, 'alternatif');
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil dihitung!</div>');
        redirect('ahp/hasil/' . $id_dusun);
    }
    public function riwayat_hitung($id_periode = null)
    {
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $user = $this->ModelUser->getUser($username);
        if ($id_periode == null) {
            $periode = $this->ModelAHP->getPeriodeSelesai();
            $data = [
                'title' => 'Riwayat Periode',
                'user' => $user,
                'periode' => $periode,
            ];
            $this->load->view('header', $data);
            $this->load->view('sidebar');
            $this->load->view('topbar');
            $this->load->view('ahp/riwayat_periode');
            $this->load->view('footer');
        } else {
            $dusun = $this->ModelAHP->getHasilAkhir($id_periode);
            $periode = $this->ModelAHP->getPeriode(['id' => $id_periode]);
            $data = [
                'title' => 'Riwayat Perankingan Periode ' . $periode['periode'],
                'user' => $user,
                'periode' => $periode,
                'dusun' => $dusun
            ];
            $this->load->view('header', $data);
            $this->load->view('sidebar');
            $this->load->view('topbar');
            $this->load->view('ahp/riwayat_hasil');
            $this->load->view('footer');
        }
    }
    public function cetak_hasil($id_periode)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $dusun = $this->ModelAHP->getHasilAkhir($id_periode);
        $periode = $this->ModelAHP->getPeriode(['id' => $id_periode]);
        $data = [
            'title' => 'Perankingan Periode ' . $periode['periode'],
            'periode' => $periode,
            'dusun' => $dusun
        ];
        $html = $this->load->view('laporan/hasil', ['data' => $data], TRUE);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Perankingan Periode ' . $periode['periode'] . '.pdf', 'I');
    }
}
