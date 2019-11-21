<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Auth extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function register_post()
    {
        $username = trim($this->post('username'));
        $nama = trim($this->post('nama'));
        $password = $this->post('password');
        if ($username && $nama && $password) {
            $this->db->select('username');
            $this->db->from('users');
            $this->db->where('username', $username);
            $hasil = $this->db->get()->row_array();
            if ($hasil > 0) {
                $this->response([
                    'status' => FALSE,
                    'error' => 'Username sudah dipakai'
                ], REST_Controller::HTTP_FOUND);
            } else {
                $data = [
                    'username' => $username,
                    'nama' => $nama,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ];
                $reg = $this->db->insert('users', $data);
                if ($reg) {
                    $this->response([
                        'status' => TRUE,
                        'pesan' => 'Registrasi Berhasil!'
                    ], REST_Controller::HTTP_CREATED);
                } else {
                    $this->response([
                        'status' => FALSE,
                        'pesan' => 'Registrasi Gagal'
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
            }
        } else {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Username, Nama, dan Password tidak boleh kosong'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_post()
    {
        $username = $this->post('username');
        $password = $this->post('password');
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
        $h = $this->db->get()->result();
        if ($h) {
            if (password_verify($password, $h[0]->password)) {
                $data = [
                    'X-API-KEY' => 'ggscscs4g8k0ww0ssk84w8k8so8s0wowkoc0gsg8',
                    'username' => $username
                ];
                $this->session->set_userdata($data);
                $this->response([
                    'status' => true,
                    'error' => 'Logged In'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'error' => 'Wrong'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => false,
                'error' => 'Username tidak ada'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
