<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline'">

    <title>Lupa Password - SINAF</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <!-- <div class="auth-logo">
                <a href="index.html"><img src="assets/images/logo/logo.svg" alt="Logo"></a>
            </div> -->
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($this->session->flashdata('success') != '') : ?>
                                <div class="alert alert-success" id="success">
                                    <?= $this->session->flashdata('success'); ?>
                                    <h5>Silahkan Periksa Email.</h5>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('warning') != '') : ?>
                                <div class="alert alert-danger" id="warning">
                                    <h5><strong>ALERT !</strong></h5>
                                    <?= $this->session->flashdata('warning'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <h1 class="auth-title">Lupa Password</h1>
                    <p class="auth-subtitle mb-5">Masukkan Email dan kami akan kirimkan link reset password</p>


                    <form action="<?php echo base_url('Forgot_password/send_mail') ?>" method="post">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input required id="emailrecover" name="emailrecover" type="email" class="form-control form-control-xl" placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Ubah Password</button>
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