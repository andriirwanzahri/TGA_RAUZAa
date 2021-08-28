</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Data Mining</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Siap untuk keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah Anda Yakin Ingin Keluar.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="index.php?page=logout">Keluar</a>
            </div>
        </div>
    </div>
</div>

<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-ndub7Wp6y-DZtdfCFqd-smlpXPnoGBs&callback=initMap" type="text/javascript"></script> -->

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<script src="js/index.js"></script>
<!-- <script src="js/index.js"></script> -->

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>


<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>
<script>
    var xValues = [2015, 2016, 2017, 2018, 2019, 2020];

    new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                data: [
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2015'  AND data_hasil_klasifikasi.kondisi_hasil='B'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2016'  AND data_hasil_klasifikasi.kondisi_hasil='B'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2017'  AND data_hasil_klasifikasi.kondisi_hasil='B'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2018'  AND data_hasil_klasifikasi.kondisi_hasil='B'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2019'  AND data_hasil_klasifikasi.kondisi_hasil='B'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2020'  AND data_hasil_klasifikasi.kondisi_hasil='B'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>
                ],
                borderColor: "rgba(87, 184, 100, 1)",
                fill: false
            }, {
                data: [
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2015'  AND data_hasil_klasifikasi.kondisi_hasil='S'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2016'  AND data_hasil_klasifikasi.kondisi_hasil='S'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2017'  AND data_hasil_klasifikasi.kondisi_hasil='S'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2018'  AND data_hasil_klasifikasi.kondisi_hasil='S'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2019'  AND data_hasil_klasifikasi.kondisi_hasil='S'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2020'  AND data_hasil_klasifikasi.kondisi_hasil='S'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>
                ],
                borderColor: "rgba(13, 152, 186,1)",
                fill: false
            }, {
                data: [
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2015'  AND data_hasil_klasifikasi.kondisi_hasil='RR'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2016'  AND data_hasil_klasifikasi.kondisi_hasil='RR'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2017'  AND data_hasil_klasifikasi.kondisi_hasil='RR'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2018'  AND data_hasil_klasifikasi.kondisi_hasil='RR'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2019'  AND data_hasil_klasifikasi.kondisi_hasil='RR'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2020'  AND data_hasil_klasifikasi.kondisi_hasil='RR'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>
                ],
                borderColor: "yellow",
                fill: false
            }, {
                data: [
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2015'  AND data_hasil_klasifikasi.kondisi_hasil='RB'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2016'  AND data_hasil_klasifikasi.kondisi_hasil='RB'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2017'  AND data_hasil_klasifikasi.kondisi_hasil='RB'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2018'  AND data_hasil_klasifikasi.kondisi_hasil='RB'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2019'  AND data_hasil_klasifikasi.kondisi_hasil='RB'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2020'  AND data_hasil_klasifikasi.kondisi_hasil='RB'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>
                ],
                borderColor: "red",
                fill: false
            }]
        },
        options: {
            legend: {
                display: false
            }
        }
    });
</script>
<!-- <script>
    var xValues = [2015, 2016, 2017, 2018, 2019, 2020];

    new Chart("myChart", {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                data: [
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2015'  AND data_hasil_klasifikasi.kondisi_hasil='B'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2016'  AND data_hasil_klasifikasi.kondisi_hasil='B'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2017'  AND data_hasil_klasifikasi.kondisi_hasil='B'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2018'  AND data_hasil_klasifikasi.kondisi_hasil='B'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2019'  AND data_hasil_klasifikasi.kondisi_hasil='B'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2020'  AND data_hasil_klasifikasi.kondisi_hasil='B'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>
                ],
                borderColor: "rgba(87, 184, 100, 1)",
                fill: false
            }, {
                data: [
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2015'  AND data_hasil_klasifikasi.kondisi_hasil='S'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2016'  AND data_hasil_klasifikasi.kondisi_hasil='S'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2017'  AND data_hasil_klasifikasi.kondisi_hasil='S'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2018'  AND data_hasil_klasifikasi.kondisi_hasil='S'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2019'  AND data_hasil_klasifikasi.kondisi_hasil='S'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2020'  AND data_hasil_klasifikasi.kondisi_hasil='S'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>
                ],
                borderColor: "rgba(13, 152, 186,1)",
                fill: false
            }, {
                data: [
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2015'  AND data_hasil_klasifikasi.kondisi_hasil='RR'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2016'  AND data_hasil_klasifikasi.kondisi_hasil='RR'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2017'  AND data_hasil_klasifikasi.kondisi_hasil='RR'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2018'  AND data_hasil_klasifikasi.kondisi_hasil='RR'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2019'  AND data_hasil_klasifikasi.kondisi_hasil='RR'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2020'  AND data_hasil_klasifikasi.kondisi_hasil='RR'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>
                ],
                borderColor: "yellow",
                fill: false
            }, {
                data: [
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2015'  AND data_hasil_klasifikasi.kondisi_hasil='RB'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2016'  AND data_hasil_klasifikasi.kondisi_hasil='RB'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2017'  AND data_hasil_klasifikasi.kondisi_hasil='RB'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2018'  AND data_hasil_klasifikasi.kondisi_hasil='RB'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2019'  AND data_hasil_klasifikasi.kondisi_hasil='RB'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem='2020'  AND data_hasil_klasifikasi.kondisi_hasil='RB'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>
                ],
                borderColor: "red",
                fill: false
            }]
        },
        options: {
            legend: {
                display: false
            }
        }
    });
</script> -->
<!-- <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Baik", "Sedang", "Rusak Ringan", "Rusak Berat"],
            datasets: [{
                label: 'Grafik Kondisi Jalan',
                data: [
                    <?php
                    $jumlah_Baik = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem  AND data_hasil_klasifikasi.kondisi_hasil='B'");
                    echo mysqli_num_rows($jumlah_Baik);
                    ?>,
                    <?php
                    $jumlah_Sedang = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem AND data_hasil_klasifikasi.kondisi_hasil='S'");
                    echo mysqli_num_rows($jumlah_Sedang);
                    ?>,
                    <?php
                    $jumlah_RusakRingan = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem AND data_hasil_klasifikasi.kondisi_hasil='RR'");
                    echo mysqli_num_rows($jumlah_RusakRingan);
                    ?>,
                    <?php
                    $jumlah_RusakBerat = mysqli_query($conn, "SELECT datajalan.*, data_hasil_klasifikasi.*
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem AND data_hasil_klasifikasi.kondisi_hasil='RB'");
                    echo mysqli_num_rows($jumlah_RusakBerat);
                    ?>
                ],
                backgroundColor: [
                    'green',
                    'blue',
                    'yellow',
                    'red'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script> -->