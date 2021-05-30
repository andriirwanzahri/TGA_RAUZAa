<?php
include 'koneksi.php';
$id = $_GET['id'];
$adm = redairec('datajalan', 'id', $id);;
?>
<div class="row mt-0">

    <div class="col-xl-8 col-md-12 mb-8">

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
                    <div class="col-lg col-xl-12 col-md-12 mb-8">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 ">PETA</h1>
                            </div>
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Halaman Aspirasi -->
    <div class="col-xl-4 col-md-12 mb-8">

        <div class="card o-hidden border-0 shadow-lg ">
            <div class="card-body">
                <!-- Nested Row within Card Body -->
                <?php
                $id = $adm['id'];
                $as = mysqli_query($conn, "SELECT * FROM aspirasi WHERE idjalan='$id'");
                $ad = mysqli_num_rows($as);
                ?>
                <center>
                    <div class="row">
                        <div class="col-lg col-xl-12 col-md-12 mb-8">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Aspirasi</h1>
                            </div>
                            <div class="scroll col-lg col-xl-12 col-md-12 mb-8">
                                <?php
                                if ($ad > 0) {
                                    # code...
                                    while ($asp = mysqli_fetch_array($as)) {
                                ?>
                                        <h5><?php echo $asp['namaUser']; ?></h5>
                                        <p><?php echo $asp['komentar']; ?></p>
                                        <hr>
                                <?php
                                    }
                                } else {
                                    echo "<h3>Belum Ada Aspirasi</h3>";
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Nama Pengirim</label>
                                    <input type="text" name="nama" class="form-control" value="<?php echo $_SESSION['login']['nama']; ?>" readonly>
                                    <input type="hidden" name="idjalan" value="<?php echo $adm['id']; ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Tambahkan Aspirasi</label>
                                    <textarea class="form-control h6" name="aspirasi" id="exampleFormControlTextarea1" rows="3" placeholder="Berilah Aspirasi anda akan jalan ini...."></textarea>
                                </div>
                                <button class="btn btn-info float-right" name="kirim">Kirim</button>
                            </div>
                        </div>
            </div>
            </form>
            <?php
            if (
                isset($_POST['kirim'])
            ) {
                if (tAspirasi($_POST) > 0) {

                    echo "<script>
                        location.replace('index.php?page=aspirasi&id=$id&pesan_success=Data berhasil ditambahkan');
                    </script>";
                } else {
                    echo "<script>
                        location.replace('index.php?page=aspirasi&id=$id&pesan_error=Data gagal ditambahkan');
                    </script>";
                }
            }
            ?>
            </center>
        </div>
    </div>
</div>

<script>
    function initMap() {
        var myLatlng = new google.maps.LatLng(<?php echo $adm['latitude']; ?>, <?php echo $adm['longitude']; ?>);
        var mapOptions = {
            zoom: 15,
            center: myLatlng
        };

        var map = new google.maps.Map(document.getElementById('map'), mapOptions);

        var contentString = '<div id="content">' +
            '<div id="siteNotice">' +
            '</div>' +
            '<h1 id="firstHeading" class="firstHeading"><?php echo $adm['namajalan']; ?></h1>' +
            '<div id="bodyContent">' +
            '<p><?php echo $adm['namajalan']; ?></p>' +
            '</div>' +
            '</div>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Maps Info',
            icon: 'img/marker.png'
        });
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
        });
    }
</script>