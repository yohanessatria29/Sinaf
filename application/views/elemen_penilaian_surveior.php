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
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="narahubung-tab" data-bs-toggle="tab" href="#narahubung" role="tab" aria-controls="narahubung" aria-selected="false">Narahubung</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="kesiapan-tab" data-bs-toggle="tab" href="#kesiapan" role="tab" aria-controls="kesiapan" aria-selected="false">Kesiapan Survei</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="hasilkesiapan-tab" data-bs-toggle="tab" href="#hasilkesiapan" role="tab" aria-controls="hasilkesiapan" aria-selected="false">Hasil Kesiapan Survei</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="kesepakatan-tab" data-bs-toggle="tab" href="#kesepakatan" role="tab" aria-controls="kesepakatan" aria-selected="false">Kesepakatan Survei</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Elemen Penilaian Surveior</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="persentase-tab" data-bs-toggle="tab" href="#persentase" role="tab" aria-controls="persentase" aria-selected="false">Persentase Capaian</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="contacta-tab" data-bs-toggle="tab" href="#contacta" role="tab" aria-controls="contacta" aria-selected="false">Pengiriman Laporan Survei</a>
                            </li>


                            <!-- <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Hasil Kesiapan Survei</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false">Kesepakatan Survei</a>
                    </li> -->
                            <!-- <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contacta-tab" data-bs-toggle="tab" href="#contacta" role="tab"
                            aria-controls="contacta" aria-selected="false">Survei Akreditasi</a>
                    </li> -->
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="page-heading">
                                    <div class="page-title">

                                    </div>
                                    <section class="section">

                                        <div class="card">
                                            <!-- <div class="card-header">
                <h3> <b> Elemen Penilaian Surveior</b> </h3>
            </div> -->
                                            <?php
                                            if ($data[0]['jenis_fasyankes'] == 1) {
                                                $jenis_fasyankes = 'Tempat Praktik Mandiri Nakes';
                                            } else if ($data[0]['jenis_fasyankes'] == 2) {
                                                $jenis_fasyankes = 'Pusat Kesehatan Masyarakat';
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
                                            // var_dump($trans);
                                            // var_dump($data);
                                            ?>

                                            <?php echo form_open_multipart('surveior/epsurveior/' . $id) ?>
                                            <form role="form" method="post" class="login-form" name="form_valdation">
                                                <div class="form-group row align-items-center">

                                                    <div class="row">
                                                        <div class="col-lg-2 col-4">
                                                            <label class="col-form-label">Kode Fasyankes :</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <label class="col-form-label"> <?= $data[0]['fasyankes_id']; ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row align-items-center">
                                                    <div class="col-lg-2 col-3">
                                                        <label class="col-form-label">Nama Fasyankes</label>
                                                    </div>
                                                    <div class="col-lg-10 col-9">
                                                        <label class="col-form-label"> <?= $data_nama[0]['nama_fasyankes']; ?></label>
                                                    </div>
                                                </div>
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


                                            <?php
                                            //}
                                            ?>
                                            <div class="card-body">
                                                <?php echo form_open_multipart('surveior/simpanEp/') ?>
                                                <form role="form" method="post" class="login-form" name="form_valdation">
                                                    <?php
                                                    //var_dump($data);
                                                    //var_dump($datab);
                                                    ?>
                                                    <div class="table-responsive">
                                                        <table class="table" id="table1" style="color: black; width:100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">Bab</th>
                                                                    <th scope="col">Standar</th>
                                                                    <th scope="col">Kriteria</th>
                                                                    <th scope="col">Elemen Penilaian</th>
                                                                    <th scope="col">Uraian</th>
                                                                    <th scope="col">SKOR Capaian Surveior</th>
                                                                    <th scope="col">SKOR Maksimal</th>
                                                                    <th scope="col">Persentase Capaian Surveior</th>
                                                                    <th scope="col" class="w-25">FAKTA DAN ANALISIS</th>
                                                                    <th scope="col" class="w-25">REKOMENDASI Hasil Survei</th>
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
                                                                    <input type="hidden" class="form-control" id="test" name="test" value="<?= $nilai; ?>">
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


                                                                                <td>
                                                                                    <select class="form-select skor_capaian_surveior" id="skor_capaian_surveior" name="skor_capaian_surveior[<?= $key; ?>]">
                                                                                        <option value='0' <?php if ((!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : '')  == "0") echo "selected" ?>>0</option>
                                                                                        <option value='5' <?php if ((!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : '')  == "5") echo "selected" ?>>5</option>
                                                                                        <option value='10' <?php if ((!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : '')  == "10") echo "selected" ?>>10</option>
                                                                                        <option value='TDD' <?php if ((!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : '')  == "TDD") echo "selected" ?>>TDD</option>
                                                                                    </select>
                                                                                </td>
                                                                            <?php
                                                                            } else { ?>
                                                                                <td><?php echo $trans[$key]['skor_capaian_surveior']; ?></td>
                                                                            <?php
                                                                            }

                                                                            if ((!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : '') == "10") {
                                                                                $required_text_rekomendasi = "";
                                                                            } else if ((!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : '') == 10) {
                                                                                $required_text_rekomendasi = "";
                                                                            } else {
                                                                                $required_text_rekomendasi = "required";
                                                                            }

                                                                            if ((!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : '') == "TDD") {
                                                                                $required_text = "";

                                                                                $required_text_rekomendasi = "";
                                                                            ?>
                                                                                <td>TDD</td>
                                                                            <?php
                                                                            } else {
                                                                                $required_text = "required";
                                                                            ?>
                                                                                <td><?= $datab['skor_maksimal'] ?> </td>
                                                                            <?php
                                                                            }

                                                                            if ((!empty($data[0]['status_final_ep']) ? $data[0]['status_final_ep'] : '') != '1') {
                                                                            ?>
                                                                                <td><input type="text" class="form-control" id="presentase_capaian_surveior<?= $n ?>" name="presentase_capaian_surveior" value="<?= (!empty($trans[$key]['persentase_capaian_surveior']) ? $trans[$key]['persentase_capaian_surveior'] : 0) ?>" readonly></td>
                                                                                <td><textarea style="color: black;" class="form-control" data-toggle="tooltip" data-placement="top" title="Minimal 30 Karakter" rows="4" cols="60" minlength="30" id="fakta_dan_analisis<?= $n ?>" name="fakta_dan_analisis[<?= $key; ?>]" <?= $required_text; ?>><?= (!empty($trans[$key]['fakta_dan_analisis']) ? $trans[$key]['fakta_dan_analisis'] : '') ?></textarea></td>
                                                                                <td><textarea style="color: black;" class="form-control" data-toggle="tooltip" data-placement="top" title="Minimal 30 Karakter" rows="4" cols="50" minlength="30" id="rekomendasi<?= $n ?>" name="rekomendasi[<?= $key; ?>]" <?= $required_text_rekomendasi; ?>><?= (!empty($trans[$key]['rekomendasi']) ? $trans[$key]['rekomendasi'] : '') ?></textarea></td>
                                                                            <?php } else { ?>
                                                                                <td><?= (!empty($trans[$key]['persentase_capaian_surveior']) ? $trans[$key]['persentase_capaian_surveior'] : 0) ?></td>
                                                                                <td><?= (!empty($trans[$key]['fakta_dan_analisis']) ? $trans[$key]['fakta_dan_analisis'] : '') ?></td>
                                                                                <td><?= (!empty($trans[$key]['rekomendasi']) ? $trans[$key]['rekomendasi'] : '') ?></td>
                                                                            <?php }
                                                                            ?>



                                                                        <?php
                                                                            //     }    
                                                                            // }
                                                                        } else {
                                                                            $required_text = "required";
                                                                        ?>

                                                                            <!-- <td> <?= form_dropdown('skor_capaian_surveior', array('0' => '0', '5' => '5', '10' => '10', 'TDD' => 'TDD'), 'id="skor_capaian_surveior"  class="skor_capaian_surveior form-select"'); ?></td> -->
                                                                            <!-- <td><input type="text" class="form-control" id="skor_maksimal_surveior" name="skor_maksimal_surveior" value="" readonly></td> -->
                                                                            <td> <select class="form-select skor_capaian_surveior" id="skor_capaian_surveior" name="skor_capaian_surveior[<?= $key; ?>]">
                                                                                    <option value='0'>0</option>
                                                                                    <option value='5'>5</option>
                                                                                    <option value='10'>10</option>
                                                                                    <option value='TDD'>TDD</option>

                                                                                </select> </td>
                                                                            <td><?= $datab['skor_maksimal'] ?> </td>

                                                                            <td><input type="text" style="color: black;" class="form-control" id="presentase_capaian_surveior<?= $n ?>" name="presentase_capaian_surveior" value="" readonly></td>
                                                                            <td><textarea style="color: black;" data-toggle="tooltip" data-placement="top" title="Minimal 30 Karakter" rows="4" cols="60" minlength="30" id="fakta_dan_analisis<?= $n ?>" name="fakta_dan_analisis[<?= $key; ?>]" <?= $required_text; ?>></textarea></td>
                                                                            <td><textarea style="color: black;" class="form-control" data-toggle="tooltip" data-placement="top" title="Minimal 30 Karakter" rows="4" cols="50" minlength="30" id="rekomendasi<?= $n ?>" name="rekomendasi[<?= $key; ?>]" <?= $required_text; ?>></textarea></td>

                                                                        <?php
                                                                        }
                                                                        ?>
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
                                            <input type="hidden" name="penetapan_tanggal_survei_id" value="<?= $data[0]['penetapan_tanggal_survei_id']; ?>">
                                            <input type="hidden" name="id_pengajuan" value="<?= $id; ?>">
                                            <input type="hidden" name="bab2" value="<?= $bab; ?>">
                                            <?php

                                            if ((!empty($data[0]['status_final_ep']) ? $data[0]['status_final_ep'] : '') != '1') {
                                            ?>
                                                <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
                                            <?php
                                            }
                                            ?>
                                            </form>
                                        </div>
                                    </section>
                                </div>
                            </div>

                            <?php
                            $date1 = $data[0]['tanggal_awal_rencana_survei'];
                            $date2 = $data[0]['tanggal_akhir_rencana_survei'];

                            $diff = abs(strtotime($date2) - strtotime($date1));

                            $years = floor($diff / (365 * 60 * 60 * 24));
                            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                            // printf("%d years, %d months, %d days\n", $years, $months, $days);

                            // echo $days;

                            $date3 = str_replace('-', '/', $date1);
                            $tomorrow = date('Y-m-d', strtotime($date3 . "+1 days"));
                            //echo $tomorrow;

                            if ($date1 == $date2) {
                                $tanggal_survei_satu = $date1;
                                $tanggal_survei_dua = null;
                                $tanggal_survei_tiga = null;
                            }

                            if ($days == 1) {
                                $tanggal_survei_satu = $date1;
                                $tanggal_survei_dua = $date2;
                                $tanggal_survei_tiga = null;
                            } else if ($days == 2) {
                                $tanggal_survei_satu = $date1;
                                $tanggal_survei_dua = $tomorrow;
                                $tanggal_survei_tiga = $date2;
                            }

                            if (!empty($detail_pengajuan[2]['tanggal_survei'])) {
                                $tanggal_survei_tiga = $detail_pengajuan[2]['tanggal_survei'];
                                $style_tanggal_survei_tiga = "block";
                            } else {
                                $tanggal_survei_tiga = null;
                                $style_tanggal_survei_tiga = "none";
                            }
                            ?>

                            <div class="tab-pane fade show" id="contacta" role="tabpanel" aria-labelledby="contacta-tab">
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
                                                        <div class="form-group" style='display:block;'>
                                                            <label for="disabledInput">Tanggal Survei Hari Pertama</label>
                                                            <input type="date" name="tanggal_survei_satu" id="tanggal_survei_satu" value="<?= (!empty($data[0]['tanggal_survei_satu']) ? $data[0]['tanggal_survei_satu'] : $detail_pengajuan[0]['tanggal_survei']) ?>" class="form-control datepicker" autocomplete="off" disabled>
                                                        </div>
                                                        <div class="form-group" style='display:block;'>
                                                            <label for="disabledInput">Foto Bukti Survei Hari Pertama</label>
                                                            <!-- <i><small class="text-muted"> Maks 2MB / Format (Jpeg/Jpg/Png)</i></small> -->
                                                            <fieldset>
                                                                <div class="input-group">
                                                                    <input type="url" class="form-control"
                                                                        required
                                                                        placeholder="Masukkan link gambar (jpg/png/jpeg) atau URL Drive"
                                                                        id="foto_bukti_survei" name="foto_bukti_survei"
                                                                        value="<?= $data[0]['url_bukti_satu'] ?? '' ?>" />
                                                                    <!-- accept="image/png, image/gif, image/jpeg"  -->

                                                                </div>

                                                                <?php
                                                                $url_bukti_satu = $data[0]['url_bukti_satu'] ?? '';

                                                                if (!empty($url_bukti_satu)) {
                                                                    $is_external = preg_match('#^https?://#i', $url_bukti_satu);
                                                                    $is_image = preg_match('/\.(jpg|jpeg|png|gif)$/i', $url_bukti_satu);
                                                                    $url_view = $is_external ? $url_bukti_satu : base_url('/assets/uploads/berkas_akreditasi/' . $url_bukti_satu);

                                                                    echo '<a class="btn btn-success rounded-pill mt-2" target="_blank" href="' . $url_view . '">Lihat Dokumen</a>';
                                                                }
                                                                ?>

                                                                <input type="hidden" name="old_foto_bukti_survei" value="<?= $url_bukti_satu ?>" id="old_foto_bukti_survei">
                                                            </fieldset>

                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="form-group" style='display:block;'>
                                                            <label for="disabledInput">Tanggal Survei Hari Kedua</label>
                                                            <input type="date" name="tanggal_survei_dua" id="tanggal_survei_dua" value="<?= (!empty($data[0]['tanggal_survei_dua']) ? $data[0]['tanggal_survei_dua'] : $detail_pengajuan[1]['tanggal_survei']) ?>" class="form-control datepicker" autocomplete="off" disabled>
                                                        </div>
                                                        <div class="form-group" style='display:block;'>
                                                            <label for="disabledInput">Foto Bukti Survei Hari Kedua</label>
                                                            <!-- <i><small class="text-muted"> Maks 2MB / Format (Jpeg/Jpg/Png)</i></small> -->
                                                            <fieldset>
                                                                <div class="input-group">
                                                                    <input type="url" class="form-control"
                                                                        required
                                                                        placeholder="Masukkan link gambar (jpg/png/jpeg/gif) atau URL Drive"
                                                                        id="foto_bukti_survei2" name="foto_bukti_survei2"
                                                                        value="<?= $data[0]['url_bukti_dua'] ?? '' ?>" />
                                                                    <!-- accept="image/png, image/gif, image/jpeg"  -->
                                                                </div>

                                                                <?php
                                                                $url_bukti_dua = $data[0]['url_bukti_dua'] ?? '';

                                                                if (!empty($url_bukti_dua)) {
                                                                    $is_external = preg_match('#^https?://#i', $url_bukti_dua);
                                                                    $url_view = $is_external ? $url_bukti_dua : base_url('/assets/uploads/berkas_akreditasi/' . $url_bukti_dua);

                                                                    echo '<a class="btn btn-success rounded-pill mt-2" target="_blank" href="' . $url_view . '">Lihat Dokumen</a>';
                                                                }
                                                                ?>

                                                                <input type="hidden" name="old_foto_bukti_survei2" value="<?= $url_bukti_dua ?>" id="old_foto_bukti_survei2">
                                                            </fieldset>

                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="form-group" style='display:<?= $style_tanggal_survei_tiga; ?>;'>
                                                            <label for="disabledInput">Tanggal Survei Hari Ketiga</label>
                                                            <input type="date" name="tanggal_survei_tiga" id="tanggal_survei_tiga" value="<?= $tanggal_survei_tiga ?>" class="form-control datepicker" autocomplete="off" disabled>
                                                        </div>
                                                        <div class="form-group" style='display:<?= $style_tanggal_survei_tiga; ?>;'>
                                                            <label for="disabledInput">Foto Bukti Survei Ketiga</label>
                                                            <i><small class="text-muted"> Maks 2MB / Format (Jpeg/Jpg/Png)</i></small>
                                                            <fieldset>
                                                                <div class="input-group">
                                                                    <input type="url" class="form-control"
                                                                        placeholder="Masukkan link gambar (jpg/png/jpeg/gif) atau URL Drive"
                                                                        id="foto_bukti_survei3" name="foto_bukti_survei3"
                                                                        value="<?= $data[0]['url_bukti_tiga'] ?? '' ?>"
                                                                        accept="image/png, image/gif, image/jpeg" />
                                                                </div>

                                                                <?php
                                                                $url_bukti_tiga = $data[0]['url_bukti_tiga'] ?? '';

                                                                if (!empty($url_bukti_tiga)) {
                                                                    $is_external = preg_match('#^https?://#i', $url_bukti_tiga);
                                                                    $url_view = $is_external ? $url_bukti_tiga : base_url('/assets/uploads/berkas_akreditasi/' . $url_bukti_tiga);

                                                                    echo '<a class="btn btn-success rounded-pill mt-2" target="_blank" href="' . $url_view . '">Lihat Dokumen</a>';
                                                                }
                                                                ?>

                                                                <input type="hidden" name="old_foto_bukti_survei3" value="<?= $url_bukti_tiga ?>" id="old_foto_bukti_survei3">
                                                            </fieldset>

                                                        </div>
                                                    </div>


                                                </div>
                                                <input type="hidden" name="penetapan_tanggal_survei_id" value="<?= $data[0]['penetapan_tanggal_survei_id']; ?>">
                                                <input type="hidden" name="pengiriman_laporan_survei_id" value="<?= $data[0]['pengiriman_laporan_survei_id']; ?>">
                                                <input type="hidden" name="lpa_id" value="<?= $data2[0]['lpa_id']; ?>">
                                                <input type="hidden" name="id_pengajuan" value="<?= $id; ?>">


                                                <?php
                                                if ((!empty($data[0]['status_final_ep']) ? $data[0]['status_final_ep'] : '') != '1') {
                                                } else {
                                                    // if ($data[0]['status_surveior_satu'] == 1) {
                                                    if (!empty(!empty($data_surveior_lapangan[0]['surveior_satu_baru_user_id']) ? $data_surveior_lapangan[0]['surveior_satu_baru_user_id'] : '')) {
                                                        if ($session_id == $data_surveior_lapangan[0]['surveior_satu_baru_user_id']) {
                                                            if ($data_surveior_lapangan[0]['jabatan_surveior_id_satu'] == 1) {
                                                ?>
                                                                <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
                                                            <?php
                                                            }
                                                        }
                                                    } else {
                                                        if ($session_id == $data[0]['surveior_satu']) {
                                                            ?>
                                                            <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
                                                            <?php
                                                        }
                                                    }
                                                    // } else  if ($data[0]['status_surveior_dua'] == 1) {
                                                    if (!empty(!empty($data_surveior_lapangan[0]['surveior_dua_baru_user_id']) ? $data_surveior_lapangan[0]['surveior_dua_baru_user_id'] : '')) {
                                                        if ($session_id == $data_surveior_lapangan[0]['surveior_dua_baru_user_id']) {
                                                            // var_dump($data_surveior_lapangan[0]['jabatan_surveior_id_dua']);
                                                            if ($data_surveior_lapangan[0]['jabatan_surveior_id_dua'] == 1) {

                                                            ?>
                                                                <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
                                                            <?php
                                                            }
                                                        }
                                                    } else {
                                                        if ($session_id == $data[0]['surveior_dua']) {
                                                            ?>
                                                            <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
                                                <?php
                                                        }
                                                    }
                                                    // }
                                                }
                                                ?>

                                                <!-- SCRIPT CWK GAJELAS -->
                                                <?php
                                                // if ($data[0]['status_surveior_satu'] == 1) {

                                                //     if ($session_id == $data[0]['surveior_satu']) {
                                                ?>
                                                <!-- <button type="submit" class="btn btn-primary rounded-pill">Submit</button> -->
                                                <?php
                                                //     }
                                                // } else  if ($data[0]['status_surveior_dua'] == 1) {

                                                //     if ($session_id == $data[0]['surveior_dua']) {
                                                ?>
                                                <!-- <button type="submit" class="btn btn-primary rounded-pill">Submit</button> -->
                                                <?php
                                                //     }
                                                // }
                                                ?>
                                                <!-- SCRIPT CWK GAJELAS -->
                                            </form>

                                        </div>
                                    </section>
                                </div>
                            </div>

                            <!-- Kesiapan Survei -->
                            <div class="tab-pane fade" id="kesiapan" role="tabpanel" aria-labelledby="kesiapan-tab">
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
                                                                        <span class="badge bg-danger"><a href="http://103.74.143.45/FasyankesOnline/Viewonly/dfo/<?= $data[0]['fasyankes_id']; ?>" target="_blank">Tidak</a></span>
                                                                    <?php
                                                                    } else if ($data[0]['update_dfo'] == 2) {
                                                                    ?>
                                                                        <span class="badge bg-success"><a href="http://103.74.143.45/FasyankesOnline/Viewonly/dfo/<?= $data[0]['fasyankes_id']; ?>" target="_blank">Ya</a></span>
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
                                                                        <span class="badge bg-success">Sesuai Persyaratan</span>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
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
                                                                        <span class="badge bg-success">Sesuai Persyaratan</span>
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
                                                                        <span class="badge bg-success">Sesuai Persyaratan</span>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
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
                                                                        <span class="badge bg-success">Sesuai Persyaratan</span>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </td>


                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <!-- Batas Tab Kesiapan Survei -->

                            <!-- narahubung -->
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
                                                        //var_dump(empty($narahubung));
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
                                                <?php } ?>
                                                </table>

                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="hasilkesiapan" role="tabpanel" aria-labelledby="hasilkesiapan-tab">
                                <?php
                                //var_dump($data);
                                ?>
                                <div class="card">
                                    <!-- <div class="card-header">
                    Data
            </div> -->
                                    <div class="card-body">
                                        <?php echo form_open_multipart('Pengajuan/simpanKelengkapanBerkas') ?>
                                        <form role="form" method="post" class="login-form" name="form_valdation">
                                            <input type="hidden" class="form-control" id="berkas_usulan_survei_id" name="berkas_usulan_survei_id" value="<?= (!empty($data[0]['berkas_usulan_survei_id']) ? $data[0]['berkas_usulan_survei_id'] : '') ?>">
                                            <input type="hidden" class="form-control" id="id" name="id" value="<?= (!empty($data[0]['id']) ? $data[0]['id'] : '') ?>">
                                            <input type="hidden" class="form-control" id="kelengkapan_berkas_id" name="kelengkapan_berkas_id" value="<?= (!empty($data[0]['kelengkapan_berkas_id']) ? $data[0]['kelengkapan_berkas_id'] : '') ?>">
                                            <?php
                                            if (!empty($data[0]['kelengkapan_berkas_usulan'])) {
                                                if ($data[0]['kelengkapan_berkas_usulan'] == 2) {
                                                    $kelengkapan_berkas_usulan_y = "checked";
                                                    $kelengkapan_berkas_usulan_n = "";
                                                } else {
                                                    $kelengkapan_berkas_usulan_y = "";
                                                    $kelengkapan_berkas_usulan_n = "checked";
                                                }
                                            } else {
                                                $kelengkapan_berkas_usulan_y = "";
                                                $kelengkapan_berkas_usulan_n = "";
                                            }

                                            if (!empty($data[0]['kelengkapan_dfo'])) {
                                                if ($data[0]['kelengkapan_dfo'] == 2) {
                                                    $kelengkapan_dfo_y = "checked";
                                                    $kelengkapan_dfo_n = "";
                                                } else {
                                                    $kelengkapan_dfo_y = "";
                                                    $kelengkapan_dfo_n = "checked";
                                                }
                                            } else {
                                                $kelengkapan_dfo_y = "";
                                                $kelengkapan_dfo_n = "";
                                            }

                                            if (!empty($data[0]['kelengkapan_sarpras_alkes'])) {
                                                if ($data[0]['kelengkapan_sarpras_alkes'] == 2) {
                                                    $kelengkapan_sarpras_alkes_y = "checked";
                                                    $kelengkapan_sarpras_alkes_n = "";
                                                } else {
                                                    $kelengkapan_sarpras_alkes_y = "";
                                                    $kelengkapan_sarpras_alkes_n = "checked";
                                                }
                                            } else {
                                                $kelengkapan_sarpras_alkes_y = "";
                                                $kelengkapan_sarpras_alkes_n = "";
                                            }

                                            if (!empty($data[0]['kelengkapan_nakes'])) {
                                                if ($data[0]['kelengkapan_nakes'] == 2) {
                                                    $kelengkapan_nakes_y = "checked";
                                                    $kelengkapan_nakes_n = "";
                                                } else {
                                                    $kelengkapan_nakes_y = "";
                                                    $kelengkapan_nakes_n = "checked";
                                                }
                                            } else {
                                                $kelengkapan_nakes_y = "";
                                                $kelengkapan_nakes_n = "";
                                            }

                                            if (!empty($data[0]['kelengkapan_laporan_inm'])) {
                                                if ($data[0]['kelengkapan_laporan_inm'] == 2) {
                                                    $kelengkapan_laporan_inm_y = "checked";
                                                    $kelengkapan_laporan_inm_n = "";
                                                } else {
                                                    $kelengkapan_laporan_inm_y = "";
                                                    $kelengkapan_laporan_inm_n = "checked";
                                                }
                                            } else {
                                                $kelengkapan_laporan_inm_y = "";
                                                $kelengkapan_laporan_inm_n = "";
                                            }

                                            if (!empty($data[0]['kelengkapan_laporan_ikp'])) {
                                                if ($data[0]['kelengkapan_laporan_ikp'] == 2) {
                                                    $kelengkapan_laporan_ikp_y = "checked";
                                                    $kelengkapan_laporan_ikp_n = "";
                                                } else {
                                                    $kelengkapan_laporan_ikp_y = "";
                                                    $kelengkapan_laporan_ikp_n = "checked";
                                                }
                                            } else {
                                                $kelengkapan_laporan_ikp_y = "";
                                                $kelengkapan_laporan_ikp_n = "";
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
                                                                <input class="form-check-input" disabled type="radio" name="kelengkapan_berkas_usulan" id="kelengkapan_berkas_usulan1" value="2" required <?= $kelengkapan_berkas_usulan_y; ?>>
                                                                <label class="form-check-label" for="kelengkapan_berkas_usulan1">
                                                                    Sesuai Persyaratan
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" disabled type="radio" name="kelengkapan_berkas_usulan" id="kelengkapan_berkas_usulan2" value="1" <?= $kelengkapan_berkas_usulan_n; ?>>
                                                                <label class="form-check-label" for="kelengkapan_berkas_usulan2">
                                                                    Belum Sesuai
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td><input type="text" class="form-control" disabled id="kelengkapan_berkas_usulan_catatan" name="kelengkapan_berkas_usulan_catatan" value="<?= (!empty($data[0]['kelengkapan_berkas_usulan_catatan']) ? $data[0]['kelengkapan_berkas_usulan_catatan'] : '') ?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Data DFO</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" disabled type="radio" name="kelengkapan_dfo" id="kelengkapan_dfo1" value="2" required <?= $kelengkapan_dfo_y; ?>>
                                                                <label class="form-check-label" for="kelengkapan_dfo1">
                                                                    Sesuai Persyaratan
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" disabled type="radio" name="kelengkapan_dfo" id="kelengkapan_dfo2" value="1" <?= $kelengkapan_dfo_n; ?>>

                                                                <label class="form-check-label" for="kelengkapan_dfo2">
                                                                    Belum Sesuai
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td><input type="text" class="form-control" disabled id="kelengkapan_dfo_catatan" name="kelengkapan_dfo_catatan" value="<?= (!empty($data[0]['kelengkapan_dfo_catatan']) ? $data[0]['kelengkapan_dfo_catatan'] : '') ?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Data ASPAK</td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" disabled type="radio" name="kelengkapan_sarpras_alkes" id="kelengkapan_sarpras_alkes1" value="2" required <?= $kelengkapan_sarpras_alkes_y; ?>>
                                                                <label class="form-check-label" for="kelengkapan_sarpras_alkes1">
                                                                    Sesuai Persyaratan
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" disabled type="radio" name="kelengkapan_sarpras_alkes" id="kelengkapan_sarpras_alkes2" value="1" <?= $kelengkapan_sarpras_alkes_n; ?>>

                                                                <label class="form-check-label" for="kelengkapan_sarpras_alkes2">
                                                                    Belum Sesuai
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td><input type="text" class="form-control" disabled id="kelengkapan_sarpras_alkes_catatan" name="kelengkapan_sarpras_alkes_catatan" value="<?= (!empty($data[0]['kelengkapan_sarpras_alkes_catatan']) ? $data[0]['kelengkapan_sarpras_alkes_catatan'] : '') ?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Data SDM</td>

                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" disabled type="radio" name="kelengkapan_nakes" id="kelengkapan_nakes1" value="2" required <?= $kelengkapan_nakes_y; ?>>
                                                                <label class="form-check-label" for="kelengkapan_nakes1">
                                                                    Sesuai Persyaratan
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" disabled type="radio" name="kelengkapan_nakes" id="kelengkapan_nakes2" value="1" <?= $kelengkapan_nakes_n; ?>>
                                                                <label class="form-check-label" for="kelengkapan_nakes2">
                                                                    Belum Sesuai
                                                                </label>
                                                            </div>
                                                        </td>

                                                        <td><input type="text" class="form-control" disabled id="kelengkapan_nakes_catatan" name="kelengkapan_nakes_catatan" value="<?= (!empty($data[0]['kelengkapan_nakes_catatan']) ? $data[0]['kelengkapan_nakes_catatan'] : '') ?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Data Laporan INM</td>

                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" disabled type="radio" name="kelengkapan_laporan_inm" id="kelengkapan_laporan_inm1" value="2" required <?= $kelengkapan_laporan_inm_y; ?>>
                                                                <label class="form-check-label" for="kelengkapan_laporan_inm1">
                                                                    Sesuai Persyaratan
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" disabled type="radio" name="kelengkapan_laporan_inm" id="kelengkapan_laporan_inm2" value="1" <?= $kelengkapan_laporan_inm_n; ?>>
                                                                <label class="form-check-label" for="kelengkapan_laporan_inm2">
                                                                    Belum Sesuai
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td><input type="text" class="form-control" disabled id="kelengkapan_laporan_inm_catatan" name="kelengkapan_laporan_inm_catatan" value="<?= (!empty($data[0]['kelengkapan_laporan_inm_catatan']) ? $data[0]['kelengkapan_laporan_inm_catatan'] : '') ?>"></td>

                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>Data Laporan IKP</td>

                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" disabled type="radio" name="kelengkapan_laporan_ikp" id="kelengkapan_laporan_ikp1" value="2" required <?= $kelengkapan_laporan_ikp_y; ?>>
                                                                <label class="form-check-label" for="kelengkapan_laporan_ikp1">
                                                                    Sesuai Persyaratan
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" disabled type="radio" name="kelengkapan_laporan_ikp" id="kelengkapan_laporan_ikp2" value="1" <?= $kelengkapan_laporan_ikp_n; ?>>
                                                                <label class="form-check-label" for="kelengkapan_laporan_ikp2">
                                                                    Belum Sesuai
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td><input type="text" class="form-control" disabled id="kelengkapan_laporan_ikp_catatan" name="kelengkapan_laporan_ikp_catatan" value="<?= (!empty($data[0]['kelengkapan_laporan_ikp_catatan']) ? $data[0]['kelengkapan_laporan_ikp_catatan'] : '') ?>"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                    </div>
                                    <!-- <button type="submit" class="btn btn-primary rounded-pill">Submit</button>  -->
                                    </form>
                                </div>
                            </div>
                            <!-- batas           -->
                            <!-- Tab Baru -->
                            <div class="tab-pane fade show" id="persentase" role="tabpanel" aria-labelledby="persentase-tab">
                                <div class="page-heading">
                                    <div class="page-title">

                                    </div>
                                    <section class="section">

                                        <div class="card">
                                            <!-- <div class="card-header">
               
            </div> -->
                                            <?php echo form_open_multipart('surveior/final_ep/') ?>
                                            <form role="form" method="post" class="login-form" name="form_valdation">
                                                <!-- <div class="row"> -->
                                                <div class="card-body">
                                                    <!-- </br> -->
                                                    <div class="row">
                                                        <?php
                                                        // var_dump($count_trans);
                                                        ?>
                                                        <table class="table table-striped" id="table2">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Bab</th>
                                                                    <th>Nama Bab </th>
                                                                    <th>EP Terisi</th>
                                                                    <th>Total EP </th>
                                                                    <th>Skor Capaian Surveior</th>
                                                                    <th>Skor Maksimal Surveior</th>
                                                                    <th>Persentase Capaian Surveior ( % )</th>
                                                                    <!-- <th>Skor Capaian Verifikator</th>
                                    <th>Skor Maksimal Verifikator</th>
                                    <th>Persentase Capaian Verifikator ( % )</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php
                                                                $count_row = 0;
                                                                $count_ep = 0;

                                                                //untuk utd, lab, dan pm
                                                                $persen80 = 0;
                                                                $persen20 = 0;
                                                                $persen0 = 0;
                                                                $persenSKP = 0;

                                                                //untuk puskesmas dan klinik
                                                                $persenbab1 = 0;
                                                                $persenbab2 = 0;
                                                                $persenbab3 = 0;
                                                                $persenbab4 = 0;
                                                                $persenbab5 = 0;

                                                                // var_dump($count_trans);
                                                                $n = 1;
                                                                foreach ($count_trans as $count_trans) {
                                                                    $count_row++;
                                                                    // $key = $datab['id'];    
                                                                    if ($count_trans['ep_terisi'] != $count_trans['total_ep']) {
                                                                        $count_ep++;
                                                                    }

                                                                    if ($data[0]['jenis_fasyankes'] == 6 || $data[0]['jenis_fasyankes'] == 7) {
                                                                        if ($count_trans['bab'] == 1) {
                                                                            if (number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') >= 80) {
                                                                                $persenSKP = 2;
                                                                            } else if (number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') < 80 && number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') >= 70) {
                                                                                $persenSKP = 1;
                                                                            } else {
                                                                                $persenSKP = 0;
                                                                            }
                                                                        } else {
                                                                            if (number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') >= 80) {
                                                                                $persen80++;
                                                                            } else if (number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') < 80 && number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') >= 20) {
                                                                                $persen20++;
                                                                            } else {
                                                                                $persen0++;
                                                                            }
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

                                                                ?>
                                                                    <tr>
                                                                        <td><?= $n; ?></td>
                                                                        <td><?= $count_trans['bab'] ?></td>
                                                                        <td><?= $count_trans['nama_bab'] ?></td>
                                                                        <td><?= $count_trans['ep_terisi'] ?></td>
                                                                        <td><?= $count_trans['total_ep'] ?></td>
                                                                        <td><?= $count_trans['skor_capaian_surveior'] ?></td>
                                                                        <td><?= $count_trans['skor_maksimal_surveior'] ?></td>
                                                                        <td><?= number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') ?></td>
                                                                        <!-- <td><?= $count_trans['skor_capaian_verifikator'] ?></td>
                                    <td><?= $count_trans['skor_maksimal_verifikator'] ?></td>
                                    <td><?= number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '') ?></td> -->
                                                                    </tr>

                                                                <?php


                                                                    $n++;
                                                                }

                                                                // var_dump($persenSKP);
                                                                // var_dump($persen80);

                                                                if ($data[0]['jenis_fasyankes'] == 6) {
                                                                    if ($count_row == 9) {
                                                                        if ($persen80 == 8 && $persenSKP == 2) {
                                                                            $status_rekomendasi_surveior = "Paripurna";
                                                                        } else if ($persen80 >= 5 && $persen80 < 9 && $persen0 == 0 && $persenSKP == 2) {
                                                                            $status_rekomendasi_surveior = "Utama";
                                                                        } else if ($persen80 >= 2 && $persen80 < 5 && $persen0 == 0 && $persenSKP == 2) {
                                                                            $status_rekomendasi_surveior = "Madya";
                                                                        } else {
                                                                            $status_rekomendasi_surveior = "Tidak Terakreditasi";
                                                                        }
                                                                    } else {
                                                                        $status_rekomendasi_surveior = "Belum Selesai Dinilai";
                                                                    }
                                                                } else if ($data[0]['jenis_fasyankes'] == 7) {
                                                                    if ($count_row == 7) {
                                                                        if ($persen80 == 6 && $persenSKP == 2) {
                                                                            $status_rekomendasi_surveior = "Paripurna";
                                                                        } else if ($persen80 >= 4 && $persen80 < 7 && $persen0 == 0 && $persenSKP == 2) {
                                                                            $status_rekomendasi_surveior = "Utama";
                                                                        } else if ($persen80 >= 2 && $persen80 < 4 && $persen0 == 0 && $persenSKP == 2) {
                                                                            $status_rekomendasi_surveior = "Madya";
                                                                        } else {
                                                                            $status_rekomendasi_surveior = "Tidak Terakreditasi";
                                                                        }
                                                                    } else {
                                                                        $status_rekomendasi_surveior = "Belum Selesai Dinilai";
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
                                                                }

                                                                //var_dump($status_rekomendasi_surveior);
                                                                ?>

                                                            </tbody>
                                                        </table>

                                                    </div>


                                                </div>

                                                <!-- <a href="#" class="btn icon btn-success">Submit</a> -->
                                                <input type="hidden" name="penetapan_tanggal_survei_id" value="<?= $data[0]['penetapan_tanggal_survei_id']; ?>">
                                                <input type="hidden" name="id_pengajuan" value="<?= $id; ?>">
                                                <?php
                                                // var_dump($data[0]['status_final_ep']);
                                                // var_dump($rows_bab);
                                                // var_dump($rows_trans);

                                                // if($session_id == $data[0]['surveior_satu']){

                                                //     if ((!empty($data[0]['status_final_ep']) ? $data[0]['status_final_ep'] : '') != '1'){
                                                //         if($rows_bab == $rows_trans){
                                                //             $disabled_final ="";
                                                //         } else {
                                                //             $disabled_final ="disabled";
                                                //         }
                                                //     
                                                ?>
                                                <!-- <button type="submit" class="btn btn-success rounded-pill" <?= $disabled_final ?>>Final</button>  -->
                                                <?php
                                                //     }
                                                // }
                                                ?>



                                                <?php
                                                // if ($data[0]['status_surveior_satu'] == 1) {
                                                // var_dump($data_surveior_lapangan[0]['jabatan_surveior_id_satu']);
                                                // var_dump($data_surveior_lapangan[0]['surveior_satu_baru_user_id']);

                                                // var_dump($session_id);
                                                if (!empty(!empty($data_surveior_lapangan[0]['surveior_satu_baru_user_id']) ? $data_surveior_lapangan[0]['surveior_satu_baru_user_id'] : '')) {
                                                    // if ($session_id == $data[0]['surveior_satu']) {
                                                    if ($session_id == $data_surveior_lapangan[0]['surveior_satu_baru_user_id']) {
                                                        // echo 'Cocok ID';
                                                        if ($data_surveior_lapangan[0]['jabatan_surveior_id_satu'] == 1) {
                                                            // echo 'Cocok Jabatan';
                                                            // echo (!empty($data[0]['status_final_ep']) ? $data[0]['status_final_ep'] : 'halo');
                                                            if ((!empty($data[0]['status_final_ep']) ? $data[0]['status_final_ep'] : 0) != 1) {
                                                                // echo 'belum final';
                                                                if ($rows_bab == $rows_trans && $count_ep == 0) {
                                                                    $disabled_final = "";
                                                ?>
                                                                    <button type="submit" class="btn btn-success rounded-pill" <?= $disabled_final ?>>Final</button>
                                                                <?php
                                                                } else {
                                                                    $disabled_final = "disabled";
                                                                }
                                                                ?>
                                                                </br>
                                                                <h3>Tombol Final akan muncul setelah semua EP terisi</h3>
                                                                <!-- <button type="submit" class="btn btn-success rounded-pill" <?= $disabled_final ?>>Final</button> -->
                                                                <?php
                                                            } else {
                                                                // echo 'sudah final';
                                                            }
                                                        }
                                                    }
                                                } else {
                                                }
                                                // } else  if ($data[0]['status_surveior_dua'] == 1) {
                                                if (!empty(!empty($data_surveior_lapangan[0]['surveior_dua_baru_user_id']) ? $data_surveior_lapangan[0]['surveior_dua_baru_user_id'] : '')) {
                                                    // if ($session_id == $data[0]['surveior_dua']) {
                                                    if ($session_id == $data_surveior_lapangan[0]['surveior_dua_baru_user_id']) {
                                                        if ($data_surveior_lapangan[0]['jabatan_surveior_id_dua'] == 1) {
                                                            if ((!empty($data[0]['status_final_ep']) ? $data[0]['status_final_ep'] : 0) != '1') {
                                                                if ($rows_bab == $rows_trans && $count_ep == 0) {
                                                                    $disabled_final = "";
                                                                ?>
                                                                    <button type="submit" class="btn btn-success rounded-pill" <?= $disabled_final ?>>Final</button>
                                                                <?php
                                                                } else {
                                                                    $disabled_final = "disabled";
                                                                }
                                                                ?>
                                                                </br>
                                                                <h3>Tombol Final akan muncul setelah semua EP terisi</h3>
                                                                <!-- <button type="submit" class="btn btn-success rounded-pill" <?= $disabled_final ?>>Final</button> -->
                                                <?php
                                                            }
                                                        }
                                                    }
                                                } else {
                                                }
                                                // }
                                                ?>
                                            </form>

                                        </div>

                                        <!--  -->

                                    </section>

                                    <section class="section">
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>Status Penilaian Surveior</h4>
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
                                        </div>
                                    </section>




                                </div>
                            </div>
                            <!-- Tab Baru -->

                            <!-- Tab Baru -->
                            <div class="tab-pane fade show" id="kesepakatan" role="tabpanel" aria-labelledby="kesepakatan-tab">
                                <div class="page-heading">
                                    <div class="page-title">

                                    </div>
                                    <section class="section">

                                        <div class="card">
                                            <!-- <div class="card-header">
               
            </div> -->
                                            <!-- <?php echo form_open_multipart('surveior/final_ep/') ?> -->
                                            <!-- <form role="form" method="post" class="login-form" name="form_valdation"> -->
                                            <!-- <div class="row"> -->
                                            <div class="card-body">
                                                <!-- </br> -->
                                                <div class="row">
                                                    <table class="table table-striped" id="table1">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Nama</th>
                                                                <th>Data</th>
                                                                <!-- <th>Catatan</th> -->

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <tr>
                                                                <td>1</td>
                                                                <td>Link Dokumen Pendukung Elemen Penilaian (EP)</td>

                                                                <td>
                                                                    <a target="_blank" href="<?= prep_url($data[0]['url_dokumen_pendukung_ep']); ?>"><?= (!empty($data[0]['url_dokumen_pendukung_ep']) ? $data[0]['url_dokumen_pendukung_ep'] : '') ?></a>

                                                                </td>


                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>Surat Tugas</td>

                                                                <td>
                                                                    <?php if (!empty($data[0]['url_surat_tugas'])) {
                                                                    ?>
                                                                        <a href="<?= $data[0]['url_surat_tugas']; ?>" target="_blank" class="btn btn-primary rounded-pill">View</a>
                                                                        <?php
                                                                    } else {
                                                                        if (!empty($surtug[0]['nama_file'])) {
                                                                        ?>
                                                                            <a href="<?= 'https://sinar.kemkes.go.id/assets/surtug/' . $surtug[0]['nama_file']; ?>" target="_blank" class="btn btn-primary rounded-pill">View</a>
                                                                    <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>Metode Survei</td>

                                                                <td><?= $data[0]['nama_metode']; ?>

                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td>Tanggal Survei</td>
                                                                <td>
                                                                    <?php
                                                                    foreach ($detail_pengajuan as $datab) {

                                                                        $timestamp = strtotime($datab['tanggal_survei']);
                                                                        $date_formated = date('d-m-Y', $timestamp);
                                                                    ?>
                                                                        <?= $date_formated; ?><br>

                                                                    <?php }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>


                                                </div>


                                            </div>



                                            <!-- </form> -->

                                        </div>

                                        <!--  -->

                                    </section>





                                </div>
                            </div>
                            <!-- Tab Baru -->

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

<!-- <script src="<?php echo base_url() ?>assets/js/extensions/simple-datatables.js"></script> -->

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
    });

    //     $('[name="skor_capaian_surveior"]').change(function(){
    //   alert($skor);
    //     });
    //     $skor =  $('[name="skor_capaian_surveior"]').val();
    //                             console.log($skor);
    // $tes = $cek + $data['skor_maksimal'];
    $tes2 = $('#apa').val();
    $('[name="skor_capaian_surveior"]').on('change', function() {
        $tes = $("#presentase_capaian_surveior").val($(this).find(":selected").val() * 100 / $tes2);



    });
</script>

<script>
    $(document).ready(function() {
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        //alert('tes');
        $("#table1").on('change', '.skor_capaian_surveior', function() {

            var currentRow = $(this).closest("tr");
            var nomor = currentRow.find("td:eq(0)").text();
            var nilaicapaian = currentRow.find('td').eq(6).find('select option:selected').text().replace(/\,/g, '');
            // alert(nilaicapaian);
            var nilaiMax = currentRow.find("td:eq(7)").text();
            if (nilaicapaian == "TDD") {
                $("#presentase_capaian_surveior" + nomor).val("TDD");
                currentRow.find("td:eq(7)").text("TDD");

                $("#fakta_dan_analisis" + nomor).removeAttr('required'); //turns required off
                $("#rekomendasi" + nomor).removeAttr('required'); //turns required off

            } else {
                if (nilaiMax == "TDD") {
                    var persentase = (nilaicapaian / 10) * 100
                    $("#presentase_capaian_surveior" + nomor).val(persentase);
                } else {
                    var persentase = (nilaicapaian / nilaiMax) * 100
                    $("#presentase_capaian_surveior" + nomor).val(persentase);
                }
                currentRow.find("td:eq(7)").text("10");

                $("#fakta_dan_analisis" + nomor).attr('required', ''); //turns required on


                if (nilaicapaian == "10" || nilaicapaian == 10) {
                    $("#rekomendasi" + nomor).removeAttr('required'); //turns required off
                } else {
                    $("#rekomendasi" + nomor).attr('required', ''); //turns required on
                }
            }

        });

        var nilai = $('#test').val(); //alert(nilai);
        if (nilai != 1) {
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
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
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


    })
</script>