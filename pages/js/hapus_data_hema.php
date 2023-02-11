<?php  


$query = "DELETE FROM tbl_hematologi_pesan";
		 
   $sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
/*		echo '<script language="javascript">window.history.back();</script>';*/

echo '<script language="javascript" type="text/javascript">
alert("data berhasil di hapus!"); window.history.back();</script>';

	} else {
		echo "gagal";
	}

?>