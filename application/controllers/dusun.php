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
        $id_dusun = $userdata['dusun']['id'];
        $username = $userdata['user']['username'];
        $id_user = $userdata['user']['id'];
        $data['user'] = $this->ModelUser->getUser($username);
        $data['kepkel'] = $this->ModelUser->getKepkelByUser($id_user);
        $data['cekPengajuan'] = $this->ModelAHP->cekPengajuan($id_dusun);
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

    public function tambah_kepkel()
    {
        $data = [
            'no_kk'         => htmlspecialchars($this->input->post('no_kk', true)),
            'nm_kpl_kel'    => htmlspecialchars($this->input->post('nama', true)),
            'alamat'        => htmlspecialchars($this->input->post('alamat', true)),
            'rt'            => htmlspecialchars($this->input->post('rt', true)),
            'rw'            => htmlspecialchars($this->input->post('rw', true)),
            'desa'          => "Kabuna",
            'kec'           => "Kakuluk Mesak",
            'kab'           => "Belu",
            'id_dusun'      => htmlspecialchars($this->session->userdata('dusun')['id'])
        ];

        $this->db->insert('kep_keluarga', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kepala Keluarga berhasil ditambahkan.</div>');
        redirect('dusun/kep_keluarga');
    }

    public function excel_batch_add_kepkel()
    {
        $this->load->library('excel');
        $file = $_FILES['excel']['name'];;
        if ($file == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-error" role="alert">File tidak didukung!.</div>');
            return redirect($_SERVER['HTTP_REFERER']);
        }
        $file_tmp = $_FILES['excel']['tmp_name'];
        try {
            $object = PHPExcel_IOFactory::load($file_tmp);
            $count = 0;
            foreach ($object->getWorksheetIterator() as $worksheet) {

                $highestRow = $worksheet->getHighestRow();

                for ($row = 2; $row <= $highestRow; $row++) {

                    $no_kk = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $alamat = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $rt = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $rw = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    if (!$this->ModelAHP->dataExists(['no_kk' => $no_kk], 'kep_keluarga')) {
                        $data = [
                            'no_kk' => $no_kk,
                            'nm_kpl_kel' => $nama,
                            'alamat' => $alamat,
                            'rt' => $rt,
                            'rw' => $rw,
                            'desa' => 'Kabuna',
                            'kec' => 'Kakuluk Mesak',
                            'kab' => 'Belu',
                            'id_dusun' => $this->session->userdata('dusun')['id'],
                        ];
                        $this->db->insert('kep_keluarga', $data);
                        $count++;
                    }
                }
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $count . ' data berhasil ditambahkan!.</div>');
            return redirect($_SERVER['HTTP_REFERER']);
        } catch (\Throwable $th) {
            echo 'gagal';
            die();
        }
    }

    public function edit_kepkel($no_kk)
    {
        $data['title'] = 'Edit';
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);
        $data['kepkel'] = $this->ModelAHP->getKepalaKelByNoKK($no_kk);

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('dusun/edit_kepkel.php', $data);
        $this->load->view('footer', $data);
    }

    public function update_kepkel($no_kk)
    {
        $data = [
            'no_kk' => $this->input->post('no_kk'),
            'nm_kpl_kel' => $this->input->post('nm_kpl_kel'),
            'alamat' => $this->input->post('alamat'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'desa' => $this->input->post('desa'),
            'kec' => $this->input->post('kec'),
            'kab' => $this->input->post('kab')
        ];

        $this->db->where('no_kk', $no_kk);
        $this->db->update('kep_keluarga', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kepala Keluarga has been updated.</div>');
        redirect('dusun/kep_keluarga');
    }
    public function hapus_kepkel($no_kk)
    {
        $this->db->where('no_kk', $no_kk);
        $this->db->delete('kep_keluarga');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kepala Keluarga berhasil dihapus.</div>');
        redirect('dusun/kep_keluarga');
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

    public function data_pengajuan()
    {
        $periode = $this->db->get_where('periode', ['status' => 1])->row_array();
        if ($periode != null) {
            $kep_keluarga = $this->ModelAHP->getAlternatif($periode['id'], null, $this->session->userdata('dusun')['id']);
            $data['title'] = 'Daftar Kepala Keluarga Yang Diajukan Periode Ini';
            $userdata = $this->session->userdata();
            $username = $userdata['user']['username'];
            $data['user'] = $this->ModelUser->getUser($username);
            $data['kepkel'] = $kep_keluarga;
            $data['periode'] = $periode;

            $this->load->view('header', $data);
            $this->load->view('sidebar');
            $this->load->view('topbar');
            $this->load->view('dusun/data_pengajuan');
            $this->load->view('footer');
        }
    }
    public function riwayat_pengajuan($id_periode = null)
    {
        if ($id_periode == null) {
            $periode = $this->ModelAHP->getPeriodeSelesai();
            $data['title'] = 'Riwayat Periode Selesai';
            $userdata = $this->session->userdata();
            $username = $userdata['user']['username'];
            $data['user'] = $this->ModelUser->getUser($username);
            $data['periode'] = $periode;

            $this->load->view('header', $data);
            $this->load->view('sidebar');
            $this->load->view('topbar');
            $this->load->view('dusun/riwayat_periode');
            $this->load->view('footer');
        } else {
            $periode = $this->ModelAHP->getPeriode(['id' => $id_periode]);
            $kep_keluarga = $this->ModelAHP->getAlternatif($periode['id'], null, $this->session->userdata('dusun')['id']);

            $data['title'] = 'Daftar Kepala Keluarga Yang Diajukan Periode ' . $periode['periode'];
            $userdata = $this->session->userdata();
            $username = $userdata['user']['username'];
            $data['user'] = $this->ModelUser->getUser($username);
            $data['kepkel'] = $kep_keluarga;
            $data['periode'] = $periode;

            $this->load->view('header', $data);
            $this->load->view('sidebar');
            $this->load->view('topbar');
            $this->load->view('dusun/data_pengajuan');
            $this->load->view('footer');
        }
    }
    public function cetak_pengajuan($id_periode)
    {
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $dusun = $this->ModelAHP->getDusun($this->session->userdata('dusun')['id']);
        $periode = $this->ModelAHP->getPeriode(['id' => $id_periode]);
        $kep_keluarga = $this->ModelAHP->getAlternatif($periode['id'], null, $this->session->userdata('dusun')['id']);
        $data = [
            'title' => 'Riwayat Perankingan Periode ' . $periode['periode'] . ' ' . $dusun['nama_dusun'],
            'periode' => $periode,
        ];
        $data['kepkel'] = $kep_keluarga;
        $html = $this->load->view('laporan/pengajuan', ['data' => $data], TRUE);
        $mpdf->WriteHTML($html);
        $mpdf->Output('Perankingan Periode ' . $periode['periode'] . '.pdf', 'I');
    }
}
