<?php
include 'koneksi.php';

?>
<div class="row mt-1">
    <!-- Halaman Aspirasi -->
    <div class="col-xl-12 col-md-12 mb-8">

        <div class="card o-hidden border-0 shadow-lg ">
            <div class="card-body">
                <!-- Nested Row within Card Body -->
                <?php
                $as = mysqli_query($conn, "SELECT * FROM aspirasi ORDER BY id ASC");
                $ad = mysqli_num_rows($as);
                ?>
                <div class="row">
                    <div class="col-lg col-xl-12 col-md-12 mb-8">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Aspirasi Masyarakat</h1>
                        </div>
                        <div class="container">
                            <div class="scroll  col-xl-12 col-md-12 mb-8">
                                <?php
                                if ($ad > 0) {

                                    while ($asp = mysqli_fetch_array($as)) { ?>
                                        <div class="container">
                                            <div class="card mt-2 border-bottom-primary">
                                                <div class="container">
                                                    <h6 class="text-center"><?php echo $asp['namaUser']; ?></h6>
                                                    <p class="mt-0" style="font-size: 10px; ">Alamat : <?php echo $asp['alamat']; ?></p>
                                                    <p class="mt-0" style="font-size: 10px;">Tanggal : <?php echo $asp['tgl']; ?></p>
                                                    <hr class="mt-0">
                                                    <p><?php echo $asp['komentar']; ?></p>
                                                    <center>
                                                        <div class="card col-md-3 justify-center"><img src="img/aspirasi/<?= $asp['lampiran']; ?>"></div>
                                                    </center>
                                                    <a href="index.php?page=detailjalan&id=<?php echo $asp['idjalan']; ?>">Lihat Detail Jalan yang di aspirasi</a>
                                                </div>
                                            </div>
                                        </div>
                                <?php   }
                                } else {
                                    echo "<h3>Belum Ada Aspirasi</h3>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            </form>
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