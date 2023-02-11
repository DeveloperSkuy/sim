<?php  
include 'koneksi.php';

$input = filter_input_array(INPUT_POST);

$jumlah = mysqli_real_escape_string($conn, $input["jumlah"]);
$hrg_jual = mysqli_real_escape_string($conn, $input["hrg_jual"]);
$subtotal = mysqli_real_escape_string($conn, $input["subtotal"]);

$no = mysqli_real_escape_string($conn, $input["no"]);

if($input["action"] === 'edit'){
	$query = "UPDATE tbl_nama_racikandetail SET jumlah=?, hrg_jual=?, subtotal=?  WHERE no=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('iiis', $jumlah, $hrg_jual, $subtotal,   $no);
	$dewan1->execute();
}

if($input["action"] === 'delete'){
	$query = "DELETE FROM tbl_nama_racikandetail WHERE no=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('s', $no);
	$dewan1->execute();
}

echo json_encode($input);
?>