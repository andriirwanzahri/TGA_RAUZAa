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
                                <img src="img/<?= $data['gambar']; ?>" alt="Circle Image" width="200px" class="img-raised rounded-circle img-fluid">
                            </div>
                            <div class="name">
                            </div>
                        </center>
                    </div>
                    <div class="container mt-3">
                        <table class="table">
                            <tr>
                                <th>Bidang </th>
                                <td> : </td>
                                <td> <?= $data['nama']; ?></td>
                            </tr>
                            <tr>
                                <th>Alamat </th>
                                <td> : </td>
                                <td> <?= $data['alamat']; ?></td>
                            </tr>
                            <tr>
                                <th>Username </th>
                                <td> : </td>
                                <td> <?= $data['username']; ?></td>
                            </tr>
                            <tr>
                                <th>Level </th>
                                <td> : </td>
                                <td> <?= $data['level']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <a href="#" class="btn btn-success float-right"><i class=" fas fa-check-circle"></i> Ganti Password</a>
                    <a href="index.php?page=ubahprofile" class="btn btn-info float-right">Ubah Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>