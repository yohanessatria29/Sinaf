<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Penolakan Usulan Survei</title>
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
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Persetujuan Usulan Survei</a>
                                </li>
                            </ul>
                            <div class="card-tools">
                                <p></p>
                                <a type="button" href="https://sinaf.kemkes.go.id/pengajuan/penolakanpengajuan" title="Kembali">
                                    <svg width="25px" height="25px" viewBox="-32 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"></path>
                                    </svg> Kembali
                                </a>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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

                                                                <div class="form-group status" style="display:<?= $var_style_status ?>" id='status'>
                                                                    <label for="disabledInput">Status Akreditasi Sebelumnya</label>
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
                                                                    <label for="">Alasan Pembatalan</label>
                                                                    <div class="col-md-6">
                                                                        <input class="form-control" value="<?= $pembatalan[0]['alasan_pembatalan'] ?>" type="text" disabled readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Surat Pembatalan</label>
                                                                    <div class="col-md-6">
                                                                        <a class="btn btn-sm btn-primary rounded-pill" target="_blank" href="<?= $pembatalan[0]['surat_pembatalan'] ?>">Lihat Dokumen</a>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="helperText">Status Pengajuan Pembatalan </label>
                                                                    <? //= form_dropdown('status_usulan_id', dropdown_sina_status_usulan(), $data[0]['status_usulan_id'], 'id="status_usulan_id"  class="form-select" '); 
                                                                    ?>
                                                                    <select class="form-select" name="status_usulan_id" id="status_usulan_id" required>
                                                                        <option value="">== PILIH ==</option>
                                                                        <option value="2">Pengajuan Pembatalan Diterima</option>
                                                                        <option value="3">Pengajuan Pembatalan Ditolak</option>
                                                                    </select>
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
                                                                    <button type="submit" class="btn btn-primary me-1 mb-1" style="display:<?= $submit_style; ?>;">Submit</button>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
</script>