<?php
error_reporting(E_ALL ^  E_NOTICE);
error_reporting(0);
include_once "koneksi.php";
function target($kondisi)
{
    global $conn;
    $qry = mysqli_query($conn, "SELECT COUNT(*) FROM data_hasil_klasifikasi WHERE $kondisi");
    $row = mysqli_fetch_array($qry);
    $jml = $row['0'];
    return $jml;
}
$baik = target("kondisi_hasil='B'");
$sedang = target("kondisi_hasil='S'");
$rusakringan = target("kondisi_hasil='RR'");
$rusakberat = target("kondisi_hasil='RB'");
?>
<div class="content">
    <!--typography-page -->
    <div class="typo-w3">
        <div class="row card mt-3 mb-5">
            <div class="container">
                <div class="col-md-12 mt-3 mb-5">
                    <h1 class="text-center">Hasil KLasifikasi Kondisi Jalan</h1>
                </div>
                <?php
                $pesan_error = $pesan_success = "";
                if (isset($_GET['pesan_error'])) {
                    $pesan_error = $_GET['pesan_error'];
                }
                if (isset($_GET['pesan_success'])) {
                    $pesan_success = $_GET['pesan_success'];
                }

                if (!isset($_POST['Klasi'])) {
                    $sql = "SELECT * FROM data_hasil_klasifikasi";
                    $query = mysqli_query($conn, $sql);
                    $jumlah = mysqli_num_rows($query);
                    $jum = mysqli_num_rows($query);
                }
                if (!isset($_POST['klasi'])) {
                    if ($jumlah == 0) {
                        echo "Data kosong...";
                    } else {
                ?>

                        <div class="row mt-3 justify-content-center">
                            <!-- Jumlaah Data jalan -->
                            <div class="col-xl-4 col-md-12 mb-8">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Jumlah Data Jalan Baik</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $baik; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <a href="index.php?page=tampilklasifikasi&kondisi=B"><i class="fas fa-check"></i>
                                                    Lihat Data Klasifikasi Baik</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><br class="mt-5">
                            <!-- Jumlaah Data jalan -->
                            <div class="col-xl-4 col-md-12 mb-8">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Jumlah Data Kondisi Jalan Sedang</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sedang; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <a href="index.php?page=tampilklasifikasi&kondisi=S"><i class="fas fa-check"></i>
                                                    Lihat Data Klasifikasi Sedang</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5 mb-5 justify-content-center">
                            <!-- Jumlaah Data jalan -->
                            <div class="col-xl-4 col-md-12 mb-8">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Jumlah Data Kondisi Jalan Rusak Ringan</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $rusakringan; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <a href="index.php?page=tampilklasifikasi&kondisi=RR"><i class="fas fa-check"></i>
                                                    Lihat Data Klasifikasi Rusak Ringan</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Jumlaah Data jalan -->
                            <div class="col-xl-4 col-md-12 mb-8">
                                <div class="card border-left-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Jumlah Data Kondisi Jalan Rusak Berat</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $rusakberat; ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <a href="index.php?page=tampilklasifikasi&kondisi=RB"><i class="fas fa-check"></i>
                                                    Lihat Data Klasifikasi Rusak Berat</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
    <?php
                    }
                }
    ?>
        </div>
    </div>
    <!-- //typography-page -->
</div>