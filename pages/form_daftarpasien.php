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


<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Daftar Pasien Rajal</h4></div>
		<div class="col-6 text-right">
			<a href="?page=datapasien">
				<button class="btn btn-sm btn-info">Daftar Data Pasien Rajal</button>
			</a>
		</div>
	</div>
	<div class="form-container">
		<div class="row">
			<div class="col-md-10 offset-md-1 offset-form">
				<h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk mengisi data Pasien</h6>
				<form action="javascrip:void(0);"  autocomplete="off">

                <?php 
                    $tgl_daftar = gmdate("Y-m-d", time() + 60 * 60 * 7);
                    $hari= substr($tgl_daftar, 8, 2);
                    $bulan = substr($tgl_daftar, 5, 2);
                    $tahun = substr($tgl_daftar, 0, 4);
                    $tgl = $tahun.$bulan.$hari;
                    $carikode = mysqli_query($conn, "SELECT MAX(no_daftar) FROM tbl_daftarpasien WHERE tgl_daftar = '$tgl_daftar'") or die (mysql_error());
                    $datakode = mysqli_fetch_array($carikode);
                    if($datakode) {
                        $nilaikode = substr($datakode[0], 13);
                        $kode = (int) $nilaikode;
                        $kode = $kode + 1;
                        $no_daftar = "REG/".$tgl."/".str_pad($kode, 2, "0", STR_PAD_LEFT);
                    } else {
                        $no_daftar = "REG/".$tgl."/01";
                    }
                 ?>

                <div style="text-align: right;">
                    No Daftar : <b><?php echo $no_daftar; ?></b> <br>
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
                            <input name="tgl_daftar" id="tgl_daftar" type="hidden" class="form-control form-control-sm" value="<?php echo gmdate('Y-m-d', time() + 60 * 60 * 7); ?>">
                        </div>
                    </div>

				  <div class="form-group row pt-3">
<!-- 				    <label for="id_pas" class="col-sm-3 col-form-label">No Pasien</label> -->
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
<!-- 				      <small class="form-text text-muted" style="text-align: right;">bulan/tanggal/tahun</small> -->
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
				    <label for="nama_pas" class="col-sm-2 col-form-label">Keluhan Awal</label>
				    <div class="col-sm-4">
				      <textarea name="keluhan" id="keluhan" rows="2" class="form-control" placeholder="masukkan Keluhan" style="font-size: 14px;"></textarea>

					</div>

					<label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: right;">Dokter </label>
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
				    <label for="nama_pj" class="col-sm-2 col-form-label">Berat Badan</label>
				    <div class="col-sm-4">
				      <input type="number" class="form-control form-control-sm" name="berat_badan" id="berat_badan" placeholder="masukkan BB" >
					</div>
					<label for="tinggi_badan" class="col-sm-2 col-form-label" style="text-align: right;">Tinggi Badan</label>
				    <div class="col-sm-4">
				      <input type="number" class="form-control form-control-sm" name="tinggi_badan" id="tinggi_badan" placeholder="masukkan TB" >
					</div>
				  </div>

 <div class="form-group row">
				    <label for="nama_pj" class="col-sm-2 col-form-label">Tekanan Darah</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" name="tekanan_darah" id="tekanan_darah" placeholder="masukkan TD" >
					</div>
					<label for="golongan darah" class="col-sm-2 col-form-label" style="text-align: right;">Golongan Darah</label>
				    <div class="col-sm-4">
				      <select name="goldarah" id="goldarah" class="form-control form-control-sm" <?php echo $data['goldarah']; ?>>
				      	<option value="0">pilih </option>
				      	<option value="A" <?php if($data['goldarah'] == "A") {echo "selected";} ?>>A</option>
				      	<option value="B" <?php if($data['goldarah'] == "B") {echo "selected";} ?>>B</option>
				      	<option value="AB" <?php if($data['goldarah'] == "AB") {echo "selected";} ?>>AB</option>
				      	<option value="O" <?php if($data['goldarah'] == "O") {echo "selected";} ?>>AB</option>

				      </select>

					</div>
				  </div>

 <div class="form-group row">
				    <label for="temp" class="col-sm-2 col-form-label">Poli</label>
				    <div class="col-sm-4">
				      <input type="hidden" class="form-control form-control-sm" name="temp" id="temp" placeholder="suhu tubuh" >


<select name="proses" id="proses" class="form-control form-control-sm" >

                <?php
                //query menampilkan nama unit kerja ke dalam combobox
                $query    =mysqli_query($conn, "SELECT * FROM tbl_poliklinik");
                while ($data_pol = mysqli_fetch_array($query)) {
                ?>
                <option value="<?=$data_pol['nama_poli'];?>"><?php echo $data_pol['nama_poli'];?></option>
                <?php } ?>
			      </select>

					</div>

					<label for="Status" class="col-sm-2 col-form-label" style="text-align: right;">Pekerjaan</label>
				    <div class="col-sm-4">

				      <input type="text" class="form-control form-control-sm" name="pekerjaan" id="pekerjaan" value="<?php echo $data['pekerjaan'] ?>" placeholder="pekerjaan" >

				      <input type="hidden" class="form-control form-control-sm" name="status" id="status" value ="daftar" placeholder="daftar" >


					</div>
				  </div>

<?php

  require_once "nomor-antrian/koneksi.php";

  // ambil tanggal sekarang
  $tanggal = gmdate("Y-m-d", time() + 60 * 60 * 7);

  // sql statement untuk menampilkan data dari tabel "tbl_antrian" berdasarkan "tanggal"
   $query = mysqli_query($mysqli, "SELECT count(id) as jumlah FROM tbl_antrian 
                                  WHERE tanggal='$tanggal'")
                                  or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
  // ambil data hasil query
  $data = mysqli_fetch_assoc($query);
  // buat variabel untuk menampilkan data
  // tampilkan data
 $jumlah_antrian = $data['jumlah']+1;


  // tampilkan data

?>

				  <div class="form-group row">
				    <label id="btn_simpandaftar"  class="btn btn-success col-sm-3 form-label"> Daftar</label>
				    <div class="col-sm-3">
 <input  type="number" class="form-control form-control-sm" id="number_antrian" autofocus="" style="font-size:28px ; color: red   " value="<?php echo number_format($jumlah_antrian, 0, '', '.'); ?>" > 

			

				    </div>
				  </div>




				</form>
			</div>
		</div>
	</div>
</div>

<script>

    $(document).ready(function() {
      // tampilkan jumlah antrian
      $('#antrian').load('nomor-antrian/get_antrian.php');

      // proses insert data
      $('#btn_simpandaftar').on('click', function() {
        $.ajax({
          type: 'POST',                     // mengirim data dengan method POST
          url: 'nomor-antrian/insert.php',                // url file proses insert data
          success: function(result) {       // ketika proses insert data selesai
            // jika berhasil
            if (result === 'Sukses') {
              // tampilkan jumlah antrian
              $('#antrian').load('nomor-antrian/get_antrian.php').fadeIn('slow');
            }
          },
        });
      });
    });

	$("#btn_simpandaftar").click(function() {
var id_daftar = $("#id_daftar").val();
var id_pas = $("#id_pas").val();
		var no_daftar = $("#no_daftar").val();
	var tgl_daftar = $("#tgl_daftar").val();
		var nama_pas = $("#nama_pas").val();
		var nik = $("#nik").val();
		var tgl_lahir = $("#tlahir_pas").val();
		var tpt_lahir = $("#tpt_lahir").val();

		var asuransi_pas = $("#asuransi_pas").val();
		var no_bpjs = $("#no_bpjs").val();
		var no_hp = $("#no_hp").val();
		var alm_pas = $("#alm_pas").val();
		var desa = $("#desa").val();
		var kec = $("#kec").val();
		var kab_kota = $("#kab_kota").val();
		var provinsi = $("#provinsi").val();

		var nomor_rm = $("#nomor_rm").val();
				var diagnosa = $("#diagnosa").val();
		var status = $("#status").val();
		var nomor_antri = $("#number_antrian").val();
		var tinggi_badan = $("#tinggi_badan").val();
		var berat_badan = $("#berat_badan").val();
		var temp = $("#temp").val();
		var keluhan = $("#keluhan").val();
		var cara_masuk = $("#cara_masuk").val();
		var jk = $("#jk_pas").val();
		var dokter = $("#dokter").val();
		var tekanan_darah = $("#tekanan_darah").val();
		var goldarah = $("#goldarah").val();
		var pekerjaan = $("#pekerjaan").val();
		var proses = $("#proses").val();

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
		} else if (no_hp=="") {
			document.getElementById("no_hp").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nomor hp petugas Pasien',
			  'warning'
			)

		} else if (cara_masuk=="") {
			document.getElementById("cara_masuk").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi  cara masuk',
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
	              url: "ajax/daftar_pasien.php",
	              data: "no_daftar="+no_daftar+"&tgl_daftar="+tgl_daftar+"&nama_pas="+nama_pas+"&nik="+nik+"&jk="+jk+"&tpt_lahir="+tpt_lahir+"&tgl_lahir="+tgl_lahir+"&pekerjaan="+pekerjaan+"&asuransi_pas="+asuransi_pas+"&no_bpjs="+no_bpjs+"&no_hp="+no_hp+"&alm_pas="+alm_pas+"&nomor_rm="+nomor_rm+"&keluhan="+keluhan+"&dokter="+dokter+"&diagnosa="+diagnosa+"&tinggi_badan="+tinggi_badan+"&berat_badan="+berat_badan+"&temp="+temp+"&goldarah="+goldarah+"&tekanan_darah="+tekanan_darah+"&nomor_antri="+nomor_antri+"&status="+status+"&cara_masuk="+cara_masuk+"&desa="+desa+"&kec="+kec+"&kab_kota="+kab_kota+"&provinsi="+provinsi+"&proses="+proses+"&id_pas="+id_pas,
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
				            window.location='?page=daftarpasien' ;
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