<?php 
	session_start();
	include "../koneksi.php";
	$id_pas = @mysqli_real_escape_string($conn, $_POST['id_pas']);
$nama_pas = @mysqli_real_escape_string($conn, $_POST['nama_pas']);
	$asuransi_pas = @mysqli_real_escape_string($conn, $_POST['asuransi_pas']);
	$no_hp = @mysqli_real_escape_string($conn, $_POST['no_hp']);
		$nomor_rm = @mysqli_real_escape_string($conn, $_POST['nomor_rm']);
	$alm_pas = @mysqli_real_escape_string($conn, $_POST['alm_pas']);
	$jk = @mysqli_real_escape_string($conn, $_POST['jk']);
	$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);

	$query = "UPDATE tbl_pasien SET nama_pas='$nama_pas', jk_pas='$jk', lhr_pas='$tgl_lahir', asuransi_pas='$asuransi_pas', no_hp='$no_hp', alm_pas='$alm_pas', nomor_rm='$nomor_rm' WHERE id_pas = '$id_pas'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>
