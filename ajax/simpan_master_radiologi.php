<?php 
	session_start();
	include "../koneksi.php";

$kode = @mysqli_real_escape_string($conn, $_POST['kode']);
	$nama_radiologi = @mysqli_real_escape_string($conn, $_POST['nama_radiologi']);
	$harga_radiologi = @mysqli_real_escape_string($conn, $_POST['harga_radiologi']);
		$tgl_input = @mysqli_real_escape_string($conn, $_POST['tgl_input']);

$query = "INSERT INTO data_radiologi (kd_radiologi, nama_radiologi, harga_radiologi, tgl_input) VALUES('$kode', '$nama_radiologi', '$harga_radiologi', '$tgl_input')";

	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>