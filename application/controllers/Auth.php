<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	// fungsi login
	public function login()
	{
		// jika sudah login maka akan di redirect ke halaman utama
		if ($this->checkCredential()) return redirect('/');
		// jika belum login maka akan diarahkan ke halaman login
		$this->load->view('auth/login');
	}
	// fungsi untuk mengecek apakah sudah login atau belum
	private function checkCredential()
	{
		return loggedIn();
	}
	// fungsi untuk melakukan login
	public function attempt_login()
	{
		// jika sudah login maka akan di redirect ke halaman utama
		if ($this->checkCredential()) return redirect('/');
		// load library form_validation
		$this->load->library('form_validation');
		// set rules untuk form login
		$this->form_validation->set_rules('username', 'Username', 'required', ['required'      => '%s tidak boleh kosong.',]);
		// set rules untuk form login
		$this->form_validation->set_rules('password', 'Password', 'required', ['required'      => '%s tidak boleh kosong.',]);
		// jika form login tidak sesuai dengan rules maka akan diarahkan ke halaman login
		if ($this->form_validation->run() == FALSE) return $this->load->view('auth/login');
		// load model User_model
		$this->load->model('User_model');
		// ambil data username dan password dari form login
		$uname = $this->input->post('username');
		// ambil data username dan password dari form login
		$password = $this->input->post('password');
		// ambil data user berdasarkan username
		$user = $this->User_model->getByUsername($uname);
		// jika user tidak ditemukan maka akan diarahkan ke halaman login
		if (!$user) {
			// set flashdata error
			$this->session->set_flashdata('error', "Username/Password salah");
			// arahkan ke halaman login
			return $this->load->view('auth/login');
		}
		// jika password tidak sesuai dengan password yang ada di database maka akan diarahkan ke halaman login
		if (!password_verify($password, $user['password'])) {
			// set flashdata error
			$this->session->set_flashdata('error', "Username/Password salah");
			// arahkan ke halaman login
			return $this->load->view('auth/login');
		}
		// jika user ditemukan dan password sesuai dengan password yang ada di database maka akan diarahkan ke halaman utama
		$user['logged_in'] = true;
		// set session user
		$this->session->set_userdata($user);
		// set flashdata success
		return redirect('/');
	}
	// fungsi untuk melakukan register
	public function register()
	{
		// jika sudah login maka akan di redirect ke halaman utama
		if ($this->checkCredential()) return redirect('/');
		// jika belum login maka akan diarahkan ke halaman register
		$this->load->view('auth/register');
	}
	// fungsi untuk melakukan register
	public function attempt_register()
	{
		// jika sudah login maka akan di redirect ke halaman utama
		if ($this->checkCredential()) return redirect('/');
		// load library form_validation
		$this->load->library('form_validation');
		// set rules untuk form register
		$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required', ['required'      => '%s tidak boleh kosong.',]);
		// set rules untuk form register
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]', ['required'      => '%s tidak boleh kosong.', 'is_unique' => "%s sudah ada"]);
		// set rules untuk form register
		$this->form_validation->set_rules('password', 'Password', 'required', ['required'      => '%s tidak boleh kosong.',]);
		// set rules untuk form register
		if ($this->form_validation->run() == FALSE) return $this->load->view('auth/register');
		// load model User_model
		$this->load->model('User_model');
		// ambil data username dan password dari form register
		$data = [
			// ambil data username dan password dari form register
			'username' => $this->input->post('username'),
			// ambil data username dan password dari form register
			'fullname' => $this->input->post('fullname'),
			// ambil data username dan password dari form register
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
		];
		// jika gagal melakukan register maka akan diarahkan ke halaman register
		if (!$this->User_model->add($data)) {
			// set flashdata error
			$this->session->set_flashdata('error', "Gagal mendaftar");
			// arahkan ke halaman register
			return $this->load->view('auth/register');
		}
		// jika berhasil melakukan register maka akan diarahkan ke halaman login
		$this->session->set_flashdata('success', "Berhasil mendaftar");
		// arahkan ke halaman login
		return redirect('login');
	}

	// fungsi untuk melakukan logout
	public function logout()
	{
		// jika belum login maka akan diarahkan ke halaman login
		session_destroy();
		// set flashdata success
		redirect('login');
	}
}
