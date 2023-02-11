<?php  
include '../../koneksi.php';

$input = filter_input_array(INPUT_POST);

$hasil = mysqli_real_escape_string($conn, $input["hasil"]);
$satuan = mysqli_real_escape_string($conn, $input["satuan"]);
$nilai_normal = mysqli_real_escape_string($conn, $input["nilai_normal"]);

$no = mysqli_real_escape_string($conn, $input["no"]);

if($input["action"] === 'edit'){
	$query = "UPDATE tbl_nama_hematologidetail SET hasil=?, satuan=?, nilai_normal=?  WHERE no=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('iiis', $jumlah, $satuan, $nilai_normal,   $no);
	$dewan1->execute();
}

if($input["action"] === 'delete'){
	$query = "DELETE FROM tbl_nama_hematologidetail WHERE no=?";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param('i', $no);
	$dewan1->execute();
}

echo json_encode($input);
?>