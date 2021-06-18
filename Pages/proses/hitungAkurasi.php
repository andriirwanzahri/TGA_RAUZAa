<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// include_once "database.php";
include_once "koneksi.php";
include_once "Pages/proses/prosesmining.php";
$query = mysqli_query($conn, "SELECT * FROM datauji");
$id_rule = array();
$it = 0;

$jumlah = mysqli_num_rows($query);
$jml = mysqli_num_rows($query);


if (isset($_GET['hapus'])) {
    mysqli_query($conn, "TRUNCATE datauji");
    header('location:index.php?page=hitungAkurasi');
}



?>
<?php
if ($jml == 0) :
?>
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <h1 class="text-center">Data Uji Kosong</h1>
        </div>
        <div class="col-md-6">
            <form method="post" enctype="multipart/form-data" action="Pages/proses/upload_datauji.php">
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" name="datauji" class="custom-file-input" id="inputGroupFile02">
                        <label class="custom-file-label" for="inputGroupFile02">Upload data uji</label>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" name="upload" type="submit">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
else :
?>

    <div class="super_sub_content">
        <div class="container">
            <a href="index.php?page=hitungAkurasi&hapus" class="btn btn-danger float-right" onClick="return confirm('Anda yakin akan hapus Data Uji ?')">
                <i class="fas fa-trash"></i> Hapus Data Uji
            </a>
            <div class="row">
                <?php
                while ($bar = mysqli_fetch_array($query)) {
                    //ambil data uji
                    $n_ura_dukung = $bar['ura_dukung'];
                    $n_namaLintas = $bar['namaLintas'];
                    $n_panjangRuas = $bar['panjangRuas'];
                    $n_jns_pen = $bar['jns_pen'];
                    $n_tanah_krikil = $bar['tanah_krikil'];
                    $n_aspal = $bar['aspal'];
                    $n_rigit = $bar['rigit'];
                    $n_target = $bar['target'];

                    $hasil = klasifikasi(
                        $conn,
                        $n_ura_dukung,
                        $n_namaLintas,
                        $n_panjangRuas,
                        $n_jns_pen,
                        $n_tanah_krikil,
                        $n_aspal,
                        $n_rigit
                    );
                    // var_dump($hasil);
                    // die;
                    $keputusan = $hasil['keputusan'];
                    $id_rule_keputusan = $hasil['id_rule'];
                    $it++;
                    mysqli_query($conn, "UPDATE datauji SET target_hasil='$keputusan', id_rule='$id_rule_keputusan' WHERE id=$bar[0]");
                } //end loop data uji


                //menampilkan data uji dengan hasil prediksi
                $sql = mysqli_query($conn, "SELECT * FROM datauji");
                ?>
                <div class="col-md-12 mt-3 mb-3">
                    <h1 class="text-center">Perhitungan Akurasi Pohon Keputusan</h1>
                </div>
                <table class='table table-bordered table-striped  table-hover'>
                    <tr align='center'>
                        <th>No</th>
                        <th>Uradukung</th>
                        <th>namaLintas</th>
                        <th>panjangRuas</th>
                        <th>jns _Pen</th>
                        <th>Tanah Krikil</th>
                        <th>Aspal</th>
                        <th>rigid</th>
                        <th><b>Kondisi asli</b></th>
                        <th><b>Kondisi hasil</b></th>
                        <th><b>ID Rule Terpilih</b></th>
                        <th><b>Ketepatan</b></th>
                    </tr>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_array($sql)) {
                        if ($row['target'] == $row['target_hasil']) {
                            $ketepatan = "benar";
                        } else {
                            $ketepatan = "salah";
                        }
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
                        echo "<td>" . $row['target_hasil'] . "</td>";
                        echo "<td>" . $row['id_rule'] . "</td>";
                        echo "<td>" . ($ketepatan == 'benar' ? "<b>" . $ketepatan . "</b>" : $ketepatan) . "</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </table>



                <?php
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
                //     echo "Jumlah data yang prediksinya kosong: $kosong<br></h4>";
                // }
                // echo "<h2>AKURASI = $akurasi %<br>";
                // echo "LAJU ERROR = $laju_error %<br></h2>";
                ?>
                <div class="col-md-6">
                    <div class="card">
                        <table class="table">
                            <tr align='center'>
                                <th>Jumlah Data Uji</th>
                                <td><?= $jumlah_uji; ?></td>
                            </tr>
                            <tr align='center'>
                                <th>Jumlah Benar</th>
                                <td><?= $tepat; ?></td>
                            </tr>
                            <tr align='center'>
                                <th>Jumlah Salah</th>
                                <td><?= $tidak_tepat; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <table class="table">
                            <tr align='center'>
                                <th>Akurasi</th>
                                <td><?= $akurasi; ?>%</td>
                            </tr>
                            <tr align='center'>
                                <th>Error</th>
                                <td><?= $laju_error; ?>%</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>