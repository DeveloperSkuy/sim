<?php 
	session_start();
	include "../koneksi.php";

	$no_diagnosa = @mysqli_real_escape_string($conn, $_POST['no_diagnosa']);
	$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);
	$tgl_diagnosa = @mysqli_real_escape_string($conn, $_POST['tgl_diagnosa']);

	$nama_pas = @mysqli_real_escape_string($conn, $_POST['nama_pas']);

	$nomor_rm = @mysqli_real_escape_string($conn, $_POST['nomor_rm']);
		
	$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
	$code = @mysqli_real_escape_string($conn, $_POST['code']);
	$diagnosa = @mysqli_real_escape_string($conn, $_POST['diagnosa']);
	$deskripsi = @mysqli_real_escape_string($conn, $_POST['deskripsi']);
	$subjective = @mysqli_real_escape_string($conn, $_POST['subjective']);
	$objective = @mysqli_real_escape_string($conn, $_POST['objective']);
	$assesment = @mysqli_real_escape_string($conn, $_POST['assesment']);
	$plan = @mysqli_real_escape_string($conn, $_POST['plan']);
	$nm_dokter = @mysqli_real_escape_string($conn, $_POST['nm_dokter']);

$goldarah = @mysqli_real_escape_string($conn, $_POST['goldarah']);
		$tekanan_darah = @mysqli_real_escape_string($conn, $_POST['tekanan_darah']);
		$pekerjaan = @mysqli_real_escape_string($conn, $_POST['pekerjaan']);
		$istirahat = @mysqli_real_escape_string($conn, $_POST['istirahat']);
		$berat_badan = @mysqli_real_escape_string($conn, $_POST['berat_badan']);
	$tinggi_badan = @mysqli_real_escape_string($conn, $_POST['tinggi_badan']);
	$temp = @mysqli_real_escape_string($conn, $_POST['temp']);
	$butawarna = @mysqli_real_escape_string($conn, $_POST['butawarna']);
	$pemeriksaan = @mysqli_real_escape_string($conn, $_POST['pemeriksaan']);
$terapi = @mysqli_real_escape_string($conn, $_POST['terapi']);


	$id_pegawai =  $_SESSION['id_peg'];

	$query = "INSERT INTO tbl_diagnosa VALUES('$no_diagnosa', '$no_daftar', '$tgl_diagnosa','$nm_dokter','$nama_pas',  '$nomor_rm','$pekerjaan', '$tgl_lahir', '$code', '$diagnosa','$deskripsi', '$tinggi_badan','$berat_badan','$tekanan_darah','$temp','$goldarah','$pemeriksaan','$terapi','$istirahat','$butawarna', '$id_pegawai')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>