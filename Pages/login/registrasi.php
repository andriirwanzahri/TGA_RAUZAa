<?php
require 'koneksi.php';

if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
        echo "<script>
				alert('user baru berhasil ditambahkan!');
			  </script>";
    } else {
        echo mysqli_error($conn);
    }
}
if (isset($_POST['tambah'])) :
?>
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block ">
                        <center><img src="img/pnl.png" width="400" height="400"></center>
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Daftar Pengguna!</h1>
                            </div>
                            <form action="" method="post" class="user">

                                <div class="form-group">
                                    <input type="text" name="nama" class="form-control" id="exampleInputEmail" placeholder="Nama lengkap" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" id="exampleInputEmail" placeholder="username" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="alamat" class="form-control" id="exampleInputEmail" placeholder="Alamat" required>
                                </div>
                                <div class="form-group">
                                    <label for="jk">Jenis Kelamin:</label>
                                    <select name="jk" class="form-control" id="jk">
                                        <option value="laki-laki">Laki-Laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="level">Level:</label>
                                    <select name="level" class="form-control" id="level">
                                        <option value="1">Admin</option>
                                        <option value="2">Petugas Lapangan</option>
                                        <option value="3">Kepala Bidang</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="password2" class="form-control" id="exampleRepeatPassword" placeholder="Konfirmasi Password" required>
                                    </div>
                                </div>
                                <button type="text" name="register" class="btn btn-primary btn-user btn-block">
                                    Daftar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif (!isset($_POST['tambah'])) :
?>
    <div class="container-fluid">
        <!-- Pages/data/upload_aksi.php -->
        <div class="card mt-3">
            <div class="card-header py-1 mt-3">
                <!-- Tombol hapus Tambah data training -->
                <?php
                if (!empty($pesan_error)) {
                    display_error($pesan_error);
                }
                if (!empty($pesan_success)) {
                    display_success($pesan_success);
                }
                ?>
                <form action="" method="post">
                    <button type="submit" name="tambah" class="btn btn-danger float-right">Tambah Pengguna</button>
                </form>
                <!-- End Tombol data training -->
                <h5 class="font-weight-bold text-primary">Data Pengguna</h5>
            </div>
            <div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>username</th>
                                <th>alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>level</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $data = mysqli_query($conn, "SELECT * FROM user");
                            while ($d = mysqli_fetch_array($data)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $d['nama']; ?></td>
                                    <td><?php echo $d['username']; ?></td>
                                    <td><?php echo $d['alamat']; ?></td>
                                    <td><?php echo $d['jk']; ?></td>
                                    <td><?php echo $d['level']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
endif;
?>