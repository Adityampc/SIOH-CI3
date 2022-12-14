<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function login()
    {
        if (loggedIn()) return redirect('/');
        $this->load->view('auth/login');
    }
    public function attempt_login()
    {
        if (loggedIn()) return redirect('/');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required', ['required'      => '%s tidak boleh kosong.',]);
        $this->form_validation->set_rules('password', 'Password', 'required', ['required'      => '%s tidak boleh kosong.',]);
        if ($this->form_validation->run() == FALSE) return $this->load->view('auth/login');
        $this->load->model('User_model');
        $uname = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->User_model->getByUsername($uname);
        if (!$user) {
            $this->session->set_flashdata('error', "Username/Password salah");
            return $this->load->view('auth/login');
        }
        if (!password_verify($password, $user['password'])) {
            $this->session->set_flashdata('error', "Username/Password salah");
            return $this->load->view('auth/login');
        }
        $user['logged_in'] = true;
        $this->session->set_userdata($user);
        return redirect('/');
    }
    public function register()
    {
        if (loggedIn()) return redirect('/');
        $this->load->view('auth/register');
    }
    public function attempt_register()
    {
        if (loggedIn()) return redirect('/');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required', ['required'      => '%s tidak boleh kosong.',]);
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]', ['required'      => '%s tidak boleh kosong.', 'is_unique' => "%s sudah ada"]);
        $this->form_validation->set_rules('password', 'Password', 'required', ['required'      => '%s tidak boleh kosong.',]);
        if ($this->form_validation->run() == FALSE) return $this->load->view('auth/register');
        $this->load->model('User_model');
        $data = [
            'username' => $this->input->post('username'),
            'fullname' => $this->input->post('fullname'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        ];
        if (!$this->User_model->add($data)) {
            $this->session->set_flashdata('error', "Gagal mendaftar");
            return $this->load->view('auth/register');
        }
        $this->session->set_flashdata('success', "Berhasil mendaftar");
        return redirect('login');
    }


    public function logout()
    {
        session_destroy();
        redirect('login');
    }
}
