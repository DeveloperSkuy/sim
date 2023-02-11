<?php 

    include('koneksi.php');
    
    $id_akai       = $_POST['id_akai'];
    $aturan_pakai       = $_POST['aturan_pakai'];
        
    $insert = mysqli_query($conn, "insert into tbl_akai set id_akai='$id_akai', aturan_pakai='$aturan_pakai'");
    
?>
    