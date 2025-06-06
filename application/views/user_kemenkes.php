<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Status Akreditasi</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main/app-dark.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png'); ?>" type="image/png">


    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/jquery-ui.css">
    <script src="<?php echo base_url('assets/temp'); ?>/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/css/jquery.dataTables.min.css">

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
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                                        aria-controls="home" aria-selected="true">Rekomendasi Status Akreditasi</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="card">
                                        </br>
                                        <div class="form-group row align-items-center">
                                            <?php //echo form_open_multipart('Kemenkes') 
                                            ?>
                                            <form role="form" method="get" action="<?= base_url('Kemenkes') ?>" class="login-form" name="form_valdation">
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
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-2 col-3">
                                                        <label class="col-form-label">Lembaga Penyelenggara Akreditasi</label>
                                                    </div>
                                                    <div class="col-lg-10 col-9">

                                                        <?= form_dropdown('lpa_id', dropdown_sina_lpa(), $lpa_id, 'id="lpa_id"  class="form-select"'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-2 col-3">
                                                        <label class="col-form-label">Status Verifikasi</label>
                                                    </div>
                                                    <div class="col-lg-10 col-9">

                                                        <?= form_dropdown('status_verifikasi_id', array(1 => 'Belum Verifikasi', 2 => 'Sudah Verifikasi'), $status_verifikasi_id, 'id="status_verifikasi_id"  class="form-select"'); ?>
                                                    </div>
                                                </div>
                                                <div class="buttons">
                                                    <button href="submit" class="btn btn-success rounded-pill">Tampilkan</button>
                                                    <a href="<?php echo base_url('kemenkes/'); ?>" class="btn btn-light rounded-pill">Bersihkan</a>
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
                                                            <th>LPA</th>
                                                            <th>Provinsi</th>
                                                            <th>Kab/Kota</th>
                                                            <th>Tanggal Verifikasi</th>
                                                            <th>Status Verifikasi</th>
                                                            <!-- <td>Alasan Ditolak</td> -->
                                                            <!-- <th>Action</th> -->

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $n = 1;
                                                        foreach ($data as $data) {
                                                            $timestamp = strtotime($data['tanggal_penerbitan_sertifikat']);
                                                            $date_formated = date('d-m-Y', $timestamp);

                                                            if ($date_formated == "01-01-1970") {
                                                                $date_formated = "";
                                                            }
                                                            $lpa_id = $data['lpa_id'];

                                                            if ($data['jenis_fasyankes'] == 1) {
                                                                $jenis_fasyankes = 'Tempat Praktik Mandiri Nakes';
                                                            } else if ($data['jenis_fasyankes'] == 2) {
                                                                $jenis_fasyankes = 'Pusat Kesehatan Masyrakat';
                                                            } else if ($data['jenis_fasyankes'] == 3) {
                                                                $jenis_fasyankes = 'Klinik';
                                                            } else if ($data['jenis_fasyankes'] == 4) {
                                                                $jenis_fasyankes = 'Rumah Sakit';
                                                            } else if ($data['jenis_fasyankes'] == 6) {
                                                                $jenis_fasyankes = 'Unit Transfusi Darah';
                                                            } else if ($data['jenis_fasyankes'] == 7) {
                                                                $jenis_fasyankes = 'Laboratorium Kesehatan';
                                                            } else if ($data['jenis_fasyankes'] == 8) {
                                                                $jenis_fasyankes = 'Optikal';
                                                            }


                                                            if ($data['status_admin_lpa'] == 1) {
                                                                $status_admin_lpa = '<span class="badge bg-warning">Belum Diperiksa</span>';
                                                            } else if ($data['status_admin_lpa'] == 3) {
                                                                $status_admin_lpa = '<span class="badge bg-success">Diterima</span>';
                                                            } else if ($data['status_admin_lpa'] == 2) {
                                                                $status_admin_lpa = '<span class="badge bg-danger">DiTolak</span>';
                                                            }
                                                        ?>

                                                            <tr>
                                                                <td><?= $n; ?></td>

                                                                <td><?= $data['fasyankes_id']; ?></td>
                                                                <td><?= $data['nama_fasyankes']; ?></td>

                                                                <td><?= $data['jenis_fasyankes_nama']; ?></td>
                                                                <td><?= $data['lpa']; ?></td>
                                                                <td><?= $data['nama_prop']; ?></td>
                                                                <td><?= $data['nama_kota']; ?></td>
                                                                <td><?= $date_formated; ?></td>

                                                                <!-- <td><? //= $status_admin_lpa; 
                                                                            ?></td> -->
                                                                <td>
                                                                    <?php
                                                                    if (is_null($data['penerbitan_sertifikat_id']) == 1) {

                                                                    ?>
                                                                        <span class="badge bg-warning">Belum Verirfikasi</span>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <span class="badge bg-success">Sudah Verifikasi</span>
                                                                    <?php

                                                                    }
                                                                    ?>

                                                                </td>
                                                                <!-- <td><?= $data['keterangan'] ?></td> -->
                                                                <!-- <td><div class="buttons">
                            <a href="<?php echo base_url('kemenkes/detail/') . $data['id']; ?>"  class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
                            <?php
                                                            if (is_null($data['status_final_ep']) == 0 && is_null($data['pengiriman_laporan_survei_id']) == 0) {
                            ?>
                                <?php } ?>
                            
                            </div></td> -->



                                                                <!-- <input type="button" name="update" svm='<?= $data['id']; ?>' value="Update" class="ruang btn btn-primary"><br> -->
                                                                <!-- <input type="button" name="history" id="history" value="History" class="btn btn-warning">
                            </a> -->

                                                            </tr>

                                                        <?php
                                                            $n++;
                                                        }
                                                        ?>



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
        </div>
    </footer>
    </div>
    </div>
    </div>
    </div>

    <script src="<?php echo base_url() ?>assets/js/app.js">
    </script>

    <script>
        $('[name="propinsi"]').change(function() {
            $("#kota_id").removeAttr('readonly'); //turns required off
            $('#kota_id').val('');

            $.ajax({
                url: "<?= base_url('pengajuan/dropdown5/') ?>" + $(this).val(),
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

</body>

</html>