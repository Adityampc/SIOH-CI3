<?php

class User_model extends CI_Model
{
    public $id;
    public $fullname;
    public $username;
    public $password;

    public function add($data = [])
    {
        if (isset($data['fullname'])) $this->fullname = $data['fullname'];
        if (isset($data['username'])) $this->username = $data['username'];
        if (isset($data['password']))  $this->password  = $data['password'];
        $this->created_at  = date('Y-m-d H:i:s');
        $this->updated_at  = date('Y-m-d H:i:s');
        return $this->db->insert('users', $this);
    }
    public function getByUsername($username = null)
    {
        $this->db->from('users');
        $this->db->where('username', $username ?? $this->username);
        return $this->db->get()->row_array();
    }
}
