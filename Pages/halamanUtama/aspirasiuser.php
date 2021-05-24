<?php
include '../template/headeruser.php';
include '../../koneksi.php';
$id = $_GET['id'];
$adm = redairec('datajalan', $id);
?>
<div class="container">
    <div class="row mt-4">
        <div class=" col-xl-12">
            <a href="../halamanUtama/datajalanuser.php" class="badge badge-pill badge-primary">Kembali</a>
        </div>
    </div>
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
                                <div>
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
                        </div>
                        <div class="col-lg col-xl-12 col-md-12 mb-8">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 ">PETA</h1>
                                </div>
                                <div id="map">data internet tidak ada</div>
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
                    <center>
                        <div class="row">
                            <div class="col-lg col-xl-12 col-md-12 mb-8">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Aspirasi</h1>
                                </div>
                                <div class="scroll col-lg col-xl-12 col-md-12 mb-8">
                                    <h4 id="fat">User4</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita impedit natus totam doloribus dolorem laborum neque, eius dolorum alias deserunt facere veniam voluptas asperiores? Sunt, inventore assumenda! Laudantium, eveniet recusandae.</p>
                                    <h4 id="mdo">User5</h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam possimus facilis maxime id sunt vel laudantium consequatur nam. Accusamus nobis veritatis hic magnam dolore quaerat explicabo quasi deserunt porro reprehenderit?</p>
                                    <h4 id="one">User6</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta distinctio ipsa, perspiciatis quidem doloremque velit voluptatem sequi iure nulla, ipsum, itaque assumenda delectus. Repellat quam architecto non. Officiis, molestias modi.</p>
                                    <h4 id="two">User7</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta distinctio ipsa, perspiciatis quidem doloremque velit voluptatem sequi iure nulla, ipsum, itaque assumenda delectus. Repellat quam architecto non. Officiis, molestias modi.</p>
                                    <h4 id="three">user9</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta distinctio ipsa, perspiciatis quidem doloremque velit voluptatem sequi iure nulla, ipsum, itaque assumenda delectus. Repellat quam architecto non. Officiis, molestias modi.</p>
                                </div>
                            </div>
                            
                        </div>
                        <form action="" method="POST">
                        <div class="row">
                    <div class="col-md-12">
                            <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Nama Pengirim</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Anda...">
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
                    </center>
                </div>
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
                icon: '../../img/marker.png'
            });
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map, marker);
            });
        }
    </script>
    <?php

    include '../template/footeruser.php';
    ?>