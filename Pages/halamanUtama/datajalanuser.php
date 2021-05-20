<?php
include '../template/headeruser.php';
include '../../koneksi.php';

$datajalan = query("SELECT * FROM datajalan");
?>
<div class="container">

    <div>
        <div class="card-header py-3">
            <a href="../halamanUtama" class="badge badge-pill badge-primary">Kembali</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jalan</th>
                            <th>Desa</th>
                            <th>Provinsi</th>
                            <th>Kecamatan</th>
                            <th>Nama Lintas</th>
                            <th>Lainnya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($datajalan as $d) :
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d['namajalan']; ?></td>
                                <td><?php echo $d['desa']; ?></td>
                                <td><?php echo $d['provinsi']; ?></td>
                                <td><?php echo $d['kecamatan']; ?></td>
                                <td><?php echo $d['namalintas']; ?></td>
                                <td><a href="aspirasiuser.php?id=<?php echo $d['id']; ?>" class="btn btn-info">detail</a> </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include '../template/footeruser.php';
?>