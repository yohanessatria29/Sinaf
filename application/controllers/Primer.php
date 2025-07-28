<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Primer extends CI_Controller
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

            $session_kriteria = $this->session->userdata('kriteria_id');
            // $post = $this->security->xss_clean($this->input->post());
            $post = $this->input->post(null, true);

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
            } else if ($session_kriteria == 13) {
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
            } else if ($session_kriteria == 14) {

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
            } else if ($session_kriteria == 15) {

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

            $this->load->view('monitoring_proses_primer', $data);
        }
    }
    // {
    //     $this->load->library('form_validation');
    //     $this->load->helper('security');
    //     if ($this->session->userdata('logged') != TRUE) {
    //         redirect('login/logout');
    //     } else {

    //         $session_kriteria = $this->session->userdata('kriteria_id');
    //         // print_r($session_kriteria);
    //         if ($session_kriteria == 1) {
    //             $session_lpa = $this->session->userdata('lpa_id');


    //             $post = $this->input->post();
    //             if (!empty($post['tanggal_awal'])) {
    //                 $tanggal_awal = $post['tanggal_awal'];
    //             } else {
    //                 $tanggal_awal = null;
    //             }
    //             if (!empty($post['tanggal_akhir'])) {
    //                 $tanggal_akhir = $post['tanggal_akhir'];
    //             } else {
    //                 $tanggal_akhir = null;
    //             }

    //             if (!empty($post['propinsi'])) {
    //                 $propinsi = $post['propinsi'];
    //             } else {
    //                 $propinsi = null;
    //             }
    //             if (!empty($post['kota'])) {
    //                 $kota = $post['kota'];
    //             } else {
    //                 $kota = null;
    //             }
    //             if (!empty($post['jenis_fasyankes'])) {
    //                 $jenis_fasyankes = $post['jenis_fasyankes'];
    //             } else {
    //                 $jenis_fasyankes = 'null';
    //             }
    //             $lpa_id = 'null';


    //             // print_r($post);
    //             $data = array(
    //                 'content' => 'view_pengajuan_usulan_survei',
    //                 // 'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
    //                 'data' => $this->Model_monitoring->select_pengajuan_search_monitoring($session_lpa, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes),
    //                 'session_lpa' => $session_lpa,
    //                 'propinsi' => $propinsi,
    //                 'kota' => $kota,
    //                 'jenis_fasyankes' => $jenis_fasyankes,
    //                 'tanggal_awal' => $tanggal_awal,
    //                 'tanggal_akhir' => $tanggal_akhir
    //             );
    //             $this->load->view('monitoring_proses_primer', $data);
    //         } else if ($session_kriteria == 5) {
    //             $session_lpa = $this->session->userdata('lpa_id');

    //             $post = $this->input->post();
    //             if (!empty($post['tanggal_awal'])) {
    //                 $tanggal_awal = $post['tanggal_awal'];
    //             } else {
    //                 $tanggal_awal = null;
    //             }
    //             if (!empty($post['tanggal_akhir'])) {
    //                 $tanggal_akhir = $post['tanggal_akhir'];
    //             } else {
    //                 $tanggal_akhir = null;
    //             }

    //             if (!empty($post['propinsi'])) {
    //                 $propinsi = $post['propinsi'];
    //             } else {
    //                 $propinsi = null;
    //             }
    //             if (!empty($post['kota'])) {
    //                 $kota = $post['kota'];
    //             } else {
    //                 $kota = null;
    //             }
    //             if (!empty($post['jenis_fasyankes'])) {
    //                 $jenis_fasyankes = $post['jenis_fasyankes'];
    //             } else {
    //                 $jenis_fasyankes = null;
    //             }

    //             // print_r($post);
    //             $data = array(
    //                 'content' => 'view_pengajuan_usulan_survei',
    //                 // 'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
    //                 'data' => $this->Model_monitoring->select_pengajuan_search_monitoring($session_lpa, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes),
    //                 'session_lpa' => $session_lpa,
    //                 'propinsi' => $propinsi,
    //                 'kota' => $kota,
    //                 'jenis_fasyankes' => $jenis_fasyankes,
    //                 'tanggal_awal' => $tanggal_awal,
    //                 'tanggal_akhir' => $tanggal_akhir
    //             );

    //             // print_r($session_lpa);
    //             $this->load->view('monitoring_proses_primer', $data);
    //         } else if ($session_kriteria == 2) {

    //             $post = $this->input->post();
    //             if (!empty($post['tanggal_awal'])) {
    //                 $tanggal_awal = $post['tanggal_awal'];
    //             } else {
    //                 $tanggal_awal = null;
    //             }
    //             if (!empty($post['tanggal_akhir'])) {
    //                 $tanggal_akhir = $post['tanggal_akhir'];
    //             } else {
    //                 $tanggal_akhir = null;
    //             }

    //             if (!empty($post['propinsi'])) {
    //                 $propinsi = $post['propinsi'];
    //             } else {
    //                 $propinsi = null;
    //             }
    //             if (!empty($post['kota'])) {
    //                 $kota = $post['kota'];
    //             } else {
    //                 $kota = null;
    //             }
    //             if (!empty($post['jenis_fasyankes'])) {
    //                 $jenis_fasyankes = $post['jenis_fasyankes'];
    //             } else {
    //                 $jenis_fasyankes = null;
    //             }

    //             if (!empty($post['lpa_id'])) {
    //                 $lpa_id = $post['lpa_id'];
    //             } else {
    //                 $lpa_id = null;
    //             }

    //             // print_r($post);
    //             $data = array(
    //                 // 'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
    //                 'data' => $this->Model_monitoring->select_pengajuan_search_monitoring($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes),
    //                 'session_lpa' => $lpa_id,
    //                 'propinsi' => $propinsi,
    //                 'kota' => $kota,
    //                 'jenis_fasyankes' => $jenis_fasyankes,
    //                 'tanggal_awal' => $tanggal_awal,
    //                 'tanggal_akhir' => $tanggal_akhir,
    //                 'lpa_id' => $lpa_id
    //             );
    //             $this->load->view('monitoring_proses_primer', $data);
    //             // print_r($data['data']);
    //         } else if ($session_kriteria == 8) {
    //             $post = $this->input->post();
    //             if (!empty($post['tanggal_awal'])) {
    //                 $tanggal_awal = $post['tanggal_awal'];
    //             } else {
    //                 $tanggal_awal = null;
    //             }
    //             if (!empty($post['tanggal_akhir'])) {
    //                 $tanggal_akhir = $post['tanggal_akhir'];
    //             } else {
    //                 $tanggal_akhir = null;
    //             }

    //             if (!empty($post['propinsi'])) {
    //                 $propinsi = $post['propinsi'];
    //             } else {
    //                 $propinsi = null;
    //             }
    //             if (!empty($post['kota'])) {
    //                 $kota = $post['kota'];
    //             } else {
    //                 $kota = null;
    //             }
    //             if (!empty($post['jenis_fasyankes'])) {
    //                 $jenis_fasyankes = $post['jenis_fasyankes'];
    //             } else {
    //                 $jenis_fasyankes = null;
    //             }

    //             if (!empty($post['lpa_id'])) {
    //                 $lpa_id = $post['lpa_id'];
    //             } else {
    //                 $lpa_id = null;
    //             }

    //             // print_r($post);
    //             $data = array(
    //                 'content' => 'view_pengajuan_usulan_survei',
    //                 // 'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
    //                 'data' => $this->Model_monitoring->select_pengajuan_search_monitoring($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes),
    //                 'session_lpa' => $lpa_id,
    //                 'propinsi' => $propinsi,
    //                 'kota' => $kota,
    //                 'jenis_fasyankes' => $jenis_fasyankes,
    //                 'tanggal_awal' => $tanggal_awal,
    //                 'tanggal_akhir' => $tanggal_akhir,
    //                 'lpa_id' => $lpa_id
    //             );
    //             $this->load->view('monitoring_proses_primer', $data);
    //         }
    //     }
    // }


    function prosescopy()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $post = $this->security->xss_clean($this->input->post());
            $session_kriteria = $this->session->userdata('kriteria_id');
            // print_r($session_kriteria);
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
                    // 'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
                    'data' => $this->Model_monitoring->select_pengajuan_search_monitoring($session_lpa, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes),
                    'session_lpa' => $session_lpa,
                    'propinsi' => $propinsi,
                    'kota' => $kota,
                    'jenis_fasyankes' => $jenis_fasyankes,
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir
                );
                $this->load->view('monitoring_proses_primer', $data);
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
                    'data' => $this->Model_monitoring->select_pengajuan_search_monitoring($session_lpa, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes),
                    'session_lpa' => $session_lpa,
                    'propinsi' => $propinsi,
                    'kota' => $kota,
                    'jenis_fasyankes' => $jenis_fasyankes,
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir
                );

                // print_r($session_lpa);
                $this->load->view('monitoring_proses_primer_primer', $data);
            } else if ($session_kriteria == 2) {
                // $session_lpa = $this->session->userdata('lpa_id');

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
                    // 'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
                    'data' => $this->Model_monitoring->select_pengajuan_search_monitoring($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes),
                    'session_lpa' => $lpa_id,
                    'propinsi' => $propinsi,
                    'kota' => $kota,
                    'jenis_fasyankes' => $jenis_fasyankes,
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir,
                    'lpa_id' => $lpa_id
                );
                $this->load->view('monitoring_proses_primer_primer', $data);

                // print_r($post);
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
                    // 'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
                    'data' => $this->Model_monitoring->select_pengajuan_search_monitoring($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes),
                    'session_lpa' => $lpa_id,
                    'propinsi' => $propinsi,
                    'kota' => $kota,
                    'jenis_fasyankes' => $jenis_fasyankes,
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir,
                    'lpa_id' => $lpa_id
                );
                $this->load->view('monitoring_proses_primer_primer', $data);
            }
        }
    }
}
