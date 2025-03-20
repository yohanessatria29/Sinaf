<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Model_viewdata extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database('default');
	}

	function select_data($table, $where)
	{
		$this->db->get_where($table, $where);
		// $this->db->last_query();
		return $this->db->get_where($table, $where);
	}

	function input_data($table, $data)
	{
		return $this->db->insert($table, $data);
	}

	function edit_data($table, $where, $data)
	{
		$this->db->where($where);
		return $this->db->update($table, $data);
	}

	function delete_data($table, $where)
	{
		$this->db->delete($table, $where);
	}

	function select_users($user_id)
	{

		$raw_user_id = " and a.id='" . $user_id . "' ";

		$sql = $this->db->query("SELECT
		b.*
		FROM
		users a
		LEFT JOIN user_surveior b ON a.id = b.users_id
		WHERE 1=1 " . $raw_user_id . " ");


		return $sql->result_array();
	}

	function select_count($table, $user_id)
	{

		$raw_user_id = " and id_faskes='" . $user_id . "' ";

		$sql = $this->db->query("SELECT COUNT(*) as jml FROM " . $table . "  WHERE 1=1 " . $raw_user_id . " ");


		return $sql->result_array();
	}

	function get_data_surveior($lpa_id)
	{
		$raw_user_id = "";
		//$lpa_id="1";
		$sql = $this->db->query("Select 
		a.* ,
		b.nama_prop,
		b.id_prop,
		c.id_kota,
		c.prop_id,
		d.nama AS nama_lpa

		
		FROM user_surveior a
		JOIN dbfaskes.propinsi b ON a.provinsi_id = b.id_prop
		JOIN dbfaskes.kota c ON a.kabkota_id = c.id_kota
		JOIN lpa d ON a.lpa_id = d.id
		
		
		WHERE a.lpa_id=" . $lpa_id . "
		ORDER BY
		a.nama DESC");
		// if($lpa_id == ""){
		// 	redirect('login');
		// }else{
		return $sql;
		//}

	}

	function get_data_ukom_surveior($lpa_id)
	{
		$sql = $this->db->query("SELECT 
		a.nik,
		a.nama,
		a.lpa,
		a.nama_faskes,
		a.nama_bidang,
		a.status_ukom,
		a.tgl_berakhir_ukom
		FROM ukom_surveior a
		LEFT OUTER JOIN lpa b ON a.lpa_id = b.id
		LEFT OUTER JOIN jenis_fasyankes c ON a.id_faskes = c.id
		LEFT OUTER JOIN bidang d ON a.id_bidang = d.id
		WHERE a.lpa_id = " . $lpa_id . " ");
		return $sql;
	}

	function get_data_surveior_jumlah($lpa_id)
	{
		$raw_user_id = "";
		//$lpa_id="1";
		$sql = $this->db->query("SELECT 
		user_surveior.nama,
				user_surveior.id,
				user_surveior.nik,
				user_surveior.email,
				user_surveior.no_hp,
				user_surveior.keaktifan,
				lpa.nama AS nama_lpa,
				dbfaskes.propinsi.nama_prop AS nama_provinsi,
				dbfaskes.kota.nama_kota AS kab_kota,
			derivedTable1.user_surveior_id,
			SUM(derivedTable1.jumlah_penugasan) as jumlah_penugasan
		FROM 
		(SELECT
			id_surveior_satu_baru as user_surveior_id,
			COUNT(id) as jumlah_penugasan
		FROM
			surveior_lapangan
		GROUP BY
			id_surveior_satu_baru
		UNION ALL
		SELECT
			id_surveior_dua_baru as user_surveior_id,
			COUNT(id) as jumlah_penugasan
		FROM
			surveior_lapangan
		GROUP BY
			id_surveior_dua_baru) derivedTable1
			
			RIGHT OUTER JOIN user_surveior
			ON user_surveior.id = derivedTable1.user_surveior_id
			
			INNER JOIN lpa ON user_surveior.lpa_id = lpa.id
			INNER JOIN dbfaskes.propinsi ON user_surveior.provinsi_id = dbfaskes.propinsi.id_prop
			INNER JOIN dbfaskes.kota ON user_surveior.kabkota_id = dbfaskes.kota.id_kota
			WHERE user_surveior.lpa_id = " . $lpa_id . "
		
		GROUP BY user_surveior.id, dbfaskes.kota.id_kota, user_surveior.nama,
-- 				
				user_surveior.nik,
				user_surveior.email,
				user_surveior.no_hp,
				user_surveior.keaktifan,
				lpa.nama,
				dbfaskes.propinsi.nama_prop,
				dbfaskes.kota.nama_kota,
			derivedTable1.user_surveior_id
		ORDER BY jumlah_penugasan ASC");

		return $sql;
	}

	// function get_data_surveior_backup($lpa_id)
	// {
	// 	$raw_user_id = "";
	// 	//$lpa_id="1";
	// 	$sql = $this->db->query("Select 
	// 	a.* ,
	// 	b.nama_prop,
	// 	b.id_prop,
	// 	c.kab_kota_new,
	// 	c.prop_id,
	// 	d.nama AS nama_lpa


	// 	FROM user_surveior a
	// 	JOIN dbfaskes.propinsi b ON a.provinsi_id = b.id_prop
	// 	JOIN dbfaskes.kab_kota_new c ON a.kabkota_id = c.link_pusdatin
	// 	JOIN lpa d ON a.lpa_id = d.id

	// 	WHERE b.id_prop = c.prop_id  " . $raw_user_id . " AND a.lpa_id=" . $lpa_id . "

	// 	ORDER BY
	// 	a.nama DESC");
	// 	// if($lpa_id == ""){
	// 	// 	redirect('login');
	// 	// }else{
	// 	return $sql;
	// 	//}

	// }

	function get_data_verifikator($lpa_id)
	{
		$sql = $this->db->query("Select 
		a.*,
		b.lpa_id
		
		FROM user_verifikator a 
		JOIN users b ON a.users_id = b.id
		WHERE lpa_id=" . $lpa_id . " ");
		return $sql;
	}

	function get_data_bidang()
	{
		$sql = $this->db->query("SELECT
		
		a.*,
		b.nama,
		b.id as id_bidang
		
		FROM bidang a
		JOIN jenis_fasyankes b ON a.fasyankes_id = b.id
		WHERE a.aktif = 1
		ORDER BY
		a.fasyankes_id DESC");
		return $sql;
	}

	function get_data_bidang_new()
	{
		$sql = $this->db->query("
		SELECT
			a.id,
			a.bidang,
			a.fasyankes_id,
			b.nama,
			b.id as fasyankes_id 
		FROM 
			bidang a
		JOIN 
			jenis_fasyankes b ON a.fasyankes_id = b.id
		WHERE 
			a.aktif = 1
		ORDER BY
			a.fasyankes_id DESC
		");
		return $sql;
	}
	function get_data_fasyankes()
	{
		$sql = $this->db->query("SELECT
		
		*
		FROM jenis_fasyankes 
		where aktif=1;
		");
		return $sql;
	}

	function get_data_pengajuan($user_id)
	{
		$raw_user_id = "";

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
		trans_final.id_faskes AS id_faskes,
		data_klinik.nama_klinik AS nama_klinik,
		data_klinik.id_prov as provinsi_id, 
		-- data_utd.nama_utd AS nama_utd,
		-- data_utd.id_prov as provinsi_id, 
		propinsi.id_prop as id_prop, 
		propinsi.nama_prop as nama_prop, 
		data_klinik.id_kota as kabkota_id,
		-- data_utd.id_kota as kabkota_id,
		kota.id_kota as id_kota, 
		kota.nama_kota AS nama_kota
		
		
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
		JOIN dbfaskes.data_utd ON dbfaskes.trans_final.id_faskes = dbfaskes.data_utd.id_faskes
		--    INNER JOIN dbfaskes.propinsi ON dbfaskes.data_utd.id_prov = dbfaskes.propinsi.id_prop
		--    INNER   JOIN dbfaskes.kota ON dbfaskes.data_utd.id_kota = dbfaskes.kota.id_kota
		LEFT JOIN status_usulan h ON b.status_usulan_id = h.id 
	WHERE 1=1 " . $raw_user_id . "
	ORDER BY
		a.created_at DESC");
		//echo $this->db->last_query();
		return $sql;

		// $db = $this->load->database("faskes", TRUE);
		// $DB = $this->load->database("default", TRUE);
		// $DB->select('pengajuan_usulan_survei.*','pengajuan_usulan_survei.fasyankes_id as fasyankes_id, penerimaan_pengajuan_usulan_survei.status_usulan_id as status_usulan_id,
		// penerimaan_pengajuan_usulan_survei.keterangan as keterangan, status_usulan.nama as status_usulan, jenis_fasyankes.nama as jenis_fasyankes_nama,
		// jenis_survei.nama as jenis_survei, jenis_akreditasi.nama as jenis_akreditasi, status_akreditasi.nama as status_akreditasi, lpa.nama as lpa,
		// trans_final.kode_faskes as kode_faskes, trans_final.id_faskes as id_faskes, data_klinik.id_faskes
		// 			, data_klinik.id_prov as provinsi_id, propinsi.id_prop as id_prop, propinsi.nama_prop as nama_prop, data_klinik.id_kota as kabkota_id,
		// 			kota.id_kota as id_kota, kota.nama_kota');
		// $DB->from('pengajuan_usulan_survei');
		// $DB->join('penerimaan_pengajuan_usulan_survei', 'pengajuan_usulan_survei.id = penerimaan_pengajuan_usulan_survei.pengajuan_usulan_survei_id' ); 
		// $DB->join('jenis_fasyankes', 'pengajuan_usulan_survei.jenis_fasyankes = jenis_fasyankes.id');
		// $DB->join('jenis_survei', 'pengajuan_usulan_survei.jenis_survei_id = jenis_survei.id');
		// $DB->join('jenis_akreditasi', 'pengajuan_usulan_survei.jenis_akreditasi_id = jenis_akreditasi.id');
		// $DB->join('status_akreditasi', 'pengajuan_usulan_survei.status_akreditasi_id = status_akreditasi.id');
		// $DB->join('lpa', 'pengajuan_usulan_survei.lpa_id = lpa.id');
		// $DB->join('status_usulan', 'penerimaan_pengajuan_usulan_survei.status_usulan_id = status_usulan.id');
		// $DB->join($db->database.'.trans_final','pengajuan_usulan_survei.fasyankes_id = trans_final.kode_faskes');
		// $DB->join($db->database.'.data_klinik','trans_final.id_faskes = data_klinik.id_faskes');
		// $DB->join($db->database.'.propinsi','data_klinik.id_prov = propinsi.id_prop');
		// $DB->join($db->database.'.kota','data_klinik.id_kota = kota.id_kota');
		// // $DB->where( '.$raw_user_id.');
		// //$DB->orderby('pengajuan_usulan_survei.created_at DESC');
		// $res = $DB->get();
		// return $res;

	}

	function get_data_pengajuan_surveior($user_id)
	{
		$raw_user_id = "AND b.status_usulan_id=3";

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
			k.status_surveior_dua
	FROM
		pengajuan_usulan_survei a
			JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
			JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
			JOIN jenis_survei d ON a.jenis_survei_id = d.id
			JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
			JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
			JOIN lpa g ON a.lpa_id = g.id
			JOIN status_usulan h ON b.status_usulan_id = h.id 
			JOIN berkas_usulan_survei i on i.penerimaan_pengajuan_usulan_survei_id = b.id
			JOIN kelengkapan_berkas j on j.berkas_usulan_survei_id = i.id
			JOIN penetapan_tanggal_survei k on k.kelengkapan_berkas_id = j.id	 
	WHERE 1=1 " . $raw_user_id . "
	ORDER BY
		k.created_at DESC");
		return $sql;
	}

	function get_data_fasyankes_admin($session_users_id)
	{
		$raw_user_id = "";
		$sql = $this->db->query("Select 
			a.fasyankes_id,
			b.nama AS nama_fasyankes
		FROM 
			user_admin_lpa a
		JOIN 
			jenis_fasyankes b ON a.fasyankes_id = b.id
		WHERE users_id=" . $session_users_id . "");
		return $sql;
	}
	function select_penilaian_surveior($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes, $user_id, $status_verifikasi_id, $users_surveior_id)
	{
		if (!empty($lpa_id)) {
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

		if (!empty($user_id)) {
			// $user_id = " AND (k.surveior_satu='" . $user_id . "' OR k.surveior_dua='" . $user_id . "' OR sl.id_surveior_satu_baru='" . $users_surveior_id . "' OR sl.id_surveior_dua_baru='" . $users_surveior_id . "')";
			$user_id = " AND (sl.id_surveior_satu_baru='" . $users_surveior_id . "' OR sl.id_surveior_dua_baru='" . $users_surveior_id . "')";
		} else {
			// $user_id = " AND (k.surveior_satu='" . $user_id . "' OR k.surveior_dua='" . $user_id . "' OR sl.id_surveior_satu_baru='" . $users_surveior_id . "' OR sl.id_surveior_dua_baru='" . $users_surveior_id . "')";
			$user_id = " AND (sl.id_surveior_satu_baru='" . $users_surveior_id . "' OR sl.id_surveior_dua_baru='" . $users_surveior_id . "')";
		}

		if (!empty($status_verifikasi_id)) {
			if ($status_verifikasi_id == 1) {
				$status_verifikasi_id = " AND m.id IS NULL";
			} else {
				$status_verifikasi_id = "  AND m.id IS NOT NULL";
			}
		} else {
			$status_verifikasi_id = " AND m.id IS NULL";
		}

		// $raw_user_id=" and a.jenis_fasyankes='".$jenis_fasyankes."' and dbfaskes.propinsi.id_prop='".$propinsi."' and dbfaskes.kota.id_kota='".$kota."' ";
		//    $raw_user_id= $propinsi.$kota.$jenis_fasyankes;
		$raw_user_id = $jenis_fasyankes2 . $lpa_id . $tanggal_awal . $propinsi2 . $kota . $user_id . $status_verifikasi_id;

		if ($jenis_fasyankes == 1 || $jenis_fasyankes == null) {
			$data_select = "trans_final.kode_faskes AS kode_faskes,
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

			$data_join = "LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
			LEFT OUTER JOIN dbfaskes.data_pm ON dbfaskes.trans_final.id_faskes = dbfaskes.data_pm.id_faskes
			LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_pm.id_prov_pm = dbfaskes.propinsi.id_prop
			LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_pm.id_kota_pm = dbfaskes.kota.id_kota";
		} else if ($jenis_fasyankes == 2) {
			// $data_select = "daftar_puskesmas.nama AS nama_fasyankes,
			// daftar_puskesmas.PROV_DAGRI AS provinsi_id,
			// daftar_puskesmas.PROVINSI AS nama_prop,
			// daftar_puskesmas.kode_kabupaten AS kabkota_id,
			// daftar_puskesmas.KABKOTA AS nama_kota,";
			// $data_join = "LEFT OUTER JOIN dbfaskes.daftar_puskesmas ON a.fasyankes_id = daftar_puskesmas.kode_satker";

			$data_select = "puskesmas_pusdatin.name AS nama_fasyankes,
			puskesmas_pusdatin.provinsi_code AS provinsi_id,
			puskesmas_pusdatin.provinsi_nama AS nama_prop,
			puskesmas_pusdatin.kabkot_code AS kabkota_id,
			puskesmas_pusdatin.kabkot_nama AS nama_kota,";
			$data_join = "LEFT OUTER JOIN dbfaskes.puskesmas_pusdatin ON a.fasyankes_id = puskesmas_pusdatin.kode_sarana";
		} else if ($jenis_fasyankes == 3) {
			$data_select = "trans_final.kode_faskes AS kode_faskes, 
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
			$data_join = "LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
			LEFT OUTER JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
			LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_klinik.id_prov = dbfaskes.propinsi.id_prop
			LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_klinik.id_kota = dbfaskes.kota.id_kota";
		} else if ($jenis_fasyankes == 6) {
			$data_select = "trans_final.kode_faskes AS kode_faskes,
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
			$data_join = "LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
			LEFT OUTER JOIN dbfaskes.data_utd ON dbfaskes.trans_final.id_faskes = dbfaskes.data_utd.id_faskes
			LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_utd.id_prov = dbfaskes.propinsi.id_prop
			LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_utd.id_kota = dbfaskes.kota.id_kota";
		} else if ($jenis_fasyankes == 7) {
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
			$data_join = "LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
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
				" . $data_select . "
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
					m.url_bukti_tiga
			FROM
				pengajuan_usulan_survei a
				LEFT OUTER JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
				LEFT OUTER JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
				LEFT OUTER JOIN jenis_survei d ON a.jenis_survei_id = d.id
				LEFT OUTER JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
				LEFT OUTER JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
				LEFT OUTER JOIN lpa g ON a.lpa_id = g.id
				" . $data_join . "
				LEFT OUTER JOIN status_usulan h ON b.status_usulan_id = h.id 
				LEFT OUTER JOIN berkas_usulan_survei i on i.penerimaan_pengajuan_usulan_survei_id = b.id
				LEFT OUTER JOIN kelengkapan_berkas j on j.berkas_usulan_survei_id = i.id
				INNER JOIN penetapan_tanggal_survei k on k.kelengkapan_berkas_id = j.id
				LEFT OUTER JOIN trans_final_ep_surveior l on l.penetapan_tanggal_survei_id = k.id
				LEFT OUTER JOIN pengiriman_laporan_survei m on m.penetapan_tanggal_survei_id = k.id
				LEFT OUTER JOIN surveior_lapangan sl ON sl.penetapan_tanggal_survei_id = k.id 
			WHERE 1=1 " . $raw_user_id . " 
			ORDER BY
			a.created_at DESC");

		return $sql->result_array();
		// return $data_select.$data_join.$raw_user_id;
	}

	function select_penilaian_verifikator($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes, $user_id, $status_verifikasi_id)
	{
		if (!empty($lpa_id)) {
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

		if (!empty($user_id)) {
			$user_id = " AND n.users_id='" . $user_id . "' ";
		} else {
			$user_id = " AND n.users_id='" . $user_id . "' ";
		}

		if (!empty($status_verifikasi_id)) {
			if ($status_verifikasi_id == 1) {
				$status_verifikasi_id = " AND o.id IS NULL";
			} else {
				$status_verifikasi_id = "  AND o.id IS NOT NULL";
			}
		} else {
			$status_verifikasi_id = " AND o.id IS NULL";
		}

		// $raw_user_id=" and a.jenis_fasyankes='".$jenis_fasyankes."' and dbfaskes.propinsi.id_prop='".$propinsi."' and dbfaskes.kota.id_kota='".$kota."' ";
		//    $raw_user_id= $propinsi.$kota.$jenis_fasyankes;
		$raw_user_id = $jenis_fasyankes2 . $lpa_id . $tanggal_awal . $propinsi2 . $kota . $user_id . $status_verifikasi_id;

		if ($jenis_fasyankes == 1 || $jenis_fasyankes == null) {
			$data_select = "trans_final.kode_faskes AS kode_faskes,
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

			$data_join = "LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
			LEFT OUTER JOIN dbfaskes.data_pm ON dbfaskes.trans_final.id_faskes = dbfaskes.data_pm.id_faskes
			LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_pm.id_prov_pm = dbfaskes.propinsi.id_prop
			LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_pm.id_kota_pm = dbfaskes.kota.id_kota";
		} else if ($jenis_fasyankes == 2) {
			// $data_select = "daftar_puskesmas.nama AS nama_fasyankes,
			// daftar_puskesmas.PROV_DAGRI AS provinsi_id,
			// daftar_puskesmas.PROVINSI AS nama_prop,
			// daftar_puskesmas.kode_kabupaten AS kabkota_id,
			// daftar_puskesmas.KABKOTA AS nama_kota,";
			// $data_join = "LEFT OUTER JOIN dbfaskes.daftar_puskesmas ON a.fasyankes_id = daftar_puskesmas.kode_satker";

			$data_select = "puskesmas_pusdatin.name AS nama_fasyankes,
			puskesmas_pusdatin.provinsi_code AS provinsi_id,
			puskesmas_pusdatin.provinsi_nama AS nama_prop,
			puskesmas_pusdatin.kabkot_code AS kabkota_id,
			puskesmas_pusdatin.kabkot_nama AS nama_kota,";
			$data_join = "LEFT OUTER JOIN dbfaskes.puskesmas_pusdatin ON a.fasyankes_id = puskesmas_pusdatin.kode_sarana";
		} else if ($jenis_fasyankes == 3) {
			$data_select = "trans_final.kode_faskes AS kode_faskes, 
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
			$data_join = "LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
			LEFT OUTER JOIN dbfaskes.data_klinik ON dbfaskes.trans_final.id_faskes = dbfaskes.data_klinik.id_faskes
			LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_klinik.id_prov = dbfaskes.propinsi.id_prop
			LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_klinik.id_kota = dbfaskes.kota.id_kota";
		} else if ($jenis_fasyankes == 6) {
			$data_select = "trans_final.kode_faskes AS kode_faskes,
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
			$data_join = "LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
			LEFT OUTER JOIN dbfaskes.data_utd ON dbfaskes.trans_final.id_faskes = dbfaskes.data_utd.id_faskes
			LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_utd.id_prov = dbfaskes.propinsi.id_prop
			LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_utd.id_kota = dbfaskes.kota.id_kota";
		} else if ($jenis_fasyankes == 7) {
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
			$data_join = "LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
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
				" . $data_select . "
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
					m.created_at AS tanggal_kirim_laporan,
					n.id AS penetapan_verifikator_id,
					n.users_id AS users_verifikator,
					o.id AS trans_final_ep_verifikator_id,
					o.final AS status_final_ep_verifikator
			FROM
				pengajuan_usulan_survei a
				LEFT OUTER JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
				LEFT OUTER JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
				LEFT OUTER JOIN jenis_survei d ON a.jenis_survei_id = d.id
				LEFT OUTER JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
				LEFT OUTER JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
				LEFT OUTER JOIN lpa g ON a.lpa_id = g.id
				" . $data_join . "
				LEFT OUTER JOIN status_usulan h ON b.status_usulan_id = h.id 
				LEFT OUTER JOIN berkas_usulan_survei i on i.penerimaan_pengajuan_usulan_survei_id = b.id
				LEFT OUTER JOIN kelengkapan_berkas j on j.berkas_usulan_survei_id = i.id
				LEFT OUTER JOIN penetapan_tanggal_survei k on k.kelengkapan_berkas_id = j.id
				INNER JOIN trans_final_ep_surveior l on l.penetapan_tanggal_survei_id = k.id
				INNER JOIN pengiriman_laporan_survei m on m.penetapan_tanggal_survei_id = k.id
				LEFT OUTER JOIN penetapan_verifikator n on n.pengiriman_laporan_survei_id = m.id
				LEFT OUTER JOIN trans_final_ep_verifikator o on o.penetapan_verifikator_id = n.id
			WHERE 1=1 " . $raw_user_id . " 
			ORDER BY
			a.created_at DESC");


		return $sql->result_array();
	}
}
