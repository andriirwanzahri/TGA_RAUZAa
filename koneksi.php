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


function tambah($data, $keputusan, $id_rule_keputusan, $kodeJalan)
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

	// upload gambar
	$gambar1 = upload('gambar1');
	if (!$gambar1) {
		return false;
	}
	$gambar2 = upload('gambar2');
	if (!$gambar2) {
		return false;
	}
	// var_dump($keputusan, $id_rule_keputusan);
	// die;
	mysqli_query($conn, "INSERT INTO data_hasil_klasifikasi VALUES('','$kodeJalan','$keputusan','$id_rule_keputusan')");
	$query = "INSERT INTO datajalan
				VALUES
			  ('$kodeJalan', 
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
				 '$gambar2'
				 )";
	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);
}

function preprocessingdata(
	$conn,
	$uradukung,
	$namalintas,
	$panjang,
	$jnspen,
	$tanah_krikil,
	$aspal,
	$rigit
) {
	if ($panjang >= 23 and $panjang <= 25) {
		$pR = "SPAS";
	} else if ($panjang >= 20) {
		$pR = "SPA";
	} else if ($panjang >= 18) {
		$pR = "CP";
	} elseif ($panjang >= 15) {
		$pR = "PA";
	} elseif ($panjang >= 13) {
		$pR = "S";
	} elseif ($panjang >= 10) {
		$pR = "CS";
	} elseif ($panjang >= 8) {
		$pR = "SS";
	} elseif ($panjang >= 5) {
		$pR = "PE";
	} elseif ($panjang >= 3) {
		$pR = "SPE";
	} elseif ($panjang >= 0) {
		$pR = "SPES";
	} else {
		$pR = "Panjang tidak terdeteksi";
	}

	// menghitung precocessing data Tanah Kerikil
	if ($tanah_krikil >= 90 and $tanah_krikil <= 100) {
		$tK = "SPAS";
	} else if ($tanah_krikil >= 80) {
		$tK = "SPA";
	} else if ($tanah_krikil >= 70) {
		$tK = "CP";
	} elseif ($tanah_krikil >= 60) {
		$tK = "PA";
	} elseif ($tanah_krikil >= 50) {
		$tK = "S";
	} elseif ($tanah_krikil >= 40) {
		$tK = "CS";
	} elseif ($tanah_krikil >= 30) {
		$tK = "SS";
	} elseif ($tanah_krikil >= 20) {
		$tK = "PE";
	} elseif ($tanah_krikil >= 10) {
		$tK = "SPE";
	} elseif ($tanah_krikil >= 0) {
		$tK = "SPES";
	} else {
		$tK = "Panjang tidak terdeteksi";
	}

	// menghitung precocessing data Tanah Kerikil
	if ($aspal >= 90 and $aspal <= 100) {
		$aspl = "SPAS";
	} elseif ($aspal >= 80) {
		$aspl = "SPA";
	} elseif ($aspal >= 70) {
		$aspl = "CP";
	} elseif ($aspal >= 60) {
		$aspl = "PA";
	} elseif ($aspal >= 50) {
		$aspl = "S";
	} elseif ($aspal >= 40) {
		$aspl = "CS";
	} elseif ($aspal >= 30) {
		$aspl = "SS";
	} elseif ($aspal >= 20) {
		$aspl = "PE";
	} elseif ($aspal >= 10) {
		$aspl = "SPE";
	} elseif ($aspal >= 0) {
		$aspl = "SPES";
	} else {
		$aspl = "Panjang tidak terdeteksi";
	}

	// menghitung precocessing data Tanah Kerikil
	if ($rigit >= 90 and $rigit <= 100) {
		$rgt = "SPAS";
	} elseif ($rigit >= 80) {
		$rgt = "SPA";
	} elseif ($rigit >= 70) {
		$rgt = "CP";
	} elseif ($rigit >= 60) {
		$rgt = "PA";
	} elseif ($rigit >= 50) {
		$rgt = "S";
	} elseif ($rigit >= 40) {
		$rgt = "CS";
	} elseif ($rigit >= 30) {
		$rgt = "SS";
	} elseif ($rigit >= 20) {
		$rgt = "PE";
	} elseif ($rigit >= 10) {
		$rgt = "SPE";
	} elseif ($rigit >= 0) {
		$rgt = "SPES";
	} else {
		$rgt = "Panjang tidak terdeteksi";
	}


	// menghitung precocessing data uradukung
	if ($uradukung == "Kawasan Cepat Tumbuh") {
		$ura = "KCT";
	} elseif ($uradukung == "Kawasan Agropolitan") {
		$ura = "KA";
	} elseif ($uradukung == "Kawasan Minapolitan") {
		$ura = "KM";
	} elseif ($uradukung == "Kawasan Minapolitan dan Kawasan Industri") {
		$ura = "KMI";
	} elseif ($uradukung == "Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi") {
		$ura = "KP";
	}

	// menghitung precocessing data Nama Lintas
	if ($namalintas == "Lintas Jalan Kabupaten") {
		$NL = "LJK";
	} else if ($namalintas == "Lintas Jalan Nasional") {
		$NL = "LJN";
	} else if ($namalintas == "Lintas Jalan Provinsi") {
		$NL = "LJP";
	} else {
		$NL = "Panjang tidak terdeteksi";
	}

	if ($jnspen == "pemeliharaan Berkala") {
		$JP = "PB";
	} else if ($jnspen == "Peningkatan") {
		$JP = "P";
	} else {
		$JP = "Panjang tidak terdeteksi";
	}


	return array(
		'uradukung' => $ura,
		'namalintas' => $NL,
		'panjang' => $pR,
		'jnspen' => $JP,
		'tanah_krikil' => $tK,
		'aspal' => $aspl,
		'rigit' => $rgt
	);
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

function tambahusulan($data, $idjalan, $iduser)
{
	global $conn;
	$tahun = $data["tahun"];
	$result = mysqli_query($conn, "SELECT idjalan FROM datausulan WHERE idjalan = '$idjalan'");

	if (mysqli_fetch_assoc($result)) {
		echo "<div class='alert alert-info alert-dismissable' id='divAlert'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
	Jalan Sudah Pernah Di usulkan
		</div>";
		return false;
	}
	$query = "INSERT INTO datausulan
				VALUES
			  ('', 
			  '$idjalan',
			  '$iduser',
			  '$tahun'
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
	$dataklasiikasi = "DELETE FROM data_hasil_klasifikasi WHERE idjalan='$id'";
	mysqli_query($conn, $dataklasiikasi);
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

function hapususulan($id)
{
	global $conn;
	$id = $_GET['hapus'];
	$query = "DELETE FROM datausulan WHERE idjalan='$id'";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

// ====================================== FUNGSI UPLOAD =========================================================//
function uploadprofile()
{
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];
	// var_dump($namaFile);
	// die;
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

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

	return $namaFileBaru;
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

// ==============================================END FUNGSI UPLOAD ============================//

// ================================================= FUNGSI ALERT ================================//
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

// ==============================================END FUNGSI ALERT ==================================//

// ============================================ FUNGSI UBAH DATA =====================================//

function ubahdatajalan($data, $keputusan, $id_rule_keputusan)
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
	$thn_pem = $data["konbaik"];
	$mandor = $data["konsedang"];
	$gambar1 = $data["gambarLama1"];
	$gambar2 = $data["gambarLama2"];
	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar1']['error'] === 4) {
		$gambarbaru1 = $gambar1;
	} else {
		$gambarbaru1 = upload('gambar1');
		// unlink("img/jalan/$gambar1");
	}
	if ($_FILES['gambar2']['error'] === 4) {
		$gambarbaru2 = $gambar2;
	} else {
		$gambarbaru2 = upload('gambar2');
		// unlink("img/jalan/$gambar2");
	}
	// var_dump($id, $namajalan, $desa, $provinsi, $uradukung, $kecamatan, $namalintas, $panjang, $jnspen, $tanah_krikil, $aspal, $rigit, $thn_pem, $mandor, $gambarbaru1, $gambarbaru2);
	// die;

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
				thn_pem = '$thn_pem',
				mandor = '$mandor',
				gambar1 = '$gambarbaru1',
				gambar2 = '$gambarbaru2'
			  WHERE id = '$id'
			";

	mysqli_query($conn, "UPDATE data_hasil_klasifikasi SET kondisi_hasil='$keputusan',id_rule='$id_rule_keputusan' WHERE idjalan='$id'");
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function ubahprofile($data)
{
	global $conn;

	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$username = htmlspecialchars($data["username"]);
	$password = $data["password"];
	$level = $data["level"];
	$alamat = htmlspecialchars($data["alamat"]);
	$jk = htmlspecialchars($data["jk"]);
	$gambar = $data["gambarLama"];

	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar']['error'] === 4) {
		$gambarbaru1 = $gambar;
	} else {
		$gambarbaru1 = uploadprofile();
		unlink("img/$gambar");
	}

	$query = "UPDATE user SET
				nama = '$nama',
				username = '$username',
				password = '$password',
				alamat = '$alamat',
				level = '$level',
				jk = '$jk',
				gambar = '$gambarbaru1'
			  WHERE id = $id
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubahdatatahun($data)
{
	global $conn;

	$id = $data["id"];
	$tahun = $data["tahun"];
	$query = "UPDATE datausulan SET
				tahunusulan = '$tahun'
			  WHERE idjalan = '$id'
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


// =============================================== REGISTRASI =========================================
function registrasi($data)
{
	global $conn;
	$nama = $data["nama"];
	$alamat = $data["alamat"];
	$jk = $data["jk"];
	$level = $data["level"];
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
	mysqli_query($conn, "INSERT INTO user VALUES('','$nama','$username', '$password','$alamat','$level','$jk','default.svg')");

	return mysqli_affected_rows($conn);
}
