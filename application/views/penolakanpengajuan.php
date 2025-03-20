<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Pembatalan Survei</title>
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/jquery-ui.css">
    <script src="<?php echo base_url('assets/temp'); ?>/jquery-3.6.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/css/jquery.dataTables.min.css">
    <style>
        .badge {
            line-height: 1.5;
        }

        .hideform {
            display: none;
        }
    </style>
</head>


<body>
    <?php include('template/sidebar.php'); ?>
    <?php if ($this->session->flashdata('message_name') != null) { ?>
        <div class="alert alert-<?= $this->session->flashdata('kode_name'); ?> alert-dismissible">
            <?= $this->session->flashdata('message_name'); ?>
        </div>
    <?php } ?>
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Permintaan Pembatalan Pengajuan Survei</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4 py-2">
                                    <label for="statususulan">Filter Status : </label>
                                    <div id="statususulan" name="statususulan"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="container-fluid">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" id="tablepenolakan">
                                                <thead>
                                                    <tr>
                                                        <th style="nowrap; width: 1%;">No</th>
                                                        <th style="nowrap; width: 1%;">Kode Faskes</th>
                                                        <th style="nowrap; width: 1%;">Nama Faskes</th>
                                                        <th style="nowrap; width: 1%;">Jenis Faskes</th>
                                                        <th style="nowrap; width: 1%;">Alasan Pembatalan</th>
                                                        <th style="nowrap; width: 1%;">Surat Pembatalan</th>
                                                        <th style="nowrap; width: 1%;">Nama LPA</th>
                                                        <th style="nowrap; width: 1%;">Tanggal Pengajuan Survei</th>
                                                        <th style="nowrap; width: 1%;">Tanggal Pengajuan Pembatalan</th>
                                                        <th style="nowrap; width: 1%;">Status Pengajuan Saat ini</th>
                                                        <th style="nowrap; width: 1%;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $n = 1;
                                                    foreach ($data as $data) {
                                                        $tanggal_usulan = date("d-m-Y", strtotime($data['tanggal_pengajuan']));
                                                        $tanggal_pembatalan = date("d-m-Y", strtotime($data['created_at']));
                                                        $db_datetime = new DateTime($data['created_at']);
                                                        $db_plus_three = $db_datetime->add(new DateInterval('P3D'));
                                                        $now_datetime = new DateTime();
                                                    ?>
                                                        <tr>
                                                            <td><?= $n ?></td>
                                                            <td><?= $data['fasyankes_id'] ?></td>
                                                            <td><?= $data['nama_fasyankes'] ?></td>
                                                            <td><?= $data['jenis_fasyankes'] ?></td>
                                                            <td><?= $data['alasan_pembatalan'] ?></td>
                                                            <td>
                                                                <a class="btn btn-sm btn-primary rounded-pill" target="_blank" href="<?php echo $data['surat_pembatalan']; ?>">Lihat Dokumen</a>
                                                            </td>
                                                            <td><?= $data['nama_lpa'] ?></td>
                                                            <td><?= $tanggal_usulan ?></td>
                                                            <td><?= $tanggal_pembatalan ?></td>
                                                            <td>
                                                                <?php
                                                                if ($data['status_usulan_id'] != '3') {
                                                                ?>
                                                                    <span class="badge bg-danger"><?= $data['status_usulan'] ?></span>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <span class="badge bg-warning">Menunggu Respon</span>
                                                                <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                $kriteriaid = $this->session->userdata('kriteria_id');
                                                                if ($kriteriaid == 1) {
                                                                    if ($data['status_usulan_id'] != '3') {
                                                                ?>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <div class="buttons">
                                                                            <a href="<?php echo base_url('pengajuan/detailpenolakanpengajuan/') . $data['pengajuan_pembatalan_id']; ?>" class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                                </svg></a>
                                                                        </div>

                                                                        <?php
                                                                    }
                                                                } else if ($kriteriaid == 8) {
                                                                    if ($db_plus_three < $now_datetime) {
                                                                        if ($data['status_usulan_id'] == '3') {
                                                                        ?>
                                                                            <div class="buttons">
                                                                                <a href="<?php echo base_url('pengajuan/detailpenolakanpengajuan/') . $data['pengajuan_pembatalan_id']; ?>" class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                                    </svg></a>
                                                                            </div>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    <?php
                                                                        // echo 'lewat';
                                                                        // print_r($db_plus_three);
                                                                    } else {
                                                                        // echo 'belum lewat';
                                                                        // print_r($now_datetime);
                                                                    ?>
                                                                        <span class="badge bg-warning">Masih menunggu Respon Admin LPA</span>
                                                                <?php
                                                                    }
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
    <script src="<?php echo base_url() ?>assets/js/app.js"></script>
</body>

</html>

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="<?php echo base_url('assets/temp/js_x'); ?>/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script>
    $('#tablepenolakan').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        initComplete: function() {
            this.api()
                .columns(9)
                .every(function() {
                    var column = this;
                    var select = $('<select class="form-control"><option value="">--Pilih Status Pengajuan--</option></select>')
                        .appendTo('#statususulan')
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function(d, j) {
                            select.append('<option>' + d + '</option>');
                        });
                })
        }
    });
</script>