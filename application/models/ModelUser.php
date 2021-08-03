<?php
class ModelUser extends CI_Model
{
    public function getUser($username)
    {
        return $this->db->get_where('user', ['username' => $username])->row_array();
    }

    public function getAllUser()
    {
        return $this->db->get('user')->result_array();
    }
}
