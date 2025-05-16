<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Model_monitoring extends CI_Model
{

	function select_pengajuan_search_monitoring($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes)
	{
		if (!empty($lpa_id) && $lpa_id != 9999) {
			$lpa_id = " AND a.lpa_id='" . $lpa_id . "'";
		} else {
			$lpa_id = "";
		}

		if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
			$tanggal_awal = " AND (a.tanggal_pengajuan BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "' )";
		} else {
			$tanggal_awal = "";
		}

		if (!empty($propinsi) && $propinsi != 9999) {
			if ($jenis_fasyankes == 2) {
				$propinsi2 = " AND pp.provinsi_code = '" . (int)$propinsi . "'";
			} else {
				$propinsi2 = " AND propinsi.id_prop='" . (int)$propinsi . "'";
			}
		} else {
			$propinsi2 = "";
		}

		if (!empty($kota) && $kota != 9999) {
			if ($jenis_fasyankes == 2) {
				// $kota = " AND dbfaskes.daftar_puskesmas.kode_kabupaten ='" . (int)$kota . "'";
				$kota = " AND pp.kabkot_code ='" . (int)$kota . "'";
			} else {
				$kota = " AND kota.id_kota='" . (int)$kota . "'";
			}
		} else {
			$kota = "";
		}

		if (!empty($jenis_fasyankes)) {
			$jenis_fasyankes2 = " AND a.jenis_fasyankes='" . $jenis_fasyankes . "'";
		} else {
			$jenis_fasyankes2 = " AND a.jenis_fasyankes='99'";
		}

		$raw_user_id = $jenis_fasyankes2 . $lpa_id . $tanggal_awal . $propinsi2 . $kota;

		if ($jenis_fasyankes == 1 || $jenis_fasyankes == null) {
			$sql = $this->db->query("SELECT
					a.*,
					b.status_usulan_id,
					b.keterangan,
					h.nama AS status_usulan,
					c.nama AS jenis_fasyankes_nama,
					d.nama AS jenis_survei,
					e.nama AS jenis_akreditasi,
					f.nama AS status_akreditasi,
					g.nama AS lpa,
					trans_final.kode_faskes AS kode_faskes,
					trans_final.id_faskes AS id_faskes,
					trans_final.kode_faskes AS kode_faskes,
					trans_final.kode_faskes_baru AS fasyankes_id_baru,
					trans_final.id_faskes AS id_faskes,
					data_pm.nama_pm AS nama_fasyankes,
					data_pm.id_prov_pm AS provinsi_id,
					propinsi.id_prop AS id_prop,
					propinsi.nama_prop AS nama_prop,
					data_pm.id_kota_pm AS kabkota_id,
					kota.id_kota AS id_kota,
					kota.nama_kota AS nama_kota,
					i.penerimaan_pengajuan_usulan_survei_id,
					i.url_surat_permohonan_survei,
					i.url_profil_fasyankes,
					i.url_laporan_hasil_penilaian_mandiri,
					i.url_pps_reakreditasi,
					i.url_surat_usulan_dinas,
					i.update_dfo,
					i.update_aspak,
					i.update_sisdmk,
					i.update_inm,
					i.update_ikp,
					i.id AS berkas_usulan_survei_id,
					j.id AS kelengkapan_berkas_id,
					j.kelengkapan_berkas_usulan,
					j.kelengkapan_berkas_usulan_catatan,
					j.kelengkapan_dfo,
					j.kelengkapan_dfo_catatan,
					j.kelengkapan_sarpras_alkes,
					j.kelengkapan_sarpras_alkes_catatan,
					j.kelengkapan_nakes,
					j.kelengkapan_nakes_catatan,
					j.kelengkapan_laporan_inm,
					j.kelengkapan_laporan_inm_catatan,
					j.kelengkapan_laporan_ikp,
					j.kelengkapan_laporan_ikp_catatan,
					k.kelengkapan_berkas_id as kelengkapan_berkas_id_2,
					k.id as penetapan_tanggal_survei_id,
					k.url_dokumen_kontrak,
					k.url_surat_tugas,
					k.tanggal_survei,
					k.url_dokumen_pendukung_ep,
					k.surveior_satu,
					k.status_surveior_satu,
					k.surveior_dua,
					k.status_surveior_dua,
					l.final AS status_final_ep,
					m.id AS pengiriman_laporan_survei_id,
					m.tanggal_survei_satu,
					m.tanggal_survei_dua,
					m.tanggal_survei_tiga,
					m.url_bukti_satu,
					m.url_bukti_dua,
					m.url_bukti_tiga,
					pus.id as pengajuan_usulan_survei_id_monitor,
					ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
					bus.id as berkas_usulan_survei_id_monitor,
					kb.id as kelengkapan_berkas_id_monitor,
					pts.id as penetapan_tanggal_survei_id_monitor,
					tfes.id as trans_final_ep_surveior_id_monitor,
					pls.id as pengiriman_laporan_survei_id_monitor,
					pv.id as penetapan_verifikator_id_monitor,
					tfev.id as trans_final_ep_verifikator_id_monitor,
					pr.id as pengiriman_rekomendasi_id_monitor,
					td.id as penerbitan_sertifikat_id_monitor,
					sr.nama as status_akreditasi_nama,
					( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pengajuan_usulan_survei_id = a.id ) AS tanggal_survei,
						IF
							(
								b.id IS NULL,
								'Pengajuan Usulan Survei',
							IF
								(
									i.id IS NULL,
									'Respon LPA',
								IF
									(
										j.id IS NULL,
										'Kesiapan Survei',
									IF
										(
											k.id IS NULL,
											'Hasil Kesiapan Survei',
										IF
											(
												l.id IS NULL,
												'Kesepakatan Survei',
											IF
												(
													m.id IS NULL,
													'Penilaian EP Surveior',
												IF
													(
														pv.id IS NULL,
														'Pengiriman Laporan',
													IF
														(
															tfev.id IS NULL,
															'Penugasan Verifikator',
														IF
														( pr.id IS NULL, 'Penilaian EP Verifikator', 
															IF 
															( td.id IS NULL , 'Pengiriman Rekomendasi' , 'Penerbitan Sertifikat')))))))))) AS tahap
				FROM
					pengajuan_usulan_survei a
					LEFT JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
					JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
					JOIN jenis_survei d ON a.jenis_survei_id = d.id
					JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
					JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
					JOIN lpa g ON a.lpa_id = g.id
					JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
					JOIN dbfaskes.data_pm ON dbfaskes.trans_final.id_faskes = dbfaskes.data_pm.id_faskes
					JOIN dbfaskes.propinsi ON dbfaskes.data_pm.id_prov_pm = dbfaskes.propinsi.id_prop
					JOIN dbfaskes.kota ON dbfaskes.data_pm.id_kota_pm = dbfaskes.kota.id_kota
					LEFT JOIN status_usulan h ON b.status_usulan_id = h.id
					LEFT JOIN berkas_usulan_survei i on i.penerimaan_pengajuan_usulan_survei_id = b.id
					LEFT JOIN kelengkapan_berkas j on j.berkas_usulan_survei_id = i.id
					LEFT JOIN penetapan_tanggal_survei k on k.kelengkapan_berkas_id = j.id
					LEFT JOIN trans_final_ep_surveior l on l.penetapan_tanggal_survei_id = k.id
					LEFT JOIN pengiriman_laporan_survei m on m.penetapan_tanggal_survei_id = k.id
					LEFT JOIN pengajuan_usulan_survei pus ON pus.id = a.id 
					LEFT JOIN penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
					LEFT JOIN berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
					LEFT JOIN kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id
					LEFT JOIN penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id
					LEFT JOIN trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
					LEFT JOIN pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id 
					LEFT JOIN penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
					LEFT JOIN trans_final_ep_verifikator tfev ON tfev.penetapan_verifikator_id = pv.id 
					LEFT JOIN pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
					LEFT JOIN persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
						LEFT JOIN persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
						LEFT JOIN data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
						LEFT JOIN tte_lpa tl ON tl.data_sertifikat_id = ds.id 
						LEFT JOIN tte_dirjen td ON tl.id = td.tte_lpa_id  
						LEFT JOIN status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
			WHERE 1=1 " . $raw_user_id . " 
			ORDER BY
			a.created_at DESC");
		} else if ($jenis_fasyankes == 2) {
			$sql = $this->db->query("SELECT
			a.id,
			a.lpa_id,
			a.jenis_fasyankes,
			a.status_admin_lpa,
			a.created_at,
			a.fasyankes_id,
			a.fasyankes_id_baru,
			b.status_usulan_id,
			b.keterangan,
			h.nama AS status_usulan,
			c.nama AS jenis_fasyankes_nama,
			d.nama AS jenis_survei,
			e.nama AS jenis_akreditasi,
			f.nama AS status_akreditasi,
			g.nama AS lpa,
			pp.kode_baru as fasyankes_id,
			pp.name as nama_fasyankes,
			pp.provinsi_nama as nama_prop,
			pp.kabkot_nama as nama_kota,
			pp.provinsi_code as provinsi_id,
			pp.kabkot_code as kabkota_id,
			pp.jenis_pelayanan as kemampuan_pelayanan,
			i.penerimaan_pengajuan_usulan_survei_id,
			pus.id as pengajuan_usulan_survei_id_monitor,
			ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
			bus.id as berkas_usulan_survei_id_monitor,
			kb.id as kelengkapan_berkas_id_monitor,
			pts.id as penetapan_tanggal_survei_id_monitor,
			tfes.id as trans_final_ep_surveior_id_monitor,
			pls.id as pengiriman_laporan_survei_id_monitor,
			pv.id as penetapan_verifikator_id_monitor,
			tfev.id as trans_final_ep_verifikator_id_monitor,
			pr.id as pengiriman_rekomendasi_id_monitor,
			td.id as penerbitan_sertifikat_id_monitor,
			sr.nama as status_akreditasi_nama,
			( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pengajuan_usulan_survei_id = a.id ) AS tanggal_survei,
				IF
				(
					b.id IS NULL,
					'Pengajuan Usulan Survei',
				IF
				(
					i.id IS NULL,
					'Respon LPA',
				IF
					(
						j.id IS NULL,
						'Kesiapan Survei',
					IF
						(
							k.id IS NULL,
							'Hasil Kesiapan Survei',
						IF
							(
								l.id IS NULL,
								'Kesepakatan Survei',
							IF
								(
									m.id IS NULL,
									'Penilaian EP Surveior',
								IF
									(
										pv.id IS NULL,
										'Pengiriman Laporan',
									IF
										(
											tfev.id IS NULL,
											'Penugasan Verifikator',
										IF
											( pr.id IS NULL, 'Penilaian EP Verifikator', 
												IF 
												( td.id IS NULL , 'Pengiriman Rekomendasi' , 'Penerbitan Sertifikat')))))))))) AS tahap
			FROM
				pengajuan_usulan_survei a
				LEFT JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
				JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
				JOIN jenis_survei d ON a.jenis_survei_id = d.id
				JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
				JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
				JOIN lpa g ON a.lpa_id = g.id
				LEFT JOIN dbfaskes.puskesmas_pusdatin pp ON pp.kode_sarana COLLATE utf8mb4_general_ci = a.fasyankes_id 
				LEFT JOIN status_usulan h ON b.status_usulan_id = h.id
				LEFT JOIN berkas_usulan_survei i on i.penerimaan_pengajuan_usulan_survei_id = b.id
				LEFT JOIN kelengkapan_berkas j on j.berkas_usulan_survei_id = i.id
				LEFT JOIN penetapan_tanggal_survei k on k.kelengkapan_berkas_id = j.id
				LEFT JOIN trans_final_ep_surveior l on l.penetapan_tanggal_survei_id = k.id
				LEFT JOIN pengiriman_laporan_survei m on m.penetapan_tanggal_survei_id = k.id
				LEFT JOIN pengajuan_usulan_survei pus ON pus.id = a.id 
				LEFT JOIN penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
				LEFT JOIN berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
				LEFT JOIN kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id
				LEFT JOIN penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id
				LEFT JOIN trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id 
				LEFT JOIN penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
				LEFT JOIN trans_final_ep_verifikator tfev ON tfev.penetapan_verifikator_id = pv.id 
				LEFT JOIN pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
				LEFT JOIN persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
				LEFT JOIN persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
				LEFT JOIN data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
				LEFT JOIN tte_lpa tl ON tl.data_sertifikat_id = ds.id 
				LEFT JOIN tte_dirjen td ON tl.id = td.tte_lpa_id  
				LEFT JOIN status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
			WHERE 1=1 " . $raw_user_id . "
			ORDER BY
			a.created_at DESC");
		} else if ($jenis_fasyankes == 3) {
			$sql = $this->db->query("SELECT
				a.*,
				b.status_usulan_id,
				b.keterangan,
				h.nama AS status_usulan,
				c.nama AS jenis_fasyankes_nama,
				d.nama AS jenis_survei,
				e.nama AS jenis_akreditasi,
				f.nama AS status_akreditasi,
				g.nama AS lpa,
				data_klinik.jenis_klinik AS kemampuan_pelayanan,
				trans_final.kode_faskes AS kode_faskes, 
				trans_final.id_faskes AS id_faskes, 
				trans_final.kode_faskes AS kode_faskes,
				trans_final.kode_faskes_baru AS fasyankes_id_baru, 
				trans_final.id_faskes AS id_faskes,
				data_klinik.nama_klinik AS nama_fasyankes,
				data_klinik.id_prov as provinsi_id, 
				propinsi.id_prop as id_prop, 
				propinsi.nama_prop as nama_prop, 
				data_klinik.id_kota as kabkota_id,
				kota.id_kota as id_kota, 
				kota.nama_kota AS nama_kota,
				i.penerimaan_pengajuan_usulan_survei_id,
					i.url_surat_permohonan_survei,
					i.url_profil_fasyankes,
					i.url_laporan_hasil_penilaian_mandiri,
					i.url_pps_reakreditasi,
					i.url_surat_usulan_dinas,
					i.update_dfo,
					i.update_aspak,
					i.update_sisdmk,
					i.update_inm,
					i.update_ikp,
					i.id AS berkas_usulan_survei_id,
					j.id AS kelengkapan_berkas_id,
					j.kelengkapan_berkas_usulan,
					j.kelengkapan_berkas_usulan_catatan,
					j.kelengkapan_dfo,
					j.kelengkapan_dfo_catatan,
					j.kelengkapan_sarpras_alkes,
					j.kelengkapan_sarpras_alkes_catatan,
					j.kelengkapan_nakes,
					j.kelengkapan_nakes_catatan,
					j.kelengkapan_laporan_inm,
					j.kelengkapan_laporan_inm_catatan,
					j.kelengkapan_laporan_ikp,
					j.kelengkapan_laporan_ikp_catatan,
					k.kelengkapan_berkas_id as kelengkapan_berkas_id_2,
					k.id as penetapan_tanggal_survei_id,
					k.url_dokumen_kontrak,
					k.url_surat_tugas,
					k.tanggal_survei,
					k.url_dokumen_pendukung_ep,
					k.surveior_satu,
					k.status_surveior_satu,
					k.surveior_dua,
					k.status_surveior_dua,
					l.final AS status_final_ep,
					m.id AS pengiriman_laporan_survei_id,
					m.tanggal_survei_satu,
					m.tanggal_survei_dua,
					m.tanggal_survei_tiga,
					m.url_bukti_satu,
					m.url_bukti_dua,
					m.url_bukti_tiga,
					pus.id as pengajuan_usulan_survei_id_monitor,
					ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
					bus.id as berkas_usulan_survei_id_monitor,
					kb.id as kelengkapan_berkas_id_monitor,
					pts.id as penetapan_tanggal_survei_id_monitor,
					tfes.id as trans_final_ep_surveior_id_monitor,
					pls.id as pengiriman_laporan_survei_id_monitor,
					pv.id as penetapan_verifikator_id_monitor,
					tfev.id as trans_final_ep_verifikator_id_monitor,
					pr.id as pengiriman_rekomendasi_id_monitor,
					td.id as penerbitan_sertifikat_id_monitor,
					sr.nama as status_akreditasi_nama,
					( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']')  FROM pengajuan_usulan_survei_detail pusd WHERE pengajuan_usulan_survei_id = a.id ) AS tanggal_survei,
					IF
						(
							b.id IS NULL,
							'Pengajuan Usulan Survei',
						IF
							(
								i.id IS NULL,
								'Respon LPA',
							IF
								(
									j.id IS NULL,
									'Kesiapan Survei',
								IF
									(
										k.id IS NULL,
										'Hasil Kesiapan Survei',
									IF
										(
											l.id IS NULL,
											'Kesepakatan Survei',
										IF
											(
												m.id IS NULL,
												'Penilaian EP Surveior',
											IF
												(
													pv.id IS NULL,
													'Pengiriman Laporan',
												IF
													(
														tfev.id IS NULL,
														'Penugasan Verifikator',
													IF
													( pr.id IS NULL, 'Penilaian EP Verifikator', 
														IF 
														( td.id IS NULL , 'Pengiriman Rekomendasi' , 'Penerbitan Sertifikat')))))))))) AS tahap
					FROM
						pengajuan_usulan_survei a
						LEFT JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
						JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
						JOIN jenis_survei d ON a.jenis_survei_id = d.id
						JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
						JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
						JOIN lpa g ON a.lpa_id = g.id
						JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
						JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
						JOIN dbfaskes.propinsi ON dbfaskes.data_klinik.id_prov = dbfaskes.propinsi.id_prop
						JOIN dbfaskes.kota ON dbfaskes.data_klinik.id_kota = dbfaskes.kota.id_kota
						LEFT JOIN status_usulan h ON b.status_usulan_id = h.id 
						LEFT JOIN berkas_usulan_survei i on i.penerimaan_pengajuan_usulan_survei_id = b.id
						LEFT JOIN kelengkapan_berkas j on j.berkas_usulan_survei_id = i.id
						LEFT JOIN penetapan_tanggal_survei k on k.kelengkapan_berkas_id = j.id
						LEFT JOIN trans_final_ep_surveior l on l.penetapan_tanggal_survei_id = k.id
						LEFT JOIN pengiriman_laporan_survei m on m.penetapan_tanggal_survei_id = k.id
						LEFT JOIN pengajuan_usulan_survei pus ON pus.id = a.id 
						LEFT JOIN penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
						LEFT JOIN berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
						LEFT JOIN kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id
						LEFT JOIN penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id
						LEFT JOIN trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
						LEFT JOIN pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id 
						LEFT JOIN penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
						LEFT JOIN trans_final_ep_verifikator tfev ON tfev.penetapan_verifikator_id = pv.id 
						LEFT JOIN pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
						LEFT JOIN persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
						LEFT JOIN persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
						LEFT JOIN data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
						LEFT JOIN tte_lpa tl ON tl.data_sertifikat_id = ds.id 
						LEFT JOIN tte_dirjen td ON tl.id = td.tte_lpa_id  
						LEFT JOIN status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
			WHERE 1=1 " . $raw_user_id . "
			ORDER BY
			a.created_at DESC");
		} else if ($jenis_fasyankes == 6) {
			$sql = $this->db->query("SELECT
				a.*,
				b.status_usulan_id,
				b.keterangan,
				h.nama AS status_usulan,
				c.nama AS jenis_fasyankes_nama,
				d.nama AS jenis_survei,
				e.nama AS jenis_akreditasi,
				f.nama AS status_akreditasi,
				g.nama AS lpa,
				data_utd.jenis_utd AS kemampuan_pelayanan,
				trans_final.kode_faskes AS kode_faskes,
				trans_final.id_faskes AS id_faskes,
				trans_final.kode_faskes AS kode_faskes,
				trans_final.kode_faskes_baru AS fasyankes_id_baru,
				trans_final.id_faskes AS id_faskes,
				data_utd.nama_utd AS nama_fasyankes,
				data_utd.id_prov AS provinsi_id,
				propinsi.id_prop AS id_prop,
				propinsi.nama_prop AS nama_prop,
				data_utd.id_kota AS kabkota_id,
				kota.id_kota AS id_kota,
				kota.nama_kota AS nama_kota,
				i.penerimaan_pengajuan_usulan_survei_id,
					i.url_surat_permohonan_survei,
					i.url_profil_fasyankes,
					i.url_laporan_hasil_penilaian_mandiri,
					i.url_pps_reakreditasi,
					i.url_surat_usulan_dinas,
					i.update_dfo,
					i.update_aspak,
					i.update_sisdmk,
					i.update_inm,
					i.update_ikp,
					i.id AS berkas_usulan_survei_id,
					j.id AS kelengkapan_berkas_id,
					j.kelengkapan_berkas_usulan,
					j.kelengkapan_berkas_usulan_catatan,
					j.kelengkapan_dfo,
					j.kelengkapan_dfo_catatan,
					j.kelengkapan_sarpras_alkes,
					j.kelengkapan_sarpras_alkes_catatan,
					j.kelengkapan_nakes,
					j.kelengkapan_nakes_catatan,
					j.kelengkapan_laporan_inm,
					j.kelengkapan_laporan_inm_catatan,
					j.kelengkapan_laporan_ikp,
					j.kelengkapan_laporan_ikp_catatan,
					k.kelengkapan_berkas_id as kelengkapan_berkas_id_2,
					k.id as penetapan_tanggal_survei_id,
					k.url_dokumen_kontrak,
					k.url_surat_tugas,
					k.tanggal_survei,	
					k.url_dokumen_pendukung_ep,
					k.surveior_satu,
					k.status_surveior_satu,
					k.surveior_dua,
					k.status_surveior_dua,
					l.final AS status_final_ep,
					m.id AS pengiriman_laporan_survei_id,
					m.tanggal_survei_satu,
					m.tanggal_survei_dua,
					m.tanggal_survei_tiga,
					m.url_bukti_satu,
					m.url_bukti_dua,
					m.url_bukti_tiga,
					pus.id as pengajuan_usulan_survei_id_monitor,
					ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
					bus.id as berkas_usulan_survei_id_monitor,
					kb.id as kelengkapan_berkas_id_monitor,
					pts.id as penetapan_tanggal_survei_id_monitor,
					tfes.id as trans_final_ep_surveior_id_monitor,
					pls.id as pengiriman_laporan_survei_id_monitor,
					pv.id as penetapan_verifikator_id_monitor,
					tfev.id as trans_final_ep_verifikator_id_monitor,
					pr.id as pengiriman_rekomendasi_id_monitor,
					td.id as penerbitan_sertifikat_id_monitor,
					sr.nama as status_akreditasi_nama,
					( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pengajuan_usulan_survei_id = a.id ) AS tanggal_survei,
					IF
						(
							b.id IS NULL,
							'Pengajuan Usulan Survei',
						IF
							(
								i.id IS NULL,
								'Respon LPA',
							IF
								(
									j.id IS NULL,
									'Kesiapan Survei',
								IF
									(
										k.id IS NULL,
										'Hasil Kesiapan Survei',
									IF
										(
											l.id IS NULL,
											'Kesepakatan Survei',
										IF
											(
												m.id IS NULL,
												'Penilaian EP Surveior',
											IF
												(
													pv.id IS NULL,
													'Pengiriman Laporan',
												IF
													(
														tfev.id IS NULL,
														'Penugasan Verifikator',
													IF
													( pr.id IS NULL, 'Penilaian EP Verifikator', 
														IF 
															( td.id IS NULL , 'Pengiriman Rekomendasi' , 'Penerbitan Sertifikat')))))))))) AS tahap
					FROM
						pengajuan_usulan_survei a
						LEFT JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
						JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
						JOIN jenis_survei d ON a.jenis_survei_id = d.id
						JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
						JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
						JOIN lpa g ON a.lpa_id = g.id
						JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
						JOIN dbfaskes.data_utd ON dbfaskes.trans_final.id_faskes = dbfaskes.data_utd.id_faskes
						JOIN dbfaskes.propinsi ON dbfaskes.data_utd.id_prov = dbfaskes.propinsi.id_prop
						JOIN dbfaskes.kota ON dbfaskes.data_utd.id_kota = dbfaskes.kota.id_kota
						LEFT JOIN status_usulan h ON b.status_usulan_id = h.id
						LEFT JOIN berkas_usulan_survei i on i.penerimaan_pengajuan_usulan_survei_id = b.id
						LEFT JOIN kelengkapan_berkas j on j.berkas_usulan_survei_id = i.id
						LEFT JOIN penetapan_tanggal_survei k on k.kelengkapan_berkas_id = j.id
						LEFT JOIN trans_final_ep_surveior l on l.penetapan_tanggal_survei_id = k.id
						LEFT JOIN pengiriman_laporan_survei m on m.penetapan_tanggal_survei_id = k.id
						LEFT JOIN pengajuan_usulan_survei pus ON pus.id = a.id 
						LEFT JOIN penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
						LEFT JOIN berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
						LEFT JOIN kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id
						LEFT JOIN penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id
						LEFT JOIN trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
						LEFT JOIN pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id 
						LEFT JOIN penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
						LEFT JOIN trans_final_ep_verifikator tfev ON tfev.penetapan_verifikator_id = pv.id 
						LEFT JOIN pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
						LEFT JOIN persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
						LEFT JOIN persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
						LEFT JOIN data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
						LEFT JOIN tte_lpa tl ON tl.data_sertifikat_id = ds.id 
						LEFT JOIN tte_dirjen td ON tl.id = td.tte_lpa_id  
						LEFT JOIN status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
			WHERE 1=1 " . $raw_user_id . "
			ORDER BY
			a.created_at DESC");
		} else if ($jenis_fasyankes == 7) {
			$sql = $this->db->query("SELECT
				a.*,
				b.status_usulan_id,
				b.keterangan,
				h.nama AS status_usulan,
				c.nama AS jenis_fasyankes_nama,
				d.nama AS jenis_survei,
				e.nama AS jenis_akreditasi,
				f.nama AS status_akreditasi,
				g.nama AS lpa,
				data_labkes.jenis_lab AS kemampuan_pelayanan,
				trans_final.kode_faskes AS kode_faskes,
				trans_final.id_faskes AS id_faskes,
				trans_final.kode_faskes AS kode_faskes,
				trans_final.kode_faskes_baru AS fasyankes_id_baru,
				trans_final.id_faskes AS id_faskes,
				data_labkes.nama_lab AS nama_fasyankes,
				data_labkes.id_prov AS provinsi_id,
				propinsi.id_prop AS id_prop,
				propinsi.nama_prop AS nama_prop,
				data_labkes.id_kota AS kabkota_id,
				kota.id_kota AS id_kota,
				kota.nama_kota AS nama_kota,
				i.penerimaan_pengajuan_usulan_survei_id,
					i.url_surat_permohonan_survei,
					i.url_profil_fasyankes,
					i.url_laporan_hasil_penilaian_mandiri,
					i.url_pps_reakreditasi,
					i.url_surat_usulan_dinas,
					i.update_dfo,
					i.update_aspak,
					i.update_sisdmk,
					i.update_inm,
					i.update_ikp,
					i.id AS berkas_usulan_survei_id,
					j.id AS kelengkapan_berkas_id,
					j.kelengkapan_berkas_usulan,
					j.kelengkapan_berkas_usulan_catatan,
					j.kelengkapan_dfo,
					j.kelengkapan_dfo_catatan,
					j.kelengkapan_sarpras_alkes,
					j.kelengkapan_sarpras_alkes_catatan,
					j.kelengkapan_nakes,
					j.kelengkapan_nakes_catatan,
					j.kelengkapan_laporan_inm,
					j.kelengkapan_laporan_inm_catatan,
					j.kelengkapan_laporan_ikp,
					j.kelengkapan_laporan_ikp_catatan,
					k.kelengkapan_berkas_id as kelengkapan_berkas_id_2,
					k.id as penetapan_tanggal_survei_id,
					k.url_dokumen_kontrak,
					k.url_surat_tugas,
					k.tanggal_survei,
					
					k.url_dokumen_pendukung_ep,
					k.surveior_satu,
					k.status_surveior_satu,
					k.surveior_dua,
					k.status_surveior_dua,
					l.final AS status_final_ep,
					m.id AS pengiriman_laporan_survei_id,
					m.tanggal_survei_satu,
					m.tanggal_survei_dua,
					m.tanggal_survei_tiga,
					m.url_bukti_satu,
					m.url_bukti_dua,
					m.url_bukti_tiga,
					pus.id as pengajuan_usulan_survei_id_monitor,
					ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
					bus.id as berkas_usulan_survei_id_monitor,
					kb.id as kelengkapan_berkas_id_monitor,
					pts.id as penetapan_tanggal_survei_id_monitor,
					tfes.id as trans_final_ep_surveior_id_monitor,
					pls.id as pengiriman_laporan_survei_id_monitor,
					pv.id as penetapan_verifikator_id_monitor,
					tfev.id as trans_final_ep_verifikator_id_monitor,
					pr.id as pengiriman_rekomendasi_id_monitor,
					td.id as penerbitan_sertifikat_id_monitor,
					sr.nama as status_akreditasi_nama,
					( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pengajuan_usulan_survei_id = a.id ) AS tanggal_survei,
					IF
						(
							b.id IS NULL,
							'Pengajuan Usulan Survei',
						IF
							(
								i.id IS NULL,
								'Respon LPA',
							IF
								(
									j.id IS NULL,
									'Kesiapan Survei',
								IF
									(
										k.id IS NULL,
										'Hasil Kesiapan Survei',
									IF
										(
											l.id IS NULL,
											'Kesepakatan Survei',
										IF
											(
												m.id IS NULL,
												'Penilaian EP Surveior',
											IF
												(
													pv.id IS NULL,
													'Pengiriman Laporan',
												IF
													(
														tfev.id IS NULL,
														'Penugasan Verifikator',
													IF
													( pr.id IS NULL, 'Penilaian EP Verifikator', 
														IF 
															( td.id IS NULL , 'Pengiriman Rekomendasi' , 'Penerbitan Sertifikat')))))))))) AS tahap
					FROM
						pengajuan_usulan_survei a
						LEFT JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
						JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
						JOIN jenis_survei d ON a.jenis_survei_id = d.id
						JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
						JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
						JOIN lpa g ON a.lpa_id = g.id
						JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
						JOIN dbfaskes.data_labkes ON dbfaskes.trans_final.id_faskes = dbfaskes.data_labkes.id_faskes
						JOIN dbfaskes.propinsi ON dbfaskes.data_labkes.id_prov = dbfaskes.propinsi.id_prop
						JOIN dbfaskes.kota ON dbfaskes.data_labkes.id_kota = dbfaskes.kota.id_kota
						LEFT JOIN status_usulan h ON b.status_usulan_id = h.id
						LEFT JOIN berkas_usulan_survei i on i.penerimaan_pengajuan_usulan_survei_id = b.id
						LEFT JOIN kelengkapan_berkas j on j.berkas_usulan_survei_id = i.id
						LEFT JOIN penetapan_tanggal_survei k on k.kelengkapan_berkas_id = j.id
						LEFT JOIN trans_final_ep_surveior l on l.penetapan_tanggal_survei_id = k.id
						LEFT JOIN pengiriman_laporan_survei m on m.penetapan_tanggal_survei_id = k.id
						LEFT JOIN pengajuan_usulan_survei pus ON pus.id = a.id 
						LEFT JOIN penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
						LEFT JOIN berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
						LEFT JOIN kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id
						LEFT JOIN penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id
						LEFT JOIN trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
						LEFT JOIN pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id 
						LEFT JOIN penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
						LEFT JOIN trans_final_ep_verifikator tfev ON tfev.penetapan_verifikator_id = pv.id 
						LEFT JOIN pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
						LEFT JOIN persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
						LEFT JOIN persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
						LEFT JOIN data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
						LEFT JOIN tte_lpa tl ON tl.data_sertifikat_id = ds.id 
						LEFT JOIN tte_dirjen td ON tl.id = td.tte_lpa_id  
						LEFT JOIN status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
			WHERE 1=1 " . $raw_user_id . "
			ORDER BY
			a.created_at DESC");
		} else {
			$sql = $this->db->query("SELECT
					a.*,
					b.status_usulan_id,
					b.keterangan,
					h.nama AS status_usulan,
					c.nama AS jenis_fasyankes_nama,
					d.nama AS jenis_survei,
					e.nama AS jenis_akreditasi,
					f.nama AS status_akreditasi,
					g.nama AS lpa,
					trans_final.kode_faskes AS kode_faskes,
					trans_final.id_faskes AS id_faskes,
					trans_final.kode_faskes AS kode_faskes,
					trans_final.kode_faskes_baru AS fasyankes_id_baru,
					trans_final.id_faskes AS id_faskes,
					data_pm.nama_pm AS nama_fasyankes,
					data_pm.id_prov_pm AS provinsi_id,
					propinsi.id_prop AS id_prop,
					propinsi.nama_prop AS nama_prop,
					data_pm.id_kota_pm AS kabkota_id,
					kota.id_kota AS id_kota,
					kota.nama_kota AS nama_kota,
					i.penerimaan_pengajuan_usulan_survei_id,
					i.url_surat_permohonan_survei,
					i.url_profil_fasyankes,
					i.url_laporan_hasil_penilaian_mandiri,
					i.url_pps_reakreditasi,
					i.url_surat_usulan_dinas,
					i.update_dfo,
					i.update_aspak,
					i.update_sisdmk,
					i.update_inm,
					i.update_ikp,
					i.id AS berkas_usulan_survei_id,
					j.id AS kelengkapan_berkas_id,
					j.kelengkapan_berkas_usulan,
					j.kelengkapan_berkas_usulan_catatan,
					j.kelengkapan_dfo,
					j.kelengkapan_dfo_catatan,
					j.kelengkapan_sarpras_alkes,
					j.kelengkapan_sarpras_alkes_catatan,
					j.kelengkapan_nakes,
					j.kelengkapan_nakes_catatan,
					j.kelengkapan_laporan_inm,
					j.kelengkapan_laporan_inm_catatan,
					j.kelengkapan_laporan_ikp,
					j.kelengkapan_laporan_ikp_catatan,
					k.kelengkapan_berkas_id as kelengkapan_berkas_id_2,
					k.id as penetapan_tanggal_survei_id,
					k.url_dokumen_kontrak,
					k.url_surat_tugas,
					k.tanggal_survei,
					k.url_dokumen_pendukung_ep,
					k.surveior_satu,
					k.status_surveior_satu,
					k.surveior_dua,
					k.status_surveior_dua,
					l.final AS status_final_ep,
					m.id AS pengiriman_laporan_survei_id,
					m.tanggal_survei_satu,
					m.tanggal_survei_dua,
					m.tanggal_survei_tiga,
					m.url_bukti_satu,
					m.url_bukti_dua,
					m.url_bukti_tiga,
					pus.id as pengajuan_usulan_survei_id_monitor,
					ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
					bus.id as berkas_usulan_survei_id_monitor,
					kb.id as kelengkapan_berkas_id_monitor,
					pts.id as penetapan_tanggal_survei_id_monitor,
					tfes.id as trans_final_ep_surveior_id_monitor,
					pls.id as pengiriman_laporan_survei_id_monitor,
					pv.id as penetapan_verifikator_id_monitor,
					tfev.id as trans_final_ep_verifikator_id_monitor,
					pr.id as pengiriman_rekomendasi_id_monitor,
					td.id as penerbitan_sertifikat_id_monitor,
					sr.nama as status_akreditasi_nama,
					( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pengajuan_usulan_survei_id = a.id ) AS tanggal_survei,
					IF
						(
							b.id IS NULL,
							'Pengajuan Usulan Survei',
						IF
							(
								i.id IS NULL,
								'Respon LPA',
							IF
								(
									j.id IS NULL,
									'Kesiapan Survei',
								IF
									(
										k.id IS NULL,
										'Hasil Kesiapan Survei',
									IF
										(
											l.id IS NULL,
											'Kesepakatan Survei',
										IF
											(
												m.id IS NULL,
												'Penilaian EP Surveior',
											IF
												(
													pv.id IS NULL,
													'Pengiriman Laporan',
												IF
													(
														tfev.id IS NULL,
														'Penugasan Verifikator',
													IF
													( pr.id IS NULL, 'Penilaian EP Verifikator', 
														IF 
															( td.id IS NULL , 'Pengiriman Rekomendasi' , 'Penerbitan Sertifikat')))))))))) AS tahap
					FROM
						pengajuan_usulan_survei a
						LEFT JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
						JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
						JOIN jenis_survei d ON a.jenis_survei_id = d.id
						JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
						JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
						JOIN lpa g ON a.lpa_id = g.id
						JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
						JOIN dbfaskes.data_pm ON dbfaskes.trans_final.id_faskes = dbfaskes.data_pm.id_faskes
						JOIN dbfaskes.propinsi ON dbfaskes.data_pm.id_prov_pm = dbfaskes.propinsi.id_prop
						JOIN dbfaskes.kota ON dbfaskes.data_pm.id_kota_pm = dbfaskes.kota.id_kota
						LEFT JOIN status_usulan h ON b.status_usulan_id = h.id
						LEFT JOIN berkas_usulan_survei i on i.penerimaan_pengajuan_usulan_survei_id = b.id
						LEFT JOIN kelengkapan_berkas j on j.berkas_usulan_survei_id = i.id
						LEFT JOIN penetapan_tanggal_survei k on k.kelengkapan_berkas_id = j.id
						LEFT JOIN trans_final_ep_surveior l on l.penetapan_tanggal_survei_id = k.id
						LEFT JOIN pengiriman_laporan_survei m on m.penetapan_tanggal_survei_id = k.id
						LEFT JOIN pengajuan_usulan_survei pus ON pus.id = a.id 
						LEFT JOIN penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
						LEFT JOIN berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
						LEFT JOIN kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id
						LEFT JOIN penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id
						LEFT JOIN trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
						LEFT JOIN pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id 
						LEFT JOIN penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
						LEFT JOIN trans_final_ep_verifikator tfev ON tfev.penetapan_verifikator_id = pv.id 
						LEFT JOIN pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
						LEFT JOIN persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
						LEFT JOIN persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
						LEFT JOIN data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
						LEFT JOIN tte_lpa tl ON tl.data_sertifikat_id = ds.id 
						LEFT JOIN tte_dirjen td ON tl.id = td.tte_lpa_id  
						LEFT JOIN status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
			WHERE 1=1 " . $raw_user_id . " 
			ORDER BY
			a.created_at DESC");
		}

		return $sql->result_array();
		// return $raw_user_id;
	}

	function select_monitoring($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes)
	{
		if (!empty($lpa_id) && $lpa_id != 9999) {
			$whereLPA = " AND l.id='" . $lpa_id . "'";
		} else {
			$whereLPA = "";
		}

		if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
			$tanggal = " AND (pus.tanggal_pengajuan BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "' )";
		} else {
			$tanggal = "";
		}

		if (!empty($propinsi) && $propinsi != 9999) {
			if ($jenis_fasyankes == 2) {
				$whereProp = " AND pp.provinsi_code = '" . (int)$propinsi . "'";
			} else {
				$whereProp = " AND p.id_prop='" . (int)$propinsi . "'";
			}
		} else {
			$whereProp = "";
		}

		if (!empty($kota) && $kota != 9999) {
			if ($jenis_fasyankes == 2) {
				$whereKota = " AND pp.kabkot_code ='" . (int)$kota . "'";
			} else {
				$whereKota = " AND k.id_kota='" . (int)$kota . "'";
			}
		} else {
			$whereKota = "";
		}

		$where = $whereLPA . $tanggal . $whereProp . $whereKota;

		if ($jenis_fasyankes == 1) {
			$sql = $this->db->query("SELECT 
					pus.id,
					dp.nama_pm as nama_fasyankes,
					p.nama_prop,
					kp.kategori_user as jenis_pelayanan,
					k.nama_kota,
					pus.fasyankes_id,
					pus.fasyankes_id_baru,
					jf.nama as jenis_fasyankes,
					js.nama as jenis_survei,
					ja.nama as jenis_akreditasi,
					sa.nama as akreditasi_terakhir,
					pus.url_sertifikasi_akreditasi_sebelumnya,
					pus.tanggal_akhir_sertifikat,
					l.nama as nama_lpa,
					pus.tanggal_pengajuan,
					pus.created_at,
					pus.status_admin_lpa,
					( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pusd.pengajuan_usulan_survei_id = pus.id ) AS tanggal_survei,
						CASE
						WHEN ppus.id IS NULL THEN 'Pengajuan Usulan Survei'
						WHEN bus.id IS NULL THEN 'Respon LPA'
						WHEN kb.id IS NULL THEN 'Kesiapan Survei'
						WHEN pts.id IS NULL THEN 'Hasil Kesiapan Survei'
						WHEN tfes.id IS NULL THEN 'Kesepakatan Survei'
						WHEN pls.id IS NULL THEN 'Penilaian EP Surveior'
						WHEN pv.id IS NULL THEN 'Pengiriman Laporan'
						WHEN tfev.id IS NULL THEN 'Penugasan Verifikator'
						WHEN pr.id IS NULL THEN 'Penilaian EP Verifikator'
						WHEN td.id IS NULL THEN 'Pengiriman Rekomendasi'
						ELSE 'Penerbitan Sertifikat'
						END AS tahap,
						pus.id as pengajuan_usulan_survei_id_monitor,
						ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
						bus.id as berkas_usulan_survei_id_monitor,
						kb.id as kelengkapan_berkas_id_monitor,
						pts.id as penetapan_tanggal_survei_id_monitor,
						tfes.id as trans_final_ep_surveior_id_monitor,
						pls.id as pengiriman_laporan_survei_id_monitor,
						pv.id as penetapan_verifikator_id_monitor,
						tfev.id as trans_final_ep_verifikator_id_monitor,
						pr.id as pengiriman_rekomendasi_id_monitor,
						td.id as penerbitan_sertifikat_id_monitor,
						sr.nama as status_akreditasi_nama,
						su.id as status_usulan_id,
						ppus.keterangan 
				FROM 
					pengajuan_usulan_survei pus
				LEFT JOIN 
					jenis_fasyankes jf ON jf.id = pus.jenis_fasyankes
				LEFT JOIN 
					jenis_survei js ON js.id = pus.jenis_survei_id 
				LEFT JOIN 
					jenis_akreditasi ja ON ja.id = pus.jenis_akreditasi_id 
				LEFT JOIN 
					status_akreditasi sa ON sa.id = pus.status_akreditasi_id
				LEFT JOIN 
					lpa l ON l.id = pus.lpa_id 
				LEFT JOIN 
					penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
				LEFT JOIN 
					status_usulan su ON su.id = ppus.status_usulan_id 
				LEFT JOIN 
					berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id 
				LEFT JOIN 
					kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id 
				LEFT JOIN 
					penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id 
				LEFT JOIN 
					trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
				LEFT JOIN 
					trans_final_ep_verifikator tfev on tfev.penetapan_verifikator_id = pv.id 
				LEFT JOIN 
					pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
				LEFT JOIN 
					persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
				LEFT JOIN 
					persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
				LEFT JOIN 
					data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
				LEFT JOIN 
					tte_lpa tl ON tl.data_sertifikat_id = ds.id 
				LEFT JOIN 
					tte_dirjen td ON tl.id = td.tte_lpa_id  
				LEFT JOIN 
					status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
				LEFT JOIN 
					dbfaskes.trans_final tf ON tf.kode_faskes = pus.fasyankes_id 
				LEFT JOIN 
					dbfaskes.data_pm dp ON dp.id_faskes = tf.id_faskes 
				LEFT JOIN 
					dbfaskes.kategori_pm kp ON kp.id = dp.id_kategori 
				LEFT JOIN 
					dbfaskes.propinsi p ON p.id_prop = dp.id_prov_pm  
				LEFT JOIN 
					dbfaskes.kota k ON k.id_kota = dp.id_kota_pm 
				WHERE 
					pus.jenis_fasyankes = '1' " . $where . "
				ORDER BY 
					pus.created_at ASC
			");
		} else if ($jenis_fasyankes == 2) {
			$sql = $this->db->query("SELECT 
					pus.id,
					pp.name as nama_fasyankes,
					p.nama_prop,
					k.nama_kota,
					pp.jenis_pelayanan as jenis_pelayanan,
					pus.fasyankes_id,
					pus.fasyankes_id_baru,
					jf.nama as jenis_fasyankes,
					js.nama as jenis_survei,
					ja.nama as jenis_akreditasi,
					sa.nama as akreditasi_terakhir,
					pus.url_sertifikasi_akreditasi_sebelumnya,
					pus.tanggal_akhir_sertifikat,
					l.nama as nama_lpa,
					pus.tanggal_pengajuan,
					pus.created_at,
					pus.status_admin_lpa,
					( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pusd.pengajuan_usulan_survei_id = pus.id ) AS tanggal_survei,
						CASE
						WHEN ppus.id IS NULL THEN 'Pengajuan Usulan Survei'
						WHEN bus.id IS NULL THEN 'Respon LPA'
						WHEN kb.id IS NULL THEN 'Kesiapan Survei'
						WHEN pts.id IS NULL THEN 'Hasil Kesiapan Survei'
						WHEN tfes.id IS NULL THEN 'Kesepakatan Survei'
						WHEN pls.id IS NULL THEN 'Penilaian EP Surveior'
						WHEN pv.id IS NULL THEN 'Pengiriman Laporan'
						WHEN tfev.id IS NULL THEN 'Penugasan Verifikator'
						WHEN pr.id IS NULL THEN 'Penilaian EP Verifikator'
						WHEN td.id IS NULL THEN 'Pengiriman Rekomendasi'
						ELSE 'Penerbitan Sertifikat'
						END AS tahap,
						pus.id as pengajuan_usulan_survei_id_monitor,
						ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
						bus.id as berkas_usulan_survei_id_monitor,
						kb.id as kelengkapan_berkas_id_monitor,
						pts.id as penetapan_tanggal_survei_id_monitor,
						tfes.id as trans_final_ep_surveior_id_monitor,
						pls.id as pengiriman_laporan_survei_id_monitor,
						pv.id as penetapan_verifikator_id_monitor,
						tfev.id as trans_final_ep_verifikator_id_monitor,
						pr.id as pengiriman_rekomendasi_id_monitor,
						td.id as penerbitan_sertifikat_id_monitor,
						sr.nama as status_akreditasi_nama,
						su.id as status_usulan_id,
						ppus.keterangan 
				FROM 
					pengajuan_usulan_survei pus
				LEFT JOIN 
					jenis_fasyankes jf ON jf.id = pus.jenis_fasyankes
				LEFT JOIN 
					jenis_survei js ON js.id = pus.jenis_survei_id 
				LEFT JOIN 
					jenis_akreditasi ja ON ja.id = pus.jenis_akreditasi_id 
				LEFT JOIN 
					status_akreditasi sa ON sa.id = pus.status_akreditasi_id
				LEFT JOIN 
					lpa l ON l.id = pus.lpa_id 
				LEFT JOIN 
					penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
				LEFT JOIN 
					status_usulan su ON su.id = ppus.status_usulan_id 
				LEFT JOIN 
					berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id 
				LEFT JOIN 
					kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id 
				LEFT JOIN 
					penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id 
				LEFT JOIN 
					trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
				LEFT JOIN 
					trans_final_ep_verifikator tfev on tfev.penetapan_verifikator_id = pv.id 
				LEFT JOIN 
					pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
				LEFT JOIN 
					persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
				LEFT JOIN 
					persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
				LEFT JOIN 
					data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
				LEFT JOIN 
					tte_lpa tl ON tl.data_sertifikat_id = ds.id 
				LEFT JOIN 
					tte_dirjen td ON tl.id = td.tte_lpa_id  
				LEFT JOIN 
					status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
				LEFT JOIN 
					dbfaskes.puskesmas_pusdatin pp ON pp.kode_sarana = pus.fasyankes_id
				LEFT JOIN 
					dbfaskes.propinsi p ON p.id_prop = pp.provinsi_code 
				LEFT JOIN 
					dbfaskes.kota k ON k.id_kota = pp.kabkot_code 
				WHERE 
					pus.jenis_fasyankes = '2' " . $where . "
				ORDER BY 
					pus.created_at ASC
			");
		} else if ($jenis_fasyankes == 3) {
			$sql = $this->db->query("SELECT 
					pus.id,
					dk.nama_klinik as nama_fasyankes,
					p.nama_prop,
					k.nama_kota,
					dk.jenis_klinik as jenis_pelayanan,
					pus.fasyankes_id,
					pus.fasyankes_id_baru,
					jf.nama as jenis_fasyankes,
					js.nama as jenis_survei,
					ja.nama as jenis_akreditasi,
					sa.nama as akreditasi_terakhir,
					pus.url_sertifikasi_akreditasi_sebelumnya,
					pus.tanggal_akhir_sertifikat,
					l.nama as nama_lpa,
					pus.tanggal_pengajuan,
					pus.created_at,
					pus.status_admin_lpa,
					( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pusd.pengajuan_usulan_survei_id = pus.id ) AS tanggal_survei,
						CASE
						WHEN ppus.id IS NULL THEN 'Pengajuan Usulan Survei'
						WHEN bus.id IS NULL THEN 'Respon LPA'
						WHEN kb.id IS NULL THEN 'Kesiapan Survei'
						WHEN pts.id IS NULL THEN 'Hasil Kesiapan Survei'
						WHEN tfes.id IS NULL THEN 'Kesepakatan Survei'
						WHEN pls.id IS NULL THEN 'Penilaian EP Surveior'
						WHEN pv.id IS NULL THEN 'Pengiriman Laporan'
						WHEN tfev.id IS NULL THEN 'Penugasan Verifikator'
						WHEN pr.id IS NULL THEN 'Penilaian EP Verifikator'
						WHEN td.id IS NULL THEN 'Pengiriman Rekomendasi'
						ELSE 'Penerbitan Sertifikat'
						END AS tahap,
						pus.id as pengajuan_usulan_survei_id_monitor,
						ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
						bus.id as berkas_usulan_survei_id_monitor,
						kb.id as kelengkapan_berkas_id_monitor,
						pts.id as penetapan_tanggal_survei_id_monitor,
						tfes.id as trans_final_ep_surveior_id_monitor,
						pls.id as pengiriman_laporan_survei_id_monitor,
						pv.id as penetapan_verifikator_id_monitor,
						tfev.id as trans_final_ep_verifikator_id_monitor,
						pr.id as pengiriman_rekomendasi_id_monitor,
						td.id as penerbitan_sertifikat_id_monitor,
						sr.nama as status_akreditasi_nama,
						su.id as status_usulan_id,
						ppus.keterangan
				FROM 
					pengajuan_usulan_survei pus
				LEFT JOIN 
					jenis_fasyankes jf ON jf.id = pus.jenis_fasyankes
				LEFT JOIN 
					jenis_survei js ON js.id = pus.jenis_survei_id 
				LEFT JOIN 
					jenis_akreditasi ja ON ja.id = pus.jenis_akreditasi_id 
				LEFT JOIN 
					status_akreditasi sa ON sa.id = pus.status_akreditasi_id
				LEFT JOIN 
					lpa l ON l.id = pus.lpa_id 
				LEFT JOIN 
					penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
				LEFT JOIN 
					status_usulan su ON su.id = ppus.status_usulan_id 
				LEFT JOIN 
					berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id 
				LEFT JOIN 
					kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id 
				LEFT JOIN 
					penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id 
				LEFT JOIN 
					trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
				LEFT JOIN 
					trans_final_ep_verifikator tfev on tfev.penetapan_verifikator_id = pv.id 
				LEFT JOIN 
					pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
				LEFT JOIN 
					persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
				LEFT JOIN 
					persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
				LEFT JOIN 
					data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
				LEFT JOIN 
					tte_lpa tl ON tl.data_sertifikat_id = ds.id 
				LEFT JOIN 
					tte_dirjen td ON tl.id = td.tte_lpa_id  
				LEFT JOIN 
					status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
				LEFT JOIN 
					dbfaskes.trans_final tf ON tf.kode_faskes = pus.fasyankes_id 
				LEFT JOIN 
					dbfaskes.data_klinik dk ON dk.id_faskes = tf.id_faskes 
				LEFT JOIN 
					dbfaskes.propinsi p ON p.id_prop = dk.id_prov 
				LEFT JOIN 
					dbfaskes.kota k ON k.id_kota  = dk.id_kota 
				WHERE 
					pus.jenis_fasyankes = '3' " . $where . "
				ORDER BY 
					pus.created_at ASC
			");
		} else if ($jenis_fasyankes == 6) {
			$sql = $this->db->query("SELECT 
					pus.id,
					du.nama_utd as nama_fasyankes,
					p.nama_prop,
					k.nama_kota,
					du.jenis_utd as jenis_pelayanan,
					pus.fasyankes_id,
					pus.fasyankes_id_baru,
					jf.nama as jenis_fasyankes,
					js.nama as jenis_survei,
					ja.nama as jenis_akreditasi,
					sa.nama as akreditasi_terakhir,
					pus.url_sertifikasi_akreditasi_sebelumnya,
					pus.tanggal_akhir_sertifikat,
					l.nama as nama_lpa,
					pus.tanggal_pengajuan,
					pus.created_at,
					pus.status_admin_lpa,
					( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pusd.pengajuan_usulan_survei_id = pus.id ) AS tanggal_survei,
						CASE
						WHEN ppus.id IS NULL THEN 'Pengajuan Usulan Survei'
						WHEN bus.id IS NULL THEN 'Respon LPA'
						WHEN kb.id IS NULL THEN 'Kesiapan Survei'
						WHEN pts.id IS NULL THEN 'Hasil Kesiapan Survei'
						WHEN tfes.id IS NULL THEN 'Kesepakatan Survei'
						WHEN pls.id IS NULL THEN 'Penilaian EP Surveior'
						WHEN pv.id IS NULL THEN 'Pengiriman Laporan'
						WHEN tfev.id IS NULL THEN 'Penugasan Verifikator'
						WHEN pr.id IS NULL THEN 'Penilaian EP Verifikator'
						WHEN td.id IS NULL THEN 'Pengiriman Rekomendasi'
						ELSE 'Penerbitan Sertifikat'
						END AS tahap,
						pus.id as pengajuan_usulan_survei_id_monitor,
						ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
						bus.id as berkas_usulan_survei_id_monitor,
						kb.id as kelengkapan_berkas_id_monitor,
						pts.id as penetapan_tanggal_survei_id_monitor,
						tfes.id as trans_final_ep_surveior_id_monitor,
						pls.id as pengiriman_laporan_survei_id_monitor,
						pv.id as penetapan_verifikator_id_monitor,
						tfev.id as trans_final_ep_verifikator_id_monitor,
						pr.id as pengiriman_rekomendasi_id_monitor,
						td.id as penerbitan_sertifikat_id_monitor,
						sr.nama as status_akreditasi_nama,
						su.id as status_usulan_id,
						ppus.keterangan
				FROM 
					pengajuan_usulan_survei pus
				LEFT JOIN 
					jenis_fasyankes jf ON jf.id = pus.jenis_fasyankes
				LEFT JOIN 
					jenis_survei js ON js.id = pus.jenis_survei_id 
				LEFT JOIN 
					jenis_akreditasi ja ON ja.id = pus.jenis_akreditasi_id 
				LEFT JOIN 
					status_akreditasi sa ON sa.id = pus.status_akreditasi_id
				LEFT JOIN 
					lpa l ON l.id = pus.lpa_id 
				LEFT JOIN 
					penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
				LEFT JOIN 
					status_usulan su ON su.id = ppus.status_usulan_id 
				LEFT JOIN 
					berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id 
				LEFT JOIN 
					kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id 
				LEFT JOIN 
					penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id 
				LEFT JOIN 
					trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
				LEFT JOIN 
					trans_final_ep_verifikator tfev on tfev.penetapan_verifikator_id = pv.id 
				LEFT JOIN 
					pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
				LEFT JOIN 
					persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
				LEFT JOIN 
					persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
				LEFT JOIN 
					data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
				LEFT JOIN 
					tte_lpa tl ON tl.data_sertifikat_id = ds.id 
				LEFT JOIN 
					tte_dirjen td ON tl.id = td.tte_lpa_id  
				LEFT JOIN 
					status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
				LEFT JOIN 
					dbfaskes.trans_final tf ON tf.kode_faskes = pus.fasyankes_id 
				LEFT JOIN 
					dbfaskes.data_utd du ON du.id_faskes = tf.id_faskes 
				LEFT JOIN 
					dbfaskes.propinsi p ON p.id_prop = du.id_prov 
				LEFT JOIN 
					dbfaskes.kota k ON k.id_kota  = du.id_kota 
				WHERE 
					pus.jenis_fasyankes = '6' " . $where . "
				ORDER BY 
					pus.created_at ASC
			");
		} else if ($jenis_fasyankes == 7) {
			$sql = $this->db->query("SELECT 
					pus.id,
					pus.fasyankes_id,
					pus.fasyankes_id_baru,
					dl.nama_lab as nama_fasyankes,
					p.nama_prop,
					k.nama_kota,
					dl.jenis_pelayanan,
					jf.nama as jenis_fasyankes,
					js.nama as jenis_survei,
					ja.nama as jenis_akreditasi,
					sa.nama as akreditasi_terakhir,
					pus.url_sertifikasi_akreditasi_sebelumnya,
					pus.tanggal_akhir_sertifikat,
					l.nama as nama_lpa,
					pus.tanggal_pengajuan,
					pus.created_at,
					pus.status_admin_lpa,
					( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pusd.pengajuan_usulan_survei_id = pus.id ) AS tanggal_survei,
						CASE
						WHEN ppus.id IS NULL THEN 'Pengajuan Usulan Survei'
						WHEN bus.id IS NULL THEN 'Respon LPA'
						WHEN kb.id IS NULL THEN 'Kesiapan Survei'
						WHEN pts.id IS NULL THEN 'Hasil Kesiapan Survei'
						WHEN tfes.id IS NULL THEN 'Kesepakatan Survei'
						WHEN pls.id IS NULL THEN 'Penilaian EP Surveior'
						WHEN pv.id IS NULL THEN 'Pengiriman Laporan'
						WHEN tfev.id IS NULL THEN 'Penugasan Verifikator'
						WHEN pr.id IS NULL THEN 'Penilaian EP Verifikator'
						WHEN td.id IS NULL THEN 'Pengiriman Rekomendasi'
						ELSE 'Penerbitan Sertifikat'
						END AS tahap,
						pus.id as pengajuan_usulan_survei_id_monitor,
						ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
						bus.id as berkas_usulan_survei_id_monitor,
						kb.id as kelengkapan_berkas_id_monitor,
						pts.id as penetapan_tanggal_survei_id_monitor,
						tfes.id as trans_final_ep_surveior_id_monitor,
						pls.id as pengiriman_laporan_survei_id_monitor,
						pv.id as penetapan_verifikator_id_monitor,
						tfev.id as trans_final_ep_verifikator_id_monitor,
						pr.id as pengiriman_rekomendasi_id_monitor,
						td.id as penerbitan_sertifikat_id_monitor,
						sr.nama as status_akreditasi_nama,
						su.id as status_usulan_id,
						ppus.keterangan
				FROM 
					pengajuan_usulan_survei pus
				LEFT JOIN 
					jenis_fasyankes jf ON jf.id = pus.jenis_fasyankes
				LEFT JOIN 
					jenis_survei js ON js.id = pus.jenis_survei_id 
				LEFT JOIN 
					jenis_akreditasi ja ON ja.id = pus.jenis_akreditasi_id 
				LEFT JOIN 
					status_akreditasi sa ON sa.id = pus.status_akreditasi_id
				LEFT JOIN 
					lpa l ON l.id = pus.lpa_id 
				LEFT JOIN 
					penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
				LEFT JOIN 
					status_usulan su ON su.id = ppus.status_usulan_id 
				LEFT JOIN 
					berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id 
				LEFT JOIN 
					kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id 
				LEFT JOIN 
					penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id 
				LEFT JOIN 
					trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
				LEFT JOIN 
					trans_final_ep_verifikator tfev on tfev.penetapan_verifikator_id = pv.id 
				LEFT JOIN 
					pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
				LEFT JOIN 
					persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
				LEFT JOIN 
					persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
				LEFT JOIN 
					data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
				LEFT JOIN 
					tte_lpa tl ON tl.data_sertifikat_id = ds.id 
				LEFT JOIN 
					tte_dirjen td ON tl.id = td.tte_lpa_id  
				LEFT JOIN 
					status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
				LEFT JOIN 
					dbfaskes.trans_final tf ON tf.kode_faskes = pus.fasyankes_id 
				LEFT JOIN 
					dbfaskes.data_labkes dl ON dl.id_faskes = tf.id_faskes
				LEFT JOIN 
					dbfaskes.propinsi p ON dl.id_prov = p.id_prop 
				LEFT JOIN
					dbfaskes.kota k ON dl.id_kota = k.id_kota 
				WHERE 
					pus.jenis_fasyankes = '7'" . $where . "
				ORDER BY 
				pus.created_at ASC
		");
		}
		return $sql->result_array();
		// return $this->db->last_query();
		// return $where;
	}

	function select_monitoring_primer($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes)
	{
		if (!empty($lpa_id) && $lpa_id != 9999) {
			$whereLPA = " AND l.id='" . $lpa_id . "'";
		} else {
			$whereLPA = "";
		}

		if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
			$tanggal = " AND (pus.tanggal_pengajuan BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "' )";
		} else {
			$tanggal = "";
		}

		if (!empty($propinsi) && $propinsi != 9999) {
			if ($jenis_fasyankes == 2) {
				$whereProp = " AND pp.provinsi_code = '" . (int)$propinsi . "'";
			} else {
				$whereProp = " AND p.id_prop='" . (int)$propinsi . "'";
			}
		} else {
			$whereProp = "";
		}

		if (!empty($kota) && $kota != 9999) {
			if ($jenis_fasyankes == 2) {
				$whereKota = " AND pp.kabkot_code ='" . (int)$kota . "'";
			} else {
				$whereKota = " AND k.id_kota='" . (int)$kota . "'";
			}
		} else {
			$whereKota = "";
		}

		$where = $whereLPA . $tanggal . $whereProp . $whereKota;

		if ($jenis_fasyankes == 1) {
			$sql = $this->db->query("SELECT 
					pus.id,
					dp.nama_pm as nama_fasyankes,
					p.nama_prop,
					kp.kategori_user as jenis_pelayanan,
					k.nama_kota,
					pus.fasyankes_id,
					pus.fasyankes_id_baru,
					jf.nama as jenis_fasyankes,
					js.nama as jenis_survei,
					ja.nama as jenis_akreditasi,
					sa.nama as akreditasi_terakhir,
					pus.url_sertifikasi_akreditasi_sebelumnya,
					pus.tanggal_akhir_sertifikat,
					l.nama as nama_lpa,
					pus.tanggal_pengajuan,
					pus.created_at,
					pus.status_admin_lpa,
					( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pusd.pengajuan_usulan_survei_id = pus.id ) AS tanggal_survei,
						IF(ppus.id IS NULL,'Pengajuan Usulan Survei',
						IF(bus.id IS NULL,'Respon LPA',
						IF(kb.id IS NULL,'Kesiapan Survei',
						IF(pts.id IS NULL,'Hasil Kesiapan Survei',
						IF(tfes.id IS NULL,'Kesepakatan Survei',
						IF(pls.id IS NULL,'Penilaian EP Surveior',
						IF(pv.id IS NULL,'Pengiriman Laporan',
						IF(tfev.id IS NULL,'Penugasan Verifikator',
						IF( pr.id IS NULL, 'Penilaian EP Verifikator', 
						IF ( td.id IS NULL , 'Pengiriman Rekomendasi' , 'Penerbitan Sertifikat')))))))))) AS tahap,
						pus.id as pengajuan_usulan_survei_id_monitor,
						ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
						bus.id as berkas_usulan_survei_id_monitor,
						kb.id as kelengkapan_berkas_id_monitor,
						pts.id as penetapan_tanggal_survei_id_monitor,
						tfes.id as trans_final_ep_surveior_id_monitor,
						pls.id as pengiriman_laporan_survei_id_monitor,
						pv.id as penetapan_verifikator_id_monitor,
						tfev.id as trans_final_ep_verifikator_id_monitor,
						pr.id as pengiriman_rekomendasi_id_monitor,
						td.id as penerbitan_sertifikat_id_monitor,
						sr.nama as status_akreditasi_nama,
						su.id as status_usulan_id,
						ppus.keterangan 
				FROM 
					pengajuan_usulan_survei pus
				LEFT JOIN 
					jenis_fasyankes jf ON jf.id = pus.jenis_fasyankes
				LEFT JOIN 
					jenis_survei js ON js.id = pus.jenis_survei_id 
				LEFT JOIN 
					jenis_akreditasi ja ON ja.id = pus.jenis_akreditasi_id 
				LEFT JOIN 
					status_akreditasi sa ON sa.id = pus.status_akreditasi_id
				LEFT JOIN 
					lpa l ON l.id = pus.lpa_id 
				LEFT JOIN 
					penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
				LEFT JOIN 
					status_usulan su ON su.id = ppus.status_usulan_id 
				LEFT JOIN 
					berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id 
				LEFT JOIN 
					kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id 
				LEFT JOIN 
					penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id 
				LEFT JOIN 
					trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
				LEFT JOIN 
					trans_final_ep_verifikator tfev on tfev.penetapan_verifikator_id = pv.id 
				LEFT JOIN 
					pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
				LEFT JOIN 
					persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
				LEFT JOIN 
					persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
				LEFT JOIN 
					data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
				LEFT JOIN 
					tte_lpa tl ON tl.data_sertifikat_id = ds.id 
				LEFT JOIN 
					tte_dirjen td ON tl.id = td.tte_lpa_id  
				LEFT JOIN 
					status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
				LEFT JOIN 
					dbfaskes.trans_final tf ON tf.kode_faskes = pus.fasyankes_id 
				LEFT JOIN 
					dbfaskes.data_pm dp ON dp.id_faskes = tf.id_faskes 
				LEFT JOIN 
					dbfaskes.kategori_pm kp ON kp.id = dp.id_kategori 
				LEFT JOIN 
					dbfaskes.propinsi p ON p.id_prop = dp.id_prov_pm  
				LEFT JOIN 
					dbfaskes.kota k ON k.id_kota = dp.id_kota_pm 
				WHERE 
					pus.jenis_fasyankes = '1' " . $where . "
				ORDER BY 
					pus.created_at ASC
			");
			return $sql->result_array();
		} else if ($jenis_fasyankes == 2) {
			$sql = $this->db->query("SELECT 
					pus.id,
					pp.name as nama_fasyankes,
					p.nama_prop,
					k.nama_kota,
					pp.jenis_pelayanan as jenis_pelayanan,
					pus.fasyankes_id,
					pus.fasyankes_id_baru,
					jf.nama as jenis_fasyankes,
					js.nama as jenis_survei,
					ja.nama as jenis_akreditasi,
					sa.nama as akreditasi_terakhir,
					pus.url_sertifikasi_akreditasi_sebelumnya,
					pus.tanggal_akhir_sertifikat,
					l.nama as nama_lpa,
					pus.tanggal_pengajuan,
					pus.created_at,
					pus.status_admin_lpa,
					( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pusd.pengajuan_usulan_survei_id = pus.id ) AS tanggal_survei,
						IF(ppus.id IS NULL,'Pengajuan Usulan Survei',
						IF(bus.id IS NULL,'Respon LPA',
						IF(kb.id IS NULL,'Kesiapan Survei',
						IF(pts.id IS NULL,'Hasil Kesiapan Survei',
						IF(tfes.id IS NULL,'Kesepakatan Survei',
						IF(pls.id IS NULL,'Penilaian EP Surveior',
						IF(pv.id IS NULL,'Pengiriman Laporan',
						IF(tfev.id IS NULL,'Penugasan Verifikator',
						IF( pr.id IS NULL, 'Penilaian EP Verifikator', 
						IF ( td.id IS NULL , 'Pengiriman Rekomendasi' , 'Penerbitan Sertifikat')))))))))) AS tahap,
						pus.id as pengajuan_usulan_survei_id_monitor,
						ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
						bus.id as berkas_usulan_survei_id_monitor,
						kb.id as kelengkapan_berkas_id_monitor,
						pts.id as penetapan_tanggal_survei_id_monitor,
						tfes.id as trans_final_ep_surveior_id_monitor,
						pls.id as pengiriman_laporan_survei_id_monitor,
						pv.id as penetapan_verifikator_id_monitor,
						tfev.id as trans_final_ep_verifikator_id_monitor,
						pr.id as pengiriman_rekomendasi_id_monitor,
						td.id as penerbitan_sertifikat_id_monitor,
						sr.nama as status_akreditasi_nama,
						su.id as status_usulan_id,
						ppus.keterangan 
				FROM 
					pengajuan_usulan_survei pus
				LEFT JOIN 
					jenis_fasyankes jf ON jf.id = pus.jenis_fasyankes
				LEFT JOIN 
					jenis_survei js ON js.id = pus.jenis_survei_id 
				LEFT JOIN 
					jenis_akreditasi ja ON ja.id = pus.jenis_akreditasi_id 
				LEFT JOIN 
					status_akreditasi sa ON sa.id = pus.status_akreditasi_id
				LEFT JOIN 
					lpa l ON l.id = pus.lpa_id 
				LEFT JOIN 
					penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
				LEFT JOIN 
					status_usulan su ON su.id = ppus.status_usulan_id 
				LEFT JOIN 
					berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id 
				LEFT JOIN 
					kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id 
				LEFT JOIN 
					penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id 
				LEFT JOIN 
					trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
				LEFT JOIN 
					trans_final_ep_verifikator tfev on tfev.penetapan_verifikator_id = pv.id 
				LEFT JOIN 
					pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
				LEFT JOIN 
					persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
				LEFT JOIN 
					persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
				LEFT JOIN 
					data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
				LEFT JOIN 
					tte_lpa tl ON tl.data_sertifikat_id = ds.id 
				LEFT JOIN 
					tte_dirjen td ON tl.id = td.tte_lpa_id  
				LEFT JOIN 
					status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
				LEFT JOIN 
					dbfaskes.puskesmas_pusdatin pp ON pp.kode_sarana = pus.fasyankes_id
				LEFT JOIN 
					dbfaskes.propinsi p ON p.id_prop = pp.provinsi_code 
				LEFT JOIN 
					dbfaskes.kota k ON k.id_kota = pp.kabkot_code 
				WHERE 
					pus.jenis_fasyankes = '2' " . $where . "
				ORDER BY 
					pus.created_at ASC
			");
			return $sql->result_array();
		} else if ($jenis_fasyankes == 3) {
			$sql = $this->db->query("SELECT 
					pus.id,
					dk.nama_klinik as nama_fasyankes,
					p.nama_prop,
					k.nama_kota,
					dk.jenis_klinik as jenis_pelayanan,
					pus.fasyankes_id,
					pus.fasyankes_id_baru,
					jf.nama as jenis_fasyankes,
					js.nama as jenis_survei,
					ja.nama as jenis_akreditasi,
					sa.nama as akreditasi_terakhir,
					pus.url_sertifikasi_akreditasi_sebelumnya,
					pus.tanggal_akhir_sertifikat,
					l.nama as nama_lpa,
					pus.tanggal_pengajuan,
					pus.created_at,
					pus.status_admin_lpa,
					( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pusd.pengajuan_usulan_survei_id = pus.id ) AS tanggal_survei,
						IF(ppus.id IS NULL,'Pengajuan Usulan Survei',
						IF(bus.id IS NULL,'Respon LPA',
						IF(kb.id IS NULL,'Kesiapan Survei',
						IF(pts.id IS NULL,'Hasil Kesiapan Survei',
						IF(tfes.id IS NULL,'Kesepakatan Survei',
						IF(pls.id IS NULL,'Penilaian EP Surveior',
						IF(pv.id IS NULL,'Pengiriman Laporan',
						IF(tfev.id IS NULL,'Penugasan Verifikator',
						IF( pr.id IS NULL, 'Penilaian EP Verifikator', 
						IF ( td.id IS NULL , 'Pengiriman Rekomendasi' , 'Penerbitan Sertifikat')))))))))) AS tahap,
						pus.id as pengajuan_usulan_survei_id_monitor,
						ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
						bus.id as berkas_usulan_survei_id_monitor,
						kb.id as kelengkapan_berkas_id_monitor,
						pts.id as penetapan_tanggal_survei_id_monitor,
						tfes.id as trans_final_ep_surveior_id_monitor,
						pls.id as pengiriman_laporan_survei_id_monitor,
						pv.id as penetapan_verifikator_id_monitor,
						tfev.id as trans_final_ep_verifikator_id_monitor,
						pr.id as pengiriman_rekomendasi_id_monitor,
						td.id as penerbitan_sertifikat_id_monitor,
						sr.nama as status_akreditasi_nama,
						su.id as status_usulan_id,
						ppus.keterangan
				FROM 
					pengajuan_usulan_survei pus
				LEFT JOIN 
					jenis_fasyankes jf ON jf.id = pus.jenis_fasyankes
				LEFT JOIN 
					jenis_survei js ON js.id = pus.jenis_survei_id 
				LEFT JOIN 
					jenis_akreditasi ja ON ja.id = pus.jenis_akreditasi_id 
				LEFT JOIN 
					status_akreditasi sa ON sa.id = pus.status_akreditasi_id
				LEFT JOIN 
					lpa l ON l.id = pus.lpa_id 
				LEFT JOIN 
					penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
				LEFT JOIN 
					status_usulan su ON su.id = ppus.status_usulan_id 
				LEFT JOIN 
					berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id 
				LEFT JOIN 
					kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id 
				LEFT JOIN 
					penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id 
				LEFT JOIN 
					trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
				LEFT JOIN 
					trans_final_ep_verifikator tfev on tfev.penetapan_verifikator_id = pv.id 
				LEFT JOIN 
					pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
				LEFT JOIN 
					persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
				LEFT JOIN 
					persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
				LEFT JOIN 
					data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
				LEFT JOIN 
					tte_lpa tl ON tl.data_sertifikat_id = ds.id 
				LEFT JOIN 
					tte_dirjen td ON tl.id = td.tte_lpa_id  
				LEFT JOIN 
					status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
				LEFT JOIN 
					dbfaskes.trans_final tf ON tf.kode_faskes = pus.fasyankes_id 
				LEFT JOIN 
					dbfaskes.data_klinik dk ON dk.id_faskes = tf.id_faskes 
				LEFT JOIN 
					dbfaskes.propinsi p ON p.id_prop = dk.id_prov 
				LEFT JOIN 
					dbfaskes.kota k ON k.id_kota  = dk.id_kota 
				WHERE 
					pus.jenis_fasyankes = '3' AND dk.jenis_klinik = 'Pratama' " . $where . "
				ORDER BY 
					pus.created_at ASC
			");
			return $sql->result_array();
		} else if ($jenis_fasyankes == 6) {
			$sql = $this->db->query("SELECT 
					pus.id,
					du.nama_utd as nama_fasyankes,
					p.nama_prop,
					k.nama_kota,
					du.jenis_utd as jenis_pelayanan,
					pus.fasyankes_id,
					pus.fasyankes_id_baru,
					jf.nama as jenis_fasyankes,
					js.nama as jenis_survei,
					ja.nama as jenis_akreditasi,
					sa.nama as akreditasi_terakhir,
					pus.url_sertifikasi_akreditasi_sebelumnya,
					pus.tanggal_akhir_sertifikat,
					l.nama as nama_lpa,
					pus.tanggal_pengajuan,
					pus.created_at,
					pus.status_admin_lpa,
					( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pusd.pengajuan_usulan_survei_id = pus.id ) AS tanggal_survei,
						IF(ppus.id IS NULL,'Pengajuan Usulan Survei',
						IF(bus.id IS NULL,'Respon LPA',
						IF(kb.id IS NULL,'Kesiapan Survei',
						IF(pts.id IS NULL,'Hasil Kesiapan Survei',
						IF(tfes.id IS NULL,'Kesepakatan Survei',
						IF(pls.id IS NULL,'Penilaian EP Surveior',
						IF(pv.id IS NULL,'Pengiriman Laporan',
						IF(tfev.id IS NULL,'Penugasan Verifikator',
						IF( pr.id IS NULL, 'Penilaian EP Verifikator', 
						IF ( td.id IS NULL , 'Pengiriman Rekomendasi' , 'Penerbitan Sertifikat')))))))))) AS tahap,
						pus.id as pengajuan_usulan_survei_id_monitor,
						ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
						bus.id as berkas_usulan_survei_id_monitor,
						kb.id as kelengkapan_berkas_id_monitor,
						pts.id as penetapan_tanggal_survei_id_monitor,
						tfes.id as trans_final_ep_surveior_id_monitor,
						pls.id as pengiriman_laporan_survei_id_monitor,
						pv.id as penetapan_verifikator_id_monitor,
						tfev.id as trans_final_ep_verifikator_id_monitor,
						pr.id as pengiriman_rekomendasi_id_monitor,
						td.id as penerbitan_sertifikat_id_monitor,
						sr.nama as status_akreditasi_nama,
						su.id as status_usulan_id,
						ppus.keterangan
				FROM 
					pengajuan_usulan_survei pus
				LEFT JOIN 
					jenis_fasyankes jf ON jf.id = pus.jenis_fasyankes
				LEFT JOIN 
					jenis_survei js ON js.id = pus.jenis_survei_id 
				LEFT JOIN 
					jenis_akreditasi ja ON ja.id = pus.jenis_akreditasi_id 
				LEFT JOIN 
					status_akreditasi sa ON sa.id = pus.status_akreditasi_id
				LEFT JOIN 
					lpa l ON l.id = pus.lpa_id 
				LEFT JOIN 
					penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
				LEFT JOIN 
					status_usulan su ON su.id = ppus.status_usulan_id 
				LEFT JOIN 
					berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id 
				LEFT JOIN 
					kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id 
				LEFT JOIN 
					penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id 
				LEFT JOIN 
					trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
				LEFT JOIN 
					trans_final_ep_verifikator tfev on tfev.penetapan_verifikator_id = pv.id 
				LEFT JOIN 
					pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
				LEFT JOIN 
					persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
				LEFT JOIN 
					persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
				LEFT JOIN 
					data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
				LEFT JOIN 
					tte_lpa tl ON tl.data_sertifikat_id = ds.id 
				LEFT JOIN 
					tte_dirjen td ON tl.id = td.tte_lpa_id  
				LEFT JOIN 
					status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
				LEFT JOIN 
					dbfaskes.trans_final tf ON tf.kode_faskes = pus.fasyankes_id 
				LEFT JOIN 
					dbfaskes.data_utd du ON du.id_faskes = tf.id_faskes 
				LEFT JOIN 
					dbfaskes.propinsi p ON p.id_prop = du.id_prov 
				LEFT JOIN 
					dbfaskes.kota k ON k.id_kota  = du.id_kota 
				WHERE 
					pus.jenis_fasyankes = '6' " . $where . "
				ORDER BY 
					pus.created_at ASC
			");
			return $sql->result_array();
		} else if ($jenis_fasyankes == 7) {
			$sql = $this->db->query("SELECT 
					pus.id,
					pus.fasyankes_id,
					pus.fasyankes_id_baru,
					dl.nama_lab as nama_fasyankes,
					p.nama_prop,
					k.nama_kota,
					dl.jenis_pelayanan,
					jf.nama as jenis_fasyankes,
					js.nama as jenis_survei,
					ja.nama as jenis_akreditasi,
					sa.nama as akreditasi_terakhir,
					pus.url_sertifikasi_akreditasi_sebelumnya,
					pus.tanggal_akhir_sertifikat,
					l.nama as nama_lpa,
					pus.tanggal_pengajuan,
					pus.created_at,
					pus.status_admin_lpa,
					( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pusd.pengajuan_usulan_survei_id = pus.id ) AS tanggal_survei,
						IF(ppus.id IS NULL,'Pengajuan Usulan Survei',
						IF(bus.id IS NULL,'Respon LPA',
						IF(kb.id IS NULL,'Kesiapan Survei',
						IF(pts.id IS NULL,'Hasil Kesiapan Survei',
						IF(tfes.id IS NULL,'Kesepakatan Survei',
						IF(pls.id IS NULL,'Penilaian EP Surveior',
						IF(pv.id IS NULL,'Pengiriman Laporan',
						IF(tfev.id IS NULL,'Penugasan Verifikator',
						IF( pr.id IS NULL, 'Penilaian EP Verifikator', 
						IF ( td.id IS NULL , 'Pengiriman Rekomendasi' , 'Penerbitan Sertifikat')))))))))) AS tahap,
						pus.id as pengajuan_usulan_survei_id_monitor,
						ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
						bus.id as berkas_usulan_survei_id_monitor,
						kb.id as kelengkapan_berkas_id_monitor,
						pts.id as penetapan_tanggal_survei_id_monitor,
						tfes.id as trans_final_ep_surveior_id_monitor,
						pls.id as pengiriman_laporan_survei_id_monitor,
						pv.id as penetapan_verifikator_id_monitor,
						tfev.id as trans_final_ep_verifikator_id_monitor,
						pr.id as pengiriman_rekomendasi_id_monitor,
						td.id as penerbitan_sertifikat_id_monitor,
						sr.nama as status_akreditasi_nama,
						su.id as status_usulan_id,
						ppus.keterangan
				FROM 
					pengajuan_usulan_survei pus
				LEFT JOIN 
					jenis_fasyankes jf ON jf.id = pus.jenis_fasyankes
				LEFT JOIN 
					jenis_survei js ON js.id = pus.jenis_survei_id 
				LEFT JOIN 
					jenis_akreditasi ja ON ja.id = pus.jenis_akreditasi_id 
				LEFT JOIN 
					status_akreditasi sa ON sa.id = pus.status_akreditasi_id
				LEFT JOIN 
					lpa l ON l.id = pus.lpa_id 
				LEFT JOIN 
					penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
				LEFT JOIN 
					status_usulan su ON su.id = ppus.status_usulan_id 
				LEFT JOIN 
					berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id 
				LEFT JOIN 
					kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id 
				LEFT JOIN 
					penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id 
				LEFT JOIN 
					trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id
				LEFT JOIN 
					penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
				LEFT JOIN 
					trans_final_ep_verifikator tfev on tfev.penetapan_verifikator_id = pv.id 
				LEFT JOIN 
					pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
				LEFT JOIN 
					persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
				LEFT JOIN 
					persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
				LEFT JOIN 
					data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
				LEFT JOIN 
					tte_lpa tl ON tl.data_sertifikat_id = ds.id 
				LEFT JOIN 
					tte_dirjen td ON tl.id = td.tte_lpa_id  
				LEFT JOIN 
					status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
				LEFT JOIN 
					dbfaskes.trans_final tf ON tf.kode_faskes = pus.fasyankes_id 
				LEFT JOIN 
					dbfaskes.data_labkes dl ON dl.id_faskes = tf.id_faskes
				LEFT JOIN 
					dbfaskes.propinsi p ON dl.id_prov = p.id_prop 
				LEFT JOIN
					dbfaskes.kota k ON dl.id_kota = k.id_kota 
				WHERE 
					pus.jenis_fasyankes = '7'" . $where . "
				ORDER BY 
				pus.created_at ASC
		");

			return $sql->result_array();
		}
	}

	function getdataPenolakanPengajuan($lpa_id)
	{
		if ($lpa_id == 'all') {
			$where = " ";
		} else {
			$where = "AND pus.lpa_id ='" . $lpa_id . "'";
		}
		// $sql = $this->db->query("SELECT 
		// 	pp.id as pengajuan_pembatalan_id,
		// 	pus.id,
		// 	pus.fasyankes_id,
		// 	jf.nama as jenis_fasyankes,
		// 	pus.tanggal_pengajuan,
		// 	ap.nama as alasan_pembatalan,
		// 	pp.surat_pembatalan,
		// 	ppus.status_usulan_id as status_usulan_id,
		// 	su.nama as status_usulan,
		// 	l.nama as nama_lpa,
		// 	pp.created_at 
		// FROM 
		// 	pengajuan_pembatalan pp 
		// LEFT JOIN 
		// 	penerimaan_pengajuan_usulan_survei ppus ON ppus.id = pp.penerimaan_pengajuan_usulan_survei_id 
		// LEFT JOIN 
		// 	pengajuan_usulan_survei pus ON pus.id = ppus.pengajuan_usulan_survei_id 
		// LEFT JOIN 
		// 	jenis_fasyankes jf ON jf.id = pus.jenis_fasyankes 
		// LEFT JOIN 
		// 	alasan_pembatalan ap ON ap.id = pp.alasan_pembatalan 
		// LEFT JOIN 
		// 	status_usulan su ON su.id = ppus.status_usulan_id 
		// LEFT JOIN 
		// 	lpa l ON l.id = pus.lpa_id 
		// WHERE 1=1
		// " . $where . "
		// ");

		$sql = $this->db->query("SELECT 
		pp.id as pengajuan_pembatalan_id,
		pus.id,
		pus.fasyankes_id,
		IF (
			pus.jenis_fasyankes = 2,
			pp2.name,
			IF (
				pus.jenis_fasyankes = 3,
				dk.nama_klinik,
				IF(
					pus.jenis_fasyankes = 6,
					du.nama_utd,
					IF(
						pus.jenis_fasyankes = 7,
						dl.nama_lab,
						''
					)
				)
			)
			) as nama_fasyankes,
			pus.jenis_fasyankes,
			jf.nama as jenis_fasyankes,
			pus.tanggal_pengajuan,
			ap.nama as alasan_pembatalan,
			pp.surat_pembatalan,
			ppus.status_usulan_id as status_usulan_id,
			su.nama as status_usulan,
			l.nama as nama_lpa,
			pp.created_at 
		FROM 
			pengajuan_pembatalan pp 
		LEFT JOIN 
			penerimaan_pengajuan_usulan_survei ppus ON ppus.id = pp.penerimaan_pengajuan_usulan_survei_id 
		LEFT JOIN 
			pengajuan_usulan_survei pus ON pus.id = ppus.pengajuan_usulan_survei_id 
		LEFT JOIN 
			jenis_fasyankes jf ON jf.id = pus.jenis_fasyankes 
		LEFT JOIN 
			alasan_pembatalan ap ON ap.id = pp.alasan_pembatalan 
		LEFT JOIN 
			status_usulan su ON su.id = ppus.status_usulan_id 
		LEFT JOIN 
			lpa l ON l.id = pus.lpa_id 
		LEFT JOIN 
			dbfaskes.trans_final tf ON tf.kode_faskes = pus.fasyankes_id 
		LEFT JOIN 
			dbfaskes.puskesmas_pusdatin pp2 ON pp2.kode_sarana = pus.fasyankes_id 
		LEFT JOIN 
			dbfaskes.data_klinik dk ON dk.id_faskes = tf.id_faskes 
		LEFT JOIN 
			dbfaskes.data_utd du ON du.id_faskes = tf.id_faskes 
		LEFT JOIN 
			dbfaskes.data_labkes dl ON dl.id_faskes = tf.id_faskes 
		WHERE 1=1
			" . $where . "
		");


		// AND
		// 	ppus.status_usulan_id = '3'
		return $sql->result_array();
	}

	function detailpenolakanPengajuan($id, $lpa_id)
	{
		$sql = $this->db->query("SELECT 
			pus.id as pengajuan_usulan_survei_id,
			pp.penerimaan_pengajuan_usulan_survei_id,
			ap.nama as alasan_pembatalan,
			pp.surat_pembatalan,
			pp.created_at as tanggal_pengajuan_pembatalan
		FROM 
			pengajuan_pembatalan pp 
		LEFT JOIN 
			penerimaan_pengajuan_usulan_survei ppus ON ppus.id = pp.penerimaan_pengajuan_usulan_survei_id 
		LEFT JOIN 
			pengajuan_usulan_survei pus ON pus.id = ppus.pengajuan_usulan_survei_id 
		LEFT JOIN 
			alasan_pembatalan ap ON ap.id = pp.alasan_pembatalan 
		WHERE 
			pp.id = '" . $id . "'
		AND
			pus.lpa_id = '" . $lpa_id . "'
		");
		return $sql->result_array();
	}

	function detailpenolakanPengajuankatim($id)
	{
		$sql = $this->db->query("SELECT 
			pus.id as pengajuan_usulan_survei_id,
			pp.penerimaan_pengajuan_usulan_survei_id,
			ap.nama as alasan_pembatalan,
			pp.surat_pembatalan,
			pp.created_at as tanggal_pengajuan_pembatalan
		FROM 
			pengajuan_pembatalan pp 
		LEFT JOIN 
			penerimaan_pengajuan_usulan_survei ppus ON ppus.id = pp.penerimaan_pengajuan_usulan_survei_id 
		LEFT JOIN 
			pengajuan_usulan_survei pus ON pus.id = ppus.pengajuan_usulan_survei_id 
		LEFT JOIN 
			alasan_pembatalan ap ON ap.id = pp.alasan_pembatalan 
		WHERE 
			pp.id = '" . $id . "'
		");
		return $sql->result_array();
	}
}


// QUERY PUSEKSMAS BARU
// SELECT
// 			a.id,
// 			a.lpa_id,
// 			a.jenis_fasyankes,
// 			a.status_admin_lpa,
// 			a.created_at,
// 			a.fasyankes_id,
// 			b.status_usulan_id,
// 			b.keterangan,
// 			h.nama AS status_usulan,
// 			c.nama AS jenis_fasyankes_nama,
// 			d.nama AS jenis_survei,
// 			e.nama AS jenis_akreditasi,
// 			f.nama AS status_akreditasi,
// 			g.nama AS lpa,
// 			pp.kode_baru as fasyankes_id,
// 			pp.name as nama_fasyankes,
// 			pp.provinsi_nama as nama_prop,
// 			pp.kabkot_nama as nama_kota,
// 			pp.provinsi_code as provinsi_id,
// 			pp.kabkot_code as kabkota_id,
// 			i.penerimaan_pengajuan_usulan_survei_id,
// 			pus.id as pengajuan_usulan_survei_id_monitor,
// 			ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
// 			bus.id as berkas_usulan_survei_id_monitor,
// 			kb.id as kelengkapan_berkas_id_monitor,
// 			pts.id as penetapan_tanggal_survei_id_monitor,
// 			tfes.id as trans_final_ep_surveior_id_monitor,
// 			pls.id as pengiriman_laporan_survei_id_monitor,
// 			pv.id as penetapan_verifikator_id_monitor,
// 			tfev.id as trans_final_ep_verifikator_id_monitor,
// 			pr.id as pengiriman_rekomendasi_id_monitor,
// 			td.id as penerbitan_sertifikat_id_monitor,
// 			sr.nama as status_akreditasi_nama,
// 			( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pengajuan_usulan_survei_id = a.id ) AS tanggal_survei,
// 				IF
// 				(
// 					b.id IS NULL,
// 					'Pengajuan Usulan Survei',
// 				IF
// 				(
// 					i.id IS NULL,
// 					'Respon LPA',
// 				IF
// 					(
// 						j.id IS NULL,
// 						'Kesiapan Survei',
// 					IF
// 						(
// 							k.id IS NULL,
// 							'Hasil Kesiapan Survei',
// 						IF
// 							(
// 								l.id IS NULL,
// 								'Kesepakatan Survei',
// 							IF
// 								(
// 									m.id IS NULL,
// 									'Penilaian EP Surveior',
// 								IF
// 									(
// 										pv.id IS NULL,
// 										'Pengiriman Laporan',
// 									IF
// 										(
// 											tfev.id IS NULL,
// 											'Penugasan Verifikator',
// 										IF
// 											( pr.id IS NULL, 'Penilaian EP Verifikator', 
// 												IF 
// 												( td.id IS NULL , 'Pengiriman Rekomendasi' , 'Penerbitan Sertifikat')))))))))) AS tahap
// 			FROM
// 				pengajuan_usulan_survei a
// 				LEFT JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
// 				JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
// 				JOIN jenis_survei d ON a.jenis_survei_id = d.id
// 				JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
// 				JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
// 				JOIN lpa g ON a.lpa_id = g.id
// 				LEFT JOIN dbfaskes.puskesmas_pusdatin pp ON pp.kode_sarana = a.fasyankes_id 
// 				LEFT JOIN status_usulan h ON b.status_usulan_id = h.id
// 				LEFT JOIN berkas_usulan_survei i on i.penerimaan_pengajuan_usulan_survei_id = b.id
// 				LEFT JOIN kelengkapan_berkas j on j.berkas_usulan_survei_id = i.id
// 				LEFT JOIN penetapan_tanggal_survei k on k.kelengkapan_berkas_id = j.id
// 				LEFT JOIN trans_final_ep_surveior l on l.penetapan_tanggal_survei_id = k.id
// 				LEFT JOIN pengiriman_laporan_survei m on m.penetapan_tanggal_survei_id = k.id
// 				LEFT JOIN pengajuan_usulan_survei pus ON pus.id = a.id 
// 				LEFT JOIN penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
// 				LEFT JOIN berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
// 				LEFT JOIN kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id
// 				LEFT JOIN penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id
// 				LEFT JOIN trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
// 				LEFT JOIN pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id 
// 				LEFT JOIN penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
// 				LEFT JOIN trans_final_ep_verifikator tfev ON tfev.penetapan_verifikator_id = pv.id 
// 				LEFT JOIN pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
// 				LEFT JOIN persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
// 				LEFT JOIN persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
// 				LEFT JOIN data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
// 				LEFT JOIN tte_lpa tl ON tl.data_sertifikat_id = ds.id 
// 				LEFT JOIN tte_dirjen td ON tl.id = td.tte_lpa_id  
// 				LEFT JOIN status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
// 			WHERE 1=1 " . $raw_user_id . "
// 			ORDER BY
// 			a.created_at DESC"

// QUERY PUSKESMAS LAMA
// SELECT
// 			a.*,
// 			b.status_usulan_id,
// 			b.keterangan,
// 			h.nama AS status_usulan,
// 			c.nama AS jenis_fasyankes_nama,
// 			d.nama AS jenis_survei,
// 			e.nama AS jenis_akreditasi,
// 			f.nama AS status_akreditasi,
// 			g.nama AS lpa,
// 			daftar_puskesmas.PELAYANAN AS kemampuan_pelayanan,
// 			daftar_puskesmas.nama AS nama_fasyankes,
// 			daftar_puskesmas.PROV_DAGRI AS provinsi_id,
// 			daftar_puskesmas.PROVINSI AS nama_prop,
// 			daftar_puskesmas.kode_kabupaten AS kabkota_id,
// 			daftar_puskesmas.KABKOTA AS nama_kota,
// 			i.penerimaan_pengajuan_usulan_survei_id,
// 			i.url_surat_permohonan_survei,
// 			i.url_profil_fasyankes,
// 			i.url_laporan_hasil_penilaian_mandiri,
// 			i.url_pps_reakreditasi,
// 			i.url_surat_usulan_dinas,
// 			i.update_dfo,
// 			i.update_aspak,
// 			i.update_sisdmk,
// 			i.update_inm,
// 			i.update_ikp,
// 			i.id AS berkas_usulan_survei_id,
// 			j.id AS kelengkapan_berkas_id,
// 			j.kelengkapan_berkas_usulan,
// 			j.kelengkapan_berkas_usulan_catatan,
// 			j.kelengkapan_dfo,
// 			j.kelengkapan_dfo_catatan,
// 			j.kelengkapan_sarpras_alkes,
// 			j.kelengkapan_sarpras_alkes_catatan,
// 			j.kelengkapan_nakes,
// 			j.kelengkapan_nakes_catatan,
// 			j.kelengkapan_laporan_inm,
// 			j.kelengkapan_laporan_inm_catatan,
// 			j.kelengkapan_laporan_ikp,
// 			j.kelengkapan_laporan_ikp_catatan,
// 			k.kelengkapan_berkas_id as kelengkapan_berkas_id_2,
// 			k.id as penetapan_tanggal_survei_id,
// 			k.url_dokumen_kontrak,
// 			k.url_surat_tugas,
// 			k.tanggal_survei,
// 			k.url_dokumen_pendukung_ep,
// 			k.surveior_satu,
// 			k.status_surveior_satu,
// 			k.surveior_dua,
// 			k.status_surveior_dua,
// 			l.final AS status_final_ep,
// 			m.id AS pengiriman_laporan_survei_id,
// 			m.tanggal_survei_satu,
// 			m.tanggal_survei_dua,
// 			m.tanggal_survei_tiga,
// 			m.url_bukti_satu,
// 			m.url_bukti_dua,
// 			m.url_bukti_tiga,
// 			pus.id as pengajuan_usulan_survei_id_monitor,
// 			ppus.id as penerimaan_pengajuan_usulan_survei_id_monitor,
// 			bus.id as berkas_usulan_survei_id_monitor,
// 			kb.id as kelengkapan_berkas_id_monitor,
// 			pts.id as penetapan_tanggal_survei_id_monitor,
// 			tfes.id as trans_final_ep_surveior_id_monitor,
// 			pls.id as pengiriman_laporan_survei_id_monitor,
// 			pv.id as penetapan_verifikator_id_monitor,
// 			tfev.id as trans_final_ep_verifikator_id_monitor,
// 			pr.id as pengiriman_rekomendasi_id_monitor,
// 			td.id as penerbitan_sertifikat_id_monitor,
// 			sr.nama as status_akreditasi_nama,
// 			( SELECT CONCAT('[', GROUP_CONCAT(JSON_QUOTE(tanggal_survei)), ']') FROM pengajuan_usulan_survei_detail pusd WHERE pengajuan_usulan_survei_id = a.id ) AS tanggal_survei,
// 				IF
// 				(
// 					b.id IS NULL,
// 					'Pengajuan Usulan Survei',
// 				IF
// 				(
// 					i.id IS NULL,
// 					'Respon LPA',
// 				IF
// 					(
// 						j.id IS NULL,
// 						'Kesiapan Survei',
// 					IF
// 						(
// 							k.id IS NULL,
// 							'Hasil Kesiapan Survei',
// 						IF
// 							(
// 								l.id IS NULL,
// 								'Kesepakatan Survei',
// 							IF
// 								(
// 									m.id IS NULL,
// 									'Penilaian EP Surveior',
// 								IF
// 									(
// 										pv.id IS NULL,
// 										'Pengiriman Laporan',
// 									IF
// 										(
// 											tfev.id IS NULL,
// 											'Penugasan Verifikator',
// 										IF
// 											( pr.id IS NULL, 'Penilaian EP Verifikator', 
// 												IF 
// 												( td.id IS NULL , 'Pengiriman Rekomendasi' , 'Penerbitan Sertifikat')))))))))) AS tahap
// 			FROM
// 				pengajuan_usulan_survei a
// 				LEFT JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
// 				JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
// 				JOIN jenis_survei d ON a.jenis_survei_id = d.id
// 				JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
// 				JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
// 				JOIN lpa g ON a.lpa_id = g.id
// 				JOIN dbfaskes.daftar_puskesmas ON a.fasyankes_id = daftar_puskesmas.kode_satker
// 				LEFT JOIN status_usulan h ON b.status_usulan_id = h.id
// 				LEFT JOIN berkas_usulan_survei i on i.penerimaan_pengajuan_usulan_survei_id = b.id
// 				LEFT JOIN kelengkapan_berkas j on j.berkas_usulan_survei_id = i.id
// 				LEFT JOIN penetapan_tanggal_survei k on k.kelengkapan_berkas_id = j.id
// 				LEFT JOIN trans_final_ep_surveior l on l.penetapan_tanggal_survei_id = k.id
// 				LEFT JOIN pengiriman_laporan_survei m on m.penetapan_tanggal_survei_id = k.id
// 				LEFT JOIN pengajuan_usulan_survei pus ON pus.id = a.id 
// 				LEFT JOIN penerimaan_pengajuan_usulan_survei ppus ON ppus.pengajuan_usulan_survei_id = pus.id 
// 				LEFT JOIN berkas_usulan_survei bus ON bus.penerimaan_pengajuan_usulan_survei_id = ppus.id
// 				LEFT JOIN kelengkapan_berkas kb ON kb.berkas_usulan_survei_id = bus.id
// 				LEFT JOIN penetapan_tanggal_survei pts ON pts.kelengkapan_berkas_id = kb.id
// 				LEFT JOIN trans_final_ep_surveior tfes ON tfes.penetapan_tanggal_survei_id = pts.id
// 				LEFT JOIN pengiriman_laporan_survei pls ON pls.penetapan_tanggal_survei_id = pts.id 
// 				LEFT JOIN penetapan_verifikator pv ON pv.pengiriman_laporan_survei_id = pls.id 
// 				LEFT JOIN trans_final_ep_verifikator tfev ON tfev.penetapan_verifikator_id = pv.id 
// 				LEFT JOIN pengiriman_rekomendasi pr ON pr.trans_final_ep_verifikator_id = tfev.id
// 				LEFT JOIN persetujuan_ketua pk ON pr.id = pk.pengiriman_rekomendasi_id 
// 				LEFT JOIN persetujuan_direktur pd ON pk.id = pd.persetujuan_ketua_id 
// 				LEFT JOIN data_sertifikat ds ON ds.persetujuan_direktur_id = pd.id 
// 				LEFT JOIN tte_lpa tl ON tl.data_sertifikat_id = ds.id 
// 				LEFT JOIN tte_dirjen td ON tl.id = td.tte_lpa_id  
// 				LEFT JOIN status_rekomendasi sr ON pr.status_rekomendasi_id = sr.id
// 			WHERE 1=1 " . $raw_user_id . "
// 			ORDER BY
// 			a.created_at DESC"
