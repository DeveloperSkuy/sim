<?php 

    include('koneksi.php');
    
    $kd_radiologi       = $_POST['kd_radiologi'];
    $nama_radiologi       = $_POST['nama_radiologi'];
    $harga_radiologi    = $_POST['harga_radiologi'];
    $tgl_input         = $_POST['tgl_input'];
        
    $insert = mysqli_query($conn, "insert into data_radiologi set kd_radiologi='$kd_radiologi',nama_radiologi='$nama_radiologi', harga_radiologi='$harga_radiologi', tgl_input='$tgl_input'");
    
?>
    