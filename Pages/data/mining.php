<?php


include_once "koneksi.php";
include_once "Pages/proses/prosesmining.php";
?>
<div class="content">
    <!--typography-page -->
    <div class="typo-w3">
        <div class="container">
            <center>
                <h2 class="tittle">Mining</h2>
            </center>

            <?php
            $pesan_error = $pesan_success = "";
            if (isset($_GET['pesan_error'])) {
                $pesan_error = $_GET['pesan_error'];
            }
            if (isset($_GET['pesan_success'])) {
                $pesan_success = $_GET['pesan_success'];
            }

            if (!isset($_POST['proses_mining'])) { //tidak muncul jika diklik proses mining
                $sql = "SELECT * FROM datapreprocessing";
                $query = mysqli_query($conn, $sql);
                $jumlah = mysqli_num_rows($query);
            ?>
                <div class="row">
                    <div class="col-md-12">
                        <!--UPLOAD EXCEL FORM-->
                        <form method="post" enctype="multipart/form-data" action="">
                            <div class="form-group">
                                <!--<input name="submit" type="submit" value="Upload Data" class="btn btn-success">-->
                                <button name="proses_mining" type="submit" class="btn btn-outline-secondary" onclick="">
                                    <i class="fa fa-check"></i> Proses Mining
                                </button>
                            </div>
                        </form>

                        <?php
                    }


                    if (!isset($_POST['proses_mining'])) { //tidak muncul jika diklik proses mining
                        echo "Jumlah data: " . $jumlah . "<br>";
                        if ($jumlah == 0) {
                            echo "Data kosong...";
                        } else {
                        ?>
                            <table class='table table-bordered table-striped  table-hover'>
                                <tr>
                                    <th>No</th>
                                    <th>ura_dukung</th>
                                    <th>nama lintas</th>
                                    <th>Panjang Ruas</th>
                                    <th>Jenis pen</th>
                                    <th>krikil</th>
                                    <th>aspal</th>
                                    <th>rigit</th>
                                    <th>kondisi</th>
                                </tr>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_array($query)) {
                                    echo "<tr>";
                                    echo "<td>" . $no . "</td>";
                                    echo "<td>" . $row['ura_dukung'] . "</td>";
                                    echo "<td>" . $row['namaLintas'] . "</td>";
                                    echo "<td>" . $row['panjangRuas'] . "</td>";
                                    echo "<td>" . $row['jns_pen'] . "</td>";
                                    echo "<td>" . $row['tanah_krikil'] . "</td>";
                                    echo "<td>" . $row['aspal'] . "</td>";
                                    echo "<td>" . $row['rigit'] . "</td>";
                                    echo "<td>" . $row['target'] . "</td>";
                                    echo "</tr>";
                                    $no++;
                                }
                                ?>
                            </table>
                    <?php
                        }
                    }

                    if (isset($_POST['proses_mining'])) {
                        $awal = microtime(true);

                        mysqli_query($conn, "TRUNCATE t_keputusan");
                        pembentukan_tree($conn, "", "");
                        echo "<br><h3><center>---PROSES SELESAI---</center></h3>";
                        echo "<center><a href='index.php?menu=pohon_keputusan' accesskey='5' "
                            . "title='pohon keputusan'>Lihat pohon keputusan yang terbentuk</a></center>";

                        $akhir = microtime(true);
                        $lama = $akhir - $awal;
                        echo "<br>Lama eksekusi adalah: " . $lama . " detik";
                    }
                    ?>
                    </div>
                </div>
        </div>
    </div>
    <!-- //typography-page -->

</div>