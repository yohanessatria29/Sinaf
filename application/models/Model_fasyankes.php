<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_fasyankes extends CI_Model{	

	public function __construct()
    {
        parent::__construct();
    }
	
	function select_data($table,$where){
        $this->db->get_where($table,$where);
        // $this->db->last_query();
		return $this->db->get_where($table,$where);
	}
	
	function input_data($table,$data){
		return $this->db->insert($table,$data);
	}
	
	function edit_data($table,$where,$data){		
	$this->db->where($where);
	return $this->db->update($table,$data);
	}
	
	function delete_data($table,$where){		
	$this->db->delete($table, $where); 
	}
	
	function select_count($table,$user_id)
	{
	
	   	$raw_user_id=" and id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT COUNT(*) as jml FROM ".$table."  WHERE 1=1 ".$raw_user_id." ");
		
		
		return $sql->result_array();
	}
	
	function getprofile($user_id=NULL)
	{
	
	   	$raw_user_id=" and registrasi_user.id='".$user_id."' ";

		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan FROM registrasi_user LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori  WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	function getcontact($user_id=NULL,$kategori=NULL)
	{
		
		
		$raw_user_id=" and ru.id='".$user_id."' ";
		if($kategori=='5'){
			$var_kategori="AND registrasi_user.id_kategori='3'";
			$var_where="AND registrasi_user.id_kota";
			$var_select="ru.id_kota";
			$var_extra="IN (SELECT ".$var_select." FROM registrasi_user ru WHERE 1=1 ".$raw_user_id.") ";
		}
		
		if($kategori=='7'){
			$var_kategori="AND registrasi_user.id_kategori='3'";
			$var_where="AND registrasi_user.id_kota";
			$var_select="ru.id_kota";
			$var_extra="IN (SELECT ".$var_select." FROM registrasi_user ru WHERE 1=1 ".$raw_user_id.") ";
		}
		
		if($kategori=='3'){
			$var_kategori="AND registrasi_user.id_kategori='2'";
			$var_where="AND registrasi_user.id_prov";
			$var_select="ru.id_prov";
			$var_extra="IN (SELECT ".$var_select." FROM registrasi_user ru WHERE 1=1 ".$raw_user_id.") ";
		}
		
		if($kategori=='2'){
			$var_kategori="AND registrasi_user.id_kategori='1'";
			$var_where="";
			$var_select="";
			$var_extra=" ";
		}
		
		if($kategori=='1'){
			$var_kategori="AND registrasi_user.id_kategori='1'";
			$var_where="";
			$var_select="";
			$var_extra=" ";
		}
	
	

		$sql = $this->db->query("SELECT registrasi_user.* ,kategori.kategori_user,propinsi.nama_prop,kota.nama_kota
FROM registrasi_user 
LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id
LEFT JOIN propinsi ON registrasi_user.id_prov = propinsi.id_prop
LEFT JOIN kota ON registrasi_user.id_kota = kota.id_kota AND registrasi_user.id_prov =kota.id_prop
WHERE 1=1 ".$var_kategori." ".$var_where." ".$var_extra." ");
		return $sql->result_array();
	}
	
	
	
	function get_kirim_pesan($id=NULL)
	{

		$sql = $this->db->query(" SELECT message.*,tujuan.nama_lengkap AS nama_tujuan
		from message 
		LEFT JOIN registrasi_user tujuan ON message.id_tujuan =tujuan.id
		WHERE id_tujuan='".$id."'  ");

		return $sql->result_array();
	}
	
	function getinbox($id=NULL)
	{

		$sql = $this->db->query(" SELECT message.*,faskes.nama_lengkap
		from message 
		LEFT JOIN registrasi_user faskes ON message.id_faskes =faskes.id
		LEFT JOIN registrasi_user tujuan ON message.id_tujuan =tujuan.id
		WHERE id_tujuan='".$id."' ORDER BY dibaca ASC,id DESC ");

		return $sql->result_array();
	}
	
	function getoutbox($id=NULL)
	{

		$sql = $this->db->query(" SELECT message.*,tujuan.nama_lengkap
		from message 
		LEFT JOIN registrasi_user faskes ON message.id_faskes =faskes.id
		LEFT JOIN registrasi_user tujuan ON message.id_tujuan =tujuan.id
		WHERE id_faskes='".$id."'  ORDER BY dibaca ASC,id DESC ");

		return $sql->result_array();
	}
	
	function get_kota_by_prop($filters=NULL, $order=NULL)
	{

		$sql = $this->db->query(" SELECT * from kota   WHERE  ".$filters." ORDER BY ".$order." ");
		return $sql->result_array();
	}
	
	function get_kota_by_prop_new($filters=NULL, $order=NULL)
	{

		$sql = $this->db->query(" SELECT * from kab_kota   WHERE  ".$filters." ORDER BY ".$order." ");
		return $sql->result_array();
	}
	
	function get_kec_by_kota_prop($filters=NULL, $order=NULL)
	{

		$sql = $this->db->query(" SELECT * from kecamatan   WHERE  ".$filters." ORDER BY ".$order." ");
		return $sql->result_array();
	}
	
	function get_pelayanan_klniik($filters=NULL, $order=NULL)
	{

		$sql = $this->db->query(" SELECT * from master_klinik_pelayanan_klinik   WHERE  ".$filters." ORDER BY ".$order." ");
		return $sql->result_array();
	}
	
	function get_jenis_rs_kelas($filters=NULL, $order=NULL)
	{

		$sql = $this->db->query(" SELECT * from master_rs_kelas   WHERE  ".$filters." ORDER BY ".$order." ");
		return $sql->result_array();
	}
	
	function get_labkes_jenis_pelayanan($filters=NULL, $order=NULL)
	{

		$sql = $this->db->query(" SELECT * from master_labkes_jenis_pelayanan   WHERE  ".$filters." ORDER BY ".$order." ");
		return $sql->result_array();
	}
	
	function getlistpendaftarancount()
	{
		

		$sql = $this->db->query(" SELECT COUNT(*) AS jml FROM registrasi_user   WHERE 1=1  ");
		return $sql->result_array();
	}
	
	
	function getlistpendaftaran($id_kategori=NULL,$id_faskes=NULL,$id_kota=NULL,$id_prov=NULL)
	{
		
		if($id_kategori=='1'){
		$where ='';
		}else if($id_kategori=='3'){
		$where ='AND registrasi_user.id_kota ="'.$id_kota.'" ';
		}else if($id_kategori=='2'){
		$where ='AND registrasi_user.id_prov ="'.$id_prov.'" ';
		}else{
		$where ='';
		}
	   
		
		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan,(SELECT COUNT(*) AS jml FROM trans_final tf WHERE tf.id_faskes=registrasi_user.id AND tf.kode_faskes !='') AS jml,trans_final.kode_faskes  FROM registrasi_user 
		LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori 
		LEFT JOIN trans_final ON registrasi_user.id=trans_final.id_faskes 
		WHERE 1=1 AND registrasi_user.id_kategori IN('5') ".$where." ORDER BY registrasi_user.id DESC");
		return $sql->result_array();
	}
	
	function getlistpendaftaranlabkes($id_kategori=NULL,$id_faskes=NULL,$id_kota=NULL,$id_prov=NULL)
	{
		
		if($id_kategori=='1'){
		$where ='';
		}else if($id_kategori=='3'){
		$where ='AND registrasi_user.id_kota ="'.$id_kota.'" ';
		}else if($id_kategori=='2'){
		$where ='AND registrasi_user.id_prov ="'.$id_prov.'" ';
		}else{
		$where ='';
		}
	   
		
		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan,(SELECT COUNT(*) AS jml FROM trans_final tf WHERE tf.id_faskes=registrasi_user.id AND tf.kode_faskes !='') AS jml,trans_final.kode_faskes  FROM registrasi_user 
		LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori 
		LEFT JOIN trans_final ON registrasi_user.id=trans_final.id_faskes 
		WHERE 1=1 AND registrasi_user.id_kategori IN('7') ".$where." ORDER BY registrasi_user.id DESC");
		return $sql->result_array();
	}
	
	
	function getlistpendaftaranrs($id_kategori=NULL,$id_faskes=NULL,$id_kota=NULL,$id_prov=NULL)
	{
		
		if($id_kategori=='1'){
		$where ='';
		}else if($id_kategori=='3'){
		$where ='AND registrasi_user.id_kota ="'.$id_kota.'" ';
		}else if($id_kategori=='2'){
		$where ='AND registrasi_user.id_prov ="'.$id_prov.'" ';
		}else{
		$where ='';
		}
	   
		
		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan,(SELECT COUNT(*) AS jml FROM trans_final tf WHERE tf.id_faskes=registrasi_user.id AND tf.kode_faskes !='') AS jml,trans_final.kode_faskes  FROM registrasi_user 
		LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori 
		LEFT JOIN trans_final ON registrasi_user.id=trans_final.id_faskes 
		WHERE 1=1 AND registrasi_user.id_kategori IN('4') ".$where." ORDER BY registrasi_user.id DESC");
		return $sql->result_array();
	}
	
	function getlistpendaftaranutd($id_kategori=NULL,$id_faskes=NULL,$id_kota=NULL,$id_prov=NULL)
	{
		
		if($id_kategori=='1'){
		$where ='';
		}else if($id_kategori=='3'){
		$where ='AND registrasi_user.id_kota ="'.$id_kota.'" ';
		}else if($id_kategori=='2'){
		$where ='AND registrasi_user.id_prov ="'.$id_prov.'" ';
		}else{
		$where ='';
		}
	   
		
		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan,(SELECT COUNT(*) AS jml FROM trans_final tf WHERE tf.id_faskes=registrasi_user.id AND tf.kode_faskes !='') AS jml,trans_final.kode_faskes  FROM registrasi_user 
		LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori 
		LEFT JOIN trans_final ON registrasi_user.id=trans_final.id_faskes 
		WHERE 1=1 AND registrasi_user.id_kategori IN('6') ".$where." ORDER BY registrasi_user.id DESC");
		return $sql->result_array();
	}

	function getlistpendaftaranpm($id_kategori=NULL,$id_faskes=NULL,$id_kota=NULL,$id_prov=NULL)
	{
		
		if($id_kategori=='1'){
		$where ='';
		}else if($id_kategori=='3'){
		$where ='AND registrasi_user.id_kota ="'.$id_kota.'" ';
		}else if($id_kategori=='2'){
		$where ='AND registrasi_user.id_prov ="'.$id_prov.'" ';
		}else{
		$where ='';
		}
	   
		
		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan,(SELECT COUNT(*) AS jml FROM trans_final tf WHERE tf.id_faskes=registrasi_user.id AND tf.kode_faskes !='') AS jml,trans_final.kode_faskes  FROM registrasi_user 
		LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori 
		LEFT JOIN trans_final ON registrasi_user.id=trans_final.id_faskes 
		WHERE 1=1 AND registrasi_user.id_kategori IN('9') ".$where." ORDER BY registrasi_user.id DESC");
		return $sql->result_array();
	}
	
	
	
	function getbylistpendaftaran($id=NULL)
	{
	
		     
		
		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan,propinsi.nama_prop,kota.nama_kota,data_klinik.nama_klinik,kategori.jenis_satker,data_klinik.jenis_klinik AS jenis_klinik_data_klinik,data_labkes.nama_lab,data_labkes.jenis_lab,data_rs.nama_rs,data_rs.jenis_rs,data_rs.nama_direktur,data_rs.alamat_faskes AS alamat_rs,data_rs.no_telp AS no_telp_rs,data_rs.email AS email_rs,data_rs.website AS website_rs,data_rs.luas_tanah AS luas_tanah_rs,data_rs.luas_bangunan AS luas_bangunan_rs,data_rs.nomor_surat_izin_usaha AS nomor_surat_izin_usaha_rs,data_rs.tanggal_surat_izin_usaha AS tanggal_surat_izin_usaha_rs,data_rs.tanggal_berlaku_surat_izin_usaha AS tanggal_berlaku_surat_izin_usaha_rs,data_rs.tahun_berdiri AS tahun_berdiri_rs,data_rs.status_blu AS status_blu_rs,data_rs.simrs AS simrs,data_rs.nama_penyelenggara,data_rs.kelas,master_rs_kepemilikan.kepemilikan AS nama_kepemilikan,data_rs.kepemilikan,data_utd.nama_utd,data_utd.jenis_utd,data_pm.nama_pm,data_pm.id_kategori AS jenis_tpmd
		FROM registrasi_user LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori 
		LEFT JOIN propinsi ON propinsi.id_prop=registrasi_user.id_prov 
		LEFT JOIN kota ON kota.id_prop=registrasi_user.id_prov AND kota.id_kota = registrasi_user.id_kota
		LEFT JOIN data_klinik ON data_klinik.id_faskes=registrasi_user.id 
		LEFT JOIN data_labkes ON data_labkes.id_faskes=registrasi_user.id 
		LEFT JOIN data_rs ON data_rs.id_faskes=registrasi_user.id 
		LEFT JOIN data_utd ON data_utd.id_faskes=registrasi_user.id 
		LEFT JOIN data_pm ON data_pm.id_faskes=registrasi_user.id 
		LEFT JOIN master_rs_kepemilikan ON data_rs.kepemilikan=master_rs_kepemilikan.id 
		WHERE 1=1  AND registrasi_user.id='".$id."'  ");
		return $sql->result_array();
	}
	
	function getdataklinik($user_id=NULL)
	{
	
	 
			$raw_user_id=" and data_klinik.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT data_klinik.*,propinsi.kode_regional FROM data_klinik  LEFT JOIN propinsi ON data_klinik.id_prov = propinsi.id_prop WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	function getdatalabkes($user_id=NULL)
	{
	
	 
			$raw_user_id=" and data_labkes.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT data_labkes.*,propinsi.kode_regional FROM data_labkes
              LEFT JOIN propinsi ON data_labkes.id_prov = propinsi.id_prop WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	function getdatars($user_id=NULL)
	{
	
	 
			$raw_user_id=" and data_rs.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT data_rs.*,propinsi.kode_regional FROM data_rs  LEFT JOIN propinsi ON data_rs.id_prov = propinsi.id_prop WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	function getdatautd($user_id=NULL)
	{
	
	 
			$raw_user_id=" and data_utd.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT data_utd.*,propinsi.kode_regional FROM data_utd  LEFT JOIN propinsi ON data_utd.id_prov = propinsi.id_prop WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	function getdatasarprasalkesklinik($user_id=NULL)
	{
	
	 
			$raw_user_id=" and trans_sarpras_alkes_klinik.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT trans_sarpras_alkes_klinik.* FROM trans_sarpras_alkes_klinik  WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	
	
	function getdatasarprasalkeslabkes($user_id=NULL)
	{
	
	 
			$raw_user_id=" and trans_labkes_sarpras_alkes.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT trans_labkes_sarpras_alkes.* FROM trans_labkes_sarpras_alkes  WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	function getdatasarprasalkesutd($user_id=NULL)
	{
	
	 
			$raw_user_id=" and trans_utd_sarpras_alkes.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT trans_utd_sarpras_alkes.* FROM trans_utd_sarpras_alkes  WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	function getdataalkesutd($user_id=NULL)
	{
	
	 
			$raw_user_id=" and trans_utd_alkes.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT trans_utd_alkes.* FROM trans_utd_alkes  WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	function getdatasdmklinik($user_id=NULL)
	{
	
	 
			$raw_user_id=" and trans_sdm.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT trans_sdm.* FROM trans_sdm  WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	function getdatasdmlabkes($user_id=NULL)
	{
	
	 
			$raw_user_id=" and trans_labkes_sdm.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT trans_labkes_sdm.*,data_sdm_labkes_jabatan.jabatan,data_sdm_labkes_pendidikan.pendidikan FROM trans_labkes_sdm 
		LEFT JOIN data_sdm_labkes_jabatan ON trans_labkes_sdm.id_jabatan = data_sdm_labkes_jabatan.id
		LEFT JOIN data_sdm_labkes_pendidikan ON trans_labkes_sdm.id_pendidikan= data_sdm_labkes_pendidikan.id
		WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	function getdatasdmrs($user_id=NULL)
	{
	
	 
			$raw_user_id=" and trans_sdm_rs.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT trans_sdm_rs.* FROM trans_sdm_rs  WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	function getdatasdmutd($user_id=NULL)
	{
	
	 
			$raw_user_id=" and trans_sdm_utd.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT trans_sdm_utd.* FROM trans_sdm_utd  WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	function getdatattrs($user_id=NULL)
	{
	
	 
			$raw_user_id=" and trans_tt_rs.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT trans_tt_rs.* FROM trans_tt_rs  WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	function getdatapelayananrs($user_id=NULL)
	{
	
	 
			$raw_user_id=" and trans_pelayanan_rs.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT trans_pelayanan_rs.* FROM trans_pelayanan_rs  WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	function getdatajenispemeriksaanlabkes($user_id=NULL)
	{
		$raw_user_id=" and trans_labkes_jenis_pemeriksaan.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT trans_labkes_jenis_pemeriksaan.* FROM trans_labkes_jenis_pemeriksaan 
		WHERE 1=1 ".$raw_user_id." ");
        //echo $this->db->last_query();
		return $sql->result_array();
	}
	
	function getdetaildatajenispemeriksaanlabkes($id_jenis_pemeriksaan=NULL)
	{
	   
		$raw_user_id=" and trans_labkes_jenis_pemeriksaan.id='".$id_jenis_pemeriksaan."' ";
		$sql = $this->db->query("SELECT trans_labkes_jenis_pemeriksaan.* FROM trans_labkes_jenis_pemeriksaan 
		WHERE 1=1 ".$raw_user_id." ");
        //echo $this->db->last_query();
		return $sql->result_array();
	}
	
	
	function getdatauser($user_id=NULL)
	{
	
	 
			$raw_user_id=" and registrasi_user.id='".$user_id."' ";

		$sql = $this->db->query("SELECT registrasi_user.* FROM registrasi_user  WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	function getlisttimeline($id_kategori=NULL,$id_faskes=NULL,$id_kota=NULL,$id_prov=NULL,$type_user=NULL)
	{
			
		if($type_user=='Admin'){
			$sraw='';
		}else if($type_user=='RS'){
			$sraw=' AND registrasi_user.id_kategori ="4" ';
		}else if($type_user=='UTD'){
			$sraw=' AND registrasi_user.id_kategori ="6" ';
		}else if($type_user=='Klinik'){
			$sraw=' AND registrasi_user.id_kategori ="5" ';
		}else if($type_user=='Labkes'){
			$sraw=' AND registrasi_user.id_kategori ="7" ';
		}else if($type_user=='Praktik Mandiri'){
			$sraw=' AND registrasi_user.id_kategori ="9" ';
		}else{
			$sraw=' ';
		}
	
		if($id_kategori=='1'){
		$where ='';
		}else if($id_kategori=='3'){
		$where ='AND registrasi_user.id_kota ="'.$id_kota.'" ';
		}else if($id_kategori=='2'){
		$where ='AND registrasi_user.id_prov ="'.$id_prov.'" ';
		}else{
		$where ='AND registrasi_user.id="'.$id_faskes.'"';
		}


		$sql = $this->db->query("
		SELECT 
		registrasi_user.id,
		registrasi_user.email,
		registrasi_user.nama_lengkap,
		kategori.keterangan,
		kategori.kategori_user,
		registrasi_user.id AS id_faskes ,data_klinik.nama_klinik,data_klinik.alamat_faskes,propinsi.nama_prop,kota.nama_kota
		FROM registrasi_user 
		INNER JOIN data_klinik ON data_klinik.id_faskes=registrasi_user.id 
		LEFT JOIN propinsi ON registrasi_user.id_prov=propinsi.id_prop
		LEFT JOIN kota ON registrasi_user.id_prov=kota.id_prop AND kota.id_kota=registrasi_user.id_kota
		LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori 
		WHERE 1=1  ".$where.$sraw."  
		UNION ALL
		SELECT 
		registrasi_user.id,
		registrasi_user.email,
		registrasi_user.nama_lengkap,
		kategori.keterangan,
		kategori.kategori_user,
		registrasi_user.id AS id_faskes ,data_rs.nama_rs AS nama_klinik,data_rs.alamat_faskes,propinsi.nama_prop,kota.nama_kota
		FROM registrasi_user 
		INNER JOIN data_rs ON data_rs.id_faskes=registrasi_user.id 
		LEFT JOIN propinsi ON registrasi_user.id_prov=propinsi.id_prop
		LEFT JOIN kota ON registrasi_user.id_prov=kota.id_prop AND kota.id_kota=registrasi_user.id_kota
		LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori 
		WHERE 1=1  ".$where.$sraw."  
		UNION ALL
		SELECT 
		registrasi_user.id,
		registrasi_user.email,
		registrasi_user.nama_lengkap,
		kategori.keterangan,
		kategori.kategori_user,
		registrasi_user.id AS id_faskes ,data_utd.nama_utd AS nama_klinik,data_utd.alamat_faskes,propinsi.nama_prop,kota.nama_kota
		FROM registrasi_user 
		INNER JOIN data_utd ON data_utd.id_faskes=registrasi_user.id 
		LEFT JOIN propinsi ON registrasi_user.id_prov=propinsi.id_prop
		LEFT JOIN kota ON registrasi_user.id_prov=kota.id_prop AND kota.id_kota=registrasi_user.id_kota
		LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori 
		WHERE 1=1  ".$where.$sraw."  	
		UNION ALL
		SELECT 
		registrasi_user.id,
		registrasi_user.email,
		registrasi_user.nama_lengkap,
		kategori.keterangan,
		kategori.kategori_user,
		registrasi_user.id AS id_faskes ,data_labkes.nama_lab AS nama_klinik,data_labkes.alamat_faskes,propinsi.nama_prop,kota.nama_kota
		FROM registrasi_user 
		INNER JOIN data_labkes ON data_labkes.id_faskes=registrasi_user.id 
		LEFT JOIN propinsi ON registrasi_user.id_prov=propinsi.id_prop
		LEFT JOIN kota ON registrasi_user.id_prov=kota.id_prop AND kota.id_kota=registrasi_user.id_kota
		LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori 
		WHERE 1=1  ".$where.$sraw." 
		UNION ALL
		SELECT 
		registrasi_user.id,
		registrasi_user.email,
		registrasi_user.nama_lengkap,
		kategori.keterangan,
		kategori.kategori_user,
		registrasi_user.id AS id_faskes ,data_pm.nama_pm AS nama_klinik,data_pm.alamat_faskes,propinsi.nama_prop,kota.nama_kota
		FROM registrasi_user 
		INNER JOIN data_pm ON data_pm.id_faskes=registrasi_user.id 
		LEFT JOIN propinsi ON registrasi_user.id_prov=propinsi.id_prop
		LEFT JOIN kota ON registrasi_user.id_prov=kota.id_prop AND kota.id_kota=registrasi_user.id_kota
		LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori 
		WHERE 1=1  ".$where.$sraw." 
	
		ORDER BY id DESC		");
		return $sql->result_array();
	}
	
	function getbytimeline($user_id=null)
	{
     	$raw_user_id=" and timeline.id_faskes='".$user_id."' ";
	

		$sql = $this->db->query("SELECT timeline.*,registrasi_user.email,registrasi_user.nama_lengkap,kategori.keterangan,kategori.kategori_user,registrasi_user.id AS id_faskes 
		FROM timeline LEFT JOIN registrasi_user ON timeline.id_faskes = registrasi_user.id LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori WHERE 1=1 ".$raw_user_id."  ORDER BY timeline.id DESC ");
		return $sql->result_array();
	}
	
	
	
	
	function getlistpengajuan($id_kategori=null,$id_kota=NULL)
	{
	if($id_kategori=='1'){
		$where =' AND registrasi_user.id_kategori="5"';
	}else{
		$where =' AND trans_final.id_link="'.$id_kota.'" AND registrasi_user.id_kategori="5"';
	}
	

		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan ,trans_final.token_kode_faskes,trans_final.kode_faskes,data_klinik.nama_klinik,data_klinik.alamat_faskes,data_klinik.persalinan,data_klinik.status_klinik,data_klinik.alasan_status_klinik
		FROM trans_final 
		LEFT JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_klinik ON data_klinik.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		WHERE trans_final.final='1' AND trans_final.kode_faskes!='' AND pma !='Penanaman Modal Asing' ".$where." AND registrasi_user.id IS NOT NULL ORDER BY registrasi_user.id DESC LImit 0,1000");
		return $sql->result_array();
	}
	
	function getlistpengajuanlabkes($id_kategori=null,$id_kota=NULL)
	{
	if($id_kategori=='1'){
		$where =' AND registrasi_user.id_kategori="7"';
	}else{
		$where ='AND trans_final.id_link="'.$id_kota.'" AND registrasi_user.id_kategori="7"';
	}
	

		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan ,trans_final.token_kode_faskes,trans_final.kode_faskes,data_klinik.nama_klinik,data_klinik.alamat_faskes
		FROM trans_final 
		LEFT JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_klinik ON data_klinik.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		WHERE trans_final.final='1' AND trans_final.kode_faskes!='' AND pma !='Penanaman Modal Asing'".$where." AND registrasi_user.id IS NOT NULL");
		return $sql->result_array();
	}
	
	function getlistpengajuanbelumvalidasi($id_kategori=null,$id_kota=NULL)
	{
	if($id_kategori=='1'){
		$where =' AND registrasi_user.id_kategori="5"';
	}else{
		$where ='AND trans_final.id_link="'.$id_kota.'" AND registrasi_user.id_kategori="5"';
	}
	

		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan ,trans_final.token_kode_faskes,trans_final.kode_faskes,data_klinik.nama_klinik,data_klinik.alamat_faskes,data_klinik.persalinan
		FROM trans_final 
		LEFT JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_klinik ON data_klinik.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		WHERE trans_final.final='1' AND (trans_final.kode_faskes='' || trans_final.kode_faskes IS NULL) AND pma !='Penanaman Modal Asing'".$where." AND registrasi_user.id IS NOT NULL");
		return $sql->result_array();
	}
	
	function getlistpengajuanbelumvalidasilabkes($id_kategori=null,$id_kota=NULL)
	{
	if($id_kategori=='1'){
		$where =' AND registrasi_user.id_kategori="7"';
	}else{
		$where ='AND trans_final.id_link="'.$id_kota.'" AND registrasi_user.id_kategori="7"';
	}
	

		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan ,trans_final.token_kode_faskes,trans_final.kode_faskes,data_labkes.nama_lab,data_labkes.alamat_faskes
		FROM trans_final 
		LEFT JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_labkes ON data_labkes.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		WHERE trans_final.final='1' AND (trans_final.kode_faskes='' || trans_final.kode_faskes IS NULL) AND pma !='Penanaman Modal Asing'".$where." AND registrasi_user.id IS NOT NULL");
		return $sql->result_array();
	}
	
	function getlistpengajuanbelumvalidasiperbaikan($id_kategori=null,$id_kota=NULL)
	{
	if($id_kategori=='1'){
		$where =' AND registrasi_user.id_kategori="5"';
	}else{
		$where ='AND trans_final.id_link="'.$id_kota.'" AND registrasi_user.id_kategori="5"';
	}


		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan ,trans_final.token_kode_faskes,trans_final.kode_faskes,data_klinik.nama_klinik,data_klinik.alamat_faskes,data_klinik.persalinan
		FROM trans_final 
		LEFT JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_klinik ON data_klinik.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		WHERE trans_final.catatan !='' AND (trans_final.kode_faskes='' || trans_final.kode_faskes IS NULL)  AND pma !='Penanaman Modal Asing'".$where." AND registrasi_user.id IS NOT NULL");
		return $sql->result_array();
	}
	
	function getlistpengajuanbelumvalidasiperbaikanlabkes($id_kategori=null,$id_kota=NULL)
	{
	if($id_kategori=='1'){
		$where =' AND registrasi_user.id_kategori="7"';
	}else{
		$where ='AND trans_final.id_link="'.$id_kota.'" AND registrasi_user.id_kategori="7"';
	}


		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan ,trans_final.token_kode_faskes,trans_final.kode_faskes,data_klinik.nama_klinik,data_klinik.alamat_faskes
		FROM trans_final 
		LEFT JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_klinik ON data_klinik.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		WHERE trans_final.catatan !='' AND (trans_final.kode_faskes='' || trans_final.kode_faskes IS NULL)  AND pma !='Penanaman Modal Asing'".$where." AND registrasi_user.id IS NOT NULL");
		return $sql->result_array();
	}
	
	
	
	function getlistpengajuanpma($id_kategori=null,$id_kota=NULL)
	{
	if($id_kategori=='1'){
		$where ='';
	}else{
		$where ='AND trans_final.id_link="'.$id_kota.'"';
	}

		

		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan,trans_final.token_kode_faskes,trans_final.kode_faskes,data_klinik.nama_klinik,data_klinik.alamat_faskes,data_klinik.status_klinik,data_klinik.alasan_status_klinik
		FROM trans_final 
		LEFT JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_klinik ON data_klinik.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		WHERE trans_final.final='1'  AND trans_final.kode_faskes!='' AND pma ='Penanaman Modal Asing'".$where." AND registrasi_user.id IS NOT NULL");
		return $sql->result_array();
	}
	
	
		function getlistpengajuanpmabelumvalidasi($id_kategori=null,$id_kota=NULL)
	{
	if($id_kategori=='1'){
		$where =' AND registrasi_user.id_kategori="5"';
	}else{
		$where ='AND trans_final.id_link="'.$id_kota.'" AND registrasi_user.id_kategori="5"';
	}
	

		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan ,trans_final.token_kode_faskes,trans_final.kode_faskes,data_klinik.nama_klinik,data_klinik.alamat_faskes
		FROM trans_final 
		LEFT JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_klinik ON data_klinik.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		WHERE trans_final.final='1' AND (trans_final.kode_faskes='' || trans_final.kode_faskes IS NULL) AND pma ='Penanaman Modal Asing'".$where." AND registrasi_user.id IS NOT NULL");
		return $sql->result_array();
	}
	
	
	function getlistpengajuanpmabelumvalidasiperbaikan($id_kategori=null,$id_kota=NULL)
	{
	if($id_kategori=='1'){
		$where =' AND registrasi_user.id_kategori="5"';
	}else{
		$where ='AND trans_final.id_link="'.$id_kota.'" AND registrasi_user.id_kategori="5"';
	}


		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan ,trans_final.token_kode_faskes,trans_final.kode_faskes,data_klinik.nama_klinik,data_klinik.alamat_faskes
		FROM trans_final 
		LEFT JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_klinik ON data_klinik.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		WHERE trans_final.catatan !='' AND (trans_final.kode_faskes='' || trans_final.kode_faskes IS NULL) AND pma ='Penanaman Modal Asing'".$where." AND registrasi_user.id IS NOT NULL");
		return $sql->result_array();
	}
	
    function findNoFaskes($kode_regional_link=NULL,$kategori=NULL) {	
		//$kategori='5';
		$kode_umum='1';
	if($kategori=='7'){
		$rincian_jenis_fasyankes="6";
	}else if($kategori=='6'){
		$rincian_jenis_fasyankes="5";
	}else if($kategori=='5'){
		$rincian_jenis_fasyankes="2";
	}else{
		$rincian_jenis_fasyankes="x";
	}
	
		$prefix2=$rincian_jenis_fasyankes.$kode_regional_link;
		$sql = $this->db->query("SELECT MAX(RIGHT(kode_faskes, 4)) AS kode_faskes FROM trans_final WHERE kode_regional_link ='".$kode_regional_link."' AND SUBSTRING(kode_faskes, 2, 1)='".$rincian_jenis_fasyankes."'");
		if ($sql->num_rows() > 0) {
			$rs = $sql->result_array();
			$str = $rs[0]['kode_faskes'] + 1;
			return $kode_umum.(string) $prefix2 . str_pad($str, 4, "0", STR_PAD_LEFT);
		} else {
			return $kode_umum.(string) $prefix2 . str_pad('1', 4, "0", STR_PAD_LEFT);
		}
	}
	
	function findNoFaskesRS($id_link=NULL,$kategori,$kelas) {	


       if($kelas=='6'){
		  $kelas_new='S'; 
	   }else{
		  $kelas_new=''; 
	   }
		$sql = $this->db->query("SELECT MAX(RIGHT(CAST(kode_faskes AS UNSIGNED), 3)) AS kode_faskes FROM trans_final,registrasi_user WHERE registrasi_user.id=trans_final.id_faskes AND id_link ='".$id_link."'  AND registrasi_user.id_kategori='".$kategori."'");
			
		$sql2 = $this->db->query("SELECT RIGHT(kode_terakhir_rs, 3) AS kode_terakhir_rs,link FROM kab_kota_new WHERE link_pusdatin ='".$id_link."' ");
			$rs = $sql->result_array();
			$rs2 = $sql2->result_array();
		if (!empty($rs[0]['kode_faskes'])) {
			
			$str = $rs[0]['kode_faskes'] + 1;
			return $rs2[0]['link'].str_pad($str, 3, "0", STR_PAD_LEFT).$kelas_new;
		} else {
			
			
			$str2 = $rs2[0]['kode_terakhir_rs'] + 1;

			return $rs2[0]['link'].str_pad($str2, 3, "0", STR_PAD_LEFT).$kelas_new;
		}
	}
	
	
	function getrekap_data($tgl1=null,$tgl2=NULL,$id_prov=NULL,$id_kota=NULL,$id_kategori=NULL,$jenis_klinik=NULL,$jenis_perawatan=NULL,$persalinan=NULL,$sorting=NULL,$type_sorting=NULL)
	{
	
		/* if(empty($tgl1) && empty($tgl2)){
		$filter_tanggal="";
		}else{
		$filter_tanggal="AND registrasi_user.tgl_buat_user BETWEEN '".date("Y-m-d",strtotime($tgl1))." 00:00:00' AND '".date("Y-m-d",strtotime($tgl2))." 23:59:59' ";
		}   	 */
		
		if(!empty($id_prov) && $id_prov !=9999){
			$prov=" AND registrasi_user.id_prov = '".$id_prov."'";
		}else{
			$prov="";
		}
		
		if(!empty($id_kota) && $id_kota !=9999){
			$kota=" AND registrasi_user.id_kota = '".$id_kota."'";
		}else{
			$kota="";
		}
		
		if(!empty($id_kategori) && $id_kategori !=9999){
			$kategori=" AND registrasi_user.id_kategori = '".$id_kategori."'";
		}else{
			$kategori=" AND registrasi_user.id_kategori = '5'";
		}
		
		if(!empty($jenis_klinik) && $jenis_klinik !=9999){
			$jenis_klinik=" AND data_klinik.jenis_klinik = '".$jenis_klinik."'";
		}else{
			$jenis_klinik="";
		}
		
		if(!empty($jenis_perawatan) && $jenis_perawatan !=9999){
			$jenis_perawatan=" AND data_klinik.jenis_perawatan = '".$jenis_perawatan."'";
		}else{
			$jenis_perawatan="";
		}
		
		if(!empty($persalinan) && $persalinan !=9999){
			$persalinan=" AND data_klinik.persalinan = '".$persalinan."'";
		}else{
			$persalinan="";
		}
		
		if(!empty($sorting) && $sorting !=9999){
			$sorting=$sorting." ".$type_sorting;
		}else{
			$sorting=" kode_faskes ".$type_sorting."";
		}

 
		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan,trans_final.token_kode_faskes,trans_final.kode_faskes,data_klinik.nama_klinik,data_klinik.alamat_faskes,data_klinik.alamat_faskes,propinsi.nama_prop,kota.nama_kota,data_klinik.no_telp,data_klinik.email AS email_klinik,data_klinik.jenis_klinik AS jenis_klinik_terbaru,data_klinik.jenis_perawatan AS jenis_perawatan_terbaru,data_klinik.persalinan,trans_final.create_kode
		FROM trans_final 
		INNER JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_klinik ON data_klinik.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		LEFT JOIN propinsi ON propinsi.id_prop=registrasi_user.id_prov 
		LEFT JOIN kota ON kota.id_prop=registrasi_user.id_prov AND kota.id_kota = registrasi_user.id_kota
		WHERE 1=1 ".$prov.$kota.$kategori.$jenis_klinik.$jenis_perawatan.$persalinan." AND trans_final.kode_faskes !='' ORDER BY 
		".$sorting." 
		");
		
	
		return $sql->result_array();
	}
	
	
	function getrekap_data_lab($tgl1=null,$tgl2=NULL,$id_prov=NULL,$id_kota=NULL,$id_kategori=NULL)
	{
	
		/* if(empty($tgl1) && empty($tgl2)){
		$filter_tanggal="";
		}else{
		$filter_tanggal="AND registrasi_user.tgl_buat_user BETWEEN '".date("Y-m-d",strtotime($tgl1))." 00:00:00' AND '".date("Y-m-d",strtotime($tgl2))." 23:59:59' ";
		}   	 */
		
		if(!empty($id_prov) && $id_prov !=9999){
			$prov=" AND registrasi_user.id_prov = '".$id_prov."'";
		}else{
			$prov="";
		}
		
		if(!empty($id_kota) && $id_kota !=9999){
			$kota=" AND registrasi_user.id_kota = '".$id_kota."'";
		}else{
			$kota="";
		}
		
		if(!empty($id_kategori) && $id_kategori !=9999){
			$kategori=" AND registrasi_user.id_kategori = '".$id_kategori."'";
		}else{
			$kategori=" AND registrasi_user.id_kategori = '7'";
		}

		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan,trans_final.token_kode_faskes,trans_final.kode_faskes,data_labkes.nama_lab,data_labkes.alamat_faskes,propinsi.nama_prop,kota.nama_kota,data_labkes.no_telp,data_labkes.email AS email_lab,data_labkes.jenis_lab,data_labkes.bentuk_lab
		FROM trans_final 
		INNER JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_labkes ON data_labkes.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		LEFT JOIN propinsi ON propinsi.id_prop=registrasi_user.id_prov 
		LEFT JOIN kota ON kota.id_prop=registrasi_user.id_prov AND kota.id_kota = registrasi_user.id_kota
		WHERE 1=1 ".$prov.$kota.$kategori." AND trans_final.kode_faskes !='' ORDER BY trans_final.kode_faskes DESC
		");
		return $sql->result_array();
	}
	
	
	function getrekap_data_rs($tgl1=null,$tgl2=NULL,$id_prov=NULL,$id_kota=NULL,$id_kategori=NULL)
	{
	
		/* if(empty($tgl1) && empty($tgl2)){
		$filter_tanggal="";
		}else{
		$filter_tanggal="AND registrasi_user.tgl_buat_user BETWEEN '".date("Y-m-d",strtotime($tgl1))." 00:00:00' AND '".date("Y-m-d",strtotime($tgl2))." 23:59:59' ";
		}   	 */
		
		if(!empty($id_prov) && $id_prov !=9999){
			$prov=" AND registrasi_user.id_prov = '".$id_prov."'";
		}else{
			$prov="";
		}
		
		if(!empty($id_kota) && $id_kota !=9999){
			$kota=" AND registrasi_user.id_kota = '".$id_kota."'";
		}else{
			$kota="";
		}
		
		if(!empty($id_kategori) && $id_kategori !=9999){
			$kategori=" AND registrasi_user.id_kategori = '".$id_kategori."'";
		}else{
			$kategori=" AND registrasi_user.id_kategori = '4'";
		}

		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan,trans_final.token_kode_faskes,trans_final.kode_faskes,data_rs.nama_rs,data_rs.alamat_faskes,propinsi.nama_prop,kota.nama_kota,data_rs.no_telp,data_rs.email AS email_rs,master_rs_jenis.jenis AS jenis_rs
		FROM trans_final 
		INNER JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_rs ON data_rs.id_faskes=registrasi_user.id 
		LEFT JOIN master_rs_jenis ON data_rs.jenis_rs=master_rs_jenis.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		LEFT JOIN propinsi ON propinsi.id_prop=registrasi_user.id_prov 
		LEFT JOIN kota ON kota.id_prop=registrasi_user.id_prov AND kota.id_kota = registrasi_user.id_kota
		WHERE 1=1 ".$prov.$kota.$kategori." AND trans_final.kode_faskes !='' ORDER BY trans_final.kode_faskes DESC
		");
		return $sql->result_array();
	}
	
	function getrekap_data_utd($tgl1=null,$tgl2=NULL,$id_prov=NULL,$id_kota=NULL,$id_kategori=NULL)
	{
	
		/* if(empty($tgl1) && empty($tgl2)){
		$filter_tanggal="";
		}else{
		$filter_tanggal="AND registrasi_user.tgl_buat_user BETWEEN '".date("Y-m-d",strtotime($tgl1))." 00:00:00' AND '".date("Y-m-d",strtotime($tgl2))." 23:59:59' ";
		}   	 */
		
		if(!empty($id_prov) && $id_prov !=9999){
			$prov=" AND registrasi_user.id_prov = '".$id_prov."'";
		}else{
			$prov="";
		}
		
		if(!empty($id_kota) && $id_kota !=9999){
			$kota=" AND registrasi_user.id_kota = '".$id_kota."'";
		}else{
			$kota="";
		}
		
		if(!empty($id_kategori) && $id_kategori !=9999){
			$kategori=" AND registrasi_user.id_kategori = '".$id_kategori."'";
		}else{
			$kategori=" AND registrasi_user.id_kategori = '6'";
		}

		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan,trans_final.token_kode_faskes,trans_final.kode_faskes,data_utd.nama_utd,data_utd.alamat_faskes,propinsi.nama_prop,kota.nama_kota,data_utd.no_telp,data_utd.email AS email_utd,data_utd.jenis_utd ,data_utd.status_kepemilikan,data_utd.nama_kepala_utd
		FROM trans_final 
		INNER JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_utd ON data_utd.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		LEFT JOIN propinsi ON propinsi.id_prop=registrasi_user.id_prov 
		LEFT JOIN kota ON kota.id_prop=registrasi_user.id_prov AND kota.id_kota = registrasi_user.id_kota
		WHERE 1=1 ".$prov.$kota.$kategori." AND trans_final.kode_faskes !='' ORDER BY trans_final.kode_faskes DESC
		");
		return $sql->result_array();
	}
	
	function getrekap_data_pm($tgl1=null,$tgl2=NULL,$id_prov=NULL,$id_kota=NULL,$id_kategori=NULL)
	{
	
		/* if(empty($tgl1) && empty($tgl2)){
		$filter_tanggal="";
		}else{
		$filter_tanggal="AND registrasi_user.tgl_buat_user BETWEEN '".date("Y-m-d",strtotime($tgl1))." 00:00:00' AND '".date("Y-m-d",strtotime($tgl2))." 23:59:59' ";
		}   	 */
		
		if(!empty($id_prov) && $id_prov !=9999){
			$prov=" AND registrasi_user.id_prov = '".$id_prov."'";
		}else{
			$prov="";
		}
		
		if(!empty($id_kota) && $id_kota !=9999){
			$kota=" AND registrasi_user.id_kota = '".$id_kota."'";
		}else{
			$kota="";
		}
		
		if(!empty($id_kategori) && $id_kategori !=9999){
			$kategori=" AND registrasi_user.id_kategori = '".$id_kategori."'";
		}else{
			$kategori=" AND registrasi_user.id_kategori = '9'";
		}

		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan,trans_final.token_kode_faskes,trans_final.kode_faskes,data_pm.nama_pm,data_pm.alamat_faskes,propinsi.nama_prop,kota.nama_kota,data_pm.no_telp,data_pm.email AS email_pm
		FROM trans_final 
		INNER JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_pm ON data_pm.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		LEFT JOIN propinsi ON propinsi.id_prop=registrasi_user.id_prov 
		LEFT JOIN kota ON kota.id_prop=registrasi_user.id_prov AND kota.id_kota = registrasi_user.id_kota
		WHERE 1=1 ".$prov.$kota.$kategori." AND trans_final.kode_faskes !='' ORDER BY trans_final.kode_faskes DESC
		");
		return $sql->result_array();
	}
	
	
	function monitoring_lab($tgl1=null,$tgl2=NULL,$id_prov=NULL,$id_kota=NULL,$id_kategori=NULL)
	{
	
		/* if(empty($tgl1) && empty($tgl2)){
		$filter_tanggal="";
		}else{
		$filter_tanggal="AND registrasi_user.tgl_buat_user BETWEEN '".date("Y-m-d",strtotime($tgl1))." 00:00:00' AND '".date("Y-m-d",strtotime($tgl2))." 23:59:59' ";
		}   	 */
		
		if(!empty($id_prov) && $id_prov !=9999){
			$prov=" AND registrasi_user.id_prov = '".$id_prov."'";
		}else{
			$prov="";
		}
		
		if(!empty($id_kota) && $id_kota !=9999){
			$kota=" AND registrasi_user.id_kota = '".$id_kota."'";
		}else{
			$kota="";
		}
		
		if(!empty($id_kategori) && $id_kategori !=9999){
			$kategori=" AND registrasi_user.id_kategori = '".$id_kategori."'";
		}else{
			$kategori=" AND registrasi_user.id_kategori = '7'";
		}

		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan,trans_final.token_kode_faskes,trans_final.kode_faskes,data_labkes.nama_lab,data_labkes.alamat_faskes,propinsi.nama_prop,kota.nama_kota,data_labkes.no_telp,data_labkes.email AS email_lab,data_labkes.jenis_lab,trans_final.status_validasi_kemkes,trans_final.status_validasi_prov,trans_final.status_validasi_kota
		FROM trans_final 
		INNER JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_labkes ON data_labkes.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		LEFT JOIN propinsi ON propinsi.id_prop=registrasi_user.id_prov 
		LEFT JOIN kota ON kota.id_prop=registrasi_user.id_prov AND kota.id_kota = registrasi_user.id_kota
		WHERE 1=1 ".$prov.$kota.$kategori."  ORDER BY trans_final.kode_faskes DESC
		");
		return $sql->result_array();
	}
	
	function monitoring_rs($tgl1=null,$tgl2=NULL,$id_prov=NULL,$id_kota=NULL,$id_kategori=NULL)
	{
	
		/* if(empty($tgl1) && empty($tgl2)){
		$filter_tanggal="";
		}else{
		$filter_tanggal="AND registrasi_user.tgl_buat_user BETWEEN '".date("Y-m-d",strtotime($tgl1))." 00:00:00' AND '".date("Y-m-d",strtotime($tgl2))." 23:59:59' ";
		}   	 */
		
		if(!empty($id_prov) && $id_prov !=9999){
			$prov=" AND registrasi_user.id_prov = '".$id_prov."'";
		}else{
			$prov="";
		}
		
		if(!empty($id_kota) && $id_kota !=9999){
			$kota=" AND registrasi_user.id_kota = '".$id_kota."'";
		}else{
			$kota="";
		}
		
		if(!empty($id_kategori) && $id_kategori !=9999){
			$kategori=" AND registrasi_user.id_kategori = '".$id_kategori."'";
		}else{
			$kategori=" AND registrasi_user.id_kategori = '4'";
		}

		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan,trans_final.token_kode_faskes,trans_final.kode_faskes,data_rs.nama_rs,data_rs.alamat_faskes,propinsi.nama_prop,kota.nama_kota,data_rs.no_telp,data_rs.email AS email_lab,trans_final.status_validasi_kemkes,trans_final.status_validasi_prov,trans_final.status_validasi_kota,master_rs_jenis.jenis AS jenis_rs
		FROM trans_final 
		INNER JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_rs ON data_rs.id_faskes=registrasi_user.id 
		LEFT JOIN master_rs_jenis ON data_rs.jenis_rs=master_rs_jenis.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		LEFT JOIN propinsi ON propinsi.id_prop=registrasi_user.id_prov 
		LEFT JOIN kota ON kota.id_prop=registrasi_user.id_prov AND kota.id_kota = registrasi_user.id_kota
		WHERE 1=1 ".$prov.$kota.$kategori."  ORDER BY trans_final.kode_faskes DESC
		");
		return $sql->result_array();
	}
	
	function monitoring_pm($tgl1=null,$tgl2=NULL,$id_prov=NULL,$id_kota=NULL,$id_kategori=NULL)
	{
	
		/* if(empty($tgl1) && empty($tgl2)){
		$filter_tanggal="";
		}else{
		$filter_tanggal="AND registrasi_user.tgl_buat_user BETWEEN '".date("Y-m-d",strtotime($tgl1))." 00:00:00' AND '".date("Y-m-d",strtotime($tgl2))." 23:59:59' ";
		}   	 */
		
		if(!empty($id_prov) && $id_prov !=9999){
			$prov=" AND registrasi_user.id_prov = '".$id_prov."'";
		}else{
			$prov="";
		}
		
		if(!empty($id_kota) && $id_kota !=9999){
			$kota=" AND registrasi_user.id_kota = '".$id_kota."'";
		}else{
			$kota="";
		}
		
		if(!empty($id_kategori) && $id_kategori !=9999){
			$kategori=" AND registrasi_user.id_kategori = '".$id_kategori."'";
		}else{
			$kategori=" AND registrasi_user.id_kategori = '9'";
		}

		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan,trans_final.token_kode_faskes,trans_final.kode_faskes,data_pm.nama_pm,data_pm.alamat_faskes,propinsi.nama_prop,kota.nama_kota,data_pm.no_telp,data_pm.email AS email_pm,trans_final.status_validasi_kemkes,trans_final.status_validasi_prov,trans_final.status_validasi_kota
		FROM trans_final 
		INNER JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_pm ON data_pm.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		LEFT JOIN propinsi ON propinsi.id_prop=registrasi_user.id_prov 
		LEFT JOIN kota ON kota.id_prop=registrasi_user.id_prov_pm AND kota.id_kota = registrasi_user.id_kota_pm
		WHERE 1=1 ".$prov.$kota.$kategori."  ORDER BY trans_final.kode_faskes DESC
		");
		return $sql->result_array();
	}
	
	
	function monitoring_utd($tgl1=null,$tgl2=NULL,$id_prov=NULL,$id_kota=NULL,$id_kategori=NULL)
	{
	
		/* if(empty($tgl1) && empty($tgl2)){
		$filter_tanggal="";
		}else{
		$filter_tanggal="AND registrasi_user.tgl_buat_user BETWEEN '".date("Y-m-d",strtotime($tgl1))." 00:00:00' AND '".date("Y-m-d",strtotime($tgl2))." 23:59:59' ";
		}   	 */
		
		if(!empty($id_prov) && $id_prov !=9999){
			$prov=" AND registrasi_user.id_prov = '".$id_prov."'";
		}else{
			$prov="";
		}
		
		if(!empty($id_kota) && $id_kota !=9999){
			$kota=" AND registrasi_user.id_kota = '".$id_kota."'";
		}else{
			$kota="";
		}
		
		if(!empty($id_kategori) && $id_kategori !=9999){
			$kategori=" AND registrasi_user.id_kategori = '".$id_kategori."'";
		}else{
			$kategori=" AND registrasi_user.id_kategori = '6'";
		}

		$sql = $this->db->query("SELECT registrasi_user.*,kategori.kategori_user,kategori.keterangan,trans_final.token_kode_faskes,trans_final.kode_faskes,data_utd.nama_utd,data_utd.alamat_faskes,propinsi.nama_prop,kota.nama_kota,data_utd.no_telp,data_utd.email AS email_utd,trans_final.status_validasi_kemkes,trans_final.status_validasi_prov,trans_final.status_validasi_kota,data_utd.jenis_utd
		FROM trans_final 
		INNER JOIN registrasi_user ON trans_final.id_faskes=registrasi_user.id 
		LEFT JOIN data_utd ON data_utd.id_faskes=registrasi_user.id 
		LEFT JOIN kategori ON registrasi_user.id_kategori=kategori.id 
		LEFT JOIN propinsi ON propinsi.id_prop=registrasi_user.id_prov 
		LEFT JOIN kota ON kota.id_prop=registrasi_user.id_prov AND kota.id_kota = registrasi_user.id_kota
		WHERE 1=1 ".$prov.$kota.$kategori."  ORDER BY trans_final.kode_faskes DESC
		");
		return $sql->result_array();
	}
	
	function getdata($id_kategori=NULL,$id_faskes=NULL,$id_kota=NULL,$id_prov=NULL,$type_user=NULL)
	{
	
		if($id_kategori=='1'){
		$where ='';
		}else if($id_kategori=='3'){
		$where ='AND registrasi_user.id_kota ="'.$id_kota.'" ';
		}else if($id_kategori=='2'){
		$where ='AND registrasi_user.id_prov ="'.$id_prov.'" ';
		}else{
		$where ='AND timeline.id_faskes="'.$id_faskes.'"';
		}
		
		if($type_user=='Labkes'){
		$where2 ='AND registrasi_user.type_user ="'.$type_user.'" ';	
		}else if($type_user=='Klinik'){
		$where2 ='AND registrasi_user.type_user ="'.$type_user.'" ';	
		}else if($type_user=='UTD'){
		$where2 ='AND registrasi_user.type_user ="'.$type_user.'" ';	
		}else if($type_user=='RS'){
		$where2 ='AND registrasi_user.type_user ="'.$type_user.'" ';
		}else if($type_user=='Praktik Mandiri'){
		$where2 ='AND registrasi_user.type_user ="'.$type_user.'" ';	
		}else{
		$where2 ='';	
		}
		
		$sql = $this->db->query("SELECT 
		registrasi_user.email,
		registrasi_user.nama_lengkap,
		registrasi_user.jabatan,
		registrasi_user.no_hp,
		registrasi_user.type_user,
		kategori.keterangan,
		kategori.kategori_user,
		registrasi_user.id AS id_faskes ,propinsi.nama_prop,kota.nama_kota,
		registrasi_user.id
		FROM registrasi_user 
		LEFT JOIN propinsi ON registrasi_user.id_prov=propinsi.id_prop
		LEFT JOIN kota ON registrasi_user.id_prov=kota.id_prop AND kota.id_kota=registrasi_user.id_kota
		LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori 
		WHERE 1=1 AND id_kategori='3' AND validate='2' ".$where.$where2."  ORDER BY registrasi_user.id DESC ");
		return $sql->result_array();
	}
	
	function getlistdinkeskotabelumvaldate($id_kategori=NULL,$id_faskes=NULL,$id_kota=NULL,$id_prov=NULL,$type_user=NULL)
	{
	
		if($id_kategori=='1'){
		$where ='';
		}else if($id_kategori=='3'){
		$where ='AND registrasi_user.id_kota ="'.$id_kota.'" ';
		}else if($id_kategori=='2'){
		$where ='AND registrasi_user.id_prov ="'.$id_prov.'" ';
		}else{
		$where ='AND timeline.id_faskes="'.$id_faskes.'"';
		}
		
		if($type_user=='Labkes'){
		$where2 ='AND registrasi_user.type_user ="'.$type_user.'" ';	
		}else if($type_user=='Klinik'){
		$where2 ='AND registrasi_user.type_user ="'.$type_user.'" ';	
		}else if($type_user=='UTD'){
		$where2 ='AND registrasi_user.type_user ="'.$type_user.'" ';	
		}else if($type_user=='RS'){
		$where2 ='AND registrasi_user.type_user ="'.$type_user.'" ';
		}else if($type_user=='Praktik Mandiri'){
		$where2 ='AND registrasi_user.type_user ="'.$type_user.'" ';	
		}else{
		$where2 ='';	
		}

		
		$sql = $this->db->query("SELECT 
		registrasi_user.email,
		registrasi_user.nama_lengkap,
		registrasi_user.jabatan,
		registrasi_user.no_hp,
		registrasi_user.type_user,
		kategori.keterangan,
		kategori.kategori_user,
		registrasi_user.id AS id_faskes ,propinsi.nama_prop,kota.nama_kota,
		registrasi_user.id
		FROM registrasi_user 
		LEFT JOIN propinsi ON registrasi_user.id_prov=propinsi.id_prop
		LEFT JOIN kota ON registrasi_user.id_prov=kota.id_prop AND kota.id_kota=registrasi_user.id_kota
		LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori 
		WHERE 1=1 AND id_kategori='3' AND validate='0' ".$where.$where2."  ORDER BY registrasi_user.id DESC ");
		return $sql->result_array();
	}
	
	
	function getlistdinkespropinsi($id_kategori=NULL,$id_faskes=NULL,$id_kota=NULL,$id_prov=NULL)
	{
	
		if($id_kategori=='1'){
		$where ='';
		}else if($id_kategori=='3'){
		$where ='AND registrasi_user.id_kota ="'.$id_kota.'" ';
		}else if($id_kategori=='2'){
		$where ='AND registrasi_user.id_prov ="'.$id_prov.'" ';
		}else{
		$where ='AND timeline.id_faskes="'.$id_faskes.'"';
		}

		
		$sql = $this->db->query("SELECT 
		registrasi_user.email,
		registrasi_user.nama_lengkap,
		registrasi_user.jabatan,
		registrasi_user.no_hp,
		kategori.keterangan,
		registrasi_user.type_user,
		kategori.kategori_user,
		registrasi_user.id AS id_faskes ,propinsi.nama_prop,kota.nama_kota,
		registrasi_user.id
		FROM registrasi_user 
		LEFT JOIN propinsi ON registrasi_user.id_prov=propinsi.id_prop
		LEFT JOIN kota ON registrasi_user.id_prov=kota.id_prop AND kota.id_kota=registrasi_user.id_kota
		LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori 
		WHERE 1=1 AND id_kategori='2' AND validate='2' ".$where."  ORDER BY registrasi_user.id DESC ");
		return $sql->result_array();
	}
	
	function getlistdinkespropinsibelumvaldate($id_kategori=NULL,$id_faskes=NULL,$id_kota=NULL,$id_prov=NULL)
	{
	
		if($id_kategori=='1'){
		$where ='';
		}else if($id_kategori=='3'){
		$where ='AND registrasi_user.id_kota ="'.$id_kota.'" ';
		}else if($id_kategori=='2'){
		$where ='AND registrasi_user.id_prov ="'.$id_prov.'" ';
		}else{
		$where ='AND timeline.id_faskes="'.$id_faskes.'"';
		}

		
		$sql = $this->db->query("SELECT 
	registrasi_user.email,
		registrasi_user.nama_lengkap,
		registrasi_user.jabatan,
		registrasi_user.no_hp,
		registrasi_user.type_user,
		kategori.keterangan,
		kategori.kategori_user,
		registrasi_user.id AS id_faskes ,propinsi.nama_prop,kota.nama_kota,
		registrasi_user.id
		FROM registrasi_user 
		LEFT JOIN propinsi ON registrasi_user.id_prov=propinsi.id_prop
		LEFT JOIN kota ON registrasi_user.id_prov=kota.id_prop AND kota.id_kota=registrasi_user.id_kota
		LEFT JOIN kategori ON kategori.id=registrasi_user.id_kategori 
		WHERE 1=1 AND id_kategori='2' AND validate='0' ".$where."  ORDER BY registrasi_user.id DESC ");
		return $sql->result_array();
	}
	
	function get_typeahead($q,$max = null){
		$limit = "";
		if(!empty($max))
			$limit = " limit ".$max;
		return $this->db->query("SELECT registrasi_user.id,registrasi_user.nama_fasyankes,registrasi_user.id AS id_faskes from registrasi_user  where registrasi_user.nama_fasyankes LIKE '%".$q."%' AND registrasi_user.validate='2' LIMIT 0,10 ")->result_array();	
	}
	
	function cek_service($tanggal=NULL)
	{
		
		$sql = $this->db->query("SELECT * FROM data_utd WHERE '".$tanggal."' > DATE_ADD(tanggal_berakhir_surat_izin, INTERVAL -3 MONTH) AND flag_kirim_email_tanggal_berakhir_surat_izin='0';");
		return $sql->result_array();
	}

	function getdatapm($user_id=NULL)
	{
			$raw_user_id=" and data_pm.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT data_pm.*,propinsi.kode_regional FROM data_pm  LEFT JOIN propinsi ON data_pm.id_prov_pm = propinsi.id_prop WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}

	function getdatasarprasalkespm($user_id=NULL)
	{
			$raw_user_id=" and trans_sarpras_alkes_pm.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT trans_sarpras_alkes_pm.* FROM trans_sarpras_alkes_pm  WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}

	function getdatasdmpm($user_id=NULL)
	{
	
	 
			$raw_user_id=" and trans_sdm_pm.id_faskes='".$user_id."' ";

		$sql = $this->db->query("SELECT trans_sdm_pm.* FROM trans_sdm_pm  WHERE 1=1 ".$raw_user_id." ");
		return $sql->result_array();
	}
	
	function get_rekap_data_admin($prov, $kab){
        if($prov != 99){
            $prov_str = "and id_prov=".$prov;
            $kab_str = "and id_kota=".$kab;
        }else{
            $prov_str = "";
            $kab_str = "";
        }
        
        $sql = $this->db->query("SELECT (select count(r.id)
            FROM dbfaskes.registrasi_user r
                    JOIN dbfaskes.trans_final tf ON tf.id_faskes=r.id
                    WHERE r.id_kategori=4 and kode_faskes != '' $prov_str $kab_str) rs_final,
                    
                    (select count(r.id)
            FROM dbfaskes.registrasi_user r
                    LEFT JOIN dbfaskes.trans_final tf ON tf.id_faskes=r.id
                    WHERE r.id_kategori=4 and kode_faskes is null $prov_str $kab_str) rs_belum_final,
                    
                    
                    (select count(r.id)
            FROM dbfaskes.registrasi_user r
                    JOIN dbfaskes.trans_final tf ON tf.id_faskes=r.id
                    WHERE r.id_kategori=5 and kode_faskes != '' $prov_str $kab_str) klinik_final,
                    
                            (select count(r.id)
            FROM dbfaskes.registrasi_user r
                    JOIN dbfaskes.trans_final tf ON tf.id_faskes=r.id
                    WHERE r.id_kategori=5 and kode_faskes is null $prov_str $kab_str) klinik_belum_final,
                    
                    (select count(r.id)
            FROM dbfaskes.registrasi_user r
                    JOIN dbfaskes.trans_final tf ON tf.id_faskes=r.id
                    WHERE r.id_kategori=6 and kode_faskes != '' $prov_str $kab_str) utd_final,
                    
                            (select count(r.id)
            FROM dbfaskes.registrasi_user r
                    JOIN dbfaskes.trans_final tf ON tf.id_faskes=r.id
                    WHERE r.id_kategori=6 and kode_faskes is NULL $prov_str $kab_str) utd_belum_final,
                    
                    (select count(r.id)
            FROM dbfaskes.registrasi_user r
                    JOIN dbfaskes.trans_final tf ON tf.id_faskes=r.id
                    WHERE r.id_kategori=7 and kode_faskes != '' $prov_str $kab_str) labkes_final,
                    
                            (select count(r.id)
            FROM dbfaskes.registrasi_user r
                    JOIN dbfaskes.trans_final tf ON tf.id_faskes=r.id
                    WHERE r.id_kategori=7 and kode_faskes is NULL $prov_str $kab_str) labkes_belum_final,
                    
                    (select count(r.id)
            FROM dbfaskes.registrasi_user r
                    JOIN dbfaskes.trans_final tf ON tf.id_faskes=r.id
                    WHERE r.id_kategori=9 and kode_faskes != '' $prov_str $kab_str) pm_final,
                    
               (select count(r.id)
            FROM dbfaskes.registrasi_user r
                    JOIN dbfaskes.trans_final tf ON tf.id_faskes=r.id
                    WHERE r.id_kategori=9 and kode_faskes is null $prov_str $kab_str) pm_belum_final
            FROM trans_final LIMIT 1");
        
        //echo $this->db->last_query();
        return $sql->result_array();
    }
		
    public function propinsi(){
        $this->db->select('id_prop,nama_prop');
        $this->db->from('dbfaskes.propinsi');
        $this->db->where('status','Aktif');
        
        return $this->db->get();
     }
    
    public function ref_kabkota($prop){
        $this->db->select('id_kota,nama_kota');
        $this->db->from('dbfaskes.kota');
        $this->db->where('id_prop',$prop);
        $this->db->where('status','Aktif');
        $this->db->order_by('id_kota','asc');
        return $this->db->get();
     }
    
    public function ref_kecamatan($kabkota){
       $this->db->select('id_camat, nama_camat, id_kota, id_prop');
       $this->db->from('dbfaskes.kecamatan');
       $this->db->where('id_kota', $kabkota);
       $this->db->where('status','Aktif');
       $this->db->order_by('id_camat','asc');
       return $this->db->get();
    }
    
    function getnama_prov($prov)
    {
        $sql = $this->db->query("SELECT id_prop, nama_prop from dbfaskes.propinsi WHERE id_prop=$prov");
        return $sql->result_array();
    }
    
    function getnama_kab($kota)
    {
        $sql = $this->db->query("SELECT id_kota, nama_kota from dbfaskes.kota WHERE id_kota=$kota");
        return $sql->result_array();
    }
    
    function gettype_user($typeuser)
    {
        $sql = $this->db->query("SELECT id, kategori_user from dbfaskes.kategori WHERE kategori_user='$typeuser'");
        return $sql->result_array();
    }
    
    public function jenis_faskes(){
       $this->db->select('id, kategori_user, keterangan');
       $this->db->from('dbfaskes.kategori');
       $this->db->where('jenis_satker IS NOT NULL', NULL, FALSE);
       $this->db->order_by('urutan','asc');
       return $this->db->get();
    }
    
    public function kategori_pm(){
       $this->db->select('id, kategori_user');
       $this->db->from('dbfaskes.kategori_pm');
       $this->db->order_by('urutan','asc');
       return $this->db->get();
    }
    
    function get_data_faskes($prov, $kota, $jenis, $jenis_klinik, $katpm, $aktif, $reg){
        
        if($prov == 99 || $prov == 0){
            $prov_str = "";
        }else{
            $prov_str = "AND p.id_prop=$prov";
        }
        
        if($kota == 99 || $kota == 0){
            $kota_str = "";
        }else{
            $kota_str = "AND k.id_kota=$kota";
        }
        
        if($jenis_klinik == ''){
            $jenis_klinik_str = "";
        }else{
            $jenis_klinik_str = "AND dr.jenis_klinik='$jenis_klinik'";
        }
        
        if($katpm == 0){
            $pm_str = "";
        }else{
            $pm_str = "AND kp.id='$katpm'";
        }
        
        if($reg == 2){
            $reg_str = "";
        }else{
            if($reg == 0){
               $reg_str = "AND tf.final IS NULL";
            }else{
               $reg_str = "AND tf.final=$reg";
                }
        }
        
        if($aktif == 2){
            $aktif_str = "";
        }else{
            if($aktif ==1){
              $aktifs = "Aktif";
            }else{
              $aktifs = "Non Aktif";
            }
            
            if($jenis == 'RS' || $jenis == 4){
                $aktif_str = ""; //AND ru.status='$aktif'";
            }else if($jenis == 'Klinik' || $jenis == 5){
                $aktif_str = "AND status_klinik='$aktifs'";
            }else if($jenis == 'Laboratorium/Bank Jaringan' || $jenis == 7){
                $aktif_str = "AND status_labkes='$aktifs'"; //AND ru.status='$aktif'";
            }elseif($jenis == 'Praktik Mandiri' || $jenis == 9){
                $aktif_str = "AND status_pm='$aktifs'"; //AND ru.status='$aktif'";
            }else{
                $aktif_str = ""; //AND ru.status='$aktif'";
            }
        }
       
      
        $query_rs = "SELECT ru.id, tf.id_faskes, ru.nama_lengkap,ru.email, tf.kode_faskes, ru.nama_fasyankes, rj.jenis jenis, ru.alamat, p.nama_prop,
                    k.nama_kota, final, ru.tgl_buat_user tglregistrasi,
                    mrs.kepemilikan pemilik, '' jenis_modal, '' kerja_sama_bpjs_kesehatan, '' akreditasi,
                    tanggal_berlaku_surat_izin_usaha tgl_izin, status_rs aktif
                    FROM registrasi_user ru
                    LEFT JOIN trans_final tf ON tf.id_faskes=ru.id
                    left join data_rs dr ON dr.id_faskes=ru.id
                    JOIN propinsi p ON p.id_prop=dr.id_prov
                    JOIN kota k ON k.id_kota=dr.id_kota
                    left join master_rs_kepemilikan mrs ON mrs.id=dr.kepemilikan
                    join master_rs_jenis rj ON rj.id=dr.jenis_rs
                    WHERE nama_lengkap not like '%tes%' $prov_str $kota_str $jenis_klinik_str $pm_str $aktif_str $reg_str";
        $query_klinik = "SELECT ru.id, tf.id_faskes, ru.nama_lengkap,ru.email, tf.kode_faskes, ru.nama_fasyankes, dr.jenis_klinik jenis,
                    ru.alamat, p.nama_prop, k.nama_kota,
                    final, ru.tgl_buat_user tglregistrasi, pemilik, jenis_modal_usaha jenis_modal, kerja_sama_bpjs_kesehatan,
                    akreditasi, tanggal_berakhir_izin_operasional tgl_izin, status_klinik aktif
                    FROM registrasi_user ru
                    LEFT JOIN trans_final tf ON tf.id_faskes=ru.id
                    left join data_klinik dr ON dr.id_faskes=ru.id
                    JOIN propinsi p ON p.id_prop=dr.id_prov
                    JOIN kota k ON k.id_kota=dr.id_kota
                    
                    WHERE nama_lengkap not like '%tes%' $prov_str $kota_str $jenis_klinik_str $pm_str $aktif_str $reg_str";
        $query_labkes = "SELECT ru.id, tf.id_faskes, ru.nama_lengkap,ru.email, tf.kode_faskes, ru.nama_fasyankes, dr.jenis_pelayanan jenis,
                    ru.alamat, p.nama_prop, k.nama_kota, pemilik, '' jenis_modal, '' kerja_sama_bpjs_kesehatan, '' akreditasi,
                    tanggal_berakhir_izin_operasional tgl_izin, final, ru.tgl_buat_user tglregistrasi, status_labkes aktif
                    FROM registrasi_user ru
                    LEFT JOIN trans_final tf ON tf.id_faskes=ru.id
                    left join data_labkes dr ON dr.id_faskes=ru.id
                    JOIN propinsi p ON p.id_prop=dr.id_prov
                    JOIN kota k ON k.id_kota=dr.id_kota
                    
                    WHERE nama_lengkap not like '%tes%' $prov_str $kota_str $jenis_klinik_str $pm_str $aktif_str $reg_str";
        $query_pm = "SELECT ru.id, tf.id_faskes, ru.nama_lengkap,ru.email, tf.kode_faskes, ru.nama_fasyankes, kp.kategori_user jenis,
                    ru.alamat, p.nama_prop, k.nama_kota, kepemilikan_tempat pemilik, '' jenis_modal, kerja_sama_bpjs_kesehatan,
                    '' akreditasi, '' tgl_izin, final, ru.tgl_buat_user tglregistrasi
                    , status_pm aktif
                    FROM registrasi_user ru
                    LEFT JOIN trans_final tf ON tf.id_faskes=ru.id
                    left join data_pm dr ON dr.id_faskes=ru.id
                    join kategori_pm kp ON kp.id=ru.id_kategori_pm
                    JOIN propinsi p ON p.id_prop=dr.id_prov_pm
                    JOIN kota k ON k.id_kota=dr.id_kota_pm
                    
                    WHERE nama_lengkap not like '%tes%' $prov_str $kota_str $jenis_klinik_str $pm_str $aktif_str $reg_str";
        
        $kosong = "SELECT ru.id, tf.id_faskes, ru.nama_lengkap,ru.email, tf.kode_faskes , ru.nama_fasyankes, kp.kategori_user jenis,
                    ru.alamat, p.nama_prop, k.nama_kota, '' pemilik, '' jenis_modal, '' kerja_sama_bpjs_kesehatan,
                    '' akreditasi, '' tgl_izin, '' final, '' tglregistrasi
                    , '' aktif
                    final, ru.tgl_buat_user tglregistrasi
                    FROM registrasi_user ru
                    LEFT JOIN trans_final tf ON tf.id_faskes=ru.id
                    left join data_pm dr ON dr.id_faskes=ru.id
                    join kategori_pm kp ON kp.id=ru.id_kategori_pm
                    JOIN propinsi p ON p.id_prop=dr.id_prov_pm
                    JOIN kota k ON k.id_kota=dr.id_kota_pm
                    
                    WHERE nama_lengkap=''";
        
        //echo $jenis;
        
        if($jenis == 'RS' || $jenis == 4){
            $sql = $this->db->query($query_rs);
        }elseif($jenis == 'Klinik' || $jenis == 5){
            $sql = $this->db->query($query_klinik);
        }elseif($jenis == 'Laboratorium/Bank Jaringan' || $jenis == 7){
            $sql = $this->db->query($query_labkes);
        }elseif($jenis == 'Praktik Mandiri' || $jenis == 9){
            $sql = $this->db->query($query_pm);
        }else{
            $sql = $this->db->query($kosong);
        }
        //echo $this->db->last_query();
        return $sql;
    }
    
    function getidfaskes($user_id, $id_kategori)
    {
        if($id_kategori == 9){
            $sql = $this->db->query("SELECT id from data_pm WHERE id_faskes=$user_id");
        }else{
            $sql = $this->db->query("SELECT id from data_rs WHERE id_faskes=$user_id");
        }
        //echo $this->db->last_query();
        return $sql->result();
    }
    
    function getkodefaskes($user_id, $id_kategori)
    {
        if($id_kategori == 9){
            $sql = $this->db->query("SELECT kode_faskes from data_pm WHERE id_faskes=$user_id");
        }else{
            $sql = $this->db->query("SELECT kode_faskes from data_rs WHERE id_faskes=$user_id");
        }
        //echo $this->db->last_query();
        return $sql->result();
    }
    
    function hapus_gambar($k){
		$hsl=$this->db->query("DELETE FROM `t_img_faskes` WHERE `id`='$k'");
		return $hsl;
	}
}



