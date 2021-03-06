<?php
include "Pages/template/header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <?php
  if (isset($_GET['page'])) {
    if ($_GET['page'] == "admin") {
      include 'admin.php';
    } elseif ($_GET['page'] == "datatraining") {
      include 'Pages/data/datatraining.php';
    } elseif ($_GET['page'] == "grafik") {
      include 'Pages/laporan/grafikmen.php';
    } elseif ($_GET['page'] == "tampilusulan") {
      include 'Pages/data/tampil_datausulan.php';
    } elseif ($_GET['page'] == "dataMasyarakat") {
      include 'Pages/data/masyarakat.php';
    } elseif ($_GET['page'] == "pohonKeputusan") {
      include 'Pages/proses/pohonKeputusan.php';
    } elseif ($_GET['page'] == "hasilKlasifikasi") {
      include 'Pages/proses/hasilKlasifikasi.php';
    } elseif ($_GET['page'] == "tampilklasifikasi") {
      include 'Pages/proses/tampil_hasil_klasifikasi.php';
    } elseif ($_GET['page'] == "hitungAkurasi") {
      include 'Pages/proses/hitungAkurasi.php';
    } elseif ($_GET['page'] == "mining") {
      include 'Pages/data/mining.php';
    } elseif ($_GET['page'] == "datajalan") {
      include 'Pages/data/datajalan.php';
    } elseif ($_GET['page'] == "datausulan") {
      include 'Pages/data/datausulan.php';
    } elseif ($_GET['page'] == "usulanjalan") {
      include 'Pages/data/usulanjalan.php';
    } elseif ($_GET['page'] == "dashboard") {
      include 'Pages/dashboard.php';
    } elseif ($_GET['page'] == "aspirasi") {
      include 'Pages/aspirasi/aspirasi.php';
    } elseif ($_GET['page'] == "detailjalan") {
      include 'Pages/data/detailjalan.php';
    } elseif ($_GET['page'] == "profile") {
      include 'Pages/profile/profile.php';
    } elseif ($_GET['page'] == "ubahprofile") {
      include 'Pages/profile/ubahprofile.php';
    } elseif ($_GET['page'] == "registrasi") {
      include 'Pages/login/registrasi.php';
    } elseif ($_GET['page'] == "laporan") {
      include 'Pages/laporan/laporan.php';
    } elseif ($_GET['page'] == "logout") {

      $_SESSION = [];
      session_unset();
      session_destroy();
      echo "<script>location='Pages/halamanUtama/index.php';</script>";
    }
  } else {
    include 'Pages/dashboard.php';
  }
  ?>


</div>
<?php
include "Pages/template/footer.php";

?>