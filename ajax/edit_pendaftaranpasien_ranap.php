<?php 
	session_start();
	include "../koneksi.php";


	$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);
$nama_pas = @mysqli_real_escape_string($conn, $_POST['nama_pas']);
		$nomor_rm = @mysqli_real_escape_string($conn, $_POST['nomor_rm']);
	$asuransi_pas = @mysqli_real_escape_string($conn, $_POST['asuransi_pas']);
	$no_bpjs = @mysqli_real_escape_string($conn, $_POST['no_bpjs']);
	$diagnosa_awal = @mysqli_real_escape_string($conn, $_POST['diagnosa_awal']);
	$jk_pas = @mysqli_real_escape_string($conn, $_POST['jk_pas']);
	$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
	$tpt_lahir = @mysqli_real_escape_string($conn, $_POST['tpt_lahir']);
	$kamar = @mysqli_real_escape_string($conn, $_POST['kamar']);
	$bed = @mysqli_real_escape_string($conn, $_POST['bed']);
	$dokter = @mysqli_real_escape_string($conn, $_POST['dokter']);

	$query = "UPDATE tbl_daftarpasienranap SET nama_pas='$nama_pas', nomor_rm='$nomor_rm', jk_pas='$jk_pas', lhr_pas='$tgl_lahir', tpt_lahir='$tpt_lahir', asuransi_pas='$asuransi_pas', no_bpjs='$no_bpjs', diagnosa_awal='$diagnosa_awal',dokter='$dokter' WHERE no_daftar = '$no_daftar'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>
