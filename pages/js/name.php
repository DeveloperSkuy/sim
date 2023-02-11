<?php  
//koneksi database
 include 'koneksi.php'; 
//menghitung jumlah input 
 $number = count($_POST["name"]);  

 if($number > 0)  
 {  
      for($i=0; $i<$number; $i++)  
      {  
           if(trim($_POST["name"][$i] != ''))  
           {  
                $insert = "INSERT INTO tbl_racikan_pasien(name,nm_obat,jumlah,hrg_jual,subtotal,no_pengobatan,no_daftar, tgl_racik, kd_racik, kd_obat) VALUES('".mysqli_real_escape_string($conn, $_POST["name"][$i])."','".$_POST['nm_obat'][$i]."','".$_POST['jumlah'][$i]."','".$_POST['hrg_jual'][$i]."','".$_POST['subtotal'][$i]."','".$_POST['no_pengobatan'][$i]."','".$_POST['no_daftar'][$i]."','".$_POST['tgl_racik'][$i]."','".$_POST['kd_racik'][$i]."','".$_POST['kd_obat'][$i]."')";  
                mysqli_query($conn, $insert);  
   
                    // jika berhasil tampilkan pesan berhasil ubah data
/*if($insert){
  $jumlah = @mysqli_real_escape_string($conn, $_POST['jumlah']);
                //update stok

    $query_stok = "SELECT stk_obat FROM tbl_dataobat WHERE kd_obat = '$kd_obat'";
    $sql_stok = mysqli_query($conn, $query_stok) or die ($conn->error);
    $data_stok = mysqli_fetch_array($sql_stok);
    $stok_lama = $data_stok['stk_obat'];
    $stok_baru = $stok_lama - $jumlah;
    $query_estok = "UPDATE tbl_dataobat SET stk_obat='$stok_baru' WHERE kd_obat='$kd_obat'";
    mysqli_query($conn, $query_estok) or die ($conn->error);


}*/
           }  
      }  
      //jika berhasil input
      echo "Berhasil";  
 }  
 else 
 {  
      //jika tidak berhasil
      echo "Please Enter Name";  
 }  

$query = "DELETE FROM tbl_racikan_pesan ";
    mysqli_query($conn, $query) or die ($conn->error);



 ?> 

