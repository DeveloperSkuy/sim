<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datapasien"><i class="fas fa-briefcase-medical"></i> Data Pasien</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Tambah Data Pasien</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Tambah Data Pasien</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datapasien">
				<button class="btn btn-sm btn-info">Daftar Data Pasien</button>
			</a>
		</div>
	</div>

<?php
                     $carikode = mysqli_query($conn, "SELECT MAX(id_pas) as kodeTerbesar FROM tbl_pasien ") ;
                    $datakode = mysqli_fetch_array($carikode);
 					$id_pas = $datakode['kodeTerbesar'];
 					$urutan = (int) substr($id_pas, 4, 4);
 					$urutan =$urutan+1;
 					$huruf = "";
$id_pas = $huruf . sprintf("%06s", $urutan);

?>

	<div class="form-container">
		<div class="row">
			<div class="col-md-10 offset-md-1 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data pasien baru</h6>
				<form action="javascrip:void(0);"  autocomplete="off">
				  <div class="form-group row pt-3">
				    <label for="nama_pas" class="col-sm-3 col-form-label">Nama Pasien</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="nama_pas" placeholder="masukkan nama pasien" autofocus="">
				    </div>
				  </div>
				  	  <div class="form-group row pt-3">
				    <label for="nomor_rm" class="col-sm-3 col-form-label">Nomor RM</label>
				    <div class="col-sm-9">

				      <input type="text" class="form-control form-control-sm" id="nomor_rm" value="<?php echo $id_pas; ?>" placeholder="masukkan nomor RM"  autofocus="">
				    </div>
				  </div>

				  				  	  <div class="form-group row pt-3">
				    <label for="nik" class="col-sm-3 col-form-label">NIK</label>
				    <div class="col-sm-9">

				      <input type="number" class="form-control form-control-sm" id="nik" value="" placeholder="masukkan NIK"  autofocus="">
				    </div>
				  </div>
				  <div class="form-group row pt-3">
				    <label for="jk_pas" class="col-sm-3 col-form-label">Jenis Kelamin</label>
				    <div class="col-sm-9">
				      <!-- <input type="text" class="form-control form-control-sm" id="jk_peg" placeholder="masukkan nama obat"> -->
				      <div class="form-check">
				      	<label class="form-check-label" style="font-weight: normal;">
				      		<input name="jk_pas" id="jk_pas1" type="radio" class="form-check-input" value="Laki-laki" checked=""> 
				      		Laki-laki
				      	</label>
				      </div>
                      <div class="form-check">
                    	<label class="form-check-label" style="font-weight: normal;">
                    		<input name="jk_pas" id="jk_pas2" type="radio" class="form-check-input" value="Perempuan">
                    		Perempuan
                    	</label>
                	  </div>
				    </div>
				  </div>

				  <div class="form-group row pt-3">
				    <label for="tlahir_pas" class="col-sm-3 col-form-label">Tanggal Lahir</label>
				    <div class="col-sm-9">
				      <input type="date" class="form-control form-control-sm" id="tlahir_pas" placeholder="masukkan tanggal lahir pasien">
				      <small class="form-text text-muted" style="text-align: right;">bulan/tanggal/tahun</small>
				    </div>
				  </div>


				  <div class="form-group row pt-3">
				    <label for="asuransi_pas" class="col-sm-3 col-form-label">Asuransi</label>
				    <div class="col-sm-9">
				      <select name="asuransi_pas" id="asuransi_pas" class="form-control form-control-sm">
				      	<option value="0">pilih Asuransi</option>
				      	<option value="BPJS Kesehatan">BPJS Kesehatan</option>
				      	<option value="Pribadi">Pribadi</option>
				      </select>
				    </div>
				  </div>

				  <div class="form-group row pt-3">
				    <label for="no_hp" class="col-sm-3 col-form-label">No HP</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" value ="" id="no_hp" placeholder="masukkan nomor hp pasien" autofocus="">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="alm_pas" class="col-sm-3 col-form-label">Alamat </label>
				    <div class="col-sm-9">
				      <textarea name="alm_pas" id="alm_pas" rows="2" class="form-control" placeholder="masukkan alamat pasien" style="font-size: 14px;"></textarea>
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="desa" class="col-sm-3 col-form-label">Desa</label>
				    <div class="col-sm-9">

                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="desa" name="desa">
                                <input type="hidden" class="form-control form-control-sm" id="kode_id" name="kode_id">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_datawilayah" id="lihat_data_pasien"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>

                        </div>


				  <div class="form-group row">
				    <label for="kec" class="col-sm-3 col-form-label">Kecamatan</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="kec" placeholder="masukkan Kecamatan" autofocus="">
				    </div>
				  </div>

				  <div class="form-group row">
				    <label for="kab_kota" class="col-sm-3 col-form-label">Kabupaten/Kota</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="kab_kota" placeholder="masukkan Kabupaten" autofocus="">
				    </div>
				  </div>



				  <div class="form-group row">
				    <label for="provinsi" class="col-sm-3 col-form-label">Kabupaten/Kota</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control form-control-sm" id="provinsi" placeholder="masukkan Kabupaten" autofocus="">
				    </div>
				  </div>

				    <div class="col-sm-9">
				      <input type="hidden" class="form-control form-control-sm" id="poscode" placeholder="masukkan Kabupaten" autofocus="">
				    </div>



				  <div class="form-group row">
				    <div class="col-sm-12 text-right">
				      <button class="btn btn-danger btn-sm" id="btn_reset">Reset</button>
				      <button class="btn btn-info btn-sm" id="btn_simpan">Simpan</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal_datawilayah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Wilayah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="example" class="table table-striped display">
            <thead>
                <tr>
                    <th>Kelurahan/Desa</th>
                    <th>Kecamatan</th>
                    <th>Kabupaten</th>
                    <th>Provinsi</th>
                    <th>Kodepos</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
        <?php 

        error_reporting(0);// taruh disini ya  bagian atas sekali

session_start();
            $query_tampil_supp = "SELECT * FROM regionalvisiter WHERE (poscode LIKE '%$targ%' || desa LIKE '%$targ%' || kec LIKE '%$targ%' || kab_kota LIKE '%$targ%') && (provinsi LIKE 'Sumatera Utara' || provinsi LIKE 'Nanggroe Aceh Darussalam (NAD)')";
            $sql_tampil_supp = mysqli_query($conn, $query_tampil_supp) or die ($conn->error);
            while($data_supp = mysqli_fetch_array($sql_tampil_supp)) {
         ?>
                <tr>
                    <td><?php echo $data_supp['desa']; ?></td>
                    <td><?php echo $data_supp['kec']; ?></td>
                    <td><?php echo $data_supp['kab_kota']; ?></td>
                    <td><?php echo $data_supp['provinsi']; ?></td>
                    <td><?php echo $data_supp['poscode']; ?></td>
                    <td class="td-opsi">
                        <button class="btn-transition btn btn-outline-dark btn-sm" title="pilih" id="tombol_pilihwilayah" name="tombol_pilihwilayah" data-dismiss="modal"
                            data-kode_id="<?php echo $data_supp['kode_id']; ?>"
                            data-desa="<?php echo $data_supp['desa']; ?>"
                            data-kec="<?php echo $data_supp['kec']; ?>"
                            data-kab_kota="<?php echo $data_supp['kab_kota']; ?>"
                            data-provinsi="<?php echo $data_supp['provinsi']; ?>"
                                data-poscode="<?php echo $data_supp['poscode']; ?>"
                        >pilih</button>
                    </td>
                </tr>
         <?php 
            } 
         ?>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
	function reset_form() {
		$("#nama_pas").val("");
		$("#asuransi_pas").val("");
		$("#no_hp").val("");
		$("#alm_pas").val("");
				$("#nomor_rm").val("");
	}

    $("button[name='tombol_pilihwilayah']").click(function() {
        var kode_id = $(this).data('kode_id');
        var desa = $(this).data('desa');
        var kec = $(this).data('kec');
        var kab_kota= $(this).data('kab_kota');
        var provinsi= $(this).data('provinsi');
        var poscode= $(this).data('poscode');

        $("#kode_id").val(kode_id);
        $("#desa").val(desa);
        $("#kec").val(kec);
        $("#kab_kota").val(kab_kota);
        $("#provinsi").val(provinsi);
		$("#poscode").val(poscode);
    });
        $("#kode_id").keypress(function (e) {
        var key = e.which;
        if(key == 13) {
            alert();
        }
    })


	$("#btn_reset").click(function() {
		reset_form();
		document.getElementById("nama_pas").focus();
	});

	$("#btn_simpan").click(function() {
		var nama_pas = $("#nama_pas").val();
		var tgl_lahir = $("#tlahir_pas").val();
		var asuransi_pas = $("#asuransi_pas").val();
		var no_hp = $("#no_hp").val();
		var alm_pas = $("#alm_pas").val();
		var nomor_rm = $("#nomor_rm").val();
		var nik = $("#nik").val();
		var desa= $("#desa").val();
		var kec = $("#kec").val();
		var kab_kota = $("#kab_kota").val();
		var provinsi = $("#provinsi").val();
		var poscode = $("#poscode").val();
		var jk = document.querySelector('input[name="jk_pas"]:checked').value;

		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

		if(nama_pas=="") {
			document.getElementById("nama_pas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama pasien',
			  'warning'
			)
		} else if (asuransi_pas=="") {
			document.getElementById("asuransi_pas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama asuransi',
			  'warning'
			)
		} else if (no_hp=="") {
			document.getElementById("no_hp").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nomor hp pasien',
			  'warning'
			)
				} else if (tgl_lahir=="") {
			document.getElementById("tlahir_pas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi tanggal lahir Pasien',
			  'warning'
			)

		} else if (nomor_rm=="") {
			document.getElementById("nomor_rm").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nomor RM',
			  'warning'
			)
		} else if (alm_pas=="") {
			document.getElementById("alm_pas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi alamat pasien',
			  'warning'
			)

		} else {
			$.ajax({
				type: "POST",
				url: "ajax/simpan_pasien.php",
				data: "nama_pas="+nama_pas+"&jk="+jk+"&tgl_lahir="+tgl_lahir+"&asuransi_pas="+asuransi_pas+"&no_hp="+no_hp+"&alm_pas="+alm_pas+"&nomor_rm="+nomor_rm+"&nik="+nik+"&desa="+desa+"&kec="+kec+"&kab_kota="+kab_kota+"&provinsi="+provinsi+"&poscode="+poscode,
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
				            window.location='?page=datapasien' ;
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