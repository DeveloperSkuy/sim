<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
<?php 
    $no_daftar = @$_GET['id'];
 ?>
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datapasien"><i class="fas fa-briefcase-medical"></i> Data Pasien</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data Pasien</li>
  </ol>
</nav>


<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Upload Gambar</h4></div>
		<div class="col-6 text-right">
			<a href="?page=perawatan">
				<button class="btn btn-sm btn-info">Data Rawat Pasien Rajal</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-10 offset-md-1 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengisi data Pasien</h6>
				<form action="javascrip:void(0);"  autocomplete="off">


				<form id="form-data">
                    <div class="position-relative row form-group">
                    	<!-- <label for="no_penjualan" class="col-sm-2 col-form-label">Nomor Penjualan</label> -->

                        	                        <div class="col-sm-3">
                        	<input name="no_daftar" id="no_daftar" placeholder="nomor daftar" type="hidden" class="form-control form-control-sm" value="<?php echo $no_daftar; ?>">
                        </div>

               <?php 
                    $query_tampil = "SELECT * FROM tbl_daftarpasien WHERE no_daftar='$no_daftar'";
                    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                    $data = mysqli_fetch_array($sql_tampil);
                   ?>

</div>


 <div class="form-group row">
				    <label for="nama_pas" class="col-sm-2 col-form-label">Nama Pasien</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" id="nama_pas" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nama_pas']; ?>">

					</div>
					<label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: right;">Nomor RM</label>
				    <div class="col-sm-4">
					<input type="text" class="form-control form-control-sm" id="nomor_rm" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nomor_rm']; ?>">
					</div>
				  </div>


 <div class="form-group row">
				    <label for="nama_pas" class="col-sm-2 col-form-label">Keterangan </label>
				    <div class="col-sm-4">
				      <textarea name="ket" id="ket" rows="2" class="form-control" placeholder="tulis keterangan gambar" style="font-size: 14px;"></textarea>

					</div>

					<label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: right;">Dokter </label>
				    <div class="col-sm-4">
<select name="dokter" id="dokter" class="form-control form-control-sm" >

                <?php
                //query menampilkan nama unit kerja ke dalam combobox
                $query    =mysqli_query($conn, "SELECT * FROM dokter");
                while ($dataku = mysqli_fetch_array($query)) {
                ?>
                <option value="<?=$dataku['nm_dokter'];?>"><?php echo $dataku['nm_dokter'];?></option>
                <?php } ?>
			      </select>

					</div>
				  </div>

				<div class="form-group">
						<label>File Upload</label>
						<input type="file" name="fileupload" id="fileupload" class="form-control"  onchange="tampilkanPreview(this,'preview')"/ />
<img id="preview" width="350px"/>
					</div>
					<div class="form-group">
						<input type="button" name="simpan" id="simpan" value="Simpan" class="btn btn-info mt-3" />
					</div>
				</form>
			</div>
		</div>
	</div>


	<script src="js/jquery.min.js"></script>

<script type="text/javascript">
function tampilkanPreview(userfile,idpreview)
{
  var gb = userfile.files;
  for (var i = 0; i < gb.length; i++)
  {
    var gbPreview = gb[i];
    var imageType = /image.*/;
    var preview=document.getElementById(idpreview);
    var reader = new FileReader();
    if (gbPreview.type.match(imageType))
    {
      //jika tipe data sesuai
      preview.file = gbPreview;
      reader.onload = (function(element)
      {
        return function(e)
        {
          element.src = e.target.result;
        };
      })(preview);
      //membaca data URL gambar
      reader.readAsDataURL(gbPreview);
    }
      else
      {
        //jika tipe data tidak sesuai
        alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
      }
  }
}
</script>


	<script>
		$(document).ready( function () {
    		$("#simpan").click(function(){
				const fileupload = $('#fileupload').prop('files')[0];

		        let formData = new FormData();
		        formData.append('fileupload', fileupload);
		        formData.append('no_daftar', $('#no_daftar').val());
		        formData.append('nama_pas', $('#nama_pas').val());
    		        formData.append('ket', $('#ket').val());

		        $.ajax({
		            type: 'POST',
		            url: "pages/gambar/upload_gambar.php",
		            data: formData,
		            cache: false,
		            processData: false,
		            contentType: false,
		            success: function (msg) {
		                alert(msg);
/*		                document.getElementById("form-data").reset();*/
		                window.location='?page=perawatan' ;
		            },
		            error: function () {
		                alert("Data Gagal Diupload");
		            }
		        });
	        });
        });
  </script>


	<div class="form-container">
		<div class="row">
			<div class="col-md-10 offset-md-1 offset-form">
				<h6><i class="fas fa-list-alt"></i> Data Riwayat Foto Pasien</h6>
<div class="page-content">
	<div class="row">



	</div>
	<div class="table-container">
		<table id="example" class="table table-striped display tabel-data">
			<thead>
					<tr>
						 <th>No</th>
		            <th>No Daftar</th>
		            <th>Nama Pasien</th>
		            <th>Keterangan</th>
		            <th>Foto (Klik untu Memperbesar Gbr)</th>
		            <th></th>
					</tr>
					</thead>
		    <tbody>
					<?php
				
						    $no_daftar = @$_GET['id'];
						$no=1;
				
                    $query_gambar = "SELECT * FROM tbl_uploadgambar  WHERE no_daftar='$no_daftar'";
                    $res1 = mysqli_query($conn, $query_gambar) or die ($conn->error);
                   
                   	while ($row = $res1->fetch_assoc()) {
                   ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $row['no_daftar']; ?></td>
							<td><?php echo $row['nama_pas']; ?></td>
							<td><?php echo $row['ket']; ?></td>
							<td>
<a href="#" class="pop">								    
   <img width="80" height="80" 
src="pages/gambar/upload/<?php echo $row['avatar']; ?>">
</a>
							<td>
 <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $row['id']; ?>" data-nama="<?php echo $row['nama_pas']; ?>">
                            <i class="fas fa-trash"></i>
                        </button>

                    </td>

 <?php } ?>
		 		</tr>
		 
		    </tbody>
		</table>
			</div>
		</div>
	</div>




<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">							   
    <div class="modal-content">         						      
     <div class="modal-body">
								      	 
       <button type="button" class="close" data-dismiss="modal"><span 
       aria-hidden="true">&times;</span><span class="sr- 
       only">Close</span></button>						        
      <img src="" class="imagepreview" style="width: 100%;">
								      
     </div>							    
   </div>								   
  </div>
</div>

<script>
	$("button[name='tombol_hapus']").click(function() {
		var id = $(this).data('id');
		var nama = $(this).data('nama');
		// alert(id);
		if(id==id_session) {
			Swal.fire({
	          title: 'Error !',
	          text: 'Anda tidak bisa menghapus data anda sendiri, mintalah admin atau manajer untuk menghapusnya',
	          type: 'error',
	          confirmButtonColor: '#3085d6',
	          confirmButtonText: 'OK'
	        }).then((baik) => {
	          if (baik.value) {

	          }
	        })
		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'anda akan menghapus data '+nama+', semua data transaksi yang berkaitan dengan pasien ini akan ikut terhapus',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((hapus) => {
	          if (hapus.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/hapus.php?page=gambarrajal",
	              data: "id="+id,
	              success: function(hasil) {
	                Swal.fire({
			          title: 'Berhasil',
			          text: 'Data Berhasil Dihapus',
			          type: 'success',
			          confirmButtonColor: '#3085d6',
			          confirmButtonText: 'OK'
			        }).then((ok) => {
			          if (ok.value) {
			            window.location='?page=perawatan';
/*			            window.location='?page=entry_gambar&id='+$no_daftar;*/
			          }
			        })
	              }
	            })  
	          }
	        })
	    }
	});
	
   $(function() {
     $('.pop').on('click', function() {
       $('.imagepreview').attr('src',$(this).find('img').attr('src'));
       $('#imagemodal').modal('show');   
       });		
   });
</script>

