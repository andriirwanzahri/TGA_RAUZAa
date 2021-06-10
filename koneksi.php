<?php
$conn = mysqli_connect("localhost", "root", "", "mining");

function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}
function redairec($table, $field, $url)
{
	global $conn;
	$qry = mysqli_query($conn, "SELECT * FROM $table WHERE $field='$url'");
	$pecah = mysqli_fetch_array($qry);
	return $pecah;
}


function tambah($data)
{
	global $conn;
	$namajalan = htmlspecialchars($data["namajalan"]);
	$desa = htmlspecialchars($data["desa"]);
	$provinsi = htmlspecialchars($data["provinsi"]);
	$uradukung = $data["uradukung"];
	$kecamatan = htmlspecialchars($data["kecamatan"]);
	$namalintas = $data["namalintas"];
	$panjang = $data["panjang"];
	$jnspen = $data["jnspen"];
	$tanah_krikil = $data["tanahkrikil"];
	$aspal = $data["aspal"];
	$rigit = $data["rigit"];
	$konbaik = $data["konbaik"];
	$konsedang = $data["konsedang"];
	$latitude = $data["latitude"];
	$longitude = $data["longitude"];

	// upload gambar
	$gambar1 = upload('gambar1');
	if (!$gambar1) {
		return false;
	}
	$gambar2 = upload('gambar2');
	if (!$gambar2) {
		return false;
	}

	$query = "INSERT INTO datajalan
				VALUES
			  ('', 
			  '$namajalan',
			   '$desa',
			    '$provinsi',
				 '$uradukung',
				 '$kecamatan',
				 '$namalintas',
				 '$panjang',
				 '$jnspen',
				 '$tanah_krikil',
				 '$aspal',
				 '$rigit',
				 '$konbaik',
				 '$konsedang',
				 '$gambar1',
				 '$gambar2',
				 '$latitude',
				 '$longitude'
				 )";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function tAspirasi($data)
{
	global $conn;
	$namaUser = htmlspecialchars($data["nama"]);
	$idjalan = $data["idjalan"];
	$komentar = htmlspecialchars($data["aspirasi"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$email = htmlspecialchars($data["email"]);

	$lampiran = uploadLampiran();
	if (!$lampiran) {
		return false;
	}
	$query = "INSERT INTO aspirasi
				VALUES
			  ('', 
			  '$namaUser',
			  '$alamat',
			  '$email',
			   '$idjalan',
			    now(),
				'$lampiran',
				'$komentar'
				 )";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapusJalan($id)
{
	global $conn;
	$id = $_GET['hapus'];
	$as = mysqli_query($conn, "SELECT * FROM aspirasi WHERE idjalan='$id'");
	$data = mysqli_num_rows($as);
	if ($data > 0) {
		$query = "DELETE FROM datajalan WHERE id='$id'";
		$aspirasi = "DELETE FROM aspirasi WHERE idjalan='$id'";
		mysqli_query($conn, $query);
		mysqli_query($conn, $aspirasi);
	} else {
		$query = "DELETE FROM datajalan WHERE id='$id'";
		mysqli_query($conn, $query);
	}

	return mysqli_affected_rows($conn);
}

function uploadLampiran()
{
	$namaFile = $_FILES['lampiran']['name'];
	$ukuranFile = $_FILES['lampiran']['size'];
	$error = $_FILES['lampiran']['error'];
	$tmpName = $_FILES['lampiran']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if ($error === 4) {
		echo "<script>
				alert('Masukkan lampiran terlebih dahulu!');
			  </script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
			  </script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, '../../img/aspirasi/' . $namaFileBaru);

	return $namaFileBaru;
}


function upload($gambar)
{
	$namaFile = $_FILES[$gambar]['name'];
	$ukuranFile = $_FILES[$gambar]['size'];
	$error = $_FILES[$gambar]['error'];
	$tmpName = $_FILES[$gambar]['tmp_name'];


	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
			  </script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($ukuranFile > 1000000) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/jalan/' . $namaFileBaru);

	return $namaFileBaru;
}
//alert PHP
function display_error($msg)
{
	echo "<div class='alert alert-danger alert-dismissable'>
            
            <h4><i class='icon fa fa-ban'></i> Error! </h4>
            " . $msg . "
        </div>";
}

function display_success($msg)
{
	echo "<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4><i class='icon fa fa-check'></i> Success. </h4>
                    " . $msg . "
                  </div>";
}

function ubahdataset($data)
{
	global $conn;

	$id = $data["id"];
	$nrp = htmlspecialchars($data["nama"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jalan = htmlspecialchars($data["jalan"]);
	// $gambarLama = htmlspecialchars($data["gambarLama"]);

	// // cek apakah user pilih gambar baru atau tidak
	// if ($_FILES['gambar']['error'] === 4) {
	// 	$gambar = $gambarLama;
	// } else {
	// 	$gambar = upload();
	// }


	// $query = "UPDATE dataset SET
	// 			nrp = '$nama',
	// 			nama = '$nama',
	// 			email = '$email',
	// 			gambar = '$gambar'
	// 		  WHERE id = $id
	// ";

	// mysqli_query($conn, $query);

	// return mysqli_affected_rows($conn);
}

function ubahdatajalan($data)
{
	global $conn;

	$id = $data["id"];
	$namajalan = htmlspecialchars($data["namajalan"]);
	$desa = htmlspecialchars($data["desa"]);
	$provinsi = htmlspecialchars($data["provinsi"]);
	$uradukung = $data["uradukung"];
	$kecamatan = htmlspecialchars($data["kecamatan"]);
	$namalintas = $data["namalintas"];
	$panjang = $data["panjang"];
	$jnspen = $data["jnspen"];
	$tanah_krikil = $data["tanahkrikil"];
	$aspal = $data["aspal"];
	$rigit = $data["rigit"];
	$konbaik = $data["konbaik"];
	$konsedang = $data["konsedang"];
	$gambar1 = $data["gambarLama1"];
	$gambar2 = $data["gambarLama2"];
	$latitude = $data["latitude"];
	$longitude = $data["longitude"];
	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar1']['error'] === 4) {
		$gambarbaru1 = $gambar1;
	} else {
		$gambarbaru1 = upload('gambar1');
	}
	if ($_FILES['gambar2']['error'] === 4) {
		$gambarbaru2 = $gambar2;
	} else {
		$gambarbaru2 = upload('gambar2');
	}

	$query = "UPDATE datajalan SET
				namajalan = '$namajalan',
				desa = '$desa',
				provinsi = '$provinsi',
				uradukung = '$uradukung',
				kecamatan = '$kecamatan',
				namalintas = '$namalintas',
				panjang = '$panjang',
				jnspen = '$jnspen',
				tanahkrikil = '$tanah_krikil',
				aspal = '$aspal',
				rigit = '$rigit',
				thn_pem = '$konbaik',
				mandor = '$konsedang',
				gambar1 = '$gambarbaru1',
				gambar2 = '$gambarbaru2',
				latitude = '$latitude',
				longitude = '$longitude'
			  WHERE id = $id
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
function registrasi($data)
{
	global $conn;
	$nama = $data["nama"];
	$alamat = $data["alamat"];
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('username sudah terdaftar!')
		      </script>";
		return false;
	}


	// cek konfirmasi password
	if ($password !== $password2) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan userbaru ke database
	mysqli_query($conn, "INSERT INTO user VALUES('','$nama','$username', '$password','$alamat','3','default.svg')");

	return mysqli_affected_rows($conn);
}
