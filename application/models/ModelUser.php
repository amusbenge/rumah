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

    public function getAllDusun()
    {
        $this->db->select('*');
        $this->db->from('dusun');
        $this->db->join('user', 'user.id = dusun.id_user');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getUserWhTypDusun()
    {
        return $this->db->get_where('user', array('tipe' => "Kepala Dusun"))->result_array();
    }

    public function tmbhDusun($data, $table) //TAMBAH USER
    {
        $this->db->insert($table, $data);
    }

    public function updateDusun($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('dusun', $data);
    }
}
