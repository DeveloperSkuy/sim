<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-users"></i> Data Pasien</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul"><h4>Data Kasir Rajal </h4></div>
		<div class="col-6 text-right">
			<a href="?page=datapenjualan">
				<button class="btn btn-sm btn-info">Data Penjualan Obat</button>
			</a>
			            <a href="?page=laporbiling">
                <button class="btn btn-sm btn-warning">Export</button>
            </a>

			            <a href="?page=laporan_jasadokter">
                <button class="btn btn-sm btn-warning">Export Jasa</button>
            </a>

		</div>

	</div>
	<div class="table-container">
		<table id="example" class="table table-striped display tabel-data">
			<thead>
		        <tr>
		            <th>No Reg</th>
		            <th>Nama</th>
		            <th>No RM</th>
		            <th>Jenis Kelamin</th>
		            <th>Alamat</th>
		            <th>Tanggal Lahir</th>
		            <th>No HP</th>
		            <th>Tgl Daftar</th>
		            <th>Antrian</th>
		            <th>Opsi</th>
		 		        </tr>
		    </thead>
		    <tbody>
		<?php 
			$query_tampil = "SELECT * FROM tbl_daftarpasien where tgl_daftar = CURDATE() AND status='rawat' ORDER BY no_antrian DESC"  ;
			$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
			while($data = mysqli_fetch_array($sql_tampil)) {
		 ?>
		 		<tr>
		 			<td><?php echo $data['no_daftar']; ?></td>
		 			<td width="15%"><?php echo $data['nama_pas']; ?></td>
		 			<td><?php echo $data['nomor_rm']; ?></td>
		 			<td width="13%"><?php echo $data['jk_pas']; ?></td>
		 			<td width="20%"><?php echo $data['alm_pas']; ?></td>
		 			<td><?php echo $data['lhr_pas']; ?><br><small>
                <?php $lahir    =new DateTime($data['lhr_pas']);
                        $today        =new DateTime();
                        $umur = $today->diff($lahir);
                        echo $umur->y; echo " Tahun, "; echo $umur->m; echo " Bulan";
                    ?></small>
                </td>



		 			<td><?php echo $data['no_hp']; ?></td>
		 			<td><?php echo $data['tgl_daftar']; ?></td>
		 			<td width="20" align="center" ><font color="red"><h2><b><?php echo $data['no_antrian']; ?></b></h2></td>

		 			<td width="10%" class="td-opsi">

	                        <a href="laporan/nota_pembayaran.php?no_daftar=<?php echo $data['no_daftar']; ?>" target="_blank">
                              <button class="btn-transition btn btn-outline-dark btn-sm" title="cetak" id="tombol_cetak" name="tombol_cetak">
                                  <i class="fas fa-print"></i>
                              </button>
                            </a>


		 				<button class="btn-transition btn btn-outline-success btn-sm" title="detail pasien" id="tombol_detail" name="tombol_detail" data-toggle="modal" data-target="#detail_pasien"
		 				data-kode="<?php echo $data['no_daftar']; ?>"
		 				data-nama="<?php echo $data['nama_pas']; ?>"
		 				data-keluhan="<?php echo $data['keluhan']; ?>"
		 				data-tb="<?php echo $data['tinggi_badan']; ?>"
		 				data-bb="<?php echo $data['berat_badan']; ?>"
		 				data-temp="<?php echo $data['temp']; ?>"
		 				data-asuransi="<?php echo $data['asuransi_pas']; ?>">
                            <i class="fas fa-info-circle"></i>
                        </button>

                        <!-- <button class="btn-transition btn btn-outline-success btn-sm" title="lihat detail" id="tombol_detail">
                            <i class="fas fa-info-circle"></i>
                        </button> -->
                        <!-- <a href="?page=edit_datapasien&id=<?php echo $data['id_peg']; ?>"> -->
	                        <!-- <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit"> -->


	                    

	                        <button class="btn-transition btn btn-outline-primary btn-sm" title="Kasir" id="tombol_kasir" name="tombol_kasir" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-plus-circle"></i>
	                        </button>


                        <!-- </a> -->
<!--                         <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['no_daftar']; ?>" data-nama="<?php echo $data['nama_pas']; ?>">
                            <i class="fas fa-trash"></i>
                        </button> -->
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


		$("#det_kode").html(kode);
		$("#det_nama").html(nama);
		$("#det_keluhan").html(keluhan);
		$("#det_tb").html(tb);
		$("#det_bb").html(bb);
		$("#det_temp").html(temp);
		$("#det_asuransi").html(asuransi);


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

	$("button[name='tombol_kasir']").click(function() {
		var id = $(this).data('id');
		window.location='?page=pembayaran&id='+id;
	});

	$("button[name='tombol_obatracik']").click(function() {
		var id = $(this).data('id');
		window.location='?page=entry_obatracik&id='+id;
	});

		$("button[name='tombol_tindakan']").click(function() {
		var id = $(this).data('id');
		window.location='?page=entry_tindakanpasien&id='+id;
	});
</script>