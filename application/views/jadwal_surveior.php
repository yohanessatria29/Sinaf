<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kesiapan Surveior</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/fontawesome/css/fontawesome.min.css">



    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/jquery-ui.css">
    <script src="<?php echo base_url('assets/temp'); ?>/jquery-3.6.0.js"></script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script> -->

    <script type="text/javascript">
        $(document).ready(function() {

            var myCounter = 1;
            $(".myDate").datepicker();

            $("#moreDates").click(function() {

                $('.myTemplate')
                    .clone()
                    .removeClass("myTemplate")
                    .addClass("additionalDate")
                    .show()
                    .appendTo('#importantDates');

                myCounter++;
                $('.additionalDate input[name=inputDate]').each(function(index) {
                    $(this).addClass("myDate");
                    $(this).attr("name", $(this).attr("name") + myCounter);
                });

                $(".myDate").on('focus', function() {
                    var $this = $(this);
                    if (!$this.data('datepicker')) {
                        $this.removeClass("hasDatepicker");
                        $this.datepicker();
                        $this.datepicker("show");
                    }
                });

            });

        });
    </script>
</head>

<style>
    .hideform {
        display: none;
    }
</style>

<body>
    <?php
    include('template/sidebar.php');
    ?>
    <?php
    if ($this->session->flashdata('message_name') != null) {
    ?>
        <div class="alert alert-<?= $this->session->flashdata('kode_name'); ?> alert-dismissible">
            <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> </button>
                            <h4><i class="icon fa fa-<?= $this->session->flashdata('icon_name'); ?>"></i> Alert!</h4> -->
            <?= $this->session->flashdata('message_name'); ?>
        </div>
    <?php
    }
    ?>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item"><a id="kesiapan-tab" class="nav-link" href="<?php echo base_url('Surveior/index') ?>">Daftar Fasyankes Yang Dinilai</a></li>
                                <li class="nav-item"><a id="kesiapan-tab" class="nav-link active" href="<?php echo base_url('Surveior/jadwal_surveior') ?>">Kesiapan Surveior</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="card">
                                    <div class="card-body">
                                        <form id="tanggal_kesiapan" name="tanggal_kesiapan" method="POST" action="<?php echo base_url('Surveior/simpan_date') ?>">

                                            <table class="table" id="tabletanggal">
                                                <tbody>
                                                    <!-- <tr>
                                                        <td style="width: 100px;">
                                                            Tanggal :
                                                        </td>
                                                        <td>
                                                            <input type="date" name="tanggalkesiapan[]" size="10" value="<?php //echo date('Y-m-d'); 
                                                                                                                            ?>" min="<?php //echo date('Y-m-d'); 
                                                                                                                                        ?>" />
                                                        </td>
                                                    </tr> -->
                                                </tbody>
                                            </table>
                                            <button class="btn btn-primary" type="button" id="adddates"><i class="far fa-calendar-plus"></i>Tambah Tanggal</button>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col text-center">
                                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                                        <button id="submit_tanggal" class="btn btn-success hideform">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-center">
                                            <table class="table" id="tablelisttanggal" style="width: 50%;">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>List Tanggal</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $n = 1;
                                                    foreach ($tanggal as $data) {
                                                    ?>
                                                        <tr>
                                                            <td><?= $n; ?></td>
                                                            <td><?= $data['jadwal_kesiapan'] ?></td>
                                                            <td>
                                                                <?php
                                                                // if ($data['status'] == 0) {
                                                                //     echo '<span class="badge bg-success">Belum di Tugaskan</span>';
                                                                // } else if ($data['status'] == 1) {
                                                                //     echo '<span class="badge bg-warning">Telah di Tugaskan</span>';
                                                                // } else if ($data['status'] == 2) {
                                                                //     echo '<span class="badge bg-warning">Ditugaskan</span>';
                                                                // }
                                                                $nama = $data['nama'];
                                                                $badge_color = $data['badge_color'];
                                                                if ($data['status'] == 6) {
                                                                    echo '<span class="badge bg-warning">Belum Ditugaskan</span>';
                                                                } else {
                                                                    echo '<span class="badge bg-' . $data['badge_color'] . '">' . $data['nama'] . '</span>';
                                                                }

                                                                // echo $data['nama'];
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if ($data['status'] == 0) {
                                                                    // var_dump($data);
                                                                ?>

                                                                    <a href="<?php echo base_url('Surveior/delete_date/' . $data['id_jadwal']) ?>" class="btn btn-danger" title="Delete Tanggal"><i class="fas fa-trash"></i></a>
                                                                <?php
                                                                } else if ($data['status'] == 6) {
                                                                ?>
                                                                    <a href="" class="btn btn-danger" title="Delete Tanggal" disabled><i class="fas fa-trash" disabled></i></a>
                                                                <?php
                                                                }
                                                                ?>
                                                            </td>
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

</body>


</html>
<script src="<?php echo base_url() ?>assets/js/app.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        var myCounter = 0;
        $(".tanggalkesiapan").datepicker();

        $("#adddates").click(function() {
            $("#tabletanggal").append(
                '<tr><td style="width: 100px;">Tanggal :</td><td style="width: 200px;"><input class="form-control" required type="date" name="tanggalkesiapan[]" size="10" value="<?php //echo date('Y-m-d'); 
                                                                                                                                                                                    ?>" min="<?php echo date('Y-m-d'); ?>" /></td><td><button class="btn btn-danger" onclick="deleterow(this)"><i class="fas fa-times"></i></button></td></tr>');
            myCounter++;
            $('#submit_tanggal').show();
        });

        deleterow = function(el) {
            $(el).parents("tr").remove()
            myCounter--;
            if (myCounter == 0) {
                $('#submit_tanggal').hide();
            }
        }

    });
</script>