<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ketua extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Model_sina');
		$this->load->model('Model_viewdata');
		$this->load->model('Model_ketuatim');
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
			if ($session_kriteria == 8) {
				$session_lpa = $this->session->userdata('lpa_id');

				$post = $this->security->xss_clean($this->input->post());
				$tanggal_awal = !empty($post['tanggal_awal']) ? $post['tanggal_awal'] : null;
				$tanggal_akhir = !empty($post['tanggal_akhir']) ? $post['tanggal_akhir'] : null;
				$propinsi = !empty($post['propinsi']) ? $post['propinsi'] : null;
				$kota = !empty($post['kota']) ? $post['kota'] : null;
				$jenis_fasyankes = !empty($post['jenis_fasyankes']) ? $post['jenis_fasyankes'] : null;
				$jenis_klinik = !empty($post['jenis_klinik']) ? $post['jenis_klinik'] : null;
				$jenis_lab = !empty($post['jenis_labkes']) ? $post['jenis_labkes'] : null;
				$lpa_id = !empty($post['lpa_id']) ? $post['lpa_id'] : null;
				$status_verifikasi_id = !empty($post['status_verifikasi_id']) ? $post['status_verifikasi_id'] : null;

				$data = array(
					'content' => 'user_ketuatim',
					'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
					'data' => $this->Model_ketuatim->select_pengajuan_search($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes, $jenis_klinik, $jenis_lab, $status_verifikasi_id),
					'session_lpa' => $session_lpa,
					'propinsi' => $propinsi,
					'kota' => $kota,
					'jenis_fasyankes' => $jenis_fasyankes,
					'tanggal_awal' => $tanggal_awal,
					'tanggal_akhir' => $tanggal_akhir,
					'lpa_id' => $lpa_id,
					'jenis_klinik' => $jenis_klinik,
					'jenis_labkes' => $jenis_lab,
					'status_verifikasi_id' => $status_verifikasi_id

				);
				$this->load->view('user_ketuatim', $data);
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
			$this->load->view('detail_ketuatim');
		}
	}










	public function ketuatim()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');

		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$this->load->view('ketuatim');
		}
	}
	public function listKetuatim()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');

		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$session_kriteria = $this->session->userdata('kriteria_id');
			if ($session_kriteria == 8) {
				$session_lpa = $this->session->userdata('lpa_id');
				$post = $this->security->xss_clean($this->input->post());
				$tanggal_awal = !empty($post['tanggal_awal']) ? $post['tanggal_awal'] : null;
				$tanggal_akhir = !empty($post['tanggal_akhir']) ? $post['tanggal_akhir'] : null;
				$propinsi = !empty($post['propinsi']) ? $post['propinsi'] : null;
				$kota = !empty($post['kota']) ? $post['kota'] : null;
				$jenis_fasyankes = !empty($post['jenis_fasyankes']) ? $post['jenis_fasyankes'] : null;
				$status_verifikasi_id = !empty($post['status_verifikasi_id']) ? $post['status_verifikasi_id'] : null;
				$selected_data = $tanggal_awal != null || $tanggal_akhir != null || $propinsi != null || $kota != null || $jenis_fasyankes != null || $status_verifikasi_id != null ? $this->Model_ketua->select_pengajuan_search($session_lpa, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes, $status_verifikasi_id) : array();

				$data = array(
					'title'						=> 'Rekomendasi Status Akreditasi',
					'content' 					=> 'view_pengajuan_usulan_survei',
					'data' 						=> $selected_data,
					'session_lpa'				=> $session_lpa,
					'propinsi'					=> $propinsi,
					'kota'						=> $kota,
					'jenis_fasyankes'			=> $jenis_fasyankes,
					'tanggal_awal'				=> $tanggal_awal,
					'tanggal_akhir'				=> $tanggal_akhir,
					'status_verifikasi_id'		=> $status_verifikasi_id
				);

				$this->load->view('user_ketuatim', $data);
				//$this->load->view('ketualpa/layout/navtabs');
				// $this->load->view('ketualpa/rekomendasi', $data);
				// $this->load->view('ketualpa/layout/footer');
			}
		}
	}

	public function elemen_penilaian_verifikator()
	{
		$this->load->helper('security');
		$post = $this->security->xss_clean($this->input->post());
		$session_lpa = $this->session->userdata('lpa_id');

		$bab = !empty($post['bab']) ? $post['bab'] : null;
		$data_ep = array();

		$data = array(
			'title'			=> 'Elemen Penilaian Verifikator',
			'session_lpa'	=> $session_lpa,
			'data_ep'		=> $data_ep,
			'bab'			=> $bab
		);

		$this->load->view('ketualpa/layout/header', $data);
		//$this->load->view('ketualpa/layout/navtabs');
		$this->load->view('ketualpa/elemen_penilaian', $data);
		$this->load->view('ketualpa/layout/footer');
	}

	public function penugasan_verifikator()
	{
		$session_lpa = $this->session->userdata('lpa_id');

		$data = array(
			'title'				=> 'Penugasan Verifikator',
			'session_lpa'		=> $session_lpa
		);

		$this->load->view('ketualpa/layout/header', $data);
		//$this->load->view('ketualpa/layout/navtabs');
		$this->load->view('ketualpa/penugasan', $data);
		$this->load->view('ketualpa/layout/footer');
	}

	public function persentase_capaian_verifikator()
	{
		$session_lpa = $this->session->userdata('lpa_id');
		$data_pc = array();

		$data = array(
			'title'			=> 'Persentase Capaian Verifikator',
			'session_lpa'	=> $session_lpa,
			'data_pc'		=> $data_pc
		);

		$this->load->view('ketualpa/layout/header', $data);
		//$this->load->view('ketualpa/layout/navtabs');
		$this->load->view('ketualpa/persentase_capaian', $data);
		$this->load->view('ketualpa/layout/footer');
	}


	// public function detail()
	// {
	// 	$this->load->library('form_validation');
	// 	$this->load->helper('security');
	// 	$post = $this->input->post();
	// 	if (!empty($post['bab'])) {
	// 		$bab = $post['bab'];
	// 	} else {
	// 		$bab = null;
	// 	}
	// 	$id = $this->uri->segment(3);

	// 	$data_pengajuan = $this->Model_sina->select_pengajuan($id);

	// 	$data_select_pengajuan = $this->Model_sina->select_pengajuan($id);

	// 	$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);

	// 	$trans = array_column($trans, null, "elemen_penilaian_id");

	// 	if ($this->session->userdata('logged') != TRUE) {
	// 		redirect('login/logout');
	// 	} else {
	// 		$session_kriteria = $this->session->userdata('kriteria_id');
	// 		$session_lpa = $this->session->userdata('lpa_id');
	// 		if ($session_kriteria == 5) {
	// 			$id = $this->uri->segment(3);
	// 			$pengajuan = $this->Model_sina->select_pengajuan($id);
	// 			$puskesmas = $this->Model_sina->get_puskesmas($pengajuan[0]['fasyankes_id']);
	// 			$data = array(
	// 				'content' => 'pengajuan_usulan_survei',
	// 				'data' => $pengajuan,
	// 				'puskesmas' => $puskesmas,
	// 				'lpa_id' => $session_lpa,
	// 				'datab' => $this->Model_sina->select_ep($bab, $data_pengajuan[0]['jenis_fasyankes']),
	// 				'trans' => $trans,
	// 				'count_trans' => $this->Model_sina->select_count_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id'],$data_pengajuan[0]['jenis_fasyankes']),
	// 				'bab' => $bab,
	// 				'id' => $id
	// 			);
	// 			// $this->load->view('ketualpa/detail', $data);
	// 			$this->load->view('detail_ketuatim', $data);
	// 		}
	// 	}
	// }

	public function detail()
	{
		// echo "tes";
		$this->load->library('form_validation');
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

		$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);

		$trans = array_column($trans, null, "elemen_penilaian_id");
		// var_dump($this->session->userdata());
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
			// echo 'test';
		} else {
			$session_kriteria = $this->session->userdata('kriteria_id');
			$session_lpa = $this->session->userdata('lpa_id');
			if ($session_kriteria == 8) {
				$id = $this->uri->segment(3);
				$pengajuan = $this->Model_ketuatim->select_pengajuan($id);
				$puskesmas = $this->Model_sina->get_puskesmas($pengajuan[0]['fasyankes_id']);
				$data = array(
					'content' => 'pengajuan_usulan_survei',
					'data' => $pengajuan,
					'puskesmas' => $puskesmas,
					'lpa_id' => $session_lpa,
					'datab' => $this->Model_sina->select_ep($bab, $data_pengajuan[0]['jenis_fasyankes']),
					'trans' => $trans,
					'count_trans' => $this->Model_sina->select_count_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id'], $data_pengajuan[0]['jenis_fasyankes']),
					'bab' => $bab,
					'id' => $id
				);
				// $this->load->view('ketualpa/detail', $data);
				// echo "tes";
				$this->load->view('detail_ketuatim', $data);
			} else {
				redirect('ketua');
			}
		}
	}

	public function simpanPersetujuan()
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

		//Upload 
		// if (!empty($_FILES['url_surat_rekomendasi_status']['name'])) {
		// 	$this->load->library('upload', $config);
		// 	if (!$this->upload->do_upload('url_surat_rekomendasi_status')) {
		// 		print_r($this->upload->display_errors());
		// 		exit;
		// 	}
		// 	$attachment = $this->upload->data();
		// 	$fileName = $attachment['file_name'];

		// 	//$foto_bukti_survei =  $url.$fileName;
		// 	$url_surat_rekomendasi_status =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
		// } else {
		// 	if (isset($post['old_url_surat_rekomendasi_status'])) {
		// 		$url_surat_rekomendasi_status = $post['old_url_surat_rekomendasi_status'];
		// 	} else {
		// 		$url_surat_rekomendasi_status = '';
		// 	}
		// }

		$datas = array(

			'pengiriman_rekomendasi_id' => $post['pengiriman_rekomendasi_id'],
			'status_rekomendasi_id' => $post['status_rekomendasi_id'],
			'catatan_ketua' => $post['catatan_ketua'],
			'status_persetujuan' => $post['status_persetujuan'],
			'catatan_terima' => $post['catatan_terima'],
			'catatan_tolak' => $post['catatan_tolak']
		);

		// $where2 = array(
		// 	'status_rekomendasi_id' => $post["status_rekomendasi_id"]
		// );
		// $this->Model_sina->delete_data('persetujuan_ketua', $where2);

		$this->Model_sina->input_data('persetujuan_ketua', $datas);

		$this->session->set_flashdata('kode_name', 'success');
		$this->session->set_flashdata('icon_name', 'check');
		$this->session->set_flashdata('message_name', 'Sukses Input Data!');

		redirect('ketua/detail/' . $post['id_pengajuan']);
	}

	public function simpanRekomendasi()
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

		//Upload 
		// if (!empty($_FILES['url_surat_rekomendasi_status']['name'])) {
		// 	$this->load->library('upload', $config);
		// 	if (!$this->upload->do_upload('url_surat_rekomendasi_status')) {
		// 		print_r($this->upload->display_errors());
		// 		exit;
		// 	}
		// 	$attachment = $this->upload->data();
		// 	$fileName = $attachment['file_name'];

		// 	//$foto_bukti_survei =  $url.$fileName;
		// 	$url_surat_rekomendasi_status =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
		// } else {
		// 	if (isset($post['old_url_surat_rekomendasi_status'])) {
		// 		$url_surat_rekomendasi_status = $post['old_url_surat_rekomendasi_status'];
		// 	} else {
		// 		$url_surat_rekomendasi_status = '';
		// 	}
		// }

		$datas = array(

			'status_rekomendasi_id' => $post['status_rekomendasi_id'],
			'url_surat_rekomendasi_status' => $post['url_surat_rekomendasi_status'],
			'trans_final_ep_verifikator_id' => $post['trans_final_ep_verifikator_id']
		);

		$where2 = array(
			'trans_final_ep_verifikator_id' => $post["trans_final_ep_verifikator_id"]
		);
		$this->Model_sina->delete_data('pengiriman_rekomendasi', $where2);

		$this->Model_sina->input_data('pengiriman_rekomendasi', $datas);

		$this->session->set_flashdata('kode_name', 'success');
		$this->session->set_flashdata('icon_name', 'check');
		$this->session->set_flashdata('message_name', 'Sukses Input Data!');

		redirect('admin/detail/' . $post['id_pengajuan']);
	}
}
