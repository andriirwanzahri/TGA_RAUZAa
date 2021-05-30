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

if (isset($_GET["hapusPerId"])) {
    $data = mysqli_query($conn, "DELETE FROM dataset WHERE id='$hapus'");
    mysqli_query($conn, "DELETE FROM datapreprocessing WHERE id='$hapus'");
    if ($data > 0) {
?>
        <script>
            location.replace("index.php?page=datatraining&pesan_success=Data berhasil dihapus");
        </script>
    <?php
    } else { ?>
        <script>
            location.replace("index.php?page=datatraining&pesan_error=Data gagal dihapus");
        </script>
<?php

    }
}

$pesan_error = $pesan_success = "";
if (isset($_GET['pesan_error'])) {
    $pesan_error = $_GET['pesan_error'];
}
if (isset($_GET['pesan_success'])) {
    $pesan_success = $_GET['pesan_success'];
}

?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Pages/data/upload_aksi.php -->
    <div>
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
            <form method="post" class="float-right" enctype="multipart/form-data" action="Pages/data/upload_aksi.php">
                <div class="input-group">
                    <input type="file" name="datatraining" class="form-control border-2 small">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" name="upload" type="submit" id="inputGroupFileAddon04">Upload</button>
                    </div>
                </div>
            </form>
            <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#HapusModal">Hapus Semua Data</button>
            <a href="#" class="btn btn-primary float-right" data-target="#tambahdata" data-toggle="modal">Tambah Data</a>
            <!-- End Tombol data training -->
            <h5 class="font-weight-bold text-primary">Data Training</h5>
        </div>
        <div>
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
                                <td>
                                    <a href="#" type="button" data-toggle="modal" data-target="#HapusPerId" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>|
                                    <a href="#" data-toggle="modal" data-target="#edit<?= $d['id']; ?>" class="btn btn-warning btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Ubah Data Jalan -->
                            <div class="modal fade bd-example-modal-lg" id="edit<?= $d['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data Jalan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <form method="POST" action="">
                                                    <?php
                                                    $id = $d['id'];
                                                    $adm = redairec('dataset', 'id', $id);
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Ura Dukung:</label>
                                                                <select name="uradukung" class="form-control" id="exampleFormControlSelect1">
                                                                    <?php
                                                                    if ($adm['ura_dukung'] == 'Kawasan Agropolitan') {
                                                                        echo '
                                                                    <option value="Kawasan Agropolitan">Kawasan Agropolitan</option>
                                                                    <option value="Kawasan Minapolitan">Kawasan Minapolitan</option>
                                                                    <option value="Kawasan Cepat Tumbuh">Kawasan Cepat Tumbuh</option>
                                                                    <option value="Kawasan Minapolitan dan Kawasan Industri">Kawasan Minapolitan dan Kawasan Industri</option>
                                                                    <option value="Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi">Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi</option>';
                                                                    } elseif ($adm['ura_dukung'] == 'Kawasan Minapolitan') {
                                                                        echo '
                                                                    <option value="Kawasan Minapolitan">Kawasan Minapolitan</option>
                                                                    <option value="Kawasan Agropolitan">Kawasan Agropolitan</option>
                                                                    <option value="Kawasan Cepat Tumbuh">Kawasan Cepat Tumbuh</option>
                                                                    <option value="Kawasan Minapolitan dan Kawasan Industri">Kawasan Minapolitan dan Kawasan Industri</option>
                                                                    <option value="Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi">Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi</option>';
                                                                    } elseif ($adm['ura_dukung'] == 'Kawasan Cepat Tumbuh') {
                                                                        echo '
                                                                    <option value="Kawasan Cepat Tumbuh">Kawasan Cepat Tumbuh</option>
                                                                    <option value="Kawasan Minapolitan">Kawasan Minapolitan</option>
                                                                    <option value="Kawasan Agropolitan">Kawasan Agropolitan</option>
                                                                    <option value="Kawasan Minapolitan dan Kawasan Industri">Kawasan Minapolitan dan Kawasan Industri</option>
                                                                    <option value="Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi">Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi</option>';
                                                                    } elseif ($adm['ura_dukung'] == 'Kawasan Minapolitan dan Kawasan Industri') {
                                                                        echo '
                                                                    <option value="Kawasan Minapolitan dan Kawasan Industri">Kawasan Minapolitan dan Kawasan Industri</option>
                                                                    <option value="Kawasan Cepat Tumbuh">Kawasan Cepat Tumbuh</option>
                                                                    <option value="Kawasan Minapolitan">Kawasan Minapolitan</option>
                                                                    <option value="Kawasan Agropolitan">Kawasan Agropolitan</option>
                                                                    <option value="Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi">Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi</option>';
                                                                    } elseif ($adm['ura_dukung'] == 'Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi') {
                                                                        echo '
                                                                    <option value="Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi">Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi</option>
                                                                    <option value="Kawasan Minapolitan dan Kawasan Industri">Kawasan Minapolitan dan Kawasan Industri</option>
                                                                    <option value="Kawasan Cepat Tumbuh">Kawasan Cepat Tumbuh</option>
                                                                    <option value="Kawasan Minapolitan">Kawasan Minapolitan</option>
                                                                    <option value="Kawasan Agropolitan">Kawasan Agropolitan</option>
                                                                    ';
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Nama Lintas:</label>
                                                                <select class="form-control" name="namalintas" value="<?php echo $adm['namajalan']; ?>" id="exampleFormControlSelect1">
                                                                    <?php
                                                                    if ($adm['uradukung'] == 'Kawasan Agropolitan') {
                                                                        echo '';
                                                                    }
                                                                    ?>
                                                                    <option value="Lintas Jalan Provinsi">Lintas Jalan Provinsi</option>
                                                                    <option value="Lintas Jalan Kabupaten">Lintas Jalan Kabupaten</option>
                                                                    <option value="Lintas Jalan Nasional">Lintas Jalan Nasional</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Jenis Pembaharuan:</label>
                                                                <select class="form-control" name="jnspen" value="<?php echo $adm['namajalan']; ?>" id="exampleFormControlSelect1">
                                                                    <option value="Peningkatan">Peningkatan</option>
                                                                    <option value="Pemeliharaan Berkala">Pembaharuan Berkala</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Panjang:</label>
                                                                <input type="text" name="panjang" class="form-control" id="recipient-name" value="<?php echo $adm['panjangRuas']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Tanah Krikil:</label>
                                                                <input type="text" name="tanahkrikil" class="form-control" id="recipient-name" value="<?php echo $adm['tanah_krikil']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Aspal:</label>
                                                                <input type="text" name="aspal" class="form-control" id="recipient-name" value="<?php echo $adm['aspal']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Rigid:</label>
                                                                <input type="text" name="rigit" class="form-control" id="recipient-name" value="<?php echo $adm['rigit']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Kondisi Baik:</label>
                                                                <input type="text" name="konbaik" class="form-control" id="recipient-name" placeholder="KM" value="<?php echo $adm['target']; ?>">
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



<div class="modal fade bd-example-modal-lg" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Training</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Ura Dukung:</label>
                                    <select name="uradukung" class="form-control" id="exampleFormControlSelect1">
                                        <option value="Kawasan Minapolitan dan Kawasan Industri">Kawasan Minapolitan dan Kawasan Industri</option>
                                        <option value="Kawasan Agropolitan">Kawasan Agropolitan</option>
                                        <option value="Kawasan Minapolitan">Kawasan Minapolitan</option>
                                        <option value="Kawasan Cepat Tumbuh">Kawasan Cepat Tumbuh</option>
                                        <option value="Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi">Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Nama Lintas:</label>
                                    <select class="form-control" name="namalintas" id="exampleFormControlSelect1">
                                        <option value="Lintas Jalan Provinsi">Lintas Jalan Provinsi</option>
                                        <option value="Lintas Jalan Kabupaten">Lintas Jalan Kabupaten</option>
                                        <option value="Lintas Jalan Nasional">Lintas Jalan Nasional</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Jenis Pembaharuan:</label>
                                    <select class="form-control" name="jnspen" id="exampleFormControlSelect1">
                                        <option value="Peningkatan">Peningkatan</option>
                                        <option value="Pemeliharaan Berkala">Pembaharuan Berkala</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Panjang:</label>
                                    <input type="text" name="panjang" class="form-control" id="recipient-name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Tanah Krikil:</label>
                                    <input type="text" name="tanahkrikil" class="form-control" id="recipient-name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Aspal:</label>
                                    <input type="text" name="aspal" class="form-control" id="recipient-name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Rigit:</label>
                                    <input type="text" name="rigit" class="form-control" id="recipient-name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Kondisi Baik:</label>
                                    <input type="text" name="konbaik" class="form-control" id="recipient-name" placeholder="KM">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambahkan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="HapusPerId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Siap untuk Menghapus?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah Anda Yakin Ingin menghapus <?= $d['id']; ?> .</div>
            <div class="modal-footer">
                <form action="" method="post">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" name="hapusPerId">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>