<?php
include 'koneksi.php';
$kondisi = $_GET['kondisi'];
?>
<div class="container-fluid">
    <!-- Pages/data/upload_aksi.php -->
    <div class="card mt-3">
        <div class="card-header py-1 mt-3">
            <!-- Tombol hapus Tambah data training -->
            <?php
            if (!empty($pesan_error)) {
                display_error($pesan_error);
            }
            if (!empty($pesan_success)) {
                display_success($pesan_success);
            }
            ?>
            <h5 class="font-weight-bold text-primary">Data Jalan Hasil Klasifikasi</h5>
        </div>
        <div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama jalan</th>
                            <th>Keputusan</th>
                            <th>id rule</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $ery = "SELECT datajalan.namajalan, data_hasil_klasifikasi.kondisi_hasil, data_hasil_klasifikasi.id_rule
                        FROM datajalan, data_hasil_klasifikasi
                        WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND data_hasil_klasifikasi.kondisi_hasil='$kondisi'";
                        $data = mysqli_query($conn, $ery);
                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d['namajalan']; ?></td>
                                <td><?php echo $d['kondisi_hasil']; ?></td>
                                <td><?php echo $d['id_rule']; ?></td>
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