<?php  
include 'koneksi.php';

$input = filter_input_array(INPUT_POST);
$temp = mysqli_real_escape_string($conn, $input["temp"]);
$subjective = mysqli_real_escape_string($conn, $input["subjective"]);
$objective = mysqli_real_escape_string($conn, $input["objective"]);
$assesment = mysqli_real_escape_string($conn, $input["assesment"]);
$plan = mysqli_real_escape_string($conn, $input["plan"]);
$no_diagnosa = mysqli_real_escape_string($conn, $input["no_diagnosa"]);

if($input["action"] === 'edit'){
	$query = "UPDATE tbl_assesmen SET temp=?, subjective=?, objective=?, assesment=?, plan=?  WHERE no_diagnosa=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('ssssss', $temp, $subjective, $objective, $assesment, $plan,   $no_diagnosa);
	$dewan1->execute();
}

if($input["action"] === 'delete'){
	$query = "DELETE FROM tbl_assesmen WHERE no_diagnosa=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('s', $no_diagnosa);
	$dewan1->execute();
}

echo json_encode($input);
?>