<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Lembaga</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main/app-dark.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png'); ?>" type="image/png">

</head>

<body>
    <?php
    include('template/sidebar.php');
    $lpa_id = '';

    ?>
    <section class="section">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Input Data Ketua Lembaga</h4>
                </div>
                <?php echo form_open_multipart('User/simpanKetuaLPA') ?>
                <form role="form" method="post" class="login-form" name="form_validation">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="lpa">LPA</label>

                                    <?= form_dropdown('lpa_id', dropdown_sina_lpa(), $lpa_id, 'id="id"  class="form-select"'); ?>
                                    <!-- <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama"  required> -->

                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email" onchange="checknama(this.value, this.id)" required>
                                </div>

                                <div class="form-group">
                                    <label for="no_hp">No Hp</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan No HP">
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-group col-md-6">
                                        <label for="helperText">Surat Keputusan Penunjukan</label>
                                        <div class="input-group">
                                            <!-- Input untuk URL Dokumen Surat Keputusan Penunjukan -->
                                            <input type="text" class="form-control" id="dokumen_sk_penunjukan" name="dokumen_sk_penunjukan"
                                                aria-describedby="inputGroupFileAddon04" aria-label="Masukkan Link Surat Keputusan Penunjukan"
                                                placeholder="Masukkan URL Surat Keputusan Penunjukan"
                                                value="<?= isset($data[0]['dokumen_sk_penunjukan']) ? $data[0]['dokumen_sk_penunjukan'] : '' ?>">

                                            <?php
                                            // Mengecek apakah ada URL yang sudah ada
                                            if (!empty($data[0]['dokumen_sk_penunjukan'])) {
                                                $dokumen_sk_penunjukan = $data[0]['dokumen_sk_penunjukan'];
                                                // Menampilkan link dokumen jika URL sudah ada
                                                echo '<a class="btn btn-primary rounded-pill" target="_blank" href="' . $dokumen_sk_penunjukan . '">Lihat Dokumen</a>';
                                            } else {
                                                $dokumen_sk_penunjukan = "";
                                            }
                                            ?>

                                            <!-- Menyimpan URL lama -->
                                            <input type="hidden" name="old_dokumen_sk_penunjukan" value="<?= $dokumen_sk_penunjukan ?>" id="old_dokumen_sk_penunjukan">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="helperText">Tanggal Mulai Aktif Sebagai Ketua Lembaga</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="date" name="tanggal_aktif" id="datepicker" class="form-control datepicker" value="">
                                        </div>
                                        s.d.
                                        <div class="col-md-4">
                                            <input type="date" name="tanggal_nonaktif" id="datepickerstr" class="form-control datepicker" value="">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
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
        $(function() {
            $("#datepicker").datepicker();
            $("#datepickerstr").datepicker();
            $("#tanggal_survei").datepicker();

        });
    </script>

</body>

</html>