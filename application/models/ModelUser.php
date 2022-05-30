<?php
class ModelUser extends CI_Model
{
    public function getUser($username) //AMBIL USER BERDASARKAN USERNAME
    {
        $this->db->select('user.*, user_role.role');
        $this->db->from('user');
        $this->db->join('user_role', 'user_role.id = user.role_id');
        $this->db->where('username', $username);
        return $this->db->get()->row_array();
    }

    public function getAllUser() // AMBIL SEMUA USER
    {
        $this->db->select('user.*, user_role.role, dusun.id as id_dusun, dusun.nama_dusun');
        $this->db->from('user');
        $this->db->join('user_role', 'user_role.id = user.role_id');
        $this->db->join('dusun', 'dusun.id_user = user.id', 'left');
        return $this->db->get()->result_array();
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

    public function getAllDusun($id_dusun = null)
    {
        if ($id_dusun == null) {
            $this->db->select('dusun.*, user.id as id_user, user.nama, user.jabatan as jabatan');
            $this->db->from('dusun');
            $this->db->join('user', 'user.id = dusun.id_user', 'left');
            $query = $this->db->get()->result_array();
            return $query;
        } else {
            // echo $id_dusun;
            // die();
            $this->db->select('dusun.*, user.id as id_user, user.nama, user.jabatan as jabatan');
            $this->db->from('dusun');
            $this->db->join('user', 'user.id = dusun.id_user', 'left');
            $this->db->where('dusun.id', $id_dusun);
            $query = $this->db->get()->row_array();
            return $query;
        }
    }

    public function getDusunWhere($where)
    {
        return $this->db->get_where('dusun', $where)->row_array();
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
        // var_dump($id);
        // die();
        $this->db->where('id', $id);
        $this->db->update('dusun', $data);
    }

    public function getPeriode()
    {
        $this->db->order_by('periode', 'DESC');
        $query = $this->db->get('periode');
        return $query->result_array();
    }

    public function getKepkel()
    {
        $query = $this->db->select('kep_keluarga.*, dusun.nama_dusun')
            ->from('kep_keluarga, dusun')
            ->where('kep_keluarga.id_dusun = dusun.id')
            ->order_by('dusun.nama_dusun', 'ASC');
        return $query = $this->db->get()->result_array();
    }

    public function getKepkelByUser($id_user)
    {
        $periode = $this->db->get_where('periode', ['status' => 1])->row_array();

        if ($periode != null) {
            $this->db->distinct('kep_keluarga.no_kk');
            $this->db->select('count(alternatif.id) as jumlah_alternatif');
            $this->db->from('alternatif');
            $this->db->join('kep_keluarga', 'kep_keluarga.no_kk = alternatif.no_kk');
            $this->db->where('alternatif.id_periode', $periode['id']);
            $this->db->group_by('kep_keluarga.no_kk');
            $q1 = $this->db->get_compiled_select();
            $this->db->select('kep_keluarga.*, dusun.nama_dusun, user.jabatan, user.nama, (' . $q1 . ') as jumlah');
        } else {
            $this->db->select('kep_keluarga.*, dusun.nama_dusun, user.jabatan, user.nama');
        }
        $this->db->from('kep_keluarga');
        $this->db->join('dusun', 'dusun.id = kep_keluarga.id_dusun');
        $this->db->join('user', 'user.id = dusun.id_user');
        $this->db->where('user.id = ' . $id_user);
        $query = $this->db->get()->result_array();
        // var_dump($que
        return $query;
    }
    public function get_jumlah_pengajuan($id_user)
    {
        $periode = $this->db->get_where('periode', ['status' => 1])->row_array();
        $this->db->count('alternatif.*');
        $this->db->from('alternatif');
        $this->db->join('kep_keluarga', 'kep_keluarga.no_kk = alternatif.no_kk');
        $this->db->join('dusun', 'dusun.id = kep_keluarga.id_dusun');
        $this->db->join('user', 'user.id = dusun.id_user');
        $this->db->where('user.id = ' . $id_user);
        $this->db->where('alternatif.id_periode', $periode['id']);
        $query = $this->db->get()->row_array();
        return $query;
    }
}
