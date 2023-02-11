<?php 
	include "../koneksi.php";
	session_start();

	$no_lab = $_POST['no_lab'];
	$tgl_labor = $_POST['tanggal_labor'];
	$no_daftar = $_POST['no_rawat'];
		$nm_dokter = $_POST['nm_dokter'];
$norem = $_POST['norem'];


	$total_penjualan = $_POST['hidden_totalpenjualan'];
	// $tunai = $total_penjualan;
	// $kembali = 0;
	
	$id_pegawai =  $_SESSION['id_peg'];
	$query_tdk = "INSERT INTO tbl_hematologi VALUES('$no_lab', '$tgl_labor','$nm_dokter', '$no_daftar','$norem', '$id_pegawai')";
	mysqli_query($conn, $query_tdk) or die ($conn->error);


	for($i = 0; $i < count($_POST['hidden_kdlabor']); $i++) {
		$kd_labor = $_POST['hidden_kdlabor'][$i];
 		$hrg_labor = $_POST['hidden_hrglabor'][$i];

		$query_pjldtl = "INSERT INTO tbl_hematologidetail (no_lab, kd_hematologi,  hrg_labor) VALUES('$no_lab', '$kd_labor',  '$hrg_labor')";
		mysqli_query($conn, $query_pjldtl) or die ($conn->error);

	}
 ?>