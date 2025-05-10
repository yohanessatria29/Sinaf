<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kesmas</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>../assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main/app-dark.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png'); ?>" type="image/png">

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
                            <h4>List User Kesmas</h4>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="card">
                                        </br>
                                        <div class="buttons">
                                            <a href="<?php echo base_url() ?>user/inputKesmas" class="btn btn-success rounded-pill">Tambah User Kesmas</a>
                                            <!-- <a href="#" class="btn btn-light rounded-pill">Bersihkan</a> -->
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped" id="table1">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nik</th>
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $n = 1;
                                                    foreach ($datakesmas as $data) {
                                                        //var_dump($data);
                                                    ?>
                                                        <tr>
                                                            <td><?= $n; ?></td>

                                                            <td><?= $data['nik']; ?></td>
                                                            <td><?= $data['nama']; ?></td>
                                                            <td><?= $data['email']; ?></td>
                                                            <td>
                                                                <div class="buttons">
                                                                    <a href="<?php echo base_url('user/editkesmas/') . $data['id']; ?>" class="btn icon btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                                        </svg></a>
                                                                    <a href="<?php echo base_url('user/hapuskesmas/') . $data['id']; ?>" onclick="return confirm('Apa Anda Yakin Ingin Menghapusnya?')" class="btn icon btn-danger">Delete</a>

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
        </div>
        </div>
    </footer>


    <script src="<?php echo base_url() ?>assets/js/app.js"></script>
</body>

</html>