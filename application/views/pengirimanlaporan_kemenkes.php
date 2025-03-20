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
    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/css/jquery.dataTables.min.css">
    <script src="<?php echo base_url('assets/temp'); ?>/jquery-3.6.0.js"></script>

</head>

<style>
    .tabcontentfont {
        font-size: 13px;
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
            <?= $this->session->flashdata('message_name'); ?>
        </div>
    <?php
    }

    if ($datab != NULL) {
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
        <!-- <div class="container"> -->
        <div class="row">
            <div class="col-md-12">
                <!-- <div class="card">
                    <div class="card-body">
                        <div class="flex">
                            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">

                                <?php if ($this->session->userdata('kriteria_id') == 5) {
                                ?>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link tabcontentfont" id="penugasan-tab" data-bs-toggle="tab" href="#penugasan" role="tab" aria-controls="penugasan" aria-selected="false">Penugasan Verifikator</a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link tabcontentfont <?= $pengiriman_laporan ?>" id="pengajuan_usulan-tab" data-bs-toggle="tab" href="#pengajuan_usulan" role="tab" aria-controls="pengajuan_usulan" aria-selected="false">Pengajuan Usulan Survei</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link tabcontentfont" id="kesiapan_survei-tab" data-bs-toggle="tab" href="#kesiapan_survei" role="tab" aria-controls="kesiapan_survei" aria-selected="false">Kesiapan Survei</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link tabcontentfont" id="pengiriman_laporan-tab" data-bs-toggle="tab" href="#pengiriman_laporan" role="tab" aria-controls="pengiriman_laporan" aria-selected="false">Pengiriman Laporan Survei</a>
                                    </li>
                                <?php
                                }
                                ?>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link tabcontentfont <?= $element ?>" id="elemenpenilaian-tab" data-bs-toggle="tab" href="#elemenpenilaian" role="tab" aria-controls="elemenpenilaian" aria-selected="false">EP Verifikator</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link tabcontentfont" id="presentasecapaian-tab" data-bs-toggle="tab" href="#presentasecapaian" role="tab" aria-controls="presentasecapaian" aria-selected="false">Capaian Verifikator (%)</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link tabcontentfont" id="rekomendasistatus-tab" data-bs-toggle="tab" href="#rekomendasistatus" role="tab" aria-controls="rekomendasistatus" aria-selected="false">Rekomendasi Status</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link tabcontentfont" id="sertifikat-tab" data-bs-toggle="tab" href="#sertifikat" role="tab" aria-controls="sertifikat" aria-selected="false">Penerbitan Sertifikat</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <div class="flex">
                                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">

                                    <?php if ($this->session->userdata('kriteria_id') == 5) {
                                    ?>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link tabcontentfont" id="penugasan-tab" data-bs-toggle="tab" href="#penugasan" role="tab" aria-controls="penugasan" aria-selected="false">Penugasan Verifikator</a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link tabcontentfont <?= $pengiriman_laporan ?>" id="pengajuan_usulan-tab" data-bs-toggle="tab" href="#pengajuan_usulan" role="tab" aria-controls="pengajuan_usulan" aria-selected="false">Pengajuan Usulan Survei</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link tabcontentfont" id="kesiapan_survei-tab" data-bs-toggle="tab" href="#kesiapan_survei" role="tab" aria-controls="kesiapan_survei" aria-selected="false">Kesiapan Survei</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link tabcontentfont" id="pengiriman_laporan-tab" data-bs-toggle="tab" href="#pengiriman_laporan" role="tab" aria-controls="pengiriman_laporan" aria-selected="false">Pengiriman Laporan Survei</a>
                                        </li>
                                    <?php
                                    }
                                    ?>

                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link tabcontentfont <?= $element ?>" id="elemenpenilaian-tab" data-bs-toggle="tab" href="#elemenpenilaian" role="tab" aria-controls="elemenpenilaian" aria-selected="false">EP Verifikator</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link tabcontentfont" id="presentasecapaian-tab" data-bs-toggle="tab" href="#presentasecapaian" role="tab" aria-controls="presentasecapaian" aria-selected="false">Capaian Verifikator (%)</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link tabcontentfont" id="rekomendasistatus-tab" data-bs-toggle="tab" href="#rekomendasistatus" role="tab" aria-controls="rekomendasistatus" aria-selected="false">Rekomendasi Status</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link tabcontentfont" id="sertifikat-tab" data-bs-toggle="tab" href="#sertifikat" role="tab" aria-controls="sertifikat" aria-selected="false">Penerbitan Sertifikat</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content" id="myTabContent">

                                <?php if ($this->session->userdata('kriteria_id') == 5) {
                                ?>
                                    <div class="tab-pane fade" id="penugasan" role="tabpanel" aria-labelledby="penugasan-tab">
                                        <div class="page-heading">
                                            <div class="page-title">
                                            </div>
                                            <section class="section">
                                                <div class="card">
                                                    <div class="card-body"></div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                <?php } else {
                                ?>

                                    <div class="tab-pane fade <?= $pengiriman_laporan_tab ?>" id="pengajuan_usulan" role="tabpanel" aria-labelledby="pengajuan_usulan-tab">
                                        <div class="page-heading">
                                            <div class="page-title"></div>
                                        </div>
                                        <section class="section">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="fasyankes_id">Kode Fasyankes</label>
                                                                <input type="text" class="form-control" id="fasyankes_id" name="fasyankes_id" placeholder="Kode Fasyankes" value="<?= $data[0]['fasyankes_id']; ?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="jenis_fasyankes">Jenis Fasyankes</label>
                                                                <input class="form-control" id="jenis_fasyankes" name="jenis_fasyankes" value="<?= $data[0]['jenis_fasyankes_nama'] ?>" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama_lpa">Nama LPA</label>
                                                                <input class="form-control" id="nama_lpa" name="nama_lpa" value="<?= $data[0]['lpa'] ?>" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="jenis_survei">Jenis Survei</label>
                                                                <input class="form-control" id="jenis_survei" name="jenis_survei" value="<?= $data[0]['jenis_survei'] ?>" disabled>
                                                            </div>
                                                            <div class="form-group" id='jenis_akreditasi'>
                                                                <label for="jenis_akreditasi">Jenis Akreditasi</label>
                                                                <input class="form-control" id="jenis_akreditasi" name="jenis_akreditasi" value="<?= $data[0]['jenis_akreditasi'] ?>" disabled>
                                                            </div>
                                                            <div class="form-group status" id='status'>
                                                                <label for="status_akreditasi_sebelumnya">Status Akreditasi Sebelumnya</label>
                                                                <input class="form-control" id="status_akreditasi_sebelumnya" name="status_akreditasi_sebelumnya" value="<?= $data[0]['status_akreditasi'] ?>" disabled>
                                                            </div>
                                                            <div class="form-group sebelum" id='sebelum'>
                                                                <div class="row">
                                                                    <div class="col-md-9">
                                                                        <label for="disabledInput">Sertifikat Akreditasi Sebelumnya / Surat Penetapan</label>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <?php
                                                                        if ($data[0]['url_sertifikasi_akreditasi_sebelumnya'] == NULL) {
                                                                        ?>
                                                                            <input type="text" id="" name="" disabled value="Dokumen Belum diupload">
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo $data[0]['url_sertifikasi_akreditasi_sebelumnya']; ?>">Lihat Dokumen</a>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group akhir" id='akhir'>
                                                                <label for="tanggal_akhir_sertifikat">Tanggal Akhir Sertifikat</label>
                                                                <input class="form-control" id="tanggal_akhir_sertifikat" name="tanggal_akhir_sertifikat" value="<?= $data[0]['tanggal_akhir_sertifikat'] ?>" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tanggal_awal_rencana_survei">Tanggal Rencana Survei</label>
                                                                <div class="row">
                                                                    <?php
                                                                    foreach ($data_detail as $key => $value) {
                                                                        // echo $value['tanggal_survei'];
                                                                    ?>
                                                                        <div class="col-md-4">
                                                                            <input type="date" name="" id="" class="form-control" value="<?= $value['tanggal_survei'] ?>" class="form-control datepicker" autocomplete="off" disabled>
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <!-- <div class="col-md-4">
                                                                        <input type="date" name="tanggal_awal_rencana_survei" id="tanggal_awal_rencana_survei" class="form-control" value="<?= $data[0]['tanggal_awal_rencana_survei'] ?>" class="form-control datepicker" autocomplete="off" disabled>
                                                                    </div>
                                                                    s.d.
                                                                    <div class="col-md-4">
                                                                        <input type="date" name="tanggal_akhir_rencana_survei" id="tanggal_akhir_rencana_survei" class="form-control" value="<?= $data[0]['tanggal_akhir_rencana_survei'] ?>" class="form-control datepicker" autocomplete="off" disabled>
                                                                    </div> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>

                                    <div class="tab-pane fade" id="kesiapan_survei" role="tabpanel" aria-labelledby="kesiapan_survei-tab">
                                        <div class="page-heading">
                                            <div class="page-title"></div>
                                        </div>
                                        <section class="section">
                                            <div class="card">
                                                <div class="card-body">
                                                    <table class="table table-striped" id="table_kesiapan">

                                                        <tbody>

                                                            <tr>
                                                                <td>
                                                                    Surat Permohonan Fasyankes untuk dilakukan survei
                                                                </td>

                                                                <?php if ($data[0]['url_surat_permohonan_survei'] != NULL) {
                                                                ?>
                                                                    <td>
                                                                        <a href="<?= $data[0]['url_surat_permohonan_survei']; ?>" target="_blank" class="btn btn-primary rounded-pill">View File</a>
                                                                    </td>
                                                                <?php
                                                                } else { ?>
                                                                    <td>Belum Mengupload Data</td>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                            <tr>
                                                                <td>Laporan Hasil Penilaian Mandiri</td>

                                                                <?php
                                                                if ($data[0]['url_laporan_hasil_penilaian_mandiri'] != NULL) {
                                                                ?>
                                                                    <td> <a href="<?= $data[0]['url_laporan_hasil_penilaian_mandiri']; ?>" target="_blank" class="btn btn-primary rounded-pill">View File</a></td>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <td>Belum Mengupload Data</td>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                            <?php
                                                            if ($data[0]['url_surat_usulan_dinas'] != NULL) {
                                                            ?>
                                                                <tr>
                                                                    <td>
                                                                        Surat Usulan Dinas Kesehatan Kabupaten / Kota Setelah Dinyatakan Siap untuk di Survei
                                                                    </td>

                                                                    <td>
                                                                        <a href="<?= $data[0]['url_surat_usulan_dinas']; ?>" target="_blank" class="btn btn-primary rounded-pill">View File</a>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($data[0]['url_pps_reakreditasi'] != NULL) {
                                                            ?>
                                                                <tr>
                                                                    <td>Hasil Perencanaan Perbaikan Strategis (PPS) Untuk Fasyankes Reakreditasi</td>
                                                                    <td>
                                                                        <a href="<?= $data[0]['url_pps_reakreditasi']; ?>" target="_blank" class="btn btn-primary rounded-pill">View File</a>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>

                                                    <?php
                                                    if (!empty($data[0]['update_dfo'])) {
                                                        if ($data[0]['update_dfo'] == 2) {
                                                            $update_dfo_y = "checked";
                                                            $update_dfo_n = "";
                                                        } else {
                                                            $update_dfo_y = "";
                                                            $update_dfo_n = "checked";
                                                        }
                                                    } else {
                                                        $update_dfo_y = "";
                                                        $update_dfo_n = "";
                                                    }

                                                    // echo $data[0]['update_dfo'];

                                                    if (!empty($data[0]['update_aspak'])) {
                                                        if ($data[0]['update_aspak'] == 2) {
                                                            $update_aspak_y = "checked";
                                                            $update_aspak_n = "";
                                                        } else {
                                                            $update_aspak_y = "";
                                                            $update_aspak_n = "checked";
                                                        }
                                                    } else {
                                                        $update_aspak_y = "";
                                                        $update_aspak_n = "";
                                                    }

                                                    if (!empty($data[0]['update_sisdmk'])) {
                                                        if ($data[0]['update_sisdmk'] == 2) {
                                                            $update_sisdmk_y = "checked";
                                                            $update_sisdmk_n = "";
                                                        } else {
                                                            $update_sisdmk_y = "";
                                                            $update_sisdmk_n = "checked";
                                                        }
                                                    } else {
                                                        $update_sisdmk_y = "";
                                                        $update_sisdmk_n = "";
                                                    }

                                                    if (!empty($data[0]['update_inm'])) {
                                                        if ($data[0]['update_inm'] == 2) {
                                                            $update_inm_y = "checked";
                                                            $update_inm_n = "";
                                                        } else {
                                                            $update_inm_y = "";
                                                            $update_inm_n = "checked";
                                                        }
                                                    } else {
                                                        $update_inm_y = "";
                                                        $update_inm_n = "";
                                                    }

                                                    if (!empty($data[0]['update_ikp'])) {
                                                        if ($data[0]['update_ikp'] == 2) {
                                                            $update_ikp_y = "checked";
                                                            $update_ikp_n = "";
                                                        } else {
                                                            $update_ikp_y = "";
                                                            $update_ikp_n = "checked";
                                                        }
                                                    } else {
                                                        $update_ikp_y = "";
                                                        $update_ikp_n = "";
                                                    }
                                                    // var_dump($update_dfo_y);
                                                    ?>
                                                    <div class="form-group" style='display:block;'>
                                                        <label> Update data fasyankes dalam aplikasi Data Fasyankes Online (DFO)</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="update_dfo" id="update_dfo1" value="2" disabled <?= $update_dfo_y; ?>>
                                                            <label class="form-check-label" for="update_dfo1">
                                                                Ya
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="update_dfo" id="update_dfo2" value="1" disabled <?= $update_dfo_n; ?>>
                                                            <label class="form-check-label" for="update_dfo2">
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" style='display:block;'>
                                                        <label> Kelengkapan data sarana, prasarana dan alat kesehatan dalam aplikasi ASPAK</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="update_aspak" id="update_aspak1" value="2" disabled <?= $update_aspak_y; ?>>
                                                            <label class="form-check-label" for="update_aspak1">
                                                                Sesuai Persyaratan
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="update_aspak" id="update_aspak2" value="1" disabled <?= $update_aspak_n; ?>>
                                                            <label class="form-check-label" for="update_aspak2">
                                                                Belum Sesuai
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" style='display:block;'>
                                                        <label> Kelengkapan data tenaga kesehatan dalam aplikasi SISDMK</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="update_sisdmk" id="update_sisdmk1" value="2" disabled <?= $update_sisdmk_y; ?>>
                                                            <label class="form-check-label" for="update_sisdmk1">
                                                                Sesuai Persyaratan
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="update_sisdmk" id="update_sisdmk2" value="1" disabled <?= $update_sisdmk_n; ?>>
                                                            <label class="form-check-label" for="update_sisdmk2">
                                                                Belum Sesuai
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" style='display:block;'>
                                                        <label> Kelengkapan data dalam aplikasi INM</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="update_inm" id="update_inm1" value="2" disabled <?= $update_inm_y; ?>>
                                                            <label class="form-check-label" for="update_inm1">
                                                                Sesuai Persyaratan
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="update_inm" id="update_inm2" value="1" disabled <?= $update_inm_n; ?>>
                                                            <label class="form-check-label" for="update_inm2">
                                                                Belum Sesuai
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" style='display:block;'>
                                                        <label> Kelengkapan data dalam aplikasi IKP</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="update_ikp" id="update_ikp1" value="2" disabled <?= $update_ikp_y; ?>>
                                                            <label class="form-check-label" for="update_ikp1">
                                                                Sesuai Persyaratan
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="update_ikp" id="update_ikp2" value="1" disabled <?= $update_ikp_n; ?>>
                                                            <label class="form-check-label" for="update_ikp2">
                                                                Belum Sesuai
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>

                                    <!-- pengiriman_laporan Survei -->
                                    <div class="tab-pane fade " id="pengiriman_laporan" role="tabpanel" aria-labelledby="pengiriman_laporan-tab">
                                        <div class="page-heading">
                                            <div class="page-title">

                                            </div>
                                            <section class="section">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="form-group col-md-4">
                                                                <div class="form-group" style="display: block;">
                                                                    <label for="tanggal_survei_pertama">Tanggal Survei Pertama :</label>
                                                                    <input class="form-control" disabled type="date" name="tanggal_survei_pertama" id="tanggal_survei_pertama" value="<?= $data[0]['tanggal_survei_satu'] ?>">
                                                                </div>

                                                                <div class="form-group" style="display: block;">
                                                                    <label for="bukti_survei_pertama">Foto Bukti Survei Hari Pertama :</label>
                                                                    <?php if ($data[0]['url_bukti_satu'] == null) {
                                                                    ?>
                                                                        <input type="text" id="bukti_survei_pertama" name="bukti_survei_pertama" disabled value="Dokumen Belum diupload">
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <a class="btn btn-success rounded-pill" target="_blank" href="<?php echo $data[0]['url_bukti_satu']; ?>">Lihat Dokumen</a>

                                                                    <?php
                                                                    }
                                                                    ?>


                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <div class="form-group" style="display: block;">
                                                                    <label for="tanggal_survei_kedua">Tanggal Survei Kedua :</label>
                                                                    <input class="form-control" disabled type="date" name="tanggal_survei_kedua" id="tanggal_survei_kedua" value="<?= $data[0]['tanggal_survei_dua'] ?>">
                                                                </div>
                                                                <div class="form-group" style="display: block;">
                                                                    <label for="bukti_survei_kedua">Foto Bukti Survei Hari Pertama :</label>
                                                                    <?php if ($data[0]['url_bukti_dua'] == null) {
                                                                    ?>
                                                                        <input type="text" id="bukti_survei_kedua" name="bukti_survei_kedua" disabled value="Dokumen Belum diupload">
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <a class="btn btn-success rounded-pill" target="_blank" href="<?php echo $data[0]['url_bukti_dua']; ?>">Lihat Dokumen</a>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <div class="form-group" style="display: block;">
                                                                    <label for="tanggal_survei_ketiga">Tanggal Survei Ketiga :</label>
                                                                    <input class="form-control" disabled type="date" name="tanggal_survei_ketiga" id="tanggal_survei_ketiga" value="<?= $data[0]['tanggal_survei_tiga'] ?>">
                                                                </div>
                                                                <div class="form-group" style="display: block;">
                                                                    <label for="bukti_survei_ketiga">Foto Bukti Survei Hari Pertama :</label>
                                                                    <?php if ($data[0]['url_bukti_tiga'] == null) {
                                                                    ?>
                                                                        <input type="text" id="bukti_survei_ketiga" name="bukti_survei_ketiga" disabled value="Dokumen Belum diupload">
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <a class="btn btn-success rounded-pill" target="_blank" href="<?php echo $data[0]['url_bukti_tiga']; ?>">Lihat Dokumen</a>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                    <!-- Batas Tab Kesiapan Survei -->
                                <?php
                                }
                                ?>

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
                                                    <?php if ($this->session->userdata('kriteria_id') == 5) { ?>
                                                        <?php echo form_open_multipart('Pengajuan/detailfasyankes/' . $id) ?>
                                                    <?php } else { ?>
                                                        <?php echo form_open_multipart('Kemenkes/detailfasyankes/' . $id) ?>
                                                    <?php } ?>
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
                                                        <table class="table table-striped" id="Tablepenilaian">
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
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $n = 1;
                                                                foreach ($datab as $datab) {
                                                                    $key = $datab['id'];
                                                                    if ((!empty($data[0]['status_final_ep']) ? $data[0]['status_final_ep'] : '') != '1') {
                                                                        $nilai = 1;
                                                                    } else {
                                                                        $nilai = 0;
                                                                    }
                                                                ?>
                                                                    <tr>
                                                                        <td><?= $n; ?></td>

                                                                        <td><?= $datab['bab'] ?></td>
                                                                        <td><?= $datab['standar'] ?></td>
                                                                        <td><?= $datab['kriteria'] ?></td>
                                                                        <td><?= $datab['elemen'] ?></td>
                                                                        <td><?= $datab['keterangan_elemen'] ?></td>
                                                                        <?php
                                                                        if (!empty($trans)) {
                                                                            if ((!empty($data[0]['status_final_ep']) ? $data[0]['status_final_ep'] : '') != '1') {
                                                                        ?>
                                                                                <td>-</td>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <td><?php echo $datab['skor_maksimal']; ?></td>
                                                                            <?php
                                                                            }
                                                                            if ((!empty($data[0]['skor_capaian_surveior']) ? $data[0]['skor_capaian_surveior'] : '') == 'TDD') {
                                                                            ?>
                                                                                <td>TDD</td>
                                                                            <?php } else {
                                                                            ?>
                                                                                <td><?php echo $datab['skor_maksimal']; ?></td>
                                                                            <?php
                                                                            }
                                                                            if ((!empty($data[0]['status_final_ep']) ? $data[0]['status_final_ep'] : '') != '1') {
                                                                            ?>
                                                                                <td>-</td>
                                                                                <td>-</td>
                                                                                <td>-</td>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <td><?= (!empty($trans[$key]['persentase_capaian_surveior']) ? $trans[$key]['persentase_capaian_surveior'] : 0) ?></td>
                                                                                <td><?= (!empty($trans[$key]['fakta_dan_analisis']) ? $trans[$key]['fakta_dan_analisis'] : '') ?></td>
                                                                                <td><?= (!empty($trans[$key]['rekomendasi']) ? $trans[$key]['rekomendasi'] : '') ?></td>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <td>-</td>
                                                                            <td><?= $datab['skor_maksimal'] ?></td>
                                                                            <td>-</td>
                                                                            <td>-</td>
                                                                            <td>-</td>
                                                                        <?php
                                                                        }
                                                                        ?>
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

                                <div class="tab-pane fade" id="rekomendasistatus" role="tabpanel" aria-labelledby="rekomendasistatus-tab">
                                    <div class="page-heading">
                                        <div class="page-title"></div>
                                        <section class="section">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="d-flex justify-content-center py-3">
                                                            <div class="col-md-3">
                                                                <label for="status_rekomendasi">
                                                                    <h5>Rekomendasi Status : </h5>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <?php
                                                                if ($data[0]['nama_rekomendasi'] != NULL) {
                                                                ?>
                                                                    <input id="status_rekomendasi" name="status_rekomendasi" type="text" disabled value="<?= $data[0]['nama_rekomendasi'] ?>">
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <input type="text" disabled value="-">
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 text-center">
                                                            <?php
                                                            if ($data[0]['url_surat_rekomendasi_status'] != NULL) {
                                                            ?>
                                                                <object width="800" height="900" data="<?= $data[0]['url_surat_rekomendasi_status']; ?>" type="application/pdf">
                                                                    <div>No online PDF viewer installed</div>
                                                                </object>
                                                            <?php } ?>
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


                                                    if ($data_sertifikat != NULL) {
                                                        $datar = 'https://sinar.kemkes.go.id/assets/faskessertif/';
                                                        $urll = $datar . $ds[0]->url_sertifikat;
                                                    ?>
                                                        <iframe src="<?php echo $urll; ?>" frameborder="0" width="100%" height="1000px"></iframe>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <h3>Masih Dalam Proses Akreditasi</h3>
                                                    <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    // if (isset($data[0]['tanggal_penetapan'])) {
                                                    //     $jadwalpenetapan = date("d-m-Y", strtotime($data[0]['tanggal_penetapan']));
                                                    //     $cek = date("D", strtotime($jadwalpenetapan));
                                                    //     // echo $cek;
                                                    //     $dayList = array(
                                                    //         'Sun' => 'Minggu',
                                                    //         'Mon' => 'Senin',
                                                    //         'Tue' => 'Selasa',
                                                    //         'Wed' => 'Rabu',
                                                    //         'Thu' => 'Kamis',
                                                    //         'Fri' => 'Jumat',
                                                    //         'Sat' => 'Sabtu'
                                                    //     );
                                                    // }

                                                    // if (isset($data[0]['tanggal_berakhir_berlaku'])) {
                                                    //     $tanggalberakhir = date("d-m-Y", strtotime($data[0]['tanggal_berakhir_berlaku']));
                                                    //     $cekberakhir = date("D", strtotime($tanggalberakhir));
                                                    //     // echo $cek;
                                                    //     $dayList = array(
                                                    //         'Sun' => 'Minggu',
                                                    //         'Mon' => 'Senin',
                                                    //         'Tue' => 'Selasa',
                                                    //         'Wed' => 'Rabu',
                                                    //         'Thu' => 'Kamis',
                                                    //         'Fri' => 'Jumat',
                                                    //         'Sat' => 'Sabtu'
                                                    //     );
                                                    // }
                                                    ?>
                                                    <!-- <div class="row">
                                                        <div class="d-flex justify-content-center">
                                                            <div class="col-md-6">
                                                                <label for="tanggal_penetapan">
                                                                    <h5>Tanggal Penetapan</h5>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <h5>:</h5>
                                                            </div>
                                                            <div class="col-md-4"> -->
                                                    <?php
                                                    // if ($data[0]['tanggal_penetapan'] != NULL) {
                                                    ?>
                                                    <!-- <h5><? //= $dayList[$cek] . ', ' . $jadwalpenetapan 
                                                                ?></h5> -->
                                                    <!-- <input id="tanggal_penetapan" name="tanggal_penetapan" type="text" disabled value=""> -->
                                                    <?php
                                                    // } else {
                                                    ?>
                                                    <!-- <h5>-</h5> -->
                                                    <?php
                                                    // }
                                                    ?>
                                                    <!-- </div>
                                                        </div> -->
                                                    <!-- <div class="d-flex justify-content-center py-3">
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
                                                                // if ($data[0]['tanggal_berakhir_berlaku'] != NULL) {
                                                                ?>
                                                                    <h5><? //= $dayList[$cekberakhir] . ', ' . $tanggalberakhir 
                                                                        ?></h5>
                                                                <?php
                                                                // } else {
                                                                ?>
                                                                    <h5>-</h5>
                                                                <?php
                                                                // }
                                                                ?>
                                                            </div>
                                                        </div> -->
                                                    <!-- <div class="col-md-12 text-center">
                                                            <?php
                                                            // if ($data[0]['url_dokumen_sertifikat'] != NULL) {
                                                            ?>
                                                                <object width="800" height="900" data="<? //= $data[0]['url_dokumen_sertifikat']; 
                                                                                                        ?>" type="application/pdf">
                                                                    <div>No online PDF viewer installed</div>
                                                                </object>
                                                            <?php //} 
                                                            ?>
                                                        </div> -->
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
        </div>
        <!-- </div> -->
        <script src="<?php echo base_url()
                        ?>assets/js/app.js">

        </script>

</body>

</html>

<script src="<?php echo base_url() ?>assets/js/extensions/simple-datatables.js"></script>
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

<script>
    // $(document).ready(function() {
    //     $('.get-data').click(function() {
    //         alert('klik');
    //     })
    // });
    // $(function() {
    //     $("#datepicker").datepicker();
    //     $("#datepickerstr").datepicker();
    // });
</script>

<script>
    // $(document).ready(function() {

    //     if (nilai != 1) {
    //         $('#table1').DataTable({
    //             "paging": true,
    //             "lengthChange": false,
    //             "searching": false,
    //             "ordering": true,
    //             "info": true,
    //             "autoWidth": false,
    //             dom: 'Bfrtip',
    //             buttons: [
    //                 'excel', 'csv'
    //             ]
    //         });
    //     } else {
    //         $('#table1').DataTable({
    //             "paging": false,
    //             "lengthChange": false,
    //             "searching": false,
    //             "ordering": true,
    //             "info": true,
    //             "autoWidth": false
    //         });
    //     }

    // })
</script>