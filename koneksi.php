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

function uploadDataSet($dataset)
{
	global $conn;
	include "Pages/excel_reader2.php";
	// mengambil isi file xls
	$data = new Spreadsheet_Excel_Reader($dataset['name'], false);
	// menghitung jumlah baris data yang ada
	$jumlah_baris = $data->rowcount($sheet_index = 0);

	// jumlah default data yang berhasil di import
	$berhasil = 0;
	for ($i = 2; $i <= $jumlah_baris; $i++) {

		// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing

		$ura_dukung     = $data->val($i, 1);
		$kecamatan  = $data->val($i, 2);
		$namaLintas = $data->val($i, 3);
		$panjangRuas = $data->val($i, 4);
		$jns_pen = $data->val($i, 5);
		$tanah_krikil = $data->val($i, 6);
		$aspal = $data->val($i, 7);
		$rigit = $data->val($i, 8);
		$kondisi = $data->val($i, 9);

		if (
			$ura_dukung != ""
			&& $kecamatan != ""
			&& $namaLintas != ""
			&& $panjangRuas != ""
			&& $jns_pen != ""
			&& $tanah_krikil != ""
			&& $aspal != ""
			&& $rigit != ""
			&& $kondisi != ""
		) {
			// input data ke database (table data_trainig)
			mysqli_query($conn, "INSERT into dataset values($i,'$ura_dukung',
			'$kecamatan',
			'$namaLintas',
			'$panjangRuas',
			'$jns_pen',
			'$tanah_krikil',
			'$aspal',
			'$rigit',
			'$kondisi'
			)");



			mysqli_query($conn, "INSERT into datapreprocessing values($i,'$ura_dukung',
			'$kecamatan',
			'$namaLintas',
			'$pR',
			'$jns_pen',
			'$tK',
			'$aspl',
			'$rgt',
			'$kon'
			)");
			$berhasil++;
		}
	}
}


function tambah($data)
{
	global $conn;

	$nrp = htmlspecialchars($data["nrp"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);

	// upload gambar
	$gambar = upload();
	if (!$gambar) {
		return false;
	}

	$query = "INSERT INTO mahasiswa
				VALUES
			  ('', '$nrp', '$nama', '$email', '$jurusan', '$gambar')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function upload()
{

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if ($error === 4) {
		echo "<script>
				alert('pilih gambar terlebih dahulu!');
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






function ubah($data)
{
	global $conn;

	$id = $data["id"];
	$nrp = htmlspecialchars($data["nrp"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}


	$query = "UPDATE mahasiswa SET
				nrp = '$nrp',
				nama = '$nama',
				email = '$email',
				jurusan = '$jurusan',
				gambar = '$gambar'
			  WHERE id = $id
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function cari($keyword)
{
	$query = "SELECT * FROM mahasiswa
				WHERE
			  nama LIKE '%$keyword%' OR
			  nrp LIKE '%$keyword%' OR
			  email LIKE '%$keyword%' OR
			  jurusan LIKE '%$keyword%'
			";
	return query($query);
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
	mysqli_query($conn, "INSERT INTO user VALUES('','$nama','$username', '$password','$alamat','1','default.png')");

	return mysqli_affected_rows($conn);
}
