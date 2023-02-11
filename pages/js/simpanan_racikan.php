<?php 
	
    $kd_racik = @$_GET['id'];
 $no = @$_POST['no_pengobatan'];
		$id_pegawai =  $_SESSION['id_peg'];
$expired = date("Y-m-d H:i:s");

$query ="INSERT INTO 
    tbl_racikan_pesan (no, kd_racik, kd_obat, hrg_jual, jumlah, sat_jual, subtotal, akai, expired, stokini) 
SELECT
no, kd_racik, kd_obat, hrg_jual, jumlah, sat_jual, subtotal, akai, '$expired', '$id_pegawai'
FROM
    tbl_nama_racikandetail WHERE kd_racik='$kd_racik'";

/*    $query = "INSERT INTO tbl_racikan_pesan SELECT * FROM tbl_nama_racikandetail  WHERE kd_racik='$kd_racik'";*/
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo '<script language="javascript">window.history.back();</script>';
	} else {
		echo "gagal";
	}


 ?>

