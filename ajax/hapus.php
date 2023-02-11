<?php 
	include "../koneksi.php";
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	if(@$_GET['page']=='pegawai')
	{
		$query = "DELETE FROM tbl_pegawai WHERE id_peg = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='pasien')
	{
		$query = "DELETE FROM tbl_pasien WHERE id_pas = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

if(@$_GET['page']=='akai')
	{
		$query = "DELETE FROM tbl_akai WHERE id_akai = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

		if(@$_GET['page']=='racik')
	{
		$query = "DELETE FROM tbl_racikan_pesan WHERE kd_obat = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='data_tindakan')
	{
		$query = "DELETE FROM data_tindakan WHERE kd_tindakan = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='labor')
	{
		$query = "DELETE FROM data_labor WHERE kd_labor = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='gambarrajal')
	{
		$query = "DELETE FROM tbl_uploadgambar WHERE id = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}


	if(@$_GET['page']=='transaksi_rajal')
	{
		$query = "DELETE FROM tbl_transaksi WHERE no_daftar = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='transaksi_ranap')
	{
		$query = "DELETE FROM tbl_transaksi_ranap WHERE no_daftar = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='datapendaftaran_ranap')
	{
		$query = "DELETE FROM tbl_daftarpasienranap WHERE no_daftar = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}


	if(@$_GET['page']=='datapendaftaran')
	{
		$query = "DELETE FROM tbl_daftarpasien WHERE no_daftar = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='datapendaftaranranap')
	{
		$query = "DELETE FROM tbl_daftarpasienranap WHERE no_daftar = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='dataobat')
	{
		$query = "DELETE FROM tbl_dataobat WHERE kd_obat = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

	if(@$_GET['page']=='supplier')
	{
		$query = "DELETE FROM tbl_supplier WHERE no_supp = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}

		if(@$_GET['page']=='dokter')
	{
		$query = "DELETE FROM dokter WHERE kd_dokter = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}


	if(@$_GET['page']=='radiologi')
	{
		$query = "DELETE FROM data_radiologi WHERE kd_radiologi = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}
	/*if(@$_GET['page']=='pengobatan')
	{
		$query = "DELETE FROM tbl_pengobatandetail WHERE no = '$id'";
		mysqli_query($conn, $query) or die ($conn->error);
	}*/

	if(@$_GET['page']=='pengobatanan')
	{
		$exp = mysqli_real_escape_string($conn, $_POST['exp']);
		$stok = mysqli_real_escape_string($conn, $_POST['stok']);
	$subtot = mysqli_real_escape_string($conn, $_POST['subtot']);

		$query_ksgstok = "UPDATE tbl_pengobatandetail SET jml_jual = '0', subtotal = '0' WHERE no = '$id' ";
		mysqli_query($conn, $query_ksgstok) or die ($conn->error);

/*		$query_stok = "SELECT stk_obat FROM tbl_dataobat WHERE kd_obat = '$id'";
		$sql_stok = mysqli_query($conn, $query_stok) or die ($conn->error);
		$data_stok = mysqli_fetch_array($sql_stok);
		$stok_lama = $data_stok['stk_obat'];
		$stok_baru = $stok_lama + $stok;
		$query_estok = "UPDATE tbl_dataobat SET stk_obat='$stok_baru' WHERE kd_obat='$id'";
		mysqli_query($conn, $query_estok) or die ($conn->error);*/

		$query_estoki = "UPDATE tbl_stokexpobat SET stok='$stok_baru' WHERE kd_obat='$kd_obat' AND tgl_exp = '$exp_obat'";
		mysqli_query($conn, $query_estoki) or die ($conn->error);

	}


	if(@$_GET['page']=='kosongkan_stok')
	{
		$exp = mysqli_real_escape_string($conn, $_POST['exp']);
		$stok = mysqli_real_escape_string($conn, $_POST['stok']);
		$query_ksgstok = "UPDATE tbl_stokexpobat SET stok = '0' WHERE kd_obat = '$id' AND tgl_exp = '$exp'";
		mysqli_query($conn, $query_ksgstok) or die ($conn->error);

		$query_stok = "SELECT stk_obat FROM tbl_dataobat WHERE kd_obat = '$id'";
		$sql_stok = mysqli_query($conn, $query_stok) or die ($conn->error);
		$data_stok = mysqli_fetch_array($sql_stok);
		$stok_lama = $data_stok['stk_obat'];
		$stok_baru = $stok_lama - $stok;
		$query_estok = "UPDATE tbl_dataobat SET stk_obat='$stok_baru' WHERE kd_obat='$id'";
		mysqli_query($conn, $query_estok) or die ($conn->error);
	}

	if(@$_GET['page']=='datapenjualan')
	{
		// $query_pjldtl = "DELETE FROM tbl_penjualandetail WHERE no_penjualan = '$id'";
		// mysqli_query($conn, $query_pjldtl) or die ($conn->error);
		$query_pjl = "DELETE FROM tbl_penjualan WHERE no_penjualan = '$id'";
		mysqli_query($conn, $query_pjl) or die ($conn->error);
	}
	if(@$_GET['page']=='datapembelian')
	{
		// $query_pbldtl = "DELETE FROM tbl_pembeliandetail WHERE no_faktur = '$id'";
		// mysqli_query($conn, $query_pbldtl) or die ($conn->error);
		$query_pbl = "DELETE FROM tbl_pembelian WHERE no_faktur = '$id'";
		mysqli_query($conn, $query_pbl) or die ($conn->error);
	}
	if(@$_GET['page']=='riwayat_peramalan')
	{
		$query_peramalan = "DELETE FROM tbl_peramalan WHERE no_rml = '$id'";
		mysqli_query($conn, $query_peramalan) or die ($conn->error);
	}
 ?>