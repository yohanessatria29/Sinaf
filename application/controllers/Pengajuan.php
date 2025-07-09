<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('Model_sina');
        $this->load->model('Model_viewdata');
        $this->load->model('Model_monitoring');
        define('MB', 1048576);
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        }
    }
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */

    public function index()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {

            $session_kriteria = $this->session->userdata('kriteria_id');
            $session_users_id = $this->session->userdata('user_id');

            if ($session_kriteria == 1) {
                $session_lpa = $this->session->userdata('lpa_id');

                // $post = $this->input->post();
                $post = $this->security->xss_clean($this->input->post());

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
                if (!empty($post['status_usulan_id'])) {
                    $status_usulan_id = $post['status_usulan_id'];
                } else {
                    $status_usulan_id = null;
                }

                $data = array(
                    // 'content' => 'view_pengajuan_usulan_survei',
                    // 'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
                    'data' => $this->Model_sina->pengajuan_search_new($session_lpa, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes, $status_usulan_id),
                    'session_lpa' => $session_lpa,
                    'propinsi' => $propinsi,
                    'kota' => $kota,
                    'status_usulan_id' => $status_usulan_id,
                    'jenis_fasyankes' => $this->Model_viewdata->get_data_fasyankes_admin($session_users_id)->result_array(),
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir
                );


                $this->load->view('view_pengajuan_usulan_survei', $data);
            }
        }
    }

    public function searchIndex()
    {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());
        // $post = $this->input->post();
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
            'data' => $this->Model_sina->select_pengajuan_search($propinsi, $kota, $jenis_fasyankes)
        );
        $this->load->view('view_pengajuan_usulan_survei', $data);
    }

    public function detail_backup_live()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $session_kriteria = $this->session->userdata('kriteria_id');
            $session_lpa = $this->session->userdata('lpa_id');
            if ($session_kriteria == 1) {
                $id = $this->uri->segment(3);
                $pengajuan = $this->Model_sina->select_pengajuan($id);
                if ($pengajuan[0]['lpa_id'] != $session_lpa) {
                    redirect('Pengajuan');
                } else {
                    $detail_pengajuan = $this->Model_sina->detail_pengajuan_survei($id);
                    $surveior = $this->Model_sina->select_surveior_kesepakatan($id);
                    $pengajuan_lama = $this->Model_sina->select_pengajuan($pengajuan[0]['pengajuan_usulan_survei_id_lama']);
                    $puskesmas = $this->Model_sina->get_puskesmas($pengajuan[0]['fasyankes_id']);
                    $surveior_lapangan = $this->Model_sina->getdatalapangan($pengajuan[0]['penetapan_tanggal_survei_id']);
                    $narahubung = $this->Model_sina->getDataNarahubung($pengajuan[0]['fasyankes_id']);
                    if (isset($surveior_lapangan[0]['id_surveior_satu_baru'])) {
                        $idsuveiorpengganti1 = $surveior_lapangan[0]['id_surveior_satu_baru'];
                        $keterangnapengganti1 = $surveior_lapangan[0]['keterangan_surveior_satu'];
                        $surveior_lapangan['datasurveiorpengganti1'] = $this->Model_sina->getdetailsuveior($idsuveiorpengganti1);
                    }

                    if (isset($surveior_lapangan[0]['id_surveior_dua_baru'])) {
                        $idsuveiorpengganti2 = $surveior_lapangan[0]['id_surveior_dua_baru'];
                        $keterangnapengganti2 = $surveior_lapangan[0]['keterangan_surveior_dua'];
                        $surveior_lapangan['datasurveiorpengganti2'] = $this->Model_sina->getdetailsuveior($idsuveiorpengganti2);
                    }
                    $datasurveiorlapangan = $this->Model_sina->getsurveiorlapangan($pengajuan[0]['penetapan_tanggal_survei_id']);
                    $getsurtug = $this->Model_sina->getsurtugtte($id);
                    $detail_faskes = $this->Model_sina->detail_faskes($pengajuan[0]['fasyankes_id'], $pengajuan[0]['jenis_fasyankes']);
                    if ($detail_faskes == '404') {
                        redirect('Pengajuan');
                    } else {
                        $data = array(
                            'content' => 'pengajuan_usulan_survei',
                            'data' => $pengajuan,
                            'data_lama' => $pengajuan_lama,
                            'puskesmas' => $puskesmas,
                            'lpa_id' => $session_lpa,
                            'surveior' => $surveior,
                            'detail_pengajuan' => $detail_pengajuan,
                            'id' => $id,
                            'surveior_lapangan' => $surveior_lapangan,
                            'narahubung' => $narahubung,
                            'data_surveior_lapangan' => $datasurveiorlapangan,
                            'surtug' => $getsurtug,
                            'detail_faskes' => $detail_faskes
                        );
                        $this->load->view('pengajuan_usulan_survei', $data);
                        // print_r($puskesmas);
                    }
                }
            }
        }
    }

    public function detail()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $session_kriteria = $this->session->userdata('kriteria_id');
            $session_lpa = $this->session->userdata('lpa_id');
            $session_users_id = $this->session->userdata('user_id');
            $session_user_fasyankes = $this->Model_viewdata->get_data_fasyankes_admin($session_users_id)->result_array();

            if ($session_kriteria == 1) {
                $id = $this->uri->segment(3);
                $pengajuan = $this->Model_sina->select_pengajuan($id);

                if ($pengajuan[0]['jenis_fasyankes'] === $session_user_fasyankes[0]['fasyankes_id']) {

                    if ($pengajuan[0]['lpa_id'] != $session_lpa) {
                        $this->session->set_flashdata('kode_name', 'danger');
                        $this->session->set_flashdata('icon_name', 'cross');
                        $this->session->set_flashdata('message_name', 'Tidak Memiliki Akses Faskes Tersebut!');
                        redirect('Pengajuan');
                    } else {
                        $detail_pengajuan = $this->Model_sina->detail_pengajuan_survei($id);
                        $surveior = $this->Model_sina->select_surveior_kesepakatan($id);
                        $pengajuan_lama = $this->Model_sina->select_pengajuan($pengajuan[0]['pengajuan_usulan_survei_id_lama']);
                        $puskesmas = $this->Model_sina->get_puskesmas($pengajuan[0]['fasyankes_id']);
                        $surveior_lapangan = $this->Model_sina->getdatalapangan($pengajuan[0]['penetapan_tanggal_survei_id']);
                        $narahubung = $this->Model_sina->getDataNarahubung($pengajuan[0]['fasyankes_id']);
                        if (isset($surveior_lapangan[0]['id_surveior_satu_baru'])) {
                            $idsuveiorpengganti1 = $surveior_lapangan[0]['id_surveior_satu_baru'];
                            $keterangnapengganti1 = $surveior_lapangan[0]['keterangan_surveior_satu'];
                            $surveior_lapangan['datasurveiorpengganti1'] = $this->Model_sina->getdetailsuveior($idsuveiorpengganti1);
                        }

                        if (isset($surveior_lapangan[0]['id_surveior_dua_baru'])) {
                            $idsuveiorpengganti2 = $surveior_lapangan[0]['id_surveior_dua_baru'];
                            $keterangnapengganti2 = $surveior_lapangan[0]['keterangan_surveior_dua'];
                            $surveior_lapangan['datasurveiorpengganti2'] = $this->Model_sina->getdetailsuveior($idsuveiorpengganti2);
                        }
                        $datasurveiorlapangan = $this->Model_sina->getsurveiorlapangan($pengajuan[0]['penetapan_tanggal_survei_id']);
                        $getsurtug = $this->Model_sina->getsurtugtte($id);
                        $detail_faskes = $this->Model_sina->detail_faskes($pengajuan[0]['fasyankes_id'], $pengajuan[0]['jenis_fasyankes']);

                        if ($detail_faskes == '404') {
                            $this->session->set_flashdata('kode_name', 'danger');
                            $this->session->set_flashdata('icon_name', 'cross');
                            $this->session->set_flashdata('message_name', 'Terjadi Kesalahan Silhakan untuk menghubungi Admin!');
                            redirect('Pengajuan');
                        } else {
                            $data = array(
                                'content' => 'pengajuan_usulan_survei',
                                'data' => $pengajuan,
                                'data_lama' => $pengajuan_lama,
                                'puskesmas' => $puskesmas,
                                'lpa_id' => $session_lpa,
                                'surveior' => $surveior,
                                'detail_pengajuan' => $detail_pengajuan,
                                'id' => $id,
                                'surveior_lapangan' => $surveior_lapangan,
                                'narahubung' => $narahubung,
                                'data_surveior_lapangan' => $datasurveiorlapangan,
                                'surtug' => $getsurtug,
                                'detail_faskes' => $detail_faskes
                            );
                            $this->load->view('pengajuan_usulan_survei', $data);
                        }
                    }
                } else {
                    $this->session->set_flashdata('kode_name', 'danger');
                    $this->session->set_flashdata('icon_name', 'cross');
                    $this->session->set_flashdata('message_name', 'Tidak Memiliki Akses ke Type Faskes Tersebut!');
                    redirect('Pengajuan');
                }
            }
        }
    }

    public function getsurveiorpengganti()
    {
        $idpengajuan = $this->input->post('idpengajuan');
        $idsurveior = $this->input->post('idsurveior');

        $datapengajuan = $this->Model_sina->get_detail_pengajuan($idpengajuan, $idsurveior);
        $lpa_id = $datapengajuan[0]['lpa_id'];
        $provinsiid = $datapengajuan[0]['provinsi_id'];
        $fasyankes_id = $datapengajuan[0]['fasyankes_id'];
        $idbidang = $datapengajuan[0]['bidang_id'];
        foreach ($datapengajuan as $value) {
            $tanggal[] = $value['jadwal_kesiapan'];
        }
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

        $where['kondisi'] = 'us.lpa_id = ' . $lpa_id . ' AND usbd.id_fasyankes_surveior = ' . $fasyankes_id . ' AND usbd.id_bidang = ' . $idbidang;
        $batal = '0';
        if (!empty($tanggal3)) {
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
            $where['kondisi_tanggal'] = "js.jadwal_kesiapan IN ('" . $tanggal1 . "', '" . $tanggal2 . "')";
            $where['tanggal'] = '2';


            $now = new DateTime();

            if ($date1 < $now) {
                $where['kondisi_tanggal'] = "js.jadwal_kesiapan IN ('" . $tanggal2 . "')";
                $where['tanggal'] = '1';
            }
        } else {
            $where['kondisi_tanggal'] = "jadwal_kesiapan IN ('" . $tanggal1 . "')";
            $where['tanggal'] = '1';
        }

        if ($fasyankes_id == '2' || $fasyankes_id == '3') {
            $where['domisili'] = 'AND us.provinsi_id = ' . $provinsiid . '';
        } else {
            $where['domisili'] = '';
        }

        $datasurveior = $this->Model_sina->select_surveior_pengganti_ukomm($where);
        echo json_encode($datasurveior);
    }

    public function getsurveiorpenggantiUkom()
    {
        // var_dump($this->input->post());
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
        echo json_encode($datasurveior);

        // print_r($fasyankes_id);
        // print_r($datasurveior);

    }

    public function getsurveiorpenggantiopenall()
    {
        $idpengajuan = $this->input->post('idpengajuan');
        $idsurveior = $this->input->post('idsurveior');

        $datapengajuan = $this->Model_sina->get_detail_pengajuan($idpengajuan, $idsurveior);
        $lpa_id = $datapengajuan[0]['lpa_id'];
        $provinsiid = $datapengajuan[0]['provinsi_id'];
        $fasyankes_id = $datapengajuan[0]['fasyankes_id'];
        $idbidang = $datapengajuan[0]['bidang_id'];
        foreach ($datapengajuan as $value) {
            $tanggal[] = $value['jadwal_kesiapan'];
        }
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

        // if ($fasyankes_id == '2' || $fasyankes_id == '3') {
        //     $where['domisili'] = 'AND us.provinsi_id = ' . $provinsiid . '';
        // } else {
        $where['domisili'] = '';
        // }


        // if ($batal === 1) {
        //     echo json_encode('test');
        // } else {
        //     echo json_encode('test');
        //     $datasurveior = $this->Model_sina->select_surveior_pengganti($where);
        //     echo json_encode($datasurveior);
        // }

        $datasurveior = $this->Model_sina->select_surveior_pengganti($where);
        echo json_encode($datasurveior);

        // print_r($fasyankes_id);
        // print_r($datasurveior);

    }


    public function getketeranganpengganti()
    {
        $dataketerangan = $this->Model_sina->getdataketeranganpengganti();
        echo json_encode($dataketerangan);
    }

    public function detailfasyankes()
    {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());
        if (!empty($post['bab'])) {
            $bab = $post['bab'];
        } else {
            $bab = null;
        }
        $id = $this->uri->segment(3);

        $data_pengajuan = $this->Model_sina->select_pengajuan($id);

        $data_select_pengajuan = $this->Model_sina->select_pengajuan($id);

        // $trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);

        // $trans = array_column($trans, null, "elemen_penilaian_id");

        if ($data_pengajuan[0]['jenis_survei_id'] == 2) {
            // $trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
            // $trans = array_column($trans, null, "elemen_penilaian_id");
            // if(!empty($trans)){

            // 	$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
            // 	$trans = array_column($trans, null, "elemen_penilaian_id");	

            // } else {
            $data_select_pengajuan_lama = $this->Model_sina->select_pengajuan($data_pengajuan[0]['pengajuan_usulan_survei_id_lama']);
            $trans = $this->Model_sina->select_trans_ep($data_select_pengajuan_lama[0]['penetapan_tanggal_survei_id']);
            $trans = array_column($trans, null, "elemen_penilaian_id");
            // }
            $trans_check = $this->Model_sina->select_trans_ep_check($data_select_pengajuan[0]['penetapan_tanggal_survei_id'], $bab);
            if (!empty($trans_check[0]['skor_capaian_verifikator'])) {
                $trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
                $trans = array_column($trans, null, "elemen_penilaian_id");
            }
        } else {
            if ($data_pengajuan[0]['jenis_akreditasi_id'] == 3) {
                $data_select_pengajuan_lama = $this->Model_sina->select_pengajuan($data_pengajuan[0]['pengajuan_usulan_survei_id_lama']);
                $trans = $this->Model_sina->select_trans_ep($data_select_pengajuan_lama[0]['penetapan_tanggal_survei_id']);
                $trans = array_column($trans, null, "elemen_penilaian_id");
                // }
                $trans_check = $this->Model_sina->select_trans_ep_check($data_select_pengajuan[0]['penetapan_tanggal_survei_id'], $bab);
                if (!empty($trans_check[0]['skor_capaian_verifikator'])) {
                    $trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
                    $trans = array_column($trans, null, "elemen_penilaian_id");
                }
            } else {
                $trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
                $trans = array_column($trans, null, "elemen_penilaian_id");
            }
        }


        $data = array(
            'content' => 'elemen_penilaian_surveior',
            'data' => $data_select_pengajuan,
            'datab' => $this->Model_sina->select_ep($bab, $data_pengajuan[0]['jenis_fasyankes']),
            'trans' => $trans,
            'count_trans' => $this->Model_sina->select_count_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id'], $data_pengajuan[0]['jenis_fasyankes']),
            'bab' => $bab,
            'data_sertifikat' => $this->Model_sina->getDataSertifikat($data_pengajuan[0]['fasyankes_id']),
            // 'datab'=> $this->Model_sina->select_ep($bab,6),
            //'datab'=> $this->Model_sina->select_ep(1,2),
            'id' => $id
        );
        $this->load->view('pengirimanlaporan_kemenkes', $data);
        // print_r($data['data_sertifikat']);
    }

    public function simpanPenerimaanUsulan()
    {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());
        $this->load->library('form_validation');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $datas = array(
                'pengajuan_usulan_survei_id' => $post['id'],
                'status_usulan_id' => $post['status_usulan_id'],
                'keterangan' => $post['keterangan']
            );

            if ($post['status_usulan_id'] == 2) {
                $where_usulan_id = array(
                    'pengajuan_usulan_survei_id' => $post['id']
                );

                $data_status = array(
                    'status' => 0
                );

                $this->Model_sina->edit_data('jadwal_surveior', $where_usulan_id, $data_status);
            }

            if (!empty($post['penerimaan_pengajuan_usulan_survei_id'])) {
                $where = array(
                    'id' => $post['penerimaan_pengajuan_usulan_survei_id']
                );

                $this->Model_sina->edit_data('penerimaan_pengajuan_usulan_survei', $where, $datas);
                $this->session->set_flashdata('kode_name', 'success');
                $this->session->set_flashdata('icon_name', 'check');
                $this->session->set_flashdata('message_name', 'Sukses Ubah Data!');

                $session_kriteria = $this->session->userdata('kriteria_id');
                if ($session_kriteria == 1) {
                    redirect('pengajuan/detail/' . $post['id']);
                    # code...
                } else if ($session_kriteria == 8) {
                    redirect('pengajuan/penolakanpengajuan');
                }
            } else {
                $this->Model_sina->input_data('penerimaan_pengajuan_usulan_survei', $datas);

                $this->session->set_flashdata('kode_name', 'success');
                $this->session->set_flashdata('icon_name', 'check');
                $this->session->set_flashdata('message_name', 'Sukses Input Data!');

                redirect('pengajuan');
            }
        }
    }

    public function simpanKelengkapanBerkas()
    {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());
        $this->load->library('form_validation');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {

            if ($post['kelengkapan_berkas_usulan'] == 2) {
                $kelengkapan_berkas_usulan_catatan = "";
            } else {
                $kelengkapan_berkas_usulan_catatan = $post['kelengkapan_berkas_usulan_catatan'];
            };

            if ($post['kelengkapan_dfo'] == 2) {
                $kelengkapan_dfo_catatan = "";
            } else {
                $kelengkapan_dfo_catatan = $post['kelengkapan_dfo_catatan'];
            };

            if ($post['kelengkapan_sarpras_alkes'] == 2) {
                $kelengkapan_sarpras_alkes_catatan = "";
            } else {
                $kelengkapan_sarpras_alkes_catatan = $post['kelengkapan_sarpras_alkes_catatan'];
            };

            if ($post['kelengkapan_nakes'] == 2) {
                $kelengkapan_nakes_catatan = "";
            } else {
                $kelengkapan_nakes_catatan = $post['kelengkapan_nakes_catatan'];
            };

            if ($post['kelengkapan_laporan_inm'] == 2) {
                $kelengkapan_laporan_inm_catatan = "";
            } else {
                $kelengkapan_laporan_inm_catatan = $post['kelengkapan_laporan_inm_catatan'];
            };

            if ($post['kelengkapan_laporan_ikp'] == 2) {
                $kelengkapan_laporan_ikp_catatan = "";
            } else {
                $kelengkapan_laporan_ikp_catatan = $post['kelengkapan_laporan_ikp_catatan'];
            };


            $datas = array(
                'berkas_usulan_survei_id' => $post['berkas_usulan_survei_id'],
                'kelengkapan_berkas_usulan' => $post['kelengkapan_berkas_usulan'],
                'kelengkapan_dfo' => $post['kelengkapan_dfo'],
                'kelengkapan_sarpras_alkes' => $post['kelengkapan_sarpras_alkes'],
                'kelengkapan_nakes' => $post['kelengkapan_nakes'],
                'kelengkapan_laporan_inm' => $post['kelengkapan_laporan_inm'],
                'kelengkapan_laporan_ikp' => $post['kelengkapan_laporan_ikp'],
                'kelengkapan_berkas_usulan_catatan' => $kelengkapan_berkas_usulan_catatan,
                'kelengkapan_dfo_catatan' => $kelengkapan_dfo_catatan,
                'kelengkapan_sarpras_alkes_catatan' => $kelengkapan_sarpras_alkes_catatan,
                'kelengkapan_nakes_catatan' => $kelengkapan_nakes_catatan,
                'kelengkapan_laporan_inm_catatan' => $kelengkapan_laporan_inm_catatan,
                'kelengkapan_laporan_ikp_catatan' => $kelengkapan_laporan_ikp_catatan
            );

            if (!empty($post['kelengkapan_berkas_id'])) {
                $where = array(
                    'id' => $post['kelengkapan_berkas_id']
                );

                $this->Model_sina->edit_data('kelengkapan_berkas', $where, $datas);
                $this->session->set_flashdata('kode_name', 'success');
                $this->session->set_flashdata('icon_name', 'check');
                $this->session->set_flashdata('message_name', 'Sukses Ubah Data!');

                redirect('pengajuan/detail/' . $post['id']);
            } else {
                $this->Model_sina->input_data('kelengkapan_berkas', $datas);

                $this->session->set_flashdata('kode_name', 'success');
                $this->session->set_flashdata('icon_name', 'check');
                $this->session->set_flashdata('message_name', 'Sukses Input Data!');

                // redirect('pengajuan');
                redirect('pengajuan/detail/' . $post['id']);
            }
        }
    }

    public function simpanPenetapanTanggalSurvei()
    {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());

        // $config['upload_path']          = 'assets/uploads/berkas_akreditasi/';
        // $config['allowed_types']        = 'pdf|xls|xlsx';
        // $config['max_size']             = 2048;
        // $config['max_width']            = 1080;
        // $config['max_height']           = 1080;
        // $config['overwrite']            = true;
        // $config['encrypt_name']         = TRUE;

        //$url = 'https://sirs.kemkes.go.id/fo/sisrute_dok/';

        //Upload url_dokumen_kontrak
        // if (!empty($_FILES['url_dokumen_kontrak']['name'])) {
        //     $this->load->library('upload', $config);
        //     if (!$this->upload->do_upload('url_dokumen_kontrak')) {
        //         print_r($this->upload->display_errors());
        //         exit;
        //     }

        //     $attachment = $this->upload->data();
        //     $fileName = $attachment['file_name'];

        //     //$url_dokumen_kontrak =  $url.$fileName;
        //     $url_dokumen_kontrak =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
        // } else {
        //     if (isset($post['old_url_dokumen_kontrak'])) {
        //         $url_dokumen_kontrak = $post['old_url_dokumen_kontrak'];
        //     } else {
        //         $url_dokumen_kontrak = '';
        //     }
        // }
        // COMMENT SEMENTARA

        //Upload url_surat_tugas
        // if (!empty($_FILES['url_surat_tugas']['name'])) {
        //     $this->load->library('upload', $config);
        //     if (!$this->upload->do_upload('url_surat_tugas')) {
        //         print_r($this->upload->display_errors());
        //         exit;
        //     }

        //     $attachment = $this->upload->data();
        //     $fileName = $attachment['file_name'];

        //     //$url_surat_tugas =  $url.$fileName;
        //     $url_surat_tugas =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
        // } else {
        //     if (isset($post['old_url_surat_tugas'])) {
        //         $url_surat_tugas = $post['old_url_surat_tugas'];
        //     } else {
        //         $url_surat_tugas = '';
        //     }
        // }
        // COMMENT SEMENTARA

        if (!empty($post['surveior_satu_arr'])) {
            $surveior_satu_arr = $post['surveior_satu_arr'];
            $surveior_satu = null;
            $status_surveior_satu = null;
        } else {
            $surveior_satu_arr = array();
            $surveior_satu = $post['surveior_satu'];
            $status_surveior_satu = 1;
        }

        if (!empty($post['surveior_dua_arr'])) {
            $surveior_dua_arr = $post['surveior_dua_arr'];
            $surveior_dua = null;
            $status_surveior_dua = null;
        } else {
            $surveior_dua_arr = array();
            $surveior_dua = $post['surveior_dua'];
            $status_surveior_dua = 2;
        }

        $datas = array(
            'kelengkapan_berkas_id' => $post['kelengkapan_berkas_id'],
            'url_dokumen_kontrak' => $post['url_dokumen_kontrak'],
            'url_dokumen_pendukung_ep' => $post['url_dokumen_pendukung_ep'],
            'surveior_satu' => $post['surveior_satu'],
            'status_surveior_satu' => $post['status_surveior_satu'],
            'surveior_dua' => $post['surveior_dua'],
            'status_surveior_dua' => $post['status_surveior_dua'],
            'url_surat_tugas' => $post['url_surat_tugas']
        );

        // COMMENT SEMENTARA

        // print_r($this->input->post());
        if (!empty($post['penetapan_tanggal_survei_id'])) {

            // UPDATE DATA PENETAPAN TANGGAL SURVEI JIKA ADA PERUBAHAN SURAT TUGAS ATAU URL DOKUMEN PENDUKUNG

            $where = array('id' => $post['penetapan_tanggal_survei_id']);
            $this->Model_sina->edit_data('penetapan_tanggal_survei', $where, $datas);

            // UPDATE DATA PENETAPAN TANGGAL SURVEI JIKA ADA PERUBAHAN SURAT TUGAS ATAU URL DOKUMEN PENDUKUNG

            // JIKA ADA PERUBAHAN SURVEIOR SATU NOTED TIDAK DIGUNAKAN
            // if (!empty($surveior_satu_arr)) {
            //     $tanggal_rencana_survei = $post['tanggal_rencana_survei'];

            //     for ($i = 0; $i < count($surveior_satu_arr); $i++) {
            //         $whereSurveior = array(
            //             'pengajuan_usulan_survei_id' => $post['id'],
            //             'tanggal_survei'             => $tanggal_rencana_survei[$i]
            //         );

            //         $updatedSurveior = array(
            //             'tanggal_survei' => $tanggal_rencana_survei[$i],
            //             'surveior_1' => $surveior_satu_arr[$i],
            //             'surveior_2' => $surveior_dua_arr[$i]
            //         );

            //         $this->Model_sina->edit_data('pengajuan_usulan_survei_detail', $whereSurveior, $updatedSurveior);
            //     }
            // }
            // JIKA ADA PERUBAHAN SURVEIOR SATU NOTED TIDAK DIGUNAKAN

            if (isset($post['id_surveior_lapangan'])) {
                if ($post['jabatan'] == 'jabatansurveior1') {
                    $jabatan_surveior_id_satu = '1';
                    $jabatan_surveior_id_dua = '2';
                    $datalapangan['jabatan_surveior_id_satu'] = $jabatan_surveior_id_satu;
                    $datalapangan['jabatan_surveior_id_dua'] = $jabatan_surveior_id_dua;
                } else if ($post['jabatan'] == 'jabatansurveior2') {
                    $jabatan_surveior_id_satu = '2';
                    $jabatan_surveior_id_dua = '1';
                    $datalapangan['jabatan_surveior_id_satu'] = $jabatan_surveior_id_satu;
                    $datalapangan['jabatan_surveior_id_dua'] = $jabatan_surveior_id_dua;
                }

                $where_lapangan = array(
                    'id' => $post['id_surveior_lapangan'],
                );

                if (isset($post['penggantis1'])) {
                    if ($post['keterangan1'] == 7) {
                        $databalik = array(
                            'status' => 0,
                            'pengajuan_usulan_survei_id' => null
                        );
                        $whereupdatejadwal = array(
                            'user_surveior_id' => $post['id_surveior_satu'],
                            'pengajuan_usulan_survei_id' => $post['id']
                        );
                        $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
                        // echo 'ini';
                        // print_r($whereupdatejadwal);
                        // print_r($databalik);
                        // print_r($test);
                    } else {
                        $databalik = array(
                            'status' => $post['keterangan1']
                        );
                        $whereupdatejadwal = array(
                            'user_surveior_id' => $post['id_surveior_satu'],
                            'pengajuan_usulan_survei_id' => $post['id']
                        );
                        $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
                    }

                    $datalapangan['id_surveior_satu_baru'] = $post['penggantis1'];
                    // $datalapangan['jabatan_surveior_id_satu'] = $jabatan_surveior_id_satu;
                    // $datalapangan['jabatan_surveior_id_dua'] = $jabatan_surveior_id_dua;
                    $datalapangan['keterangan_surveior_satu_id'] = $post['keterangan1'];
                    // UPDATE JADWAL
                    if (isset($post['tanggal_1'])) {
                        $tanggal1 = $post['tanggal_1'];
                        $where_update = array(
                            'user_surveior_id' => $post['penggantis1'],
                            'jadwal_kesiapan' => $tanggal1
                        );
                        $dataupdate_jadwal = array(
                            'status' => 1,
                            'pengajuan_usulan_survei_id' => $post['id']
                        );

                        // UPDATE TANGGAL1 SURVEIOR 1
                        $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                        // UPDATE TANGGAL1 SURVEIOR 1
                    }
                    if (isset($post['tanggal_2'])) {
                        $tanggal2 = $post['tanggal_2'];
                        $where_update = array(
                            'user_surveior_id' => $post['penggantis1'],
                            'jadwal_kesiapan' => $tanggal2
                        );

                        $dataupdate_jadwal = array(
                            'status' => 1,
                            'pengajuan_usulan_survei_id' => $post['id']
                        );
                        // UPDATE TANGGAL2 SURVEIOR 1
                        $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                        // UPDATE TANGGAL2 SURVEIOR 1
                    }
                    if (isset($post['tanggal_3'])) {
                        $tanggal3 = $post['tanggal_3'];
                        $where_update = array(
                            'user_surveior_id' => $post['penggantis1'],
                            'jadwal_kesiapan' => $tanggal3
                        );

                        $dataupdate_jadwal = array(
                            'status' => 1,
                            'pengajuan_usulan_survei_id' => $post['id']
                        );
                        // UPDATE TANGGAL3 SURVEIOR 1
                        $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                        // UPDATE TANGGAL3 SURVEIOR 1
                    }
                    // UPDATE JADWAL
                } else {
                    $dataupdate = array(
                        'status' => 1
                    );

                    $whereupdatejadwal = array(
                        'user_surveior_id' => $post['id_surveior_satu'],
                        'pengajuan_usulan_survei_id' => $post['id']
                    );
                    $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $dataupdate);
                }

                if (isset($post['penggantis2'])) {
                    if ($post['keterangan2'] == 7) {
                        $databalik = array(
                            'status' => 0,
                            'pengajuan_usulan_survei_id' => null
                        );
                        $whereupdatejadwal = array(
                            'user_surveior_id' => $post['id_surveior_dua'],
                            'pengajuan_usulan_survei_id' => $post['id']
                        );
                        $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
                    } else {
                        $databalik = array(
                            'status' => $post['keterangan2']
                        );
                        $whereupdatejadwal = array(
                            'user_surveior_id' => $post['id_surveior_dua'],
                            'pengajuan_usulan_survei_id' => $post['id']
                        );
                        $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
                    }

                    $datalapangan['id_surveior_dua_baru'] = $post['penggantis2'];
                    // $datalapangan['keterangan_surveior_dua'] = $post['keterangandua'];
                    $datalapangan['keterangan_surveior_dua_id'] = $post['keterangan2'];
                    // UPDATE JADWAL
                    if (isset($post['tanggal_1'])) {
                        $tanggal1 = $post['tanggal_1'];
                        $where_update = array(
                            'user_surveior_id' => $post['penggantis2'],
                            'jadwal_kesiapan' => $tanggal1
                        );
                        $dataupdate_jadwal = array(
                            'status' => 1,
                            'pengajuan_usulan_survei_id' => $post['id']
                        );

                        // UPDATE TANGGAL1 SURVEIOR 2
                        $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                        // UPDATE TANGGAL1 SURVEIOR 2
                    }
                    if (isset($post['tanggal_2'])) {
                        $tanggal2 = $post['tanggal_2'];
                        $where_update = array(
                            'user_surveior_id' => $post['penggantis2'],
                            'jadwal_kesiapan' => $tanggal2
                        );
                        $dataupdate_jadwal = array(
                            'status' => 1,
                            'pengajuan_usulan_survei_id' => $post['id']
                        );

                        // UPDATE TANGGAL2 SURVEIOR 2
                        $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                        // UPDATE TANGGAL2 SURVEIOR 2
                    }
                    if (isset($post['tanggal_3'])) {
                        $tanggal3 = $post['tanggal_3'];

                        $where_update = array(
                            'user_surveior_id' => $post['penggantis2'],
                            'jadwal_kesiapan' => $tanggal3
                        );
                        $dataupdate_jadwal = array(
                            'status' => 1,
                            'pengajuan_usulan_survei_id' => $post['id']
                        );

                        // UPDATE TANGGAL3 SURVEIOR 2
                        $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                        // UPDATE TANGGAL3 SURVEIOR 2
                    }
                    // UPDATE JADWAL
                } else {
                    $dataupdate = array(
                        'status' => 1
                    );

                    $whereupdatejadwal = array(
                        'user_surveior_id' => $post['id_surveior_dua'],
                        'pengajuan_usulan_survei_id' => $post['id']
                    );
                    $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $dataupdate);
                }

                $this->Model_sina->edit_data('surveior_lapangan', $where_lapangan, $datalapangan);
            } else {

                if ($post['jabatan'] == 'jabatansurveior1') {
                    $jabatan_surveior_id_satu = '1';
                    $jabatan_surveior_id_dua = '2';
                } else if ($post['jabatan'] == 'jabatansurveior2') {
                    $jabatan_surveior_id_satu = '2';
                    $jabatan_surveior_id_dua = '1';
                }

                $datalapangan = array(
                    'penetapan_tanggal_survei_id' => $post['penetapan_tanggal_survei_id'],
                    'id_surveior_satu_lama' => $post['id_surveior_satu'],
                    'id_surveior_dua_lama' => $post['id_surveior_dua'],
                    'id_surveior_satu_baru' => $post['id_surveior_satu'],
                    'id_surveior_dua_baru' => $post['id_surveior_dua'],
                    'jabatan_surveior_id_satu' => $jabatan_surveior_id_satu,
                    'jabatan_surveior_id_dua' => $jabatan_surveior_id_dua
                );

                if (isset($post['penggantis1'])) {
                    if ($post['keterangan1'] == 7) {
                        $databalik = array(
                            'status' => 0,
                            'pengajuan_usulan_survei_id' => null
                        );
                        $whereupdatejadwal = array(
                            'user_surveior_id' => $post['id_surveior_satu'],
                            'pengajuan_usulan_survei_id' => $post['id']
                        );
                        $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
                    } else {
                        $databalik = array(
                            'status' => $post['keterangan1']
                        );
                        $whereupdatejadwal = array(
                            'user_surveior_id' => $post['id_surveior_satu'],
                            'pengajuan_usulan_survei_id' => $post['id']
                        );
                        $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
                    }

                    $datalapangan['id_surveior_satu_baru'] = $post['penggantis1'];
                    $datalapangan['keterangan_surveior_satu_id'] = $post['keterangan1'];
                    // $datalapangan['keterangan_surveior_satu'] = $post['keterangansatu'];

                    // UPDATE JADWAL
                    if (isset($post['tanggal_1'])) {
                        $tanggal1 = $post['tanggal_1'];
                        $where_update = array(
                            'user_surveior_id' => $post['penggantis1'],
                            'jadwal_kesiapan' => $tanggal1
                        );
                        $dataupdate_jadwal = array(
                            'status' => 1,
                            'pengajuan_usulan_survei_id' => $post['id']
                        );

                        // UPDATE TANGGAL1 SURVEIOR 1
                        $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                        // UPDATE TANGGAL1 SURVEIOR 1
                    }
                    if (isset($post['tanggal_2'])) {
                        $tanggal2 = $post['tanggal_2'];
                        $where_update = array(
                            'user_surveior_id' => $post['penggantis1'],
                            'jadwal_kesiapan' => $tanggal2
                        );

                        $dataupdate_jadwal = array(
                            'status' => 1,
                            'pengajuan_usulan_survei_id' => $post['id']
                        );
                        // UPDATE TANGGAL2 SURVEIOR 1
                        $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                        // UPDATE TANGGAL2 SURVEIOR 1
                    }
                    if (isset($post['tanggal_3'])) {
                        $tanggal3 = $post['tanggal_3'];
                        $where_update = array(
                            'user_surveior_id' => $post['penggantis1'],
                            'jadwal_kesiapan' => $tanggal3
                        );

                        $dataupdate_jadwal = array(
                            'status' => 1,
                            'pengajuan_usulan_survei_id' => $post['id']
                        );
                        // UPDATE TANGGAL3 SURVEIOR 1
                        $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                        // UPDATE TANGGAL3 SURVEIOR 1
                    }
                    // UPDATE JADWAL
                }

                if (isset($post['penggantis2'])) {

                    if ($post['keterangan2'] == 7) {
                        $databalik = array(
                            'status' => 0,
                            'pengajuan_usulan_survei_id' => null
                        );
                        $whereupdatejadwal = array(
                            'user_surveior_id' => $post['id_surveior_dua'],
                            'pengajuan_usulan_survei_id' => $post['id']
                        );
                        $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
                    } else {
                        $databalik = array(
                            'status' => $post['keterangan2']
                        );
                        $whereupdatejadwal = array(
                            'user_surveior_id' => $post['id_surveior_dua'],
                            'pengajuan_usulan_survei_id' => $post['id']
                        );
                        $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
                    }

                    $datalapangan['id_surveior_dua_baru'] = $post['penggantis2'];
                    $datalapangan['keterangan_surveior_dua_id'] = $post['keterangan2'];
                    // $datalapangan['keterangan_surveior_dua'] = $post['keterangandua'];
                    // UPDATE JADWAL
                    if (isset($post['tanggal_1'])) {
                        $tanggal1 = $post['tanggal_1'];
                        $where_update = array(
                            'user_surveior_id' => $post['penggantis2'],
                            'jadwal_kesiapan' => $tanggal1
                        );
                        $dataupdate_jadwal = array(
                            'status' => 1,
                            'pengajuan_usulan_survei_id' => $post['id']
                        );

                        // UPDATE TANGGAL1 SURVEIOR 2
                        $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                        // UPDATE TANGGAL1 SURVEIOR 2
                    }
                    if (isset($post['tanggal_2'])) {
                        $tanggal2 = $post['tanggal_2'];
                        $where_update = array(
                            'user_surveior_id' => $post['penggantis2'],
                            'jadwal_kesiapan' => $tanggal2
                        );
                        $dataupdate_jadwal = array(
                            'status' => 1,
                            'pengajuan_usulan_survei_id' => $post['id']
                        );

                        // UPDATE TANGGAL2 SURVEIOR 2
                        $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                        // UPDATE TANGGAL2 SURVEIOR 2
                    }
                    if (isset($post['tanggal_3'])) {
                        $tanggal3 = $post['tanggal_3'];

                        $where_update = array(
                            'user_surveior_id' => $post['penggantis2'],
                            'jadwal_kesiapan' => $tanggal3
                        );
                        $dataupdate_jadwal = array(
                            'status' => 1,
                            'pengajuan_usulan_survei_id' => $post['id']
                        );

                        // UPDATE TANGGAL3 SURVEIOR 2
                        $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                        // UPDATE TANGGAL3 SURVEIOR 2
                    }
                    // UPDATE JADWAL
                }

                $this->Model_sina->input_data('surveior_lapangan', $datalapangan);
            }

            $this->session->set_flashdata('kode_name', 'success');
            $this->session->set_flashdata('icon_name', 'check');
            $this->session->set_flashdata('message_name', 'Sukses Ubah Data!');
            redirect('pengajuan/detail/' . $post['id']);
        } else {
            $input_penetapan = $this->Model_sina->input_data_lastid('penetapan_tanggal_survei', $datas);
            // INSERT SURVEIOR LAPANGAN

            if ($post['jabatan'] == 'jabatansurveior1') {
                $jabatan_surveior_id_satu = '1';
                $jabatan_surveior_id_dua = '2';
            } else if ($post['jabatan'] == 'jabatansurveior2') {
                $jabatan_surveior_id_satu = '2';
                $jabatan_surveior_id_dua = '1';
            }

            $datalapangan = array(
                'penetapan_tanggal_survei_id' => $input_penetapan,
                'id_surveior_satu_lama' => $post['id_surveior_satu'],
                'id_surveior_dua_lama' => $post['id_surveior_dua'],
                'jabatan_surveior_id_satu' => $jabatan_surveior_id_satu,
                'id_surveior_satu_baru' => $post['id_surveior_satu'],
                'id_surveior_dua_baru' => $post['id_surveior_dua'],
                'jabatan_surveior_id_dua' => $jabatan_surveior_id_dua
            );

            if (isset($post['penggantis1'])) {
                if ($post['keterangan1'] == 7) {
                    $databalik = array(
                        'status' => 0,
                        'pengajuan_usulan_survei_id' => null
                    );
                    $whereupdatejadwal = array(
                        'user_surveior_id' => $post['id_surveior_satu'],
                        'pengajuan_usulan_survei_id' => $post['id']
                    );
                    $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
                } else {
                    $databalik = array(
                        'status' => $post['keterangan1']
                    );
                    $whereupdatejadwal = array(
                        'user_surveior_id' => $post['id_surveior_satu'],
                        'pengajuan_usulan_survei_id' => $post['id']
                    );
                    $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
                }
                $datalapangan['id_surveior_satu_baru'] = $post['penggantis1'];
                // $datalapangan['keterangan_surveior_satu'] = $post['keterangansatu'];
                $datalapangan['keterangan_surveior_satu_id'] = $post['keterangan1'];

                // UPDATE JADWAL
                if (isset($post['tanggal_1'])) {
                    $tanggal1 = $post['tanggal_1'];
                    $where_update = array(
                        'user_surveior_id' => $post['penggantis1'],
                        'jadwal_kesiapan' => $tanggal1
                    );
                    $dataupdate_jadwal = array(
                        'status' => 1,
                        'pengajuan_usulan_survei_id' => $post['id']
                    );

                    // UPDATE TANGGAL1 SURVEIOR 1
                    $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                    // UPDATE TANGGAL1 SURVEIOR 1
                }
                if (isset($post['tanggal_2'])) {
                    $tanggal2 = $post['tanggal_2'];
                    $where_update = array(
                        'user_surveior_id' => $post['penggantis1'],
                        'jadwal_kesiapan' => $tanggal2
                    );

                    $dataupdate_jadwal = array(
                        'status' => 1,
                        'pengajuan_usulan_survei_id' => $post['id']
                    );
                    // UPDATE TANGGAL2 SURVEIOR 1
                    $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                    // UPDATE TANGGAL2 SURVEIOR 1
                }
                if (isset($post['tanggal_3'])) {
                    $tanggal3 = $post['tanggal_3'];
                    $where_update = array(
                        'user_surveior_id' => $post['penggantis1'],
                        'jadwal_kesiapan' => $tanggal3
                    );

                    $dataupdate_jadwal = array(
                        'status' => 1,
                        'pengajuan_usulan_survei_id' => $post['id']
                    );
                    // UPDATE TANGGAL3 SURVEIOR 1
                    $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                    // UPDATE TANGGAL3 SURVEIOR 1
                }
                // UPDATE JADWAL
            } else {
                $dataupdate = array(
                    'status' => 1
                );
                $whereupdatejadwal = array(
                    'user_surveior_id' => $post['id_surveior_satu'],
                    'pengajuan_usulan_survei_id' => $post['id']
                );
                $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $dataupdate);
            }

            if (isset($post['penggantis2'])) {
                if ($post['keterangan2'] == 7) {
                    $databalik = array(
                        'status' => 0,
                        'pengajuan_usulan_survei_id' => null
                    );
                    $whereupdatejadwal = array(
                        'user_surveior_id' => $post['id_surveior_dua'],
                        'pengajuan_usulan_survei_id' => $post['id']
                    );
                    $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
                } else {
                    $databalik = array(
                        'status' => $post['keterangan2']
                    );
                    $whereupdatejadwal = array(
                        'user_surveior_id' => $post['id_surveior_dua'],
                        'pengajuan_usulan_survei_id' => $post['id']
                    );
                    $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
                }
                $datalapangan['id_surveior_dua_baru'] = $post['penggantis2'];
                // $datalapangan['keterangan_surveior_dua'] = $post['keterangandua'];
                $datalapangan['keterangan_surveior_dua_id'] = $post['keterangan2'];
                // UPDATE JADWAL
                if (isset($post['tanggal_1'])) {
                    $tanggal1 = $post['tanggal_1'];
                    $where_update = array(
                        'user_surveior_id' => $post['penggantis2'],
                        'jadwal_kesiapan' => $tanggal1
                    );
                    $dataupdate_jadwal = array(
                        'status' => 1,
                        'pengajuan_usulan_survei_id' => $post['id']
                    );

                    // UPDATE TANGGAL1 SURVEIOR 2
                    $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                    // UPDATE TANGGAL1 SURVEIOR 2
                }
                if (isset($post['tanggal_2'])) {
                    $tanggal2 = $post['tanggal_2'];
                    $where_update = array(
                        'user_surveior_id' => $post['penggantis2'],
                        'jadwal_kesiapan' => $tanggal2
                    );
                    $dataupdate_jadwal = array(
                        'status' => 1,
                        'pengajuan_usulan_survei_id' => $post['id']
                    );

                    // UPDATE TANGGAL2 SURVEIOR 2
                    $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                    // UPDATE TANGGAL2 SURVEIOR 2
                }
                if (isset($post['tanggal_3'])) {
                    $tanggal3 = $post['tanggal_3'];

                    $where_update = array(
                        'user_surveior_id' => $post['penggantis2'],
                        'jadwal_kesiapan' => $tanggal3
                    );
                    $dataupdate_jadwal = array(
                        'status' => 1,
                        'pengajuan_usulan_survei_id' => $post['id']
                    );

                    // UPDATE TANGGAL3 SURVEIOR 2
                    $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
                    // UPDATE TANGGAL3 SURVEIOR 2
                }
                // UPDATE JADWAL
            } else {
                $dataupdate = array(
                    'status' => 1
                );
                $whereupdatejadwal = array(
                    'user_surveior_id' => $post['id_surveior_dua'],
                    'pengajuan_usulan_survei_id' => $post['id']
                );
                $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $dataupdate);
            }

            $this->Model_sina->input_data('surveior_lapangan', $datalapangan);
            // INSERT SURVEIOR LAPANGAN

            $this->session->set_flashdata('kode_name', 'success');
            $this->session->set_flashdata('icon_name', 'check');
            $this->session->set_flashdata('message_name', 'Sukses Input Data!');
            redirect('pengajuan/detail/' . $post['id']);
        }

        // COMMENT SEMENTARA
    }

    // public function simpanPenetapanTanggalSurveiCopy()
    // {
    //     $post = $this->input->post();
    //     $config['upload_path']          = 'assets/uploads/berkas_akreditasi/';
    //     $config['allowed_types']        = 'pdf|xls|xlsx';
    //     $config['max_size']             = 2048;
    //     $config['max_width']            = 1080;
    //     $config['max_height']           = 1080;
    //     $config['overwrite']            = true;
    //     $config['encrypt_name']         = TRUE;

    //     //Upload url_dokumen_kontrak
    //     if (!empty($_FILES['url_dokumen_kontrak']['name'])) {
    //         $this->load->library('upload', $config);
    //         if (!$this->upload->do_upload('url_dokumen_kontrak')) {
    //             print_r($this->upload->display_errors());
    //             exit;
    //         }

    //         $attachment = $this->upload->data();
    //         $fileName = $attachment['file_name'];

    //         //$url_dokumen_kontrak =  $url.$fileName;
    //         $url_dokumen_kontrak =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
    //     } else {
    //         if (isset($post['old_url_dokumen_kontrak'])) {
    //             $url_dokumen_kontrak = $post['old_url_dokumen_kontrak'];
    //         } else {
    //             $url_dokumen_kontrak = '';
    //         }
    //     }
    //     // COMMENT SEMENTARA

    //     //Upload url_surat_tugas
    //     if (!empty($_FILES['url_surat_tugas']['name'])) {
    //         $this->load->library('upload', $config);
    //         if (!$this->upload->do_upload('url_surat_tugas')) {
    //             print_r($this->upload->display_errors());
    //             exit;
    //         }

    //         $attachment = $this->upload->data();
    //         $fileName = $attachment['file_name'];

    //         //$url_surat_tugas =  $url.$fileName;
    //         $url_surat_tugas =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
    //     } else {
    //         if (isset($post['old_url_surat_tugas'])) {
    //             $url_surat_tugas = $post['old_url_surat_tugas'];
    //         } else {
    //             $url_surat_tugas = '';
    //         }
    //     }
    //     // COMMENT SEMENTARA

    //     if (!empty($post['surveior_satu_arr'])) {
    //         $surveior_satu_arr = $post['surveior_satu_arr'];
    //         $surveior_satu = null;
    //         $status_surveior_satu = null;
    //     } else {
    //         $surveior_satu_arr = array();
    //         $surveior_satu = $post['surveior_satu'];
    //         $status_surveior_satu = 1;
    //     }

    //     if (!empty($post['surveior_dua_arr'])) {
    //         $surveior_dua_arr = $post['surveior_dua_arr'];
    //         $surveior_dua = null;
    //         $status_surveior_dua = null;
    //     } else {
    //         $surveior_dua_arr = array();
    //         $surveior_dua = $post['surveior_dua'];
    //         $status_surveior_dua = 2;
    //     }

    //     $datas = array(
    //         'kelengkapan_berkas_id' => $post['kelengkapan_berkas_id'],
    //         'url_dokumen_kontrak' => $url_dokumen_kontrak,
    //         'url_dokumen_pendukung_ep' => $post['url_dokumen_pendukung_ep'],
    //         'surveior_satu' => $post['surveior_satu'],
    //         'status_surveior_satu' => $post['status_surveior_satu'],
    //         'surveior_dua' => $post['surveior_dua'],
    //         'status_surveior_dua' => $post['status_surveior_dua'],
    //         'url_surat_tugas' => $url_surat_tugas
    //     );

    //     if (!empty($post['penetapan_tanggal_survei_id'])) {

    //         // UPDATE DATA PENETAPAN TANGGAL SURVEI JIKA ADA PERUBAHAN SURAT TUGAS ATAU URL DOKUMEN PENDUKUNG

    //         $where = array('id' => $post['penetapan_tanggal_survei_id']);
    //         $this->Model_sina->edit_data('penetapan_tanggal_survei', $where, $datas);

    //         // UPDATE DATA PENETAPAN TANGGAL SURVEI JIKA ADA PERUBAHAN SURAT TUGAS ATAU URL DOKUMEN PENDUKUNG

    //         if (isset($post['id_surveior_lapangan'])) {
    //             // if ($post['jabatan'] == 'jabatansurveior1') {
    //             //     $jabatan_surveior_id_satu = '1';
    //             //     $jabatan_surveior_id_dua = '2';
    //             //     $datalapangan['jabatan_surveior_id_satu'] = $jabatan_surveior_id_satu;
    //             //     $datalapangan['jabatan_surveior_id_dua'] = $jabatan_surveior_id_dua;
    //             // } else if ($post['jabatan'] == 'jabatansurveior2') {
    //             //     $jabatan_surveior_id_satu = '2';
    //             //     $jabatan_surveior_id_dua = '1';
    //             //     $datalapangan['jabatan_surveior_id_satu'] = $jabatan_surveior_id_satu;
    //             //     $datalapangan['jabatan_surveior_id_dua'] = $jabatan_surveior_id_dua;
    //             // }

    //             // $where_lapangan = array(
    //             //     'id' => $post['id_surveior_lapangan'],
    //             // );

    //             // if (isset($post['penggantis1'])) {
    //             //     if ($post['keterangan1'] == 7) {
    //             //         $databalik = array(
    //             //             'status' => 0,
    //             //             'pengajuan_usulan_survei_id' => null
    //             //         );
    //             //         $whereupdatejadwal = array(
    //             //             'user_surveior_id' => $post['id_surveior_satu'],
    //             //             'pengajuan_usulan_survei_id' => $post['id']
    //             //         );
    //             //         $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
    //             //     } else {
    //             //         $databalik = array(
    //             //             'status' => $post['keterangan1']
    //             //         );
    //             //         $whereupdatejadwal = array(
    //             //             'user_surveior_id' => $post['id_surveior_satu'],
    //             //             'pengajuan_usulan_survei_id' => $post['id']
    //             //         );
    //             //         $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
    //             //     }

    //             //     $datalapangan['id_surveior_satu_baru'] = $post['penggantis1'];
    //             //     $datalapangan['keterangan_surveior_satu_id'] = $post['keterangan1'];
    //             //     // UPDATE JADWAL
    //             //     if (isset($post['tanggal_1'])) {
    //             //         $tanggal1 = $post['tanggal_1'];
    //             //         $where_update = array(
    //             //             'user_surveior_id' => $post['penggantis1'],
    //             //             'jadwal_kesiapan' => $tanggal1
    //             //         );
    //             //         $dataupdate_jadwal = array(
    //             //             'status' => 1,
    //             //             'pengajuan_usulan_survei_id' => $post['id']
    //             //         );
    //             //         // UPDATE TANGGAL1 SURVEIOR 1
    //             //         $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //             //         // UPDATE TANGGAL1 SURVEIOR 1
    //             //     }
    //             //     if (isset($post['tanggal_2'])) {
    //             //         $tanggal2 = $post['tanggal_2'];
    //             //         $where_update = array(
    //             //             'user_surveior_id' => $post['penggantis1'],
    //             //             'jadwal_kesiapan' => $tanggal2
    //             //         );
    //             //         $dataupdate_jadwal = array(
    //             //             'status' => 1,
    //             //             'pengajuan_usulan_survei_id' => $post['id']
    //             //         );
    //             //         // UPDATE TANGGAL2 SURVEIOR 1
    //             //         $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //             //         // UPDATE TANGGAL2 SURVEIOR 1
    //             //     }
    //             //     if (isset($post['tanggal_3'])) {
    //             //         $tanggal3 = $post['tanggal_3'];
    //             //         $where_update = array(
    //             //             'user_surveior_id' => $post['penggantis1'],
    //             //             'jadwal_kesiapan' => $tanggal3
    //             //         );

    //             //         $dataupdate_jadwal = array(
    //             //             'status' => 1,
    //             //             'pengajuan_usulan_survei_id' => $post['id']
    //             //         );
    //             //         // UPDATE TANGGAL3 SURVEIOR 1
    //             //         $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //             //         // UPDATE TANGGAL3 SURVEIOR 1
    //             //     }
    //             //     // UPDATE JADWAL
    //             // } else {
    //             //     $dataupdate = array(
    //             //         'status' => 1
    //             //     );
    //             //     $whereupdatejadwal = array(
    //             //         'user_surveior_id' => $post['id_surveior_satu'],
    //             //         'pengajuan_usulan_survei_id' => $post['id']
    //             //     );
    //             //     $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $dataupdate);
    //             // }

    //             // if (isset($post['penggantis2'])) {
    //             //     if ($post['keterangan2'] == 7) {
    //             //         $databalik = array(
    //             //             'status' => 0,
    //             //             'pengajuan_usulan_survei_id' => null
    //             //         );
    //             //         $whereupdatejadwal = array(
    //             //             'user_surveior_id' => $post['id_surveior_dua'],
    //             //             'pengajuan_usulan_survei_id' => $post['id']
    //             //         );
    //             //         $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
    //             //     } else {
    //             //         $databalik = array(
    //             //             'status' => $post['keterangan2']
    //             //         );
    //             //         $whereupdatejadwal = array(
    //             //             'user_surveior_id' => $post['id_surveior_dua'],
    //             //             'pengajuan_usulan_survei_id' => $post['id']
    //             //         );
    //             //         $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
    //             //     }

    //             //     $datalapangan['id_surveior_dua_baru'] = $post['penggantis2'];
    //             //     // $datalapangan['keterangan_surveior_dua'] = $post['keterangandua'];
    //             //     $datalapangan['keterangan_surveior_dua_id'] = $post['keterangan2'];
    //             //     // UPDATE JADWAL
    //             //     if (isset($post['tanggal_1'])) {
    //             //         $tanggal1 = $post['tanggal_1'];
    //             //         $where_update = array(
    //             //             'user_surveior_id' => $post['penggantis2'],
    //             //             'jadwal_kesiapan' => $tanggal1
    //             //         );
    //             //         $dataupdate_jadwal = array(
    //             //             'status' => 1,
    //             //             'pengajuan_usulan_survei_id' => $post['id']
    //             //         );

    //             //         // UPDATE TANGGAL1 SURVEIOR 2
    //             //         $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //             //         // UPDATE TANGGAL1 SURVEIOR 2
    //             //     }
    //             //     if (isset($post['tanggal_2'])) {
    //             //         $tanggal2 = $post['tanggal_2'];
    //             //         $where_update = array(
    //             //             'user_surveior_id' => $post['penggantis2'],
    //             //             'jadwal_kesiapan' => $tanggal2
    //             //         );
    //             //         $dataupdate_jadwal = array(
    //             //             'status' => 1,
    //             //             'pengajuan_usulan_survei_id' => $post['id']
    //             //         );

    //             //         // UPDATE TANGGAL2 SURVEIOR 2
    //             //         $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //             //         // UPDATE TANGGAL2 SURVEIOR 2
    //             //     }
    //             //     if (isset($post['tanggal_3'])) {
    //             //         $tanggal3 = $post['tanggal_3'];

    //             //         $where_update = array(
    //             //             'user_surveior_id' => $post['penggantis2'],
    //             //             'jadwal_kesiapan' => $tanggal3
    //             //         );
    //             //         $dataupdate_jadwal = array(
    //             //             'status' => 1,
    //             //             'pengajuan_usulan_survei_id' => $post['id']
    //             //         );

    //             //         // UPDATE TANGGAL3 SURVEIOR 2
    //             //         $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //             //         // UPDATE TANGGAL3 SURVEIOR 2
    //             //     }
    //             //     // UPDATE JADWAL
    //             // } else {
    //             //     $dataupdate = array(
    //             //         'status' => 1
    //             //     );

    //             //     $whereupdatejadwal = array(
    //             //         'user_surveior_id' => $post['id_surveior_dua'],
    //             //         'pengajuan_usulan_survei_id' => $post['id']
    //             //     );
    //             //     $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $dataupdate);
    //             // }
    //             // $this->Model_sina->edit_data('surveior_lapangan', $where_lapangan, $datalapangan);
    //         } else {
    //             if ($post['jabatan'] == 'jabatansurveior1') {
    //                 $jabatan_surveior_id_satu = '1';
    //                 $jabatan_surveior_id_dua = '2';
    //             } else if ($post['jabatan'] == 'jabatansurveior2') {
    //                 $jabatan_surveior_id_satu = '2';
    //                 $jabatan_surveior_id_dua = '1';
    //             }
    //             $datalapangan = array(
    //                 'penetapan_tanggal_survei_id' => $post['penetapan_tanggal_survei_id'],
    //                 'id_surveior_satu_lama' => $post['id_surveior_satu'],
    //                 'id_surveior_dua_lama' => $post['id_surveior_dua'],
    //                 'id_surveior_satu_baru' => $post['id_surveior_satu'],
    //                 'id_surveior_dua_baru' => $post['id_surveior_dua'],
    //                 'jabatan_surveior_id_satu' => $jabatan_surveior_id_satu,
    //                 'jabatan_surveior_id_dua' => $jabatan_surveior_id_dua,
    //                 'no_surattugas' => $post['no_surat_tugas']
    //             );

    //             if (isset($post['penggantis1'])) {
    //                 if ($post['keterangan1'] == 7) {
    //                     $databalik = array(
    //                         'status' => 0,
    //                         'pengajuan_usulan_survei_id' => null
    //                     );
    //                     $whereupdatejadwal = array(
    //                         'user_surveior_id' => $post['id_surveior_satu'],
    //                         'pengajuan_usulan_survei_id' => $post['id']
    //                     );
    //                     $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
    //                 } else {
    //                     $databalik = array(
    //                         'status' => $post['keterangan1']
    //                     );
    //                     $whereupdatejadwal = array(
    //                         'user_surveior_id' => $post['id_surveior_satu'],
    //                         'pengajuan_usulan_survei_id' => $post['id']
    //                     );
    //                     $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
    //                 }

    //                 $datalapangan['id_surveior_satu_baru'] = $post['penggantis1'];
    //                 $datalapangan['keterangan_surveior_satu_id'] = $post['keterangan1'];
    //                 // $datalapangan['keterangan_surveior_satu'] = $post['keterangansatu'];

    //                 // UPDATE JADWAL
    //                 if (isset($post['tanggal_1'])) {
    //                     $tanggal1 = $post['tanggal_1'];
    //                     $where_update = array(
    //                         'user_surveior_id' => $post['penggantis1'],
    //                         'jadwal_kesiapan' => $tanggal1
    //                     );
    //                     $dataupdate_jadwal = array(
    //                         'status' => 1,
    //                         'pengajuan_usulan_survei_id' => $post['id']
    //                     );

    //                     // UPDATE TANGGAL1 SURVEIOR 1
    //                     $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //                     // UPDATE TANGGAL1 SURVEIOR 1
    //                 }
    //                 if (isset($post['tanggal_2'])) {
    //                     $tanggal2 = $post['tanggal_2'];
    //                     $where_update = array(
    //                         'user_surveior_id' => $post['penggantis1'],
    //                         'jadwal_kesiapan' => $tanggal2
    //                     );

    //                     $dataupdate_jadwal = array(
    //                         'status' => 1,
    //                         'pengajuan_usulan_survei_id' => $post['id']
    //                     );
    //                     // UPDATE TANGGAL2 SURVEIOR 1
    //                     $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //                     // UPDATE TANGGAL2 SURVEIOR 1
    //                 }
    //                 if (isset($post['tanggal_3'])) {
    //                     $tanggal3 = $post['tanggal_3'];
    //                     $where_update = array(
    //                         'user_surveior_id' => $post['penggantis1'],
    //                         'jadwal_kesiapan' => $tanggal3
    //                     );

    //                     $dataupdate_jadwal = array(
    //                         'status' => 1,
    //                         'pengajuan_usulan_survei_id' => $post['id']
    //                     );
    //                     // UPDATE TANGGAL3 SURVEIOR 1
    //                     $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //                     // UPDATE TANGGAL3 SURVEIOR 1
    //                 }
    //                 // UPDATE JADWAL
    //             }

    //             if (isset($post['penggantis2'])) {

    //                 if ($post['keterangan2'] == 7) {
    //                     $databalik = array(
    //                         'status' => 0,
    //                         'pengajuan_usulan_survei_id' => null
    //                     );
    //                     $whereupdatejadwal = array(
    //                         'user_surveior_id' => $post['id_surveior_dua'],
    //                         'pengajuan_usulan_survei_id' => $post['id']
    //                     );
    //                     $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
    //                 } else {
    //                     $databalik = array(
    //                         'status' => $post['keterangan2']
    //                     );
    //                     $whereupdatejadwal = array(
    //                         'user_surveior_id' => $post['id_surveior_dua'],
    //                         'pengajuan_usulan_survei_id' => $post['id']
    //                     );
    //                     $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
    //                 }

    //                 $datalapangan['id_surveior_dua_baru'] = $post['penggantis2'];
    //                 $datalapangan['keterangan_surveior_dua_id'] = $post['keterangan2'];
    //                 // UPDATE JADWAL
    //                 if (isset($post['tanggal_1'])) {
    //                     $tanggal1 = $post['tanggal_1'];
    //                     $where_update = array(
    //                         'user_surveior_id' => $post['penggantis2'],
    //                         'jadwal_kesiapan' => $tanggal1
    //                     );
    //                     $dataupdate_jadwal = array(
    //                         'status' => 1,
    //                         'pengajuan_usulan_survei_id' => $post['id']
    //                     );

    //                     // UPDATE TANGGAL1 SURVEIOR 2
    //                     $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //                     // UPDATE TANGGAL1 SURVEIOR 2
    //                 }
    //                 if (isset($post['tanggal_2'])) {
    //                     $tanggal2 = $post['tanggal_2'];
    //                     $where_update = array(
    //                         'user_surveior_id' => $post['penggantis2'],
    //                         'jadwal_kesiapan' => $tanggal2
    //                     );
    //                     $dataupdate_jadwal = array(
    //                         'status' => 1,
    //                         'pengajuan_usulan_survei_id' => $post['id']
    //                     );

    //                     // UPDATE TANGGAL2 SURVEIOR 2
    //                     $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //                     // UPDATE TANGGAL2 SURVEIOR 2
    //                 }
    //                 if (isset($post['tanggal_3'])) {
    //                     $tanggal3 = $post['tanggal_3'];

    //                     $where_update = array(
    //                         'user_surveior_id' => $post['penggantis2'],
    //                         'jadwal_kesiapan' => $tanggal3
    //                     );
    //                     $dataupdate_jadwal = array(
    //                         'status' => 1,
    //                         'pengajuan_usulan_survei_id' => $post['id']
    //                     );

    //                     // UPDATE TANGGAL3 SURVEIOR 2
    //                     $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //                     // UPDATE TANGGAL3 SURVEIOR 2
    //                 }
    //                 // UPDATE JADWAL
    //             }

    //             $this->Model_sina->input_data('surveior_lapangan', $datalapangan);
    //         }

    //         $this->session->set_flashdata('kode_name', 'success');
    //         $this->session->set_flashdata('icon_name', 'check');
    //         $this->session->set_flashdata('message_name', 'Sukses Ubah Data!');
    //         redirect('pengajuan/detail/' . $post['id']);
    //     } else {
    //         $input_penetapan = $this->Model_sina->input_data_lastid('penetapan_tanggal_survei', $datas);
    //         // INSERT SURVEIOR LAPANGAN

    //         if ($post['jabatan'] == 'jabatansurveior1') {
    //             $jabatan_surveior_id_satu = '1';
    //             $jabatan_surveior_id_dua = '2';
    //         } else if ($post['jabatan'] == 'jabatansurveior2') {
    //             $jabatan_surveior_id_satu = '2';
    //             $jabatan_surveior_id_dua = '1';
    //         }

    //         $datalapangan = array(
    //             'penetapan_tanggal_survei_id' => $input_penetapan,
    //             'id_surveior_satu_lama' => $post['id_surveior_satu'],
    //             'id_surveior_dua_lama' => $post['id_surveior_dua'],
    //             'jabatan_surveior_id_satu' => $jabatan_surveior_id_satu,
    //             'id_surveior_satu_baru' => $post['id_surveior_satu'],
    //             'id_surveior_dua_baru' => $post['id_surveior_dua'],
    //             'jabatan_surveior_id_dua' => $jabatan_surveior_id_dua,
    //             'no_surattugas' => $post['no_surat_tugas']
    //         );

    //         if (isset($post['penggantis1'])) {
    //             if ($post['keterangan1'] == 7) {
    //                 $databalik = array(
    //                     'status' => 0,
    //                     'pengajuan_usulan_survei_id' => null
    //                 );
    //                 $whereupdatejadwal = array(
    //                     'user_surveior_id' => $post['id_surveior_satu'],
    //                     'pengajuan_usulan_survei_id' => $post['id']
    //                 );
    //                 $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
    //             } else {
    //                 $databalik = array(
    //                     'status' => $post['keterangan1']
    //                 );
    //                 $whereupdatejadwal = array(
    //                     'user_surveior_id' => $post['id_surveior_satu'],
    //                     'pengajuan_usulan_survei_id' => $post['id']
    //                 );
    //                 $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
    //             }
    //             $datalapangan['id_surveior_satu_baru'] = $post['penggantis1'];
    //             // $datalapangan['keterangan_surveior_satu'] = $post['keterangansatu'];
    //             $datalapangan['keterangan_surveior_satu_id'] = $post['keterangan1'];

    //             // UPDATE JADWAL
    //             if (isset($post['tanggal_1'])) {
    //                 $tanggal1 = $post['tanggal_1'];
    //                 $where_update = array(
    //                     'user_surveior_id' => $post['penggantis1'],
    //                     'jadwal_kesiapan' => $tanggal1
    //                 );
    //                 $dataupdate_jadwal = array(
    //                     'status' => 1,
    //                     'pengajuan_usulan_survei_id' => $post['id']
    //                 );

    //                 // UPDATE TANGGAL1 SURVEIOR 1
    //                 $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //                 // UPDATE TANGGAL1 SURVEIOR 1
    //             }
    //             if (isset($post['tanggal_2'])) {
    //                 $tanggal2 = $post['tanggal_2'];
    //                 $where_update = array(
    //                     'user_surveior_id' => $post['penggantis1'],
    //                     'jadwal_kesiapan' => $tanggal2
    //                 );

    //                 $dataupdate_jadwal = array(
    //                     'status' => 1,
    //                     'pengajuan_usulan_survei_id' => $post['id']
    //                 );
    //                 // UPDATE TANGGAL2 SURVEIOR 1
    //                 $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //                 // UPDATE TANGGAL2 SURVEIOR 1
    //             }
    //             if (isset($post['tanggal_3'])) {
    //                 $tanggal3 = $post['tanggal_3'];
    //                 $where_update = array(
    //                     'user_surveior_id' => $post['penggantis1'],
    //                     'jadwal_kesiapan' => $tanggal3
    //                 );

    //                 $dataupdate_jadwal = array(
    //                     'status' => 1,
    //                     'pengajuan_usulan_survei_id' => $post['id']
    //                 );
    //                 // UPDATE TANGGAL3 SURVEIOR 1
    //                 $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //                 // UPDATE TANGGAL3 SURVEIOR 1
    //             }
    //             // UPDATE JADWAL
    //         } else {
    //             $dataupdate = array(
    //                 'status' => 1
    //             );
    //             $whereupdatejadwal = array(
    //                 'user_surveior_id' => $post['id_surveior_satu'],
    //                 'pengajuan_usulan_survei_id' => $post['id']
    //             );
    //             $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $dataupdate);
    //         }

    //         if (isset($post['penggantis2'])) {
    //             if ($post['keterangan2'] == 7) {
    //                 $databalik = array(
    //                     'status' => 0,
    //                     'pengajuan_usulan_survei_id' => null
    //                 );
    //                 $whereupdatejadwal = array(
    //                     'user_surveior_id' => $post['id_surveior_dua'],
    //                     'pengajuan_usulan_survei_id' => $post['id']
    //                 );
    //                 $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
    //             } else {
    //                 $databalik = array(
    //                     'status' => $post['keterangan2']
    //                 );
    //                 $whereupdatejadwal = array(
    //                     'user_surveior_id' => $post['id_surveior_dua'],
    //                     'pengajuan_usulan_survei_id' => $post['id']
    //                 );
    //                 $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $databalik);
    //             }
    //             $datalapangan['id_surveior_dua_baru'] = $post['penggantis2'];
    //             // $datalapangan['keterangan_surveior_dua'] = $post['keterangandua'];
    //             $datalapangan['keterangan_surveior_dua_id'] = $post['keterangan2'];
    //             // UPDATE JADWAL
    //             if (isset($post['tanggal_1'])) {
    //                 $tanggal1 = $post['tanggal_1'];
    //                 $where_update = array(
    //                     'user_surveior_id' => $post['penggantis2'],
    //                     'jadwal_kesiapan' => $tanggal1
    //                 );
    //                 $dataupdate_jadwal = array(
    //                     'status' => 1,
    //                     'pengajuan_usulan_survei_id' => $post['id']
    //                 );

    //                 // UPDATE TANGGAL1 SURVEIOR 2
    //                 $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //                 // UPDATE TANGGAL1 SURVEIOR 2
    //             }
    //             if (isset($post['tanggal_2'])) {
    //                 $tanggal2 = $post['tanggal_2'];
    //                 $where_update = array(
    //                     'user_surveior_id' => $post['penggantis2'],
    //                     'jadwal_kesiapan' => $tanggal2
    //                 );
    //                 $dataupdate_jadwal = array(
    //                     'status' => 1,
    //                     'pengajuan_usulan_survei_id' => $post['id']
    //                 );

    //                 // UPDATE TANGGAL2 SURVEIOR 2
    //                 $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //                 // UPDATE TANGGAL2 SURVEIOR 2
    //             }
    //             if (isset($post['tanggal_3'])) {
    //                 $tanggal3 = $post['tanggal_3'];

    //                 $where_update = array(
    //                     'user_surveior_id' => $post['penggantis2'],
    //                     'jadwal_kesiapan' => $tanggal3
    //                 );
    //                 $dataupdate_jadwal = array(
    //                     'status' => 1,
    //                     'pengajuan_usulan_survei_id' => $post['id']
    //                 );

    //                 // UPDATE TANGGAL3 SURVEIOR 2
    //                 $this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
    //                 // UPDATE TANGGAL3 SURVEIOR 2
    //             }
    //             // UPDATE JADWAL
    //         } else {
    //             $dataupdate = array(
    //                 'status' => 1
    //             );
    //             $whereupdatejadwal = array(
    //                 'user_surveior_id' => $post['id_surveior_dua'],
    //                 'pengajuan_usulan_survei_id' => $post['id']
    //             );
    //             $this->Model_sina->edit_data('jadwal_surveior', $whereupdatejadwal, $dataupdate);
    //         }

    //         $this->Model_sina->input_data('surveior_lapangan', $datalapangan);
    //         // INSERT SURVEIOR LAPANGAN

    //         $this->session->set_flashdata('kode_name', 'success');
    //         $this->session->set_flashdata('icon_name', 'check');
    //         $this->session->set_flashdata('message_name', 'Sukses Input Data!');
    //         redirect('pengajuan/detail/' . $post['id']);
    //     }
    //     // COMMENT SEMENTARA
    // }

    public function simpanPenetapanVerifikator()
    {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());
        $this->load->library('form_validation');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $datas = array(
                'pengiriman_laporan_survei_id' => $post['pengiriman_laporan_survei_id'],
                'users_id' => $post['users_id']
            );

            if (!empty($post['penetapan_verifikator_id'])) {
                $where = array(
                    'id' => $post['penetapan_verifikator_id']
                );

                $this->Model_sina->edit_data('penetapan_verifikator', $where, $datas);
                $this->session->set_flashdata('kode_name', 'success');
                $this->session->set_flashdata('icon_name', 'check');
                $this->session->set_flashdata('message_name', 'Sukses Ubah Data!');

                redirect('pengajuan/detail/' . $post['id']);
            } else {
                $this->Model_sina->input_data('penetapan_verifikator', $datas);

                $this->session->set_flashdata('kode_name', 'success');
                $this->session->set_flashdata('icon_name', 'check');
                $this->session->set_flashdata('message_name', 'Sukses Input Data!');

                // redirect('pengajuan');
                redirect('pengajuan/detail/' . $post['id']);
            }
        }
    }

    public function hapus()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $id = $this->uri->segment(3);
            $this->Model_sina->delete_pengajuan($id);
            redirect('pengajuan');
        }
    }

    public function surveior()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        $lpa_id = $this->session->userdata('lpa_id');
        if ($this->session->userdata('lpa_id') != TRUE) {
            redirect('login/logout');
        } else {

            $data = array(
                'content' => 'surveior',
                'data' => $this->Model_viewdata->get_data_surveior_jumlah($lpa_id)->result_array(),
                'data_ukom' => $this->Model_viewdata->get_data_ukom_surveior($lpa_id)->result_array(),
                'lpa_id' => $this->session->userdata('lpa_id')
            );
            // if(!empty($lpa_id)){
            $this->load->view('surveior', $data);
            // }else{
            // 	redirect('Login');
            // }
        }
    }

    public function inputsurveiornew()
    {
        $data = array(
            'content',
            'data' => $this->Model_viewdata->get_data_fasyankes()->result_array(),
            'lpa_id' => $this->session->userdata('lpa_id')
        );
        $this->load->view('input_surveior_new', $data);
    }

    public function inputsurveior()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $data = array(
                'content',
                'data' => $this->Model_viewdata->get_data_bidang()->result_array(),
                'datav' => $this->Model_viewdata->get_data_fasyankes()->result_array(),
                // 'lpa_id' => $this->Model_viewdata->get_lpa($this->session->userdata('lpa_id'))->result_array()
                'lpa_id' => $this->session->userdata('lpa_id')
            );
            $this->load->view('input_surveior', $data);
        }
    }

    public function simpanSurveior()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            if ($this->session->userdata('kriteria_id') != 1) {
                $this->session->set_flashdata('kode_name', 'Failed');
                $this->session->set_flashdata('icon_name', 'cross');
                $this->session->set_flashdata('message_name', 'Gagal Input Data, Pilih Salah Satu Bidang!');
                redirect('pengajuan/inputsurveior');
            }
            $post = $this->security->xss_clean($this->input->post());

            if ($this->input->post('keaktifan_surveior') != NULL && $this->input->post('keaktifan_surveior') === 'on') {
                $lpa_id = $this->session->userdata('lpa_id');
                $check = $this->Model_sina->checksertifikatsurveior($post['nik']);
                if (empty($check)) {
                    // $check = $this->Model_sina->checksertifikatukom($post['nik']);
                    $check = $this->Model_sina->checkbidanguser($post['nik'], $lpa_id);
                }

                // Jika hasil check tidak kosong, baru izinkan aktif
                if (!empty($check)) {
                    $keaktifan_surveior = 1;
                } else {
                    $keaktifan_surveior = 0;
                }
            } else {
                $keaktifan_surveior = 0;
            }

            $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
            $pwd = substr(str_shuffle($data), 0, 7);
            $users_id = $this->session->userdata('id');

            $password1 = $pwd;
            $salt      = '1m_@_SaLT_f0R_4kreD!t4$i';
            $hashed    = hash('sha256', $password1 . $salt);

            $datab = array(
                'nik' => $post['nik'],
                'nama' => $post['nama'],
                'email' => $post['email'],
                'username' => $post['email'],
                'password' => $pwd,
                'kriteria_id' => '3',
                'lpa_id' => $this->session->userdata('lpa_id'),
                'user_status' => '1',
                'validate' => '2',
                'password_enkripsi' => $hashed

            );


            if (!empty($post['id'])) {
                $wheres = array(
                    'id' => $post['users_id'],
                );
                $wheref = array(
                    'users_id' => $post['id'],
                );
                $datac = array(
                    'nama' => $post['nama'],
                    'email' => $post['email'],
                    'username' => $post['email']

                );

                $this->Model_sina->edit_data('users', $wheres, $datac);
                $users_id = $this->db->insert_id();
                $datas = array(
                    // 'nik' =>$post['nik'],
                    'nama' => $post['nama'],
                    'email' => $post['email'],
                    'no_hp' => $post['no_hp'],
                    'keaktifan' => $post['keaktifan'],
                    'url_sertifikat_surveior' => $post['url_sertifikat_surveior'],
                    'url_surat_keputusan_keanggotaan' => $post['url_surat_keputusan_keanggotaan'],
                    'status_aktif' => $keaktifan_surveior
                );
                $this->Model_sina->edit_data('user_surveior', $wheref, $datas);

                $uniqfasyankes = [];
                $uniqfasyankes = array_unique($post['fasyankes']);
                $count = 0;
                $query = [];
                foreach ($post['id_bidang'] as $bidangid) {
                    $choose = "";
                    $where = array(
                        'users_id' => $post['users_id'],
                        'id_bidang' => $bidangid
                    );
                    foreach ($uniqfasyankes as $fasyankesid) {
                        // echo $fasyankesid;
                        if (isset($post['fasyankes_id'][$fasyankesid]) && $post['fasyankes_id'][$fasyankesid] == $bidangid) {
                            $choose = 'true';
                        }
                    }
                    if ($choose == true) {
                        $databi = array(
                            'is_checked' => '1'
                        );
                    } else {
                        $databi = array(
                            'is_checked' => '0'
                        );
                        $count++;
                    }

                    $query[] = array(
                        'where' => $where,
                        'data' => $databi
                    );
                }
                if ($count < 10) {
                    foreach ($query as $query) {
                    }
                    $this->session->set_flashdata('kode_name', 'success');
                    $this->session->set_flashdata('icon_name', 'check');
                    $this->session->set_flashdata('message_name', 'Sukses Ubah Data!');
                    redirect('Pengajuan/editsurveior/' . $post['id_user_surveior']);
                } else {
                    $this->session->set_flashdata('kode_name', 'success');
                    $this->session->set_flashdata('icon_name', 'check');
                    $this->session->set_flashdata('message_name', 'Berhasil Simpan Data');

                    redirect('Pengajuan/editsurveior/' . $post['id_user_surveior']);
                }
            } else {
                if (isset($post['fasyankes_id'])) {
                    $this->Model_sina->input_data('users', $datab);
                    $users_id = $this->db->insert_id();
                    $no = 1;
                    $datas = array(
                        'nik' => $post['nik'],
                        'users_id' => $users_id,
                        'nama' => $post['nama'],
                        'email' => $post['email'],
                        'no_hp' => $post['no_hp'],
                        'lpa_id' => $this->session->userdata('lpa_id'),
                        'provinsi_id' => $post['propinsi'],
                        'kabkota_id' => $post['kota'],
                        'keaktifan' => $post['keaktifan'],
                        'fasyankes_id' => $no,
                        'bidang_id'        => $no,
                        'url_sertifikat_surveior' => $post['url_sertifikat_surveior'],
                        'url_surat_keputusan_keanggotaan' => $post['url_surat_keputusan_keanggotaan'],
                        'status_aktif' => $keaktifan_surveior
                    );
                    $this->Model_sina->input_data('user_surveior', $datas);
                    $id_user_surveior = $this->db->insert_id();
                    $fasyankes_id = $this->db->insert_id();
                    $bidang_id = $this->db->insert_id();
                    // SCIRPT INPUT BIDANG ZK
                    $uniqfasyankes = [];
                    $uniqfasyankes = array_unique($post['fasyankes']);
                    $count = 0;
                    $query = [];
                    foreach ($post['id_bidang'] as $bidangid) {
                        $choose = "";
                        $where = array(
                            'id_bidang' => $bidangid
                        );
                        foreach ($uniqfasyankes as $fasyankesid) {
                            if (isset($post['fasyankes_id'][$fasyankesid]) && $post['fasyankes_id'][$fasyankesid] == $bidangid) {
                                $choose = 'true';
                            }
                        }
                        if ($choose == true) {
                            $databi = array(
                                'is_checked' => '1'
                            );
                        } else {
                            $databi = array(
                                'is_checked' => '0'
                            );
                            $count++;
                        }

                        $query[] = array(
                            'id_user_surveior' => $id_user_surveior,
                            'users_id' => $users_id,
                            'id_fasyankes_surveior' => $post['fasyankes'][$bidangid],
                            'id_bidang' => $bidangid,
                            'nama_bidang' => $post['nama_bidang'][$bidangid],
                            'is_checked' => $databi['is_checked']
                        );
                    }
                    if ($count < 10) {
                        foreach ($query as $query) {
                            $this->Model_sina->input_data('user_surveior_bidang_detail', $query);
                        }

                        $this->load->helper('date');
                        date_default_timezone_set("Asia/Jakarta");
                        $data = $this->session->flashdata('datapengguna');

                        $emailpengguna = $post['email'];
                        $namapengguna = $post['nama'];
                        $notelp = $post['no_hp'];

                        $subject = 'Akreditasi Fasyankes ACCOUNT';

                        // Compose a simple HTML email message
                        $message = '<html><body>';
                        $message .= '<h4>Hallo, ' . $namapengguna . '!</h4>';
                        $message .= '<p>Account Surveior Lembaga anda telah di validasi, </p>';
                        $message .= '<p>Silahkan login pada halaman website : sinaf.kemkes.go.id .</p>';
                        $message .= '<p><b>Menggunakan Username : ' . $emailpengguna . '  dan Menggunakan password : ' . $pwd . ' </b></p>';
                        // $message .= '<b style="color:red;">After logging in, please change your password at profile.</b> <br><br>';
                        $message .= '<b>===============================================================</b> <br> <br>';
                        $message .= '<b style="color:blue;">If you need help, please contact the site administrator.</b>';
                        $message .= '</body></html>';


                        $config = [
                            'mailtype' => 'html',
                            'charset' => 'iso-8859-1',
                            'protocol' => 'smtp',
                            // 'smtp_host' => 'ssl://proxy.kemkes.go.id',
                            'smtp_host' => 'ssl://mail.kemkes.go.id',
                            'smtp_user' => 'infoyankes@kemkes.go.id',
                            'smtp_pass' => 'n3nceY@D',
                            'smtp_port' => 465,
                            'smtp_timeout' => 60
                        ];

                        $this->load->library('email', $config);
                        $this->email->initialize($config);

                        $this->email->from('infoyankes@kemkes.go.id');
                        $this->email->to($emailpengguna);
                        $this->email->subject($subject);
                        $this->email->message($message);
                        $this->email->set_newline("\r\n");
                        $send = $this->email->send();
                        if ($send) {
                            // SUCCESS REDIRECT KEMANA ?????
                            $this->session->set_flashdata('kode_name', 'success');
                            $this->session->set_flashdata('icon_name', 'check');
                            $this->session->set_flashdata('message_name', 'Sukses Input Data Surveior!');
                            redirect('pengajuan/surveior');
                        }
                        // SUCCESS REDIRECT KEMANA ?????

                    } else {
                        $this->session->set_flashdata('kode_name', 'Failed');
                        $this->session->set_flashdata('icon_name', 'cross');
                        $this->session->set_flashdata('message_name', 'Gagal Input Data, Pilih Salah Satu Bidang!');
                        redirect('pengajuan/inputsurveior');
                    }
                    // SCRIPT INPUT BIDANG ZK
                } else {
                    $this->session->set_flashdata('kode_name', 'Failed');
                    $this->session->set_flashdata('icon_name', 'cross');
                    $this->session->set_flashdata('message_name', 'Gagal Input Data, Pilih Salah Satu Bidang!');
                    redirect('pengajuan/inputsurveior');
                }
            }
        }
    }

    public function editsurveior()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $id = $this->uri->segment(3);
            $trans = $this->Model_sina->select_surveior_detail($id);
            $trans = array_column($trans, null, "id_bidang");
            $data = array(
                'content' => 'edit_surveior',
                'data' => $this->Model_sina->select_surveior($id),
                // 'datab' => $this->Model_viewdata->get_data_bidang()->result_array(),
                // 'data-sertifikat' => $thiis->Model_sina->get_surveior_sertifikat($id),
                'datab' => $this->Model_viewdata->get_data_bidang_new()->result_array(),
                'datac' => $trans,
                'id' => $id
            );

            $this->load->view('edit_surveior', $data);
        }
    }

    public function hapussurveior()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $id = $this->uri->segment(3);
            $notelp = $this->uri->segment(4);
            // $namapengguna = $this->uri->segment(5);
            //$emailpengguna = $this->uri->segment(5);


            // $rest = $this->Model_sina->delete_surveior($id);
            // if($rest == true){
            //echo $no_telp;
            // WHATSAPP


            // 		$curl = curl_init();

            // 		curl_setopt_array($curl, array(
            // 			CURLOPT_URL => 'http://192.168.48.124:8000/send-message',
            // 			CURLOPT_RETURNTRANSFER => true,
            // 			CURLOPT_ENCODING => '',
            // 			CURLOPT_MAXREDIRS => 10,
            // 			CURLOPT_TIMEOUT => 0,
            // 			CURLOPT_FOLLOWLOCATION => true,
            // 			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            // 			CURLOPT_CUSTOMREQUEST => 'POST',
            // 			// CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo%2C%20' . $namapengguna .
            // 			//     '!%2C%20Account%20Verifikator%20Fasyankes%20anda%20telah%20aktif%2C%20Silahkan%20login%20pada%20halaman%20website%20%3A%20http%3A%2F%2Fperizinan.yankes.kemkes.go.id%2Fsina%2F%20.%20%0AMenggunakan%Username%20%3A%20'. $emailpengguna .'%20Dan%20Menggunakan%20password%20%3A%2012345%20%20%20%20%20%0AIf%20you%20need%20help%2C%20please%20contact%20the%20site%20administrator.',
            // 			CURLOPT_POSTFIELDS => 'sender=sinaf&number=' . $notelp . '&message=Hallo Surveior !.
            // Akun anda telah dihapus. 

            // Apabila membutuhkan bantuan, silahkan hubungi Tim Admin Kemenkes',
            // 			CURLOPT_HTTPHEADER => array(
            // 				'Content-Type: application/x-www-form-urlencoded'
            // 			),
            // 		));

            // 		$response = curl_exec($curl);

            // 		curl_close($curl);
            // 		$res = json_decode($response, true);
            // 		// echo $response;
            // 		if ($res['status'] == TRUE) {
            // 			echo '1';
            $rest = $this->Model_sina->delete_surveior($id);

            if ($rest == TRUE) {
                echo '1';

                redirect('pengajuan/surveior');
            } else {
                echo $rest;
            }
            // } else {
            // 	echo $response;
            // }


            // WHATSAPP


            // } else {
            // 	//show_error($this->email->print_debugger());
            // }

        }
    }

    public function verifikator()
    {
        $lpa_id = $this->session->userdata('lpa_id');
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            if ($this->session->userdata('lpa_id') != TRUE) {
                redirect('login/logout');
            } else {
                $data = array(
                    'content' => 'verifikator',
                    'data' => $this->Model_viewdata->get_data_verifikator($lpa_id)->result_array(),
                    'lpa_id' => $this->session->userdata('lpa_id')
                );
                $response = $this->load->view('verifikator', $data);
                // $this->load->view('verifikator');
            }
        }
    }

    public function inputverifikator()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $this->load->view('input_verifikator');
        }
    }

    public function editverifikator()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $id = $this->uri->segment(3);
            $data = array(
                'content' => 'edit_verifikator',
                'data' => $this->Model_sina->select_verifikator($id),
                'id' => $id
            );
            $this->load->view('edit_verifikator', $data);
        }
    }

    public function simpanVerifikator()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $post = $this->security->xss_clean($this->input->post());
            $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
            $pwd = substr(str_shuffle($data), 0, 7);
            $users_id = $this->session->userdata('id');
            $lpa_id = $this->session->userdata('lpa_id');

            $password1 = $pwd;
            $salt      = '1m_@_SaLT_f0R_4kreD!t4$i';
            $hashed    = hash('sha256', $password1 . $salt);

            $datab = array(
                'nik' => $post['nik'],
                // 'id' => $users_id,
                'nama' => $post['nama'],
                'email' => $post['email'],
                'username' => $post['email'],
                'password' => $pwd,
                'kriteria_id' => '4',
                'validate' => '2',
                'user_status' => '1',
                'lpa_id' => $lpa_id,
                'password_enkripsi' => $hashed
            );
            // $this->Model_sina->input_data('users',$datab);
            // $users_id = $this->db->insert_id();


            // $users_ida = $this->Model_sina->getLastID('users',$users_id);
            // // $datas['users_id'] = $users_id;
            // $this->Model_sina->input_data('user_verifikator',$datas);
            // redirect('pengajuan/verifikator');

            if (!empty($post['id'])) {
                $where = array(
                    'id' => $post['id'],

                );
                $wheres = array(
                    'id' => $post['users_id'],

                );
                $datac = array(
                    'nik' => $post['nik'],
                    'nama' => $post['nama'],
                    'email' => $post['email'],
                    'username' => $post['email']

                );

                $this->Model_sina->edit_data('users', $wheres, $datac);
                $users_id = $this->db->insert_id();
                $datas = array(
                    'nik' => $post['nik'],

                    'nama' => $post['nama'],
                    'email' => $post['email'],
                    'no_hp' => $post['no_hp']
                );
                $this->Model_sina->edit_data('user_verifikator', $where, $datas);

                $this->session->set_flashdata('kode_name', 'success');
                $this->session->set_flashdata('icon_name', 'check');
                $this->session->set_flashdata('message_name', 'Sukses Ubah Data!');

                redirect('pengajuan/verifikator/' . $post['id']);
                // if($response == true){
                // 	redirect(base_url('Mail/useractive'));
                // }else{
                // 	echo $response;
                // }
            } else {
                $this->Model_sina->input_data('users', $datab);
                $users_id = $this->db->insert_id();
                $datas = array(
                    'nik' => $post['nik'],
                    'users_id' => $users_id,
                    'nama' => $post['nama'],
                    'email' => $post['email'],
                    'no_hp' => $post['no_hp']
                );
                $responsed = $this->Model_sina->input_data('user_verifikator', $datas);


                $this->session->set_flashdata('kode_name', 'success');
                $this->session->set_flashdata('icon_name', 'check');
                $this->session->set_flashdata('message_name', 'Sukses Input Data!');

                if ($responsed == true) {
                    $this->load->helper('date');
                    date_default_timezone_set("Asia/Jakarta");
                    $data = $this->session->flashdata('datapengguna');
                    // $namapengguna = $data['nama'];
                    // $emailpengguna = $data['email'];
                    // $notelp = $data['no_telp'];
                    $emailpengguna = $post['email'];
                    $namapengguna = $post['nama'];
                    $notelp = $post['no_hp'];

                    $subject = 'Akreditasi Fasyankes ACCOUNT';

                    // Compose a simple HTML email message
                    $message = '<html><body>';
                    $message .= '<h4>Hallo, ' . $namapengguna . '!</h4>';
                    $message .= '<p>Account Verifikator Lembaga anda telah di validasi, </p>';
                    $message .= '<p>Silahkan login pada halaman website : sinaf.kemkes.go.id .</p>';
                    $message .= '<p><b>Menggunakan Username : ' . $emailpengguna . '  dan Menggunakan password : ' . $pwd . ' </b></p>';
                    // $message .= '<b style="color:red;">After logging in, please change your password at profile.</b> <br><br>';
                    $message .= '<b>===============================================================</b> <br> <br>';
                    $message .= '<b style="color:blue;">If you need help, please contact the site administrator.</b>';
                    $message .= '</body></html>';


                    // $config = [
                    //     'mailtype' => 'html',
                    //     'charset' => 'iso-8859-1',
                    //     'protocol' => 'smtp',
                    //     'smtp_host' => 'ssl://smtp.googlemail.com',
                    //     'smtp_user' => 'testrspmail@gmail.com',
                    //     'smtp_pass' => 'kpvtvwozhlmqsrwx',
                    //     'smtp_port' => 465
                    // ];

                    $config = [
                        'mailtype' => 'html',
                        'charset' => 'iso-8859-1',
                        'protocol' => 'smtp',
                        // 'smtp_host' => 'ssl://proxy.kemkes.go.id',
                        'smtp_host' => 'ssl://mail.kemkes.go.id',
                        'smtp_user' => 'infoyankes@kemkes.go.id',
                        'smtp_pass' => 'n3nceY@D',
                        'smtp_port' => 465,
                        'smtp_timeout' => 60
                    ];

                    $this->load->library('email', $config);
                    $this->email->initialize($config);

                    $this->email->from('infoyankes@kemkes.go.id');
                    $this->email->to($emailpengguna);
                    $this->email->subject($subject);
                    $this->email->message($message);
                    $this->email->set_newline("\r\n");
                    $send = $this->email->send();
                    if ($send) {
                        // echo '1';


                        // WHATSAPP


                        // 					$curl = curl_init();

                        // 					curl_setopt_array($curl, array(
                        // 						CURLOPT_URL => 'http://192.168.48.124:8000/send-message',
                        // 						CURLOPT_RETURNTRANSFER => true,
                        // 						CURLOPT_ENCODING => '',
                        // 						CURLOPT_MAXREDIRS => 10,
                        // 						CURLOPT_TIMEOUT => 0,
                        // 						CURLOPT_FOLLOWLOCATION => true,
                        // 						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        // 						CURLOPT_CUSTOMREQUEST => 'POST',
                        // 						// CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo%2C%20' . $namapengguna .
                        // 						//     '!%2C%20Account%20Verifikator%20Fasyankes%20anda%20telah%20aktif%2C%20Silahkan%20login%20pada%20halaman%20website%20%3A%20http%3A%2F%2Fperizinan.yankes.kemkes.go.id%2Fsina%2F%20.%20%0AMenggunakan%Username%20%3A%20'. $emailpengguna .'%20Dan%20Menggunakan%20password%20%3A%2012345%20%20%20%20%20%0AIf%20you%20need%20help%2C%20please%20contact%20the%20site%20administrator.',
                        // 						CURLOPT_POSTFIELDS => 'sender=sinaf&number=' . $notelp . '&message=Hallo ' . $namapengguna .' !!!

                        // Akun Verifikator anda telah aktif. Silahkan login  aplikasi SINAF sinaf.kemkes.go.id menggunakan :
                        // 	Username : '. $emailpengguna .'
                        // 	password : '. $pwd . '

                        // Apabila membutuhkan bantuan, silahkan hubungi Tim Admin Kemenkes',
                        // 						CURLOPT_HTTPHEADER => array(
                        // 							'Content-Type: application/x-www-form-urlencoded'
                        // 						),
                        // 					));

                        // 					$response = curl_exec($curl);

                        // 					curl_close($curl);
                        // 					$res = json_decode($response, true);
                        // 					// echo $response;
                        // 					if ($res['status'] == TRUE) {
                        // 						echo '1';
                        redirect('pengajuan/verifikator');
                        // 					} else {
                        // 						echo $response;
                        // 					}


                        // WHATSAPP


                    } else {
                        show_error($this->email->print_debugger());
                    }
                } else {
                    echo $response;
                }
                //redirect('pengajuan/verifikator');

            }
        }
    }

    // public function searchbyNIK()
    // {
    //     // if (!$this->input->is_ajax_request()) {
    //     //     exit('No direct script access allowed');
    //     // } else {
    //     //     $nik = $this->input->post('param1');
    //     //     $check = $this->Model_sina->checksertifikatsurveior($nik);
    //     //     echo json_encode($check);
    //     // }
    //     var_dump($_POST);
    // }

    public function hapusverifikator()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $id = $this->uri->segment(3);
            //$id = $this->input->post('id');
            // $this->Model_sina->delete_verifikator($id);
            // redirect('pengajuan/verifikator');
            $notelp = $this->uri->segment(4);
            //$notelp = $this->input->post('no_telp');
            // $namapengguna = $this->uri->segment(5);
            //$emailpengguna = $this->uri->segment(5);


            // $rest = $this->Model_sina->delete_surveior($id);
            // if($rest == true){
            //echo $no_telp;
            // WHATSAPP


            // 		$curl = curl_init();

            // 		curl_setopt_array($curl, array(
            // 			CURLOPT_URL => 'http://192.168.48.124:8000/send-message',
            // 			CURLOPT_RETURNTRANSFER => true,
            // 			CURLOPT_ENCODING => '',
            // 			CURLOPT_MAXREDIRS => 10,
            // 			CURLOPT_TIMEOUT => 0,
            // 			CURLOPT_FOLLOWLOCATION => true,
            // 			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            // 			CURLOPT_CUSTOMREQUEST => 'POST',
            // 			// CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo%2C%20' . $namapengguna .
            // 			//     '!%2C%20Account%20Verifikator%20Fasyankes%20anda%20telah%20aktif%2C%20Silahkan%20login%20pada%20halaman%20website%20%3A%20http%3A%2F%2Fperizinan.yankes.kemkes.go.id%2Fsina%2F%20.%20%0AMenggunakan%Username%20%3A%20'. $emailpengguna .'%20Dan%20Menggunakan%20password%20%3A%2012345%20%20%20%20%20%0AIf%20you%20need%20help%2C%20please%20contact%20the%20site%20administrator.',
            // 			CURLOPT_POSTFIELDS => 'sender=sinaf&number=' . $notelp . '&message=Hallo Verifikator !.
            // Akun anda telah dihapus. 

            // Apabila membutuhkan bantuan, silahkan hubungi Tim Admin Kemenkes',
            // 			CURLOPT_HTTPHEADER => array(
            // 				'Content-Type: application/x-www-form-urlencoded'
            // 			),
            // 		));

            // 		$response = curl_exec($curl);

            // 		curl_close($curl);
            // 		$res = json_decode($response, true);
            // 		// echo $response;
            // 		if ($res['status'] == TRUE) {
            // 			echo '1';
            $rest = $this->Model_sina->delete_verifikator($id);

            if ($rest == TRUE) {
                echo '1';

                redirect('pengajuan/verifikator');
            } else {
                echo $rest;
            }
            // } else {
            // 	//alert('Nomor anda tidak valid');
            // 	$message = "Nomor anda tidak valid";
            // 	echo "<script type='text/javascript'>alert('$message');</script>";
            // 	die(redirect('pengajuan/verifikator', 'refresh'));
            // 	//echo $response;
            // }
        }
    }

    public function userketualpa()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $data = array(
                'content' => 'user_ketua_lpa',
                'data' => $this->Model_viewdata->get_data_pengajuan(1)->result_array()
            );
            $this->load->view('user_ketua_lpa', $data);
        }
    }

    public function userkemenkes()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $data = array(
                'content' => 'user_kemenkes',
                'data' => $this->Model_viewdata->get_data_pengajuan(1)->result_array()
            );
            $this->load->view('user_kemenkes', $data);
        }
    }

    public function dropdown5($id = null, $filters = '')
    {
        //if ($this->input->is_ajax_request()) {
        //$this->load->model('helpdesksubprojectmodel');
        $filters .= "id_prop = '" . urldecode($id) . "' ";
        $order = " nama_kota ASC";

        $rsData = $this->Model_sina->get_kab_kota_by_prop($filters, $order); //exit(show_last_query());
        echo json_encode($rsData);
        //}
        return;
    }

    function detailsurveior()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            // load table library
            $this->load->library('table');

            // set heading
            $this->table->set_heading('#', 'First Name', 'Last Name', 'Email-ID', 'Credits');

            // set template
            $style = array('table_open'  => '<table class="table table-striped table-hover">');
            $this->table->set_template($style);

            echo $this->table->generate($this->db->get('user_surveior'));
        }
    }

    public function checkemail($email)
    {
        // echo $email;
        $decodeemail = urldecode($email);
        // $checkemail = $this->input->post('email_user');
        $check = $this->Model_sina->checkmail($decodeemail);
        echo $check;
    }

    public function checknikverifikator($nik)
    {
        // echo $email;
        $decodeemail = urldecode($nik);
        // $checkemail = $this->input->post('email_user');
        $check = $this->Model_sina->checknikverifikator($decodeemail);
        echo $check;
    }

    public function checkniksurveior($nik)
    {
        // echo $email;
        $decodeemail = urldecode($nik);
        // $checkemail = $this->input->post('email_user');
        $check = $this->Model_sina->checkniksurveior($decodeemail);
        echo $check;
    }

    // public function checknik($nik)
    // {
    //     // echo $email;
    //     $decodeemail = urldecode($nik);
    //     // $checkemail = $this->input->post('email_user');
    //     $check = $this->Model_sina->checknik($decodeemail);
    //     echo $check;
    // }

    public function getIkp()
    {
        $getdata = $this->input->get();

        $kode_faskes = $getdata['kode_faskes'];
        $tahun = $getdata['tahun'];

        $checkData = $this->Model_sina->getIkp($kode_faskes, $tahun);

        if (!isset($kode_faskes) || !isset($tahun)) {
            echo json_encode([]);
            exit;
        }

        if (!empty($checkData)) {
            echo json_encode($checkData);
        } else {
            echo json_encode([]);
            exit;
        }
    }

    public function getInm()
    {
        $getdata = $this->input->get();

        $kode_faskes = $getdata['kode_faskes'];
        $tahun = $getdata['tahun'];

        $checkData = $this->Model_sina->getInm($kode_faskes, $tahun);

        // print_r($kode_faskes);

        if (!isset($kode_faskes) || !isset($tahun)) {
            echo json_encode([]);
            exit;
        }

        if (!empty($checkData)) {
            echo json_encode($checkData);
        } else {
            echo json_encode([]);
            exit;
        }
    }

    public function getAspakId()
    {
        $code = null;
        $getdata = $this->input->get();
        if (!isset($getdata['code'])) {
            echo json_encode([]);
            exit;
        }
        $code = $getdata['code'];

        $url = "http://dwh-aspak.kemkes.go.id/aspakresume/checkfaskes?code={$code}";
        $jsonResponse = $this->restHandler('GET', $url, false, false, false, true);
        $response = json_decode($jsonResponse);

        echo json_encode($response);
    }

    public function getAspak()
    {
        $getdata = $this->input->get();


        $kode_faskes = $getdata['kode_faskes'];
        // $kode_integrasi = $getdata['kode_integrasi'];

        // $checkData = $this->Model_sina->getAspak($kode_faskes, $kode_integrasi);
        $checkData = $this->Model_sina->getAspak($kode_faskes);

        // if (!isset($kode_faskes) || !isset($kode_integrasi)) {
        //     echo json_encode([]);
        //     exit;
        // }

        if (!isset($kode_faskes)) {
            echo json_encode([]);
            exit;
        }

        if (!empty($checkData)) {
            echo json_encode($checkData);
        } else {
            echo json_encode([]);
            exit;
        }
    }

    public function getAspakResume()
    {
        $getdata = $this->input->get();

        if (!isset($getdata['id']) || !isset($getdata['action']) || !isset($getdata['user_id'])) {
            echo json_encode([]);
            exit;
        }

        $id = $getdata['id'];
        $action = $getdata['action'];
        $data = $this->Model_sina->select_pengajuan($getdata['user_id']);

        if ($data[0]['jenis_fasyankes'] == 2) {
            $jenis = 'pkm';
        } else if ($data[0]['jenis_fasyankes'] == 6) {
            $jenis = 'transfusi';
        } else if ($data[0]['jenis_fasyankes'] == 7) {
            $jenis = 'labkes';
        }

        $url = "http://dwh-aspak.kemkes.go.id/aspakresume/{$jenis}/{$action}?id={$id}";
        $jsonResponse = $this->restHandler('GET', $url, false, false, false, true);
        $response = json_decode($jsonResponse);

        echo json_encode($response);
    }

    public function getSisdmk()
    {
        $getdata = $this->input->get();
        $kode_faskes = $getdata['kode_faskes'];

        if (!isset($kode_faskes)) {
            echo json_encode([]);
            exit;
        }

        $checkData = $this->Model_sina->getSisdmk($kode_faskes);

        if (!empty($checkData)) {
            echo json_encode($checkData);
        } else {
            echo json_encode([]);
            exit;
        }
    }

    private function fasyankesMapper()
    {
        $getdata = $this->input->get();
        $jenisFasyankesMapper = [
            'Tempat Praktik Mandiri Nakes' => null,
            'Pusat Kesehatan Masyarakat' => 'puskes',
            'Klinik' => 'klinik',
            'Unit Transfusi Darah' => 'utd',
            'Laboratorium Kesehatan' => 'lab',
        ];
        $fasyankesName = null;

        if (!isset($getdata['id']) || !isset($getdata['nama'])) {
            echo json_encode([]);
            exit;
        }

        foreach ($jenisFasyankesMapper as $fasyankes => $label) {
            if ($fasyankes == $getdata['nama'] && $label !== null) {
                $fasyankesName = $label;
            }
        }

        if (!$fasyankesName) {
            echo json_encode([]);
            exit;
        }

        return $fasyankesName;
    }

    private function parseToMonth($month)
    {
        switch ($month) {
            case 1:
                return 'Januari';
                break;
            case 2:
                return 'Februari';
                break;
            case 3:
                return 'Maret';
                break;
            case 4:
                return 'April';
                break;
            case 5:
                return 'Mei';
                break;
            case 6:
                return 'Juni';
                break;
            case 7:
                return 'Juli';
                break;
            case 8:
                return 'Agustus';
                break;
            case 9:
                return 'September';
                break;
            case 10:
                return 'Oktober';
                break;
            case 11:
                return 'November';
                break;
            case 12:
                return 'Desember';
                break;
        }
    }

    private function restHandler($method, $url, $data = false, $contentType = false, $withHeaders = false, $withToken = false)
    {
        $curl = curl_init();

        if ($withHeaders) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'X-Id: mutukemenkes',
                'X-Pass: rsonline!@#$',
                'X-Timestamp: ' . strtotime(date('Y-m-d H:i:s')) . '',
            ]);
        }

        if ($withToken) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer 3SgM1bCljMgYtXq8ofM1yCeBodFgf16-EY8ts_VScehYsNlZA4k9wP1pgDKTv2TyZd6Ce3SZxsul8E21jzjAw8LhEosTeLPdv386_1674791351',
            ]);
        }

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data) {
                    if ($contentType) {
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                            'Content-Type: ' . $contentType
                        ));
                    }
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0);

        // enable this if need to debugging
        // curl_setopt($curl, CURLOPT_VERBOSE, true);

        // $streamVerboseHandle = fopen('php://temp', 'w+');
        // curl_setopt($curl, CURLOPT_STDERR, $streamVerboseHandle);

        $result = curl_exec($curl);

        // if ($result === FALSE) {
        //     printf("cUrl error (#%d): %s<br>\n",
        //            curl_errno($curl),
        //            htmlspecialchars(curl_error($curl)))
        //            ;
        // }

        // rewind($streamVerboseHandle);
        // $verboseLog = stream_get_contents($streamVerboseHandle);

        // echo "cUrl verbose information:\n", 
        //      "<pre>", htmlspecialchars($verboseLog), "</pre>\n";

        curl_close($curl);

        return $result;
    }

    public function getdatauser()
    {
        $check = $this->Model_sina->getuser();
        // var_dump($check);
        foreach ($check as $value) {
            //  echo $value['id'];
            //  echo $value['nama'];
            //  echo $value['email'];
            $this->load->helper('date');
            date_default_timezone_set("Asia/Jakarta");
            // $data = $this->session->flashdata('datapengguna');

            $emailpengguna = $value['email'];
            $namapengguna = $value['nama'];
            // $notelp = $post['no_hp'];
            $pwd = $value['password'];
            $subject = 'Akreditasi Fasyankes ACCOUNT';

            // Compose a simple HTML email message
            $message = '<html><body>';
            $message .= '<h4>Hallo, ' . $namapengguna . '!</h4>';
            $message .= '<p>Account Surveior Lembaga anda telah di validasi, </p>';
            $message .= '<p>Silahkan login pada halaman website : sinaf.kemkes.go.id .</p>';
            $message .= '<p><b>Menggunakan Username : ' . $emailpengguna . '  dan Menggunakan password : ' . $pwd . ' </b></p>';
            // $message .= '<b style="color:red;">After logging in, please change your password at profile.</b> <br><br>';
            $message .= '<b>===============================================================</b> <br> <br>';
            $message .= '<b style="color:blue;">If you need help, please contact the site administrator.</b>';
            $message .= '</body></html>';


            $config = [
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://mail.kemkes.go.id',
                // 'smtp_host' => 'ssl://proxy.kemkes.go.id',
                'smtp_user' => 'infoyankes@kemkes.go.id',
                'smtp_pass' => 'n3nceY@D',
                'smtp_port' => 465,
                'smtp_timeout' => 60
            ];

            $this->load->library('email', $config);
            $this->email->initialize($config);

            $this->email->from('infoyankes@kemkes.go.id');
            $this->email->to($emailpengguna);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->set_newline("\r\n");
            $send = $this->email->send();
            // var_dump($data['email']);
            if ($send) {
                $wheres = array(
                    'id' => $value['id'],
                );
                $datac = array(
                    'lastlogin' => 1
                );
                $this->Model_sina->edit_data('users_email', $wheres, $datac);
                echo "succeess";
            } else {
                show_error($this->email->print_debugger());
            }
        }
    }

    public function checksertifikatsurveior()
    {
        // if (!$this->input->is_ajax_request()) {
        //     exit('No direct script access allowed');
        //     // show_404();
        // }
        if ($this->session->userdata('kriteria_id') != 1) {
            // Langsung balikan array kosong kalau bukan kriteria 1
            echo json_encode([]);
            return; // pastikan fungsi berhenti di sini
        }

        $nik = $this->input->post('param1');

        // Cek dari sumber pertama
        $check = $this->Model_sina->checksertifikatsurveior($nik);

        // Jika kosong, cek sumber kedua
        if (empty($check)) {
            // $check = $this->Model_sina->checksertifikatukom($nik);


            $lpa_id = $this->session->userdata('lpa_id');
            $check = $this->Model_sina->checkbidanguser($nik, $lpa_id);
            // print_r($check);

            // Jika hasil sumber kedua ada, tambahkan keterangan sertifikat
            if (!empty($check)) {
                // Jika $check hanya 1 record (array asosiatif)
                if (isset($check[0]) && is_array($check[0])) {
                    // Tambahkan ke setiap record (kalau hasil berupa banyak data)
                    foreach ($check as &$row) {
                        // $row['no_sertifikat'] = 'Lulus Ukom untuk Faskes RS';
                        $row['no_sertifikat'] = '-';
                    }
                } else {
                    // Kalau hasil hanya satu array (bukan array of array)
                    // $check['no_sertifikat'] = 'Lulus Ukom untuk Faskes RS';
                    $check['no_sertifikat'] = '-';
                }
            }
        }

        // Keluarkan hasil sebagai JSON
        echo json_encode($check);
    }

    // public function checkbidang()
    // {
    //     if (!$this->input->is_ajax_request()) {
    //         exit('No direct script access allowed');
    //         // show_404();
    //     } else {
    //         $nik = $this->input->post('param1');
    //         $lpa = $this->input->post('param2');
    //         $user = $this->input->post('param3');
    //         // $bidang = $this->input->post('param4');
    //         // $faskes = $this->input->post('param5');

    //         $getbidang = $this->Model_sina->checkuserbidang($user);

    //         foreach ($getbidang as $value) {
    //             $nik = $value['nik'];
    //             $lpa = $value['lpa_id'];
    //             $user = $value['id'];
    //             $check = $this->Model_sina->checkbidang($nik, $lpa);
    //             $data = array();
    //             $tgl = array();

    //             if (!empty($check)) {
    //                 foreach ($check as $value) {
    //                     array_push($data, $user);
    //                     array_push($tgl, $value['tgl_berakhir_ukom']);
    //                 }

    //                 $this->Model_sina->updateUkom($data, $tgl);
    //             } else {
    //                 foreach ($getbidang as $value) {
    //                     array_push($data, $user);
    //                 }

    //                 $this->Model_sina->updateUkomSalah($data);
    //             }
    //         }
    //     }

    //     echo json_encode(1); // Atau status apa pun yang kamu perlukan
    //     return;



    //     // echo json_encode($check);

    //     // $data = array();
    //     // $tgl = array();

    //     // if(!empty($check)){
    //     //     foreach ($check as $value) {
    //     //         // $data[] = [
    //     //         //     'id' => $value['id']
    //     //         // ];
    //     //         // $tgl[] = [
    //     //         //     'tgl_berlaku_sertifikat' => $value['tgl_berakhir_ukom']
    //     //         // ];

    //     //         array_push($data, $value['id']);
    //     //         array_push($tgl, $value['tgl_berakhir_ukom']);
    //     //     }

    //     //     $update = $this->Model_sina->updateUkom($data, $tgl);
    //     // }else{
    //     //     foreach ($check as $value) {
    //     //         // $data[] = [
    //     //         //     'id' => $value['id']
    //     //         // ];
    //     //         // $tgl[] = [
    //     //         //     'tgl_berlaku_sertifikat' => $value['tgl_berakhir_ukom']
    //     //         // ];

    //     //         array_push($data, $value['id']);
    //     //         array_push($tgl, $value['tgl_berakhir_ukom']);
    //     //     }

    //     //     $update = $this->Model_sina->updateUkomSalah($data, $tgl);
    //     // }

    //     // print_r($update);


    //     // }
    // }

    public function checkbidang()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $nik  = $this->input->post('param1');
        $lpa  = $this->input->post('param2');
        $user = $this->input->post('param3');

        $getbidang = $this->Model_sina->checkuserbidang($user);

        foreach ($getbidang as $value) {
            $nik  = $value['nik'];
            $lpa  = $value['lpa_id'];
            $idbidang = $value['id'];

            $check = $this->Model_sina->checkbidang($nik, $lpa, $idbidang);

            $data = [];
            $tgl  = [];

            if (!empty($check)) {
                foreach ($check as $val) {
                    $data[] = $val['id'];
                    $tgl[]  = $val['tgl_berakhir_ukom'];
                }
                $this->Model_sina->updateUkom($data, $tgl);
                // exit;
            } else {
                // foreach ($getbidang as $val) {
                $data[] = $idbidang;
                // }
                // print_r($data);
                $this->Model_sina->updateUkomSalah($data);
                // exit;
            }
        }

        // Kirim response JSON dengan content-type
        ob_clean();

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['status' => true, 'message' => 'Update berhasil']));
    }


    public function penolakanpengajuan()
    {
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $session_kriteria = $this->session->userdata('kriteria_id');
            // $session_users_id = $this->session->userdata('user_id');

            if ($session_kriteria == 1) {
                $session_lpa = $this->session->userdata('lpa_id');
                $data = array(
                    'data' => $this->Model_monitoring->getdataPenolakanPengajuan($session_lpa),
                );
                $this->load->view('penolakanpengajuan', $data);
            } else if ($session_kriteria == 8) {
                $session_lpa = 'all';
                $data = array(
                    'data' => $this->Model_monitoring->getdataPenolakanPengajuan($session_lpa),
                );
                // print_r($data);
                $this->load->view('penolakanpengajuan', $data);
            }
        }
    }
    public function detailpenolakanpengajuan($idpembatalan)
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $session_kriteria = $this->session->userdata('kriteria_id');
            $session_lpa = $this->session->userdata('lpa_id');
            if ($session_kriteria == 1) {
                $datapembatalan = $this->Model_monitoring->detailpenolakanpengajuan($idpembatalan, $session_lpa);
                if (!empty($datapembatalan)) {
                    $id = $datapembatalan[0]['pengajuan_usulan_survei_id'];
                    $pengajuan = $this->Model_sina->select_pengajuan($id);
                    $detail_pengajuan = $this->Model_sina->detail_pengajuan_survei($id);
                    $data = array(
                        'pembatalan' => $datapembatalan,
                        'data' => $pengajuan,
                        'detail_pengajuan' => $detail_pengajuan
                    );
                    $this->load->view('penolakan_usulan_survei', $data);
                    // print_r($datapembatalan);
                } else {
                    $this->session->set_flashdata('kode_name', 'danger');
                    $this->session->set_flashdata('message_name', 'Terjadi Kesalahan Silahkan Menghubungi Admin !.');
                    redirect('Pengajuan/penolakanpengajuan');
                }

                // $surveior = $this->Model_sina->select_surveior_kesepakatan($id);
                // $pengajuan_lama = $this->Model_sina->select_pengajuan($pengajuan[0]['pengajuan_usulan_survei_id_lama']);
                // $puskesmas = $this->Model_sina->get_puskesmas($pengajuan[0]['fasyankes_id']);
                // $surveior_lapangan = $this->Model_sina->getdatalapangan($pengajuan[0]['penetapan_tanggal_survei_id']);
                // $narahubung = $this->Model_sina->getDataNarahubung($pengajuan[0]['fasyankes_id']);
                // if (isset($surveior_lapangan[0]['id_surveior_satu_baru'])) {
                //     $idsuveiorpengganti1 = $surveior_lapangan[0]['id_surveior_satu_baru'];
                //     $keterangnapengganti1 = $surveior_lapangan[0]['keterangan_surveior_satu'];
                //     $surveior_lapangan['datasurveiorpengganti1'] = $this->Model_sina->getdetailsuveior($idsuveiorpengganti1);
                // }

                // if (isset($surveior_lapangan[0]['id_surveior_dua_baru'])) {
                //     $idsuveiorpengganti2 = $surveior_lapangan[0]['id_surveior_dua_baru'];
                //     $keterangnapengganti2 = $surveior_lapangan[0]['keterangan_surveior_dua'];
                //     $surveior_lapangan['datasurveiorpengganti2'] = $this->Model_sina->getdetailsuveior($idsuveiorpengganti2);
                // }
                // $datasurveiorlapangan = $this->Model_sina->getsurveiorlapangan($pengajuan[0]['penetapan_tanggal_survei_id']);

                // $data = array(
                //     'content' => 'pengajuan_usulan_survei',
                //     'data' => $pengajuan,
                //     'data_lama' => $pengajuan_lama,
                //     'puskesmas' => $puskesmas,
                //     'lpa_id' => $session_lpa,
                //     'surveior' => $surveior,
                //     'detail_pengajuan' => $detail_pengajuan,
                //     'id' => $id,
                //     'surveior_lapangan' => $surveior_lapangan,
                //     'narahubung' => $narahubung,
                //     'data_surveior_lapangan' => $datasurveiorlapangan
                // );
            } else if ($session_kriteria == 8) {
                $datapembatalan = $this->Model_monitoring->detailpenolakanPengajuankatim($idpembatalan);
                if (!empty($datapembatalan)) {
                    $id = $datapembatalan[0]['pengajuan_usulan_survei_id'];
                    $pengajuan = $this->Model_sina->select_pengajuan($id);
                    $detail_pengajuan = $this->Model_sina->detail_pengajuan_survei($id);
                    $data = array(
                        'pembatalan' => $datapembatalan,
                        'data' => $pengajuan,
                        'detail_pengajuan' => $detail_pengajuan
                    );
                    $this->load->view('penolakan_usulan_survei', $data);
                } else {
                    $this->session->set_flashdata('kode_name', 'danger');
                    $this->session->set_flashdata('message_name', 'Terjadi Kesalahan Silahkan Menghubungi Admin !.');
                    redirect('Pengajuan/penolakanpengajuan');
                }
            }
        }
    }

    public function simpanBerkasKesepakatan()
    {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());
        // $config['upload_path']          = 'assets/uploads/berkas_akreditasi/';
        // $config['allowed_types']        = 'pdf|xls|xlsx';
        // $config['max_size']             = 2048;
        // $config['max_width']            = 1080;
        // $config['max_height']           = 1080;
        // $config['overwrite']            = true;
        // $config['encrypt_name']         = TRUE;

        // UPLOAD DOKUMEN KONTRAK
        // if (!empty($_FILES['url_dokumen_kontrak']['name'])) {
        //     $this->load->library('upload', $config);
        //     if (!$this->upload->do_upload('url_dokumen_kontrak')) {
        //         print_r($this->upload->display_errors());
        //         exit;
        //     }

        //     $attachment = $this->upload->data();
        //     $fileName = $attachment['file_name'];
        //     $url_dokumen_kontrak =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
        // } else {
        //     if (isset($post['old_url_dokumen_kontrak'])) {
        //         $url_dokumen_kontrak = $post['old_url_dokumen_kontrak'];
        //     } else {
        //         $url_dokumen_kontrak = '';
        //     }
        // }
        // UPLOAD DOKUMEN KONTRAK

        $datas = array(
            'kelengkapan_berkas_id' => $post['kelengkapan_berkas_id'],
            'url_dokumen_kontrak' => $post['url_dokumen_kontrak'],
            'url_dokumen_pendukung_ep' => $post['url_dokumen_pendukung_ep']
        );

        if (!empty($post['penetapan_tanggal_survei_id'])) {
            // UPDATE DATA PENETAPAN
            $where = array('id' => $post['penetapan_tanggal_survei_id']);
            $input = $this->Model_sina->updatePTS('penetapan_tanggal_survei', $where, $datas);
            if ($input == '1') {
                $this->session->set_flashdata('kode_name', 'success');
                $this->session->set_flashdata('icon_name', 'check');
                $this->session->set_flashdata('message_name', 'Sukses Input Data!');
                redirect('pengajuan/detail/' . $post['id']);
            } else {
                $this->session->set_flashdata('kode_name', 'danger');
                $this->session->set_flashdata('icon_name', 'check');
                $this->session->set_flashdata('message_name', 'Input Data Gagal!' . $input);
                redirect('pengajuan/detail/' . $post['id']);
            }
        } else {
            $input_penetapan = $this->Model_sina->inputPTS('penetapan_tanggal_survei', $datas);
            if ($input_penetapan == '1') {
                $this->session->set_flashdata('kode_name', 'success');
                $this->session->set_flashdata('icon_name', 'check');
                $this->session->set_flashdata('message_name', 'Sukses Input Data!');
                redirect('pengajuan/detail/' . $post['id']);
            } else {
                $this->session->set_flashdata('kode_name', 'danger');
                $this->session->set_flashdata('icon_name', 'check');
                $this->session->set_flashdata('message_name', 'Input Data Gagal!');
                redirect('pengajuan/detail/' . $post['id']);
            }
        }
    }

    public function simpanSurveiorLapangan()
    {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());

        // DATA SURVEIOR LAPANGAN
        $idpengajuan = $post['id'];
        if ($post['jabatan'] == 'jabatansurveior1') {
            $jabatan_surveior_id_satu = '1';
            $jabatan_surveior_id_dua = '2';
        } else if ($post['jabatan'] == 'jabatansurveior2') {
            $jabatan_surveior_id_satu = '2';
            $jabatan_surveior_id_dua = '1';
        }

        $jadwal = array();
        $tanggal = array();
        $usersurveior = array();
        $jadwal_pengganti = array();
        $jadwal_penggant_baru = array();

        if (isset($post['tanggal_1'])) {
            array_push($tanggal, $post['tanggal_1']);
        }
        if (isset($post['tanggal_2'])) {
            array_push($tanggal, $post['tanggal_2']);
        }
        if (isset($post['tanggal_3'])) {
            array_push($tanggal, $post['tanggal_3']);
        }

        array_push($usersurveior, $post['id_surveior_satu']);
        array_push($usersurveior, $post['id_surveior_dua']);

        $surveior_lapangan = array(
            'penetapan_tanggal_survei_id' => $post['PTSID'],
            'id_surveior_satu_lama' => $post['id_surveior_satu'],
            'id_surveior_dua_lama' => $post['id_surveior_dua'],
            'id_surveior_satu_baru' => $post['id_surveior_satu'],
            'id_surveior_dua_baru' => $post['id_surveior_dua'],
            'jabatan_surveior_id_satu' => $jabatan_surveior_id_satu,
            'jabatan_surveior_id_dua' => $jabatan_surveior_id_dua,
            'no_surattugas' => $post['no_surat_tugas'],
            'status_tte' => '0'
        );

        $jadwal['pengajuan_usulan_survei_id'] = $idpengajuan;
        $jadwal['jadwal_kesiapan'] = $tanggal;
        $jadwal['user_surveior_id'] = $usersurveior;
        $jadwal['status'][0] = '1';
        $jadwal['status'][1] = '1';

        if (isset($post['penggantis1'])) {
            $surveior_lapangan['id_surveior_satu_baru'] = $post['penggantis1'];
            $surveior_lapangan['keterangan_surveior_satu_id'] = $post['keterangan1'];
            $jadwal_pengganti['jadwal_kesiapan'] = $tanggal;
            $jadwal_pengganti['user_surveior_id'][0] = $post['penggantis1'];
            $jadwal_pengganti['status'][0] = '1';
            // $jadwal['status'][0] = $post['keterangan1'];
            if ($post['keterangan1'] == 7) {
                $jadwal['status'][0] = 0;
            } else {
                $jadwal['status'][0] = $post['keterangan1'];
            }

            foreach ($tanggal as $key => $value) {
                $jadwal_penggant_baru[0][$key] = array(
                    "jadwal_kesiapan" => $value,
                    "user_surveior_id" => $post['penggantis1'],
                    "status" => 1
                );
            }
        }
        if (isset($post['penggantis2'])) {
            $surveior_lapangan['id_surveior_dua_baru'] = $post['penggantis2'];
            $surveior_lapangan['keterangan_surveior_dua_id'] = $post['keterangan2'];
            $jadwal_pengganti['jadwal_kesiapan'] = $tanggal;
            $jadwal_pengganti['user_surveior_id'][1] = $post['penggantis2'];
            $jadwal_pengganti['status'][1] = '1';
            // $jadwal['status'][1] = $post['keterangan2'];
            if ($post['keterangan1'] == 7) {
                $jadwal['status'][1] = 0;
            } else {
                $jadwal['status'][1] = $post['keterangan2'];
            }

            foreach ($tanggal as $key => $value) {
                $jadwal_penggant_baru[1][$key] = array(
                    "jadwal_kesiapan" => $value,
                    "user_surveior_id" => $post['penggantis2'],
                    "status" => 1
                );
            }
        }

        $input = $this->Model_sina->inputSurveiorLapanganpengganti($surveior_lapangan, $jadwal, $jadwal_penggant_baru);
        if ($input == '1') {
            $this->session->set_flashdata('kode_name', 'success');
            $this->session->set_flashdata('icon_name', 'check');
            $this->session->set_flashdata('message_name', 'Sukses Input Data!');
            redirect('pengajuan/detail/' . $post['id']);
        } else {
            $this->session->set_flashdata('kode_name', 'danger');
            $this->session->set_flashdata('icon_name', 'check');
            $this->session->set_flashdata('message_name', 'Input Data Gagal!');
            redirect('pengajuan/detail/' . $post['id']);
        }
    }

    public function updateSurveiorLapangan()
    {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());
        // DATA SURVEIOR LAPANGAN
        $idpengajuan = $post['id'];
        $surveior_lapangan_id = $post['SLID'];
        if ($post['jabatan'] == 'jabatansurveior1') {
            $jabatan_surveior_id_satu = '1';
            $jabatan_surveior_id_dua = '2';
        } else if ($post['jabatan'] == 'jabatansurveior2') {
            $jabatan_surveior_id_satu = '2';
            $jabatan_surveior_id_dua = '1';
        }

        $jadwal = array();
        $tanggal = array();
        $usersurveior = array();
        $jadwal_pengganti = array();
        $jadwal_penggant_baru = array();

        if (isset($post['tanggal_1'])) {
            array_push($tanggal, $post['tanggal_1']);
        }
        if (isset($post['tanggal_2'])) {
            array_push($tanggal, $post['tanggal_2']);
        }
        if (isset($post['tanggal_3'])) {
            array_push($tanggal, $post['tanggal_3']);
        }

        array_push($usersurveior, $post['id_surveior_satu']);
        array_push($usersurveior, $post['id_surveior_dua']);

        $where = array(
            'id' => $surveior_lapangan_id
        );

        $surveior_lapangan = array(
            'penetapan_tanggal_survei_id' => $post['PTSID'],
            'id_surveior_satu_lama' => $post['id_surveior_satu'],
            'id_surveior_dua_lama' => $post['id_surveior_dua'],
            'jabatan_surveior_id_satu' => $jabatan_surveior_id_satu,
            'jabatan_surveior_id_dua' => $jabatan_surveior_id_dua,
            'no_surattugas' => $post['no_surat_tugas'],
            'status_tte' => '0'
        );

        if (isset($post['surveior_satu_baru_id'])) {
            $surveior_lapangan['id_surveior_satu_baru'] = $post['surveior_satu_baru_id'];
        }

        if (isset($post['surveior_dua_baru_id'])) {
            $surveior_lapangan['id_surveior_dua_baru'] = $post['surveior_dua_baru_id'];
        }

        $jadwal['pengajuan_usulan_survei_id'] = $idpengajuan;
        $jadwal['jadwal_kesiapan'] = $tanggal;
        $jadwal['user_surveior_id'] = $usersurveior;
        $jadwal['status'][0] = '1';
        $jadwal['status'][1] = '1';

        if (isset($post['penggantis1'])) {
            $surveior_lapangan['id_surveior_satu_baru'] = $post['penggantis1'];
            $surveior_lapangan['keterangan_surveior_satu_id'] = $post['keterangan1'];
            $jadwal_pengganti['jadwal_kesiapan'] = $tanggal;
            $jadwal_pengganti['user_surveior_id'][0] = $post['penggantis1'];
            $jadwal_pengganti['status'][0] = '1';
            $jadwal['status'][0] = $post['keterangan1'];

            foreach ($tanggal as $key => $value) {
                $jadwal_penggant_baru[0][$key] = array(
                    "jadwal_kesiapan" => $value,
                    "user_surveior_id" => $post['penggantis1'],
                    "status" => 1
                );
            }
        }
        if (isset($post['penggantis2'])) {
            $surveior_lapangan['id_surveior_dua_baru'] = $post['penggantis2'];
            $surveior_lapangan['keterangan_surveior_dua_id'] = $post['keterangan2'];
            $jadwal_pengganti['jadwal_kesiapan'] = $tanggal;
            $jadwal_pengganti['user_surveior_id'][1] = $post['penggantis2'];
            $jadwal_pengganti['status'][1] = '1';
            $jadwal['status'][1] = $post['keterangan2'];

            foreach ($tanggal as $key => $value) {
                $jadwal_penggant_baru[1][$key] = array(
                    "jadwal_kesiapan" => $value,
                    "user_surveior_id" => $post['penggantis2'],
                    "status" => 1
                );
            }
        }

        print_r($jadwal);
    }
}
