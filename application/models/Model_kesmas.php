<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Model_kesmas extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}


	function getSurveior() {
		$sql = $this->db->query("SELECT 
		
				d.nama AS Lembaga,
		
				COUNT(a.nama) AS jumlah
		
				FROM user_surveior a
		
				JOIN lpa d ON a.lpa_id = d.id
				WHERE a.status_aktif=1 AND d.status=1
				GROUP BY d.nama");
				return $sql->result_array();
	}

	public function getAll($jenisFaskes,$namaFaskes,$provinsiId,$kabKotaId) {
		$newName = str_replace(' ', '+', $namaFaskes);

		$curlToken = curl_init();

		// Create Token
		curl_setopt_array($curlToken, array(
			CURLOPT_URL => 'https://api-yankes.kemkes.go.id/faskes/login',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>'{
				"userName": "kotakelektronik@gmail.com",
				"password": "p5fuNGds"
			}',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json'
			),
		));

		$responseToken = curl_exec($curlToken);
		curl_close($curlToken);
// echo 
// var_dump($responseToken);
		$jsonDecodeToken = json_decode($responseToken, true);
		if ($jsonDecodeToken['status'] === true) {
			$token = $jsonDecodeToken['data']['access_token'];

			// Get Akreditasi
			if ($jenisFaskes == 'klinik') {
				$curlAkreditasi = curl_init();
				curl_setopt_array($curlAkreditasi, array(
					CURLOPT_URL => 'https://api-yankes.kemkes.go.id/faskes/klinikakreditasi?provinsiId='.$provinsiId.'&kabKotaId='.$kabKotaId.
						'&namaFaskes='.$newName,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'GET',
					CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json',
						'Authorization: Bearer '. $token
					),
				));
				
				$responseAkreditasi = curl_exec($curlAkreditasi);
				curl_close($curlAkreditasi);

				$response = json_decode($responseAkreditasi, true);
				return $response;
			} else if ($jenisFaskes == 'puskesmas') {
				$curlAkreditasi = curl_init();
				if($provinsiId == 9999){
					$page=1;
					curl_setopt_array($curlAkreditasi, array(
						CURLOPT_URL => 'https://api-yankes.kemkes.go.id/faskes/puskesmasakreditasi?namaFaskes='.$newName.'&page='.$page.'&limit=1000',
						CURLOPT_RETURNTRANSFER => true,
						CURLOPT_ENCODING => '',
						CURLOPT_MAXREDIRS => 100,
						CURLOPT_TIMEOUT => 0,
						CURLOPT_FOLLOWLOCATION => true,
						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						CURLOPT_CUSTOMREQUEST => 'GET',
						CURLOPT_HTTPHEADER => array(
							'Content-Type: application/json',
							'Authorization: Bearer '. $token
						),
					));
				}else{
				
				curl_setopt_array($curlAkreditasi, array(
					CURLOPT_URL => 'https://api-yankes.kemkes.go.id/faskes/puskesmasakreditasi?provinsiId='.$provinsiId.'&kabKotaId='.$kabKotaId.
						'&namaFaskes='.$newName,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'GET',
					CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json',
						'Authorization: Bearer '. $token
					),
				));
			}
				$responseAkreditasi = curl_exec($curlAkreditasi);
				curl_close($curlAkreditasi);

				$response = json_decode($responseAkreditasi, true);
				return $response;
				
			} else if ($jenisFaskes == 'labkes') {
				$curlAkreditasi = curl_init();
				curl_setopt_array($curlAkreditasi, array(
					CURLOPT_URL => 'https://api-yankes.kemkes.go.id/faskes/labkesakreditasi?provinsiId='.$provinsiId.'&kabKotaId='.$kabKotaId.
						'&namaFaskes='.$newName,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'GET',
					CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json',
						'Authorization: Bearer '. $token
					),
				));
				
				$responseAkreditasi = curl_exec($curlAkreditasi);
				curl_close($curlAkreditasi);

				$response = json_decode($responseAkreditasi, true);
				return $response;
			} else if ($jenisFaskes == 'rumahsakit') {
				$curlAkreditasi = curl_init();
				curl_setopt_array($curlAkreditasi, array(
					CURLOPT_URL => 'https://api-yankes.kemkes.go.id/faskes/rumahsakitakreditasi?provinsiId='.$provinsiId.'&kabKotaId='.$kabKotaId.
						'&namaFaskes='.$newName,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'GET',
					CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json',
						'Authorization: Bearer '. $token
					),
				));
				
				$responseAkreditasi = curl_exec($curlAkreditasi);
				curl_close($curlAkreditasi);

				$response = json_decode($responseAkreditasi, true);
				return $response;
			} else {
				$response = "link is broken";
				return $response;
			}
		}
	}

public function getapi(){
	$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-dev.dto.kemkes.go.id/dev-portal-api/external/auth',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "email": "dfoyankes@yopmail.com",
    "password": "soulAdmin@27128"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo json_encode($response);
}


	public function getAllAkreditasi($jenisFaskes,$namaFaskes,$provinsiId,$kabKotaId)
	{

		if (!empty($provinsiId) && $provinsiId != 9999) {
			if ($jenisFaskes == 'puskesmas') {
				$propinsi2 = " AND puskesmas_pusdatin.provinsi_code='" . (int)$provinsiId . "'";
			} else {
				$propinsi2 = " AND propinsi.id_prop='" . (int)$provinsiId . "'";
			}
		} else {
			$propinsi2 = "";
		}

		if (!empty($kabKotaId) && $kabKotaId != 9999) {
			if ($jenisFaskes == 'puskesmas') {
				$kabKotaId = " AND puskesmas_pusdatin.kabkot_code='" . (int)$kabKotaId . "'";
			} else {
				$kabKotaId = " AND kota.id_kota='" . (int)$kabKotaId . "'";
			}
		} else {
			$kabKotaId = "";
		}

		// if (!empty($jenisFaskes)) {
		// 	$jenisFaskes = " AND a.jenis_fasyankes='" . $jenisFaskes . "'";
		// } else {
		// 	$jenisFaskes = " AND a.jenis_fasyankes='99'";
		// }


		// $raw_user_id=" and a.jenis_fasyankes='".$jenis_fasyankes."' and dbfaskes.propinsi.id_prop='".$propinsi."' and dbfaskes.kota.id_kota='".$kota."' ";
		//    $raw_user_id= $propinsi.$kota.$jenis_fasyankes;
		$raw_user_id =   $propinsi2 . $kabKotaId. $namaFaskes;

		if($jenisFaskes=='puskesmas') {
			$data_select ="puskesmas_pusdatin.name AS nama_fasyankes,
			puskesmas_pusdatin.provinsi_code AS provinsi_id,
			puskesmas_pusdatin.provinsi_nama AS nama_prop,
			puskesmas_pusdatin.kabkot_code AS kabkota_id,
			puskesmas_pusdatin.kode_baru AS kode_baru,
			puskesmas_pusdatin.kabkot_nama AS nama_kota,";
			$data_join ="JOIN dbfaskes.puskesmas_pusdatin ON a.fasyankes_id = puskesmas_pusdatin.kode_sarana";
			
		
		}else if($jenisFaskes=='labkes') {
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
			data_labkes.pemilik,
			kota.nama_kota AS nama_kota,";
			$data_join ="JOIN dbfaskes.trans_final ON a.fasyankes_id = dbfaskes.trans_final.kode_faskes
			JOIN dbfaskes.data_labkes ON dbfaskes.trans_final.id_faskes = dbfaskes.data_labkes.id_faskes
			JOIN dbfaskes.propinsi ON dbfaskes.data_labkes.id_prov = dbfaskes.propinsi.id_prop
			JOIN dbfaskes.kota ON dbfaskes.data_labkes.id_kota = dbfaskes.kota.id_kota";

		}else if($jenisFaskes == null){
			echo "<script type='text/javascript'>alert('Faskes tidak boleh kosong!');</script>";
			redirect('/kesmas');
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
					p.created_at AS tanggal_rekomendasi,
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
					s.tgl_survei,
					t.id AS tte_lpa_id,
					t.tgl_tte,
					t.tgl_berakhir,
					u.id AS tte_dirjen_id,
					v.nama AS nama_akreditasi
					
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
				JOIN tte_dirjen u ON u.tte_lpa_id = t.id
				LEFT OUTER JOIN status_rekomendasi v ON p.status_rekomendasi_id = v.id

			WHERE 1=1 ".$raw_user_id." 
			");


		return $sql->result_array();
	}
}