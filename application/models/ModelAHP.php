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
    }

?>