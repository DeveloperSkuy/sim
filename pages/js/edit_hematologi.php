<?php
//include('dbconnected.php');
include('koneksidb.php');

$id = $_GET['no'];
$nama = $_GET['nama_hematologi'];
$kesan = $_GET['kesan'];

//query update
$query = "UPDATE tbl_hematologidetail SET nama='$nama' , kesan='$kesan' WHERE id='$id' ";

if (mysql_query($query)) {
	# credirect ke page index
	header("location:?page=farmasi_ranap");	
}
else{
	echo "ERROR, data gagal diupdate". mysql_error();
}

//mysql_close($host);
?>