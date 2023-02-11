<?php 
	 
    $kd_hematologi = @$_GET['id'];
 $no = @$_POST['no_lab'];
		$id_pegawai =  $_SESSION['id_peg'];
$expired = date("Y-m-d H:i:s");

$query ="INSERT INTO 
    tbl_hematologi_pesan (no, kd_hematologi, kd_labor, hrg_jual, hasil, satuan, subtotal, nilai_normal,keterangan,kategori, expired ) 
SELECT
no, kd_hematologi, kd_labor, hrg_jual, hasil, satuan, subtotal, nilai_normal,keterangan,kategori, '$expired'
FROM
    tbl_nama_hematologidetail WHERE kd_hematologi='$kd_hematologi'";

/*    $query = "INSERT INTO tbl_hematologi_pesan SELECT * FROM tbl_nama_hematologidetail  WHERE kd_racik='$kd_racik'";*/
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
echo '<script language="javascript" type="text/javascript">
alert("data berhasil di Pindahkan!"); window.history.back(-3);</script>';

/*		echo '<script language="javascript">window.history.back();</script>';*/
	} else {
		echo "gagal";
	}


 ?>

