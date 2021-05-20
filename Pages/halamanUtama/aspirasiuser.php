<?php
include '../template/headeruser.php';
include '../../koneksi.php';
$id = $_GET['id'];
$adm = redairec('datajalan', $id);
?>
<div class="container">
    <div class="row">

        <a href="../halamanUtama/datajalanuser.php" class="badge badge-pill badge-primary">Kembali</a>
    </div>
    <div class="row mt-0">

        <div class="col-xl-4 col-md-12 mb-8">

            <div class="card o-hidden border-0 shadow-lg ">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg col-xl-12 col-md-12 mb-8">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 ">Detail Jalan</h1>
                                </div>
                                <form class="user" method="post" action="">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Nama Jalan</label>
                                        <input type="text" class="form-control" value="<?php echo $adm['namajalan']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Nama Desa</label>

                                        <input type="text" class="form-control" value="<?php echo $adm['desa']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Provinsi</label>
                                        <input type="text" class="form-control" value="<?php echo $adm['provinsi']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Ura Dukung</label>
                                        <input type="text" class="form-control" value="<?php echo $adm['uradukung']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">kecamatan</label>
                                        <input type="text" class="form-control" value="<?php echo $adm['kecamatan']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Nama Lintas Jalan</label>
                                        <input type="text" class="form-control" value="<?php echo $adm['namalintas']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Panjang Jalan</label>
                                        <input type="text" class="form-control" value="<?php echo $adm['panjang']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Jenis Pembaharuan</label>
                                        <input type="text" class="form-control" value="<?php echo $adm['jnspen']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Tanah Krikil</label>
                                        <input type="text" class="form-control" value="<?php echo $adm['tanahkrikil']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Aspal</label>
                                        <input type="text" class="form-control" value="<?php echo $adm['aspal']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Rigit</label>
                                        <input type="text" class="form-control" value="<?php echo $adm['rigit']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">kondisi Baik</label>
                                        <input type="text" class="form-control" value="<?php echo $adm['konbaik']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Kondisi Sedang</label>
                                        <input type="text" class="form-control" value="<?php echo $adm['konsedang']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Kondsi Rusak Ringan</label>
                                        <input type="text" class="form-control" value="<?php echo $adm['konringan']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Kondisi Rusak Berat</label>
                                        <input type="text" class="form-control" value="<?php echo $adm['konrusak']; ?>" required>
                                    </div>
                                    <!-- <div class=" row">
                                        <div class="col-lg col-3">
                                            <input type="reset" class="btn btn-info btn-user btn-block" value="Bersihkan">
                                            </input>
                                        </div>
                                        <div class="col-lg col-3">
                                            <button type="submit" class="btn btn-info btn-user btn-block" id="tekan">
                                                Jalan
                                            </button>
                                        </div>
                                    </div> -->
                                </form>
                                <div class="text-center">
                                    <a class="small" href="#">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-8 col-md-12 mb-8">

            <div class="card o-hidden border-0 shadow-lg ">
                <div class="card-body">
                    <!-- Nested Row within Card Body -->
                    <center>
                        <div class="row">
                            <div class="col-lg col-xl-12 col-md-12 mb-8">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Aspirasi</h1>
                                </div>
                                <div class="scroll col-lg col-xl-12 col-md-12 mb-8">
                                    <h4 id="fat">User4</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita impedit natus totam doloribus dolorem laborum neque, eius dolorum alias deserunt facere veniam voluptas asperiores? Sunt, inventore assumenda! Laudantium, eveniet recusandae.</p>
                                    <h4 id="mdo">User5</h4>
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam possimus facilis maxime id sunt vel laudantium consequatur nam. Accusamus nobis veritatis hic magnam dolore quaerat explicabo quasi deserunt porro reprehenderit?</p>
                                    <h4 id="one">User6</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta distinctio ipsa, perspiciatis quidem doloremque velit voluptatem sequi iure nulla, ipsum, itaque assumenda delectus. Repellat quam architecto non. Officiis, molestias modi.</p>
                                    <h4 id="two">User7</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta distinctio ipsa, perspiciatis quidem doloremque velit voluptatem sequi iure nulla, ipsum, itaque assumenda delectus. Repellat quam architecto non. Officiis, molestias modi.</p>
                                    <h4 id="three">user9</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta distinctio ipsa, perspiciatis quidem doloremque velit voluptatem sequi iure nulla, ipsum, itaque assumenda delectus. Repellat quam architecto non. Officiis, molestias modi.</p>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Tambahkan Aspirasi</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <button class="btn btn-info float-right">Kirim</button>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include '../template/footeruser.php';
?>