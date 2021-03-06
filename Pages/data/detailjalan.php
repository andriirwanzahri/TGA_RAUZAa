<?php
include 'koneksi.php';
$id = $_GET['id'];
$adm = redairec('datajalan', 'id', $id);;
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
                                <h1 class="h4 text-gray-900 ">Detail Jalan</h1>
                            </div>
                            <table class="table">
                                <tr>
                                    <th>Nama Jalan</th>
                                    <td>
                                        <?php echo $adm['namajalan']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nama Desa</td>
                                    <td>
                                        <?php echo $adm['desa']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ura dukung</td>
                                    <td>
                                        <?php echo $adm['uradukung']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jenis Pen</td>
                                    <td>
                                        <?php echo $adm['jnspen']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kecamatan</td>
                                    <td>
                                        <?php echo $adm['kecamatan']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Provinsi</td>
                                    <td>
                                        <?php echo $adm['provinsi']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Panjang</td>
                                    <td>
                                        <?php echo $adm['panjang']; ?> (Km)
                                    </td>
                                </tr>
                                <tr>
                                    <td>Krikil</td>
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
                                    <td>Aspal</td>
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
                                    <td>Rigid</td>
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
                        </div>
                    </div>
                    <div class="col-lg col-xl-12 col-md-12 mb-8 bg-gray-200">
                        <div class="p-3">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 ">Gambar Jalan</h1>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card shadow-lg"><img src="img/jalan/<?php echo $adm['gambar1']; ?>"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card shadow-lg"><img src="img/jalan/<?php echo $adm['gambar2']; ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>