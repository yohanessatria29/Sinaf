<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Binwas extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Model_sina');
		$this->load->model('Model_viewdata');
		$this->load->model('Model_binwas');
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
		if($this->session->userdata('logged') !=TRUE){
			redirect('login/logout');
		} else {
			$session_kriteria = $this->session->userdata('kriteria_id');
			if($session_kriteria == 10){
				$session_lpa = $this->session->userdata('lpa_id');

				$post = $this->input->post();
				$tanggal_awal = !empty($post['tanggal_awal']) ? $post['tanggal_awal'] : null;
				$tanggal_akhir = !empty($post['tanggal_akhir']) ? $post['tanggal_akhir'] : null;
				$propinsi = !empty($post['propinsi']) ? $post['propinsi'] : null;
				$kota = !empty($post['kota']) ? $post['kota'] : null;
				$jenis_fasyankes = !empty($post['jenis_fasyankes']) ? $post['jenis_fasyankes'] : null;
				$lpa_id = !empty($post['lpa_id']) ? $post['lpa_id'] : null;
				$status_verifikasi_id = !empty($post['status_verifikasi_id']) ? $post['status_verifikasi_id'] : null;
				
				$data = array('content' =>'user_binwas',
						'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
						'data' => $this->Model_binwas->select_pengajuan_search($lpa_id,$tanggal_awal,$tanggal_akhir,$propinsi,$kota,$jenis_fasyankes,$status_verifikasi_id),
						'session_lpa' => $session_lpa,
						'propinsi'=> $propinsi,
						'kota'=> $kota,
						'jenis_fasyankes'=> $jenis_fasyankes,
						'tanggal_awal'=> $tanggal_awal,
						'tanggal_akhir'=> $tanggal_akhir,
						'lpa_id'=>$lpa_id,
						'status_verifikasi_id'=>$status_verifikasi_id

							);
				$this->load->view('user_binwas',$data);
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
			$this->load->view('detail_binwas');
		}
		
	}










	public function binwas()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');

		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$this->load->view('binwas');
		}
		
	}
	public function listBinwas()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');

		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$session_kriteria = $this->session->userdata('kriteria_id');
			if ($session_kriteria == 10) {
				$session_lpa = $this->session->userdata('lpa_id');

				$post = $this->input->post();
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

				$this->load->view('user_binwas', $data);
				//$this->load->view('ketualpa/layout/navtabs');
				// $this->load->view('ketualpa/rekomendasi', $data);
				// $this->load->view('ketualpa/layout/footer');
			}
		}
	}

	public function elemen_penilaian_verifikator()
	{
		$session_lpa = $this->session->userdata('lpa_id');
		$post = $this->input->post();

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
		$post = $this->input->post();
		if (!empty($post['bab'])) {
			$bab = $post['bab'];
		} else {
			$bab = null;
		}
		$id = $this->uri->segment(3);
		
		$data_pengajuan = $this->Model_sina->select_pengajuan($id);
		$surveior = $this->Model_sina->select_surveior_kesepakatan($id);
		$data_select_pengajuan = $this->Model_sina->select_pengajuan($id);
		$detail_pengajuan = $this->Model_sina->detail_pengajuan_survei($id);
		$surveior_lapangan = $this->Model_sina->getdatalapangan($data_pengajuan[0]['penetapan_tanggal_survei_id']);
                $narahubung = $this->Model_sina->getDataNarahubung($data_pengajuan[0]['fasyankes_id']);
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
        $datasurveiorlapangan = $this->Model_sina->getsurveiorlapangan($data_pengajuan[0]['penetapan_tanggal_survei_id']);
		
		$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);

		$trans = array_column($trans, null, "elemen_penilaian_id");
		// var_dump($this->session->userdata());
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
			// echo 'test';
		} else {
			$session_kriteria = $this->session->userdata('kriteria_id');
			$session_lpa = $this->session->userdata('lpa_id');
			if ($session_kriteria == 10) {
				$id = $this->uri->segment(3);
				$pengajuan = $this->Model_sina->select_pengajuan($id);
				$puskesmas = $this->Model_sina->get_puskesmas($pengajuan[0]['fasyankes_id']);
				$data = array(
					'content' => 'pengajuan_usulan_survei',
					'data' => $pengajuan,
					'puskesmas' => $puskesmas,
					'lpa_id' => $session_lpa,
					'surveior' => $surveior,
					'detail_pengajuan' => $detail_pengajuan,
					'surveior_lapangan' => $surveior_lapangan,
                    'narahubung' => $narahubung,
                    'data_surveior_lapangan' => $datasurveiorlapangan,
					'datab' => $this->Model_sina->select_ep($bab, $data_pengajuan[0]['jenis_fasyankes']),
					'trans' => $trans,
					'count_trans' => $this->Model_sina->select_count_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id'],$data_pengajuan[0]['jenis_fasyankes']),
					'bab' => $bab,
					'id' => $id
				);
				// $this->load->view('ketualpa/detail', $data);
				// echo "tes";
				$this->load->view('detail_binwas', $data);
			}else{
				redirect('binwas');
			}
		}
	}


}
