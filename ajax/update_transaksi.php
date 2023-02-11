
 <?php 
	session_start();
	include "../koneksi.php";
	$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);

	$total_penjualan = @mysqli_real_escape_string($conn, $_POST['total_penjualan']);
	$jml_uang = @mysqli_real_escape_string($conn, $_POST['jml_uang']);
	$jml_kembali = @mysqli_real_escape_string($conn, $_POST['jml_kembali']);
	$administrasi = @mysqli_real_escape_string($conn, $_POST['administrasi']);

	$query = "UPDATE tbl_transaksi SET total_penjualan='$total_penjualan', jml_uang='$jml_uang', jml_kembali='$jml_kembali', administrasi='$administrasi' WHERE no_daftar = '$no_daftar'";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>