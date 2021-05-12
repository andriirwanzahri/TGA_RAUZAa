<?php
include '../../koneksi.php';
include "../excel_reader2.php";
// upload file xls
$target = basename($_FILES['datatraining']['name']);
move_uploaded_file($_FILES['datatraining']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
$cham = chmod($_FILES['datatraining']['name'], 0777);

if ($cham) {

	// mengambil isi file xls
	$data = new Spreadsheet_Excel_Reader($_FILES['datatraining']['name'], false);
	// menghitung jumlah baris data yang ada
	$jumlah_baris = $data->rowcount($sheet_index = 0);

	// jumlah default data yang berhasil di import
	$berhasil = 0;
	for ($i = 2; $i <= $jumlah_baris; $i++) {

		// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing

		$ura_dukung     = $data->val($i, 1);
		$namaLintas = $data->val($i, 2);
		$panjangRuas = $data->val($i, 3);
		$jns_pen = $data->val($i, 4);
		$tanah_krikil = $data->val($i, 5);
		$aspal = $data->val($i, 6);
		$rigit = $data->val($i, 7);
		$kondisi = $data->val($i, 8);

		if (
			$ura_dukung != ""
			&& $namaLintas != ""
			&& $panjangRuas != ""
			&& $jns_pen != ""
			&& $tanah_krikil != ""
			&& $aspal != ""
			&& $rigit != ""
			&& $kondisi != ""
		) {
			// input data ke database (table data_trainig)
			mysqli_query($conn, "INSERT into dataset values(
			$i,
			'$ura_dukung',
			'$namaLintas',
			'$panjangRuas',
			'$jns_pen',
			'$tanah_krikil',
			'$aspal',
			'$rigit',
			'$kondisi'
			)");

			// menghitung precocessing data panjang ruas
			if ($panjangRuas >= 23 and $panjangRuas <= 25) {
				$pR = "SPAS";
			} else if ($panjangRuas >= 20) {
				$pR = "SPA";
			} else if ($panjangRuas >= 18) {
				$pR = "CP";
			} elseif ($panjangRuas >= 15) {
				$pR = "PA";
			} elseif ($panjangRuas >= 13) {
				$pR = "S";
			} elseif ($panjangRuas >= 10) {
				$pR = "CS";
			} elseif ($panjangRuas >= 8) {
				$pR = "SS";
			} elseif ($panjangRuas >= 5) {
				$pR = "PE";
			} elseif ($panjangRuas >= 3) {
				$pR = "SPE";
			} elseif ($panjangRuas >= 0) {
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



			// menghitung precocessing data Tanah Kerikil
			$persen = ($kondisi / $panjangRuas) * 100;
			if ($persen >= 75 and $persen <= 100) {
				$kon = "B";
			} else if ($persen >= 50) {
				$kon = "S";
			} else if ($persen >= 25) {
				$kon = "RR";
			} elseif ($persen >= 0) {
				$kon = "RB";
			} else {
				$kon = "Panjang tidak terdeteksi";
			}

			// menghitung precocessing data uradukung
			if ($ura_dukung == "Kawasan Cepat Tumbuh") {
				$ura = "KCT";
			} elseif ($ura_dukung == "Kawasan Agropolitan") {
				$ura = "KA";
			} elseif ($ura_dukung == "Kawasan Minapolitan") {
				$ura = "KM";
			} elseif ($ura_dukung == "Kawasan Minapolitan dan Kawasan Industri") {
				$ura = "KMI";
			} elseif ($ura_dukung == "Kawasan Pertanian / Kawasan Perikanan dan Kawasan Hutan Produksi") {
				$ura = "KP";
			}

			// menghitung precocessing data Nama Lintas
			if ($namaLintas == "Lintas Jalan Kabupaten") {
				$NL = "LJK";
			} else if ($namaLintas == "Lintas Jalan Nasional") {
				$NL = "LJN";
			} else if ($namaLintas == "Lintas Jalan Provinsi") {
				$NL = "LJP";
			} else {
				$NL = "Panjang tidak terdeteksi";
			}

			if ($jns_pen == "pemeliharaan Berkala") {
				$JP = "PB";
			} else if ($jns_pen == "Peningkatan") {
				$JP = "P";
			} else {
				$JP = "Panjang tidak terdeteksi";
			}




			$result = mysqli_query($conn, "INSERT into datapreprocessing values(
			$i,
			'$ura',
			'$NL',
			'$pR',
			'$JP',
			'$tK',
			'$aspl',
			'$rgt',
			'$kon'
			)");
			$berhasil++;
			if ($result) {
				header("location:../../index.php?page=datatraining&berhasil=$berhasil");
			} else {
				header("location:../../index.php?page=datatraining&gagal=0");
			}
		}
	}
} else {
	header("location:../../index.php?page=datatraining&gagal=tidak ada file");
}



// hapus kembali file .xls yang di upload tadi
unlink($_FILES['datatraining']['name']);

// alihkan halaman ke index.php
