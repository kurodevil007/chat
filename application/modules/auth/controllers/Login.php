<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->has_userdata('username')) {
            redirect('webchat', 'refresh');
        }
    }

    public function index()
    {
        $this->load->view('login-view');
    }

    public function login()
    {
        # code...
    }
}
