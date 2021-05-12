<?php
include 'koneksi.php';
$datajalan = query("SELECT * FROM datajalan");
?>
<div class="card shadow mb-4 mt-3">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">Data Jalan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Ura_Dukung</th>
                        <th>Kecamatan</th>
                        <th>Nama Lintas</th>
                        <th>Panjang Ruas</th>
                        <th>Jns_Pen</th>
                        <th>Panjang Tanah_Kri</th>
                        <th>Aspal</th>
                        <th>rigit</th>
                        <th>Target</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($datajalan as $d) :
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['ura_dukung']; ?></td>
                            <td><?php echo $d['kecamatan']; ?></td>
                            <td><?php echo $d['namaLintas']; ?></td>
                            <td><?php echo $d['panjangRuas']; ?></td>
                            <td><?php echo $d['jns_pen']; ?></td>
                            <td><?php echo $d['tanah_krikil']; ?></td>
                            <td><?php echo $d['aspal']; ?></td>
                            <td><?php echo $d['rigit']; ?></td>
                            <td><?php echo $d['target']; ?></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>