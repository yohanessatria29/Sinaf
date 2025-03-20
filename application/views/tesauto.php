<!doctype html>
<html>
  <head>
  <title>Cara Membuat AutoComplete Codeigniter</title>

  <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://dfo.kemkes.go.id/assets/css/main/app.css">
    <link rel="stylesheet" href="https://dfo.kemkes.go.id/assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="https://dfo.kemkes.go.id/assets/temp/img/loginlg1.png" type="image/x-icon">
    <link rel="shortcut icon" href="https://dfo.kemkes.go.id/assets/temp/img/loginlg1.png" type="image/png">
    <link rel="stylesheet" href="https://dfo.kemkes.go.id/assets/css/pages/simple-datatables.css">
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="https://dfo.kemkes.go.id/assets/css/pages/filepond.css">
    <link rel="stylesheet" href="https://dfo.kemkes.go.id/assets/temp/jquery-ui.css">
    <script src="https://dfo.kemkes.go.id/assets/temp/jquery-3.6.0.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://dfo.kemkes.go.id/assets/css/jquery-ui.css">
  </head>

  <body>
                                    

<body>
<div id="app">
            <div id="main">
                <header class="mb-3">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </header>
                
                <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Dasar Puskesmas</h3>
                    <p class="text-subtitle text-muted">
                    </p>
                </div>
            </div>
        </div>

        <section class="section">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item mb-4" role="presentation">
                                <a class="nav-link" href="https://dfo.kemkes.go.id/Puskesmas"
                                    aria-controls="data-dasar">Data Dasar</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" href="https://dfo.kemkes.go.id/Puskesmas/penyakit"
                                    aria-controls="data-sarpras">10 Besar Penyakit</a>
                            </li>
                        </ul>

                       
                                <div class="row">
                                    <form action="https://dfo.kemkes.go.id/Puskesmas/simpan_penyakit" method="post">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">Nama Penyakit</label>
                                             <input type="text" class="form-control"
                                                placeholder="Cari Nama Penyakit" name="namasurveior" id="namasurveior" autocomplete="on">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Jumlah Kasus</label>
                                            <input type="text" id="jumlah" class="form-control" name="jumlah"
                                                placeholder="Jumlah">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <br>
                    
                </div>
    </section>
                                
            

               



    
</body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- jQuery UI -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://dfo.kemkes.go.id/assets/js/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="https://dfo.kemkes.go.id/assets/js/bootstrap.js" type="text/javascript"></script>
    <script src="https://dfo.kemkes.go.id/assets/js/jquery-ui.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){


            $('#namasurveior').autocomplete({
                source: "<?php echo site_url('Tesauto/get_autocomplete_surveior');?>",
     
                select: function (event, ui) {
                    $('[name="nama"]').val(ui.item.label);
                }
            });

        });
    </script>
  </body>
</html>