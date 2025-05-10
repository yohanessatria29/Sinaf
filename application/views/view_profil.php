  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Usul Survei</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main/app-dark.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png'); ?>" type="image/png">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/pages/simple-datatables.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  </head>

  <body>
    <?php
    include('template/sidebar.php');

    if ($this->session->userdata('kriteria_id') == 3) {
      if ($datauser[0]->sertifikat_surveior != NULL) {
        $hideserti = '';
        $nama_sertifikat = $datauser[0]->sertifikat_surveior;
      } else {
        $hideserti = 'hidden';
      }
    }
    ?>
    <?php if ($this->session->flashdata('message_name') != null) { ?>
      <div class="alert alert-<?= $this->session->flashdata('kode_name'); ?> alert-dismissible">
        <?= $this->session->flashdata('message_name'); ?>
      </div>
    <?php } ?>
    <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="container">
              <?php
              if ($this->session->flashdata('Status_Aktif') === 0) : ?>
                <div class="alert alert-danger" id="warning">
                  <h5><strong>Akun Anda Tidak Aktif !</strong></h5>
                  <p>Hubungi Admin LPA untuk mengaktifkan Akun Anda.</p>
                </div>
              <?php endif; ?>
              <?php if ($this->session->flashdata('Status_Sertifikat') === 0) : ?>
                <div class="alert alert-danger" id="warning">
                  <h5><strong>Anda Belum Mengupload Sertifikat Refreshing atau Sertifikat Pelatihan !</strong></h5>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    <div class="table-responsive">

                      <?php
                      if ($this->session->flashdata('msg') != null) {
                      ?>
                        <div class="alert alert-<?= $this->session->flashdata('kode_name'); ?> alert-dismissible">
                          <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> </button>
                                      <h4><i class="icon fa fa-<?= $this->session->flashdata('icon_name'); ?>"></i> Alert!</h4> -->
                          <?= $this->session->flashdata('msg'); ?>
                        </div>
                      <?php
                      }
                      ?>
                      <h1>Profil </h1>

                      <?php
                      if ($this->session->userdata('kriteria_id') == 3) {
                      ?>
                        <?php
                        foreach ($datauser as $d) {
                        ?>
                          <table class="table table-striped mb-0">
                            <tbody>
                              <tr>
                                <td class="text-bold-500">NIK</td>
                                <td>:</td>
                                <td class="text-bold-500"><?= $d->nik ?></td>
                              </tr>
                              <tr>
                                <td class="text-bold-500">Nama User</td>
                                <td>:</td>
                                <td class="text-bold-500"><?= $d->nama ?></td>
                              </tr>
                              <tr>
                                <td class="text-bold-500">Email / Username</td>
                                <td>:</td>
                                <td class="text-bold-500"><?= $d->email ?></td>

                              </tr>

                              <tr>
                                <td class="text-bold-500">LPA</td>
                                <td>:</td>
                                <td class="text-bold-500"><?= $d->namalpa ?></td>
                              </tr>

                              <tr>
                                <td class="text-bold-500">No HP</td>
                                <td>:</td>
                                <td class="text-bold-500"><?= $d->nohp ?></td>
                              </tr>
                              <tr>
                                <td class="text-bold-500">Provinsi</td>
                                <td>:</td>
                                <td class="text-bold-500"><?= $d->propinsi ?></td>
                              </tr>
                              <tr>
                                <td class="text-bold-500">Kab/Kota</td>
                                <td>:</td>
                                <td class="text-bold-500"><?= $d->kabkota ?></td>
                              </tr>
                              <tr>
                                <td class="text-bold-500">Keaktifan</td>
                                <td>:</td>
                                <td class="text-bold-500"><?= $d->keaktifan ?></td>
                              </tr>
                              <!-- <tr>
                                          <td class="text-bold-500">Sertifikat Surveior</td>
                                          <td>:</td>
                                          <td class="text-bold-500"><a class="btn btn-primary rounded-pill" target="_blank" href="<?php //echo $d->sertif ;
                                                                                                                                  ?>">Lihat Dokumen</a></td>
                                      </tr> -->

                              <?php if (empty($d->sertif)) {

                              ?>
                                <tr>
                                  <td class="text-bold-500">Sertifikat Surveior</td>
                                  <td>:</td>
                                  <td class="text-bold-500">Tidak Ada Dokumen Sertifikat</td>
                                </tr>

                              <?php    } else { ?>
                                <tr>
                                  <td class="text-bold-500">Sertifikat Surveior</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo $d->sertif; ?>">Lihat Dokumen</a></td>
                                </tr>

                              <?php } ?>

                              <!-- Nasrul -->
                              <?php if (empty($d->sertif_anggota)) {

                              ?>
                                <tr>
                                  <td class="text-bold-500">Surat Keputusan Keanggotaan</td>
                                  <td>:</td>
                                  <td class="text-bold-500">Tidak Ada Dokumen Surat</td>
                                </tr>

                              <?php    } else { ?>
                                <tr>
                                  <td class="text-bold-500">Surat Keputusan Keanggotaan</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo $d->sertif_anggota; ?>">Lihat Dokumen</a></td>
                                </tr>

                              <?php } ?>



                            <?php } ?>
                            </tbody>
                          </table>

                          <br>
                          <h1>Bidang</h1>

                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Fasyankes</th>
                                <th>Bidang</th>
                              </tr>
                            </thead>

                            <tbody>
                              <?php
                              $n = 1;
                              foreach ($databidang as $data) {

                              ?>

                                <tr>
                                  <td><?= $n++ ?></td>
                                  <td><?= $data['fasyankes'] ?></td>
                                  <td><?= $data['bidang'] ?></td>
                                </tr>
                              <?php
                              }
                              ?>

                            </tbody>
                          </table>

                        <?php
                      } else if ($this->session->userdata('kriteria_id') == 4) {
                        ?>
                          <table class="table table-striped mb-0">
                            <?php
                            foreach ($dataverif as $a) {

                            ?>


                              <tbody>
                                <tr>

                                  <td class="text-bold-500">NIK</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->nik ?></td>
                                </tr>
                                <tr>
                                  <td class="text-bold-500">Nama User</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->nama ?></td>
                                </tr>
                                <tr>
                                  <td class="text-bold-500">Email / Username</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->email ?></td>

                                </tr>

                                <tr>
                                  <td class="text-bold-500">No HP</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->nohp ?></td>
                                </tr>

                              <?php } ?>
                              </tbody>
                          </table>
                        <?php  } else if ($this->session->userdata('kriteria_id') == 1) {
                        ?>
                          <table class="table table-striped mb-0">
                            <?php
                            foreach ($dataadminlpa as $a) {  ?>


                              <tbody>

                                <tr>
                                  <td class="text-bold-500">Nama User</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->nama ?></td>
                                </tr>
                                <tr>
                                  <td class="text-bold-500">Lembaga</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->nama_lpa ?></td>
                                </tr>
                                <tr>
                                  <td class="text-bold-500">Email / Username</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->email ?></td>

                                </tr>

                                <tr>
                                  <td class="text-bold-500">No HP</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->no_hp ?></td>
                                </tr>
                                <?php if (empty($a->sk_penugasan)) {

                                ?>
                                  <tr>
                                    <td class="text-bold-500">Dokumen SK Penugasan</td>
                                    <td>:</td>
                                    <td class="text-bold-500">Tidak Ada Dokumen</td>
                                  </tr>

                                <?php    } else { ?>
                                  <tr>
                                    <td class="text-bold-500">Dokumen SK Penugasan</td>
                                    <td>:</td>
                                    <td class="text-bold-500"><a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo $a->sk_penugasan; ?>">Lihat Dokumen</a></td>
                                  </tr>

                                <?php } ?>
                              <?php } ?>
                              </tbody>
                          </table>
                        <?php  } else if ($this->session->userdata('kriteria_id') == 5) {
                        ?>
                          <table class="table table-striped mb-0">
                            <?php
                            foreach ($dataketualpa as $a) {  ?>


                              <tbody>

                                <tr>
                                  <td class="text-bold-500">Nama User</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->nama ?></td>
                                </tr>
                                <tr>
                                  <td class="text-bold-500">Lembaga</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->nama_lpa ?></td>
                                </tr>
                                <tr>
                                  <td class="text-bold-500">Email / Username</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->email ?></td>

                                </tr>

                                <tr>
                                  <td class="text-bold-500">No HP</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->no_hp ?></td>
                                </tr>
                                <?php if (empty($a->sk_penunjukan)) {

                                ?>
                                  <tr>
                                    <td class="text-bold-500">Dokumen SK Penunjukan</td>
                                    <td>:</td>
                                    <td class="text-bold-500">Tidak Ada Dokumen</td>
                                  </tr>

                                <?php    } else { ?>
                                  <tr>
                                    <td class="text-bold-500">Dokumen SK Penunjukan</td>
                                    <td>:</td>
                                    <td class="text-bold-500"><a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo $a->sk_penunjukan; ?>">Lihat Dokumen</a></td>

                                  </tr>
                                <?php } ?>


                              <?php } ?>
                              </tbody>
                          </table>
                        <?php  } else if ($this->session->userdata('kriteria_id') == 2) {
                        ?>
                          <table class="table table-striped mb-0">
                            <?php
                            foreach ($dataadmkemenkes as $a) {  ?>


                              <tbody>
                                <tr>
                                  <td class="text-bold-500">Nama Admin Kemenkes</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->nama ?></td>
                                </tr>
                                <tr>
                                  <td class="text-bold-500">Unit Kerja</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->unit_kerja ?></td>
                                </tr>
                                <tr>
                                  <td class="text-bold-500">Jabatan</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->jabatan ?></td>
                                </tr>
                                <tr>
                                  <td class="text-bold-500">Email / Username</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->email ?></td>
                                </tr>
                                <tr>
                                  <td class="text-bold-500">No HP</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->no_hp ?></td>
                                </tr>
                                <?php if (empty($a->sk_penugasan)) {

                                ?>
                                  <tr>
                                    <td class="text-bold-500">Dokumen SK Penugasan</td>
                                    <td>:</td>
                                    <td class="text-bold-500">Tidak Ada Dokumen</td>
                                  </tr>

                                <?php    } else { ?>
                                  <tr>
                                    <td class="text-bold-500">Dokumen SK Penugasan</td>
                                    <td>:</td>
                                    <td class="text-bold-500"><a class="btn btn-primary rounded-pill" target="_blank" href="<?php echo $a->sk_penugasan; ?>">Lihat Dokumen</a></td>
                                  </tr>

                                <?php } ?>

                                <tr>
                                  <td class="text-bold-500">Status Keaktifan</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->status_keaktifan ?></td>

                                </tr>
                                <tr>
                                  <td class="text-bold-500">Tanggal Aktif Jabatan</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->tanggal_aktif ?></td>

                                </tr>
                                <tr>
                                  <td class="text-bold-500">Tanggal Non Aktif Jabatan</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $a->tanggal_nonaktif ?></td>

                                </tr>

                              <?php } ?>
                              </tbody>
                          </table>
                        <?php  } else { ?>

                          <table class="table table-striped mb-0">
                            <?php
                            foreach ($dataotheruser as $d) {
                            ?>
                              <tbody>
                                <tr>
                                  <td class="text-bold-500">NIK</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $d->nik ?></td>
                                </tr>
                                <tr>
                                  <td class="text-bold-500">Nama User</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $d->nama ?></td>
                                </tr>
                                <tr>
                                  <td class="text-bold-500">Email / Username</td>
                                  <td>:</td>
                                  <td class="text-bold-500"><?= $d->email ?></td>

                                </tr>

                              <?php } ?>
                              </tbody>
                          </table>
                        <?php } ?>

                        <br>
                        <?php
                        if ($this->session->userdata('kriteria_id') == 1 || $this->session->userdata('kriteria_id') == 2 || $this->session->userdata('kriteria_id') == 3 || $this->session->userdata('kriteria_id') == 4 || $this->session->userdata('kriteria_id') == 5) {
                        ?>
                          <button style="position: center;" type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                            Ganti Profil
                          </button>
                        <?php } else { ?> <br> <?php } ?>


                        <button style="position: center;" type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal1">
                          Ganti Password
                        </button>



                        <!-- Modal -->


                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <div class="modal-header">
                                <!-- <h5 style="text-align: center;" >Ubah Profil</h5> -->
                                <div class="center">
                                  <h5 style="text-align: center;">Ubah Profil</h5>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <br>
                              <?php
                              if ($this->session->userdata('kriteria_id') == 4) {
                                $datum = $dataverif;
                              } else if ($this->session->userdata('kriteria_id') == 3) {
                                $datum = $datauser;
                              } else if ($this->session->userdata('kriteria_id') == 1) {
                                $datum = $dataadminlpa;
                              } else if ($this->session->userdata('kriteria_id') == 5) {
                                $datum = $dataketualpa;
                              } else if ($this->session->userdata('kriteria_id') == 2) {
                                $datum = $dataadmkemenkes;
                              } else {
                                $datum = $dataotheruser;
                              }
                              ?>

                              <?php
                              if ($this->session->userdata('kriteria_id') == 1 || $this->session->userdata('kriteria_id') == 5) {
                              ?>
                                <div class="modal-body">
                                  <form method="post" action="<?php echo base_url() . 'profil/update_profil' ?>" enctype='multipart/form-data'>
                                    <div class="col-sm">
                                      <h6 style="text-align: left;">Nama</h6>
                                      <input value="<?= $datum[0]->nama ?>" class="form-control form-control-lg" id="Nama" type="Nama" name="nama_baru" placeholder="Nama Baru" required>
                                    </div>
                                    <br>

                                    <div class="col-sm">
                                      <h6 style="text-align: left;">No.Hp/ No.Telp</h6>
                                      <input value="<?= $datum[0]->no_hp ?>" class="form-control form-control-lg" id="NoHpBaru" type="NoHpBaru" name="nohpbaru" placeholder="NoHp baru" required>
                                    </div>
                                    <br>
                                    <div class="col-sm">
                                      <h6 style="text-align: left;">Dokumen SK</h6>


                                      <?php if ($this->session->userdata('kriteria_id') == 1) {  ?>

                                        <small class="text-muted"> <a target="_blank" href="<?php echo $datum[0]->sk_penugasan; ?>">Download Dokumen Lama</a></small>

                                      <?php } else {  ?>
                                        <small class="text-muted"> <a target="_blank" href="<?php echo $datum[0]->sk_penunjukan; ?>">Download Dokumen Lama</a></small>
                                      <?php }  ?>


                                      <div class="input-group">
                                        <!-- Input untuk URL Dokumen SK -->
                                        <input type="text" class="form-control" id="dokumen_sk" name="dokumen_sk"
                                          aria-describedby="inputGroupFileAddon04" aria-label="Masukkan Link Dokumen SK"
                                          placeholder="Masukkan URL Dokumen SK"
                                          value="<?= isset($data[0]['dokumen_sk']) ? $data[0]['dokumen_sk'] : '' ?>">

                                        <?php
                                        // Mengecek apakah ada URL yang sudah ada
                                        if (!empty($data[0]['dokumen_sk'])) {
                                          $dokumen_sk = $data[0]['dokumen_sk'];
                                          // Menampilkan link dokumen jika URL sudah ada
                                          echo '<a class="btn btn-primary rounded-pill" target="_blank" href="' . $dokumen_sk . '">Lihat Dokumen</a>';
                                        } else {
                                          $dokumen_sk = "";
                                        }
                                        ?>

                                        <!-- Menyimpan URL lama -->
                                        <input type="hidden" name="old_dokumen_sk" value="<?= $dokumen_sk ?>" id="old_dokumen_sk">
                                      </div>


                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-success ml-1" data-bs-dismiss="modal">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Simpan</span>
                                      </button>
                                    </div>
                                  </form>
                                </div>

                              <?php } else if ($this->session->userdata('kriteria_id') == 2) { ?>

                                <div class="modal-body">
                                  <form method="post" action="<?php echo base_url() . 'profil/update_profil' ?>" enctype='multipart/form-data'>
                                    <div class="col-sm">
                                      <h6 style="text-align: left;">Nama Admin</h6>
                                      <input value="<?= $datum[0]->nama ?>" class="form-control form-control-lg" id="Nama" type="Nama" name="nama_baru" placeholder="Nama Baru" required>
                                    </div>
                                    <br>

                                    <div class="col-sm">
                                      <h6 style="text-align: left;">Unit Kerja</h6>

                                      <?= form_dropdown('unit_kerja', dropdown_unitkerja(), $datum[0]->id_unit, 'id="unit_kerja" class="form-select"'); ?>
                                    </div>
                                    <br>
                                    <div class="col-sm">
                                      <h6 style="text-align: left;">Jabatan</h6>

                                      <?= form_dropdown('jabatan', dropdown_jabatanadminkemenkes(), $datum[0]->id_jabatan, 'id="jabatan" class="form-select"'); ?>
                                    </div>
                                    <br>

                                    <div class="col-sm">
                                      <h6 style="text-align: left;">No.Hp/ No.Telp</h6>
                                      <input value="<?= $datum[0]->no_hp ?>" class="form-control form-control-lg" id="NoHpBaru" type="NoHpBaru" name="nohpbaru" placeholder="NoHp baru" required>
                                    </div>
                                    <br>
                                    <div class="col-sm">
                                      <h6 style="text-align: left;">Dokumen SK</h6>
                                      <small class="text-muted"> <a target="_blank" href="<?php echo $datum[0]->sk_penugasan; ?>">Download Dokumen Lama</a></small>

                                      <div class="input-group">
                                        <!-- Input untuk URL Dokumen SK -->
                                        <input type="text" class="form-control" id="dokumen_sk" name="dokumen_sk"
                                          aria-describedby="inputGroupFileAddon04" aria-label="Masukkan Link Dokumen SK"
                                          placeholder="Masukkan URL Dokumen SK"
                                          value="<?= isset($data[0]['dokumen_sk']) ? $data[0]['dokumen_sk'] : '' ?>">

                                        <?php
                                        // Mengecek apakah ada URL yang sudah ada
                                        if (!empty($data[0]['dokumen_sk'])) {
                                          $dokumen_sk = $data[0]['dokumen_sk'];
                                          // Menampilkan link dokumen jika URL sudah ada
                                          echo '<a class="btn btn-primary rounded-pill" target="_blank" href="' . $dokumen_sk . '">Lihat Dokumen</a>';
                                        } else {
                                          $dokumen_sk = "";
                                        }
                                        ?>

                                        <!-- Menyimpan URL lama -->
                                        <input type="hidden" name="old_dokumen_sk" value="<?= $dokumen_sk ?>" id="old_dokumen_sk">
                                      </div>


                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-success ml-1" data-bs-dismiss="modal">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Simpan</span>
                                      </button>
                                    </div>
                                  </form>
                                </div>


                              <?php } else { ?>
                                <div class="modal-body">
                                  <form method="post" action="<?php echo base_url() . 'profil/update_profil' ?>">
                                    <div class="col-sm">
                                      <h6 style="text-align: left;">Nama</h6>
                                      <input value="<?= $datum[0]->nama ?>" class="form-control form-control-lg" id="Nama" type="Nama" name="nama_baru" placeholder="Nama Baru" required>
                                    </div>
                                    <br>
                                    <div class="col-sm">
                                      <h6 style="text-align: left;">No.Hp/ No.Telp</h6>
                                      <input value="<?= $datum[0]->nohp ?>" class="form-control form-control-lg" id="NoHpBaru" type="NoHpBaru" name="nohpbaru" placeholder="NoHp baru" required>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-success ml-1" data-bs-dismiss="modal">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Simpan</span>
                                      </button>
                                    </div>
                                  </form>
                                </div>

                              <?php } ?>
                            </div>
                          </div>
                        </div>


                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel1">Ganti Password</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                <br>
                                <form method="post" action="<?php echo base_url() . 'profil/update_pass' ?>">
                                  <div class="col-sm">
                                    <h6 style="text-align: left;">Password Lama</h6>
                                    <input value="" class="form-control form-control-lg" id="oldpass" type="Password" name="oldpass" placeholder="Password lama" required>
                                  </div>
                                  <br>
                                  <div class="col-sm">
                                    <h6 style="text-align: left;">Password Baru</h6>
                                    <input value="" class="form-control form-control-lg" id="Password" type="Password" name="password" placeholder="Password baru" required>
                                  </div>
                                  <br>
                                  <div class="col-sm">
                                    <h6 style="text-align: left;">Konfirmasi Password Baru</h6>
                                    <input value="" class="form-control form-control-lg" id="confirmpass" type="Password" name="confirmpass" placeholder="Konfirmasi Password" required>
                                  </div>
                                  <p style="font-size: 14px; color:#ff2d03;- margin-top: 1px;"><span style="color: red;">**</span> Password :Minimal 8 karakter, memiliki huruf besar, <br>huruf kecil, angka dan spesial karakter e.g,!@#$%^&()</p>

                                  <div class="modal-footer">

                                    <button type="submit" class="btn btn-success ml-1" data-bs-dismiss="modal">
                                      <i class="bx bx-check d-block d-sm-none"></i>
                                      <span class="d-none d-sm-block">Simpan</span>
                                    </button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>


                    </div>
                  </div>
                  <!--BorderLess Modal Modal -->

                </div>
              </div>
            </div>

          </div>

          <?php
          if ($this->session->userdata('kriteria_id') == 3) {
          ?>
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h2 class="card-title">Sertifikat Refreshing / Sertifikat Pelatihan</h2>
                </div>
                <div class="card-body">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="">Dokumen Sertifikat</label>
                      </div>
                      <div class="col-md-6">
                        <?php
                        $link_sertifikat = $nama_sertifikat ?? '';

                        // Cek apakah link eksternal (https) atau file lokal PDF
                        $is_external = preg_match('#^https?://#i', $link_sertifikat);
                        $is_pdf = preg_match('/\.pdf$/i', $link_sertifikat);

                        if (!empty($link_sertifikat)) {
                          $url_view = $is_external ? $link_sertifikat : base_url('/assets/uploads/berkas_akreditasi/' . $link_sertifikat);
                          echo '<a class="btn btn-primary rounded-pill" target="_blank" href="' . $url_view . '">Lihat Dokumen Sertifikat</a>';
                        }
                        ?>
                      </div>
                      <?php echo form_open_multipart('Profil/uploadsertifikat') ?>
                      <form role="form" method="post" class="login-form" name="form_valdation">
                        <div class="row mt-2">
                          <div class="col-md-8">
                            <input type="url" class="form-control" name="sertifikat_surveior" id="sertifikat_surveior"
                              placeholder="Masukkan link Google Drive atau URL PDF"
                              value="<?= $link_sertifikat ?? '' ?>" required />
                            <p><small>Masukkan link URL Google Drive atau file PDF. Contoh: https://drive.google.com/...</small></p>
                          </div>
                          <div class="col-md-4">
                            <button type="submit" class="btn btn-success rounded-pill">Simpan Link</button>
                          </div>
                        </div>
                      </form>


                    </div>
                  </div>
                </div>
              </div>
            <?php
          }
            ?>
            </div>
            <!-- Button trigger modal -->
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="modal_uploadserti">
          <div class="modal-dialog">
            <form class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Upload Confirmation</h5>
                <button type="button" class="close" data-bs-dismiss="modal">
                  <span>&times;</span>
                </button>
              </div>
              <div class="modal-body" style="height: 100px">
                <p>Apakah Anda Yakin Ingin Mengupload Dokumen ini ?</p>
              </div>
              <div class="modal-footer">
                <button type="button" onclick='doupload()' class="btn btn-success">Ya</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
              </div>
            </form>
          </div>
        </div>

    </section>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="<?php echo base_url('assets/temp/js_x'); ?>/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/extensions/datatables.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/extensions/filepond.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/extensions/form-element-select.js'); ?>"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script>
      var myInput = document.getElementById("Password");
      var letter = document.getElementById("letter");
      var capital = document.getElementById("capital");
      var number = document.getElementById("number");
      var length = document.getElementById("length");

      // Ketika pengguna mengklik bidang kata sandi, tunjukkan kotak pesan
      myInput.onfocus = function() {
        document.getElementById("message").style.display = "block";
      }

      // Ketika pengguna mengklik di luar field password, sembunyikan kotak pesan
      myInput.onblur = function() {
        document.getElementById("message").style.display = "none";
      }

      // Saat pengguna mulai mengetik sesuatu di dalam field password
      myInput.onkeyup = function() {
        // Validasi huruf kecil(lowercase)
        var lowerCaseLetters = /[a-z]/g;
        if (myInput.value.match(lowerCaseLetters)) {
          letter.classList.remove("invalid");
          letter.classList.add("valid");
        } else {
          letter.classList.remove("valid");
          letter.classList.add("invalid");
        }

        // Validasi huruf kapital
        var upperCaseLetters = /[A-Z]/g;
        if (myInput.value.match(upperCaseLetters)) {
          capital.classList.remove("invalid");
          capital.classList.add("valid");
        } else {
          capital.classList.remove("valid");
          capital.classList.add("invalid");
        }

        // Validasi angka/number
        var numbers = /[0-9]/g;
        if (myInput.value.match(numbers)) {
          number.classList.remove("invalid");
          number.classList.add("valid");
        } else {
          number.classList.remove("valid");
          number.classList.add("invalid");
        }

        // Validasi panjangnya
        if (myInput.value.length >= 8) {
          length.classList.remove("invalid");
          length.classList.add("valid");
        } else {
          length.classList.remove("valid");
          length.classList.add("invalid");
        }
      }
    </script>
    <script>
      function uploadserti() {
        $('#modal_uploadserti').modal('show');
      }


      $('[data-bs-dismiss=modal]').on('click', function(e) {
        document.getElementById("sertifikat_surveior").value = "";
      })

      function doupload() {
        var file_data = $('#sertifikat_surveior').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
          url: "<?php echo base_url('/Profil/uploadsertifikat'); ?>", // <-- point to server-side PHP script 
          dataType: 'text', // <-- what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(result) {
            if (result == 'true') {
              window.location.reload();
            } else {
              alert('Upload Error');
              console.log(result);
            }
          },
          error: function(result) {
            console.log(result);
          }
        });
      }
    </script>
  </body>
  <html>