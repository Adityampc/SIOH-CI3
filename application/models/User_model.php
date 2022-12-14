<?php

class User_model extends CI_Model
{
    public $id;
    public $fullname;
    public $username;
    public $password;
    public function getAll($opt = [])
    {
        $this->db->from('reports');
        if (isset($opt['name'])) $this->db->like('name', $opt['name']);
        if (isset($opt['limit'])) $this->db->limit($opt['limit']);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get()->result_array();
    }

    public function add($data = [])
    {
        if (isset($data['fullname'])) $this->fullname = $data['fullname'];
        if (isset($data['username'])) $this->username = $data['username'];
        if (isset($data['password']))  $this->password  = $data['password'];
        $this->created_at  = date('Y-m-d H:i:s');
        $this->updated_at  = date('Y-m-d H:i:s');
       return $this->db->insert('users', $this);
    }

    public function find($id)
    {
        $this->db->from('reports');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }
    public function getByUsername($username = null)
    {
        $this->db->from('users');
        $this->db->where('username', $username ?? $this->username);
        return $this->db->get()->row_array();
    }
}
