<?php
include 'koneksi.php';
$id = $_GET['id'];
$kon = $_GET['kondisi'];
$adm = redairec('datajalan', 'id', $id);
$iduser = $_SESSION['login']['id'];

if (isset($_POST['submit'])) {
    if (tambahusulan($_POST, $adm['id'], $iduser) > 0) {
        echo ' <script>
        location.replace("index.php?page=tampilklasifikasi&kondisi=' . $kon . '&pesan_success= Jalan Berhasil di usulkan");
    </script>';
    } else {
        echo mysqli_error($conn);
    }
}

?>
<div class="row mt-0">

    <div class="col-xl-12 col-md-12 mb-8">

        <div class="card o-hidden border-0 shadow-lg ">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg col-xl-12 col-md-12 mb-8">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 ">Tambahkan Data Usulan Perbaikan Jalan</h1>
                            </div>
                            <table class="table">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Tahun Usulan:</label>
                                        <input type="text" name="tahun" class="form-control" id="recipient-name">
                                    </div>
                                    <tr>
                                        <th>Nama Jalan</th>
                                        <td>
                                            <?php echo $adm['namajalan']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nama Desa</th>
                                        <td>
                                            <?php echo $adm['desa']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Ura dukung</th>
                                        <td>
                                            <?php echo $adm['uradukung']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Pen</th>
                                        <td>
                                            <?php echo $adm['jnspen']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Kecamatan</th>
                                        <td>
                                            <?php echo $adm['kecamatan']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Provinsi</th>
                                        <td>
                                            <?php echo $adm['provinsi']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Panjang</th>
                                        <td>
                                            <?php echo $adm['panjang']; ?> (Km)
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Krikil</th>
                                        <td>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h6 mb-0 mr-3 text-gray-800"><?php echo $adm['tanahkrikil']; ?>%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $adm['tanahkrikil']; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Aspal</th>
                                        <td>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h6 mb-0 mr-3 text-gray-800"><?php echo $adm['aspal']; ?>%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $adm['aspal']; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Rigid</th>
                                        <td>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h6 mb-0 mr-3 text-gray-800"><?php echo $adm['rigit']; ?>%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $adm['rigid']; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            </table>
                            <button type="submit" name="submit" class="btn btn-success ">Usulkan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>