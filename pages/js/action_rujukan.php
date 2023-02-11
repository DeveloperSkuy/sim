<?php  
include 'koneksi.php';

$input = filter_input_array(INPUT_POST);


	$no_surat = @mysqli_real_escape_string($conn, $_POST['no_surat']);
	$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);
	$tgl_surat = @mysqli_real_escape_string($conn, $_POST['tgl_surat']);

	$nama_pas = @mysqli_real_escape_string($conn, $_POST['nama_pas']);

	$nomor_rm = @mysqli_real_escape_string($conn, $_POST['nomor_rm']);
		
	$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
	$rs_tujuan = @mysqli_real_escape_string($conn, $_POST['rs_tujuan']);
	$dokter_tujuan = @mysqli_real_escape_string($conn, $_POST['dokter_tujuan']);
	$nm_dokter = @mysqli_real_escape_string($conn, $_POST['nm_dokter']);

if($input["action"] === 'edit'){
	$query = "UPDATE tbl_suratrujukan SET rs_tujuan=?, dokter_tujuan=? WHERE no_surat=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('sss', $rs_tujuan, $dokter_tujuan,   $no_surat);
	$dewan1->execute();
}

if($input["action"] === 'delete'){
	$query = "DELETE FROM tbl_suratrujukan WHERE no_surat=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('s', $no_surat);
	$dewan1->execute();
}

echo json_encode($input);
?>