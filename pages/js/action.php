<?php  
include 'koneksi.php';

$input = filter_input_array(INPUT_POST);

$nama_tindakan = mysqli_real_escape_string($conn, $input["nama_tindakan"]);
$harga_tindakan = mysqli_real_escape_string($conn, $input["harga_tindakan"]);
$tgl_input = mysqli_real_escape_string($conn, $input["tgl_input"]);
$kd_tindakan = mysqli_real_escape_string($conn, $input["kd_tindakan"]);

if($input["action"] === 'edit'){
	$query = "UPDATE data_tindakan SET nama_tindakan=?, harga_tindakan=? WHERE kd_tindakan=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('sss', $nama_tindakan,  $harga_tindakan,  $kd_tindakan);
	$dewan1->execute();
}

if($input["action"] === 'delete'){
	$query = "DELETE FROM data_tindakan WHERE kd_tindakan=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('s', $kd_tindakan);
	$dewan1->execute();
}

echo json_encode($input);
?>