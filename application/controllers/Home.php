<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function index()
	{
		$this->load->view('index');
	}
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
		$this->load->view('all', $data);
	}
	public function create_report()
	{
		$this->load->view('report/create');
	}
	public function save_report()
	{
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
		$RM->photo = $this->upload->data('file_name');
		$RM->name = $this->input->post('name');
		$RM->age = $this->input->post('age');
		$RM->lost_date = $this->input->post('lost_date');
		$RM->description = $this->input->post('description');
		$RM->add();
		echo json_encode(['statusCode' => 200, 'message' => 'Berhasil Membuat Laporan Orang Hilang']);
	}
	public function report($id)
	{
		$data = $this->Report_model->find($id);
		$this->load->view('report/detail', ['data' => $data]);
	}
}
