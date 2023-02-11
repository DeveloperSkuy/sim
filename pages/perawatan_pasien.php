<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-users"></i> Data Pasien</li>
  </ol>
</nav>
			
 <?php if($_SESSION['posisi_peg'] == 'Admin') { ?>			
<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul"><h4>Data Rawat Pasien Poli </h4></div>
		<div class="col-6 text-right">
			<a href="?page=bankdata">
				<button class="btn btn-sm btn-info">Pendaftaran Pasien</button>
			</a>
		</div>
  				    	<span class="nama"></span><br>

	</div>


	<div class="table-container">
		<table id="example" class="table table-striped display tabel-data" >
			<thead>
		        <tr>
		            <th>No Reg</th>
		            <th>Nama</th>
		            <th>No RM</th>

		            <th>Antrian</th>
    		        <th>Assesment</th>
					<th>Obat</th>

					<th>Tindakan</th>
					<th>Penunjang</th>
					<th>Upload</th>
		            <th>Detail</th>
		 		        </tr>
		    </thead>
		    <tbody>



		<?php 
			$query_tampil = "SELECT * FROM tbl_daftarpasien where  tgl_daftar = CURDATE() AND status='rawat' ORDER BY no_antrian DESC"  ;
			$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
			while($data = mysqli_fetch_array($sql_tampil)) {
		 ?>
		 		<tr>
		 			<td><?php echo $data['no_daftar']; ?></td>
		 			<td width="15%"><?php echo $data['nama_pas']; ?></td>
		 			<td><?php echo $data['nomor_rm']; ?></td>

		 			<td width="20" align="center" ><font color="red"><h3><b><?php echo $data['no_antrian']; ?></b></h3></td>

<td><button class="btn-transition btn btn-outline-primary btn-sm" title="Diagnosa" id="tombol_diagnosa_rajal" name="tombol_diagnosa_rajal" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-calendar-plus"></i> </a> </li></i>
	                        </button></td>

<!-- 	                        <div class="btn-group">

								<a class="btn-transition btn btn-outline-primary btn-sm" href="#"><i class="icon-wrench icon-white"></i> Assesment</a>
								<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li> 
 <button class="btn-transition btn btn-outline-primary btn-sm" title="Diagnosa" id="tombol_edit" name="tombol_edit" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-user-edit"></i></i>Diagnosa</a> </li></i>
	                        </button> </li>


<button class="btn-transition btn btn-outline-primary btn-sm" title="Diagnosa" id="tombol_diagnosa_rajal" name="tombol_diagnosa_rajal" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-calendar-plus"></i> SOAP </a> </li></i>
	                        </button> </li>

				
								</ul>
							</div></td> -->

<td><div class="btn-group">
								<a class="btn-transition btn btn-outline-primary btn-sm" href="#"><i class="icon-wrench icon-white"></i> Obat</a>
								<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li> 
		                        <button class="btn-transition btn btn-outline-primary btn-sm" title="Obat Pasien" id="tombol_obatpasien" name="tombol_obatpasien" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-plus-circle"></i>Obat</a> </li></i>
	                        </button> </li>


		                        <button class="btn-transition btn btn-outline-primary btn-sm" title="Obat Racik" id="tombol_obatracik" name="tombol_obatracik" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-plus"></i> Obat Racik </a> </li></i>
	                        </button> </li>
			
								</ul>
							</div></td>


<td>
		                         <button class="btn-transition btn btn-outline-primary btn-sm" title="Tindakan Pasien" id="tombol_tindakan" name="tombol_tindakan" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-user"></i>
	                        </button>

<td>
		                        <button class="btn-transition btn btn-outline-primary btn-sm" title="Pemeriksaan Penunjang" id="tombol_penunjang" name="tombol_penunjang" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-plus-circle"></i>
	                        </button>
</td>

	                       </td> 
<td>
		                         <button class="btn-transition btn btn-outline-primary btn-sm" title="Upload" id="tombol_gambar" name="tombol_gambar" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-book"></i>
	                        </button>
	                       </td> 
<td>
		 				<button class="btn-transition btn btn-outline-success btn-sm" title="detail pasien" id="tombol_detail" name="tombol_detail" data-toggle="modal" data-target="#detail_pasien"
		 				data-kode="<?php echo $data['no_daftar']; ?>"
		 				data-nama="<?php echo $data['nama_pas']; ?>"
		 				data-keluhan="<?php echo $data['keluhan']; ?>"
		 				data-tb="<?php echo $data['tinggi_badan']; ?>"
		 				data-bb="<?php echo $data['berat_badan']; ?>"
		 				data-temp="<?php echo $data['temp']; ?>"
		 				data-diagnosa="<?php echo $data['diagnosa']; ?>"
		 				data-asuransi="<?php echo $data['asuransi_pas']; ?>">
                            <i class="fas fa-info-circle"></i>
                        </button>

                        <!-- <button class="btn-transition btn btn-outline-success btn-sm" title="lihat detail" id="tombol_detail">
                            <i class="fas fa-info-circle"></i>
                        </button> -->
                        <!-- <a href="?page=edit_datapasien&id=<?php echo $data['id_peg']; ?>"> -->
	                        <!-- <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit"> -->
	                        	<?php 
                          if ($data['status']=='aktif') { ?>
                            <a data-toggle="tooltip" data-placement="top" title="Proses" style="margin-right:5px" class="btn btn-warning btn-sm" href="user/proses.php?act=off&id=<?php echo $data['no_daftar'];?>">
                                <i style="color:#fff" class="fas fa-user"></i>
                            </a>

            <?php
                          } 
                          ?>
<?php } ?>


                    </td>
                    <?php } ?>
		 		</tr>
		 
		    </tbody>
		</table>


			 <?php if($_SESSION['posisi_peg'] == 'Dokter' || $_SESSION['posisi_peg'] == 'Perawat') { ?>
			
			<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul"><h4>Data Rawat Pasien Poli <?php echo $_SESSION['jenis_poli']; ?> </h4></div>
		<div class="col-6 text-right">
			<a href="?page=bankdata">
				<button class="btn btn-sm btn-info">Pendaftaran Pasien</button>
			</a>
		</div>
  				    	<span class="nama"></span><br>

	</div>


	<div class="table-container">
		<table id="example" class="table table-striped display tabel-data" >
			<thead>
		        <tr>
		            <th>No Reg</th>
		            <th>Nama</th>
		            <th>No RM</th>

		            <th>Antrian</th>
    		        <th>Assesment</th>
					<th>Obat</th>

					<th>Tindakan</th>
					<th>Penunjang</th>
					<th>Upload</th>
		            <th>Detail</th>
		 		        </tr>
		    </thead>
		    <tbody>



		<?php 
			$query_tampil = "SELECT * FROM tbl_daftarpasien where proses = '".$_SESSION['jenis_poli']."'  AND tgl_daftar = CURDATE() AND status='rawat' ORDER BY no_antrian DESC"  ;
			$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
			while($data = mysqli_fetch_array($sql_tampil)) {
		 ?>
		 		<tr>
		 			<td><?php echo $data['no_daftar']; ?></td>
		 			<td width="15%"><?php echo $data['nama_pas']; ?></td>
		 			<td><?php echo $data['nomor_rm']; ?></td>

		 			<td width="20" align="center" ><font color="red"><h3><b><?php echo $data['no_antrian']; ?></b></h3></td>

<td><div class="btn-group">

								<a class="btn-transition btn btn-outline-primary btn-sm" href="#"><i class="icon-wrench icon-white"></i> Assesment</a>
								<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li> 
 <button class="btn-transition btn btn-outline-primary btn-sm" title="Diagnosa" id="tombol_edit" name="tombol_edit" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-user-edit"></i></i>Diagnosa</a> </li></i>
	                        </button> </li>


<button class="btn-transition btn btn-outline-primary btn-sm" title="Diagnosa" id="tombol_diagnosa_rajal" name="tombol_diagnosa_rajal" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-calendar-plus"></i> SOAP </a> </li></i>
	                        </button> </li>

				
								</ul>
							</div></td>

<td><div class="btn-group">
								<a class="btn-transition btn btn-outline-primary btn-sm" href="#"><i class="icon-wrench icon-white"></i> Obat</a>
								<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li> 
		                        <button class="btn-transition btn btn-outline-primary btn-sm" title="Obat Pasien" id="tombol_obatpasien" name="tombol_obatpasien" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-plus-circle"></i>Obat</a> </li></i>
	                        </button> </li>


		                        <button class="btn-transition btn btn-outline-primary btn-sm" title="Obat Racik" id="tombol_obatracik" name="tombol_obatracik" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-plus"></i> Obat Racik </a> </li></i>
	                        </button> </li>
			
								</ul>
							</div></td>


<td>
		                         <button class="btn-transition btn btn-outline-primary btn-sm" title="Tindakan Pasien" id="tombol_tindakan" name="tombol_tindakan" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-user"></i>
	                        </button>

<td>
		                        <button class="btn-transition btn btn-outline-primary btn-sm" title="Pemeriksaan Penunjang" id="tombol_penunjang" name="tombol_penunjang" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-plus-circle"></i>
	                        </button>
</td>

	                       </td> 
<td>
		                         <button class="btn-transition btn btn-outline-primary btn-sm" title="Upload" id="tombol_gambar" name="tombol_gambar" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-book"></i>
	                        </button>
	                       </td> 
<td>
		 				<button class="btn-transition btn btn-outline-success btn-sm" title="detail pasien" id="tombol_detail" name="tombol_detail" data-toggle="modal" data-target="#detail_pasien"
		 				data-kode="<?php echo $data['no_daftar']; ?>"
		 				data-nama="<?php echo $data['nama_pas']; ?>"
		 				data-keluhan="<?php echo $data['keluhan']; ?>"
		 				data-tb="<?php echo $data['tinggi_badan']; ?>"
		 				data-bb="<?php echo $data['berat_badan']; ?>"
		 				data-temp="<?php echo $data['temp']; ?>"
		 				data-diagnosa="<?php echo $data['diagnosa']; ?>"
		 				data-asuransi="<?php echo $data['asuransi_pas']; ?>">
                            <i class="fas fa-info-circle"></i>
                        </button>

                        <!-- <button class="btn-transition btn btn-outline-success btn-sm" title="lihat detail" id="tombol_detail">
                            <i class="fas fa-info-circle"></i>
                        </button> -->
                        <!-- <a href="?page=edit_datapasien&id=<?php echo $data['id_peg']; ?>"> -->
	                        <!-- <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit"> -->
	                        	<?php 
                          if ($data['status']=='aktif') { ?>
                            <a data-toggle="tooltip" data-placement="top" title="Proses" style="margin-right:5px" class="btn btn-warning btn-sm" href="user/proses.php?act=off&id=<?php echo $data['no_daftar'];?>">
                                <i style="color:#fff" class="fas fa-user"></i>
                            </a>

            <?php
                          } 
                          ?>
<?php } ?>


                    </td>
                    <?php } ?>
		 		</tr>
		 
		    </tbody>
		</table>
	</div>
</div>



<div class="modal fade" id="detail_pasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Info Detail Pasien</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <table class="tabel-detail-obat" style="font-size: 14px;">
        <tr>
          <th>Registrasi</th>
          <td id="det_kode"></td>
        </tr>
        <tr>
          <th>Nama</th>
          <td id="det_nama"></td>
        </tr>
        <tr>
          <th>Keluhan</th>
          <td id="det_keluhan"></td>
        </tr>
        <tr>
          <th>Tinggi</th>
          <td id="det_tb"></td>
        </tr>
        <tr>
          <th>Berat Badan</th>
          <td id="det_bb"></td>
        </tr>
        <tr>
          <th>Temperatur</th>
          <td id="det_temp"></td>
        </tr>
        <tr>
          <th>Diagnosa</th>
          <td id="det_diagnosa"></td>
        </tr>
        <tr>
          <th>Asuransi</th>
          <td id="det_asuransi"></td>
        </tr>
      </table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">tutup</button>
    </div>
  </div>
</div>
</div>


<script>
	$("button[name='tombol_detail']").click(function(){
		var kode = $(this).data('kode');
		var nama = $(this).data('nama');
		var keluhan = $(this).data('keluhan');
		var tb = $(this).data('tb');
		var bb = $(this).data('bb');
		var temp = $(this).data('temp');
		var asuransi = $(this).data('asuransi');
		var diagnosa = $(this).data('diagnosa');

		$("#det_kode").html(kode);
		$("#det_nama").html(nama);
		$("#det_keluhan").html(keluhan);
		$("#det_tb").html(tb);
		$("#det_bb").html(bb);
		$("#det_temp").html(temp);
		$("#det_asuransi").html(asuransi);
		$("#det_diagnosa").html(diagnosa);

	});


	$("button[name='tombol_edit']").click(function() {
		var id = $(this).data('id');
		window.location='?page=edit_pendaftaran&id='+id;
	});

	$("button[name='tombol_diagnosa_rajal']").click(function() {
		var id = $(this).data('id');
		window.location='?page=diagnosa_rajal&id='+id;
	});



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
	              url: "ajax/hapus.php?page=datapendaftaran",
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
			            window.location='?page=datapendaftaran';
			          }
			        })
	              }
	            })  
	          }
	        })
	    }
	});

	$("button[name='tombol_obatpasien']").click(function() {
		var id = $(this).data('id');
		window.location='?page=entry_obatpasien&id='+id;
	});

	$("button[name='tombol_obatracik']").click(function() {
		var id = $(this).data('id');
		window.location='?page=entry_obatracik&id='+id;
	});

		$("button[name='tombol_tindakan']").click(function() {
		var id = $(this).data('id');
		window.location='?page=entry_tindakanpasien&id='+id;
	});

		$("button[name='tombol_gambar']").click(function() {
		var id = $(this).data('id');
		window.location='?page=entry_gambar&id='+id;
	});

			$("button[name='tombol_penunjang']").click(function() {
		var id = $(this).data('id');
		window.location='?page=entry_penunjang&id='+id;
	});

</script>