<?php 

    include('koneksi.php');
    
    $kd_tindakan       = $_POST['kd_tindakan'];
    $nama_tindakan       = $_POST['nama_tindakan'];
    $harga_tindakan    = $_POST['harga_tindakan'];
    $persen    = $_POST['persen'];
    $jasa_dokter    = $_POST['jasa_dokter'];
    $tgl_input         = $_POST['tgl_input'];
        
    $insert = mysqli_query($conn, "insert into data_tindakan set kd_tindakan='$kd_tindakan',nama_tindakan='$nama_tindakan', harga_tindakan='$harga_tindakan',persen='$persen', jasa_dokter='$jasa_dokter', tgl_input='$tgl_input'");
    
?>
    