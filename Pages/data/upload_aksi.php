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

		if ($ura_dukung != "" && $namaLintas != "" && $panjangRuas != "" && $jns_pen != "" && $tanah_krikil != "" && $aspal != "" && $rigit != "" && $kondisi != "") {
			// input data ke database (table data_trainig)
			mysqli_query($conn, "INSERT into dataset values($i,'$ura_dukung','$namaLintas','$panjangRuas','$jns_pen','$tanah_krikil','$aspal','$rigit','$kondisi')");
			// menghitung precocessing data KONDIS /TARGET
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
			// mengubah preprocessing semua
			$preproces = preprocessingdata($conn, $ura_dukung, $namaLintas, $panjangRuas, $jns_pen, $tanah_krikil, $aspal, $rigit);
			$ura = $preproces['uradukung'];
			$NL = $preproces['namalintas'];
			$pR = $preproces['panjang'];
			$JP = $preproces['jnspen'];
			$tK = $preproces['tanah_krikil'];
			$aspl = $preproces['aspal'];
			$rgt = $preproces['rigit'];
			//masukkan data  pada table  data preprocessing
			$result = mysqli_query($conn, "INSERT into datapreprocessing values(
			$i,'$ura','$NL','$pR','$JP','$tK','$aspl','$rgt','$kon')");
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
