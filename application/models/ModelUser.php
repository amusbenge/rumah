<?php
class ModelUser extends CI_Model
{
    public function getUserByUsername($username)
    {
        return $this->db->get('user', ['username' => $username])->row_array();
    }
}
