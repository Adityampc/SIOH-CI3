<?php

// model User_model
class User_model extends CI_Model
{
	// property $id untuk class User_model
	public $id;
	// property $fullname untuk class User_model
	public $fullname;
	// property $username untuk class User_model
	public $username;
	// property $password untuk class User_model
	public $password;

	// fungsi untuk menampilkan semua data user
	public function add($data = [])
	{
		// ambil data fullname dari url jika ada dan lakukan like terhadap fullname
		if (isset($data['fullname'])) $this->fullname = $data['fullname'];
		// ambil data username dari url jika ada dan lakukan like terhadap username
		if (isset($data['username'])) $this->username = $data['username'];
		// ambil data password dari url jika ada dan lakukan like terhadap password
		if (isset($data['password']))  $this->password  = $data['password'];
		// ambil data created_at dari url jika ada dan lakukan like terhadap created_at
		$this->created_at  = date('Y-m-d H:i:s');
		// ambil data updated_at dari url jika ada dan lakukan like terhadap updated_at
		$this->updated_at  = date('Y-m-d H:i:s');
		// tambahkan data ke database
		return $this->db->insert('users', $this);
	}

	// fungsi untuk menampilkan semua data user
	public function getByUsername($username = null)
	{
		// ambil data dari table users
		$this->db->from('users');
		// ambil data berdasarkan username
		$this->db->where('username', $username ?? $this->username);
		// ambil data dari database
		return $this->db->get()->row_array();
	}
}
