<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Akreditasi RS</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <!-- <link rel="stylesheet" href="<?php //echo base_url('assets/css/main/app-dark.css'); 
                                        ?>"> -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png'); ?>" type="image/png">

    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/temp'); ?>/css/jquery.dataTables.min.css">
    <script src="<?php echo base_url('assets/temp'); ?>/jquery-3.6.0.js"></script>

</head>

<style>
    input[data-readonly] {
        pointer-events: none;
    }
</style>

<body>
    <?php
    include('template/sidebar.php');
    ?>
    <?php if ($this->session->flashdata('message_name') != null) { ?>
        <div class="alert alert-<?= $this->session->flashdata('kode_name'); ?> alert-dismissible">
            <?= $this->session->flashdata('message_name'); ?>
        </div>
    <?php } ?>


    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <div class="card">

                        <div class="card-header">
                            <h5>
                                Input Akreditasi RS
                            </h5>
                        </div>

                        <div class="card-body">
                            <div class="container">
                                <div class="form-group row align-item-center">
                                    <?php echo form_open_multipart("AkreditasiRS/SimpanAkreditasiRS") ?>
                                    <form role="form" method="post" class="login-form" name="form_pengajuan_akreditasi_RS">
                                        <div class="row">
                                            <div class="form-group row align-items-center">
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label" for="kodeRS">Kode RS</label>
                                                </div>
                                                <div class="col-lg-4 col-2">
                                                    <input class="form-control" type="text" name="kodeRS" id="kodeRS" placeholder="input kode rs ...">
                                                </div>

                                                <div class="col-lg-2 col-2">
                                                    <button class="btn btn-primary" id="btn-search" name="btn-search" onclick="searchrs()">search</button>
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <small class="text-danger">*Input kode RS lalu klik tombol search untuk mengisi field nama rs dan alamat rs</small>
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label" for="nama_fasyankes">Nama Fasyankes</label>
                                                </div>
                                                <div class="col-lg-4 col-2">
                                                    <input class="form-control" type="text" name="nama_fasyankes" id="nama_fasyankes" required data-readonly>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label" for="alamat">Alamat</label>
                                                </div>
                                                <div class="col-lg-4 col-2">
                                                    <input class="form-control" type="text" name="alamat" id="alamat" required data-readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label" for="jenis_fasyankes">Jenis fasyankes</label>
                                                </div>
                                                <div class="col-lg-4 col-2">
                                                    <select class="form-control" name="jenis_fasyankes" id="jenis_fasyankes" readonly>
                                                        <option value="4">Rumah Sakit</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label" for="metode_survei">Metode Survei</label>
                                                </div>
                                                <div class="col-lg-4 col-2">
                                                    <!-- <input class="form-control" type="text" name="metode_survei" id="metode_survei"> -->
                                                    <?= form_dropdown('metode_survei', dropdown_sina_metode_surve(), '', 'id="metode_survei"  class="form-select"'); ?>
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label" for="tgl_survei_1">Tanggal Survei Pertama <small class="text-danger">*</small> </label>
                                                </div>
                                                <div class="col-lg-4 col-2">
                                                    <input class="form-control" type="date" name="tgl_survei_1" id="tgl_survei_1" required>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label" for="tgl_survei_2">Tanggal Survei Kedua <small class="text-danger">*</small></label>
                                                </div>
                                                <div class="col-lg-4 col-2">
                                                    <input class="form-control" type="date" name="tgl_survei_2" id="tgl_survei_2" required>
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label" for="tgl_survei_3">Tanggal Survei Ketiga</label>
                                                </div>
                                                <div class="col-lg-4 col-2">
                                                    <input class="form-control" type="date" name="tgl_survei_3" id="tgl_survei_3">
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label" for="tgl_survei_4">Tanggal Survei Keempat</label>
                                                </div>
                                                <div class="col-lg-4 col-2">
                                                    <input class="form-control" type="date" name="tgl_survei_4" id="tgl_survei_4">
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label" for="narahubung">Kontak Narahubung RS</label>
                                                </div>
                                                <div class="col-lg-4 col-2">
                                                    <input class="form-control" type="text" name="narahubung" id="narahubung" required>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label" for="no_hp_narahubung">No Telp Narahubung</label>
                                                </div>
                                                <div class="col-lg-4 col-2">
                                                    <input class="form-control" type="text" name="no_hp_narahubung" id="no_hp_narahubung" required>
                                                </div>
                                            </div>
                                            <?php
                                            $lpa_id = $this->session->userdata('lpa_id');
                                            ?>

                                            <div class="form-group row align-items-center">
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label" for="surveior_pertama">Surveior Pertama (Manajemen)</label>
                                                </div>
                                                <div class="col-lg-4 col-2">
                                                    <!-- <input class="form-control" type="text" name="surveior_pertama" id="surveior_pertama" required> -->

                                                    <?= form_dropdown('surveior_pertama', dropdown_sina_surveior_manajemen($lpa_id), '', 'id="surveior_pertama"  class="form-select" required'); ?>
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label" for="jabatan_surveior_pertama">Jabatan Surveior Pertama</label>
                                                </div>
                                                <div class="col-lg-4 col-2">
                                                    <select class="form-control" name="jabatan_surveior_pertama" id="jabatan_surveior_pertama" required onchange="check_jabatan(this)">
                                                        <option value="">Pilih Jabatan Surveior Pertama</option>
                                                        <option value="1">Ketua</option>
                                                        <option value="2">Anggota</option>
                                                    </select>
                                                    <!-- <input class="form-control" type="text" name="jabatan_surveior_pertama" id="jabatan_surveior_pertama" required> -->
                                                </div>
                                            </div>

                                            <div class="form-group row align-items-center">
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label" for="surveior_kedua">Surveior Kedua (Pelayanan)</label>

                                                </div>

                                                <div class="col-lg-4 col-2">

                                                    <?= form_dropdown('surveior_kedua', dropdown_sina_surveior_Pelayanan($lpa_id), '', 'id="surveior_kedua"  class="form-select" required'); ?>
                                                    <!-- <input class="form-control" type="text" name="surveior_kedua" id="surveior_kedua" required> -->
                                                </div>
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label" for="jabatan_surveior_kedua">Jabatan Surveior Kedua</label>
                                                </div>
                                                <div class="col-lg-4 col-2">
                                                    <select class="form-control" name="jabatan_surveior_kedua" id="jabatan_surveior_kedua" required onchange="check_jabatan(this)">
                                                        <option value="">Pilih Jabatan Surveior Kedua</option>
                                                        <option data-option='2' value="1">Ketua</option>
                                                        <option data-option='1' value="2">Anggota</option>
                                                    </select>
                                                    <!-- <input class="form-control" type="text" name="jabatan_surveior_kedua" id="jabatan_surveior_kedua" required> -->
                                                </div>
                                            </div>

                                            <div class="form-group row align-item-center">
                                                <div class="col-lg-2 col-4">
                                                    <label class="col-form-label" for="no_surtug">No Surat Tugas</label>
                                                </div>
                                                <div class="col-lg-4 col-2">
                                                    <input class="form-control" type="text" name="no_surtug" id="no_surtug" placeholder="Inputkan No Surat Tugas ...." required>
                                                </div>
                                            </div>




                                            <div class="buttons" align="center">
                                                <button href="submit" class="btn btn-success rounded-pill">Simpan</button>
                                                <a href="<?php echo base_url('AkreditasiRS/'); ?>" class="btn btn-danger rounded-pill">Batal</a>
                                            </div>
                                        </div>
                                    </form>
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

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
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
        function searchrs() {
            var koders = document.getElementById('kodeRS').value;
            var base_url = window.location.origin;
            if (koders != "") {
                $.ajax({
                    url: base_url + '/AkreditasiRS/searchRS/' + koders,
                    type: 'get',
                    success: function(response) {
                        const obj = JSON.parse(response);

                        if (obj.data != null) {
                            document.getElementById("nama_fasyankes").value = obj.data.nama;
                            document.getElementById("alamat").value = obj.data.alamat;
                        } else {
                            alert('DATA RS TIDAK DITEMUKAN PERIKSA KEMBALI KODE RS.');
                            document.getElementById('kodeRS').value = "";
                        }
                    }
                })
            }
        }


        function check_jabatan(value) {

            if (value.id === 'jabatan_surveior_pertama') {


                if (value.value === '1') {
                    document.getElementById('jabatan_surveior_kedua').value = '2';
                } else if (value.value === '2') {
                    document.getElementById('jabatan_surveior_kedua').value = '1';
                }


            } else if (value.id === 'jabatan_surveior_kedua') {
                if (value.value === '1') {
                    document.getElementById('jabatan_surveior_pertama').value = '2';
                } else if (value.value === '2') {
                    document.getElementById('jabatan_surveior_pertama').value = '1';
                }
            }


        }
    </script>
    <!-- <script src="<?php //echo base_url() 
                        ?>assets/js/app.js"></script> -->

</body>

</html>