
<div class="table-container">
        <table id="example" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Racikan</th>
                    <th>Nama Obat</th>
                    <th>Satuan</th>
                    <th>Harga Jual</th>
                    <th>Jumlah </th>
                    <th>Subtotal</th>
<!--                     <th>Opsi</th> -->
                        </tr>
            </thead>
            <tbody>

<?php
 include "../koneksi.php";
 /*
echo "
<div class='table-container'>
        <table id='example2' class='table table-striped display tabel-data'>
            <thead>
            <th>Nomor RM</th>
            <th>Nama Pasien</th>
            <th>Jenis Kelamin</th>
            <th>Asuransi</th>
            <th>Tgl Lahir</th>
               
        </tr>
</thead>
            <tbody>
        ";*/

 $nama_racikan=$_POST["nama_racikan"];
  $kd_racik=$_POST["kd_racik"];
    $kd_obat =$_POST["kd_obat"];
/*        $no_hp =$_POST["no_hp"];*/
$no_urut = 0;
 
                     $result = "SELECT tbl_nama_racikandetail.kd_racik,tbl_nama_racikandetail.sat_jual, tbl_nama_racikandetail.subtotal, tbl_nama_racikandetail.jumlah,tbl_nama_racikandetail.hrg_jual, tbl_dataobat.nm_obat, tbl_nama_racikan.kd_racik, tbl_nama_racikan.nama_racikan FROM tbl_nama_racikandetail
                  LEFT JOIN tbl_nama_racikan ON tbl_nama_racikandetail.kd_racik=tbl_nama_racikan.kd_racik
                  LEFT JOIN tbl_dataobat ON tbl_nama_racikandetail.kd_obat=tbl_dataobat.kd_obat where tbl_nama_racikan.nama_racikan like '%$nama_racikan%' OR tbl_nama_racikandetail.kd_racik like '%$kd_racik%' ";

 /*          $result = "SELECT * FROM tbl_nama_racikandetail where kd_racik like '%$kd_racik%' OR kd_obat like '%$kd_obat%'  ";*/
            $found = mysqli_query($conn, $result);
if(mysqli_num_rows($found) > 0) {

/* if($found > 0){*/
            while($data = mysqli_fetch_array($found)) {
 $no_urut++;
    echo "<tr>
     <td>$no_urut</td>
     <td>".$data['nama_racikan']."</td>
     <td>".$data['nm_obat']."</td>
     <td>".$data['sat_jual']."</td>     
     <td>".$data['jumlah']."</td>
     <td>".$data['hrg_jual']."</td>
     <td>".$data['subtotal']."</td>



  <tr>";
 }



       
 }else{
    echo "<li>Tidak ada artikel yang ditemukan <li>";
 }

?>

<!--                     <td class='td-opsi'>
                    <button class='btn-transition btn btn-outline-primary btn-sm' title='daftar' id='tombol_daftar' name='tombol_daftar' data-id=".$data['kd_racik'].">

                        Daftar</button>
                    </td>
 -->


</table>

<script>
   
    $("button[name='tombol_daftar']").click(function() {
        var id = $(this).data('id');
        window.location='?page=entry_obatracik&id='+id;
    });


</script>