<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Model_sina extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function select_data($table, $where)
	{
		$this->db->get_where($table, $where);
		// $this->db->last_query();
		return $this->db->get_where($table, $where);
	}

	function get_detail_pengajuan($idpengajuan, $idsurveior)
	{
		$query = "
		SELECT 
			pus.jenis_fasyankes,js.jadwal_kesiapan, us.nama, us.lpa_id, us.provinsi_id, b.bidang , b.fasyankes_id, b.id as bidang_id  
		FROM 
			pengajuan_usulan_survei pus 
		LEFT JOIN
			pengajuan_usulan_survei_detail pusd 
		ON 
			pusd.pengajuan_usulan_survei_id = pus.id 
		LEFT JOIN
			jadwal_surveior js 
		ON
			js.pengajuan_usulan_survei_id = pus.id 
		LEFT JOIN 
			user_surveior us 
		ON
			us.id = js.user_surveior_id 
		LEFT JOIN 
			user_surveior_bidang_detail usbd 
		ON 
			usbd.id_user_surveior = us.id 
		LEFT JOIN 
			bidang b 
		ON 
			b.id = usbd.id_bidang 
		WHERE 
			pus.id = '$idpengajuan'
			AND us.id = '$idsurveior'
			AND usbd.is_checked = '1' 
			AND b.fasyankes_id = pus.jenis_fasyankes 
		";
		return $this->db->query($query)->result_array();
	}
	// {
	// 	$query = "
	// 	SELECT 
	// 		pus.jenis_fasyankes,js.jadwal_kesiapan, us.nama, us.lpa_id, us.provinsi_id, b.bidang , b.fasyankes_id, b.id as bidang_id  
	// 	FROM 
	// 		pengajuan_usulan_survei pus 
	// 	LEFT JOIN
	// 		pengajuan_usulan_survei_detail pusd 
	// 	ON 
	// 		pusd.pengajuan_usulan_survei_id = pus.id 
	// 	LEFT JOIN
	// 		jadwal_surveior js 
	// 	ON
	// 		js.pengajuan_usulan_survei_id = pus.id 
	// 	LEFT JOIN 
	// 		user_surveior us 
	// 	ON
	// 		us.id = js.user_surveior_id 
	// 	LEFT JOIN 
	// 		user_surveior_bidang_detail usbd 
	// 	ON 
	// 		usbd.id_user_surveior = us.id 
	// 	LEFT JOIN 
	// 		bidang b 
	// 	ON 
	// 		b.id = usbd.id_bidang 
	// 	WHERE 
	// 		pus.id = '$idpengajuan'
	// 		AND us.users_id = '$idsurveior'
	// 		AND usbd.is_checked = '1' 
	// 		AND b.fasyankes_id = pus.jenis_fasyankes 
	// 	";
	// 	return $this->db->query($query)->result_array();
	// }

	function select_surveior_pengganti($where)
	{
		// $query = "SELECT derivedTable1.*
		// FROM
		// 	(
		// 		SELECT 
		// 			us.id as userSurveiorId,
		// 			us.nama as surveior_nama,
		// 			p.nama_prop as propinsi_name,
		// 			COUNT(js.id) as jumlahHariKesiapan
		// 		FROM 
		// 			jadwal_surveior js 
		// 		LEFT JOIN user_surveior us ON us.id = js.user_surveior_id 
		// 		LEFT JOIN lpa l ON l.id = us.lpa_id 
		// 		LEFT JOIN user_surveior_bidang_detail usbd ON usbd.id_user_surveior = us.id 
		// 		LEFT JOIN bidang b ON b.id = usbd.id_bidang
		// 		LEFT JOIN dbfaskes.propinsi p ON  p.id_prop = us.provinsi_id 
		// 		WHERE 
		// 			" . $where['kondisi'] . "
		// 				AND
		// 			" . $where['kondisi_tanggal'] . "
		// 		AND 
		// 			js.status = 0
		// 		AND 
		// 			usbd.is_checked = 1
		// 		GROUP BY 
		// 		us.id, us.nama , p.nama_prop
		// 		) derivedTable1
		// 	WHERE derivedTable1.jumlahHariKesiapan = " . $where['tanggal'] . "
		// ";
		$query = "SELECT 
		derivedTable2.*,
		derivedTable4.jumlah_penugasan
	FROM
	(SELECT derivedTable1.*
		FROM
			(
					SELECT 
						us.id as userSurveiorId,
						us.nama as surveior_nama,
						p.nama_prop as propinsi_name,
						COUNT(js.id) as jumlahHariKesiapan
					FROM 
						jadwal_surveior js 
					LEFT JOIN user_surveior us ON us.id = js.user_surveior_id 
					LEFT JOIN lpa l ON l.id = us.lpa_id 
					LEFT JOIN user_surveior_bidang_detail usbd ON usbd.id_user_surveior = us.id 
					LEFT JOIN bidang b ON b.id = usbd.id_bidang
					LEFT JOIN dbfaskes.propinsi p ON  p.id_prop = us.provinsi_id 
					WHERE 
					" . $where['kondisi'] . "
					AND
					" . $where['kondisi_tanggal'] . "
					" . $where['domisili'] . "
					AND 
						( js.status = 0 OR js.status = 7)
					AND 
						usbd.is_checked = 1
					GROUP BY 
					us.id, us.nama , p.nama_prop
					) derivedTable1
				WHERE derivedTable1.jumlahHariKesiapan = " . $where['tanggal'] . ") derivedTable2
				LEFT OUTER JOIN
				(SELECT 
					derivedTable3.user_surveior_id,
					SUM(derivedTable3.jumlah_penugasan) as jumlah_penugasan
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
					id_surveior_dua_baru) derivedTable3
				GROUP BY derivedTable3.user_surveior_id) derivedTable4
				ON derivedTable4.user_surveior_id = derivedTable2.userSurveiorId
					";

		// return $query;
		return $this->db->query($query)->result_array();

		// return $query;
		// return $this->db->query($query)->result_array();
	}


	function select_surveior_pengganti_ukomm($where)
	{

		$query = "SELECT 
			derivedTable2.*,
			derivedTable4.jumlah_penugasan
			FROM
			(
				SELECT derivedTable1.*
					FROM
						(
							SELECT 
								us.id as userSurveiorId,
								us.nama as surveior_nama,
								p.nama_prop as propinsi_name,
								COUNT(js.id) as jumlahHariKesiapan
							FROM 
								jadwal_surveior js 
							LEFT JOIN user_surveior us ON us.id = js.user_surveior_id 
							LEFT JOIN lpa l ON l.id = us.lpa_id 
							LEFT JOIN user_surveior_bidang_detail usbd ON usbd.id_user_surveior = us.id 
							LEFT JOIN bidang b ON b.id = usbd.id_bidang
							LEFT JOIN dbfaskes.propinsi p ON  p.id_prop = us.provinsi_id 
							WHERE 
							" . $where['kondisi'] . "
							AND
							" . $where['kondisi_tanggal'] . "
							" . $where['domisili'] . "
							AND 
								( js.status = 0 OR js.status = 7)
							AND 
								usbd.is_checked = 1
							AND 
								usbd.status_ukom = 1
							AND 
								usbd.tgl_berlaku_sertifikat >= CURDATE()
							GROUP BY 
							us.id, us.nama , p.nama_prop
						) derivedTable1
					WHERE derivedTable1.jumlahHariKesiapan = " . $where['tanggal'] . "
			) derivedTable2
			LEFT OUTER JOIN
						(SELECT 
							derivedTable3.user_surveior_id,
							SUM(derivedTable3.jumlah_penugasan) as jumlah_penugasan
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
							id_surveior_dua_baru) derivedTable3
						GROUP BY derivedTable3.user_surveior_id) derivedTable4
						ON derivedTable4.user_surveior_id = derivedTable2.userSurveiorId
			";
		return $this->db->query($query)->result_array();

		// return $query;
	}

	function getdataketeranganpengganti()
	{
		$query = "SELECT
		*
		FROM 
			status_kesiapan_surveior
		WHERE 
			flag = '1'
		ORDER BY 
			urutan ASC
		";
		return $this->db->query($query)->result_array();
	}

	function checktablelapangan($id)
	{
		$query = "
			SELECT 
				*
			FROM 
				surveior_lapangan
			WHERE
				penetapan_tanggal_survei_id = " . $id . "
		";
		$sql = $this->db->query($query);
		return $sql->result_array();
	}

	function getdatalapangan($id)
	{
		$where = array(
			'penetapan_tanggal_survei_id' => $id
		);
		$query = $this->db->get_where('surveior_lapangan', $where);
		return $query->result_array();
	}

	function getsurveiorlapangan($idpenetapantanggalsurvei)
	{
		$query = "SELECT 
		sl.id as surveior_lapangan_id,
		us.users_id as surveior_satu_user_id,
		us.id as surveior_satu_id,
		us.nama as surveior_satu_lama,
		us2.id as surveior_satu_baru_id,
		us2.users_id as surveior_satu_baru_user_id,
		us2.nama as surveior_satu_baru,
		sl.jabatan_surveior_id_satu as jabatan_surveior_id_satu,
		sl.keterangan_surveior_satu_id as keterangan_surveior_satu_id,
		sl.keterangan_surveior_satu as Keterangan_surveior_satu,
		us3.users_id as surveior_dua_user_id,
		us3.id as surveior_dua_id,
		us3.nama as surveior_dua_lama,
		us4.users_id as surveior_dua_baru_user_id,
		us4.id as surveior_dua_baru_id,
		us4.nama as surveior_dua_baru,
		sl.jabatan_surveior_id_dua as jabatan_surveior_id_dua,
		sl.keterangan_surveior_dua_id as keterangan_surveior_dua_id,
		sl.keterangan_surveior_dua as keterangan_surveior_dua,
		sl.no_surattugas,
		sl.status_tte
		FROM surveior_lapangan sl 
		LEFT JOIN user_surveior us ON us.id = sl.id_surveior_satu_lama
		LEFT JOIN user_surveior us2 ON us2.id = sl.id_surveior_satu_baru 
		LEFT JOIN user_surveior us3 ON us3.id = sl.id_surveior_dua_lama
		LEFT JOIN user_surveior us4 ON us4.id = sl.id_surveior_dua_baru 
		WHERE sl.penetapan_tanggal_survei_id = '" . $idpenetapantanggalsurvei . "'";
		return $this->db->query($query)->result_array();
	}

	function getdetailsuveior($id)
	{
		$query = "
		SELECT 
			us.id,us.nama, p.nama_prop propinsi_name 
		FROM 
			user_surveior us 
		LEFT JOIN
			dbfaskes.propinsi p 
		ON 
			p.id_prop = us.provinsi_id  
		WHERE 
			us.id = $id
		";

		return $this->db->query($query)->result_array();
	}

	function select_jadwal_suveior()
	{
		$sina = $this->load->database('sina', TRUE);
		$sql = $sina->query("
		SELECT 
			js.jadwal_kesiapan,
			b.bidang,
			COUNT(*) as Total 
			FROM jadwal_surveior js 
			LEFT JOIN user_surveior us ON js.user_surveior_id = us.id 
			LEFT JOIN bidang b ON us.bidang_id = b.id 
			WHERE js.status = 0
			GROUP BY b.bidang , js.jadwal_kesiapan 
		");
		return $sql->result_array();
	}

	function select_data_jadwal($table, $where)
	{
		// return $this->db->order_by("jadwal_kesiapan", "ASC")->get_where($table, $where);
		return $this->db->select('*, jadwal_surveior.id id_jadwal,  status_kesiapan_surveior.nama, status_kesiapan_surveior.badge_color')->join('status_kesiapan_surveior', 'status_kesiapan_surveior.id = jadwal_surveior.status')->order_by("jadwal_kesiapan", "ASC")->get_where($table, $where);
	}

	function select_jadwal_surveior($user_id, $tanggal_awal, $tanggal_akhir)
	{
		if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
			$tanggal_awal = " AND a.jadwal_kesiapan BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "' ";
		} else {
			$tanggal_awal = "";
		}

		if (!empty($user_id)) {
			$user_id = " AND c.id = '" . $user_id . "' ";
		} else {
			$user_id = "AND c.id =0";
		}

		$where_status = "AND a.status NOT IN (1)";

		$raw_user_id = $tanggal_awal . $user_id;

		$sql = $this->db->query("SELECT
		a.* 
	FROM
		jadwal_surveior a 
		JOIN user_surveior b ON b.id = a.user_surveior_id
		JOIN users c ON c.id = b.users_id WHERE 1=1 " . $raw_user_id . " ");

		return $sql->result_array();
	}

	function getsurveior($title)
	{
		$id = $this->session->userdata('lpa_id');
		$this->db->like('lpa_id', $id);
		$this->db->like('nama', $title, 'both');
		$this->db->order_by('nama', 'ASC');
		$this->db->limit(10);
		return $this->db->get('user_surveior')->result();
		// echo $this->db->last_query();
	}


	function select_surveior_kesepakatan($id)
	{

		if (!empty($id)) {
			$id = " AND a.pengajuan_usulan_survei_id = '" . $id . "' ";
		} else {
			$id = "AND a.pengajuan_usulan_survei_id =0";
		}

		$raw_user_id = $id;

		$sql = $this->db->query("SELECT
		-- a.* , c.id users_id
		a.user_surveior_id  , c.id users_id
	FROM
		jadwal_surveior a 
		JOIN user_surveior b ON b.id = a.user_surveior_id
		JOIN users c ON c.id = b.users_id WHERE 1=1 " . $raw_user_id . " 
		GROUP BY a.user_surveior_id ");

		return $sql->result_array();
		// return $raw_user_id;
	}


	function input_data($table, $data)
	{
		// return $this->db->insert($table, $data);
		$this->db->insert($table, $data);
		return $this->db->error();
	}

	function input_data_lastid($table, $data)
	{
		$this->db->insert($table, $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	function input_date($table, $data)
	{
		// return $this->db->insert($table, $data);
		try {
			$this->db->trans_start(FALSE);
			$this->db->insert($table, $data);
			$this->db->trans_complete();
			$db_error = $this->db->error();
			if (!empty($db_error)) {
				throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
				return false; // unreachable retrun statement !!!
			}
			return TRUE;
		} catch (Exception $e) {
			// return $e;
		}
	}

	function edit_data($table, $where, $data)
	{
		$this->db->where($where);
		// return $this->db->update($table, $data);
		$this->db->update($table, $data);
		return $this->db->error();
	}

	function delete_data($table, $where)
	{
		$this->db->delete($table, $where);
	}

	function select_count($table, $user_id)
	{

		$raw_user_id = " and id_faskes='" . $user_id . "' ";

		$sql = $this->db->query("SELECT COUNT(*) as jml FROM " . $table . "  WHERE 1=1 " . $raw_user_id . " ");


		return $sql->result_array();
	}

	function select_surveior($user_id)
	{
		//$user_id=3;
		$raw_user_id = " and a.id='" . $user_id . "' ";

		$sql = $this->db->query("SELECT
		a.*,
		b.id,
		c.nama AS nama_lpa,
		propinsi.nama_prop AS nama_prop,
		kota.`nama_kota` AS nama_kota
		FROM
		user_surveior a 
		LEFT JOIN users b ON a.users_id = b.id
		LEFT JOIN lpa c ON a.lpa_id = c.id
		LEFT JOIN dbfaskes.propinsi ON a.provinsi_id = dbfaskes.`propinsi`.`id_prop`
		LEFT JOIN dbfaskes.`kota` ON a.`kabkota_id` = dbfaskes.`kota`.`id_kota`
		WHERE 1=1 " . $raw_user_id . "");


		return $sql->result_array();
	}
	function select_surveior_detail($user_id)
	{
		//$user_id=3;
		$raw_user_id = " and id_user_surveior='" . $user_id . "' ";

		$sql = $this->db->query("SELECT
		*
		FROM
		user_surveior_bidang_detail WHERE 1=1 " . $raw_user_id . "");


		return $sql->result_array();
	}
	function select_verifikator($user_id)
	{
		//$user_id=3;
		$raw_user_id = " and user_verifikator.id='" . $user_id . "' ";

		$sql = $this->db->query("SELECT
		*
		FROM
		user_verifikator WHERE 1=1 " . $raw_user_id . "");


		return $sql->result_array();
	}
	function select_ep($bab, $fanyankes_id)
	{
		//$user_id=3;
		// if(is_null($bab) == 1){
		// 	$raw_user_id=" and bab='".$bab."' and jenis_fasyankes_id='".$fanyankes_id."' ";
		// }
		$raw_user_id = " and bab='" . $bab . "' and jenis_fasyankes_id='" . $fanyankes_id . "' ";

		$sql = $this->db->query("SELECT
		*
		FROM
		elemen_penilaian WHERE 1=1 " . $raw_user_id . "");


		return $sql->result_array();
	}

	function select_bidang_surveior($users_id, $fanyankes_id)
	{
		//$user_id=3;
		// if(is_null($bab) == 1){
		// 	$raw_user_id=" and bab='".$bab."' and jenis_fasyankes_id='".$fanyankes_id."' ";
		// }
		$raw_user_id = " and users_id='" . $users_id . "' and id_fasyankes_surveior='" . $fanyankes_id . "' and is_checked=1 ";

		$sql = $this->db->query("SELECT
		*
		FROM
		user_surveior_bidang_detail WHERE 1=1 " . $raw_user_id . "");


		return $sql->result_array();
	}

	function select_ep_by_bidang($bab, $fanyankes_id, $id_bidang)
	{
		//$user_id=3;
		// if(is_null($bab) == 1){
		// 	$raw_user_id=" and bab='".$bab."' and jenis_fasyankes_id='".$fanyankes_id."' ";
		// }
		$raw_user_id = " and bab='" . $bab . "' and id_bidang='" . $id_bidang . "' and jenis_fasyankes_id='" . $fanyankes_id . "' ";

		$sql = $this->db->query("SELECT
		*
		FROM
		elemen_penilaian WHERE 1=1 " . $raw_user_id . "");


		return $sql->result_array();
	}

	function select_trans_ep($id)
	{
		//$user_id=3;
		// if(is_null($bab) == 1){
		// 	$raw_user_id=" and bab='".$bab."' and jenis_fasyankes_id='".$fanyankes_id."' ";
		// }
		$raw_user_id = " and a.penetapan_tanggal_survei_id='" . $id . "' ";

		$sql = $this->db->query("SELECT
		a.*,
		b.skor_capaian_verifikator,
		b.persentase_capaian_verifikator,
		b.keterangan 
		FROM
		trans_ep a
		LEFT JOIN trans_ep_verifikator b ON a.id = b.trans_ep_id   WHERE 1=1 " . $raw_user_id . "");


		return $sql->result_array();
	}

	function select_trans_ep_check($id, $bab)
	{
		//$user_id=3;
		// if(is_null($bab) == 1){
		// 	$raw_user_id=" and bab='".$bab."' and jenis_fasyankes_id='".$fanyankes_id."' ";
		// }
		$raw_user_id = " and a.penetapan_tanggal_survei_id='" . $id . "' and c.bab='" . $bab . "' ";

		$sql = $this->db->query("SELECT
		a.*,
		b.skor_capaian_verifikator,
		b.persentase_capaian_verifikator,
		b.keterangan 
		FROM
		trans_ep a
		LEFT JOIN trans_ep_verifikator b ON a.id = b.trans_ep_id   
		JOIN elemen_penilaian c ON c.id = a.elemen_penilaian_id
		WHERE 1=1 " . $raw_user_id . "");


		return $sql->result_array();
	}

	function select_count_trans_ep($id, $jenis_fasyankes)
	{
		//$user_id=3;
		// if(is_null($bab) == 1){
		// 	$raw_user_id=" and bab='".$bab."' and jenis_fasyankes_id='".$fanyankes_id."' ";
		// }
		$raw_user_id = " and a.penetapan_tanggal_survei_id='" . $id . "' ";

		$sql = $this->db->query("SELECT
		b.bab,
		( SELECT be.nama_bab FROM bab_ep be WHERE be.jenis_fasyankes_id = " . $jenis_fasyankes . "  AND be.bab = b.bab ) AS nama_bab,

		(
			SELECT
				count( tp.id ) 
			FROM
				trans_ep tp
				JOIN elemen_penilaian ep ON tp.elemen_penilaian_id = ep.id 
			WHERE
				ep.jenis_fasyankes_id = " . $jenis_fasyankes . "
				AND ep.bab = b.bab 
				AND tp.penetapan_tanggal_survei_id = " . $id . "
		) AS ep_terisi,
		( SELECT count( ep.id ) FROM elemen_penilaian ep WHERE ep.jenis_fasyankes_id = " . $jenis_fasyankes . " AND ep.bab = b.bab ) AS total_ep,

		(
			SELECT
				count( tpv.id ) 
			FROM
				trans_ep_verifikator tpv
				JOIN elemen_penilaian ep ON tpv.elemen_penilaian_id = ep.id 
			WHERE
				ep.jenis_fasyankes_id = " . $jenis_fasyankes . "
				AND ep.bab = b.bab 
				AND tpv.penetapan_tanggal_survei_id = " . $id . "
			) AS ep_terisi_verifikator,

		SUM( CASE WHEN a.skor_capaian_surveior <> 'TDD' THEN a.skor_capaian_surveior END ) AS skor_capaian_surveior,
		SUM( CASE WHEN a.skor_capaian_surveior <> 'TDD' THEN b.skor_maksimal END ) AS skor_maksimal_surveior,
		SUM( CASE WHEN a.skor_capaian_surveior <> 'TDD' THEN a.persentase_capaian_surveior END ) AS count_sum_persentase_capaian_surveior,
		(
		SELECT
		count( CASE WHEN a.skor_capaian_surveior <> 'TDD' THEN a.persentase_capaian_surveior END )) AS count_persentase_capaian_surveior,
		SUM( CASE WHEN a.skor_capaian_surveior <> 'TDD' THEN a.persentase_capaian_surveior END ) / (
		SELECT
		count( CASE WHEN a.skor_capaian_surveior <> 'TDD' THEN a.persentase_capaian_surveior END )) AS persentase_capaian_surveior,
		SUM( CASE WHEN c.skor_capaian_verifikator <> 'TDD' THEN c.skor_capaian_verifikator END ) AS skor_capaian_verifikator,
		SUM( CASE WHEN c.skor_capaian_verifikator <> 'TDD' THEN b.skor_maksimal END ) AS skor_maksimal_verifikator,
		SUM( CASE WHEN c.skor_capaian_verifikator <> 'TDD' THEN c.persentase_capaian_verifikator END ) AS count_sum_persentase_capaian_verifikator,
		(
		SELECT
		count( CASE WHEN c.skor_capaian_verifikator <> 'TDD' THEN c.persentase_capaian_verifikator END )) AS count_persentase_capaian_verifikator,
		SUM( CASE WHEN c.skor_capaian_verifikator <> 'TDD' THEN c.persentase_capaian_verifikator END ) / (
		SELECT
		count( CASE WHEN c.skor_capaian_verifikator <> 'TDD' THEN c.persentase_capaian_verifikator END )) AS persentase_capaian_verifikator 
		FROM
		trans_ep a
		JOIN elemen_penilaian b ON a.elemen_penilaian_id = b.id
		LEFT JOIN trans_ep_verifikator c ON a.id = c.trans_ep_id
		#JOIN bab_ep d ON d.bab = b.bab 
		
		WHERE 1=1 " . $raw_user_id . " 
		GROUP BY
		b.bab
		
		#ORDER BY d.urutan
		");


		return $sql->result_array();
	}

	public function get_tanggal_rencana_survei($pengajuan_usulan_survei_id)
	{
		$this->db->from('pengajuan_usulan_survei_detail');
		$this->db->where('pengajuan_usulan_survei_id', $pengajuan_usulan_survei_id);
		return $this->db->get()->result();
	}

	function select_pengajuan_search($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes, $status_usulan_id)
	{
		if (!empty($lpa_id)) {
			$lpa_id = " AND a.lpa_id='" . $lpa_id . "'";
		} else {
			$lpa_id = "";
		}

		if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
			$tanggal_awal = " AND a.tanggal_pengajuan BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "' ";
		} else {
			$tanggal_awal = "";
		}

		if (!empty($propinsi) && $propinsi != 9999) {
			if ($jenis_fasyankes == 2) {
				// $propinsi2 = " AND daftar_puskesmas.PROV_DAGRI='" . (int)$propinsi . "'";
				$propinsi2 = " AND pp.provinsi_code = '" . (int)$propinsi . "'";
			} else {
				$propinsi2 = " AND propinsi.id_prop='" . (int)$propinsi . "'";
			}
		} else {
			$propinsi2 = "";
		}

		if (!empty($kota) && $kota != 9999) {
			if ($jenis_fasyankes == 2) {
				// $kota = " AND daftar_puskesmas.kode_kabupaten='" . (int)$kota . "'";
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

		if (!empty($status_usulan_id)) {
			if ($status_usulan_id == 1) {
				// $status_usulan_id = " AND b.status_usulan_id IS NULL";
				$status_usulan_id = " AND b.status_usulan_id = '1'";
			} else {
				$status_usulan_id = " AND b.status_usulan_id='" . $status_usulan_id . "'";
			}
		} else {
			$status_usulan_id = " AND b.status_usulan_id IS NULL";
		}

		// $raw_user_id=" and a.jenis_fasyankes='".$jenis_fasyankes."' and dbfaskes.propinsi.id_prop='".$propinsi."' and dbfaskes.kota.id_kota='".$kota."' ";
		//    $raw_user_id= $propinsi.$kota.$jenis_fasyankes;
		$raw_user_id = $jenis_fasyankes2 . $lpa_id . $tanggal_awal . $propinsi2 . $kota . $status_usulan_id;

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

			$data_select = "pp.name as nama_fasyankes,
			pp.kode_baru as fasyankes_id,
			pp.provinsi_nama as nama_prop,
			pp.kabkot_nama as nama_kota,
			pp.provinsi_code as provinsi_id,
			pp.kabkot_code as kabkota_id,";

			// $data_join = "LEFT OUTER JOIN dbfaskes.daftar_puskesmas ON a.fasyankes_id = daftar_puskesmas.kode_satker";
			$data_join = "LEFT JOIN dbfaskes.puskesmas_pusdatin pp ON pp.kode_sarana = a.fasyankes_id ";
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
					i.url_ijazah_kepala_puskesmas,
					i.url_sertifikat_pelatihan_puskesmas,
					i.url_sp_ikp_klinik,
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
				LEFT OUTER JOIN penetapan_tanggal_survei k on k.kelengkapan_berkas_id = j.id
				LEFT OUTER JOIN trans_final_ep_surveior l on l.penetapan_tanggal_survei_id = k.id
				LEFT OUTER JOIN pengiriman_laporan_survei m on m.penetapan_tanggal_survei_id = k.id
				LEFT OUTER JOIN penetapan_verifikator n on n.pengiriman_laporan_survei_id = m.id
				LEFT OUTER JOIN trans_final_ep_verifikator o on o.penetapan_verifikator_id = n.id
                LEFT OUTER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
				LEFT OUTER JOIN penerbitan_sertifikat q ON q.pengiriman_rekomendasi_id = p.id

			WHERE 1=1 " . $raw_user_id . " 
			ORDER BY
			a.created_at DESC");


		return $sql->result_array();
	}

	function pengajuan_search_new($lpa_id, $tanggal_awal, $tanggal_akhir, $propinsi, $kota, $jenis_fasyankes, $status_usulan_id)
	{
		if (!empty($lpa_id)) {
			$lpa_id = " AND a.lpa_id='" . $lpa_id . "'";
		} else {
			$lpa_id = "";
		}

		if (!empty($tanggal_awal) && !empty($tanggal_akhir)) {
			$tanggal_awal = " AND a.tanggal_pengajuan BETWEEN '" . $tanggal_awal . "' AND '" . $tanggal_akhir . "' ";
		} else {
			$tanggal_awal = "";
		}

		if (!empty($propinsi) && $propinsi != 9999) {
			if ($jenis_fasyankes == 2) {
				// $propinsi2 = " AND daftar_puskesmas.PROV_DAGRI='" . (int)$propinsi . "'";
				$propinsi2 = " AND pp.provinsi_code = '" . (int)$propinsi . "'";
			} else {
				$propinsi2 = " AND propinsi.id_prop='" . (int)$propinsi . "'";
			}
		} else {
			$propinsi2 = "";
		}

		if (!empty($kota) && $kota != 9999) {
			if ($jenis_fasyankes == 2) {
				// $kota = " AND daftar_puskesmas.kode_kabupaten='" . (int)$kota . "'";
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

		if (!empty($status_usulan_id)) {
			if ($status_usulan_id == 1) {
				// $status_usulan_id = " AND b.status_usulan_id IS NULL";
				$status_usulan_id = " AND (b.status_usulan_id = '1' OR b.status_usulan_id IS NULL)";
			} else {
				$status_usulan_id = " AND b.status_usulan_id='" . $status_usulan_id . "'";
			}
		} else {
			$status_usulan_id = " AND b.status_usulan_id IS NULL";
		}

		// $raw_user_id=" and a.jenis_fasyankes='".$jenis_fasyankes."' and dbfaskes.propinsi.id_prop='".$propinsi."' and dbfaskes.kota.id_kota='".$kota."' ";
		//    $raw_user_id= $propinsi.$kota.$jenis_fasyankes;
		$raw_user_id = $jenis_fasyankes2 . $lpa_id . $tanggal_awal . $propinsi2 . $kota . $status_usulan_id;

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
			kota.nama_kota AS nama_kota";

			$data_join = "LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
			LEFT OUTER JOIN dbfaskes.data_pm ON dbfaskes.trans_final.id_faskes = dbfaskes.data_pm.id_faskes
			LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_pm.id_prov_pm = dbfaskes.propinsi.id_prop
			LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_pm.id_kota_pm = dbfaskes.kota.id_kota";
		} else if ($jenis_fasyankes == 2) {
			// $data_select = "daftar_puskesmas.nama AS nama_fasyankes,
			// daftar_puskesmas.PROV_DAGRI AS provinsi_id,
			// daftar_puskesmas.PROVINSI AS nama_prop,
			// daftar_puskesmas.kode_kabupaten AS kabkota_id,
			// daftar_puskesmas.KABKOTA AS nama_kota";

			$data_select = "pp.name as nama_fasyankes,
			pp.kode_baru as fasyankes_id,
			pp.provinsi_nama as nama_prop,
			pp.kabkot_nama as nama_kota,
			pp.provinsi_code as provinsi_id,
			pp.kabkot_code as kabkota_id";

			// $data_join = "LEFT OUTER JOIN dbfaskes.daftar_puskesmas ON a.fasyankes_id = daftar_puskesmas.kode_satker";
			$data_join = "LEFT JOIN dbfaskes.puskesmas_pusdatin pp ON pp.kode_sarana = a.fasyankes_id ";
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
			kota.nama_kota AS nama_kota";
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
			kota.nama_kota AS nama_kota";
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
			kota.nama_kota AS nama_kota";
			$data_join = "LEFT OUTER JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
			LEFT OUTER JOIN dbfaskes.data_labkes ON dbfaskes.trans_final.id_faskes = dbfaskes.data_labkes.id_faskes
			LEFT OUTER JOIN dbfaskes.propinsi ON dbfaskes.data_labkes.id_prov = dbfaskes.propinsi.id_prop
			LEFT OUTER JOIN dbfaskes.kota ON dbfaskes.data_labkes.id_kota = dbfaskes.kota.id_kota";
		}


		$sql = $this->db->query("SELECT
				a.*,
				(SELECT MIN(pusd2.tanggal_survei) FROM pengajuan_usulan_survei_detail pusd2 WHERE pusd2.pengajuan_usulan_survei_id = a.id) as tanggal_awal_survei,
				b.status_usulan_id,
				b.keterangan,
				h.nama AS status_usulan,
				c.nama AS jenis_fasyankes_nama,
				d.nama AS jenis_survei,
				e.nama AS jenis_akreditasi,
				f.nama AS status_akreditasi,
				g.nama AS lpa,
				l.final AS status_final_ep,
				m.id AS pengiriman_laporan_survei_id,
				" . $data_select . "
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
				LEFT OUTER JOIN trans_final_ep_surveior l on l.penetapan_tanggal_survei_id = k.id
				LEFT OUTER JOIN pengiriman_laporan_survei m on m.penetapan_tanggal_survei_id = k.id
				LEFT OUTER JOIN penetapan_verifikator n on n.pengiriman_laporan_survei_id = m.id
				LEFT OUTER JOIN trans_final_ep_verifikator o on o.penetapan_verifikator_id = n.id
				LEFT OUTER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
				LEFT OUTER JOIN penerbitan_sertifikat q ON q.pengiriman_rekomendasi_id = p.id

			WHERE 1=1 " . $raw_user_id . " 
			ORDER BY
			a.created_at DESC");


		return $sql->result_array();
		// $this->db->last_query();
	}

	function detail_faskes($idfaskes, $jenis_fasyankes)
	{
		switch ($jenis_fasyankes) {
			case '1':
				$where = " tf.kode_faskes = '$idfaskes'";
				$sql = $this->db->query("SELECT
					tf.kode_faskes as id_faskes,
				 	dp.nama_pm as nama_faskes,
					dp.alamat_faskes as alamat_faskes,
					dp.alamat_cetak_sertifikat as alamat_faskes_sertifikat
				FROM
					dbfaskes.trans_final tf
				LEFT JOIN 
					dbfaskes.data_pm dp ON dp.id_faskes = tf.id_faskes   
				WHERE 
					" . $where . "
				");
				return $sql->result_array();
				break;
			case '2':
				$where = " pp.kode_sarana = '$idfaskes'";
				$sql = $this->db->query("SELECT
					pp.kode_sarana as id_faskes,
				 	pp.name as nama_faskes,
					pp.alamat as alamat_faskes,
					pp.alamat_sertifikat as alamat_faskes_sertifikat 
				FROM
					dbfaskes.puskesmas_pusdatin pp  
				WHERE 
					" . $where . "
				");
				return $sql->result_array();
				// return $where;
				break;
			case '3':
				$where = " tf.kode_faskes = '$idfaskes'";
				$sql = $this->db->query("SELECT 
					tf.kode_faskes as id_faskes,
					dk.nama_klinik as nama_faskes,
					dk.alamat_faskes as alamat_faskes,
					dk.alamat_faskes_versi_akreditasi as alamat_faskes_sertifikat 
				FROM 
					dbfaskes.trans_final tf 
				LEFT JOIN 
					dbfaskes.data_klinik dk ON dk.id_faskes = tf.id_faskes 
				WHERE 
					" . $where . "
				");
				return $sql->result_array();
				// return $this->db->error();
				break;
			case '4':
				return '404';
				break;
			case '5':
				return '404';
				break;
			case '6':
				$where = " tf.kode_faskes = '$idfaskes'";
				$sql = $this->db->query("SELECT 
					tf.kode_faskes as id_faskes,
					du.nama_utd as nama_faskes,
					du.alamat_faskes as alamat_faskes,
					du.alamat_faskes as alamat_faskes_sertifikat
				FROM 
					dbfaskes.trans_final tf 
				LEFT JOIN 
					dbfaskes.data_utd du ON du.id_faskes = tf.id_faskes 
				WHERE 
					" . $where . "
				");
				return $sql->result_array();
				break;
			case '7':
				$where = " tf.kode_faskes = '$idfaskes'";
				$sql = $this->db->query("SELECT 
							tf.kode_faskes as id_faskes,
							dl.nama_lab as nama_faskes,
							dl.alamat_faskes as alamat_faskes,
							dl.alamat_faskes_versi_akreditasi as alamat_faskes_sertifikat
						FROM 
							dbfaskes.trans_final tf 
						LEFT JOIN 
							dbfaskes.data_labkes dl ON dl.id_faskes = tf.id_faskes  
				WHERE 
					" . $where . "
				");
				return $sql->result_array();
				break;
			case '8':
				return '404';
				break;
			case '9':
				return '404';
				break;
			case '10':
				return '404';
				break;
			default:
				return '404';
				break;
		}
	}



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
				$propinsi2 = " AND dbfaskes.daftar_puskesmas.PROV_DAGRI = '" . (int)$propinsi . "'";
			} else {
				$propinsi2 = " AND propinsi.id_prop='" . (int)$propinsi . "'";
			}
		} else {
			$propinsi2 = "";
		}

		if (!empty($kota) && $kota != 9999) {
			if ($jenis_fasyankes == 2) {
				$kota = " AND dbfaskes.daftar_puskesmas.kode_kabupaten ='" . (int)$kota . "'";
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

		// $raw_user_id=" and a.jenis_fasyankes='".$jenis_fasyankes."' and dbfaskes.propinsi.id_prop='".$propinsi."' and dbfaskes.kota.id_kota='".$kota."' ";
		//    $raw_user_id= $propinsi.$kota.$jenis_fasyankes;
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
					ps.id as penerbitan_sertifikat_id_monitor,
					( SELECT JSON_ARRAYAGG( tanggal_survei ) FROM pengajuan_usulan_survei_detail pusd WHERE pengajuan_usulan_survei_id = a.id ) AS tanggal_survei,
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
								( pr.id IS NULL, 'Penilaian EP Verifikator', 'Pengiriman Rekomendasi' ))))))))) AS tahap
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
					LEFT JOIN penerbitan_sertifikat ps ON ps.pengiriman_rekomendasi_id = pr.id 
			WHERE 1=1 " . $raw_user_id . " 
			ORDER BY
			a.created_at DESC");
		} else if ($jenis_fasyankes == 2) {
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
					daftar_puskesmas.nama AS nama_fasyankes,
					daftar_puskesmas.PROV_DAGRI AS provinsi_id,
					daftar_puskesmas.PROVINSI AS nama_prop,
					daftar_puskesmas.kode_kabupaten AS kabkota_id,
					daftar_puskesmas.KABKOTA AS nama_kota,
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
					ps.id as penerbitan_sertifikat_id_monitor,
					( SELECT JSON_ARRAYAGG( tanggal_survei ) FROM pengajuan_usulan_survei_detail pusd WHERE pengajuan_usulan_survei_id = a.id ) AS tanggal_survei,
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
								( pr.id IS NULL, 'Penilaian EP Verifikator', 'Pengiriman Rekomendasi' ))))))))) AS tahap
				FROM
					pengajuan_usulan_survei a
					LEFT JOIN penerimaan_pengajuan_usulan_survei b ON a.id = b.pengajuan_usulan_survei_id
					JOIN jenis_fasyankes c ON a.jenis_fasyankes = c.id
					JOIN jenis_survei d ON a.jenis_survei_id = d.id
					JOIN jenis_akreditasi e ON a.jenis_akreditasi_id = e.id
					JOIN status_akreditasi f ON a.status_akreditasi_id = f.id
					JOIN lpa g ON a.lpa_id = g.id
					JOIN dbfaskes.daftar_puskesmas ON a.fasyankes_id = daftar_puskesmas.kode_satker
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
					LEFT JOIN penerbitan_sertifikat ps ON ps.pengiriman_rekomendasi_id = pr.id 
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
				trans_final.kode_faskes AS kode_faskes, 
				trans_final.id_faskes AS id_faskes, 
				trans_final.kode_faskes AS kode_faskes, 
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
					ps.id as penerbitan_sertifikat_id_monitor,
					( SELECT JSON_ARRAYAGG( tanggal_survei ) FROM pengajuan_usulan_survei_detail pusd WHERE pengajuan_usulan_survei_id = a.id ) AS tanggal_survei,
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
								( pr.id IS NULL, 'Penilaian EP Verifikator', 'Pengiriman Rekomendasi' ))))))))) AS tahap
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
				LEFT JOIN penerbitan_sertifikat ps ON ps.pengiriman_rekomendasi_id = pr.id 
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
				trans_final.kode_faskes AS kode_faskes,
				trans_final.id_faskes AS id_faskes,
				trans_final.kode_faskes AS kode_faskes,
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
					ps.id as penerbitan_sertifikat_id_monitor,
					( SELECT JSON_ARRAYAGG( tanggal_survei ) FROM pengajuan_usulan_survei_detail pusd WHERE pengajuan_usulan_survei_id = a.id ) AS tanggal_survei,
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
								( pr.id IS NULL, 'Penilaian EP Verifikator', 'Pengiriman Rekomendasi' ))))))))) AS tahap
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
				LEFT JOIN penerbitan_sertifikat ps ON ps.pengiriman_rekomendasi_id = pr.id 
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
				trans_final.kode_faskes AS kode_faskes,
				trans_final.id_faskes AS id_faskes,
				trans_final.kode_faskes AS kode_faskes,
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
					ps.id as penerbitan_sertifikat_id_monitor,
					( SELECT JSON_ARRAYAGG( tanggal_survei ) FROM pengajuan_usulan_survei_detail pusd WHERE pengajuan_usulan_survei_id = a.id ) AS tanggal_survei,
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
								( pr.id IS NULL, 'Penilaian EP Verifikator', 'Pengiriman Rekomendasi' ))))))))) AS tahap
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
				LEFT JOIN penerbitan_sertifikat ps ON ps.pengiriman_rekomendasi_id = pr.id 
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
					ps.id as penerbitan_sertifikat_id_monitor,
					( SELECT JSON_ARRAYAGG( tanggal_survei ) FROM pengajuan_usulan_survei_detail pusd WHERE pengajuan_usulan_survei_id = a.id ) AS tanggal_survei,
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
								( pr.id IS NULL, 'Penilaian EP Verifikator', 'Pengiriman Rekomendasi' ))))))))) AS tahap
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
					LEFT JOIN penerbitan_sertifikat ps ON ps.pengiriman_rekomendasi_id = pr.id 
			WHERE 1=1 " . $raw_user_id . " 
			ORDER BY
			a.created_at DESC");
		}
		return $sql->result_array();
		// return $raw_user_id;
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
		i.url_sp_ikp_klinik,
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
		sl.id_surveior_satu_baru as surveior_satu,
		-- k.surveior_satu,
		k.status_surveior_satu,
		sl.id_surveior_dua_baru as surveior_dua,
		-- k.surveior_dua,
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
		u.catatan_direktur
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
		LEFT JOIN surveior_lapangan sl ON sl.penetapan_tanggal_survei_id = k.id 
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
		WHERE 1=1 " . $raw_user_id . " ");


		return $sql->result_array();
	}

	function select_pengajuan_detail($user_id)
	{
		$this->db->select('*');
		$this->db->from('pengajuan_usulan_survei_detail');
		$this->db->where('pengajuan_usulan_survei_id', $user_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_puskesmas($kodesatker)
	{
		// $query = "SELECT * FROM dbfaskes.daftar_puskesmas WHERE kode_satker = '$kodesatker'";

		$query = "SELECT 
			* 
		FROM 
			dbfaskes.puskesmas_pusdatin pp 
		WHERE 
			pp.kode_sarana  = '$kodesatker'";

		return $this->db->query($query)->row();
	}

	function delete_pengajuan($user_id)
	{

		$raw_user_id = " and id='" . $user_id . "' ";

		$sql = $this->db->query("DELETE FROM pengajuan_usulan_survei  WHERE 1=1 " . $raw_user_id . " ");


		return 1;
	}
	function delete_surveior($user_id)
	{

		$raw_id = " and users_id='" . $user_id . "' ";
		$raw_user_id = " and id='" . $user_id . "' ";

		$sql = $this->db->query("DELETE FROM user_surveior  WHERE 1=1 " . $raw_id . " ");
		$sql = $this->db->query("DELETE FROM users  WHERE 1=1 " . $raw_user_id . " ");
		$sql = $this->db->query("DELETE FROM user_surveior_bidang_detail  WHERE 1=1 " . $raw_id . " ");

		return 1;
	}
	function delete_verifikator($user_id)
	{

		$raw_id = " and users_id='" . $user_id . "' ";
		$raw_user_id = " and id='" . $user_id . "' ";


		$sql = $this->db->query("DELETE FROM user_verifikator  WHERE 1=1 " . $raw_id . " ");
		$sql = $this->db->query("DELETE FROM users  WHERE 1=1 " . $raw_user_id . " ");

		return 1;
	}
	public function checkmail($email)
	{

		$query = "SELECT * FROM users WHERE email = '$email' ";
		$sql = $this->db->query($query);
		return $sql->num_rows();
	}
	public function checkniksurveior($nik)
	{

		$query = "SELECT * FROM user_surveior WHERE nik = '$nik' ";
		$sql = $this->db->query($query);
		return $sql->num_rows();
	}
	public function checknikverifikator($nik)
	{

		$query = "SELECT * FROM user_verifikator WHERE nik = '$nik' ";
		$sql = $this->db->query($query);
		return $sql->num_rows();
	}

	public function getLastID($table, $id_pengguna)
	{
		$lastID = $this->db->query('SELECT MAX(id) as max_id FROM ' . $table . ' WHERE users_id = ' . $id_pengguna)->row();
		$id = $lastID->max_id;

		return $id;
	}
	function get_kab_kota_by_prop($filters = NULL, $order = NULL)
	{

		$sql = $this->db->query(" SELECT * from dbfaskes.kota   WHERE  " . $filters . " ORDER BY " . $order . " ");
		return $sql->result_array();
	}

	function count_rows_bab($jenis_fasyankes)
	{
		$raw_user_id = " and jenis_fasyankes_id='" . $jenis_fasyankes . "' ";

		$sql = $this->db->query("SELECT
		bab
	FROM
		elemen_penilaian WHERE 1=1 " . $raw_user_id . "  GROUP BY bab");


		return $sql->num_rows();
	}

	function count_rows_trans_ep($id)
	{
		//$user_id=3;
		// if(is_null($bab) == 1){
		// 	$raw_user_id=" and bab='".$bab."' and jenis_fasyankes_id='".$fanyankes_id."' ";
		// }
		$raw_user_id = " and a.penetapan_tanggal_survei_id='" . $id . "' ";

		$sql = $this->db->query("SELECT
		b.bab
	FROM
		trans_ep a
		JOIN elemen_penilaian b ON a.elemen_penilaian_id = b.id
		LEFT JOIN trans_ep_verifikator c ON a.id = c.trans_ep_id 
		
		WHERE 1=1 " . $raw_user_id . " 
		GROUP BY
		b.bab");

		return $sql->num_rows();
	}

	function count_rows_trans_ep_verifikator($id)
	{
		//$user_id=3;
		// if(is_null($bab) == 1){
		// 	$raw_user_id=" and bab='".$bab."' and jenis_fasyankes_id='".$fanyankes_id."' ";
		// }
		$raw_user_id = " and a.penetapan_tanggal_survei_id='" . $id . "' ";

		$sql = $this->db->query("SELECT
		b.bab
	FROM
		trans_ep a
		JOIN elemen_penilaian b ON a.elemen_penilaian_id = b.id
		JOIN trans_ep_verifikator c ON a.id = c.trans_ep_id 
		
		WHERE 1=1 " . $raw_user_id . " 
		GROUP BY
		b.bab");

		return $sql->num_rows();
	}

	function select_nama_faskes($jenis_fasyankes, $fasyankes_id)
	{

		if (!empty($jenis_fasyankes)) {
			$jenis_fasyankes2 = " AND a.jenis_fasyankes='" . $jenis_fasyankes . "'";
		} else {
			$jenis_fasyankes2 = " AND a.jenis_fasyankes='99'";
		}

		if (!empty($fasyankes_id)) {
			$fasyankes_id = " AND a.fasyankes_id='" . $fasyankes_id . "'";
		} else {
			$fasyankes_id = " AND a.fasyankes_id='99'";
		}

		$raw_user_id = $jenis_fasyankes2 . $fasyankes_id;

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
			$data_select = "daftar_puskesmas.nama AS nama_fasyankes,
			daftar_puskesmas.PROV_DAGRI AS provinsi_id,
			daftar_puskesmas.PROVINSI AS nama_prop,
			daftar_puskesmas.kode_kabupaten AS kabkota_id,
			daftar_puskesmas.KABKOTA AS nama_kota,";
			$data_join = "LEFT OUTER JOIN dbfaskes.daftar_puskesmas ON a.fasyankes_id = daftar_puskesmas.kode_satker";
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
				
				" . $data_select . "
				
					a.created_at
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
				LEFT OUTER JOIN trans_final_ep_surveior l on l.penetapan_tanggal_survei_id = k.id
				LEFT OUTER JOIN pengiriman_laporan_survei m on m.penetapan_tanggal_survei_id = k.id
				LEFT OUTER JOIN penetapan_verifikator n on n.pengiriman_laporan_survei_id = m.id
				LEFT OUTER JOIN trans_final_ep_verifikator o on o.penetapan_verifikator_id = n.id
                LEFT OUTER JOIN pengiriman_rekomendasi p ON p.trans_final_ep_verifikator_id = o.id
				LEFT OUTER JOIN penerbitan_sertifikat q ON q.pengiriman_rekomendasi_id = p.id

			WHERE 1=1 " . $raw_user_id . " 
			ORDER BY
			a.created_at DESC");


		return $sql->result_array();
	}

	function detail_pengajuan_survei($id)
	{
		if (!empty($id)) {
			$id = " AND a.pengajuan_usulan_survei_id='" . $id . "'";
		} else {
			$id = " AND a.pengajuan_usulan_survei_id='0'";
		}

		$raw_user_id = $id;

		$sql = $this->db->query("SELECT
					a.*
				FROM
					pengajuan_usulan_survei_detail a
					 
			WHERE 1=1 " . $raw_user_id . " 
			ORDER BY
			a.tanggal_survei ASC");

		return $sql->result_array();
	}


	function getsurtugtte($id)
	{
		$sql = $this->db->query("SELECT
		* FROM surtug
		WHERE id_pengajuan = " . $id . "
		");
		return $sql->result_array();
	}

	function checksertifikatsurveior($nik)
	{
		$data = array(
			'sertifikat_surveior.nik' => $nik
		);
		$query = $this->db->get_where('sertifikat_surveior', $data);
		// $this->db->select('*');
		// $this->db->from('sertifikat_surveior');
		// $this->db->join('user_surveior', 'user_surveior.nik = sertifikat_surveior.NIK');
		// $this->db->where($data);

		// $query = $this->db->get();
		return $query->result_array();
	}



	public function getIkp($kode_faskes, $tahun)
	{
		$dbFaskes = $this->load->database('dbfaskes', TRUE);

		$dbFaskes->from('integrasi_ikp');
		$dbFaskes->where('kode_faskes', $kode_faskes);
		// $dbFaskes->where('tahun', $tahun);

		return $dbFaskes->get()->result();
	}

	public function getInm($kode_faskes, $tahun)
	{
		$dbFaskes = $this->load->database('dbfaskes', TRUE);

		$dbFaskes->from('integrasi_inm');
		$dbFaskes->where('kode_faskes', $kode_faskes);
		// $dbFaskes->where('tahun', $tahun);

		return $dbFaskes->get()->result();
	}

	// public function getAspak($kode_faskes, $kode_integrasi)
	// {
	// 	$dbFaskes = $this->load->database('dbfaskes', TRUE);

	// 	$dbFaskes->from('integrasi_aspak');
	// 	$dbFaskes->where('kode_faskes', $kode_faskes);
	// 	// $dbFaskes->where('kode_integrasi', $kode_integrasi);

	// 	return $dbFaskes->get()->result();
	// }

	public function getAspak($kode_faskes)
	{
		$dbFaskes = $this->load->database('dbfaskes', TRUE);

		$dbFaskes->from('integrasi_aspak');
		$dbFaskes->where('kode_faskes', $kode_faskes);
		// $dbFaskes->where('kode_integrasi', $kode_integrasi);

		return $dbFaskes->get()->result();
	}

	public function getSisdmk($kode_faskes, $kode_integrasi = null)
	{
		$dbFaskes = $this->load->database('dbfaskes', TRUE);

		$dbFaskes->from('integrasi_sisdmk');
		$dbFaskes->where('kode_faskes', $kode_faskes);

		if ($kode_integrasi != null) {
			$dbFaskes->where('kode_integrasi', $kode_integrasi);
		}

		return $dbFaskes->get()->result();
	}
	public function getDataNarahubung($id)
	{
		$raw_user_id =  " AND a.fasyankes_id='" . $id . "'";;

		$sql = $this->db->query("SELECT
					a.*
				FROM
					narahubung a
					 
			WHERE 1=1 " . $raw_user_id);

		return $sql->result();
	}
	public function getDataSertifikat($idfaskes)
	{
		$sql = $this->db->query("SELECT
			*
		FROM 
			tte_dirjen td
		WHERE 
			td.id_faskes = '$idfaskes'
		");
		return $sql->result();
	}

	public function viwDataSertifikat($id)
	{
		$sql = $this->db->query("SELECT
								tte_dirjen.url_sertifikat
								FROM
								data_sertifikat
								INNER JOIN
								tte_lpa
								ON 
								data_sertifikat.id = tte_lpa.data_sertifikat_id
								INNER JOIN
								tte_dirjen
								ON 
								tte_lpa.id = tte_dirjen.tte_lpa_id
								WHERE
								data_sertifikat.id_pengajuan = '$id'
		");
		return $sql->result();
	}

	public function inputPTS($table, $data)
	{
		// $this->db->trans_start();

		$this->db->trans_begin();
		$this->db->insert($table, $data);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return '0';
		} else {
			$this->db->trans_commit();
			return '1';
		}


		// $this->db->trans_complete();
		// if ($this->db->trans_status() === FALSE) {
		// 	return '0';
		// } else {
		// 	return '1';
		// }
	}

	public function updatePTS($table, $where, $data)
	{
		// $this->db->trans_start();

		$this->db->trans_begin();
		$this->db->where($where);
		$this->db->update($table, $data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return '0';
		} else {
			$this->db->trans_commit();
			return '1';
		}

		// $this->db->trans_complete();
		// if ($this->db->trans_status() === FALSE) {
		// 	return '0';
		// } else {
		// 	return '1';
		// }
	}

	// public function inputSurveiorLapangannopengganti($id, $status, $surveior_lapangan)
	// {
	// 	$this->db->trans_start();
	// 	$this->db->where('pengajuan_usulan_survei_id', $id);
	// 	$this->db->update('jadwal_surveior', $status);
	// 	$this->db->insert('surveior_lapangan', $surveior_lapangan);
	// 	$this->db->trans_complete();
	// 	if ($this->db->trans_status() === FALSE) {
	// 		return '0';
	// 	} else {
	// 		return '1';
	// 	}
	// }

	public function inputSurveiorLapanganpengganti($surveior_lapangan, $jadwal, $jadwal_pengganti)
	{
		// print_r(json_encode($jadwal_pengganti));

		// JADWAL LAMA
		// $this->db->trans_start();


		$this->db->trans_begin();

		$id = $jadwal['pengajuan_usulan_survei_id'];
		foreach ($jadwal['user_surveior_id'] as $key => $value) {
			$where = array('pengajuan_usulan_survei_id' => $id, 'user_surveior_id' => $value);
			$status = array('status' => $jadwal['status'][$key]);
			// $status = array('status' => $jadwal['status'][$key], 'pengajuan_usulan_survei_id' => null);
			$this->db->where($where);
			$this->db->update('jadwal_surveior', $status);
		}

		// JADWAL BARU
		foreach ($jadwal_pengganti as $key => $value) {
			foreach ($value as $index => $data) {
				$where = array('user_surveior_id' => $data['user_surveior_id'], 'jadwal_kesiapan' => $data['jadwal_kesiapan']);
				$update = array('status' => '1', 'pengajuan_usulan_survei_id' => $id);
				$this->db->where($where);
				$this->db->update('jadwal_surveior', $update);
			}
		}

		// INPUT SURVEIOR LAPANGAN
		$this->db->insert('surveior_lapangan', $surveior_lapangan);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return '0';
		} else {
			$this->db->trans_commit();
			return '1';
		}

		// $this->db->trans_complete();

		// if ($this->db->trans_status() === FALSE) {
		// 	return '0';
		// } else {
		// 	return '1';
		// }
	}

	public function updateSurveiorLapangan($surveior_lapangan, $jadwal, $jadwal_pengganti) {}

	public function checkFinalepSurveior($idpts)
	{
		$sql = $this->db->query("SELECT 
			tfes.`final` 
		FROM 
			trans_final_ep_surveior tfes 
		WHERE 
			tfes.penetapan_tanggal_survei_id = '" . $idpts . "'
		");
		return $sql->result_array();
	}

	public function checkep($data)
	{
		$penetapan_tanggal_survei_id = $data['penetapan_tanggal_survei_id'];
		$elemen_penilaian_id = $data['elemen_penilaian_id'];

		$sql = $this->db->query("SELECT 
			te.id 
		FROM 
			trans_ep te 
		WHERE 
			te.penetapan_tanggal_survei_id = '" . $penetapan_tanggal_survei_id . "'
		AND
			te.elemen_penilaian_id = '" . $elemen_penilaian_id . "'
		");
		return $sql->result_array();
	}

	public function edit_data_ep($data)
	{
		return $data;
	}

	function checkuserbidang($user)
	{
		// $data = array(
		// 	'ukom_surveior.nik' => $nik,
		// 	'ukom_surveior.lpa_id' => $lpa
		// 	// ,
		// 	// 'ukom_surveior.id_faskes' => $faskes,
		// 	// 'ukom_surveior.id_bidang' => $bidang
		// 	// 'ukom_surveior.nik' => $nik
		// );
		// $query = $this->db->get_where('ukom_surveior', $data);
		$query = $this->db->query(
			"SELECT 
			us.nik,
		-- 	us.nama, 
		-- 	us.email,
		-- 	jf.nama,
		-- 	l.nama as nama_lpa,
		l.id as lpa_id,
		-- 	us.id_bidang,
		-- 	b.bidang,
-- 		b.id,
-- 			IF (us.status_ukom = 1, 'LULUS', 'Tidak Lulus') as status_ukom,
		-- 	us.tgl_berakhir_ukom,
-- 			usbd.id,
-- 			us.tgl_berakhir_ukom,
			usbd.*
		FROM 
			user_surveior_bidang_detail usbd 
		LEFT JOIN 
			jenis_fasyankes jf ON jf.id = usbd.id_fasyankes_surveior 
		LEFT JOIN 
			bidang b ON usbd.id_bidang = b.id 
			LEFT JOIN 
			users us ON us.id = usbd.users_id 
		LEFT JOIN 
			lpa l ON l.id = us.lpa_id 
		LEFT JOIN 
			user_surveior us2 ON usbd.id_user_surveior = us2.id
-- 		LEFT JOIN 
-- 			user_surveior_bidang_detail usbd ON usbd.id_user_surveior = us2.id 
		WHERE 
		usbd.is_checked = 1
		
		AND

		usbd.users_id = '" . $user . "'	
		"

		);

		return $query->result_array();
	}

	function checkbidang($nik, $lpa)
	{
		$data = array(
			'ukom_surveior.nik' => $nik,
			'ukom_surveior.lpa_id' => $lpa
			// ,
			// 'ukom_surveior.id_faskes' => $faskes,
			// 'ukom_surveior.id_bidang' => $bidang
			// 'ukom_surveior.nik' => $nik
		);
		// $query = $this->db->get_where('ukom_surveior', $data);
		$query = $this->db->query("SELECT 
		-- 	us.nik,
		-- 	us.nama, 
		-- 	us.email,
		-- 	jf.nama,
		-- 	l.nama as nama_lpa,
		-- 	us.id_bidang,
		-- 	b.bidang,
		-- 	IF (us.status_ukom = 1, 'LULUS', 'Tidak Lulus') as status_ukom,
		-- 	us.tgl_berakhir_ukom,
			usbd.id,
			us.tgl_berakhir_ukom
		-- 	usbd.*
		FROM 
			ukom_surveior us 
		LEFT JOIN 
			jenis_fasyankes jf ON jf.id = us.id_faskes 
		LEFT JOIN 
			bidang b ON us.id_bidang = b.id 
		LEFT JOIN 
			lpa l ON l.id = us.lpa_id 
		LEFT JOIN 
			user_surveior us2 ON us2.nik = us.nik 
		LEFT JOIN 
			user_surveior_bidang_detail usbd ON usbd.id_user_surveior = us2.id 
		WHERE 
		-- 	jf.id = '2'
		-- AND 
			us.status_ukom = '1'
		AND
			usbd.id_bidang = us.id_bidang 
		AND 
		
			us.nik = '" . $nik . "' 
			
		AND
		
		us.lpa_id = '" . $lpa . "'	");

		return $query->result_array();
	}


	public function updateUkom($id_usbd, $tgl)
	{
		$this->db->trans_begin();
		foreach ($id_usbd as $key => $value) {

			$where = array('id' => $value);
			$update = array('status_ukom' => '1', 'is_checked' => '1', 'tgl_berlaku_sertifikat' => $tgl[$key]);
			$this->db->where($where);
			$this->db->update('user_surveior_bidang_detail', $update);
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo '0';
			return '0';
		} else {
			$this->db->trans_commit();
			echo '1';
			return '1';
		}
	}

	public function updateUkomSalah($id_usbd)
	{
		$this->db->trans_begin();
		foreach ($id_usbd as $key => $value) {
			$where = array('id' => $value);
			$update = array('status_ukom' => '0', 'is_checked' => '1');
			$this->db->where($where);
			$this->db->update('user_surveior_bidang_detail', $update);
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo '1';
			return '1';
		} else {
			$this->db->trans_commit();
			echo '0';
			return '0';
		}
	}
}
