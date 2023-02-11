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
		$temp = @mysqli_real_escape_string($conn, $_POST['temp']);
	$tekanan_darah = @mysqli_real_escape_string($conn, $_POST['tekanan_darah']);
	$respirasi = @mysqli_real_escape_string($conn, $_POST['respirasi']);
	$detak_jantung = @mysqli_real_escape_string($conn, $_POST['detak_jantung']);
$terapi = @mysqli_real_escape_string($conn, $_POST['terapi']);
$instruksi = @mysqli_real_escape_string($conn, $_POST['instruksi']);



	$id_pegawai =  $_SESSION['id_peg'];

	$query = "INSERT INTO tbl_assesmen VALUES('$no_diagnosa', '$no_daftar', '$tgl_diagnosa','$nm_dokter','$nama_pas',  '$nomor_rm', '$tgl_lahir','$tekanan_darah','$respirasi', '$temp','$detak_jantung','$terapi',  '$subjective','$objective','$assesment','$plan', '$instruksi','$id_pegawai')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>