<?php
include "../koneksi.php";

$kamar = $_GET['kamar'];
$query = mysqli_query($conn, "select * from ruangan where kamar='$kamar'");
$mahasiswa = mysqli_fetch_array($query);
$data = array(
            'kamar'      =>  $mahasiswa['kamar'],
            'no_bed'   =>  $mahasiswa['no_bed'],
            'tarif'    =>  $mahasiswa['tarif'],);
 echo json_encode($data);
?>