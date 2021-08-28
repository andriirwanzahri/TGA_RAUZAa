<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
include_once "koneksi.php";
//object database class
?>
<div class="content">
    <!--typography-page -->
    <div class="typo-w3">
        <div class="container">
            <Center>
                <h3 class="tittle">Pohon Keputusan</h3>
            </Center>
            <?php
            if (isset($_GET['hapus'])) {
                mysqli_query($conn, "TRUNCATE t_keputusan");
                header('location:index.php?page=pohonKeputusan');
            }

            $query = mysqli_query($conn, "select * from t_keputusan order by(id)");
            $jumlah = mysqli_num_rows($query);

            //jika pohon keputusan kosong
            if ($jumlah == 0) {

                echo "<center><button class='btn btn-danger'><h3> Pohon keputusan belum terbentuk...</h3></button></center>";
                echo "<center><a href='index.php?page=mining' accesskey='5' "
                    . "title='pohon keputusan'>Silahkan Lakukan Proses Mining Terlebih dahulu.</a></button></center>";
            } else {
                //hanya kaprodi yang bisa menghapus pohon keputusan dan menguji akurasi

            ?>
                <p>
                    <a href="index.php?page=pohonKeputusan&hapus" class="btn btn-danger float-right" onClick="return confirm('Anda yakin akan hapus pohon keputusan?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </p>
                <?php

                echo "Jumlah rule : " . $jumlah . "<br>";
                ?>
                <table class='table table-bordered '>
                    <tr align='center'>
                        <th>Id</th>
                        <th>rule</th>
                    </tr>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td align='center'><?php echo $row['id']; ?></td>
                            <td><?php
                                echo "IF ";
                                if ($row['parent'] != '') {
                                    echo $row['parent'] . " AND ";
                                }
                                if ($row['keputusan'] == "B") {
                                    $kondisi = "Baik";
                                } elseif ($row['keputusan'] == "S") {
                                    $kondisi = "Sedang";
                                } elseif ($row['keputusan'] == "RR") {
                                    $kondisi = "Rusak Ringan";
                                } elseif ($row['keputusan'] == "RB") {
                                    $kondisi = "Rusak Berat";
                                }
                                echo $row['akar'] . " THEN Label = " . $kondisi; ?>
                            </td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </table>
            <?php
            }
            ?>
        </div>
    </div>
</div>