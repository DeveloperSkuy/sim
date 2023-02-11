<?php 
	$kd_radiologi = @$_GET['id'];
 ?>
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datasupplier"><i class="fas fa-briefcase-medical"></i> Data Radiologi</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data Radiologi</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Edit Data Radiologi</h4></div>
		<div class="col-6 text-right">
			<a href="?page=data_radiologi">
				<button class="btn btn-sm btn-info">Daftar Data Radiologi</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengedit data radiologi</h6>
				<form action="javascrip:void(0);"  autocomplete="off">
				  <div class="form-group row pt-3">
				    <label for="kd_radiologi" class="col-sm-3 col-form-label">Kode radiologi</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="kd_radiologi" placeholder="masukkan nama supplier" value="<?php echo $kd_radiologi; ?>" disabled="">
				    </div>
				  </div>
				  <?php 
				  	$query_tampil = "SELECT * FROM data_radiologi WHERE kd_radiologi='$kd_radiologi'";
					$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
					$data = mysqli_fetch_array($sql_tampil);
				   ?>
				  <div class="form-group row pt-3">
				    <label for="nama_radiologi" class="col-sm-3 col-form-label">Nama Radiologi</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nama_radiologi" placeholder="masukkan nama radiologi" autofocus="" value="<?php echo $data['nama_radiologi']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="harga_radiologi" class="col-sm-3 col-form-label">Harga </label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="harga_radiologi" placeholder="masukkan nama harga" autofocus="" value="<?php echo $data['harga_radiologi']; ?>">
				    </div>
				  </div>
				  <div class="form-group row">
				    <div class="col-sm-12 text-right">
				      <button class="btn btn-info btn-sm" id="btn_simpan">Simpan Perubahan</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$("#btn_simpan").click(function() {
		var kd_radiologi = $("#kd_radiologi").val();
		var nama_radiologi = $("#nama_radiologi").val();
		var harga_radiologi = $("#harga_radiologi").val();

		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

	 if (nama_radiologi=="") {
			document.getElementById("nama_radiologi").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama radiologi',
			  'warning'
			)
		} else if (harga_radiologi=="") {
			document.getElementById("harga_radiologi").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi harga_radiologi',
			  'warning'
			)
		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'anda akan merubah data radiologi ini',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((ya) => {
	          if (ya.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/edit_radiologi.php",
	              data: "nama_radiologi="+nama_radiologi+"&harga_radiologi="+harga_radiologi+"&kd_radiologi="+kd_radiologi,
	              success: function(hasil) {
	              	if(hasil=="berhasil") {
						Swal.fire({
				          title: 'Berhasil',
				          text: 'Data Berhasil Diubah',
				          type: 'success',
				          confirmButtonColor: '#3085d6',
				          confirmButtonText: 'OK'
				        }).then((ok) => {
				          if (ok.value) {
				            window.location='?page=data_radiologi' ;
				          }
				        })
					}else if(hasil=="gagal") {
						Swal.fire(
						  'Gagal',
						  'Data Gagal Diubah',
						  'error'
						)
					}
	              }
	            })  
	          }
	        })
		}
	});
</script>