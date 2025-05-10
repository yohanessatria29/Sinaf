<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Survei</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/css/jquery.dataTables.min.css">
    <script src="<?php echo base_url('assets/temp'); ?>/jquery-3.6.0.js"></script>


</head>

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
    //var_dump($data);
    if ($data != NULL) {
        $element = "active";
        $element_tab = "show active";
        $pengiriman_laporan = "";
        $pengiriman_laporan_tab = "";
    } else {
        $pengiriman_laporan = "active";
        $pengiriman_laporan_tab = "show active";
        $element = "";
        $element_tab = "";
    }

    ?>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="card">

                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Persetujuan Usulan Survei</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="narahubung-tab" data-bs-toggle="tab" href="#narahubung" role="tab" aria-controls="narahubung" aria-selected="false">Narahubung</a>
                                </li>
                                <?php
                                if (!empty($data[0]['penerimaan_pengajuan_usulan_survei_id'])) {
                                ?>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="contacta-tab" data-bs-toggle="tab" href="#contacta" role="tab" aria-controls="contacta" aria-selected="false">Kesiapan Survei </a>
                                    </li>
                                <?php
                                }
                                if (!empty($data[0]['berkas_usulan_survei_id'])) {
                                ?>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Hasil Kesiapan Survei</a>
                                    </li>
                                <?php
                                }
                                if (!empty($data[0]['kelengkapan_berkas_id'])) {
                                ?>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#kesepakatan_survei" role="tab" aria-controls="kesepakatan_survei" aria-selected="false">Kesepakatan Survei</a>
                                    </li>
                                <?php
                                } ?>

                                <!-- <li class="nav-item" role="presentation">
                                    <a class="nav-link tabcontentfont" id="verifikator-tab" data-bs-toggle="tab" href="#verifikator" role="tab" aria-controls="penugasan" aria-selected="false">Penugasan Verifikator</a>
                                </li> -->
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="elemenpenilaian-tab" data-bs-toggle="tab" href="#elemenpenilaian" role="tab" aria-controls="elemenpenilaian" aria-selected="false">Elemen Penilaian</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link tabcontentfont" id="presentasecapaian-tab" data-bs-toggle="tab" href="#presentasecapaian" role="tab" aria-controls="presentasecapaian" aria-selected="false">Capaian EP (%)</a>
                                </li>
                                <!-- <li class="nav-item" role="presentation">
                                    <a class="nav-link tabcontentfont <?= $pengiriman_laporan ?>" id="rekomendasi-tab" data-bs-toggle="tab" href="#rekomendasi" role="tab" aria-controls="rekomendasi" aria-selected="true">Rekomendasi Usulan Survei</a>
                                </li> -->
                                <?php
                                // var_dump($data);
                                if (!empty($data[0]['pengiriman_rekomendasi_id'])) {

                                ?>
                                    <!-- <li class="nav-item" role="presentation">
                                        <a class="nav-link tabcontentfont" id="persetujuan-tab" data-bs-toggle="tab" href="#persetujuan" role="tab" aria-controls="persetujuan" aria-selected="false">Persetujuan Ketua Tim</a>
                                    </li> -->
                                <?php
                                }
                                ?>
                                <!-- <li class="nav-item" role="presentation">
                                    <a class="nav-link tabcontentfont" id="sertifikat-tab" data-bs-toggle="tab" href="#sertifikat" role="tab" aria-controls="sertifikat" aria-selected="false">Penerbitan Sertifikat</a>
                                </li> -->



                                <?php

                                if (!empty($data[0]['pengiriman_laporan_survei_id'])) {
                                ?>
                                    <!-- <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="verifikator-tab" data-bs-toggle="tab" href="#verifikator" role="tab"
                                        aria-controls="verifikator" aria-selected="false">Pemiihan Verifikator</a>
                                </li> -->
                                <?php
                                }
                                ?>
                                <!-- <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="contacta-tab" data-bs-toggle="tab" href="#contacta" role="tab"
                                        aria-controls="contacta" aria-selected="false">Survei Akreditasi</a>
                                </li> -->
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="page-heading">
                                        <section class="section">
                                            <div class="card">
                                                <div class="card-body">
                                                    <?php echo form_open_multipart('Pengajuan/simpanPenerimaanUsulan') ?>
                                                    <form role="form" method="post" class="login-form" name="form_valdation">
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
                                                                        <p>Jenis Survei</p>
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
                                                                        <p>Tanggal Usulan Sebelumnya</p>
                                                                        <fieldset class="form-group">
                                                                            <?= form_dropdown('pengajuan_usulan_survei_id_lama', dropdown_sina_daftar_pengajuan($data[0]['fasyankes_id'], $data[0]['jenis_fasyankes']), $data[0]['pengajuan_usulan_survei_id_lama'], 'id="pengajuan_usulan_survei_id_lama"  class="form-select" disabled'); ?>
                                                                        </fieldset>
                                                                    </div>

                                                                    <div class="form-group" style="display:<?= $var_style_jenis_akreditasi ?>">
                                                                        <p>Jenis Akreditasi</p>
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

                                                                    <div class="form-group status" style="display:<?= $var_style_status ?>" id='status'>
                                                                        <label for="disabledInput">Status Akreditasi Sebelumnya</label>
                                                                        <!-- DICOMMNENT -->
                                                                        <?php //form_dropdown('status_akreditasi_id', array('1' => 'Paripurna', '2' => 'Utama', '3' => 'Madya', '4' => 'Dasar'), $data[0]['status_akreditasi_id'], 'id="status_akreditasi_id"  class="form-control" disabled'); 
                                                                        ?>
                                                                        <!-- NEW DISINI -->
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
                                                                        <!-- <input type="date" class="form-control" id="disabledInput" placeholder="Disabled Text"> -->
                                                                        <input type="text" name="tanggal_akhir_sertifikat" id="datepicker" value="<?= $data[0]['tanggal_akhir_sertifikat'] ?>" class="form-control datepicker" autocomplete="off" disabled>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="helperText">Tanggal Pengajuan Survei</label>
                                                                        <!-- <input type="date" id="tanggalpengajuan" class="form-control" > -->
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
                                                                            foreach ($detail_pengajuan as $datac) {

                                                                            ?>

                                                                                <div class="col-md-4">
                                                                                    <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="<?= $datac['tanggal_survei'] ?>" disabled>
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
                                                                        <?= form_dropdown('status_usulan_id', dropdown_sina_status_usulan(), $data[0]['status_usulan_id'], 'id="status_usulan_id"  class="form-select" '); ?>
                                                                    </div>
                                                                    <?php
                                                                    if (!empty($data[0]['status_usulan_id'])) {
                                                                        if ($data[0]['status_usulan_id'] == 2) {
                                                                            $keterangan_style = "block";
                                                                            $submit_style = "none";
                                                                            $keterangan_required = "required";
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
                                                                        <!-- <button type="submit" class="btn btn-primary me-1 mb-1" style="display:<?= $submit_style; ?>;">Submit</button> -->
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="penugasan" role="tabpanel" aria-labelledby="penugasan-tab">
                                    <div class="page-heading">
                                        <div class="page-title">
                                        </div>
                                        <section class="section">
                                            <div class="card">
                                                <div class="card-body">

                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="narahubung" role="tabpanel" aria-labelledby="narahubung-tab">
                                    <div class="page-heading">
                                        <div class="page-title">
                                        </div>
                                        <section class="section">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h1>Data Narahubung Faskes </h1>
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

                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <!-- Kesiapan Survei -->
                                <div class="tab-pane fade" id="contacta" role="tabpanel" aria-labelledby="contacta-tab">
                                    <div class="page-heading">
                                        <div class="page-title">

                                        </div>
                                        <section class="section">
                                            <div class="card">
                                                <div class="card-body">
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
                                                            <!-- <tr>
                                                        <td>2</td>
                                                        <td>Profil fasyankes terbaru</td>
                                                        <td>
                                                        <?php
                                                        if (!empty($data[0]['url_profil_fasyankes'])) {
                                                        ?>
                                                            <a href="<?= $data[0]['url_profil_fasyankes']; ?>" target="_blank" class="btn btn-primary rounded-pill">View</a>
                                                            <?php
                                                        }
                                                            ?>   
                                                        </td>
                                                    </tr> -->
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
                                                                <td><?php
                                                                    if (is_null($data[0]['update_dfo']) == 1) {

                                                                    ?>
                                                                        <span class="badge bg-warning">!</span>
                                                                        <?php
                                                                    } else {
                                                                        if ($data[0]['update_dfo'] == 1) {
                                                                        ?>
                                                                            <span class="badge bg-danger"><a href="http://103.74.143.45/FasyankesOnline/Viewonly/dfo/<?= $data[0]['fasyankes_id']; ?>/<?= $data[0]['jenis_fasyankes']; ?>" target="_blank">Tidak</a></span>
                                                                        <?php
                                                                        } else if ($data[0]['update_dfo'] == 2) {
                                                                        ?>
                                                                            <span class="badge bg-success"><a href="http://103.74.143.45/FasyankesOnline/Viewonly/dfo/<?= $data[0]['fasyankes_id']; ?>/<?= $data[0]['jenis_fasyankes']; ?>" target="_blank">Ya</a></span>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><?php
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
                                                                            <span class="btn btn-success btn-sm">Sesuai Persyaratan</span>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <button type="button" class="btn btn-primary btn-sm" onclick="getDataASPAK()">
                                                                        Cek Data ASPAK
                                                                    </button>
                                                                </td>
                                                                <td><?php
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
                                                                            <span class="btn btn-success btn-sm">Sesuai Persyaratan</span>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><?php
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
                                                                            <span class="btn btn-success btn-sm">Sesuai Persyaratan</span>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <button type="button" class="btn btn-primary btn-sm" onclick="getDataINM()">
                                                                        Cek Data INM
                                                                    </button>
                                                                </td>
                                                                <td><?php
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
                                                                            <span class="btn btn-success btn-sm">Sesuai Persyaratan</span>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <button type="button" class="btn btn-primary btn-sm" onclick="getDataIKP()">
                                                                        Cek Data IKP
                                                                    </button>
                                                                </td>


                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="card">
                                        <!-- <div class="card-header">
                                                Data
                                        </div> -->
                                        <div class="card-body">
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

                                                // var_dump($update_ikp_n);
                                                ?>
                                                <table class="table table-striped" id="table1">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Data</th>
                                                            <th>Kelengkapan</th>
                                                            <th>Catatan</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
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
                                                            <td><input type="text" style="display:<?= $kelengkapan_berkas_usulan_checked; ?>;" class="form-control" id="kelengkapan_berkas_usulan_catatan" name="kelengkapan_berkas_usulan_catatan" value="<?= $data[0]['kelengkapan_berkas_usulan_catatan']; ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
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

                                                            <td><input type="text" class="form-control" style="display:<?= $kelengkapan_dfo_checked; ?>" id="kelengkapan_dfo_catatan" name="kelengkapan_dfo_catatan" value="<?= $data[0]['kelengkapan_dfo_catatan']; ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
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

                                                            <td><input type="text" class="form-control" style="display:<?= $kelengkapan_sarpras_alkes_checked; ?>" id="kelengkapan_sarpras_alkes_catatan" name="kelengkapan_sarpras_alkes_catatan" value="<?= $data[0]['kelengkapan_sarpras_alkes_catatan']; ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
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

                                                            <td><input type="text" class="form-control" style="display:<?= $kelengkapan_nakes_checked; ?>" id="kelengkapan_nakes_catatan" name="kelengkapan_nakes_catatan" value="<?= $data[0]['kelengkapan_nakes_catatan']; ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>5</td>
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
                                                            <td><input type="text" class="form-control" style="display:<?= $kelengkapan_laporan_inm_checked; ?> " id="kelengkapan_laporan_inm_catatan" name="kelengkapan_laporan_inm_catatan" value="<?= $data[0]['kelengkapan_laporan_inm_catatan']; ?>"></td>

                                                        </tr>
                                                        <tr>
                                                            <td>6</td>
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
                                                            <td><input type="text" class="form-control" style="display:<?= $kelengkapan_laporan_ikp_checked; ?>" id="kelengkapan_laporan_ikp_catatan" name="kelengkapan_laporan_ikp_catatan" value="<?= $data[0]['kelengkapan_laporan_ikp_catatan']; ?>"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                        </div>
                                        <!-- <button type="submit" class="btn btn-primary rounded-pill">Submit</button> -->
                                        </form>
                                    </div>
                                </div>

                                <!-- Tab Baru -->
                                <div class="tab-pane fade show" id="laporan" role="tabpanel" aria-labelledby="laporan-tab">
                                    <div class="page-heading">
                                        <div class="page-title">

                                        </div>
                                        <section class="section">

                                            <div class="card">
                                                <div class="card-header">

                                                </div>
                                                <?php echo form_open_multipart('surveior/simpanLaporan/') ?>
                                                <form role="form" method="post" class="login-form" name="form_valdation">
                                                    <div class="row">
                                                        </br>
                                                        <div class="form-group col-md-4">
                                                            <!-- <div class="form-group" style='display:block;'>
                                                                <label for="disabledInput">Tanggal Pengiriman Laporan Survei 1</label>
                                                            
                                                                <input type="date"  name="tanggal_pengiriman_laporan" id="tanggal_pengiriman_laporan" value=""  class="form-control datepicker"  autocomplete="off"  >
                                                            </div> -->
                                                            <div class="form-group" style='display:block;'>
                                                                <label for="disabledInput">Tanggal Survei Hari Pertama</label>
                                                                <!-- <input type="date" class="form-control" id="disabledInput" placeholder="Disabled Text"> -->
                                                                <input type="date" name="tanggal_survei_satu" id="tanggal_survei_satu" value="<?= (!empty($data[0]['tanggal_survei_satu']) ? $data[0]['tanggal_survei_satu'] : '') ?>" class="form-control datepicker" autocomplete="off" required>
                                                            </div>
                                                            <div class="form-group" style='display:block;'>
                                                                <label for="disabledInput">Foto Bukti Survei Hari Pertama</label>
                                                                <i><small class="text-muted"> Maks 2MB </i></small>
                                                                <fieldset>
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control" id="foto_bukti_survei" name="foto_bukti_survei" aria-describedby="inputGroupFileAddon04" aria-label="Upload">

                                                                    </div>
                                                                    <?php
                                                                    if (!empty($data[0]['url_bukti_satu'])) {
                                                                        $url_bukti_satu = $data[0]['url_bukti_satu'];
                                                                    ?>
                                                                        <a class="btn btn-success rounded-pill" target="_blank" href="<?php echo $url_bukti_satu; ?>">Lihat Dokumen</a>
                                                                    <?php
                                                                    } else {
                                                                        $url_bukti_satu = "";
                                                                    }
                                                                    ?>

                                                                    <input type="hidden" name="old_foto_bukti_survei" value="" id="old_foto_bukti_survei">
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <!-- <div class="form-group" style='display:block;'>
                                                                <label for="disabledInput">Tanggal Pengiriman Laporan Survei 2</label>
                                                            
                                                                <input type="date"  name="tanggal_pengiriman_laporan2" id="tanggal_pengiriman_laporan2" value=""  class="form-control datepicker"  autocomplete="off"  >
                                                            </div> -->
                                                            <div class="form-group" style='display:block;'>
                                                                <label for="disabledInput">Tanggal Survei Hari Kedua</label>
                                                                <!-- <input type="date" class="form-control" id="disabledInput" placeholder="Disabled Text"> -->
                                                                <input type="date" name="tanggal_survei_dua" id="tanggal_survei_dua" value="<?= (!empty($data[0]['tanggal_survei_dua']) ? $data[0]['tanggal_survei_dua'] : '') ?>" class="form-control datepicker" autocomplete="off">
                                                            </div>
                                                            <div class="form-group" style='display:block;'>
                                                                <label for="disabledInput">Foto Bukti Survei Hari Kedua</label>
                                                                <i><small class="text-muted"> Maks 2MB </i></small>
                                                                <fieldset>
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control" id="foto_bukti_survei2" name="foto_bukti_survei2" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                                                    </div>

                                                                    <?php
                                                                    if (!empty($data[0]['url_bukti_dua'])) {
                                                                        $url_bukti_dua = $data[0]['url_bukti_dua'];
                                                                    ?>
                                                                        <a class="btn btn-success rounded-pill" target="_blank" href="<?php echo $url_bukti_dua; ?>">Lihat Dokumen</a>
                                                                    <?php
                                                                    } else {
                                                                        $url_bukti_dua = "";
                                                                    }
                                                                    ?>

                                                                    <input type="hidden" name="old_foto_bukti_survei2" value="" id="old_foto_bukti_survei2">
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <!-- <div class="form-group" style='display:block;'>
                                                                    <label for="disabledInput">Tanggal Pengiriman Laporan Survei 3</label>
                                                                
                                                                    <input type="date"  name="tanggal_pengiriman_laporan3" id="tanggal_pengiriman_laporan3" value=""  class="form-control datepicker"  autocomplete="off"  >
                                                                </div> -->
                                                            <div class="form-group" style='display:block;'>
                                                                <label for="disabledInput">Tanggal Survei Hari Ketiga</label>
                                                                <!-- <input type="date" class="form-control" id="disabledInput" placeholder="Disabled Text"> -->
                                                                <input type="date" name="tanggal_survei_tiga" id="tanggal_survei_tiga" value="<?= (!empty($data[0]['tanggal_survei_tiga']) ? $data[0]['tanggal_survei_tiga'] : '') ?>" class="form-control datepicker" autocomplete="off">
                                                            </div>
                                                            <div class="form-group" style='display:block;'>
                                                                <label for="disabledInput">Foto Bukti Survei Ketiga</label>
                                                                <i><small class="text-muted"> Maks 2MB </i></small>
                                                                <fieldset>
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control" id="foto_bukti_survei3" name="foto_bukti_survei3" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                                                    </div>
                                                                    <?php
                                                                    if (!empty($data[0]['url_bukti_tiga'])) {
                                                                        $url_bukti_tiga = $data[0]['url_bukti_tiga'];
                                                                    ?>
                                                                        <a class="btn btn-success rounded-pill" target="_blank" href="<?php echo $url_bukti_tiga; ?>">Lihat Dokumen</a>
                                                                    <?php
                                                                    } else {
                                                                        $url_bukti_tiga = "";
                                                                    }
                                                                    ?>

                                                                    <input type="hidden" name="old_foto_bukti_survei3" value="" id="old_foto_bukti_survei3">
                                                                </fieldset>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <input type="hidden" name="penetapan_tanggal_survei_id" value="<?= $data[0]['penetapan_tanggal_survei_id']; ?>">
                                                    <input type="hidden" name="id_pengajuan" value="<?= $id; ?>">

                                                </form>

                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <!-- Tab Baru -->

                                <!-- Tab Baru -->
                                <div class="tab-pane fade <?= $pengiriman_laporan_tab ?>" id="rekomendasi" role="tabpanel" aria-labelledby="rekomendasi-tab">
                                    <div class="page-heading">
                                        <div class="page-title">

                                        </div>
                                        <section class="section">

                                            <div class="card">
                                                <div class="card-header">

                                                </div>
                                                <?php echo form_open_multipart('admin/simpanRekomendasi/') ?>
                                                <form role="form" method="post" class="login-form" name="form_valdation">
                                                    <div class="row">
                                                        </br>
                                                        <div class="form-group col-md-4">
                                                            <!-- <div class="form-group" style='display:block;'>
                                                                <label for="disabledInput">Tanggal Pengiriman Laporan Survei 1</label>
                                                            
                                                                <input type="date"  name="tanggal_pengiriman_laporan" id="tanggal_pengiriman_laporan" value=""  class="form-control datepicker"  autocomplete="off"  >
                                                            </div> -->
                                                            <?php
                                                            if (!empty($data[0]['status_rekomendasi_id'])) {
                                                                $status_rekomendasi_id = "";
                                                            } else {
                                                                $status_rekomendasi_id = $data[0]['status_rekomendasi_id'];
                                                            }
                                                            ?>
                                                            <div class="form-group" style='display:block;'>
                                                                <label for="disabledInput">Rekomendasi Status </label>
                                                                <!-- <input type="date" class="form-control" id="disabledInput" placeholder="Disabled Text"> -->
                                                                <?= form_dropdown('status_rekomendasi_id', dropdown_sina_status_rekomendasi($data[0]['jenis_fasyankes']), $data[0]['status_rekomendasi_id'], 'id="status_rekomendasi_id"  class="form-select" required'); ?>
                                                            </div>
                                                            <div class="form-group" style='display:block;'>
                                                                <label for="disabledInput">Surat Rekomendasi Status</label>
                                                                <small class="text-muted"><i>Dokumen PDF, Maks 2MB - </i><a href="https://docs.google.com/document/d/12xidmLJ174G8uDlj167VoibGp-FcEYvL/edit?usp=sharing&ouid=109754320285918165578&rtpof=true&sd=true" target="_blank">Download Contoh</a></small>
                                                                <fieldset>
                                                                    <div class="input-group">
                                                                        <!-- Input untuk URL Drive (Google Drive) -->
                                                                        <input type="text" class="form-control" id="url_surat_rekomendasi_status" name="url_surat_rekomendasi_status"
                                                                            aria-describedby="inputGroupFileAddon04" aria-label="Masukkan Link Google Drive"
                                                                            placeholder="Masukkan URL Google Drive" value="<?= isset($data[0]['url_surat_rekomendasi_status']) ? $data[0]['url_surat_rekomendasi_status'] : '' ?>">
                                                                    </div>

                                                                    <?php
                                                                    // Mengecek apakah ada URL yang sudah ada (bisa berupa file atau link)
                                                                    if (!empty($data[0]['url_surat_rekomendasi_status'])) {
                                                                        $url_surat_rekomendasi_status = $data[0]['url_surat_rekomendasi_status'];

                                                                        // Mengecek apakah yang disimpan adalah URL Google Drive
                                                                        if (filter_var($url_surat_rekomendasi_status, FILTER_VALIDATE_URL) && strpos($url_surat_rekomendasi_status, 'drive.google.com') !== false) {
                                                                            // Jika URL Google Drive, tampilkan link tersebut
                                                                            echo '<a class="btn btn-success rounded-pill" target="_blank" href="' . $url_surat_rekomendasi_status . '">Lihat Dokumen (Google Drive)</a>';
                                                                        } else {
                                                                            // Jika file masih berupa file, tampilkan link file lama
                                                                            echo '<a class="btn btn-success rounded-pill" target="_blank" href="' . $url_surat_rekomendasi_status . '">Lihat Dokumen</a>';
                                                                        }
                                                                    } else {
                                                                        $url_surat_rekomendasi_status = "";
                                                                    }
                                                                    ?>

                                                                    <!-- Menyimpan URL lama -->
                                                                    <input type="hidden" name="old_url_surat_rekomendasi_status" value="<?= $url_surat_rekomendasi_status ?>" id="old_url_surat_rekomendasi_status">
                                                                </fieldset>

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <input type="hidden" name="trans_final_ep_verifikator_id" value="<?= $data[0]['trans_final_ep_verifikator_id']; ?>">
                                                    <input type="hidden" name="id_pengajuan" value="<?= $id; ?>">
                                                    <!-- <button type="submit" class="btn btn-primary rounded-pill">Submit</button> -->
                                                </form>

                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <!-- Tab Baru -->


                                <!-- Batas Tab -->
                                <div class="tab-pane fade" id="verifikator" role="tabpanel" aria-labelledby="verifikator-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Penugasan Verifikator</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-2 col-4">
                                                        <label class="col-form-label">Nama Verifikator : </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <label class="col-form-label"><?php echo $data[0]['nama_verifikator']; ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Batas Tab -->
                                <div class="tab-pane fade <?= $element_tab ?>" id="elemenpenilaian" role="tabpanel" aria-labelledby="elemenpenilaian-tab">
                                    <div class="page-heading">
                                        <div class="page-tittle"></div>
                                        <section class="section">
                                            <div class="card">
                                                <div class="card-body">
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

                                                    <?php echo form_open_multipart('Binwas/detail/' . $id) ?>
                                                    <form role="form" method="post" class="login-form" name="form_validation">
                                                        <div class="form-group row align-items-center">
                                                            <div class="row">
                                                                <div class="col-lg-2 col-4">
                                                                    <label class="col-form-label">Kode Fasyankes</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <label class="col-form-label"><?php echo $data[0]['fasyankes_id']; ?></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group row align-items-center">
                                                                <div class="col-lg-2 col-3">
                                                                    <label class="col-form-label">Nama Fasyankes</label>
                                                                </div>
                                                                <div class="col-lg-10 col-9">
                                                                    <label class="col-form-label"> </label>
                                                                </div>
                                                            </div> -->
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-lg-2 col-3">
                                                                <label class="col-form-label">Jenis Fasyankes</label>
                                                            </div>
                                                            <div class="col-lg-10 col-9">
                                                                <label class="col-form-label"><?= $jenis_fasyankes; ?></label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-lg-2 col-3">
                                                                <label class="col-form-label">BAB</label>
                                                            </div>
                                                            <div class="col-lg-10 col-9">
                                                                <?= form_dropdown('bab', dropdown_sina_ep($data[0]['jenis_fasyankes']), $bab, 'id="bab"  class="form-select" required'); ?>
                                                                <?php //var_dump($data[0]);
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="buttons">
                                                            <!-- <a href="#" class="btn btn-success rounded-pill">Tampilkan</a> -->
                                                            <button type="submit" class="btn btn-success me-1 mb-1">Cari</button>
                                                            <!-- <a href="#" class="btn btn-light rounded-pill">Bersihkan</a> -->
                                                        </div>
                                                    </form>

                                                    <div class="table-responsive">
                                                        <table class="table table-striped" id="table3">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Bab</th>
                                                                    <th>Standar</th>
                                                                    <th>Kriteria</th>
                                                                    <th>Elemen Penilaian</th>
                                                                    <th>Uraian</th>
                                                                    <th>SKOR Capaian Surveior</th>
                                                                    <th>SKOR Maksimal</th>
                                                                    <th>Persentase Capaian Surveior</th>
                                                                    <th>FAKTA DAN ANALISIS</th>
                                                                    <th>REKOMENDASI Hasil Survei</th>
                                                                    <th>SKOR Capaian Verifikator</th>
                                                                    <th>Persentase Capaian Verifikator</th>
                                                                    <th>Keterangan</th>
                                                                    <!-- <th>Nama Verifikator</th> -->

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $n = 1;
                                                                // var_dump($data);
                                                                foreach ($datab as $datab) {
                                                                    $key = $datab['id'];
                                                                    $data[0]['status_final_ep_verifikator'];

                                                                    if ($data[0]['status_final_ep_verifikator'] != '1') {
                                                                        $nilai = 0;
                                                                    } else {
                                                                        $nilai = 1;
                                                                    }
                                                                ?>
                                                                    <input type="hidden" class="form-control" id="test" name="test" value="<?= $nilai; ?>">
                                                                    <tr>
                                                                        <td><?= $n; ?></td>
                                                                        <td><?= $datab['bab'] ?></td>
                                                                        <td><?= $datab['standar'] ?></td>
                                                                        <td><?= $datab['kriteria'] ?></td>
                                                                        <td><?= $datab['elemen'] ?></td>
                                                                        <td><?= $datab['keterangan_elemen'] ?></td>


                                                                        <td><?= (!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : 0) ?> </td>
                                                                        <?php
                                                                        if ((!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : '') == "TDD") {
                                                                        ?>
                                                                            <td>TDD</td>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <td><?= $datab['skor_maksimal'] ?> </td>
                                                                        <?php
                                                                        }
                                                                        ?>

                                                                        <td><?= (!empty($trans[$key]['persentase_capaian_surveior']) ? $trans[$key]['persentase_capaian_surveior'] : 0) ?></td>
                                                                        <td><?= (!empty($trans[$key]['fakta_dan_analisis']) ? $trans[$key]['fakta_dan_analisis'] : '') ?></td>
                                                                        <td><?= (!empty($trans[$key]['rekomendasi']) ? $trans[$key]['rekomendasi'] : '') ?></td>

                                                                        <?php
                                                                        if ($data[0]['status_final_ep_verifikator'] == '1') { ?>
                                                                            <td><?= $trans[$key]['skor_capaian_verifikator']; ?></td>
                                                                            <td><?= $trans[$key]['persentase_capaian_verifikator']; ?></td>
                                                                            <td><?= $trans[$key]['keterangan']; ?></td>
                                                                            <?php
                                                                        } else {
                                                                            if ($trans[$key]['skor_capaian_verifikator'] == (!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : 0)) {
                                                                                $required_text = "";
                                                                            } else {
                                                                                $required_text = "required";
                                                                            }


                                                                            if ((!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : '') == "TDD") {
                                                                                $required_text = "";
                                                                            ?>
                                                                                <td>
                                                                                    <select class="form-select skor_capaian_verifikator" id="skor_capaian_verifikator" name="skor_capaian_verifikator[<?= $key; ?>]">
                                                                                        <option value='TDD'>TDD</option>
                                                                                    </select>
                                                                                </td>
                                                                                <td><input type="text" class="form-control" id="persentase_capaian_verifikator<?= $n ?>" name="persentase_capaian_verifikator" value="TDD" readonly></td>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <td>
                                                                                    <select class="form-select skor_capaian_verifikator" id="skor_capaian_verifikator" name="skor_capaian_verifikator[<?= $key; ?>]">
                                                                                        <option value='0' <?php if ((!empty($trans[$key]['skor_capaian_verifikator']) ? $trans[$key]['skor_capaian_verifikator'] : '')  == "0") echo "selected" ?>>0</option>
                                                                                        <option value='5' <?php if ((!empty($trans[$key]['skor_capaian_verifikator']) ? $trans[$key]['skor_capaian_verifikator'] : '')  == "5") echo "selected" ?>>5</option>
                                                                                        <option value='10' <?php if ((!empty($trans[$key]['skor_capaian_verifikator']) ? $trans[$key]['skor_capaian_verifikator'] : '')  == "10") echo "selected" ?>>10</option>
                                                                                        <!-- <option value='TDD' <?php if ((!empty($trans[$key]['skor_capaian_verifikator']) ? $trans[$key]['skor_capaian_verifikator'] : '')  == "TDD") echo "selected" ?>>TDD</option> -->
                                                                                    </select>
                                                                                    <!-- <input type="text" class="form-control" id="tesssss<?= $n ?>" name="tesssss" value="<?= (!empty($trans[$key]['skor_capaian_verifikator']) ? $trans[$key]['skor_capaian_verifikator'] : 0) ?>" readonly> -->
                                                                                </td>
                                                                                <td><input type="text" class="form-control" id="persentase_capaian_verifikator<?= $n ?>" name="persentase_capaian_verifikator" value="<?= (!empty($trans[$key]['persentase_capaian_verifikator']) ? $trans[$key]['persentase_capaian_verifikator'] : 0) ?>" readonly></td>
                                                                            <?php
                                                                            } ?>

                                                                            <td><textarea class="form-control" data-toggle="tooltip" data-placement="top" title="Minimal 30 Karakter" rows="4" cols="50" id="keterangan<?= $n ?>" minlength="30" name="keterangan[<?= $key; ?>]" <?= $required_text; ?>><?= (!empty($trans[$key]['keterangan']) ? $trans[$key]['keterangan'] : '') ?></textarea></td>
                                                                        <?php
                                                                        }
                                                                        ?>



                                                                        <!-- <td><input type="text" class="form-control" id="nama_verifikator" name="nama_verifikator" value="" readonly></td> -->

                                                                        <input type="hidden" name="trans_ep_id[<?= $key; ?>]" value="<?= (!empty($trans2[$key]['id']) ? $trans2[$key]['id'] : '') ?>"></td>
                                                                        <input type="hidden" name="skor_maksimal[<?= $key; ?>]" value="<?= $datab['skor_maksimal']; ?>">
                                                                        <input type="hidden" name="id_ep[]" value="<?= $key; ?>">
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
                                        </section>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="presentasecapaian" role="tabpanel" aria-labelledby="presentasecapaian-tab">
                                    <div class="page-heading">
                                        <div class="page-tittle"></div>
                                        <section class="section">
                                            <div class="card">
                                                <div class="card-header"></div>
                                                <?php echo form_open_multipart('verifikator/final_ep/') ?>
                                                <form role="form" method="post" class="login-form" name="form_valdation">
                                                    <!-- <div class="row"> -->
                                                    <div class="card-body">
                                                        </br>
                                                        <div class="row">
                                                            <?php
                                                            // var_dump($count_trans);
                                                            ?>
                                                            <table class="table table-striped" id="table2">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Bab</th>
                                                                        <th>Skor Capaian Surveior</th>
                                                                        <th>Skor Maksimal Surveior</th>
                                                                        <th>Persentase Capaian Surveior ( % )</th>
                                                                        <th>Skor Capaian Verifikator</th>
                                                                        <th>Skor Maksimal Verifikator</th>
                                                                        <th>Persentase Capaian Verifikator ( % )</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $disabled_final = "";

                                                                    $count_row = 0;
                                                                    $count_row_verifikator = 0;

                                                                    //untuk utd, lab, dan pm
                                                                    $persen80 = 0;
                                                                    $persen20 = 0;
                                                                    $persen0 = 0;

                                                                    $persen80_verifikator = 0;
                                                                    $persen20_verifikator = 0;
                                                                    $persen0_verifikator = 0;

                                                                    //untuk puskesmas dan klinik
                                                                    $persenbab1 = 0;
                                                                    $persenbab2 = 0;
                                                                    $persenbab3 = 0;
                                                                    $persenbab4 = 0;
                                                                    $persenbab5 = 0;

                                                                    $persenbab1_verifikator = 0;
                                                                    $persenbab2_verifikator = 0;
                                                                    $persenbab3_verifikator = 0;
                                                                    $persenbab4_verifikator = 0;
                                                                    $persenbab5_verifikator = 0;

                                                                    $n = 1;

                                                                    // var_dump($data);
                                                                    foreach ($count_trans as $count_trans) {
                                                                        $count_row++;
                                                                        // $key = $datab['id'];


                                                                        if ($data[0]['jenis_fasyankes'] == 6 || $data[0]['jenis_fasyankes'] == 7) {
                                                                            if (number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') >= 80) {
                                                                                $persen80++;
                                                                            } else if (number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') < 80 && number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') >= 20) {
                                                                                $persen20++;
                                                                            } else {
                                                                                $persen0++;
                                                                            }
                                                                        } else if ($data[0]['jenis_fasyankes'] == 1) {
                                                                            if (number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') >= 80) {
                                                                                $persen80++;
                                                                            } else {
                                                                                $persen0++;
                                                                            }
                                                                        } else if ($data[0]['jenis_fasyankes'] == 2 || $data[0]['jenis_fasyankes'] == 3) {
                                                                            if ($count_trans['bab'] == 1) {
                                                                                $persenbab1 = number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '');
                                                                            } else if ($count_trans['bab'] == 2) {
                                                                                $persenbab2 = number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '');
                                                                            } else if ($count_trans['bab'] == 3) {
                                                                                $persenbab3 = number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '');
                                                                            } else if ($count_trans['bab'] == 4) {
                                                                                $persenbab4 = number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '');
                                                                            } else if ($count_trans['bab'] == 5) {
                                                                                $persenbab5 = number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '');
                                                                            }
                                                                        }

                                                                        //penilaian verifikator
                                                                        if (!empty($count_trans['persentase_capaian_verifikator'])) {
                                                                            $count_row_verifikator++;

                                                                            if ($data[0]['jenis_fasyankes'] == 6 || $data[0]['jenis_fasyankes'] == 7) {
                                                                                if (number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '') >= 80) {
                                                                                    $persen80_verifikator++;
                                                                                } else if (number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '') < 80 && number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') >= 20) {
                                                                                    $persen20_verifikator++;
                                                                                } else {
                                                                                    $persen0_verifikator++;
                                                                                }
                                                                            } else if ($data[0]['jenis_fasyankes'] == 1) {
                                                                                if (number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '') >= 80) {
                                                                                    $persen80_verifikator++;
                                                                                } else {
                                                                                    $persen0_verifikator++;
                                                                                }
                                                                            } else if ($data[0]['jenis_fasyankes'] == 2 || $data[0]['jenis_fasyankes'] == 3) {
                                                                                if ($count_trans['bab'] == 1) {
                                                                                    $persenbab1_verifikator = number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '');
                                                                                } else if ($count_trans['bab'] == 2) {
                                                                                    $persenbab2_verifikator = number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '');
                                                                                } else if ($count_trans['bab'] == 3) {
                                                                                    $persenbab3_verifikator = number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '');
                                                                                } else if ($count_trans['bab'] == 4) {
                                                                                    $persenbab4_verifikator = number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '');
                                                                                } else if ($count_trans['bab'] == 5) {
                                                                                    $persenbab5_verifikator = number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '');
                                                                                }
                                                                            }
                                                                        }
                                                                    ?>
                                                                        <tr>
                                                                            <td><?= $n; ?></td>
                                                                            <td><?= $count_trans['bab'] ?></td>
                                                                            <td><?= $count_trans['skor_capaian_surveior'] ?></td>
                                                                            <td><?= $count_trans['skor_maksimal_surveior'] ?></td>
                                                                            <td><?= number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') ?></td>
                                                                            <td><?= $count_trans['skor_capaian_verifikator'] ?></td>
                                                                            <td><?= $count_trans['skor_maksimal_verifikator'] ?></td>
                                                                            <td><?= number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '') ?></td>
                                                                        </tr>

                                                                    <?php
                                                                        if (is_null($count_trans['skor_capaian_verifikator']) == 1) {
                                                                            $disabled_final = "disabled";
                                                                        }
                                                                        $n++;
                                                                    }

                                                                    if ($data[0]['jenis_fasyankes'] == 6) {
                                                                        if ($count_row == 9) {
                                                                            if ($persen80 == 9) {
                                                                                $status_rekomendasi_surveior = "Paripurna";
                                                                            } else if ($persen80 >= 7 && $persen80 < 9 && $persen0 == 0) {
                                                                                $status_rekomendasi_surveior = "Utama";
                                                                            } else if ($persen80 >= 5 && $persen80 < 7 && $persen0 == 0) {
                                                                                $status_rekomendasi_surveior = "Madya";
                                                                            } else if ($persen80 >= 3 && $persen80 < 5 && $persen0 == 0) {
                                                                                $status_rekomendasi_surveior = "Dasar";
                                                                            } else {
                                                                                $status_rekomendasi_surveior = "Tidak Terakreditasi";
                                                                            }
                                                                        } else {
                                                                            $status_rekomendasi_surveior = "Belum Selesai Dinilai";
                                                                        }

                                                                        if ($count_row_verifikator == 9) {
                                                                            if ($persen80_verifikator == 9) {
                                                                                $status_rekomendasi_verifikator = "Paripurna";
                                                                            } else if ($persen80_verifikator >= 7 && $persen80_verifikator < 9 && $persen0_verifikator == 0) {
                                                                                $status_rekomendasi_verifikator = "Utama";
                                                                            } else if ($persen80_verifikator >= 5 && $persen80_verifikator < 7 && $persen0_verifikator == 0) {
                                                                                $status_rekomendasi_verifikator = "Madya";
                                                                            } else if ($persen80_verifikator >= 3 && $persen80_verifikator < 5 && $persen0_verifikator == 0) {
                                                                                $status_rekomendasi_verifikator = "Dasar";
                                                                            } else {
                                                                                $status_rekomendasi_verifikator = "Tidak Terakreditasi";
                                                                            }
                                                                        } else {
                                                                            $status_rekomendasi_verifikator = "Belum Selesai Dinilai";
                                                                        }
                                                                    } else if ($data[0]['jenis_fasyankes'] == 7) {
                                                                        if ($count_row == 7) {
                                                                            if ($persen80 == 7) {
                                                                                $status_rekomendasi_surveior = "Paripurna";
                                                                            } else if ($persen80 >= 6 && $persen80 < 7 && $persen0 == 0) {
                                                                                $status_rekomendasi_surveior = "Utama";
                                                                            } else if ($persen80 >= 5 && $persen80 < 6 && $persen0 == 0) {
                                                                                $status_rekomendasi_surveior = "Madya";
                                                                            } else if ($persen80 >= 4 && $persen80 < 5 && $persen0 == 0) {
                                                                                $status_rekomendasi_surveior = "Dasar";
                                                                            } else {
                                                                                $status_rekomendasi_surveior = "Tidak Terakreditasi";
                                                                            }
                                                                        } else {
                                                                            $status_rekomendasi_surveior = "Belum Selesai Dinilai";
                                                                        }

                                                                        if ($count_row_verifikator == 7) {
                                                                            if ($persen80_verifikator == 7) {
                                                                                $status_rekomendasi_verifikator = "Paripurna";
                                                                            } else if ($persen80_verifikator >= 6 && $persen80_verifikator < 7 && $persen0_verifikator == 0) {
                                                                                $status_rekomendasi_verifikator = "Utama";
                                                                            } else if ($persen80_verifikator >= 5 && $persen80_verifikator < 6 && $persen0_verifikator == 0) {
                                                                                $status_rekomendasi_verifikator = "Madya";
                                                                            } else if ($persen80_verifikator >= 4 && $persen80_verifikator < 5 && $persen0_verifikator == 0) {
                                                                                $status_rekomendasi_verifikator = "Dasar";
                                                                            } else {
                                                                                $status_rekomendasi_verifikator = "Tidak Terakreditasi";
                                                                            }
                                                                        } else {
                                                                            $status_rekomendasi_verifikator = "Belum Selesai Dinilai";
                                                                        }
                                                                    } else if ($data[0]['jenis_fasyankes'] == 1) {
                                                                        if ($count_row == 2) {
                                                                            if ($persen80 == 2) {
                                                                                $status_rekomendasi_surveior = "Terakreditasi";
                                                                            } else {
                                                                                $status_rekomendasi_surveior = "Tidak Terakreditasi";
                                                                            }
                                                                        } else {
                                                                            $status_rekomendasi_surveior = "Belum Selesai Dinilai";
                                                                        }

                                                                        if ($count_row_verifikator == 2) {
                                                                            if ($persen80_verifikator == 2) {
                                                                                $status_rekomendasi_verifikator = "Terakreditasi";
                                                                            } else {
                                                                                $status_rekomendasi_verifikator = "Tidak Terakreditasi";
                                                                            }
                                                                        } else {
                                                                            $status_rekomendasi_verifikator = "Belum Selesai Dinilai";
                                                                        }
                                                                    } else if ($data[0]['jenis_fasyankes'] == 2) {
                                                                        if ($count_row == 5) {
                                                                            if ($persenbab1 >= 80 && $persenbab2 >= 80 && $persenbab3 >= 80 && $persenbab4 >= 80 && $persenbab5 >= 80) {
                                                                                $status_rekomendasi_surveior = "Paripurna";
                                                                            } else if ($persenbab1 >= 80 && $persenbab2 >= 80 && $persenbab3 >= 70 && $persenbab4 >= 80 && $persenbab5 >= 75) {
                                                                                $status_rekomendasi_surveior = "Utama";
                                                                            } else if ($persenbab1 >= 75 && $persenbab2 >= 75 && $persenbab3 >= 60 && $persenbab4 >= 75 && $persenbab5 >= 70) {
                                                                                $status_rekomendasi_surveior = "Madya";
                                                                            } else if ($persenbab1 >= 75 && $persenbab2 >= 60 && $persenbab3 >= 50 && $persenbab4 >= 60 && $persenbab5 >= 60) {
                                                                                $status_rekomendasi_surveior = "Dasar";
                                                                            } else if ($persenbab1 < 75 && $persenbab2 < 60 && $persenbab3 < 50 && $persenbab4 < 60 && $persenbab5 < 60) {
                                                                                $status_rekomendasi_surveior = "Tidak Terakreditasi";
                                                                            } else {
                                                                                $status_rekomendasi_surveior = "Tidak Terakreditasi";
                                                                            }
                                                                        } else {
                                                                            $status_rekomendasi_surveior = "Belum Selesai Dinilai";
                                                                        }

                                                                        if ($count_row_verifikator == 5) {
                                                                            if ($persenbab1_verifikator >= 80 && $persenbab2_verifikator >= 80 && $persenbab3_verifikator >= 80 && $persenbab4_verifikator >= 80 && $persenbab5_verifikator >= 80) {
                                                                                $status_rekomendasi_verifikator = "Paripurna";
                                                                            } else if ($persenbab1_verifikator >= 80 && $persenbab2_verifikator >= 80 && $persenbab3_verifikator >= 70 && $persenbab4_verifikator >= 80 && $persenbab5_verifikator >= 75) {
                                                                                $status_rekomendasi_verifikator = "Utama";
                                                                            } else if ($persenbab1_verifikator >= 75 && $persenbab2_verifikator >= 75 && $persenbab3_verifikator >= 60 && $persenbab4_verifikator >= 75 && $persenbab5_verifikator >= 70) {
                                                                                $status_rekomendasi_verifikator = "Madya";
                                                                            } else if ($persenbab1_verifikator >= 75 && $persenbab2_verifikator >= 60 && $persenbab3_verifikator >= 50 && $persenbab4_verifikator >= 60 && $persenbab5_verifikator >= 60) {
                                                                                $status_rekomendasi_verifikator = "Dasar";
                                                                            } else if ($persenbab1_verifikator < 75 && $persenbab2_verifikator < 60 && $persenbab3_verifikator < 50 && $persenbab4_verifikator < 60 && $persenbab5_verifikator < 60) {
                                                                                $status_rekomendasi_verifikator = "Tidak Terakreditasi";
                                                                            } else {
                                                                                $status_rekomendasi_verifikator = "Tidak Terakreditasi";
                                                                            }
                                                                        } else {
                                                                            $status_rekomendasi_verifikator = "Belum Selesai Dinilai";
                                                                        }
                                                                    } else if ($data[0]['jenis_fasyankes'] == 3) {
                                                                        if ($count_row == 3) {
                                                                            if ($persenbab1 >= 80 && $persenbab2 >= 80 && $persenbab3 >= 80) {
                                                                                $status_rekomendasi_surveior = "Paripurna";
                                                                            } else if ($persenbab1 >= 80 && $persenbab2 >= 60 && $persenbab3 >= 80) {
                                                                                $status_rekomendasi_surveior = "Utama";
                                                                            } else if ($persenbab1 >= 75 && $persenbab2 >= 40 && $persenbab3 >= 75) {
                                                                                $status_rekomendasi_surveior = "Madya";
                                                                            } else if ($persenbab1 < 75 && $persenbab2 < 40 && $persenbab3 < 75) {
                                                                                $status_rekomendasi_surveior = "Tidak Terakreditasi";
                                                                            } else {
                                                                                $status_rekomendasi_surveior = "Tidak Terakreditasi";
                                                                            }
                                                                        } else {
                                                                            $status_rekomendasi_surveior = "Belum Selesai Dinilai";
                                                                        }

                                                                        if ($count_row_verifikator == 3) {
                                                                            if ($persenbab1_verifikator >= 80 && $persenbab2_verifikator >= 80 && $persenbab3_verifikator >= 80) {
                                                                                $status_rekomendasi_verifikator = "Paripurna";
                                                                            } else if ($persenbab1_verifikator >= 80 && $persenbab2_verifikator >= 60 && $persenbab3_verifikator >= 80) {
                                                                                $status_rekomendasi_verifikator = "Utama";
                                                                            } else if ($persenbab1_verifikator >= 75 && $persenbab2_verifikator >= 40 && $persenbab3_verifikator >= 75) {
                                                                                $status_rekomendasi_verifikator = "Madya";
                                                                            } else if ($persenbab1_verifikator < 75 && $persenbab2_verifikator < 40 && $persenbab3_verifikator < 75) {
                                                                                $status_rekomendasi_verifikator = "Tidak Terakreditasi";
                                                                            } else {
                                                                                $status_rekomendasi_verifikator = "Tidak Terakreditasi";
                                                                            }
                                                                        } else {
                                                                            $status_rekomendasi_verifikator = "Belum Selesai Dinilai";
                                                                        }
                                                                    }
                                                                    ?>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </section>

                                        <section class="section">
                                            <div class="row">
                                                <div class="col-6 col-md-6 col-lg-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4>Hasil Penilaian Surveior</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <!-- <div class="badges">
                                                                    <span class="badge bg-primary"><?= $status_rekomendasi_surveior; ?></span>
                                                                </div> -->
                                                            <div class="alert alert-primary">
                                                                <h4 class="alert-heading"><?= $status_rekomendasi_surveior; ?></h4>
                                                                <!-- <p>This is a primary alert.</p> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-6 col-lg-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4>Hasil Penilaian Verifikator</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <!-- <div class="badges">
                                                                <span class="badge bg-primary"><?= $status_rekomendasi_verifikator; ?></span>
                                                            </div> -->
                                                            <div class="alert alert-primary">
                                                                <h4 class="alert-heading"><?= $status_rekomendasi_verifikator; ?></h4>
                                                                <!-- <p>This is a primary alert.</p> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                    </div>
                                </div>


                                <div class="tab-pane fade" id="sertifikat" role="tabpanel" aria-labelledby="sertifikat-tab">
                                    <div class="page-heading">
                                        <div class="page-title"></div>
                                        <div class="section">
                                            <div class="card">
                                                <div class="card-body">
                                                    <?php
                                                    if (isset($data[0]['tanggal_penetapan'])) {
                                                        $jadwalpenetapan = date("d-m-Y", strtotime($data[0]['tanggal_penetapan']));
                                                        $cek = date("D", strtotime($jadwalpenetapan));
                                                        // echo $cek;
                                                        $dayList = array(
                                                            'Sun' => 'Minggu',
                                                            'Mon' => 'Senin',
                                                            'Tue' => 'Selasa',
                                                            'Wed' => 'Rabu',
                                                            'Thu' => 'Kamis',
                                                            'Fri' => 'Jumat',
                                                            'Sat' => 'Sabtu'
                                                        );
                                                    }

                                                    if (isset($data[0]['tanggal_berakhir_berlaku'])) {
                                                        $tanggalberakhir = date("d-m-Y", strtotime($data[0]['tanggal_berakhir_berlaku']));
                                                        $cekberakhir = date("D", strtotime($tanggalberakhir));
                                                        // echo $cek;
                                                        $dayList = array(
                                                            'Sun' => 'Minggu',
                                                            'Mon' => 'Senin',
                                                            'Tue' => 'Selasa',
                                                            'Wed' => 'Rabu',
                                                            'Thu' => 'Kamis',
                                                            'Fri' => 'Jumat',
                                                            'Sat' => 'Sabtu'
                                                        );
                                                    }
                                                    ?>
                                                    <div class="row">
                                                        <div class="d-flex justify-content-center">
                                                            <div class="col-md-6">
                                                                <label for="tanggal_penetapan">
                                                                    <h5>Tanggal Penetapan</h5>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <h5>:</h5>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <?php
                                                                if ($data[0]['tanggal_penetapan'] != NULL) {
                                                                ?>
                                                                    <h5><?= $dayList[$cek] . ', ' . $jadwalpenetapan ?></h5>
                                                                    <!-- <input id="tanggal_penetapan" name="tanggal_penetapan" type="text" disabled value=""> -->
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <h5>-</h5>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-center py-3">
                                                            <div class="col-md-6">
                                                                <label for="tanggal_berakhir">
                                                                    <h5>Tanggal Berakhir Berlaku</h5>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <h5>:</h5>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <?php
                                                                if ($data[0]['tanggal_berakhir_berlaku'] != NULL) {
                                                                ?>
                                                                    <h5><?= $dayList[$cekberakhir] . ', ' . $tanggalberakhir ?></h5>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <h5>-</h5>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 text-center">
                                                            <?php
                                                            if ($data[0]['url_dokumen_sertifikat'] != NULL) {
                                                            ?>
                                                                <object width="800" height="900" data="<?= $data[0]['url_dokumen_sertifikat']; ?>" type="application/pdf">
                                                                    <div>No online PDF viewer installed</div>
                                                                </object>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- TAB KESEPAKATAN SURVEI -->
                                <div class="tab-pane fade" id="kesepakatan_survei" role="tabpanel" aria-labelledby="contact-tab">
                                    </br>
                                    <div class="col-md-12 mb-1">
                                        <?php
                                        if (isset($surveior_lapangan[0]['id_surveior_satu_baru'])) {
                                            $idsuveiorpengganti1 = $surveior_lapangan[0]['id_surveior_satu_baru'];
                                            // $keterangnapengganti1 = $surveior_lapangan[0]['keterangan_surveior_satu'];
                                            $keterangnapengganti1 = $surveior_lapangan[0]['keterangan_surveior_satu_id'];
                                            $namasuveiorpengganti1 = $surveior_lapangan['datasurveiorpengganti1'][0]['nama'];
                                            $provinsisurveiorpengganti1 = $surveior_lapangan['datasurveiorpengganti1'][0]['propinsi_name'];
                                        }

                                        if (isset($surveior_lapangan[0]['id_surveior_dua_baru'])) {
                                            $idsuveiorpengganti2 = $surveior_lapangan[0]['id_surveior_dua_baru'];
                                            // $keterangnapengganti2 = $surveior_lapangan[0]['keterangan_surveior_dua'];
                                            $keterangnapengganti2 = $surveior_lapangan[0]['keterangan_surveior_dua_id'];
                                            $namasuveiorpengganti2 = $surveior_lapangan['datasurveiorpengganti2'][0]['nama'];
                                            $provinsisurveiorpengganti2 = $surveior_lapangan['datasurveiorpengganti2'][0]['propinsi_name'];
                                        }
                                        ?>
                                        <?php echo form_open_multipart('Pengajuan/simpanPenetapanTanggalSurvei') ?>
                                        <form role="form" method="post" class="login-form" name="form_valdation">
                                            <p>Dokumen Kontrak <i><small class="text-muted"><a href="<?php echo base_url('assets/uploads/template/Dokumen_kontrak.docx'); ?>" target="_blank" href="">Download Contoh</a> </i></small></p>
                                            <?php
                                            if (!empty($data[0]['url_dokumen_kontrak'])) {
                                                $url_dokumen_kontrak_required = '';
                                            } else {
                                                $url_dokumen_kontrak_required = 'required';
                                            }
                                            ?>

                                            <fieldset>
                                                <div class="input-group">
                                                    <!-- Menyembunyikan field ID dan lainnya -->
                                                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $data[0]['id'] ?>">
                                                    <input type="hidden" class="form-control" id="kelengkapan_berkas_id" name="kelengkapan_berkas_id" value="<?= $data[0]['kelengkapan_berkas_id'] ?>">
                                                    <input type="hidden" class="form-control" id="penetapan_tanggal_survei_id" name="penetapan_tanggal_survei_id" value="<?= $data[0]['penetapan_tanggal_survei_id'] ?>">

                                                    <!-- Input untuk URL Dokumen Kontrak -->
                                                    <input type="text" class="form-control" id="url_dokumen_kontrak" name="url_dokumen_kontrak"
                                                        aria-describedby="inputGroupFileAddon04" aria-label="Masukkan Link Dokumen Kontrak"
                                                        placeholder="Masukkan URL Dokumen Kontrak (Google Drive)"
                                                        value="<?= isset($data[0]['url_dokumen_kontrak']) ? $data[0]['url_dokumen_kontrak'] : '' ?>" <?= $url_dokumen_kontrak_required ?>>
                                                </div>

                                                <?php
                                                // Mengecek apakah ada URL yang sudah ada (bisa berupa file atau link)
                                                if (!empty($data[0]['url_dokumen_kontrak'])) {
                                                    $url_dokumen_kontrak = $data[0]['url_dokumen_kontrak'];

                                                    // Mengecek apakah URL adalah link Google Drive
                                                    if (filter_var($url_dokumen_kontrak, FILTER_VALIDATE_URL) && strpos($url_dokumen_kontrak, 'drive.google.com') !== false) {
                                                        // Jika URL adalah Google Drive, tampilkan link ke Google Drive
                                                        echo '<a class="btn btn-primary rounded-pill" target="_blank" href="' . $url_dokumen_kontrak . '">Lihat Dokumen (Google Drive)</a>';
                                                    } else {
                                                        // Jika URL bukan Google Drive, tampilkan link umum
                                                        echo '<a class="btn btn-primary rounded-pill" target="_blank" href="' . $url_dokumen_kontrak . '">Lihat Dokumen</a>';
                                                    }
                                                } else {
                                                    $url_dokumen_kontrak = "";
                                                }
                                                ?>

                                                <!-- Menyimpan URL lama -->
                                                <input type="hidden" name="old_url_dokumen_kontrak" value="<?= $url_dokumen_kontrak ?>" id="old_url_dokumen_kontrak">
                                            </fieldset>


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

                                            <div class="col-md-6 mb-1">
                                                <p>Link Dokumen Pendukung Elemen Penilaian (EP)</p>
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

                                            <?php
                                            if ($surveior_lapangan != NULL) {
                                                $surveior_satu = $data_surveior_lapangan[0]['surveior_satu_user_id'];
                                                $surveior_dua = $data_surveior_lapangan[0]['surveior_dua_user_id'];
                                                $surveior_id_satu = $data_surveior_lapangan[0]['surveior_satu_id'];
                                                $surveior_id_dua = $data_surveior_lapangan[0]['surveior_dua_id'];
                                                $status_jabatan_satu = $data_surveior_lapangan[0]['jabatan_surveior_id_satu'];
                                                $status_jabatan_dua = $data_surveior_lapangan[0]['jabatan_surveior_id_dua'];
                                            ?>
                                                <input type="text" name="surveior_satu" value="<?= $surveior_satu ?>" id="surveior_satu" hidden>
                                                <input type="text" name="status_surveior_satu" value="1" id="status_surveior_satu" hidden>
                                                <input type="text" name="id_surveior_satu" id="id_surveior_satu" value="<?php echo $surveior_id_satu ?>" hidden>
                                                <input type="text" name="surveior_dua" value="<?= $surveior_dua ?>" id="surveior_dua" hidden>
                                                <input type="text" name="status_surveior_dua" value="2" id="status_surveior_dua" hidden>
                                                <input type="text" name="id_surveior_dua" id="id_surveior_dua" value="<?php echo $surveior_id_dua ?>" hidden>
                                                <input type="text" name="id_surveior_lapangan" id="id_surveior_lapangan" value="<?php echo $surveior_lapangan[0]['id'] ?>" hidden>
                                                <?php
                                                if ($surveior_lapangan[0]['id_surveior_satu_lama'] == $surveior_lapangan[0]['id_surveior_satu_baru']) {
                                                    // CODE TIDAK ADA PENGGANTI
                                                ?>
                                                    <div class="form-group col-md-12">
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label for="helperText">Nama Surveior 1</label>
                                                                <?php
                                                                if ($status_jabatan_satu == '1') {
                                                                ?>
                                                                    <input class="form-check-input" onclick="//check(this.value)" type="radio" value="jabatansurveior1" name="jabatan" id="jabatansurveior1" checked disabled>
                                                                    <label class="form-check-label" id="labeljabatan1" for="jabatansurveior1">
                                                                        Ketua
                                                                    </label>
                                                                <?php
                                                                } else if ($status_jabatan_satu == '2') {
                                                                ?>
                                                                    <input class="form-check-input" onclick="//check(this.value)" type="radio" value="jabatansurveior1" name="jabatan" id="jabatansurveior1" disabled>
                                                                    <label class="form-check-label" id="labeljabatan1" for="jabatansurveior1">
                                                                        Anggota
                                                                    </label>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <input class="form-check-input" onclick="//check(this.value)" type="radio" value="jabatansurveior1" name="jabatan" id="jabatansurveior1" checked>
                                                                    <label class="form-check-label" id="labeljabatan1" for="jabatansurveior1">
                                                                        Ketua
                                                                    </label>
                                                                <?php
                                                                }
                                                                ?>
                                                                <select class="form-select" name="surveior_satu1" id="surveior_satu1" disabled>
                                                                    <option value=""><?php echo $data_surveior_lapangan[0]['surveior_satu_lama'] ?></option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="checkbox" name="approvements1" id="approvements1" onclick="findsurveriorpengganti1(<?php echo $surveior_satu ?>)">
                                                                <label for="approvements1">Tidak Bersedia</label>
                                                            </div>
                                                            <div class="col-md-4 hideform" id="formpengganti1">
                                                                <label for="penggantis1">Nama Surveior Pengganti</label>
                                                                <select name="penggantis1" id="penggantis1" class="form-select">
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 hideform" id="formpenggantitext1">
                                                                <label for="keterangan1">Keterangan</label>
                                                                <select name="keterangan1" id="keterangan1" class="form-select">
                                                                </select>
                                                                <!-- <textarea name="keterangansatu" id="keterangansatu" cols="20" rows="2"></textarea> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                } else {
                                                    // CODE ADA PENGGANTI
                                                ?>
                                                    <div class="form-group col-md-12">
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label for="helperText">Nama Surveior 1</label>
                                                                <?php
                                                                if ($status_jabatan_satu == '1') {
                                                                ?>
                                                                    <input class="form-check-input" onclick="//check(this.value)" type="radio" value="jabatansurveior1" name="jabatan" id="jabatansurveior1" checked disabled>
                                                                    <label class="form-check-label" id="labeljabatan1" for="jabatansurveior1">
                                                                        Ketua
                                                                    </label>
                                                                <?php
                                                                } else if ($status_jabatan_satu == '2') {
                                                                ?>
                                                                    <input class="form-check-input" onclick="//check(this.value)" type="radio" value="jabatansurveior1" name="jabatan" id="jabatansurveior1" disabled>
                                                                    <label class="form-check-label" id="labeljabatan1" for="jabatansurveior1">
                                                                        Anggota
                                                                    </label>
                                                                <?php
                                                                }
                                                                ?>
                                                                <select class="form-select" name="surveior_satu1" id="surveior_satu1" disabled>
                                                                    <option value=""><?php echo $data_surveior_lapangan[0]['surveior_satu_lama'] ?></option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="checkbox" checked name="approvements1" id="approvements1" disabled>
                                                                <label for="approvements1">Tidak Bersedia</label>
                                                            </div>
                                                            <div class="col-md-4" id="formpengganti1">
                                                                <label for="penggantis1">Nama Surveior Pengganti</label>
                                                                <select class="form-select" disabled>
                                                                    <option><?php echo $namasuveiorpengganti1 . ' - ' . $provinsisurveiorpengganti1 ?></option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3" id="formpenggantitext1">
                                                                <label for="keterangansatu">Keterangan</label>
                                                                <!-- <textarea class="form-control" cols="20" disabled rows="2"><?php //echo $keterangnapengganti1 
                                                                                                                                ?></textarea> -->
                                                                <?= form_dropdown('keterangan1', dropdown_sina_keterangan_pengganti($keterangnapengganti1), $keterangnapengganti1, 'id="keterangan1"  class="form-select" disabled'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                if ($surveior_lapangan[0]['id_surveior_dua_lama'] == $surveior_lapangan[0]['id_surveior_dua_baru']) {
                                                    // CODE TIDAK ADA PENGGANTI
                                                ?>
                                                    <div class="form-group col-md-12">
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label for="helperText">Nama Surveior 2</label>
                                                                <?php
                                                                if ($status_jabatan_dua == '1') {
                                                                ?>
                                                                    <input class="form-check-input" onclick="//check(this.value)" type="radio" value="jabatansurveior2" name="jabatan" id="jabatansurveior2" checked disabled>
                                                                    <label class="form-check-label" id="labeljabatan2" for="jabatansurveior2">
                                                                        Ketua
                                                                    </label>
                                                                <?php
                                                                } else if ($status_jabatan_dua == '2') {
                                                                ?>
                                                                    <input class="form-check-input" onclick="//check(this.value)" type="radio" value="jabatansurveior2" name="jabatan" id="jabatansurveior2" disabled>
                                                                    <label class="form-check-label" id="labeljabatan2" for="jabatansurveior2">
                                                                        Anggota
                                                                    </label>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <input class="form-check-input" onclick="//check(this.value)" type="radio" value="jabatansurveior2" name="jabatan" id="jabatansurveior2">
                                                                    <label class="form-check-label" id="labeljabatan2" for="jabatansurveior2">
                                                                        Ketua
                                                                    </label>
                                                                <?php
                                                                }
                                                                ?>
                                                                <select class="form-select" name="surveior_dua2" id="surveior_dua2" disabled>
                                                                    <option value=""><?php echo $data_surveior_lapangan[0]['surveior_dua_lama'] ?></option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="checkbox" name="approvements2" id="approvements2" onclick="findsurveriorpengganti2(<?php echo $surveior_dua ?>)">
                                                                <label for="approvements2">Tidak Bersedia</label>
                                                            </div>
                                                            <div class="col-md-4 hideform" id="formpengganti2">
                                                                <label for="penggantis2">Nama Surveior Pengganti</label>
                                                                <select name="penggantis2" id="penggantis2" class="form-select">
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 hideform" id="formpenggantitext2">
                                                                <label for="keterangan2">Keterangan</label>
                                                                <select name="keterangan2" id="keterangan2" class="form-select">
                                                                </select>
                                                                <!-- <textarea class="form-control" name="keterangandua" id="keterangandua" cols="20" rows="2"></textarea> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                } else {
                                                    // CODE ADA PENGGANTI
                                                ?>
                                                    <div class="form-group col-md-12">
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label for="helperText">Nama Surveior 2</label>
                                                                <?php
                                                                if ($status_jabatan_dua == '1') {
                                                                ?>
                                                                    <input class="form-check-input" onclick="//check(this.value)" type="radio" value="jabatansurveior2" name="jabatan" id="jabatansurveior2" checked disabled>
                                                                    <label class="form-check-label" id="labeljabatan2" for="jabatansurveior2">
                                                                        Ketua
                                                                    </label>
                                                                <?php
                                                                } else if ($status_jabatan_dua == '2') {
                                                                ?>
                                                                    <input class="form-check-input" onclick="//check(this.value)" type="radio" value="jabatansurveior2" name="jabatan" id="jabatansurveior2" disabled>
                                                                    <label class="form-check-label" id="labeljabatan2" for="jabatansurveior2">
                                                                        Anggota
                                                                    </label>
                                                                <?php
                                                                }
                                                                ?>
                                                                <select class="form-select" name="surveior_dua2" id="surveior_dua2" disabled>
                                                                    <option value=""><?php echo $data_surveior_lapangan[0]['surveior_dua_lama'] ?></option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="checkbox" checked name="approvements2" id="approvements2" disabled>
                                                                <label for="approvements2">Tidak Bersedia</label>
                                                            </div>
                                                            <div class="col-md-4" id="formpengganti2">
                                                                <label for="penggantis2">Nama Surveior Pengganti</label>
                                                                <select class="form-select" disabled>
                                                                    <option><?php echo $namasuveiorpengganti2 . ' - ' . $provinsisurveiorpengganti2 ?></option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3" id="formpenggantitext2">
                                                                <label for="keterangandua">Keterangan</label>
                                                                <!-- <textarea class="form-control" cols="20" disabled rows="2"><?php //echo $keterangnapengganti2 
                                                                                                                                ?></textarea> -->
                                                                <?= form_dropdown('keterangan2', dropdown_sina_keterangan_pengganti($keterangnapengganti2), $keterangnapengganti2, 'id="keterangan2"  class="form-select" disabled'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                            } else {
                                                if ($data[0]['jenis_survei_id'] == 1) {
                                                    $surveior_satu = $surveior[0]['users_id'];
                                                    $surveior_dua = $surveior[1]['users_id'];
                                                    $surveior_id_satu = $surveior[0]['user_surveior_id'];
                                                    $surveior_id_dua = $surveior[1]['user_surveior_id'];
                                                } else if ($data[0]['jenis_survei_id'] == 2) {
                                                    $surveior_satu = $data_lama[0]['surveior_satu'];
                                                    $surveior_dua = $data_lama[0]['surveior_dua'];
                                                }

                                                // print_r($lpa_id);
                                                // print_r($surveior_id_satu);
                                                // echo '|';
                                                // print_r($surveior_satu);
                                                // echo '|';

                                                // print_r($surveior_id_dua);
                                                // echo '|';
                                                // print_r($surveior_dua);
                                                ?>
                                                <input type="text" name="surveior_satu" value="<?= $surveior_satu ?>" id="surveior_satu" hidden>
                                                <input type="text" name="status_surveior_satu" value="1" id="status_surveior_satu" hidden>
                                                <input type="text" name="id_surveior_satu" id="id_surveior_satu" value="<?php echo $surveior_id_satu ?>" hidden>
                                                <input type="text" name="surveior_dua" value="<?= $surveior_dua ?>" id="surveior_dua" hidden>
                                                <input type="text" name="status_surveior_dua" value="2" id="status_surveior_dua" hidden>
                                                <input type="text" name="id_surveior_dua" id="id_surveior_dua" value="<?php echo $surveior_id_dua ?>" hidden>
                                                <div class="form-group col-md-12">
                                                    <div class="row">
                                                        <div class="form-group col-md-3">
                                                            <label for="helperText">Nama Surveior 1</label>
                                                            <input class="form-check-input" onclick="//check(this.value)" type="radio" value="jabatansurveior1" name="jabatan" id="jabatansurveior1" checked>
                                                            <label class="form-check-label" id="labeljabatan1" for="jabatansurveior1">
                                                                Ketua
                                                            </label>
                                                            <? //= form_dropdown('surveior_satu1', dropdown_sina_surveior($lpa_id), $surveior_satu, 'id="surveior_satu1"  class="form-select" disabled'); 
                                                            ?>
                                                            <?= form_dropdown('surveior_satu1', dropdown_sina_surveior_new($surveior_id_satu), $surveior_id_satu, 'id="surveior_satu1"  class="form-select" disabled'); ?>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="checkbox" name="approvements1" id="approvements1" onclick="findsurveriorpengganti1(<?php echo $surveior_satu ?>)">
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
                                                            <!-- <textarea class="form-control" name="keterangansatu" id="keterangansatu" cols="20" rows="2"></textarea> -->
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
                                                            <? //= form_dropdown('surveior_dua2', dropdown_sina_surveior($lpa_id), $surveior_dua, 'id="surveior_dua2"  class="form-select" disabled'); 
                                                            ?>
                                                            <?= form_dropdown('surveior_dua2', dropdown_sina_surveior_new($surveior_id_dua), $surveior_id_dua, 'id="surveior_dua2"  class="form-select" disabled'); ?>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="checkbox" name="approvements2" id="approvements2" onclick="findsurveriorpengganti2(<?php echo $surveior_dua ?>)">
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
                                                            <!-- <textarea class="form-control" name="keterangandua" id="keterangandua" cols="20" rows="2"></textarea> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                            <?php
                                            if (!empty($data[0]['url_surat_tugas'])) {
                                                $url_surat_tugas_required = '';
                                            } else {
                                                $url_surat_tugas_required = 'required';
                                            }
                                            ?>

                                            <div class="form-group col-md-12">
                                                <div class="form-group col-md-6">
                                                    <label for="helperText">Surat Tugas</label>
                                                    <div class="input-group">
                                                        <!-- Input untuk URL Surat Tugas -->
                                                        <input type="text" class="form-control" id="url_surat_tugas" name="url_surat_tugas"
                                                            aria-describedby="inputGroupFileAddon04" aria-label="Masukkan Link Surat Tugas"
                                                            placeholder="Masukkan URL Surat Tugas (Google Drive)"
                                                            value="<?= isset($data[0]['url_surat_tugas']) ? $data[0]['url_surat_tugas'] : '' ?>" <?= $url_surat_tugas_required ?>>
                                                    </div>

                                                    <?php
                                                    // Mengecek apakah ada URL yang sudah ada (bisa berupa file atau link)
                                                    if (!empty($data[0]['url_surat_tugas'])) {
                                                        $url_surat_tugas = $data[0]['url_surat_tugas'];

                                                        // Mengecek apakah URL adalah link Google Drive
                                                        if (filter_var($url_surat_tugas, FILTER_VALIDATE_URL) && strpos($url_surat_tugas, 'drive.google.com') !== false) {
                                                            // Jika URL adalah Google Drive, tampilkan link ke Google Drive
                                                            echo '<a class="btn btn-primary rounded-pill" target="_blank" href="' . $url_surat_tugas . '">Lihat Dokumen (Google Drive)</a>';
                                                        } else {
                                                            // Jika URL bukan Google Drive, tampilkan link umum
                                                            echo '<a class="btn btn-primary rounded-pill" target="_blank" href="' . $url_surat_tugas . '">Lihat Dokumen</a>';
                                                        }
                                                    } else {
                                                        $url_surat_tugas = "";
                                                    }
                                                    ?>

                                                    <!-- Menyimpan URL lama -->
                                                    <input type="hidden" name="old_url_surat_tugas" value="<?= $url_surat_tugas ?>" id="old_url_surat_tugas">
                                                </div>
                                            </div>


                                            <!-- <button type="submit" class="btn btn-primary rounded-pill">Submit</button> -->
                                        </form>
                                    </div>
                                </div>
                                <!-- TAB KESEPAKATAN SURVEI -->


                                <div class="tab-pane fade" id="persetujuan" role="tabpanel" aria-labelledby="persetujuan-tab">
                                    <div class="page-heading">
                                        <div class="page-title"></div>
                                        <div class="section">
                                            <div class="card">
                                                <div class="card-header"></div>
                                                <div class="form-group row align-items-center">
                                                    <?php echo form_open_multipart('ketua/simpanPersetujuan/') ?>
                                                    <form role="form" method="post" class="login-form" name="form_valdation">
                                                        <div class="row">
                                                            <div class="col-lg-4 col-4">
                                                                <label class="col-form-label">Kode Fasyankes : <?= $data[0]['fasyankes_id']; ?> </label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <label class="col-form-label"> </label>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-4 col-4">
                                                        <label class="col-form-label">Jenis Fasyankes : <?= $jenis_fasyankes; ?></label>
                                                    </div>
                                                    <div class="col-lg-10 col-9">
                                                        <label class="col-form-label"> </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <section class="section">
                                            <div class="row">
                                                <div class="col-4 col-md-4 col-lg-4">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4>Hasil Penilaian Surveior</h4>
                                                        </div>
                                                        <div class="card-body">

                                                            <div class="alert alert-primary">
                                                                <?= $status_rekomendasi_surveior; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4 col-md-4 col-lg-4">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4>Hasil Penilaian Verifikator</h4>
                                                        </div>
                                                        <div class="card-body">

                                                            <div class="alert alert-primary">
                                                                <?= $status_rekomendasi_verifikator; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4 col-md-4 col-lg-4">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4>Rekomendasi Ketua LPA</h4>
                                                        </div>
                                                        <div class="card-body">

                                                            <div class="alert alert-primary">
                                                                <div class="form-group" style='display:block;'>
                                                                    <label for="disabledInput">Rekomendasi Status </label>

                                                                    <!-- <input type="date" class="form-control" id="disabledInput" placeholder="Disabled Text"> -->
                                                                    <?= form_dropdown('status_rekomendasi_id', dropdown_sina_status_rekomendasi($data[0]['jenis_fasyankes']), $data[0]['status_rekomendasi_id'], 'id="status_rekomendasi_id"  class="form-select" required disabled'); ?>
                                                                </div>
                                                                <input type="hidden" name="pengiriman_rekomendasi_id" value="<?= $data[0]['pengiriman_rekomendasi_id'] ?>" id="pengiriman_rekomendasi_id">
                                                                <input type="hidden" name="status_rekomendasi_id" value="<?= $data[0]['status_rekomendasi_id'] ?>" id="status_rekomendasi_id">

                                                                <div class="form-group" style='display:block;'>
                                                                    <label for="disabledInput">Surat Rekomendasi Status</label>
                                                                    <fieldset>
                                                                        <?php
                                                                        if (!empty($data[0]['url_surat_rekomendasi_status'])) {
                                                                            $url_surat_rekomendasi_status = $data[0]['url_surat_rekomendasi_status'];
                                                                        ?>
                                                                            <a class="btn btn-success rounded-pill" target="_blank" href="<?php echo $url_surat_rekomendasi_status; ?>">Lihat Dokumen</a>
                                                                        <?php
                                                                        } else {
                                                                            $url_surat_rekomendasi_status = "";
                                                                        }
                                                                        ?>

                                                                        <input type="hidden" name="old_url_surat_rekomendasi_status" value="<?= $url_surat_rekomendasi_status ?>" id="old_url_surat_rekomendasi_status">
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <section class="section">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="alert alert-primary col-4 col-md-4 col-lg-4">
                                                        <label for="helperText">Catatan Ketua Tim Kerja</label>
                                                    </div>
                                                    <?php
                                                    // var_dump($data[0]);
                                                    if (!empty($data[0]['catatan_ketua'])) {
                                                        //$catatan_ketua = $data[0]['catatan_ketua'];
                                                    ?>
                                                        <textarea type="text" id="catatan_ketua" name="catatan_ketua" class="form-control" style="display;" required><?= $data[0]['catatan_ketua']; ?></textarea>
                                                    <?php
                                                    } else { ?>
                                                        <textarea type="text" id="catatan_ketua" name="catatan_ketua" class="form-control" style="display;" required></textarea>
                                                    <?php }
                                                    ?>

                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-4 col-md-4 col-lg-4">
                                                        <div class="alert alert-primary ">
                                                            <?php
                                                            if ((!empty($data[0]['status_persetujuan'])) && $data[0]['status_persetujuan'] == 1) {
                                                            ?>
                                                                <input type="radio" id="terima" name="status_persetujuan" value="1" required checked><label for="helperText">Setuju Terakreditasi</label>
                                                            <?php
                                                            } else { ?>
                                                                <input type="radio" id="terima" name="status_persetujuan" value="1" required><label for="helperText">Setuju Terakreditasi</label>
                                                            <?php }
                                                            ?>
                                                        </div>

                                                    </div>

                                                    <div class="form-group col-4 col-md-4 col-lg-4">

                                                        <div class="alert alert-primary ">
                                                            <?php
                                                            if ((!empty($data[0]['status_persetujuan'])) && $data[0]['status_persetujuan'] == 2) {
                                                            ?>
                                                                <input type="radio" id="tolak" name="status_persetujuan" value="2" required checked><label for="helperText">Setuju Tidak Terakreditasi</label>
                                                            <?php
                                                            } else { ?>
                                                                <input type="radio" id="tolak" name="status_persetujuan" value="2" required><label for="helperText">Setuju Tidak Terakreditasi</label>
                                                            <?php }
                                                            ?>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- <input type="hidden" name="trans_final_ep_verifikator_id" value="<?= $data[0]['trans_final_ep_verifikator_id']; ?>"> -->
                                                <input type="hidden" name="id_pengajuan" value="<?= $id; ?>">
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </section>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Modal -->
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
    <!-- Modal -->
    <div class="modal fade" id="inmModal" tabindex="-1" aria-labelledby="inmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
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
                                <th>KKT</th>
                                <th>APD</th>
                                <th>Identifikasi</th>
                                <th>Obat</th>
                                <th>ANC</th>
                                <th>Kepuasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="8">sedang mengambil data...</td>
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
    <!-- Modal -->
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

    <script src="<?php echo base_url() ?>assets/js/app.js">

    </script>

</body>

</html>

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
    $(function() {
        $("#datepicker").datepicker();
        $("#datepickerstr").datepicker();
        $("#tanggal_survei").datepicker();

    });

    async function getDataIKP() {
        $("#ikpModal").modal('show')
        try {
            const response = await fetch('<?= base_url(sprintf('pengajuan/getIkp?id=%s&nama=%s', $data[0]['fasyankes_id'], $data[0]['jenis_fasyankes_nama'])) ?>', {
                method: 'GET',
            });
            const data = await response.json();
            let rows = ''

            data.map(item => {
                rows += `<tr><td>${sanitizeString(item.nama)}</td><td>${sanitizeString(item.tahun)}</td><td>${sanitizeString(item.jenis)}</td></tr>`
            })
            $("#ikpModal tbody").empty().append(rows)
        } catch (e) {
            console.log(e)
            alert('Terjadi kesalahan.')
        }
    }

    async function getDataINM() {
        $("#inmModal").modal('show')
        try {
            const response = await fetch('<?= base_url(sprintf('pengajuan/getInm?id=%s&nama=%s', $data[0]['fasyankes_id'], $data[0]['jenis_fasyankes_nama'])) ?>', {
                method: 'GET',
            });
            const data = await response.json();
            let rows = ''

            data.map(item => {
                rows += `<tr>
                    <td>${sanitizeString(item.bulan)}</td>
                    <td>${sanitizeString(item.tahun)}</td>
                    <td>${sanitizeString(item.kkt)}</td>
                    <td>${sanitizeString(item.apd)}</td>
                    <td>${sanitizeString(item.identifikasi)}</td>
                    <td>${sanitizeString(item.obat)}</td>
                    <td>${sanitizeString(item.anc)}</td>
                    <td>${sanitizeString(item.kepuasan)}</td>
                </tr>`
            })
            $("#inmModal tbody").empty().append(rows)
        } catch (e) {
            console.log(e)
            alert('Terjadi kesalahan.')
        }
    }

    async function getDataASPAK() {
        $("#aspakModal").modal('show')

        try {
            let rows = ''
            const response = await fetch('<?= base_url(sprintf('pengajuan/getAspakId?code=%s', $puskesmas->KODE_LAMA)) ?>', {
                method: 'GET',
            });
            const puskesmas = await response.json();
            const id = puskesmas?.data[0]?.id

            const getResumeAlat = await fetch(`<?= base_url('pengajuan/getAspakResume') ?>?id=${id}&action=resumealat`, {
                method: 'GET',
            })
            const getResumeAlatResponse = await getResumeAlat.json()
            rows += `<tr>
                    <td>Resume Alat</td>
                    <td>${sanitizeString(getResumeAlatResponse['persen alat'], true)}</td>
                </tr>`

            const getResumeSarana = await fetch(`<?= base_url('pengajuan/getAspakResume') ?>?id=${id}&action=resumesarana`, {
                method: 'GET',
            })
            const getResumeSaranaResponse = await getResumeSarana.json()
            rows += `<tr>
                    <td>Resume Sarana</td>
                    <td>${sanitizeString(getResumeSaranaResponse['persen sarana'], true)}</td>
                </tr>`

            const getResumePrasarana = await fetch(`<?= base_url('pengajuan/getAspakResume') ?>?id=${id}&action=resumeprasarana`, {
                method: 'GET',
            })
            const getResumePrasaranaResponse = await getResumePrasarana.json()
            rows += `<tr>
                    <td>Resume Prasarana</td>
                    <td>${sanitizeString(getResumePrasaranaResponse['persen prasarana'], true)}</td>
                </tr>`

            const getResumeSpa = await fetch(`<?= base_url('pengajuan/getAspakResume') ?>?id=${id}&action=resumespa`, {
                method: 'GET',
            })
            const getResumeSpaResponse = await getResumeSpa.json()
            rows += `<tr>
                    <td>Resume SPA</td>
                    <td>${sanitizeString(getResumeSpaResponse['persen spa'], true)}</td>
                </tr>`

            const getResumeUpdateAlat = await fetch(`<?= base_url('pengajuan/getAspakResume') ?>?id=${id}&action=updatealat`, {
                method: 'GET',
            })
            const getResumeUpdateAlatResponse = await getResumeUpdateAlat.json()
            rows += `<tr>
                    <td>Update Alat</td>
                    <td>${sanitizeString(getResumeUpdateAlatResponse['update alat'], true)}</td>
                </tr>`

            $("#aspakModal tbody").empty().append(rows)
        } catch (e) {
            console.log(e)
            alert('Terjadi kesalahan.')
        }
    }

    function sanitizeString(value, withPercent = false) {
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
    // $('#surveior_satu').on('change', function(e) {
    //     $tes=$(this).val();
    //    // alert($tes);
    //     $.ajax({
    //     url : "<?php echo base_url('/detailsurveior'); ?>"
    //     type : "POST",
    //     dataType : "json",
    //     data : {"account" : account, "passwd" : passwd},
    //     success : function(data) {
    //         // do something
    //     },
    //     error : function(data) {
    //         // do something
    //     }
    // });
    // });
</script>

<script>
    $(document).ready(function() {
        var nilai = $('#test').val(); //alert(nilai);
        if (nilai == 1) {
            $('#table1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'csv'
                ]
            });
        } else {
            $('#table1').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'csv'
                ]
            });
        }

        $('#table2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'csv'
            ]
        });

        $('#table3').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'csv'
            ]
        });

    })
</script>