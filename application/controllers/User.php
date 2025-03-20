<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_profile');
        $this->load->model('Model_user');
        $this->load->model('Model_sina');
        // $this->load->model('Model_viewdata');
        if ($this->session->userdata('logged') != TRUE) {
            $url = base_url('login');
            redirect($url);
        };
    }

    public function index()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');

        $id = $this->session->userdata();
        // echo json_encode($id['id']);
        $data = array(
            'content' => 'view-profil',
            'datauser' => $this->Model_profile->Profile_view($id['id']),
            'dataadminlpa' => $this->Model_user->get_admin_lpa(),
            'dataketualpa' => $this->Model_user->get_ketua_lpa(),
            'datalpa' => $this->Model_user->get_list_lpa(),
            'dataotheruser' => $this->Model_profile->Other_view($id['user_id']),
        );
        // echo json_encode($data['datauser']); exit;
        $this->load->view('ketualpa', $data);

        // $this->load->view('view_profil');

        // echo $this->session->userdata('name');
    }

    public function listAdminlpa()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');

        $id = $this->session->userdata();
        // echo json_encode($id['id']);
        $data = array(
            'content' => 'view-profil',
            'datauser' => $this->Model_profile->Profile_view($id['id']),
            'dataadminlpa' => $this->Model_user->get_admin_lpa(),
            'datalpa' => $this->Model_user->get_list_lpa(),
            'dataotheruser' => $this->Model_profile->Other_view($id['user_id']),
        );
        // echo json_encode($data['datauser']); exit;
        $this->load->view('adminlpa', $data);

        // $this->load->view('view_profil');

        // echo $this->session->userdata('name');
    }

    public function inputketualpa()
    {
        $this->load->view('input_ketualpa');
    }
    public function editketualpa()
    {
        $id = $this->uri->segment(3);
        $data = array(
            'content' => 'edit_ketualembaga',
            'data' => $this->Model_user->select_ketualpa($id),
            'id' => $id
        );
        $this->load->view('edit_ketualembaga', $data);
    }

    public function simpanKetuaLPA()
    {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        $pwd = substr(str_shuffle($data), 0, 7);
        $post = $this->input->post();

        $users_id = $this->session->userdata('id');
        $config['upload_path']          = 'assets/uploads/berkas_akreditasi/';
        $config['allowed_types']        = 'pdf|xls|xlsx';
        $config['max_size']             = 2048;
        $config['max_width']            = 1080;
        $config['max_height']           = 1080;
        $config['overwrite']            = true;
        $config['encrypt_name'] = TRUE;

        $password1 = $pwd;
        $salt      = '1m_@_SaLT_f0R_4kreD!t4$i';
        $hashed    = hash('sha256', $password1 . $salt);;

        //Upload dokumen_sk_penunjukan
        if (!empty($_FILES['dokumen_sk_penunjukan']['name'])) {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('dokumen_sk_penunjukan')) {
                print_r($this->upload->display_errors());
                exit;
            }
            $attachment = $this->upload->data();
            $fileName = $attachment['file_name'];

            //$dokumen_sk_penunjukan =  $url.$fileName;
            $dokumen_sk_penunjukan =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
        } else {
            if (isset($post['old_dokumen_sk_penunjukan'])) {
                $dokumen_sk_penunjukan = $post['old_dokumen_sk_penunjukan'];
            } else {
                $dokumen_sk_penunjukan = '';
            }
        }
        $datausers = array(
            'nik' => $post['nik'],
            'nama' => $post['nama'],
            'email' => $post['email'],
            'username' => $post['email'],
            'password' => $pwd,
            'password_enkripsi' => $hashed,
            'kriteria_id' => '5',
            'lpa_id' => $post['lpa_id'],
            'user_status' => '1',
            'validate' => '2'

        );

        if (!empty($post['id'])) {
            $where = array(
                'id' => $post['id'],

            );
            $wheres = array(
                'id' => $post['users_id'],

            );
            $datac = array(
                //'nik' =>$post['nik'],
                'nama' => $post['nama'],
                //'email' =>$post['email'],
                'username' => $post['email']

            );

            $this->Model_sina->edit_data('users', $wheres, $datac);
            $users_id = $this->db->insert_id();
            $datas = array(
                //'users_id' => $users_id,
                'lpa_id' => $post['lpa_id'],
                //'nik' =>$post['nik'],
                'nama' => $post['nama'],
                //'email' =>$post['email'],
                'no_hp' => $post['no_hp'],
                'status_keaktifan' => $post['status_keaktifan'],
                'tanggal_aktif' => $post['tanggal_aktif'],
                'tanggal_nonaktif' => $post['tanggal_nonaktif'],
                'dokumen_sk_penunjukan' => $dokumen_sk_penunjukan
            );
            $this->Model_sina->edit_data('user_ketua_lpa', $where, $datas);

            $this->session->set_flashdata('kode_name', 'success');
            $this->session->set_flashdata('icon_name', 'check');
            $this->session->set_flashdata('message_name', 'Sukses Ubah Data!');

            redirect('user/index/' . $post['id']);
        } else {
            $this->Model_sina->input_data('users', $datausers);
            $users_id = $this->db->insert_id();
            $datas = array(

                'users_id' => $users_id,
                'nik' => $post['nik'],
                'lpa_id' => $post['lpa_id'],
                'nama' => $post['nama'],
                'email' => $post['email'],
                'no_hp' => $post['no_hp'],
                'status_keaktifan' => $post['status_keaktifan'],
                'tanggal_aktif' => $post['tanggal_aktif'],
                'tanggal_nonaktif' => $post['tanggal_nonaktif'],
                'dokumen_sk_penunjukan' => $dokumen_sk_penunjukan
            );
            $responsed = $this->Model_sina->input_data('user_ketua_lpa', $datas);


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
                $message .= '<p>Account <b> Ketua Lembaga </b> anda telah di validasi, </p>';
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
                    // echo 'Success';


                    // WHATSAPP


                    // 						$curl = curl_init();

                    // 						curl_setopt_array($curl, array(
                    // 							CURLOPT_URL => 'http://192.168.48.124:8000/send-message',
                    // 							CURLOPT_RETURNTRANSFER => true,
                    // 							CURLOPT_ENCODING => '',
                    // 							CURLOPT_MAXREDIRS => 10,
                    // 							CURLOPT_TIMEOUT => 0,
                    // 							CURLOPT_FOLLOWLOCATION => true,
                    // 							CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    // 							CURLOPT_CUSTOMREQUEST => 'POST',
                    // 							// CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo%2C%20' . $namapengguna .
                    // 							//     '!%2C%20Account%20Verifikator%20Fasyankes%20anda%20telah%20aktif%2C%20Silahkan%20login%20pada%20halaman%20website%20%3A%20http%3A%2F%2Fperizinan.yankes.kemkes.go.id%2Fsina%2F%20.%20%0AMenggunakan%Username%20%3A%20'. $emailpengguna .'%20Dan%20Menggunakan%20password%20%3A%2012345%20%20%20%20%20%0AIf%20you%20need%20help%2C%20please%20contact%20the%20site%20administrator.',
                    // 							CURLOPT_POSTFIELDS => 'sender=sinaf&number=' . $notelp . '&message=Hallo ' . $namapengguna .' !!!


                    // Akun Ketua Lembaga anda telah aktif. Silahkan login  aplikasi SINAF sinaf.kemkes.go.id menggunakan :
                    //     Username : '. $emailpengguna .'
                    //     password : '. $pwd . '

                    // Apabila membutuhkan bantuan, silahkan hubungi Tim Admin Kemenkes',
                    // 							CURLOPT_HTTPHEADER => array(
                    // 								'Content-Type: application/x-www-form-urlencoded'
                    // 							),
                    // 						));

                    // 						$response = curl_exec($curl);

                    // 						curl_close($curl);
                    // 						$res = json_decode($response, true);
                    // 						// echo $response;
                    // 						if ($res['status'] == TRUE) {
                    // 							echo '1';
                    redirect('user/index');
                    // 						} else {
                    // 							echo $response;
                    // 						}


                    // 					// WHATSAPP


                    // 					} else {
                    // 						show_error($this->email->print_debugger());
                    // 					}
                    // 				}else{
                    // 						echo $responsed;
                    // 				}
                    //redirect('pengajuan/verifikator');

                }



                //awal
                // $this->Model_sina->input_data('users',$datausers);
                // 	$users_id = $this->db->insert_id();
                // 	$no=1;
                // 	$datas = array(
                // 			'users_id' => $users_id,
                // 			'lpa_id' =>$post['lpa_id'],
                // 			'nama' =>$post['nama'],
                // 			'email' =>$post['email'],
                // 			'no_hp' =>$post['no_hp'],
                // 			'status_keaktifan' =>"Aktif",
                //             'tanggal_aktif' =>$post['tanggal_aktif'],
                //             'tanggal_nonaktif' =>$post['tanggal_nonaktif'],
                //             'dokumen_sk_penunjukan' => $dokumen_sk_penunjukan

                // 			);


                // 		$this->Model_sina->input_data('user_ketua_lpa',$datas);
                //         $this->session->set_flashdata('kode_name', 'success');
                //         $this->session->set_flashdata('msg','<div class="alert alert-success">Berhasil Tambah User. </div>');
                //         redirect('User');
            }
        }
    }
    public function hapusketualpa()
    {
        $id = $this->uri->segment(3);
        // $this->Model_sina->delete_verifikator($id);
        // redirect('pengajuan/verifikator');
        $notelp = $this->uri->segment(4);
        // $namapengguna = $this->uri->segment(5);
        //$emailpengguna = $this->uri->segment(5);


        // $rest = $this->Model_sina->delete_surveior($id);
        // if($rest == true){
        //echo $no_telp;
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
        // 						CURLOPT_POSTFIELDS => 'sender=sinaf&number=' . $notelp . '&message=Hallo Ketua Lembaga !.
        // Akun anda telah dihapus. 

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
        $rest = $this->Model_user->delete_ketualpa($id);

        if ($rest == TRUE) {
            echo '1';

            redirect('user/index');
        } else {
            echo $rest;
        }
        // } else {
        // 	//alert('Nomor anda tidak valid');
        // 	$message = "Nomor anda tidak valid";
        // 	echo "<script type='text/javascript'>alert('$message');</script>";
        // 	die(redirect('user/index','refresh'));
        // 	//echo $response;
        // }
    }

    public function checkemail($email)
    {
        // echo $email;
        $decodeemail = urldecode($email);
        // $checkemail = $this->input->post('email_user');
        $check = $this->Model_user->checkmail($decodeemail);
        echo $check;
    }

    public function checkniksurveior($nik)
    {
        // echo $email;
        $decodeemail = urldecode($nik);
        // $checkemail = $this->input->post('email_user');
        $check = $this->Model_user->checkniksurveior($decodeemail);
        echo $check;
    }
    public function checknik($nik)
    {
        // echo $email;
        $decodeemail = urldecode($nik);
        // $checkemail = $this->input->post('email_user');
        $check = $this->Model_user->checknik($decodeemail);
        echo $check;
    }
    public function checknikadmin($nik)
    {
        // echo $email;
        $decodeemail = urldecode($nik);
        // $checkemail = $this->input->post('email_user');
        $check = $this->Model_user->checknikadmin($decodeemail);
        echo $check;
    }
    public function checknikketua($nik)
    {
        // echo $email;
        $decodeemail = urldecode($nik);
        // $checkemail = $this->input->post('email_user');
        $check = $this->Model_user->checknikketua($decodeemail);
        echo $check;
    }
    public function inputAdminlpa()
    {
        $this->load->view('input_adminlpa');
    }

    public function editAdminlpa()
    {
        $id = $this->uri->segment(3);
        $data = array(
            'content' => 'edit_adminlembaga',
            'data' => $this->Model_user->select_adminlpa($id),
            'id' => $id
        );
        $this->load->view('edit_adminlembaga', $data);
    }

    public function simpanAdminLPA()
    {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        $pwd = substr(str_shuffle($data), 0, 7);
        $post = $this->input->post();

        $users_id = $this->session->userdata('id');
        $config['upload_path']          = 'assets/uploads/berkas_akreditasi/';
        $config['allowed_types']        = 'pdf|xls|xlsx';
        $config['max_size']             = 2048;
        $config['max_width']            = 1080;
        $config['max_height']           = 1080;
        $config['overwrite']            = true;
        $config['encrypt_name'] = TRUE;

        $password1 = $pwd;
        $salt      = '1m_@_SaLT_f0R_4kreD!t4$i';
        $hashed    = hash('sha256', $password1 . $salt);;

        //Upload dokumen_sk_penugasan
        if (!empty($_FILES['dokumen_sk_penugasan']['name'])) {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('dokumen_sk_penugasan')) {
                print_r($this->upload->display_errors());
                exit;
            }
            $attachment = $this->upload->data();
            $fileName = $attachment['file_name'];

            //$dokumen_sk_penugasan =  $url.$fileName;
            $dokumen_sk_penugasan =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
        } else {
            if (isset($post['old_dokumen_sk_penugasan'])) {
                $dokumen_sk_penugasan = $post['old_dokumen_sk_penugasan'];
            } else {
                $dokumen_sk_penugasan = '';
            }
        }
        $datausers = array(
            'nik' => $post['nik'],
            'nama' => $post['nama'],
            'email' => $post['email'],
            'username' => $post['email'],
            'password' => $pwd,
            'password_enkripsi' => $hashed,
            'kriteria_id' => '1',
            'lpa_id' => $post['lpa_id'],
            'user_status' => '1',
            'validate' => '2'

        );

        if (!empty($post['id'])) {
            $where = array(
                'id' => $post['id'],

            );
            $wheres = array(
                'id' => $post['users_id'],

            );
            $datac = array(
                //'nik' =>$post['nik'],
                'nama' => $post['nama'],
                //'email' =>$post['email'],
                'username' => $post['email']

            );

            $this->Model_sina->edit_data('users', $wheres, $datac);
            $users_id = $this->db->insert_id();
            $datas = array(
                //'users_id' => $users_id,
                'lpa_id' => $post['lpa_id'],
                //'nik' =>$post['nik'],
                'nama' => $post['nama'],
                //'email' =>$post['email'],
                'no_hp' => $post['no_hp'],
                //'status_keaktifan' =>"Aktif",
                'fasyankes_id' => $post['fasyankes_id'],
                'tanggal_aktif' => $post['tanggal_aktif'],
                'tanggal_nonaktif' => $post['tanggal_nonaktif'],
                'dokumen_sk_penugasan' => $dokumen_sk_penugasan
            );
            $this->Model_sina->edit_data('user_admin_lpa', $where, $datas);

            $this->session->set_flashdata('kode_name', 'success');
            $this->session->set_flashdata('icon_name', 'check');
            $this->session->set_flashdata('message_name', 'Sukses Ubah Data!');

            redirect('user/listAdminlpa/' . $post['id']);
            // if($response == true){
            // 	redirect(base_url('Mail/useractive'));
            // }else{
            // 	echo $response;
            // }
        } else {
            $this->Model_sina->input_data('users', $datausers);
            $users_id = $this->db->insert_id();
            $datas = array(

                'users_id' => $users_id,
                'nik' => $post['nik'],
                'lpa_id' => $post['lpa_id'],
                'fasyankes_id' => $post['fasyankes_id'],
                'nama' => $post['nama'],
                'email' => $post['email'],
                'no_hp' => $post['no_hp'],
                'status_keaktifan' => $post['status_keaktifan'],
                'tanggal_aktif' => $post['tanggal_aktif'],
                'tanggal_nonaktif' => $post['tanggal_nonaktif'],
                'dokumen_sk_penugasan' => $dokumen_sk_penugasan
            );
            $responsed = $this->Model_sina->input_data('user_admin_lpa', $datas);


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
                $message .= '<p>Account Admin Lembaga anda telah di validasi, </p>';
                $message .= '<p>Silahkan login pada halaman website : sinaf.kemkes.go.id .</p>';
                $message .= '<p><b>Menggunakan Username : ' . $emailpengguna . '  dan Menggunakan password : ' . $pwd . ' </b></p>';
                // $message .= '<b style="color:red;">After logging in, please change your password at profile.</b> <br><br>';
                $message .= '<b>===============================================================</b> <br> <br>';
                $message .= '<b style="color:blue;">Apabila membutuhkan bantuan, silahkan hubungi Tim Admin Kemenkes</b>';
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
                    //  echo 'Success';


                    // WHATSAPP


                    //                             $curl = curl_init();

                    //                             curl_setopt_array($curl, array(
                    //                                 CURLOPT_URL => 'http://192.168.48.124:8000/send-message',
                    //                                 CURLOPT_RETURNTRANSFER => true,
                    //                                 CURLOPT_ENCODING => '',
                    //                                 CURLOPT_MAXREDIRS => 10,
                    //                                 CURLOPT_TIMEOUT => 0,
                    //                                 CURLOPT_FOLLOWLOCATION => true,
                    //                                 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    //                                 CURLOPT_CUSTOMREQUEST => 'POST',
                    //                                 // CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo%2C%20' . $namapengguna .
                    //                                 //     '!%2C%20Account%20Verifikator%20Fasyankes%20anda%20telah%20aktif%2C%20Silahkan%20login%20pada%20halaman%20website%20%3A%20http%3A%2F%2Fperizinan.yankes.kemkes.go.id%2Fsina%2F%20.%20%0AMenggunakan%Username%20%3A%20'. $emailpengguna .'%20Dan%20Menggunakan%20password%20%3A%2012345%20%20%20%20%20%0AIf%20you%20need%20help%2C%20please%20contact%20the%20site%20administrator.',
                    //                                 CURLOPT_POSTFIELDS => 'sender=sinaf&number=' . $notelp . '&message=Hallo ' . $namapengguna .' !!!

                    // Akun Admin Lembaga anda telah aktif. Silahkan login  aplikasi SINAF sinaf.kemkes.go.id menggunakan :
                    //     Username : '. $emailpengguna .'
                    //     password : '. $pwd . '

                    // Apabila membutuhkan bantuan, silahkan hubungi Tim Admin Kemenkes',
                    //                                 CURLOPT_HTTPHEADER => array(
                    //                                     'Content-Type: application/x-www-form-urlencoded'
                    //                                 ),
                    //                             ));

                    //                             $response = curl_exec($curl);

                    //                             curl_close($curl);
                    //                             $res = json_decode($response, true);
                    //                             echo $response;
                    //                             if ($res['status'] == TRUE) {
                    //                                echo '1';
                    redirect('user/listAdminlpa');
                    //                            } else {
                    //                                echo $response;
                    //                            }


                    //                         // WHATSAPP


                    //                         } else {
                    //                             show_error($this->email->print_debugger());
                    //                         }
                    //                     }else{
                    //                             echo $responsed;
                    //                     }
                    //redirect('pengajuan/verifikator');

                }
            }
        }
    }
    public function hapusadminlpa()
    {
        $id = $this->uri->segment(3);
        // $this->Model_sina->delete_verifikator($id);
        // redirect('pengajuan/verifikator');
        $notelp = $this->uri->segment(4);
        // $namapengguna = $this->uri->segment(5);
        //$emailpengguna = $this->uri->segment(5);


        // $rest = $this->Model_sina->delete_surveior($id);
        // if($rest == true){
        //echo $no_telp;
        // WHATSAPP

        // batas
        //                         $curl = curl_init();

        //                         curl_setopt_array($curl, array(
        //                             CURLOPT_URL => 'http://192.168.48.124:8000/send-message',
        //                             CURLOPT_RETURNTRANSFER => true,
        //                             CURLOPT_ENCODING => '',
        //                             CURLOPT_MAXREDIRS => 10,
        //                             CURLOPT_TIMEOUT => 0,
        //                             CURLOPT_FOLLOWLOCATION => true,
        //                             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //                             CURLOPT_CUSTOMREQUEST => 'POST',
        //                             // CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo%2C%20' . $namapengguna .
        //                             //     '!%2C%20Account%20Verifikator%20Fasyankes%20anda%20telah%20aktif%2C%20Silahkan%20login%20pada%20halaman%20website%20%3A%20http%3A%2F%2Fperizinan.yankes.kemkes.go.id%2Fsina%2F%20.%20%0AMenggunakan%Username%20%3A%20'. $emailpengguna .'%20Dan%20Menggunakan%20password%20%3A%2012345%20%20%20%20%20%0AIf%20you%20need%20help%2C%20please%20contact%20the%20site%20administrator.',
        //                             CURLOPT_POSTFIELDS => 'sender=sinaf&number=' . $notelp . '&message=Hallo Admin Lembaga !. 
        // Akun anda telah dihapus. 

        // Apabila membutuhkan bantuan, silahkan hubungi Tim Admin Kemenkes',
        //                             CURLOPT_HTTPHEADER => array(
        //                                 'Content-Type: application/x-www-form-urlencoded'
        //                             ),
        //                         ));

        //                         $response = curl_exec($curl);

        //                         curl_close($curl);
        //                         $res = json_decode($response, true);
        // // batas



        //                         // echo $response;

        //                         if ($res['status'] == TRUE) {
        //                             echo '1';
        $rest = $this->Model_user->delete_adminlpa($id);

        if ($rest == TRUE) {
            // echo '1';

            redirect('user/listAdminlpa');
        } else {
            echo $rest;
        }
        // } else {
        //     alert('Nomor anda tidak valid');
        //     $message = "Nomor anda tidak valid";
        //     echo "<script type='text/javascript'>alert('$message');</script>";
        //     die(redirect('user/listAdminlpa','refresh'));
        //     echo $response;
        // }
    }
    // public function simpanAdminLPA()
    // {
    //         $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
    //         $pwd = substr(str_shuffle($data), 0, 7);
    //         $post = $this->input->post();

    //         $users_id = $this->session->userdata('id');
    //         $config['upload_path']          = 'assets/uploads/berkas_akreditasi/';
    //         $config['allowed_types']        = 'pdf|xls|xlsx';
    //         $config['max_size']             = 2048;
    //         $config['max_width']            = 1080;
    //         $config['max_height']           = 1080;
    //         $config['overwrite']            = true;
    //         $config['encrypt_name'] = TRUE;

    //         $password1 = $pwd;
    //         $salt      = '1m_@_SaLT_f0R_4kreD!t4$i';
    //         $hashed    = hash('sha256', $password1 . $salt);;

    //         //Upload dokumen_sk_penugasan
    //         if (!empty($_FILES['dokumen_sk_penugasan']['name'])){
    //             $this->load->library('upload', $config);
    //             if ( ! $this->upload->do_upload('dokumen_sk_penugasan'))
    //             {
    //                 print_r($this->upload->display_errors());exit;
    //             }
    //                 $attachment = $this->upload->data();
    //                 $fileName = $attachment['file_name'];

    //                 //$dokumen_sk_penugasan =  $url.$fileName;
    //                 $dokumen_sk_penugasan =  base_url('assets/uploads/berkas_akreditasi/'. $fileName) ;

    //         } else {
    //             if(isset($post['old_dokumen_sk_penugasan'])){
    //                 $dokumen_sk_penugasan = $post['old_dokumen_sk_penugasan'];
    //             } else {
    //                 $dokumen_sk_penugasan = '';
    //             }
    //         }
    //             $datausers = array(
    //                 'nik' =>$post['nik'],
    //                 'nama' =>$post['nama'],
    //                 'email' =>$post['email'],
    //                 'username' =>$post['email'],
    //                 'password' =>$pwd,
    //                 'password_enkripsi' =>$hashed,
    //                 'kriteria_id' => '1',
    //                 'lpa_id'=>$post['lpa_id'],
    //                 'user_status'=>'1',
    //                 'validate' =>'2'

    //             );



    //             $this->Model_sina->input_data('users',$datausers);
    //                 $users_id = $this->db->insert_id();
    //                 $no=1;
    //                 $datas = array(
    //                         'users_id' => $users_id,
    //                         'lpa_id' =>$post['lpa_id'],
    //                         'nama' =>$post['nama'],
    //                         'email' =>$post['email'],
    //                         'no_hp' =>$post['no_hp'],
    //                         'status_keaktifan' =>"Aktif",
    //                         'tanggal_aktif' =>$post['tanggal_aktif'],
    //                         'tanggal_nonaktif' =>$post['tanggal_nonaktif'],
    //                         'dokumen_sk_penugasan' => $dokumen_sk_penugasan

    //                         );


    //                     $this->Model_sina->input_data('user_admin_lpa',$datas);

    //                     $this->session->set_flashdata('kode_name', 'success');
    //                      $this->session->set_flashdata('msg','<div class="alert alert-success">Berhasil Tambah User. </div>');

    //                     redirect('User/listAdminlpa');


    //             //email notif
    //             // if($response == true){
    //             //     $this->load->helper('date');
    //             //     date_default_timezone_set("Asia/Jakarta");
    //             //     $data = $this->session->flashdata('datapengguna');

    //             //     $emailpengguna = $post['email'];
    //             //     $namapengguna = $post['nama'];
    //             //     $notelp = $post['no_hp'];

    //             //     $subject = 'Akreditasi Fasyankes ACCOUNT';

    //             //     $message = '<html><body>';
    //             //     $message .= '<h4>Hallo, ' . $namapengguna . '!</h4>';
    //             //     $message .= '<p>Account Admin Lembaga anda telah di validasi, </p>';
    //             //     $message .= '<p>Silahkan login pada halaman website : sinaf.kemkes.go.id .</p>';
    //             //     $message .= '<p><b>Menggunakan Username : '. $emailpengguna . '  dan Menggunakan password : '. $pwd . ' </b></p>';
    //             //     $message .= '<b>===============================================================</b> <br> <br>';
    //             //     $message .= '<b style="color:blue;">If you need help, please contact the site administrator.</b>';
    //             //     $message .= '</body></html>';



    //             //     $config = [
    //             //         'mailtype' => 'html',
    //             //         'charset' => 'iso-8859-1',
    //             //         'protocol' => 'smtp',
    //             //         'smtp_host' => 'ssl://proxy.kemkes.go.id',
    //             //         'smtp_user' => 'infoyankes@kemkes.go.id',
    //             //         'smtp_pass' => 'n3nceY@D',
    //             //         'smtp_port' => 465,
    //             //         'smtp_timeout' => 60
    //             //     ];

    //             //     $this->load->library('email', $config);
    //             //     $this->email->initialize($config);

    //             //     $this->email->from('infoyankes@kemkes.go.id');
    //             //     $this->email->to($emailpengguna);
    //             //     $this->email->subject($subject);
    //             //     $this->email->message($message);
    //             //     $this->email->set_newline("\r\n");
    //             //     $send = $this->email->send();
    //             //     if ($send) {
    //             //         // echo '1';


    //             //         // WHATSAPP


    //             //         $curl = curl_init();

    //             //         curl_setopt_array($curl, array(
    //             //             CURLOPT_URL => 'http://192.168.48.124:8000/send-message',
    //             //             CURLOPT_RETURNTRANSFER => true,
    //             //             CURLOPT_ENCODING => '',
    //             //             CURLOPT_MAXREDIRS => 10,
    //             //             CURLOPT_TIMEOUT => 0,
    //             //             CURLOPT_FOLLOWLOCATION => true,
    //             //             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //             //             CURLOPT_CUSTOMREQUEST => 'POST',

    //             //             CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo ' . $namapengguna .
    //             //             '!. Account Admin Lembaga anda telah aktif. Silahkan login pada halaman website sinaf.kemkes.go.id . Menggunakan Username : '. $emailpengguna .' Dan Menggunakan password : '. $pwd . '. If you need help please contact the site administrator.',
    //             //             CURLOPT_HTTPHEADER => array(
    //             //                 'Content-Type: application/x-www-form-urlencoded'
    //             //             ),
    //             //         ));

    //             //         $response = curl_exec($curl);

    //             //         curl_close($curl);
    //             //         $res = json_decode($response, true);
    //             //         // echo $response;
    //             //         if ($res['status'] == TRUE) {
    //             //             echo '1';
    //             //             redirect('pengajuan/surveior');
    //             //         } else {
    //             //             echo $response;
    //             //         }


    //             //         // WHATSAPP


    //             //     } else {
    //             //             show_error($this->email->print_debugger());
    //             //     }
    //             // }else{
    //             //                     echo $response;
    //             // }



    //     }

    //Direktur
    public function listDirektur()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');

        $id = $this->session->userdata();
        $data = array(
            'content' => 'view-profil',
            'datauser' => $this->Model_profile->Profile_view($id['id']),
            'datadirektur' => $this->Model_user->get_direktur(),
            'datalpa' => $this->Model_user->get_list_lpa(),
            'dataotheruser' => $this->Model_profile->Other_view($id['user_id']),
        );
        $this->load->view('direktur', $data);
    }

    public function inputdirektur()
    {
        $this->load->view('input_direktur');
    }

    public function simpanDirektur()
    {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        $pwd = substr(str_shuffle($data), 0, 7);
        $post = $this->input->post();

        $users_id = $this->session->userdata('id');
        $config['upload_path']          = 'assets/uploads/berkas_akreditasi/';
        $config['allowed_types']        = 'pdf|xls|xlsx';
        $config['max_size']             = 2048;
        $config['max_width']            = 1080;
        $config['max_height']           = 1080;
        $config['overwrite']            = true;
        $config['encrypt_name'] = TRUE;

        $password1 = $pwd;
        $salt      = '1m_@_SaLT_f0R_4kreD!t4$i';
        $hashed    = hash('sha256', $password1 . $salt);


        $datausers = array(
            'nik' => $post['nik'],
            'nama' => $post['nama'],
            'email' => $post['email'],
            'username' => $post['email'],
            'password' => $pwd,
            'password_enkripsi' => $hashed,
            'kriteria_id' => '9',

            'user_status' => '1',
            'validate' => '2'

        );

        if (!empty($post['id'])) {
            $where = array(
                'id' => $post['id'],

            );
            $wheres = array(
                'id' => $post['users_id'],

            );
            $datac = array(
                //'nik' =>$post['nik'],
                'nama' => $post['nama'],
                //'email' =>$post['email'],
                'username' => $post['email']

            );

            $this->Model_sina->edit_data('users', $where, $datac);


            $this->session->set_flashdata('kode_name', 'success');
            $this->session->set_flashdata('icon_name', 'check');
            $this->session->set_flashdata('message_name', 'Sukses Ubah Data!');

            redirect('user/listDirektur/' . $post['id']);
        } else {
            $responsed =  $this->Model_sina->input_data('users', $datausers);

            $this->session->set_flashdata('kode_name', 'success');
            $this->session->set_flashdata('icon_name', 'check');
            $this->session->set_flashdata('message_name', 'Sukses Input Data!');

            if ($responsed == true) {
                $this->load->helper('date');
                date_default_timezone_set("Asia/Jakarta");
                $data = $this->session->flashdata('datapengguna');
                $emailpengguna = $post['email'];
                $namapengguna = $post['nama'];


                $subject = 'Akreditasi Fasyankes ACCOUNT';

                // Compose a simple HTML email message
                $message = '<html><body>';
                $message .= '<h4>Hallo, ' . $namapengguna . '!</h4>';
                $message .= '<p>Akun <b>Ketua Tim Kerja</b> anda telah aktif, </p>';
                $message .= '<p>Silahkan login  aplikasi SINAF sinaf.kemkes.go.id.</p>';
                $message .= '<p><b>Menggunakan: Username : ' . $emailpengguna . '  dan password : ' . $pwd . ' </b></p>';
                // $message .= '<b style="color:red;">After logging in, please change your password at profile.</b> <br><br>';
                $message .= '<b>===============================================================</b> <br> <br>';
                $message .= '<b style="color:blue;">Apabila membutuhkan bantuan, silahkan hubungi Tim Admin Kemenkes.</b>';
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
                    redirect('user/listDirektur');
                }
            }
        }
    }

    public function editdirektur()
    {
        $id = $this->uri->segment(3);
        $data = array(
            'content' => 'edit_direktur',
            'data' => $this->Model_user->select_direktur($id),
            'id' => $id
        );
        $this->load->view('edit_direktur', $data);
    }

    public function hapusdirektur()
    {
        $id = $this->uri->segment(3);
        $rest = $this->Model_user->delete_direktur($id);

        if ($rest == TRUE) {
            echo '1';

            redirect('user/listDirektur');
        } else {
            echo $rest;
        }
    }

    //Ketua Tim Kerja
    public function listKetuatim()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');

        $id = $this->session->userdata();
        // echo json_encode($id['id']);
        $data = array(
            'content' => 'view-profil',
            'datauser' => $this->Model_profile->Profile_view($id['id']),
            'dataketuatim' => $this->Model_user->get_ketua_tim(),
            'datalpa' => $this->Model_user->get_list_lpa(),
            'dataotheruser' => $this->Model_profile->Other_view($id['user_id']),
        );
        // echo json_encode($data['datauser']); exit;
        $this->load->view('ketuatim', $data);

        // $this->load->view('view_profil');

        // echo $this->session->userdata('name');
    }

    public function inputketuatim()
    {
        $this->load->view('input_ketuatim');
    }
    public function editketuatim()
    {
        $id = $this->uri->segment(3);
        $data = array(
            'content' => 'edit_ketuatim',
            'data' => $this->Model_user->select_ketuatim($id),
            'id' => $id
        );
        $this->load->view('edit_ketuatim', $data);
    }

    public function simpanKetuatim()
    {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        $pwd = substr(str_shuffle($data), 0, 7);
        $post = $this->input->post();

        $users_id = $this->session->userdata('id');
        $config['upload_path']          = 'assets/uploads/berkas_akreditasi/';
        $config['allowed_types']        = 'pdf|xls|xlsx';
        $config['max_size']             = 2048;
        $config['max_width']            = 1080;
        $config['max_height']           = 1080;
        $config['overwrite']            = true;
        $config['encrypt_name'] = TRUE;

        $password1 = $pwd;
        $salt      = '1m_@_SaLT_f0R_4kreD!t4$i';
        $hashed    = hash('sha256', $password1 . $salt);;

        //Upload dokumen_sk_penunjukan
        if (!empty($_FILES['dokumen_sk_penunjukan']['name'])) {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('dokumen_sk_penunjukan')) {
                print_r($this->upload->display_errors());
                exit;
            }
            $attachment = $this->upload->data();
            $fileName = $attachment['file_name'];

            //$dokumen_sk_penunjukan =  $url.$fileName;
            $dokumen_sk_penunjukan =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
        } else {
            if (isset($post['old_dokumen_sk_penunjukan'])) {
                $dokumen_sk_penunjukan = $post['old_dokumen_sk_penunjukan'];
            } else {
                $dokumen_sk_penunjukan = '';
            }
        }
        $datausers = array(
            'nik' => $post['nik'],
            'nama' => $post['nama'],
            'email' => $post['email'],
            'username' => $post['email'],
            'password' => $pwd,
            'password_enkripsi' => $hashed,
            'kriteria_id' => '8',
            'lpa_id' => $post['lpa_id'],
            'user_status' => '1',
            'validate' => '2'

        );

        if (!empty($post['id'])) {
            $where = array(
                'id' => $post['id'],

            );
            $wheres = array(
                'id' => $post['users_id'],

            );
            $datac = array(
                //'nik' =>$post['nik'],
                'nama' => $post['nama'],
                //'email' =>$post['email'],
                'username' => $post['email']

            );

            $this->Model_sina->edit_data('users', $wheres, $datac);
            $users_id = $this->db->insert_id();
            $datas = array(
                //'users_id' => $users_id,
                'lpa_id' => $post['lpa_id'],
                //'nik' =>$post['nik'],
                'nama' => $post['nama'],
                //'email' =>$post['email'],
                'no_hp' => $post['no_hp'],
                'status_keaktifan' => $post['status_keaktifan'],
                'tanggal_aktif' => $post['tanggal_aktif'],
                'tanggal_nonaktif' => $post['tanggal_nonaktif'],
                'dokumen_sk_penunjukan' => $dokumen_sk_penunjukan
            );
            $this->Model_sina->edit_data('user_ketua_tim', $where, $datas);

            $this->session->set_flashdata('kode_name', 'success');
            $this->session->set_flashdata('icon_name', 'check');
            $this->session->set_flashdata('message_name', 'Sukses Ubah Data!');

            redirect('user/index/' . $post['id']);
            // if($response == true){
            // 	redirect(base_url('Mail/useractive'));
            // }else{
            // 	echo $response;
            // }
        } else {
            $this->Model_sina->input_data('users', $datausers);
            $users_id = $this->db->insert_id();
            $datas = array(

                'users_id' => $users_id,
                'nik' => $post['nik'],
                'lpa_id' => $post['lpa_id'],
                'nama' => $post['nama'],
                'email' => $post['email'],
                'no_hp' => $post['no_hp'],
                'status_keaktifan' => $post['status_keaktifan'],
                'tanggal_aktif' => $post['tanggal_aktif'],
                'tanggal_nonaktif' => $post['tanggal_nonaktif'],
                'dokumen_sk_penunjukan' => $dokumen_sk_penunjukan
            );
            $responsed = $this->Model_sina->input_data('user_ketua_tim', $datas);


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
                $message .= '<p>Akun <b>Ketua Tim Kerja</b> anda telah aktif, </p>';
                $message .= '<p>Silahkan login  aplikasi SINAF sinaf.kemkes.go.id.</p>';
                $message .= '<p><b>Menggunakan: Username : ' . $emailpengguna . '  dan password : ' . $pwd . ' </b></p>';
                // $message .= '<b style="color:red;">After logging in, please change your password at profile.</b> <br><br>';
                $message .= '<b>===============================================================</b> <br> <br>';
                $message .= '<b style="color:blue;">Apabila membutuhkan bantuan, silahkan hubungi Tim Admin Kemenkes.</b>';
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


                    //                     $curl = curl_init();

                    //                     curl_setopt_array($curl, array(
                    //                         CURLOPT_URL => 'http://192.168.48.124:8000/send-message',
                    //                         CURLOPT_RETURNTRANSFER => true,
                    //                         CURLOPT_ENCODING => '',
                    //                         CURLOPT_MAXREDIRS => 10,
                    //                         CURLOPT_TIMEOUT => 0,
                    //                         CURLOPT_FOLLOWLOCATION => true,
                    //                         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    //                         CURLOPT_CUSTOMREQUEST => 'POST',
                    //                         // CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo%2C%20' . $namapengguna .
                    //                         //     '!%2C%20Account%20Verifikator%20Fasyankes%20anda%20telah%20aktif%2C%20Silahkan%20login%20pada%20halaman%20website%20%3A%20http%3A%2F%2Fperizinan.yankes.kemkes.go.id%2Fsina%2F%20.%20%0AMenggunakan%Username%20%3A%20'. $emailpengguna .'%20Dan%20Menggunakan%20password%20%3A%2012345%20%20%20%20%20%0AIf%20you%20need%20help%2C%20please%20contact%20the%20site%20administrator.',
                    //                         CURLOPT_POSTFIELDS => 'sender=sinaf&number=' . $notelp . '&message=Hallo ' . $namapengguna .' !!!

                    // Akun Ketua Tim Kerja anda telah aktif. Silahkan login  aplikasi SINAF sinaf.kemkes.go.id menggunakan :
                    //     Username : '. $emailpengguna .'
                    //     password : '. $pwd . '

                    // Apabila membutuhkan bantuan, silahkan hubungi Tim Admin Kemenkes',
                    //                         CURLOPT_HTTPHEADER => array(
                    //                             'Content-Type: application/x-www-form-urlencoded'
                    //                         ),
                    //                     ));

                    //                     $response = curl_exec($curl);

                    //                     curl_close($curl);
                    //                     $res = json_decode($response, true);
                    //                     // echo $response;
                    //                     if ($res['status'] == TRUE) {
                    //                         echo '1';
                    redirect('user/listKetuatim');
                    //                     } else {
                    //                         echo $response;
                    //                     }


                    //                 // WHATSAPP


                    //                 } else {
                    //                     show_error($this->email->print_debugger());
                    //                 }
                    //             }else{
                    //                     echo $responsed;
                    //             }
                    //redirect('pengajuan/verifikator');

                }
            }
        }
    }
    public function hapusketuatim()
    {
        $id = $this->uri->segment(3);
        // $this->Model_sina->delete_verifikator($id);
        // redirect('pengajuan/verifikator');
        $notelp = $this->uri->segment(4);
        // $namapengguna = $this->uri->segment(5);
        //$emailpengguna = $this->uri->segment(5);


        // $rest = $this->Model_sina->delete_surveior($id);
        // if($rest == true){
        //echo $no_telp;
        // WHATSAPP


        //                 $curl = curl_init();

        //                 curl_setopt_array($curl, array(
        //                     CURLOPT_URL => 'http://192.168.48.124:8000/send-message',
        //                     CURLOPT_RETURNTRANSFER => true,
        //                     CURLOPT_ENCODING => '',
        //                     CURLOPT_MAXREDIRS => 10,
        //                     CURLOPT_TIMEOUT => 0,
        //                     CURLOPT_FOLLOWLOCATION => true,
        //                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //                     CURLOPT_CUSTOMREQUEST => 'POST',
        //                     // CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo%2C%20' . $namapengguna .
        //                     //     '!%2C%20Account%20Verifikator%20Fasyankes%20anda%20telah%20aktif%2C%20Silahkan%20login%20pada%20halaman%20website%20%3A%20http%3A%2F%2Fperizinan.yankes.kemkes.go.id%2Fsina%2F%20.%20%0AMenggunakan%Username%20%3A%20'. $emailpengguna .'%20Dan%20Menggunakan%20password%20%3A%2012345%20%20%20%20%20%0AIf%20you%20need%20help%2C%20please%20contact%20the%20site%20administrator.',
        //                     CURLOPT_POSTFIELDS => 'sender=sinaf&number=' . $notelp . '&message=Hallo Ketua Tim Kerja !. 
        // Akun anda telah dihapus.

        // Apabila membutuhkan bantuan, silahkan hubungi Tim Admin Kemenkes',
        //                     CURLOPT_HTTPHEADER => array(
        //                         'Content-Type: application/x-www-form-urlencoded'
        //                     ),
        //                 ));

        //                 $response = curl_exec($curl);

        //                 curl_close($curl);
        //                 $res = json_decode($response, true);
        //                 // echo $response;
        //                 if ($res['status'] == TRUE) {
        //                     echo '1';
        $rest = $this->Model_user->delete_ketuatim($id);

        if ($rest == TRUE) {
            echo '1';

            redirect('user/listKetuatim');
        } else {
            echo $rest;
        }
        // } else {
        //     //alert('Nomor anda tidak valid');
        //     $message = "Nomor anda tidak valid";
        //     echo "<script type='text/javascript'>alert('$message');</script>";
        //     die(redirect('user/listKetuatim','refresh'));
        //     //echo $response;
        // }
    }


 //Binwas
 public function listBinwas()
 {
     $this->load->library('form_validation');
     $this->load->helper('security');

     $id = $this->session->userdata();
     $data = array(
         'content' => 'view-profil',
         'datauser' => $this->Model_profile->Profile_view($id['id']),
         'databinwas' => $this->Model_user->get_binwas(),
         'datalpa' => $this->Model_user->get_list_lpa(),
         'dataotheruser' => $this->Model_profile->Other_view($id['user_id']),
     );
     $this->load->view('binwas', $data);
 }

 public function inputbinwas()
 {
     $this->load->view('input_binwas');
 }

 public function simpanBinwas()
 {
     $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
     $pwd = substr(str_shuffle($data), 0, 7);
     $post = $this->input->post();

     $users_id = $this->session->userdata('id');
     $config['upload_path']          = 'assets/uploads/berkas_akreditasi/';
     $config['allowed_types']        = 'pdf|xls|xlsx';
     $config['max_size']             = 2048;
     $config['max_width']            = 1080;
     $config['max_height']           = 1080;
     $config['overwrite']            = true;
     $config['encrypt_name'] = TRUE;

     $password1 = $pwd;
     $salt      = '1m_@_SaLT_f0R_4kreD!t4$i';
     $hashed    = hash('sha256', $password1 . $salt);


     $datausers = array(
         'nik' => $post['nik'],
         'nama' => $post['nama'],
         'email' => $post['email'],
         'username' => $post['email'],
         'password' => $pwd,
         'password_enkripsi' => $hashed,
         'kriteria_id' => '10',

         'user_status' => '1',
         'validate' => '2'

     );

     if (!empty($post['id'])) {
         $where = array(
             'id' => $post['id'],

         );
         $wheres = array(
             'id' => $post['users_id'],

         );
         $datac = array(
             //'nik' =>$post['nik'],
             'nama' => $post['nama'],
             //'email' =>$post['email'],
             'username' => $post['email']

         );

         $this->Model_sina->edit_data('users', $where, $datac);


         $this->session->set_flashdata('kode_name', 'success');
         $this->session->set_flashdata('icon_name', 'check');
         $this->session->set_flashdata('message_name', 'Sukses Ubah Data!');

         redirect('user/listBinwas/' . $post['id']);
     } else {
         $responsed =  $this->Model_sina->input_data('users', $datausers);

         $this->session->set_flashdata('kode_name', 'success');
         $this->session->set_flashdata('icon_name', 'check');
         $this->session->set_flashdata('message_name', 'Sukses Input Data!');

         if ($responsed == true) {
             $this->load->helper('date');
             date_default_timezone_set("Asia/Jakarta");
             $data = $this->session->flashdata('datapengguna');
             $emailpengguna = $post['email'];
             $namapengguna = $post['nama'];


             $subject = 'Akreditasi Fasyankes ACCOUNT';

             // Compose a simple HTML email message
             $message = '<html><body>';
             $message .= '<h4>Hallo, ' . $namapengguna . '!</h4>';
             $message .= '<p>Akun <b>Binwas</b> anda telah aktif, </p>';
             $message .= '<p>Silahkan login  aplikasi SINAF sinaf.kemkes.go.id.</p>';
             $message .= '<p><b>Menggunakan: Username : ' . $emailpengguna . '  dan password : ' . $pwd . ' </b></p>';
             // $message .= '<b style="color:red;">After logging in, please change your password at profile.</b> <br><br>';
             $message .= '<b>===============================================================</b> <br> <br>';
             $message .= '<b style="color:blue;">Apabila membutuhkan bantuan, silahkan hubungi Tim Admin Kemenkes.</b>';
             $message .= '</body></html>';

             $config = [
                 'mailtype' => 'html',
                 'charset' => 'iso-8859-1',
                 'protocol' => 'smtp',
                //  'smtp_host' => 'ssl://proxy.kemkes.go.id',
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
                 redirect('user/listBinwas');
             }
         }
     }
 }

 public function editbinwas()
 {
     $id = $this->uri->segment(3);
     $data = array(
         'content' => 'edit_binwas',
         'data' => $this->Model_user->select_binwas($id),
         'id' => $id
     );
     $this->load->view('edit_binwas', $data);
 }

 public function hapusbinwas()
 {
     $id = $this->uri->segment(3);
     $rest = $this->Model_user->delete_binwas($id);

     if ($rest == TRUE) {
         echo '1';

         redirect('user/listBinwas');
     } else {
         echo $rest;
     }
 }




    public function update_profil()
    {
        $id = $this->session->userdata();
        $surveior = $this->Model_profile->Profile_view($id['user_id']);
        $verifikator = $this->Model_profile->Verifikator_view($id['user_id']);

        var_dump($verifikator[0]->nama);

        $nama_baru = $this->input->post('nama_baru');
        $nohpbaru = $this->input->post('nohpbaru');

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
        } else {
            $this->Model_profile->Update_nama_users($nama_baru);
            $this->Model_profile->Trans_upd_profil($nama_baru, $nama_lama, $nohpbaru, $nohplama);
        }
        echo $this->session->set_flashdata('msg', '<div class="alert alert-success"Update Profil Berhasil</div>');

        redirect('profil');
    }

    public function update_pass()
    {
        $id = $this->session->userdata();
        $pass = $this->input->post('password');
        $old = $this->Model_profile->getpw($id['user_id']);
        $confirm = $this->input->post('confirmpass');

        $id = $this->session->userdata();

        // $sql=$this->db->query("SELECT password from users where id=$id['user_id']")->result();

        $uppercase = preg_match('@[A-Z]@', $pass);
        $lowercase = preg_match('@[a-z]@', $pass);
        $number    = preg_match('@[0-9]@', $pass);
        $specialChars = preg_match('@[^\w]@', $pass);
        if ($old != $old) {
            $url = base_url('profil');
            echo $this->session->set_flashdata('msg', '<div class="alert alert-danger">Ubah Password Gagal. Password Lama Salah.</div>');
            redirect(profil);
        } else if ($pass != $confirm) {
            $url = base_url('profil');
            echo $this->session->set_flashdata('msg', '<div class="alert alert-danger">Ubah Password Gagal. Password Baru dan Konfirmasi Password Tidak Sama.</div>');
            redirect(profil);
        } else if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
            $url = base_url('profil');
            echo $this->session->set_flashdata('msg', '<div class="alert alert-danger">Ubah Password Gagal. Pasword setidaknya harus 8 karakter dan harus memiliki huruf besar, huruf kecil, angka, dan spesial karakter (!@#$%^&*()) .</div>');
            redirect(profil);
        } else {
            $this->Model_profile->update_password($confirm);
            $this->session->set_flashdata('kode_name', 'success');
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Pasword Berhasil Diubah. </div>');
            redirect('profil');
        }
    }



}
