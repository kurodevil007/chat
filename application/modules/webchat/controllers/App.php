<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Carbon\Carbon;

class App extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['master_model' => 'master']);
        if (!$this->session->has_userdata('username')) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $dari = $this->master->get_chat('ihsanfawzan', 'fawzanihsan')->result();
        $ke = $this->master->get_chat('fawzanihsan', 'ihsanfawzan')->result();
        $carbon = new Carbon();
        $c = array_merge($dari, $ke);
        sort($c);
        $chat = [];
        foreach ($c as $key) {
            // print_r($key);
            $pesan = ($key->pesan != NULL) ? $this->encryption->decrypt($key->pesan, $key->dari . $key->ke) : NULL;
            $chats = [
                'id' => $key->id,
                'dari' => $key->dari,
                'ke' => $key->ke,
                'pesan' => $pesan,
                'created_at' => $carbon->parse($key->created_at)->timezone('Asia/Jakarta')->locale('id')->diffForHumans(),
                'deleted_at' => $key->deleted_at,
            ];
            array_push($chat, $chats);
        }
        $f = $this->master->get_fl('ihsanfawzan');
        // die;
        $data = [
            'chat' => $chat,
            'friend_list' => $f
        ];
        $this->load->view('main', $data);
        // echo 'Under Maintenance!';
    }
}
