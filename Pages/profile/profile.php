<?php
include 'koneksi.php';
$id = $_SESSION['login']['id'];
$result = mysqli_query($conn, "SELECT * FROM user WHERE id='$id'");
$data = mysqli_fetch_assoc($result);
?>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-8 ml-auto mr-auto">
            <div class="card o-hidden border-0 shadow  mb-3">
                <div class="container mb-5">
                    <div class="profile mt-3">
                        <center>
                            <div class="avatar">
                                <img src="img/default.svg" alt="Circle Image" width="200px" class="img-raised rounded-circle img-fluid">
                            </div>
                            <div class="name">
                            </div>
                        </center>
                    </div>
                    <div data-spy="scroll" data-target=".navbar" data-offset="50" style="position: relative;">
                        <table>
                            <tr>
                                <td>Bidang : <?= $data['nama']; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat : <?= $data['alamat']; ?></td>
                            </tr>
                            <tr>
                                <td>Username : <?= $data['username']; ?></td>
                            </tr>
                            <tr>
                                <td>Level : <?= $data['level']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <a href="index.php?page=ubahprofile" class="btn btn-info float-right">Ubah Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>