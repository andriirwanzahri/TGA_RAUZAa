<?php
include '../../koneksi.php';
include '../template/headeruser.php';
?>

<body class="bg-gradient-light">
    <div class="container card mt-5 shadow-lg">
        <div class="row">
            <div class="col-md-12 mt-3 mb-3">
                <a href="../halamanUtama" class="badge badge-pill badge-primary">Kembali</a>
            </div>
            <div class="col-md-12 mt-3 mb-3">
                <h1 class="text-center">Usulan Perbaikan Jalan </h1>
            </div>
            <table class='table table-bordered table-striped  table-hover'>
                <tr align='center' class="bg-warning">
                    <th>No</th>
                    <th>Nama Jalan</th>
                    <th>Desa</th>
                    <th>Kecamatan</th>
                    <th>tahun Usulan</th>
                    <!-- <th>Nama Penyusulan</th> -->
                </tr>
                <?php
                $no = 1;
                $sql = mysqli_query($conn, "SELECT datajalan.namajalan, datajalan.desa, datajalan.kecamatan,datausulan.tahunusulan, user.nama 
            FROM datajalan, datausulan,user WHERE datajalan.id=datausulan.idjalan AND user.id=datausulan.iduser");
                while ($row = mysqli_fetch_array($sql)) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>";
                    echo "<td>" . $row['namajalan'] . "</td>";
                    echo "<td>" . $row['desa'] . "</td>";
                    echo "<td>" . $row['kecamatan'] . "</td>";
                    echo "<td>" . $row['tahunusulan'] . "</td>";
                    // echo "<td>" . $row['nama'] . "</td>";
                    echo "</tr>";
                    $no++;
                }
                ?>
            </table>
        </div>
    </div>
</body>


<?php
include '../template/footeruser.php';
?>