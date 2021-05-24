<?php
// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED | E_USER_WARNING | E_PARSE));
// error_reporting(0);
session_start();
if (!isset($_SESSION['login']['nama'])) {
    header("Location: Pages/halamanUtama/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Algoritma C 4.5</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <style type="text/css">
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;
            /* The height is 400 pixels */
            width: 100%;
            /* The width is the width of the web page */
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class=" mt-3 justify-content-center">
                <!-- <div class="sidebar-brand-icon"> -->
                <center><img src="img/pnl.png" width="100" height="100"></center>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- JIKA LEVELNYA 2 MAKA AKAN MENAMPILKAN -->
            <?php
            if ($_SESSION['login']['level'] == '2') :
            ?>

                <!-- Heading -->
                <div class="sidebar-heading">
                    Data Jalan
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Data Jalan</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Data Jalan</h6>
                            <a class="collapse-item" href="index.php?page=datajalan">Data jalan</a>
                            <a class="collapse-item" href="#">Hasil Klasifikasi</a>

                        </div>
                    </div>
                </li>

                <!-- JIKA LEVELNYA 1 MAKA AKAN MENAMPILKAN -->
            <?php
            elseif ($_SESSION['login']['level'] == '1') :
            ?>
                <!-- Heading -->
                <div class="sidebar-heading">
                    Data Jalan
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Data</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Data Olahan C45</h6>
                            <a class="collapse-item" href="index.php?page=datatraining">Data Training</a>
                            <a class="collapse-item" href="index.php?page=mining">Mining C 4.5</a>
                            <a class="collapse-item" href="index.php?page=pohonKeputusan">Pohon Keputusan</a>
                            <a class="collapse-item" href="index.php?page=datajalan">Data jalan</a>
                            <a class="collapse-item" href="#">Hasil Prediksi</a>
                            <div class="collapse-divider"></div>
                            <h6 class="collapse-header">Data User</h6>
                            <a class="collapse-item" href="index.php?page=dataMasyarakat">Data Masyarakat</a>
                            <a class="collapse-item" href="blank.html">Data Pejabat</a>
                        </div>
                    </div>
                </li>


                <!-- JIKA LEVELNYA 2 MAKA AKAN MENAMPILKAN -->
            <?php


            elseif ($_SESSION['login']['level'] == '3') :
            ?>
                <!-- Heading -->
                <div class="sidebar-heading">
                    Data Jalan
                </div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Data Jalan</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Data Jalan</h6>
                            <a class="collapse-item" href="index.php?page=datajalan">Data jalan</a>
                            <a class="collapse-item" href="#">Hasil Klasifikasi</a>
                        </div>
                    </div>
                </li>
            <?php
            endif;
            ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=profile">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Profile</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-dark bg-black topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['login']['nama']; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->