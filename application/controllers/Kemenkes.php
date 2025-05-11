<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kemenkes extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('Model_sina');
        $this->load->model('Model_viewdata');
        $this->load->model('Model_kemenkes');
        define('MB', 1048576);
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
            if ($session_kriteria == 2) {
                $session_lpa = $this->session->userdata('lpa_id');
                $post = $this->security->xss_clean($this->input->post());
                $tanggal_awal = !empty($post['tanggal_awal']) ? $post['tanggal_awal'] : null;
                $tanggal_akhir = !empty($post['tanggal_akhir']) ? $post['tanggal_akhir'] : null;
                $propinsi = !empty($post['propinsi']) ? $post['propinsi'] : null;
                $kota = !empty($post['kota']) ? $post['kota'] : null;
                $jenis_fasyankes = !empty($post['jenis_fasyankes']) ? $post['jenis_fasyankes'] : null;
                $lpa_id = !empty($post['lpa_id']) ? $post['lpa_id'] : null;
                $status_verifikasi_id = !empty($post['status_verifikasi_id']) ? $post['status_verifikasi_id'] : null;

                $data = array(
                    'content' => 'user_kemenkes',
                    'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
                    // 'data' => $this->Model_kemenkes->select_pengajuan_search($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes, $status_verifikasi_id),
                    'session_lpa' => $session_lpa,
                    'propinsi' => $propinsi,
                    'kota' => $kota,
                    'jenis_fasyankes' => $jenis_fasyankes,
                    'tanggal_awal' => $tanggal_awal,
                    'tanggal_akhir' => $tanggal_akhir,
                    'lpa_id' => $lpa_id,
                    'status_verifikasi_id' => $status_verifikasi_id

                );

                print_r($data);
                // $this->load->view('user_kemenkes', $data);
            }
        }
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

        $data_kemenkes = $this->Model_sina->select_kemenkes($id);
        $data_kemenkes_detail = $this->Model_sina->select_kemenkes_detail($id);

        $data_select_kemenkes = $this->Model_sina->select_kemenkes($id);

        $trans = $this->Model_sina->select_trans_ep($data_select_kemenkes[0]['penetapan_tanggal_survei_id']);

        $trans = array_column($trans, null, "elemen_penilaian_id");


        $data = array(
            'content' => 'elemen_penilaian_surveior',
            'data' => $data_select_kemenkes,
            'data_detail' => $data_kemenkes_detail,
            'datab' => $this->Model_sina->select_ep($bab, $data_kemenkes[0]['jenis_fasyankes']),
            'trans' => $trans,
            'count_trans' => $this->Model_sina->select_count_trans_ep($data_select_kemenkes[0]['penetapan_tanggal_survei_id'], $data_kemenkes[0]['jenis_fasyankes']),
            'bab' => $bab,
            // 'datab'=> $this->Model_sina->select_ep($bab,6),
            //'datab'=> $this->Model_sina->select_ep(1,2),
            'data_sertifikat' => $this->Model_sina->getDataSertifikat($data_kemenkes[0]['fasyankes_id']),
            'ds' => $this->Model_sina->viwDataSertifikat($id),
            'id' => $id
        );
        $this->load->view('pengirimanlaporan_kemenkes', $data);
        // print_r($data_kemenkes);
        // var_dump($data_select_kemenkes[0]);
        // var_dump($data_kemenkes[0]['jenis_fasyankes']);
    }

    public function detail()
    {
        // $id = $this->uri->segment(3);
        // $data = array(
        // 	'content' => 'sertifikat',
        // 	'data' => $this->Model_sina->select_kemenkes($id),
        // 	'id' => $id
        // );
        // $this->load->view('sertifikat', $data);

        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $session_kriteria = $this->session->userdata('kriteria_id');
            $session_lpa = $this->session->userdata('lpa_id');
            if ($session_kriteria == 2) {
                $id = $this->uri->segment(3);
                $kemenkes = $this->Model_sina->select_kemenkes($id);
                $puskesmas = $this->Model_sina->get_puskesmas($kemenkes[0]['fasyankes_id']);
                $data = array(
                    'content' => 'sertifikat',
                    'data' => $kemenkes,
                    'puskesmas' => $puskesmas,
                    'lpa_id' => $session_lpa,
                    'id' => $id
                );
                // $this->load->view('ketualpa/detail', $data);
                $this->load->view('sertifikat', $data);
            }
        }
    }

    public function simpanPenerbitan()
    {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());

        // $config['upload_path']          = 'assets/uploads/berkas_akreditasi/';
        // $config['allowed_types']        = 'pdf|jpg|jpeg|png';
        // $config['max_size']             = 2048;
        // $config['max_width']            = 1080;
        // $config['max_height']           = 1080;
        // $config['overwrite']            = true;
        // $config['encrypt_name'] = TRUE;

        //$url = 'https://sirs.kemkes.go.id/fo/sisrute_dok/';

        //Upload foto_bukti_survei
        // if (!empty($_FILES['url_dokumen_sertifikat']['name'])) {
        //     $this->load->library('upload', $config);
        //     if (!$this->upload->do_upload('url_dokumen_sertifikat')) {
        //         print_r($this->upload->display_errors());
        //         exit;
        //     }
        //     $attachment = $this->upload->data();
        //     $fileName = $attachment['file_name'];

        //     //$foto_bukti_survei =  $url.$fileName;
        //     $url_dokumen_sertifikat =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
        // } else {
        //     if (isset($post['old_url_dokumen_sertifikat'])) {
        //         $url_dokumen_sertifikat = $post['old_url_dokumen_sertifikat'];
        //     } else {
        //         $url_dokumen_sertifikat = '';
        //     }
        // }

        $datas = array(

            'nomor_sertifikat' => $post['nomor_sertifikat'],
            'tanggal_penetapan' => $post['tanggal_penetapan'],
            'tanggal_berakhir_berlaku' => $post['tanggal_berakhir_berlaku'],
            'url_dokumen_sertifikat' => $post['url_dokumen_sertifikat'],
            'pengiriman_rekomendasi_id' => $post['pengiriman_rekomendasi_id']
        );

        $where2 = array(
            'pengiriman_rekomendasi_id' => $post["pengiriman_rekomendasi_id"]
        );
        $this->Model_sina->delete_data('penerbitan_sertifikat', $where2);

        $this->Model_sina->input_data('penerbitan_sertifikat', $datas);

        $this->session->set_flashdata('kode_name', 'success');
        $this->session->set_flashdata('icon_name', 'check');
        $this->session->set_flashdata('message_name', 'Sukses Input Data!');

        redirect('kemenkes/detail/' . $post['id_kemenkes']);
    }

    public function surveior()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        // $lpa_id = $this->session->userdata('lpa_id');
        if ($this->session->userdata('lpa_id') != TRUE) {
            redirect('login/logout');
        } else {
            $post = $this->security->xss_clean($this->input->post());

            if ($post != NULL) {
                $propinsi = !empty($post['propinsi']) ? $post['propinsi'] : null;
                $kota = !empty($post['kota']) ? $post['kota'] : null;
                $lpa_id = !empty($post['lpa_id']) ? $post['lpa_id'] : null;
                $keaktifan = !empty($post['status']) ? $post['status'] : null;
                $data = array(
                    'content' => 'surveior',
                    'data' => $this->Model_kemenkes->select_surveior_search($lpa_id, $propinsi, $kota, $keaktifan),
                    'data_ukom' => $this->Model_kemenkes->get_data_ukom_surveior($lpa_id),
                    'propinsi' => $propinsi,
                    'kota' => $kota,
                    'lpa_id' => $lpa_id,
                    'keaktifan' => $keaktifan
                );
            } else {
                $data = array(
                    'content' => 'surveior',
                    'data' => [],
                    'data_ukom' => [],
                    'propinsi' => NULL,
                    'kota' => NULL,
                    'lpa_id' => NULL,
                    'keaktifan' => NULL
                );
            }

            //print_r($data);
            $this->load->view('kemkes_view_surveior', $data);
        }
    }

    public function simpanSurveior()
    {
        // var_dump($this->input->post());

        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $post = $this->security->xss_clean($this->input->post());
            if ($this->input->post('keaktifan_surveior') != NULL && $this->input->post('keaktifan_surveior') === 'on') {
                $keaktifan_surveior = 1;
            } else {
                $keaktifan_surveior = 0;
            }
            $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
            $pwd = substr(str_shuffle($data), 0, 7);
            $users_id = $this->session->userdata('id');
            // $config['upload_path']          = 'assets/uploads/berkas_akreditasi/';
            // $config['allowed_types']        = 'pdf|xls|xlsx';
            // $config['max_size']             = 2048;
            // $config['max_width']            = 1080;
            // $config['max_height']           = 1080;
            // $config['overwrite']            = true;
            // $config['encrypt_name'] = TRUE;

            $password1 = $pwd;
            $salt      = '1m_@_SaLT_f0R_4kreD!t4$i';
            $hashed    = hash('sha256', $password1 . $salt);

            //$url = 'https://sirs.kemkes.go.id/fo/sisrute_dok/';

            //Upload url_sertifikat_surveior
            // if (!empty($_FILES['url_sertifikat_surveior']['name'])) {
            //     $this->load->library('upload', $config);
            //     if (!$this->upload->do_upload('url_sertifikat_surveior')) {
            //         print_r($this->upload->display_errors());
            //         exit;
            //     }
            //     $attachment = $this->upload->data();
            //     $fileName = $attachment['file_name'];

            //     //$url_sertifikat_surveior =  $url.$fileName;
            //     $url_sertifikat_surveior =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
            // } else {
            //     if (isset($post['old_url_sertifikat_surveior'])) {
            //         $url_sertifikat_surveior = $post['old_url_sertifikat_surveior'];
            //     } else {
            //         $url_sertifikat_surveior = '';
            //     }
            // }

            //Upload url_surat_keputusan_keanggotaan
            // if (!empty($_FILES['url_surat_keputusan_keanggotaan']['name'])) {
            //     $this->load->library('upload', $config);
            //     if (!$this->upload->do_upload('url_surat_keputusan_keanggotaan')) {
            //         print_r($this->upload->display_errors());
            //         exit;
            //     }
            //     $attachment = $this->upload->data();
            //     $fileName = $attachment['file_name'];

            //     //$url_dokumen_kontrak =  $url.$fileName;
            //     $url_surat_keputusan_keanggotaan =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
            // } else {
            //     if (isset($post['old_url_surat_keputusan_keanggotaan'])) {
            //         $url_surat_keputusan_keanggotaan = $post['old_url_surat_keputusan_keanggotaan'];
            //     } else {
            //         $url_surat_keputusan_keanggotaan = '';
            //     }
            // }
            $datab = array(
                'nik' => $post['nik'],
                // 'id' => $users_id,
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
                // var_dump($this->input->post());
                $wheres = array(
                    'id' => $post['users_id'],
                );
                $wheref = array(
                    'users_id' => $post['id'],
                );
                $datac = array(
                    // 'nik' =>$post['nik'],
                    'nama' => $post['nama'],
                    'email' => $post['email'],
                    'username' => $post['email']

                );

                // $this->Model_sina->edit_data('users', $wheres, $datac);
                $users_id = $this->db->insert_id();
                $datas = array(
                    // 'nik' =>$post['nik'],
                    'nama' => $post['nama'],
                    'email' => $post['email'],
                    'no_hp' => $post['no_hp'],
                    // 'provinsi_id' => $post['propinsi'],
                    // 'kabkota_id' => $post['kota'],
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

                if ($count < 15) {
                    foreach ($query as $query) {
                        $this->Model_sina->edit_data('user_surveior_bidang_detail', $query['where'], $query['data']);
                        // var_dump($test);
                    }
                    $this->session->set_flashdata('kode_name', 'success');
                    $this->session->set_flashdata('icon_name', 'check');
                    $this->session->set_flashdata('message_name', 'Sukses Ubah Data!');
                    redirect('kemenkes/editsurveior/' . $post['id_user_surveior']);
                } else {
                    $this->session->set_flashdata('kode_name', 'Failed');
                    $this->session->set_flashdata('icon_name', 'cross');
                    $this->session->set_flashdata('message_name', 'Gagal Ubah Data, Silakan Hubungi Admin!');
                    // $this->session->set_flashdata('message_name', 'Berhasil Simpan Data');

                    redirect('kemenkes/editsurveior/' . $post['id_user_surveior']);
                }
            } else {
                if (isset($post['fasyankes_id'])) {
                    // $this->Model_sina->input_data('users', $datab);
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

                    //$users_ida = $this->Model_sina->getLastID('users',$users_id);
                    // $datas['users_id'] = $users_id;
                    // $message2 = "Sudah benar 2";
                    // 	echo "<script type='text/javascript'>alert('$message2');</script>";
                    // $this->Model_sina->input_data('user_surveior', $datas);
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
                            // 'users_id' => $post['users_id'],
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

                        // $query[] = array(
                        // 	'where' => $where,
                        // 	'data' => $databi
                        // );
                        $query[] = array(
                            'id_user_surveior' => $id_user_surveior,
                            'users_id' => $users_id,
                            'id_fasyankes_surveior' => $post['fasyankes'][$bidangid],
                            'id_bidang' => $bidangid,
                            'nama_bidang' => $post['nama_bidang'][$bidangid],
                            'is_checked' => $databi['is_checked']
                        );
                    }
                    if ($count < 15) {
                        foreach ($query as $query) {
                            // $this->Model_sina->edit_data('user_surveior_bidang_detail', $query['where'], $query['data']);
                            // var_dump($query);
                            // $testquery = $this->Model_sina->input_data('user_surveior_bidang_detail', $query);
                            // var_dump($testquery);
                            // $this->Model_sina->input_data('user_surveior_bidang_detail', $query);
                        }
                        // SUCCESS REDIRECT KEMANA ?????
                        $this->session->set_flashdata('kode_name', 'success');
                        $this->session->set_flashdata('icon_name', 'check');
                        $this->session->set_flashdata('message_name', 'Sukses Input Data Surveior!');
                        redirect('kemenkes/surveior');
                    }
                    // SCRIPT INPUT BIDANG ZK
                } else {
                    $this->session->set_flashdata('kode_name', 'Failed');
                    $this->session->set_flashdata('icon_name', 'cross');
                    $this->session->set_flashdata('message_name', 'Gagal Input Data, Pilih Salah Satu Bidang!');
                    redirect('kemenkes/inputsurveior');
                }
                if ($send) {
                }
            }
        }
    }

    public function editsurveior()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        $session_kriteria = $this->session->userdata('kriteria_id');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $id = $this->uri->segment(3);
            $trans = $this->Model_sina->select_surveior_detail($id);
            $trans = array_column($trans, null, "id_bidang");
            $data = array(
                'content' => 'kemkes_edit_surveior',
                'data' => $this->Model_sina->select_surveior($id),
                // 'datab' => $this->Model_viewdata->get_data_bidang()->result_array(),
                // 'data-sertifikat' => $thiis->Model_sina->get_surveior_sertifikat($id),
                'datab' => $this->Model_viewdata->get_data_bidang_new()->result_array(),
                'datac' => $trans,
                'id' => $id
            );
            // var_dump($data['data']);
            $this->load->view('kemkes_edit_surveior', $data);
        }
    }
    public function simpanSurveiorBidang()
    {
        // var_dump($this->input->post());

        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            print_r($this->input->post());
        }
    }
}
