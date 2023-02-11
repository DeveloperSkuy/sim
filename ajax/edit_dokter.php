<?php 
	session_start();
	include "../koneksi.php";

	$kd_dokter = @mysqli_real_escape_string($conn, $_POST['kd_dokter']);
	$nm_dokter = @mysqli_real_escape_string($conn, $_POST['nm_dokter']);
	$no_hp = @mysqli_real_escape_string($conn, $_POST['no_hp']);
	$spesialisasi = @mysqli_real_escape_string($conn, $_POST['spesialisasi']);
	$jasa_dok = @mysqli_real_escape_string($conn, $_POST['jasa_dok']);

	$query = "UPDATE dokter SET nm_dokter='$nm_dokter', no_telepon='$no_hp', spesialisasi='$spesialisasi' , jasa_dok='$jasa_dok' WHERE kd_dokter = '$kd_dokter'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>