<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-briefcase-medical"></i> Data Radiologi</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul"><h4>Data Aturan Pakai</h4></div>
		<div class="col-6 text-right">
  <a href="?page=tambah_dataakai">
        <button class="btn btn-sm btn-info">Tambah Data</button>
      </a>

<!-- 			<a href="?page=tambah_datadokter">
				<button class="btn btn-sm btn-info">Tambah Dokter</button> -->
			</a>
		</div>
	</div>



	<div class="table-container">
		<table id="example" class="table table-striped display tabel-data">
			<thead>
		        <tr>
		            <th>No</th>
		            <th>Aturan Pakai</th>

		            <th>Opsi</th>
		        </tr>
		    </thead>
		    <tbody>
		<?php 
/*			$no = 1;*/
			$query_tampil = "SELECT * FROM tbl_akai";
			$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
			while($data = mysqli_fetch_array($sql_tampil)) {
		 ?>
		 		<tr>
		 			<td><?php echo $data['id_akai']; ?></td>
		 			<td><?php echo $data['aturan_pakai']; ?></td>
		 			<td class="td-opsi">
                        <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit" name="tombol_edit" data-id="<?php echo $data['id_akai']; ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['id_akai']; ?>" data-nama="<?php echo $data['aturan_pakai']; ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
		 		</tr>
		 <?php 
			} 
		 ?>
		    </tbody>
		</table>
	</div>
</div>


<div class="modal fade" id="detail_obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Input Data Radiologi</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
 	<div class="form-container">
		<div class="row">
			<div class="col-md-10 offset-md-1 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data dokter baru</h6>
				<?php 
                   
                    $carikode = mysqli_query($conn, "SELECT MAX(kd_radiologi) as kodeTerbesar FROM data_radiologi ") ;
                    $datakode = mysqli_fetch_array($carikode);
 					$kd_radiologi = $datakode['kodeTerbesar'];
 					$urutan = (int) substr($kd_radiologi, 3, 3);
 					$urutan =$urutan+1;
 					$huruf = "RAD";
$kd_radiologi = $huruf . sprintf("%03s", $urutan);


                 ?>
				<form action="javascrip:void(0);"  autocomplete="off">
				  <div class="form-group row pt-3">
				    <label for="kd_radiologi" class="col-sm-3 col-form-label">Kode Radiologi</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm"  name="kd_radiologi" id="kd_radiologi" value="<?php echo $kd_radiologi; ?>" placeholder="masukkan kode Radiologi" autofocus="">
				    </div>
				  </div>
  <div class="col-sm-4">
                            <input name="tgl_input" id="tgl_input" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                        </div>

				  <div class="form-group row pt-3">
				    <label for="nm_dokter" class="col-sm-3 col-form-label">Nama Pemeriksaan</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm"  id="nama_radiologi" placeholder="masukkan nama Radiologi"  autofocus="">
				    </div>
				  </div>
  		
				  <div class="form-group row pt-3">
				    <label for="no_hp" class="col-sm-3 col-form-label">Harga </label>
				    <div class="col-sm-9">
				      <input type="number" class="form-control form-control-sm"  id="harga_radiologi" placeholder="masukkan Harga" autofocus="">
				    </div>
				  </div>


    <div class="col-sm-12 text-right">
              <button class="btn btn-info btn-sm" id="btn_save" name="btn_save" >Simpan</button>

				    </div>
				  </div>
				</form>
			</div>
		</div>
		</div>
  </div>













<script>
	$("button[name='tombol_hapus']").click(function() {
		var id = $(this).data('id');
		var nama = $(this).data('nama');
		
		Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda akan menghapus data '+nama+', semua data transaksi  yang berkaitan dengan Radiologi ini akan ikut terhapus',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=akai",
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
		            window.location='?page=data_akai';
		          }
		        })
              }
            })  
          }
        })
	    
	});

	$("button[name='tombol_edit']").click(function() {
		var id = $(this).data('id');
		window.location='?page=edit_dataakai&id='+id;
	});

		function reset_form() {
		$("#kd_radiologi").val("");
		$("#nama_radiologi").val("");
		$("#harga_radiologi").val("");
	}

	$("#btn_reset").click(function() {
		reset_form();
		document.getElementById("nama_radiologi").focus();
	});

	$("#btn_save").click(function() {
		var kode = $("#kd_radiologi").val();
		var nama_radiologi = $("#nama_radiologi").val();
		        var tgl_input = $("#tgl_input").val();
		var harga_radiologi = $("#harga_radiologi").val();


		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);
		if(kode=="") {
			document.getElementById("kd_radiologi").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi kode obat',
			  'warning'
			)

		}else if(nama_radiologi=="") {
			document.getElementById("nama_radiologi").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama dokter',
			  'warning'
			)
		} else if (harga_radiologi=="") {
			document.getElementById("harga_radiologi").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi harga radiologi',
			  'warning'
			)

		} else {
			$.ajax({
				type: "POST",
				url: "ajax/simpan_master_radiologi.php",
				data: "nama_radiologi="+nama_radiologi+"&kode="+kode+"&harga_radiologi="+harga_radiologi+"&tgl_input="+tgl_input,
				success: function(hasil) {
					if(hasil=="berhasil") {
						Swal.fire({
				          title: 'Berhasil',
				          text: 'Data Berhasil Disimpan',
				          type: 'success',
				          confirmButtonColor: '#3085d6',
				          confirmButtonText: 'OK'
				        }).then((ok) => {
				          if (ok.value) {
				           window.location='?page=data_radiologi' ;
				          }
				        })
					} else if(hasil=="gagal") {
						Swal.fire(
						  'Gagal',
						  'Data Gagal Disimpan',
						  'error'
						)
					}
				}
			});
		}
	});
</script>
