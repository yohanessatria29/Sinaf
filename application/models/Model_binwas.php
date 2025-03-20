<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Model_binwas extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

    function select_pengajuan_search($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes, $status_verifikasi_id)
	{
		if (!empty($lpa_id) && $lpa_id != 9999) {
			$lpa_id = " AND a.lpa_id='" . $lpa_id . "'";
		} else {
			$lpa_id = "";
		}

		if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
			$tanggal_awal = " AND (a.tanggal_awal_rencana_survei <='" . $tanggal_akhir . "' AND a.tanggal_akhir_rencana_survei >= '" . $tanggal_awal . "' )";
		} else {
			$tanggal_awal = "";
		}

		if (!empty($propinsi) && $propinsi != 9999) {
			if ($jenis_fasyankes == 2) {
				$propinsi2 = " AND puskesmas_pusdatin.provinsi_code='" . (int)$propinsi . "'";
			} else {
				$propinsi2 = " AND propinsi.id_prop='" . (int)$propinsi . "'";
			}
		} else {
			$propinsi2 = "";
		}

		if (!empty($kota) && $kota != 9999) {
			if ($jenis_fasyankes == 2) {
				$kota = " AND puskesmas_pusdatin.kabkot_code='" . (int)$kota . "'";
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

		if (!empty($status_verifikasi_id)) {
			if ($status_verifikasi_id == 1) {
				$status_verifikasi_id = " AND q.id IS NULL 
				ORDER BY
				p.created_at ASC";
			} else {
				$status_verifikasi_id = "  AND q.id IS NOT NULL 
				ORDER BY
				q.created_at ASC";
			}
		} else {
			$status_verifikasi_id = " AND q.id IS NULL 
			ORDER BY
			p.created_at ASC";
		}

		// $raw_user_id=" and a.jenis_fasyankes='".$jenis_fasyankes."' and dbfaskes.propinsi.id_prop='".$propinsi."' and dbfaskes.kota.id_kota='".$kota."' ";
		//    $raw_user_id= $propinsi.$kota.$jenis_fasyankes;
		$raw_user_id = $jenis_fasyankes2 . $lpa_id . $tanggal_awal . $propinsi2 . $kota . $status_verifikasi_id;

		if($jenis_fasyankes==1 || $jenis_fasyankes==null){
			$data_select ="trans_final.kode_faskes AS kode_faskes,
			trans_final.id_faskes AS id_faskes,
			trans_final.kode_faskes AS kode_faskes,
			trans_final.id_faskes AS id_faskes,
			data_pm.nama_pm AS nama_fasyankes,
			data_pm.id_prov_pm AS provinsi_id,
			propinsi.id_prop AS id_prop,
			propinsi.nama_prop AS nama_prop,
			data_pm.id_kota_pm AS kabkota_id,
			kota.id_kota AS id_kota,
			kota.nama_kota AS nama_kota,";

			$data_join ="LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
			LEFT OUTER JOIN dbfaskes.data_pm ON dbfaskes.trans_final.id_faskes = dbfaskes.data_pm.id_faskes
			LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_pm.id_prov_pm = dbfaskes.propinsi.id_prop
			LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_pm.id_kota_pm = dbfaskes.kota.id_kota";

		}else if($jenis_fasyankes==2) {
			$data_select ="puskesmas_pusdatin.name AS nama_fasyankes,
			puskesmas_pusdatin.provinsi_code AS provinsi_id,
			puskesmas_pusdatin.provinsi_nama AS nama_prop,
			puskesmas_pusdatin.kabkot_code AS kabkota_id,
			puskesmas_pusdatin.kabkot_nama AS nama_kota,";
			$data_join ="LEFT OUTER JOIN dbfaskes.puskesmas_pusdatin ON a.fasyankes_id = puskesmas_pusdatin.kode_sarana";
			
		}else if($jenis_fasyankes==3) {
			$data_select ="trans_final.kode_faskes AS kode_faskes, 
			trans_final.id_faskes AS id_faskes, 
			trans_final.kode_faskes AS kode_faskes, 
			trans_final.id_faskes AS id_faskes,
			data_klinik.nama_klinik AS nama_fasyankes,
			data_klinik.id_prov as provinsi_id, 
			propinsi.id_prop as id_prop, 
			propinsi.nama_prop as nama_prop, 
			data_klinik.id_kota as kabkota_id,
			kota.id_kota as id_kota, 
			kota.nama_kota AS nama_kota,";
			$data_join ="LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
			LEFT OUTER JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
			LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_klinik.id_prov = dbfaskes.propinsi.id_prop
			LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_klinik.id_kota = dbfaskes.kota.id_kota";
		}else if($jenis_fasyankes==6) {
			$data_select ="trans_final.kode_faskes AS kode_faskes,
			trans_final.id_faskes AS id_faskes,
			trans_final.kode_faskes AS kode_faskes,
			trans_final.id_faskes AS id_faskes,
			data_utd.nama_utd AS nama_fasyankes,
			data_utd.id_prov AS provinsi_id,
			propinsi.id_prop AS id_prop,
			propinsi.nama_prop AS nama_prop,
			data_utd.id_kota AS kabkota_id,
			kota.id_kota AS id_kota,
			kota.nama_kota AS nama_kota,";
			$data_join ="LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
			LEFT OUTER JOIN dbfaskes.data_utd ON dbfaskes.trans_final.id_faskes = dbfaskes.data_utd.id_faskes
			LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_utd.id_prov = dbfaskes.propinsi.id_prop
			LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_utd.id_kota = dbfaskes.kota.id_kota";
		}else if($jenis_fasyankes==7) {
			$data_select = "trans_final.kode_faskes AS kode_faskes,
			trans_final.id_faskes AS id_faskes,
			trans_final.kode_faskes AS kode_faskes,
			trans_final.id_faskes AS id_faskes,
			data_labkes.nama_lab AS nama_fasyankes,
			data_labkes.id_prov AS provinsi_id,
			propinsi.id_prop AS id_prop,
			propinsi.nama_prop AS nama_prop,
			data_labkes.id_kota AS kabkota_id,
			kota.id_kota AS id_kota,
			kota.nama_kota AS nama_kota,";
			$data_join ="LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
			LEFT OUTER JOIN dbfaskes.data_labkes ON dbfaskes.trans_final.id_faskes = dbfaskes.data_labkes.id_faskes
			LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_labkes.id_prov = dbfaskes.propinsi.id_prop
			LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_labkes.id_kota = dbfaskes.kota.id_kota";

		}

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
				".$data_select."
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
					k.metode_survei_id,
					k.url_dokumen_pendukung_ep,
					k.surveior_satu,
					k.status_surveior_satu,
					k.surveior_dua,
					k.status_surveior_dua,
					l.id AS trans_final_ep_surveior_id,
					l.final AS status_final_ep,
					m.id AS pengiriman_laporan_survei_id,
					m.tanggal_survei_satu,
					m.tanggal_survei_dua,
					m.tanggal_survei_tiga,
					m.url_bukti_satu,
					m.url_bukti_dua,
					m.url_bukti_tiga,
					n.id AS penetapan_verifikator_id,
					n.users_id AS users_verifikator,
					o.id AS trans_final_ep_verifikator_id,
					o.final AS status_final_ep_verifikator,
                    p.id AS pengiriman_rekomendasi_id,
                    p.url_surat_rekomendasi_status,
					q.id AS pengajuan_id,
					q.pengiriman_rekomendasi_id,
					q.status_rekomendasi_id AS pengajuan_rekomendasi,
					q.catatan_ketua,
					q.status_persetujuan,
					q.catatan_terima,
					q.created_at,
					r.id AS direktur_id,
					r.status_direktur AS direktur,
					r.persetujuan_ketua_id,
					r.catatan_direktur,
					s.id AS data_sertifikat_id,
					s.nomor_surat,
					s.tgl_nomor_surat,
					t.id AS tte_lpa_id,
					t.tgl_tte,
					t.tgl_berakhir,
					u.id AS tte_dirjen_id
			FROM
				pengajuan_usulan_survei a
				LEFT OUTER JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
				LEFT OUTER JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
				LEFT OUTER JOIN jenis_survei d ON a.jenis_survei_id = d.id
				LEFT OUTER JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
				LEFT OUTER JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
				LEFT OUTER JOIN lpa g ON a.lpa_id = g.id
				".$data_join."
				LEFT OUTER JOIN status_usulan h ON b.status_usulan_id = h.id 
				LEFT OUTER JOIN berkas_usulan_survei i on i.penerimaan_pengajuan_usulan_survei_id = b.id
				LEFT OUTER JOIN kelengkapan_berkas j on j.berkas_usulan_survei_id = i.id
				LEFT OUTER JOIN penetapan_tanggal_survei k on k.kelengkapan_berkas_id = j.id
				LEFT OUTER JOIN trans_final_ep_surveior l on l.penetapan_tanggal_survei_id = k.id
				LEFT OUTER JOIN pengiriman_laporan_survei m on m.penetapan_tanggal_survei_id = k.id
				LEFT OUTER JOIN penetapan_verifikator n on n.pengiriman_laporan_survei_id = m.id
				LEFT OUTER JOIN trans_final_ep_verifikator o on o.penetapan_verifikator_id = n.id
                INNER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
				LEFT OUTER JOIN persetujuan_ketua q ON q.pengiriman_rekomendasi_id = p.id
				LEFT OUTER JOIN persetujuan_direktur r ON r.persetujuan_ketua_id = q.id
				LEFT OUTER JOIN data_sertifikat s ON s.persetujuan_direktur_id = r.id
				LEFT OUTER JOIN tte_lpa t ON t.data_sertifikat_id = s.id
				LEFT OUTER JOIN tte_dirjen u ON u.tte_lpa_id = t.id

			WHERE 1=1 ".$raw_user_id." 
			");


		return $sql->result_array();
	}

	function select_pengajuan($user_id)
	{

		$raw_user_id = " and a.id='" . $user_id . "' ";

		$sql = $this->db->query("SELECT
		a.*,
		sa.nama AS status_akreditasi_sebelumnya,
		b.status_usulan_id,
		b.keterangan,
		h.nama AS status_usulan,
		c.nama AS jenis_fasyankes_nama,
		d.nama AS jenis_survei,
		e.nama AS jenis_akreditasi,
		f.nama AS status_akreditasi,
		g.nama AS lpa,
		b.id AS penerimaan_pengajuan_usulan_survei_id,
		i.url_surat_permohonan_survei,
		i.url_profil_fasyankes,
		i.url_laporan_hasil_penilaian_mandiri,
		i.url_pps_reakreditasi,
		i.url_surat_usulan_dinas,
		i.url_ijazah_kepala_puskesmas,
		i.url_sertifikat_pelatihan_puskesmas,
		i.update_dfo,
		i.update_aspak,
		i.update_sisdmk,
		i.update_inm,
		i.update_ikp,
		i.modified_at as tgl_edit_berkas, 
		j.modified_at as tgl_periksa_berkas, 
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
		l.id AS trans_final_ep_surveior_id,
		l.final AS status_final_ep,
		m.id AS pengiriman_laporan_survei_id,
		m.tanggal_survei_satu,
		m.tanggal_survei_dua,
		m.tanggal_survei_tiga,
		m.url_bukti_satu,
		m.url_bukti_dua,
		m.url_bukti_tiga,
		n.id AS penetapan_verifikator_id,
		n.users_id AS users_verifikator,
		n.users_id AS users_id_penetapan_verifikator,
		o.id AS trans_final_ep_verifikator_id,
		o.final AS status_final_ep_verifikator,
		p.id AS pengiriman_rekomendasi_id,
		p.status_rekomendasi_id,
		p.url_surat_rekomendasi_status,
		sr.nama AS nama_rekomendasi,
		q.id AS penerbitan_sertifikat_id,
		q.nomor_sertifikat,
		q.tanggal_penetapan,
		q.tanggal_berakhir_berlaku,
		q.url_dokumen_sertifikat,
		r.nama as nama_verifikator,
		s.id AS persetujuan_ketua_id,
		s.catatan_ketua,
		s.status_persetujuan,
		s.catatan_terima,
		s.catatan_tolak, 
		t.nama as nama_metode,
		u.catatan_direktur,
		v.id AS id_data_sertifikat,
		w.id AS id_tte_lpa,
		w.tgl_tte,
		w.tgl_berakhir,
		x.id AS id_tte_dirjen,
		x.url_sertifikat
		
		FROM
		pengajuan_usulan_survei a
		LEFT JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
		JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
		JOIN jenis_survei d ON a.jenis_survei_id = d.id
		JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
		JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
		JOIN lpa g ON a.lpa_id = g.id
		LEFT JOIN status_usulan h ON b.status_usulan_id = h.id 
		LEFT JOIN berkas_usulan_survei i on i.penerimaan_pengajuan_usulan_survei_id = b.id
		LEFT JOIN kelengkapan_berkas j on j.berkas_usulan_survei_id = i.id
		LEFT JOIN penetapan_tanggal_survei k on k.kelengkapan_berkas_id = j.id
		LEFT JOIN trans_final_ep_surveior l on l.penetapan_tanggal_survei_id = k.id
		LEFT JOIN pengiriman_laporan_survei m on m.penetapan_tanggal_survei_id = k.id
		LEFT JOIN penetapan_verifikator n on n.pengiriman_laporan_survei_id = m.id
		LEFT JOIN trans_final_ep_verifikator o on o.penetapan_verifikator_id = n.id
		LEFT JOIN pengiriman_rekomendasi p on p.trans_final_ep_verifikator_id = o.id
		LEFT JOIN status_rekomendasi sr on sr.id = p.status_rekomendasi_id
		LEFT JOIN penerbitan_sertifikat q on q.pengiriman_rekomendasi_id = p.id
		LEFT JOIN users r on n.users_id = r.id
		LEFT JOIN persetujuan_ketua s on s.pengiriman_rekomendasi_id = p.id
		LEFT JOIN metode_survei t on t.id = a.metode_survei_id 
		LEFT JOIN status_akreditasi sa ON sa.id = a.status_akreditasi_id
		LEFT JOIN persetujuan_direktur u on u.persetujuan_ketua_id = s.id
		LEFT JOIN data_sertifikat v on v.persetujuan_direktur_id = u.id
		LEFT JOIN tte_lpa w on w.data_sertifikat_id = v.id
		LEFT JOIN tte_dirjen x ON x.tte_lpa_id = w.id
		WHERE 1=1 " . $raw_user_id . " ");


		return $sql->result_array();
	}
}