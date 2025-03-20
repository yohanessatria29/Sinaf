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

    <script src="<?php echo base_url('assets/temp'); ?>/jquery-3.6.0.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


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
    var_dump($data);
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
                                    <a class="nav-link tabcontentfont" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="persetujuan" aria-selected="true">Persetujuan</a>
                                </li>
                                <!-- <li class="nav-item" role="presentation">
                                    <a class="nav-link tabcontentfont <?= $element ?>" id="elemenpenilaian-tab" data-bs-toggle="tab" href="#elemenpenilaian" role="tab" aria-controls="elemenpenilaian" aria-selected="false">EP Verifikator</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link tabcontentfont" id="presentasecapaian-tab" data-bs-toggle="tab" href="#presentasecapaian" role="tab" aria-controls="presentasecapaian" aria-selected="false">Capaian Verifikator (%)</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link tabcontentfont <?= $pengiriman_laporan ?>" id="rekomendasi-tab" data-bs-toggle="tab" href="#rekomendasi" role="tab" aria-controls="rekomendasi" aria-selected="true">Rekomendasi Usulan Survei</a>
                                </li>
                                
                                <li class="nav-item" role="presentation">
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
                                <div class="tab-pane" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="page-heading">
                                        <section class="section">
                                            <div class="card">
                                                <div class="card-header"></div>
                                                <div class="form-group row align-items-center">

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
                                                    <div class="col-lg-2 col-3">
                                                        <label class="col-form-label">Nama Fasyankes</label>
                                                    </div>
                                                    <div class="col-lg-10 col-9">
                                                        <label class="col-form-label"></label>
                                                    </div>
                                                </div>

                                            </div>
                                        </section>

                                        <section class="section">
                                            <div class="row">
                                                <div class="col-4 col-md-4 col-lg-4">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4>Hasil Penilaian Surveior</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="badges">
                                                                <span class="badge bg-primary"><?= $status_rekomendasi_surveior; ?></span>
                                                            </div>
                                                            <div class="alert alert-primary">
                                                                <h4 class="alert-heading"><?= $status_rekomendasi_surveior; ?></h4>
                                                                <!-- <p>This is a primary alert.</p> -->
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
                                                            <div class="badges">
                                                                <span class="badge bg-primary"><?= $status_rekomendasi_verifikator; ?></span>
                                                            </div>
                                                            <div class="alert alert-primary">
                                                                <h4 class="alert-heading"><?= $status_rekomendasi_verifikator; ?></h4>
                                                                <!-- <p>This is a primary alert.</p> -->
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
                                                            <div class="badges">
                                                                <span class="badge bg-primary"><?= $status_rekomendasi_verifikator; ?></span>
                                                            </div>
                                                            <div class="alert alert-primary">
                                                                <h4 class="alert-heading"><?= $status_rekomendasi_verifikator; ?></h4>
                                                                <!-- <p>This is a primary alert.</p> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <div class="form-group">
                                            <div class="alert alert-primary col-4 col-md-4 col-lg-4">
                                                <label for="helperText">Catatan Ketua Tim Kerja</label>
                                            </div>
                                            <textarea type="text" id="keterangan" name="keterangan" class="form-control" style="display;"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-4 col-md-4 col-lg-4">
                                                <div class="alert alert-primary ">
                                                    <input type="radio" id="terima" name="fav_language" value="Setuju Akreditasi Diterima"><label for="helperText">Setuju Akreditasi Diterima</label>
                                                </div>
                                                <textarea type="text" id="keterangan" name="keterangan" class="form-control" style="display;"></textarea>
                                            </div>

                                            <div class="form-group col-4 col-md-4 col-lg-4">

                                                <div class="alert alert-primary ">
                                                    <input type="radio" id="tolak" name="fav_language" value="Setuju Akreditasi Ditolak"><label for="helperText">Setuju Akreditasi Ditolak</label>
                                                </div>
                                                <textarea type="text" id="keterangan" name="keterangan" class="form-control" style="display;"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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
                "autoWidth": false
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