<?php
include 'koneksi.php';
if (isset($_GET['berhasil'])) {
    echo "
    <div class='alert alert-info alert-dismissable' id='divAlert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
            Data Tersimpan Sebanyak " . $_GET['berhasil'] . "
            </div>";
} else if (isset($_GET['gagal'])) {
    echo "
    <div class='alert alert-danger alert-dismissable' id='divAlert'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
            Data Gagal Tersimpan " . $_GET['gagal'] . "
            </div>";
}
if (isset($_POST["hapus"])) {
    $data = mysqli_query($conn, "DELETE FROM datapreprocessing");
    mysqli_query($conn, "DELETE FROM dataset");
    if ($data > 0) {
        echo "
        <div class='alert alert-info alert-dismissable' id='divAlert'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        Data Berhasil di Hapus Semua
        </div>";
    } else {
        echo "
        <div class='alert alert-danger alert-dismissable' id='divAlert'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        Data Gagal di hapus
        </div>";
    }
}


?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Pages/data/upload_aksi.php -->
    <div class="card shadow mb-4">
        <div class="card-header py-1">
            <!-- Tombol hapus Tambah data training -->
            <form method="post" class="float-right" enctype="multipart/form-data" action="Pages/data/upload_aksi.php">
                <div class="input-group">
                    <input type="file" name="datatraining" class="form-control border-2 small">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" name="upload" type="submit" id="inputGroupFileAddon04">Upload</button>
                    </div>
                </div>
            </form>
            <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#HapusModal">Hapus Semua Data</button>
            <a href="#" class="btn btn-primary float-right">Tambah Data</a>
            <!-- End Tombol data training -->
            <h5 class="font-weight-bold text-primary">Data Training</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ura Dukung</th>
                            <th>Lintas</th>
                            <th>Panjang</th>
                            <th>Jns_Pen</th>
                            <th>Krikil</th>
                            <th>Aspal</th>
                            <th>rigit</th>
                            <th>Kondisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;


                        $data = mysqli_query($conn, "select * from datapreprocessing");
                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d['ura_dukung']; ?></td>
                                <td><?php echo $d['namaLintas']; ?></td>
                                <td><?php echo $d['panjangRuas']; ?></td>
                                <td><?php echo $d['jns_pen']; ?></td>
                                <td><?php echo $d['tanah_krikil']; ?></td>
                                <td><?php echo $d['aspal']; ?></td>
                                <td><?php echo $d['rigit']; ?></td>
                                <td><?php echo $d['target']; ?></td>
                                <td><a href="#" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="#" class="btn btn-warning btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
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

<!-- Hapus Modal-->
<div class="modal fade" id="HapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Siap untuk Menghapus?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah Anda Yakin Ingin menghapus Semua Data.</div>
            <div class="modal-footer">
                <form action="" method="post">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" name="hapus">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>