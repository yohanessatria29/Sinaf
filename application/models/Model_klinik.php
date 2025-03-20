<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_klinik extends CI_Model{

    function Trans_Sarpras_klinik($id_faskes){
    	$result = $this->db->query("SELECT 'is_checked' FROM dbfaskes.trans_sarpras_alkes_klnik WHERE id_faskes =  '$id_faskes'");
        return $result;
    }

    function Sarpras_klinik($id_faskes){
    	$result = $this->db->query("SELECT * FROM dbfaskes.sarpras_alkes_klnik WHERE id_faskes =  '$id_faskes'");
        return $result;
    }
} 