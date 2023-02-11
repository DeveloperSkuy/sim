<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-users"></i> Data Pasien</li>
  </ol>
</nav>

	 <?php if($_SESSION['posisi_peg'] == 'Admin') { ?>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul"><h4>Data Rawat Pasien Ranap</h4></div>
		<div class="col-6 text-right">
			<a href="?page=bankdata">
				<button class="btn btn-sm btn-info">Pendaftaran Pasien</button>
			</a>
		</div>

	</div>
	<div class="table-container">
		<table id="example" class="table table-striped display tabel-data" >
			<thead>
		        <tr>
		            <th>No Reg</th>
		            <th>Tgl masuk</th>
		            <th>Nama</th>
		            <th>No RM</th>
		            <th>Lama Hari</th>
		            <th>Ruangan</th>
    		        <th>Assesment</th>
					<th>Obat</th>

    		        <th>Penunjang</th>    		        
					<th>Tindakan</th>
		            <th>Detail</th>
		            <th>Pulang</th>
 		        </tr>
		    </thead>
		    <tbody>
		<?php 


			$query_tampil = "SELECT * FROM tbl_daftarpasienranap 


			where  ket = 'open' AND status='rawat' ORDER BY no_daftar DESC"  ;
			$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
			while($data = mysqli_fetch_array($sql_tampil)) {


$tarif=$data['trf_kamar'];
$tareg    =new DateTime($data['tgl_masuk']);
                        $today        =new DateTime();
                        $diff = $today->diff($tareg);

$total_hari = $data['trf_kamar']*($diff->d+1);
		 ?>
		 		<tr>
		 			<td><?php echo $data['no_daftar']; ?></td>
		 			<td><?php echo $data['tgl_masuk']; ?></td>
		 			<td ><?php echo $data['nama_pas']; ?>
		 					 				<br>
                    <small><?php echo $data['lhr_pas']; ?></small>

		 			</td>

		 			<td><?php echo $data['nomor_rm']; ?></td>
		 			                         <td><?php 
$tareg    =new DateTime($data['tgl_masuk']);
                        $today        =new DateTime();
                        $diff = $today->diff($tareg);
                        echo $diff->d+1; echo " Hari";?>

		 			<td><?php echo $data['kamar']; ?>
	 				<br>
                    <small>B: <?php echo $data['no_bed']; ?></small>
		 			</td>

<td><div class="btn-group">
								<a class="btn-transition btn btn-outline-primary btn-sm" href="#"><i class="icon-wrench icon-white"></i> Assesment</a>
								<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li> 
		                        <button class="btn-transition btn btn-outline-primary btn-sm" title="Diagnosa" id="tombol_diagnosa" name="tombol_diagnosa" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-user-edit"></i>Diagnosa</a> </li></i>
	                        </button> </li>


		                        <button class="btn-transition btn btn-outline-primary btn-sm" title="SOAP" id="tombol_soap" name="tombol_soap" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-medkit"></i> SOAP </a> </li></i>
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



<!-- <td>
		                        <button class="btn-transition btn btn-outline-primary btn-sm" title="Obat Racik" id="tombol_obatracik" name="tombol_obatracik" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-plus"></i>
	                        </button>
</td> -->

<td><div class="btn-group">
								<a class="btn-transition btn btn-outline-primary btn-sm" href="#"><i class="icon-wrench icon-white"></i> exam</a>
								<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li> 
		                        <button class="btn-transition btn btn-outline-primary btn-sm" title="Pemeriksaan Penunjang" id="tombol_penunjang" name="tombol_penunjang" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-plus-circle"></i> Laboratorium </a> </li></i>
	                        </button> </li>

		                        <button class="btn-transition btn btn-outline-primary btn-sm" title="Pemeriksaan Penunjang" id="tombol_penunjang_rad" name="tombol_penunjang_rad" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-plus-circle"></i> Radiologi </a> </li></i>
	                        </button> </li>


					
								</ul>
							</div></td>

<td>
		                         <button class="btn-transition btn btn-outline-primary btn-sm" title="Tindakan Pasien" id="tombol_tindakan" name="tombol_tindakan" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-user"></i>
	                        </button>
	                       </td> 
	<!-- 	 			<td width="10%" class="td-opsi"> -->
<td>
		 				<button class="btn-transition btn btn-outline-success btn-sm" title="detail pasien" id="tombol_detail" name="tombol_detail" data-toggle="modal" data-target="#detail_pasien"
		 				data-kode="<?php echo $data['no_daftar']; ?>"
		 				data-nama="<?php echo $data['nama_pas']; ?>"
		 				data-keluhan="<?php echo $data['nomor_rm']; ?>"
		 				data-tb="<?php echo $data['kamar']; ?>"
		 				data-bb="<?php echo $data['no_bed']; ?>"
		 				data-temp="<?php echo $data['tgl_masuk']; ?>"
		 				data-asuransi="<?php echo $data['asuransi_pas']; ?>">
                            <i class="fas fa-info-circle"></i>
                        </button>

	                        	<?php 
                          if ($data['status']=='aktif') { ?>
                            <a data-toggle="tooltip" data-placement="top" title="Proses" style="margin-right:5px" class="btn btn-warning btn-sm" href="user/proses.php?act=off&id=<?php echo $data['no_daftar'];?>">
                                <i style="color:#fff" class="fas fa-user"></i>
                            </a>

            <?php
                          } 
                          ?>
  <button class="btn-transition btn btn-outline-danger btn-sm" title="Upload" id="tombol_gambar" name="tombol_gambar" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-book"></i>
	                        </button>

                    </td>
<td>
                                                       <button class="btn-transition btn btn-outline-success btn-sm" title="Pulang" id="tombol_pulang" name="tombol_pulang" data-no_daftar="<?php echo $data['no_daftar']; ?>" data-nama_pas="<?php echo $data['nama_pas']; ?>">
                                        <i class="fas fa-check-square"></i>
                                    </button>
                                </td>
                    <?php } ?>
		 		</tr>
		 
		    </tbody>
		</table>
	</div>
</div>
  <?php } ?>







	 <?php if($_SESSION['posisi_peg'] == 'Dokter') { ?>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul"><h4>Data Rawat Pasien Ranap <?php echo $_SESSION['jenis_poli']; ?> </h4></div>
		<div class="col-6 text-right">
			<a href="?page=bankdata">
				<button class="btn btn-sm btn-info">Pendaftaran Pasien</button>
			</a>
		</div>

	</div>
	<div class="table-container">
		<table id="example" class="table table-striped display tabel-data" >
			<thead>
		        <tr>
		            <th>No Reg</th>
		            <th>Tgl masuk</th>
		            <th>Nama</th>
		            <th>No RM</th>
		            <th>Lama Hari</th>
		            <th>Ruangan</th>
    		        <th>Assesment</th>
					<th>Obat</th>

    		        <th>Penunjang</th>    		        
					<th>Tindakan</th>
		            <th>Detail</th>
		            <th>Pulang</th>
 		        </tr>
		    </thead>
		    <tbody>
		<?php 


			$query_tampil = "SELECT * FROM tbl_daftarpasienranap 


			where kamar = '".$_SESSION['jenis_poli']."' AND ket = 'open' AND status='rawat' ORDER BY no_daftar DESC"  ;
			$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
			while($data = mysqli_fetch_array($sql_tampil)) {


$tarif=$data['trf_kamar'];
$tareg    =new DateTime($data['tgl_masuk']);
                        $today        =new DateTime();
                        $diff = $today->diff($tareg);

$total_hari = $data['trf_kamar']*($diff->d+1);
		 ?>
		 		<tr>
		 			<td><?php echo $data['no_daftar']; ?></td>
		 			<td><?php echo $data['tgl_masuk']; ?></td>
		 			<td ><?php echo $data['nama_pas']; ?>
		 					 				<br>
                    <small><?php echo $data['lhr_pas']; ?></small>

		 			</td>

		 			<td><?php echo $data['nomor_rm']; ?></td>
		 			                         <td><?php 
$tareg    =new DateTime($data['tgl_masuk']);
                        $today        =new DateTime();
                        $diff = $today->diff($tareg);
                        echo $diff->d+1; echo " Hari";?>

		 			<td><?php echo $data['kamar']; ?>
	 				<br>
                    <small>B: <?php echo $data['no_bed']; ?></small>
		 			</td>

<td><div class="btn-group">
								<a class="btn-transition btn btn-outline-primary btn-sm" href="#"><i class="icon-wrench icon-white"></i> Assesment</a>
								<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li> 
		                        <button class="btn-transition btn btn-outline-primary btn-sm" title="Diagnosa" id="tombol_diagnosa" name="tombol_diagnosa" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-user-edit"></i>Diagnosa</a> </li></i>
	                        </button> </li>


		                        <button class="btn-transition btn btn-outline-primary btn-sm" title="SOAP" id="tombol_soap" name="tombol_soap" data-id="<?php echo $data['no_daftar']; ?>"><i class="fas fa-medkit"></i> SOAP </a> </li></i>
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



<!-- <td>
		                        <button class="btn-transition btn btn-outline-primary btn-sm" title="Obat Racik" id="tombol_obatracik" name="tombol_obatracik" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-plus"></i>
	                        </button>
</td> -->

<td><div class="btn-group">
								<a class="btn-transition btn btn-outline-primary btn-sm" href="#"><i class="icon-wrench icon-white"></i> exam</a>
								<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li> 
		                        <button class="btn-transition btn btn-outline-primary btn-sm" title="Pemeriksaan Penunjang" id="tombol_penunjang" name="tombol_penunjang" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-plus-circle"></i> Laboratorium </a> </li></i>
	                        </button> </li>

		                        <button class="btn-transition btn btn-outline-primary btn-sm" title="Pemeriksaan Penunjang" id="tombol_penunjang_rad" name="tombol_penunjang_rad" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-plus-circle"></i> Radiologi </a> </li></i>
	                        </button> </li>


					
								</ul>
							</div></td>

<td>
		                         <button class="btn-transition btn btn-outline-primary btn-sm" title="Tindakan Pasien" id="tombol_tindakan" name="tombol_tindakan" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-user"></i>
	                        </button>
	                       </td> 
	<!-- 	 			<td width="10%" class="td-opsi"> -->
<td>
		 				<button class="btn-transition btn btn-outline-success btn-sm" title="detail pasien" id="tombol_detail" name="tombol_detail" data-toggle="modal" data-target="#detail_pasien"
		 				data-kode="<?php echo $data['no_daftar']; ?>"
		 				data-nama="<?php echo $data['nama_pas']; ?>"
		 				data-keluhan="<?php echo $data['nomor_rm']; ?>"
		 				data-tb="<?php echo $data['kamar']; ?>"
		 				data-bb="<?php echo $data['no_bed']; ?>"
		 				data-temp="<?php echo $data['tgl_masuk']; ?>"
		 				data-asuransi="<?php echo $data['asuransi_pas']; ?>">
                            <i class="fas fa-info-circle"></i>
                        </button>

	                        	<?php 
                          if ($data['status']=='aktif') { ?>
                            <a data-toggle="tooltip" data-placement="top" title="Proses" style="margin-right:5px" class="btn btn-warning btn-sm" href="user/proses.php?act=off&id=<?php echo $data['no_daftar'];?>">
                                <i style="color:#fff" class="fas fa-user"></i>
                            </a>

            <?php
                          } 
                          ?>
  <button class="btn-transition btn btn-outline-danger btn-sm" title="Upload" id="tombol_gambar" name="tombol_gambar" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-book"></i>
	                        </button>

                    </td>
<td>
                                                       <button class="btn-transition btn btn-outline-success btn-sm" title="Pulang" id="tombol_pulang" name="tombol_pulang" data-no_daftar="<?php echo $data['no_daftar']; ?>" data-nama_pas="<?php echo $data['nama_pas']; ?>">
                                        <i class="fas fa-check-square"></i>
                                    </button>
                                </td>
                    <?php } ?>
		 		</tr>
		 
		    </tbody>
		</table>
	</div>
</div>
  <?php } ?>

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
          <th>Nomor RM</th>
          <td id="det_keluhan"></td>
        </tr>
        <tr>
          <th>Kamar</th>
          <td id="det_tb"></td>
        </tr>
        <tr>
          <th>No. BED</th>
          <td id="det_bb"></td>
        </tr>
        <tr>
          <th>Tgl Masuk</th>
          <td id="det_temp"></td>
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


	$("button[name='tombol_diagnosa']").click(function() {
		var id = $(this).data('id');
		window.location='?page=diagnosa&id='+id;
	});

	$("button[name='tombol_soap']").click(function() {
		var id = $(this).data('id');
		window.location='?page=assesmen&id='+id;
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


		$("button[name='tombol_gambar']").click(function() {
		var id = $(this).data('id');
		window.location='?page=entry_gambar_ranap&id='+id;
	});

	$("button[name='tombol_obatpasien']").click(function() {
		var id = $(this).data('id');
		window.location='?page=entry_obatpasienranap&id='+id;
	});

	$("button[name='tombol_penunjang']").click(function() {
		var id = $(this).data('id');
		window.location='?page=entry_penunjang_ranap&id='+id;
	});

	$("button[name='tombol_penunjang_rad']").click(function() {
		var id = $(this).data('id');
		window.location='?page=entry_penunjang_radiologi&id='+id;
	});

	$("button[name='tombol_obatracik']").click(function() {
		var id = $(this).data('id');
		window.location='?page=entry_obatracik_ranap&id='+id;
	});

		$("button[name='tombol_tindakan']").click(function() {
		var id = $(this).data('id');
		window.location='?page=entry_tindakanpasien_ranap&id='+id;
	});

 $("button[name='tombol_pulang']").click(function() {
        var no_daftar = $(this).data("no_daftar");
        var nama_pas = $(this).data("nama_pas");
        Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda telah Memulangkan '+no_daftar+' dengan nama '+nama_pas+', data ini tidak dapat dirubah kembali.',
          type: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#28A745',
          cancelButtonText: 'Tidak',
          confirmButtonText: 'Pulang'
        }).then((lunas) => {
          if (lunas.value) {
            $.ajax({
              type: "POST",
              url: "ajax/detail.php?page=rawatpulang",
              data: "no_daftar="+no_daftar,
              success: function(hasil2) {
                Swal.fire({
                  title: 'Berhasil',
                  text: 'Pasien telah dirawat',
                  type: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                    }).then((ok) => {
			          if (ok.value) {
			            window.location='?page=perawatan_ranap';
			          }
			        })
              }
            })  
          }
        })
    });

</script>

