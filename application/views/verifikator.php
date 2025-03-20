<?php

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Usul Survei</title>
    
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main/app-dark.css');?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg');?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png');?>" type="image/png">

</head>

<body>
<?php
    include('template/sidebar.php');
    
    ?>

<section class="section">
<div class="row">
    <div class="col-md-12">
    <div class="container">
        <div class="card">
          
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Verifikator</a>
                    </li>
                    
                </ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div class="card">
</br>
           
            <div class="buttons">
                <a href="<?php echo base_url()?>pengajuan/inputverifikator" class="btn btn-success rounded-pill">Input Verifikator</a>
                <!-- <a href="#" class="btn btn-light rounded-pill">Bersihkan</a> -->
           </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Email</th>
                           
                            <th>No Hp</th>
                          
                            <th>Action</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $n=1;
                        foreach ($data as $data) {
                           
                        ?>

                       <?php
                        
                        ?>
                        <tr>
                            <td><?=$n++;?></td>
                           
                            <td><?=$data['nik'];?></td>
                            <td><?=$data['nama'];?></td>
                            <td><?=$data['email'];?></td>
                          
                            <td><?=$data['no_hp'];?></td>
                           

                            <td><div class="buttons">
                            <a href="<?php echo base_url('pengajuan/editverifikator/').$data['id'];?>"  class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
                            <a href="<?php echo base_url('pengajuan/hapusverifikator/').$data['users_id'].'/'.$data['no_hp'];?>" onclick="return confirm('Apa Anda Yakin Ingin Menghapusnya?')" class="btn icon btn-danger">Delete</a>
                            <!-- <a href=""></a> -->
                            </div></td>

                            
                        </tr>

                        <?php
                       
                            }
                        ?>

                        
                        
                    </tbody>
                    
                </table>
            </div>
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
                    <!-- <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div> -->
                </div>
            </footer>
</div>
</div>
</div>
</div>
    <script src="<?php echo base_url()?>assets/js/app.js">
   $('#btn_hapus').on('click',function(e){
    e.preventDefault();
    var id=$('#id_cus').val();
    $.ajax({
    type : "POST",
    url  : "<?php echo base_url('pengajuan/hapusverifikator/')?>",
      data : {id: id},
        success: function(data){
                $('#ModalHapus').modal('hide');
                data_customer();
        }
      });
    });
    </script>

   
</body>

</html>
