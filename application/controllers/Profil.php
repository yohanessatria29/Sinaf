<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_profile');
        // $this->load->model('Model_viewdata');
        if ($this->session->userdata('logged') != TRUE) {
            $url = base_url('login');
            redirect($url);
        };
    }

    public function index()
    {
        $id = $this->session->userdata();
        // echo json_encode($id['id']);
        $data = array(
            'content' => 'view-profil',
            'datauser' => $this->Model_profile->Profile_view($id['id']),
            'databidang' => $this->Model_profile->Surv_bidang_view($id['user_id']),
            'dataverif' => $this->Model_profile->Verifikator_view($id['user_id']),
            'dataketualpa' => $this->Model_profile->Ketualpa_view($id['user_id']),
            'dataadminlpa' => $this->Model_profile->Adminlpa_view($id['user_id']),
            'dataotheruser' => $this->Model_profile->Other_view($id['user_id']),
            'dataadmkemenkes' => $this->Model_profile->AdminKemenkes_view($id['user_id']),


        );

        if ($this->session->userdata('kriteria_id') == 3) {
            if ($data['datauser'][0]->{'status_aktif'} == 1) {
                $this->session->set_flashdata('Status_Aktif', 1);
            } else {
                $this->session->set_flashdata('Status_Aktif', 0);
            }

            if ($data['datauser'][0]->{'sertifikat_surveior'} == NULL) {
                $this->session->set_flashdata('Status_Sertifikat', 0);
            } else if ($data['datauser'][0]->{'sertifikat_surveior'} != NULL) {
                $this->session->set_flashdata('Status_Sertifikat', 1);
            }
        }

        $this->load->view('view_profil', $data);
    }
    public function update_profil()
    {

        // $config['upload_path']          = 'assets/uploads/berkas_akreditasi/';
        // $config['allowed_types']        = 'pdf|xls|xlsx';
        // $config['max_size']             = 2048;
        // $config['max_width']            = 1080;
        // $config['max_height']           = 1080;
        // $config['overwrite']            = true;
        // $config['encrypt_name'] = TRUE;

        // $post = $this->input->post();
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->post());

        $id = $this->session->userdata();
        $surveior = $this->Model_profile->Profile_view($id['user_id']);
        $verifikator = $this->Model_profile->Verifikator_view($id['user_id']);
        $ketualpa = $this->Model_profile->Ketualpa_view($id['user_id']);
        $adminlpa = $this->Model_profile->Adminlpa_view($id['user_id']);
        $adminkemenkes = $this->Model_profile->AdminKemenkes_view($id['user_id']);




        // if (!empty($_FILES['dokumen_sk']['name'])) {
        //     $this->load->library('upload', $config);
        //     if (!$this->upload->do_upload('dokumen_sk')) {
        //         print_r($this->upload->display_errors());
        //         exit;
        //     }
        //     $attachment = $this->upload->data();
        //     $fileName = $attachment['file_name'];

        //     //$dokumen_sk =  $url.$fileName;
        //     $dokumen_sk =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
        // } else {
        //     if (isset($post['old_dokumen_sk'])) {
        //         $dokumen_sk = $post['old_dokumen_sk'];
        //     } else {
        //         $dokumen_sk = '';
        //     }
        // }

        $nama_baru = $this->input->post('nama_baru');
        $nohpbaru = $this->input->post('nohpbaru');
        $dokumen_sk = $this->input->post('dokumen_sk');




        if ($id['kriteria_id'] == 3) {
            $nama_lama = $surveior['nama'];
            $nohplama = $surveior['nohp'];
            $this->Model_profile->Update_nama_nohp_surv($nama_baru, $nohpbaru);
            $this->Model_profile->Update_nama_users($nama_baru);
            $this->Model_profile->Trans_upd_profil($nama_baru, $nama_lama, $nohpbaru, $nohplama);
        } else if ($id['kriteria_id'] == 4) {
            $nama_lama = $verifikator[0]->nama;
            $nohplama = $verifikator[0]->nohp;
            $this->Model_profile->Update_nama_users($nama_baru, $nohpbaru);
            $this->Model_profile->Update_nama_nohp_verif($nama_baru, $nohpbaru);
            $this->Model_profile->Trans_upd_profil($nama_baru, $nama_lama, $nohpbaru, $nohplama);
        } else if ($id['kriteria_id'] == 1) {
            $cek = $this->Model_profile->update_users($nama_baru);
            $cek2 = $this->Model_profile->update_profile_adminlpa($nama_baru, $nohpbaru, $dokumen_sk);
        } else if ($id['kriteria_id'] == 5) {
            $this->Model_profile->update_users($nama_baru);
            $this->Model_profile->update_profile_ketualpa($nama_baru, $nohpbaru, $dokumen_sk);
        } else if ($id['kriteria_id'] == 2) {
            $unit_kerja = $this->input->post('unit_kerja');
            $jabatan = $this->input->post('jabatan');
            $this->Model_profile->update_users($nama_baru);
            $this->Model_profile->update_profile_adminkemenkes($nama_baru, $nohpbaru, $unit_kerja, $jabatan, $dokumen_sk);
        } else {
            $this->Model_profile->Update_nama_users($nama_baru);
            $this->Model_profile->Trans_upd_profil($nama_baru, $nama_lama, $nohpbaru, $nohplama);
        }
        echo $this->session->set_flashdata('msg', '<div class="alert alert-success"> Update Profil Berhasil</div>');

        // echo $dokumen_sk;
        redirect('profil');
    }

    public function update_pass()
    {
        $id = $this->session->userdata();
        $pass = $this->input->post('password');
        $old = $this->Model_profile->getpw($id['user_id']);
        $confirm = $this->input->post('confirmpass');
        $oldpass = $this->input->post('oldpass');


        // $password1 = $pwd;
        $salt      = '1m_@_SaLT_f0R_4kreD!t4$i';
        $hashed    = hash('sha256', $oldpass . $salt);


        $id = $this->session->userdata();

        // $sql=$this->db->query("SELECT password from users where id=$id['user_id']")->result();

        $uppercase = preg_match('@[A-Z]@', $pass);
        $lowercase = preg_match('@[a-z]@', $pass);
        $number    = preg_match('@[0-9]@', $pass);
        $specialChars = preg_match('@[^\w]@', $pass);

        echo $old[0]['password_enkripsi'];
        // var_dump($hashed);

        if ($old[0]['password_enkripsi'] != $hashed) {
            echo $this->session->set_flashdata('msg', '<div class="alert alert-danger">Ubah Password Gagal. Password Lama Salah.</div>');
        } else if ($pass != $confirm) {
            echo $this->session->set_flashdata('msg', '<div class="alert alert-danger">Ubah Password Gagal. Password Baru dan Konfirmasi Password Tidak Sama.</div>');
        } else if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
            echo $this->session->set_flashdata('msg', '<div class="alert alert-danger">Ubah Password Gagal. Pasword setidaknya harus 8 karakter dan harus memiliki huruf besar, huruf kecil, angka, dan spesial karakter (!@#$%^&*()) .</div>');
        } else {
            $hashed_new = hash('sha256', $confirm . $salt);
            $this->Model_profile->update_password($hashed_new);
            $this->session->set_flashdata('kode_name', 'success');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Pasword Berhasil Diubah. </div>');
        }
        redirect('profil');
    }

    public function uploadsertifikat()
    {
        // $config['upload_path']          = 'assets/uploads/berkas_akreditasi/';
        // $config['allowed_types']        = 'pdf';
        // $config['max_size']             = 2048;
        // $config['max_width']            = 1080;
        // $config['max_height']           = 1080;
        // $config['overwrite']            = true;
        // $config['encrypt_name']         = TRUE;
        // $this->load->library('upload', $config);
        // if (!$this->upload->do_upload('file')) {
        //     print_r($this->upload->display_errors());
        //     exit;
        // } else {
        //     $attachment = $this->upload->data();
        //     $fileName = $attachment['file_name'];
        $user_id = $this->session->userdata('user_id');
        $url = $this->input->post('sertifikat_surveior');
        $data = array(
            'nama_sertifikat' => $url
        );
        $where = array(
            'users_id' => $user_id
        );
        $result = $this->Model_profile->edit_sertifikat('user_surveior', $where, $data);
        if ($result) {
            $this->session->set_flashdata('kode_name', 'success');
            $this->session->set_flashdata('icon_name', 'check');
            $this->session->set_flashdata('message_name', 'Sukses Input Data!');
        } else {
            $this->session->set_flashdata('kode_name', 'danger');
            $this->session->set_flashdata('icon_name', 'check');
            $this->session->set_flashdata('message_name', 'Input Data Gagal!');
        }

        redirect('Profil');
        // }
    }
}
