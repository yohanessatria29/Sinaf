<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forgot_password extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        // $this->load->library('encrypt');
        $this->load->library('encryption');
    }

    public function index()
    {
        $this->load->view('lupa_password');
    }

    public function send_mail()
    {
        // $this->load->library('encrypt');
        $this->load->library('encryption');
        // CHECK EMAIL TERDAFTAR ATAU TIDAK
        // $email = $this->input->post('emailrecover');
        $email = str_replace("'", "", htmlspecialchars($this->input->post('emailrecover'), ENT_QUOTES));
        // echo $email;
        $this->load->model('Model_user');
        $check = $this->Model_user->checkemailrecover($email);
        $valid = $check->num_rows();
        // CHECK EMAIL TERDAFTAR ATAU TIDAK
        if ($valid > 0) {
            $this->load->helper('date');
            $this->load->helper('security');
            date_default_timezone_set("Asia/Jakarta");
            $datauser = $check->result_array();
            $id = $datauser[0]['id'];
            $idencrypt = encrypt_url($id);
            $dateencrypt = encrypt_url(date("Y-m-d"));
            $jam = encrypt_url(date("H:i:s"));
            $namapengguna = $datauser[0]['nama'];
            $ip = $this->input->ip_address();
            $date = date("d M Y") . ', pukul ' . date("H:i:s");
            $subject = 'Sistem Informasi Akreditasi Non RS';
            $message = '<html><body>';
            $message .= '<h4>Hallo, ' . $namapengguna . '.</h4>';
            $message .= '<p>Anda telah melakukan permintaan reset password pada tanggal, ' . $date . ' melalui IP ' . $ip . ' .</p>';
            $message .= '<p>Silahkan klik link dibawah ini untuk melanjutkan proses reset password.</p>';
            $message .= '<a href="' . base_url('Forgot_password/recoveraccount/') . $idencrypt . '/' . $dateencrypt . '/' . $jam . '">Reset Password</a><br><br>';
            $message .= '<b>===============================================================</b> <br> <br>';
            $message .= '<p>Apabila anda tidak melakukan perubahan ini mohon hubungi site administrator.</p>';
            $message .= '<p>Terima kasih atas perhatiannya.</p>';
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
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->set_newline("\r\n");
            $send = $this->email->send();
            $send = $this->email->send();
            if ($send) {
                $this->session->set_flashdata('success', 'Email Berhasil Di Kirim.');
                redirect(base_url('Forgot_password'));
            } else {
                // Debugging output
                echo $this->email->print_debugger();
                $this->session->set_flashdata('warning', 'Gagal Mengirim Email.');
                // redirect(base_url('Forgot_password'));
            }
        } else {
            $this->session->set_flashdata('warning', 'Email Tidak Terdaftar.');
            redirect(base_url('Forgot_password'));
        }
    }

    public function recoveraccount()
    {
        // $this->load->library('encrypt');
        $this->load->library('encryption');
        $this->load->helper('security');
        $this->load->helper('date');
        $this->load->model('Model_user');
        date_default_timezone_set("Asia/Jakarta");
        $iddecrypt['idpengguna'] = decrypt_url($this->uri->segment(3));
        $tanggalpengajuan = decrypt_url($this->uri->segment(4));
        $jampengajuan = decrypt_url($this->uri->segment(5));
        $pengajuan = $tanggalpengajuan . ' ' . $jampengajuan;
        $datetimepengajuan = strtotime($pengajuan);
        // $tanggalrecover = strtotime(decrypt_url($this->uri->segment(4)));
        // $tanggalhariini = strtotime(date("d/m/Y"));
        $datapengguna = $this->Model_user->getpenggunamodified($iddecrypt['idpengguna'])->result_array();
        $datamodified = $datapengguna[0]['modified_at'];
        $datetimedb = strtotime($datamodified);
        // var_dump($datapengguna)  ;
        // echo $datetimedb;
        // echo '|';
        // echo $datetimepengajuan;
        if ($datetimepengajuan > $datetimedb) {
            // echo 'belum update';
            $data['url'] = $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5);
            // $this->load->view('templates/header');
            $this->load->view('recover_account', $data);
            // $this->load->view('templates/footer');
        } else {
            // echo 'sudah update';
            redirect('Login');
        }
        // if ($tanggalrecover == $tanggalhariini) {
        //     // echo 'sesuai';
        //     $data['url'] = $this->uri->segment(3) . '/' . $this->uri->segment(4);
        //     // $this->load->view('templates/header');
        //     $this->load->view('login/recover_account', $data);
        //     // $this->load->view('templates/footer');
        // } else {
        //     redirect('Login');
        // }
    }

    public function changepassword()
    {
        // $this->load->library('encrypt');
        $this->load->library('encryption');
        $this->load->helper('security');
        $password1 = $this->input->post('newpasswordfirst');
        $salt      = '1m_@_SaLT_f0R_4kreD!t4$i';
        $hashed1    = hash('sha256', $password1 . $salt);
        $password2 = $this->input->post('newpasswordsecond');
        $salt      = '1m_@_SaLT_f0R_4kreD!t4$i';
        $hashed2    = hash('sha256', $password2 . $salt);
        $idpengguna =  decrypt_url($this->uri->segment(3));

        if ($hashed1 == $hashed2) {
            // echo 'sama';
            // echo $hashed1;
            $this->load->model('Model_user');
            $data = array(
                'password_enkripsi' => $hashed1,
                'password' => $password1

            );
            $test = $this->Model_user->updatepassword($idpengguna, $data);
            //    var_dump($test);
            echo "
            <script> 
                alert('Password Berhasil diganti.');  
                window.location = '../../Login';
            </script>
            ";
            // redirect(base_url('Login'));
        } else {
            $URL = $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5);
            echo $URL;
            $this->session->set_flashdata('warning', 'Password Tidak Sama.');
            redirect(base_url('Forgot_password/recoveraccount/') . $URL);
        }
    }
}
