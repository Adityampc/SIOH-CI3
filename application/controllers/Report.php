<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

	public function all()
	{
		$query = $this->input->get('query');
		$limit = $this->input->get('limit');
		$opt = [];
		if ($query) $opt['name'] = $query;
		if (is_numeric($limit)) $opt['limit'] = $limit;
		$data['result'] = $this->Report_model->getAll($opt);
		$data['query'] = $query;
		if ($this->input->get('type') == 'json') {
			echo json_encode($data['result']);
			return;
		};
		$this->load->view('report/all', $data);
	}
	public function create()
	{
		if (!loggedIn()) return redirect('/login');
		$this->load->view('report/create');
	}
	public function add()
	{
		if (!loggedIn()) return redirect('/login');
		header('Content-Type: application/json');
		$target_dir = "./images/user/";
		if (!file_exists($target_dir)) {
			mkdir($target_dir, 0777);
		}

		$config['upload_path']          = './images/user/';
		$config['allowed_types']        = 'jpg|png';
		$config['encrypt_name'] 		= true;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('photo')) {
			echo json_encode(['statusCode' => 403, 'message' => $this->upload->display_errors()]);
			return;
		}
		$RM = $this->Report_model;
		$RM->age = $this->input->post('age');
		$RM->name = $this->input->post('name');
		$RM->photo = $this->upload->data('file_name');
		$RM->user_id = $this->session->userdata('id');
		$RM->lost_date = $this->input->post('lost_date');
		$RM->description = $this->input->post('description');
		$RM->add();
		echo json_encode(['statusCode' => 200, 'message' => 'Berhasil Membuat Laporan Orang Hilang']);
	}
	public function detail($id)
	{
		$data = $this->Report_model->find($id);
		$this->load->view('report/detail', ['data' => $data]);
	}
	public function delete($id)
	{
		if (!loggedIn()) {
			header('Content-Type: application/json; charset=utf-8', true, 403);
			echo json_encode(['message' => "Tindakan tidak diizinkan"]);
			return;
		}
		$data = $this->Report_model->find($id);
		if (!$data) {
			header('Content-Type: application/json; charset=utf-8', true, 404);
			echo json_encode(['message' => "Data tidak ditemukan"]);
			return;
		}
		if ($data['user_id'] != $this->session->id) {
			header('Content-Type: application/json; charset=utf-8', true, 403);
			echo json_encode(['message' => "Tindakan tidak diizinkan"]);
			return;
		}
		if (!$this->Report_model->delete($id)) {
			header('Content-Type: application/json; charset=utf-8', true, 500);
			echo json_encode(['message' => "Gagal menghapus data"]);
			return;
		}
		echo json_encode(['message' => "Berhasil menghapus data",'statusCode'=>200]);
	}
}
