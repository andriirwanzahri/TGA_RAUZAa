

<?php
include '../../koneksi.php';
include "../excel_reader2.php";
?>

<?php
// upload file xls
$target = basename($_FILES['datatraining']['name']);
move_uploaded_file($_FILES['datatraining']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['datatraining']['name'], 0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['datatraining']['name'], false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index = 0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i = 2; $i <= $jumlah_baris; $i++) {

	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing

	$namaRuas     = $data->val($i, 1);
	$thn_pen_ak   = $data->val($i, 2);
	$kecamatan  = $data->val($i, 3);
	$ura_dukung  = $data->val($i, 4);
	$tanah_krikil  = $data->val($i, 5);
	$aspal  = $data->val($i, 6);
	$jns_pen  = $data->val($i, 7);
	$kon_baik  = $data->val($i, 8);
	$kon_sedang  = $data->val($i, 9);
	$kon_rusakringan  = $data->val($i, 10);
	$kon_rusakberat  = $data->val($i, 11);


	if (
		$namaRuas != ""
		&& $thn_pen_ak != ""
		&& $kecamatan != ""
		&& $ura_dukung != ""
		&& $tanah_krikil != ""
		&& $aspal != ""
		&& $jns_pen != ""
		&& $kon_baik != ""
		&& $kon_sedang != ""
		&& $kon_rusakringan != ""
		&& $kon_rusakberat != ""
	) {
		// input data ke database (table data_pegawai)
		mysqli_query($conn, "INSERT into data_training values('','$namaRuas',
		'$thn_pen_ak',
		'$kecamatan',
		'$ura_dukung',
		'$tanah_krikil',
		'$aspal',
		'$jns_pen',
		'$kon_baik',
		'$kon_sedang',
		'$kon_rusakringan',
		'$kon_rusakberat'
		)");
		$berhasil++;
	}
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['datatraining']['name']);

// alihkan halaman ke index.php
header("location:../../index.php?page=datatraining&berhasil=$berhasil");
?>