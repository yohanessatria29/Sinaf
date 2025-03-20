<?php

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ketua Lembaga</title>
    
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
                <?php
                        if($this->session->flashdata('msg') !=null){
                    ?>
                                <div class="alert alert-<?=$this->session->flashdata('kode_name');?> alert-dismissible">
                                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> </button>
                                    <h4><i class="icon fa fa-<?=$this->session->flashdata('icon_name');?>"></i> Alert!</h4> -->
                                    <?=$this->session->flashdata('msg');?>
                                </div>
                    <?php
                        }
                    ?>
                    <div class="card-body">
                        <h4>List User Ketua Lembaga</h4>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card">
                                    </br>
                                    <div class="buttons">
                                        <a href="<?php echo base_url()?>User/inputketualpa" class="btn btn-success rounded-pill">Tambah User Ketua Lembaga</a>
                                        <!-- <a href="#" class="btn btn-light rounded-pill">Bersihkan</a> -->
                                        </div>
                                            <div class="card-body">
                                                <table class="table table-striped" id="table1">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>LPA</th>
                                                            <th>Email</th>
                                                            <th>No Hp</th>
                                                            <th>Status</th>
                                                            <th>Tanggal Aktif</th>
                                                            <th>Tanggal Non Aktif</th>
                                                            <th>Dokumen SK Penunjukan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $n=1;
                                                        foreach ($dataketualpa as $data) {

                                                        ?>
                                                        <tr>
                                                            <td><?=$n;?></td>
                                                            
                                                            <td><?=$data['nama'];?></td>
                                                            <td><?=$data['nama_lpa'];?></td>
                                                            <td><?=$data['email'];?></td>
                                                            <td><?=$data['no_hp'];?></td>
                                                            <td><?=$data['status'];?></td>
                                                            <td><?=$data['tanggal_aktif'];?></td>
                                                            <td><?=$data['tanggal_nonaktif'];?></td>
                                                            <td>
                                                            <?php
                                                                if (!empty($data['sk_penunjukan'])) {
                                                                ?>
                                                                    <a href="<?= $data['sk_penunjukan']; ?>" target="_blank" class="btn btn-primary rounded-pill">Lihat Dokumen</a>
                                                                <?php
                                                                }
                                                                ?>    
                                                            </td>
                                                            <td><div class="buttons">
                                                            <a href="<?php echo base_url('user/editketualpa/').$data['id'];?>"  class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
                                                            <a href="<?php echo base_url('user/hapusketualpa/').$data['users_id'].'/'.$data['no_hp'];?>" onclick="return confirm('Apa Anda Yakin Ingin Menghapusnya?')" class="btn icon btn-danger" id="delete">Delete</a>
                                                                
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        <?php
                                                        $n++;
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
        </div>   
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/app.js"></script>
    <script>
        
    </script>
</body>

</html>
