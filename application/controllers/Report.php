<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
	// fungsi untuk menampilkan semua data laporan
	public function all()
	{
		// ambil data query dari url
		$query = $this->input->get('query');
		// ambil data limit dari url
		$limit = $this->input->get('limit');
		// load model Report_model
		$opt = [];
		// jika query tidak kosong maka akan ditambahkan ke dalam array opt
		if ($query) $opt['name'] = $query;
		// jika limit tidak kosong maka akan ditambahkan ke dalam array opt
		if (is_numeric($limit)) $opt['limit'] = $limit;
		// load model Report_model
		$data['result'] = $this->Report_model->getAll($opt);
		// set data query
		$data['query'] = $query;
		// set data limit
		if ($this->input->get('type') == 'json') {
			// tampikan data dalam bentuk json
			echo json_encode($data['result']);
			return;
		};
		// load view report/all
		$this->load->view('report/all', $data);
	}
	// fungsi untuk menampilkan form create
	public function create()
	{
		// jika belum login maka akan diarahkan ke halaman login
		if (!loggedIn()) return redirect('/login');
		// load view report/create
		$this->load->view('report/create');
	}
	// fungsi untuk menambahkan data laporan
	public function add()
	{
		// jika belum login maka akan diarahkan ke halaman login
		if (!loggedIn()) return redirect('/login');
		// set header content-type
		header('Content-Type: application/json');
		// set rules untuk form create
		$target_dir = "./images/user/";
		// set rules untuk form create
		if (!file_exists($target_dir)) {
			// set rules untuk form create
			mkdir($target_dir, 0777);
		}
		// set rules untuk form create
		$config['upload_path']          = './images/user/';
		// set rules untuk form create
		$config['allowed_types']        = 'jpg|png';
		// set rules untuk form create
		$config['encrypt_name'] 		= true;
		// set rules untuk form create
		$this->load->library('upload', $config);
		// set rules untuk form create
		if (!$this->upload->do_upload('photo')) {
			// set rules untuk form create
			echo json_encode(['statusCode' => 403, 'message' => $this->upload->display_errors()]);
			return;
		}
		// set rules untuk form create
		$RM = $this->Report_model;
		// set rules untuk form create
		$RM->age = $this->input->post('age');
		// set rules untuk form create
		$RM->name = $this->input->post('name');
		// set rules untuk form create
		$RM->photo = $this->upload->data('file_name');
		// set rules untuk form create
		$RM->user_id = $this->session->userdata('id');
		// set rules untuk form create
		$RM->lost_date = $this->input->post('lost_date');
		// set rules untuk form create
		$RM->description = $this->input->post('description');
		// set rules untuk form create
		$RM->add();
		// set rules untuk form create
		echo json_encode(['statusCode' => 200, 'message' => 'Berhasil Membuat Laporan Orang Hilang']);
	}
	// fungsi untuk menambahkan data laporan
	public function process_edit($id)
	{
		// jika belum login maka akan diarahkan ke halaman login
		if (!loggedIn()) return redirect('/login');
		// set header content-type
		header('Content-Type: application/json');
		// set rules untuk form create
		$target_dir = "./images/user/";
		// set rules untuk form create
		if (!file_exists($target_dir)) {
			// set rules untuk form create
			mkdir($target_dir, 0777);
		}
		// set rules untuk form create
		$config['upload_path']          = './images/user/';
		// set rules untuk form create
		$config['allowed_types']        = 'jpg|png';
		// set rules untuk form create
		$config['encrypt_name'] 		= true;
		// set rules untuk form create
		$this->load->library('upload', $config);
		// set rules untuk form create
		$RM = $this->Report_model;
		if ($this->upload->do_upload('photo')) {
			// set rules untuk form create
			$RM->photo = $this->upload->data('file_name');
		} else {
			$data = $this->Report_model->find($id);
			$RM->photo = $data['photo'];
		}
		// set rules untuk form create
		// set rules untuk form create
		$RM->age = $this->input->post('age');
		// set rules untuk form create
		$RM->name = $this->input->post('name');
		// set rules untuk form create
		$RM->user_id = $this->session->userdata('id');
		// set rules untuk form create
		$RM->lost_date = $this->input->post('lost_date');
		// set rules untuk form create
		$RM->description = $this->input->post('description');
		// set rules untuk form create
		$RM->edit($id);
		// set rules untuk form create
		echo json_encode(['statusCode' => 201, 'message' => 'Berhasil Mengubah Laporan Orang Hilang']);
	}
	// fungsi untuk menampilkan data laporan berdasarkan id
	public function detail($id)
	{
		// load model Report_model
		$data = $this->Report_model->find($id);
		$this->load->view('report/detail', ['data' => $data]);
	}
	public function edit($id)
	{
		$data = $this->Report_model->find($id);
		$this->load->view('report/edit', ['data' => $data]);
	}
	// fungsi untuk menghapus data laporan berdasarkan id
	public function delete($id)
	{
		// jika belum login maka akan diarahkan ke halaman login
		if (!loggedIn()) {
			// set header content-type
			header('Content-Type: application/json; charset=utf-8', true, 403);
			// tampilkan pesan error
			echo json_encode(['message' => "Tindakan tidak diizinkan"]);
			return;
		}
		// load model Report_model
		$data = $this->Report_model->find($id);
		// jika data tidak ditemukan maka akan diarahkan ke halaman 404
		if (!$data) {
			// set header content-type
			header('Content-Type: application/json; charset=utf-8', true, 404);
			// tampilkan pesan error
			echo json_encode(['message' => "Data tidak ditemukan"]);
			return;
		}
		// jika user yang login bukan pemilik data maka akan diarahkan ke halaman 403
		if ($data['user_id'] != $this->session->id) {
			// set header content-type
			header('Content-Type: application/json; charset=utf-8', true, 403);
			// tampilkan pesan error
			echo json_encode(['message' => "Tindakan tidak diizinkan"]);
			return;
		}
		// jika data ditemukan maka akan dihapus
		if (!$this->Report_model->delete($id)) {
			// set header content-type
			header('Content-Type: application/json; charset=utf-8', true, 500);
			// tampilkan pesan error
			echo json_encode(['message' => "Gagal menghapus data"]);
			return;
		}
		// set header content-type
		echo json_encode(['message' => "Berhasil menghapus data", 'statusCode' => 200]);
	}
}
