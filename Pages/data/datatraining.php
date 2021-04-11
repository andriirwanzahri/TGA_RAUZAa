<?php
include 'koneksi.php';
if (isset($_GET['berhasil'])) {
    echo "<p>" . $_GET['berhasil'] . " Data berhasil di import.</p>";
}

if (isset($_POST["hapus"])) {
    $data = mysqli_query($conn, "DELETE FROM data_training");
    if ($data > 0) {
        echo "
            <script>
                alert('data berhasil dihapus!');
                document.location.href = 'index.php?page=datatraining';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'index.php?page=datatraining';
            </script>
        ";
    }
}
?>
<center>
    <h1>Data Training</h1>
</center>

<form method="post" enctype="multipart/form-data" action="Pages/data/upload_aksi.php">
    <div class="input-group mb-3 ">
        <div class="custom-file">
            <input name="datatraining" type="file" required="required" class="custom-file-input" id="inputGroupFile02">
            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
        </div>
        <div class="input-group-append">
            <input name="upload" type="submit" class="input-group-text" value="Import">
        </div>

    </div>
</form>
<form action="" method="post">
    <button type="submit" name="hapus" class="btn btn-danger btn-lg">Hapus Data</button>
</form>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Training</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ruas</th>
                        <th>Thn_Pen_Ak</th>
                        <th>Nama Lintas Kecamatan</th>
                        <th>Ura_Dukung</th>
                        <th>Panjang Tanah_Kri</th>
                        <th>Aspal</th>
                        <th>Jns_Pen</th>
                        <th>Kondisi Baik</th>
                        <th>kondisi sedang</th>
                        <th>kondisi rusak ringan</th>
                        <th>kondisi rusak berat</th>
                    </tr>
                </thead>
                <tfoot>


                    <tr>
                        <th>No</th>
                        <th>Nama Ruas</th>
                        <th>Thn_Pen_Ak</th>
                        <th>Nama Lintas Kecamatan</th>
                        <th>Ura_Dukung</th>
                        <th>Panjang Tanah_Kri</th>
                        <th>Aspal</th>
                        <th>Jns_Pen</th>
                        <th>Kondisi Baik</th>
                        <th>kondisi sedang</th>
                        <th>kondisi rusak ringan</th>
                        <th>kondisi rusak berat</th>
                    </tr>

                </tfoot>
                <tbody>
                    <?php
                    $no = 1;


                    $data = mysqli_query($conn, "select * from data_training");
                    while ($d = mysqli_fetch_array($data)) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['nama_ruas']; ?></td>
                            <td><?php echo $d['thn_pen_ak']; ?></td>
                            <td><?php echo $d['kecamatan']; ?></td>
                            <td><?php echo $d['ura_dukung']; ?></td>
                            <td><?php echo $d['tanah_krikil']; ?></td>
                            <td><?php echo $d['aspal']; ?></td>
                            <td><?php echo $d['jns_pen']; ?></td>
                            <td><?php echo $d['kon_baik']; ?></td>
                            <td><?php echo $d['kon_sedang']; ?></td>
                            <td><?php echo $d['kon_rusakringan']; ?></td>
                            <td><?php echo $d['kon_rusakberat']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>