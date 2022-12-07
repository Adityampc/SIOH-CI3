<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function login()
    {
        $this->load->view('auth/login');
    }
    public function attempt_login()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required', ['required'      => '%s tidak boleh kosong.',]);
        $this->form_validation->set_rules('password', 'Password', 'required', ['required'      => '%s tidak boleh kosong.',]);
        if ($this->form_validation->run() == FALSE) $this->load->view('auth/login');
        
    }
}
