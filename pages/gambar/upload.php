<?php
  include 'koneksi.php';
 
  $temp = "upload/";
  if (!file_exists($temp))
    mkdir($temp);
 
  $nama_customer   = $_POST['nama_customer'];
  $alamat          = $_POST['alamat'];
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
 
    $query = "INSERT into tbl_fileupload (nama_customer, alamat, avatar) VALUES (?, ?, ?)";
    $dewan1 = $db1->prepare($query);
    $dewan1->bind_param("sss", $nama_customer, $alamat, $NewImageName);
    $dewan1->execute();
 
    echo "Data Berhasil Disimpan";
  } else {
    echo "Data Gagal Disimpan";
  }
?>