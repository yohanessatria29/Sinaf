<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Juknis</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main/app-dark.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png'); ?>" type="image/png">

</head>
<body> <?php
    include('template/sidebar.php');
  
    ?>
    <!-- Main content -->
    <section class="content">
	 <a href="<?php echo site_url('admin/index')?>" ><button class="btn btn-success"><i class="fa fa-fw fa-arrow-left"></i> Back</button></a>
	<br><br>
     

  <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="card">

                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="kontrak-tab" data-bs-toggle="tab" href="#kontrak" role="tab" aria-controls="kontrak" aria-selected="true">Dokumen Kontrak</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link " id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Self Assasement Klinik</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true"> Self Assasement Puskesmas</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="home2-tab" data-bs-toggle="tab" href="#home2" role="tab" aria-controls="home2" aria-selected="true">Self Assasement UTD</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="home3-tab" data-bs-toggle="tab" href="#home3" role="tab" aria-controls="home3" aria-selected="true">Self Assasement Labkes</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="home4-tab" data-bs-toggle="tab" href="#home4" role="tab" aria-controls="home4" aria-selected="true">Self Assasement TPMD/TPMDG</a>
                                </li>


                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="kontrak" role="tabpanel" aria-labelledby="kontrak-tab">
                                  <h3></h3>
                                  <div class="form-group col-md-12">
                                    <a target="_blank" href="<?php echo site_url('assets/uploads/template/Dokumen_kontrak.docx')?>" class="btn btn-block btn-success">Download Dokumen Kontrak</a>
                                  </div>
                                </div>
                                <div class="tab-pane fade show " id="home" role="tabpanel" aria-labelledby="home-tab">
                                  <h3></h3>
                                  <div class="form-group col-md-12">
                                    <a target="_blank" href="<?php echo site_url('assets/uploads/template/TemplateKlinik.xls')?>" class="btn btn-block btn-success">Download Template Assasement</a>
                                  </div>
                                </div>
                                <div class="tab-pane fade show " id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                  <h3></h3>
                                  <div class="form-group col-md-12">
                                    <a target="_blank" href="<?php echo site_url('assets/uploads/template/TemplatePuskesmas.xlsx')?>" class="btn btn-block btn-success">Download Template Assasement</a>
                                  </div>
                                
                                </div>
                                <div class="tab-pane fade show " id="home2" role="tabpanel" aria-labelledby="home2-tab">
                                  <h3></h3>
                                  <div class="form-group col-md-12">
                                    <a target="_blank" href="<?php echo site_url('assets/uploads/template/TemplateUtd.xlsx')?>" class="btn btn-block btn-success">Download Template Assasement</a>
                                  </div>
                                 
                                </div>
                                <div class="tab-pane fade show " id="home3" role="tabpanel" aria-labelledby="home3-tab">
                                  <h3></h3>
                                  <div class="form-group col-md-12">
                                    <a target="_blank" href="<?php echo site_url('assets/uploads/template/TemplateLabkes.xlsx')?>" class="btn btn-block btn-success">Download Template Assasement</a>
                                  </div>
                                </div>
                                <div class="tab-pane fade show " id="home4" role="tabpanel" aria-labelledby="home4-tab">
                                  <h3></h3>
                                  <div class="form-group col-md-12">
                                    <a target="_blank" href="<?php echo site_url('assets/uploads/template/TemplatePm.xlsx')?>" class="btn btn-block btn-success">Download Template Assasement</a>
                                  </div> 
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        </div>
    </section>


    <script src="<?php echo base_url() ?>assets/js/app.js">

    </script>

</body>

</html>

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>




<!-- 

  <button class="tablinks" onclick="openTab(event, 'klinik')">KLINIK</button>
  <button class="tablinks" onclick="openTab(event, 'labkes')">LABKES</button>
  <button class="tablinks" onclick="openTab(event, 'rs')">RS</button>
  <button class="tablinks" onclick="openTab(event, 'utd')">UTD</button>
  <button class="tablinks" onclick="openTab(event, 'praktik_mandiri')">PRAKTIK MANDIRI</button>
</div>

<div id="klinik" class="tabcontent">
  <h3>Download Juknis Klinik</h3>
   <a target="_blank" href="<?php echo site_url('assets/CONTOH.pdf')?>" class="btn btn-block btn-success">Download Juknis</a>
    <a target="_blank" href="<?php echo site_url('assets/SE TENTANG REGISTRASI KLINIK.pdf')?>" class="btn btn-block btn-success">Download Surat Edaran</a>
</div>

<div id="labkes" class="tabcontent">
  <h3>Download Juknis Labkes</h3>
    <a target="_blank" href="<?php echo site_url('assets/Juknis aplikasi registrasi LABKES.pdf')?>" class="btn btn-block btn-success">Download Juknis</a>
    <a target="_blank" href="<?php echo site_url('assets/SE Registrasi LAb.pdf')?>" class="btn btn-block btn-success">Download Surat Edaran</a>
</div>

<div id="rs" class="tabcontent">
   <h3>Download Juknis RS</h3>
   <a target="_blank" href="<?php echo site_url('assets/Juknis_SE REGISTRASI RS.pdf')?>" class="btn btn-block btn-success">Download Juknis</a>
    <a target="_blank" href="<?php echo site_url('assets/SE Reg RS.pdf')?>" class="btn btn-block btn-success">Download Surat Edaran</a>
</div>

<div id="utd" class="tabcontent">
 <h3>Download Juknis UTD</h3>
    <a target="_blank" href="<?php echo site_url('assets/Juknis aplikasi registrasi UTD.pdf')?>" class="btn btn-block btn-success">Download Juknis</a>
    <a target="_blank" href="<?php echo site_url('assets/SURAT EDARAN REGISTRASI UTD.pdf')?>" class="btn btn-block btn-success">Download Surat Edaran</a>
  
</div>

<div id="praktik_mandiri" class="tabcontent">
 <h3>Download Juknis PRAKTIK MANDIRI</h3>
    <a target="_blank" href="<?php echo site_url('assets/Juknis Registrasi Tempat Praktik Mandiri Nakes.pdf')?>" class="btn btn-block btn-success">Download Juknis</a>
    <a target="_blank" href="<?php echo site_url('assets/Surat Edaran Dirjen Yankes tentang Registrasi Tempat Praktik Mandiri Tenaga Kesehatan.pdf')?>" class="btn btn-block btn-success">Download Surat Edaran</a>
  
</div>


          </div> -->
          <!-- /.box -->


        <!-- </div> -->
        <!--/.col (left) -->

        <!--/.col (right) -->
      <!-- </div> -->
      <!-- /.row -->
    <!-- </section> -->
    <!-- /.content -->

            <!-- /.tab-content -->
          <!-- </div>  -->

<script>
function openTab(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>