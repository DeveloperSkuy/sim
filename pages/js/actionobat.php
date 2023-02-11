<?php  
include 'koneksi.php';

$input = filter_input_array(INPUT_POST);

$jml_jual = mysqli_real_escape_string($conn, $input["jml_jual"]);
$hrg_jual = mysqli_real_escape_string($conn, $input["hrg_jual"]);
$subtotal = mysqli_real_escape_string($conn, $input["subtotal"]);
$no_pengobatan = mysqli_real_escape_string($conn, $input["no_pengobatan"]);
$no = mysqli_real_escape_string($conn, $input["no"]);

if($input["action"] === 'edit'){
	$query = "UPDATE tbl_pengobatandetail SET jml_jual=?, hrg_jual=?, subtotal=?  WHERE no=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('iiis', $jml_jual, $hrg_jual, $subtotal,   $no);
	$dewan1->execute();
}

if($input["action"] === 'delete'){
	$query = "DELETE FROM tbl_pengobatandetail WHERE no=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('s', $no);
	$dewan1->execute();
}

echo json_encode($input);
?>