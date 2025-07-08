<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surveior</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main/app-dark.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png'); ?>" type="image/png">

</head>

<body>
    <?php
    include('template/sidebar.php');
    // var_dump($data);
    $provinsi_id = $data[0]['provinsi_id'];
    $kota_id = $data[0]['kabkota_id'];
    $lpa_id = $data[0]['lpa_id'];
    $nama_sertifikat_refreshing = $data[0]['nama_sertifikat'];

    if ($nama_sertifikat_refreshing != NULL) {
        $url_serti_refreshing = base_url('/assets/uploads/berkas_akreditasi/') . $nama_sertifikat_refreshing;
    } else {
        $url_serti_refreshing = "";
    }


    if ($data[0]['keaktifan'] === 'PNS') {
        $keaktifan = '1';
    } else if ($data[0]['keaktifan'] === 'Swasta') {
        $keaktifan = '2';
    } else if ($data[0]['keaktifan'] === 'Purna Tugas') {
        $keaktifan = '3';
    }

    if ($data[0]['status_aktif'] == 1) {
        $status_aktif = 'checked';
        $is_disabled = '';
    } else if ($data[0]['status_aktif'] == 0) {
        $status_aktif = 'unchecked';
        $is_disabled = 'disabled';
    } else {
        $status_aktif = 'unchecked';
        $is_disabled = 'disabled';
    }
    ?>
    <section class="section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <?php
                        // var_dump($this->session->flashdata());
                        if ($this->session->flashdata('kode_name') == 'Failed') : ?>
                            <div class="alert alert-danger" id="warning">
                                <h5><strong>ALERT !</strong></h5>
                                <?= $this->session->flashdata('message_name'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata('kode_name') == 'success') : ?>
                            <div class="alert alert-success" id="warning">
                                <h5><strong>Success !</strong></h5>
                                <?= $this->session->flashdata('message_name'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Data Surveior</h4>
                            </div>
                            <?php echo form_open_multipart('Pengajuan/simpanSurveior') ?>
                            <form role="form" method="post" class="login-form" name="form_valdation">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="nik">NIK</label>

                                                <input type="text" class="form-control" id="nik" name="nik" onchange="checkniksurveior(this.value, this.id)" placeholder="Masukkan NIK" value="<?= $data[0]['nik'] ?>" disabled>
                                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $data[0]['id'] ?>">
                                                <input type="hidden" class="form-control" id="users_id" name="users_id" value="<?= $data[0]['users_id'] ?>">
                                                <input type="hidden" class="form-control" id="nik" name="nik" value="<?= $data[0]['nik'] ?>">
                                                <input type="hidden" class="form-control" id="id_user_surveior" name="id_user_surveior" value="<?= $datac[1]['id_user_surveior'] ?>">
                                                <input type="hidden" class="form-control" id="lpa_id" name="lpa_id" value="<?= $data[0]['lpa_id'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" value="<?= $data[0]['nama'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" onchange="checkemail(this.value, this.id)" placeholder="Masukkan Email" value="<?= $data[0]['email'] ?>">

                                            </div>
                                            <div class="form-group">
                                                <label for="lpa">LPA</label>
                                                <input type="text" class="form-control" id="lpa" name="lpa_id" value="<?= $data[0]['nama_lpa'] ?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_hp">No Hp</label>
                                                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $data[0]['no_hp'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="provinsi">Provinsi</label>

                                                <?= form_dropdown('propinsi', dropdown_sina_propinsi(), $provinsi_id, 'id="provinsi_id"  class="form-select" required disabled'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="kabkota">Kab/Kota</label>
                                                <input type="hidden" class="form-control" id="kabkota" name="kabkota" placeholder="Masukkan No HP" value="<?= $data[0]['kabkota_id'] ?>">
                                                <?= form_dropdown('kota', dropdown_sina_kab_kota($provinsi_id), $kota_id, 'id="kabkota_id"  class="form-select" required disabled'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="keaktifan">Status</label>
                                                <?= form_dropdown('keaktifan', array('1' => 'PNS', '2' => 'SWASTA', '3' => 'Purna Tugas'), $keaktifan, 'id="keaktifan"  class="form-select" '); ?>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <div class="form-group col-md-12">
                                                    <label for="helperText">Sertifikat Surveior</label>
                                                    <div class="input-group">
                                                        <!-- Input Link -->
                                                        <input type="url" class="form-control" id="url_sertifikat_surveior" name="url_sertifikat_surveior"
                                                            placeholder="Masukkan link Google Drive atau URL PDF"
                                                            value="<?= $data[0]['url_sertifikat_surveior'] ?? '' ?>">

                                                        <?php
                                                        $url_sertifikat_surveior = $data[0]['url_sertifikat_surveior'] ?? '';
                                                        if (!empty($url_sertifikat_surveior)) {
                                                            // Deteksi apakah ini link eksternal (https://) atau file PDF lokal
                                                            $is_external = preg_match('#^https?://#i', $url_sertifikat_surveior);
                                                            $is_pdf = preg_match('/\.pdf$/i', $url_sertifikat_surveior);

                                                            if ($is_external || $is_pdf) {
                                                                echo '<a class="btn btn-primary rounded-pill ms-2" target="_blank" href="' . $url_sertifikat_surveior . '">Lihat Dokumen</a>';
                                                            }
                                                        }
                                                        ?>
                                                        <input type="hidden" name="old_url_sertifikat_surveior" value="<?= $url_sertifikat_surveior ?>" id="old_url_sertifikat_surveior">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <div class="form-group col-md-12">
                                                        <label for="helperText">Surat Keputusan Keanggotaan dari Lembaga</label>
                                                        <div class="input-group">
                                                            <!-- Input Link -->
                                                            <input type="url" class="form-control" id="url_surat_keputusan_keanggotaan" name="url_surat_keputusan_keanggotaan"
                                                                placeholder="Masukkan link Google Drive atau URL PDF"
                                                                value="<?= $data[0]['url_surat_keputusan_keanggotaan'] ?? '' ?>">

                                                            <?php
                                                            $url_surat_keputusan_keanggotaan = $data[0]['url_surat_keputusan_keanggotaan'] ?? '';
                                                            if (!empty($url_surat_keputusan_keanggotaan)) {
                                                                $is_external = preg_match('#^https?://#i', $url_surat_keputusan_keanggotaan);
                                                                $is_pdf = preg_match('/\.pdf$/i', $url_surat_keputusan_keanggotaan);

                                                                if ($is_external || $is_pdf) {
                                                                    echo '<a class="btn btn-primary rounded-pill ms-2" target="_blank" href="' . $url_surat_keputusan_keanggotaan . '">Lihat Dokumen</a>';
                                                                }
                                                            }
                                                            ?>
                                                            <input type="hidden" name="old_url_surat_keputusan_keanggotaan" value="<?= $url_surat_keputusan_keanggotaan ?>" id="old_url_surat_keputusan_keanggotaan">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-7">
                                            <?php echo form_open_multipart('Pengajuan/simpanSurveiorDetail') ?>
                                            <form role="form" method="post" class="login-form" name="form_valdation">
                                                <table class="table table-striped" id="table1">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Fasyankes</th>
                                                            <th>Bidang</th>
                                                            <th>Action</th>
                                                            <!-- <th>Cek Kelulusan</th> -->
                                                            <th>Status Ukom</th>
                                                            <th>Tgl Akhir</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $n = 1;
                                                        foreach ($datab as $data) {
                                                            $key = $data['id'];
                                                            $bidang = $data['fasyankes_id'];
                                                            $bidangid = $data['id'];
                                                            $namafasyankes = $data['nama'];
                                                        ?>
                                                            <tr>
                                                                <td><?= $n++ ?></td>
                                                                <td><?= $data['nama'] ?></td>
                                                                <td><?= $data['bidang'] ?></td>

                                                                <input type="hidden" id="id_bidang[<?= $key; ?>]" name="id_bidang[<?= $key; ?>]" value="<?= $data['id'] ?>">
                                                                <input type="hidden" id="nama_bidang[]" name="nama_bidang[<?= $key; ?>]" value="<?= $data['bidang'] ?>">

                                                                <input type="hidden" id="fasyankes[<?= $key; ?>]" name="fasyankes[<?= $key; ?>]" value="<?= $data['fasyankes_id'] ?>">
                                                                <input type="hidden" name="id_bidang[]" id="id_bidang[]" value="<?= $key; ?>">

                                                                <?php
                                                                foreach ($datac as $databidang) {
                                                                    if ($databidang['id_bidang'] == $bidangid) {
                                                                        if ($databidang['is_checked'] == "1") {

                                                                            if ($databidang['status_ukom'] == NULL) {
                                                                                $status_ukom = 'Belum Cek';
                                                                            } elseif ($databidang['status_ukom'] == 1) {
                                                                                $status_ukom = 'Lulus';
                                                                            } else {
                                                                                $status_ukom = 'Tidak Lulus';
                                                                            }
                                                                ?>
                                                                            <td><input type="radio" id="bidang[]" name="fasyankes_id[<?php echo $bidang ?>]" value="<?php echo $bidangid ?>" checked disabled></th>
                                                                            <td><?= $status_ukom ?></td>
                                                                            <td><?= $databidang['tgl_berlaku_sertifikat'] ?></td>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <td><input type="radio" id="bidang[]" name="fasyankes_id[<?php echo $bidang ?>]" value="<?php echo $bidangid ?>" disabled></td>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>

                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                        <td><button type="button" onclick="checkbidang()" class="btn btn-primary" style="width: 80px;">Cek Ukom</button></td>

                                                    </tbody>

                                                </table>

                                                <div class="container">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5 class="card-tittle">
                                                                Sertifikat Surveior
                                                            </h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="container">
                                                                        <div class="col-md-12">
                                                                            <button type="button" onclick="checksertifikat()" class="btn btn-primary" style="width: 80px;">Cek</button>
                                                                            <button type="button" id="no_sertifikat" class="btn btn-outline-primary" style="width: 200px; margin-left: 5px;" name="no_sertifikat" hidden disabled></button>
                                                                            <?php
                                                                            if ($url_serti_refreshing != NULL) {
                                                                            ?>
                                                                                <a class="btn btn-primary rounded-pill" id="link_sertifikat_surveior" target="_blank" href="<?php echo $url_serti_refreshing ?>">Lihat Sertifikat</a>
                                                                            <?php
                                                                            } else {
                                                                            ?>
                                                                                <a class="btn disabled" id="notif_belum_upload" href="#" hidden>Surveior Belum Mengupload Dokumen</a>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row pt-3">
                                                                    <p style="font-size: 10px;">* Surveior sebelum 2023 menggunakan Sertifikat Refreshing, sesudah 2023 menggunakan Sertifikat Pelatihan Surveior</p>
                                                                </div>
                                                            </div>
                                                            <div class="container" id="form_keaktifan" name="form_keaktifan">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-check form-switch" style="padding-left:0px;width: 200px;">
                                                                            <label for="">Keaktifan Surveior</label>
                                                                            <input style="float: right;" class="form-check-input btn-lg" <?php echo $status_aktif; ?> type="checkbox" role="switch" name="keaktifan_surveior" id="keaktifan_surveior" <?php echo $is_disabled ?>>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary me-1 mb-1">Edit</button>
                                </div>

                            </form>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/app.js"></script>
    <script>
        $('input[type=radio]').click(function() {
            if (this.previous) {
                this.checked = false;
            }
            this.previous = this.checked;
        });
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
        // Install input filters.
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
                url: base_url + '/pengajuan/checkemail/' + username,
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

        function checkniksurveior(val, inputbox) {
            // alert("The input value has changed. The new value is: " + val);
            var base_url = window.location.origin;
            var username = encodeURIComponent(val);
            var id_inputbox = document.getElementById(inputbox);

            $.ajax({
                url: base_url + '/pengajuan/checkniksurveior/' + username,
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

        function checksertifikat() {
            var inputnik = String(document.getElementById("nik").value);
            if (inputnik === "") {
                alert('Input NIK kosong.');
            } else if (inputnik.length === 16) {
                $.ajax({
                    url: "<?php echo base_url('/pengajuan/checksertifikatsurveior'); ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        "param1": inputnik,
                    },
                    success: function(data) {
                        if (data === undefined || data.length == 0) {
                            alert('Tidak ada Sertifikat');
                            document.getElementById("no_sertifikat").hidden = true;
                            $("#keaktifan_surveior").prop("checked", false);
                            document.getElementById('keaktifan_surveior').disabled = true;
                            return;
                        } else {
                            var no_sertifikat = data[0].no_sertifikat;
                            var button_sertifikat = document.getElementById("no_sertifikat");
                            button_sertifikat.removeAttribute('hidden');
                            button_sertifikat.innerHTML = no_sertifikat;
                            document.getElementById('keaktifan_surveior').disabled = false;
                        }

                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            } else {
                alert('Input NIK ERROR.');
            }
        }

        function checkbidang() {
            var inputnik = String(document.getElementById("nik").value);
            var inputlpa = String(document.getElementById("lpa_id").value);
            var inputuser = String(document.getElementById("users_id").value);
            // var inputbidang = String(document.getElementById("id_bidang[<?= $key; ?>]").value);
            // var inputfaskes = String(document.getElementById("fasyankes[<?= $key; ?>]").value);
            if (inputnik === "") {
                alert('Input NIK kosong.');
            } else if (inputnik.length === 16) {
                $.ajax({
                    url: "<?php echo base_url('/pengajuan/checkbidang'); ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        "param1": inputnik,
                        "param2": inputlpa,
                        "param3": inputuser,
                        // "param4": inputbidang,
                        // "param5": inputfaskes,
                    },
                    success: function(data) {
                        // do something
                        // console.log(data);

                        if (data == 1) {
                            alert('Update Sertifikat Ukom');
                            location.reload();
                            // return;
                        } else {
                            // foreach ($data as $value){
                            alert('Update Sertifikat UKOM');
                            location.reload();


                            // }
                            // var no_sertifikat = data[0].no_sertifikat;
                            // var button_sertifikat = document.getElementById("no_sertifikat");
                            // var nama_sertifikat = data[0].nama_sertifikat;

                            // if (nama_sertifikat != null) {
                            //     var a = document.getElementById('link_sertifikat_surveior'); //or grab it by tagname etc
                            //     a.removeAttribute('hidden');
                            //     a.href = '<?php //echo base_url('/assets/uploads/berkas_akreditasi/') 
                                                ?>' + nama_sertifikat
                            // } else {
                            //     console.log('kosong');
                            // }

                            // button_sertifikat.removeAttribute('hidden');
                            // button_sertifikat.innerHTML = no_sertifikat;
                            // document.getElementById('keaktifan_surveior').disabled = false;
                        }

                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            } else {
                alert('Input NIK ERROR.');
            }
        }
    </script>
    <script>
        $('[name="propinsi"]').change(function() {
            $("#kota_id").removeAttr('readonly'); //turns required off
            $('#kota_id').val('');

            $.ajax({
                // url: "../dropdown5/" + $(this).val(),
                url: "<?= base_url('pengajuan/dropdown5/') ?>" + $(this).val(),
                dataType: "json",
                type: "GET",
                success: function(data) { //
                    addOption($('[name="kota"]'), data, 'id_kota', 'nama_kota');
                    console.log(data)
                }
            });
        });

        //  $('[name="kota"]').change(function() {
        //        $('#kecamatan').val('');
        //           $.ajax({
        //        url: "<?php //echo site_url('pengajuan/dropdown6') 
                        ?>/" + $('#provinsi_id').val()+"/"+ $(this).val(),
        //        dataType: "json",
        //        type: "GET",
        //        success: function(data) { //
        //       addOption($('[name="kecamatan"]'), data, 'id_camat', 'nama_camat');
        //        }
        //     }); 


        //  });
        // function tes() {
        //     // $("#kota_id").removeAttr('readonly');  //turns required off
        //     //     $('#kota_id').val('');

        //     //         $.ajax({
        //     //     url: "../dropdown5/" + $(this).val(),
        //     //     dataType: "json",
        //     //     type: "GET",
        //     //     success: function(data) { //
        //     //     addOption($('[name="kota"]'), data, 'id_kota', 'nama_kota');
        //     //     }
        //     //     }); 
        // }


        function check() {
            if (document.getElementById('kata_sandi').value ===
                document.getElementById('kata_sandi_confirm').value) {
                document.getElementById('message').innerHTML = "<font color='green'>Password Sama</font>";
                document.getElementById('submit').disabled = false;
            } else {
                document.getElementById('message').innerHTML = "<font color='red'>Password Tidak Sama</font>";
                document.getElementById('submit').disabled = true;
            }
        }

        function addOption(ele, data, key, val) { //alert(data.length);
            $('option', ele).remove();

            ele.append(new Option('', 9999));
            $(data).each(function(index) { //alert(eval('data[index].' + nama));
                ele.append(new Option(eval('data[index].' + val), eval('data[index].' + key)));

            });
        }
    </script>


</body>

</html>