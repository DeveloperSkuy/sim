<?php  

	include "../koneksi.php";

	$kode_bed = $_POST['kode'];

	$query = mysqli_query($conn,"select * from bed WHERE kode_bed='$kode_bed'");
    
    if (mysqli_num_rows($query)) {
    	$row = mysqli_fetch_assoc($query);
    	echo $row['stok'];
    }
  
?>