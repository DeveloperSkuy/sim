
<div class="table-container">
        <table id="example" class="table table-striped display tabel-data">
            <thead>
                <tr>
              <th>Kode</th>
                    <th>Nama Obat</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Opsi</th>
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
$no_urut = 0;
 

			$result = "SELECT * FROM tbl_nama_racikan where nama_racikan like '%$nama_racikan%' OR kd_racik like '%$kd_racik%'  ";
			$found = mysqli_query($conn, $result);
if(mysqli_num_rows($found) > 0) {

/* if($found > 0){*/
  			while($data = mysqli_fetch_array($found)) {
 $no_urut++;
    echo "<tr>
     <td>$no_urut</td>
     <td>".$data['kd_racik']."</td>
     <td>".$data['nama_racikan']."</td>
     <td>".$data['stk_obat']."</td>
     <td>".$data['total_penjualan']."</td>     
                    <td class='td-opsi'>
                    <button class='btn-transition btn btn-outline-primary btn-sm' title='daftar' id='tombol_obatpasien' name='tombol_obatpasien' data-id=".$data['kd_racik'].">

                        edit</button>
                    </td>


  <tr>";
 }



       
 }else{
    echo "<li>Tidak ada artikel yang ditemukan <li>";
 }

?>
</table>

<script>
   
$("button[name='tombol_obatpasien']").click(function() {
    var id = $(this).data('id');
    window.location='?page=entry_obatracik&id='+id;
  });



    $("button[name='tombol_daftar']").click(function() {
        var id = $(this).data('id');
        window.location='?page=daftar_pasien&id='+id;
    });

        $("button[name='tombol_daftar_ranap']").click(function() {
        var id = $(this).data('id');
        window.location='?page=daftar_pasien_ranap&id='+id;
    });
</script>