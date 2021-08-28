<?php
include 'koneksi.php';
$kondisi = $_GET['kondisi'];
$ery = "SELECT datajalan.namajalan, datajalan.id, datajalan.desa, datajalan.kecamatan,datausulan.tahunusulan, user.nama 
FROM datajalan, datausulan,user WHERE datajalan.id=datausulan.idjalan AND user.id=datausulan.iduser";
$data = mysqli_query($conn, $ery);

if (isset($_POST['ubah'])) {
    if (ubahdatatahun($_POST) > 0) {
        echo '<script>
    location.replace("index.php?page=usulanjalan&pesan_success=Tahun Berhasi diubah");
</script>';
    } else {
        echo '<script>
    location.replace("index.php?page=usulanjalan&pesan_error=Tahun gagal diubah");
</script>';
    }
}

if (isset($_GET["hapus"])) {
    $hapus = $_GET['hapus'];
    if (hapususulan($_GET) > 0) {
        echo ' <script>
            location.replace("index.php?page=usulanjalan&pesan_success=Data berhasil dihapus");
        </script>';
    } else {
        echo '<script>
            location.replace("index.php?page=usulanjalan&pesan_error=Data gagal dihapus");
        </script>';
    }
}


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
<div class="container-fluid">
    <div class="card mt-3">
        <div class="card-header py-1 mt-3">
            <h5 class="font-weight-bold text-primary">Data Jalan yang diusulkan</h5>
        </div>
        <div class="container">
            <div class="table-responsive ">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama jalan</th>
                            <th>desa</th>
                            <th>kecamatan</th>
                            <th>tahun usulan</th>
                            <th>Aksi</th>
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
                                <td><?php echo $d['desa']; ?></td>
                                <td><?php echo $d['kecamatan']; ?></td>
                                <td><?php echo $d['tahunusulan']; ?></td>
                                <td><a href="index.php?page=usulanjalan&hapus=<?php echo $d['id']; ?>" class="badge badge-pill badge-danger" onClick="return confirm('Anda yakin akan hapus ?')"><i class=" fas fa-trash"></i> hapus</a>
                                    <a href="index.php?page=detailjalan&id=<?php echo $d['id']; ?>" class="badge badge-pill badge-info"><i class="fas fa-info"></i> detail</a>
                                    <a href="#" class="badge badge-pill badge-success" data-toggle="modal" data-target="#myModal<?= $d['id']; ?>"><i class="fas fa-edit"></i> ubah</a>
                                </td>
                            </tr>
                            <!-- Ubah Data usulan jalan -->
                            <div class="modal fade bd-example-modal-lg" id="myModal<?= $d['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Tahun Usulan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <form method="POST" action="">
                                                    <?php
                                                    $id = $d['id'];
                                                    $adm = redairec('datausulan', 'idjalan', $id);
                                                    ?>
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Tahun Usulan:</label>
                                                                <input type="hidden" name="id" class="form-control" id="recipient-name" value="<?php echo $adm['idjalan']; ?>">
                                                                <input type="text" name="tahun" class="form-control" id="recipient-name" value="<?php echo $adm['tahunusulan']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                            <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>