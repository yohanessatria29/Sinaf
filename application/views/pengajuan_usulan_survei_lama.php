<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Usul Survei</title>
    
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/logo/favicon.png" type="image/png">
    
   

    <link rel="stylesheet" href="<?php echo base_url('assets/temp');?>/jquery-ui.css">

    <script src="<?php echo base_url('assets/temp');?>/jquery-3.6.0.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    
</head>

<body>
<?php
    include('template/sidebar.php');
    
    ?>

            <?php
            if($this->session->flashdata('message_name') !=null){
            ?>
                        <div class="alert alert-<?=$this->session->flashdata('kode_name');?> alert-dismissible">
                            <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> </button>
                            <h4><i class="icon fa fa-<?=$this->session->flashdata('icon_name');?>"></i> Alert!</h4> -->
                            <?=$this->session->flashdata('message_name');?>
                        </div>
            <?php
                }
            ?>
<section class="section">
<div class="row">
    <div class="col-md-12">
        <div class="card">
          
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Pengajuan Usul Survei</a>
                    </li>
                    <?php
                        if (!empty($data[0]['penerimaan_pengajuan_usulan_survei_id'])){
                    ?>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contacta-tab" data-bs-toggle="tab" href="#contacta" role="tab"
                            aria-controls="contacta" aria-selected="false">Kesiapan Survei  </a>
                    </li>
                    <?php
                        }
                        if (!empty($data[0]['berkas_usulan_survei_id'])){
                    ?>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Hasil Kesiapan Survei</a>
                    </li>
                    <?php
                        }
                        if (!empty($data[0]['kelengkapan_berkas_id'])){
                    ?>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false">Kesepakatan Survei</a>
                    </li>
                    <?php
                        }
                        if (!empty($data[0]['pengiriman_laporan_survei_id'])){
                    ?>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="verifikator-tab" data-bs-toggle="tab" href="#verifikator" role="tab"
                            aria-controls="verifikator" aria-selected="false">Pemiihan Verifikator</a>
                    </li>
                    <?php
                        }
                    ?>
                    <!-- <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contacta-tab" data-bs-toggle="tab" href="#contacta" role="tab"
                            aria-controls="contacta" aria-selected="false">Survei Akreditasi</a>
                    </li> -->
                </ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="page-heading">
            <div class="page-title">
                
            </div>
            
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <?php echo form_open_multipart('Pengajuan/simpanPenerimaanUsulan') ?>
                        <form role="form"  method="post" class="login-form" name="form_valdation">
                        <div class="row">
                            <div class="col-md-12">
                            <?php //var_dump($data);?>
                            <div class="form-group">
                            <label for="disabledInput">Kode Fasyankes</label>
                            <input type="text" class="form-control" id="fasyankes_id" name="fasyankes_id" placeholder="Kode Fasyankes" value="<?= $data[0]['fasyankes_id']; ?>"
                                readonly>
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $data[0]['id'] ?>">
                                <input type="hidden" class="form-control" id="penerimaan_pengajuan_usulan_survei_id" name="penerimaan_pengajuan_usulan_survei_id" value="<?= $data[0]['penerimaan_pengajuan_usulan_survei_id'] ?>">
                    </div>

                    <?php
                        if($data[0]['jenis_fasyankes'] == 1){
                            $jenis_fasyankes = 'Tempat Praktik Mandiri Nakes';
                        }else if($data[0]['jenis_fasyankes'] == 2){
                            $jenis_fasyankes = 'Pusat Kesehatan Masyrakat';   
                        }else if($data[0]['jenis_fasyankes'] == 3){
                            $jenis_fasyankes = 'Klinik';
                        }else if($data[0]['jenis_fasyankes'] == 4){
                            $jenis_fasyankes = 'Rumah Sakit';
                        }else if($data[0]['jenis_fasyankes'] == 5){
                            $jenis_fasyankes = 'Apotek';
                        }else if($data[0]['jenis_fasyankes'] == 6){
                            $jenis_fasyankes = 'Unit Transfusi Darah';   
                        }else if($data[0]['jenis_fasyankes'] == 7){
                            $jenis_fasyankes = 'Laboratorium Kesehatan';
                        }else if($data[0]['jenis_fasyankes'] == 8){
                            $jenis_fasyankes = 'Optikal';
                        }else if($data[0]['jenis_fasyankes'] == 9){
                            $jenis_fasyankes = 'Fasyankes Kedokteran Untuk Kepentingan Hukum';
                        }else{
                            $jenis_fasyankes = 'Fasyankes Tradisional';
                        };
                        
                    ?>

                    <div class="form-group">
                            <label for="disabledInput">Jenis Fasyankes</label>
                            <input type="text" class="form-control" id="jenis_fasyankes" name="jenis_fasyankes" placeholder="Jenis Fasyankes" value="<?= $jenis_fasyankes; ?>"
                             readonly>
                            
                        </div>
                        <div class="form-group">
                            <label for="helperText">Nama LPA</label>
                            <!-- <input type="text" id="namelpa" class="form-control" placeholder="NameLPA" value='<?=$data[0]['lpa_id'];?>' > -->
                            <!-- <input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-1" aria-autocomplete="list" aria-activedescendant="bs-select-1-11"> -->
                            <?=form_dropdown('lpa_id', array('1'=>'LPA 1','2'=>'LPA 2', '3'=>'LPA 3', '4'=>'LPA 4'),$data[0]['lpa_id'],'id="lpa_id"  class="form-control" disabled');?>
                        </div>
                        <!-- <div class="bs-searchbox">
                            <input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-1" aria-autocomplete="list" aria-activedescendant="bs-select-1-11"></div>
                         -->
                        <div class="form-group">
                        <p>Jenis Survei</p>
                        <fieldset class="form-group">
                                        <!-- <select class="form-select" id="survei">
                                            <option value='survei'>Survei</option>
                                            <option value='remedial'>Survei Remedial</option>
                                            
                                        </select> -->
                                        <?=form_dropdown('jenis_survei_id', array('1'=>'Survei','2'=>'Survei Remedial'),$data[0]['jenis_survei_id'],'id="jenis_survei_id"  class="form-control" disabled');?>
                                    </fieldset>
                        </div>
                        <div class="form-group">
                        <p>Jenis Akreditasi</p>
                   
                            <!-- <select class="form-select akreditasi" id="akreditasi">
                                            <option value='perdana'>Perdana</option>
                                            <option value='reakreditasi'>Reakreditasi</option>
                                            
                            </select> -->
                            <?=form_dropdown('jenis_akreditasi_id', array('1'=>'Perdana','2'=>'Reakreditasi'),$data[0]['jenis_akreditasi_id'],'id="jenis_akreditasi_id"  class="form-control" disabled');?>
                                
                        </div>

                        <?php
                                                                    if($data[0]['jenis_akreditasi_id']==2){
                                                                        $var_style_status="block";
                                                                        $var_style_sertifikat="block";
                                                                        $var_style_tgl_akhir="block";
                                                                    }else{
                                                                        $var_style_status="none";
                                                                        $var_style_sertifikat="none";
                                                                        $var_style_tgl_akhir="none";
                                                                    }
                                                                ?>

                        <div class="form-group status" style="display:<?=$var_style_status?>" id='status'>
                            <label for="disabledInput">Status Akreditasi Sebelumnya</label>
                            <!-- <select class="form-select akreditasi" id="statusakreditasi">
                                            <option value='paripurna'>Paripurna</option>
                                            <option value='utama'>Utama</option>
                                            <option value='madya'>Madya</option>
                                            <option value='dasar'>Dasar</option>
                                            
                            </select> -->
                            <?=form_dropdown('status_akreditasi_id', array('1'=>'Paripurna','2'=>'Utama','3'=>'Madya','4'=>'Dasar'),$data[0]['status_akreditasi_id'],'id="status_akreditasi_id"  class="form-control" disabled');?>
                        </div>
                        <div class="form-group" style="display:<?=$var_style_sertifikat?>">
                            <label for="disabledInput">Sertifikat Akreditasi Sebelumnya / Surat Penetapan</label>
                            <fieldset>
                                        <div class="input-group">
                                            <!-- <input type="file" class="form-control" id="inputGroupFile04"
                                                aria-describedby="inputGroupFileAddon04" aria-label="Upload" disabled> -->
                                                <a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo $data[0]['url_sertifikasi_akreditasi_sebelumnya'] ;?>">Lihat Dokumen</a>
                                           
                                        </div>
                                    </fieldset>
                        </div>
                        <div class="form-group" style="display:<?=$var_style_tgl_akhir?>">
                            <label for="disabledInput">Tanggal Akhir Sertifikat</label>
                            <!-- <input type="date" class="form-control" id="disabledInput" placeholder="Disabled Text"> -->
                            <input type="text"  name="tanggal_akhir_sertifikat" id="datepicker" value="<?= $data[0]['tanggal_akhir_sertifikat'] ?>"  class="form-control datepicker"  autocomplete="off"  disabled>
                        </div>
                        <div class="form-group">
                            <label for="helperText">Tanggal Pengajuan Survei</label>
                            <!-- <input type="date" id="tanggalpengajuan" class="form-control" > -->
                            <input type="text"  name="tanggal_pengajuan_survei" id="datepickerstr" value="<?= $data[0]['created_at'] ?>"  class="form-control datepicker"  autocomplete="off"  disabled>
                        </div>
                        <div class="form-group">
                            <label for="helperText">Tanggal Rencana Survei</label>
                            <div class="row">
                                  
                                        <div class="col-md-4">
                                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="<?= $data[0]['tanggal_awal_rencana_survei'] ?>" disabled>
                                        </div>
                                        s.d.
                                        <div class="col-md-4">
                                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="<?= $data[0]['tanggal_akhir_rencana_survei'] ?>" disabled>
                                        </div>
                                    </div>
                            <!-- <input type="date" id="tanggalpengajuan" class="form-control" > -->
                            <!-- <input type="text"  name="tanggal_rencana_survei" id="datepickerstr" value="<?= $data[0]['tanggal_rencana_survei'] ?>"  class="form-control datepicker"  autocomplete="off"  disabled> -->
                        </div>

                        <div class="form-group">
                            <label for="helperText">Status Usulan</label>
                            <!-- <input type="date" id="tanggalpengajuan" class="form-control" > -->
                            <?=form_dropdown('status_usulan_id', dropdown_sina_status_usulan(),$data[0]['status_usulan_id'],'id="status_usulan_id"  class="form-select" ');?>
                        </div>
                        <?php
                        if (!empty($data[0]['status_usulan_id'])){
                            if ($data[0]['status_usulan_id'] == 2) {
                                $keterangan_style="block";
                            } else {
                                $keterangan_style="none";
                            }
                        } else {
                            $keterangan_style="block";
                        }
                        ?>
                        <div class="form-group">
                            <label for="helperText">Alasan Ditolak</label>
                            <textarea type="text" id="keterangan" name="keterangan" class="form-control" style="display:<?= $keterangan_style;?>;" ><?= $data[0]['keterangan']; ?></textarea>
                        
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>                       
                        </div>

                            </div>
                            </form>
                   
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- Kesiapan Survei -->
     <div class="tab-pane fade" id="contacta" role="tabpanel" aria-labelledby="contacta-tab">
        <div class="page-heading">
            <div class="page-title">
            
            </div>
            <section class="section">
                <div class="card">
                <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dokumen</th>
                            <th>Action</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Surat permohonan fasyankes untuk dilakukan survei, ditujukan kepada lembaga penyelenggara akreditasi</td>
                            <td>   
                            <?php 
                                if(!empty($data[0]['url_surat_permohonan_survei'])) {
                                    ?>
                                 <a href="<?= $data[0]['url_surat_permohonan_survei']; ?>" target="_blank" class="btn btn-primary rounded-pill">View</a>
                                <?php
                                }
                                ?>
                            
                            </td>
                        </tr>
                        <!-- <tr>
                            <td>2</td>
                            <td>Profil fasyankes terbaru</td>
                            <td>
                            <?php 
                                if(!empty($data[0]['url_profil_fasyankes'])) {
                                    ?>
                                 <a href="<?= $data[0]['url_profil_fasyankes']; ?>" target="_blank" class="btn btn-primary rounded-pill">View</a>
                                <?php
                                }
                                ?>   
                            </td>
                        </tr> -->
                        <tr>
                            <td>2</td>
                            <td>Laporan hasil penilaian mandiri (self assessment)</td>
                            <td>   
                            <?php 
                                if(!empty($data[0]['url_laporan_hasil_penilaian_mandiri'])) {
                                    ?>
                                 <a href="<?= $data[0]['url_laporan_hasil_penilaian_mandiri']; ?>" target="_blank" class="btn btn-primary rounded-pill">View</a>
                                <?php
                                }
                                ?>  
                            </td>

                        </tr>
                        <?php
                            $no_3 = "";
                            $no_4 = "3";
                        if($data[0]['jenis_akreditasi_id'] == "2"){
                            $no_3 = "3";
                            $no_4 = "4";
                        
                        ?>
                        <tr>
                            <td><?=$no_3?></td>
                            <td>Hasil perencanaan perbaikan strategis (PPS) untuk fasyankes reakreditasi</td>
                            <td>   
                            <?php 
                                if(!empty($data[0]['url_pps_reakreditasi'])) {
                                    ?>
                                 <a href="<?= $data[0]['url_pps_reakreditasi']; ?>" target="_blank" class="btn btn-primary rounded-pill">View</a>
                                <?php
                                }
                                ?>  
                            </td>

                        </tr>
                        <?php
                        }
                        ?>
                        <?php
                        if($data[0]['jenis_fasyankes'] == 2){
                        
                        ?>
                        <tr>
                            <td><?=$no_4?></td>
                            <td>Surat usulan Dinas Kesehatan Kabupaten/Kota setelah dinyatakan siap untuk di survei</td>
                        
                            <td>   
                            <?php 
                                if(!empty($data[0]['url_surat_usulan_dinas'])) {
                                    ?>
                                <a href="<?= $data[0]['url_surat_usulan_dinas']; ?>" target="_blank" class="btn btn-primary rounded-pill">View</a>
                                <?php
                                }
                                ?>  
                            </td>
                        </tr> 
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Update Data Fasyankes Online (DFO)</th>
                            <th>Data ASPAK</th>
                            <th>Data SISDMK</th>
                            <th>Data INM</th>
                            <th>Data IKP</th>
                           
                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php 
                                if(is_null($data[0]['update_dfo'])== 1){
                                    
                                ?>
                                    <span class="badge bg-warning">!</span>
                                <?php 
                                    } else {
                                        if($data[0]['update_dfo']== 1 ) {
                                        ?>
                                    <span class="badge bg-danger">Tidak</span>
                                    <?php
                                        } else if($data[0]['update_dfo']== 2 ) {
                                    ?>
                                        <span class="badge bg-success">Ya</span>
                                <?php
                                    }
                                    }
                                ?></td>
                            <td><?php 
                                if(is_null($data[0]['update_aspak'])== 1){
                                    
                                ?>
                                    <span class="badge bg-warning">!</span>
                                <?php 
                                    } else {
                                        if($data[0]['update_aspak']== 1 ) {
                                        ?>
                                    <span class="badge bg-danger">Belum Sesuai</span>
                                    <?php
                                        } else if($data[0]['update_aspak']== 2 ) {
                                    ?>
                                        <span class="badge bg-success">Sesuai Persyaratan</span>
                                <?php
                                    }
                                    }
                                ?></td>
                            <td><?php 
                                if(is_null($data[0]['update_sisdmk'])== 1){
                                    
                                ?>
                                    <span class="badge bg-warning">!</span>
                                <?php 
                                    } else {
                                        if($data[0]['update_sisdmk']== 1 ) {
                                        ?>
                                    <span class="badge bg-danger">Belum Sesuai</span>
                                    <?php
                                        } else if($data[0]['update_sisdmk']== 2 ) {
                                    ?>
                                        <span class="badge bg-success">Sesuai Persyaratan</span>
                                <?php
                                    }
                                    }
                                ?></td>
                            <td><?php 
                                if(is_null($data[0]['update_inm'])== 1){
                                    
                                ?>
                                    <span class="badge bg-warning">!</span>
                                <?php 
                                    } else {
                                        if($data[0]['update_inm']== 1 ) {
                                        ?>
                                    <span class="badge bg-danger">Belum Sesuai</span>
                                    <?php
                                        } else if($data[0]['update_inm']== 2 ) {
                                    ?>
                                        <span class="badge bg-success">Sesuai Persyaratan</span>
                                <?php
                                    }
                                    }
                                ?></td>
                            <td><?php 
                                if(is_null($data[0]['update_ikp'])== 1){
                                    
                                ?>
                                    <span class="badge bg-warning">!</span>
                                <?php 
                                    } else {
                                        if($data[0]['update_ikp']== 1 ) {
                                        ?>
                                    <span class="badge bg-danger">Belum Sesuai</span>
                                    <?php
                                        } else if($data[0]['update_ikp']== 2 ) {
                                    ?>
                                        <span class="badge bg-success">Sesuai Persyaratan</span>
                                <?php
                                    }
                                    }
                                ?></td>
                            
                            
                        </tr>
                        
                    </tbody>
                </table>
            </div>
                </div>
            </section>
        </div>
    </div>                    


    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="card">
            <!-- <div class="card-header">
                    Data
            </div> -->
            <div class="card-body">
            <?php echo form_open_multipart('Pengajuan/simpanKelengkapanBerkas') ?>
                        <form role="form"  method="post" class="login-form" name="form_valdation">
                        <input type="hidden" class="form-control" id="berkas_usulan_survei_id" name="berkas_usulan_survei_id" value="<?= $data[0]['berkas_usulan_survei_id'] ?>">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $data[0]['id'] ?>">
                        <input type="hidden" class="form-control" id="kelengkapan_berkas_id" name="kelengkapan_berkas_id" value="<?= $data[0]['kelengkapan_berkas_id'] ?>">
            <?php 
                if (!empty($data[0]['kelengkapan_berkas_usulan'])){
                    if ($data[0]['kelengkapan_berkas_usulan'] == 2) {
                        $kelengkapan_berkas_usulan_y = "checked";
                        $kelengkapan_berkas_usulan_n = "";
                        $kelengkapan_berkas_usulan_checked="none";
                    } else {
                        $kelengkapan_berkas_usulan_y = "";
                        $kelengkapan_berkas_usulan_n = "checked";
                        $kelengkapan_berkas_usulan_checked="block";
                    }
                }  else {
                    $kelengkapan_berkas_usulan_y = "";
                    $kelengkapan_berkas_usulan_n = "";
                    $kelengkapan_berkas_usulan_checked="none";
                }

                if (!empty($data[0]['kelengkapan_dfo'])){
                    if ($data[0]['kelengkapan_dfo'] == 2) {
                        $kelengkapan_dfo_y = "checked";
                        $kelengkapan_dfo_n = "";
                        $kelengkapan_dfo_checked="none"; 
                    } else {
                        $kelengkapan_dfo_y = "";
                        $kelengkapan_dfo_n = "checked";
                        $kelengkapan_dfo_checked="block";
                    }
                }  else {
                    $kelengkapan_dfo_y = "";
                    $kelengkapan_dfo_n = "";
                    $kelengkapan_dfo_checked="none";
                }

                if (!empty($data[0]['kelengkapan_sarpras_alkes'])){
                    if ($data[0]['kelengkapan_sarpras_alkes'] == 2) {
                        $kelengkapan_sarpras_alkes_y = "checked";
                        $kelengkapan_sarpras_alkes_n = "";
                        $kelengkapan_sarpras_alkes_checked = "none"; 
                    } else {
                        $kelengkapan_sarpras_alkes_y = "";
                        $kelengkapan_sarpras_alkes_n = "checked";
                        $kelengkapan_sarpras_alkes_checked = "block";
                    }
                }  else {
                    $kelengkapan_sarpras_alkes_y = "";
                    $kelengkapan_sarpras_alkes_n = "";
                    $kelengkapan_sarpras_alkes_checked = "none";
                }

                if (!empty($data[0]['kelengkapan_nakes'])){
                    if ($data[0]['kelengkapan_nakes'] == 2) {
                        $kelengkapan_nakes_y = "checked";
                        $kelengkapan_nakes_n = "";
                        $kelengkapan_nakes_checked = "none";
                    } else {
                        $kelengkapan_nakes_y = "";
                        $kelengkapan_nakes_n = "checked";
                        $kelengkapan_nakes_checked = "block";
                    }
                }  else {
                    $kelengkapan_nakes_y = "";
                    $kelengkapan_nakes_n = "";
                    $kelengkapan_nakes_checked = "none";
                }

                if (!empty($data[0]['kelengkapan_laporan_inm'])){
                    if ($data[0]['kelengkapan_laporan_inm'] == 2) {
                        $kelengkapan_laporan_inm_y = "checked";
                        $kelengkapan_laporan_inm_n = "";
                        $kelengkapan_laporan_inm_checked="none";
                    } else {
                        $kelengkapan_laporan_inm_y = "";
                        $kelengkapan_laporan_inm_n = "checked";
                        $kelengkapan_laporan_inm_checked="block";
                    }
                }  else {
                    $kelengkapan_laporan_inm_y = "";
                    $kelengkapan_laporan_inm_n = "";
                    $kelengkapan_laporan_inm_checked="none";
                }

                if (!empty($data[0]['kelengkapan_laporan_ikp'])){
                    if ($data[0]['kelengkapan_laporan_ikp'] == 2) {
                        $kelengkapan_laporan_ikp_y = "checked";
                        $kelengkapan_laporan_ikp_n = "";
                        $kelengkapan_laporan_ikp_checked = "none";
                    } else {
                        $kelengkapan_laporan_ikp_y = "";
                        $kelengkapan_laporan_ikp_n = "checked";
                        $kelengkapan_laporan_ikp_checked = "block";
                    }
                }  else {
                    $kelengkapan_laporan_ikp_y = "";
                    $kelengkapan_laporan_ikp_n = "";
                    $kelengkapan_laporan_ikp_checked = "none";
                }

                // var_dump($update_ikp_n);
                ?>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Data</th>
                            <th>Kelengkapan</th>
                            <th>Catatan</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Kelengkapan berkas usulan</td>
                            <td>   
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelengkapan_berkas_usulan" id="kelengkapan_berkas_usulan1" value="2" required <?=$kelengkapan_berkas_usulan_y ;?>>
                                    <label class="form-check-label" for="kelengkapan_berkas_usulan1">
                                    Sesuai Persyaratan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelengkapan_berkas_usulan" id="kelengkapan_berkas_usulan2" value="1" <?=$kelengkapan_berkas_usulan_n ;?>>
                                    <label class="form-check-label" for="kelengkapan_berkas_usulan2">
                                    Belum Sesuai
                                    </label>
                                </div>
                            </td>
                            <td><input type="text" style="display:<?= $kelengkapan_berkas_usulan_checked;?>;" class="form-control" id="kelengkapan_berkas_usulan_catatan" name="kelengkapan_berkas_usulan_catatan" value="<?=$data[0]['kelengkapan_berkas_usulan_catatan'] ;?>" ></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Data DFO</td>
                            <td>   
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelengkapan_dfo" id="kelengkapan_dfo1" value="2" required <?=$kelengkapan_dfo_y;?>>
                                    <label class="form-check-label" for="kelengkapan_dfo1">
                                        Sesuai Persyaratan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelengkapan_dfo" id="kelengkapan_dfo2" value="1" <?=$kelengkapan_dfo_n ;?>>
                                        
                                    <label class="form-check-label" for="kelengkapan_dfo2">
                                        Belum Sesuai
                                    </label>
                                </div>
                            </td>
                       
                            <td><input type="text" class="form-control" style="display:<?= $kelengkapan_dfo_checked; ?>" id="kelengkapan_dfo_catatan" name="kelengkapan_dfo_catatan" value="<?=$data[0]['kelengkapan_dfo_catatan'] ;?>"  ></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Data ASPAK</td>
                            <td>   
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelengkapan_sarpras_alkes" id="kelengkapan_sarpras_alkes1" value="2" required <?=$kelengkapan_sarpras_alkes_y;?>>
                                    <label class="form-check-label" for="kelengkapan_sarpras_alkes1">
                                        Sesuai Persyaratan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelengkapan_sarpras_alkes" id="kelengkapan_sarpras_alkes2" value="1" <?=$kelengkapan_sarpras_alkes_n ;?>>
                                        
                                    <label class="form-check-label" for="kelengkapan_sarpras_alkes2">
                                        Belum Sesuai
                                    </label>
                                </div>
                            </td>
                       
                            <td><input type="text" class="form-control" style="display:<?= $kelengkapan_sarpras_alkes_checked; ?>" id="kelengkapan_sarpras_alkes_catatan" name="kelengkapan_sarpras_alkes_catatan" value="<?=$data[0]['kelengkapan_sarpras_alkes_catatan'] ;?>"  ></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Data SDM</td>
                            
                            <td>   
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelengkapan_nakes" id="kelengkapan_nakes1" value="2" required <?=$kelengkapan_nakes_y ;?>>
                                    <label class="form-check-label" for="kelengkapan_nakes1">
                                        Sesuai Persyaratan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelengkapan_nakes" id="kelengkapan_nakes2" value="1" <?=$kelengkapan_nakes_n ;?>>
                                    <label class="form-check-label" for="kelengkapan_nakes2">
                                        Belum Sesuai
                                    </label>
                                </div>
                            </td>
                     
                            <td><input type="text" class="form-control" style="display:<?= $kelengkapan_nakes_checked; ?>" id="kelengkapan_nakes_catatan" name="kelengkapan_nakes_catatan" value="<?=$data[0]['kelengkapan_nakes_catatan'] ;?>" ></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Data Laporan INM</td>
                            
                        <td>   
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelengkapan_laporan_inm" id="kelengkapan_laporan_inm1" value="2" required <?=$kelengkapan_laporan_inm_y ;?>>
                                    <label class="form-check-label" for="kelengkapan_laporan_inm1">
                                        Sesuai Persyaratan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelengkapan_laporan_inm" id="kelengkapan_laporan_inm2" value="1" <?=$kelengkapan_laporan_inm_n ;?>>
                                    <label class="form-check-label" for="kelengkapan_laporan_inm2">
                                        Belum Sesuai
                                    </label>
                                </div>
                            </td>
                            <td><input type="text" class="form-control" style="display:<?= $kelengkapan_laporan_inm_checked; ?> " id="kelengkapan_laporan_inm_catatan" name="kelengkapan_laporan_inm_catatan" value="<?=$data[0]['kelengkapan_laporan_inm_catatan'] ;?>" ></td>

                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Data Laporan IKP</td>
                        
                            <td>   
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelengkapan_laporan_ikp" id="kelengkapan_laporan_ikp1" value="2" required <?=$kelengkapan_laporan_ikp_y ;?>>
                                    <label class="form-check-label" for="kelengkapan_laporan_ikp1">
                                        Sesuai Persyaratan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kelengkapan_laporan_ikp" id="kelengkapan_laporan_ikp2" value="1" <?=$kelengkapan_laporan_ikp_n ;?>>
                                    <label class="form-check-label" for="kelengkapan_laporan_ikp2">
                                        Belum Sesuai
                                    </label>
                                </div>
                            </td>
                            <td><input type="text" class="form-control" style="display:<?= $kelengkapan_laporan_ikp_checked; ?>" id="kelengkapan_laporan_ikp_catatan" name="kelengkapan_laporan_ikp_catatan" value="<?=$data[0]['kelengkapan_laporan_ikp_catatan'] ;?>" ></td>
                        </tr> 
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary rounded-pill">Submit</button> 
            </form>
        </div>
    </div>

    <!-- Batas Tab -->
    <div class="tab-pane fade" id="verifikator" role="tabpanel" aria-labelledby="verifikator-tab">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pemilihan Verifikator</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <?php echo form_open_multipart('Pengajuan/simpanPenetapanVerifikator') ?>
                    <form role="form"  method="post" class="login-form" name="form_valdation">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $data[0]['id'] ?>">
                            <input type="hidden" class="form-control" id="pengiriman_laporan_survei_id" name="pengiriman_laporan_survei_id" value="<?= $data[0]['pengiriman_laporan_survei_id'] ?>">
                            <input type="hidden" class="form-control" id="penetapan_verifikator_id" name="penetapan_verifikator_id" value="<?= $data[0]['penetapan_verifikator_id'] ?>">

                            <div class="form-group col-md-12"> 
                                <div class="form-group col-md-12">
                                    <label for="helperText">Daftar Verifikator</label>
                                    <?=form_dropdown('users_id', dropdown_sina_verifikator($lpa_id), (!empty($data[0]['users_id_penetapan_verifikator']) ? $data[0]['users_id_penetapan_verifikator'] : ''),'id="users_id" class="form-select"');?>
                                </div>
                            </div>
                            <div class="form-group col-md-12"> 
                                <div class="form-group col-md-12">
                                    <!-- <label for="helperText">Nama Surveior 1</label> -->
                                    <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
                                </div>
                            </div>

                    </form>    
                </div>
            </div>
        </div>
    </div>
    <!-- Batas Tab -->

    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        </br>
        <div class="col-md-6 mb-1">
            <?php echo form_open_multipart('Pengajuan/simpanPenetapanTanggalSurvei') ?>
                        <form role="form"  method="post" class="login-form" name="form_valdation">
            <p>Dokumen Kontrak <i><small class="text-muted"><a href="https://docs.google.com/document/d/1uXYZsuQLofqcGqPyez-ASbufyDDYMpYS/edit?usp=sharing&ouid=109754320285918165578&rtpof=true&sd=true"target="_blank" href="">Download Contoh</a> </i></small></p>
                <fieldset>
                    <div class="input-group">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $data[0]['id'] ?>">
                        <input type="hidden" class="form-control" id="kelengkapan_berkas_id" name="kelengkapan_berkas_id" value="<?= $data[0]['kelengkapan_berkas_id'] ?>">
                        <input type="hidden" class="form-control" id="penetapan_tanggal_survei_id" name="penetapan_tanggal_survei_id" value="<?= $data[0]['penetapan_tanggal_survei_id'] ?>">
                        
                            <input type="file" class="form-control" id="url_dokumen_kontrak" name="url_dokumen_kontrak"
                                aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                
                                <?php 
                                if(!empty($data[0]['url_dokumen_kontrak'])) {
                                    $url_dokumen_kontrak = $data[0]['url_dokumen_kontrak'];
                                    ?>
                                 <a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo $url_dokumen_kontrak ;?>">Lihat Dokumen</a>
                                <?php
                                } else {
                                    $url_dokumen_kontrak = "";
                                }
                                ?>
                               
                                <input type="hidden"  name="old_url_dokumen_kontrak"  value="<?=$url_dokumen_kontrak?>" id="old_url_dokumen_kontrak">
                    
                    </div>
                </fieldset>
        </div>

        <?php 

                    //var_dump($data);

                    if(is_null($data[0]['kelengkapan_berkas_id_2'])){
                        //$lpa_id = '';
                        
                        $tanggal_survei = '';
                    } else {
                        //$lpa_id = $data[0]['lpa_id'];
                        
                        $tanggal_survei = $data[0]['tanggal_survei'];
                        $tanggal_survei = date("m/d/Y", strtotime($tanggal_survei));
                    }

        ?>

        <div class="form-group">
            <label for="helperText">Tanggal Survei</label>
            <!-- <input type="text"  name="tanggal_survei" id="tanggal_survei" value="<?= $tanggal_survei ?>"  class="form-control datepicker"  autocomplete="off" required > -->
            <div class="row">
                                        <div class="col-md-4">
                                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="<?= $data[0]['tanggal_awal_rencana_survei'] ?>" disabled>
                                        </div>
                                        s.d.
                                        <div class="col-md-4">
                                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="<?= $data[0]['tanggal_akhir_rencana_survei'] ?>" disabled>
                                        </div>
            </div>
        </div>

        <div class="form-group">
            <label for="helperText">Metode Survei</label>
            <?=form_dropdown('metode_survei_id', array(1=>'Luring',2=>'Hybrid'),$data[0]['metode_survei_id'],'id="metode_survei_id"  class="form-select" required');?>
        </div>

        <div class="col-md-6 mb-1">
            <p>Link Dokumen Pendukung Elemen Penilaian (EP)</p>
                <fieldset>
                    <!-- <div class="input-group">
                        <input type="file" class="form-control" id="url_dokumen_pendukung_ep" name="url_dokumen_pendukung_ep"
                            aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    
                    </div> -->
                    <textarea class="form-control" id="url_dokumen_pendukung_ep" name="url_dokumen_pendukung_ep"> <?=  $data[0]['url_dokumen_pendukung_ep']; ?></textarea>
                    <?php 
                                if(!empty($data[0]['url_dokumen_pendukung_ep'])) {
                                    $url_dokumen_pendukung_ep = $data[0]['url_dokumen_pendukung_ep'];
                                    ?>
                                 <a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo prep_url($url_dokumen_pendukung_ep);?>">View URL</a>
                                <?php
                                } else {
                                    $url_dokumen_pendukung_ep = "";
                                }
                                ?>
                               
                                <input type="hidden"  name="old_url_url_dokumen_pendukung_ep"  value="<?=$url_dokumen_pendukung_ep?>" id="old_url_url_dokumen_pendukung_ep">
                    
                </fieldset>

        </div>

        <div class="form-group col-md-12"> 
            <div class="form-group col-md-8">
                <label for="helperText">Nama Surveior 1</label>
                <?=form_dropdown('surveior_satu', dropdown_sina_surveior($lpa_id),$data[0]['surveior_satu'],'id="surveior_satu"  class="form-select" ');?>
            </div>
          
        </div>
        <div class="form-group col-md-12"> 
            <div class="form-group col-md-8">
                <label for="helperText">Status Tim Surveior 1</label>
                <?=form_dropdown('status_surveior_satu', array(1=>'Ketua',2=>'Anggota'),$data[0]['status_surveior_satu'],'id="status_surveior_satu"  class="form-select" required');?>
            </div>
          
        </div>

        <div class="form-group col-md-12"> 
            <div class="form-group col-md-8">
            <label for="helperText">Nama Surveior 2</label>
            <?=form_dropdown('surveior_dua', dropdown_sina_surveior($lpa_id),$data[0]['surveior_dua'],'id="surveior_dua"  class="form-select" ');?>
            </div>
       
        </div>
        <div class="form-group col-md-12"> 
            <div class="form-group col-md-8">
                <label for="helperText">Status Tim Surveior 2</label>
                <?=form_dropdown('status_surveior_dua', array(1=>'Ketua',2=>'Anggota'),$data[0]['status_surveior_dua'],'id="status_surveior_dua"  class="form-select" required');?>
            </div>
          
        </div>
        <div class="form-group col-md-12"> 
            <div class="form-group col-md-6">
                <label for="helperText">Surat Tugas</label>
                <div class="input-group">
                                <input type="file" class="form-control" id="url_surat_tugas" name="url_surat_tugas"
                                aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                
                                <?php 
                                if(!empty($data[0]['url_surat_tugas'])) {
                                    $url_surat_tugas = $data[0]['url_surat_tugas'];
                                    ?>
                                 <a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo $url_surat_tugas ;?>">Lihat Dokumen</a>
                                <?php
                                } else {
                                    $url_surat_tugas = "";
                                }
                                ?>
                               
                                <input type="hidden"  name="old_url_surat_tugas"  value="<?=$url_surat_tugas?>" id="old_url_surat_tugas">
                            </div>
                            </div>
          
        </div>
        


        <!-- <div class="card-header">
                    Detail Data Surveior LPA
            </div>

            <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Surveior 1</th>
                            <th>Surveior 2</th>
                           
                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                NIK     :  </br>
                                Nama    :   </br>
                                Email     :  </br>
                                LPA    :   </br>
                                No HP : </br>
                                Provinsi : </br>
                                Kab/Kota : </br>
                                Keaktifan : </br>
                                Fasyankes : </br>
                                Bidang : </br>
                                Status Tim : </br>

                            </td>
                            <td>
                                NIK     :  </br>
                                Nama    :   </br>
                                Email     :  </br>
                                LPA    :   </br>
                                No HP : </br>
                                Provinsi : </br>
                                Kab/Kota : </br>
                                Keaktifan : </br>
                                Fasyankes : </br>
                                Bidang : </br>
                                Status Tim : </br>
                            </td>
                            
                        </tr>
                        
                    </tbody>
                </table> -->
        

        <button type="submit" class="btn btn-primary rounded-pill">Submit</button> 
        </form>



    </div>


   
</div>
   
</div>
</div>
       
</div>
    
</div>
</section>           


            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2022 &copy; Kemenkes</p>
                    </div>
                 
                </div>
            </footer>
</div>
</div>
</div>
</div> 
   
    <script src="<?php echo base_url()?>assets/js/app.js">
   
    </script>
   
</body>

</html>

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>



<script>
    $( function() {
        $( "#datepicker" ).datepicker();
        $( "#datepickerstr" ).datepicker();
        $( "#tanggal_survei" ).datepicker();
        
    } );

    $('input[name="kelengkapan_berkas_usulan"]').on('click change', function(e) {
        if($(this).val()==2){
            document.getElementById("kelengkapan_berkas_usulan_catatan").style.display = "none";
            $("#kelengkapan_berkas_usulan_catatan").removeAttr('required');  //turns required off
        }else if($(this).val()==1){
            document.getElementById("kelengkapan_berkas_usulan_catatan").style.display = "block";
            $("#kelengkapan_berkas_usulan_catatan").attr('required', '');    //turns required on
        }

    }); 
    $('input[name="kelengkapan_dfo"]').on('click change', function(e) {
        if($(this).val()==2){
            document.getElementById("kelengkapan_dfo_catatan").style.display = "none";
            $("#kelengkapan_dfo_catatan").removeAttr('required');  //turns required off
        }else if($(this).val()==1){
            document.getElementById("kelengkapan_dfo_catatan").style.display = "block";
            $("#kelengkapan_dfo_catatan").attr('required', '');    //turns required on
        }

    }); 
    $('input[name="kelengkapan_nakes"]').on('click change', function(e) {
        if($(this).val()==2){
            document.getElementById("kelengkapan_nakes_catatan").style.display = "none";
            $("#kelengkapan_nakes_catatan").removeAttr('required');  //turns required off
        }else if($(this).val()==1){
            document.getElementById("kelengkapan_nakes_catatan").style.display = "block";
            $("#kelengkapan_nakes_catatan").attr('required', '');    //turns required on
        }

    }); 
    $('input[name="kelengkapan_sarpras_alkes"]').on('click change', function(e) {
        if($(this).val()==2){
            document.getElementById("kelengkapan_sarpras_alkes_catatan").style.display = "none";
            $("#kelengkapan_sarpras_alkes_catatan").removeAttr('required');  //turns required off
        }else if($(this).val()==1){
            document.getElementById("kelengkapan_sarpras_alkes_catatan").style.display = "block";
            $("#kelengkapan_sarpras_alkes_catatan").attr('required', '');    //turns required on
        }

    }); 
        $('input[name="kelengkapan_laporan_inm"]').on('click change', function(e) {
        if($(this).val()==2){
            document.getElementById("kelengkapan_laporan_inm_catatan").style.display = "none";
            $("#kelengkapan_laporan_inm_catatan").removeAttr('required');  //turns required off
        }else if($(this).val()==1){
            document.getElementById("kelengkapan_laporan_inm_catatan").style.display = "block";
            $("#kelengkapan_laporan_inm_catatan").attr('required', '');    //turns required on
        }
            
    });
    $('input[name="kelengkapan_laporan_ikp"]').on('click change', function(e) {
            if($(this).val()==2){
                document.getElementById("kelengkapan_laporan_ikp_catatan").style.display = "none";
                $("#kelengkapan_laporan_ikp_catatan").removeAttr('required');  //turns required off
            }else if($(this).val()==1){
                document.getElementById("kelengkapan_laporan_ikp_catatan").style.display = "block";
                $("#kelengkapan_laporan_ikp_catatan").attr('required', '');    //turns required on
            }
            
    });

    $('#status_usulan_id').on('change', function(e) {
        if($(this).val()==2){
            document.getElementById("keterangan").style.display = "block";
            $("#keterangan").attr('required', '');    //turns required on
        }else if($(this).val()==3){
            $("#keterangan").val("")
            document.getElementById("keterangan").style.display = "none";
            $("#keterangan").removeAttr('required');  //turns required off
        }
    });
    // $('#surveior_satu').on('change', function(e) {
    //     $tes=$(this).val();
    //    // alert($tes);
    //     $.ajax({
    //     url : "<?php echo base_url('/detailsurveior'); ?>"
    //     type : "POST",
    //     dataType : "json",
    //     data : {"account" : account, "passwd" : passwd},
    //     success : function(data) {
    //         // do something
    //     },
    //     error : function(data) {
    //         // do something
    //     }
    // });
    // });


    
    </script>
