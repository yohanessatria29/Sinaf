<?php

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Usul Survei</title>
    
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main/app-dark.css');?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg');?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png');?>" type="image/png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
</head>

<body>
    <?php
    include('template/sidebar.php');
    $provinsi_id = '';
    $kota_id = '';
    ?>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Input Data Surveior</h4>
            </div>
            <?php echo form_open_multipart('Pengajuan/simpanSurveior') ?>
                        <form role="form"  method="post" class="login-form" name="form_valdation">
            <div class="card-body">
                <div class="row">
                   
                    <div class="col-md-6">
                        
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" onchange="checkniksurveior(this.value, this.id)" required placeholder="Masukkan NIK" >
                        </div>
                        
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama"  required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email" onchange="checkemail(this.value, this.id)" required>
                        </div>
                        <div class="form-group">
                            <label for="lpa">LPA</label>
                            <input type="text" class="form-control" id="lpa_id" name="lpa_id" placeholder="LPA 1" value="<?=$lpa_id?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Hp</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" required placeholder="Masukkan No HP">
                        </div>
                        <div class="form-group">
                            <label for="propinsi">Provinsi</label>
                           
                            <?=form_dropdown('propinsi', dropdown_sina_propinsi(),$provinsi_id,'id="provinsi_id"  class="form-select" required');?>
                        </div>
                        <div class="form-group">
                            <label for="kabkota">Kab/Kota</label>
                            <?=form_dropdown('kota', dropdown_sina_kab_kota(),$kota_id,'id="kota_id"  class="form-select" required');?>
                        </div>
                        <div class="form-group">
                            <label for="keaktifan">Keaktifan</label>
                            <?=form_dropdown('keaktifan', array('1'=>'PNS','2'=>'SWASTA', '3'=>'Purna Tugas'),'','id="keaktifan"  class="form-select" ');?>
                        </div>

                        <div class="form-group col-md-12"> 
                            <div class="form-group col-md-6">
                                <label for="helperText">Sertifikat Surveior</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="url_sertifikat_surveior" required name="url_sertifikat_surveior"
                                aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                
                                <?php 
                                if(!empty($data[0]['url_sertifikat_surveior'])) {
                                    $url_sertifikat_surveior = $data[0]['url_sertifikat_surveior'];
                                    ?>
                                 <a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo $url_sertifikat_surveior ;?>">Lihat Dokumen</a>
                                <?php
                                } else {
                                    $url_sertifikat_surveior = "";
                                }
                                ?>
                               
                                <input type="hidden"  name="old_url_sertifikat_surveior"  value="<?=$url_sertifikat_surveior?>" id="old_url_sertifikat_surveior">
                            </div>
                        </div>
                        <div class="form-group col-md-12"> 
                            <div class="form-group col-md-6">
                                <label for="helperText">Surat Keputusan Keanggotaan dari Lembaga</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="url_surat_keputusan_keanggotaan" required name="url_surat_keputusan_keanggotaan"
                                aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                
                                <?php 
                                if(!empty($data[0]['url_surat_keputusan_keanggotaan'])) {
                                    $url_surat_keputusan_keanggotaan = $data[0]['url_surat_keputusan_keanggotaan'];
                                    ?>
                                 <a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo $url_surat_keputusan_keanggotaan ;?>">Lihat Dokumen</a>
                                <?php
                                } else {
                                    $url_surat_keputusan_keanggotaan = "";
                                }
                                ?>
                               
                                <input type="hidden"  name="old_url_surat_keputusan_keanggotaan"  value="<?=$url_surat_keputusan_keanggotaan?>" id="old_url_surat_keputusan_keanggotaan">
                            </div>
                        </div>
                            </div>
          
        </div>
                        
                    </div>
                   
                    <div class="col-md-6">
                        
                        <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Fasyankes</th>
                                <th>Bidang</th>
                               
                            
                            </tr>
                        </thead>
                        
                        <tbody>
                        <?php
                                $n=1;

                                foreach ($data as $data) {    
                                    $key = $data['id'];
                            //var_dump($key);
                            $bidang_id = $key;
                            ?>
                        <tr>
                                <td><?= $n++ ?></td>
                                <td><?= $data['nama'] ?> </td>
                                <input type="hidden" id="fasyankes_id" name="fasyankes_id"  value="<?= $data['id'] ?>">
                                <td>  <?=form_dropdown('bidang', dropdown_sina_bidang($bidang_id),$bidang_id,'id="bidang_id"  class="form-select" required');?></td>
                               
                            </tr>
                            <?php
                                }
                       ?>

                        
                        </tbody>
                        </table>
                    
                      

                    
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
            </div>
            
                        </form>

        </div>
    </section>



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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/js/apa.js"></script>
    <script src="<?php echo base_url()?>assets/js/app.js"></script>
    <script>
                                        // Restricts input for the given textbox to the given inputFilter.
                                        function setInputFilter(textbox, inputFilter) {
                                            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
                                                textbox.addEventListener(event, function() {
                                                    if (inputFilter(this.value)) {
                                                        this.oldValue = this.value;
                                                        this.oldSelectionStart = this.selectionStart;
                                                        this.oldSelectionEnd = this.selectionEnd;
                                                    } else if (this.hasOwnProperty("oldValue")) {
                                                        this.value = this.oldValue;
                                                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                                                    } else {
                                                        this.value = "";
                                                    }
                                                });
                                            });
                                        }
                                        // Install input filters.
                                        setInputFilter(document.getElementById("nik"), function(value) {
                                            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 9999999999999999);
                                        });
                                        setInputFilter(document.getElementById("no_hp"), function(value) {
                                            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 999999999999);
                                        });
                                    </script> 
    <script>
        function checkemail(val, inputbox) {
            // alert("The input value has changed. The new value is: " + val);
            var base_url = window.location.origin;
            var username = encodeURIComponent(val);
            var id_inputbox = document.getElementById(inputbox);

            $.ajax({
                url: base_url + '/sina/pengajuan/checkemail/' + username,
                type: 'get',
                success: function(response) {
                    // alert(response);
                    $(this).val = "";
                    if (response > 0) {
                        id_inputbox.value = "";
                        alert('Email yang digunakan sudah terdaftar !');
                    }
                }
            })
        }

        function checkniksurveior(val, inputbox) {
            // alert("The input value has changed. The new value is: " + val);
            var base_url = window.location.origin;
            var username = encodeURIComponent(val);
            var id_inputbox = document.getElementById(inputbox);

            $.ajax({
                url: base_url + '/sina/pengajuan/checkniksurveior/' + username,
                type: 'get',
                success: function(response) {
                    // alert(response);
                    $(this).val = "";
                    if (response > 0) {
                        id_inputbox.value = "";
                        alert('NIK yang digunakan sudah terdaftar !');
                    }
                }
            })
        }
    </script>
</body>

</html>
