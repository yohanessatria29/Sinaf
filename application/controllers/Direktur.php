<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Direktur extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Model_sina');
		$this->load->model('Model_viewdata');
		$this->load->model('Model_direktur');
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
			if ($session_kriteria == 9) {
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
					'content' => 'user_direktur',
					'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
					'data' => $this->Model_direktur->select_pengajuan_search($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes, $status_verifikasi_id),
					'session_lpa' => $session_lpa,
					'propinsi' => $propinsi,
					'kota' => $kota,
					'jenis_fasyankes' => $jenis_fasyankes,
					'tanggal_awal' => $tanggal_awal,
					'tanggal_akhir' => $tanggal_akhir,
					'lpa_id' => $lpa_id,
					'status_verifikasi_id' => $status_verifikasi_id

				);
				// var_dump($data);
				$this->load->view('user_direktur', $data);
			}
		}
	}

	public function direktur()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');

		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$this->load->view('direktur');
		}
	}


	public function setuju()
	{

		$this->load->helper('security');
		$post = $this->security->xss_clean($this->input->post());
		$this->load->library('form_validation');
		$id = $this->uri->segment(3);

		$data = array(

			'persetujuan_ketua_id' => $id,
			'status_direktur' => 1
		);


		if ($this->Model_sina->input_data('persetujuan_direktur', $data)) {
			echo '1';
		} else {
			echo '2';
		}




		// var_dump($data);

		// $this->session->set_flashdata('kode_name', 'success');
		// $this->session->set_flashdata('icon_name', 'check');
		// $this->session->set_flashdata('message_name', 'Sukses Input Data!');

		// redirect('direktur');

	}

	public function tolak()
	{
		$this->load->helper('security');
		$this->load->library('form_validation');
		$post = $this->security->xss_clean($this->input->post());

		$id = $this->uri->segment(3);

		$data = array(

			'persetujuan_ketua_id' => $post['id_pengajuan'],
			'catatan_direktur' => $post['catatan_direktur'],
			'status_direktur' => 0
		);

		$test = $this->Model_sina->input_data('persetujuan_direktur', $data);
		// var_dump($test);
		if ($this->Model_sina->input_data('persetujuan_direktur', $data) == true) {
			echo '1';
		} else {
			echo '2';
		}

		$this->Model_sina->input_data('persetujuan_direktur', $data);

		// $this->session->set_flashdata('kode_name', 'success');
		// $this->session->set_flashdata('icon_name', 'check');
		// $this->session->set_flashdata('message_name', 'Sukses Input Data!');

		redirect('direktur');
	}
}
