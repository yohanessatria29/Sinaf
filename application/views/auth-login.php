<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self' https://sinaf.kemkes.go.id/ 'unsafe-inline'"> -->
    <title>Login - SINAF</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
    <meta name="description" content="Halaman Sinaf">
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

                    <form action="<?php echo base_url() . 'login/autentikasi' ?>" method="post">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" class="form-control form-control-xl" placeholder="Masukkan Email">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl" placeholder="Masukkan Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <div class="action">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Masuk</button>
                            <!-- <a  href="<?php echo site_url('admin/halaman_juknis') ?>" class="btn btn-block btn-success">Lihat Juknis</a>  -->
                        </div>

                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <!-- <p class="text-gray-600">Belum Punya Akun? <a href="auth-register.html" class="font-bold">Buat Akun</a>.</p> -->
                        <p><a class="font-bold" href="<?php echo base_url('Forgot_password') ?>">Lupa password?</a></p>
                    </div>
                    <!-- <div class="text-center mt-5 text-lg fs-4">
                <p class="text-gray-600">Belum Punya Akun? <a href="auth-register.html" class="font-bold">Buat Akun</a>.</p>
                <p><a class="font-bold" href="auth-forgot-password.html">Lupa password?</a>.</p>
            </div> -->
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