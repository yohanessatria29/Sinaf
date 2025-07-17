<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surveior</title>


    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main/app-dark.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png'); ?>" type="image/png">
    <!-- <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href=" https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css"> -->

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
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Surveior</a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="ukom-tab" data-bs-toggle="tab" href="#ukom" role="tab" aria-controls="ukom" aria-selected="true">UKOM Surveior</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <!-- surveior -->
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="card">
                                        </br>

                                        <div class="buttons">
                                            <a href="<?php echo base_url() ?>pengajuan/inputsurveior" class="btn btn-success rounded-pill">Input Surveior</a>
                                            <!-- <a href="#" class="btn btn-light rounded-pill">Bersihkan</a> -->
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered" id="table1">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>NIK</th>
                                                                <th>Nama</th>
                                                                <th style="text-align: center">Jumlah Penugasan</th>
                                                                <th>Email</th>
                                                                <th>LPA</th>
                                                                <th>No Hp</th>
                                                                <th>Provinsi</th>
                                                                <th>Kab/Kota</th>
                                                                <th>Status</th>
                                                                <!-- <th>Fasyankes</th>
                                                                <th>Bidang</th> -->
                                                                <th>Action</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $n = 1;
                                                            foreach ($data as $data) {
                                                                if ($data['jumlah_penugasan'] == NULL) {
                                                                    $data['jumlah_penugasan'] = '0';
                                                                }

                                                            ?>
                                                                <tr>
                                                                    <td style="text-align: center"><?= $n; ?></td>

                                                                    <td>
                                                                        <?php
                                                                        $masked = substr($data['nik'], 0, 4) . str_repeat('*', strlen($data['nik']) - 8) . substr($data['nik'], -4);
                                                                        echo $masked;
                                                                        ?>
                                                                        <? //= $data['nik']; 
                                                                        ?>
                                                                    </td>
                                                                    <td><?= $data['nama']; ?></td>
                                                                    <td style="text-align: center"><?= $data['jumlah_penugasan']; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        $parts = explode('@', $data['email']);
                                                                        $username = $parts[0];
                                                                        $domain = $parts[1];

                                                                        // Masking username dengan menampilkan hanya 2 karakter pertama dan sisanya dengan asterisk
                                                                        $maskedUsername = substr($username, 0, 2) . str_repeat('*', strlen($username) - 2);

                                                                        $maskedemail = $maskedUsername . '@' . $domain;

                                                                        echo $maskedemail;

                                                                        ?>
                                                                        <? //= $data['email']; 
                                                                        ?>
                                                                    </td>
                                                                    <td><?= $data['nama_lpa']; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        $no_hp = $data['no_hp'] ?? ''; // jika null, jadi empty string

                                                                        if (strlen($no_hp) >= 8) {
                                                                            $masked = substr($no_hp, 0, 4)
                                                                                . str_repeat('*', strlen($no_hp) - 8)
                                                                                . substr($no_hp, -4);
                                                                        } else {
                                                                            // Bisa tampilkan default, atau langsung tampilkan apa adanya
                                                                            $masked = $no_hp ?: '-';
                                                                        }

                                                                        echo $masked;
                                                                        ?>
                                                                    </td>
                                                                    <td><?= $data['nama_provinsi']; ?></td>
                                                                    <td><?= $data['kab_kota']; ?></td>
                                                                    <td><?= $data['keaktifan']; ?></td>
                                                                    <!-- <td>Puskesmas</td>
                                                                    <td>Managemen</td> -->

                                                                    <td>
                                                                        <div class="buttons">
                                                                            <a href="<?php echo base_url('pengajuan/editsurveior/') . $data['id']; ?>" class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                                </svg></a>
                                                                            <!-- <a href="<?php echo base_url('pengajuan/hapussurveior/') . $data['users_id'] . '/' . $data['no_hp']; ?>" onclick="return confirm('Apa Anda Yakin Ingin Menghapusnya?')" class="btn icon btn-danger">Delete</a> -->

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
                                    </div>
                                </div>
                                <!-- ukom -->
                                <div class="tab-pane fade show" id="ukom" role="tabpanel" aria-labelledby="ukom-tab">
                                    <div class="card">
                                        </br>

                                        <div class="buttons">
                                            <!-- <a href="<?php echo base_url() ?>pengajuan/inputsurveior" class="btn btn-success rounded-pill">Daftar Ukom</a> -->
                                            <!-- <a href="#" class="btn btn-light rounded-pill">Bersihkan</a> -->
                                            <label>Daftar Ukom Surveior</label>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered" id="table2">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>NIK</th>
                                                                <th>Nama</th>
                                                                <!-- <th style="text-align: center">Jumlah Penugasan</th> -->
                                                                <!-- <th>Email</th> -->
                                                                <th>LPA</th>
                                                                <th>Fasyankes</th>
                                                                <th>Bidang</th>
                                                                <th>Status Ukom</th>
                                                                <th>Tanggal Berakhir</th>
                                                                <!-- <th>Fasyankes</th>
                                                                <th>Bidang</th> -->
                                                                <!-- <th>Action</th> -->

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $n = 1;
                                                            foreach ($data_ukom as $data_ukom) {
                                                                if ($data_ukom['status_ukom'] == '1') {
                                                                    $status_ukom = "Lulus";
                                                                } else {
                                                                    $status_ukom = "Tidak Lulus";
                                                                }

                                                            ?>
                                                                <tr>
                                                                    <td style="text-align: center"><?= $n; ?></td>

                                                                    <td><?= $data_ukom['nik']; ?></td>
                                                                    <td><?= $data_ukom['nama']; ?></td>

                                                                    <td><?= $data_ukom['lpa']; ?></td>
                                                                    <td><?= $data_ukom['nama_faskes']; ?></td>
                                                                    <td><?= $data_ukom['nama_bidang']; ?></td>
                                                                    <td><?= $status_ukom; ?></td>
                                                                    <td><?= $data_ukom['tgl_berakhir_ukom']; ?></td>
                                                                    <!-- <td><?= $data['keaktifan']; ?></td> -->
                                                                    <!-- <td>Puskesmas</td>
                                                                    <td>Managemen</td> -->

                                                                    <!-- <td>
                                                                        <div class="buttons">
                                                                            <a href="<?php echo base_url('pengajuan/editsurveior/') . $data['id']; ?>" class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                                </svg></a> -->
                                                                    <!-- <a href="<?php echo base_url('pengajuan/hapussurveior/') . $data['users_id'] . '/' . $data['no_hp']; ?>" onclick="return confirm('Apa Anda Yakin Ingin Menghapusnya?')" class="btn icon btn-danger">Delete</a> -->

                                                                    <!-- </div>
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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script> -->
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


</body>

</html>
<script>
    $(document).ready(function() {
        $('#table1').DataTable();
        $('#table2').DataTable();
    });
</script>
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
</script>