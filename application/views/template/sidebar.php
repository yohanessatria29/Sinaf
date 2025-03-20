<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout Horizontal - Mazer Admin Dashboard</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main/app.css">
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/shared/iconly.css">

</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="#"><img src="<?php echo base_url() ?>/assets/images/logo/kemkes.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="header-top-right">

                            <div class="dropdown">
                                <a href="#" class="user-dropdown d-flex dropend" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2">
                                        <img src="<?php echo base_url() ?>assets/images/faces/1.jpg" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name"><?= $this->session->userdata('name') ?></h6>
                                        <p class="user-dropdown-status text-sm text-muted"><?= $this->session->userdata('kriteria') ?></p>
                                    </div>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="dropdownMenuButton1">
                                    <!-- <li><a class="dropdown-item" href="#">My Account</a></li>
                                  <li><a class="dropdown-item" href="#">Settings</a></li> -->
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>


                                    <li><a class="dropdown-item" href="<?php echo site_url('Profil'); ?>">Profil</a></li>
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
                <nav class="main-navbar" style="padding: 2rem;">
                    <div class="container">
                        <ul>
                            <!-- <li class="menu-item ">
                                <a href="index.html" class='menu-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li> -->
                            <?php if ($this->session->userdata('access') == "Admin Lembaga") { ?>
                                <?php if (
                                    $this->session->userdata('lpa_id') == 15 || $this->session->userdata('lpa_id') == 16 || $this->session->userdata('lpa_id') == 17 ||
                                    $this->session->userdata('lpa_id') == 18 || $this->session->userdata('lpa_id') == 19 || $this->session->userdata('lpa_id') == 20
                                ) { ?>
                                    <li class="menu-item ">
                                        <a href="<?php echo base_url() ?>pengajuan/surveior" class='menu-link'>
                                            <i class="bi bi-grid-fill"></i>
                                            <span>Input Surveior</span>
                                        </a>
                                    </li>
                                    <li class="menu-item ">
                                        <a href="<?php echo base_url() ?>AkreditasiRS" class='menu-link'>
                                            <i class="bi bi-grid-fill"></i>
                                            <span>Surat Tugas Akreditasi RS</span>
                                        </a>
                                    </li>
                                <?php } else { ?>
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
                                    <li class="menu-item  ">
                                        <a href="<?php echo base_url() ?>Monitoring/proses" class='menu-link'>
                                            <i class="bi bi-grid-fill"></i>
                                            <span>Monitoring Proses Akreditasi</span>
                                        </a>
                                    </li>

                                    <li class="menu-item  ">
                                        <a href="<?php echo base_url() ?>Surveior/jadwal_perjalanan" class='menu-link'>
                                            <i class="bi bi-grid-fill"></i>
                                            <span>Jadwal Surveior</span>
                                        </a>
                                    </li>

                                    <li class="menu-item  ">
                                        <a href="<?php echo base_url() ?>pengajuan/penolakanpengajuan" class='menu-link'>
                                            <i class="bi bi-grid-fill"></i>
                                            <span>Pengajuan Pembatalan Survei</span>
                                        </a>
                                    </li>
                                <?php } ?>




                                <!-- <li class="menu-item  has-sub">
                                <a href="#" class='menu-link'>
                                    <i class="bi bi-stack"></i>
                                    <span>User Admin LPA</span>
                                </a>
                                <div class="submenu ">
                                  
                                    <div class="submenu-group-wrapper"> 
                                        <ul class="submenu-group">
                                            
                                            <li
                                                class="submenu-item">
                                                <a href="<?php //echo base_url() 
                                                            ?>pengajuan" class='submenu-link'>Pengajuan Usulan Survei</a>
                                            </li>                                        
                                            <li class="submenu-item">
                                                <a href="<?php //echo base_url() 
                                                            ?>pengajuan/surveior" class='submenu-link'>Input Surveior</a>
                                            </li>
                                            <li class="submenu-item">
                                                <a href="<?php //echo base_url() 
                                                            ?>pengajuan/verifikator" class='submenu-link'>Input Verifikator</a>
                                            </li>
                                        </ul>    
                                    </div>
                                </div>
                            </li> -->
                            <?php } elseif ($this->session->userdata('access') == "Surveior") { ?>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>surveior" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Surveior</span>
                                    </a>
                                </li>
                            <?php } elseif ($this->session->userdata('access') == "Verifikator") { ?>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>verifikator" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Verifikator</span>
                                    </a>
                                </li>
                            <?php } elseif ($this->session->userdata('access') == "Ketua LPA") { ?>
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
                            <?php } elseif ($this->session->userdata('access') == "Kemenkes") { ?>
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
                                    <a href="<?php echo base_url() ?>User" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Input User Ketua Lembaga</span>
                                    </a>
                                </li>
                                <li class="menu-item  ">
                                    <a href="<?php echo base_url() ?>User/listAdminlpa" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Input User Admin Lembaga</span>
                                    </a>
                                </li>
                                <li class="menu-item  ">
                                    <a href="<?php echo base_url() ?>User/listKetuatim" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Input User Ketua Tim</span>
                                    </a>
                                </li>
                                <!-- <li class="menu-item  ">
                                    <a href="<?php //echo base_url() 
                                                ?>User/listDirektur" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Input User Direktur</span>
                                    </a>
                                </li> -->
                                <li class="menu-item  ">
                                    <a href="<?php echo base_url() ?>User/listBinwas" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Input User Binwas</span>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>kemenkes/surveior" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Surveior</span>
                                    </a>
                                </li>
                            <?php } elseif ($this->session->userdata('access') == "Dinkes") { ?>
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

                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="dropdownMenuButton1">
                                    <!-- <li><a class="dropdown-item" href="#">My Account</a></li>
                                  <li><a class="dropdown-item" href="#">Settings</a></li> -->
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="<?php echo site_url('login/logout'); ?>">Logout</a></li>
                                </ul>
                            <?php } elseif ($this->session->userdata('access') == "Ketua Tim") { ?>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>ketua" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Ketua Tim</span>
                                    </a>
                                </li>
                                <li class="menu-item  ">
                                    <a href="<?php echo base_url() ?>Monitoring/proses" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Monitoring Proses Akreditasi</span>
                                    </a>
                                </li>
                                <li class="menu-item  ">
                                    <a href="<?php echo base_url() ?>pengajuan/penolakanpengajuan" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Pengajuan Pembatalan Survei</span>
                                    </a>
                                </li>
                                <!-- nasrul -->
                            <?php } elseif ($this->session->userdata('access') == "Direktur") { ?>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>direktur" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Direktur Mutu</span>
                                    </a>
                                </li>
                                <!-- <li class="menu-item  ">
                                    <a href="<?php //echo base_url() 
                                                ?>Monitoring/proses" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Monitoring Proses Akreditasi</span>
                                    </a>
                                </li> -->
                            <?php } elseif ($this->session->userdata('access') == "Binwas") { ?>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>binwas" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Binwas</span>
                                    </a>
                                </li>

                            <?php } elseif ($this->session->userdata('access') == "Kesmas") { ?>
                                <li class="menu-item ">
                                    <a href="<?php echo base_url() ?>kesmas" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Kesmas</span>
                                    </a>
                                </li>
                                <!-- <li class="menu-item  ">
                                    <a href="<?php //echo base_url() 
                                                ?>Monitoring/proses" class='menu-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Monitoring Proses Akreditasi</span>
                                    </a>
                                </li> -->
                            <?php } ?>





                        </ul>
                    </div>
                </nav>

            </header>