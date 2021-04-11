<?php
include "Pages/template/header.php";
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
    <?php
        if (isset($_GET['page'])) {
            if ($_GET['page']=="admin") {
              include 'admin.php';
            }
            elseif ($_GET['page']=="datatraining") {
              include 'Pages/data/datatraining.php';
            }
            elseif ($_GET['page']=="dashboard") {
                include 'Pages/dashboard.php';
            }
            elseif ($_GET['page']=="registrasi") {
                include 'Pages/login/registrasi.php';
            }
            elseif ($_GET['page']=="logout") {

              $_SESSION = [];
              session_unset();
              session_destroy();
              echo "<script>location='Pages/login/login.php';</script>";
            }
          }
          else{
            include 'Pages/dashboard.php';
          }
        ?>  
                 

    </div>
<?php
include "Pages/template/footer.php";

?>
            