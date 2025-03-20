<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan_dev extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('Model_sina');
        $this->load->model('Model_viewdata');
        $this->load->model('Model_monitoring');
        define('MB', 1048576);
    }

    public function index()
    {
        echo 'test';
    }


    public function getsurveiorpenggantiUkom()
    {
        $idpengajuan = $this->input->post('idpengajuan');
        $idsurveior = $this->input->post('idsurveior');

        $datapengajuan = $this->Model_sina->get_detail_pengajuan($idpengajuan, $idsurveior);
        // $input = array_map("unserialize", array_unique(array_map("serialize", $datapengajuan)));

        $lpa_id = $datapengajuan[0]['lpa_id'];
        $provinsiid = $datapengajuan[0]['provinsi_id'];
        // $provinsiid = '31';
        $fasyankes_id = $datapengajuan[0]['fasyankes_id'];
        $idbidang = $datapengajuan[0]['bidang_id'];
        foreach ($datapengajuan as $value) {
            $tanggal[] = $value['jadwal_kesiapan'];
        }
        // $tanggal1 = $tanggal[0];
        // if (!empty($tanggal[4])) {
        // 	$tanggal2 = $tanggal[4];
        // } else {
        // 	$tanggal2 = '';
        // }
        // if (!empty($tanggal[5])) {
        // 	$tanggal3 = $tanggal[2];
        // } else {
        // 	$tanggal3 = '';
        // }
        $uniqtanggal = array_unique($tanggal);


        if (isset($uniqtanggal[2])) {
            $tanggal1 = $tanggal[0];
            $date1 = new DateTime($tanggal1);
            $tanggal2 = $tanggal[2];
            $date2 = new DateTime($tanggal2);
            $tanggal3 = '';
        } else if (isset($uniqtanggal[6])) {
            $tanggal1 = $tanggal[0];
            $date1 = new DateTime($tanggal1);
            $tanggal2 = $tanggal[3];
            $date2 = new DateTime($tanggal2);
            $tanggal3 = $tanggal[6];
            $date3 = new DateTime($tanggal3);
        } else if (isset($uniqtanggal[0])) {
            $tanggal1 = $tanggal[0];
            $tanggal2 = '';
            $tanggal3 = '';
        }


        // $where['kondisi'] = 'user_surveior.lpa_id = ' . $lpa_id . ' AND user_surveior.provinsi_id = ' . $provinsiid . ' AND user_surveior_bidang_detail.id_fasyankes_surveior = ' . $fasyankes_id . ' AND user_surveior_bidang_detail.id_bidang = ' . $idbidang;
        // $where['kondisi'] = 'user_surveior.lpa_id = ' . $lpa_id . ' AND user_surveior_bidang_detail.id_fasyankes_surveior = ' . $fasyankes_id . ' AND user_surveior_bidang_detail.id_bidang = ' . $idbidang;
        // UPDATE 5/12/2023 JANGAN DIUBAH LAGI BADUT
        $where['kondisi'] = 'us.lpa_id = ' . $lpa_id . ' AND usbd.id_fasyankes_surveior = ' . $fasyankes_id . ' AND usbd.id_bidang = ' . $idbidang;
        $batal = '0';
        if (!empty($tanggal3)) {
            // $where_tanggal = 'js.jadwal_kesiapan = ' . $tanggal1 . ' AND js.jadwal_kesiapan = ' . $tanggal2 . ' AND js.jadwal_kesiapan = ' . $tanggal3;

            // LIVE NOW
            $where['kondisi_tanggal'] = "js.jadwal_kesiapan IN ('" . $tanggal1 . "', '" . $tanggal2 . "', '" . $tanggal3 . "')";
            $where['tanggal'] = '3';


            $now = new DateTime('2023-11-29');

            if ($date1 < $now) {
                if ($date2 < $now) {
                    if ($date3 < $now) {
                        $batal = '1';
                    } else {
                        $where['kondisi_tanggal'] = "js.jadwal_kesiapan IN ('" . $tanggal3 . "')";
                        $where['tanggal'] = '1';
                    }
                } else {
                    $where['kondisi_tanggal'] = "js.jadwal_kesiapan IN ('" . $tanggal2 . "', '" . $tanggal3 . "')";
                    $where['tanggal'] = '2';
                }
            } else {
                $where['kondisi_tanggal'] = "js.jadwal_kesiapan IN ('" . $tanggal1 . "', '" . $tanggal2 . "', '" . $tanggal3 . "')";
                $where['tanggal'] = '3';
            }
        } else if (!empty($tanggal2)) {
            // $where_tanggal = 'js.jadwal_kesiapan = ' . $tanggal1 . ' AND js.jadwal_kesiapan = ' . $tanggal2;
            $where['kondisi_tanggal'] = "js.jadwal_kesiapan IN ('" . $tanggal1 . "', '" . $tanggal2 . "')";
            $where['tanggal'] = '2';


            $now = new DateTime();

            if ($date1 < $now) {
                $where['kondisi_tanggal'] = "js.jadwal_kesiapan IN ('" . $tanggal2 . "')";
                $where['tanggal'] = '1';
            }
        } else {
            // $where_tanggal = 'js.jadwal_kesiapan = ' . $tanggal1;
            $where['kondisi_tanggal'] = "jadwal_kesiapan IN ('" . $tanggal1 . "')";
            $where['tanggal'] = '1';
        }

        if ($fasyankes_id == '2' || $fasyankes_id == '3') {
            $where['domisili'] = 'AND us.provinsi_id = ' . $provinsiid . '';
        } else {
            $where['domisili'] = '';
        }


        // if ($batal === 1) {
        //     echo json_encode('test');
        // } else {
        //     echo json_encode('test');
        //     $datasurveior = $this->Model_sina->select_surveior_pengganti($where);
        //     echo json_encode($datasurveior);
        // }

        $datasurveior = $this->Model_sina->select_surveior_pengganti_ukomm($where);
        // echo json_encode($datasurveior);

        print_r($datasurveior);


        // print_r($fasyankes_id);
        // print_r($datasurveior);

    }
}
