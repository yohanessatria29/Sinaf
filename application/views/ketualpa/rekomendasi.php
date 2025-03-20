<div class="card">
    <div class="card-body">
        <?php echo form_open_multipart('Admin/rekomendasi_status_akreditasi') ?>
        <form role="form" method="post" class="login-form" name="form_valdation">
            <div class="row" style="margin-bottom: 0.7rem;">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Tanggal</label>
                </div>
                <div class="col-lg-10 col-9">
                    <div class="input-group">
                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="<?=$tanggal_awal?>">
                        <span class="mx-2 my-auto">s.d.</span>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="<?=$tanggal_akhir?>" min="<?=$tanggal_awal?>" readonly>
                    </div>
                </div>
            </div>
        
            <div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Provinsi</label>
                </div>
                <div class="col-lg-10 col-9">
                    <?=form_dropdown('propinsi', dropdown_sina_propinsi(),$propinsi,'id="provinsi_id"  class="form-select" required');?>
                </div>
            </div>

            <div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Kab/Kota</label>
                </div>
                <div class="col-lg-10 col-9">
                    <?=form_dropdown('kota', dropdown_sina_kab_kota(),$kota,'id="kota_id"  class="form-select"');?>
                </div>
            </div>

            <div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Jenis Fasyankes</label>
                </div>
                <div class="col-lg-10 col-9">
                    <?=form_dropdown('jenis_fasyankes', dropdown_sina_jenis_fasyankes(),$jenis_fasyankes,'id="jenis_fasyankes"  class="form-select" ');?>
                </div>
            </div>

            <div class="form-group row align-items-center">
                <div class="col-lg-2 col-3">
                    <label class="col-form-label">Status Verifikasi</label>
                </div>
                <div class="col-lg-10 col-9">
                    <?= form_dropdown('status_verifikasi_id', array(1=>'Belum Verifikasi',2=>'Sudah Verifikasi'), $status_verifikasi_id, 'id="status_verifikasi_id"  class="form-select"'); ?>
                </div>
            </div>
            <div class="buttons">
                <button href="submit" class="btn btn-success rounded-pill">Tampilkan</button>
                <a href="<?php echo base_url('admin/rekomendasi_status_akreditasi');?>" class="btn btn-light rounded-pill">Bersihkan</a>
            </div>
        </form>

        <table class="table table-striped text-center" id="table1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Fasyankes</th>
                    <th>Nama Fasyankes</th>
                    <th>Jenis Fasyankes</th>
                    <th>LPA</th>
                    <th>Provinsi</th>
                    <th>Kab/Kota</th>
                    <th>Tanggal Verifikasi</th>
                    <th>Status Verifikasi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)) : ?>
                    <?php
                        $n=1;
                        foreach ($data as $data) {
                            $timestamp = strtotime($data['tanggal_pengiriman_rekomendasi']);
                            $date_formated = date('d-m-Y', $timestamp);
                            if($date_formated == '01-01-1970'){
                                $tanggal='';
                            }else{
                                $tanggal=$date_formated;
                            }
                            $lpa_id = $data['lpa_id'];
                    ?>

                        <tr>
                            <td><?=$n;?></td>
                            <td><?=$data['fasyankes_id'];?></td>
                            <td><?=$data['nama_fasyankes'];?></td>
                            <td><?=$data['jenis_fasyankes_nama'];?></td>
                            <td><?=$data['lpa'];?></td>
                            <td><?=$data['nama_prop'];?></td>
                            <td><?=$data['nama_kota'];?></td>
                            <td><?=$tanggal;?></td>
                            <td>
                                <?php if($data['status_usulan_id'] == 1) { ?>
                                    <span class="badge bg-warning">Belum Verirfikasi</span>
                                <?php } else if($data['status_usulan_id']== 2 ) { ?>
                                    <span class="badge bg-danger">Ditolak</span>
                                <?php } else if ($data['status_usulan_id']== 3 ) { ?>
                                    <span class="badge bg-success">Sudah Verifikasi</span>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="buttons">
                                    <a href="<?php echo base_url('admin/detail/').$data['id'];?>"  class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
                                </div>
                            </td>
                        </tr>

                    <?php
                        $n++;
                        }
                    ?>
                <?php else : ?>
                    <tr>
                        <td colspan="10">No data available in this table.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    $( window ).on( "load", function() {
        $('.nav-item').find('a.active').removeClass('active');
        document.getElementById("rekomendasi-tab").classList.add('active');
    });
</script>