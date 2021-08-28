<?php
include 'koneksi.php';
function jumlah($tabel)
{
  global $conn;
  $sql = "SELECT * FROM $tabel";
  $query = mysqli_query($conn, $sql);
  $jum = mysqli_num_rows($query);
  return $jum;
}

$datatraining = jumlah('datapreprocessing');
$datajalan = jumlah('datajalan');



//perhitungan akurasi
$que = mysqli_query($conn, "SELECT * FROM datauji");
$jumlah_uji = mysqli_num_rows($que);
//$TP=0; $FN=0; $TN=0; $FP=0; $kosong=0;
$TA = $FB = $FC = $FD =
  $FE = $TF = $FG = $FH =
  $FI = $FJ = $TK = $FL =
  $FM = $FN = $FO = $TP = 0;
$kosong = 0;
while ($row = mysqli_fetch_array($que)) {
  $asli = $row['target'];
  $prediksi = $row['target_hasil'];
  if ($asli == 'B' & $prediksi == 'B') {
    $TA++;
  } else if ($asli == 'B' & $prediksi == 'S') {
    $FB++;
  } else if ($asli == 'B' & $prediksi == 'RR') {
    $FC++;
  } else if ($asli == 'B' & $prediksi == 'RB') {
    $FD++;
  } else if ($asli == 'S' & $prediksi == 'B') {
    $FE++;
  } else if ($asli == 'S' & $prediksi == 'S') {
    $TF++;
  } else if ($asli == 'S' & $prediksi == 'RR') {
    $FG++;
  } else if ($asli == 'S' & $prediksi == 'RB') {
    $FH++;
  } else if ($asli == 'RR' & $prediksi == 'B') {
    $FI++;
  } else if ($asli == 'RR' & $prediksi == 'S') {
    $FJ++;
  } else if ($asli == 'RR' & $prediksi == 'RR') {
    $TK++;
  } else if ($asli == 'RR' & $prediksi == 'RB') {
    $FL++;
  } else if ($asli == 'RB' & $prediksi == 'B') {
    $FM++;
  } else if ($asli == 'RB' & $prediksi == 'S') {
    $FN++;
  } else if ($asli == 'RB' & $prediksi == 'RR') {
    $FO++;
  } else if ($asli == 'RB' & $prediksi == 'RB') {
    $TP++;
  } else if ($prediksi == '') {
    $kosong++;
  }
}
$tepat = ($TA + $TF + $TK + $TP);
$tidak_tepat = ($FB + $FC + $FD + $FE + $FG + $FH + $FI + $FJ + $FL + $FM + $FN + $FO + $kosong);
$akurasi = ($tepat / $jumlah_uji) * 100;
$laju_error = ($tidak_tepat / $jumlah_uji) * 100;

$akurasi = round($akurasi, 2);
$laju_error = round($laju_error, 2);
$sensitivitas = round($sensitivitas, 2);
$spesifisitas = round($spesifisitas, 2);


?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <center>
        <h2>Sistem Informasi Klasifikasi Kondisi Jalan Pada Dinas PUPR PIDIE</h2>
        <h5>Menggunakan Algoritma C4.5. </h5>
      </center>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="container card shadow-lg bg-warning ">
          <div class="carousel-inner mt-3">
            <div class="carousel-item active">
              <div class="row">
                <div class="col-md-4"><img class="d-block w-100" src="img/bg2.jpg" alt="Second slide"></div>
                <div class="col-md-4"><img class="d-block w-100" src="img/bg3.jpg" alt="Second slide"></div>
                <div class="col-md-4"><img class="d-block w-100" src="img/bg1.jpg" alt="Second slide"></div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row">
                <div class="col-md-4"><img class="d-block w-100" src="img/bg2.jpg" alt="Second slide"></div>
                <div class="col-md-4"><img class="d-block w-100" src="img/bg3.jpg" alt="Second slide"></div>
                <div class="col-md-4"><img class="d-block w-100" src="img/bg1.jpg" alt="Second slide"></div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row">
                <div class="col-md-4"><img class="d-block w-100" src="img/bg2.jpg" alt="Second slide"></div>
                <div class="col-md-4"><img class="d-block w-100" src="img/bg3.jpg" alt="Second slide"></div>
                <div class="col-md-4"><img class="d-block w-100" src="img/bg1.jpg" alt="Second slide"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</div>
<hr />
<div class="container">
  <div class="row">
    <!-- Jumlaah Data jalan -->
    <div class="col-xl-4 col-md-12 mb-8">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Jumlah Data Training</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $datatraining; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Akurasi Algoritma C45 -->
    <div class="col-xl-4 col-md-12 mb-8">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Akurasi Algoritma C 45
              </div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $akurasi; ?>%</div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $akurasi; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-12 mb-8">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Data Jalan
              </div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $datajalan; ?></div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container mt-3">
    <h5 class="text-center">Grafik Data Kondisi Jalan</h5>
    <div class="row">
      <div class="col-md-9 card">
        <div style="width: 700px;margin: 0px auto;">
          <canvas id="myChart"></canvas>
        </div>
      </div>
      <div class="col-md-3 card mt-10">
        <ul>
          <li><button class="btn btn-success"></button> Kondisi Baik</li>
          <li><button class="btn btn-info"></button> Kondisi Sedang</li>
          <li><button class="btn btn-warning"></button> Kondisi Rusak Ringan</li>
          <li><button class="btn btn-danger"></button> Kondisi Rusak Berat</li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>