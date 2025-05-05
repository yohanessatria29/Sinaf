<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mlogin extends CI_Model
{

    function query_validasi_email($email)
    {
        $result = $this->db->get_where('users', array('email' => $email), 1);
        return $result;
    }

    function query_validasi_password($email, $hashed)
    {
        $result = $this->db->get_where('users', array('email' => $email, 'password_enkripsi' => $hashed), 1);
        return $result;
    }

    function cek_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function input_data($table, $data)
    {
        $this->db->insert($table, $data);
    }
}
