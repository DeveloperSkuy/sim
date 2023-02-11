<?php 
	session_start();
	include "../koneksi.php";
$nama_pas = @mysqli_real_escape_string($conn, $_POST['nama_pas']);
	$asuransi_pas = @mysqli_real_escape_string($conn, $_POST['asuransi_pas']);
	$no_hp = @mysqli_real_escape_string($conn, $_POST['no_hp']);
		$nomor_rm = @mysqli_real_escape_string($conn, $_POST['nomor_rm']);
	$alm_pas = @mysqli_real_escape_string($conn, $_POST['alm_pas']);
	$jk_pas = @mysqli_real_escape_string($conn, $_POST['jk_pas']);
	$tpt_lahir = @mysqli_real_escape_string($conn, $_POST['tpt_lahir']);
	$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
	$nik = @mysqli_real_escape_string($conn, $_POST['nik']);
	$desa = @mysqli_real_escape_string($conn, $_POST['desa']);
	$kec = @mysqli_real_escape_string($conn, $_POST['kec']);
	$kab_kota = @mysqli_real_escape_string($conn, $_POST['kab_kota']);
	$provinsi = @mysqli_real_escape_string($conn, $_POST['provinsi']);
	$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);
	$tgl_daftar = @mysqli_real_escape_string($conn, $_POST['tgl_daftar']);
	$id_pas = @mysqli_real_escape_string($conn, $_POST['id_pas']);
	$cara_masuk = @mysqli_real_escape_string($conn, $_POST['cara_masuk']);
	$status = @mysqli_real_escape_string($conn, $_POST['status']);
	$nama_pj = @mysqli_real_escape_string($conn, $_POST['nama_pj']);
	$kontak_pj = @mysqli_real_escape_string($conn, $_POST['kontak_pj']);
	$hubungan_pj = @mysqli_real_escape_string($conn, $_POST['hubungan_pj']);
	$dokter = @mysqli_real_escape_string($conn, $_POST['dokter']);
	$diagnosa_awal = @mysqli_real_escape_string($conn, $_POST['diagnosa_awal']);
	$kamar = @mysqli_real_escape_string($conn, $_POST['kamar']);
	$no_bed = @mysqli_real_escape_string($conn, $_POST['no_bed']);
	$tarif = @mysqli_real_escape_string($conn, $_POST['tarif']);
	$deposit = @mysqli_real_escape_string($conn, $_POST['deposit']);
	$no_bpjs = @mysqli_real_escape_string($conn, $_POST['no_bpjs']);
	$ket = @mysqli_real_escape_string($conn, $_POST['ket']);
	$tgl_masuk = @mysqli_real_escape_string($conn, $_POST['tgl_masuk']);
	$tgl_pulang = @mysqli_real_escape_string($conn, $_POST['tgl_pulang']);
 
$id_pegawai =  $_SESSION['id_peg'];
	$query = "INSERT INTO tbl_daftarpasienranap VALUES('$no_daftar', '$tgl_daftar', '$nama_pas', '$nomor_rm','$nik', '$jk_pas','$tpt_lahir','$tgl_lahir', '$asuransi_pas', '$no_bpjs','$no_hp', '$alm_pas','$desa','$kec','$kab_kota','$provinsi','$nama_pj','$kontak_pj','$hubungan_pj','$deposit','$cara_masuk','$diagnosa_awal','$dokter','$kamar','$no_bed','$tarif','$status', '$ket','$tgl_masuk','$tgl_pulang', '$id_pas','$id_pegawai')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}

/*		$query_stok = "SELECT nama_pas FROM tbl_daftarpasien WHERE no_daftar = '$no_daftar'";
		$sql_stok = mysqli_query($conn, $query_stok) or die ($conn->error);
		$data = mysqli_fetch_array($sql_stok);
		$nama_pas = $data['nama_pas'];
		$nomor = $data['no_antrian'];

$query_estok = "UPDATE tbl_antrian SET nama_pas='$nama_pas' WHERE no_antrian='$nomor'";
		mysqli_query($conn, $query_estok) or die ($conn->error);
*/

 ?>