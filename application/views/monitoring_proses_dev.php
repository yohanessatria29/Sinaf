<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Usul Survei</title>

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
    :root {
        --primary-color: rgb(17 137 33 / 83%);
    }

    /* Progressbartest */
    .progressbartest {
        position: relative;
        display: flex;
        justify-content: space-between;
        counter-reset: step;
        margin: 2rem 0 4rem;
        z-index: 0;
    }

    .progressbartest::before,
    .progresstest {
        content: "";
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        height: 4px;
        width: 100%;
        background-color: #dcdcdc;
        z-index: -1;
    }

    .progresstest {
        background-color: var(--primary-color);
        width: 0%;
        transition: 0.3s;
    }

    .progress-steptest {
        width: 2rem;
        height: 2rem;
        background-color: #dcdcdc;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .progress-steptest-active {
        background-color: var(--primary-color);
        color: #f3f3f3;
    }

    .progress-steptest-proses {
        background-color: yellow;
    }

    .progress-steptest-reject {
        background-color: red;
    }
</style>

<body>
    <?php
    include('template/sidebar.php');
    ?>
    <section class="section">
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
                            <div class="form-group row align-items-center">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="container">
                                            <form role="form" method="get" class="login-form" name="form_valdation" action="<?= base_url('Monitoring/prosescopy') ?>">
                                                <!-- FORM TANGGAL -->
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-2 col-4">
                                                        <label class="col-form-label" for="tanggal_awal">Tanggal</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="<?= $tanggal_awal ?>">
                                                    </div>
                                                    s.d.
                                                    <div class="col-md-4">
                                                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="<?= $tanggal_akhir ?>" min="<?= $tanggal_awal ?>">
                                                    </div>
                                                </div>
                                                <!-- FORM TANGGAL -->

                                                <!-- FORM PROVINSI -->
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-2 col-3">
                                                        <label class="col-form-label" for="provinsi_id">Provinsi</label>
                                                    </div>
                                                    <div class="col-lg-10 col-9">
                                                        <?= form_dropdown('propinsi', dropdown_sina_propinsi(), $propinsi, 'id="provinsi_id"  class="form-select" required'); ?>
                                                    </div>
                                                </div>
                                                <!-- FORM PROVINSI -->

                                                <!-- FORM KABKOTA -->
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-2 col-3">
                                                        <label class="col-form-label" for="kota_id">Kab/Kota</label>
                                                    </div>
                                                    <div class="col-lg-10 col-9">
                                                        <?= form_dropdown('kota', dropdown_sina_kab_kota(), $kota, 'id="kota_id"  class="form-select"'); ?>
                                                    </div>
                                                </div>
                                                <!-- FORM KABKOTA -->

                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-2 col-3">
                                                        <label class="col-form-label" for="jenis_fasyankes">Jenis Fasyankes</label>
                                                    </div>
                                                    <div class="col-lg-10 col-9">
                                                        <?= form_dropdown('jenis_fasyankes', dropdown_sina_jenis_fasyankes(), $jenis_fasyankes, 'id="jenis_fasyankes"  class="form-select"'); ?>
                                                    </div>
                                                </div>

                                                <div id="form_container">
                                                </div>

                                                <?php
                                                if ($this->session->userdata['kriteria_id'] == 2) {
                                                ?>
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
                                                <?php
                                                }
                                                ?>


                                                <div class="buttons" align="center">
                                                    <button href="submit" class="btn btn-success rounded-pill">Tampilkan</button>
                                                    <a href="<?php echo base_url('Monitoring/proses'); ?>" class="btn btn-light rounded-pill">Bersihkan</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 py-2">
                                            <label for="status_usulan">Filter Status Akreditasi : </label>
                                            <div id="statususulan" name="statususulan"></div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="table1" style="width: 200%;">
                                            <thead>
                                                <tr class="text-center">
                                                    <th style="width: 1%;">No</th>
                                                    <th style="width: 5%;">Kode Fasyankes</th>
                                                    <th style="width: 5%;">Kode Fasyankes Baru</th>
                                                    <th style="width: 12%;">Nama Fasyankes</th>
                                                    <th style="width: 10%;">Jenis Fasyankes</th>
                                                    <th>Kemampuan Pelayanan</th>
                                                    <th style="width: 3%;">LPA</th>
                                                    <th style="width: 5%;">Provinsi</th>
                                                    <th style="width: 10%;">Kab/Kota</th>
                                                    <th style="width: 5%;">Tgl Usulan</th>
                                                    <th>Tgl Survei 1</th>
                                                    <th>Tgl Survei 2</th>
                                                    <th>Tgl Survei 3</th>
                                                    <th style="width: 5%;">Tahap usulan</th>
                                                    <th>Status Akreditasi</th>
                                                    <th>Status Usulan</th>
                                                    <th>Keterangan Status</th>
                                                    <th>Pengajuan Usulan Survei</th>
                                                    <th>Respon LPA</th>
                                                    <th>Kesiapan Survei</th>
                                                    <th>Hasil Kesiapan Survei</th>
                                                    <th>Kesepakatan Survei</th>
                                                    <th>Penilaian EP Survei</th>
                                                    <th>Pengiriman Laporan</th>
                                                    <th>Penugasan Verifikator</th>
                                                    <th>Elemen Penilaian Verifikator</th>
                                                    <th>Rekomendasi Status Akreditasi</th>
                                                    <th>Penerbitan Sertifikat</th>
                                                    <?php if ($this->session->userdata('kriteria_id') == 2) {
                                                    ?>
                                                        <th>Action</th>
                                                    <?php
                                                    } else if ($this->session->userdata('kriteria_id') == 1) {
                                                    ?>
                                                        <th>Action</th>
                                                    <?php
                                                    } else if ($this->session->userdata('kriteria_id') == 5) { ?>
                                                        <th>Action</th>
                                                    <?php
                                                    }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $n = 1;
                                                foreach ($data as $data) {
                                                    $timestamp = strtotime($data['created_at']);
                                                    $date_formated = date('d-m-Y', $timestamp);
                                                    // $lpa_id = $data['lpa_id'];

                                                    $jenis_fasyankes = $data['jenis_fasyankes'];

                                                    // if ($data['jenis_fasyankes'] == 1) {
                                                    //     $jenis_fasyankes = 'Tempat Praktik Mandiri Nakes';
                                                    // } else if ($data['jenis_fasyankes'] == 2) {
                                                    //     $jenis_fasyankes = 'Pusat Kesehatan Masyrakat';
                                                    // } else if ($data['jenis_fasyankes'] == 3) {
                                                    //     $jenis_fasyankes = 'Klinik';
                                                    // } else if ($data['jenis_fasyankes'] == 4) {
                                                    //     $jenis_fasyankes = 'Rumah Sakit';
                                                    // } else if ($data['jenis_fasyankes'] == 6) {
                                                    //     $jenis_fasyankes = 'Unit Transfusi Darah';
                                                    // } else if ($data['jenis_fasyankes'] == 7) {
                                                    //     $jenis_fasyankes = 'Laboratorium Kesehatan';
                                                    // } else if ($data['jenis_fasyankes'] == 8) {
                                                    //     $jenis_fasyankes = 'Optikal';
                                                    // }

                                                    if ($data['status_admin_lpa'] == 1) {
                                                        $status_admin_lpa = '<span class="badge bg-warning">Belum Diperiksa</span>';
                                                    } else if ($data['status_admin_lpa'] == 3) {
                                                        $status_admin_lpa = '<span class="badge bg-success">Diterima</span>';
                                                    } else if ($data['status_admin_lpa'] == 2) {
                                                        $status_admin_lpa = '<span class="badge bg-danger">DiTolak</span>';
                                                    }

                                                    $tanggal_survei = json_decode($data['tanggal_survei']);
                                                    // print_r($tanggal_survei);

                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?= $n; ?></td>
                                                        <td><?= $data['fasyankes_id']; ?></td>
                                                        <td><?= $data['fasyankes_id_baru'] ?></td>
                                                        <td><?= $data['nama_fasyankes']; ?></td>
                                                        <td><?= $data['jenis_fasyankes']; ?></td>
                                                        <td>
                                                            <?php if (isset($data['jenis_pelayanan'])) {
                                                                echo $data['jenis_pelayanan'];
                                                            } ?>
                                                        </td>
                                                        <td><?= $data['nama_lpa']; ?></td>
                                                        <td><?= $data['nama_prop']; ?></td>
                                                        <td><?= $data['nama_kota']; ?></td>
                                                        <td><?= $date_formated; ?></td>
                                                        <td>
                                                            <?php
                                                            $date = date_create((!empty($tanggal_survei[0]) ? $tanggal_survei[0] : ''));
                                                            echo date_format($date, "d-m-Y");
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $date = date_create((!empty($tanggal_survei[1]) ? $tanggal_survei[1] : ''));
                                                            echo date_format($date, "d-m-Y");
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if (isset($tanggal_survei[2])) {
                                                                $date = date_create((!empty($tanggal_survei[2]) ? $tanggal_survei[2] : ''));
                                                                $date = date_format($date, "d-m-Y");
                                                                echo $date;
                                                            } else {
                                                                echo '-';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $data['tahap']; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($data['status_akreditasi_nama'] != NULL) {
                                                                echo $data['status_akreditasi_nama'];
                                                            } else {
                                                                echo 'Dalam Proses Akreditasi';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($data['status_usulan_id'] == '3') { ?>
                                                                <span class="badge bg-success">Diterima</span>
                                                            <?php } else if ($data['status_usulan_id'] == '2') { ?>
                                                                <span class="badge bg-danger">Ditolak</span>
                                                            <?php } else if ($data['status_usulan_id'] == '1') { ?>
                                                                <span class="badge bg-warning">Belum di periksa</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td><?php echo $data['keterangan'] ?></td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <?php
                                                                if ($data['pengajuan_usulan_survei_id_monitor'] != NULL) {
                                                                ?>
                                                                    <img src="<?php echo base_url() ?>assets/images/checklist.png" style="width: 30px;" alt="">
                                                                    <!-- <div class="progress-steptest progress-steptest-active" data-title="Pemohon"></div> -->
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="<?php echo base_url() ?>assets/images/cross.png" style="width: 30px;" alt="">
                                                                    <!-- <div class="progress-steptest progress-steptest-reject" data-title="Pemohon"></div> -->
                                                                <?php
                                                                }
                                                                ?>
                                                                <!-- test -->
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <?php
                                                                if ($data['penerimaan_pengajuan_usulan_survei_id_monitor'] != NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-active" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/checklist.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else if ($data['pengajuan_usulan_survei_id_monitor'] != NULL && $data['penerimaan_pengajuan_usulan_survei_id_monitor'] == NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-proses" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/alert.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="<?php echo base_url() ?>assets/images/cross.png" style="width: 30px;" alt="">
                                                                    <!-- <div class="progress-steptest progress-steptest-reject" data-title="Pemohon"></div> -->
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <?php
                                                                if ($data['berkas_usulan_survei_id_monitor'] != NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-active" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/checklist.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else if ($data['penerimaan_pengajuan_usulan_survei_id_monitor'] != NULL && $data['berkas_usulan_survei_id_monitor'] == NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-proses" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/alert.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else {
                                                                ?> <img src="<?php echo base_url() ?>assets/images/cross.png" style="width: 30px;" alt="">
                                                                    <!-- <div class="progress-steptest progress-steptest-reject" data-title="Pemohon"></div> -->
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <?php
                                                                if ($data['kelengkapan_berkas_id_monitor'] != NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-active" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/checklist.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else if ($data['berkas_usulan_survei_id_monitor'] != NULL && $data['kelengkapan_berkas_id_monitor'] == NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-proses" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/alert.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="<?php echo base_url() ?>assets/images/cross.png" style="width: 30px;" alt="">
                                                                    <!-- <div class="progress-steptest progress-steptest-reject" data-title="Pemohon"></div> -->
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <?php
                                                                if ($data['penetapan_tanggal_survei_id_monitor'] != NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-active" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/checklist.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else if ($data['kelengkapan_berkas_id_monitor'] != NULL && $data['penetapan_tanggal_survei_id_monitor'] == NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-proses" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/alert.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="<?php echo base_url() ?>assets/images/cross.png" style="width: 30px;" alt="">
                                                                    <!-- <div class="progress-steptest progress-steptest-reject" data-title="Pemohon"></div> -->
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <?php
                                                                if ($data['trans_final_ep_surveior_id_monitor'] != NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-active" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/checklist.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else if ($data['penetapan_tanggal_survei_id_monitor'] != NULL && $data['trans_final_ep_surveior_id_monitor'] == NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-proses" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/alert.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="<?php echo base_url() ?>assets/images/cross.png" style="width: 30px;" alt="">
                                                                    <!-- <div class="progress-steptest progress-steptest-reject" data-title="Pemohon"></div> -->
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <?php
                                                                if ($data['pengiriman_laporan_survei_id_monitor'] != NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-active" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/checklist.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else if ($data['trans_final_ep_surveior_id_monitor'] != NULL && $data['pengiriman_laporan_survei_id_monitor'] == NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-proses" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/alert.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="<?php echo base_url() ?>assets/images/cross.png" style="width: 30px;" alt="">
                                                                    <!-- <div class="progress-steptest progress-steptest-reject" data-title="Pemohon"></div> -->
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <?php
                                                                if ($data['penetapan_verifikator_id_monitor'] != NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-active" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/checklist.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else if ($data['pengiriman_laporan_survei_id_monitor'] != NULL && $data['penetapan_verifikator_id_monitor'] == NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-proses" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/alert.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="<?php echo base_url() ?>assets/images/cross.png" style="width: 30px;" alt="">
                                                                    <!-- <div class="progress-steptest progress-steptest-reject" data-title="Pemohon"></div> -->
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <?php
                                                                if ($data['trans_final_ep_verifikator_id_monitor'] != NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-active" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/checklist.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else if ($data['penetapan_verifikator_id_monitor'] != NULL && $data['trans_final_ep_verifikator_id_monitor'] == NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-proses" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/alert.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="<?php echo base_url() ?>assets/images/cross.png" style="width: 30px;" alt="">
                                                                    <!-- <div class="progress-steptest progress-steptest-reject" data-title="Pemohon"></div> -->
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <?php
                                                                if ($data['pengiriman_rekomendasi_id_monitor'] != NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-active" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/checklist.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else if ($data['trans_final_ep_verifikator_id_monitor'] != NULL && $data['pengiriman_rekomendasi_id_monitor'] == NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-proses" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/alert.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="<?php echo base_url() ?>assets/images/cross.png" style="width: 30px;" alt="">
                                                                    <!-- <div class="progress-steptest progress-steptest-reject" data-title="Pemohon"></div> -->
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">

                                                                <?php
                                                                if ($data['penerbitan_sertifikat_id_monitor'] != NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-active" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/checklist.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else if ($data['penerbitan_sertifikat_id_monitor'] == NULL && $data['pengiriman_rekomendasi_id_monitor'] != NULL) {
                                                                ?>
                                                                    <!-- <div class="progress-steptest progress-steptest-proses" data-title="Pemohon"></div> -->
                                                                    <img src="<?php echo base_url() ?>assets/images/alert.png" style="width: 30px;" alt="">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <img src="<?php echo base_url() ?>assets/images/cross.png" style="width: 30px;" alt="">
                                                                    <!-- <div class="progress-steptest progress-steptest-reject" data-title="Pemohon"></div> -->
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </td>
                                                        <?php if ($this->session->userdata('kriteria_id') == 2) {
                                                        ?>
                                                            <td>
                                                                <?php if ($data['trans_final_ep_surveior_id_monitor'] != NULL) { ?>
                                                                    <a href="<?php echo base_url('Kemenkes/detailfasyankes/') . $data['id']; ?>" class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                        </svg></a>
                                                                <?php } ?>
                                                            </td>
                                                        <?php
                                                        } else if ($this->session->userdata('kriteria_id') == 1) {
                                                        ?>
                                                            <td>
                                                                <a href="<?php echo base_url('Pengajuan/detail/') . $data['id']; ?>" class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                    </svg></a>
                                                            </td>
                                                        <?php
                                                        } else if ($this->session->userdata('kriteria_id') == 5) {
                                                        ?>
                                                            <td>
                                                                <?php if ($data['trans_final_ep_surveior_id_monitor'] != NULL) { ?>
                                                                    <a href="<?php echo base_url('Pengajuan/detailfasyankes/') . $data['id']; ?>" class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                        </svg></a>
                                                                <?php } ?>
                                                            </td>
                                                        <?php }
                                                        ?>
                                                        <!-- <td>
                                                                            <div class="buttons">
                                                                                <a href="<?php //echo base_url('pengajuan/detail/') . $data['id']; 
                                                                                            ?>" class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                                    </svg></a>
                                                                                <?php
                                                                                // if (is_null($data['status_final_ep']) == 0 && is_null($data['pengiriman_laporan_survei_id']) == 0) {

                                                                                ?>
                                                                                    <a data-bs-toggle="modal" data-bs-target="#modal_verif" class="btn icon icon-left btn-secondary"><i data-feather="user"></i>
                                                                                        Verifikator</a>
                                                                                <?php // } 
                                                                                ?>
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

        $('#jenis_fasyankes').change(function() {
            var value = $(this).val();
            var formContainer = document.getElementById('form_container');

            if (formContainer) {
                formContainer.innerHTML = ''; // Remove any previous form content
            }

            if (value === '3') {
                createForm('klinik');
            } else if (value === '7') {
                createForm('lab')
            }
        })



        // Function to dynamically create the form
        function createForm(jenis) {
            // Check if the form already exists, if so, don't create it again
            var formContainer = document.getElementById('form_container');
            if (document.getElementById('form_jenis_faskes')) {
                return; // Form already exists
            }

            // Create the form container div
            var formDiv = document.createElement('div');
            formDiv.id = 'form_jenis_faskes';
            formDiv.classList.add('form-group', 'row', 'align-items-center');

            // Create the label element
            var labelDiv = document.createElement('div');
            labelDiv.classList.add('col-lg-2', 'col-3');

            var label = document.createElement('label');
            label.setAttribute('for', 'jenis_faskes');
            label.id = 'label_jenis_faskes';
            if (jenis === 'klinik') {
                label.textContent = "Jenis Klinik"; // Set the label text
            } else if (jenis === 'lab') {
                label.textContent = "Jenis Lab";
            }

            labelDiv.appendChild(label);

            // Create the dropdown container (second dropdown)
            var dropdownDiv = document.createElement('div');
            dropdownDiv.classList.add('col-lg-10', 'col-9');

            // Create the second dropdown select element
            var selectElement = document.createElement('select');
            selectElement.id = 'jenis_faskes';
            selectElement.name = 'jenis_faskes';
            selectElement.classList.add('form-select');

            if (jenis === 'klinik') {
                // Add options to the second dropdown (you can replace this with dynamic data)
                var option1 = document.createElement('option');
                option1.value = '1';
                option1.textContent = 'Pratama';
                selectElement.appendChild(option1);

                var option2 = document.createElement('option');
                option2.value = '2';
                option2.textContent = 'Utama';
                selectElement.appendChild(option2);

                dropdownDiv.appendChild(selectElement);
            } else if (jenis === 'lab') {
                // Add options to the second dropdown (you can replace this with dynamic data)
                var option1 = document.createElement('option');
                option1.value = '1';
                option1.textContent = 'Medis';
                selectElement.appendChild(option1);

                var option2 = document.createElement('option');
                option2.value = '2';
                option2.textContent = 'Kesehatan';
                selectElement.appendChild(option2);


                dropdownDiv.appendChild(selectElement);
            }


            // Append the label and dropdown containers to the form container
            formDiv.appendChild(labelDiv);
            formDiv.appendChild(dropdownDiv);

            // Append the form to the formContainer
            formContainer.appendChild(formDiv);
        }


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
            "autoWidth": false,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'csv'
            ],
            initComplete: function() {
                this.api()
                    .columns(13)
                    .every(function() {
                        var column = this;
                        var select = $('<select class="form-control" id="status_usulan"><option value="">--Pilih Status Akreditasi--</option></select>')
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
</body>

</html>