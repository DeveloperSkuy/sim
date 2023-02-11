<?php 
	include "../koneksi.php";
	session_start();

	$no_labor = $_POST['no_labor'];
	$tgl_labor = $_POST['tanggal_labor'];
	$no_daftar = $_POST['no_rawat'];
		$nm_dokter = $_POST['nm_dokter'];
	// $hari= substr($tgl_penjualan, 8, 2);
	// $bulan = substr($tgl_penjualan, 5, 2);
	// $tahun = substr($tgl_penjualan, 0, 4);
	// $tgl = $tahun.$bulan.$hari;
	// $carikode = mysqli_query($conn, "SELECT MAX(no_penjualan) FROM tbl_penjualan WHERE tgl_penjualan = '$tgl_penjualan'") or die (mysql_error());
	// $datakode = mysqli_fetch_array($carikode);
	// if($datakode) {
 //        $nilaikode = substr($datakode[0], 13);
 //        $kode = (int) $nilaikode;
 //        $kode = $kode + 1;
 //        $no_penjualan = "PJL/".$tgl."/".str_pad($kode, 2, "0", STR_PAD_LEFT);
 //    } else {
 //        $no_penjualan = "PJL/".$tgl."/01";
 //    }

	$total_penjualan = $_POST['hidden_totalpenjualan'];
	// $tunai = $total_penjualan;
	// $kembali = 0;
	
	$id_pegawai =  $_SESSION['id_peg'];
	$query_tdk = "INSERT INTO tbl_hematologi VALUES('$no_labor', '$tgl_labor','$nm_dokter', '$no_daftar', '$id_pegawai')";
	mysqli_query($conn, $query_tdk) or die ($conn->error);

		// $kd_obat = "tes";
		// $hrg_jual = 2000;
		// $jml_obat = 2;
		// $sat_jual = "Strip";
		// $subtotal = 4000;

		// $query_pjldtl = "INSERT INTO tbl_penjualandetail (no_penjualan, kd_obat, hrg_jual, jml_jual, sat_jual, subtotal) VALUES ('$no_penjualan', '$kd_obat', '$hrg_jual', '$jml_obat', '$sat_jual', '$subtotal')";
		// mysqli_query($conn, $query_pjldtl) or die ($conn->error);

	for($i = 0; $i < count($_POST['hidden_kdlabor']); $i++) {
		$kd_labor = $_POST['hidden_kdlabor'][$i];
		$hrg_labor = $_POST['hidden_hrglabor'][$i];

		$query_pjldtl = "INSERT INTO tbl_hematologidetail (no_lab, kd_hematologi,  hrg_jual) VALUES('$no_labor', '$kd_labor',  '$hrg_labor')";
		mysqli_query($conn, $query_pjldtl) or die ($conn->error);

	}
 ?>