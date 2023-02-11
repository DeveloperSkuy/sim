<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
<?php 
	$id_pas = @$_GET['id'];
 ?>
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=datapasien"><i class="fas fa-briefcase-medical"></i> Data Pasien</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data Pasien</li>
  </ol>
</nav>

   <style type="text/css">
        .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
        .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
        .autocomplete-selected { background: #F0F0F0; }
        .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
        .autocomplete-group { padding: 2px 5px; }
        .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
    </style>



<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Daftar Pasien Ranap</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datapasien">
				<button class="btn btn-sm btn-info">Daftar Data Pasien Ranap</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-10 offset-md-1 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengedit data Pasien</h6>
				<form action="javascrip:void(0);"  autocomplete="off">

                <?php 
                $tanggal_in = date("Y-m-d H:i:s");
                    $tgl_daftar = gmdate("Y-m-d", time() + 60 * 60 * 7);
                    $hari= substr($tgl_daftar, 8, 2);
                    $bulan = substr($tgl_daftar, 5, 2);
                    $tahun = substr($tgl_daftar, 0, 4);
                    $tgl = $tahun.$bulan.$hari;
                    $carikode = mysqli_query($conn, "SELECT MAX(no_daftar) FROM tbl_daftarpasienranap WHERE tgl_daftar = '$tgl_daftar'") or die (mysql_error());
                    $datakode = mysqli_fetch_array($carikode);
                    if($datakode) {
                        $nilaikode = substr($datakode[0], 16);
                        $kode = (int) $nilaikode;
                        $kode = $kode + 1;
                        $no_daftar = "REG/IP/".$tgl."/".str_pad($kode, 2, "0", STR_PAD_LEFT);
                    } else {
                        $no_daftar = "REG/IP/".$tgl."/01";
                    }
                 ?>

                <div style="text-align: right;">
                    No Daftar : <b><?php echo $no_daftar; ?></b> 
                    Tanggal : <b><?php echo tgl_indo(gmdate('Y-m-d', time() + 60 * 60 * 7)); ?></b>
                </div>
                <form method="post" id="form_penjualan" autocomplete="off">
                    <div class="position-relative row form-group">
                    	<!-- <label for="no_penjualan" class="col-sm-2 col-form-label">Nomor Penjualan</label> -->
                        <div class="col-sm-3">
                        	<input name="no_daftar" id="no_daftar" placeholder="nomor daftar" type="hidden" class="form-control form-control-sm" value="<?php echo $no_daftar; ?>">

                        	                        <div class="col-sm-3">
                        	<input name="no_daftar" id="no_daftar" placeholder="nomor daftar" type="hidden" class="form-control form-control-sm" value="<?php echo $no_daftar; ?>">
                        </div>
                        </div>
                        <!-- <label for="tanggal_pjl" class="col-sm-2 col-form-label">Periode Penjualan</label> -->
                        <div class="col-sm-4">
                            <input name="tgl_daftar" id="tgl_daftar" type="hidden" class="form-control form-control-sm" value="<?php echo gmdate("Y-m-d", time() + 60 * 60 * 7); ?>">

                            <input name="tgl_masuk" id="tgl_masuk" type="hidden" class="form-control form-control-sm" value="<?php echo $tanggal_in; ?>">

                            <input name="tgl_pulang" id="tgl_pulang" type="hidden" class="form-control form-control-sm" value="">

                                   <input name="ket" id="ket" type="hidden" class="form-control form-control-sm" value="open">
                        </div>
                    </div>

				  <div class="form-group row pt-3">

				    <div class="col-sm-9">
				      <input type="hidden" class="form-control form-control-sm" id="id_pas" placeholder="masukkan nama pasien" value="<?php echo $id_pas; ?>" disabled="">
				    </div>
				  </div>
				  <?php 
				  	$query_tampil = "SELECT * FROM tbl_pasien WHERE id_pas='$id_pas'";
					$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
					$data = mysqli_fetch_array($sql_tampil);
				   ?>

 <div class="form-group row">
				    <label for="nama_pas" class="col-sm-2 col-form-label">Nama Pasien</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" id="nama_pas" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nama_pas']; ?>">
				      <input type="hidden" class="form-control form-control-sm" id="diagnosa" placeholder="masukkan nama pasien" autofocus="" value="">

					</div>
					<label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: right;">Nomor RM</label>
				    <div class="col-sm-4">
					<input type="text" class="form-control form-control-sm" id="nomor_rm" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nomor_rm']; ?>">
					</div>
				  </div>

 <div class="form-group row">
				    <label for="nama_pas" class="col-sm-2 col-form-label">Tempat Lahir</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" id="tpt_lahir" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['tpt_lahir']; ?>">

					</div>
					<label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: right;">Tgl Lahir</label>
				    <div class="col-sm-4">
				      <input type="date" class="form-control form-control-sm" id="tlahir_pas" value="<?php echo $data['lhr_pas'] ?>">
				      <small class="form-text text-muted" style="text-align: right;">bulan/tanggal/tahun</small>
					</div>
				  </div>

 <div class="form-group row">
				    <label for="nama_pas" class="col-sm-2 col-form-label">NIK</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" id="nik" placeholder="masukkan NIK" autofocus="" value="<?php echo $data['nik']; ?>">

					</div>
					<label for="jk_pas" class="col-sm-2 col-form-label" style="text-align: right;">Jenis Kelamin</label>
				    <div class="col-sm-4">
				      <select name="jk_pas" id="jk_pas" class="form-control form-control-sm" <?php echo $data['jk_pas']; ?>>
				      	<option value="0">Pilih Jenis Kelamin</option>
				      	<option value="Laki-laki" <?php if($data['jk_pas'] == "Laki-laki") {echo "selected";} ?>>Laki-laki</option>
				      	<option value="Perempuan" <?php if($data['jk_pas'] == "Perempuan") {echo "selected";} ?>>Perempuan</option>

				      </select>

					</div>
				  </div>




 <div class="form-group row">
				    <label for="nama_pas" class="col-sm-2 col-form-label">Cara Masuk</label>
				    <div class="col-sm-4">
				      <select name="cara_masuk" id="cara_masuk" class="form-control form-control-sm">
				      	<option value="0">--Pilih --</option>
				      	<option value="Datang Sendiri">Datang Sendiri</option>
				      	<option value="Puskesmas">Puskesmas</option>
				      </select>

					</div>
					<label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: right;">Nomor HP</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" name="no_hp" id="no_hp" placeholder="masukkan nomor hp pasien" autofocus="" value="<?php echo $data['no_hp']; ?>">
					</div>
				  </div>


 <div class="form-group row">
				    <label for="nama_pas" class="col-sm-2 col-form-label">Asuransi</label>
				    <div class="col-sm-4">
				      <select name="asuransi_pas" id="asuransi_pas" class="form-control form-control-sm" <?php echo $data['asuransi_pas']; ?>>
				      	<option value="0">pilih Asuransi Pasien</option>
				      	<option value="BPJS Kesehatan" <?php if($data['asuransi_pas'] == "BPJS Kesehatan") {echo "selected";} ?>>BPJS Kesehatan</option>
				      	<option value="Pribadi" <?php if($data['asuransi_pas'] == "Pribadi") {echo "selected";} ?>>Pribadi</option>

				      </select>

					</div>
					<label for="no_bpjs" class="col-sm-2 col-form-label" style="text-align: right;">No BPJS</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" name="no_bpjs" id="no_bpjs" placeholder="masukkan nomor BPJS" autofocus="" value="<?php echo $data['no_bpjs']; ?>">
					</div>
				  </div>


 <div class="form-group row">
				    <label for="nama_pas" class="col-sm-2 col-form-label">Alamat</label>
				    <div class="col-sm-4">
				      <textarea name="alm_pas" id="alm_pas" rows="2" class="form-control" placeholder="masukkan alamat pasien" style="font-size: 14px;"><?php echo $data['alm_pas']; ?></textarea>

					</div>
					<label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: right;">Kelurahan/Desa</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" name="desa" id="desa" value="<?php echo $data['desa'] ?>">
				      <input type="hidden" class="form-control form-control-sm" name="kec" id="kec" value="<?php echo $data['kec'] ?>">
				      <input type="hidden" class="form-control form-control-sm" name="kab_kota" id="kab_kota" value="<?php echo $data['kab_kota'] ?>">
				      <input type="hidden" class="form-control form-control-sm" name="provinsi" id="provinsi" value="<?php echo $data['provinsi'] ?>">

					</div>
				  </div>


 <div class="form-group row">
				    <label for="nama_pas" class="col-sm-2 col-form-label">Diagnosa Awal</label>
				    <div class="col-sm-4">
				      <textarea name="diagnosa_awal" id="diagnosa_awal" rows="2" class="form-control" placeholder="masukkan Diagnosa" style="font-size: 14px;"></textarea>

					</div>

					<label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: right;">Dokter DPJP</label>
				    <div class="col-sm-4">
<select name="dokter" id="dokter" class="form-control form-control-sm" >

                <?php
                //query menampilkan nama unit kerja ke dalam combobox
                $query    =mysqli_query($conn, "SELECT * FROM dokter");
                while ($dataku = mysqli_fetch_array($query)) {
                ?>
                <option value="<?=$dataku['nm_dokter'];?>"><?php echo $dataku['nm_dokter'];?></option>
                <?php } ?>
			      </select>

					</div>
				  </div>

 <div class="form-group row">
				    <label for="nama_pj" class="col-sm-2 col-form-label">Nama PJ</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" name="nama_pj" id="nama_pj" placeholder="masukkan Nama Penanggungjawab" >
					</div>
					<label for="kontak_pj" class="col-sm-2 col-form-label" style="text-align: right;">Kontak PJ</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" name="kontak_pj" id="kontak_pj" placeholder="masukkan nomor hp PJ" >
					</div>
				  </div>


 <div class="form-group row">
				    <label for="hubungan_pj" class="col-sm-2 col-form-label">Hubungan PJ</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" name="hubungan_pj" id="hubungan_pj" placeholder="Hubungan Penanggungjawab" >
					</div>
					<label for="deposit" class="col-sm-2 col-form-label" style="text-align: right;">Deposit</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" name="deposit" id="deposit" placeholder="masukkan Deposit" >
					</div>
				  </div>

<div class="form-group row">
				    <label for="kamar" class="col-sm-2 col-form-label">Ruangan</label>
				    <div class="col-sm-4">
<input type="text" onkeyup="isi_otomatis()" id="kamar" name="kamar" class="form-control">
</div> 


					<label for="no_bed" class="col-sm-2 col-form-label" style="text-align: right;">Nomor BED</label>
				    <div class="col-sm-4">

<input type="text" id="no_bed" name="no_bed"  class="form-control">


</div>
				  </div>


 <div class="form-group row">
				    <label for="hubungan_pj" class="col-sm-2 col-form-label">status daftar</label>
				    <div class="col-sm-4">
				         <select name="status" id="status" class="form-control form-control-sm" >
				      	<option value="daftar">daftar</option>
				      	<option value="rawat" >rawat</option>
				      	<option value="daftar" >daftar</option>

				      </select>
					</div>
					<label for="" class="col-sm-2 col-form-label" style="text-align: right;"> TARIF </label>

				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" name="tarif" id="tarif" placeholder="masukkan Deposit" >
					</div>
				  </div>


				  <div class="form-group row">
				    <div class="col-sm-12 text-right">
				      <button class="btn btn-info btn-sm" id="btn_simpandaftar">Daftar Pasien</button>
				    </div>
				  </div>
				</form>



			</div>
		</div>
	</div>
</div>




            <table>
 


       
            </table>
        </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript">
            function isi_otomatis(){
                var kamar = $("#kamar").val();
                $.ajax({
                    url: 'ajax/form_ajax.php',
                    data:"kamar="+kamar ,
                }).success(function (data) {
                    var json = data,
                    obj = JSON.parse(json);

                    $('#no_bed').val(obj.no_bed);
                    $('#tarif').val(obj.tarif);
                });
            }
        </script>
    


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.4.11/jquery.autocomplete.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $( "#kamar" ).autocomplete({
      serviceUrl: "ajax/get_data.php",   
      dataType: "JSON",          
      onSelect: function (suggestion) {
          $( "#kamar" ).val(suggestion.kamar);
      }
  });
})
</script>


<script type="text/javascript">

	$("#btn_simpandaftar").click(function() {
var id_daftar = $("#id_daftar").val();
var id_pas = $("#id_pas").val();
		var no_daftar = $("#no_daftar").val();
	var tgl_daftar = $("#tgl_daftar").val();
		var nama_pas = $("#nama_pas").val();
		var nik = $("#nik").val();
		var nomor_rm = $("#nomor_rm").val();
		var tpt_lahir = $("#tpt_lahir").val();
		var tgl_lahir = $("#tlahir_pas").val();
		var asuransi_pas = $("#asuransi_pas").val();
		var no_bpjs = $("#no_bpjs").val();
		var no_hp = $("#no_hp").val();
		var alm_pas = $("#alm_pas").val();
		var desa = $("#desa").val();
		var kec = $("#kec").val();
		var kab_kota = $("#kab_kota").val();
		var provinsi = $("#provinsi").val();
		var diagnosa_awal = $("#diagnosa_awal").val();
		var status = $("#status").val();
		var nama_pj = $("#nama_pj").val();
		var kontak_pj = $("#kontak_pj").val();
		var hubungan_pj = $("#hubungan_pj").val();
		var no_bpjs = $("#no_bpjs").val();
		var cara_masuk = $("#cara_masuk").val();
		var dokter = $("#dokter").val();
		var kamar = $("#kamar").val();
		var no_bed = $("#no_bed").val();
		var tarif = $("#tarif").val();
		var jk_pas = $("#jk_pas").val();
		var deposit = $("#deposit").val();
		var ket = $("#ket").val();
		var tgl_masuk = $("#tgl_masuk").val();
		var tgl_pulang = $("#tgl_pulang").val();
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
			  'maaf, tolong isi nama petugas pasien',
			  'warning'
			)
		} else if (cara_masuk=="") {
			document.getElementById("cara_masuk").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi cara masuk pasien',
			  'warning'
			)
} else if (kamar=="") {
			document.getElementById("kamar").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi cara masuk pasien',
			  'warning'
			)

		} else if (no_hp=="") {
			document.getElementById("no_hp").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nomor hp petugas Pasien',
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
			  'maaf, tolong isi alamat Pasien',
			  'warning'
			)
		} else {
			Swal.fire({
	          title: 'Apakah Anda Yakin?',
	          text: 'anda akan Mendaftarkan data Pasien ini',
	          type: 'warning',
	          showCancelButton: true,
	          confirmButtonColor: '#3085d6',
	          cancelButtonColor: '#d33',
	          confirmButtonText: 'Ya'
	        }).then((ya) => {
	          if (ya.value) {
	            $.ajax({
	              type: "POST",
	              url: "ajax/daftar_pasienranap.php",
	              data: "no_daftar="+no_daftar+"&tgl_daftar="+tgl_daftar+"&nama_pas="+nama_pas+"&nomor_rm="+nomor_rm+"&nik="+nik+"&jk_pas="+jk_pas+"&tpt_lahir="+tpt_lahir+"&tgl_lahir="+tgl_lahir+"&asuransi_pas="+asuransi_pas+"&no_bpjs="+no_bpjs+"&no_hp="+no_hp+"&alm_pas="+alm_pas+"&desa="+desa+"&kec="+kec+"&kab_kota="+kab_kota+"&provinsi="+provinsi+"&nama_pj="+nama_pj+"&kontak_pj="+kontak_pj+"&hubungan_pj="+hubungan_pj+"&deposit="+deposit+"&cara_masuk="+cara_masuk+"&diagnosa_awal="+diagnosa_awal+"&dokter="+dokter+"&kamar="+kamar+"&no_bed="+no_bed+"&tarif="+tarif+"&status="+status+"&ket="+ket+"&tgl_masuk="+tgl_masuk+"&tgl_pulang="+tgl_pulang+"&id_pas="+id_pas,
	              success: function(hasil) {
	              	if(hasil=="berhasil") {
						Swal.fire({
				          title: 'Berhasil',
				          text: 'Data Berhasil Didaftarkan',
				          type: 'success',
				          confirmButtonColor: '#3085d6',
				          confirmButtonText: 'OK'
				        }).then((ok) => {
				          if (ok.value) {
				            window.location='?page=daftarpasien_ranap' ;
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

