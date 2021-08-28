<?php
include 'koneksi.php';

?>
<div class="card o-hidden border-0 shadow-lg ">
    <div class="card-body">
        <!-- Nested Row within Card Body -->
        <?php
        $as = mysqli_query($conn, "SELECT * FROM aspirasi ORDER BY id ASC");
        $ad = mysqli_num_rows($as);
        ?>
        <div class="row">
            <div class="col-lg col-xl-12 col-md-12 mb-8">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Aspirasi Masyarakat</h1>
                </div>
                <div class="container">
                    <div class="scroll  col-xl-12 col-md-12 mb-8">
                        <div class="row">
                            <?php
                            if ($ad > 0) {

                                while ($asp = mysqli_fetch_array($as)) { ?>
                                    <div class="col-md-6">
                                        <div class="card border-warning">
                                            <h5 class="card-header"><?php echo $asp['namaUser']; ?></h5>
                                            <div class="card-body">
                                                <div>NIK : <?php echo $asp['email']; ?></div>
                                                <div>tanggal upload : <?php echo $asp['tgl']; ?></div><br>
                                                <div class="card-text"><?php echo $asp['komentar']; ?></div><br>
                                                <div><img class="card-img-bottom" src="img/aspirasi/<?= $asp['lampiran']; ?>"></div><br>
                                                <a href="index.php?page=detailjalan&id=<?php echo $asp['idjalan']; ?>" class="btn btn-primary">Lihat Detail Jalan yang di aspirasi</a>
                                            </div>
                                        </div>
                                    </div>
                            <?php   }
                            } else {
                                echo "<h3>Belum Ada Aspirasi</h3>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>