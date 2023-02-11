<?php

include "../koneksi.php";

$kamar = $_GET['kamar'];

$kota = mysqli_query($conn, "SELECT id_bed,nama_bed FROM bed WHERE id_kamar='$kamar' order by nama_bed");
echo "<option>-- Pilih bed --</option>";
while($k = mysqli_fetch_array($kota)){
echo "<option value=\"".$k['id_bed']."\">".$k['nama_bed']."</option>\n";
}
?>