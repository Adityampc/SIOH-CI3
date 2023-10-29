<?php
// model Report_model
class Report_model extends CI_Model
{
	// property $name untuk class Report_model
	public $name;
	// property $age untuk class Report_model
	public $age;
	// property $photo untuk class Report_model
	public $photo;
	// property $user_id untuk class Report_model
	public $user_id;
	// property $lost_date untuk class Report_model
	public $lost_date;
	// property $description untuk class Report_model
	public $description;
	// property $created_at untuk class Report_model

	// fungsi untuk menampilkan semua data laporan
	public function getAll($opt = [])
	{
		// ambil data query dari url
		$this->db->from('reports');
		// ambil data name dari url jika ada dan lakukan like terhadap name
		if (isset($opt['name'])) $this->db->like('name', $opt['name']);
		// ambil data limit dari url jika ada dan lakukan limit terhadap data
		if (isset($opt['limit'])) $this->db->limit($opt['limit']);
		// ambil data order dari url jika ada dan lakukan order terhadap data
		$this->db->order_by('created_at', 'DESC');
		// ambil data dari database
		return $this->db->get()->result_array();
	}

	// fungsi untuk menambahkan data laporan
	public function add($data = [])
	{
		// ambil data name dari url jika ada dan lakukan like terhadap name
		if (isset($data['name'])) $this->name = $data['name'];
		// ambil data age dari url jika ada dan lakukan like terhadap age
		if (isset($data['age'])) $this->age = $data['age'];
		// ambil data photo dari url jika ada dan lakukan like terhadap photo
		if (isset($data['photo']))  $this->photo  = $data['photo'];
		// ambil data user_id dari url jika ada dan lakukan like terhadap user_id
		if (isset($data['user_id'])) $this->user_id = $data['user_id'];
		// ambil data lost_date dari url jika ada dan lakukan like terhadap lost_date
		if (isset($data['lost_date']))  $this->lost_date = $data['lost_date'];
		// ambil data description dari url jika ada dan lakukan like terhadap description
		if (isset($data['description'])) $this->description = $data['description'];
		// ambil data created_at dari url jika ada dan lakukan like terhadap created_at
		$this->created_at  = date('Y-m-d H:i:s');
		// tambahkan data ke database
		$this->db->insert('reports', $this);
	}

	// fungsi untuk menampilkan data laporan berdasarkan id
	public function find($id)
	{
		// ambil data dari table reports
		$this->db->from('reports');
		// ambil data berdasarkan id		
		$this->db->where('id', $id);
		// ambil data dari database
		return $this->db->get()->row_array();
	}

	// fungsi untuk mengupdate data laporan berdasarkan id
	public function delete($id)
	{
		// ambil data dari table reports
		$this->db->from('reports');
		// ambil data berdasarkan id
		$this->db->where('id', $id);
		// hapus data dari database
		$this->db->delete();
		// kembalikan nilai true jika berhasil
		return $this->db->affected_rows() > 0;
	}
}
