<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Halaman Utama</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../css/custom.css" rel="stylesheet">
    <style type="text/css">
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;
            /* The height is 400 pixels */
            width: 100%;
            /* The width is the width of the web page */
        }
    </style>
    <script>
        //     const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        //     let labelIndex = 0;

        //     function initMap() {
        //         const bangalore = {
        //             lat: 5.3759564,
        //             lng: 95.9003835
        //         };
        //         const map = new google.maps.Map(document.getElementById("map"), {
        //             zoom: 12,
        //             center: bangalore,
        //         });
        //         // This event listener calls addMarker() when the map is clicked.
        //         google.maps.event.addListener(map, "click", (event) => {
        //             addMarker(event.latLng, map);
        //         });
        //         // Add a marker at the center of the map.
        //         addMarker(bangalore, map);
        //     }

        //     // Adds a marker to the map.
        //     function addMarker(location, map) {
        //         // Add the marker at the clicked location, and add the next-available label
        //         // from the array of alphabetical characters.
        //         new google.maps.Marker({
        //             position: location,
        //             label: labels[labelIndex++ % labels.length],
        //             map: map,
        //         });
        //     }
    </script>
    <script>
        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            const uluru = {
                lat: 5.3759564,
                lng: 95.9003835
            };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 13,
                center: uluru,
            });
            // The marker, positioned at Uluru
            setMarkers(map, officeLocations);
            // const marker = new google.maps.Marker({
            //     position: uluru,
            //     map: map,
            // });
        }
        var officeLocations = [
            <?php
            $data = file_get_contents('http://localhost/TGA_RAUZAa/Pages/peta/dataPetaAll.php');
            $no = 1;
            if (json_decode($data, true)) {
                $obj = json_decode($data);
                foreach ($obj->results as $item) {
            ?>[<?php echo $item->id ?>,
                        '<?php echo $item->namajalan ?>',
                        '<?php echo $item->desa ?>',
                        <?php echo $item->longitude ?>,
                        <?php echo $item->latitude ?>],
            <?php
                }
            }
            ?>
        ];

        function setMarkers(map, locations) {
            var globalPin = 'img/marker.png';

            for (var i = 0; i < locations.length; i++) {

                var office = locations[i];
                var myLatLng = new google.maps.LatLng(office[4], office[3]);
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                var contentString =
                    '<div id="content">' +
                    '<div id="siteNotice">' +
                    '</div>' +
                    '<h5 id="firstHeading" class="firstHeading">' + office[1] + '</h5>' +
                    '<h6 id="firstHeading">' + office[2] + '</h6>' +
                    '<div id="bodyContent">' +
                    '<center><a href=aspirasiuser.php?id=' + office[0] + '>Info Detail</a></center>' +
                    '</div>' +
                    '</div>';

                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    title: office[1],
                    icon: '../../img/marker.png'
                });

                google.maps.event.addListener(marker, 'click', getInfoCallback(map, contentString));
            }
        }

        function getInfoCallback(map, content) {
            var infowindow = new google.maps.InfoWindow({
                content: content
            });
            return function() {
                infowindow.setContent(content);
                infowindow.open(map, this);
            };
        }
    </script>
</head>

<body class="">
    <div class="container shadow">
        <div class="row"></div>
        <div id="carouselExampleIndicators" class="carousel slide mb-3 mt-3" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../../img/bg.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>

        <center>
            <a href="#" class="btn btn-warning" type="submit">Data Usulan Perbaikan</a>
            <a href="datajalanuser.php" class="btn btn-warning" type="submit">Data Jalan</a>
            <a href="../login/login.php" class="btn btn-warning" type="submit">Login</a>
            <h1 class="h3 mb-4 text-gray-800 mt-5">PETA JALAN PIDIE</h1>
        </center>
        <div class="row">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body shadow">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-ndub7Wp6y-DZtdfCFqd-smlpXPnoGBs&callback=initMap" type="text/javascript"></script>


</body>

</html>