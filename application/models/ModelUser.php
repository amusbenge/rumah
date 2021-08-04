<?php
    class ModelUser extends CI_Model
    {
        public function getUser($username) //AMBIL USER BERDASARKAN USERNAME
        {
            return $this->db->get_where('user', ['username' => $username])->row_array();
        }

        public function getAllUser() // AMBIL SEMUA USER
        {
            return $this->db->get('user')->result_array();
        }

        public function tmbhUser($data, $table) //TAMBAH USER
        {
            $this->db->insert($table, $data);
        }

        public function hapusUser($table, $id) //HAPUS USER
        {
            $this->db->where('id', $id);
            $this->db->delete($table);
        }
    }
