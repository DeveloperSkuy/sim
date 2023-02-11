<?php 
    $no_daftar = @$_GET['id'];
 ?>

 <script src="js/jquery.tabledit.min.js"></script>
 
<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Diagnosa Pasien Rajal</h4></div>
		<div class="col-6 text-right">
			<a href="?page=perawatan_ranap">
				<button class="btn btn-sm btn-info">Data Perawatan</button>
			</a>
		</div>
	</div>




		<div class="row" style="padding: 0 20px;">
			<div class="col-md-12 vertical-form">
                <?php 
                    $tgl_diagnosa = gmdate('Y-m-d', time() + 60 * 60 * 7);
                    $hari= substr($tgl_diagnosa, 8, 2);
                    $bulan = substr($tgl_diagnosa, 5, 2);
                    $tahun = substr($tgl_diagnosa, 0, 4);
                    $tgl = $tahun.$bulan.$hari;
                    $carikode = mysqli_query($conn, "SELECT MAX(no_diagnosa) FROM tbl_diagnosa WHERE tgl_diagnosa = '$tgl_diagnosa'") or die (mysql_error());
                    $datakode = mysqli_fetch_array($carikode);
                    if($datakode) {
                        $nilaikode = substr($datakode[0], 13);
                        $kode = (int) $nilaikode;
                        $kode = $kode + 1;
                        $no_diagnosa = "DIA/".$tgl."/".str_pad($kode, 2, "0", STR_PAD_LEFT);
                    } else {
                        $no_diagnosa = "DIA/".$tgl."/01";
                    }
                 ?>

                <div style="text-align: right;">
                    No Diagnosa : <b><?php echo $no_diagnosa; ?></b> Tanggal : <b><?php echo tgl_indo(date('Y-m-d')); ?></b>
                </div>


  <form method="post" id="form_tindakan" autocomplete="off">
			<div class="col-md-10 offset-md-1 offset-form">

				  <div class="form-group row pt-3">

				    <div class="col-sm-9">

                        	<input name="no_diagnosa" id="no_diagnosa" placeholder="nomor diagnosa" type="hidden" class="form-control form-control-sm" value="<?php echo $no_diagnosa; ?>">

				      <input type="hidden" class="form-control form-control-sm" id="id_pas" placeholder="masukkan nama pasien" value="<?php echo $id_pas; ?>" disabled="">

            <input name="tgl_diagnosa" id="tgl_diagnosa" type="hidden" class="form-control form-control-sm" value="<?php echo gmdate("Y-m-d", time() + 60 * 60 * 7); ?>">

				    </div>
				  </div>

   <?php 
                    $query_tampil = "SELECT * FROM tbl_daftarpasien WHERE no_daftar='$no_daftar'";
                    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                    $data = mysqli_fetch_array($sql_tampil);
                   ?>


 <div class="form-group row">
				    <label for="nama_pas" class="col-sm-2 col-form-label">No Registrasi</label>
				    <div class="col-sm-4">
	                                        <div class="input-group-append">
                                            
                            <input type="text" class="form-control form-control-sm" id="no_daftar" name="no_daftar" value="<?php echo $no_daftar; ?>" >


</div>
					</div>
					<label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: right;">Nama Pasien</label>
				    <div class="col-sm-4">
                        <input type="text" class="form-control form-control-sm" id="nama_pas" name="nama_pas" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nama_pas']; ?>" disabled="">
					</div>
				  </div>


 <div class="form-group row">
				    <label for="nomor_rm" class="col-sm-2 col-form-label">Nomor RM</label>
				    <div class="col-sm-4">
	                                        <div class="input-group-append">
                                            
                              <input type="text" class="form-control form-control-sm" id="nomor_rm" name="nomor_rm" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nomor_rm']; ?>" disabled="">


</div>
					</div>
					<label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: right;">Tgl Lahir </label>
				    <div class="col-sm-4">
				      <input type="date" class="form-control form-control-sm" id="tlahir_pas" value="<?php echo $data['lhr_pas'] ?>">
				      <small class="form-text text-muted" style="text-align: right;">bulan/tanggal/tahun</small>
					</div>
				  </div>


   <?php 
                    $query_tampol = "SELECT * FROM tbl_diagnosa WHERE no_daftar='$no_daftar'";
                    $sql_tampol = mysqli_query($conn, $query_tampol) or die ($conn->error);
                    $data_pol = mysqli_fetch_array($sql_tampol);
                   ?>

 <div class="form-group row">
            <label for="temp" class="col-sm-2 col-form-label">Gol. Darah</label>
            <div class="col-sm-4">

              <select name="goldarah" id="goldarah" class="form-control form-control-sm" <?php echo $data['goldarah']; ?>>
                <option value="0">Gol Darah</option>
                <option value="A" <?php if($data['goldarah'] == "A") {echo "selected";} ?>>A</option>
                <option value="B" <?php if($data['goldarah'] == "B") {echo "selected";} ?>>B</option>
                <option value="O" <?php if($data['goldarah'] == "O") {echo "selected";} ?>>O</option>
                <option value="AB" <?php if($data['goldarah'] == "AB") {echo "selected";} ?>>AB</option>

              </select>

          </div>

          <label for="Status" class="col-sm-2 col-form-label" style="text-align: right;">Pekerjaan </label>
            <div class="col-sm-4">
              <input type="text" class="form-control form-control-sm" name="pekerjaan" id="pekerjaan" value="<?php echo $data['pekerjaan']; ?>" placeholder="pekerjaan" >
          </div>
          </div>

 <div class="form-group row">
				    <label for="code" class="col-sm-2 col-form-label">Code Diagnosa</label>
				    <div class="col-sm-4">
	                                        <div class="input-group-append">
                                            
				      <input type="text" class="form-control form-control-sm" id="code" name="code" placeholder="masukkan Code" autofocus="" value="<?php echo $data_pol['code']; ?>">

				      <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_diagnosa" id="lihat_data_diagnosa"><i class="fas fa-search"></i></button>

</div>
					</div>
					<label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: right;">Diagnosa</label>
				    <div class="col-sm-4">
					<input type="text" class="form-control form-control-sm" name="diagnosa" id="diagnosa" placeholder="masukkan diagnosa" autofocus="" value="<?php echo $data_pol['diagnosa']; ?>">
					</div>
				  </div>

 <div class="form-group row">
				    <label for="nama_pas" class="col-sm-2 col-form-label">Deskripsi</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control form-control-sm" name = "deskripsi" id="deskripsi" placeholder="masukkan deskripsi" autofocus="" value="<?php echo $data_pol['deskripsi']; ?>">

					</div>
					<label for="dokter" class="col-sm-2 col-form-label" style="text-align: right;">Dokter</label>
				    <div class="col-sm-4">
				    	       <div class="input-group-append">
            <input type="text" class="form-control form-control-sm" id="nm_dokter" value="<?php echo $data['dokter']; ?>" name="nm_dokter">
                         
</div>
</div>
</div>

 <div class="form-group row">
            <label for="nama_pj" class="col-sm-2 col-form-label">Berat Badan</label>
            <div class="col-sm-4">
              <input type="number" class="form-control form-control-sm" name="berat_badan" id="berat_badan" placeholder="masukkan BB" value="<?php echo $data_pol['berat_badan']; ?>">
          </div>
          <label for="tinggi_badan" class="col-sm-2 col-form-label" style="text-align: right;">Tinggi Badan</label>
            <div class="col-sm-4">
              <input type="number" class="form-control form-control-sm" name="tinggi_badan" id="tinggi_badan" value="<?php echo $data_pol['tinggi_badan']; ?>" placeholder="masukkan TB" >
          </div>
          </div>


 <div class="form-group row">
            <label for="temp" class="col-sm-2 col-form-label">Temperatur</label>
            <div class="col-sm-4">
              <input type="text" class="form-control form-control-sm" name="temp" id="temp" value="<?php echo $data_pol['temp']; ?>" placeholder="suhu tubuh" >
          </div>
          <label for="Status" class="col-sm-2 col-form-label" style="text-align: right;">Tekanan Darah</label>
            <div class="col-sm-4">
              <input type="text" class="form-control form-control-sm" name="tekanan_darah" id="tekanan_darah" value="<?php echo $data_pol['tekanan_darah']; ?>" placeholder="tekanan_darah" >
          </div>
          </div>




<!--  <div class="form-group row">
				    <label for="subjective" class="col-sm-2 col-form-label">Subject (S)</label>
				    <div class="col-sm-4">
			      <textarea name="subjective" id="subjective" rows="2" class="form-control" placeholder="masukkan subjective" style="font-size: 14px;"></textarea>

					</div>
					<label for="objective" class="col-sm-2 col-form-label" style="text-align: right;">Object (O)</label>
				    <div class="col-sm-4">
				    	       <div class="input-group-append">
			      <textarea name="objective" id="objective" rows="2" class="form-control" placeholder="masukkan Objective" style="font-size: 14px;"></textarea>

                         </div>

</div>
</div>
 <div class="form-group row">
				    <label for="assesment" class="col-sm-2 col-form-label">Assesment (P)</label>
				    <div class="col-sm-4">
			      <textarea name="assesment" id="assesment" rows="2" class="form-control" placeholder="masukkan assesment" style="font-size: 14px;"></textarea>

					</div>
					<label for="dokter" class="col-sm-2 col-form-label" style="text-align: right;">Plan(P)</label>
				    <div class="col-sm-4">
				    	       <div class="input-group-append">
			      <textarea name="plan" id="plan" rows="2" class="form-control" placeholder="masukkan Plan" style="font-size: 14px;"></textarea>


                         </div>


      </div>
</div> -->
<div class="form-group row">
            <label for="nama_pas" class="col-sm-2 col-form-label">Pemeriksaan </label>
            <div class="col-sm-4">
              <textarea name="pemeriksaan" id="pemeriksaan" rows="2" class="form-control" placeholder="tulis pemeriksaan " style="font-size: 14px;"><?php echo $data_pol['pemeriksaan']; ?></textarea>

          </div>

          <label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: right;">Terapi</label>
    <div class="col-sm-4">
              <textarea name="terapi" id="terapi" rows="2" class="form-control" placeholder="tulis terapi " style="font-size: 14px;"><?php echo $data_pol['terapi']; ?></textarea>

          </div>

          </div>







 <div class="form-group row">
            <label for="temp" class="col-sm-2 col-form-label">Perlu Istirahat (Hari)</label>
            <div class="col-sm-4">
              <input type="text" class="form-control " name="istirahat" id="istirahat" value="<?php echo $data_pol['istirahat']; ?>" placeholder="Istirahat (hari)" >
          </div>
          <label for="Status" class="col-sm-2 col-form-label" style="text-align: right;"> Buta Warna </label>
            <div class="col-sm-4">
              <div class="form-check">
                <label class="form-check-label" style="font-weight: normal;">
                  <input name="butawarna" id="butawarna1" type="radio" class="form-check-input" value="Ya" <?php if($data_pol['butawarna'] == "Ya") {echo "checked";} ?>> 
                  Ya
                </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="form-check-label" style="font-weight: normal; text-align: right;">
                        <input name="butawarna" id="butawarna2" type="radio" class="form-check-input" value="Tidak" <?php if($data_pol['butawarna'] == "Tidak") {echo "checked";} ?>>Tidak </label>


          </div>
          </div>
</div>


                          <div class="text-right tombol-kanan">
			      <button class="btn btn-info btn-sm" id="btn_simpan">Simpan</button>

<!-- 
                        <input type="submit" name="simpan_diagnosa" id="simpan_diagnosa" class="btn btn-info" value="Simpan"> -->
                    </div>
                </form>
                            </div>

                        
 <h5 align="center"> Diagnosa Pasien</h5>
        <table  id="editable_table" class="table table-striped display tabel-data">
            <thead>
                <tr>
                     <th>No Reg</th>
                    <th>Diagnosa</th>
                    <th>Deskripsi</th>
                    <th>Pemeriksaan</th>
                   <th>Terapi</th> 
                  <th>Waktu Istirahat</th>
                </tr>
            </thead>
            <?php 
    $no_daftar = @$_GET['id'];

                $nomor = 1;
                $query_pjlobat = "SELECT * From tbl_diagnosa

                WHERE no_daftar ='$no_daftar' ";

 $dewan1 = mysqli_query($conn, $query_pjlobat) or die ($conn->error);
          
            while($row = mysqli_fetch_array($dewan1)) {

                
                echo '
                <tr>
                 <td>'.$row["no_diagnosa"].'</td>
                 <td>'.$row["diagnosa"].'</td>
                  <td>'.$row["deskripsi"].'</td>
                  <td>'.$row["pemeriksaan"].'</td>
                  <td>'.$row["terapi"].'</td>
                  <td>'.$row["istirahat"].'</td>

                </tr>
                ';
             }
            ?>

            </tbody>
        </table>
    </div>




<div class="modal fade" id="modal_dokter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Dokter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="example2" class="table table-striped display">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Dokter</th>
                    <th>Spesialis</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
        <?php 
        require_once "koneksi.php";
            $query_tampil = "SELECT * FROM dokter ";
/*            $query_tampil = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp > date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.stok > 0 ORDER BY tbl_dataobat.nm_obat ASC";*/

            $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
            while($data = mysqli_fetch_array($sql_tampil)) {
         ?>
                <tr>
                    <td><?php echo $data['kd_dokter']; ?></td>
                    <td><?php echo $data['nm_dokter']; ?></td>
                    <td><?php echo $data['spesialisasi']; ?></td>
                    <td class="td-opsi">
                        <button class="btn-transition btn btn-outline-dark btn-sm" title="pilih" id="tombol_pilihdokter" name="tombol_pilihdokter" data-dismiss="modal"
                            data-kd="<?php echo $data['kd_dokter']; ?>"
                            data-nm="<?php echo $data['nm_dokter']; ?>"
                        > pilih
                        </button>
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



<div class="modal fade" id="modal_diagnosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">


  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data ICD 10</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">


                    <div class="row data-pengobatan">
                        <div class="position-relative form-group col-md-3">
                            <label for="code" class="">Cari Code, Diagnosa (tekan Enter) </label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm" id="search"   >

                              </div>
                            </div>
                          </div>

                        <div class="position-relative form-group col-md-12">
                                <ul id="result"></ul>
                                
                            </div>
   
                        </div>



                </form>
      </div>
    </div>
  </div>
</div>




     <script type="text/javascript">
            $(document).ready(function(){
                 
                 function search(){

                       var code=$("#search").val();

                       var diagnosa=$("#search").val();
                       var deskripsi=$("#search").val();

                      if(code!=""){
                        $("#result").html("<img src='img/ajax-loader.gif'/>");
                         $.ajax({
                            type:"post",
                            url:"ajax/search_icd10.php",
                            data:"code="+code+"&diagnosa="+diagnosa+"&deskripsi="+deskripsi,
                            success:function(data){
                                $("#result").html(data);
                                $("#search").val("");
                             }
                          });
                      }
                      

                     
                 }

                  $("#button").click(function(){
                  	 search();
                  });

                  $('#search').keyup(function(e) {
                     if(e.keyCode == 13) {
                        search();
                      }
                  });
            });



$(document).ready(function() {
    // $(".kotak-form-obat-terjual").slideTo('slow');
    var count = 0;
    var total_penjualan = 0;

    $('.datepicker').datepicker({
        format : "yyyy-mm-dd",
        orientation: "bottom left",
        todayBtn: "linked",
        autoclose: true,
        language: "id",
        todayHighlight: true
    });

    function reset() {
        $("#kode_tindakan").val("");
        $("#nama_tindakan").val("");
        $("#harga_tindakan").val("");
    }

    $("button[name='tombol_pilihdokter']").click(function() {
        var kd = $(this).data('kd');
        var nm = $(this).data('nm');
       

        $("#kd_dokter").val(kd);
        $("#nm_dokter").val(nm);
    });
 


    $("button[name='tombol_pilihdiagnosa']").click(function() {
        var cod = $(this).data('cod');
        var nam = $(this).data('nam');
        var desk = $(this).data('desk');
       

        $("#code").val(cod);
        $("#diagnosa").val(nam);
        $("#deskripsi").val(desk);
    });



    // $("#kode_obat").click(functon() {
    //     $("#lihat_data_obat").click();
    // });

   

    $(document).on("click", ".hapus_tindakan", function() {
        var row_id = $(this).attr("id");
        var harga = Number($("#td_harga"+row_id).val());

        total_penjualan = total_penjualan-harga;
        $("#total_penjualan").text(total_penjualan);
        $("#hidden_totalpenjualan").val(total_penjualan);
        $("#total_pembayaran").text(total_penjualan);
        $("#row_"+row_id).remove();
        if(total_penjualan==0)
        {
            $("#baris_kosong").show();
            $(".baris_total").hide();
            $("#tambah_tindakan_lagi").click();
        }
    });

    $("#hapus_semua_tindakan").click(function() {
        Swal.fire({
          title: 'Hapus Semua ?',
          text: 'apakah anda yakin menghapus semua daftar tindakan',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $("#keranjang_tindakan > tr").remove();
            total_penjualan = 0;
            $("#hidden_totalpenjualan").val("0");
            $("#total_pembayaran").text(total_penjualan);
            $("#baris_kosong").show();
            $(".baris_total").hide();
            $("#tambah_tindakan_lagi").click();
          }
        })
    });

    $("#lanjut_pembayaran").click(function() {
        // alert();
        $(".kotak-form-tindakan-terjual").hide();
        $(".kotak-form-pembayaran").show();
        document.getElementById("jml_uang").focus();
        $("#tambah_tindakan_lagi").show();
        $("#lanjut_pembayaran").hide();
    });

    $("#tambah_tindakan_lagi").click(function() {
        // alert();
        $(".kotak-form-tindakan-terjual").show();
        $(".kotak-form-pembayaran").hide();
        $("#jml_uang").val("");
        $("#jml_kembali").val("");
        $("#tambah_tindakan_lagi").hide();
        $("#lanjut_pembayaran").show();
    });

   /* $("#jml_uang").keyup(function() {
        var nominal = $(this).val();
        var kembali;
        if(nominal>=total_penjualan){
            kembali = nominal - total_penjualan;
            $("#jml_kembali").val(kembali);
        } else {
            $("#jml_kembali").val("uang tidak cukup");
        }
    });*/



    $("#form_tindakan").on("submit", function(event){
        event.preventDefault();
        var no_tindakan = $("#no_tindakan").val();
        var tanggal_tindakan = $("#tanggal_tindakan").val();
        var no_rawat = $("#no_rawat").val();
        var nominal = $("#jml_uang").val();
        var kembali = $("#jml_kembali").val();
        var nm_dokter = $("#nm_dokter").val();

    });
});

	$("#btn_simpan").click(function() {
		var no_diagnosa = $("#no_diagnosa").val();
		var code = $("#code").val();
		var diagnosa = $("#diagnosa").val();
		var deskripsi = $("#deskripsi").val();
		var nama_pas = $("#nama_pas").val();
		var tgl_lahir = $("#tlahir_pas").val();
		var nomor_rm = $("#nomor_rm").val();
		var subjective = $("#subjective").val();
		var objective= $("#objective").val();
		var assesment = $("#assesment").val();
		var plan = $("#plan").val();
		var no_daftar = $("#no_daftar").val();
		var nm_dokter = $("#nm_dokter").val();
		var tgl_diagnosa = $("#tgl_diagnosa").val();
    var tinggi_badan = $("#tinggi_badan").val();
    var berat_badan = $("#berat_badan").val();  
    var tekanan_darah = $("#tekanan_darah").val();
    var goldarah = $("#goldarah").val();
    var jk_pas = $("#jk_pas").val();
    var temp = $("#temp").val();
    var pemeriksaan = $("#pemeriksaan").val();
    var terapi = $("#terapi").val();
    var tpt_lahir = $("#tpt_lahir").val();
    var pekerjaan = $("#pekerjaan").val();
    var istirahat = $("#istirahat").val();
var butawarna = document.querySelector('input[name="butawarna"]:checked').value;

		// alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

		if(nama_pas=="") {
			document.getElementById("nama_pas").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nama pasien',
			  'warning'
			)

		} else if (nomor_rm=="") {
			document.getElementById("nomor_rm").focus();
			Swal.fire(
			  'Data Belum Lengkap',
			  'maaf, tolong isi nomor RM',
			  'warning'
			)

		} else {
			$.ajax({
				type: "POST",
				url: "ajax/simpan_diagnosa.php",
				data: "no_diagnosa="+no_diagnosa+"&no_daftar="+no_daftar+"&tgl_diagnosa="+tgl_diagnosa+"&nm_dokter="+nm_dokter+"&nama_pas="+nama_pas+"&nomor_rm="+nomor_rm+"&pekerjaan="+pekerjaan+"&tgl_lahir="+tgl_lahir+"&code="+code+"&diagnosa="+diagnosa+"&deskripsi="+deskripsi+"&tinggi_badan="+tinggi_badan+"&berat_badan="+berat_badan+"&tekanan_darah="+tekanan_darah+"&temp="+temp+"&goldarah="+goldarah+"&pemeriksaan="+pemeriksaan+"&terapi="+terapi+"&istirahat="+istirahat+"&butawarna="+butawarna,
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
				            window.location='?page=perawatan' ;
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



<script>  
    $(document).ready(function(){  
      $('#editable_table').Tabledit({
        url:'pages/js/action_diagnosa.php',
        columns:{
          identifier:[0, "no_diagnosa"],
          editable:[ [3, 'subjective'], [4, 'objective'], [5, 'assesment'], [6, 'plan']]
        },
        restoreButton:true,
        onSuccess:function(data, textStatus, jqXHR){
          if(data.action == 'delete'){
            $('#'+data.no_diagnosa).remove();
          }
        }
      });
    });
  </script>
