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
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <!-- <link rel="stylesheet" href="https://dfo.kemkes.go.id/assets/css/pages/filepond.css">
    <link rel="stylesheet" href="https://dfo.kemkes.go.id/assets/temp/jquery-ui.css"> -->
    <!-- <script src="https://dfo.kemkes.go.id/assets/temp/jquery-3.6.0.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://dfo.kemkes.go.id/assets/css/jquery-ui.css"> -->


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

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="card">
                                        </br>
                                        <?php echo form_open_multipart('Surveior/jadwal_perjalanan') ?>
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
                                                    <label class="col-form-label">Pilih Surveior</label>
                                                </div>
                                                <div class="col-lg-10 col-9">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control"
                                                            placeholder="Cari Nama Surveior" name="namasurveior" id="namasurveior" autocomplete="on">
                                                        <input type="hidden" class="form-control" name="user_id" id="usersid" autocomplete="on">
                                                    </div>
                                                </div>
                                                <div class="buttons">
                                                    <button href="submit" class="btn btn-success rounded-pill">Tampilkan</button>
                                                    <a href="<?php echo base_url('surveior/jadwal_perjalanan'); ?>" class="btn btn-light rounded-pill">Bersihkan</a>
                                                </div>

                                        </form>

                                        <div class="card-body">
                                            <table class="table table-striped" id="table1">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tanggal Kesiapan</th>
                                                        <th>Alasan</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $n = 1;
                                                    foreach ($data as $data) {
                                                        // if($data === 0){
                                                        // vardump($data);
                                                        // }
                                                    ?>

                                                        <tr>
                                                            <td><?= $n; ?></td>

                                                            <td><?= $data['jadwal_kesiapan']; ?></td>
                                                            <td>
                                                                <!-- <select class="form-select akreditasi" id="status<?= $data['id']; ?>"  name="status[<?= $data['id']; ?>]">
                                                                    <option value='0'>Belum Ditugaskan</option>
                                                                    <option value='2'>Dalam Perjalanan Survei</option>
                                                                    <option value='3'>Sakit</option>
                                                                    <option value='4'>Izin Keperluan</option>
                                                                    <option value='5'>dll</option>
                                                                    
                                                    </select> -->
                                                                <?php
                                                                if ($data['status'] != 1) {
                                                                    $status = "";
                                                                } else {
                                                                    $status = "disabled";
                                                                }
                                                                ?>
                                                                <?= form_dropdown('status', dropdown_sina_status_kesiapan_surveior(), $data['status'], 'id="status' . $data['id'] . '"  class="form-control" ' . $status . ' '); ?>
                                                            </td>

                                                            <!-- <td> -->
                                                            <!-- <a href="<?php echo base_url('Surveior/update_jadwal/' . $data['id']) ?>" class="btn btn-danger" title="Delete Tanggal">Non Aktifkan</a> -->
                                                            <?php
                                                            if ($data['status'] != 1) {
                                                            ?>
                                                                <td><input type='button' name='update' id='update' class='btn btn-info update' ids='<?= $data['id']; ?>' value='Submit'></td>
                                                            <?php
                                                            }
                                                            ?>
                                                            <!-- </td> -->


                                                            <!-- <td>
                                                            <div class="buttons">
                                                                <a href="<?php echo base_url('surveior/epsurveior/') . $data['id']; ?>" class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                    </svg></a>


                                                            </div>
                                                        </td> -->
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



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- <script src="https://dfo.kemkes.go.id/assets/js/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="https://dfo.kemkes.go.id/assets/js/bootstrap.js" type="text/javascript"></script>
    <script src="https://dfo.kemkes.go.id/assets/js/jquery-ui.js" type="text/javascript"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {


            $('#namasurveior').autocomplete({
                source: "<?php echo site_url('Surveior/get_autocomplete_surveior'); ?>",


                select: function(event, ui) {
                    $('#namasurveior').val(ui.item.label);
                    $('#usersid').val(ui.item.userid);
                }
            });

        });
    </script>

    <script>
        $('[name="propinsi"]').change(function() {
            $("#kota_id").removeAttr('readonly'); //turns required off
            $('#kota_id').val('');

            $.ajax({
                // url: "../sina/pengajuan/dropdown5/" + $(this).val(),
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


        $(".update").click(function() {
            var id = $(this).attr('ids');
            var status = $("#status" + id).val();


            $.ajax({
                type: 'POST',
                url: "<?php echo site_url(); ?>/surveior/update_jadwal_perjalanan",
                data: {
                    id: id,
                    status: status
                },
                cache: false,
                success: function(data) {
                    alert(data);
                    location.reload();
                }
            });
        });
    </script>
    <script src="<?php echo base_url() ?>assets/js/app.js">

    </script>


</body>

</html>