<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_profile extends CI_Model
{

    // Nasrul
    function Profile_view($id)
    {
        // $userid = $this->session->userdata('user_id');
        // echo json_encode($user_id);
        return $this->db->query("SELECT 
        db_akreditasi_non_rs.user_surveior.nik, 
        db_akreditasi_non_rs.user_surveior.nama, 
        db_akreditasi_non_rs.user_surveior.email, 
        db_akreditasi_non_rs.lpa.nama as namalpa, 
        db_akreditasi_non_rs.user_surveior.no_hp as nohp, 
        dbfaskes.propinsi.nama_prop as propinsi,
        dbfaskes.kab_kota_new.kab_kota_new as kabkota,
        db_akreditasi_non_rs.user_surveior.keaktifan, 
        db_akreditasi_non_rs.user_surveior.url_sertifikat_surveior as sertif,
        db_akreditasi_non_rs.user_surveior.url_surat_keputusan_keanggotaan as sertif_anggota,
        db_akreditasi_non_rs.user_surveior.status_aktif as status_aktif,
        db_akreditasi_non_rs.user_surveior.nama_sertifikat as sertifikat_surveior
        FROM db_akreditasi_non_rs.user_surveior
        left join db_akreditasi_non_rs.lpa on db_akreditasi_non_rs.lpa.id = db_akreditasi_non_rs.user_surveior.lpa_id
        left join dbfaskes.propinsi on dbfaskes.propinsi.id_prop = db_akreditasi_non_rs.user_surveior.provinsi_id
        left join dbfaskes.kab_kota_new on dbfaskes.kab_kota_new.link_pusdatin = db_akreditasi_non_rs.user_surveior.kabkota_id
     where db_akreditasi_non_rs.user_surveior.users_id = '$id'")->result();
    }
    // function Profile_view($id)
    // {
    //     return $this->db->query("SELECT 
    //     db_akreditasi_non_rs.user_surveior.nik, 
    //     db_akreditasi_non_rs.user_surveior.nama, 
    //     db_akreditasi_non_rs.user_surveior.email, 
    //     db_akreditasi_non_rs.lpa.nama as namalpa, 
    //     db_akreditasi_non_rs.user_surveior.no_hp as nohp, 
    //     dbfaskes.propinsi.nama_prop as propinsi,
    //     dbfaskes.kab_kota_new.kab_kota_new as kabkota,
    //     db_akreditasi_non_rs.user_surveior.keaktifan, 
    //     db_akreditasi_non_rs.user_surveior.url_sertifikat_surveior as sertif,
    //     db_akreditasi_non_rs.user_surveior.status_aktif as status_aktif,
    //     db_akreditasi_non_rs.user_surveior.nama_sertifikat as sertifikat_surveior
    //     FROM db_akreditasi_non_rs.user_surveior
    //     left join db_akreditasi_non_rs.lpa on db_akreditasi_non_rs.lpa.id = db_akreditasi_non_rs.user_surveior.lpa_id
    //     left join dbfaskes.propinsi on dbfaskes.propinsi.id_prop = db_akreditasi_non_rs.user_surveior.provinsi_id
    //     left join dbfaskes.kab_kota_new on dbfaskes.kab_kota_new.link_pusdatin = db_akreditasi_non_rs.user_surveior.kabkota_id
    //  where db_akreditasi_non_rs.user_surveior.users_id = '$id'")->result();
    // }

    function Verifikator_view($id)
    {

        return $this->db->query("SELECT 
        nik, nama, email, no_hp as nohp 
        from user_verifikator 
        where users_id = '$id'")->result();
    }

    function Ketualpa_view($id)
    {

        return $this->db->query("SELECT a.id, a.nama,a.users_id, a.lpa_id , b.nama as nama_lpa, a.email, a.no_hp, a.dokumen_sk_penunjukan as sk_penunjukan
        FROM `user_ketua_lpa` a 
        join lpa b on a.lpa_id = b.id
        where users_id = '$id'")->result();
    }
    function Adminlpa_view($id)
    {


        return $this->db->query("SELECT
        a.id, a.nama,  a.lpa_id,b.nama as nama_lpa, a.email,a.users_id, a.no_hp, a.dokumen_sk_penugasan as sk_penugasan
        FROM `user_admin_lpa`a 
        join lpa b on a.lpa_id = b.id 
        where users_id = '$id'")->result();
    }

    function AdminKemenkes_view($id)
    {


        return $this->db->query("SELECT
        a.id,a.users_id, a.nama, b.id as id_unit, b.unit_kerja, c.id as id_jabatan, c.jabatan, a.email, a.no_hp, a.dokumen_sk_penugasan as sk_penugasan, a.status_keaktifan, a.tanggal_aktif, a.tanggal_nonaktif 
        FROM user_admin_kemkes a 
        join m_unit_kerja b on a.unit_kerja = b.id 
				join m_jabatan c on a.jabatan = c.id
        where users_id = '$id'")->result();
    }

    function Other_view($id)
    {

        return $this->db->query("SELECT
         nik, nama, email from users where id = '$id'")->result();
    }

    function getpw($id)
    {

        return $this->db->query("SELECT password_enkripsi from users where id='$id'")->result_array();
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
        where users_id = '$id' and is_checked=1")->result_array();
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
        password_enkripsi = '$pass'
        WHERE id = '$id'");
        return $hsl;
    }

    function update_users($nama_baru)
    {
        $id = $this->session->userdata('id');
        $updusers = $this->db->query("UPDATE db_akreditasi_non_rs.users SET
        nama = '$nama_baru'
        WHERE id = '$id'");

        return ($updusers);
    }

    function update_profile_ketualpa($nama_baru, $nohpbaru, $dokumen_sk)
    {
        $id = $this->session->userdata('id');
        $upduser = $this->db->query("UPDATE db_akreditasi_non_rs.user_ketua_lpa SET
        nama = '$nama_baru',  no_hp = '$nohpbaru', dokumen_sk_penunjukan = '$dokumen_sk'
        WHERE users_id = '$id'");

        return ($upduser);
    }


    function update_profile_adminlpa($nama_baru, $nohpbaru, $dokumen_sk)
    {
        $id = $this->session->userdata('id');
        $upduser = $this->db->query("UPDATE db_akreditasi_non_rs.user_admin_lpa SET
        nama = '$nama_baru',  no_hp = '$nohpbaru', dokumen_sk_penugasan = '$dokumen_sk'
        WHERE users_id = '$id'");
        return $upduser;
    }

    function update_profile_adminkemenkes($nama_baru, $nohpbaru, $unit_kerja, $jabatan, $dokumen_sk)
    {
        $id = $this->session->userdata('id');
        $upduser = $this->db->query("UPDATE db_akreditasi_non_rs.user_admin_kemkes SET
        nama = '$nama_baru', unit_kerja = '$unit_kerja', jabatan='$jabatan',  no_hp = '$nohpbaru', dokumen_sk_penugasan = '$dokumen_sk'
        WHERE users_id = '$id'");
        return $upduser;
    }
    function edit_sertifikat($table, $where, $data)
    {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }
}
