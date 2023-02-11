<?php  
include 'koneksi.php';

$input = filter_input_array(INPUT_POST);

$jumlah = mysqli_real_escape_string($conn, $input["jumlah"]);
$hrg_jual = mysqli_real_escape_string($conn, $input["hrg_jual"]);
$subtotal = mysqli_real_escape_string($conn, $input["subtotal"]);

$id = mysqli_real_escape_string($conn, $input["id"]);

if($input["action"] === 'edit'){
	$query = "UPDATE tbl_racikan_pasien SET jumlah=?, hrg_jual=?, subtotal=?  WHERE id=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('iiis', $jumlah, $hrg_jual, $subtotal,   $id);
	$dewan1->execute();
}

if($input["action"] === 'delete'){
	$query = "DELETE FROM tbl_racikan_pasien WHERE id=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('s', $id);
	$dewan1->execute();
}

echo json_encode($input);
?>