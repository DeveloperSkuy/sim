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
                $insert = "INSERT INTO tbl_hematologi_pasien(name,nm_labor,hasil,satuan, nilai_normal, hrg_jual,keterangan, no_lab,no_daftar, tgl_hematologi, kd_hematologi, kd_labor, kategori) VALUES('".mysqli_real_escape_string($conn, $_POST["name"][$i])."','".$_POST['nm_labor'][$i]."','".$_POST['hasil'][$i]."','".$_POST['satuan'][$i]."','".$_POST['nilai_normal'][$i]."','".$_POST['hrg_jual'][$i]."','".$_POST['keterangan'][$i]."','".$_POST['no_lab'][$i]."','".$_POST['no_daftar'][$i]."','".$_POST['tgl_hematologi'][$i]."','".$_POST['kd_hematologi'][$i]."','".$_POST['kd_labor'][$i]."','".$_POST['kategori'][$i]."')";  
                mysqli_query($conn, $insert);  
   
                    // jika berhasil tampilkan pesan berhasil ubah data
if($insert){
  $jumlah = @mysqli_real_escape_string($conn, $_POST['jumlah']);
                //update stok

    $query_stok = "SELECT stk_obat FROM tbl_dataobat WHERE kd_obat = '$kd_obat'";
    $sql_stok = mysqli_query($conn, $query_stok) or die ($conn->error);
    $data_stok = mysqli_fetch_array($sql_stok);
    $stok_lama = $data_stok['stk_obat'];
    $stok_baru = $stok_lama - $jumlah;
    $query_estok = "UPDATE tbl_dataobat SET stk_obat='$stok_baru' WHERE kd_obat='$kd_obat'";
    mysqli_query($conn, $query_estok) or die ($conn->error);


}
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

$query = "DELETE FROM tbl_hematologi_pesan ";
    mysqli_query($conn, $query) or die ($conn->error);



 ?> 

