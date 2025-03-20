<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Usul Survei</title>
    
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/logo/favicon.png" type="image/png">
    
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
                            aria-controls="home" aria-selected="true">Pengajuan Usul Survei</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Kesiapan Survei</a>
                    </li>
                  
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
                                <div class="form-group">
                                        <label for="fasyankes_id">Kode Fasyankes</label>
                                        <input type="text" class="form-control" name="fasyankes_id" id="fasyankes_id" placeholder="Kode Fasyankes"
                                            disabled>
                                </div>

                                <div class="form-group">
                                    <label for="jenis_fasyankes">Jenis Fasyankes</label>
                                    <input type="text" class="form-control" name="jenis_fasyankes" id="jenis_fasyankes" placeholder="Jenis Fasyankes"
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label for="helperText">Nama LPA</label>
                                    <input type="search" id="lpa_id" name="lpa_id" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-1" aria-autocomplete="list" aria-activedescendant="bs-select-1-11">
                                
                                </div>
                            
                                <div class="form-group">
                                <p>Jenis Survei</p>
                                <!-- <fieldset class="form-group">
                                                <select class="form-select" name="jenis_survei_id" id="jenis_survei_id">
                                                    <option value='1'>Survei</option>
                                                    <option value='2'>Survei Remedial</option>
                                                    
                                                </select>
                                            </fieldset> -->
                                            <input type="text" class="form-control" id='jenis_survei_id' name='jenis_survei_id' placeholder="Jenis Survei"
                                        disabled>            
                                </div>
                                <div class="form-group">
                                <p>Jenis Akreditasi</p>
                        
                                    <!-- <select class="form-select akreditasi" name="jenis_akreditasi_id" id="jenis_akreditasi_id">
                                                    <option value='1'>Perdana</option>
                                                    <option value='2'>Reakreditasi</option>
                                                    
                                    </select> -->
                                    <input type="text" class="form-control" name="jenis_akreditasi_id" id="jenis_akreditasi_id" placeholder="Jenis Akreditasi"
                                        disabled>
                                        
                                </div>
                                <div class="form-group status" style='display:block;' >
                                    <label for="disabledInput">Status Akreditasi Sebelumnya</label>
                                    <!-- <select class="form-select akreditasi" id="status_akreditasi">
                                                    <option value='1'>Paripurna</option>
                                                    <option value='2'>Utama</option>
                                                    <option value='3'>Madya</option>
                                                    <option value='4'>Dasar</option>
                                                    
                                    </select> -->
                                    <input type="text" class="form-control" id='status_akreditasi_id' name='status_akreditasi_id' placeholder="Status Akreditasi"
                                        disabled>
                                </div>
                                <div class="form-group" style='display:block;'>
                                    <label for="disabledInput">Sertifikat Akreditasi Sebelumnya</label>
                                    <fieldset>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="url_sertifikasi_akreditasi_sebelumnya" name="url_sertifikasi_akreditasi_sebelumnya"
                                                aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="form-group" style='display:block;'>
                                    <label for="disabledInput">Tanggal Akhir Sertifikat</label>
                                    <input type="date" class="form-control" name="tanggal_akhir_sertifikat" id="tanggal_akhir_sertifikat" placeholder="Disabled Text"
                                        >
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_rencana_survei">Tanggal Rencana Survei</label>
                                    <div class="row">
                                        <div class="col-md-5">
                                        <input type="date" name="tanggal_awal_rencana_survei" id="tanggal_awal_rencana_survei" class="form-control" >
                                        </div>
                                        s.d.
                                        <div class="col-md-5">
                                        <input type="date" name="tanggal_akhir_rencana_survei" id="tanggal_akhir_rencana_survei" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="card">
           
            <div class="card-body">
                <div class="form-group" style='display:block;'>
                    <label for="disabledInput">Upload Surat permohonan fasyankes untuk dilakukan survei</label>
                    <fieldset>
                        <div class="input-group">
                            <input type="file" class="form-control" id="url_surat_permohonan_survei" name="url_surat_permohonan_survei"
                                aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>
                    </fieldset>
                </div>

                <div class="form-group" style='display:block;'>
                    <label for="disabledInput">Upload Profil fasyankes terbaru (Puskesmas)</label>
                    <fieldset>
                        <div class="input-group">
                            <input type="file" class="form-control" id="url_profil_fasyankes" name="url_profil_fasyankes"
                                aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>
                    </fieldset>
                </div>

                <div class="form-group" style='display:block;'>
                    <label for="disabledInput">Upload Laporan hasil penilaian mandiri</label>
                    <fieldset>
                        <div class="input-group">
                            <input type="file" class="form-control" id="url_laporan_hasil_penilaian_mandiri" name="url_laporan_hasil_penilaian_mandiri"
                                aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>
                    </fieldset>
                </div>
                
                <div class="form-group" style='display:block;'>
                    <label for="disabledInput">Upload Hasil perencanaan perbaikan strategis (PPS) untuk fasyankes reakreditasi</label>
                    <fieldset>
                        <div class="input-group">
                            <input type="file" class="form-control" id="url_pps_reakreditasi" name="url_pps_reakreditasi"
                                aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>
                    </fieldset>
                </div>
                
                <div class="form-group" style='display:block;'>
                    <label for="disabledInput">Upload Surat usulan Dinas Kesehatan Kabupaten/Kota setelah dinyatakan siap untuk di survei</label>
                    <fieldset>
                        <div class="input-group">
                            <input type="file" class="form-control" id="url_surat_usulan_dinas" name="url_surat_usulan_dinas"
                                aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>
                    </fieldset>
                </div> 
                
                
                <div class="form-group" style='display:block;'>
                        <p>Update data fasyankes dalam aplikasi Data Fasyankes Online (DFO)</p>
                        <fieldset class="form-group">
                            <select class="form-select" id="update_dfo">
                                <option value='1'>Ya</option>
                                <option value='2'>Tidak</option>
                            </select>
                                      
                        </fieldset>
                        </div>

                <div class="form-group" style='display:block;'>
                    <label> Kelengkapan data sarana, prasarana dan alat kesehatan dalam aplikasi ASPAK</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="kelengkapan_berkas_aspak" id="kelengkapan_berkas_aspak1">
                        <label class="form-check-label" for="kelengkapan_berkas_aspak1">
                        Lengkap
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="kelengkapan_berkas_aspak" id="kelengkapan_berkas_aspak2" checked>
                        <label class="form-check-label" for="kelengkapan_berkas_aspak2">
                        Tidak Lengkap
                        </label>
                    </div>
                </div>

                <div class="form-group" style='display:block;'>
                    <label> Kelengkapan data tenaga kesehatan dalam aplikasi SISDMK</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="kelengkapan_berkas_sisdmk" id="kelengkapan_berkas_sisdmk1">
                        <label class="form-check-label" for="kelengkapan_berkas_sisdmk1">
                        Lengkap
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="kelengkapan_berkas_sisdmk" id="kelengkapan_berkas_sisdmk2" checked>
                        <label class="form-check-label" for="kelengkapan_berkas_sisdmk2">
                        Tidak Lengkap
                        </label>
                    </div>
                </div>
               
                <div class="form-group" style='display:block;'>
                    <label> Kelengkapan data dalam aplikasi INM</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="kelengkapan_berkas_inm" id="kelengkapan_berkas_inm1">
                        <label class="form-check-label" for="kelengkapan_berkas_inm1">
                        Lengkap
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="kelengkapan_berkas_inm" id="kelengkapan_berkas_inm2" checked>
                        <label class="form-check-label" for="kelengkapan_berkas_inm2">
                        Tidak Lengkap
                        </label>
                    </div>
                </div>

                <div class="form-group" style='display:block;'>
                    <label> Kelengkapan data dalam aplikasi IKP</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="kelengkapan_berkas_ikp" id="kelengkapan_berkas_ikp1">
                        <label class="form-check-label" for="kelengkapan_berkas_ikp1">
                        Lengkap
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="kelengkapan_berkas_ikp" id="kelengkapan_berkas_ikp2" checked>
                        <label class="form-check-label" for="kkelengkapan_berkas_ikp2">
                        Tidak Lengkap
                        </label>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    


                       
</div>
    <div class="buttons">
                <a href="#" class="btn btn-primary rounded-pill">Submit</a>
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
    <script src="<?php echo base_url()?>assets/js/app.js">
   
    </script>
   
</body>

</html>
