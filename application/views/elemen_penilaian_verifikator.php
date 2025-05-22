<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elemen Penilaian Verifikator</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/jquery-ui.css">
    <script src="<?php echo base_url('assets/temp'); ?>/jquery-3.6.0.js"></script>
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
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">Elemen Penilaian Verifikator</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="persentase-tab" data-bs-toggle="tab" href="#persentase" role="tab"
                                    aria-controls="persentase" aria-selected="false">Persentase Capaian</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="page-heading">
                                    <div class="page-title">
                                    </div>

                                    <section class="section">
                                        <div class="card">
                                            <div class="card-header">
                                                Nama Verifikator : Verifikator 1
                                            </div>
                                            <div class="card-body">
                                                <?php echo form_open_multipart('verifikator/epverifikator/' . $id) ?>
                                                <form role="form" method="post" class="login-form" name="form_valdation">
                                                    <div class="form-group row align-items-center">
                                                        <div class="col-lg-2 col-3">
                                                            <label class="col-form-label">BAB</label>
                                                        </div>
                                                        <div class="col-lg-10 col-9">
                                                            <?= form_dropdown('bab', dropdown_sina_ep($data[0]['jenis_fasyankes']), $bab, 'id="bab"  class="form-select" required'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="buttons">
                                                        <button type="submit" class="btn btn-success me-1 mb-1">Cari</button>
                                                    </div>
                                                </form>

                                                <?php echo form_open_multipart('verifikator/simpanEp/') ?>
                                                <form role="form" method="post" class="login-form" name="form_valdation">
                                                    <div class="table-responsive" style="overflow-x:auto; width: 100%;">
                                                        <?php
                                                        if ((int)$jenis_akreditasi === 3) {
                                                        ?>
                                                            <style>
                                                                /* Ensure the table width is 100% */
                                                                table#table1 {
                                                                    width: 100%;
                                                                }

                                                                /* Apply custom width to the header and data cells for 'Keterangan' */
                                                                th.keterangan-column,
                                                                td.keterangan-column {
                                                                    width: 300px !important;
                                                                    /* You can adjust this as needed */
                                                                }

                                                                /* Optional: If you want the textarea inside the cell to expand and take up full width */
                                                                td.keterangan-column textarea {
                                                                    width: 100%;
                                                                }
                                                            </style>
                                                            <table class="table table-bordered table-striped" id="table1">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col" class="text-center">No</th>
                                                                        <th scope="col" class="text-center">Bab</th>
                                                                        <th scope="col" class="text-center">Standar</th>
                                                                        <th scope="col" class="text-center">Kriteria</th>
                                                                        <th scope="col" class="text-center">Elemen Penilaian</th>
                                                                        <th scope="col" class="w-25">Uraian</th>
                                                                        <th scope="col" class="text-center">SKOR Capaian Surveior</th>
                                                                        <th scope="col" class="text-center">SKOR Maksimal</th>
                                                                        <th scope="col" class="text-center">Persentase Capaian Surveior</th>

                                                                        <th scope="col" class="w-25">FAKTA DAN ANALISIS Pengajuan Lama</th>
                                                                        <th scope="col" class="w-25">REKOMENDASI Hasil Survei Pengajuan Lama</th>

                                                                        <th scope="col" class="w-25">FAKTA DAN ANALISIS Pengajuan Saat ini</th>
                                                                        <th scope="col" class="w-25">REKOMENDASI Hasil Survei Pengajuan Saat ini</th>

                                                                        <th scope="col" class="text-center">SKOR Capaian Verifikator</th>
                                                                        <th scope="col" class="text-center">Persentase Capaian Verifikator</th>
                                                                        <th scope="col" class="keterangan-column text-center">Keterangan</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $n = 1;
                                                                    foreach ($datab as $datab) {
                                                                        $key = $datab['id'];

                                                                        if ($data[0]['status_final_ep_verifikator'] != '1') {
                                                                            $nilai = 0;
                                                                        } else {
                                                                            $nilai = 1;
                                                                        }
                                                                    ?>
                                                                        <input type="hidden" class="form-control" id="test" name="test" value="<?= $nilai; ?>">
                                                                        <tr>
                                                                            <td><?= $n; ?></td>
                                                                            <td>
                                                                                <?= $datab['bab'] ?>
                                                                            </td>
                                                                            <td><?= $datab['standar'] ?></td>
                                                                            <td><?= $datab['kriteria'] ?></td>
                                                                            <td><?= $datab['elemen'] ?></td>
                                                                            <td><?= $datab['keterangan_elemen'] ?></td>


                                                                            <td><?= (!empty($trans2[$key]['skor_capaian_surveior']) ? $trans2[$key]['skor_capaian_surveior'] : 0) ?> </td>
                                                                            <?php
                                                                            if ((!empty($trans2[$key]['skor_capaian_surveior']) ? $trans2[$key]['skor_capaian_surveior'] : '') == "TDD") {
                                                                            ?>
                                                                                <td>TDD</td>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <td><?= $datab['skor_maksimal'] ?> </td>
                                                                            <?php
                                                                            }
                                                                            ?>

                                                                            <td><?= (!empty($trans2[$key]['persentase_capaian_surveior']) ? $trans2[$key]['persentase_capaian_surveior'] : 0) ?></td>

                                                                            <td><?= (!empty($trans[$key]['fakta_dan_analisis']) ? $trans[$key]['fakta_dan_analisis'] : '') ?></td>
                                                                            <td><?= (!empty($trans[$key]['rekomendasi']) ? $trans[$key]['rekomendasi'] : '') ?></td>


                                                                            <td><?= (!empty($trans2[$key]['fakta_dan_analisis']) ? $trans2[$key]['fakta_dan_analisis'] : '') ?></td>
                                                                            <td><?= (!empty($trans2[$key]['rekomendasi']) ? $trans2[$key]['rekomendasi'] : '') ?></td>

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

                                                                                <td><textarea class="form-control" data-toggle="tooltip" data-placement="top" title="Minimal 30 Karakter" rows="4" cols="50" id="keterangan<?= $n ?>" minlength="30" name="keterangan[<?= $key; ?>]" <?= $required_text; ?> placeholder="Enter at least 30 characters"><?= (!empty($trans[$key]['keterangan']) ? $trans[$key]['keterangan'] : '') ?></textarea></td>
                                                                            <?php
                                                                            }
                                                                            ?>

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
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <table class="table table-bordered table-striped" id="table1">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col" class="text-center">No</th>
                                                                        <th scope="col" class="text-center">Bab</th>
                                                                        <th scope="col" class="text-center">Standar</th>
                                                                        <th scope="col" class="text-center">Kriteria</th>
                                                                        <th scope="col" class="text-center">Elemen Penilaian</th>
                                                                        <th scope="col" class="w-25">Uraian</th>
                                                                        <th scope="col" class="text-center">SKOR Capaian Surveior</th>
                                                                        <th scope="col" class="text-center">SKOR Maksimal</th>
                                                                        <th scope="col" class="text-center">Persentase Capaian Surveior</th>
                                                                        <th scope="col" class="w-25">FAKTA DAN ANALISIS</th>
                                                                        <th scope="col" class="w-25">REKOMENDASI Hasil Survei</th>
                                                                        <th scope="col" class="text-center">SKOR Capaian Verifikator</th>
                                                                        <th scope="col" class="text-center">Persentase Capaian Verifikator</th>
                                                                        <th scope="col" class="w-25">Keterangan</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $n = 1;
                                                                    foreach ($datab as $datab) {
                                                                        $key = $datab['id'];

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
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                            </div>
                                            <input type="hidden" name="penetapan_tanggal_survei_id" value="<?= $data[0]['penetapan_tanggal_survei_id']; ?>">
                                            <input type="hidden" name="id_pengajuan" value="<?= $id; ?>">

                                            <?php
                                            if ((!empty($data[0]['status_final_ep_verifikator']) ? $data[0]['status_final_ep_verifikator'] : '') != '1') {
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

                            <!-- Tab Baru -->
                            <div class="tab-pane fade show" id="persentase" role="tabpanel" aria-labelledby="persentase-tab">
                                <div class="page-heading">
                                    <div class="page-title">

                                    </div>
                                    <section class="section">

                                        <div class="card">
                                            <div class="card-header">

                                            </div>
                                            <?php echo form_open_multipart('verifikator/final_ep/') ?>
                                            <form role="form" method="post" class="login-form" name="form_valdation">
                                                <div class="card-body">
                                                    </br>
                                                    <div class="row">
                                                        <table class="table table-striped" id="table2">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Bab</th>
                                                                    <th>Nama Bab </th>
                                                                    <th>Skor Capaian Surveior</th>
                                                                    <th>Skor Maksimal Surveior</th>
                                                                    <th>Persentase Capaian Surveior ( % )</th>
                                                                    <th>EP Terisi Verifikator</th>
                                                                    <th>Total EP </th>
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
                                                                $count_ep = 0;

                                                                //untuk utd, lab, dan pm
                                                                $persen80 = 0;
                                                                $persen20 = 0;
                                                                $persen0 = 0;
                                                                $persenSKP = 0;

                                                                $persen80_verifikator = 0;
                                                                $persen20_verifikator = 0;
                                                                $persen0_verifikator = 0;
                                                                $persenSKP_verifikator = 0;

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

                                                                // var_dump($count_trans);

                                                                $n = 1;
                                                                foreach ($count_trans as $count_trans) {
                                                                    $count_row++;
                                                                    // $key = $datab['id'];
                                                                    if ($count_trans['ep_terisi_verifikator'] != $count_trans['total_ep']) {
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

                                                                    //penilaian verifikator
                                                                    if (!empty($count_trans['persentase_capaian_verifikator'])) {
                                                                        $count_row_verifikator++;

                                                                        if ($data[0]['jenis_fasyankes'] == 6 || $data[0]['jenis_fasyankes'] == 7) {
                                                                            // if (number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '') >= 80){
                                                                            //     $persen80_verifikator++ ;
                                                                            // } else if(number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '') < 80 && number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') >= 20){
                                                                            //     $persen20_verifikator++ ;
                                                                            // } else {
                                                                            //     $persen0_verifikator++ ;
                                                                            // }

                                                                            if ($count_trans['bab'] == 1) {
                                                                                if (number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '') >= 80) {
                                                                                    $persenSKP_verifikator = 2;
                                                                                } else if (number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '') < 80 && number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '') >= 70) {
                                                                                    $persenSKP_verifikator = 1;
                                                                                } else {
                                                                                    $persenSKP_verifikator = 0;
                                                                                }
                                                                            } else {
                                                                                if (number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '') >= 80) {
                                                                                    $persen80_verifikator++;
                                                                                } else if (number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '') < 80 && number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '') >= 20) {
                                                                                    $persen20_verifikator++;
                                                                                } else {
                                                                                    $persen0_verifikator++;
                                                                                }
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
                                                                        <td><?= $count_trans['nama_bab'] ?></td>
                                                                        <td><?= $count_trans['skor_capaian_surveior'] ?></td>
                                                                        <td><?= $count_trans['skor_maksimal_surveior'] ?></td>
                                                                        <td><?= number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') ?></td>
                                                                        <td><?= $count_trans['ep_terisi_verifikator'] ?></td>
                                                                        <td><?= $count_trans['total_ep'] ?></td>
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

                                                                    if ($count_row_verifikator == 9) {
                                                                        if ($persen80_verifikator == 8 && $persenSKP_verifikator == 2) {
                                                                            $status_rekomendasi_verifikator = "Paripurna";
                                                                        } else if ($persen80_verifikator >= 5 && $persen80_verifikator < 9 && $persen0_verifikator == 0 && $persenSKP_verifikator == 2) {
                                                                            $status_rekomendasi_verifikator = "Utama";
                                                                        } else if ($persen80_verifikator >= 2 && $persen80_verifikator < 5 && $persen0_verifikator == 0 && $persenSKP_verifikator == 2) {
                                                                            $status_rekomendasi_verifikator = "Madya";
                                                                        } else {
                                                                            $status_rekomendasi_verifikator = "Tidak Terakreditasi";
                                                                        }
                                                                    } else {
                                                                        $status_rekomendasi_verifikator = "Belum Selesai Dinilai";
                                                                    }
                                                                } else if ($data[0]['jenis_fasyankes'] == 7) {
                                                                    if ($count_row == 7) {
                                                                        if ($persen80 == 6 && $persenSKP = 2) {
                                                                            $status_rekomendasi_surveior = "Paripurna";
                                                                        } else if ($persen80 >= 4 && $persen80 < 7 && $persen0 == 0 && $persenSKP = 2) {
                                                                            $status_rekomendasi_surveior = "Utama";
                                                                        } else if ($persen80 >= 2 && $persen80 < 4 && $persen0 == 0 && $persenSKP = 2) {
                                                                            $status_rekomendasi_surveior = "Madya";
                                                                        } else {
                                                                            $status_rekomendasi_surveior = "Tidak Terakreditasi";
                                                                        }
                                                                    } else {
                                                                        $status_rekomendasi_surveior = "Belum Selesai Dinilai";
                                                                    }

                                                                    if ($count_row_verifikator == 7) {
                                                                        if ($persen80_verifikator == 6 && $persenSKP_verifikator == 2) {
                                                                            $status_rekomendasi_verifikator = "Paripurna";
                                                                        } else if ($persen80_verifikator >= 4 && $persen80_verifikator < 7 && $persen0_verifikator == 0 && $persenSKP_verifikator == 2) {
                                                                            $status_rekomendasi_verifikator = "Utama";
                                                                        } else if ($persen80_verifikator >= 2 && $persen80_verifikator < 4 && $persen0_verifikator == 0 && $persenSKP_verifikator == 2) {
                                                                            $status_rekomendasi_verifikator = "Madya";
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
                                                <input type="hidden" name="penetapan_verifikator_id" value="<?= $data[0]['penetapan_verifikator_id']; ?>">
                                                <!-- <?php var_dump($data); ?> -->
                                                <input type="hidden" name="id_pengajuan" value="<?= $id; ?>">
                                                <?php
                                                if ((!empty($data[0]['status_final_ep_verifikator']) ? $data[0]['status_final_ep_verifikator'] : '') != '1') {
                                                    if ($rows_bab == $rows_trans && $count_ep == 0) {
                                                        $disabled_final = "";
                                                    } else {
                                                        $disabled_final = "disabled";
                                                    }
                                                ?>
                                                    <button type="submit" class="btn btn-success rounded-pill" <?= $disabled_final ?>>Final</button>
                                                <?php
                                                }
                                                ?>
                                            </form>

                                        </div>
                                    </section>

                                    <section class="section">
                                        <div class="row">
                                            <div class="col-6 col-md-6 col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>Verifikasi Surveior</h4>
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
                            <!-- Tab Baru -->


    </section>
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

<script type="text/javascript">



</script>

<script>
    $(document).ready(function() {
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        //alert('tes');
        $("#table1").on('change', '.skor_capaian_verifikator', function() {

            var currentRow = $(this).closest("tr");
            var nomor = currentRow.find("td:eq(0)").text();
            var nilaicapaiansurveior = currentRow.find("td:eq(6)").text();

            var nilaicapaian = currentRow.find('td').eq(11).find('select option:selected').text().replace(/\,/g, '');
            // alert(nilaicapaian);
            var nilaiMax = currentRow.find("td:eq(7)").text();


            if (nilaicapaian == "TDD") {
                $("#persentase_capaian_verifikator" + nomor).val("TDD");
                //currentRow.find("td:eq(7)").text("TDD");

            } else {
                if (nilaiMax == "TDD") {
                    var persentase = (nilaicapaian / 10) * 100
                    $("#persentase_capaian_verifikator" + nomor).val(persentase);

                } else {
                    var persentase = (nilaicapaian / nilaiMax) * 100
                    $("#persentase_capaian_verifikator" + nomor).val(persentase);

                }
                //currentRow.find("td:eq(7)").text("10");
            }
            // alert(typeof nilaicapaian);
            // alert(typeof nilaicapaiansurveior);
            if (parseInt(nilaicapaian) == parseInt(nilaicapaiansurveior)) {
                // $("#keterangan"+nomor).val("TDD");
                $("#keterangan" + nomor).removeAttr('required'); //turns required off
            } else {
                // $("#keterangan"+nomor).val("TDD2");
                $("#keterangan" + nomor).attr('required', ''); //turns required on
            }


        });

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
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false
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