<?php 

    include('koneksi.php');
    
    $kd_labor       = $_POST['kd_labor'];
    $nm_labor       = $_POST['nm_labor'];
    $satuan       = $_POST['satuan'];
   $nilai_normal       = $_POST['nilai_normal']; 
   $kategori       = $_POST['kategori']; 
    $harga_labor    = $_POST['harga_labor'];
    $tgl_input         = $_POST['tgl_input'];
        
    $insert = mysqli_query($conn, "insert into data_labor set kd_labor='$kd_labor',nm_labor='$nm_labor', harga_labor='$harga_labor', satuan='$satuan', nilai_normal='$nilai_normal', kategori='$kategori', tgl_input='$tgl_input'");
    
?>
    