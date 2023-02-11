<?php
  include 'koneksi.php';
  if(isset($_POST["id"]))  {
    $output = '';
    $id = $_POST["id"];
    $query = "SELECT * FROM tbl_uploadgambar WHERE id=?";
    $dewan1 = $db1->prepare($query);
    $dewan1->bind_param('i', $id);
    $dewan1->execute();
    $res1 = $dewan1->get_result();
    while ($row = $res1->fetch_assoc()) {
      $output = '  
        <p><img src="pages/gambar/upload/'.$row["avatar"].'" class="img-responsive img-thumbnail" /></p>
        <p><b>Nama Lengkap : </b><br /> '.$row['nama_pas'].'</p>
      ';  
    }  
    echo $output;  
  }  
?>