<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Model_akreditasi_RS extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database('default');
    }


    public function Pengajuan_search($lpa_id, $tanggal_awal, $tanggal_akhir, $jenis_fasyankes, $status_usulan_id)
    {
        if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
            $tanggal = "AND (sr.tanggal_survei_1  BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "') OR (sr.tanggal_survei_2  BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "') OR (sr.tanggal_survei_3  BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "') OR 
                (sr.tanggal_survei_4  BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "')	";
        } else {
            $tanggal = "";
        }

        if (!empty($status_usulan_id)) {
            $status = "AND sr.status_tte = '" . $status_usulan_id . "'";
        } else {
            $status = '';
        }

        $sql = $this->db->query("SELECT 
                sr.kode_rs,
                l.nama as lpa,
                jf.nama as jenis_fasyankes,
                msr.metode as metode_survei,
                sr.tanggal_survei_1,
                sr.tanggal_survei_2,
                sr.tanggal_survei_3,
                sr.tanggal_survei_4,
                us.nama as nama_surveior_pertama,
                us2.nama as nama_surveior_kedua,
                sr.narahubung_rs,
                sr.no_hp_narahubung,
                sr.no_surat_tugas,
                sr.status_tte,
	            sr.created_at 
            FROM 
                surtug_rs sr
            LEFT JOIN 
                lpa l ON l.id = sr.lpa_id 
            LEFT JOIN 	
                jenis_fasyankes jf on jf.id = sr.jenis_fasyankes_id 
            LEFT JOIN 
                metode_survei_rs msr ON msr.id = sr.metode_survei_rs_id 
            LEFT JOIN 
                user_surveior us ON us.id = sr.surveior_id_satu 
            LEFT JOIN 
                user_surveior us2 ON us2.id = sr.surveior_id_dua 
            WHERE 
                sr.lpa_id = '" . $lpa_id . "'
            AND
                sr.jenis_fasyankes_id  = '" . $jenis_fasyankes . "'
            " . $status . "
            " . $tanggal . "");

        return $sql->result_array();
    }
}
