<?php
include 'koneksi.php';
$datajalan = query("SELECT * FROM datajalan");
?>
<div>
    <div class="card-header py-3">
        <?php if ($_SESSION['login']['level'] == '1') : ?>
            <a href="#" class="btn btn-info float-right">Tambah Data</a>
        <?php endif; ?>
        <h6 class="m-0 font-weight-bold text-info">Data Jalan</h6>
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
                            <?php if ($_SESSION['login']['level'] == '1') : ?>
                                <td>
                                    <button>hapus</button>
                                    <button>edit</button>
                                    <a href="index.php?page=aspirasi&id=<?php echo $d['id']; ?>" class="btn btn-info">detail</a>
                                </td>
                            <?php else : ?>
                                <td>
                                    <a href="" class="btn btn-info">detail</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>