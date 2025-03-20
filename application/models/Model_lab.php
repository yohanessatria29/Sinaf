<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_lab extends CI_Model{

    function Trans_Sarpras_lab($id_faskes){
    	$result = $this->db->query("SELECT 'is_checked' FROM dbfaskes.trans_sarpras_alkes_lab WHERE id_faskes =  '$id_faskes'");
        return $result;
    }

    function Sarpras_lab($id_faskes){
    	$result = $this->db->query("SELECT * FROM dbfaskes.sarpras_alkes_lab WHERE id_faskes =  '$id_faskes'");
        return $result;
    }
} 