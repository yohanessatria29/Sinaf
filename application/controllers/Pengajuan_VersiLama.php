<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends CI_Controller
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
			if ($session_kriteria == 1) {
				$session_lpa = $this->session->userdata('lpa_id');

				$post = $this->input->post();
				if (!empty($post['tanggal_awal'])) {
					$tanggal_awal = $post['tanggal_awal'];
				} else {
					$tanggal_awal = null;
				}
				if (!empty($post['tanggal_akhir'])) {
					$tanggal_akhir = $post['tanggal_akhir'];
				} else {
					$tanggal_akhir = null;
				}

				if (!empty($post['propinsi'])) {
					$propinsi = $post['propinsi'];
				} else {
					$propinsi = null;
				}
				if (!empty($post['kota'])) {
					$kota = $post['kota'];
				} else {
					$kota = null;
				}
				if (!empty($post['jenis_fasyankes'])) {
					$jenis_fasyankes = $post['jenis_fasyankes'];
				} else {
					$jenis_fasyankes = null;
				}
				if (!empty($post['status_usulan_id'])) {
					$status_usulan_id = $post['status_usulan_id'];
				} else {
					$status_usulan_id = null;
				}

				$data = array(
					'content' => 'view_pengajuan_usulan_survei',
					'datab' => $this->Model_viewdata->get_data_pengajuan(1)->result_array(),
					'data' => $this->Model_sina->select_pengajuan_search($session_lpa, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes, $status_usulan_id),
					'session_lpa' => $session_lpa,
					'propinsi' => $propinsi,
					'kota' => $kota,
					'status_usulan_id' => $status_usulan_id,
					'jenis_fasyankes' => $jenis_fasyankes,
					'tanggal_awal' => $tanggal_awal,
					'tanggal_akhir' => $tanggal_akhir
				);
				$this->load->view('view_pengajuan_usulan_survei', $data);
			}
		}
	}

	public function searchIndex()
	{
		$post = $this->input->post();
		if (!empty($post['propinsi'])) {
			$propinsi = $post['propinsi'];
		} else {
			$propinsi = null;
		}
		if (!empty($post['kota'])) {
			$kota = $post['kota'];
		} else {
			$kota = null;
		}
		if (!empty($post['jenis_fasyankes'])) {
			$jenis_fasyankes = $post['jenis_fasyankes'];
		} else {
			$jenis_fasyankes = null;
		}

		$data = array(
			'content' => 'view_pengajuan_usulan_survei',
			'data' => $this->Model_sina->select_pengajuan_search($propinsi, $kota, $jenis_fasyankes)
		);
		$this->load->view('view_pengajuan_usulan_survei', $data);
	}

	// public function tes_cek() {
	// 	$data = $this->Model_sina->get_tanggal_rencana_survei(91);

	// 	echo '<pre>';
	// 	print_r($data);
	// 	echo '</pre>';
	// }

	public function detail()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$session_kriteria = $this->session->userdata('kriteria_id');
			$session_lpa = $this->session->userdata('lpa_id');
			if ($session_kriteria == 1) {
				$id = $this->uri->segment(3);
				$pengajuan = $this->Model_sina->select_pengajuan($id);
				$detail_pengajuan = $this->Model_sina->detail_pengajuan_survei($id);
				$surveior = $this->Model_sina->select_surveior_kesepakatan($id);
				$pengajuan_lama = $this->Model_sina->select_pengajuan($pengajuan[0]['pengajuan_usulan_survei_id_lama']);
				$puskesmas = $this->Model_sina->get_puskesmas($pengajuan[0]['fasyankes_id']);
				$surveior_lapangan = $this->Model_sina->getdatalapangan($pengajuan[0]['penetapan_tanggal_survei_id']);
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

				$data = array(
					'content' => 'pengajuan_usulan_survei',
					'data' => $pengajuan,
					'data_lama' => $pengajuan_lama,
					'puskesmas' => $puskesmas,
					'lpa_id' => $session_lpa,
					'surveior' => $surveior,
					'detail_pengajuan' => $detail_pengajuan,
					'id' => $id,
					'surveior_lapangan' => $surveior_lapangan
				);
				$this->load->view('pengajuan_usulan_survei', $data);
			}
		}
	}

	public function getsurveiorpengganti()
	{
		// var_dump($this->input->post());
		$idpengajuan = $this->input->post('idpengajuan');
		$idsurveior = $this->input->post('idsurveior');

		$datapengajuan = $this->Model_sina->get_detail_pengajuan($idpengajuan, $idsurveior);
		// $input = array_map("unserialize", array_unique(array_map("serialize", $datapengajuan)));
		$lpa_id = $datapengajuan[0]['lpa_id'];
		// $provinsiid = $datapengajuan[0]['provinsi_id'];
		// $provinsiid = '31';
		$fasyankes_id = $datapengajuan[0]['fasyankes_id'];
		$idbidang = $datapengajuan[0]['bidang_id'];
		foreach ($datapengajuan as $value) {
			$tanggal[] = $value['jadwal_kesiapan'];
		}
		// $tanggal1 = $tanggal[0];
		// if (!empty($tanggal[4])) {
		// 	$tanggal2 = $tanggal[4];
		// } else {
		// 	$tanggal2 = '';
		// }
		// if (!empty($tanggal[5])) {
		// 	$tanggal3 = $tanggal[2];
		// } else {
		// 	$tanggal3 = '';
		// }
		$uniqtanggal = array_unique($tanggal);


		if (isset($uniqtanggal[2])) {
			$tanggal1 = $tanggal[0];
			$tanggal2 = $tanggal[2];
			$tanggal3 = '';
		} else if (isset($uniqtanggal[6])) {
			$tanggal1 = $tanggal[0];
			$tanggal2 = $tanggal[3];
			$tanggal3 = $tanggal[6];
		} else if (isset($uniqtanggal[0])) {
			$tanggal1 = $tanggal[0];
			$tanggal2 = '';
			$tanggal3 = '';
		}


		// $where['kondisi'] = 'user_surveior.lpa_id = ' . $lpa_id . ' AND user_surveior.provinsi_id = ' . $provinsiid . ' AND user_surveior_bidang_detail.id_fasyankes_surveior = ' . $fasyankes_id . ' AND user_surveior_bidang_detail.id_bidang = ' . $idbidang;
		$where['kondisi'] = 'user_surveior.lpa_id = ' . $lpa_id . ' AND user_surveior_bidang_detail.id_fasyankes_surveior = ' . $fasyankes_id . ' AND user_surveior_bidang_detail.id_bidang = ' . $idbidang;
		if (!empty($tanggal3)) {
			// $where_tanggal = 'js.jadwal_kesiapan = ' . $tanggal1 . ' AND js.jadwal_kesiapan = ' . $tanggal2 . ' AND js.jadwal_kesiapan = ' . $tanggal3;
			$where['kondisi_tanggal'] = "jadwal_kesiapan IN ('" . $tanggal1 . "', '" . $tanggal2 . "', '" . $tanggal3 . "')";
			$where['tanggal'] = '3';
		} else if (!empty($tanggal2)) {
			// $where_tanggal = 'js.jadwal_kesiapan = ' . $tanggal1 . ' AND js.jadwal_kesiapan = ' . $tanggal2;
			$where['kondisi_tanggal'] = "jadwal_kesiapan IN ('" . $tanggal1 . "', '" . $tanggal2 . "')";
			$where['tanggal'] = '2';
		} else {
			// $where_tanggal = 'js.jadwal_kesiapan = ' . $tanggal1;
			$where['kondisi_tanggal'] = "jadwal_kesiapan IN ('" . $tanggal1 . "')";
			$where['tanggal'] = '1';
		}


		$datasurveior = $this->Model_sina->select_surveior_pengganti($where);
		// echo ($where_tanggal);
		// echo '|';
		// echo ($where);
		// var_dump($datasurveior);
		// var_dump(json_encode($datasurveior));
		echo json_encode($datasurveior);
	}

	public function detailfasyankes()
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

		// $trans = $this->Model_sina->select_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id']);

		// $trans = array_column($trans, null, "elemen_penilaian_id");

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


		$data = array(
			'content' => 'elemen_penilaian_surveior',
			'data' => $data_select_pengajuan,
			'datab' => $this->Model_sina->select_ep($bab, $data_pengajuan[0]['jenis_fasyankes']),
			'trans' => $trans,
			'count_trans' => $this->Model_sina->select_count_trans_ep($data_select_pengajuan[0]['penetapan_tanggal_survei_id'], $data_pengajuan[0]['jenis_fasyankes']),
			'bab' => $bab,
			// 'datab'=> $this->Model_sina->select_ep($bab,6),
			//'datab'=> $this->Model_sina->select_ep(1,2),
			'id' => $id
		);
		$this->load->view('pengirimanlaporan_kemenkes', $data);
	}

	public function simpanPenerimaanUsulan()
	{
		$post = $this->input->post();
		$this->load->library('form_validation');
		$this->load->helper('security');
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$datas = array(
				'pengajuan_usulan_survei_id' => $post['id'],
				'status_usulan_id' => $post['status_usulan_id'],
				'keterangan' => $post['keterangan']
			);

			if (!empty($post['penerimaan_pengajuan_usulan_survei_id'])) {
				$where = array(
					'id' => $post['penerimaan_pengajuan_usulan_survei_id']
				);

				$this->Model_sina->edit_data('penerimaan_pengajuan_usulan_survei', $where, $datas);
				$this->session->set_flashdata('kode_name', 'success');
				$this->session->set_flashdata('icon_name', 'check');
				$this->session->set_flashdata('message_name', 'Sukses Ubah Data!');

				redirect('pengajuan/detail/' . $post['id']);
			} else {
				$this->Model_sina->input_data('penerimaan_pengajuan_usulan_survei', $datas);

				$this->session->set_flashdata('kode_name', 'success');
				$this->session->set_flashdata('icon_name', 'check');
				$this->session->set_flashdata('message_name', 'Sukses Input Data!');

				redirect('pengajuan');
			}
		}
	}

	public function simpanKelengkapanBerkas()
	{
		$post = $this->input->post();
		$this->load->library('form_validation');
		$this->load->helper('security');
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {

			if ($post['kelengkapan_berkas_usulan'] == 2) {
				$kelengkapan_berkas_usulan_catatan = "";
			} else {
				$kelengkapan_berkas_usulan_catatan = $post['kelengkapan_berkas_usulan_catatan'];
			};

			if ($post['kelengkapan_dfo'] == 2) {
				$kelengkapan_dfo_catatan = "";
			} else {
				$kelengkapan_dfo_catatan = $post['kelengkapan_dfo_catatan'];
			};

			if ($post['kelengkapan_sarpras_alkes'] == 2) {
				$kelengkapan_sarpras_alkes_catatan = "";
			} else {
				$kelengkapan_sarpras_alkes_catatan = $post['kelengkapan_sarpras_alkes_catatan'];
			};

			if ($post['kelengkapan_nakes'] == 2) {
				$kelengkapan_nakes_catatan = "";
			} else {
				$kelengkapan_nakes_catatan = $post['kelengkapan_nakes_catatan'];
			};

			if ($post['kelengkapan_laporan_inm'] == 2) {
				$kelengkapan_laporan_inm_catatan = "";
			} else {
				$kelengkapan_laporan_inm_catatan = $post['kelengkapan_laporan_inm_catatan'];
			};

			if ($post['kelengkapan_laporan_ikp'] == 2) {
				$kelengkapan_laporan_ikp_catatan = "";
			} else {
				$kelengkapan_laporan_ikp_catatan = $post['kelengkapan_laporan_ikp_catatan'];
			};


			$datas = array(
				'berkas_usulan_survei_id' => $post['berkas_usulan_survei_id'],
				'kelengkapan_berkas_usulan' => $post['kelengkapan_berkas_usulan'],
				'kelengkapan_dfo' => $post['kelengkapan_dfo'],
				'kelengkapan_sarpras_alkes' => $post['kelengkapan_sarpras_alkes'],
				'kelengkapan_nakes' => $post['kelengkapan_nakes'],
				'kelengkapan_laporan_inm' => $post['kelengkapan_laporan_inm'],
				'kelengkapan_laporan_ikp' => $post['kelengkapan_laporan_ikp'],
				'kelengkapan_berkas_usulan_catatan' => $kelengkapan_berkas_usulan_catatan,
				'kelengkapan_dfo_catatan' => $kelengkapan_dfo_catatan,
				'kelengkapan_sarpras_alkes_catatan' => $kelengkapan_sarpras_alkes_catatan,
				'kelengkapan_nakes_catatan' => $kelengkapan_nakes_catatan,
				'kelengkapan_laporan_inm_catatan' => $kelengkapan_laporan_inm_catatan,
				'kelengkapan_laporan_ikp_catatan' => $kelengkapan_laporan_ikp_catatan
			);

			if (!empty($post['kelengkapan_berkas_id'])) {
				$where = array(
					'id' => $post['kelengkapan_berkas_id']
				);

				$this->Model_sina->edit_data('kelengkapan_berkas', $where, $datas);
				$this->session->set_flashdata('kode_name', 'success');
				$this->session->set_flashdata('icon_name', 'check');
				$this->session->set_flashdata('message_name', 'Sukses Ubah Data!');

				redirect('pengajuan/detail/' . $post['id']);
			} else {
				$this->Model_sina->input_data('kelengkapan_berkas', $datas);

				$this->session->set_flashdata('kode_name', 'success');
				$this->session->set_flashdata('icon_name', 'check');
				$this->session->set_flashdata('message_name', 'Sukses Input Data!');

				// redirect('pengajuan');
				redirect('pengajuan/detail/' . $post['id']);
			}
		}
	}

	public function simpanPenetapanTanggalSurvei()
	{
		$post = $this->input->post();
		$config['upload_path']          = 'assets/uploads/berkas_akreditasi/';
		$config['allowed_types']        = 'pdf|xls|xlsx';
		$config['max_size']             = 2048;
		$config['max_width']            = 1080;
		$config['max_height']           = 1080;
		$config['overwrite']            = true;
		$config['encrypt_name'] 		= TRUE;

		//$url = 'https://sirs.kemkes.go.id/fo/sisrute_dok/';

		//Upload url_dokumen_kontrak
		if (!empty($_FILES['url_dokumen_kontrak']['name'])) {
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('url_dokumen_kontrak')) {
				print_r($this->upload->display_errors());
				exit;
			}

			$attachment = $this->upload->data();
			$fileName = $attachment['file_name'];

			//$url_dokumen_kontrak =  $url.$fileName;
			$url_dokumen_kontrak =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
		} else {
			if (isset($post['old_url_dokumen_kontrak'])) {
				$url_dokumen_kontrak = $post['old_url_dokumen_kontrak'];
			} else {
				$url_dokumen_kontrak = '';
			}
		}
		// COMMENT SEMENTARA

		//Upload url_surat_tugas
		if (!empty($_FILES['url_surat_tugas']['name'])) {
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('url_surat_tugas')) {
				print_r($this->upload->display_errors());
				exit;
			}

			$attachment = $this->upload->data();
			$fileName = $attachment['file_name'];

			//$url_surat_tugas =  $url.$fileName;
			$url_surat_tugas =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
		} else {
			if (isset($post['old_url_surat_tugas'])) {
				$url_surat_tugas = $post['old_url_surat_tugas'];
			} else {
				$url_surat_tugas = '';
			}
		}
		// COMMENT SEMENTARA

		if (!empty($post['surveior_satu_arr'])) {
			$surveior_satu_arr = $post['surveior_satu_arr'];
			$surveior_satu = null;
			$status_surveior_satu = null;
		} else {
			$surveior_satu_arr = array();
			$surveior_satu = $post['surveior_satu'];
			$status_surveior_satu = 1;
		}

		if (!empty($post['surveior_dua_arr'])) {
			$surveior_dua_arr = $post['surveior_dua_arr'];
			$surveior_dua = null;
			$status_surveior_dua = null;
		} else {
			$surveior_dua_arr = array();
			$surveior_dua = $post['surveior_dua'];
			$status_surveior_dua = 2;
		}

		$datas = array(
			'kelengkapan_berkas_id' => $post['kelengkapan_berkas_id'],
			'url_dokumen_kontrak' => $url_dokumen_kontrak,
			//'tanggal_survei' => date('Y-m-d',strtotime($post['tanggal_survei'])),
			//'metode_survei_id' => $post['metode_survei_id'],
			'url_dokumen_pendukung_ep' => $post['url_dokumen_pendukung_ep'],
			// 'surveior_satu' => $surveior_satu,
			// 'status_surveior_satu' => $status_surveior_satu,
			// 'surveior_dua' => $surveior_dua,
			// 'status_surveior_dua' => $status_surveior_dua,
			'surveior_satu' => $post['surveior_satu'],
			'status_surveior_satu' => $post['status_surveior_satu'],
			'surveior_dua' => $post['surveior_dua'],
			'status_surveior_dua' => $post['status_surveior_dua'],
			'url_surat_tugas' => $url_surat_tugas
		);
		// COMMENT SEMENTARA

		if (!empty($post['penetapan_tanggal_survei_id'])) {
			$where = array('id' => $post['penetapan_tanggal_survei_id']);
			$this->Model_sina->edit_data('penetapan_tanggal_survei', $where, $datas);
			if (!empty($surveior_satu_arr)) {
				$tanggal_rencana_survei = $post['tanggal_rencana_survei'];

				for ($i = 0; $i < count($surveior_satu_arr); $i++) {
					$whereSurveior = array(
						'pengajuan_usulan_survei_id' => $post['id'],
						'tanggal_survei'			 => $tanggal_rencana_survei[$i]
					);

					$updatedSurveior = array(
						'tanggal_survei' => $tanggal_rencana_survei[$i],
						'surveior_1' => $surveior_satu_arr[$i],
						'surveior_2' => $surveior_dua_arr[$i]
					);

					$this->Model_sina->edit_data('pengajuan_usulan_survei_detail', $whereSurveior, $updatedSurveior);
				}
			}
			if (isset($post['id_surveior_lapangan'])) {
				$where_lapangan = array(
					'id' => $post['id_surveior_lapangan'],
				);
				if (isset($post['penggantis1'])) {
					$datalapangan['id_surveior_satu_baru'] = $post['penggantis1'];
					$datalapangan['keterangan_surveior_satu'] = $post['keterangansatu'];
					// UPDATE JADWAL
					if (isset($post['tanggal_1'])) {
						$tanggal1 = $post['tanggal_1'];
						$where_update = array(
							'user_surveior_id' => $post['penggantis1'],
							'jadwal_kesiapan' => $tanggal1
						);
						$dataupdate_jadwal = array(
							'status' => 1,
							'pengajuan_usulan_survei_id' => $post['id']
						);

						// UPDATE TANGGAL1 SURVEIOR 1
						$this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
						// UPDATE TANGGAL1 SURVEIOR 1
					}
					if (isset($post['tanggal_2'])) {
						$tanggal2 = $post['tanggal_2'];
						$where_update = array(
							'user_surveior_id' => $post['penggantis1'],
							'jadwal_kesiapan' => $tanggal2
						);

						$dataupdate_jadwal = array(
							'status' => 1,
							'pengajuan_usulan_survei_id' => $post['id']
						);
						// UPDATE TANGGAL2 SURVEIOR 1
						$this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
						// UPDATE TANGGAL2 SURVEIOR 1
					}
					if (isset($post['tanggal_3'])) {
						$tanggal3 = $post['tanggal_3'];
						$where_update = array(
							'user_surveior_id' => $post['penggantis1'],
							'jadwal_kesiapan' => $tanggal3
						);

						$dataupdate_jadwal = array(
							'status' => 1,
							'pengajuan_usulan_survei_id' => $post['id']
						);
						// UPDATE TANGGAL3 SURVEIOR 1
						$this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
						// UPDATE TANGGAL3 SURVEIOR 1
					}
					// UPDATE JADWAL
				}
				if (isset($post['penggantis2'])) {
					$datalapangan['id_surveior_dua_baru'] = $post['penggantis2'];
					$datalapangan['keterangan_surveior_dua'] = $post['keterangandua'];
					// UPDATE JADWAL
					if (isset($post['tanggal_1'])) {
						$tanggal1 = $post['tanggal_1'];
						$where_update = array(
							'user_surveior_id' => $post['penggantis2'],
							'jadwal_kesiapan' => $tanggal1
						);
						$dataupdate_jadwal = array(
							'status' => 1,
							'pengajuan_usulan_survei_id' => $post['id']
						);

						// UPDATE TANGGAL1 SURVEIOR 2
						$this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
						// UPDATE TANGGAL1 SURVEIOR 2
					}
					if (isset($post['tanggal_2'])) {
						$tanggal2 = $post['tanggal_2'];
						$where_update = array(
							'user_surveior_id' => $post['penggantis2'],
							'jadwal_kesiapan' => $tanggal2
						);
						$dataupdate_jadwal = array(
							'status' => 1,
							'pengajuan_usulan_survei_id' => $post['id']
						);

						// UPDATE TANGGAL2 SURVEIOR 2
						$this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
						// UPDATE TANGGAL2 SURVEIOR 2
					}
					if (isset($post['tanggal_3'])) {
						$tanggal3 = $post['tanggal_3'];

						$where_update = array(
							'user_surveior_id' => $post['penggantis2'],
							'jadwal_kesiapan' => $tanggal3
						);
						$dataupdate_jadwal = array(
							'status' => 1,
							'pengajuan_usulan_survei_id' => $post['id']
						);

						// UPDATE TANGGAL3 SURVEIOR 2
						$this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
						// UPDATE TANGGAL3 SURVEIOR 2
					}
					// UPDATE JADWAL
				}

				$this->Model_sina->edit_data('surveior_lapangan', $where_lapangan, $datalapangan);
			}

			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Ubah Data!');
			redirect('pengajuan/detail/' . $post['id']);
		} else {
			// $this->Model_sina->input_data('penetapan_tanggal_survei', $datas);
			$input_penetapan = $this->Model_sina->input_data_lastid('penetapan_tanggal_survei', $datas);
			// INSERT SURVEIOR LAPANGAN
			$datalapangan = array(
				'penetapan_tanggal_survei_id' => $input_penetapan,
				'id_surveior_satu_lama' => $post['id_surveior_satu'],
				'id_surveior_dua_lama' => $post['id_surveior_dua'],
			);

			if (isset($post['penggantis1'])) {
				$datalapangan['id_surveior_satu_baru'] = $post['penggantis1'];
				$datalapangan['keterangan_surveior_satu'] = $post['keterangansatu'];
				// UPDATE JADWAL
				if (isset($post['tanggal_1'])) {
					$tanggal1 = $post['tanggal_1'];
					$where_update = array(
						'user_surveior_id' => $post['penggantis1'],
						'jadwal_kesiapan' => $tanggal1
					);
					$dataupdate_jadwal = array(
						'status' => 1,
						'pengajuan_usulan_survei_id' => $post['id']
					);

					// UPDATE TANGGAL1 SURVEIOR 1
					$this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
					// UPDATE TANGGAL1 SURVEIOR 1
				}
				if (isset($post['tanggal_2'])) {
					$tanggal2 = $post['tanggal_2'];
					$where_update = array(
						'user_surveior_id' => $post['penggantis1'],
						'jadwal_kesiapan' => $tanggal2
					);

					$dataupdate_jadwal = array(
						'status' => 1,
						'pengajuan_usulan_survei_id' => $post['id']
					);
					// UPDATE TANGGAL2 SURVEIOR 1
					$this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
					// UPDATE TANGGAL2 SURVEIOR 1
				}
				if (isset($post['tanggal_3'])) {
					$tanggal3 = $post['tanggal_3'];
					$where_update = array(
						'user_surveior_id' => $post['penggantis1'],
						'jadwal_kesiapan' => $tanggal3
					);

					$dataupdate_jadwal = array(
						'status' => 1,
						'pengajuan_usulan_survei_id' => $post['id']
					);
					// UPDATE TANGGAL3 SURVEIOR 1
					$this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
					// UPDATE TANGGAL3 SURVEIOR 1
				}
				// UPDATE JADWAL
			}
			if (isset($post['penggantis2'])) {
				$datalapangan['id_surveior_dua_baru'] = $post['penggantis2'];
				$datalapangan['keterangan_surveior_dua'] = $post['keterangandua'];
				// UPDATE JADWAL
				if (isset($post['tanggal_1'])) {
					$tanggal1 = $post['tanggal_1'];
					$where_update = array(
						'user_surveior_id' => $post['penggantis2'],
						'jadwal_kesiapan' => $tanggal1
					);
					$dataupdate_jadwal = array(
						'status' => 1,
						'pengajuan_usulan_survei_id' => $post['id']
					);

					// UPDATE TANGGAL1 SURVEIOR 2
					$this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
					// UPDATE TANGGAL1 SURVEIOR 2
				}
				if (isset($post['tanggal_2'])) {
					$tanggal2 = $post['tanggal_2'];
					$where_update = array(
						'user_surveior_id' => $post['penggantis2'],
						'jadwal_kesiapan' => $tanggal2
					);
					$dataupdate_jadwal = array(
						'status' => 1,
						'pengajuan_usulan_survei_id' => $post['id']
					);

					// UPDATE TANGGAL2 SURVEIOR 2
					$this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
					// UPDATE TANGGAL2 SURVEIOR 2
				}
				if (isset($post['tanggal_3'])) {
					$tanggal3 = $post['tanggal_3'];

					$where_update = array(
						'user_surveior_id' => $post['penggantis2'],
						'jadwal_kesiapan' => $tanggal3
					);
					$dataupdate_jadwal = array(
						'status' => 1,
						'pengajuan_usulan_survei_id' => $post['id']
					);

					// UPDATE TANGGAL3 SURVEIOR 2
					$this->Model_sina->edit_data('jadwal_surveior', $where_update, $dataupdate_jadwal);
					// UPDATE TANGGAL3 SURVEIOR 2
				}
				// UPDATE JADWAL
			}

			$this->Model_sina->input_data('surveior_lapangan', $datalapangan);
			// var_dump($datalapangan);
			// INSERT SURVEIOR LAPANGAN

			$this->session->set_flashdata('kode_name', 'success');
			$this->session->set_flashdata('icon_name', 'check');
			$this->session->set_flashdata('message_name', 'Sukses Input Data!');
			redirect('pengajuan/detail/' . $post['id']);
		}
		// COMMENT SEMENTARA

	}

	public function simpanPenetapanVerifikator()
	{
		$post = $this->input->post();
		$this->load->library('form_validation');
		$this->load->helper('security');
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$datas = array(
				'pengiriman_laporan_survei_id' => $post['pengiriman_laporan_survei_id'],
				'users_id' => $post['users_id']
			);

			if (!empty($post['penetapan_verifikator_id'])) {
				$where = array(
					'id' => $post['penetapan_verifikator_id']
				);

				$this->Model_sina->edit_data('penetapan_verifikator', $where, $datas);
				$this->session->set_flashdata('kode_name', 'success');
				$this->session->set_flashdata('icon_name', 'check');
				$this->session->set_flashdata('message_name', 'Sukses Ubah Data!');

				redirect('pengajuan/detail/' . $post['id']);
			} else {
				$this->Model_sina->input_data('penetapan_verifikator', $datas);

				$this->session->set_flashdata('kode_name', 'success');
				$this->session->set_flashdata('icon_name', 'check');
				$this->session->set_flashdata('message_name', 'Sukses Input Data!');

				// redirect('pengajuan');
				redirect('pengajuan/detail/' . $post['id']);
			}
		}
	}

	public function hapus()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$id = $this->uri->segment(3);
			$this->Model_sina->delete_pengajuan($id);
			redirect('pengajuan');
		}
	}




	public function surveior()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');
		$lpa_id = $this->session->userdata('lpa_id');
		if ($this->session->userdata('lpa_id') != TRUE) {
			redirect('login/logout');
		} else {

			$data = array(
				'content' => 'surveior',
				'data' => $this->Model_viewdata->get_data_surveior($lpa_id)->result_array(),
				'lpa_id' => $this->session->userdata('lpa_id')
			);
			// if(!empty($lpa_id)){
			$this->load->view('surveior', $data);
			// }else{
			// 	redirect('Login');
			// }
		}
	}

	public function inputsurveiornew()
	{

		$data = array(
			'content',
			'data' => $this->Model_viewdata->get_data_fasyankes()->result_array(),
			'lpa_id' => $this->session->userdata('lpa_id')
		);
		$this->load->view('input_surveior_new', $data);
	}

	public function inputsurveior()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
			$data = array(
				'content',
				'data' => $this->Model_viewdata->get_data_bidang()->result_array(),
				'datav' => $this->Model_viewdata->get_data_fasyankes()->result_array(),
				'lpa_id' => $this->session->userdata('lpa_id')
			);
			$this->load->view('input_surveior', $data);
		}
	}



	public function simpanSurveior()
	{
		// var_dump($this->input->post());

		$this->load->library('form_validation');
		$this->load->helper('security');
		if ($this->session->userdata('logged') != TRUE) {
			redirect('login/logout');
		} else {
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

			//$url = 'https://sirs.kemkes.go.id/fo/sisrute_dok/';

			//Upload url_sertifikat_surveior
			if (!empty($_FILES['url_sertifikat_surveior']['name'])) {
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('url_sertifikat_surveior')) {
					print_r($this->upload->display_errors());
					exit;
				}
				$attachment = $this->upload->data();
				$fileName = $attachment['file_name'];

				//$url_sertifikat_surveior =  $url.$fileName;
				$url_sertifikat_surveior =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
			} else {
				if (isset($post['old_url_sertifikat_surveior'])) {
					$url_sertifikat_surveior = $post['old_url_sertifikat_surveior'];
				} else {
					$url_sertifikat_surveior = '';
				}
			}

			//Upload url_surat_keputusan_keanggotaan
			if (!empty($_FILES['url_surat_keputusan_keanggotaan']['name'])) {
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('url_surat_keputusan_keanggotaan')) {
					print_r($this->upload->display_errors());
					exit;
				}
				$attachment = $this->upload->data();
				$fileName = $attachment['file_name'];

				//$url_dokumen_kontrak =  $url.$fileName;
				$url_surat_keputusan_keanggotaan =  base_url('assets/uploads/berkas_akreditasi/' . $fileName);
			} else {
				if (isset($post['old_url_surat_keputusan_keanggotaan'])) {
					$url_surat_keputusan_keanggotaan = $post['old_url_surat_keputusan_keanggotaan'];
				} else {
					$url_surat_keputusan_keanggotaan = '';
				}
			}
			$datab = array(
				'nik' => $post['nik'],
				// 'id' => $users_id,
				'nama' => $post['nama'],
				'email' => $post['email'],
				'username' => $post['email'],
				'password' => $pwd,
				'kriteria_id' => '3',
				'lpa_id' => $this->session->userdata('lpa_id'),
				'user_status' => '1',
				'validate' => '2',
				'password_enkripsi' => $hashed

			);

			if (!empty($post['id'])) {
				// var_dump($this->input->post());
				$wheres = array(
					'id' => $post['users_id'],
				);
				$wheref = array(
					'users_id' => $post['id'],
				);
				$datac = array(
					// 'nik' =>$post['nik'],
					'nama' => $post['nama']
					// 'email' =>$post['email'],
					// 'username' =>$post['email']

				);

				$this->Model_sina->edit_data('users', $wheres, $datac);
				$users_id = $this->db->insert_id();
				$datas = array(
					// 'nik' =>$post['nik'],
					'nama' => $post['nama'],
					// 'email' =>$post['email'],
					'no_hp' => $post['no_hp'],
					'provinsi_id' => $post['propinsi'],
					'kabkota_id' => $post['kota'],
					'keaktifan' => $post['keaktifan'],
					'url_sertifikat_surveior' => $url_sertifikat_surveior,
					'url_surat_keputusan_keanggotaan' => $url_surat_keputusan_keanggotaan

				);
				$this->Model_sina->edit_data('user_surveior', $wheref, $datas);

				// $id_user_surveior = $this->db->insert_id();
				// $fasyankes_id = $this->db->insert_id();
				// $bidang_id = $this->db->insert_id();

				// 	// if ($idfasyankes == $ids) {
				// 	// 	// echo 'sama';
				// 	// 	$where = array(
				// 	// 		'users_id' => $post['users_id'],
				// 	// 		'id_bidang' => $ids
				// 	// 	);
				// 	// 	$databi = array(
				// 	// 		'is_checked' => '1'
				// 	// 	);
				// 	// 	// if (isset($post['fasyankes_id'][$ids]) && $post['bidangid'][$ids] == 1) {
				// 	// 	// 	// echo '1';
				// 	// 	// 	$databi = array(
				// 	// 	// 		'is_checked' => '1'
				// 	// 	// 	);
				// 	// 	// } else {
				// 	// 	// 	// echo '0';
				// 	// 	// 	$databi = array(
				// 	// 	// 		'is_checked' => '0'
				// 	// 	// 	);
				// 	// 	// }

				// 	// 	// var_dump($databi);
				// 	// 	// var_dump($where);
				// 	// 	// $this->Model_sina->edit_data('user_surveior_bidang_detail', $where, $databi);
				// 	// } else {
				// 	// 	$where = array(
				// 	// 		'users_id' => $post['users_id'],
				// 	// 		'id_bidang' => $ids
				// 	// 	);
				// 	// 	$databi = array(
				// 	// 		'is_checked' => '0'
				// 	// 	);
				// 	// 	// var_dump($databi);
				// 	// 	// var_dump($where);
				// 	// }
				// 	// var_dump($databi);
				// 	// echo '|batas|';
				// 	}
				// 	// $query = $this->Model_sina->edit_data('user_surveior_bidang_detail', $where, $databi);
				// 	// var_dump($query);
				// 	// var_dump($where);
				// 	// var_dump($databi);
				// 	// $databi = array(

				// 	// 	'is_checked' => (!empty($post['is_checked'][$ids]) ? $post['is_checked'][$ids] : 0)

				// 	// );
				// 	// var_dump($where);
				// 	// var_dump($databi);

				// 	// 	// $this->Model_sina->input_data('user_surveior_fasyankes_detail',$dataf);
				// 	// var_dump($query);
				// }

				$uniqfasyankes = [];
				$uniqfasyankes = array_unique($post['fasyankes']);
				$count = 0;
				$query = [];
				foreach ($post['id_bidang'] as $bidangid) {
					$choose = "";
					$where = array(
						'users_id' => $post['users_id'],
						'id_bidang' => $bidangid
					);
					foreach ($uniqfasyankes as $fasyankesid) {
						// echo $fasyankesid;
						if (isset($post['fasyankes_id'][$fasyankesid]) && $post['fasyankes_id'][$fasyankesid] == $bidangid) {
							$choose = 'true';
						}
					}
					if ($choose == true) {
						$databi = array(
							'is_checked' => '1'
						);
					} else {
						$databi = array(
							'is_checked' => '0'
						);
						$count++;
					}

					$query[] = array(
						'where' => $where,
						'data' => $databi
					);
				}
				// echo ($count);
				// var_dump($query);
				if ($count < 10) {
					foreach ($query as $query) {
						$this->Model_sina->edit_data('user_surveior_bidang_detail', $query['where'], $query['data']);
						// var_dump($test);
					}

					$this->session->set_flashdata('kode_name', 'success');
					$this->session->set_flashdata('icon_name', 'check');
					$this->session->set_flashdata('message_name', 'Sukses Ubah Data!');
					redirect('Pengajuan/editsurveior/' . $post['id_user_surveior']);
				} else {
					// var_dump($this->input->post('id_user_surveior'));
					// echo $post['id_user_surveior'];

					$this->session->set_flashdata('kode_name', 'Failed');
					$this->session->set_flashdata('icon_name', 'cross');
					$this->session->set_flashdata('message_name', 'Gagal Ubah Data, Pilih Salah Satu Bidang!');
					redirect('Pengajuan/editsurveior/' . $post['id_user_surveior']);
					// echo "<script type='text/javascript'>alert('Gagal Pilih Salah Satu Bidang !');</script>";
				}

				// $this->session->set_flashdata('kode_name', 'success');
				// $this->session->set_flashdata('icon_name', 'check');
				// $this->session->set_flashdata('message_name', 'Sukses Ubah Data!');

				// redirect('pengajuan/surveior/' . $post['id']);
			} else {
				if (!empty($post['is_checked'])) {
					$this->Model_sina->input_data('users', $datab);
					// $message1 = "sudah benar";
					// 	echo "<script type='text/javascript'>alert('$message1');</script>";
					$users_id = $this->db->insert_id();
					$no = 1;
					$datas = array(
						'nik' => $post['nik'],
						'users_id' => $users_id,
						'nama' => $post['nama'],
						'email' => $post['email'],
						'no_hp' => $post['no_hp'],
						'lpa_id' => $this->session->userdata('lpa_id'),
						'provinsi_id' => $post['propinsi'],
						'kabkota_id' => $post['kota'],
						'keaktifan' => $post['keaktifan'],
						'fasyankes_id' => $no,
						'bidang_id'		=> $no,
						'url_sertifikat_surveior' => $url_sertifikat_surveior,
						'url_surat_keputusan_keanggotaan' => $url_surat_keputusan_keanggotaan

					);

					//$users_ida = $this->Model_sina->getLastID('users',$users_id);
					// $datas['users_id'] = $users_id;
					// $message2 = "Sudah benar 2";
					// 	echo "<script type='text/javascript'>alert('$message2');</script>";
					$this->Model_sina->input_data('user_surveior', $datas);
					$id_user_surveior = $this->db->insert_id();
					$fasyankes_id = $this->db->insert_id();
					$bidang_id = $this->db->insert_id();

					foreach ($post['id_bidang'] as $ids) {
						$databi = array(

							'id_user_surveior' => $id_user_surveior,
							'users_id' => $users_id,
							'id_fasyankes_surveior' => $post['fasyankes'][$ids],
							'id_bidang' => $ids,
							'is_checked' => (!empty($post['is_checked'][$ids]) ? $post['is_checked'][$ids] : 0),
							'nama_bidang' => $post['nama_bidang'][$ids]

						);
						// $this->Model_sina->input_data('user_surveior_fasyankes_detail',$dataf);
						$response = $this->Model_sina->input_data('user_surveior_bidang_detail', $databi);
					}
					// redirect('pengajuan/surveior');
					if ($response == true) {
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
						$message .= '<p>Account Surveior Lembaga anda telah di validasi, </p>';
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
							'smtp_host' => 'ssl://proxy.kemkes.go.id',
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
							// 							// 	'!%2C%20Account%20Surveior%20Fasyankes%20anda%20telah%20aktif%2C%20Silahkan%20login%20pada%20halaman%20website%20%3A%20http%3A%2F%2Fperizinan.yankes.kemkes.go.id%2Fsina%2F%20.%20%0AMenggunakan%Username%20%3A%20'. $emailpengguna .'%20Dan%20Menggunakan%20password%20%3A%2012345%20%20%20%20%20%0AIf%20you%20need%20help%2C%20please%20contact%20the%20site%20administrator.',
							// 							CURLOPT_POSTFIELDS => 'sender=sinaf&number=' . $notelp . '&message=Hallo ' . $namapengguna .' !!!

							// Akun Surveior anda telah aktif. Silahkan login  aplikasi SINAF sinaf.kemkes.go.id menggunakan :
							// 	Username : '. $emailpengguna .'
							// 	password : '. $pwd . '

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
							redirect('pengajuan/surveior');
							// 						} else {
							// 							echo $response;
							// 						}


							// WHATSAPP


						} else {
							show_error($this->email->print_debugger());
						}
					} else {
						echo $response;
					}
				} else {
					$message = "Data Bidang harus diisi";
					echo "<script type='text/javascript'>alert('$message');</script>";
					die(redirect('pengajuan/inputsurveior', 'refresh'));
				}
				//redirect('pengajuan/verifikator');

			}
		}
	}
		public function editsurveior()
		{
			$id = $this->uri->segment(3);
			$trans = $this->Model_sina->select_surveior_detail($id);
			$trans = array_column($trans,null,"id_bidang");
			$data = array('content' =>'edit_surveior',
					'data' => $this->Model_sina->select_surveior($id),
					'datab' => $this->Model_viewdata->get_data_bidang()->result_array(),
					'datac' => $trans,
					'id' => $id
						  );
			$this->load->view('edit_surveior', $data);
			// var_dump($data['data']);
			// var_dump($data['datab']);
			// var_dump($data['datac']);
		}

		public function hapussurveior()
		{
			$id = $this->uri->segment(3);
			$notelp = $this->uri->segment(4);
			// $namapengguna = $this->uri->segment(5);
			 //$emailpengguna = $this->uri->segment(5);
			

			// $rest = $this->Model_sina->delete_surveior($id);
			// if($rest == true){
				//echo $no_telp;
					// WHATSAPP
		
		
					$curl = curl_init();
		
					curl_setopt_array($curl, array(
						CURLOPT_URL => 'http://192.168.48.124:8000/send-message',
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'POST',
						// CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo%2C%20' . $namapengguna .
						//     '!%2C%20Account%20Verifikator%20Fasyankes%20anda%20telah%20aktif%2C%20Silahkan%20login%20pada%20halaman%20website%20%3A%20http%3A%2F%2Fperizinan.yankes.kemkes.go.id%2Fsina%2F%20.%20%0AMenggunakan%Username%20%3A%20'. $emailpengguna .'%20Dan%20Menggunakan%20password%20%3A%2012345%20%20%20%20%20%0AIf%20you%20need%20help%2C%20please%20contact%20the%20site%20administrator.',
						CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo !. Account Verifikator Fasyankes anda telah Dihapus. If you need help please contact the site administrator.',
						CURLOPT_HTTPHEADER => array(
							'Content-Type: application/x-www-form-urlencoded'
						),
					));
		
					$response = curl_exec($curl);
		
					curl_close($curl);
					$res = json_decode($response, true);
					// echo $response;
					if ($res['status'] == TRUE) {
						echo '1';
						$rest = $this->Model_sina->delete_surveior($id);
						
						if ($rest == TRUE) {
							echo '1';
							
							redirect('pengajuan/surveior');
						} else {
							echo $rest;
						}
					} else {
						echo $response;
					}
		
		
					// WHATSAPP
		
		
				// } else {
				// 	//show_error($this->email->print_debugger());
				// }
				

			
		}
	
	
	public function verifikator()
		{
			$lpa_id = $this->session->userdata('lpa_id');
			$data = array('content' =>'verifikator',
					'data' => $this->Model_viewdata->get_data_verifikator($lpa_id)->result_array(),
					'lpa_id' => $this->session->userdata('lpa_id')
						  );
			$response = $this->load->view('verifikator',$data);
			// $this->load->view('verifikator');
			
		}
	
	public function inputverifikator()
	{
	$this->load->view('input_verifikator');
	}
	public function editverifikator()
		{
			$id = $this->uri->segment(3);
			$data = array('content' =>'edit_verifikator',
					'data' => $this->Model_sina->select_verifikator($id),
					'id' => $id
						  );
			$this->load->view('edit_verifikator', $data);
		}
		public function simpanVerifikator()
		{
			
  			$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
			$pwd = substr(str_shuffle($data), 0, 7);
			$post = $this->input->post();
			$users_id = $this->session->userdata('id');
			$lpa_id = $this->session->userdata('lpa_id');
			
			$datab = array(
				'nik' =>$post['nik'],
				// 'id' => $users_id,
				'nama' =>$post['nama'],
				'email' =>$post['email'],
				'username' =>$post['email'],
				'password' =>$pwd,
				'kriteria_id' => '4',
				'validate' => '2',
				'user_status' => '1',
				'lpa_id' =>$lpa_id
	
			);
			// $this->Model_sina->input_data('users',$datab);
			// $users_id = $this->db->insert_id();
			
			
			// $users_ida = $this->Model_sina->getLastID('users',$users_id);
			// // $datas['users_id'] = $users_id;
			// $this->Model_sina->input_data('user_verifikator',$datas);
			// redirect('pengajuan/verifikator');

			if(!empty($post['id'])){
				$where = array(
					'id' =>$post['id'],
					
					);
					$wheres = array(
						'id' =>$post['users_id'],
						
						);
					$datac = array(
						'nik' =>$post['nik'],
						'nama' =>$post['nama'],
						'email' =>$post['email'],
						'username' =>$post['email']
						
						);
	
				$this->Model_sina->edit_data('users',$wheres,$datac);
				$users_id = $this->db->insert_id();
				$datas = array(
					'nik' =>$post['nik'],
					
					'nama' =>$post['nama'],
					'email' =>$post['email'],
					'no_hp' =>$post['no_hp']
					);
				 $this->Model_sina->edit_data('user_verifikator',$where,$datas);

				$this->session->set_flashdata('kode_name', 'success');
				$this->session->set_flashdata('icon_name', 'check');
				$this->session->set_flashdata('message_name', 'Sukses Ubah Data!');
	
				 redirect('pengajuan/verifikator/'.$post['id']);
				// if($response == true){
				// 	redirect(base_url('Mail/useractive'));
				// }else{
				// 	echo $response;
				// }
			} else {
				$this->Model_sina->input_data('users',$datab);
			$users_id = $this->db->insert_id();
			$datas = array(
				'nik' =>$post['nik'],
				'users_id' => $users_id,
				'nama' =>$post['nama'],
				'email' =>$post['email'],
				'no_hp' =>$post['no_hp']
				);
				$responsed =$this->Model_sina->input_data('user_verifikator',$datas);
			
	
				$this->session->set_flashdata('kode_name', 'success');
				$this->session->set_flashdata('icon_name', 'check');
				$this->session->set_flashdata('message_name', 'Sukses Input Data!');
				
		if($responsed == true){
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
        $message .= '<p>Account Verifikator Lembaga anda telah di validasi, </p>';
        $message .= '<p>Silahkan login pada halaman website : 103.74.143.45/sina .</p>';
        $message .= '<p><b>Menggunakan Username : '. $emailpengguna . '  dan Menggunakan password : '. $pwd . ' </b></p>';
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
            'smtp_host' => 'ssl://proxy.kemkes.go.id',
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


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://192.168.48.124:8000/send-message',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                // CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo%2C%20' . $namapengguna .
                //     '!%2C%20Account%20Verifikator%20Fasyankes%20anda%20telah%20aktif%2C%20Silahkan%20login%20pada%20halaman%20website%20%3A%20http%3A%2F%2Fperizinan.yankes.kemkes.go.id%2Fsina%2F%20.%20%0AMenggunakan%Username%20%3A%20'. $emailpengguna .'%20Dan%20Menggunakan%20password%20%3A%2012345%20%20%20%20%20%0AIf%20you%20need%20help%2C%20please%20contact%20the%20site%20administrator.',
                CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo ' . $namapengguna .
							'!. Account Verifikator Fasyankes anda telah aktif. Silahkan login pada halaman website http://perizinan.yankes.kemkes.go.id/sina . Menggunakan Username : '. $emailpengguna .' Dan Menggunakan password : '. $pwd . '. If you need help please contact the site administrator.',
				CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $res = json_decode($response, true);
            // echo $response;
            if ($res['status'] == TRUE) {
                echo '1';
				redirect('pengajuan/verifikator');
            } else {
                echo $response;
            }


            // WHATSAPP


        } else {
            show_error($this->email->print_debugger());
        }
		}else{
					echo $response;
		}
				//redirect('pengajuan/verifikator');
	
		}
		}
	
	public function hapusverifikator()
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
		
		
					$curl = curl_init();
		
					curl_setopt_array($curl, array(
						CURLOPT_URL => 'http://192.168.48.124:8000/send-message',
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 10,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'POST',
						// CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo%2C%20' . $namapengguna .
						//     '!%2C%20Account%20Verifikator%20Fasyankes%20anda%20telah%20aktif%2C%20Silahkan%20login%20pada%20halaman%20website%20%3A%20http%3A%2F%2Fperizinan.yankes.kemkes.go.id%2Fsina%2F%20.%20%0AMenggunakan%Username%20%3A%20'. $emailpengguna .'%20Dan%20Menggunakan%20password%20%3A%2012345%20%20%20%20%20%0AIf%20you%20need%20help%2C%20please%20contact%20the%20site%20administrator.',
						CURLOPT_POSTFIELDS => 'sender=sirs&number=' . $notelp . '&message=Hallo !. Account Verifikator Fasyankes  anda telah Dihapus. If you need help please contact the site administrator.',
						CURLOPT_HTTPHEADER => array(
							'Content-Type: application/x-www-form-urlencoded'
						),
					));
		
					$response = curl_exec($curl);
		
					curl_close($curl);
					$res = json_decode($response, true);
					// echo $response;
					if ($res['status'] == TRUE) {
						echo '1';
						$rest = $this->Model_sina->delete_verifikator($id);
						
						if ($rest == TRUE) {
							echo '1';
							
							redirect('pengajuan/verifikator');
						} else {
							echo $rest;
						}
					} else {
						echo $response;
					}
		}
	public function userketualpa()
		{
			
			$data = array('content' =>'user_ketua_lpa',
					'data' => $this->Model_viewdata->get_data_pengajuan(1)->result_array()
						  );
			$this->load->view('user_ketua_lpa',$data);
		}
	
	public function userkemenkes()
		{
			
			$data = array('content' =>'user_kemenkes',
					'data' => $this->Model_viewdata->get_data_pengajuan(1)->result_array()
						  );
			$this->load->view('user_kemenkes',$data);
		}
		public function dropdown5($id=null,$filters='') {
			//if ($this->input->is_ajax_request()) {
				//$this->load->model('helpdesksubprojectmodel');
				$filters .= "id_prop = '".urldecode($id)."' ";
				$order = " nama_kota ASC";
				
				$rsData = $this->Model_sina->get_kab_kota_by_prop($filters, $order);//exit(show_last_query());
				echo json_encode($rsData);
			//}
			return;
		}

		function detailsurveior()
    {
        // load table library
        $this->load->library('table');
        
        // set heading
        $this->table->set_heading('#', 'First Name', 'Last Name', 'Email-ID', 'Credits');

        // set template
        $style = array('table_open'  => '<table class="table table-striped table-hover">');
        $this->table->set_template($style);

        echo $this->table->generate($this->db->get('user_surveior'));
    }

	public function checkemail($email)
    {
        // echo $email;
        $decodeemail = urldecode($email);
        // $checkemail = $this->input->post('email_user');
        $check = $this->Model_sina->checkmail($decodeemail);
        echo $check;
    }
	public function checknama($email)
    {
        // echo $email;
        $decodeemail = urldecode($nama);
        // $checkemail = $this->input->post('email_user');
        $check = $this->Model_sina->checkemails($decodeemail);
        echo $check;
    }
	// public function checknik($nik)
    // {
    //     // echo $email;
    //     $decodeemail = urldecode($nik);
    //     // $checkemail = $this->input->post('email_user');
    //     $check = $this->Model_sina->checknik($decodeemail);
    //     echo $check;
    // }
    public function getIkp()
    {
		$getdata = $this->input->get();
		$fasyankesName = $this->fasyankesMapper();
		
        $url = "https://mutufasyankes.kemkes.go.id/api/status_ikp/{$getdata['id']}/{$fasyankesName}";
        $jsonResponse = $this->restHandler('GET', $url, false, false, true);
        $response = json_decode($jsonResponse);
		
		$month = date('n');

		foreach($response as $item) {
			if(in_array($item->jenis, ['nihil', 'ikp'])) {
				$item->jenis = 'Melapor';
			}
			else if($month > $item->bulan) {
				$item->tahun = date('Y');
				$item->jenis = 'Tidak Melapor';
			}
		}
        
        echo json_encode($response);
    }

    public function getInm()
    {
		$getdata = $this->input->get();
		$fasyankesName = $this->fasyankesMapper();

		$url = "https://mutufasyankes.kemkes.go.id/api/status_inm/{$getdata['id']}/{$fasyankesName}";
        $jsonResponse = $this->restHandler('GET', $url, false, false, true);
        $response = json_decode($jsonResponse);

		if(isset($response->Code) && isset($response->pesan)){
			echo json_encode([]);exit;
		}

        foreach($response as $item) {
			if(isset($item->bulan)) {
				$item->bulan = $this->parseToMonth($item->bulan);
			}
        }
        
        echo json_encode($response);
    }

	public function getAspakId()
	{
		$code = null;
		$getdata = $this->input->get();
		if(!isset($getdata['code'])) {
			echo json_encode([]);exit;
		}
		$code = $getdata['code'];
		
		$url = "http://dwh-aspak.kemkes.go.id/aspakresume/checkfaskes?code={$code}";
        $jsonResponse = $this->restHandler('GET', $url, false, false, false, true);
        $response = json_decode($jsonResponse);

		echo json_encode($response);
	}

	public function getAspakResume()
	{
		$id = null;
		$action = null;
		$getdata = $this->input->get();
		if(!isset($getdata['id']) || !isset($getdata['action'])) {
			echo json_encode([]);exit;
		}
		$id = $getdata['id'];
		$action = $getdata['action'];
		
		$url = "http://dwh-aspak.kemkes.go.id/aspakresume/pkm/{$action}?id={$id}";
        $jsonResponse = $this->restHandler('GET', $url, false, false, false, true);
        $response = json_decode($jsonResponse);
        
        echo json_encode($response);
	}

	private function fasyankesMapper()
	{
		$getdata = $this->input->get();
		$jenisFasyankesMapper = [
			'Tempat Praktik Mandiri Nakes' => null,
			'Pusat Kesehatan Masyarakat' => 'puskes',
			'Klinik' => null,
			'Unit Transfusi Darah' => 'utd',
			'Laboratorium Kesehatan' => 'lab',
		];
		$fasyankesName = null;
		
		if(!isset($getdata['id']) || !isset($getdata['nama'])) {
			echo json_encode([]);exit;
		}
		
		foreach($jenisFasyankesMapper as $fasyankes => $label)
		{
			if($fasyankes == $getdata['nama'] && $label !== null) {
				$fasyankesName = $label;
			}
		}

		if(!$fasyankesName) {
			echo json_encode([]);exit; 
		}

		return $fasyankesName;
	}

    private function parseToMonth($month)
    {
        switch($month) {
            case 1: return 'Januari'; break;
            case 2: return 'Februari'; break;
            case 3: return 'Maret'; break;
            case 4: return 'April'; break;
            case 5: return 'Mei'; break;
            case 6: return 'Juni'; break;
            case 7: return 'Juli'; break;
            case 8: return 'Agustus'; break;
            case 9: return 'September'; break;
            case 10: return 'Oktober'; break;
            case 11: return 'November'; break;
            case 12: return 'Desember'; break;
        }
    }

    private function restHandler($method, $url, $data = false, $contentType= false, $withHeaders = false, $withToken = false)
    {
        $curl = curl_init();
    
        if($withHeaders)
        {
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'X-Id: mutukemenkes',
                'X-Pass: rsonline!@#$',
                'X-Timestamp: '.strtotime(date('Y-m-d H:i:s')).'',
            ]);
        }

		if($withToken)
		{
			curl_setopt($curl, CURLOPT_HTTPHEADER, [
				'Authorization: Bearer dJb6uphMP4VjJnoSsIqmZygjgxYSDI442dKWkNPtoPLLBiNzvFzSeSJogyEZbSxLqiif1IGMSVXcZgnkgiZDcXCWkjSJetJLCegE_1635140555',
			]);
		}
    
        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data){
                    if($contentType){
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                            'Content-Type: '.$contentType
                        ));
                    }
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
    
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0);

        // enable this if need to debugging
        // curl_setopt($curl, CURLOPT_VERBOSE, true);

        // $streamVerboseHandle = fopen('php://temp', 'w+');
        // curl_setopt($curl, CURLOPT_STDERR, $streamVerboseHandle);

        $result = curl_exec($curl);

        // if ($result === FALSE) {
        //     printf("cUrl error (#%d): %s<br>\n",
        //            curl_errno($curl),
        //            htmlspecialchars(curl_error($curl)))
        //            ;
        // }
        
        // rewind($streamVerboseHandle);
        // $verboseLog = stream_get_contents($streamVerboseHandle);
        
        // echo "cUrl verbose information:\n", 
        //      "<pre>", htmlspecialchars($verboseLog), "</pre>\n";
    
        curl_close($curl);
    
        return $result;
    }

}