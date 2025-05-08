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

    <script src="<?php echo base_url('assets/temp'); ?>/jquery-3.6.0.js"></script>


</head>

<body>
    <?php
    include('template/sidebar.php');

    ?>
    <div class="container">
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <div class="card">

                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Rekomendasi Status Akreditasi</a>
                                    </li>

                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="card">
                                            </br>
                                            <div class="form-group row align-items-center">
                                                <?php echo form_open_multipart('direktur') ?>
                                                <form role="form" method="post" class="login-form" name="form_valdation">
                                                    <!-- <div class="col-lg-2 col-3">
                                            <label class="col-form-label">Tanggal</label>
                                        </div>
                                        <div class="col-lg-10 col-6">
                                            <input type="date" id="date_start" class="form-control" name="date_start" placeholder="Date Start">
                                        </div> -->
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

                                                    <?= form_dropdown('jenis_fasyankes', dropdown_sina_jenis_fasyankes_pkm(), $jenis_fasyankes, 'id="jenis_fasyankes"  class="form-select" '); ?>

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

                                                    <?= form_dropdown('status_verifikasi_id', array(1 => 'Belum Verifikasi', 2 => 'Status Terverifikasi'), $status_verifikasi_id, 'id="status_verifikasi_id"  class="form-select"'); ?>

                                                </div>
                                            </div>
                                            <div class="buttons">
                                                <button href="submit" class="btn btn-success rounded-pill">Tampilkan</button>
                                                <a href="<?php echo base_url('direktur/'); ?>" class="btn btn-light rounded-pill">Bersihkan</a>
                                            </div>

                                            </form>

                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id="table-direktur">
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
                                                                <th>Verifikasi Katim</th>
                                                                <th>Verifikasi Direktur</th>
                                                                <th>Action</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $n = 1;
                                                            foreach ($data as $key => $value) {
                                                                $timestamp = strtotime($value['created_at']);
                                                                $date_formated = date('d-m-Y', $timestamp);

                                                                if ($date_formated == "01-01-1970") {
                                                                    $date_formated = "";
                                                                }
                                                                $lpa_id = $value['lpa_id'];

                                                                if ($value['jenis_fasyankes'] == 1) {
                                                                    $jenis_fasyankes = 'Tempat Praktik Mandiri Nakes';
                                                                } else if ($value['jenis_fasyankes'] == 2) {
                                                                    $jenis_fasyankes = 'Pusat Kesehatan Masyrakat';
                                                                } else if ($value['jenis_fasyankes'] == 3) {
                                                                    $jenis_fasyankes = 'Klinik';
                                                                } else if ($value['jenis_fasyankes'] == 4) {
                                                                    $jenis_fasyankes = 'Rumah Sakit';
                                                                } else if ($value['jenis_fasyankes'] == 6) {
                                                                    $jenis_fasyankes = 'Unit Transfusi Darah';
                                                                } else if ($value['jenis_fasyankes'] == 7) {
                                                                    $jenis_fasyankes = 'Laboratorium Kesehatan';
                                                                } else if ($value['jenis_fasyankes'] == 8) {
                                                                    $jenis_fasyankes = 'Optikal';
                                                                }


                                                                if ($value['status_admin_lpa'] == 1) {
                                                                    $status_admin_lpa = '<span class="badge bg-warning">Belum Diperiksa</span>';
                                                                } else if ($value['status_admin_lpa'] == 3) {
                                                                    $status_admin_lpa = '<span class="badge bg-success">Diterima</span>';
                                                                } else if ($value['status_admin_lpa'] == 2) {
                                                                    $status_admin_lpa = '<span class="badge bg-danger">Tidak Direkomendasikan</span>';
                                                                }
                                                            ?>

                                                                <tr>
                                                                    <td><?= $n; ?></td>

                                                                    <td><?= $value['fasyankes_id']; ?></td>
                                                                    <td><?= $value['nama_fasyankes']; ?></td>

                                                                    <td><?= $value['jenis_fasyankes_nama']; ?></td>
                                                                    <td><?= $value['lpa']; ?></td>
                                                                    <td><?= $value['nama_prop']; ?></td>
                                                                    <td><?= $value['nama_kota']; ?></td>
                                                                    <td><?= $date_formated; ?></td>

                                                                    <td>

                                                                        <?php
                                                                        if (is_null($value['status_persetujuan']) == 1) {

                                                                        ?>
                                                                            <span class="badge bg-warning">Belum Verifikasi</span>
                                                                        <?php
                                                                        } else if (($value['status_persetujuan']) == 0) {
                                                                        ?>
                                                                            <span class="badge bg-danger">DiTolak</span>
                                                                            <button type="button" class="btn btn-primary btn-sm" onclick="getCatatan('<?php echo $data[$key]['catatan_ketua'] ?>')">Catatan</button>
                                                                        <?php

                                                                        } else {
                                                                        ?>
                                                                            <span class="badge bg-success">Diterima</span>
                                                                            <!-- <a data-bs-toggle="modal" data-bs-target="#modal_catatan" class="btn icon btn-primary">Catatan</a> -->
                                                                            <button type="button" class="btn btn-primary btn-sm" onclick="getCatatan('<?php echo $data[$key]['catatan_ketua'] ?>')">Catatan</button>
                                                                        <?php }
                                                                        ?>

                                                                    </td>
                                                                    <!-- Modal 1-->
                                                                    <div class="modal fade" id="ikpModal" tabindex="-1" aria-labelledby="ikpModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-xl">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="ikpModalLabel">Catatan Ketua Tim</h5>

                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="container">
                                                                                        <textarea type="text" id="catatan_ketua" name="catatan_ketua" class="form-control" style="display;" disabled></textarea>
                                                                                        <!-- <h5 id="catatan_ketua_h5" name="catatan_ketua_h5"><?php //echo $data[$key]['catatan_ketua'] 
                                                                                                                                                ?></h5> -->
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Akhir Modal 1-->

                                                                    <!-- Modal 2-->
                                                                    <?php echo form_open_multipart('direktur/tolak') ?>

                                                                    <form role="form" method="post" class="login-form" name="form_valdation">
                                                                        <div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="tolakModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="tolakModalLabel">Catatan Penolakan Direktur</h5>

                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <input type="hidden" name="id_pengajuan" value="<?= $value['pengajuan_id']; ?>">
                                                                                        <textarea type="text" id="catatan_direktur" name="catatan_direktur" class="form-control" style="display;" required></textarea>
                                                                                    </div>
                                                                                    <div class="modal-footer">

                                                                                        <button href="submit" class="btn btn-success rounded-pill">Submit</button>
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                    <!-- Akhir Modal 2-->
                                                                    <td>
                                                                        <?php
                                                                        if (is_null($value['direktur']) == 1) {

                                                                        ?>
                                                                            <span class="badge bg-warning">Belum Verifikasi</span>
                                                                        <?php
                                                                        } else if (($value['direktur']) == 0) {
                                                                        ?>
                                                                            <span class="badge bg-danger">Tidak Direkomendasikan</span>
                                                                        <?php

                                                                        } else {
                                                                        ?>
                                                                            <span class="badge bg-success">Diterima</span>
                                                                        <?php }
                                                                        ?>

                                                                    </td>
                                                                    <!-- <td></?= $value['keterangan'] ?></td> -->
                                                                    <td>
                                                                        <div class="buttons">
                                                                            <!-- <a href="<?php echo base_url('direktur/detail/') . $value['id']; ?>" class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                                </svg></a> -->
                                                                            <!-- <a data-bs-toggle="modal" data-bs-target="#modal_verif" class="btn icon btn-danger">X</a> -->

                                                                            <?php
                                                                            if (is_null($value['direktur']) == 1) {

                                                                            ?>
                                                                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                                                                    <button onclick="setuju(<?php echo $value['pengajuan_id'] ?>)" class="btn icon btn-success">Diterima</button>
                                                                                    <!-- <button onclick="tolak(<?php echo $value['pengajuan_id'] ?>)" onclick="getCatatan()" class="btn icon btn-danger">Ditolak</button> -->

                                                                                    <!-- <button onclick="getTolak()" class="btn icon btn-danger">Tidak Direkomendasikan</button> -->
                                                                                </div>
                                                                                <!-- <a onclick="setuju()" href="<?php //echo base_url('direktur/setuju/') . $data['pengajuan_id']; 
                                                                                                                    ?>" class="btn icon btn-success">Setuju</a> | <a onclick="tolak()" href="<?php //echo base_url('direktur/tolak/') . $data['pengajuan_id']; 
                                                                                                                                                                                                ?>" class="btn icon btn-danger">Tolak</a> -->
                                                                            <?php
                                                                            } else if (($value['direktur']) == 0) {
                                                                            ?>
                                                                                <span class="badge bg-success">Status Terverifikasi</span>
                                                                            <?php

                                                                            } else {
                                                                            ?>
                                                                                <span class="badge bg-success">Status Terverifikasi</span>
                                                                            <?php }
                                                                            ?>




                                                                            <?php
                                                                            if (is_null($value['status_final_ep']) == 0 && is_null($value['pengiriman_laporan_survei_id']) == 0) {

                                                                            ?>
                                                                                <!-- <a data-bs-toggle="modal" data-bs-target="#modal_verif" class="btn icon icon-left btn-secondary"><i data-feather="user"></i>
                                        Verifikator</a> -->
                                                                            <?php } ?>

                                                                        </div>
                                                                    </td>



                                                                    <!-- <input type="button" name="update" svm='<? //= $value['id']; 
                                                                                                                    ?>' value="Update" class="ruang btn btn-primary"><br> -->
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
                </div>
        </section>
    </div>






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

    <script src="assets/js/pages/horizontal-layout.js"></script>
    <!-- <script src="<?php //echo base_url() 
                        ?>assets/js/apa.js"></script> -->
    <script src="<?php echo base_url() ?>assets/js/app.js"></script>
    <script src="<?php echo base_url('assets/temp/js_x'); ?>/jquery-ui.js"></script>
    <script src="<?php echo base_url('assets/temp/js_x'); ?>/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/temp/js_x'); ?>/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets/temp/js_x'); ?>/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url('assets/temp/js_x'); ?>/buttons.flash.min.js"></script>
    <script src="<?php echo base_url('assets/temp/js_x'); ?>/jszip.min.js"></script>
    <script src="<?php echo base_url('assets/temp/js_x'); ?>/pdfmake.min.js"></script>
    <script src="<?php echo base_url('assets/temp/js_x'); ?>/vfs_fonts.js"></script>
    <script src="<?php echo base_url('assets/temp/js_x'); ?>/buttons.html5.min.js"></script>
    <script src="<?php echo base_url('assets/temp/js_x'); ?>/buttons.print.min.js"></script>



    <script>
        $('[name="propinsi"]').change(function() {
            $("#kota_id").removeAttr('readonly'); //turns required off
            $('#kota_id').val('');
            $.ajax({
                // url: "../pengajuan/dropdown5/" + $(this).val(),
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



        async function getCatatan(catatan) {
            $('#catatan_ketua').val('');
            $('#catatan_ketua').val(catatan);
            // $("#catatan_ketua_h5").text("");
            // $("#catatan_ketua_h5").text(catatan);
            $("#ikpModal").modal('show')
            // console.log($data);
            // try {
            //     // echo 'tes';
            //     $("#ikpModal tbody").empty().append(rows)
            // } catch (e) {
            //     console.log(e)
            //     alert('Terjadi kesalahan.')
            // }
        }

        async function getTolak() {
            $("#tolakModal").modal('show')

        }

        // $('#table1').DataTable({
        //         "paging": true,
        //         "lengthChange": false,
        //         "searching": false,
        //         "ordering": true,
        //         "info": true,
        //         "autoWidth": false,
        //         dom: 'Bfrtip',
        //         buttons: [
        //             'excel', 'csv'
        //         ]
        //     });
    </script>

    <script>
        function setuju(id_pengajuan) {
            // alert('test');
            $.ajax({
                url: '<?php echo base_url() ?>direktur/setuju/' + id_pengajuan,
                method: 'post',
                dataType: 'text',
                cache: false,
                success: function(response) {
                    var len = response.length;
                    console.log(len);
                    if (response == 1) {
                        alert('Sukses Data Tersimpan');
                        location.reload(true);
                        // console.log(response);
                    } else {
                        alert('Terjadi Kesalahan..');
                        // location.reload(true);
                        console.log(response);
                    }
                    console.log(response);
                }
            });
        }

        function tolak(id_pengajuan) {
            // alert('test');
            $.ajax({
                url: '<?php echo base_url() ?>direktur/tolak/' + id_pengajuan,
                method: 'post',
                dataType: 'text',
                cache: false,
                success: function(response) {
                    var len = response.length;
                    console.log(len);
                    if (response == 1) {
                        alert('Success Menolak Akreditasi');
                        location.reload(true);
                    } else {
                        alert('Terjadi Kesalahan..');
                        location.reload(true);
                    }
                    console.log(response);
                }
            });
        }
    </script>
</body>

</html>