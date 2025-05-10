<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penerbitan Sertifikat Akreditasi</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/jquery-ui.css">
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
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                                        aria-controls="home" aria-selected="true">Penerbitan Sertifikat Akreditasi</a>
                                </li>
                                <!-- <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contacta-tab" data-bs-toggle="tab" href="#contacta" role="tab"
                            aria-controls="contacta" aria-selected="false">Kesiapan Survei  </a>
                    </li>
                    <li class="nav-item" role="presentation">
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
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php //var_dump($data);
                                                            ?>

                                                            <?php echo form_open_multipart('kemenkes/simpanPenerbitan/') ?>
                                                            <form role="form" method="post" class="login-form" name="form_valdation">

                                                                <div class="form-group">
                                                                    <label for="disabledInput">Kode Fasyankes</label>
                                                                    <input type="text" class="form-control" id="fasyankes_id" name="fasyankes_id" placeholder="Kode Fasyankes" value="<?= $data[0]['fasyankes_id']; ?>"
                                                                        readonly>
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
                                                                    <input type="text" class="form-control" id="jenis_fasyankes" name="jenis_fasyankes" placeholder="Jenis Fasyankes" value="<?= $jenis_fasyankes; ?>"
                                                                        readonly>

                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="helperText">Nama LPA</label>
                                                                    <!-- <input type="text" id="namelpa" class="form-control" placeholder="NameLPA" value='<?= $data[0]['lpa_id']; ?>' > -->
                                                                    <!-- <input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-1" aria-autocomplete="list" aria-activedescendant="bs-select-1-11"> -->
                                                                    <?= form_dropdown('lpa_id', array('1' => 'LPA 1', '2' => 'LPA 2', '3' => 'LPA 3', '4' => 'LPA 4'), $data[0]['lpa_id'], 'id="lpa_id"  class="form-control" disabled'); ?>
                                                                </div>
                                                                <!-- <div class="bs-searchbox">
                            <input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-1" aria-autocomplete="list" aria-activedescendant="bs-select-1-11"></div>
                         -->
                                                                <div class="form-group">
                                                                    <p>Jenis Survei</p>
                                                                    <fieldset class="form-group">
                                                                        <!-- <select class="form-select" id="survei">
                                            <option value='survei'>Survei</option>
                                            <option value='remedial'>Survei Remedial</option>
                                            
                                        </select> -->
                                                                        <?= form_dropdown('jenis_survei_id', array('1' => 'Survei', '2' => 'Survei Remedial'), $data[0]['jenis_survei_id'], 'id="jenis_survei_id"  class="form-control" disabled'); ?>
                                                                    </fieldset>
                                                                </div>
                                                                <div class="form-group">
                                                                    <p>Jenis Akreditasi</p>

                                                                    <!-- <select class="form-select akreditasi" id="akreditasi">
                                            <option value='perdana'>Perdana</option>
                                            <option value='reakreditasi'>Reakreditasi</option>
                                            
                            </select> -->
                                                                    <?= form_dropdown('jenis_akreditasi_id', array('1' => 'Perdana', '2' => 'Reakreditasi'), $data[0]['jenis_akreditasi_id'], 'id="jenis_akreditasi_id"  class="form-control" disabled'); ?>

                                                                </div>

                                                                <?php
                                                                if ($data[0]['jenis_akreditasi_id'] == 2) {
                                                                    $var_style_status = "block";
                                                                    $var_style_sertifikat = "block";
                                                                    $var_style_tgl_akhir = "block";
                                                                } else {
                                                                    $var_style_status = "none";
                                                                    $var_style_sertifikat = "none";
                                                                    $var_style_tgl_akhir = "none";
                                                                }
                                                                ?>

                                                                <div class="form-group status" style="display:<?= $var_style_status ?>" id='status'>
                                                                    <label for="disabledInput">Status Akreditasi Sebelumnya</label>
                                                                    <!-- <select class="form-select akreditasi" id="statusakreditasi">
                                            <option value='paripurna'>Paripurna</option>
                                            <option value='utama'>Utama</option>
                                            <option value='madya'>Madya</option>
                                            <option value='dasar'>Dasar</option>
                                            
                            </select> -->
                                                                    <?= form_dropdown('status_akreditasi_id', array('1' => 'Paripurna', '2' => 'Utama', '3' => 'Madya', '4' => 'Dasar'), $data[0]['status_akreditasi_id'], 'id="status_akreditasi_id"  class="form-control" disabled'); ?>
                                                                </div>
                                                                <div class="form-group" style="display:<?= $var_style_sertifikat ?>">
                                                                    <label for="disabledInput">Sertifikat Akreditasi Sebelumnya / Surat Penetapan</label>
                                                                    <fieldset>
                                                                        <div class="input-group">
                                                                            <!-- <input type="file" class="form-control" id="inputGroupFile04"
                                                aria-describedby="inputGroupFileAddon04" aria-label="Upload" disabled> -->
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
                                                                <div class="form-group">
                                                                    <label for="helperText">Tanggal Survei</label>
                                                                    <div class="row">

                                                                        <div class="col-md-4">
                                                                            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="<?= $data[0]['tanggal_awal_rencana_survei'] ?>" disabled>
                                                                        </div>
                                                                        s.d.
                                                                        <div class="col-md-4">
                                                                            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="<?= $data[0]['tanggal_akhir_rencana_survei'] ?>" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <input type="date" id="tanggalpengajuan" class="form-control" > -->
                                                                    <!-- <input type="text"  name="tanggal_rencana_survei" id="datepickerstr" value="<?= $data[0]['tanggal_rencana_survei'] ?>"  class="form-control datepicker"  autocomplete="off"  disabled> -->
                                                                </div>

                                                                <div class="form-group">
                                                                    <p>Status Akreditasi</p>
                                                                    <input type="text" class="form-control" id="status_akreditasi" name="status_akreditasi" placeholder="Status Akreditas" value="Utama" readonly>
                                                                </div>

                                                                <div class="form-group">
                                                                    <p>Nomor Sertifikat</p>
                                                                    <input type="text" class="form-control" id="nomor_sertifikat" name="nomor_sertifikat" placeholder="Nomor Sertifikat" value="<?= (!empty($data[0]['nomor_sertifikat']) ? $data[0]['nomor_sertifikat'] : '') ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <p>Tanggal Penetapan</p>
                                                                    <input type="date" class="form-control" id="tanggal_penetapan" name="tanggal_penetapan" value="<?= (!empty($data[0]['tanggal_penetapan']) ? $data[0]['tanggal_penetapan'] : '') ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <p>Tanggal Berakhir Berlaku</p>
                                                                    <input type="date" class="form-control" id="tanggal_berakhir_berlaku" name="tanggal_berakhir_berlaku" value="<?= (!empty($data[0]['tanggal_berakhir_berlaku']) ? $data[0]['tanggal_berakhir_berlaku'] : '') ?>">
                                                                </div>

                                                                <div class="col-md-6 mb-1">
                                                                    <p>Dokumen Sertifikat/Surat Keterangan Tidak Lulus</p>
                                                                    <fieldset>
                                                                        <div class="input-group">
                                                                            <!-- Input untuk URL Google Drive -->
                                                                            <input type="text" class="form-control" id="url_dokumen_sertifikat" name="url_dokumen_sertifikat"
                                                                                aria-describedby="inputGroupFileAddon04" aria-label="Masukkan Link Google Drive"
                                                                                placeholder="Masukkan URL Google Drive"
                                                                                value="<?= isset($data[0]['url_dokumen_sertifikat']) ? $data[0]['url_dokumen_sertifikat'] : '' ?>">
                                                                        </div>

                                                                        <?php
                                                                        // Mengecek apakah ada URL yang sudah ada (bisa berupa file atau link)
                                                                        if (!empty($data[0]['url_dokumen_sertifikat'])) {
                                                                            $url_dokumen_sertifikat = $data[0]['url_dokumen_sertifikat'];

                                                                            // Mengecek apakah URL adalah link Google Drive
                                                                            if (filter_var($url_dokumen_sertifikat, FILTER_VALIDATE_URL) && strpos($url_dokumen_sertifikat, 'drive.google.com') !== false) {
                                                                                // Jika URL adalah Google Drive, tampilkan link ke Google Drive
                                                                                echo '<a class="btn btn-success rounded-pill" target="_blank" href="' . $url_dokumen_sertifikat . '">Lihat Dokumen (Google Drive)</a>';
                                                                            } else {
                                                                                // Jika URL bukan Google Drive, tampilkan link umum
                                                                                echo '<a class="btn btn-success rounded-pill" target="_blank" href="' . $url_dokumen_sertifikat . '">Lihat Dokumen</a>';
                                                                            }
                                                                        } else {
                                                                            $url_dokumen_sertifikat = "";
                                                                        }
                                                                        ?>

                                                                        <!-- Menyimpan URL lama -->
                                                                        <input type="hidden" name="old_url_dokumen_sertifikat" value="<?= $url_dokumen_sertifikat ?>" id="old_url_dokumen_sertifikat">
                                                                    </fieldset>

                                                                </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <input type="hidden" name="pengiriman_rekomendasi_id" value="<?= $data[0]['pengiriman_rekomendasi_id']; ?>">
                                                <input type="hidden" name="id_pengajuan" value="<?= $id; ?>">
                                                <button type="submit" class="btn btn-primary rounded-pill">Submit</button>
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
    <script src="<?php echo base_url() ?>assets/js/app.js">

    </script>

</body>

</html>

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script type="text/javascript">



</script>

<script>
    $(function() {
        $("#datepicker").datepicker();
        $("#datepickerstr").datepicker();
    });

    $('#tanggal_penetapan').change(function() {
        $("#tanggal_berakhir_berlaku").removeAttr('disabled'); //turns disabled off
        var tanggal_min = $('#tanggal_penetapan').val();
        $('#tanggal_berakhir_berlaku').val("");
        document.getElementById("tanggal_berakhir_berlaku").setAttribute("min", tanggal_min);

        // var tanggal_max = tanggal_min +1;
        // var tanggal_max = new Date(tanggal_min);
        // tanggal_max.setDate(tanggal_max.getDate() + 1);

        // alert($('#jumlah_hari_survei').val());
        var dateStr = tanggal_min;
        var days = 1825;

        var result = new Date(new Date(dateStr).setDate(new Date(dateStr).getDate() + days));
        document.getElementById("tanggal_berakhir_berlaku").setAttribute("max", result.toISOString().substr(0, 10));
        $('#tanggal_berakhir_berlaku').val(result.toISOString().substr(0, 10));

    });
</script>