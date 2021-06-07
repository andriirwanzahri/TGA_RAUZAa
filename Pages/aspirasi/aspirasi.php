<?php
include 'koneksi.php';

?>
<div class="row mt-0">
    <!-- Halaman Aspirasi -->
    <div class="col-xl-7 col-md-12 mb-8">

        <div class="card o-hidden border-0 shadow-lg ">
            <div class="card-body">
                <!-- Nested Row within Card Body -->
                <?php
                // $id = $adm['id'];
                // $as = mysqli_query($conn, "SELECT * FROM aspirasi WHERE idjalan='$id'");
                // $ad = mysqli_num_rows($as);
                ?>
                <center>
                    <div class="row">
                        <div class="col-lg col-xl-12 col-md-12 mb-8">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Aspirasi Masyarakat</h1>
                            </div>
                            <div class="scroll col-lg col-xl-12 col-md-12 mb-8">
                                <?php
                                if ($ad > 0) {

                                    while ($asp = mysqli_fetch_array($as)) {
                                    }
                                } else {
                                    echo "<h3>Belum Ada Aspirasi</h3>";
                                }
                                ?>
                            </div>
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
    <div class="col-xl-5 col-md-12 mb-8">

        <div class="card o-hidden border-0 shadow-lg ">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg col-xl-12 col-md-12 mb-8">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 ">Detail Jalan</h1>
                            </div>
                            <table class="table"> </table>
                        </div>
                    </div>
                    <div class="col-lg col-xl-12 col-md-12 mb-8">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 ">PETA</h1>
                            </div>
                            <div id="map">
                                <Center>Data Internet Non Aktif</Center>
                            </div>
                        </div>
                    </div>
                </div>
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
            icon: 'img/marker.png'
        });
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
        });
    }
</script>