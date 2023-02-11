<?php 
	include "../koneksi.php";
	session_start();

	$kd_hematologi = $_POST['kd_hematologi'];
	$tgl_hematologi = $_POST['tanggal_hematologi'];
	$satuan = $_POST['satuan'];
	$nilai_normal = $_POST['nilai_normal'];
	$nama_hematologi = $_POST['nama_hematologi'];
	$hrg_hematologi = $_POST['hrg_hematologi'];
	$hasil = $_POST['hasil'];
	$kategori = $_POST['kategori'];
	$status = $_POST['status'];
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

	$tunai = $_POST['jml_uang'];
	$kembali = $_POST['jml_kembali'];
	$total_penjualan = $_POST['hidden_totalpenjualan'];
	// $tunai = $total_penjualan;
	// $kembali = 0;
	

/*	$query_pjl = "INSERT INTO tbl_nama_hematologi VALUES('$kd_hematologi', '$tgl_hematologi','$nama_hematologi','$hasil','$satuan','$nilai_normal','$hrg_hematologi', '$id_pegawai', '$status')";
	mysqli_query($conn, $query_pjl) or die ($conn->error);*/

		// $kd_obat = "tes";
		// $hrg_jual = 2000;
		// $jml_obat = 2;
		// $sat_jual = "Strip";
		// $subtotal = 4000;

		// $query_pjldtl = "INSERT INTO tbl_penjualandetail (no_penjualan, kd_obat, hrg_jual, jml_jual, sat_jual, subtotal) VALUES ('$no_penjualan', '$kd_obat', '$hrg_jual', '$jml_obat', '$sat_jual', '$subtotal')";
		// mysqli_query($conn, $query_pjldtl) or die ($conn->error);

	for($i = 0; $i < count($_POST['hidden_kdobat']); $i++) {
		$kd_obat = $_POST['hidden_kdobat'][$i];
		$nilai_normal = $_POST['hidden_nilainormal'][$i];
		$hasil = $_POST['hidden_hasil'][$i];
		$satuan = $_POST['hidden_satuan'][$i];
		$subtotal = $_POST['hidden_subtotal'][$i];
		$kategori = $_POST['hidden_kategori'][$i];	
		
		$query_pjldtl = "INSERT INTO tbl_nama_hematologidetail (kd_hematologi, kd_labor,  nilai_normal, hasil, satuan, subtotal, kategori) VALUES('$kd_hematologi', '$kd_obat',  '$nilai_normal', '$hasil', '$satuan', '$subtotal', '$kategori')";
		mysqli_query($conn, $query_pjldtl) or die ($conn->error);

	}
 ?>