<?php
error_reporting(E_ALL ^  E_NOTICE);
error_reporting(0);
include_once "koneksi.php";
include_once "Pages/proses/prosesmining.php";
function target($kondisi)
{
    global $conn;
    $qry = mysqli_query($conn, "SELECT COUNT(*) FROM datapreprocessing WHERE $kondisi");
    $row = mysqli_fetch_array($qry);
    $jml = $row['0'];
    return $jml;
}
$baik = target("target='B'");
$sedang = target("target='S'");
$rusakringan = target("target='RR'");
$rusakberat = target("target='RB'");
?>
<div class="content">
    <!--typography-page -->
    <div class="typo-w3">
        <div class="container">
            <div class="col-md-12 mt-3 mb-5">
                <h1 class="text-center">Hasil KLasifikasi Jalan</h1>
            </div>
            <?php
            $pesan_error = $pesan_success = "";
            if (isset($_GET['pesan_error'])) {
                $pesan_error = $_GET['pesan_error'];
            }
            if (isset($_GET['pesan_success'])) {
                $pesan_success = $_GET['pesan_success'];
            }

            if (!isset($_POST['Klasi'])) { //tidak muncul jika diklik proses mining
                $sql = "SELECT * FROM dataklasifikasi";
                $query = mysqli_query($conn, $sql);
                $jumlah = mysqli_num_rows($query);
                $jum = mysqli_num_rows($query);
            }
            if (!isset($_POST['klasi'])) { //tidak muncul jika diklik proses mining
                // echo "Jumlah data: " . $jumlah . "<br>";
                if ($jumlah == 0) {
                    echo "Data kosong...";
                } else {
            ?>
                    <div class="row mt-3">
                        <!-- Jumlaah Data jalan -->
                        <div class="col-xl-4 col-md-12 mb-8">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Jumlah Data Training</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 justify-content-center">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }

            // JIKA PILIHAN DI TEKAN
            if (isset($_POST['klasi'])) {
            }
            ?>
        </div>
    </div>
    <!-- //typography-page -->
</div>