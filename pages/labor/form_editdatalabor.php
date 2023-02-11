<?php 
	$kd_labor = @$_GET['id'];
 ?>
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datasupplier"><i class="fas fa-briefcase-medical"></i> Data labor</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data labor</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Edit Data labor</h4></div>
		<div class="col-6 text-right">
			<a href="?page=data_labor">
				<button class="btn btn-sm btn-info">Daftar Data labor</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengedit data labor</h6>
				<form action="javascrip:void(0);"  autocomplete="off">
				  <div class="form-group row pt-3">
				    <label for="kd_labor" class="col-sm-3 col-form-label">Kode labor</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="kd_labor" placeholder="masukkan nama supplier" value="<?php echo $kd_labor; ?>" disabled="">
				    </div>
				  </div>
				  <?php 
				  	$query_tampil = "SELECT * FROM data_labor WHERE kd_labor='$kd_labor'";
					$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
					$data = mysqli_fetch_array($sql_tampil);
				   ?>
				  <div class="form-group row pt-3">
				    <label for="nama_labor" class="col-sm-3 col-form-label">Nama labor</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nama_labor" placeholder="masukkan nama labor" autofocus="" value="<?php echo $data['nama_labor']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="harga_labor" class="col-sm-3 col-form-label">Harga </label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="harga_labor" placeholder="masukkan nama harga" autofocus="" value="<?php echo $data['harga_labor']; ?>">
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
		var kd_labor = $("#kd_labor").val();
		var nama_labor = $("#nama_labor").val();
		var harga_labor = $("#harga_labor").val();

		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

	 if (nama_labor=="") {
			document.getElementById("nama_labor").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama labor',
			  'warning'
			)
		} else if (harga_labor=="") {
			document.getElementById("harga_labor").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi harga_labor',
			  'warning'
			)
		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'anda akan merubah data labor ini',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((ya) => {
	          if (ya.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/edit_labor.php",
	              data: "nama_labor="+nama_labor+"&harga_labor="+harga_labor+"&kd_labor="+kd_labor,
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
				            window.location='?page=data_labor' ;
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