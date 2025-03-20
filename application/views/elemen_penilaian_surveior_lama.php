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
                            aria-controls="home" aria-selected="true">Daftar Fasyankes Yang Dinilai</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="persentase-tab" data-bs-toggle="tab" href="#persentase" role="tab"
                            aria-controls="persentase" aria-selected="false">Persentase Capaian</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contacta-tab" data-bs-toggle="tab" href="#contacta" role="tab"
                            aria-controls="contacta" aria-selected="false">Pengiriman Laporan Survei</a>
                    </li>
                    
                    <!-- <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Hasil Kesiapan Survei</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false">Kesepakatan Survei</a>
                    </li> -->
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
            <!-- <div class="card-header">
                <h3> <b> Elemen Penilaian Surveior</b> </h3>
            </div> -->
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
                // var_dump($trans);
                // var_dump($data);
            ?>

                    <?php echo form_open_multipart('surveior/epsurveior/'.$id) ?>
                        <form role="form"  method="post" class="login-form" name="form_valdation">
                            <div class="form-group row align-items-center">
                                    
                                    <div class="row">
                                    <div class="col-lg-2 col-4">
                                        <label class="col-form-label">Kode Fasyankes :</label>
                                    </div>
                                        <div class="col-md-8">
                                        <label class="col-form-label"> <?=$data[0]['fasyankes_id'];?></label>
                                        </div>
                                    </div>
            </div>
            <div class="form-group row align-items-center">
                                    <div class="col-lg-2 col-3">
                                        <label class="col-form-label">Nama Fasyankes</label>
                                    </div>
                                    <div class="col-lg-10 col-9">
                                        <label class="col-form-label"> </label>
                                    </div>
            </div>
            <div class="form-group row align-items-center">
                                    <div class="col-lg-2 col-3">
                                        <label class="col-form-label">Jenis Fasyankes</label>
                                    </div>
                                    <div class="col-lg-10 col-9">
                                        <label class="col-form-label"><?=$jenis_fasyankes;?></label>
                                    </div>
            </div>
            <div class="form-group row align-items-center">
                                    <div class="col-lg-2 col-3">
                                        <label class="col-form-label">BAB</label>
                                    </div>
                                    <div class="col-lg-10 col-9">
                                    <?=form_dropdown('bab', dropdown_sina_ep($data[0]['jenis_fasyankes']),$bab,'id="bab"  class="form-select" required');?>
                                    <?php //var_dump($data[0]);?>
                                    </div>
            </div>
            <div class="buttons">
                <!-- <a href="#" class="btn btn-success rounded-pill">Tampilkan</a> -->
                <button type="submit" class="btn btn-success me-1 mb-1">Cari</button>     
                <!-- <a href="#" class="btn btn-light rounded-pill">Bersihkan</a> -->
           </div>

           </form>
            

            <?php
            //}
            ?>
            <div class="card-body">
            <?php echo form_open_multipart('surveior/simpanEp/') ?>
                        <form role="form"  method="post" class="login-form" name="form_valdation">
                <?php
                //var_dump($data);
                //var_dump($datab);
                 ?>
                <div class="table-responsive">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bab</th>
                            <th>Standar</th>
                            <th>Kriteria</th>
                            <th>Elemen Penilaian</th>
                            <th>Uraian</th>
                            <th>SKOR Capaian Surveior</th>
                            <th>SKOR Maksimal</th>
                            <th>Persentase Capaian Surveior</th>
                            <th>FAKTA DAN ANALISIS</th>
                            <th>REKOMENDASI Hasil Survei</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $n=1;
                        foreach ($datab as $datab) {
                            $key = $datab['id'];    
                            
                        ?>
                        <tr>
                        <td><?=$n;?></td>                           
                                <td><?= $datab['bab'] ?></td>
                                <td><?= $datab['standar'] ?></td>
                                <td><?= $datab['kriteria'] ?></td>
                                <td><?= $datab['elemen'] ?></td>
                                <td><?= $datab['keterangan_elemen'] ?></td>

                        <?php
                            if(!empty($trans)){
                                // foreach ($trans as $trans2) {
                                //     var_dump($trans2['elemen_penilaian_id']);
                                //     var_dump($key);
                                //     if($trans['elemen_penilaian_id'] == $key){

                        ?>

                                <td>
                                    <select class="form-select skor_capaian_surveior" id="skor_capaian_surveior" name="skor_capaian_surveior[<?=$key;?>]">
                                        <option value='0' <?php if ((!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : '')  == "0") echo "selected" ?> >0</option>
                                        <option value='5' <?php if ((!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : '')  == "5") echo "selected" ?>>5</option>
                                        <option value='10' <?php if ((!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : '')  == "10") echo "selected" ?>>10</option>
                                        <option value='TDD' <?php if ((!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : '')  == "TDD") echo "selected" ?>>TDD</option>
                                    </select> </td>
                                <?php
                                if ((!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : '') == "TDD"){
                                ?>
                                <td>TDD</td>
                                <?php
                                    } else {
                                ?>
                                <td><?= $datab['skor_maksimal'] ?> </td>
                                <?php
                                    }
                                ?>
                                
                                <td><input type="text" class="form-control" id="presentase_capaian_surveior<?=$n?>" name="presentase_capaian_surveior" value="<?=(!empty($trans[$key]['persentase_capaian_surveior']) ? $trans[$key]['persentase_capaian_surveior'] : 0)?>" readonly></td>
                                <td><textarea class="form-control" rows="4" cols="60" id="fakta_dan_analisis" name="fakta_dan_analisis[<?=$key;?>]"><?=(!empty($trans[$key]['fakta_dan_analisis']) ? $trans[$key]['fakta_dan_analisis'] : '')?></textarea></td>
                                <td><textarea class="form-control" rows="4" cols="50" id="rekomendasi" name="rekomendasi[<?=$key;?>]"><?=(!empty($trans[$key]['rekomendasi']) ? $trans[$key]['rekomendasi'] : '')?></textarea></td>
                        
                        <?php
                                //     }
                                // }
                            } else {
                        ?>
                            
                                <!-- <td> <?=form_dropdown('skor_capaian_surveior', array('0'=>'0','5'=>'5','10'=>'10','TDD'=>'TDD'),'id="skor_capaian_surveior"  class="skor_capaian_surveior form-select"');?></td> -->
                                <!-- <td><input type="text" class="form-control" id="skor_maksimal_surveior" name="skor_maksimal_surveior" value="" readonly></td> -->
                                <td> <select class="form-select skor_capaian_surveior" id="skor_capaian_surveior" name="skor_capaian_surveior[<?=$key;?>]">
                                                    <option value='0'>0</option>
                                                    <option value='5'>5</option>
                                                    <option value='10'>10</option>
                                                    <option value='TDD'>TDD</option>
                                                    
                                    </select> </td>
                                <td><?= $datab['skor_maksimal'] ?> </td>
                                
                                <td><input type="text" class="form-control" id="presentase_capaian_surveior<?=$n?>" name="presentase_capaian_surveior" value="" readonly></td>
                                <td><textarea class="form-control" rows="4" cols="60" id="fakta_dan_analisis" name="fakta_dan_analisis[<?=$key;?>]"></textarea></td>
                                <td><textarea class="form-control" rows="4" cols="50" id="rekomendasi" name="rekomendasi[<?=$key;?>]"></textarea></td>
                                
                        <?php
                            }
                        ?>
                        <input type="hidden" name="skor_maksimal[<?=$key;?>]" value="<?=$datab['skor_maksimal'];?>">
                        <input type="hidden" name="id_ep[]" value="<?=$key;?>">
                        
                            
                        </tr>

                        <?php
                            
                       
                        $n++;
                        }
                        ?>
                        
                    </tbody>
                </table>
                </div>
            </div>
            <input type="hidden" name="penetapan_tanggal_survei_id" value="<?=$data[0]['penetapan_tanggal_survei_id'];?>">
            <input type="hidden" name="id_pengajuan" value="<?=$id;?>">
            <?php

            if ((!empty($data[0]['status_final_ep']) ? $data[0]['status_final_ep'] : '') != '1'){
            ?>
            <button type="submit" class="btn btn-primary rounded-pill">Submit</button> 
            <?php
            }
            ?>
                    </form>
        </div>
</section>
        </div>
    </div>

    <div class="tab-pane fade show" id="contacta" role="tabpanel" aria-labelledby="contacta-tab">
        <div class="page-heading">
            <div class="page-title">
                
            </div>
            <section class="section">

            <div class="card">
            <div class="card-header">
               
            </div>
            <?php echo form_open_multipart('surveior/simpanLaporan/') ?>
                        <form role="form"  method="post" class="login-form" name="form_valdation">
        <div class="row">
</br>
            <div class="form-group col-md-4">
                <!-- <div class="form-group" style='display:block;'>
                    <label for="disabledInput">Tanggal Pengiriman Laporan Survei 1</label>
                  
                    <input type="date"  name="tanggal_pengiriman_laporan" id="tanggal_pengiriman_laporan" value=""  class="form-control datepicker"  autocomplete="off"  >
                </div> -->
                <div class="form-group" style='display:block;'>
                    <label for="disabledInput">Tanggal Survei Hari Pertama</label>
                    <!-- <input type="date" class="form-control" id="disabledInput" placeholder="Disabled Text"> -->
                    <input type="date"  name="tanggal_survei_satu" id="tanggal_survei_satu" value="<?=(!empty($data[0]['tanggal_survei_satu']) ? $data[0]['tanggal_survei_satu'] : '')?>"  class="form-control datepicker"  autocomplete="off"  required>
                </div>
                <div class="form-group" style='display:block;'>
                        <label for="disabledInput">Foto Bukti Survei Hari Pertama</label>
                        <i><small class="text-muted"> Maks 2MB </i></small>
                        <fieldset>
                            <div class="input-group">
                                <input type="file" class="form-control" id="foto_bukti_survei" name="foto_bukti_survei"
                                    aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                
                            </div>
                            <?php 
                                if(!empty($data[0]['url_bukti_satu'])) {
                                    $url_bukti_satu = $data[0]['url_bukti_satu'];
                                    ?>
                                 <a class="btn btn-success rounded-pill" target="_blank" href="<?php echo $url_bukti_satu ;?>">Lihat Dokumen</a>
                                <?php
                                } else {
                                    $url_bukti_satu = "";
                                }
                                ?>

                            <input type="hidden"  name="old_foto_bukti_survei"  value="" id="old_foto_bukti_survei">
                        </fieldset>
                </div> 
            </div>
            <div class="form-group col-md-4">
                <!-- <div class="form-group" style='display:block;'>
                    <label for="disabledInput">Tanggal Pengiriman Laporan Survei 2</label>
                  
                    <input type="date"  name="tanggal_pengiriman_laporan2" id="tanggal_pengiriman_laporan2" value=""  class="form-control datepicker"  autocomplete="off"  >
                </div> -->
                <div class="form-group" style='display:block;'>
                    <label for="disabledInput">Tanggal Survei Hari Kedua</label>
                    <!-- <input type="date" class="form-control" id="disabledInput" placeholder="Disabled Text"> -->
                    <input type="date"  name="tanggal_survei_dua" id="tanggal_survei_dua" value="<?=(!empty($data[0]['tanggal_survei_dua']) ? $data[0]['tanggal_survei_dua'] : '')?>"  class="form-control datepicker"  autocomplete="off"  >
                </div>
                <div class="form-group" style='display:block;'>
                        <label for="disabledInput">Foto Bukti Survei Hari Kedua</label>
                        <i><small class="text-muted"> Maks 2MB </i></small>
                        <fieldset>
                            <div class="input-group">
                                <input type="file" class="form-control" id="foto_bukti_survei2" name="foto_bukti_survei2"
                                    aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                            </div>

                            <?php 
                                if(!empty($data[0]['url_bukti_dua'])) {
                                    $url_bukti_dua = $data[0]['url_bukti_dua'];
                                    ?>
                                 <a class="btn btn-success rounded-pill" target="_blank" href="<?php echo $url_bukti_dua ;?>">Lihat Dokumen</a>
                                <?php
                                } else {
                                    $url_bukti_dua = "";
                                }
                                ?>
                               
                                <input type="hidden"  name="old_foto_bukti_survei2"  value="" id="old_foto_bukti_survei2">
                        </fieldset>
                </div> 
            </div>
            <div class="form-group col-md-4">
                <!-- <div class="form-group" style='display:block;'>
                    <label for="disabledInput">Tanggal Pengiriman Laporan Survei 3</label>
                   
                    <input type="date"  name="tanggal_pengiriman_laporan3" id="tanggal_pengiriman_laporan3" value=""  class="form-control datepicker"  autocomplete="off"  >
                </div> -->
                <div class="form-group" style='display:block;'>
                    <label for="disabledInput">Tanggal Survei Hari Ketiga</label>
                    <!-- <input type="date" class="form-control" id="disabledInput" placeholder="Disabled Text"> -->
                    <input type="date"  name="tanggal_survei_tiga" id="tanggal_survei_tiga" value="<?=(!empty($data[0]['tanggal_survei_tiga']) ? $data[0]['tanggal_survei_tiga'] : '')?>"  class="form-control datepicker"  autocomplete="off"  >
                </div>
                <div class="form-group" style='display:block;'>
                        <label for="disabledInput">Foto Bukti Survei Ketiga</label>
                        <i><small class="text-muted"> Maks 2MB </i></small>
                        <fieldset>
                            <div class="input-group">
                                <input type="file" class="form-control" id="foto_bukti_survei3" name="foto_bukti_survei3"
                                    aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                            </div>
                            <?php 
                                if(!empty($data[0]['url_bukti_tiga'])) {
                                    $url_bukti_tiga = $data[0]['url_bukti_tiga'];
                                    ?>
                                <a class="btn btn-success rounded-pill" target="_blank" href="<?php echo $url_bukti_tiga ;?>">Lihat Dokumen</a>
                                <?php
                                } else {
                                    $url_bukti_tiga = "";
                                }
                                ?>

                            <input type="hidden"  name="old_foto_bukti_survei3"  value="" id="old_foto_bukti_survei3">
                        </fieldset>
                </div> 
            </div>

            
                </div>
                    <input type="hidden" name="penetapan_tanggal_survei_id" value="<?=$data[0]['penetapan_tanggal_survei_id'];?>">
                    <input type="hidden" name="id_pengajuan" value="<?=$id;?>">
                    <button type="submit" class="btn btn-primary rounded-pill">Submit</button> 
                    </form>

        </div>
</section>
        </div>
    </div>


    <!-- Tab Baru -->
    <div class="tab-pane fade show" id="persentase" role="tabpanel" aria-labelledby="persentase-tab">
        <div class="page-heading">
            <div class="page-title">
                
            </div>
            <section class="section">

            <div class="card">
            <!-- <div class="card-header">
               
            </div> -->
            <?php echo form_open_multipart('surveior/final_ep/') ?>
            <form role="form"  method="post" class="login-form" name="form_valdation">
        <!-- <div class="row"> -->
        <div class="card-body">
        <!-- </br> -->
            <div class="row">
                <?php
                // var_dump($count_trans);
                ?>
                <table class="table table-striped" id="table2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bab</th>
                                    <th>Skor Capaian Surveior</th>
                                    <th>Skor Maksimal Surveior</th>
                                    <th>Persentase Capaian Surveior ( % )</th>
                                    <!-- <th>Skor Capaian Verifikator</th>
                                    <th>Skor Maksimal Verifikator</th>
                                    <th>Persentase Capaian Verifikator ( % )</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                        $n=1;
                        foreach ($count_trans as $count_trans) {
                            // $key = $datab['id'];    
                            
                        ?>
                        <tr>
                        <td><?=$n;?></td>                           
                                <td><?= $count_trans['bab'] ?></td>
                                <td><?= $count_trans['skor_capaian_surveior'] ?></td>
                                <td><?= $count_trans['skor_maksimal_surveior'] ?></td>
                                <td><?= number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') ?></td>
                                <!-- <td><?= $count_trans['skor_capaian_verifikator'] ?></td>
                                <td><?= $count_trans['skor_maksimal_verifikator'] ?></td>
                                <td><?= number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '') ?></td> -->
                                </tr>

                        <?php
                            
                       
                        $n++;
                        }
                        ?>

                            </tbody>
                            </table>
                            
            </div>
            
        </div>
                    
            <!-- <a href="#" class="btn icon btn-success">Submit</a> -->
            <input type="hidden" name="penetapan_tanggal_survei_id" value="<?=$data[0]['penetapan_tanggal_survei_id'];?>">
            <input type="hidden" name="id_pengajuan" value="<?=$id;?>">
            <?php
            // var_dump($data[0]['status_final_ep']);

            if ((!empty($data[0]['status_final_ep']) ? $data[0]['status_final_ep'] : '') != '1'){
            ?>
            <button type="submit" class="btn btn-success rounded-pill">Final</button> 
            <?php
            }
            ?>
            </form>

        </div>
</section>
        </div>
    </div>
    <!-- Tab Baru -->

</div>


            
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2022 &copy; Kemenkes</p>
                    </div>
                    <!-- <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div> -->
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

<!-- <script src="<?php echo base_url()?>assets/js/extensions/simple-datatables.js"></script> -->

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $( function() {
        $( "#datepicker" ).datepicker();
        $( "#datepickerstr" ).datepicker();
    } );
    
//     $('[name="skor_capaian_surveior"]').change(function(){
//   alert($skor);
//     });
//     $skor =  $('[name="skor_capaian_surveior"]').val();
//                             console.log($skor);
// $tes = $cek + $data['skor_maksimal'];
$tes2 = $('#apa').val();
$('[name="skor_capaian_surveior"]').on('change', function() {
    $tes= $("#presentase_capaian_surveior").val($(this).find(":selected").val()*100/$tes2);
    
    
    
});
    </script>

<script>
        $(document).ready(function(){
            //alert('tes');
            $("#table1").on('change','.skor_capaian_surveior',function(){
                
                var currentRow = $(this).closest("tr"); 
                var nomor = currentRow.find("td:eq(0)").text();
                var nilaicapaian = currentRow.find('td').eq(6).find('select option:selected').text().replace(/\,/g,'');
                // alert(nilaicapaian);
                var nilaiMax = currentRow.find("td:eq(7)").text();
                if (nilaicapaian== "TDD"){
                    $("#presentase_capaian_surveior"+nomor).val("TDD");
                    currentRow.find("td:eq(7)").text("TDD");

                } else {
                    if (nilaiMax== "TDD"){
                        var persentase = (nilaicapaian / 10) * 100
                        $("#presentase_capaian_surveior"+nomor).val(persentase);
                        
                    } else {
                        var persentase = (nilaicapaian / nilaiMax) * 100
                        $("#presentase_capaian_surveior"+nomor).val(persentase);

                    }
                    currentRow.find("td:eq(7)").text("10");
                }
                
            })
        })
    </script>
