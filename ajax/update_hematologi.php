<?php 
	session_start();
	include "../koneksi.php";

	$id = @mysqli_real_escape_string($conn, $_POST['id']);
	$nama = @mysqli_real_escape_string($conn, $_POST['nama']);
	$kesan = @mysqli_real_escape_string($conn, $_POST['kesan']);
		$expired = @mysqli_real_escape_string($conn, $_POST['expired']);

	$query = "UPDATE tbl_hematologidetail SET  kesan='$kesan', expired='$expired' WHERE no = '$id'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>