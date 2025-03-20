<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main/app-dark.css');?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg');?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png');?>" type="image/png">
</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="#"><img src="<?php echo base_url() ?>assets/images/logo/kemkes.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="header-top-right">
                            <div class="dropdown">
                                <a href="#" class="user-dropdown d-flex dropend" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2">
                                        <img src="<?php echo base_url() ?>assets/images/faces/1.jpg" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name"><?= $this->session->userdata('name') ?></h6>
                                        <p class="user-dropdown-status text-sm text-muted">Member</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="<?php echo site_url('Profil'); ?>">Profil</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?php echo site_url('login/logout'); ?>">Logout</a></li>
                                </ul>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <nav class="main-navbar">
                    <div class="container">
                        <ul>
                            <?php if ($this->session->userdata('access') == "Admin Lembaga") { ?>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>pengajuan" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Pengajuan Usulan Survei</span>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>pengajuan/surveior" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Input Surveior</span>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>pengajuan/verifikator" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Input Verifikator</span>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>Monitoring/proses" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Monitoring Proses Akreditasi</span>
                                    </a>
                                </li>
                            <?php } else if ($this->session->userdata('access') == "Surveior") { ?>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>surveior" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Surveior</span>
                                    </a>
                                </li>
                            <?php } elseif ($this->session->userdata('access') == "Ketua Tim") { ?>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>ketua" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Ketua Tim</span>
                                    </a>
                                </li>
                            <?php } else if ($this->session->userdata('access') == "Verifikator") { ?>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>verifikator" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Verifikator</span>
                                    </a>
                                </li>
                            <?php } else if ($this->session->userdata('access') == "Ketua LPA") { ?>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>admin" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Ketua LPA</span>
                                    </a>
                                </li>
                                <li class="menu-item  ">
                                    <a href="<?php echo base_url() ?>Monitoring/proses" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Monitoring Proses Akreditasi</span>
                                    </a>
                                </li>
                            <?php } else if ($this->session->userdata('access') == "Kemenkes") { ?>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>kemenkes" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Kemenkes</span>
                                    </a>
                                </li>
                                <li class="menu-item  ">
                                    <a href="<?php echo base_url() ?>Monitoring/proses" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Monitoring Proses Akreditasi</span>
                                    </a>
                                </li>
                                    <li class="menu-item  ">
                                    <a href="<?php echo base_url()?>User" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Input User Ketua Lembaga</span>
                                    </a>
                                </li>
                                <li class="menu-item  ">
                                    <a href="<?php echo base_url() ?>User/getadminlembaga" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Input User Admin Lembaga</span>
                                    </a>
                                </li>
                            <?php } else if ($this->session->userdata('access') == "Dinkes") { ?>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>pengajuan" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Pengajuan Usulan Survei</span>
                                    </a>
                                </li>
                                
                                <li class="menu-item  ">
                                    <a href="<?php echo base_url() ?>Monitoring/proses" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Monitoring Proses Akreditasi</span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
            </header>

            <div class="content-wrapper container">
                <div class="page-content">
                    <div class="row">
                        <div class="col-md-12">