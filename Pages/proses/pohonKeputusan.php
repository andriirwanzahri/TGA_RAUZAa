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

            if (isset($_GET['act'])) {
                $action = $_GET['act'];
                $id = $_GET['id'];
                if ($action == 'delete') {
                    mysqli_query($conn, "TRUNCATE t_keputusan");
                    header('location:index.php?page=pohonKeputusan');
                }
            }

            $query = mysqli_query($conn, "select * from t_keputusan order by(id)");
            $jumlah = mysqli_num_rows($query);
            //jika pohon keputusan kosong
            if ($jumlah == 0) {

                echo "<center><button><h3> Pohon keputusan belum terbentuk...</h3></button></center>";
            } else {
                //hanya kaprodi yang bisa menghapus pohon keputusan dan menguji akurasi

            ?>
                <p>
                    <a href="index.php?page=pohonKeputusan&hapus=delete" class="btn btn-danger float-right" onClick="return confirm('Anda yakin akan hapus pohon keputusan?')">
                        <i class="fas fa-trash"></i>
                        Hapus Pohon Keputusan
                    </a>
                    <!--<a href="?menu=pohon_tree" >Lihat Pohon Keputusan</a> |-->
                    <!-- <a href="?menu=uji_rule" class="btn btn-default">Uji Rule</a> -->
                </p>
                <?php

                echo "Jumlah rule : " . $jumlah . "<br>";
                ?>
                <table class='table table-bordered '>
                    <tr align='center'>
                        <th>Id</th>
                        <th>Aturan</th>
                    </tr>
                    <?php
                    $warna1 = '#ffc';
                    $warna2 = '#eea';
                    $warna  = $warna1;
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