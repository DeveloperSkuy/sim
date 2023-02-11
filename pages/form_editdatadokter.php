<?php 
	$kd_dokter = @$_GET['id'];
 ?>
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datasupplier"><i class="fas fa-briefcase-medical"></i> Data Dokter</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data Dokter</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Edit Data Dokter</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datadokter">
				<button class="btn btn-sm btn-info">Daftar Data Dokter</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengedit data dokter</h6>
				<form action="javascrip:void(0);"  autocomplete="off">
				  <div class="form-group row pt-3">
				    <label for="kd_dokter" class="col-sm-3 col-form-label">Kode Dokter</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="kd_dokter" placeholder="masukkan nama supplier" value="<?php echo $kd_dokter; ?>" disabled="">
				    </div>
				  </div>
				  <?php 
				  	$query_tampil = "SELECT * FROM dokter WHERE kd_dokter='$kd_dokter'";
					$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
					$data = mysqli_fetch_array($sql_tampil);
				   ?>
				  <div class="form-group row pt-3">
				    <label for="nm_dokter" class="col-sm-3 col-form-label">Nama Supplier</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nm_dokter" placeholder="masukkan nama supplier" autofocus="" value="<?php echo $data['nm_dokter']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="no_hp" class="col-sm-3 col-form-label">No HP </label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="no_hp" placeholder="masukkan nama petugas" autofocus="" value="<?php echo $data['no_telepon']; ?>">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="no_petugas" class="col-sm-3 col-form-label">Spesialisasi</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="spesialisasi" placeholder="masukkan nomor hp petugas" autofocus="" value="<?php echo $data['spesialisasi']; ?>">
				    </div>
				  </div>
				  	  <div class="form-group row pt-3">
				    <label for="no_petugas" class="col-sm-3 col-form-label">Jasa Dokter</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="jasa_dok" placeholder="masukkan jasa dokter" autofocus="" value="<?php echo $data['jasa_dok']; ?>">
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
		var kd_dokter = $("#kd_dokter").val();
		var nm_dokter = $("#nm_dokter").val();
		var no_hp = $("#no_hp").val();
		var spesialisasi = $("#spesialisasi").val();
		var jasa_dok = $("#jasa_dok").val();

		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

	 if (nm_dokter=="") {
			document.getElementById("nm_dokter").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama petugas supplier',
			  'warning'
			)
		} else if (no_hp=="") {
			document.getElementById("no_petugas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nomor hp petugas supplier',
			  'warning'
			)
		} else if (spesialisasi=="") {
			document.getElementById("alm_supp").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi alamat supplier',
			  'warning'
			)
		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'anda akan merubah data supplier ini',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((ya) => {
	          if (ya.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/edit_dokter.php",
	              data: "nm_dokter="+nm_dokter+"&no_hp="+no_hp+"&spesialisasi="+spesialisasi+"&jasa_dok="+jasa_dok+"&kd_dokter="+kd_dokter,
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
				            window.location='?page=datadokter' ;
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