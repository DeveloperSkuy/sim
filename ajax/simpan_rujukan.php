<?php 
	session_start();
	include "../koneksi.php";

	$no_surat = @mysqli_real_escape_string($conn, $_POST['no_surat']);
	$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);
	$tgl_surat = @mysqli_real_escape_string($conn, $_POST['tgl_surat']);

	$nama_pas = @mysqli_real_escape_string($conn, $_POST['nama_pas']);

	$nomor_rm = @mysqli_real_escape_string($conn, $_POST['nomor_rm']);
		
	$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
	$rs_tujuan = @mysqli_real_escape_string($conn, $_POST['rs_tujuan']);
	$dokter_tujuan = @mysqli_real_escape_string($conn, $_POST['dokter_tujuan']);
	$nm_dokter = @mysqli_real_escape_string($conn, $_POST['nm_dokter']);




	$id_pegawai =  $_SESSION['id_peg'];

	$query = "INSERT INTO tbl_suratrujukan VALUES('$no_surat', '$no_daftar', '$tgl_surat','$rs_tujuan','$dokter_tujuan','$nm_dokter','$nama_pas',  '$nomor_rm', '$tgl_lahir','$id_pegawai')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>