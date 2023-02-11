<?php 
	session_start();
	include "../koneksi.php";

	$kd_radiologi = @mysqli_real_escape_string($conn, $_POST['kd_radiologi']);
	$nama_radiologi = @mysqli_real_escape_string($conn, $_POST['nama_radiologi']);
	$harga_radiologi = @mysqli_real_escape_string($conn, $_POST['harga_radiologi']);

	$query = "UPDATE data_radiologi SET nama_radiologi='$nama_radiologi', harga_radiologi='$harga_radiologi' WHERE kd_radiologi = '$kd_radiologi'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>