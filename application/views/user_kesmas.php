<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Akreditasi Kesmas</title>

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
    $propinsi = 9999;
    $kota = 9999;
    ?>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Capaian Akreditasi</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="surveior-tab" data-bs-toggle="tab" href="#surveior" role="tab" aria-controls="surveior" aria-selected="true">Jumlah Surveior</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="card">
                                        </br>
                                        <div class="form-group row align-items-center">
                                            <?php echo form_open_multipart('Kesmas/list') ?>
                                            <form role="form" method="get" class="login-form" name="form_valdation">
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="col-lg-2 col-3">
                                                <label class="col-form-label">Provinsi</label>
                                            </div>
                                            <div class="col-lg-10 col-9">
                                                <?= form_dropdown('propinsi', dropdown_sina_propinsi_kesmas(), $propinsi, 'id="provinsi_id"  class="form-select" required'); ?>
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
                                                <select name="jenis_fasyankes" id="jenis_fasyankes" class="form-control">
                                                    <option value="">--Pilih Faskes--</option>
                                                    <option value="puskesmas">Puskesmas</option>
                                                    <option value="labkes">Laboratorium Kesehatan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="col-lg-2 col-3">
                                                <label class="col-form-label">Nama Fasyankes</label>
                                            </div>
                                            <div class="col-lg-10 col-9">

                                                <input type="text" name="nama_fasyankes" id="nama_fasyankes" class="form-control">
                                            </div>
                                        </div>
                                        <div class="buttons">
                                            <button href="submit" class="btn btn-success rounded-pill">Tampilkan</button>
                                            <a href="<?php echo base_url('kesmas'); ?>" class="btn btn-light rounded-pill">Bersihkan</a>
                                        </div>

                                        </form>
                                        <?php
                                        // var_dump($dataapi[0]["jenis_fasyankes"]);
                                        if (!empty($dataapi)) {

                                        ?>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered" id="table1">
                                                            <thead>
                                                                <tr>
                                                                    <?php if ($dataapi[0]["jenis_fasyankes"] == 2) {
                                                                    ?>

                                                                        <th>No</th>
                                                                        <th>Nama Fasyankes</th>
                                                                        <th>Provinsi</th>
                                                                        <th>Kab/Kota</th>

                                                                        <th>Status Akreditasi</th>
                                                                        <th>Tanggal Awal Sertifikat</th>
                                                                        <th>Tanggal Akhir Sertifikat</th>

                                                                    <?php } else { ?>

                                                                        <th>No</th>
                                                                        <th>Nama Fasyankes</th>
                                                                        <th>Provinsi</th>
                                                                        <th>Kab/Kota</th>
                                                                        <th>Kepemilikan</th>
                                                                        <th>Status Akreditasi</th>
                                                                        <th>Tanggal Awal Sertifikat</th>
                                                                        <th>Tanggal Akhir Sertifikat</th>

                                                                    <?php } ?>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php

                                                                // var_dump($dataapi);
                                                                $n = 1;
                                                                foreach ($dataapi as $key => $value) {
                                                                    // var_dump($value);
                                                                    $tgl1 = $value['tgl_survei'];
                                                                    $tgl2    = date('Y-m-d', strtotime('+5 year', strtotime($tgl1)));
                                                                ?>
                                                                    <tr>
                                                                        <?php if ($dataapi[0]["jenis_fasyankes"] == 2) {
                                                                        ?>
                                                                            <td><?= $n; ?></td>
                                                                            <td><?= $value["nama_fasyankes"] ?></td>
                                                                            <td><?= $value['nama_prop']; ?></td>
                                                                            <td><?= $value['nama_kota']; ?></td>

                                                                            <td><?= $value['nama_akreditasi']; ?></td>
                                                                            <td><?= $value['tgl_survei']; ?></td>
                                                                            <td><?= $tgl2; ?></td>
                                                                        <?php } else { ?>
                                                                            <td><?= $n; ?></td>
                                                                            <td><?= $value["nama_fasyankes"] ?></td>
                                                                            <td><?= $value['nama_prop']; ?></td>
                                                                            <td><?= $value['nama_kota']; ?></td>
                                                                            <td><?= $value['pemilik']; ?></td>
                                                                            <td><?= $value['nama_akreditasi']; ?></td>
                                                                            <td><?= $value['tgl_survei']; ?></td>
                                                                            <td><?= $tgl2; ?></td>
                                                                        <?php } ?>
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
                                        <?php } else {
                                            echo "Silahkan Filter";
                                        } ?>
                                    </div>
                                </div>


                                <div class="tab-pane fade show" id="surveior" role="tabpanel" aria-labelledby="surveior-tab">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered" id="table2">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Lembaga</th>
                                                            <th>Jumlah Surveior</th>


                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $n = 1;
                                                        foreach ($datasurveior as $key => $value) {
                                                            //   var_dump($value);

                                                        ?>

                                                            <tr>
                                                                <td><?= $n; ?></td>
                                                                <td><?= $value['Lembaga']; ?></td>
                                                                <td><?= $value['jumlah']; ?></td>


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
            $('#table1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'csv'
                ]
            });

            $('#table2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'csv'
                ]
            });
        });
    </script>
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



        async function getTolak(catatan) {
            $('#catatan_direktur').val('');
            $('#catatan_direktur').val(catatan);
            $("#tolakModal").modal('show')

        }
    </script>

</body>

</html>