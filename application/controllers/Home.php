<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	// fungsi untuk menampilkan halaman utama
	public function index()
	{
		// load view index
		$this->load->view('index');
	}
}
