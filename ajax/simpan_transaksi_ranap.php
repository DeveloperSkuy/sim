
 <?php 
	session_start();
	include "../koneksi.php";
	$kode = @mysqli_real_escape_string($conn, $_POST['kode']);

	$total_penjualan = @mysqli_real_escape_string($conn, $_POST['total_penjualan']);
	$jml_uang = @mysqli_real_escape_string($conn, $_POST['jml_uang']);
	$jml_kembali = @mysqli_real_escape_string($conn, $_POST['jml_kembali']);
	$administrasi = @mysqli_real_escape_string($conn, $_POST['administrasi']);

	$query = "INSERT INTO tbl_transaksi_ranap (no_daftar, total_penjualan, jml_uang, jml_kembali, administrasi)
	 VALUES('$kode', '$total_penjualan', '$jml_uang', '$jml_kembali', '$administrasi')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>