<?php

class Report_model extends CI_Model
{
    public $name;
    public $age;
    public $photo;
    public $lost_date;
    public $description;
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
        if (isset($data['name'])) $this->name = $data['name'];
        if (isset($data['age'])) $this->age = $data['age'];
        if (isset($data['photo']))  $this->photo  = $data['photo'];
        if (isset($data['lost_date']))  $this->lost_date = $data['lost_date'];
        if (isset($data['description'])) $this->description = $data['description'];
        $this->created_at  = date('Y-m-d H:i:s');
        $this->db->insert('reports', $this);
    }

    public function find($id)
    {
        $this->db->from('reports');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }
}
