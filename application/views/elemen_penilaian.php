<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei</title>
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
                <div class="card">

                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <!-- <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Survei Akreditasi</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Verifikasi Status Survei</a>
                    </li> -->
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab"
                                    aria-controls="contact" aria-selected="false">Pengiriman Rekomendasi</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <!-- <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="page-heading">
    <div class="page-title">
        
    </div>
    <section class="section">
        <div class="card">
           

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                    
                        <div class="form-group">
                        <p>Metode Survei</p>
                        <fieldset class="form-group">
                                        <select class="form-select" id="metode">
                                            <option value='luring'>Luring</option>
                                            <option value='hybrid'>Hybrid</option>
                                            
                                        </select>
                                    </fieldset>
                        </div>
                        <div class="form-group">
                            <label for="helperText">Tanggal Pengiriman Laporan Survei</label>
                            <input type="date" id="tanggalpengiriman" class="form-control" >
                        </div>
                   
                    </div>
                   
                </div>
            </div>
        </div>
    </section>

   
</div>
                    </div> -->

                            <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                </br>
                                <div class="form-group">
                                    <p>Bab</p>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="bab">
                                            <option value=''>Bab 1</option>
                                            <option value=''>Bab 2</option>

                                        </select>
                                    </fieldset>
                                </div>

                                <div class="form-group">
                                    <p>Standar</p>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="standar">
                                            <option value=''>Standar 1</option>
                                            <option value=''>Standar 2</option>

                                        </select>
                                    </fieldset>
                                </div>
                                <div class="form-group">
                                    <p>Kriteria</p>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="kriteria">
                                            <option value=''>Kriteria 1</option>
                                            <option value=''>Kriteria 2</option>

                                        </select>
                                    </fieldset>
                                </div>
                                <div class="form-group">
                                    <p>Elemen Penilaian</p>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="elemen">
                                            <option value=''>Elemen Penilaian 1</option>
                                            <option value=''>Elemen Penilaian 2</option>

                                        </select>
                                    </fieldset>
                                </div>
                                <div class="form-group">
                                    <label for="helperText">Skor Capaian Surveior</label>
                                    <input type="text" id="tanggalpengajuan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="helperText">Skor Maksimal</label>
                                    <input type="text" id="tanggalpengajuan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="helperText">Presentase Capaian Surveior</label>
                                    <input type="text" id="tanggalpengajuan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="helperText">Fakta dan Analis</label>
                                    <input type="text" id="tanggalpengajuan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="helperText">Rekomendasi</label>
                                    <input type="text" id="tanggalpengajuan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="helperText">Skor Capaian Verifikator</label>
                                    <input type="text" id="tanggalpengajuan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="helperText">Presentase Capaian Verifikator</label>
                                    <input type="text" id="tanggalpengajuan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="helperText">Rekomendasi Status AKreditasi</label>
                                    <input type="text" id="tanggalpengajuan" class="form-control">
                                </div>


                                <div class="col-md-6 mb-1">
                                    <p>Dokumen Penetapan Rekomendasi Status Verifikasi</p>
                                    <fieldset>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="inputGroupFile04"
                                                aria-describedby="inputGroupFileAddon04" aria-label="Upload">

                                        </div>
                                    </fieldset>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="buttons">

                        <a href="#" class="btn icon btn-success">Submit</a>

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
    <script src="<?php echo base_url() ?>assets/js/app.js">

    </script>

</body>

</html>