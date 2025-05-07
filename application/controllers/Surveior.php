<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surveior extends CI_Controller
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
			if ($session_kriteria == 3) {
				$session_lpa = $this->session->userdata('lpa_id');
				$session_id = $this->session->userdata('id');

				$post = $this->input->post();
				$tanggal_awal = !empty($post['tanggal_awal']) ? $post['tanggal_awal'] : null;
				$tanggal_akhir = !empty($post['tanggal_akhir']) ? $post['tanggal_akhir'] : null;
				$propinsi = !empty($post['propinsi']) ? $post['propinsi'] : null;
				$kota = !empty($post['kota']) ? $post['kota'] : null;
				$jenis_fasyankes = !empty($post['jenis_fasyankes']) ? $post['jenis_fasyankes'] : null;
				$status_verifikasi_id = !empty($post['status_verifikasi_id']) ? $post['status_verifikasi_id'] : null;

				$select_users = $this->Model_viewdata->select_users($session_id);
				$users_surveior_id = $select_users[0]['id'];
				// var_dump($users_surveior_id);

				$data = array(
					'content' => 'user_surveior',
					'data' => $this->Model_viewdata->select_penilaian_surveior($session_lpa, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes, $session_id, $status_verifikasi_id, $users_surveior_id),
					'propinsi' => $propinsi,
					'kota' => $kota,
					'jenis_fasyankes' => $jenis_fasyankes,
					'tanggal_awal' => $tanggal_awal,
					'tanggal_akhir' => $tanggal_akhir,
					'status_verifikasi_id' => $status_verifikasi_id
				);
				// $this->load->view('user_surveior', $data);
				if ($select_users[0]['status_aktif'] == 0 || $select_users[0]['nama_sertifikat'] == NULL) {
					if ($select_users[0]['status_aktif'] == 1) {
						$this->session->set_flashdata('Status_Aktif', 1);
					} else {
						$this->session->set_flashdata('Status_Aktif', 0);
					}

					if ($select_users[0]['nama_sertifikat'] == NULL) {
						$this->session->set_flashdata('Status_Sertifikat', 0);
					} else if ($select_users[0]['nama_sertifikat'] != NULL) {
						$this->session->set_flashdata('Status_Sertifikat', 1);
					}
					redirect('Profil');
					// echo $select_users[0]['nama_sertifikat'];
				} else {
					$this->load->view('user_surveior', $data);
				}
			}
		}
	}
	public function epsurveior_backup()
	{
		$post = $this->input->post();
		if (!empty($post['bab'])) {
			$bab = $post['bab'];
		} else if (!empty($post['bab2'])) {
			$bab = $post['bab2'];
		} else {
			$bab = null;
		}
		$id = $this->uri->segment(3);

		$data_pengajuan = $this->Model_sina->select_pengajuan($id);


		$data = array(
			'content' => 'elemen_penilaian_surveior',
			'data' => $this->Model_sina->select_pengajuan($id),
			'datab' => $this->Model_sina->select_ep($bab, $data_pengajuan[0]['jenis_fasyankes']),
			'bab' => $bab,
			// 'datab'=> $this->Model_sina->select_ep($bab,6),
			//'datab'=> $this->Model_sina->select_ep(1,2),
			'id' => $id
		);
		$this->load->view('elemen_penilaian_surveior', $data);
		//$this->load->view('elemen_penilaian_surveior');
	}

	public function epsurveior()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$session_kriteria = $this->session->userdata('kriteria_id');
			if ($session_kriteria == 3) {
				$session_lpa = $this->session->userdata('lpa_id');
				$session_id = $this->session->userdata('id');
				$post = $this->input->post();
				if (!empty($post['bab'])) {
					$bab = $post['bab'];
				} else if (!empty($post['bab2'])) {
					$bab = $post['bab2'];
				} else {
					$bab = null;
				}
				$id = $this->uri->segment(3);

				$data_pengajuan = $this->Model_sina->select_pengajuan($id);
				$data_registrasi = $this->Model_sina->select_nama_faskes($data_pengajuan[0]['jenis_fasyankes'], $data_pengajuan[0]['fasyankes_id']);
				$detail_pengajuan = $this->Model_sina->detail_pengajuan_survei($id);
				$data_select_pengajuan = $this->Model_sina->select_pengajuan($id);
				$narahubung = $this->Model_sina->getDataNarahubung($data_pengajuan[0]['fasyankes_id']);


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
					if (!empty($trans_check)) {
						$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
						$trans = array_column($trans, null, "elemen_penilaian_id");
					}
				} else {
					if ($data_pengajuan[0]['jenis_akreditasi_id'] == 3) {
						$data_select_pengajuan_lama = $this->Model_sina->select_pengajuan($data_pengajuan[0]['pengajuan_usulan_survei_id_lama']);
						$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan_lama[0]['penetapan_tanggal_survei_id']);
						$trans = array_column($trans, null, "elemen_penilaian_id");
						$trans_check = $this->Model_sina->select_trans_ep_check($data_select_pengajuan[0]['penetapan_tanggal_survei_id'], $bab);
						if (!empty($trans_check)) {
							$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
							$trans = array_column($trans, null, "elemen_penilaian_id");
						}
					} else {
						$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
						$trans = array_column($trans, null, "elemen_penilaian_id");
					}
				}

				$data_bidang_surveior = $this->Model_sina->select_bidang_surveior($session_id, $data_pengajuan[0]['jenis_fasyankes']);

				// if ($data_pengajuan[0]['jenis_fasyankes'] == 1) {
				// 	$ep = $this->Model_sina->select_ep($bab, $data_pengajuan[0]['jenis_fasyankes']);
				// } else {

				$ep = $this->Model_sina->select_ep_by_bidang($bab, $data_pengajuan[0]['jenis_fasyankes'], $data_bidang_surveior[0]['id_bidang']);
				// }



				$data_surveior_lapangan = $this->Model_sina->getsurveiorlapangan($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
				$data = array(
					'content' => 'elemen_penilaian_surveior',
					'data' => $data_select_pengajuan,
					'data2' => $data_pengajuan,
					'surtug' => $this->Model_sina->getsurtugtte($id),
					'data_surveior_lapangan' => $data_surveior_lapangan,
					'data_nama' => $data_registrasi,
					'detail_pengajuan' => $detail_pengajuan,
					'datab' => $ep,
					'trans' => $trans,
					'count_trans' => $this->Model_sina->select_count_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id'], $data_pengajuan[0]['jenis_fasyankes']),
					'rows_bab' => $this->Model_sina->count_rows_bab($data_pengajuan[0]['jenis_fasyankes']),
					'rows_trans' => $this->Model_sina->count_rows_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']),
					'bab' => $bab,
					'session_id' => $session_id,
					// 'session_id' => $data_bidang_surveior[0]['id_user_surveior'],
					'narahubung' => $narahubung,
					// 'datab'=> $this->Model_sina->select_ep($bab,6),
					//'datab'=> $this->Model_sina->select_ep(1,2),
					'id' => $id
				);
				$this->load->view('elemen_penilaian_surveior', $data);
				//$this->load->view('elemen_penilaian_surveior');
			}
		}
	}

	public function epsurveiorcopy()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$session_kriteria = $this->session->userdata('kriteria_id');
			if ($session_kriteria == 3) {
				$session_lpa = $this->session->userdata('lpa_id');
				$session_id = $this->session->userdata('id');
				$post = $this->input->post();
				if (!empty($post['bab'])) {
					$bab = $post['bab'];
				} else if (!empty($post['bab2'])) {
					$bab = $post['bab2'];
				} else {
					$bab = null;
				}
				$id = $this->uri->segment(3);

				$data_pengajuan = $this->Model_sina->select_pengajuan($id);
				$data_registrasi = $this->Model_sina->select_nama_faskes($data_pengajuan[0]['jenis_fasyankes'], $data_pengajuan[0]['fasyankes_id']);
				$detail_pengajuan = $this->Model_sina->detail_pengajuan_survei($id);
				$data_select_pengajuan = $this->Model_sina->select_pengajuan($id);
				$narahubung = $this->Model_sina->getDataNarahubung($data_pengajuan[0]['fasyankes_id']);


				if ($data_pengajuan[0]['jenis_survei_id'] == 2) {

					$data_select_pengajuan_lama = $this->Model_sina->select_pengajuan($data_pengajuan[0]['pengajuan_usulan_survei_id_lama']);
					$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan_lama[0]['penetapan_tanggal_survei_id']);
					$trans = array_column($trans, null, "elemen_penilaian_id");
					$trans_check = $this->Model_sina->select_trans_ep_check($data_select_pengajuan[0]['penetapan_tanggal_survei_id'], $bab);
					if (!empty($trans_check)) {
						$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
						$trans = array_column($trans, null, "elemen_penilaian_id");
					}
				} else {
					if ($data_pengajuan[0]['jenis_akreditasi_id'] == 3) {
						$data_select_pengajuan_lama = $this->Model_sina->select_pengajuan($data_pengajuan[0]['pengajuan_usulan_survei_id_lama']);
						$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan_lama[0]['penetapan_tanggal_survei_id']);
						$trans = array_column($trans, null, "elemen_penilaian_id");
						$trans_check = $this->Model_sina->select_trans_ep_check($data_select_pengajuan[0]['penetapan_tanggal_survei_id'], $bab);
						if (!empty($trans_check)) {
							$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
							$trans = array_column($trans, null, "elemen_penilaian_id");
						}
					} else {
						$trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
						$trans = array_column($trans, null, "elemen_penilaian_id");
					}
				}

				$data_bidang_surveior = $this->Model_sina->select_bidang_surveior($session_id, $data_pengajuan[0]['jenis_fasyankes']);
				$ep = $this->Model_sina->select_ep_by_bidang($bab, $data_pengajuan[0]['jenis_fasyankes'], $data_bidang_surveior[0]['id_bidang']);


				$data_surveior_lapangan = $this->Model_sina->getsurveiorlapangan($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);
				$data = array(
					'content' => 'elemen_penilaian_surveior',
					'data' => $data_select_pengajuan,
					'data2' => $data_pengajuan,
					'surtug' => $this->Model_sina->getsurtugtte($id),
					'data_surveior_lapangan' => $data_surveior_lapangan,
					'data_nama' => $data_registrasi,
					'detail_pengajuan' => $detail_pengajuan,
					'datab' => $ep,
					'trans' => $trans,
					'count_trans' => $this->Model_sina->select_count_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id'], $data_pengajuan[0]['jenis_fasyankes']),
					'rows_bab' => $this->Model_sina->count_rows_bab($data_pengajuan[0]['jenis_fasyankes']),
					'rows_trans' => $this->Model_sina->count_rows_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']),
					'bab' => $bab,
					'session_id' => $session_id,
					'narahubung' => $narahubung,
					'id' => $id
				);
				$this->load->view('elemen_penilaian_surveior_copy', $data);
			}
		}
	}

	public function epsurveior2()
	{
		$post = $this->input->post();
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


		$data = array(
			'content' => 'elemen_penilaian_surveior',
			'data' => $data_select_pengajuan,
			'datab' => $this->Model_sina->select_ep($bab, $data_pengajuan[0]['jenis_fasyankes']),
			'trans' => $trans,
			'count_trans' => $this->Model_sina->select_count_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']),
			'bab' => $bab,
			// 'datab'=> $this->Model_sina->select_ep($bab,6),
			//'datab'=> $this->Model_sina->select_ep(1,2),
			'id' => $id
		);
		$this->load->view('ep_tes', $data);
		//$this->load->view('elemen_penilaian_surveior');
	}

	public function simpanEpLama()
	{
		$post = $this->input->post();

		foreach ($post['id_ep'] as $ids) {

			$skor_capaian_surveior = $post['skor_capaian_surveior'][$ids];
			$skor_maksimal = $post['skor_maksimal'][$ids];
			if ($skor_capaian_surveior == 'TDD') {
				$persentase_capaian_surveior = 'TDD';
			} else {
				$persentase_capaian_surveior = ($skor_capaian_surveior / $skor_maksimal) * 100;
			}


			$datas_detail = array(
				'penetapan_tanggal_survei_id' => $post['penetapan_tanggal_survei_id'],
				'elemen_penilaian_id' => $ids,
				'skor_capaian_surveior' => $skor_capaian_surveior,
				'persentase_capaian_surveior' => $persentase_capaian_surveior,
				'fakta_dan_analisis' => $post['fakta_dan_analisis'][$ids],
				'rekomendasi' => $post['rekomendasi'][$ids]
			);

			$where2 = array(
				'penetapan_tanggal_survei_id' => $post["penetapan_tanggal_survei_id"],
				'elemen_penilaian_id' => $ids
			);
			$this->Model_sina->delete_data('trans_ep', $where2);

			$this->Model_sina->input_data('trans_ep', $datas_detail);
		}

		redirect('surveior/epsurveior/' . $post['id_pengajuan']);
	}

	public function simpanEp()
	{
		$post = $this->input->post();


		$penetapan_tanggal_survei_id = $post['penetapan_tanggal_survei_id'];
		$check = $this->Model_sina->checkFinalepSurveior($penetapan_tanggal_survei_id);
		$edit = 0;

		// CEK DULU SUDAH FINAL ATAU BELUM

		if ($check == NULL) {
			$edit = 1;
		} else {
			if ($check[0]['final'] != 1) {
				$edit = 1;
			} else {
				$edit = 0;
			}
		}

		// CEK DULU SUDAH FINAL ATAU BELUM

		if ($edit === 1) {

			foreach ($post['id_ep'] as $ids) {

				$skor_capaian_surveior = $post['skor_capaian_surveior'][$ids];
				$skor_maksimal = $post['skor_maksimal'][$ids];
				if ($skor_capaian_surveior == 'TDD') {
					$persentase_capaian_surveior = 'TDD';
				} else {
					$persentase_capaian_surveior = ($skor_capaian_surveior / $skor_maksimal) * 100;
				}


				$datas_detail = array(
					'penetapan_tanggal_survei_id' => $post['penetapan_tanggal_survei_id'],
					'elemen_penilaian_id' => $ids,
					'skor_capaian_surveior' => $skor_capaian_surveior,
					'persentase_capaian_surveior' => $persentase_capaian_surveior,
					'fakta_dan_analisis' => $post['fakta_dan_analisis'][$ids],
					'rekomendasi' => $post['rekomendasi'][$ids]
				);

				$where2 = array(
					'penetapan_tanggal_survei_id' => $post["penetapan_tanggal_survei_id"],
					'elemen_penilaian_id' => $ids
				);

				$checkEP = $this->Model_sina->checkep($where2);

				if (empty($checkEP)) {
					$this->Model_sina->input_data('trans_ep', $datas_detail);
				} else {
					$where3 = array(
						'id' => $checkEP[0]['id']
					);
					// $data['data'] = $datas_detail;
					// $datas = $this->Model_sina->edit_data_ep($data);

					$this->Model_sina->edit_data('trans_ep', $where3, $datas_detail);
				}

				// $this->Model_sina->delete_data('trans_ep', $where2);
			}
		} else {
			$this->session->set_flashdata('kode_name', 'danger');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Gagal Input / Ubah Sudah di final');
		}

		redirect('surveior/epsurveior/' . $post['id_pengajuan']);
	}

	public function simpanLaporan()
	{
		$post = $this->input->post();

		// $config['upload_path']          = 'assets/uploads/berkas_akreditasi/';
		// $config['allowed_types']        = 'pdf|jpg|jpeg|png';
		// $config['max_size']             = 2048;
		// $config['max_width']            = 1080;
		// $config['max_height']           = 1080;
		// $config['overwrite']            = true;
		// $config['encrypt_name'] = TRUE;

		//Upload foto_bukti_survei
		// if (!empty($_FILES['foto_bukti_survei']['name'])) {
		// 	$this->load->library('upload', $config);
		// 	if (!$this->upload->do_upload('foto_bukti_survei')) {
		// 		print_r($this->upload->display_errors());
		// 		exit;
		// 	}
		// 	$attachment = $this->upload->data();
		// 	$fileName = $attachment['file_name'];

		// 	//$foto_bukti_survei =  $url.$fileName;
		// 	$foto_bukti_survei =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
		// } else {
		// 	if (isset($post['old_foto_bukti_survei'])) {
		// 		$foto_bukti_survei = $post['old_foto_bukti_survei'];
		// 	} else {
		// 		$foto_bukti_survei = '';
		// 	}
		// }

		//Upload foto_bukti_survei2
		// if (!empty($_FILES['foto_bukti_survei2']['name'])) {
		// 	$this->load->library('upload', $config);
		// 	if (!$this->upload->do_upload('foto_bukti_survei2')) {
		// 		print_r($this->upload->display_errors());
		// 		exit;
		// 	}
		// 	$attachment = $this->upload->data();
		// 	$fileName = $attachment['file_name'];

		// 	//$foto_bukti_survei2 =  $url.$fileName;
		// 	$foto_bukti_survei2 =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
		// } else {
		// 	if (isset($post['old_foto_bukti_survei2'])) {
		// 		$foto_bukti_survei2 = $post['old_foto_bukti_survei2'];
		// 	} else {
		// 		$foto_bukti_survei2 = '';
		// 	}
		// }

		//Upload foto_bukti_survei3
		// if (!empty($_FILES['foto_bukti_survei3']['name'])) {
		// 	$this->load->library('upload', $config);
		// 	if (!$this->upload->do_upload('foto_bukti_survei3')) {
		// 		print_r($this->upload->display_errors());
		// 		exit;
		// 	}
		// 	$attachment = $this->upload->data();
		// 	$fileName = $attachment['file_name'];

		// 	//$foto_bukti_survei3 =  $url.$fileName;
		// 	$foto_bukti_survei3 =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
		// } else {
		// 	if (isset($post['old_foto_bukti_survei3'])) {
		// 		$foto_bukti_survei3 = $post['old_foto_bukti_survei3'];
		// 	} else {
		// 		$foto_bukti_survei3 = '';
		// 	}
		// }

		$datas = array(

			'tanggal_survei_satu' => $post['tanggal_survei_satu'],
			'tanggal_survei_dua' => $post['tanggal_survei_dua'],
			'tanggal_survei_tiga' => $post['tanggal_survei_tiga'],
			'url_bukti_satu' => $post['foto_bukti_survei'],
			'url_bukti_dua' => $post['foto_bukti_survei2'],
			'url_bukti_tiga' => $post['foto_bukti_survei3'],
			'penetapan_tanggal_survei_id' => $post['penetapan_tanggal_survei_id']
		);

		/*
		$where2 = array(
			'penetapan_tanggal_survei_id' => $post["penetapan_tanggal_survei_id"]
		);
		$this->Model_sina->delete_data('pengiriman_laporan_survei', $where2);

		$this->Model_sina->input_data('pengiriman_laporan_survei', $datas);

		$this->session->set_flashdata('kode_name', 'success');
		$this->session->set_flashdata('icon_name', 'check');
		$this->session->set_flashdata('message_name', 'Sukses Input Data!');
		*/

		if (!empty($post['pengiriman_laporan_survei_id'])) {
			$where = array(
				'id' => $post['pengiriman_laporan_survei_id']
			);

			$this->Model_sina->edit_data('pengiriman_laporan_survei', $where, $datas);
			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Ubah Data!');

			// redirect('pengajuan/detail/'.$post['id']);
		} else {
			if ($post['lpa_id'] == 14) {
				// $this->db->trans_begin();
				$this->db->insert('pengiriman_laporan_survei', $datas);
				$insert_id = $this->db->insert_id();
				// echo $insert_id;

				$datas2 = array(
					'pengiriman_laporan_survei_id' => $insert_id,
					'users_id' => 8821
				);
				$this->db->insert('penetapan_verifikator', $datas2);
				$insert_id2 = $this->db->insert_id();

				$datas3 = array(
					'penetapan_verifikator_id' => $insert_id2,
					'final' => 1
				);

				$this->db->insert('trans_final_ep_verifikator', $datas3);
				$insert_id3 = $this->db->insert_id();
				// $this->session->set_flashdata('message_name', $insert_id3);

				// $this->db->trans_complete();



			} else {
				$this->Model_sina->input_data('pengiriman_laporan_survei', $datas);
			}


			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');

			// redirect('pengajuan');
			// redirect('pengajuan/detail/'.$post['id']);

		}

		redirect('surveior/epsurveior/' . $post['id_pengajuan']);
	}

	public function final_ep()
	{
		$post = $this->input->post();

		$datas = array(
			'penetapan_tanggal_survei_id' => $post['penetapan_tanggal_survei_id'],
			'final' => 1
		);

		$where2 = array(
			'penetapan_tanggal_survei_id' => $post["penetapan_tanggal_survei_id"]
		);
		$this->Model_sina->delete_data('trans_final_ep_surveior', $where2);

		$this->Model_sina->input_data('trans_final_ep_surveior', $datas);

		$this->session->set_flashdata('kode_name', 'success');
		$this->session->set_flashdata('icon_name', 'check');
		$this->session->set_flashdata('message_name', 'Sukses Input Data!');

		// if(!empty($post['penetapan_tanggal_survei_id'])){
		// 	$where = array(
		// 		'id' =>$post['penetapan_tanggal_survei_id']
		// 		);

		// 	$this->Model_sina->edit_data('trans_final_ep_surveior',$where,$datas);
		// 	$this->session->set_flashdata('kode_name', 'success');
		// 	$this->session->set_flashdata('icon_name', 'check');
		// 	$this->session->set_flashdata('message_name', 'Sukses Ubah Data!');

		// 	// redirect('pengajuan/detail/'.$post['id']);
		// } else {
		// 	$this->Model_sina->input_data('trans_final_ep_surveior',$datas);

		// 	$this->session->set_flashdata('kode_name', 'success');
		// 	$this->session->set_flashdata('icon_name', 'check');
		// 	$this->session->set_flashdata('message_name', 'Sukses Input Data!');

		// 	// redirect('pengajuan');
		// 	// redirect('pengajuan/detail/'.$post['id']);

		// }

		redirect('surveior/epsurveior/' . $post['id_pengajuan']);
	}

	public function jadwal_surveior()
	{
		$userid = $this->session->userdata('user_id');
		$where = array(
			'users_id' => $userid
		);
		$getsurveior = $this->Model_sina->select_data('user_surveior', $where)->result_array();
		$surveior_id = $getsurveior[0]['id'];

		$where = array(
			'user_surveior_id' => $surveior_id,
		);
		$jadwal = $this->Model_sina->select_data_jadwal('jadwal_surveior', $where)->result_array();
		$data = array(
			'tanggal' => $jadwal
		);
		// var_dump($getsurveior);
		$this->load->view('jadwal_surveior', $data);
	}

	public function simpan_date()
	{
		$tanggal = $this->input->post('tanggalkesiapan');
		$userid = $this->session->userdata('user_id');
		$where = array(
			'users_id' => $userid
		);
		$getsurveior = $this->Model_sina->select_data('user_surveior', $where)->result_array();
		$surveior_id = $getsurveior[0]['id'];

		if (!empty($tanggal)) {
			foreach ($tanggal as $key => $value) {
				$data['user_surveior_id'] = $surveior_id;
				$data['jadwal_kesiapan'] = $value;
				// $this->Model_sina->input_date('jadwal_surveior', $data);
				$query = $this->Model_sina->input_date('jadwal_surveior', $data);
			}
		}
		redirect('Surveior/jadwal_surveior');
	}
	public function delete_date($id)
	{
		$userid = $this->session->userdata('user_id');
		$where = array(
			'users_id' => $userid
		);
		$getsurveior = $this->Model_sina->select_data('user_surveior', $where)->result_array();
		$surveior_id = $getsurveior[0]['id'];

		$data = array(
			'id' => $id,
			'user_surveior_id' => $surveior_id
		);
		$this->Model_sina->delete_data('jadwal_surveior', $data);
		redirect('Surveior/jadwal_surveior');
	}

	public function jadwal_perjalanan()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$session_kriteria = $this->session->userdata('kriteria_id');
			if ($session_kriteria == 3 || $session_kriteria == 1) {
				$session_lpa = $this->session->userdata('lpa_id');
				$session_id = $this->session->userdata('id');

				$post = $this->input->post();
				$tanggal_awal = !empty($post['tanggal_awal']) ? $post['tanggal_awal'] : null;
				$tanggal_akhir = !empty($post['tanggal_akhir']) ? $post['tanggal_akhir'] : null;
				$user_id = !empty($post['user_id']) ? $post['user_id'] : null;

				$data = array(
					'content' => 'jadwal_perjalanan',
					'data' => $this->Model_sina->select_jadwal_surveior($user_id, $tanggal_awal, $tanggal_akhir),
					'user_id' => $user_id,
					'tanggal_awal' => $tanggal_awal,
					'tanggal_akhir' => $tanggal_akhir,
					'lpa_id' => $session_lpa
				);
				//echo json_encode($data['lpa_id']);exit;
				$this->load->view('jadwal_perjalanan', $data);
			}
		}
	}

	function get_autocomplete_surveior()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			if (isset($_GET['term'])) {
				$result = $this->Model_sina->getsurveior($_GET['term']);
				if (count($result) > 0) {
					foreach ($result as $row)
						$arr_result[] = array(
							'nama'          => "$row->nama",
							'lpa'			=> "$row->lpa_id",
							'userid'			=> "$row->users_id",
							'label'        => "$row->nama",
						);
					echo json_encode($arr_result);
				}
			}
		}
	}

	public function update_jadwal_perjalanan()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {

			if ($_POST) {
				$id = $_POST['id'];
				$status = $_POST['status'];

				$filter = array("id" => $id);
				$data = array("status" => $_POST['status']);
				$this->db->where($filter);
				$this->db->update('jadwal_surveior', $data);
				echo "Data Berhasil Disimpan";
			} else {
				echo "Data gagal Disimpan";
			}
		}
	}
}
