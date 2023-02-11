
<div class="table-container">
        <table id="example" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>code</th>
                    <th>diagnosa</th>
                    <th>deskripsi</th>
                    <th>Opsi</th>
                        </tr>
            </thead>
            <tbody>

<?php
error_reporting(0);
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


 $code=$_POST["code"];
 $diagnosa=$_POST["diagnosa"];
  $deskripsi=$_POST["deskripsi"];

      $result = "SELECT * FROM tbl_icd10 where code like '%$code%' OR diagnosa like '%$diagnosa%'  ";
 

			$found = mysqli_query($conn, $result);
if(mysqli_num_rows($found) > 0) {

/* if($found > 0){*/
  			while($data = mysqli_fetch_array($found)) {
       
    echo "<tr>
     <td>".$data['code']."</td>
     <td>".$data['diagnosa']."</td>
     <td>".$data['deskripsi']."</td>
                    <td class='td-opsi'>
                      <button class='btn-transition btn btn-outline-dark btn-sm' title='pilih' id='tombol_daftar' name='tombol_daftar' data-dismiss='modal'
                            data-code=".$data['code']."
                            data-diagnosa='$data[diagnosa]'
                            data-deskripsi='$data[deskripsi]' >Pilih</button>  

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
      

        var code=$(this).data('code');
        var diagnosa = $(this).data('diagnosa');
        var deskripsi = $(this).data('deskripsi');

        $("#code").val(code);
        $("#diagnosa").val(diagnosa);
        $("#deskripsi").val(deskripsi);

     $("#modal_diagnosa").modal("hide");
    });
        $("#code").keypress(function (e) {
        var key = e.which;
        if(key == 13) {
            alert(berhasil);
        }
    })

       

</script>