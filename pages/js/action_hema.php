<?php  
include 'koneksi.php';

$input = filter_input_array(INPUT_POST);

$hasil = mysqli_real_escape_string($conn, $input["hasil"]);
$name = mysqli_real_escape_string($conn, $input["name"]);
$nm_labor = mysqli_real_escape_string($conn, $input["nm_labor"]);
$satuan = mysqli_real_escape_string($conn, $input["satuan"]);
$id = mysqli_real_escape_string($conn, $input["id"]);

if($input["action"] === 'edit'){
	$query = "UPDATE tbl_hematologi_pasien SET name=?, nm_labor=?, hasil=?, satuan=?  WHERE id=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('ssssi', $name, $nm_labor, $hasil,$satuan,   $id);
	$dewan1->execute();
}

if($input["action"] === 'delete'){
	$query = "DELETE FROM tbl_hematologi_pasien WHERE id=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('i', $id);
	$dewan1->execute();

	
}

echo json_encode($input);
?>