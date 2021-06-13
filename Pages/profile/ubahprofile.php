<?php
include 'koneksi.php';
$id = $_SESSION['login']['id'];
$result = mysqli_query($conn, "SELECT * FROM user WHERE id='$id'");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    if (ubahprofile($_POST) > 0) {
        echo '
        <script>
            location.replace("index.php?page=ubahprofile&pesan_success=Profile berhasil di ubah");
        </script>';
    } else {
        echo '
        <script>
            location.replace("index.php?page=ubahprofile&pesan_error=Profile gagal di ubah");
        </script>';
    }
}

?>
<div class="row">
    <div class="col-md-6  ml-auto mr-auto">
        <div class="card mt-3">
            <div class="card-header">
                Ubah Profile
            </div>
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nama User:</label>
                                    <input type="hidden" name="id" value="<?= $id; ?>">
                                    <input type="hidden" name="password" value="<?= $data['password']; ?>">
                                    <input type="hidden" name="gambarLama" value="<?= $data['gambar']; ?>">
                                    <input type="hidden" name="level" value="<?= $data['level']; ?>">
                                    <input type="text" name="nama" value="<?= $data['nama']; ?>" class="form-control" id="recipient-name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Nama Username:</label>
                                    <input type="text" name="username" value="<?= $data['username']; ?>" class="form-control" id="recipient-name" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Alamat:</label>
                                    <input type="text" name="alamat" value="<?= $data['alamat']; ?>" class="form-control" id="recipient-name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Jenis Kelamin:</label>
                                    <input type="text" name="desa" value="Laki-Laki" class="form-control" id="recipient-name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <center>
                                        <div class="shadow-lg">
                                            <img src="img/<?= $data['gambar']; ?>" width='160px' alt="Circle Image" class="img-raised rounded-circle img-fluid">
                                        </div>
                                    </center>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="gambar" id="customFile">
                                        <label class="custom-file-label" for="customFile">Pilih Gambar profile</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" name="submit">Ubah</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>