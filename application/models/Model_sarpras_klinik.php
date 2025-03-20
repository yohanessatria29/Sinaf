<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_sarpras_klinik extends CI_Model{

    function farmasi_no($id){
        // $userid = $this->session->userdata('user_id');
        // echo json_encode($user_id);
    	return $this->db->query("SELECT
        *
    FROM
        dbfaskes.t_farmasi_no t
    WHERE
        t.id_faskes = '$id'")->result_array();
    }

    function lab_no($id){
        // $userid = $this->session->userdata('user_id');
        // echo json_encode($user_id);
    	return $this->db->query("SELECT
        *
    FROM
        dbfaskes.t_lab_no t
    WHERE
        t.id_faskes = '$id'")->result_array();
    }

    function lab_yes($id){
        // $userid = $this->session->userdata('user_id');
        // echo json_encode($user_id);
    	return $this->db->query("SELECT
        *
    FROM
        dbfaskes.t_lab_yes t
    WHERE
        t.id_faskes = '$id'")->result_array();
    }

} 