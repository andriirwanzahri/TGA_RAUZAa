<?php
include 'koneksi.php';
include 'Pages/proses/prosesmining.php';

$datajalan = query("SELECT * FROM datajalan ORDER BY id DESC");

if (isset($_GET["hapus"])) {
    $hapus = $_GET['hapus'];
    if (hapusJalan($_GET) > 0) {
        echo ' <script>
            location.replace("index.php?page=datajalan&pesan_success=Data berhasil dihapus");
        </script>';
    } else {
        echo '<script>
            location.replace("index.php?page=datajalan&pesan_error=Data gagal dihapus");
        </script>';
    }
}

if (isset($_POST["tambah"])) {

    $uradukung = $_POST['uradukung'];
    $namalintas = $_POST['namalintas'];
    $panjang = $_POST['panjang'];
    $jnspen = $_POST['jnspen'];
    $tanahkrikil = $_POST['tanahkrikil'];
    $aspal = $_POST['aspal'];
    $rigit = $_POST['rigit'];
    $namajalan = $_POST['namajalan'];

    $preproces = preprocessingdata(
        $conn,
        $uradukung,
        $namalintas,
        $panjang,
        $jnspen,
        $tanahkrikil,
        $aspal,
        $rigit
    );

    $n_ura_dukung = $preproces['uradukung'];
    $n_namaLintas = $preproces['namalintas'];
    $n_panjangRuas = $preproces['panjang'];
    $n_jns_pen = $preproces['jnspen'];
    $n_tanah_krikil = $preproces['tanah_krikil'];
    $n_aspal = $preproces['aspal'];
    $n_rigit = $preproces['rigit'];

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
    $keputusan = $hasil['keputusan'];
    $id_rule_keputusan = $hasil['id_rule'];

    if ($keputusan == 'RR') {
        $kpk = 'Rusak Ringan';
    } else if ($keputusan == 'RB') {
        $kpk = 'Rusak Berat';
    } else if ($keputusan == 'B') {
        $kpk = 'Baik';
    } else if ($keputusan == 'S') {
        $kpk = 'Sedang';
    }

    $query = "SELECT max(id) as maxKode FROM datajalan";
    $hasil = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($hasil);
    $kodeJalan = $data['maxKode'];
    $noUrut = (int) substr($kodeJalan, 3, 3);
    $noUrut++;
    $char = "JLN";
    $kodeJalan = $char . sprintf("%03s", $noUrut);

    if (tambah($_POST, $keputusan, $id_rule_keputusan, $kodeJalan) > 0) {
        echo ' <script>
        location.replace("index.php?page=datajalan&pesan_success=Data jalan <th>' . $namajalan . '</th> berhasil di tambahkan <br> Kondisi Jalan <th>' . $kpk . '</th><br> id Rule Pohon Keputusan <th>' . $id_rule_keputusan . '</th>");
    </script>';
    } else {
        echo '<script>
            location.replace("index.php?page=datajalan&pesan_error=Data gagal ditambahkan");
        </script>';
    }
}

if (isset($_POST["ubah"])) {

    $uradukung = $_POST['uradukung'];
    $namalintas = $_POST['namalintas'];
    $panjang = $_POST['panjang'];
    $jnspen = $_POST['jnspen'];
    $tanahkrikil = $_POST['tanahkrikil'];
    $aspal = $_POST['aspal'];
    $rigit = $_POST['rigit'];
    $namajalan = $_POST['namajalan'];

    $preproces = preprocessingdata(
        $conn,
        $uradukung,
        $namalintas,
        $panjang,
        $jnspen,
        $tanahkrikil,
        $aspal,
        $rigit
    );

    $n_ura_dukung = $preproces['uradukung'];
    $n_namaLintas = $preproces['namalintas'];
    $n_panjangRuas = $preproces['panjang'];
    $n_jns_pen = $preproces['jnspen'];
    $n_tanah_krikil = $preproces['tanah_krikil'];
    $n_aspal = $preproces['aspal'];
    $n_rigit = $preproces['rigit'];

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
    $keputusan = $hasil['keputusan'];
    $id_rule_keputusan = $hasil['id_rule'];

    if ($keputusan == 'RR') {
        $kpk = 'Rusak Ringan';
    } else if ($keputusan == 'RB') {
        $kpk = 'Rusak Berat';
    } else if ($keputusan == 'B') {
        $kpk = 'Baik';
    } else if ($keputusan == 'S') {
        $kpk = 'Sedang';
    }

    if (ubahdatajalan($_POST, $keputusan, $id_rule_keputusan) > 0) {
        echo ' <script>
            location.replace("index.php?page=datajalan&pesan_success=Data jalan <th>' . $namajalan . '</th> berhasil diubah <br> Kondisi Jalan <th>' . $kpk . '</th><br> id Rule Pohon Keputusan <th>' . $id_rule_keputusan . '</th>");
        </script>';
    } else {
        echo '<script>
            location.replace("index.php?page=datajalan&pesan_error=Data gagal diubah");
        </script>';
    }
}

?>
<div>
    <div class="card-header py-3">

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
        if ($_SESSION['login']['level'] == '2') : ?>
        <?php else : ?>
            <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Tambah Data</button>
        <?php endif; ?>
        <h6 class="m-0 font-weight-bold text-info">Data Jalan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jalan</th>
                        <th>Desa</th>
                        <th>Provinsi</th>
                        <th>Kecamatan</th>
                        <th>Nama Lintas</th>
                        <th>Lainnya</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($datajalan as $d) :
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['namajalan']; ?></td>
                            <td><?php echo $d['desa']; ?></td>
                            <td><?php echo $d['provinsi']; ?></td>
                            <td><?php echo $d['kecamatan']; ?></td>
                            <td><?php echo $d['namalintas']; ?></td>
                            <?php if ($_SESSION['login']['level'] == '2') : ?>
                                <td>
                                    <a href="index.php?page=detailjalan&id=<?php echo $d['id']; ?>" class="badge badge-pill badge-info">Detail</a>
                                </td>
                            <?php else : ?>
                                <td>
                                    <a href="#" class="badge badge-pill badge-success" data-toggle="modal" data-target="#myModal<?= $d['id']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?page=datajalan&hapus=<?php echo $d['id']; ?>" class="badge badge-pill badge-danger" onClick="return confirm('Anda yakin akan hapus ?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="index.php?page=detailjalan&id=<?php echo $d['id']; ?>" class="badge badge-pill badge-info">detail</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <!-- Ubah Data Jalan -->
                        <div class="modal fade bd-example-modal-lg" id="myModal<?= $d['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                <?php
                                                $id = $d['id'];
                                                $adm = redairec('datajalan', 'id', $id);
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Nama Jalan:</label>
                                                            <input type="hidden" name="id" value="<?php echo $adm['id']; ?>">
                                                            <input type="hidden" name="gambarLama1" value="<?= $adm["gambar1"]; ?>">
                                                            <input type="hidden" name="gambarLama2" value="<?= $adm["gambar2"]; ?>">
                                                            <input type="text" name="namajalan" class="form-control" id="recipient-name" value="<?php echo $adm['namajalan']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Desa:</label>
                                                            <input type="text" name="desa" class="form-control" id="recipient-name" value="<?php echo $adm['desa']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Ura Dukung:</label>
                                                            <select name="uradukung" class="form-control" id="exampleFormControlSelect1">
                                                                <?php
                                                                if ($adm['uradukung'] == 'Kawasan Agropolitan') {
                                                                    echo '
                                                                    <option value="Kawasan Agropolitan">Kawasan Agropolitan</option>
                                                                    <option value="Kawasan Minapolitan">Kawasan Minapolitan</option>
                                                                    <option value="Kawasan Cepat Tumbuh">Kawasan Cepat Tumbuh</option>
                                                                    <option value="Kawasan Minapolitan dan Kawasan Industri">Kawasan Minapolitan dan Kawasan Industri</option>
                                                                    <option value="Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi">Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi</option>';
                                                                } elseif ($adm['uradukung'] == 'Kawasan Minapolitan') {
                                                                    echo '
                                                                    <option value="Kawasan Minapolitan">Kawasan Minapolitan</option>
                                                                    <option value="Kawasan Agropolitan">Kawasan Agropolitan</option>
                                                                    <option value="Kawasan Cepat Tumbuh">Kawasan Cepat Tumbuh</option>
                                                                    <option value="Kawasan Minapolitan dan Kawasan Industri">Kawasan Minapolitan dan Kawasan Industri</option>
                                                                    <option value="Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi">Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi</option>';
                                                                } elseif ($adm['uradukung'] == 'Kawasan Cepat Tumbuh') {
                                                                    echo '
                                                                    <option value="Kawasan Cepat Tumbuh">Kawasan Cepat Tumbuh</option>
                                                                    <option value="Kawasan Minapolitan">Kawasan Minapolitan</option>
                                                                    <option value="Kawasan Agropolitan">Kawasan Agropolitan</option>
                                                                    <option value="Kawasan Minapolitan dan Kawasan Industri">Kawasan Minapolitan dan Kawasan Industri</option>
                                                                    <option value="Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi">Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi</option>';
                                                                } elseif ($adm['uradukung'] == 'Kawasan Minapolitan dan Kawasan Industri') {
                                                                    echo '
                                                                    <option value="Kawasan Minapolitan dan Kawasan Industri">Kawasan Minapolitan dan Kawasan Industri</option>
                                                                    <option value="Kawasan Cepat Tumbuh">Kawasan Cepat Tumbuh</option>
                                                                    <option value="Kawasan Minapolitan">Kawasan Minapolitan</option>
                                                                    <option value="Kawasan Agropolitan">Kawasan Agropolitan</option>
                                                                    <option value="Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi">Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi</option>';
                                                                } elseif ($adm['uradukung'] == 'Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi') {
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
                                                            <label for="recipient-name" class="col-form-label">Provinsi:</label>
                                                            <input type="text" name="provinsi" class="form-control" id="recipient-name" value="<?php echo $adm['provinsi']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Kecamatan:</label>
                                                            <input type="text" name="kecamatan" class="form-control" id="recipient-name" value="<?php echo $adm['kecamatan']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Nama Lintas:</label>
                                                            <select class="form-control" name="namalintas" value="<?php echo $adm['namajalan']; ?>" id="exampleFormControlSelect1">
                                                                <?php
                                                                if ($adm['namalintas'] == 'Lintas Jalan Provinsi') {
                                                                    echo '
                                                                    <option value="Lintas Jalan Provinsi">Lintas Jalan Provinsi</option>
                                                                    <option value="Lintas Jalan Kabupaten">Lintas Jalan Kabupaten</option>
                                                                    <option value="Lintas Jalan Nasional">Lintas Jalan Nasional</option>
                                                                    ';
                                                                } elseif ($adm['namalintas'] == 'Lintas Jalan Kabupaten') {
                                                                    echo '
                                                                    <option value="Lintas Jalan Kabupaten">Lintas Jalan Kabupaten</option>
                                                                    <option value="Lintas Jalan Provinsi">Lintas Jalan Provinsi</option>
                                                                    <option value="Lintas Jalan Nasional">Lintas Jalan Nasional</option>
                                                                    ';
                                                                } elseif ($adm['namalintas'] == 'Lintas Jalan Nasional') {
                                                                    echo '
                                                                    <option value="Lintas Jalan Nasional">Lintas Jalan Nasional</option>
                                                                    <option value="Lintas Jalan Kabupaten">Lintas Jalan Kabupaten</option>
                                                                    <option value="Lintas Jalan Provinsi">Lintas Jalan Provinsi</option>
                                                                    ';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Jenis Pemeliaraan:</label>
                                                            <select class="form-control" name="jnspen" value="<?php echo $adm['namajalan']; ?>" id="exampleFormControlSelect1">
                                                                <?php
                                                                if ($adm['jnspen'] == 'Peningkatan') {
                                                                    echo '
                                                                    <option value="Peningkatan">Peningkatan</option>
                                                                    <option value="pemeliharaan Berkala">Pembaharuan Berkala</option>
                                                                    ';
                                                                } elseif ($adm['jnspen'] == 'pemeliharaan Berkala') {
                                                                    echo '
                                                                    <option value="pemeliharaan Berkala">Pembaharuan Berkala</option>
                                                                    <option value="Peningkatan">Peningkatan</option>
                                                                ';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Panjang:</label>
                                                            <input type="text" name="panjang" class="form-control" id="recipient-name" value="<?php echo $adm['panjang']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Tanah Krikil:</label>
                                                            <input type="text" name="tanahkrikil" class="form-control" id="recipient-name" value="<?php echo $adm['tanahkrikil']; ?>">
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
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Tahun Terakhir Pembuatan:</label>
                                                            <input type="text" name="konbaik" class="form-control" id="datepicker" value="<?php echo $adm['thn_pem']; ?>" placeholder="Tanggal Pembuatan">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Penyedia:</label>
                                                            <input type="text" name="konsedang" class="form-control" id="recipient-name" placeholder="Mandor" value="<?php echo $adm['mandor']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Gambar Jalan 1:</label>
                                                            <input type="file" name="gambar1" class="form-control" id="recipient-name">
                                                            <?php
                                                            if (isset($adm['gambar1'])) {
                                                                echo "<img src='img/jalan/" . $adm['gambar1'] . "' width='40'>";
                                                            } else {
                                                                echo "Gambar belum Ada";
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Gambar Jalan 2:</label>
                                                            <input type="file" name="gambar2" class="form-control" id="recipient-name">
                                                            <?php
                                                            if (isset($adm['gambar2'])) {
                                                                echo "<img src='img/jalan/" . $adm['gambar2'] . "' width='40'>";
                                                            } else {
                                                                echo "Gambar belum Ada";
                                                            }
                                                            ?>
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
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tambah Data Jalan -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jalan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nama Jalan:</label>
                                    <input type="text" name="namajalan" class="form-control" id="recipient-name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Desa:</label>
                                    <input type="text" name="desa" class="form-control" id="recipient-name" required>
                                </div>
                            </div>
                        </div>
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
                                    <label for="recipient-name" class="col-form-label">Provinsi:</label>
                                    <input type="text" name="provinsi" class="form-control" id="recipient-name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Kecamatan:</label>
                                    <input type="text" name="kecamatan" class="form-control" id="recipient-name" required>
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
                                        <option value="pemeliharaan Berkala">Pembaharuan Berkala</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Panjang:</label>
                                    <input type="text" name="panjang" class="form-control" id="recipient-name" placeholder="Km" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Tanah Krikil:</label>
                                    <input type="text" name="tanahkrikil" class="form-control" id="recipient-name" placeholder="%" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Aspal:</label>
                                    <input type="text" name="aspal" class="form-control" id="recipient-name" placeholder="%" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Rigid:</label>
                                    <input type="text" name="rigit" class="form-control" id="recipient-name" placeholder="%" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Tahun Terakhir Pembuatan:</label>
                                    <input type="text" name="konbaik" class="date-own form-control" id="datepicker" placeholder="Tanggal Pembuatan" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Mandor:</label>
                                    <input type="text" name="konsedang" class="form-control" id="recipient-name" placeholder="Mandor" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Gambar Jalan 1:</label>
                                    <input type="file" name="gambar1" class="form-control" id="recipient-name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Gambar Jalan 2:</label>
                                    <input type="file" name="gambar2" class="form-control" id="recipient-name">
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
<script type="text/javascript">
    $("#datepicker").datepicker({
        format: "yyyy",
        startView: "years",
        minViewMode: "years"
    });
</script>