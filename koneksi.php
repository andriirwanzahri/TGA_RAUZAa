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
function redairec($table, $url)
{
	global $conn;
	$qry = mysqli_query($conn, "SELECT * FROM $table WHERE id='$url'");
	$pecah = mysqli_fetch_array($qry);
	return $pecah;
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
	$konringan = $data["konringan"];
	$konrusak = $data["konrusak"];
	$latitude = $data["latitude"];
	$longitude = $data["longitude"];

	// // upload gambar
	// $gambar = upload();
	// if (!$gambar) {
	// 	return false;
	// }

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
				 '$konringan',
				 '$konrusak',
				 '$latitude',
				 '$longitude'
				 )";
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
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}


	$query = "UPDATE dataset SET
				nrp = '$nama',
				nama = '$nama',
				email = '$email',
				gambar = '$gambar'
			  WHERE id = $id
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
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
	$konringan = $data["konringan"];
	$konrusak = $data["konrusak"];
	$latitude = $data["latitude"];
	$longitude = $data["longitude"];

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
				konbaik = '$konbaik',
				konsedang = '$konsedang',
				konrigan = '$konringan',
				konrusak = '$konrusak',
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
	mysqli_query($conn, "INSERT INTO user VALUES('','$nama','$username', '$password','$alamat','3','default.png')");

	return mysqli_affected_rows($conn);
}
