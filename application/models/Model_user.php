<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function get_ketua_lpa()
    {
        return $this->db->query("SELECT a.id, a.nama,a.users_id, b.nama as nama_lpa, a.email, a.no_hp, a.status_keaktifan as status, a.dokumen_sk_penunjukan as sk_penunjukan, a.tanggal_aktif, a.tanggal_nonaktif 
        FROM `user_ketua_lpa` a 
        join lpa b on a.lpa_id = b.id ")->result_array();
    }

    function get_ketua_lpa_by_id($id)
    {
        return $this->db->query("SELECT 
        nama, email, no_hp, status_keaktifan, dokumen_sk_penunjukan, tanggal_aktif, tanggal_nonaktif 
        FROM db_akreditasi_non_rs.user_ketua_lpa where users_id  = '$id'")->result();
    }

    function get_admin_lpa()
    {
        return $this->db->query("SELECT
         a.id, a.nama, b.nama as nama_lpa,c.nama as nama_fasyankes, a.email,a.users_id, a.no_hp, a.status_keaktifan as status, a.dokumen_sk_penugasan as sk_penugasan,  a.tanggal_aktif, a.tanggal_nonaktif  
         FROM `user_admin_lpa`a 
         LEFT JOIN lpa b on a.lpa_id = b.id
         LEFT JOIN jenis_fasyankes c on a.fasyankes_id = c.id")->result_array();
    }

    function get_admin_lpa_by_id($id)
    {
        // $userid = $this->session->userdata('user_id');
        // echo json_encode($user_id);
        return $this->db->query("SELECT 
        nama, email, no_hp, status_keaktifan, dokumen_sk_penugasan, tanggal_aktif, tanggal_nonaktif 
        FROM db_akreditasi_non_rs.user_ketua_lpa where users_id  = '$id'")->result();
    }
    function get_ketua_tim()
    {
        return $this->db->query("SELECT a.id, a.nama,a.users_id, b.nama as nama_timker, a.email, a.no_hp, a.status_keaktifan as status, a.dokumen_sk_penunjukan as sk_penunjukan, a.tanggal_aktif, a.tanggal_nonaktif 
        FROM `user_ketua_tim` a 
        join list_ketua b on a.lpa_id = b.id ")->result_array();
    }

    function get_ketua_tim_by_id($id)
    {
        return $this->db->query("SELECT 
        nama, email, no_hp, status_keaktifan, dokumen_sk_penunjukan, tanggal_aktif, tanggal_nonaktif 
        FROM db_akreditasi_non_rs.user_ketua_tim where users_id  = '$id'")->result();
    }

    //Direktur
    function get_direktur()
    {
        return $this->db->query("SELECT *
        FROM `users` 
       Where kriteria_id = 9 ")->result_array();
    }

     //Binwas
     function get_binwas()
     {
         return $this->db->query("SELECT *
         FROM `users` 
        Where kriteria_id = 10 ")->result_array();
     }
    // function get_direktur_by_id($id)
    // {
    //     return $this->db->query("SELECT 
    //     nama, email, no_hp, status_keaktifan, dokumen_sk_penunjukan, tanggal_aktif, tanggal_nonaktif 
    //     FROM db_akreditasi_non_rs.user_ketua_tim where users_id  = '$id'")->result();
    // }

    function get_list_lpa()
    {
        return $this->db->query("SELECT * from lpa")->result_array();
    }

    function select_ketualpa($user_id)
    {
        //$user_id=3;
        $raw_user_id = " and a.id='" . $user_id . "' ";

        $sql = $this->db->query("SELECT
		a.*,
        b.nik
		FROM
		user_ketua_lpa a
        LEFT JOIN users b ON a.users_id = b.id WHERE 1=1 " . $raw_user_id . "");


        return $sql->result_array();
    }
    function delete_ketualpa($user_id)
    {

        $raw_id = " and users_id='" . $user_id . "' ";
        $raw_user_id = " and id='" . $user_id . "' ";


        $sql = $this->db->query("DELETE FROM user_ketua_lpa  WHERE 1=1 " . $raw_id . " ");
        $sql = $this->db->query("DELETE FROM users  WHERE 1=1 " . $raw_user_id . " ");

        return 1;
    }

    function select_adminlpa($user_id)
    {
        //$user_id=3;
        $raw_user_id = " and a.id='" . $user_id . "' ";

        $sql = $this->db->query("SELECT
		a.*,
        b.nik
		FROM
		user_admin_lpa a
        LEFT JOIN users b ON a.users_id = b.id WHERE 1=1 " . $raw_user_id . "");


        return $sql->result_array();
    }
    function delete_adminlpa($user_id)
    {

        $raw_id = " and users_id='" . $user_id . "' ";
        $raw_user_id = " and id='" . $user_id . "' ";


        $sql = $this->db->query("DELETE FROM user_admin_lpa  WHERE 1=1 " . $raw_id . " ");
        $sql = $this->db->query("DELETE FROM users  WHERE 1=1 " . $raw_user_id . " ");

        return 1;
    }

    function select_ketuatim($user_id)
    {
        //$user_id=3;
        $raw_user_id = " and a.id='" . $user_id . "' ";

        $sql = $this->db->query("SELECT
		a.*,
        b.nik
		FROM
		user_ketua_tim a
        LEFT JOIN users b ON a.users_id = b.id WHERE 1=1 " . $raw_user_id . "");


        return $sql->result_array();
    }
    function delete_ketuatim($user_id)
    {

        $raw_id = " and users_id='" . $user_id . "' ";
        $raw_user_id = " and id='" . $user_id . "' ";


        $sql = $this->db->query("DELETE FROM user_ketua_tim  WHERE 1=1 " . $raw_id . " ");
        $sql = $this->db->query("DELETE FROM users  WHERE 1=1 " . $raw_user_id . " ");

        return 1;
    }

    function select_direktur($user_id)
    {
        //$user_id=3;
        $raw_user_id = " and id='" . $user_id . "' ";

        $sql = $this->db->query("SELECT *        
		FROM
		users  WHERE 1=1 " . $raw_user_id . "");

        return $sql->result_array();
    }
    function delete_direktur($user_id)
    {

       
        $raw_user_id = " and id='" . $user_id . "' ";


        
        $sql = $this->db->query("DELETE FROM users  WHERE 1=1 " . $raw_user_id . " ");

        return 1;
    }
    // function get_admin_lpa(){
    //     // $userid = $this->session->userdata('user_id');
    //     // echo json_encode($user_id);
    // 	return $this->db->query("SELECT 
    //     db_akreditasi_non_rs.user_surveior.nik, 
    //     db_akreditasi_non_rs.user_surveior.nama, 
    //     db_akreditasi_non_rs.user_surveior.email, 
    //     db_akreditasi_non_rs.lpa.nama as namalpa, 
    //     db_akreditasi_non_rs.user_surveior.no_hp as nohp, 
    //     dbfaskes.propinsi.nama_prop as propinsi,
    //     dbfaskes.kab_kota_new.kab_kota_new as kabkota,
    //     db_akreditasi_non_rs.user_surveior.keaktifan, 
    //     db_akreditasi_non_rs.user_surveior.url_sertifikat_surveior as sertif

    //     FROM db_akreditasi_non_rs.user_surveior
    //     left join db_akreditasi_non_rs.lpa on db_akreditasi_non_rs.lpa.id = db_akreditasi_non_rs.user_surveior.lpa_id
    //     left join dbfaskes.propinsi on dbfaskes.propinsi.id_prop = db_akreditasi_non_rs.user_surveior.provinsi_id
    //     left join dbfaskes.kab_kota_new on dbfaskes.kab_kota_new.link = db_akreditasi_non_rs.user_surveior.kabkota_id
    //  where db_akreditasi_non_rs.user_surveior.users_id = '$id'")->result_array();
    // }

    function Verifikator_view($id)
    {

        return $this->db->query("SELECT 
        nik, nama, email, no_hp as nohp 
        from user_verifikator 
        where users_id = '$id'")->result();
    }

    function Other_view($id)
    {

        return $this->db->query("SELECT
         nik, nama, email from user_verifikator where id = '$id'")->result();
    }

    function getpw($id)
    {

        return $this->db->query("SELECT password from users where id='$id'")->result();
    }


    function Surv_bidang_view($id)
    {
        // $userid = $this->session->userdata('user_id');
        // echo json_encode($user_id);
        return $this->db->query("SELECT 
        b.nama as fasyankes, a.nama_bidang as bidang 
        from user_surveior_bidang_detail a 
        join jenis_fasyankes b 
        on a.id_fasyankes_surveior = b.id 
        where id_user_surveior = '$id'")->result_array();
    }

    function Trans_upd_profil($nama_baru, $nama_lama, $nohp_baru, $nohp_lama)
    {


        $id = $this->session->userdata('id');

        $history = $this->db->query("INSERT into db_akreditasi_non_rs.trans_upd_user
        (nama_baru, nama_lama, no_telp_baru, no_telp_lama, user_id) VALUES
        ('$nama_baru','$nama_lama','$nohp_baru', '$nohp_lama', '$id')");

        return ($history);
    }

    function Update_nama_nohp_verif($nama_baru, $nohp_baru)
    {


        $id = $this->session->userdata('id');


        $upduserverif = $this->db->query("UPDATE db_akreditasi_non_rs.user_verifikator SET
        nama = '$nama_baru',
        no_hp = '$nohp_baru'
        WHERE users_id = '$id'");

        return ($upduserverif);
    }

    function Update_nama_nohp_surv($nama_baru, $nohp_baru)
    {


        $id = $this->session->userdata('id');

        $updusersurv = $this->db->query("UPDATE db_akreditasi_non_rs.user_surveior SET
        nama = '$nama_baru',
        no_hp = '$nohp_baru'    
        WHERE users_id = '$id'");


        return ($updusersurv);
    }

    function Update_nama_users($nama_baru)
    {
        $id = $this->session->userdata('id');
        $updusers = $this->db->query("UPDATE db_akreditasi_non_rs.users SET
        nama = '$nama_baru'
        WHERE id = '$id'");

        return ($updusers);

        // $hsl2=$this->db->query("insert into dbfaskes.trans_upd_user 
        // nama_baru = '$nama_baru',
        // no_telp_baru = '$nohp_baru'
        // nama_baru = '$nama_lama',
        // no_telp_baru = '$nohp_lama',  
        // modified_at = getdate(),
        // WHERE id = '$id'");
    }

    function update_password($pass)
    {
        $id = $this->session->userdata('id');
        $hsl = $this->db->query("UPDATE db_akreditasi_non_rs.users SET
        password = '$pass'
        WHERE id = '$id'");
        return $hsl;
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
    public function checknik($nik)
    {

        $query = "SELECT * FROM users WHERE nik = '$nik' ";
        $sql = $this->db->query($query);
        return $sql->num_rows();
    }
    public function checknikadmin($nik)
    {

        $query = "SELECT * FROM user_admin_lpa WHERE nik = '$nik' ";
        $sql = $this->db->query($query);
        return $sql->num_rows();
    }

    public function checknikketua($nik)
    {

        $query = "SELECT * FROM user_ketua_lpa WHERE nik = '$nik' ";
        $sql = $this->db->query($query);
        return $sql->num_rows();
    }
    public function checkemailrecover($email)
    {
        $this->db->select('id, username, nama');
        $this->db->from('users');
        // $this->db->where('username', $this->db->escape_like_str($email));
        $this->db->where('username', $email);
        return $this->db->get();
    }
    public function getpenggunamodified($idpengguna)
    {
        $this->db->select('id, modified_at');
        $this->db->from('users');
        $this->db->where('id', $idpengguna);
        return $this->db->get();
    }
    public function updatepassword($idpengguna, $data)
    {
        $this->db->where('id', $idpengguna);
        return $this->db->update('users', $data);
        // return print_r($this->db->last_query());

    }
}
