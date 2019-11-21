<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_Model extends CI_Model
{

    public function get_chat($dari, $ke)
    {
        $this->db->select('*');
        $this->db->from('chats');
        $this->db->where('dari', $dari);
        $this->db->where('ke', $ke);
        return $this->db->get();
    }

    public function get_fl($me)
    {
        $this->db->select('dengan');
        $this->db->from('friend_list');
        $this->db->where('username', $me);
        $user = $this->db->get()->result();
        // $this->db->reset_query();
        $data = [];
        foreach ($user as $key) {
            $dengan = $key->dengan;
            $this->db->select('nama');
            $this->db->select('username');
            $this->db->from('users');
            $this->db->where('username', $dengan);
            $c =  $this->db->get()->result();
            array_push($data, $c);
        }
        return $data;
    }
}
