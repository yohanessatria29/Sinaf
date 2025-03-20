<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Fasyankes Yang Dinilai</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main/app-dark.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png'); ?>" type="image/png">

</head>

<body>
    <?php
    include('template/sidebar.php');

    ?>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
            <div class="container">
                <div class="card">

                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Daftar Fasyankes Yang Dinilai</a>
                            </li>
                            <li class="nav-item"><a id="kesiapan-tab" class="nav-link" href="<?php echo base_url('Surveior/jadwal_surveior') ?>">Kesiapan Surveior</a></li>
			    <li class="nav-item"><a class="nav-link" target="_blank" href="https://link.kemkes.go.id/surveior">Asessment Surveyor</a></li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card">
                                    </br>
                                    <?php echo form_open_multipart('Surveior') ?>
                                    <form role="form" method="post" class="login-form" name="form_valdation">
                                        <div class="form-group row align-items-center">
                                            <div class="row">
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label">Tanggal</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="<?= $tanggal_awal ?>">
                                                </div>
                                                s.d.
                                                <div class="col-md-4">
                                                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="<?= $tanggal_akhir ?>" min="<?= $tanggal_awal ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="col-lg-2 col-3">
                                                <label class="col-form-label">Provinsi</label>
                                            </div>
                                            <div class="col-lg-10 col-9">
                                                <?= form_dropdown('propinsi', dropdown_sina_propinsi(), $propinsi, 'id="provinsi_id"  class="form-select" required'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="col-lg-2 col-3">
                                                <label class="col-form-label">Kab/Kota</label>
                                            </div>
                                            <div class="col-lg-10 col-9">
                                                <?= form_dropdown('kota', dropdown_sina_kab_kota(), $kota, 'id="kota_id"  class="form-select"'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="col-lg-2 col-3">
                                                <label class="col-form-label">Jenis Fasyankes</label>
                                            </div>
                                            <div class="col-lg-10 col-9">

                                                <?= form_dropdown('jenis_fasyankes', dropdown_sina_jenis_fasyankes(), $jenis_fasyankes, 'id="jenis_fasyankes"  class="form-select" '); ?>
                                                <?php //var_dump($data);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="col-lg-2 col-3">
                                                <label class="col-form-label">Status Verifikasi</label>
                                            </div>
                                            <div class="col-lg-10 col-9">
                                                <?= form_dropdown('status_verifikasi_id', array(1 => 'Belum Dikirim', 2 => 'Sudah Dikirim'), $status_verifikasi_id, 'id="status_verifikasi_id"  class="form-select"'); ?>
                                            </div>
                                        </div>
                                        <div class="buttons">
                                            <button href="submit" class="btn btn-success rounded-pill">Tampilkan</button>
                                            <a href="<?php echo base_url('surveior/'); ?>" class="btn btn-light rounded-pill">Bersihkan</a>
                                        </div>

                                    </form>

                                    <div class="card-body">
                                        <table class="table table-striped" id="table1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Fasyankes</th>
                                                    <th>Nama Fasyankes</th>
                                                    <th>Jenis Fasyankes</th>
                                                    <th>Provinsi</th>
                                                    <th>Kab/Kota</th>
                                                    <th>Tgl Usulan</th>
                                                    <th>Status</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $n = 1;
                                                foreach ($data as $data) {
                                                    $timestamp = strtotime($data['created_at']);
                                                    $date_formated = date('d-m-Y', $timestamp);



                                                    if ($data['status_surveior'] == 1) {
                                                        $status_surveior = '<span class="badge bg-danger">Belum Dinilai</span>';
                                                    } else if ($data['status_surveior'] == 2) {
                                                        $status_surveior = '<span class="badge bg-warning">Sedang Dinilai</span>';
                                                    } else if ($data['status_surveior'] == 3) {
                                                        $status_surveior = '<span class="badge bg-success">Sudah Dinilai</span>';
                                                    }
                                                ?>

                                                    <tr>
                                                        <td><?= $n; ?></td>

                                                        <td><?= $data['fasyankes_id']; ?></td>
                                                        <td><?= $data['nama_fasyankes']; ?></td>

                                                        <td><?= $data['jenis_fasyankes_nama']; ?></td>
                                                        <td><?= $data['nama_prop']; ?></td>
                                                        <td><?= $data['nama_kota']; ?></td>
                                                        <td><?= $date_formated; ?></td>

                                                        <!-- <td><?= $status_surveior; ?></td> -->
                                                        <td>
                                                            <?php
                                                            if (is_null($data['status_final_ep']) == 1 || is_null($data['pengiriman_laporan_survei_id']) == 1) {

                                                            ?>
                                                                <span class="badge bg-warning">Belum Dikirim</span>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span class="badge bg-success">Sudah Dikirim</span>
                                                            <?php
                                                            }
                                                            ?>

                                                        </td>

                                                        <td>
                                                            <div class="buttons">
                                                                <a href="<?php echo base_url('surveior/epsurveior/') . $data['id']; ?>" class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                    </svg></a>


                                                            </div>
                                                        </td>



                                                        <!-- <input type="button" name="update" svm='<?= $data['id']; ?>' value="Update" class="ruang btn btn-primary"><br> -->
                                                        <!-- <input type="button" name="history" id="history" value="History" class="btn btn-warning">
                            </a> -->

                                                    </tr>

                                                <?php
                                                    $n++;
                                                }
                                                ?>

                                                <!-- <tr>
                            <td>2</td>
                            <td>234</td>
                            <td>Klinik BCA</td>
                            <td>Klinik</td>
                            <td>DKI Jakarta</td>
                            <td>Jakarta Selatan</td>
                            <td>03/08/2022</td>
                            <td><span class="badge bg-success">Disetujui</span></td>
                            <td><div class="buttons">
                            <a href="<?php echo base_url() ?>index.php/pengajuan/detail" class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
                            <a href="#" class="btn icon btn-danger">Delete</a>
                            
                        </div></td>
                        </tr> -->

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
    <script>
        $('[name="propinsi"]').change(function() {
            $("#kota_id").removeAttr('readonly'); //turns required off
            $('#kota_id').val('');

            $.ajax({
                url: "../pengajuan/dropdown5/" + $(this).val(),
                dataType: "json",
                type: "GET",
                success: function(data) { //
                    addOption($('[name="kota"]'), data, 'id_kota', 'nama_kota');
                }
            });
        });

        function addOption(ele, data, key, val) { //alert(data.length);
            $('option', ele).remove();

            ele.append(new Option('', 9999));
            $(data).each(function(index) { //alert(eval('data[index].' + nama));
                ele.append(new Option(eval('data[index].' + val), eval('data[index].' + key)));

            });
        }

        $('#tanggal_awal').change(function() {
            $("#tanggal_akhir").removeAttr('readonly'); //turns required off
            $("#tanggal_akhir").attr('required', ''); //turns required on
            var tanggal_min = $('#tanggal_awal').val();
            $('#tanggal_akhir').val("");
            document.getElementById("tanggal_akhir").setAttribute("min", tanggal_min);


        });
    </script>
    <script src="<?php echo base_url() ?>assets/js/app.js">

    </script>


    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script >
   
 
    $('[name="propinsi"]').change(function() {
       $('#kota_id').val('');
      
          $.ajax({
       url: "../dropdown5/" + $(this).val(),
       dataType: "json",
       type: "GET",
       success: function(data) { //
      addOption($('[name="kota"]'), data, 'kab_id', 'kab_kota_new');
       }
    }); 
    
   
 });
 
 $('[name="kota"]').change(function() {
       $('#kecamatan').val('');
          $.ajax({
       url: "<?php echo site_url('register/dropdown6') ?>/" + $('#propinsi').val()+"/"+ $(this).val(),
       dataType: "json",
       type: "GET",
       success: function(data) { //
      addOption($('[name="kecamatan"]'), data, 'id_camat', 'nama_camat');
       }
    }); 
    
   
 });
 
 

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
    <script src="<?php echo base_url() ?>assets/js/app.js">
   
    </script> -->

</body>

</html>