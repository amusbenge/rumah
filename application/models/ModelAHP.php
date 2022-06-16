<?php

class ModelAHP extends CI_Model
{
    public function getAllKriteria() //AMBIL SEMUA KRITERIA
    {
        $kriteria = $this->db->get('kriteria')->result_array();
        foreach ($kriteria as $i => $k) {
            $kriteria[$i]['sub_kriteria'] = [];
            if ($k['punya_sub'] == 1) {
                $kriteria[$i]['sub_kriteria'] = $this->db->get_where('sub_kriteria', ['id_kriteria' => $k['id']])->result_array();
            }
        }
        return $kriteria;
    }
    public function getSingleKriteria($id)
    {
        return $this->db->get_where('kriteria', ['id' => $id])->row_array();
    }

    public function getAllAlternatif()
    {
        return $this->db->get('alternatif')->result_array();
    }
    public function getDusun($id = null)
    {
        if ($id == null) {
            return $this->db->get('dusun')->result_array();
        } else {
            return $this->db->get_where('dusun', ['id' => $id])->row_array();
        }
    }


    public function inputData($data, $table) //TAMBAH SEMUA DATA BERHUBUNGAN DENGAN AHP
    {
        $this->db->insert($table, $data);
    }
    public function updateData($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function getSubKriteria($id_kriteria)
    {
        $this->db->from('sub_kriteria');
        $this->db->where('id_kriteria', $id_kriteria);
        return $this->db->get()->result_array();
    }

    public function getAllKepalaKeluarga($where = null) //Ambil semua kepala Keluarga 
    {
        $this->db->select('kep_keluarga.*, dusun.nama_dusun');
        $this->db->from('kep_keluarga');
        $this->db->join('dusun', 'dusun.id = kep_keluarga.id_dusun'); //Join dgn dusun supaya bisa ditampilkan
        if ($where != null) {
            $this->db->where($where);
        }
        return $this->db->get()->result_array();
    }

    public function getKepalaKelByNoKK($no_kk)
    {
        return $this->db->get_where('kep_keluarga', ['no_kk' => $no_kk])->row_array();
    }
    public function getAHPDusun($id = null) //PANGGIL DATA AHP BERHUBUNGAN DGN DUSUN
    {
        $periode = $this->getPeriode(['status' => 1])['id'];
        if ($id == null) { //PANGGIL SEMUA DUSUN DAN PRENSENTASE SURVEYNYA
            $sql = "SELECT DISTINCT dusun.*, (SELECT COUNT(*) FROM alternatif JOIN kep_keluarga ON alternatif.no_kk = kep_keluarga.no_kk WHERE alternatif.id_periode = '$periode' AND kep_keluarga.id_dusun = dusun.id) as jumlah_alternatif, (SELECT COUNT(*) FROM kriteria_alternatif JOIN alternatif on kriteria_alternatif.id_alternatif = alternatif.id JOIN kep_keluarga on kep_keluarga.no_kk = alternatif.no_kk WHERE alternatif.id_periode = '$periode' AND kep_keluarga.id_dusun = dusun.id) as jumlah_ada FROM `dusun` LEFT JOIN kep_keluarga ON kep_keluarga.id_dusun = dusun.id LEFT JOIN alternatif ON alternatif.no_kk = kep_keluarga.no_kk LEFT JOIN kriteria_alternatif ON kriteria_alternatif.id_alternatif = alternatif.id GROUP BY dusun.id";
            return $this->db->query($sql)->result_array();
        } else { //MENAMPILKAN KRITERIA BERDASARKAN DUSUN BESERTA JUMLAH YG SUDAH DIHITUNG PER KRITERIA
            $sql = "SELECT DISTINCT kriteria.*, (SELECT COUNT(*) FROM perbandingan_alternatif JOIN kriteria_alternatif on kriteria_alternatif.id = perbandingan_alternatif.id_kriteria_alternatif JOIN alternatif on alternatif.id = kriteria_alternatif.id_alternatif JOIN kep_keluarga on alternatif.no_kk = kep_keluarga.no_kk WHERE kep_keluarga.id_dusun = '$id' AND alternatif.id_periode = '$periode' AND kriteria_alternatif.id_kriteria = kriteria.id) as jumlah_perbandingan FROM kriteria GROUP BY kriteria.id";
            return $this->db->query($sql)->result_array();
        }
    }
    public function getHitungDusun($id_periode)
    {
        $sql = "SELECT dusun.*, (SELECT COUNT(*) FROM kriteria_alternatif join alternatif on alternatif.id = kriteria_alternatif.id_alternatif JOIN kep_keluarga ON kep_keluarga.no_kk = alternatif.no_kk WHERE kep_keluarga.id_dusun = dusun.id AND alternatif.id_periode = '$id_periode') as jumlah_seluruh, (SELECT COUNT(*) FROM kriteria_alternatif join alternatif on alternatif.id = kriteria_alternatif.id_alternatif JOIN kep_keluarga ON kep_keluarga.no_kk = alternatif.no_kk WHERE kep_keluarga.id_dusun = dusun.id AND alternatif.id_periode = '$id_periode' AND kriteria_alternatif.eigen > 0) as jumlah_hitung, (SELECT COUNT(*) FROM alternatif JOIN kep_keluarga on kep_keluarga.no_kk = alternatif.no_kk WHERE kep_keluarga.id_dusun = dusun.id AND alternatif.id_periode = '$id_periode') as jumlah_alternatif, (SELECT COUNT(*) FROM alternatif JOIN kep_keluarga on kep_keluarga.no_kk = alternatif.no_kk WHERE kep_keluarga.id_dusun = dusun.id AND alternatif.id_periode = '$id_periode' AND alternatif.hasil > 0) as jumlah_hitung_alternatif FROM dusun";
        return $this->db->query($sql)->result_array();
    }

    public function getSelesai($id_periode, $id_dusun = null)
    {
        $sql = "SELECT DISTINCT dusun.*,
                (SELECT COUNT(alternatif.id) FROM alternatif
                JOIN kep_keluarga on kep_keluarga.no_kk = alternatif.no_kk
                WHERE kep_keluarga.id_dusun = dusun.id AND alternatif.id_periode = '$id_periode') as jumlah_alter,
                (SELECT COUNT(alternatif.id) FROM alternatif
                JOIN kep_keluarga on kep_keluarga.no_kk = alternatif.no_kk
                WHERE kep_keluarga.id_dusun = dusun.id AND alternatif.id_periode = '$id_periode' AND alternatif.hasil > 0) as jumlah_hasil
                FROM dusun
                JOIN kep_keluarga ON kep_keluarga.id_dusun = dusun.id
                JOIN alternatif on alternatif.no_kk = kep_keluarga.no_kk
                GROUP BY dusun.id";
        $result =  $this->db->query($sql)->result_array();
        return $result;
    }

    public function getCountPerbandingan($id_dusun, $id_kriteria, $id_periode)
    {
        $sql = "SELECT COUNT(*) as jumlah FROM perbandingan_alternatif JOIN kriteria_alternatif on kriteria_alternatif.id = perbandingan_alternatif.id_kriteria_alternatif JOIN alternatif on alternatif.id = kriteria_alternatif.id_alternatif JOIN kep_keluarga on alternatif.no_kk = kep_keluarga.no_kk WHERE kep_keluarga.id_dusun = '$id_dusun' AND alternatif.id_periode = '$id_periode' AND kriteria_alternatif.id_kriteria = '$id_kriteria'";
        return $this->db->query($sql)->row_array();
    }

    public function getAHPForm($id_dusun, $id_kriteria, $id_periode)
    {

        //panggil data alternatif dulu bos
        $this->db->select('kriteria_alternatif.*, kep_keluarga.*');
        $this->db->from('kriteria_alternatif');
        $this->db->join('alternatif', 'alternatif.id = kriteria_alternatif.id_alternatif');
        $this->db->join('kep_keluarga', 'kep_keluarga.no_kk = alternatif.no_kk');
        $this->db->where('id_dusun', $id_dusun);
        $this->db->where('id_kriteria', $id_kriteria);
        $this->db->where('alternatif.id_periode', $id_periode);
        $alternatif = $this->db->get()->result_array();
        if ($alternatif != null) {
            //mulai cari terbanding
            $kecuali = []; //untuk simpan id dari alternatif yang tidak boleh dipanggil
            foreach ($alternatif as $key => $alt) {
                //Panggil data alternatif untuk pembanding
                $kecuali[$key] = $alt['id_alternatif'];
                $this->db->select('kriteria_alternatif.*, kep_keluarga.*');
                $this->db->from('kriteria_alternatif');
                $this->db->join('alternatif', 'alternatif.id = kriteria_alternatif.id_alternatif');
                $this->db->join('kep_keluarga', 'kep_keluarga.no_kk = alternatif.no_kk');
                $this->db->where('id_dusun', $id_dusun);
                $this->db->where('id_kriteria', $id_kriteria);
                $this->db->where('alternatif.id_periode', $id_periode);
                $this->db->where_not_in('kriteria_alternatif.id_alternatif', $kecuali);
                $banding = $this->db->get()->result_array();
                //Simpan di array alternatif dengan index 'banding'
                if ($banding != null) {
                    $alternatif[$key]['banding'] = $banding;
                } else {
                    $alternatif[$key]['banding'] = [];
                }
            }
            return $alternatif;
        } else {
            return null;
        }
    }

    public function getAHPEditForm($id_dusun, $id_kriteria, $id_periode)
    {
        //panggil data alternatif dulu bos
        $this->db->select('kriteria_alternatif.*, kep_keluarga.*');
        $this->db->from('kriteria_alternatif');
        $this->db->join('alternatif', 'alternatif.id = kriteria_alternatif.id_alternatif');
        $this->db->join('kep_keluarga', 'kep_keluarga.no_kk = alternatif.no_kk');
        $this->db->where('id_dusun', $id_dusun);
        $this->db->where('id_kriteria', $id_kriteria);
        $this->db->where('alternatif.id_periode', $id_periode);
        $alternatif = $this->db->get()->result_array();
        if ($alternatif != null) {
            foreach ($alternatif as $key => $alt) {
                $this->db->select('perbandingan_alternatif.*, kep_keluarga.*, kriteria_alternatif.deskripsi');
                $this->db->from('perbandingan_alternatif');
                $this->db->join('alternatif', 'alternatif.id = perbandingan_alternatif.id_alternatif');
                $this->db->join('kep_keluarga', 'kep_keluarga.no_kk = alternatif.no_kk');
                $this->db->join('kriteria_alternatif', 'kriteria_alternatif.id_alternatif = alternatif.id');
                $this->db->where('perbandingan_alternatif.id_kriteria_alternatif', $alt['id']);
                $this->db->where('skala_inverse', 0);
                $this->db->where('kriteria_alternatif.id_kriteria', $id_kriteria);
                $this->db->where('perbandingan_alternatif.id_alternatif !=', $alt['id_alternatif']);
                $banding = $this->db->get()->result_array();
                $alternatif[$key]['banding'] = $banding;
            }
            return $alternatif;
        } else {
            return null;
        }
    }

    public function getAlternatif($id_periode, $id = null, $id_dusun = null)
    {
        // $this->db->distinct('alternatif.id');
        $this->db->select('kep_keluarga.*, alternatif.id as id_alternatif, alternatif.hasil as hasil, periode.periode, periode.status, dusun.nama_dusun, (SELECT distinct COUNT(kriteria_alternatif.id) FROM kriteria_alternatif WHERE alternatif.id = kriteria_alternatif.id_alternatif group by alternatif.id) as jumlah_survey');
        $this->db->from('alternatif');
        $this->db->join('kep_keluarga', 'kep_keluarga.no_kk = alternatif.no_kk');
        $this->db->join('periode', 'periode.id = alternatif.id_periode');
        $this->db->join('dusun', 'dusun.id = kep_keluarga.id_dusun');
        $this->db->where('alternatif.id_periode', $id_periode);
        if ($id_dusun != null) {
            $this->db->where('kep_keluarga.id_dusun', $id_dusun);
        }
        if ($id != null) {
            $this->db->where('alternatif.id', $id);
            $this->db->order_by('alternatif.hasil', 'desc');
            return $this->db->get()->row_array();
        } else {
            $this->db->order_by('alternatif.hasil', 'desc');
            return $this->db->get()->result_array();
        }
    }

    public function cekPengajuan($id_dusun)
    {
        $ada = false;
        $periode = $this->db->get_where('periode', ['status' => 1])->row();
        if ($periode != null) {
            $sql = "SELECT * FROM kep_keluarga join alternatif ON alternatif.no_kk = kep_keluarga.no_kk WHERE alternatif.id_periode = '$periode->id' AND kep_keluarga.id_dusun = '$id_dusun'";
            $results = $this->db->query($sql)->result_array();
            if ($results != null) {
                $ada = true;
            }
        } else {
            $ada = true;
        }
        return $ada;
    }

    public function getAnyAlternatif($id) //Fungsi ini untuk mengambil data alternatif single tanpa memperhatikan periode
    {
        $this->db->select('kep_keluarga.*, alternatif.id as id_alternatif, periode.periode, periode.status, dusun.nama_dusun');
        $this->db->from('alternatif');
        $this->db->join('kep_keluarga', 'kep_keluarga.no_kk = alternatif.no_kk');
        $this->db->join('periode', 'periode.id = alternatif.id_periode');
        $this->db->join('dusun', 'dusun.id = kep_keluarga.id_dusun');
        // $this->db->;
        $this->db->where('alternatif.id', $id);
        return $this->db->get()->row_array();
    }

    public function getSurvey($id_alternatif)
    {
        $this->db->from('kriteria_alternatif');
        $this->db->join('kriteria', 'kriteria.id = kriteria_alternatif.id_kriteria');
        $this->db->join('alternatif', 'alternatif.id = kriteria_alternatif.id_alternatif');
        $this->db->where('id_alternatif', $id_alternatif);
        return $this->db->get()->result_array();
    }

    public function getSkala($id = null) // Ambil Semua Skala atau satu skala saja
    {
        if ($id == null) {
            return $this->db->get('skala')->result_array();
        } else {
            return $this->db->get_where('skala', ['id' => $id])->row_array();
        }
    }
    public function getPeriode($where = null) // Ambil semua periode atau satu periode berdasarkan kondisi
    {
        if ($where == null) {
            return $this->db->get('periode')->result_array();
        } else {
            return $this->db->get_where('periode', $where)->row_array();
        }
    }

    public function getPeriodeSelesai()
    {
        return $this->db->get_where('periode', ['status' => 0])->result_array();
    }

    public function dataExists($where, $table) //Cek apakah data sudah ada
    {
        $data = $this->db->get_where($table, $where)->row();
        if ($data == null) {
            return false; //Return false kalau data belum ada
        } else {
            return true; // True kalau data sudah ada
        }
    }
    public function findIDKAlternatif($id_alternatif, $kriteria)
    {
        return $this->db->get_where('kriteria_alternatif', ['id_alternatif' => $id_alternatif, 'id_kriteria' => $kriteria])->row_array()['id'];
    }
    public function getSingleKAlternatif($where)
    {
        return $this->db->get_where('kriteria_alternatif', $where)->row_array();
    }
    public function sumAlternatif($id_kriteria_alternatif)
    {
        //SELECT ID ALTERNATIF
        $this->db->select_sum('bobot', 'bobot');
        $this->db->select('id_alternatif');
        $this->db->from('v_perbandingan_alt');
        $this->db->where_in('id_kriteria_alternatif', $id_kriteria_alternatif);
        $this->db->group_by('id_alternatif');
        $this->db->order_by('id_alternatif');
        // var_dump($this->db->get()->result_array());
        // die();
        return $this->db->get()->result_array();
        // die();
    }
    public function getPerbandingan($id_dusun, $id_kriteria)
    {
        $periode = $this->getPeriode(['status' => 1])['id'];
        $this->db->select('kriteria_alternatif.*');
        $this->db->from('kriteria_alternatif');
        $this->db->join('alternatif', 'alternatif.id = kriteria_alternatif.id_alternatif');
        $this->db->join('kep_keluarga', 'kep_keluarga.no_kk = alternatif.no_kk');
        $this->db->where('id_kriteria', $id_kriteria);
        $this->db->where('kep_keluarga.id_dusun', $id_dusun);
        $this->db->where('alternatif.id_periode', $periode);
        $this->db->order_by('kriteria_alternatif.id_alternatif');
        $perbandingan = $this->db->get()->result_array();
        foreach ($perbandingan as $key => $banding) {
            $this->db->from('v_perbandingan_alt');
            $this->db->where('id_kriteria_alternatif', $banding['id']);
            $this->db->order_by('id_kriteria_alternatif');
            $pembanding = $this->db->get()->result_array();
            $perbandingan[$key]['banding'] = $pembanding;
        }
        return $perbandingan;
    }
    public function getHasilPerKriteria($id_dusun, $id_periode)
    {
        $this->db->select('alternatif.*');
        $this->db->from('alternatif');
        $this->db->join('kep_keluarga', 'kep_keluarga.no_kk = alternatif.no_kk');
        $this->db->where('kep_keluarga.id_dusun', $id_dusun);
        $this->db->where('alternatif.id_periode', $id_periode);
        $data_hasil = $this->db->get()->result_array();
        foreach ($data_hasil as $key => $hasil) {
            $this->db->select('kriteria_alternatif.eigen, kriteria.bobot');
            $this->db->from('kriteria_alternatif');
            $this->db->join('kriteria', 'kriteria.id = kriteria_alternatif.id_kriteria');
            $this->db->where('kriteria_alternatif.id_alternatif', $hasil['id']);
            $kriteria = $this->db->get()->result_array();
            $data_hasil[$key]['kriteria'] = $kriteria;
        }
        return $data_hasil;
    }

    public function getHasilAkhirPerDusun($id_dusun, $periode)
    {
        $this->db->from('alternatif');
        $this->db->join('kep_keluarga', 'kep_keluarga.no_kk = alternatif.no_kk');
        $this->db->where('alternatif.id_periode', $periode);
        $this->db->where('alternatif.hasil !=', 0);
        $this->db->where('kep_keluarga.id_dusun', $id_dusun);
        $this->db->order_by('hasil', 'desc');
        return $this->db->get()->result_array();
    }
    public function getHasilAkhir($id_periode)
    {
        $this->db->distinct('dusun.*');
        $this->db->from('dusun');
        $this->db->join('kep_keluarga', 'kep_keluarga.id_dusun = dusun.id');
        $this->db->join('alternatif', 'alternatif.no_kk = kep_keluarga.no_kk');
        $this->db->where('alternatif.id_periode', $id_periode);
        $this->db->where('alternatif.hasil !=', 0);
        $this->db->group_by('dusun.id');
        $data_dusun = $this->db->get()->result_array();
        foreach ($data_dusun as $i => $dusun) {
            $data_dusun[$i]['hasil'] = $this->getHasilAkhirPerDusun($dusun['id'], $id_periode);
        }
        return $data_dusun;
    }
}
