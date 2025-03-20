<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mlogin extends CI_Model
{

    function query_validasi_email($email)
    {
        // $result = $this->db->query("SELECT db_akreditasi_non_rs.users.* FROM db_akreditasi_non_rs.users WHERE db_akreditasi_non_rs.users.email = '$email'  LIMIT 1");
        // $result = $this->db->get_where('users', array('email' => $this->db->escape($email)), 1);
        $result = $this->db->get_where('users', array('email' => $email), 1);
        return $result;
        // return $this->db->escape($email);
    }

    function query_validasi_password($email, $hashed)
    {
        // $result = $this->db->query("SELECT db_akreditasi_non_rs.users.* FROM db_akreditasi_non_rs.users WHERE db_akreditasi_non_rs.users.email ='$email' AND db_akreditasi_non_rs.users.password_enkripsi ='$hashed'  LIMIT 1");
        // $result = $this->db->get_where('users', array('email' => $this->db->escape($email), 'password_enkripsi' => $this->db->escape_like_str($hashed)), 1);
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
