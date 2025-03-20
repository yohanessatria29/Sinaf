<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'test';
        $this->load->view('email/activeuser', $data);
    }

    public function useractive()
    {
        $this->load->helper('date');
        date_default_timezone_set("Asia/Jakarta");
        $data = $this->session->flashdata('datapengguna');
        // $namapengguna = $data['nama'];
        // $emailpengguna = $data['email'];
        // $notelp = $data['no_telp'];
        $emailpengguna = 'nasrul27fata@gmail.com';
        // $emailpengguna = 'muhamad.nfata@kemkes.go.id';
        $namapengguna = 'Nasrul';
        $notelp = '082347465862';

        $subject = 'Akreditasi Fasyankes ACCOUNT';

        // Compose a simple HTML email message
        $message = '<html><body>';
        $message .= '<h4>Hallo, ' . $namapengguna . '!</h4>';
        $message .= '<p>Account Verifikator Lembaga anda telah di validasi, </p>';
        $message .= '<p>Silahkan login pada halaman website : http://perizinan.yankes.kemkes.go.id/sina .</p>';
        $message .= '<p>Menggunakan password : 12345 </p>';
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
            echo $send;
            // redirect('pengajuan/verifikator');

            // WHATSAPP


            // $curl = curl_init();

            // curl_setopt_array($curl, array(
            //     CURLOPT_URL => 'http://192.168.48.124:8000/send-message',
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => '',
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 0,
            //     CURLOPT_FOLLOWLOCATION => true,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => 'POST',
            //     CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo%2C%20' . $namapengguna .
            //         '!%2C%20Account%20Akreitasi%20Fasyankes%20anda%20telah%20di%20validasi%2C%20Silahkan%20login%20pada%20halaman%20website%20%3A%20http%3A%2F%2Fperizinan.yankes.kemkes.go.id%2Fsina%2F%20.%20%0AMenggunakan%20password%20%3A%2012345%20%20%20%20%20%0A%7C%7C%20If%20you%20need%20help%2C%20please%20contact%20the%20site%20administrator.',
            //     CURLOPT_HTTPHEADER => array(
            //         'Content-Type: application/x-www-form-urlencoded'
            //     ),
            // ));

            // $response = curl_exec($curl);

            // curl_close($curl);
            // $res = json_decode($response, true);
            // // echo $response;
            // if ($res['status'] == TRUE) {
            //     echo '1';
            // } else {
            //     echo $response;
            // }


            // WHATSAPP


        } else {
            show_error($this->email->print_debugger());
        }
    }
    public function useractivesurveior()
    {
        $this->load->helper('date');
        date_default_timezone_set("Asia/Jakarta");
        $data = $this->session->flashdata('datapengguna');
        // $namapengguna = $data['nama'];
        // $emailpengguna = $data['email'];
        // $notelp = $data['no_telp'];
        $emailpengguna = 'nasrul27fata@gmail.com';
        $namapengguna = 'Nasrul';
        $notelp = '082347465862';

        $subject = 'Akreditasi Fasyankes ACCOUNT';

        // Compose a simple HTML email message
        $message = '<html><body>';
        $message .= '<h4>Hallo, ' . $namapengguna . '!</h4>';
        $message .= '<p>Account Verifikator Lembaga anda telah di validasi, </p>';
        $message .= '<p>Silahkan login pada halaman website : http://perizinan.yankes.kemkes.go.id/sina .</p>';
        $message .= '<p>Menggunakan password : 12345 </p>';
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
            redirect('pengajuan/surveior');

            // WHATSAPP


            // $curl = curl_init();

            // curl_setopt_array($curl, array(
            //     CURLOPT_URL => 'http://192.168.48.124:8000/send-message',
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => '',
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 0,
            //     CURLOPT_FOLLOWLOCATION => true,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => 'POST',
            //     CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo%2C%20' . $namapengguna .
            //         '!%2C%20Account%20Akreitasi%20Fasyankes%20anda%20telah%20di%20validasi%2C%20Silahkan%20login%20pada%20halaman%20website%20%3A%20http%3A%2F%2Fperizinan.yankes.kemkes.go.id%2Fsina%2F%20.%20%0AMenggunakan%20password%20%3A%2012345%20%20%20%20%20%0A%7C%7C%20If%20you%20need%20help%2C%20please%20contact%20the%20site%20administrator.',
            //     CURLOPT_HTTPHEADER => array(
            //         'Content-Type: application/x-www-form-urlencoded'
            //     ),
            // ));

            // $response = curl_exec($curl);

            // curl_close($curl);
            // $res = json_decode($response, true);
            // // echo $response;
            // if ($res['status'] == TRUE) {
            //     echo '1';
            // } else {
            //     echo $response;
            // }


            // WHATSAPP


        } else {
            show_error($this->email->print_debugger());
        }
    }
}
