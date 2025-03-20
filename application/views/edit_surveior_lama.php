<?php

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Surveior</title>
    
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main/app-dark.css');?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg');?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png');?>" type="image/png">
    
</head>

<body>
    <?php
    include('template/sidebar.php');
    $provinsi_id = $data[0]['provinsi_id'];
    $kota_id = $data[0]['kabkota_id'];
    ?>
       
<section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data Surveior</h4>
            </div>
            <?php echo form_open_multipart('Pengajuan/simpanSurveior') ?>
            <form role="form"  method="post" class="login-form" name="form_valdation">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" onchange="checkniksurveior(this.value, this.id)" placeholder="Masukkan NIK" value="<?= $data[0]['nik']?>" disabled>
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $data[0]['id']?>">
                            <input type="hidden" class="form-control" id="users_id" name="users_id" value="<?= $data[0]['users_id']?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama"  value="<?= $data[0]['nama']?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" onchange="checkemail(this.value, this.id)" placeholder="Masukkan Email"  value="<?= $data[0]['email']?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="lpa">LPA</label>
                            <input type="text" class="form-control" id="lpa" name="lpa_id" placeholder="LPA 1" disabled>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Hp</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp"  value="<?= $data[0]['no_hp']?>">
                        </div>
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                           
                            <?=form_dropdown('propinsi', dropdown_sina_propinsi(),$provinsi_id,'id="provinsi_id" onchange="tes()" class="form-select" required');?>
                        </div>
                        <div class="form-group">
                            <label for="kabkota">Kab/Kota</label>
                            <input type="hidden" class="form-control" id="kabkota" name="kabkota" placeholder="Masukkan No HP"  value="<?= $data[0]['kabkota_id']?>">
                            <?=form_dropdown('kota', dropdown_sina_kab_kota($provinsi_id),$kota_id,'id="kabkota_id"  class="form-select" required');?>
                        </div>
                        <div class="form-group">
                            <label for="keaktifan">Keaktifan</label>
                            <?=form_dropdown('keaktifan', array('1'=>'PNS','2'=>'SWASTA', '3'=>'Purna Tugas'),'','id="keaktifan"  class="form-select" ');?>
                        </div>
                        <div class="form-group col-md-12"> 
                            <div class="form-group col-md-6">
                                <label for="helperText">Sertifikat Surveior</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="url_sertifikat_surveior" name="url_sertifikat_surveior"
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
                            </div>
                            <div class="form-group col-md-12"> 
                            <div class="form-group col-md-6">
                                <label for="helperText">Surat Keputusan Keanggotaan dari Lembaga</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="url_surat_keputusan_keanggotaan" name="url_surat_keputusan_keanggotaan"
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
                    <div class="col-md-6">
                        <?php echo form_open_multipart('Pengajuan/simpanSurveiorDetail') ?>
                        <form role="form"  method="post" class="login-form" name="form_valdation">
                        <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Fasyankes</th>
                                <th>Bidang</th>
                                <th>Action</th>
                            
                            </tr>
                        </thead>
                        
                        <tbody>
                        <?php
                                $n=1;
                                // var_dump($datac[2]['is_checked']);
                                 
                                foreach ($datab as $data) { 
                                    $key = $data['id'];
                                     
                            ?>
                        <tr>
                                <td><?= $n++ ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['bidang'] ?></td>

                                <input type="hidden" id="nama_bidang[]" name="nama_bidang[<?=$key;?>]"  value="<?= $data['bidang'] ?>">
                                
                                <input type="hidden" id="fasyankes[]" name="fasyankes[<?=$key;?>]"  value="<?= $data['fasyankes_id'] ?>">
                                <input type="hidden" name="id_bidang[]" value="<?=$key;?>">
                                
                                
                                
                         
                            
<?php   
            //  foreach ($datac as $datas) {                 
                            // if($datas['id_bidang'] == $data['id']){
                                
                                        if($datac[$data['id']]['is_checked'] == 1){
                                        ?>
                                        <td><input type="checkbox" id="bidang[]" name="is_checked[<?=$key;?>]" value="1" checked></th>
                                        
                                        <?php
                                    }else {
                                        ?>
                                        <td><input type="checkbox" id="bidang[]" name="is_checked[<?=$key;?>]" value="1"></td>
                                        <?php
                                    }
                                    ?>
                                    <input type="hidden" name="ids[<?=$key;?>]" value="<?=$datac[$data['id']]['id'];?>">
                                <?php
                        
                                }
                            ?>
                               </tr>
                        </tbody>
                        </table>
                    
                      

                    </form> 
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary me-1 mb-1">Edit</button>
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
                                        // Install input filters.
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
<script >
   
 
   $('[name="propinsi"]').change(function() {
        $("#kota_id").removeAttr('readonly');  //turns required off
        $('#kota_id').val('');
        
            $.ajax({
        url: "../dropdown5/" + $(this).val(),
        dataType: "json",
        type: "GET",
        success: function(data) { //
        addOption($('[name="kota"]'), data, 'id_kota', 'nama_kota');
        }
        }); 
    });
 
//  $('[name="kota"]').change(function() {
//        $('#kecamatan').val('');
//           $.ajax({
//        url: "<?php echo site_url('pengajuan/dropdown6')?>/" + $('#provinsi_id').val()+"/"+ $(this).val(),
//        dataType: "json",
//        type: "GET",
//        success: function(data) { //
//       addOption($('[name="kecamatan"]'), data, 'id_camat', 'nama_camat');
//        }
//     }); 
    
   
//  });
 function tes(){
    // $("#kota_id").removeAttr('readonly');  //turns required off
    //     $('#kota_id').val('');
        
    //         $.ajax({
    //     url: "../dropdown5/" + $(this).val(),
    //     dataType: "json",
    //     type: "GET",
    //     success: function(data) { //
    //     addOption($('[name="kota"]'), data, 'id_kota', 'nama_kota');
    //     }
    //     }); 
    alert('tes');
 }
 

function check() {
  if(document.getElementById('kata_sandi').value ===
          document.getElementById('kata_sandi_confirm').value) {
      document.getElementById('message').innerHTML = "<font color='green'>Password Sama</font>";
       document.getElementById('submit').disabled = false;
  } else {
      document.getElementById('message').innerHTML = "<font color='red'>Password Tidak Sama</font>";
       document.getElementById('submit').disabled = true;
  }
}
 
 function addOption(ele, data, key, val) { //alert(data.length);
 $('option', ele).remove();

 ele.append(new Option('', 9999));
 $(data).each(function(index) { //alert(eval('data[index].' + nama));
    ele.append(new Option(eval('data[index].' + val), eval('data[index].' + key)));
   
 });
}
</script>
    
   
</body>

</html>
