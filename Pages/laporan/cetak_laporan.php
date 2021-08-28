<?php
include "../../koneksi.php";
$dari = $_POST['dari'];
$sampai = $_POST['sampai'];
// var_dump($data);
// die;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=Cetak Laporan, initial-scale=1.0">
    <title>Cetak</title>
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../css/custom.css" rel="stylesheet">
</head>

<body>
    <div class="super_sub_content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3 mb-3">
                    <h1 class="text-center">Hasil Klasifikasi Jalan</h1>
                </div>
                <table style='border: 2px;' class='table table-bordered table-striped  table-hover'>
                    <tr align='center'>
                        <th>No</th>
                        <th>Tahun </th>
                        <th>Nama Jalan </th>
                        <th>Kondisi Jalan</th>
                        <!-- <th>id_rule</th> -->
                    </tr>
                    <?php
                    $no = 1;
                    $sql = mysqli_query($conn, "SELECT datajalan.namajalan,datajalan.thn_pem, data_hasil_klasifikasi.kondisi_hasil, data_hasil_klasifikasi.id_rule
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan AND datajalan.thn_pem BETWEEN $dari AND $sampai ORDER BY datajalan.thn_pem ASC");
                    while ($row = mysqli_fetch_array($sql)) {
                        if ($row['kondisi_hasil'] == "B") {
                            $kondisi = "Baik";
                        } elseif ($row['kondisi_hasil'] == "S") {
                            $kondisi = "Sedang";
                        } elseif ($row['kondisi_hasil'] == "RR") {
                            $kondisi = "Rusak Ringan";
                        } elseif ($row['kondisi_hasil'] == "RB") {
                            $kondisi = "Rusak Berat";
                        }
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . $row['thn_pem'] . "</td>";
                        echo "<td>" . $row['namajalan'] . "</td>";
                        echo "<td>" . $kondisi . "</td>";
                        // echo "<td>" . $row['id_rule'] . "</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
<script>
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
</script>




<script>
    window.print();
</script>