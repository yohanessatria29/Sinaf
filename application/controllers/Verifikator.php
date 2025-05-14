<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikator extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('Model_sina');
		$this->load->model('Model_viewdata');
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
			if ($session_kriteria == 4) {
				$post = $this->security->xss_clean($this->input->post());
				$session_lpa = $this->session->userdata('lpa_id');
				$session_id = $this->session->userdata('id');

				$tanggal_awal = !empty($post['tanggal_awal']) ? $post['tanggal_awal'] : null;
				$tanggal_akhir = !empty($post['tanggal_akhir']) ? $post['tanggal_akhir'] : null;
				$propinsi = !empty($post['propinsi']) ? $post['propinsi'] : null;
				$kota = !empty($post['kota']) ? $post['kota'] : null;
				$jenis_fasyankes = !empty($post['jenis_fasyankes']) ? $post['jenis_fasyankes'] : null;
				$status_verifikasi_id = !empty($post['status_verifikasi_id']) ? $post['status_verifikasi_id'] : null;

				$data = array(
					'content' => 'user_verifikator',
					'data' => $this->Model_viewdata->select_penilaian_verifikator($session_lpa, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes, $session_id, $status_verifikasi_id),
					'propinsi' => $propinsi,
					'kota' => $kota,
					'jenis_fasyankes' => $jenis_fasyankes,
					'tanggal_awal' => $tanggal_awal,
					'tanggal_akhir' => $tanggal_akhir,
					'session_id' => $session_id,
					'session_lpa' => $session_lpa,
					'status_verifikasi_id' => $status_verifikasi_id
				);
				$this->load->view('user_verifikator', $data);
			}
		}
	}
	public function epverifikator()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$post = $this->security->xss_clean($this->input->post());
			if (!empty($post['bab'])) {
				$bab = $post['bab'];
			} else {
				$bab = null;
			}
			$id = $this->uri->segment(3);

			$data_pengajuan = $this->Model_sina->select_pengajuan($id);

			$data_select_pengajuan = $this->Model_sina->select_pengajuan($id);

			if ($data_pengajuan[0]['jenis_survei_id'] == 2) {
				// $trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
				// $trans = array_column($trans, null, "elemen_penilaian_id");
				// if(!empty($trans)){

				// 	$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
				// 	$trans = array_column($trans, null, "elemen_penilaian_id");	

				// } else {
				$data_select_pengajuan_lama = $this->Model_sina->select_pengajuan($data_pengajuan[0]['pengajuan_usulan_survei_id_lama']);
				$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan_lama[0]['penetapan_tanggal_survei_id']);
				$trans = array_column($trans, null, "elemen_penilaian_id");
				// }
				$trans_check = $this->Model_sina->select_trans_ep_check($data_select_pengajuan[0]['penetapan_tanggal_survei_id'], $bab);
				if (!empty($trans_check[0]['skor_capaian_verifikator'])) {
					$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
					$trans = array_column($trans, null, "elemen_penilaian_id");
				}
			} else {
				if ($data_pengajuan[0]['jenis_akreditasi_id'] == 3) {
					$data_select_pengajuan_lama = $this->Model_sina->select_pengajuan($data_pengajuan[0]['pengajuan_usulan_survei_id_lama']);
					$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan_lama[0]['penetapan_tanggal_survei_id']);
					$trans = array_column($trans, null, "elemen_penilaian_id");
					// }
					$trans_check = $this->Model_sina->select_trans_ep_check($data_select_pengajuan[0]['penetapan_tanggal_survei_id'], $bab);
					if (!empty($trans_check[0]['skor_capaian_verifikator'])) {
						$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
						$trans = array_column($trans, null, "elemen_penilaian_id");
					}
				} else {
					$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
					$trans = array_column($trans, null, "elemen_penilaian_id");
				}
			}

			$trans2 = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
			$trans2 = array_column($trans2, null, "elemen_penilaian_id");

			$data = array(
				'content' => 'elemen_penilaian_surveior',
				'data' => $data_select_pengajuan,
				'datab' => $this->Model_sina->select_ep($bab, $data_pengajuan[0]['jenis_fasyankes']),
				'trans' => $trans,
				'trans2' => $trans2,
				'count_trans' => $this->Model_sina->select_count_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id'], $data_pengajuan[0]['jenis_fasyankes']),
				'rows_bab' => $this->Model_sina->count_rows_bab($data_pengajuan[0]['jenis_fasyankes']),
				'rows_trans' => $this->Model_sina->count_rows_trans_ep_verifikator($data_select_pengajuan[0]['penetapan_tanggal_survei_id']),
				'bab' => $bab,
				// 'datab'=> $this->Model_sina->select_ep($bab,6),
				//'datab'=> $this->Model_sina->select_ep(1,2),
				'id' => $id
			);

			$this->load->view('elemen_penilaian_verifikator', $data);
		}
	}

	public function epverifikatorcopy()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$post = $this->security->xss_clean($this->input->post());
			if (!empty($post['bab'])) {
				$bab = $post['bab'];
			} else {
				$bab = null;
			}
			$id = $this->uri->segment(3);

			$data_pengajuan = $this->Model_sina->select_pengajuan($id);

			$data_select_pengajuan = $this->Model_sina->select_pengajuan($id);

			print_r($data_pengajuan);
			echo 'dataselect';
			print_r($data_select_pengajuan);


			if ($data_pengajuan[0]['jenis_survei_id'] == 2) {
				$data_select_pengajuan_lama = $this->Model_sina->select_pengajuan($data_pengajuan[0]['pengajuan_usulan_survei_id_lama']);
				$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan_lama[0]['penetapan_tanggal_survei_id']);
				$trans = array_column($trans, null, "elemen_penilaian_id");
				$trans_check = $this->Model_sina->select_trans_ep_check($data_select_pengajuan[0]['penetapan_tanggal_survei_id'], $bab);
				if (!empty($trans_check[0]['skor_capaian_verifikator'])) {
					$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
					$trans = array_column($trans, null, "elemen_penilaian_id");
				}
			} else {
				if ($data_pengajuan[0]['jenis_akreditasi_id'] == 3) {
					$data_select_pengajuan_lama = $this->Model_sina->select_pengajuan($data_pengajuan[0]['pengajuan_usulan_survei_id_lama']);
					$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan_lama[0]['penetapan_tanggal_survei_id']);
					$trans = array_column($trans, null, "elemen_penilaian_id");
					$trans_check = $this->Model_sina->select_trans_ep_check($data_select_pengajuan[0]['penetapan_tanggal_survei_id'], $bab);
					if (!empty($trans_check[0]['skor_capaian_verifikator'])) {
						$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
						$trans = array_column($trans, null, "elemen_penilaian_id");
					}
				} else {
					$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
					$trans = array_column($trans, null, "elemen_penilaian_id");
				}
			}

			echo 'trans';
			print_r($trans);
			echo 'transcheck';
			print_r($trans_check);

			// $trans2 = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
			// $trans2 = array_column($trans2, null, "elemen_penilaian_id");

			// $data = array(
			// 	'content' => 'elemen_penilaian_surveior',
			// 	'data' => $data_select_pengajuan,
			// 	'datab' => $this->Model_sina->select_ep($bab, $data_pengajuan[0]['jenis_fasyankes']),
			// 	'trans' => $trans,
			// 	'trans2' => $trans2,
			// 	'count_trans' => $this->Model_sina->select_count_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id'], $data_pengajuan[0]['jenis_fasyankes']),
			// 	'rows_bab' => $this->Model_sina->count_rows_bab($data_pengajuan[0]['jenis_fasyankes']),
			// 	'rows_trans' => $this->Model_sina->count_rows_trans_ep_verifikator($data_select_pengajuan[0]['penetapan_tanggal_survei_id']),
			// 	'bab' => $bab,
			// 	'id' => $id
			// );

			// $this->load->view('elemen_penilaian_verifikator', $data);
		}
	}


	public function simpanEp()
	{
		$this->load->helper('security');
		$post = $this->security->xss_clean($this->input->post());

		// $where2 = array(
		// 	'penetapan_tanggal_survei_id' => $post["penetapan_tanggal_survei_id"]
		// 	);
		// $this->Model_sina->delete_data('trans_ep',$where2);

		foreach ($post['id_ep'] as $ids) {

			$skor_capaian_verifikator = $post['skor_capaian_verifikator'][$ids];
			$skor_maksimal = $post['skor_maksimal'][$ids];
			if ($skor_capaian_verifikator == 'TDD') {
				$persentase_capaian_verifikator = 'TDD';
			} else {
				$persentase_capaian_verifikator = ($skor_capaian_verifikator / $skor_maksimal) * 100;
			}


			$datas_detail = array(
				'penetapan_tanggal_survei_id' => $post['penetapan_tanggal_survei_id'],
				'elemen_penilaian_id' => $ids,
				'trans_ep_id' => $post['trans_ep_id'][$ids],
				'keterangan' => $post['keterangan'][$ids],
				'skor_capaian_verifikator' => $skor_capaian_verifikator,
				'persentase_capaian_verifikator' => $persentase_capaian_verifikator
			);

			$where2 = array(
				'penetapan_tanggal_survei_id' => $post["penetapan_tanggal_survei_id"],
				'elemen_penilaian_id' => $ids,
				'trans_ep_id' => $post["trans_ep_id"][$ids]
			);
			$this->Model_sina->delete_data('trans_ep_verifikator', $where2);

			$this->Model_sina->input_data('trans_ep_verifikator', $datas_detail);
		}

		redirect('verifikator/epverifikator/' . $post['id_pengajuan']);
	}

	public function final_ep()
	{
		$this->load->helper('security');
		$post = $this->security->xss_clean($this->input->post());

		$datas = array(
			'penetapan_verifikator_id' => $post['penetapan_verifikator_id'],
			'final' => 1
		);

		$where2 = array(
			'penetapan_verifikator_id' => $post["penetapan_verifikator_id"]
		);
		$this->Model_sina->delete_data('trans_final_ep_verifikator', $where2);

		$this->Model_sina->input_data('trans_final_ep_verifikator', $datas);

		$this->session->set_flashdata('kode_name', 'success');
		$this->session->set_flashdata('icon_name', 'check');
		$this->session->set_flashdata('message_name', 'Sukses Input Data!');

		// if(!empty($post['penetapan_verifikator_id'])){
		// 	$where = array(
		// 		'id' =>$post['penetapan_verifikator_id']
		// 		);

		// 	$this->Model_sina->edit_data('trans_final_ep_verifikator',$where,$datas);
		// 	$this->session->set_flashdata('kode_name', 'success');
		// 	$this->session->set_flashdata('icon_name', 'check');
		// 	$this->session->set_flashdata('message_name', 'Sukses Ubah Data!');

		// 	redirect('pengajuan/detail/'.$post['id']);
		// } else {
		// 	$this->Model_sina->input_data('trans_final_ep_verifikator',$datas);

		// 	$this->session->set_flashdata('kode_name', 'success');
		// 	$this->session->set_flashdata('icon_name', 'check');
		// 	$this->session->set_flashdata('message_name', 'Sukses Input Data!');

		// 	// redirect('pengajuan');
		// 	redirect('pengajuan/detail/'.$post['id']);

		// }

		redirect('verifikator/epverifikator/' . $post['id_pengajuan']);
	}
}
