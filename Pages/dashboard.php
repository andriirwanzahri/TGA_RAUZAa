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


// echo "<br><br>";
// echo "<center><h4>";
// echo "Jumlah prediksi: $jumlah_uji<br>";
// echo "Jumlah tepat: $tepat<br>";
// echo "Jumlah tidak tepat: $tidak_tepat<br>";
// if ($kosong != 0) {
//   echo "Jumlah data yang prediksinya kosong: $kosong<br></h4>";
// }
// echo "<h2>AKURASI = $akurasi %<br>";
// echo "LAJU ERROR = $laju_error %<br></h2>";

?>
<div class="container-fluid">
  <div class="row mt-3">
    <div class="col-md-12">
      <center>
        <h2>Sistem Informasi Klasifikasi Jalan Pada Dinas PUPR PIDIE</h2>
        <h5>Mengunakan Algoritma C4.5. </h5>
      </center>
      <div class="row mt-5">
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
    </div>
  </div>
  <hr />
  <div class="row">
    <div class="col-12 mb-3">
      <div class="card">
        <div class="card-body shadow">
          <div id="map" style="height: 400px; width: 100%;">
            <Center>Data Internet Non Aktif</Center>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Initialize and add the map
  function initMap() {
    // The location of Uluru
    const uluru = {
      lat: 5.3759564,
      lng: 95.9003835
    };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 13,
      center: uluru,
    });
    // The marker, positioned at Uluru
    setMarkers(map, officeLocations);
    // const marker = new google.maps.Marker({
    //     position: uluru,
    //     map: map,
    // });
  }
  var officeLocations = [
    <?php
    $data = file_get_contents('http://localhost/TGA_RAUZAa/Pages/peta/dataPetaAll.php');
    $no = 1;
    if (json_decode($data, true)) {
      $obj = json_decode($data);
      foreach ($obj->results as $item) {
    ?>[<?php echo $item->id ?>,
          '<?php echo $item->namajalan ?>',
          '<?php echo $item->desa ?>',
          <?php echo $item->longitude ?>,
          <?php echo $item->latitude ?>],
    <?php
      }
    }
    ?>
  ];

  function setMarkers(map, locations) {
    var globalPin = 'img/marker.png';

    for (var i = 0; i < locations.length; i++) {

      var office = locations[i];
      var myLatLng = new google.maps.LatLng(office[4], office[3]);
      var infowindow = new google.maps.InfoWindow({
        content: contentString
      });

      var contentString =
        '<div id="content">' +
        '<div id="siteNotice">' +
        '</div>' +
        '<h5 id="firstHeading" class="firstHeading">' + office[1] + '</h5>' +
        '<h6 id="firstHeading">' + office[2] + '</h6>' +
        '<div id="bodyContent">' +
        '<center><a href=index.php?page=detailjalan&id=' + office[0] + '>Info Detail</a></center>' +
        '</div>' +
        '</div>';

      var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: office[1],
        icon: 'img/marker.png'
      });

      google.maps.event.addListener(marker, 'click', getInfoCallback(map, contentString));
    }
  }

  function getInfoCallback(map, content) {
    var infowindow = new google.maps.InfoWindow({
      content: content
    });
    return function() {
      infowindow.setContent(content);
      infowindow.open(map, this);
    };
  }
</script>