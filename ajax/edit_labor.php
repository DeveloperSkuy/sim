<?php 
	session_start();
	include "../koneksi.php";

	$kd_labor = @mysqli_real_escape_string($conn, $_POST['kd_labor']);
	$nama_labor = @mysqli_real_escape_string($conn, $_POST['nama_labor']);
	$harga_labor = @mysqli_real_escape_string($conn, $_POST['harga_labor']);

	$query = "UPDATE data_labor SET nama_labor='$nama_labor', harga_labor='$harga_labor' WHERE kd_labor = '$kd_labor'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>