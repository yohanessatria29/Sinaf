<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');

class AkreditasiRS extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('Model_sina');
        $this->load->model('Model_viewdata');
        $this->load->model('Model_akreditasi_RS');
        define('MB', 1048576);

        if ($this->session->userdata('access') != 'Admin Lembaga') {
            redirect('Pengajuan');
        };
    }

    public function index()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $session_lpa = $this->session->userdata('lpa_id');
            $session_kriteria = $this->session->userdata('kriteria_id');
            $session_users_id = $this->session->userdata('user_id');
            $post = $this->input->post();
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

            // if (!empty($post['propinsi'])) {
            //     $propinsi = $post['propinsi'];
            // } else {
            //     $propinsi = null;
            // }

            // if (!empty($post['kota'])) {
            //     $kota = $post['kota'];
            // } else {
            //     $kota = null;
            // }

            if (!empty($post['jenis_fasyankes'])) {
                $jenis_fasyankes = $post['jenis_fasyankes'];
            } else {
                $jenis_fasyankes = 4;
            }

            if (!empty($post['status_usulan_id'])) {
                $status_usulan_id = $post['status_usulan_id'];
            } else {
                $status_usulan_id = '';
            }

            $data = array(
                'data' => $this->Model_akreditasi_RS->Pengajuan_search($session_lpa, $tanggal_awal, $tanggal_akhir, $jenis_fasyankes, $status_usulan_id),
                'session_lpa' => $session_lpa,
                // 'propinsi' => $propinsi,
                // 'kota' => $kota,
                'status_usulan_id' => $status_usulan_id,
                'jenis_fasyankes' => $this->Model_viewdata->get_data_fasyankes_admin($session_users_id)->result_array(),
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' => $tanggal_akhir
            );

            // print_r($data);

            $this->load->view('view_list_akreditasi_rs', $data);
        }
    }


    public function inputakreditasiRS()
    {
        $this->load->view('input_akreditasi_rs');
    }

    public function searchRS($koders)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api-yankes.kemkes.go.id/faskes/login',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
			"userName": "kotakelektronik@gmail.com",
			"password": "p5fuNGds"
		}',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec(($curl));
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);


            if ($status_code == 201) {
                $bearerToken = json_decode($response, true);

                $curl2 = curl_init();
                curl_setopt_array($curl2, array(
                    CURLOPT_URL => 'https://api-yankes.kemkes.go.id/faskes/rumahsakit/' . $koders,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer ' . $bearerToken['data']['access_token']
                    ),
                ));

                $response2 = curl_exec($curl2);

                $status_code = curl_getinfo($curl2, CURLINFO_HTTP_CODE);
                curl_close($curl2);
                $data = json_decode($response2, true);
                if ($data['data'] === null) {
                    // echo 0;
                    echo json_encode($data);
                } else {
                    echo json_encode($data);
                }
            } else {
                $this->session->set_flashdata('kode_name', 'alert alert-danger alert-dismissible');
                $this->session->set_flashdata('icon_name', 'danger');
                $this->session->set_flashdata('message_name', 'Terjadi Kesalahan pada API!');
                $this->session->set_flashdata('Error_name', 'Akun Admin');
                return 404;
            }
        }
    }


    public function SimpanAkreditasiRS()
    {

        $this->load->library('form_validation');
        $this->load->helper('security');
        if ($this->session->userdata('logged') != TRUE) {
            redirect('login/logout');
        } else {
            $koders = $this->input->post('kodeRS');
            $jenis_fasyankes = $this->input->post('jenis_fasyankes');
            $metode_survei_rs_id = $this->input->post('metode_survei');
            $tanggal_1 = $this->input->post('tgl_survei_1');
            $tanggal_2 = $this->input->post('tgl_survei_2');
            $tanggal_3 = $this->input->post('tgl_survei_3');
            $tanggal_4 = $this->input->post('tgl_survei_4');
            $narahubung = $this->input->post('narahubung');
            $no_hp_narahubung = $this->input->post('no_hp_narahubung');
            $surveior_id_pertama = $this->input->post('surveior_pertama');
            $surveior_pertama_jabatan = $this->input->post('jabatan_surveior_pertama');
            $surveior_id_kedua = $this->input->post('surveior_kedua');
            $surveior_kedua_jabatan = $this->input->post('jabatan_surveior_kedua');
            $no_surtug = $this->input->post('no_surtug');
            $session_lpa = $this->session->userdata('lpa_id');

            $data_input = array(
                'kode_rs' => $koders,
                'jenis_fasyankes_id' => $jenis_fasyankes,
                'metode_survei_rs_id' => $metode_survei_rs_id,
                'lpa_id' => $session_lpa,
                'tanggal_survei_1' => $tanggal_1,
                'tanggal_survei_2' => $tanggal_2,
                'tanggal_survei_3' => $tanggal_3,
                'tanggal_survei_4' => $tanggal_4,
                'narahubung_rs' => $narahubung,
                'no_hp_narahubung' => $no_hp_narahubung,
                'surveior_id_satu' => $surveior_id_pertama,
                'jabatan_surveior_satu' => $surveior_pertama_jabatan,
                'surveior_id_dua' => $surveior_id_kedua,
                'jabatan_surveior_dua' => $surveior_kedua_jabatan,
                'no_surat_tugas' => $no_surtug,
                'status_tte' => 0
            );

            $input =   $this->Model_sina->input_data('surtug_rs', $data_input);

            if ($input['code'] === 0) {
                $this->session->set_flashdata('kode_name', 'success');
                $this->session->set_flashdata('icon_name', 'check');
                $this->session->set_flashdata('message_name', 'Sukses Input Data!');

                redirect('AkreditasiRS');
            } else {
                $this->session->set_flashdata('kode_name', 'danger');
                $this->session->set_flashdata('icon_name', 'warning');
                $this->session->set_flashdata('message_name', 'Gagal Input Data!');

                redirect('AkreditasiRS/inputakreditasiRS');
            }
        }
    }
}
