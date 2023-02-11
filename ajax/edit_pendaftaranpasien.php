<?php 
	session_start();
	include "../koneksi.php";
	$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);
$nama_pas = @mysqli_real_escape_string($conn, $_POST['nama_pas']);
	$asuransi_pas = @mysqli_real_escape_string($conn, $_POST['asuransi_pas']);
	$no_bpjs = @mysqli_real_escape_string($conn, $_POST['no_bpjs']);
		$nomor_rm = @mysqli_real_escape_string($conn, $_POST['nomor_rm']);
	$diagnosa = @mysqli_real_escape_string($conn, $_POST['diagnosa']);
	$jk_pas = @mysqli_real_escape_string($conn, $_POST['jk_pas']);
	$dokter = @mysqli_real_escape_string($conn, $_POST['dokter']);
	$berat_badan = @mysqli_real_escape_string($conn, $_POST['berat_badan']);
	$tinggi_badan = @mysqli_real_escape_string($conn, $_POST['tinggi_badan']);
	$temp = @mysqli_real_escape_string($conn, $_POST['temp']);
	$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
	$tpt_lahir = @mysqli_real_escape_string($conn, $_POST['tpt_lahir']);
	$goldarah = @mysqli_real_escape_string($conn, $_POST['goldarah']);
		$tekanan_darah = @mysqli_real_escape_string($conn, $_POST['tekanan_darah']);

$nik = @mysqli_real_escape_string($conn, $_POST['nik']);
		$pekerjaan = @mysqli_real_escape_string($conn, $_POST['pekerjaan']);
		$istirahat = @mysqli_real_escape_string($conn, $_POST['istirahat']);
		$keluhan = @mysqli_real_escape_string($conn, $_POST['keluhan']);
				$tgl_istirahat = @mysqli_real_escape_string($conn, $_POST['tgl_istirahat']);
	            /*  data: "nama_pas="+nama_pas+"&jk_pas="+jk_pas+"&tgl_lahir="+tgl_lahir+"&tpt_lahir="+tpt_lahir+"&asuransi_pas="+asuransi_pas+"&no_bpjs="+no_bpjs+"&diagnosa="+diagnosa+"&nomor_rm="+nomor_rm+"&dokter="+dokter+"&tinggi_badan="+tinggi_badan+"&berat_badan="+berat_badan+"&tekanan_darah="+tekanan_darah+"&temp="+temp+"&goldarah="+goldarah+"&no_daftar="+no_daftar,*/

	$query = "UPDATE tbl_daftarpasien SET nama_pas='$nama_pas', nik='$nik', jk_pas='$jk_pas', lhr_pas='$tgl_lahir', tpt_lahir='$tpt_lahir', pekerjaan='$pekerjaan', asuransi_pas='$asuransi_pas', no_bpjs='$no_bpjs', keluhan='$keluhan',   nomor_rm='$nomor_rm', tinggi_badan='$tinggi_badan',berat_badan='$berat_badan', tekanan_darah='$tekanan_darah', temp='$temp', dokter='$dokter', goldarah='$goldarah', istirahat='$istirahat', tgl_istirahat='$tgl_istirahat' WHERE no_daftar = '$no_daftar'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
?>
