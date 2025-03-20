<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recover Password - SINAF</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/pages/auth.css'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png'); ?>" type="image/png">

</head>

<body>
    <div id="auth">
        <?php
        if ($this->session->flashdata('pesan_form')) :
            echo $this->session->flashdata('pesan_form');
        endif

        ?>
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <!-- <a href="index.html"><img src="assets/images/logo/logo.svg" alt="Logo"></a> -->
                    </div>
                    <h1 class="auth-title">SINAF</h1>
                    <p class="auth-subtitle mb-5">Sistem Informasi Nasional Akreditasi Fasilitas Pelayanan Kesehatan</p>

                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($this->session->flashdata('warning') != '') : ?>
                                <div class="alert alert-danger" id="warning">
                                    <h5><strong>ALERT !</strong></h5>
                                    <?= $this->session->flashdata('warning'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p> -->

                    <form action="<?php echo base_url('Forgot_password/changepassword/') . $url ?>" method="post">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input required type="password" id="newpasswordfirst" name="newpasswordfirst" class="form-control form-control-xl" placeholder="New Password">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input required type="password" id="newpasswordsecond" name="newpasswordsecond" class="form-control form-control-xl" placeholder="Confirm Password">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Ubah Password</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Ingat Password? <a href="<?php echo base_url('login') ?>" class="font-bold">Log in</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right" style="background-image: url('assets/images/login1.jpg');">
                </div>
            </div>

        </div>
    </div>
</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('success') != '') : ?>
            $("#success").fadeTo(5000, 1).slideUp(1500);
        <?php endif; ?>
        <?php if ($this->session->flashdata('warning') != '') : ?>
            $("#warning").fadeTo(5000, 1).slideUp(1500);
        <?php endif; ?>
    })
</script>