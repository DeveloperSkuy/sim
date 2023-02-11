<?php
  include 'koneksi.php';
 
  $temp = "upload/";
  if (!file_exists($temp))
    mkdir($temp);
 
  $no_daftar   = $_POST['no_daftar'];
  $nama_pas          = $_POST['nama_pas'];
  $ket          = $_POST['ket'];
  $fileupload      = $_FILES['fileupload']['tmp_name'];
  $ImageName       = $_FILES['fileupload']['name'];
  $ImageType       = $_FILES['fileupload']['type'];
 
  if (!empty($fileupload)){
    $acak           = rand(11111111, 99999999);
    $ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
    $ImageExt       = str_replace('.','',$ImageExt); // Extension
    $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
    $NewImageName   = str_replace(' ', '', $acak.'.'.$ImageExt);
 
    move_uploaded_file($_FILES["fileupload"]["tmp_name"], $temp.$NewImageName); // Menyimpan file
 
    $query = "INSERT into tbl_uploadgambar (no_daftar, nama_pas, ket, avatar) VALUES (?, ?, ?, ?)";
    $dewan1 = $db1->prepare($query);
    $dewan1->bind_param("ssss", $no_daftar, $nama_pas, $ket, $NewImageName);
    $dewan1->execute();
 
    echo "Data Berhasil Disimpan";
  } else {
    echo "Data Gagal Disimpan";
  }
?>