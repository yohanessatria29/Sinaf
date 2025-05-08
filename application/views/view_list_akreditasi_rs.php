<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Akreditasi RS</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <!-- <link rel="stylesheet" href="<?php //echo base_url('assets/css/main/app-dark.css'); 
                                        ?>"> -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png'); ?>" type="image/png">

    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/css/jquery.dataTables.min.css">
    <script src="<?php echo base_url('assets/temp'); ?>/jquery-3.6.0.js"></script>

</head>

<style>
    .table td.fit,
    .table th.fit {
        white-space: nowrap;
        width: 1%;
    }
</style>


<body>
    <?php
    include('template/sidebar.php');
    ?>
    <?php if ($this->session->flashdata('message_name') != null) { ?>
        <div class="alert alert-<?= $this->session->flashdata('kode_name'); ?> alert-dismissible">
            <?= $this->session->flashdata('message_name'); ?>
        </div>
    <?php } ?>


    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="card">

                        <div class="card-header">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">List Akreditasi RS</a>
                                </li>
                            </ul>

                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="container pb-4">
                                        <div class="form-group row align-item-center">
                                            <?php echo form_open_multipart("AkreditasiRS") ?>
                                            <form role="form" method="post" class="login-form" name="form_search">
                                                <div class="row">
                                                    <div class="form-group row align-items-center">
                                                        <div class="col-lg-2 col-4">
                                                            <label class="col-form-label" for="tanggal_awal">Tanggal Survei</label>
                                                        </div>
                                                        <div class="col-lg-10 col-9">

                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="<?= $tanggal_awal ?>">
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <p class="col-form-label align-items-center">s.d</p>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="<?= $tanggal_akhir ?>" min="<?= $tanggal_awal ?>" readonly>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <!-- <div class="form-group row align-items-center">
                                                        <div class="col-lg-2 col-3">
                                                            <label class="col-form-label" for="provinsi_id">Provinsi</label>
                                                        </div>
                                                        <div class="col-lg-10 col-9">
                                                            <? //= form_dropdown('propinsi', dropdown_sina_propinsi(), $propinsi, 'id="provinsi_id"  class="form-select" required'); 
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row align-items-center">
                                                        <div class="col-lg-2 col-3">
                                                            <label class="col-form-label" for="kota_id">Kab/Kota</label>
                                                        </div>
                                                        <div class="col-lg-10 col-9">
                                                            <? //= form_dropdown('kota', dropdown_sina_kab_kota(), $kota, 'id="kota_id"  class="form-select"'); 
                                                            ?>
                                                        </div>
                                                    </div> -->

                                                    <div class="form-group row align-items-center">
                                                        <div class="col-lg-2 col-3">
                                                            <label class="col-form-label" for="jenis_fasyankes">Jenis Fasyankes</label>
                                                        </div>
                                                        <div class="col-lg-10 col-9">

                                                            <select name="jenis_fasyankes" id="jenis_fasyankes" class="form-control">
                                                                <option value="<?= $jenis_fasyankes[0]['fasyankes_id'] ?>"><?= $jenis_fasyankes[0]['nama_fasyankes'] ?></option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row align-items-center">
                                                        <div class="col-lg-2 col-3">
                                                            <label class="col-form-label" for="status_usulan_id">Status TTE</label>
                                                        </div>
                                                        <div class="col-lg-10 col-9">
                                                            <select class="form-control" name="status_usulan_id" id="status_usulan_id">
                                                                <option value="">Pilih Status TTE</option>
                                                                <option value="0">Belum di TTE</option>
                                                                <option value="1">Sudah di TTE</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="buttons" align="center">
                                                        <button href="submit" class="btn btn-success rounded-pill">Tampilkan</button>
                                                        <a href="<?php echo base_url('AkreditasiRS/'); ?>" class="btn btn-light rounded-pill">Bersihkan</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                    <div class="container-fluid pb-4">
                                        <div class="row pb-4">
                                            <div class="col-md-12">
                                                <a href="<?= base_url('AkreditasiRS/inputakreditasiRS') ?>">
                                                    <button class="btn btn-primary">
                                                        Input Akreditasi RS Baru
                                                    </button>
                                                </a>

                                            </div>
                                        </div>
                                        <div class="table-responsive">

                                            <table class="table table-striped" id="table_list_akreditasi_rs">
                                                <thead>
                                                    <tr>
                                                        <th class="fit">No</th>
                                                        <th>Kode Fasyankes</th>
                                                        <th class="fit">Jenis Faskes</th>
                                                        <th class="fit">LPA</th>
                                                        <!-- <th>Provinsi</th>
                                                        <th>Kab/Kota</th> -->
                                                        <th class="fit">Tanggal Usulan</th>
                                                        <th>Rencana Tanggal Awal Survei</th>
                                                        <th class="fit">Nama Narahubung</th>
                                                        <th class="fit">No HP Narahubung</th>
                                                        <th class="fit">No Surat Tugas</th>
                                                        <th class="fit">Status TTE</th>
                                                        <!-- <th>Alasan Ditolak</th> -->
                                                        <!-- <th>Action</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $n = 1;
                                                    foreach ($data as $data) {
                                                        $timestamp = strtotime($data['created_at']);
                                                        $date_formated = date('d-m-Y', $timestamp);

                                                        $tanggal_awal = strtotime($data['tanggal_survei_1']);
                                                        $date_tanggal_awal = date('d-m-Y', $tanggal_awal);

                                                        if ($data['status_tte'] == 0) {
                                                            $status_tte = '<span class="badge bg-warning">Belum di TTE</span>';
                                                        } else if ($data['status_tte'] == 1) {
                                                            $status_tte = '<span class="badge bg-success">Sudah di TTE</span>';
                                                        }
                                                    ?>

                                                        <tr>
                                                            <td><?= $n ?></td>
                                                            <td><?= $data['kode_rs'] ?></td>
                                                            <td><?= $data['jenis_fasyankes'] ?></td>
                                                            <td><?= $data['lpa'] ?></td>
                                                            <td><?= $date_formated ?></td>
                                                            <td><?= $date_tanggal_awal ?></td>
                                                            <td><?= $data['narahubung_rs'] ?></td>
                                                            <td><?= $data['no_hp_narahubung'] ?></td>
                                                            <td><?= $data['no_surat_tugas'] ?></td>
                                                            <td><?= $status_tte ?></td>
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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
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

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <script>
        $('#table_list_akreditasi_rs').DataTable({
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

            ele.append(new Option('ALL', 9999));
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
    <!-- <script src="<?php //echo base_url() 
                        ?>assets/js/app.js"></script> -->

</body>

</html>