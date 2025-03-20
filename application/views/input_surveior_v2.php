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
                                <th>Bidang 1</th>
                                <th>Bidang 2</th>
                            
                            </tr>
                        </thead>
                        
                        <tbody>
                        <?php
                        //var_dump($data);
                                $n=1;
                                foreach ($datav as $datab) {    
                                    $key = $datab['id'];

                                     
                            ?>
                        <tr>
                                <td><?= $n++ ?></td>
                                <td><?= $datab['nama'];?> </td>
                                
                                <?php
                                if($key == 1){
                                    //$a=1;
                                    ?>
                                   <td>
                                   <input type="hidden" id="nama_bidang[]" name="nama_bidang[1]"  value="<?= $data['7']['bidang'] ?>"> 
                                    <input type="radio" id="bidang[]" name="is_checked[<?=$data[1]['fasyankes_id'];?>]" value="1" fasyankes="<?= $data[7]['fasyankes_id'] ?>"><?= $data[7]['bidang'] ?>
                                        <input type="hidden" id="fasyankes[]" name="fasyankes[1]"  value="1">
                                        <input type="hidden" name="id_bidang[]" value="7"></td>
                                   <td><input type="hidden" id="nama_bidang[]" name="nama_bidang[1]"  value="<?= $data['9']['bidang'] ?>">  
                                    <input type="radio" id="bidang[]" name="is_checked[<?=$data[1]['fasyankes_id'];?>]" value="1" fasyankes="<?= $data[9]['fasyankes_id'] ?>"><?= $data[9]['bidang'] ?>
                                        <input type="hidden" id="fasyankes[]" name="fasyankes[1]"  value="1">
                                        <input type="hidden" name="id_bidang[]" value="10"></td>
                                 <?php }else if($key == 2){?>
                                    <td> <input type="radio" id="bidang[]" name="is_checked[<?=$data[2]['fasyankes_id'];?>]" value="1" fasyankes="<?= $data[5]['fasyankes_id'] ?>"><?= $data[5]['bidang'] ?>
                                        <input type="hidden" id="fasyankes[]" name="fasyankes[2]"  value="2">
                                        <input type="hidden" name="id_bidang[]" value="5"></td>
                                    <td> <input type="radio" id="bidang[]" name="is_checked[<?=$data[2]['fasyankes_id'];?>]" value="1" fasyankes="<?= $data[8]['fasyankes_id'] ?>"><?= $data[8]['bidang'] ?>
                                        <input type="hidden" id="fasyankes[]" name="fasyankes[2]"  value="2">
                                        <input type="hidden" name="id_bidang[]" value="8"></td>

                                <?php }else if($key == 3){?>
                                    <td> <input type="radio" id="bidang[]" name="is_checked[<?=$data[3]['fasyankes_id'];?>]" value="1" fasyankes="<?= $data[5]['fasyankes_id'] ?>"><?= $data[5]['bidang'] ?>
                                        <input type="hidden" id="fasyankes[]" name="fasyankes[3]"  value="3">
                                        <input type="hidden" name="id_bidang[]" value="6"></td>
                                    <td> <input type="radio" id="bidang[]" name="is_checked[<?=$data[3]['fasyankes_id'];?>]" value="1" fasyankes="<?= $data[9]['fasyankes_id'] ?>"><?= $data[9]['bidang'] ?>
                                        <input type="hidden" id="fasyankes[]" name="fasyankes[3]"  value="3">
                                        <input type="hidden" name="id_bidang[]" value="9"></td>
                                <?php }else if($key == 6){?>
                                    <td> <input type="radio" id="bidang[]" name="is_checked[<?=$data[6]['fasyankes_id'];?>]" value="1" fasyankes="<?= $data[2]['fasyankes_id'] ?>"><?= $data[2]['bidang'] ?>
                                        <input type="hidden" id="fasyankes[]" name="fasyankes[6]"  value="6">
                                        <input type="hidden" name="id_bidang[]" value="3"></td>
                                    <td> <input type="radio" id="bidang[]" name="is_checked[<?=$data[6]['fasyankes_id'];?>]" value="1" fasyankes="<?= $data[3]['fasyankes_id'] ?>"><?= $data[3]['bidang'] ?>
                                        <input type="hidden" id="fasyankes[]" name="fasyankes[6]"  value="6">
                                        <input type="hidden" name="id_bidang[]" value="4"></td>
                                <?php }else if($key == 7){?>
                                    <td> <input type="radio" id="bidang[]" name="is_checked[<?=$data[7]['fasyankes_id'];?>]" value="1" fasyankes="<?= $data[0]['fasyankes_id'] ?>"><?= $data[0]['bidang'] ?>
                                        <input type="hidden" id="fasyankes[]" name="fasyankes[7]"  value="7">
                                        <input type="hidden" name="id_bidang[]" value="1"></td>
                                    <td> <input type="radio" id="bidang[]" name="is_checked[<?=$data[7]['fasyankes_id'];?>]" value="1" fasyankes="<?= $data[1]['fasyankes_id'] ?>"><?= $data[1]['bidang'] ?>
                                        <input type="hidden" id="fasyankes[]" name="fasyankes[7]"  value="7">
                                        <input type="hidden" name="id_bidang[]" value="2"></td>
                                
                                <?php
                                }

                                
                                ?>
                               
                               
                            </tr>
                            <?php
                              //}  
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
        $('input[type=radio]').click(function(){
    if (this.previous) {
        this.checked = false;
    }
    this.previous = this.checked;
});
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
