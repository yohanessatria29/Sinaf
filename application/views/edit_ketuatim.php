<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ketua Tim Kerja</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main/app-dark.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png'); ?>" type="image/png">

</head>

<body>
    <?php
    include('template/sidebar.php');
    // var_dump($data);
    $ketua_tim = $data[0]['lpa_id'];
    $status_keaktifan = $data[0]['status_keaktifan'];
    ?>

    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Data Ketua Tim Kerja</h4>
                        </div>
                        <?php echo form_open_multipart('User/simpanKetuatim') ?>
                        <form role="form" method="post" class="login-form" name="form_valdation">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik" onchange="checknikketua(this.value, this.id)" placeholder="Masukkan NIK" value="<?= $data[0]['nik'] ?>" disabled>
                                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $data[0]['id'] ?>">
                                            <input type="hidden" class="form-control" id="users_id" name="users_id" value="<?= $data[0]['users_id'] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" value="<?= $data[0]['nama'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="lpa">Ketua Tim Kerja</label>

                                            <?= form_dropdown('lpa_id', dropdown_sina_ketua_tim(), $ketua_tim, 'id="id"  class="form-select"'); ?>
                                            <!-- <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama"  required> -->

                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email" onchange="checkemail(this.value, this.id)" value="<?= $data[0]['email'] ?>" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="no_hp">No Hp</label>
                                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan No HP" value="<?= $data[0]['no_hp'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="status_keaktifan">Status Keaktifan</label>
                                            <fieldset class="form-group">
                                                <?= form_dropdown('status_keaktifan', array('Aktif' => 'Aktif', 'Non Aktif' => 'Non Aktif'), $status_keaktifan, 'id="status_keaktifan"  class="form-control"'); ?>
                                            </fieldset>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="form-group col-md-6">
                                                <label for="helperText">Surat Keputusan Penunjukan</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" id="dokumen_sk_penunjukan" name="dokumen_sk_penunjukan"
                                                        aria-describedby="inputGroupFileAddon04" aria-label="Upload">

                                                    <?php
                                                    // Check if the existing document is not empty
                                                    if (!empty($data[0]['dokumen_sk_penunjukan'])) {
                                                        $dokumen_sk_penunjukan = $data[0]['dokumen_sk_penunjukan'];

                                                        // Check if it's a URL (e.g., Google Drive or other URL)
                                                        if (filter_var($dokumen_sk_penunjukan, FILTER_VALIDATE_URL)) {
                                                            // If it's a URL, display it as a clickable link
                                                            echo '<a class="btn btn-primary rounded-pill" target="_blank" href="' . $dokumen_sk_penunjukan . '">Lihat Dokumen (Link)</a>';
                                                        } else {
                                                            // Otherwise, treat it as a file path and show the file (PDF or any other file type)
                                                            echo '<a class="btn btn-primary rounded-pill" target="_blank" href="' . base_url($dokumen_sk_penunjukan) . '">Lihat Dokumen (File)</a>';
                                                        }
                                                    }
                                                    ?>

                                                    <input type="hidden" name="old_dokumen_sk_penunjukan" value="<?= $dokumen_sk_penunjukan ?? '' ?>" id="old_dokumen_sk_penunjukan">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="helperText">Tanggal Mulai Aktif Sebagai Ketua Lembaga</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="date" name="tanggal_aktif" id="datepicker" class="form-control datepicker" value="<?= $data[0]['tanggal_aktif'] ?>">
                                                </div>
                                                s.d.
                                                <div class="col-md-4">
                                                    <input type="date" name="tanggal_nonaktif" id="datepickerstr" class="form-control datepicker" value="<?= $data[0]['tanggal_nonaktif'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <button type="submit" class="btn btn-primary me-1 mb-1">Edit</button>
                            </div>
                        </form>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/app.js">

    </script>
    <script>
        // Restricts input for the given textbox to the given inputFilter.
        function setInputFilter(textbox, inputFilter) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
                textbox.addEventListener(event, function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    } else {
                        this.value = "";
                    }
                });
            });
        }
        // Install input filters.
        setInputFilter(document.getElementById("nik"), function(value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 9999999999999999);
        });
        setInputFilter(document.getElementById("no_hp"), function(value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 999999999999);
        });
    </script>
    <script>
        function checkemail(val, inputbox) {
            // alert("The input value has changed. The new value is: " + val);
            var base_url = window.location.origin;
            var username = encodeURIComponent(val);
            var id_inputbox = document.getElementById(inputbox);

            $.ajax({
                url: base_url + '/user/checkemail/' + username,
                type: 'get',
                success: function(response) {
                    // alert(response);
                    $(this).val = "";
                    if (response > 0) {
                        id_inputbox.value = "";
                        alert('Email yang digunakan sudah terdaftar !');
                    }
                }
            })
        }

        function checknikketua(val, inputbox) {
            // alert("The input value has changed. The new value is: " + val);
            var base_url = window.location.origin;
            var username = encodeURIComponent(val);
            var id_inputbox = document.getElementById(inputbox);

            $.ajax({
                url: base_url + '/user/checknikketua/' + username,
                type: 'get',
                success: function(response) {
                    // alert(response);
                    $(this).val = "";
                    if (response > 0) {
                        id_inputbox.value = "";
                        alert('NIK yang digunakan sudah terdaftar !');
                    }
                }
            })
        }
    </script>
</body>

</html>