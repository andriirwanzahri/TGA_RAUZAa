<?php
include "../../koneksi.php";
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
    SELECT * FROM nama_tabel
    WHERE tanggal BETWEEN $_post['tgl_awal'] AND '" . $_post['tgl_akhir'] . "'
    <div class="super_sub_content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3 mb-3">
                    <h1 class="text-center">Hasil Klasifikasi Jalan</h1>
                </div>
                <table style='border: 2px;' class='table table-bordered table-striped  table-hover'>
                    <tr align='center'>
                        <th>No</th>
                        <th>Nama Jalan </th>
                        <th>Kondisi Jalan</th>
                        <th>id_rule</th>
                    </tr>
                    <?php
                    $no = 1;
                    $sql = mysqli_query($conn, "SELECT datajalan.namajalan, data_hasil_klasifikasi.kondisi_hasil, data_hasil_klasifikasi.id_rule
                    FROM datajalan, data_hasil_klasifikasi
                    WHERE datajalan.id=data_hasil_klasifikasi.idjalan");
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
                        echo "<td>" . $row['namajalan'] . "</td>";
                        echo "<td>" . $kondisi . "</td>";
                        echo "<td>" . $row['id_rule'] . "</td>";
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
    window.print();
</script>