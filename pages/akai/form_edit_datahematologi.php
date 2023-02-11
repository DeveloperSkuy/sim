<?php 
	$id = @$_GET['id'];
 ?>
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datasupplier"><i class="fas fa-briefcase-medical"></i> Data Akai</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Kesan Laboratorium </li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Kesan Laboratorium</h4></div>
		<div class="col-6 text-right">
			<a href="?page=labor_rajal">
				<button class="btn btn-sm btn-info">Laboratorium </button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-6 offset-md-3 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk Kesan</h6>
				<form action="javascrip:void(0);"  autocomplete="off">
				  <div class="form-group row pt-3">
<!-- 				    <label for="no" class="col-sm-3 col-form-label">Id</label> -->
				    <div class="col-sm-9">
				      <input type="hidden" class="form-control form-control-sm" id="id" placeholder="masukkan no" value="<?php echo $id; ?>" disabled="">
				    </div>
				  </div>
	
				<?php 

				$tanggal = date("Y-m-d H:i:s");
				  	$query_tampil = "SELECT tbl_hematologidetail.*, tbl_hematologidetail.kd_hematologi, tbl_hematologi.no_daftar,  tbl_nama_hematologi.nama_hematologi FROM tbl_hematologidetail
                  LEFT JOIN tbl_hematologi ON tbl_hematologidetail.no_lab=tbl_hematologi.no_lab
                    LEFT JOIN tbl_nama_hematologi ON tbl_hematologidetail.kd_hematologi=tbl_nama_hematologi.kd_hematologi

                WHERE  no='$id'";
					$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
					$datasu = mysqli_fetch_array($sql_tampil);
				   
				   ?>
				  <div class="form-group row pt-3">
 				   <label for="no" class="col-sm-3 col-form-label">Pemeriksaan </label> 
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nama" placeholder="masukkan Pemeriksaan" value="<?php echo $datasu['nama_hematologi']; ?>" disabled="">
				    </div>
				  </div>

                     				  <div class="form-group row pt-3">
				    <label for="kesan" class="col-sm-3 col-form-label">Kesan</label>
				    <div class="col-sm-9">
				      <textarea type="text" class="form-control form-control-sm"
rows="5"
				       id="kesan" placeholder="masukkan kesan" autofocus="" ><?php echo $datasu['kesan']; ?></textarea>
				    </div>
				  </div>

                     				  <div class="form-group row pt-3">
				    <label for="expired" class="col-sm-3 col-form-label">Waktu</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm"
				       id="expired" value="<?php echo $tanggal; ?>">
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
		var id = $("#id").val();
		var kesan = $("#kesan").val();
		var expired= $("#expired").val();

		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

	 if (kesan=="") {
			document.getElementById("kesan").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama radiologi',
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
	              url: "ajax/update_hematologi.php",
	              data: "kesan="+kesan+"&expired="+expired+"&id="+id,
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
				            window.location.href = '?page=lab_hematologi_jalan&id='+$id;
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