<?php $this->load->view('template/head');?>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/pages/filepond.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/temp');?>/jquery-ui.css">
    <script src="<?php echo base_url('assets/temp');?>/jquery-3.6.0.js"></script>

    <?php $this->load->view('template/sidebar');?>
    </div>
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
                                <a class="nav-link active" href="<?php echo base_url('Puskesmas')?>"
                                    aria-controls="data-dasar">Data Dasar</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="<?php echo base_url('Puskesmas/penyakit')?>"
                                    aria-controls="data-sarpras">10 Besar Penyakit</a>
                            </li>
                        </ul>

                        

            </div>
        </div>
    </section>
                                
            

    <?php $this->load->view('template/footer');?>
    <?php $this->load->view('template/js');?>

    </html>

    <script type="text/javascript">
        // $(document).ready(function(){
        //      $.ajax({
        //     type: "GET",
        //     url: '<?php echo base_url().'Puskesmas/integrasi_puskesmas' ?>',
        //     dataType: 'json',
        //     data: {'nama':nama},
        //     success: function(data){
        //         consol.log(data);
        //     }
        //  });

        //        });

            </script>

            <body>
            <script type="text/javascript">
            $.ajax({
              url : '<?php echo base_url().'Puskesmas/integrasi_puskesmas' ?>',
              dataType : 'json',
              success: function (data) {
                console.log(data);
                alert(data)
              },
              error: function (xhr, status, msg) {
                alert('Status: ' + status + "\n" + msg);
              }
            })
            </script>
            
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
    $( function() {
        $( "#datepicker" ).datepicker();
        $( "#datepicker2" ).datepicker();
        $( "#datepicker3" ).datepicker();
    } );
    </script>