<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Usul Survei</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main/app-dark.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png'); ?>" type="image/png">

    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/css/jquery.dataTables.min.css">
    <script src="<?php echo base_url('assets/temp'); ?>/jquery-3.6.0.js"></script>

</head>

<body>
    <?php include('template/sidebar.php'); ?>
    <?php

    if ($this->session->flashdata('message_name') != null) { ?>
        <div class="alert alert-<?= $this->session->flashdata('kode_name'); ?> alert-dismissible">
            <?= $this->session->flashdata('message_name'); ?>
        </div>
    <?php } ?>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="card">

                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pengajuan Usul Survei</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="card">
                                        </br>
                                        <div class="form-group row align-items-center">
                                            <?php echo form_open_multipart('Pengajuan') ?>
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

                                                        <select name="jenis_fasyankes" id="jenis_fasyankes" class="form-control">
                                                            <option value="<?= $jenis_fasyankes[0]['fasyankes_id'] ?>"><?= $jenis_fasyankes[0]['nama_fasyankes'] ?></option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-2 col-3">
                                                        <label class="col-form-label">Status Usulan</label>
                                                    </div>
                                                    <div class="col-lg-10 col-9">

                                                        <?= form_dropdown('status_usulan_id', dropdown_sina_status_usulan_all(), $status_usulan_id, 'id="status_usulan_id"  class="form-select" '); ?>

                                                    </div>
                                                </div>
                                                <div class="buttons" align="center">
                                                    <button href="submit" class="btn btn-success rounded-pill">Tampilkan</button>
                                                    <a href="<?php echo base_url('pengajuan/'); ?>" class="btn btn-light rounded-pill">Bersihkan</a>
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
                                                            <th>Tgl Usulan</th>
                                                            <th>Rencana Tgl Awal Survei</th>
                                                            <th>Status</th>
                                                            <td>Alasan Ditolak</td>
                                                            <th>Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $n = 1;
                                                        foreach ($data as $data) {
                                                            $timestamp = strtotime($data['created_at']);
                                                            $date_formated = date('d-m-Y', $timestamp);
                                                            $timestamp2 = strtotime($data['tanggal_awal_survei']);
                                                            $date_formated2 = date('d-m-Y', $timestamp2);
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
                                                                <td><?= $date_formated2 ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($data['status_usulan_id'] == 1) {
                                                                    ?>
                                                                        <span class="badge bg-warning">Belum Diperiksa</span>
                                                                        <?php
                                                                    } else {
                                                                        if ($data['status_usulan_id'] == 2) {
                                                                        ?>
                                                                            <span class="badge bg-danger">Ditolak</span>
                                                                        <?php
                                                                        } else if ($data['status_usulan_id'] == 3) {
                                                                        ?>
                                                                            <span class="badge bg-success">Diterima</span>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><?= $data['keterangan'] ?></td>
                                                                <td>
                                                                    <div class="buttons">
                                                                        <a href="<?php echo base_url('pengajuan/detail/') . $data['id']; ?>" class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                            </svg></a>
                                                                        <?php
                                                                        if (is_null($data['status_final_ep']) == 0 && is_null($data['pengiriman_laporan_survei_id']) == 0) {
                                                                        ?>
                                                                        <?php } ?>
                                                                    </div>
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


                                    <!-- Modal -->
                                    <!-- <div class="modal fade text-left modal-borderless" id="modal_verif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <br>
                                                    <div class="col-sm mt-2">
                                                        <h6>Verifikator</h6>

                                                        <?= form_dropdown('verifikator', dropdown_sina_verifikator($session_lpa), '', 'id="verifikator" class="form-select"'); ?>
                                                    </div>

                                                    <input type="hidden" name="id_faskes6" value="<?= $lpa_id; ?>" id="id_faskes6">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Batal</span>
                                                        </button>
                                                        <button type="submit" class="btn btn-success ml-1" data-bs-dismiss="modal" id="simpan_lab_no" name="simpan_lab_no">
                                                            <i class="bx bx-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Simpan</span>
                                                        </button>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                </div>
                            </div>
                            <!-- Batas Modal -->



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
            ],
            "initComplete": function(settings, json) {
                // Check if the table is empty
                if ($('#table1').DataTable().data().count() === 0) {
                    // Hide the buttons if the table is empty
                    $('.dt-buttons').hide();
                } else {
                    // Ensure buttons are visible if there's data
                    $('.dt-buttons').show();
                }
            }
        });

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

</body>

</html>