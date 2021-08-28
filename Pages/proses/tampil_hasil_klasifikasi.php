<?php
include 'koneksi.php';
$kondisi = $_GET['kondisi'];
$ery = "SELECT datajalan.namajalan,
        data_hasil_klasifikasi.idjalan,
        data_hasil_klasifikasi.kondisi_hasil,
        data_hasil_klasifikasi.id_rule
        FROM datajalan, data_hasil_klasifikasi
        WHERE datajalan.id=data_hasil_klasifikasi.idjalan 
        AND data_hasil_klasifikasi.kondisi_hasil='$kondisi'";
$data = mysqli_query($conn, $ery);
?>
<div class="container-fluid">
    <!-- Pages/data/upload_aksi.php -->
    <div class="card mt-3">
        <div class="card-header py-1 mt-3">
            <!-- Tombol hapus Tambah data training -->
            <?php
            $pesan_error = $pesan_success = "";
            if (isset($_GET['pesan_error'])) {
                $pesan_error = $_GET['pesan_error'];
            }
            if (isset($_GET['pesan_success'])) {
                $pesan_success = $_GET['pesan_success'];
            }

            if (!empty($pesan_error)) {
                display_error($pesan_error);
            }
            if (!empty($pesan_success)) {
                display_success($pesan_success);
            }
            ?>
            <h5 class="font-weight-bold text-primary">Data Jalan Hasil Klasifikasi</h5>
        </div>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama jalan</th>
                            <th>Keputusan</th>
                            <th>id rule</th>
                            <?php if ($_SESSION['login']['level'] == '2') : ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d['namajalan']; ?></td>
                                <td><?php echo $d['kondisi_hasil']; ?></td>
                                <td><?php echo $d['id_rule']; ?></td>
                                <?php if ($_SESSION['login']['level'] == '2') :
                                    $id = $d['idjalan'];
                                    $result = mysqli_query($conn, "SELECT idjalan FROM datausulan WHERE idjalan='$id'");
                                    if (mysqli_fetch_assoc($result)) :      ?>
                                        <td><a class="badge badge-pill badge-success">Sudah Diusulkan</a></td>
                                    <?php else : ?>
                                        <td><a href="index.php?page=datausulan&id=<?php echo $d['idjalan']; ?>&kondisi=<?php echo $d['kondisi_hasil']; ?>" class="badge badge-pill badge-warning">Usulkan</a></td>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>