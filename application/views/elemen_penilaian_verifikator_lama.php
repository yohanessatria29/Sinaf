<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elemen Penilaian Verifikator</title>
    
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="<?php echo base_url('assets/temp');?>/jquery-ui.css">
    <script src="<?php echo base_url('assets/temp');?>/jquery-3.6.0.js"></script>
    
</head>

<body>
    <?php
    include('sidebar_verifikator.php');
    ?>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <section class="section">
<div class="row">
    <div class="col-md-12">
        <div class="card">
          
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Elemen Penilaian Verifikator</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="persentase-tab" data-bs-toggle="tab" href="#persentase" role="tab"
                            aria-controls="persentase" aria-selected="false">Persentase Capaian</a>
                    </li>
                    
                </ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="page-heading">
            <div class="page-title">
                
            </div>
            <section class="section">

            <div class="card">
            <!-- <div class="card-header">
                  <h3> <b> Elemen Penilaian Surveior</b> </h3>
            </div> -->
            <!-- <?php
            foreach ($data as $data) {
                if($data['jenis_fasyankes'] == 5){
                    $jenis_fasyankes = 'Klinik';
                } else if ($data['jenis_fasyankes'] == 6){
                    $jenis_fasyankes = 'UTD';
                } else if ($data['jenis_fasyankes'] == 7){
                    $jenis_fasyankes = 'Laboratorium/Bank Jaringan';
                } else if ($data['jenis_fasyankes'] == 11){
                    $jenis_fasyankes = 'Puskemas';
                }
            ?>
            
            <div class="card-header">
                    Jenis Fasyankes : Klinik
            </div>
            <?php
            }
            ?> -->
            <div class="card-header">
                    Nama Verifikator : Verifikator 1
            </div>

            
            <div class="card-body">
                <!-- <?php var_dump($data['jenis_fasyankes']) ?> -->
                <!-- <?php var_dump($trans) ?> -->
                    <?php echo form_open_multipart('verifikator/epverifikator/'.$id) ?>
                    <form role="form"  method="post" class="login-form" name="form_valdation">
                                <div class="form-group row align-items-center">
                                                <div class="col-lg-2 col-3">
                                                    <label class="col-form-label">BAB</label>
                                                </div>
                                                <div class="col-lg-10 col-9">
                                                <?=form_dropdown('bab', dropdown_sina_ep($data['jenis_fasyankes']),$bab,'id="bab"  class="form-select" required');?>
                                                <?php //var_dump($data[0]);?>
                                                </div>
                        </div>
                        <div class="buttons">
                            <!-- <a href="#" class="btn btn-success rounded-pill">Tampilkan</a> -->
                            <button type="submit" class="btn btn-success me-1 mb-1">Cari</button>     
                            <!-- <a href="#" class="btn btn-light rounded-pill">Bersihkan</a> -->
                    </div>
                    </form>
                
                    <?php echo form_open_multipart('verifikator/simpanEp/') ?>
                        <form role="form"  method="post" class="login-form" name="form_valdation">
                        <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bab</th>
                            <th>Standar</th>
                            <th>Kriteria</th>
                            <th>Elemen Penilaian</th>
                            <th>Uraian</th>
                            <th>SKOR Capaian Surveior</th>
                            <th>SKOR Maksimal</th>
                            <th>Persentase Capaian Surveior</th>
                            <th>FAKTA DAN ANALISIS</th>
                            <th>REKOMENDASI Hasil Survei</th>
                            <th>SKOR Capaian Verifikator</th>
                            <th>Persentase Capaian Verifikator</th>
                            <th>Keterangan</th>
                            <!-- <th>Nama Verifikator</th> -->

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $n=1;
                        foreach ($datab as $datab) {
                            $key = $datab['id'];    
                            
                        ?>
                        <tr>
                        <td><?=$n;?></td>                           
                                <td><?= $datab['bab'] ?></td>
                                <td><?= $datab['standar'] ?></td>
                                <td><?= $datab['kriteria'] ?></td>
                                <td><?= $datab['elemen'] ?></td>
                                <td><?= $datab['keterangan_elemen'] ?></td>

                        
                                <td><?= (!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : 0) ?> </td>
                                <?php
                                if ((!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : '') == "TDD"){
                                ?>
                                <td>TDD</td>
                                <?php
                                    } else {
                                ?>
                                <td><?= $datab['skor_maksimal'] ?> </td>
                                <?php
                                    }
                                ?>
                                
                                <td><?=(!empty($trans[$key]['persentase_capaian_surveior']) ? $trans[$key]['persentase_capaian_surveior'] : 0)?></td>
                                <td><?=(!empty($trans[$key]['fakta_dan_analisis']) ? $trans[$key]['fakta_dan_analisis'] : '')?></td>
                                <td><?=(!empty($trans[$key]['rekomendasi']) ? $trans[$key]['rekomendasi'] : '')?></td>

                                <?php
                                if ((!empty($trans[$key]['skor_capaian_surveior']) ? $trans[$key]['skor_capaian_surveior'] : '') == "TDD"){
                                ?>
                                <td>
                                    <select class="form-select skor_capaian_verifikator" id="skor_capaian_verifikator" name="skor_capaian_verifikator[<?=$key;?>]">
                                        <option value='TDD'>TDD</option>
                                    </select> </td>
                                <?php
                                    } else {
                                ?>
                                <td>
                                    <select class="form-select skor_capaian_verifikator" id="skor_capaian_verifikator" name="skor_capaian_verifikator[<?=$key;?>]">
                                        <option value='0' <?php if ((!empty($trans[$key]['skor_capaian_verifikator']) ? $trans[$key]['skor_capaian_verifikator'] : '')  == "0") echo "selected" ?> >0</option>
                                        <option value='5' <?php if ((!empty($trans[$key]['skor_capaian_verifikator']) ? $trans[$key]['skor_capaian_verifikator'] : '')  == "5") echo "selected" ?>>5</option>
                                        <option value='10' <?php if ((!empty($trans[$key]['skor_capaian_verifikator']) ? $trans[$key]['skor_capaian_verifikator'] : '')  == "10") echo "selected" ?>>10</option>
                                        <!-- <option value='TDD' <?php if ((!empty($trans[$key]['skor_capaian_verifikator']) ? $trans[$key]['skor_capaian_verifikator'] : '')  == "TDD") echo "selected" ?>>TDD</option> -->
                                    </select> 
                                    <!-- <input type="text" class="form-control" id="tesssss<?=$n?>" name="tesssss" value="<?=(!empty($trans[$key]['skor_capaian_verifikator']) ? $trans[$key]['skor_capaian_verifikator'] : 0)?>" readonly> -->
                                </td>
                                <?php
                                    }
                                ?>

                            <td><input type="text" class="form-control" id="persentase_capaian_verifikator<?=$n?>" name="persentase_capaian_verifikator" value="<?=(!empty($trans[$key]['persentase_capaian_verifikator']) ? $trans[$key]['persentase_capaian_verifikator'] : 0)?>" readonly></td>
                            <td><textarea class="form-control" rows="4" cols="50" id="keterangan" minlength="30" name="keterangan[<?=$key;?>]"><?=(!empty($trans[$key]['keterangan']) ? $trans[$key]['keterangan'] : '')?></textarea></td>
                            <!-- <td><input type="text" class="form-control" id="nama_verifikator" name="nama_verifikator" value="" readonly></td> -->
                            
                            <input type="hidden" name="trans_ep_id[<?=$key;?>]" value="<?=(!empty($trans[$key]['id']) ? $trans[$key]['id'] : '')?>"></td>
                            <input type="hidden" name="skor_maksimal[<?=$key;?>]" value="<?=$datab['skor_maksimal'];?>">
                            <input type="hidden" name="id_ep[]" value="<?=$key;?>">
                        </tr>

                        <?php
                            
                       
                        $n++;
                        }
                        ?>
                       
                    </tbody>
                </table>
                    </div>
            </div>
            <input type="hidden" name="penetapan_tanggal_survei_id" value="<?=$data['penetapan_tanggal_survei_id'];?>">
            <input type="hidden" name="id_pengajuan" value="<?=$id;?>">
            
            <?php
            if ((!empty($data['status_final_ep_verifikator']) ? $data['status_final_ep_verifikator'] : '') != '1'){
            ?>
            <button type="submit" class="btn btn-primary rounded-pill">Submit</button> 
            <?php
            }
            ?>
                    </form>
        </div>
        
            <a href="#" class="btn icon btn-primary">Kirim</a>
</section>
        </div>
    </div>

    <!-- Tab Baru -->
    <div class="tab-pane fade show" id="persentase" role="tabpanel" aria-labelledby="persentase-tab">
        <div class="page-heading">
            <div class="page-title">
                
            </div>
            <section class="section">

            <div class="card">
            <div class="card-header">
               
            </div>
            <?php echo form_open_multipart('verifikator/final_ep/') ?>
            <form role="form"  method="post" class="login-form" name="form_valdation">
        <!-- <div class="row"> -->
        <div class="card-body">
        </br>
            <div class="row">
                <?php
                // var_dump($count_trans);
                ?>
                <table class="table table-striped" id="table2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bab</th>
                                    <th>Skor Capaian Surveior</th>
                                    <th>Skor Maksimal Surveior</th>
                                    <th>Persentase Capaian Surveior ( % )</th>
                                    <th>Skor Capaian Verifikator</th>
                                    <th>Skor Maksimal Verifikator</th>
                                    <th>Persentase Capaian Verifikator ( % )</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                        $n=1;
                        foreach ($count_trans as $count_trans) {
                            // $key = $datab['id'];    
                            
                        ?>
                        <tr>
                        <td><?=$n;?></td>                           
                                <td><?= $count_trans['bab'] ?></td>
                                <td><?= $count_trans['skor_capaian_surveior'] ?></td>
                                <td><?= $count_trans['skor_maksimal_surveior'] ?></td>
                                <td><?= number_format((float)$count_trans['persentase_capaian_surveior'], 0, '.', '') ?></td>
                                <td><?= $count_trans['skor_capaian_verifikator'] ?></td>
                                <td><?= $count_trans['skor_maksimal_verifikator'] ?></td>
                                <td><?= number_format((float)$count_trans['persentase_capaian_verifikator'], 0, '.', '') ?></td>
                                </tr>

                        <?php
                            
                       
                        $n++;
                        }
                        ?>

                            </tbody>
                            </table>
            </div>

            
            
            
        </div>
        <input type="hidden" name="penetapan_verifikator_id" value="<?=$data['penetapan_verifikator_id'];?>">
        <!-- <?php var_dump($data);?> -->
        <input type="hidden" name="id_pengajuan" value="<?=$id;?>">
        <?php
        if ((!empty($data['status_final_ep_verifikator']) ? $data['status_final_ep_verifikator'] : '') != '1'){
            ?>
            <button type="submit" class="btn btn-success rounded-pill">Final</button> 
            <?php
            }
            ?>
                    </form>

        </div>
</section>
        </div>
    </div>
    <!-- Tab Baru -->

    
</section>
        </div>
    </div>

</div>


            
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
   
    </script>
   
</body>

</html>

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <script type="text/javascript"> 

    

        </script>

<script>
    $(document).ready(function(){
            //alert('tes');
            $("#table1").on('change','.skor_capaian_verifikator',function(){
                
                var currentRow = $(this).closest("tr"); 
                var nomor = currentRow.find("td:eq(0)").text();
                
                var nilaicapaian = currentRow.find('td').eq(11).find('select option:selected').text().replace(/\,/g,'');
                // alert(nilaicapaian);
                var nilaiMax = currentRow.find("td:eq(7)").text();

                
                if (nilaicapaian== "TDD"){
                    $("#persentase_capaian_verifikator"+nomor).val("TDD");
                    //currentRow.find("td:eq(7)").text("TDD");

                } else {
                    if (nilaiMax== "TDD"){
                        var persentase = (nilaicapaian / 10) * 100
                        $("#persentase_capaian_verifikator"+nomor).val(persentase);
                        
                    } else {
                        var persentase = (nilaicapaian / nilaiMax) * 100
                        $("#persentase_capaian_verifikator"+nomor).val(persentase);

                    }
                    //currentRow.find("td:eq(7)").text("10");
                }
                
            });

        })
    </script>
