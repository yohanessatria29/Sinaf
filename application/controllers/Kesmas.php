<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kesmas extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Model_sina');
		$this->load->model('Model_viewdata');
		$this->load->model('Model_kesmas');
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
			if ($session_kriteria == 11) {
				$session_lpa = $this->session->userdata('lpa_id');
				$post = $this->security->xss_clean($this->input->post());

				$data = array(
					'content' => 'user_kesmas',
					// 'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
					// 'dataapi'=>$this->Model_kesmas->getAllAkreditasi($jenis_fasyankes,$nama_fasyankes,$propinsi,$kota),
					'datasurveior' => $this->Model_kesmas->getSurveior()
					// 'data' => $this->Model_kesmas->select_pengajuan_search($lpa_id,$tanggal_awal,$tanggal_akhir,$propinsi,$kota,$jenis_fasyankes,$status_verifikasi_id),
				);
				$this->load->view('user_kesmas', $data);
			}
		}
	}
	public function list()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->library('pagination');
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$session_kriteria = $this->session->userdata('kriteria_id');
			if ($session_kriteria == 11) {
				$session_lpa = $this->session->userdata('lpa_id');
				$post = $this->security->xss_clean($this->input->post());
				$tanggal_awal = !empty($post['tanggal_awal']) ? $post['tanggal_awal'] : null;
				$tanggal_akhir = !empty($post['tanggal_akhir']) ? $post['tanggal_akhir'] : null;
				$propinsi = !empty($post['propinsi']) ? $post['propinsi'] : null;
				$kota = !empty($post['kota']) ? $post['kota'] : null;
				$jenis_fasyankes = !empty($post['jenis_fasyankes']) ? $post['jenis_fasyankes'] : null;
				$nama_fasyankes = !empty($post['nama_fasyankes']) ? $post['nama_fasyankes'] : null;
				$lpa_id = !empty($post['lpa_id']) ? $post['lpa_id'] : null;
				$status_verifikasi_id = !empty($post['status_verifikasi_id']) ? $post['status_verifikasi_id'] : null;
				$config['per_page'] = 10;
				$page = $this->pagination->initialize($config);

				$data = array(
					'content' => 'user_kesmas',
					// 'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
					'dataapi' => $this->Model_kesmas->getAllAkreditasi($jenis_fasyankes, $nama_fasyankes, $propinsi, $kota),
					'datasurveior' => $this->Model_kesmas->getSurveior()

				);
				$this->load->view('user_kesmas', $data);
			}
		}
	}

	public function tes()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');

		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {

			$session_kriteria = $this->session->userdata('kriteria_id');
			if ($session_kriteria == 11) {
				$session_lpa = $this->session->userdata('lpa_id');
				$post = $this->security->xss_clean($this->input->post());
				$tanggal_awal = !empty($post['tanggal_awal']) ? $post['tanggal_awal'] : null;
				$tanggal_akhir = !empty($post['tanggal_akhir']) ? $post['tanggal_akhir'] : null;
				$propinsi = !empty($post['propinsi']) ? $post['propinsi'] : null;
				$kota = !empty($post['kota']) ? $post['kota'] : null;
				$jenis_fasyankes = !empty($post['jenis_fasyankes']) ? $post['jenis_fasyankes'] : null;
				$nama_fasyankes = !empty($post['nama_fasyankes']) ? $post['nama_fasyankes'] : null;
				$lpa_id = !empty($post['lpa_id']) ? $post['lpa_id'] : null;
				$status_verifikasi_id = !empty($post['status_verifikasi_id']) ? $post['status_verifikasi_id'] : null;
				$page = !empty($post['page']) ? $post['page'] : null;

				$data = array(
					'content' => 'user_kesmas_tes',
					// 'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
					'dataapi' => $this->Model_kesmas->getAll($jenis_fasyankes, $nama_fasyankes, $propinsi, $kota),
					// 'data' => $this->Model_kesmas->select_pengajuan_search($lpa_id,$tanggal_awal,$tanggal_akhir,$propinsi,$kota,$jenis_fasyankes,$status_verifikasi_id),
					'session_lpa' => $session_lpa,
					'propinsi' => $propinsi,
					'kota' => $kota,
					'jenis_fasyankes' => $jenis_fasyankes,
					'tanggal_awal' => $tanggal_awal,
					'tanggal_akhir' => $tanggal_akhir,
					'lpa_id' => $lpa_id,
					'status_verifikasi_id' => $status_verifikasi_id

				);
				$this->load->view('user_kesmas_tes', $data);
			}
		}
	}





	public function listKesmas()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');

		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$session_kriteria = $this->session->userdata('kriteria_id');
			if ($session_kriteria == 11) {
				$this->load->view('tes');
			}
		}
	}

	function listKesmast()
	{ {
			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://api-dev.dto.kemkes.go.id/dev-portal-api/external/auth',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => '{
				"email": "dfoyankes@yopmail.com",
				"password": "soulAdmin@27128"
			}',
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json'
				),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			echo json_encode($response);
		}
		// $post = $this->input->post();


		// 					$data = array('content' =>'tes',
		// 							// 'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
		// 							// 'dataapi'=>$this->Model_kesmas->getAllAkreditasi($jenis_fasyankes,$nama_fasyankes,$propinsi,$kota),
		// 							'data'=>$response
		// 							// 'data' => $this->Model_kesmas->select_pengajuan_search($lpa_id,$tanggal_awal,$tanggal_akhir,$propinsi,$kota,$jenis_fasyankes,$status_verifikasi_id),
		// 							);
		// 			$this->load->view('tes',$data);
		// $this->load->view('tes');

		// 	}
		// }
	}
}
