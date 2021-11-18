<?php

class ModelAHP extends CI_Model
{
    public function getAllKriteria() //AMBIL SEMUA KRITERIA
    {
        return $this->db->get('kriteria')->result_array();
    }

    public function inputKriteria($data, $table) //TAMBAH KRITERIA
    {
        $this->db->insert($table, $data);
    }

    public function getAllKepalaKeluarga() //Ambil semua kepala Keluarga
    {
        return $this->db->get('kep_keluarga')->result_array();
    }

    public function getKepalaKelByNoKK($no_kk)
    {
        return $this->db->get_where('kep_keluarga', ['no_kk' => $no_kk])->row_array();
    }
}
