<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Chat extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index_get()
    {
        $dari = $this->get('dari', TRUE);
        $ke = $this->get('ke', TRUE);
        if ($dari && $ke) {
            $this->db->select('*');
            $this->db->from('chats');
            $this->db->where(['dari' => $dari, 'ke' => $ke]);
            $this->db->order_by('created_at', 'ASC');
            $pesan = $this->db->get()->result_array();
            if ($pesan) {
                $pesans = [];
                foreach ($pesan as $key) {
                    $d = [
                        'pesan' => $this->encryption->decrypt($key['pesan'], $key['dari'] . $key['ke']),
                        'created_at' => $key['created_at'],
                        'deleted_at' => $key['deleted_at'],
                    ];
                    array_push($pesans, $d);
                }
                $this->response([
                    'status' => TRUE,
                    'dari' => $dari,
                    'ke' => $ke,
                    'pesan' => $pesans
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'error' => 'Pengirim ataupun Penerima tidak diketahui'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Pengirim ataupun Penerima tidak boleh kosong'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_post()
    {
        $dari = $this->post('dari', TRUE);
        $ke = $this->post('ke', TRUE);
        $pesan = $this->post('pesan', TRUE);

        if ($dari && $ke && $pesan) {
            $this->db->from('users');
            $this->db->where('username', $dari);
            $this->db->or_where('username', $ke);
            $cek = $this->db->get()->result_array();
            if ($cek) {
                $data = [
                    'dari' => $dari,
                    'ke' => $ke,
                    'pesan' => $this->encryption->encrypt($pesan, $dari . $ke)
                ];
                $this->db->insert('chats', $data);
                $this->response([
                    'status' => TRUE,
                    'pesan' => 'Pesan Terkirim'
                ], REST_Controller::HTTP_CREATED);
            } else {
                $this->response([
                    'status' => FALSE,
                    'pesan' => $cek
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response([
                'status' => FALSE,
                'pesan' => 'Pengirim, Penerima, ataupun Pesan tidak boleh kosong'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
