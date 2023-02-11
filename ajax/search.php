
<div class="table-container">
        <table id="example" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No RM</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>No HP</th>
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

 $nama_pas=$_POST["nama_pas"];
  $nomor_rm=$_POST["nomor_rm"];
    $no_hp =$_POST["no_hp"];
$no_urut = 0;
 
			$result = "SELECT * FROM tbl_pasien where nama_pas like '%$nama_pas%' OR nomor_rm like '%$nomor_rm%' OR no_hp like '%$no_hp%' ";
			$found = mysqli_query($conn, $result);
if(mysqli_num_rows($found) > 0) {

/* if($found > 0){*/
  			while($data = mysqli_fetch_array($found)) {
 $no_urut++;
    echo "<tr>
     <td>$no_urut</td>
     <td>".$data['nama_pas']."</td>
     <td>".$data['nomor_rm']."</td>
     <td>".$data['jk_pas']."</td>
     <td>".$data['alm_pas']."</td>     
     <td>".$data['lhr_pas']."</td>
     <td>".$data['no_hp']."</td>
                    <td class='td-opsi'>
                    <button class='btn-transition btn btn-outline-primary btn-sm' title='daftar' id='tombol_daftar' name='tombol_daftar' data-id=".$data['id_pas'].">

                        Daftar Rajal</button>
                    </td>

                                    <td class='td-opsi'>
                    <button class='btn-transition btn btn-outline-danger btn-sm' title='daftar ranap' id='tombol_daftar_ranap' name='tombol_daftar_ranap' data-id=".$data['id_pas'].">

                        Daftar Ranap</button>
                    </td>


  <tr>";
 }



       
 }else{
    echo "<li>Tidak ada artikel yang ditemukan <li>";
 }

?>
</table>

<script>
   
    $("button[name='tombol_daftar']").click(function() {
        var id = $(this).data('id');
        window.location='?page=daftar_pasien&id='+id;
    });

        $("button[name='tombol_daftar_ranap']").click(function() {
        var id = $(this).data('id');
        window.location='?page=daftar_pasien_ranap&id='+id;
    });
</script>