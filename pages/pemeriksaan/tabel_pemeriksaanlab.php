<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-users"></i> Data Pasien</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6" id="judul"><h4>Data Master Pemeriksaan LAB</h4></div>
		<div class="col-6 text-right">
			<a href="?page=tambah_pemeriksaanlab">
				<button class="btn btn-sm btn-info">Tabel Pemeriksaan</button>
			</a>
		</div>

	</div>
	<div class="table-container">
		<table id="example" class="table table-striped display tabel-data">
			<thead>
		        <tr>
      <th>Kode</th>
                    <th>Nama Pemeriksaan</th>
                    <th>Satuan</th>
                    <th>Nilai Normal</th>
                    <th>Opsi</th>
                    </tr>
		    </thead>
		    <tbody>
		<?php 

/*            $query_tampil = "SELECT * FROM tbl_nama_hematologi INNER JOIN  tbl_nama_hematologidetail ON tbl_nama_hematologi.kd_racik = tbl_nama_hematologidetail.kd_racik INNER JOIN  tbl_dataobat ON tbl_nama_hematologidetail.kd_obat = tbl_dataobat.kd_obat WHERE tbl_nama_hematologi.status = 'aktif' ORDER BY tbl_nama_hematologi.nama_hematologi ASC";*/


            $query_tampil = "SELECT * FROM tbl_nama_hematologi  WHERE status = 'aktif' ORDER BY nama_hematologi ASC";
            $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
			while($dutang = mysqli_fetch_array($sql_tampil)) {
		 ?>
		 		<tr>
		 			  <td><?php echo $dutang['kd_hematologi']; ?></td>
                    <td><?php echo $dutang['nama_hematologi']; ?></td>
                    <td><?php echo $dutang['satuan']; ?></td>
                    <td><?php echo $dutang['nilai_normal']; ?></td>

		 			<td width="10%" class="td-opsi">
                        <!-- <button class="btn-transition btn btn-outline-success btn-sm" title="lihat detail" id="tombol_detail">
                            <i class="fas fa-info-circle"></i>
                        </button> -->
                        <!-- <a href="?page=edit_datapasien&id=<?php echo $data['id_peg']; ?>"> -->
	                        <!-- <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit"> -->

                                <button class="btn-transition btn btn-outline-success btn-sm" title="Edit Hematologi" id="tombol_hematologi_pasien" name="tombol_hematologi_pasien" data-id="<?php echo $dutang['kd_hematologi']; ?>">
                              <i class="fas fa-medkit"></i>
                          </button>

                                    <button class="btn-transition btn btn-outline-danger btn-sm" title="Hapus" id="tombol_racik" name="tombol_racik" data-kd_hematologi="<?php echo $dutang['kd_hematologi']; ?>" data-nama_hematologi="<?php echo $dutang['nama_hematologi']; ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>

<!--                                     <button class="btn-transition btn btn-outline-primary btn-sm" title="detail hematologi" id="tombol_detailhematologi" name="tombol_detailhematologi" data-toggle="modal" data-target="#detail_hematologi" data-kd_racik="<?php echo $dutang['kd_racik']; ?>" data-tgl_racik="<?php echo tgl_indo($dutang['tgl_racik']); ?>" data-nama_hematologi="<?php echo $dutang['nama_hematologi']; ?>"
                                    	data-stk_obat="<?php echo $dutang['stk_obat']; ?>">
                                        <i class="fas fa-info-circle"></i>
                                    </button> -->



<!-- 	                        <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit" name="tombol_edit" data-id="<?php echo $data['no_daftar']; ?>">
	                            <i class="fas fa-user-edit"></i>
	                        </button>
                        <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['no_daftar']; ?>" data-nama="<?php echo $data['nama_pas']; ?>">
                            <i class="fas fa-trash"></i>
                        </button> -->
                    </td>
                    <?php } ?>
		 		</tr>
		 
		    </tbody>
		</table>
	</div>
</div>



<div class="modal fade" id="detail_hematologi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Detail Obat Hematologi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        	<table class="tabel-profil">
        		<tr>
        			<th>No Faktur</th>
        			<td id="kd_racikdetail">PJL00001</td>
        			<th>Tanggal</th>
        			<td id="tgl_racikdetail">20/11/19</td>
        		</tr>
         		<tr>
        			<th>Nama Hematologi</th>
        			<td id="nama_hematologidetail">Nama Hematologi</td>
                    <th>Stok</th>
                    <td id="stk_obatdetail">Stok</td>
        		</tr>
        	</table>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Nama Obat</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Satuan</th>
						<th>Subtotal</th>
					</tr>
				</thead>
				<tbody id="data_detailhematologi">
					<!-- diisi dengan ajax jquery -->
				</tbody>
						<tfoot>
					<tr>
						<th colspan="4" class="text-right">Total :</th>
						<th class="text-right">
							<span id="total_pembeliandetail"></span>
						</th>
					</tr>
				</tfoot>
			</table>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        </div> -->
      </div>
    </div>
</div>


<script>

	$("button[name='tombol_detailhematologi']").click(function() {
		var kd_racik = $(this).data("kd_racik");
		var tgl_racik = $(this).data("tgl_racik");
		var nama_hematologi = $(this).data("nama_hematologi");
				var stk_obat = $(this).data("stk_obat");
		$("#kd_racikdetail").html(kd_racik);
		$("#tgl_racikdetail").html(tgl_racik);
		$("#nama_hematologidetail").html(nama_hematologi);
				$("#stk_obatdetail").html(stk_obat);


		$("#data_detailhematologi").html("");
		$.ajax({
			type: "GET",
			url: "ajax/detail.php?page=hematologi",
			data: "kd_racik="+kd_racik,
			success : function(data) {
				// console.log(data);
			var total_pembelian = 0;
				var objData = JSON.parse(data);
				$.each(objData, function(key,val){
					// $("#data_detailpjl").append(val.nm_obat+"/"+val.hrg_jual+"/"+val.jml_jual+"/"+val.sat_jual+"/"+val.subtotal+"<br>");
					var baris_baru = '';
					baris_baru += '<tr>';
					baris_baru += 	'<td>'+val.nm_obat+'</td>';
					baris_baru += 	'<td class="text-right">'+val.hrg_jual+'</td>';
					baris_baru += 	'<td class="text-center">'+val.jumlah+'</td>';
					baris_baru += 	'<td>'+val.sat_jual+'</td>';
					baris_baru += 	'<td class="text-right">'+val.subtotal+'</td>';
					baris_baru += '</tr>';
					total_pembelian = total_pembelian + Number(val.subtotal);
					$("#data_detailhematologi").append(baris_baru);
					$("#total_pembeliandetail").html(total_pembelian);

				})
			}
		});
	});


$("button[name='tombol_hematologi_pasien']").click(function() {
    var id = $(this).data('id');
    window.location='?page=edit_pemeriksaanlab&id='+id;
  });





 $("button[name='tombol_racik']").click(function() {
        var kd_hematologi = $(this).data("kd_hematologi");
        var nama_hematologi = $(this).data("nama_hematologi");
        Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda Ingin Menghapus '+kd_hematologi+' dengan nama '+nama_hematologi+', data ini tidak dapat dirubah kembali.',
          type: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#28A745',
          cancelButtonText: 'Tidak',
          confirmButtonText: 'Daftar'
        }).then((lunas) => {
          if (lunas.value) {
            $.ajax({
              type: "POST",
              url: "ajax/detail.php?page=hematologi",
              data: "kd_hematologi="+kd_hematologi,
              success: function(hasil2) {
                Swal.fire({
                  title: 'Berhasil',
                  text: 'Pasien telah dirawat',
                  type: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                    }).then((ok) => {
			          if (ok.value) {
			            window.location='?page=tabel_pemeriksaanlab';
			          }
			        })
              }
            })  
          }
        })
    });

</script>