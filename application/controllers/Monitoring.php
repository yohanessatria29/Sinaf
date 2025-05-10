<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Monitoring extends CI_Controller
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

    function proses()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $post = $this->security->xss_clean($this->input->post());
            $session_kriteria = $this->session->userdata('kriteria_id');

            if ($session_kriteria == 1) {
                $session_lpa = $this->session->userdata('lpa_id');

                if (!empty($post['tanggal_awal'])) {
                    $tanggal_awal = $post['tanggal_awal'];
                } else {
                    $tanggal_awal = null;
                }
                if (!empty($post['tanggal_akhir'])) {
                    $tanggal_akhir = $post['tanggal_akhir'];
                } else {
                    $tanggal_akhir = null;
                }

                if (!empty($post['propinsi'])) {
                    $propinsi = $post['propinsi'];
                } else {
                    $propinsi = null;
                }
                if (!empty($post['kota'])) {
                    $kota = $post['kota'];
                } else {
                    $kota = null;
                }
                if (!empty($post['jenis_fasyankes'])) {
                    $jenis_fasyankes = $post['jenis_fasyankes'];
                } else {
                    $jenis_fasyankes = 'null';
                }
                $lpa_id = 'null';

                $data = array(
                    'content' => 'view_pengajuan_usulan_survei',
                    // 'data' => $this->Model_monitoring->select_pengajuan_search_monitoring($session_lpa, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes),
                    'session_lpa' => $session_lpa,
                    'propinsi' => $propinsi,
                    'kota' => $kota,
                    'jenis_fasyankes' => $jenis_fasyankes,
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir
                );

                if ($post != NULL) {
                    $data['data'] = $this->Model_monitoring->select_monitoring($session_lpa, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes);
                } else {
                    $data['data'] = array();
                }
            } else if ($session_kriteria == 5) {
                $session_lpa = $this->session->userdata('lpa_id');

                if (!empty($post['tanggal_awal'])) {
                    $tanggal_awal = $post['tanggal_awal'];
                } else {
                    $tanggal_awal = null;
                }
                if (!empty($post['tanggal_akhir'])) {
                    $tanggal_akhir = $post['tanggal_akhir'];
                } else {
                    $tanggal_akhir = null;
                }

                if (!empty($post['propinsi'])) {
                    $propinsi = $post['propinsi'];
                } else {
                    $propinsi = null;
                }
                if (!empty($post['kota'])) {
                    $kota = $post['kota'];
                } else {
                    $kota = null;
                }
                if (!empty($post['jenis_fasyankes'])) {
                    $jenis_fasyankes = $post['jenis_fasyankes'];
                } else {
                    $jenis_fasyankes = null;
                }
                $data = array(
                    'content' => 'view_pengajuan_usulan_survei',
                    // 'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
                    // 'data' => $this->Model_monitoring->select_pengajuan_search_monitoring($session_lpa, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes),
                    'session_lpa' => $session_lpa,
                    'propinsi' => $propinsi,
                    'kota' => $kota,
                    'jenis_fasyankes' => $jenis_fasyankes,
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir
                );
                if ($post != NULL) {
                    $data['data'] = $this->Model_monitoring->select_monitoring($session_lpa, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes);
                } else {
                    $data['data'] = array();
                }
            } else if ($session_kriteria == 2) {
                if (!empty($post['tanggal_awal'])) {
                    $tanggal_awal = $post['tanggal_awal'];
                } else {
                    $tanggal_awal = null;
                }
                if (!empty($post['tanggal_akhir'])) {
                    $tanggal_akhir = $post['tanggal_akhir'];
                } else {
                    $tanggal_akhir = null;
                }

                if (!empty($post['propinsi'])) {
                    $propinsi = $post['propinsi'];
                } else {
                    $propinsi = null;
                }
                if (!empty($post['kota'])) {
                    $kota = $post['kota'];
                } else {
                    $kota = null;
                }
                if (!empty($post['jenis_fasyankes'])) {
                    $jenis_fasyankes = $post['jenis_fasyankes'];
                } else {
                    $jenis_fasyankes = null;
                }

                if (!empty($post['lpa_id'])) {
                    $lpa_id = $post['lpa_id'];
                } else {
                    $lpa_id = null;
                }
                $data = array(
                    'session_lpa' => $lpa_id,
                    'propinsi' => $propinsi,
                    'kota' => $kota,
                    'jenis_fasyankes' => $jenis_fasyankes,
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir,
                    'lpa_id' => $lpa_id
                );

                if ($post != NULL) {
                    $data['data'] = $this->Model_monitoring->select_monitoring($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes);
                } else {
                    $data['data'] = array();
                }
            } else if ($session_kriteria == 8) {
                if (!empty($post['tanggal_awal'])) {
                    $tanggal_awal = $post['tanggal_awal'];
                } else {
                    $tanggal_awal = null;
                }
                if (!empty($post['tanggal_akhir'])) {
                    $tanggal_akhir = $post['tanggal_akhir'];
                } else {
                    $tanggal_akhir = null;
                }

                if (!empty($post['propinsi'])) {
                    $propinsi = $post['propinsi'];
                } else {
                    $propinsi = null;
                }
                if (!empty($post['kota'])) {
                    $kota = $post['kota'];
                } else {
                    $kota = null;
                }
                if (!empty($post['jenis_fasyankes'])) {
                    $jenis_fasyankes = $post['jenis_fasyankes'];
                } else {
                    $jenis_fasyankes = null;
                }

                if (!empty($post['lpa_id'])) {
                    $lpa_id = $post['lpa_id'];
                } else {
                    $lpa_id = null;
                }
                $data = array(
                    'content' => 'view_pengajuan_usulan_survei',
                    // 'data' => $this->Model_monitoring->select_pengajuan_search_monitoring($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes),
                    'session_lpa' => $lpa_id,
                    'propinsi' => $propinsi,
                    'kota' => $kota,
                    'jenis_fasyankes' => $jenis_fasyankes,
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir,
                    'lpa_id' => $lpa_id
                );

                if ($post != NULL) {
                    $data['data'] = $this->Model_monitoring->select_monitoring($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes);
                } else {
                    $data['data'] = array();
                }
            }

            $this->load->view('monitoring_proses', $data);
        }
    }


    function prosescopy()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $session_kriteria = $this->session->userdata('lpa_id');
            $data = array();
            if ($session_kriteria == 1) {
                $session_lpa = $this->session->userdata('lpa_id');
                $GET = $this->input->get();

                if (!empty($GET['tanggal_awal'])) {
                    $tanggal_awal = $GET['tanggal_awal'];
                } else {
                    $tanggal_awal = null;
                }
                if (!empty($GET['tanggal_akhir'])) {
                    $tanggal_akhir = $GET['tanggal_akhir'];
                } else {
                    $tanggal_akhir = null;
                }

                if (!empty($GET['propinsi'])) {
                    $propinsi = $GET['propinsi'];
                } else {
                    $propinsi = null;
                }
                if (!empty($GET['kota'])) {
                    $kota = $GET['kota'];
                } else {
                    $kota = null;
                }
                if (!empty($GET['jenis_fasyankes'])) {
                    $jenis_fasyankes = $GET['jenis_fasyankes'];
                } else {
                    $jenis_fasyankes = 'null';
                }

                if (isset($_GET['jenis_faskes'])) {
                    $jenis_faskes = $_GET['jenis_faskes'];
                    $data['jenis_faskes'] = $_GET['jenis_faskes'];
                } else {
                    $jenis_faskes = 'null';
                }
                if ($GET != NULL) {
                    $data_monitoring = $this->Model_monitoring->select_monitoring_new($session_lpa, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes, $jenis_faskes);
                } else {
                    $data_monitoring = array();
                }


                $lpa_id = 'null';

                $data = array(
                    'data' => $data_monitoring,
                    'session_lpa' => $session_lpa,
                    'propinsi' => $propinsi,
                    'kota' => $kota,
                    'jenis_fasyankes' => $jenis_fasyankes,
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir
                );
            } else if ($session_kriteria == 2) {
                $GET = $this->input->get();

                if (!empty($GET['tanggal_awal'])) {
                    $tanggal_awal = $GET['tanggal_awal'];
                } else {
                    $tanggal_awal = null;
                }
                if (!empty($GET['tanggal_akhir'])) {
                    $tanggal_akhir = $GET['tanggal_akhir'];
                } else {
                    $tanggal_akhir = null;
                }

                if (!empty($GET['propinsi'])) {
                    $propinsi = $GET['propinsi'];
                } else {
                    $propinsi = null;
                }
                if (!empty($GET['kota'])) {
                    $kota = $GET['kota'];
                } else {
                    $kota = null;
                }
                if (!empty($GET['jenis_fasyankes'])) {
                    $jenis_fasyankes = $GET['jenis_fasyankes'];
                } else {
                    $jenis_fasyankes = 'null';
                }

                if (!empty($GET['lpa_id'])) {
                    $lpa_id = $GET['lpa_id'];
                } else {
                    $lpa_id = null;
                }

                if (isset($_GET['jenis_faskes'])) {
                    $jenis_faskes = $_GET['jenis_faskes'];
                } else {
                    $jenis_faskes = null;
                }


                if ($GET != NULL) {
                    $data_monitoring = $this->Model_monitoring->select_monitoring_new($session_lpa, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes, $jenis_faskes);
                } else {
                    $data_monitoring = array();
                }

                $lpa_id = 'null';

                $data = array(
                    'data' => $data_monitoring,
                    'session_lpa' => $lpa_id,
                    'propinsi' => $propinsi,
                    'kota' => $kota,
                    'jenis_fasyankes' => $jenis_fasyankes,
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir,
                    'lpa_id' => $lpa_id
                );
            }

            $this->load->view('monitoring_proses_dev', $data);
        }
    }
}
