<?php  
include 'koneksi.php';

$input = filter_input_array(INPUT_POST);


	$no_surat = @mysqli_real_escape_string($conn, $_POST['no_surat']);
	$no_daftar = @mysqli_real_escape_string($conn, $_POST['no_daftar']);
	$tgl_surat = @mysqli_real_escape_string($conn, $_POST['tgl_surat']);

	$nama_pas = @mysqli_real_escape_string($conn, $_POST['nama_pas']);

	$nomor_rm = @mysqli_real_escape_string($conn, $_POST['nomor_rm']);
		
	$tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
	$kebutuhan = @mysqli_real_escape_string($conn, $_POST['kebutuhan']);
	$nm_dokter = @mysqli_real_escape_string($conn, $_POST['nm_dokter']);

if($input["action"] === 'edit'){
	$query = "UPDATE tbl_suratsehat SET kebutuhan=?, nm_dokter=?  WHERE no_surat=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('sss', $kebutuhan, $nm_dokter,   $no_surat);
	$dewan1->execute();
}

if($input["action"] === 'delete'){
	$query = "DELETE FROM tbl_suratsehat WHERE no_surat=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('s', $no_surat);
	$dewan1->execute();
}

echo json_encode($input);
?>