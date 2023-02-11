<?php  
include 'koneksi.php';

$input = filter_input_array(INPUT_POST);

$nama_tindakan = mysqli_real_escape_string($db1, $input["nama_tindakan"]);
$harga_tindakan = mysqli_real_escape_string($db1, $input["harga_tindakan"]);
$tgl_input = mysqli_real_escape_string($db1, $input["tgl_input"]);
$id = mysqli_real_escape_string($db1, $input["id"]);

if($input["action"] === 'edit'){
	$query = "UPDATE data_tindakan SET nama_tindakan=?, harga_tindakan=?, tgl_input=? WHERE id=?";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param('sssssi', $nama_tindakan, $harga_tindakan,$tgl_input, $id);
	$dewan1->execute();
}

if($input["action"] === 'delete'){
	$query = "DELETE FROM data_tindakan WHERE id=?";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param('i', $id);
	$dewan1->execute();
}

echo json_encode($input);
?>