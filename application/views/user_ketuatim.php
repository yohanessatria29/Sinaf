<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Akreditasi Ketua Tim</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main/app-dark.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png'); ?>" type="image/png">

    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/css/jquery.dataTables.min.css">
    <script src="<?php echo base_url('assets/temp'); ?>/jquery-3.6.0.js"></script>

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
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Rekomendasi Status Akreditasi</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="card">
                                        </br>
                                        <div class="form-group row align-items-center">
                                            <?php echo form_open_multipart('Ketua') ?>
                                            <form role="form" method="post" class="login-form" name="form_valdation">

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

                                                <?= form_dropdown('jenis_fasyankes', dropdown_sina_jenis_fasyankes(), $jenis_fasyankes, 'id="jenis_fasyankes"  class="form-select" onchange="handleChange(this)" '); ?>
                                                <?php //var_dump($data);
                                                ?>
                                            </div>
                                        </div>
                                        <?php if (!empty($data[0]['jenis_klinik'])) { ?>
                                            <div class="form-group row align-items-center" id="jenis">


                                            <?pHP } else { ?>
                                                <div class="form-group row align-items-center" id="jenis" hidden>

                                                <?php } ?>
                                                <div class="col-lg-2 col-3">
                                                    <label class="col-form-label">Jenis Klinik</label>
                                                </div>
                                                <div class="col-lg-10 col-9">
                                                    <select name="jenis_klinik" id="jenis_klinik" class="form-select" fdprocessedid="k143t8">
                                                        <option value="9999">Pilih Jenis Klinik</option>
                                                        <option value="Pratama">Pratama</option>
                                                        <option value="Utama">Utama</option>
                                                    </select>

                                                </div>
                                                </div>
                                                <?php
                                                // var_dump($data);
                                                if (!empty($data[0]['jenis_lab'])) { ?>
                                                    <div class="form-group row align-items-center" id="jenis_lab">
                                                    <?pHP } else { ?>
                                                        <div class="form-group row align-items-center" id="jenis_lab" hidden>
                                                        <?php } ?>
                                                        <div class="col-lg-2 col-3">
                                                            <label class="col-form-label">Jenis Labkes</label>
                                                        </div>
                                                        <div class="col-lg-10 col-9">
                                                            <select name="jenis_labkes" id="jenis_labkes" class="form-select" fdprocessedid="k143t8">
                                                                <option value="9999">Pilih Jenis Lab</option>
                                                                <option value="77">Medis</option>
                                                                <option value="88">Kesehatan</option>
                                                            </select>

                                                        </div>
                                                        </div>
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-lg-2 col-3">
                                                                <label class="col-form-label">Lembaga Penyelenggara Akreditasi</label>
                                                            </div>
                                                            <div class="col-lg-10 col-9">

                                                                <?= form_dropdown('lpa_id', dropdown_sina_lpa(), $lpa_id, 'id="lpa_id"  class="form-select"'); ?>
                                                                <?php //var_dump($data);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-lg-2 col-3">
                                                                <label class="col-form-label">Status Verifikasi</label>
                                                            </div>
                                                            <div class="col-lg-10 col-9">

                                                                <?= form_dropdown('status_verifikasi_id', array(1 => 'Belum Verifikasi', 2 => 'Status Terverifikasi'), $status_verifikasi_id, 'id="status_verifikasi_id"  class="form-select"'); ?>
                                                                <?php //var_dump($data);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="buttons">
                                                            <button href="submit" class="btn btn-success rounded-pill">Tampilkan</button>
                                                            <a href="<?php echo base_url('ketua/'); ?>" class="btn btn-light rounded-pill">Bersihkan</a>
                                                        </div>

                                                        </form>

                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered" id="table1">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>No</th>
                                                                                <th>Kode Fasyankes</th>
                                                                                <th>Nama Fasyankes</th>
                                                                                <th>Jenis Fasyankes</th>
                                                                                <?php
                                                                                // var_dump($data[0]['jenis_fasyankes']);
                                                                                if ($data[0]['jenis_fasyankes'] == "3") { ?>
                                                                                    <th>Jenis Klinik</th>
                                                                                    <th>LPA</th>

                                                                                <?php } elseif ($data[0]['jenis_fasyankes'] == "7") { ?>
                                                                                    <th>Jenis Laboratorium</th>
                                                                                    <th>LPA</th>
                                                                                <?php } else { ?>
                                                                                    <th>LPA</th>

                                                                                <?php } ?>
                                                                                <th>Provinsi</th>
                                                                                <th>Kab/Kota</th>
                                                                                <th>Tanggal Rekomendasi</th>
                                                                                <th>Tanggal Verifikasi</th>
                                                                                <th>Status Verifikasi</th>
                                                                                <th>Status Direktur</th>
                                                                                <th>Status TTE</th>
                                                                                <th>Action</th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $n = 1;
                                                                            foreach ($data as $key => $value) {
                                                                                //   var_dump($value);
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
                                                                                    $jenis_fasyankes = 'Laboratorium';
                                                                                } else if ($value['jenis_fasyankes'] == 8) {
                                                                                    $jenis_fasyankes = 'Optikal';
                                                                                }


                                                                                if ($value['status_admin_lpa'] == 1) {
                                                                                    $status_admin_lpa = '<span class="badge bg-warning">Belum Diperiksa</span>';
                                                                                } else if ($value['status_admin_lpa'] == 3) {
                                                                                    $status_admin_lpa = '<span class="badge bg-success">Diterima</span>';
                                                                                } else if ($value['status_admin_lpa'] == 2) {
                                                                                    $status_admin_lpa = '<span class="badge bg-danger">DiTolak</span>';
                                                                                }
                                                                            ?>

                                                                                <tr>
                                                                                    <td><?= $n; ?></td>
                                                                                    <td><?= $value['fasyankes_id']; ?></td>
                                                                                    <td><?= $value['nama_fasyankes']; ?></td>
                                                                                    <td><?= $value['jenis_fasyankes_nama']; ?></td>
                                                                                    <?php if ($data[0]['jenis_fasyankes'] == "3") { ?>
                                                                                        <td><?= $value['jenis_klinik']; ?></td>
                                                                                        <td><?= $value['lpa']; ?></td>

                                                                                    <?php } elseif ($data[0]['jenis_fasyankes'] == "7") { ?>
                                                                                        <td><?= $value['jenis_lab']; ?></td>

                                                                                        <td><?= $value['lpa']; ?></td>


                                                                                    <?php } else { ?>
                                                                                        <td><?= $value['lpa']; ?></td>

                                                                                    <?php } ?>
                                                                                    <td><?= $value['nama_prop']; ?></td>
                                                                                    <td><?= $value['nama_kota']; ?></td>
                                                                                    <td><?= $value['tanggal_rekomendasi']; ?></td>
                                                                                    <td><?= $date_formated; ?></td>

                                                                                    <!-- <td><?= $status_admin_lpa; ?></td> -->
                                                                                    <td>
                                                                                        <?php
                                                                                        if (is_null($value['status_persetujuan']) == 1) {

                                                                                        ?>
                                                                                            <span class="badge bg-warning">Belum Verirfikasi</span>
                                                                                        <?php
                                                                                        } else {
                                                                                        ?>
                                                                                            <span class="badge bg-success">Status Terverifikasi</span>
                                                                                        <?php

                                                                                        }
                                                                                        ?>

                                                                                    </td>
                                                                                    <td>
                                                                                        <?php
                                                                                        if (is_null($value['direktur']) == 1) {

                                                                                        ?>
                                                                                            <span class="badge bg-warning">Belum Verifikasi</span>
                                                                                        <?php
                                                                                        } else if (($value['direktur']) == 0) {
                                                                                        ?>

                                                                                            <button onclick="getTolak()" class="btn icon btn-danger">Tidak Direkomendasikan</button>
                                                                                        <?php

                                                                                        } else if (($value['direktur']) == 1) {
                                                                                        ?>
                                                                                            <span class="badge bg-success">Diterima</span>
                                                                                        <?php } else if (($value['direktur']) == 2) {
                                                                                        ?>
                                                                                            <span class="badge bg-danger">Perbaikan</span>
                                                                                            <button type="button" class="btn btn-primary btn-sm" onclick="getTolak('<?php echo $data[$key]['catatan_direktur'] ?>')">Catatan</button>
                                                                                        <?php }
                                                                                        ?>

                                                                                    </td>
                                                                                    <td>

                                                                                        <?php
                                                                                        if (is_null($value['nomor_surat'])) {
                                                                                        ?>
                                                                                            <span class="badge bg-danger">Belum Bernomor</span>
                                                                                        <?php
                                                                                        } else {
                                                                                        ?>
                                                                                            <span class="badge bg-success">Sudah Bernomor</span>
                                                                                        <?php
                                                                                        }
                                                                                        ?>

                                                                                        <?php
                                                                                        if ($lpa_id != 14) {
                                                                                            if (is_null($value['tte_lpa_id'])) {

                                                                                        ?>
                                                                                                <span class="badge bg-warning">Belum TTE LPA </span>

                                                                                            <?php
                                                                                            } else {
                                                                                            ?>
                                                                                                <span class="badge bg-success">Sudah TTE LPA</span>
                                                                                        <?php
                                                                                            }
                                                                                        } else {
                                                                                        } ?>


                                                                                        <?php
                                                                                        if (is_null($value['tte_dirjen_id'])) {

                                                                                        ?>
                                                                                            <span class="badge bg-warning">Belum TTE Dirjen </span>

                                                                                        <?php
                                                                                        } else {
                                                                                        ?>
                                                                                            <span class="badge bg-success">Sudah TTE Dirjen</span>
                                                                                        <?php
                                                                                        }
                                                                                        ?>


                                                                                    </td>

                                                                                    <td>
                                                                                        <div class="buttons">
                                                                                            <a href="<?php echo base_url('ketua/detail/') . $value['id']; ?>" class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                                                </svg></a>

                                                                                            <?php
                                                                                            if (is_null($value['status_final_ep']) == 0 && is_null($value['pengiriman_laporan_survei_id']) == 0) {

                                                                                            ?>

                                                                                            <?php } ?>

                                                                                        </div>
                                                                                    </td>
                                                                                    <!-- Modal 1-->
                                                                                    <div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="tolakModalLabel" aria-hidden="true">
                                                                                        <div class="modal-dialog">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h5 class="modal-title" id="tolakModalLabel">Catatan Direktur</h5>

                                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <textarea type="text" id="catatan_direktur" name="catatan_direktur" class="form-control" style="display;" disabled></textarea>
                                                                                                </div>
                                                                                                <div class="modal-footer">
                                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
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
    <!-- <script src="assets/js/pages/dashboard.js"></script> -->
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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <script src="assets/js/pages/horizontal-layout.js"></script>
    <script src="<?php echo base_url() ?>assets/js/apa.js"></script>
    <script src="<?php echo base_url() ?>assets/js/app.js"></script>

    </script>
    <script>
        $(document).ready(function() {
            $('#table1').DataTable();
        });
    </script>
    <script>
        function handleChange(selectElement) {
            var selectedOption = selectElement.value; // Get selected value
            var textElement = document.getElementById('jenis');
            var labElement = document.getElementById('jenis_lab');
            if (selectedOption === "3") {
                textElement.hidden = false;
                labElement.hidden = true;
            } else if (selectedOption === "7") {
                labElement.hidden = false;
                textElement.hidden = true;
            } else {
                textElement.hidden = true;
                labElement.hidden = true;
            }
            // console.log("You selected: " + selectedOption);
        }

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

        $('#table1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
            // dom: 'Bfrtip',
            // buttons: [
            //     'excel', 'csv'
            // ]
        });

        async function getTolak(catatan) {
            $('#catatan_direktur').val('');
            $('#catatan_direktur').val(catatan);
            $("#tolakModal").modal('show')

        }
    </script>

</body>

</html>