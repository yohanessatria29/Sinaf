<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Usul Survei</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/jquery-ui.css">
    <script src="<?php echo base_url('assets/temp'); ?>/jquery-3.6.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
    <section class="section">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="persetujuan-tab" data-bs-toggle="tab" href="#persetujuan" role="tab" aria-controls="persetujuan" aria-selected="true">Persetujuan Usulan Survei</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="narahubung-tab" data-bs-toggle="tab" href="#narahubung" role="tab" aria-controls="narahubung" aria-selected="false">Narahubung</button>
                        </li>

                        <?php
                        if (!empty($data[0]['penerimaan_pengajuan_usulan_survei_id'])) {
                        ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="kesiapan-tab" data-bs-toggle="tab" href="#kesiapan" role="tab" aria-controls="kesiapan" aria-selected="false">Kesiapan Survei </a>
                            </li>
                        <?php
                        } ?>

                        <?php
                        if (!empty($data[0]['berkas_usulan_survei_id'])) {
                        ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="hasilkesiapan-tab" data-bs-toggle="tab" href="#hasilkesiapan" role="tab" aria-controls="hasilkesiapan" aria-selected="false">Hasil Kesiapan Survei</a>
                            </li>
                        <?php
                        } ?>

                        <?php
                        if (!empty($data[0]['kelengkapan_berkas_id'])) {
                        ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="kesepakatan-tab" data-bs-toggle="tab" href="#kesepakatan" role="tab" aria-controls="kesepakatan" aria-selected="false">Kesepakatan Survei</a>
                            </li>
                        <?php
                        }
                        ?>

                        <?php
                        if (!empty($data[0]['pengiriman_laporan_survei_id'])) {
                        ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="laporan-tab" data-bs-toggle="tab" href="#laporan" role="tab" aria-controls="laporan" aria-selected="false">Laporan Survei</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="verifikator-tab" data-bs-toggle="tab" href="#verifikator" role="tab" aria-controls="verifikator" aria-selected="false">Pemiihan Verifikator</a>
                            </li>
                        <?php
                        }
                        ?>


                    </ul>
                    <div class="tab-content" id="TabContent">

                        <!-- TAB PERSETUJUAN -->
                        <div class="tab-pane fade show active" id="persetujuan" role="tabpanel" aria-labelledby="persetujuan-tab">
                            <div class="page-heading">

                            </div>
                            <div class="page-body">
                                <?php
                                echo form_open_multipart('Pengajuan/simpanPenerimaanUsulan')
                                ?>
                                <form method="post" class="login-form" name="form_validation">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="disabledInput">Kode Fasyankes</label>
                                                <input type="text" class="form-control" id="fasyankes_id" name="fasyankes_id" placeholder="Kode Fasyankes" value="<?= $data[0]['fasyankes_id']; ?>" readonly>
                                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $data[0]['id'] ?>">
                                                <input type="hidden" class="form-control" id="penerimaan_pengajuan_usulan_survei_id" name="penerimaan_pengajuan_usulan_survei_id" value="<?= $data[0]['penerimaan_pengajuan_usulan_survei_id'] ?>">
                                            </div>
                                            <?php
                                            if ($data[0]['jenis_fasyankes'] == 1) {
                                                $jenis_fasyankes = 'Tempat Praktik Mandiri Nakes';
                                            } else if ($data[0]['jenis_fasyankes'] == 2) {
                                                $jenis_fasyankes = 'Pusat Kesehatan Masyrakat';
                                            } else if ($data[0]['jenis_fasyankes'] == 3) {
                                                $jenis_fasyankes = 'Klinik';
                                            } else if ($data[0]['jenis_fasyankes'] == 4) {
                                                $jenis_fasyankes = 'Rumah Sakit';
                                            } else if ($data[0]['jenis_fasyankes'] == 5) {
                                                $jenis_fasyankes = 'Apotek';
                                            } else if ($data[0]['jenis_fasyankes'] == 6) {
                                                $jenis_fasyankes = 'Unit Transfusi Darah';
                                            } else if ($data[0]['jenis_fasyankes'] == 7) {
                                                $jenis_fasyankes = 'Laboratorium Kesehatan';
                                            } else if ($data[0]['jenis_fasyankes'] == 8) {
                                                $jenis_fasyankes = 'Optikal';
                                            } else if ($data[0]['jenis_fasyankes'] == 9) {
                                                $jenis_fasyankes = 'Fasyankes Kedokteran Untuk Kepentingan Hukum';
                                            } else {
                                                $jenis_fasyankes = 'Fasyankes Tradisional';
                                            };
                                            ?>
                                            <div class="form-group">
                                                <label for="disabledInput">Jenis Fasyankes</label>
                                                <input type="text" class="form-control" id="jenis_fasyankes" name="jenis_fasyankes" placeholder="Jenis Fasyankes" value="<?= $jenis_fasyankes; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="helperText">Nama LPA</label>
                                                <fieldset class="form-group">
                                                    <input type="text" class="form-control" placeholder="Nama LPA" value="<?php echo $data[0]['lpa']; ?>" readonly>
                                                </fieldset>

                                                <div class="form-group">
                                                    <label for="helperText">Metode Survei</label>
                                                    <fieldset class="form-group">
                                                        <?= form_dropdown('metode_survei_id', dropdown_sina_metode_survei($data[0]['jenis_fasyankes']), $data[0]['metode_survei_id'], 'id="metode_survei_id"  class="form-select" disabled'); ?>
                                                    </fieldset>
                                                </div>

                                                <?php if ($data[0]['url_suket_kendala_jaringan'] != NULL) { ?>
                                                    <div class="form-group">
                                                        <label for="disabledInput">Surat Keterangan Kendala Jaringan Dinkes Kab/Kota</label>
                                                        <fieldset>
                                                            <div class="input-group">
                                                                <a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo $data[0]['url_suket_kendala_jaringan']; ?>">Lihat Dokumen</a>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                                <div class="form-group">
                                                    <label for="">Jenis Survei</label>
                                                    <fieldset class="form-group">
                                                        <?= form_dropdown('jenis_survei_id', dropdown_sina_jenis_survei(), $data[0]['jenis_survei_id'], 'id="jenis_survei_id"  class="form-control" disabled'); ?>
                                                    </fieldset>
                                                </div>

                                                <?php
                                                if ($data[0]['jenis_survei_id'] == 2) {
                                                    $var_style_jenis_akreditasi = "none";
                                                    $required = "";

                                                    $var_style_usulan = "block";
                                                    $required_usulan = "required";
                                                } else {
                                                    $var_style_jenis_akreditasi = "block";
                                                    $required = "required";

                                                    if ($data[0]['jenis_akreditasi_id'] == 3) {
                                                        $var_style_usulan = "block";
                                                        $required_usulan = "required";
                                                    } else {
                                                        $var_style_usulan = "none";
                                                        $required_usulan = "";
                                                    }
                                                }
                                                ?>

                                                <div class="form-group" style="display:<?= $var_style_usulan ?>" id='pengajuan_usulan_survei'>
                                                    <label for="">Tanggal Usulan Sebelumnya</label>
                                                    <fieldset class="form-group">
                                                        <?= form_dropdown('pengajuan_usulan_survei_id_lama', dropdown_sina_daftar_pengajuan($data[0]['fasyankes_id'], $data[0]['jenis_fasyankes']), $data[0]['pengajuan_usulan_survei_id_lama'], 'id="pengajuan_usulan_survei_id_lama"  class="form-select" disabled'); ?>
                                                    </fieldset>
                                                </div>

                                                <div class="form-group" style="display:<?= $var_style_jenis_akreditasi ?>">
                                                    <label for="">Jenis Akreditasi</label>
                                                    <?= form_dropdown('jenis_akreditasi_id', dropdown_sina_jenis_akreditasi(), $data[0]['jenis_akreditasi_id'], 'id="jenis_akreditasi_id"  class="form-control" disabled'); ?>
                                                </div>

                                                <?php
                                                if ($data[0]['jenis_survei_id'] == 1) {
                                                    if ($data[0]['jenis_akreditasi_id'] == 2) {
                                                        $var_style_status = "block";
                                                        $var_style_sertifikat = "block";
                                                        $var_style_tgl_akhir = "block";
                                                    } else {
                                                        $var_style_status = "none";
                                                        $var_style_sertifikat = "none";
                                                        $var_style_tgl_akhir = "none";
                                                    }
                                                } else {
                                                    $var_style_status = "none";
                                                    $var_style_sertifikat = "none";
                                                    $var_style_tgl_akhir = "none";
                                                }
                                                ?>

                                                <div class="form-group status" style="display: <?= $var_style_status; ?>" id="status">
                                                    <label for="disabledInput">Status Akreditasi Sebelumnya</label>
                                                    <input type="text" name="status_akreditasi_id" id="status_akreditasi_id" value="<?= $data[0]['status_akreditasi_sebelumnya'] ?>" class="form-control" disabled>
                                                </div>

                                                <div class="form-group" style="display:<?= $var_style_sertifikat ?>">
                                                    <label for="disabledInput">Sertifikat Akreditasi Sebelumnya / Surat Penetapan</label>
                                                    <fieldset>
                                                        <div class="input-group">
                                                            <a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo $data[0]['url_sertifikasi_akreditasi_sebelumnya']; ?>">Lihat Dokumen</a>
                                                        </div>
                                                    </fieldset>
                                                </div>

                                                <div class="form-group" style="display:<?= $var_style_tgl_akhir ?>">
                                                    <label for="disabledInput">Tanggal Akhir Sertifikat</label>
                                                    <input type="text" name="tanggal_akhir_sertifikat" id="datepicker" value="<?= $data[0]['tanggal_akhir_sertifikat'] ?>" class="form-control datepicker" autocomplete="off" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label for="helperText">Tanggal Pengajuan Survei</label>
                                                    <input type="text" name="tanggal_pengajuan_survei" id="datepickerstr" value="<?= $data[0]['created_at'] ?>" class="form-control datepicker" autocomplete="off" disabled>
                                                </div>

                                                <div class="form-group" style="display:<?= $var_style_tgl_akhir ?>">
                                                    <label for="disabledInput">Tanggal Keberangkatan Survei</label>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="date" name="tanggal_awal_keberangkatan" id="datepicker" value="<?= $data[0]['tanggal_awal_keberangkatan'] ?>" class="form-control datepicker" autocomplete="off" disabled>
                                                        </div>
                                                        s.d.
                                                        <div class="col-md-4">
                                                            <input type="date" name="tanggal_akhir_keberangkatan" id="datepicker" value="<?= $data[0]['tanggal_akhir_keberangkatan'] ?>" class="form-control datepicker" autocomplete="off" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="helperText">Tanggal Rencana Survei</label>
                                                    <div class="row">
                                                        <?php
                                                        foreach ($detail_pengajuan as $datab) {
                                                        ?>
                                                            <div class="col-md-4">
                                                                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="<?= $datab['tanggal_survei'] ?>" disabled>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="display:<?= $var_style_tgl_akhir ?>">
                                                    <label for="disabledInput">Tanggal Kepulangan Survei</label>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="date" name="tanggal_awal_kepulangan" id="datepicker" value="<?= $data[0]['tanggal_awal_kepulangan'] ?>" class="form-control datepicker" autocomplete="off" disabled>
                                                        </div>
                                                        s.d.
                                                        <div class="col-md-4">
                                                            <input type="date" name="tanggal_akhir_kepulangan" id="datepicker" value="<?= $data[0]['tanggal_akhir_kepulangan'] ?>" class="form-control datepicker" autocomplete="off" disabled>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="form-group">
                                                    <label for="helperText">Status Usulan</label>
                                                    <?php
                                                    if (!empty($data[0]['pengiriman_laporan_survei_id'])) {
                                                    ?>
                                                        <?= form_dropdown('status_usulan_id', dropdown_sina_status_usulan(), $data[0]['status_usulan_id'], 'id="status_usulan_id" disabled  class="form-select" '); ?>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <?= form_dropdown('status_usulan_id', dropdown_sina_status_usulan(), $data[0]['status_usulan_id'], 'id="status_usulan_id"   class="form-select" '); ?>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>

                                                <?php
                                                if (!empty($data[0]['status_usulan_id'])) {
                                                    if ($data[0]['status_usulan_id'] == 2) {
                                                        $keterangan_style = "block";
                                                        $submit_style = "none";
                                                        $keterangan_required = "required";
                                                    } else if (!empty($data[0]['pengiriman_laporan_survei_id'])) {
                                                        $keterangan_style = "none";
                                                        $submit_style = "none";
                                                        $keterangan_required = "";
                                                    } else {
                                                        $keterangan_style = "none";
                                                        $submit_style = "block";
                                                        $keterangan_required = "";
                                                    }
                                                } else {
                                                    $keterangan_style = "block";
                                                    $submit_style = "block";
                                                    $keterangan_required = "required";
                                                }
                                                ?>

                                                <div class="form-group">
                                                    <label for="helperText">Alasan Ditolak</label>
                                                    <textarea type="text" id="keterangan" name="keterangan" class="form-control" style="display:<?= $keterangan_style; ?>;" <?= $keterangan_required; ?>><?= $data[0]['keterangan']; ?></textarea>
                                                </div>

                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1" style="display:<?= $submit_style; ?>;">Submit</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- TAB PERSETUJUAN -->


                        <!-- TAB NARAHUBUNG -->
                        <div class="tab-pane fade" id="narahubung" role="tabpanel" aria-labelledby="narahubung-tab">
                            <div class="page-heading">
                                <div class="page-title"></div>
                            </div>
                            <div class="page-body">
                                <section class="section">
                                    <h1>Data Narahubung Faskes</h1>
                                    <table class="table table-striped mb-0">
                                        <tbody>
                                            <?php
                                            if (empty($narahubung)) {
                                            ?>
                                                <div class="alert alert-danger" id="warning">
                                                    <h5 style="color: white; justify-content: center;">Faskes Belum Menambahkan Data Narahubung</h5>
                                                </div>
                                            <?php } else { ?>
                                                <tr>
                                                    <td class="text-bold-500" style="width: 20%;">Nama Narahubung</td>
                                                    <td>:</td>
                                                    <td class="text-bold-500"><?= $narahubung[0]->nama_narahubung; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Jabatan</td>
                                                    <td>:</td>
                                                    <td class="text-bold-500"><?= $narahubung[0]->jabatan; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Nomor Telepon Narahubung</td>
                                                    <td>:</td>
                                                    <td class="text-bold-500"><?= $narahubung[0]->no_telepon_narahubung; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Nomor Telepon Kantor</td>
                                                    <td>:</td>
                                                    <td class="text-bold-500"><?= $narahubung[0]->no_telepon_kantor; ?></td>
                                                </tr>

                                                <tr>
                                                    <td class="text-bold-500">Email Kantor</td>
                                                    <td>:</td>
                                                    <td class="text-bold-500"><?= $narahubung[0]->email_kantor; ?></td>
                                                </tr>
                                        </tbody>
                                    <?php }
                                    ?>
                                    </table>
                                </section>
                            </div>
                        </div>
                        <!-- TAB NARAHUBUNG -->

                        <!-- TAB KESIAPAN -->
                        <div class="tab-pane fade" id="kesiapan" role="tabpanel" aria-labelledby="kesiapan-tab">
                            <div class="page-heading">
                                <div class="page-title"></div>
                            </div>
                            <div class="page-body">
                                <div class="section">
                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Dokumen</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Surat permohonan fasyankes untuk dilakukan survei, ditujukan kepada lembaga penyelenggara akreditasi</td>
                                                <td>
                                                    <?php
                                                    if (!empty($data[0]['url_surat_permohonan_survei'])) {
                                                    ?>
                                                        <a href="<?= $data[0]['url_surat_permohonan_survei']; ?>" target="_blank" class="btn btn-primary rounded-pill">View</a>
                                                    <?php
                                                    }
                                                    ?>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>2</td>
                                                <td>Laporan hasil penilaian mandiri (self assessment)</td>
                                                <td>
                                                    <?php
                                                    if (!empty($data[0]['url_laporan_hasil_penilaian_mandiri'])) {
                                                    ?>
                                                        <a href="<?= $data[0]['url_laporan_hasil_penilaian_mandiri']; ?>" target="_blank" class="btn btn-primary rounded-pill">View</a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>

                                            </tr>

                                            <?php
                                            $no_3 = "";
                                            $no_4 = "3";
                                            if ($data[0]['jenis_akreditasi_id'] == "2") {
                                                $no_3 = "3";
                                                $no_4 = "4";

                                            ?>
                                                <tr>
                                                    <td><?= $no_3 ?></td>
                                                    <td>Hasil perencanaan perbaikan strategis (PPS) untuk fasyankes reakreditasi</td>
                                                    <td>
                                                        <?php
                                                        if (!empty($data[0]['url_pps_reakreditasi'])) {
                                                        ?>
                                                            <a href="<?= $data[0]['url_pps_reakreditasi']; ?>" target="_blank" class="btn btn-primary rounded-pill">View</a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>

                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($data[0]['jenis_fasyankes'] == 2) {
                                            ?>
                                                <tr>
                                                    <td><?= $no_4 ?></td>
                                                    <td>Surat usulan Dinas Kesehatan Kabupaten/Kota setelah dinyatakan siap untuk di survei</td>

                                                    <td>
                                                        <?php
                                                        if (!empty($data[0]['url_surat_usulan_dinas'])) {
                                                        ?>
                                                            <a href="<?= $data[0]['url_surat_usulan_dinas']; ?>" target="_blank" class="btn btn-primary rounded-pill">View</a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>5</td>
                                                    <td>Ijazah Pendidikan S1 Kesehatan Kepala Puskesmas </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($data[0]['url_ijazah_kepala_puskesmas'])) {
                                                        ?>
                                                            <a href="<?= $data[0]['url_ijazah_kepala_puskesmas']; ?>" target="_blank" class="btn btn-primary rounded-pill">View</a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>6</td>
                                                    <td>Sertifikat Pelatihan Manajemen Puskesmas </td>
                                                    <td>
                                                        <?php if (!empty($data[0]['url_sertifikat_pelatihan_puskesmas'])) { ?>
                                                            <a href="<?= $data[0]['url_sertifikat_pelatihan_puskesmas']; ?>" target="_blank" class="btn btn-primary rounded-pill">View</a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>Update Data Fasyankes Online (DFO)</th>
                                                <th>Data ASPAK</th>
                                                <th>Data SISDMK</th>
                                                <th>Data INM</th>
                                                <th>Data IKP</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?php
                                                    if (is_null($data[0]['update_dfo']) == 1) {

                                                    ?>
                                                        <span class="btn btn-warning btn-sm">!</span>
                                                        <?php
                                                    } else {
                                                        if ($data[0]['update_dfo'] == 1) {
                                                        ?>
                                                            <span class="badge bg-danger">Tidak</span>
                                                        <?php
                                                        } else if ($data[0]['update_dfo'] == 2) {
                                                        ?>
                                                            <span class="badge bg-success">Ya</span>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <a target="_blank" href="https://dfo.kemkes.go.id/Viewonly/dfo/<?= $data[0]['fasyankes_id']; ?>/<?= $data[0]['jenis_fasyankes']; ?>">
                                                        <button type="button" class="btn btn-primary btn-sm">
                                                            Cek Data DFO
                                                        </button>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (is_null($data[0]['update_aspak']) == 1) {
                                                    ?>
                                                        <span class="badge bg-warning">!</span>
                                                        <?php
                                                    } else {
                                                        if ($data[0]['update_aspak'] == 1) {
                                                        ?>
                                                            <span class="badge bg-danger">Belum Sesuai</span>
                                                        <?php
                                                        } else if ($data[0]['update_aspak'] == 2) {
                                                        ?>
                                                            <span class="badge bg-success btn-sm">Sesuai Persyaratan</span>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <button type="button" class="btn btn-primary btn-sm" onclick="getDataASPAK()">
                                                        Cek Data ASPAK
                                                    </button>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (is_null($data[0]['update_sisdmk']) == 1) {
                                                    ?>
                                                        <span class="badge bg-warning">!</span>
                                                        <?php
                                                    } else {
                                                        if ($data[0]['update_sisdmk'] == 1) {
                                                        ?>
                                                            <span class="badge bg-danger">Belum Sesuai</span>
                                                        <?php
                                                        } else if ($data[0]['update_sisdmk'] == 2) {
                                                        ?>
                                                            <span class="badge bg-success btn-sm">Sesuai Persyaratan</span>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <button type="button" class="btn btn-primary btn-sm" id="cek_sisdmk">Cek Data SISDMK</button>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (is_null($data[0]['update_inm']) == 1) {

                                                    ?>
                                                        <span class="badge bg-warning">!</span>
                                                        <?php
                                                    } else {
                                                        if ($data[0]['update_inm'] == 1) {
                                                        ?>
                                                            <span class="badge bg-danger">Belum Sesuai</span>
                                                        <?php
                                                        } else if ($data[0]['update_inm'] == 2) {
                                                        ?>
                                                            <span class="badge bg-success btn-sm">Sesuai Persyaratan</span>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <button type="button" class="btn btn-primary btn-sm" onclick="getDataINM()">
                                                        Cek Data INM
                                                    </button>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (is_null($data[0]['update_ikp']) == 1) {

                                                    ?>
                                                        <span class="badge bg-warning">!</span>
                                                        <?php
                                                    } else {
                                                        if ($data[0]['update_ikp'] == 1) {
                                                        ?>
                                                            <span class="badge bg-danger">Belum Sesuai</span>
                                                        <?php
                                                        } else if ($data[0]['update_ikp'] == 2) {
                                                        ?>
                                                            <span class="badge bg-success btn-sm">Sesuai Persyaratan</span>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($data[0]['jenis_fasyankes'] == 3) {
                                                        if ($data[0]['url_sp_ikp_klinik'] != null) {
                                                    ?>
                                                            <a class="btn btn-primary btn-sm rounded-pill" target="_blank" href="<?= $data[0]['url_sp_ikp_klinik'] ?>">Lihat Dokumen</a>
                                                        <?php
                                                        }
                                                        ?>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button type="button" class="btn btn-primary btn-sm" onclick="getDataIKP()">
                                                            Cek Data IKP
                                                        </button>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="form-group col-md-4">
                                        <div class="form-group" style='display:block;'>
                                            <label for="disabledInput">Tanggal Kirim Berkas Fasyankes</label>
                                            <input type="text" name="" id="" value="<?= (!empty($data[0]['tgl_edit_berkas']) ? $data[0]['tgl_edit_berkas'] : '') ?>" class="form-control datepicker" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group" style='display:block;'>
                                            <label for="disabledInput">Tanggal Periksa Berkas</label>
                                            <input type="text" name="" id="" value="<?= (!empty($data[0]['tgl_periksa_berkas']) ? $data[0]['tgl_periksa_berkas'] : '') ?>" class="form-control datepicker" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- TAB KESIAPAN -->

                        <!-- TAB HASIL KESIAPAN SURVEI -->
                        <div class="tab-pane fade" id="hasilkesiapan" role="tabpanel" aria-labelledby="hasilkesiapan-tab">
                            <div class="page-heading"></div>
                            <div class="page-body">
                                <div class="section">

                                    <?php echo form_open_multipart('Pengajuan/simpanKelengkapanBerkas') ?>
                                    <form role="form" method="post" class="login-form" name="form_valdation">
                                        <input type="hidden" class="form-control" id="berkas_usulan_survei_id" name="berkas_usulan_survei_id" value="<?= $data[0]['berkas_usulan_survei_id'] ?>">
                                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $data[0]['id'] ?>">
                                        <input type="hidden" class="form-control" id="kelengkapan_berkas_id" name="kelengkapan_berkas_id" value="<?= $data[0]['kelengkapan_berkas_id'] ?>">
                                        <?php
                                        if (!empty($data[0]['kelengkapan_berkas_usulan'])) {
                                            if ($data[0]['kelengkapan_berkas_usulan'] == 2) {
                                                $kelengkapan_berkas_usulan_y = "checked";
                                                $kelengkapan_berkas_usulan_n = "";
                                                $kelengkapan_berkas_usulan_checked = "none";
                                            } else {
                                                $kelengkapan_berkas_usulan_y = "";
                                                $kelengkapan_berkas_usulan_n = "checked";
                                                $kelengkapan_berkas_usulan_checked = "block";
                                            }
                                        } else {
                                            $kelengkapan_berkas_usulan_y = "";
                                            $kelengkapan_berkas_usulan_n = "";
                                            $kelengkapan_berkas_usulan_checked = "none";
                                        }

                                        if (!empty($data[0]['kelengkapan_dfo'])) {
                                            if ($data[0]['kelengkapan_dfo'] == 2) {
                                                $kelengkapan_dfo_y = "checked";
                                                $kelengkapan_dfo_n = "";
                                                $kelengkapan_dfo_checked = "none";
                                            } else {
                                                $kelengkapan_dfo_y = "";
                                                $kelengkapan_dfo_n = "checked";
                                                $kelengkapan_dfo_checked = "block";
                                            }
                                        } else {
                                            $kelengkapan_dfo_y = "";
                                            $kelengkapan_dfo_n = "";
                                            $kelengkapan_dfo_checked = "none";
                                        }

                                        if (!empty($data[0]['kelengkapan_sarpras_alkes'])) {
                                            if ($data[0]['kelengkapan_sarpras_alkes'] == 2) {
                                                $kelengkapan_sarpras_alkes_y = "checked";
                                                $kelengkapan_sarpras_alkes_n = "";
                                                $kelengkapan_sarpras_alkes_checked = "none";
                                            } else {
                                                $kelengkapan_sarpras_alkes_y = "";
                                                $kelengkapan_sarpras_alkes_n = "checked";
                                                $kelengkapan_sarpras_alkes_checked = "block";
                                            }
                                        } else {
                                            $kelengkapan_sarpras_alkes_y = "";
                                            $kelengkapan_sarpras_alkes_n = "";
                                            $kelengkapan_sarpras_alkes_checked = "none";
                                        }

                                        if (!empty($data[0]['kelengkapan_nakes'])) {
                                            if ($data[0]['kelengkapan_nakes'] == 2) {
                                                $kelengkapan_nakes_y = "checked";
                                                $kelengkapan_nakes_n = "";
                                                $kelengkapan_nakes_checked = "none";
                                            } else {
                                                $kelengkapan_nakes_y = "";
                                                $kelengkapan_nakes_n = "checked";
                                                $kelengkapan_nakes_checked = "block";
                                            }
                                        } else {
                                            $kelengkapan_nakes_y = "";
                                            $kelengkapan_nakes_n = "";
                                            $kelengkapan_nakes_checked = "none";
                                        }

                                        if (!empty($data[0]['kelengkapan_laporan_inm'])) {
                                            if ($data[0]['kelengkapan_laporan_inm'] == 2) {
                                                $kelengkapan_laporan_inm_y = "checked";
                                                $kelengkapan_laporan_inm_n = "";
                                                $kelengkapan_laporan_inm_checked = "none";
                                            } else {
                                                $kelengkapan_laporan_inm_y = "";
                                                $kelengkapan_laporan_inm_n = "checked";
                                                $kelengkapan_laporan_inm_checked = "block";
                                            }
                                        } else {
                                            $kelengkapan_laporan_inm_y = "";
                                            $kelengkapan_laporan_inm_n = "";
                                            $kelengkapan_laporan_inm_checked = "none";
                                        }

                                        if (!empty($data[0]['kelengkapan_laporan_ikp'])) {
                                            if ($data[0]['kelengkapan_laporan_ikp'] == 2) {
                                                $kelengkapan_laporan_ikp_y = "checked";
                                                $kelengkapan_laporan_ikp_n = "";
                                                $kelengkapan_laporan_ikp_checked = "none";
                                            } else {
                                                $kelengkapan_laporan_ikp_y = "";
                                                $kelengkapan_laporan_ikp_n = "checked";
                                                $kelengkapan_laporan_ikp_checked = "block";
                                            }
                                        } else {
                                            $kelengkapan_laporan_ikp_y = "";
                                            $kelengkapan_laporan_ikp_n = "";
                                            $kelengkapan_laporan_ikp_checked = "none";
                                        }
                                        ?>
                                        <table class="table table-striped" id="table1">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Data</th>
                                                    <th>Kelengkapan</th>
                                                    <th>Catatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>1. </td>
                                                    <td>Kelengkapan berkas usulan</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="kelengkapan_berkas_usulan" id="kelengkapan_berkas_usulan1" value="2" required <?= $kelengkapan_berkas_usulan_y; ?>>
                                                            <label class="form-check-label" for="kelengkapan_berkas_usulan1">
                                                                Sesuai Persyaratan
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="kelengkapan_berkas_usulan" id="kelengkapan_berkas_usulan2" value="1" <?= $kelengkapan_berkas_usulan_n; ?>>
                                                            <label class="form-check-label" for="kelengkapan_berkas_usulan2">
                                                                Belum Sesuai
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <textarea style="display:<?= $kelengkapan_berkas_usulan_checked; ?>;" class="form-control" rows="5" cols="30" id="kelengkapan_berkas_usulan_catatan" name="kelengkapan_berkas_usulan_catatan" value="<?= $data[0]['kelengkapan_berkas_usulan_catatan']; ?>"><?= $data[0]['kelengkapan_berkas_usulan_catatan']; ?></textarea>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>2.</td>
                                                    <td>Data DFO</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="kelengkapan_dfo" id="kelengkapan_dfo1" value="2" required <?= $kelengkapan_dfo_y; ?>>
                                                            <label class="form-check-label" for="kelengkapan_dfo1">
                                                                Sesuai Persyaratan
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="kelengkapan_dfo" id="kelengkapan_dfo2" value="1" <?= $kelengkapan_dfo_n; ?>>

                                                            <label class="form-check-label" for="kelengkapan_dfo2">
                                                                Belum Sesuai
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td><textarea style="display:<?= $kelengkapan_dfo_checked; ?>;" class="form-control" rows="3" cols="30" id="kelengkapan_dfo_catatan" name="kelengkapan_dfo_catatan" value="<?= $data[0]['kelengkapan_dfo_catatan']; ?>"><?= $data[0]['kelengkapan_dfo_catatan']; ?></textarea></td>
                                                </tr>

                                                <tr>
                                                    <td>3.</td>
                                                    <td>Data ASPAK</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="kelengkapan_sarpras_alkes" id="kelengkapan_sarpras_alkes1" value="2" required <?= $kelengkapan_sarpras_alkes_y; ?>>
                                                            <label class="form-check-label" for="kelengkapan_sarpras_alkes1">
                                                                Sesuai Persyaratan
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="kelengkapan_sarpras_alkes" id="kelengkapan_sarpras_alkes2" value="1" <?= $kelengkapan_sarpras_alkes_n; ?>>
                                                            <label class="form-check-label" for="kelengkapan_sarpras_alkes2">
                                                                Belum Sesuai
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td><textarea style="display:<?= $kelengkapan_sarpras_alkes_checked; ?>;" class="form-control" rows="3" cols="30" id="kelengkapan_sarpras_alkes_catatan" name="kelengkapan_sarpras_alkes_catatan" value="<?= $data[0]['kelengkapan_sarpras_alkes_catatan']; ?>"><?= $data[0]['kelengkapan_sarpras_alkes_catatan']; ?></textarea></td>
                                                </tr>

                                                <tr>
                                                    <td>4.</td>
                                                    <td>Data SDM</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="kelengkapan_nakes" id="kelengkapan_nakes1" value="2" required <?= $kelengkapan_nakes_y; ?>>
                                                            <label class="form-check-label" for="kelengkapan_nakes1">
                                                                Sesuai Persyaratan
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="kelengkapan_nakes" id="kelengkapan_nakes2" value="1" <?= $kelengkapan_nakes_n; ?>>
                                                            <label class="form-check-label" for="kelengkapan_nakes2">
                                                                Belum Sesuai
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <textarea style="display:<?= $kelengkapan_nakes_checked; ?>;" class="form-control" rows="3" cols="30" id="kelengkapan_nakes_catatan" name="kelengkapan_nakes_catatan" value="<?= $data[0]['kelengkapan_nakes_catatan']; ?>"><?= $data[0]['kelengkapan_nakes_catatan']; ?></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>5.</td>
                                                    <td>Data Laporan INM</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="kelengkapan_laporan_inm" id="kelengkapan_laporan_inm1" value="2" required <?= $kelengkapan_laporan_inm_y; ?>>
                                                            <label class="form-check-label" for="kelengkapan_laporan_inm1">
                                                                Sesuai Persyaratan
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="kelengkapan_laporan_inm" id="kelengkapan_laporan_inm2" value="1" <?= $kelengkapan_laporan_inm_n; ?>>
                                                            <label class="form-check-label" for="kelengkapan_laporan_inm2">
                                                                Belum Sesuai
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <textarea style="display:<?= $kelengkapan_laporan_inm_checked; ?>;" class="form-control" rows="3" cols="30" id="kelengkapan_laporan_inm_catatan" name="kelengkapan_laporan_inm_catatan" value="<?= $data[0]['kelengkapan_laporan_inm_catatan']; ?>"><?= $data[0]['kelengkapan_laporan_inm_catatan']; ?></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6.</td>
                                                    <td>Data Laporan IKP</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="kelengkapan_laporan_ikp" id="kelengkapan_laporan_ikp1" value="2" required <?= $kelengkapan_laporan_ikp_y; ?>>
                                                            <label class="form-check-label" for="kelengkapan_laporan_ikp1">
                                                                Sesuai Persyaratan
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="kelengkapan_laporan_ikp" id="kelengkapan_laporan_ikp2" value="1" <?= $kelengkapan_laporan_ikp_n; ?>>
                                                            <label class="form-check-label" for="kelengkapan_laporan_ikp2">
                                                                Belum Sesuai
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <textarea style="display:<?= $kelengkapan_laporan_ikp_checked; ?>;" class="form-control" rows="3" cols="30" id="kelengkapan_laporan_ikp_catatan" name="kelengkapan_laporan_ikp_catatan" value="<?= $data[0]['kelengkapan_laporan_ikp_catatan']; ?>"><?= $data[0]['kelengkapan_laporan_ikp_catatan']; ?></textarea>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-primary btn-block rounded-pill">Submit</button>

                                    </form>

                                    <div class="form-group col-md-4 mt-4">
                                        <div class="form-group" style='display:block;'>
                                            <label for="disabledInput">Tanggal Kirim Berkas Fasyankes</label>

                                            <input type="text" name="" id="" value="<?= (!empty($data[0]['tgl_edit_berkas']) ? $data[0]['tgl_edit_berkas'] : '') ?>" class="form-control datepicker" autocomplete="off" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group" style='display:block;'>
                                            <label for="disabledInput">Tanggal Periksa Berkas</label>

                                            <input type="text" name="" id="" value="<?= (!empty($data[0]['tgl_periksa_berkas']) ? $data[0]['tgl_periksa_berkas'] : '') ?>" class="form-control datepicker" autocomplete="off" disabled>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- TAB HASIL KESIAPAN SURVEI -->

                        <!-- TAB KESEPAKATAN -->
                        <div class="tab-pane fade" id="kesepakatan" role="tabpanel" aria-labelledby="kesepakatan-tab">
                            <div class="page-heading">
                            </div>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                <div class="container mb-4">
                                    <div class="page-body">
                                        <h5>Upload Dokumen</h5>
                                        <?php
                                        if (isset($surveior[0]['user_surveior_id']) && $surveior[0]['user_surveior_id'] != NULL) {
                                            $surveior_id_satu = $surveior[0]['user_surveior_id'];
                                        } else {
                                            $surveior_id_satu = '';
                                        };
                                        if (isset($surveior[1]['user_surveior_id']) && $surveior[1]['user_surveior_id'] != NULL) {
                                            $surveior_id_dua = $surveior[1]['user_surveior_id'];
                                        } else {
                                            $surveior_id_dua = '';
                                        };
                                        ?>
                                        <?php
                                        if ($surveior_id_satu == NULL || $surveior_id_dua == NULL) {
                                        ?>
                                            <h5 style="color:red;">Sehubungan adanya kendala pada pengajuan, silahkan menghubungi faskes untuk melakukan pengajuan ulang <a href="https://sinaf.kemkes.go.id/Pengajuan/detail/<?= $id ?>" class="btn btn-primary"> Persetujuan Usulan Survei</a></h5>
                                        <?php
                                            // IF JIKA TIDAK ADA SURVEIOR
                                        } else {

                                            if (isset($surveior_lapangan[0]['id_surveior_satu_baru'])) {
                                                $idsuveiorpengganti1 = $surveior_lapangan[0]['id_surveior_satu_baru'];
                                                // $keterangnapengganti1 = $surveior_lapangan[0]['keterangan_surveior_satu'];
                                                if ($surveior_lapangan[0]['keterangan_surveior_satu_id'] == NULL) {
                                                    $keterangnapengganti1 = '5';
                                                } else if ($surveior_lapangan[0]['keterangan_surveior_satu_id'] != NULL) {
                                                    $keterangnapengganti1 = $surveior_lapangan[0]['keterangan_surveior_satu_id'];
                                                }
                                                $namasuveiorpengganti1 = $surveior_lapangan['datasurveiorpengganti1'][0]['nama'];
                                                $provinsisurveiorpengganti1 = $surveior_lapangan['datasurveiorpengganti1'][0]['propinsi_name'];
                                            }

                                            if (isset($surveior_lapangan[0]['id_surveior_dua_baru'])) {
                                                $idsuveiorpengganti2 = $surveior_lapangan[0]['id_surveior_dua_baru'];
                                                // $keterangnapengganti2 = $surveior_lapangan[0]['keterangan_surveior_dua'];
                                                if ($surveior_lapangan[0]['keterangan_surveior_dua_id'] == NULL) {
                                                    $keterangnapengganti2 = '5';
                                                } else if ($surveior_lapangan[0]['keterangan_surveior_dua_id'] != NULL) {
                                                    $keterangnapengganti2 = $surveior_lapangan[0]['keterangan_surveior_dua_id'];
                                                }
                                                // $keterangnapengganti2 = $surveior_lapangan[0]['keterangan_surveior_dua_id'];
                                                $namasuveiorpengganti2 = $surveior_lapangan['datasurveiorpengganti2'][0]['nama'];
                                                $provinsisurveiorpengganti2 = $surveior_lapangan['datasurveiorpengganti2'][0]['propinsi_name'];
                                            }
                                        ?>
                                            <?php echo form_open_multipart('Pengajuan/simpanBerkasKesepakatan') ?>
                                            <form role="form" method="post" class="login-form" name="form_valdation">
                                                <div class="form-group">
                                                    <label for="">Dokumen Kontrak </label><small class="text-muted"><a href="<?php echo base_url('assets/uploads/template/Dokumen_kontrak.docx'); ?>" target="_blank" href=""> Download Contoh</a> </i></small>
                                                    <?php
                                                    if (!empty($data[0]['url_dokumen_kontrak'])) {
                                                        $url_dokumen_kontrak_required = '';
                                                    } else {
                                                        $url_dokumen_kontrak_required = 'required';
                                                    }
                                                    ?>
                                                    <fieldset>
                                                        <div class="input-group">
                                                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $data[0]['id'] ?>">
                                                            <input type="hidden" class="form-control" id="kelengkapan_berkas_id" name="kelengkapan_berkas_id" value="<?= $data[0]['kelengkapan_berkas_id'] ?>">
                                                            <input type="hidden" class="form-control" id="penetapan_tanggal_survei_id" name="penetapan_tanggal_survei_id" value="<?= $data[0]['penetapan_tanggal_survei_id'] ?>">
                                                            <input type="file" class="form-control" id="url_dokumen_kontrak" name="url_dokumen_kontrak" aria-describedby="inputGroupFileAddon04" aria-label="Upload" <?= $url_dokumen_kontrak_required; ?>>

                                                            <?php if (!empty($data[0]['url_dokumen_kontrak'])) {
                                                                $url_dokumen_kontrak = $data[0]['url_dokumen_kontrak'];
                                                            ?>
                                                                <a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo $url_dokumen_kontrak; ?>">Lihat Dokumen</a>
                                                            <?php } else {
                                                                $url_dokumen_kontrak = "";
                                                            }
                                                            ?>
                                                            <input type="hidden" name="old_url_dokumen_kontrak" value="<?= $url_dokumen_kontrak ?>" id="old_url_dokumen_kontrak">
                                                        </div>
                                                    </fieldset>
                                                </div>

                                                <div class="form-group">
                                                    <?php
                                                    if (is_null($data[0]['kelengkapan_berkas_id_2'])) {
                                                        $tanggal_survei = '';
                                                    } else {
                                                        $tanggal_survei = $data[0]['tanggal_survei'];
                                                        $tanggal_survei = date("m/d/Y", strtotime($tanggal_survei));
                                                    }
                                                    ?>
                                                    <div class="form-group">
                                                        <label for="helperText">Metode Survei</label>
                                                        <?= form_dropdown('metode_survei_id', dropdown_sina_metode_survei($data[0]['jenis_fasyankes']), $data[0]['metode_survei_id'], 'id="metode_survei_id"  class="form-select" disabled'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Link Dokumen Pendukung Elemen Penilaian (EP)</label>
                                                    <fieldset>
                                                        <textarea class="form-control" id="url_dokumen_pendukung_ep" name="url_dokumen_pendukung_ep" required><?= $data[0]['url_dokumen_pendukung_ep']; ?></textarea>
                                                        <?php if (!empty($data[0]['url_dokumen_pendukung_ep'])) {
                                                            $url_dokumen_pendukung_ep = $data[0]['url_dokumen_pendukung_ep'];
                                                        ?>
                                                            <a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo prep_url($url_dokumen_pendukung_ep); ?>">View URL</a>
                                                        <?php } else {
                                                            $url_dokumen_pendukung_ep = "";
                                                        }
                                                        ?>

                                                        <input type="hidden" name="old_url_url_dokumen_pendukung_ep" value="<?= $url_dokumen_pendukung_ep ?>" id="old_url_url_dokumen_pendukung_ep">
                                                    </fieldset>
                                                </div>

                                                <div class="form-group">
                                                    <label for="helperText">Tanggal Survei</label>
                                                    <div class="row">
                                                        <?php
                                                        $x = 1;
                                                        foreach ($detail_pengajuan as $datab) {
                                                        ?>
                                                            <div class="col-md-4">
                                                                <input type="date" name="tanggal_<?php echo $x ?>" id="tanggal_<?php echo $x ?>" class="form-control" value="<?= $datab['tanggal_survei'] ?>" readonly>
                                                            </div>
                                                        <?php
                                                            $x++;
                                                        }
                                                        ?>
                                                    </div>

                                                </div>

                                                <button type="submit" class="btn btn-primary btn-block rounded-pill">Submit</button>

                                            </form>
                                        <?php
                                            // IF JIKA TIDAK ADA SURVEIOR
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>


                            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                                <div class="container mt-5">
                                    <div class="page-body">
                                        <h5>Data Surveior</h5>
                                        <?php
                                        // JIKA DATA SURVEIOR LAPANGAN KOSONG
                                        if (empty($surveior_lapangan)) {
                                            // JENIS SURVEI
                                            if ($data[0]['jenis_survei_id'] == 1) {
                                                if (isset($surveior[0]['users_id']) && $surveior[0]['users_id'] != NULL) {
                                                    $surveior_satu = $surveior[0]['users_id'];
                                                } else {
                                                    $surveior_satu = '';
                                                };
                                                if (isset($surveior[1]['users_id']) && $surveior[1]['users_id'] != NULL) {
                                                    $surveior_dua = $surveior[1]['users_id'];
                                                } else {
                                                    $surveior_dua = '';
                                                };
                                                if (isset($surveior[0]['user_surveior_id']) && $surveior[0]['user_surveior_id'] != NULL) {
                                                    $surveior_id_satu = $surveior[0]['user_surveior_id'];
                                                } else {
                                                    $surveior_id_satu = '';
                                                };
                                                if (isset($surveior[1]['user_surveior_id']) && $surveior[1]['user_surveior_id'] != NULL) {
                                                    $surveior_id_dua = $surveior[1]['user_surveior_id'];
                                                } else {
                                                    $surveior_id_dua = '';
                                                };
                                                // ELSE JENIS SURVEI
                                            } else if ($data[0]['jenis_survei_id'] == 2) {
                                                $surveior_satu = $data_lama[0]['surveior_satu'];
                                                $surveior_dua = $data_lama[0]['surveior_dua'];
                                            }
                                            // JENIS SURVEI

                                            // CATCH JIKA DATA SURVEIOR KOSONG
                                            if ($surveior_satu == NULL || $surveior_dua == NULL) {
                                        ?>
                                                <h5 style="color:red;">Sehubungan adanya kendala pengajuan, silahkan fasyankes melakukan pengajuan ulang<a href="https://sinaf.kemkes.go.id/Pengajuan/detail/<?= $id ?>"> Persetujuan Usulan Survei</a></h5>
                                            <?php
                                            } else {
                                            ?>
                                                <?php echo form_open_multipart('Pengajuan/simpanSurveiorLapangan') ?>
                                                <form role="form" method="post" class="login-form" name="form_valdation">
                                                    <input type="text" name="surveior_satu" value="<?= $surveior_satu ?>" id="surveior_satu" hidden>
                                                    <input type="text" name="status_surveior_satu" value="1" id="status_surveior_satu" hidden>
                                                    <input type="text" name="id_surveior_satu" id="id_surveior_satu" value="<?php echo $surveior_id_satu ?>" hidden>
                                                    <input type="text" name="surveior_dua" value="<?= $surveior_dua ?>" id="surveior_dua" hidden>
                                                    <input type="text" name="status_surveior_dua" value="2" id="status_surveior_dua" hidden>
                                                    <input type="text" name="id_surveior_dua" id="id_surveior_dua" value="<?php if (isset($surveior_id_dua)) {
                                                                                                                                echo $surveior_id_dua;
                                                                                                                            }; ?>" hidden>
                                                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $data[0]['id'] ?>">
                                                    <div class="form-group">
                                                        <label for="helperText">Tanggal Survei</label>
                                                        <div class="row">
                                                            <?php
                                                            $x = 1;
                                                            foreach ($detail_pengajuan as $datab) {
                                                            ?>
                                                                <div class="col-md-4">
                                                                    <input type="date" name="tanggal_<?php echo $x ?>" id="tanggal_<?php echo $x ?>" class="form-control" value="<?= $datab['tanggal_survei'] ?>" readonly>
                                                                </div>
                                                            <?php
                                                                $x++;
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label for="helperText">Nama Surveior 1</label>
                                                                <input class="form-check-input" onclick="//check(this.value)" type="radio" value="jabatansurveior1" name="jabatan" id="jabatansurveior1" checked>
                                                                <label class="form-check-label" id="labeljabatan1" for="jabatansurveior1">
                                                                    Ketua
                                                                </label>
                                                                <?= form_dropdown('surveior_satu1', dropdown_sina_surveior_new($surveior_id_satu), $surveior_id_satu, 'id="surveior_satu1"  class="form-select" disabled'); ?>

                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="checkbox" name="approvements1" id="approvements1" onclick="findsurveriorpengganti1(<?php echo $surveior_id_satu ?>)">
                                                                <label for="approvements1">Tidak Bersedia</label>
                                                            </div>
                                                            <div class="col-md-4 hideform" id="formpengganti1">
                                                                <label for="penggantis1">Nama Surveior Pengganti</label>
                                                                <select name="penggantis1" id="penggantis1" class="form-select">
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 hideform" id="formpenggantitext1">
                                                                <label for="keterangansatu">Keterangan</label>
                                                                <select name="keterangan1" id="keterangan1" class="form-select"></select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label for="helperText">Nama Surveior 2</label>
                                                                <input class="form-check-input" onclick="//check(this.value)" type="radio" value="jabatansurveior2" name="jabatan" id="jabatansurveior2">
                                                                <label class="form-check-label" id="labeljabatan2" for="jabatansurveior2">
                                                                    Ketua
                                                                </label>
                                                                <?= form_dropdown('surveior_dua2', dropdown_sina_surveior_new($surveior_id_dua), $surveior_id_dua, 'id="surveior_dua2"  class="form-select" disabled'); ?>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="checkbox" name="approvements2" id="approvements2" onclick="findsurveriorpengganti2(<?php echo $surveior_id_dua ?>)">
                                                                <label for="approvements2">Tidak Bersedia</label>
                                                            </div>
                                                            <div class="col-md-4 hideform" id="formpengganti2">
                                                                <label for="penggantis2">Nama Surveior Pengganti</label>
                                                                <select name="penggantis2" id="penggantis2" class="form-select">
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 hideform" id="formpenggantitext2">
                                                                <label for="keterangandua">Keterangan</label>
                                                                <select name="keterangan2" id="keterangan2" class="form-select"></select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="no_surat_tugas">No Surat Tugas</label>
                                                        <div class="input-group">
                                                            <?php
                                                            if (isset($data_surveior_lapangan[0]['no_surattugas']) && $data_surveior_lapangan[0]['no_surattugas'] != NULL) {
                                                            ?>
                                                                <input type="text" class="form-control" id="no_surat_tugas" name="no_surat_tugas" value="<?= $data_surveior_lapangan[0]['no_surattugas'] ?>" readonly disabled placeholder="Input No Surat Tugas">
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <input type="text" class="form-control" id="no_surat_tugas" name="no_surat_tugas" placeholder="Input No Surat Tugas" required>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <?php
                                                    if ($data[0]['penetapan_tanggal_survei_id'] != NULL) {
                                                    ?>
                                                        <input type="text" id="PTSID" name="PTSID" value="<?= $data[0]['penetapan_tanggal_survei_id'] ?>" hidden readonly>
                                                        <button type="submit" class="btn btn-primary btn-block rounded-pill">Submit</button>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <button type="submit" class="btn btn-primary btn-block rounded-pill" disabled onclick="alertPTSkosong()">Submit</button>
                                                    <?php
                                                    }
                                                    ?>
                                                </form>
                                            <?php
                                            }
                                            // CATCH JIKA DATA SURVEIOR KOSONG
                                            // ELSE DATA SURVEIOR LAPANGAN JIKA TERISI
                                        } elseif ($data_surveior_lapangan[0]['status_tte'] == 1) {
                                            ?>
                                            <?php echo form_open_multipart('Pengajuan/updateSurveiorLapangan') ?>
                                            <form role="form" method="post" class="login-form" name="form_valdation">

                                                <div class="form-group">
                                                    <label for="helperText">Tanggal Survei</label>
                                                    <div class="row">
                                                        <?php
                                                        $x = 1;
                                                        foreach ($detail_pengajuan as $datab) {
                                                        ?>
                                                            <div class="col-md-4">
                                                                <input type="date" name="tanggal_<?php echo $x ?>" id="tanggal_<?php echo $x ?>" class="form-control" value="<?= $datab['tanggal_survei'] ?>" readonly>
                                                            </div>
                                                        <?php
                                                            $x++;
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                                <?php
                                                if ($surveior_lapangan[0]['jabatan_surveior_id_satu'] == '1') {
                                                    $ischeck = 'checked';
                                                    $status1 = 'KETUA';
                                                } else {
                                                    $ischeck = '';
                                                    $status1 = 'ANGGOTA';
                                                }
                                                if ($surveior_lapangan[0]['jabatan_surveior_id_dua'] == '1') {
                                                    $ischeck2 = 'checked';
                                                    $status2 = 'KETUA';
                                                } else {
                                                    $ischeck2 = '';
                                                    $status2 = 'ANGGOTA';
                                                }

                                                if (isset($surveior_lapangan[0]['id_surveior_satu_baru'])) {
                                                    $idsuveiorpengganti1 = $surveior_lapangan[0]['id_surveior_satu_baru'];
                                                    if ($surveior_lapangan[0]['keterangan_surveior_satu_id'] == NULL) {
                                                        $keterangnapengganti1 = '5';
                                                    } else if ($surveior_lapangan[0]['keterangan_surveior_satu_id'] != NULL) {
                                                        $keterangnapengganti1 = $surveior_lapangan[0]['keterangan_surveior_satu_id'];
                                                    }
                                                    $namasuveiorpengganti1 = $surveior_lapangan['datasurveiorpengganti1'][0]['nama'];
                                                    $provinsisurveiorpengganti1 = $surveior_lapangan['datasurveiorpengganti1'][0]['propinsi_name'];
                                                }

                                                if (isset($surveior_lapangan[0]['id_surveior_dua_baru'])) {
                                                    $idsuveiorpengganti2 = $surveior_lapangan[0]['id_surveior_dua_baru'];
                                                    if ($surveior_lapangan[0]['keterangan_surveior_dua_id'] == NULL) {
                                                        $keterangnapengganti2 = '5';
                                                    } else if ($surveior_lapangan[0]['keterangan_surveior_dua_id'] != NULL) {
                                                        $keterangnapengganti2 = $surveior_lapangan[0]['keterangan_surveior_dua_id'];
                                                    }
                                                    $namasuveiorpengganti2 = $surveior_lapangan['datasurveiorpengganti2'][0]['nama'];
                                                    $provinsisurveiorpengganti2 = $surveior_lapangan['datasurveiorpengganti2'][0]['propinsi_name'];
                                                }
                                                ?>

                                                <input type="text" name="id_surveior_satu" id="id_surveior_satu" value="<?php echo $data_surveior_lapangan[0]['surveior_satu_id'] ?>" hidden>
                                                <input type="text" name="id_surveior_dua" id="id_surveior_dua" value="<?php echo $data_surveior_lapangan[0]['surveior_dua_id'] ?>" hidden>
                                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $data[0]['id'] ?>">

                                                <div class="form-group col-md-12">
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            <label for="helperText">Nama Surveior 1</label>
                                                            <input class="form-check-input" type="radio" value="jabatansurveior1" name="jabatan" id="jabatansurveior1" onchange="gantitulisan(this.value)" readonly <?= $ischeck ?>>
                                                            <label class="form-check-label" id="labeljabatan1" for="jabatansurveior1">
                                                                <?= $status1 ?>
                                                            </label>
                                                            <?= form_dropdown('surveior_satu1', dropdown_sina_surveior_new($data_surveior_lapangan[0]['surveior_satu_id']), $data_surveior_lapangan[0]['surveior_satu_id'], 'id="surveior_satu1"  class="form-select" disabled'); ?>
                                                        </div>

                                                        <?php
                                                        // IF JIKA ADA PENGGANTI
                                                        if ($data_surveior_lapangan[0]['surveior_satu_id'] != $data_surveior_lapangan[0]['surveior_satu_baru_id']) {
                                                        ?>
                                                            <div class="col-md-2">
                                                                <input type="checkbox" checked name="approvements1" id="approvements1" disabled>
                                                                <label for="approvements1">Tidak Bersedia</label>
                                                            </div>
                                                            <div class="col-md-4" id="formpengganti1">
                                                                <label for="penggantis1">Nama Surveior Pengganti</label>
                                                                <select class="form-select" disabled>
                                                                    <option><?php echo $namasuveiorpengganti1 . ' - ' . $provinsisurveiorpengganti1 ?></option>
                                                                </select>
                                                                <input type="text" id="surveior_satu_baru_id" name="surveior_satu_baru_id" hidden value="<?= $data_surveior_lapangan[0]['surveior_satu_baru_id'] ?>">
                                                            </div>
                                                            <div class="col-md-3" id="formpenggantitext1">
                                                                <label for="keterangansatu">Keterangan</label>
                                                                <?= form_dropdown('keterangan1', dropdown_sina_keterangan_pengganti($keterangnapengganti1), $keterangnapengganti1, 'id="keterangan1"  class="form-select" disabled'); ?>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="col-md-2">
                                                                <input type="checkbox" name="approvements1" id="approvements1" onclick="findsurveriorpengganti1(<?php echo $data_surveior_lapangan[0]['surveior_satu_id'] ?>)">
                                                                <label for="approvements1">Tidak Bersedia</label>
                                                            </div>
                                                            <div class="col-md-4 hideform" id="formpengganti1">
                                                                <label for="penggantis1">Nama Surveior Pengganti</label>
                                                                <select name="penggantis1" id="penggantis1" class="form-select">
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 hideform" id="formpenggantitext1">
                                                                <label for="keterangansatu">Keterangan</label>
                                                                <select name="keterangan1" id="keterangan1" class="form-select"></select>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                </div>


                                                <div class="form-group col-md-12">
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            <label for="helperText">Nama Surveior 2</label>
                                                            <input class="form-check-input" type="radio" value="jabatansurveior2" name="jabatan" id="jabatansurveior2" onchange="gantitulisan(this.value)" readonly <?= $ischeck2 ?>>
                                                            <label class="form-check-label" id="labeljabatan2" for="jabatansurveior2">
                                                                <?= $status2 ?>
                                                            </label>
                                                            <?= form_dropdown('surveior_dua1', dropdown_sina_surveior_new($data_surveior_lapangan[0]['surveior_dua_id']), $data_surveior_lapangan[0]['surveior_dua_id'], 'id="surveior_dua2"  class="form-select" disabled'); ?>
                                                        </div>

                                                        <?php
                                                        // IF JIKA ADA PENGGANTI
                                                        if ($data_surveior_lapangan[0]['surveior_dua_id'] != $data_surveior_lapangan[0]['surveior_dua_baru_id']) {
                                                        ?>
                                                            <div class="col-md-2">
                                                                <input type="checkbox" name="approvements2" id="approvements2" checked disabled>
                                                                <label for="approvements2">Tidak Bersedia</label>
                                                            </div>
                                                            <div class="col-md-4" id="formpengganti2">
                                                                <label for="penggantis2">Nama Surveior Pengganti</label>
                                                                <select class="form-select" disabled>
                                                                    <option><?php echo $namasuveiorpengganti2 . ' - ' . $provinsisurveiorpengganti2 ?></option>
                                                                </select>

                                                                <input type="text" id="surveior_dua_baru_id" name="surveior_dua_baru_id" hidden value="<?= $data_surveior_lapangan[0]['surveior_dua_baru_id'] ?>">
                                                            </div>
                                                            <div class="col-md-3" id="formpenggantitext2">
                                                                <label for="keterangandua">Keterangan</label>
                                                                <?= form_dropdown('keterangan2', dropdown_sina_keterangan_pengganti($keterangnapengganti2), $keterangnapengganti2, 'id="keterangan2"  class="form-select" disabled'); ?>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="col-md-2">
                                                                <input type="checkbox" name="approvements2" id="approvements2" onclick="findsurveriorpengganti2(<?php echo $data_surveior_lapangan[0]['surveior_dua_id']     ?>)">
                                                                <label for="approvements2">Tidak Bersedia</label>
                                                            </div>
                                                            <div class="col-md-4 hideform" id="formpengganti2">
                                                                <label for="penggantis2">Nama Surveior Pengganti</label>
                                                                <select name="penggantis2" id="penggantis2" class="form-select">
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 hideform" id="formpenggantitext2">
                                                                <label for="keterangandua">Keterangan</label>
                                                                <select name="keterangan2" id="keterangan2" class="form-select"></select>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <div class="form-group col-md-6">
                                                        <label for="helperText">
                                                            <h5>Surat Tugas</h5>
                                                        </label>
                                                        <div class="input-group">

                                                            <?php
                                                            $url_surat_tugas = "";
                                                            if (!empty($data[0]['url_surat_tugas']) && empty($surtug)) {
                                                                $url_surat_tugas = $data[0]['url_surat_tugas'];
                                                            ?>
                                                                <a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo $url_surat_tugas; ?>">Lihat Dokumen</a>
                                                            <?php
                                                            } elseif (empty($data[0]['url_surat_tugas']) && empty($surtug) && $surveior_lapangan[0]['no_surattugas'] != NULL) {
                                                            ?>
                                                                <h5>Proses TTE Surtug</h5>
                                                            <?php
                                                            } elseif (!empty($surtug)) {
                                                            ?>
                                                                <a class="btn btn-primary rounded-pill" target="_blank" href="https://sinar.kemkes.go.id/assets/surtug/tte<?php echo $data[0]['id']; ?>.pdf">Lihat Dokumen</a>
                                                            <?php
                                                            }
                                                            ?>

                                                            <input type="hidden" name="old_url_surat_tugas" value="<?= $url_surat_tugas ?>" id="old_url_surat_tugas">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="no_surat_tugas">No Surat Tugas</label>
                                                    <div class="input-group">
                                                        <?php
                                                        if (isset($data_surveior_lapangan[0]['no_surattugas']) && $data_surveior_lapangan[0]['no_surattugas'] != NULL) {
                                                        ?>
                                                            <input type="text" class="form-control" id="no_surat_tugas" name="no_surat_tugas" value="<?= $data_surveior_lapangan[0]['no_surattugas'] ?>" required placeholder="Input No Surat Tugas">
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <input type="text" class="form-control" id="no_surat_tugas" name="no_surat_tugas" placeholder="Input No Surat Tugas" required>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                                <?php
                                                print_r($data_surveior_lapangan);
                                                ?>
                                                <input type="text" id="SLID" name="SLID" value="<?= $data_surveior_lapangan[0]['surveior_lapangan_id'] ?>" hidden readonly>
                                                <input type="text" id="PTSID" name="PTSID" value="<?= $data[0]['penetapan_tanggal_survei_id'] ?>" hidden readonly>

                                                <?php
                                                if ($data_surveior_lapangan[0]['status_tte'] != 1) {
                                                ?>
                                                    <button type="submit" class="btn btn-primary btn-block rounded-pill">Submit</button>
                                                <?php
                                                }
                                                ?>
                                                <button type="submit" class="btn btn-primary btn-block rounded-pill">Submit</button>

                                            </form>
                                        <?php
                                        } else {
                                        ?>
                                            <h5>VIEW ONLY</h5>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- TAB KESEPAKATAN -->

                        <!-- TAB LAPORAN -->
                        <div class="tab-pane fade show" id="laporan" role="tabpanel" aria-labelledby="laporan-tab">
                            <div class="page-heading">
                            </div>
                            <div class="page-body">
                                <div class="section">
                                    <div class="row">
                                        <?php
                                        $x = 1;
                                        foreach ($detail_pengajuan as $key => $datab) {
                                            $jumlah = $key + 1;
                                            if ($jumlah == 1) {
                                                $namajumlah = 'Pertama';

                                                $url_bukti = $data[0]['url_bukti_satu'];
                                            } else if ($jumlah == 2) {
                                                $namajumlah = 'Kedua';
                                                $url_bukti = $data[0]['url_bukti_dua'];
                                            } else if ($jumlah == 3) {
                                                $namajumlah = 'Ketiga';
                                                $url_bukti = $data[0]['url_bukti_tiga'];
                                            }
                                        ?>
                                            <div class="form-group col-md-4">
                                                <div class="form-group" style='display:block;'>
                                                    <label for="disabledInput">Tanggal Survei Hari <?= $namajumlah ?></label>
                                                    <input type="date" value="<?= $datab['tanggal_survei'] ?>" class="form-control datepicker" autocomplete="off" readonly>
                                                </div>
                                                <div class="form-group" style='display:block;'>
                                                    <label for="disabledInput">Foto Bukti Survei Hari <?= $namajumlah ?></label>
                                                    <i><small class="text-muted"> Maks 2MB </i></small>
                                                    <fieldset>
                                                        <div class="input-group">
                                                            <a class="btn btn-success rounded-pill" target="_blank" href="<?php echo $url_bukti; ?>">Lihat Dokumen</a>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        <?php
                                            $x++;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- TAB LAPORAN -->

                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Modal IKP-->
    <div class="modal fade" id="ikpModal" tabindex="-1" aria-labelledby="ikpModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ikpModalLabel">Data IKP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="content">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Kepatuhan Pelaporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3">sedang mengambil data...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal SDMK-->
    <div class="modal fade" id="modal_sisdmk" tabindex="-1" role="dialog" aria-labelledby="modal_sisdmk_label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h6 class="modal-title mx-auto" id="modal_sisdmk_label">Data SISDMK</h6>
                </div>
                <div class="modal-body">
                    <div id="loading" style="display: none;">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-grow spinner-grow-xl text-primary mr-3" role="status"></div>
                            <div class="spinner-grow spinner-grow-xl text-primary mr-3" role="status"></div>
                            <div class="spinner-grow spinner-grow-xl text-primary" role="status"></div>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered" width="100%" id="table_sisdmk" style="display: none;">
                        <tbody id="tbody_sisdmk"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-close-sisdmk" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal INM-->
    <div class="modal fade" id="inmModal" tabindex="-1" aria-labelledby="inmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inmModalLabel">Data INM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="content">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Kepatuhan Pelaporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3">sedang mengambil data...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal ASPAK-->
    <div class="modal fade" id="aspakModal" tabindex="-1" aria-labelledby="aspakModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aspakModalLabel">Data ASPAK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="content">
                    <table class="table table-responsive">
                        <tbody>
                            <tr>
                                <td colspan="2">sedang mengambil data...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL CONFIRMATION KESEPAKATAN SURVEI -->
    <div class="modal fade" id="confirmationbox" tabindex="-1" aria-labelledby="ModalconfirmationLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="ModalconfirmationLabel">Apakah Anda Yakin ?</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="content">
                    <p>
                        Kesepakatan yang telah di submit tidak dapat diubah kembali !!!.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnconfirmation">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url() ?>assets/js/app.js"></script>
</body>

</html>

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script>
    $('#status_usulan_id').on('change', function(e) {
        if ($(this).val() == 2) {
            document.getElementById("keterangan").style.display = "block";
            $("#keterangan").attr('required', ''); //turns required on
        } else if ($(this).val() == 3) {
            $("#keterangan").val("")
            document.getElementById("keterangan").style.display = "none";
            $("#keterangan").removeAttr('required'); //turns required off
        }
    });

    async function getDataIKP() {
        $("#ikpModal").modal('show')
        try {
            const response = await fetch('<?= base_url(sprintf('pengajuan/getIkp?kode_faskes=%s&tahun=%s', $data[0]['fasyankes_id'], date('Y', strtotime('-1 year')))) ?>', {
                method: 'GET'
            });
            const data = await response.json();
            let rows = '';

            if (data === undefined || data.length == 0) {
                rows += `<tr><th colspan="3" class="text-center">Belum ada data.</th></tr>
                <tr>
                            <th colspan="3" style="color: red;" class="text-center">Fasyankes belum melakukan update data <br>(Klik Update Data di DFO) </th>
                        </tr>`;
                $("#ikpModal tbody").empty().append(rows)

                return;
            }

            rows += `
                <tr><td>Januari</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].januari)}</td></tr>
                <tr><td>Februari</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].februari)}</td></tr>
                <tr><td>Maret</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].maret)}</td></tr>
                <tr><td>April</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].april)}</td></tr>
                <tr><td>Mei</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].mei)}</td></tr>
                <tr><td>Juni</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].juni)}</td></tr>
                <tr><td>Juli</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].juli)}</td></tr>
                <tr><td>Agustus</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].agustus)}</td></tr>
                <tr><td>September</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].september)}</td></tr>
                <tr><td>Oktober</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].oktober)}</td></tr>
                <tr><td>November</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].november)}</td></tr>
                <tr><td>Desember</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].desember)}</td></tr>
            `;

            $("#ikpModal tbody").empty().append(rows)
        } catch (e) {
            console.log(e)
            alert('Terjadi kesalahan.')
        }
    }

    async function getDataINM() {
        $("#inmModal").modal('show')
        try {
            const response = await fetch('<?= base_url(sprintf('pengajuan/getInm?kode_faskes=%s&tahun=%s', $data[0]['fasyankes_id'], date('Y', strtotime('-1 year')))) ?>', {
                method: 'GET'
            });
            const data = await response.json();
            let rows = ''

            if (data === undefined || data.length == 0) {
                rows += `
                <tr>
                    <th colspan="3" class="text-center">Belum ada data.</th>
                </tr>
                <tr>
                            <th colspan="3" style="color: red;" class="text-center">Fasyankes belum melakukan update data <br>(Klik Update Data di DFO) </th>
                        </tr>
                `;
                $("#inmModal tbody").empty().append(rows)

                return;
            }

            rows += `
                <tr><td>Januari</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].januari)}</td></tr>
                <tr><td>Februari</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].februari)}</td></tr>
                <tr><td>Maret</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].maret)}</td></tr>
                <tr><td>April</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].april)}</td></tr>
                <tr><td>Mei</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].mei)}</td></tr>
                <tr><td>Juni</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].juni)}</td></tr>
                <tr><td>Juli</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].juli)}</td></tr>
                <tr><td>Agustus</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].agustus)}</td></tr>
                <tr><td>September</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].september)}</td></tr>
                <tr><td>Oktober</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].oktober)}</td></tr>
                <tr><td>November</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].november)}</td></tr>
                <tr><td>Desember</td><td>${sanitizeString(data[0].tahun)}</td><td>${sanitizeString(data[0].desember)}</td></tr>
            `

            $("#inmModal tbody").empty().append(rows)
        } catch (e) {
            console.log(e)
            alert('Terjadi kesalahan.')
        }
    }

    async function getDataASPAK() {
        <?php
        if ($data[0]['jenis_fasyankes'] == 2) {
            $apiCode = isset($puskesmas->KODE_LAMA) ? $puskesmas->KODE_LAMA : '-1';
        } else {
            $apiCode = isset($data[0]['fasyankes_id']) ? $data[0]['fasyankes_id'] : '-1';
        }
        ?>

        let code = '<?= $apiCode ?>'

        if (code == -1) {
            return null
        }

        try {
            let rows = ''
            const response = await fetch(`<?= base_url('pengajuan/getAspakId') ?>?code=${code}`, {
                method: 'GET'
            });
            const data = await response.json();

            const kodeFaskes = '<?= $data[0]['fasyankes_id'] ?>'
            const kodeIntegrasi = data?.data[0]?.id

            const getDataAspak = await fetch(`<?= base_url('pengajuan/getAspak') ?>?kode_integrasi=${kodeIntegrasi}&kode_faskes=${kodeFaskes}`, {
                method: 'GET'
            })

            const datas = await getDataAspak.json()

            if (datas === undefined || datas.length == 0) {
                rows += `<tr>
                            <th colspan="2" class="text-center">Belum ada data.</th>
                        </tr>
                        <tr>
                            <th colspan="2" style="color: red;" class="text-center">Fasyankes belum melakukan update data <br>(Klik Update Data di DFO) </th>
                        </tr>
                        `;

                $("#aspakModal").modal('show')
                $("#aspakModal tbody").empty().append(rows)

                return;
            }

            rows += `
                <tr>
                    <td>Resume Alat</td>
                    <td>${sanitizeString(datas[0].resume_alat, true)}</td>
                </tr>
                <tr>
                    <td>Resume Sarana</td>
                    <td>${sanitizeString(datas[0].resume_sarana, true)}</td>
                </tr>
                <tr>
                    <td>Resume Prasarana</td>
                    <td>${sanitizeString(datas[0].resume_prasarana, true)}</td>
                </tr>
                <tr>
                    <td>Resume SPA</td>
                    <td>${sanitizeString(datas[0].resume_spa, true)}</td>
                </tr>
                <tr>
                    <td>Update Alat</td>
                    <td>${sanitizeString(datas[0].update_alat, true)}</td>
                </tr>
                <tr>
                    <td>Update Sarana</td>
                    <td>${sanitizeString(datas[0].update_sarana, true)}</td>
                </tr>
                <tr>
                    <td>Update Prasarana</td>
                    <td>${sanitizeString(datas[0].update_prasarana, true)}</td>
                </tr>
                <tr>
                    <td>Validasi Dinkes</td>
                    <td>${sanitizeString(datas[0].validasi_dinkes, true)}</td>
                </tr>
            `;

            $("#aspakModal").modal('show')
            $("#aspakModal tbody").empty().append(rows)
        } catch (e) {
            alert('Terjadi kesalahan.')
        }
    }

    function sanitizeString(value, withPercent = false) {
        if (value === undefined) {
            return '-';
        }

        return (value === null) ? '-' : value + (withPercent ? '%' : '');
    }

    $('input[name="kelengkapan_berkas_usulan"]').on('click change', function(e) {
        if ($(this).val() == 2) {
            document.getElementById("kelengkapan_berkas_usulan_catatan").style.display = "none";
            $("#kelengkapan_berkas_usulan_catatan").removeAttr('required'); //turns required off
        } else if ($(this).val() == 1) {
            document.getElementById("kelengkapan_berkas_usulan_catatan").style.display = "block";
            $("#kelengkapan_berkas_usulan_catatan").attr('required', ''); //turns required on
        }

    });
    $('input[name="kelengkapan_dfo"]').on('click change', function(e) {
        if ($(this).val() == 2) {
            document.getElementById("kelengkapan_dfo_catatan").style.display = "none";
            $("#kelengkapan_dfo_catatan").removeAttr('required'); //turns required off
        } else if ($(this).val() == 1) {
            document.getElementById("kelengkapan_dfo_catatan").style.display = "block";
            $("#kelengkapan_dfo_catatan").attr('required', ''); //turns required on
        }

    });
    $('input[name="kelengkapan_nakes"]').on('click change', function(e) {
        if ($(this).val() == 2) {
            document.getElementById("kelengkapan_nakes_catatan").style.display = "none";
            $("#kelengkapan_nakes_catatan").removeAttr('required'); //turns required off
        } else if ($(this).val() == 1) {
            document.getElementById("kelengkapan_nakes_catatan").style.display = "block";
            $("#kelengkapan_nakes_catatan").attr('required', ''); //turns required on
        }

    });
    $('input[name="kelengkapan_sarpras_alkes"]').on('click change', function(e) {
        if ($(this).val() == 2) {
            document.getElementById("kelengkapan_sarpras_alkes_catatan").style.display = "none";
            $("#kelengkapan_sarpras_alkes_catatan").removeAttr('required'); //turns required off
        } else if ($(this).val() == 1) {
            document.getElementById("kelengkapan_sarpras_alkes_catatan").style.display = "block";
            $("#kelengkapan_sarpras_alkes_catatan").attr('required', ''); //turns required on
        }

    });
    $('input[name="kelengkapan_laporan_inm"]').on('click change', function(e) {
        if ($(this).val() == 2) {
            document.getElementById("kelengkapan_laporan_inm_catatan").style.display = "none";
            $("#kelengkapan_laporan_inm_catatan").removeAttr('required'); //turns required off
        } else if ($(this).val() == 1) {
            document.getElementById("kelengkapan_laporan_inm_catatan").style.display = "block";
            $("#kelengkapan_laporan_inm_catatan").attr('required', ''); //turns required on
        }

    });
    $('input[name="kelengkapan_laporan_ikp"]').on('click change', function(e) {
        if ($(this).val() == 2) {
            document.getElementById("kelengkapan_laporan_ikp_catatan").style.display = "none";
            $("#kelengkapan_laporan_ikp_catatan").removeAttr('required'); //turns required off
        } else if ($(this).val() == 1) {
            document.getElementById("kelengkapan_laporan_ikp_catatan").style.display = "block";
            $("#kelengkapan_laporan_ikp_catatan").attr('required', ''); //turns required on
        }

    });

    $(".btn-close-sisdmk").click(function() {
        $("#loading").hide()
        $("#table_sisdmk").hide()
        $("#table_sisdmk tbody").empty()

        $("#modal_sisdmk").modal('hide')
    })

    $("#cek_sisdmk").click(async function() {
        $("#modal_sisdmk").modal('show')
        $("#loading").show()
        $("#table_sisdmk").hide()

        try {
            const response = await fetch('<?= base_url(sprintf('pengajuan/getSisdmk?kode_faskes=%s', $data[0]['fasyankes_id'])) ?>', {
                method: 'GET'
            });
            const data = await response.json();
            let tbodyHTML = '';

            if (data === undefined || data.length == 0) {
                tbodyHTML += `
                    <tr>
                        <th width="100%" class="text-center">Belum ada data.</th>
                    </tr>
                    <tr>
                            <th colspan="2" style="color: red;" class="text-center">Fasyankes belum melakukan update data <br>(Klik Update Data di DFO) </th>
                    </tr>
                `
            } else {
                const jenisFasyankes = "<?= $jenis_fasyankes; ?>"
                const persentase_sip = data[0].persentase_sip;
                const persentase_str = data[0].persentase_str;

                tbodyHTML += `
                    <tr>
                        <th width="85%">Persentase SIP Nakes yang masih berlaku</th>
                        <td class="text-center" width="15%">${persentase_sip}</td>
                    </tr>
                    <tr>
                        <th width="85%">Persentase STR Nakes yang masih berlaku</th>
                        <td class="text-center" width="15%">${persentase_str}</td>
                    </tr>
                `;

                if (jenisFasyankes === 'Pusat Kesehatan Masyrakat') {
                    tbodyHTML += `
                        <tr>
                            <th width="85%">Memiliki Dokter di Puskesmas</th>
                            <td class="text-center" width="15%">${data[0].memiliki_dokter}</td>
                        </tr>
                    `;
                }
            }

            $("#table_sisdmk tbody").empty().append(tbodyHTML)
            $("#loading").hide()
            $("#table_sisdmk").show()
        } catch (e) {
            console.log(e)
        }
    });


    $("#penggantis1").select2({
        placeholder: "Pilih Surveior",
        width: '100%'
    });

    $("#penggantis2").select2({
        placeholder: "Pilih Surveior",
        width: '100%'
    });

    function findsurveriorpengganti1(idsurveior) {
        var checkBox = document.getElementById("approvements1");
        if (checkBox.checked == true) {
            $('#formpengganti1').show();
            $('#formpenggantitext1').show();

            $("#penggantis1").attr('required', '');
            // $("#keterangansatu").attr('required', '');
            $("#keterangan1").attr('required', '');
            idpengajuan = '<?php echo $data[0]['id'] ?>';
            base_url = '<?php echo base_url() ?>';
            $.ajax({
                url: base_url + 'Pengajuan/getsurveiorpenggantiopenall/',
                type: 'POST',
                data: {
                    idpengajuan: idpengajuan,
                    idsurveior: idsurveior
                },
                success: function(response) {
                    console.log(JSON.parse(response));
                    $("#penggantis1").html('');
                    $("#penggantis1").append('<option value="">==Pilih Surveior Pengganti==</option>')
                    $.each(JSON.parse(response), function() {
                        if (this.jumlah_penugasan == null) {
                            var jumlah = 0
                        } else {
                            var jumlah = this.jumlah_penugasan
                        }
                        $("#penggantis1").append('<option value="' + this.userSurveiorId + '">' + this.surveior_nama + ' - ' + this.propinsi_name + ' - (' + jumlah + ')</option>')
                    })
                }
            })

            $.ajax({
                url: base_url + 'Pengajuan/getketeranganpengganti/',
                type: 'GET',
                success: function(responseketerangan) {
                    // console.log(responseketerangan);
                    $("#keterangan1").html('');
                    $("#keterangan1").append('<option value="">==Pilih Keterangan Pengganti==</option>')
                    $.each(JSON.parse(responseketerangan), function() {
                        $("#keterangan1").append('<option value="' + this.id + '">' + this.nama + '</option>')
                    })
                }
            })
        } else {
            $('#formpengganti1').hide();
            $('#formpenggantitext1').hide();
            $("#penggantis1").removeAttr('required');
            // $("#keterangansatu").removeAttr('required');
            $("#keterangan1").removeAttr('required');
        }
    }

    function findsurveriorpengganti2(idsurveior) {
        var checkBox = document.getElementById("approvements2");
        if (checkBox.checked == true) {
            $('#formpengganti2').show();
            $('#formpenggantitext2').show();

            $("#penggantis2").attr('required', '');
            // $("#keterangandua").attr('required', '');
            $("#keterangan2").attr('required', '');
            idpengajuan = '<?php echo $data[0]['id'] ?>';
            base_url = '<?php echo base_url() ?>';
            $.ajax({
                url: base_url + 'Pengajuan/getsurveiorpenggantiopenall/',
                type: 'POST',
                data: {
                    idpengajuan: idpengajuan,
                    idsurveior: idsurveior
                },
                success: function(response) {
                    // console.log(response);
                    $("#penggantis2").html('');
                    $("#penggantis2").append('<option value="">==Pilih Surveior Pengganti==</option>')
                    $.each(JSON.parse(response), function() {
                        if (this.jumlah_penugasan == null) {
                            var jumlah = 0
                        } else {
                            var jumlah = this.jumlah_penugasan
                        }
                        $("#penggantis2").append('<option value="' + this.userSurveiorId + '">' + this.surveior_nama + ' - ' + this.propinsi_name + ' - (' + jumlah + ')</option>')
                    })
                }
            })

            $.ajax({
                url: base_url + 'Pengajuan/getketeranganpengganti/',
                type: 'GET',
                success: function(responseketerangan) {
                    // console.log(responseketerangan);
                    $("#keterangan2").html('');
                    $("#keterangan2").append('<option value="">==Pilih Keterangan Pengganti==</option>')
                    $.each(JSON.parse(responseketerangan), function() {
                        $("#keterangan2").append('<option value="' + this.id + '">' + this.nama + '</option>')
                    })
                }
            })
        } else {
            $('#formpengganti2').hide();
            $('#formpenggantitext2').hide();
            $("#penggantis2").removeAttr('required');
            $("#keterangan2").removeAttr('required');
        }
    }

    function alertPTSkosong() {
        alert("Dokumen Pendukung Belum di upload!");
    }

    function gantitulisan(e) {

        if (e == 'jabatansurveior1') {
            // console.log('jabatan 1 ketua');
            document.getElementById('labeljabatan1').innerHTML = 'KETUA';
            document.getElementById('labeljabatan2').innerHTML = 'ANGGOTA';
        } else if (e == 'jabatansurveior2') {
            document.getElementById('labeljabatan2').innerHTML = 'KETUA';
            document.getElementById('labeljabatan1').innerHTML = 'ANGGOTA';
        }
    }
</script>