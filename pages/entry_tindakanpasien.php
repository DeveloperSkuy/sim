<?php 
    $no_daftar = @$_GET['id'];
 ?>


<!-- <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Perawatan</li>
  </ol>
</nav> -->

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Tindakan Pasien</h4></div>
		<div class="col-6 text-right">
			<a href="?page=perawatan">
				<button class="btn btn-sm btn-info">Data Perawatan</button>
			</a>
		</div>
	</div>

   <?php 
                    $query_tampil = "SELECT * FROM tbl_daftarpasien WHERE no_daftar='$no_daftar'";
                    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                    $data = mysqli_fetch_array($sql_tampil);
                   ?>


  <form method="post" id="form_tindakan" autocomplete="off">
                    <div class="row data-tindakan">
                        <div class="position-relative form-group col-md-3">
                            <label for="dokter" class="">Dokter </label>
                            <div class="input-group input-group-sm">
            <input type="text" class="form-control form-control-sm" id="nm_dokter" value="<?php echo $data['dokter']; ?>" name="nm_dokter">
                                <div class="input-group-append">

          <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_dokter" id="lihat_data_dokter"><i class="fas fa-file-signature"></i></button>

                                </div>
                            </div>
   
                        </div>

                        <div class="position-relative form-group col-md-3">
                            <label for="no_daftar" class="">No Registrasi<small>(nomor  pendaftaran)</small></label>
                            <div class="input-group">
                            <input type="text" class="form-control form-control-sm" id="no_rawat" name="no_rawat" value="<?php echo $no_daftar; ?>" >

                                </div>
                           
                        </div>
                        <div class="position-relative form-group col-md-3">
                            <label for="nomor_rm" class="">Nama Pasien</label>
                            <div class="input-group ">
                        <input type="text" class="form-control form-control-sm" id="nama_pas" name="nama_pas" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nama_pas']; ?>" disabled="">
                            </div>
                        </div>

                            <div class="position-relative form-group col-md-3">
                            <label for="nomor_rm" class="">Nomor RM</label>
                            <div class="input-group ">
                              <input type="text" class="form-control form-control-sm" id="norem" name="norem" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nomor_rm']; ?>" >
                            </div>
                        </div>

                    </div>

		<div class="row" style="padding: 0 20px;">
			<div class="col-md-12 vertical-form">
                <?php 
                    $tgl_tindakan = gmdate('Y-m-d', time() + 60 * 60 * 7);
                    $hari= substr($tgl_tindakan, 8, 2);
                    $bulan = substr($tgl_tindakan, 5, 2);
                    $tahun = substr($tgl_tindakan, 0, 4);
                    $tgl = $tahun.$bulan.$hari;
                    $carikode = mysqli_query($conn, "SELECT MAX(no_tindakan) FROM tbl_tindakan WHERE tgl_tindakan = '$tgl_tindakan'") or die (mysql_error());
                    $datakode = mysqli_fetch_array($carikode);
                    if($datakode) {
                        $nilaikode = substr($datakode[0], 13);
                        $kode = (int) $nilaikode;
                        $kode = $kode + 1;
                        $no_tindakan = "TNK/".$tgl."/".str_pad($kode, 2, "0", STR_PAD_LEFT);
                    } else {
                        $no_tindakan = "TNK/".$tgl."/01";
                    }
                 ?>

                <div style="text-align: right;">
                    No Tindakan : <b><?php echo $no_tindakan; ?></b> Tanggal : <b><?php echo tgl_indo(date('Y-m-d')); ?></b>
                </div>
              
                    <div class="position-relative row form-group">
                    	<!-- <label for="no_penjualan" class="col-sm-2 col-form-label">Nomor Penjualan</label> -->
                        <div class="col-sm-4">
                        	<input name="no_tindakan" id="no_tindakan" placeholder="nomor tindakan" type="hidden" class="form-control form-control-sm" value="<?php echo $no_tindakan; ?>">
                        </div>
                        <!-- <label for="tanggal_pjl" class="col-sm-2 col-form-label">Periode Penjualan</label> -->
                        <div class="col-sm-4">
                            <input name="tanggal_tindakan" id="tanggal_tindakan" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                    <!-- <h6><i class="fas fa-list-alt"></i> Masukkan daftar obat terjual</h6> -->
                    <div class="row kotak-form-tabel-tindakan">
                    	<div class="col-md-3 kotak-form-tindakan-terjual" style="display: ;">
                    		<!-- <div class="judul-form">Form data obat terjual</div> -->
                    		<!-- <form action="javascript:void(0);">  -->
                    			<div class="position-relative form-group">
                    				<label for="kode_tindakan" class="">Kode Tindakan</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" id="kode_tindakan">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_datatindakan" id="lihat_data_tindakan"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                    			</div>
                                <div class="position-relative form-group">
                                    <label for="nama_tindakan" class="">Nama Tindakan</label>
                                    <input name="nama_tindakan" id="nama_tindakan" placeholder="" type="text" class="form-control form-control-sm" disabled="">
                                </div>
                    			<div class="position-relative form-group">
                    				<label for="harga_tindakan" class="">Harga</label>
                    				<div class="input-group input-group-sm">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                      </div>
                                      <input type="number" class="form-control" id="harga_tindakan" name="harga_tindakan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                  </div>
                    			</div>
<!--                                 <div class="position-relative form-group">
                                    <label for="jml_tindakan" class="">Jumlah</label>
                                    <div class="input-group input-group-sm">
                                      <input type="number" class="form-control" id="jml_tindakan" name="jml_tindakan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                      <div class="input-group-append">
                                        <span class="input-group-text" id="span_satuan">satuan</span>
                                      </div>
                                  </div>
                                </div>
                                <div class="position-relative form-group">
                                    <label for="toth_obat" class="">Total Harga</label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                        </div>
                                        <input name="toth_obat" id="toth_obat" placeholder="" type="number" class="form-control form-control-sm" disabled="">
                                    </div>
                                </div> -->
                                <div class="position-relative form-group text-right mt-2 mb-2">
                                    <button type="button" class="btn btn-danger btn-sm" id="reset_tindakan">reset</button>
                                    <button type="button" class="btn btn-info btn-sm" id="tambah_tindakan">tambah</button>
                                </div>
                    		<!-- </form> -->
                    	</div>
                        <div class="col-md-3 kotak-form-pembayaran" style="display:none;">
                            <!-- <div class="judul-form">Form data obat terjual</div> -->
                            <!-- <form action="javascript:void(0);">  -->
                                <div class="position-relative form-group">
                                    <label class="">Total</label>
                                    <!-- <input type="number" class="form-control form-control-sm" id="kode_obat"> -->
                                    <div class="text-right">
                                        Rp<span id="total_pembayaran">127500</span>
                                    </div>
                                </div>
                                <div class="position-relative form-group">
                                    <label for="jml_uang" class="">Jumlah Uang</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                      </div>
                                      <input name="jml_uang" id="jml_uang" placeholder="" type="number" class="form-control" placeholder="0">
                                    </div>
                                </div>
                                <div class="position-relative form-group">
                                    <label for="jml_kembali" class="">Kembalian</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                      </div>
                                      <input type="text" class="form-control" id="jml_kembali" name="jml_kembali" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" readonly="">
                                    </div>
                                </div>
                            <!-- </form> -->
                        </div>
                    	<div class="col-md-9 kotak-tabel-tindakan-terjual">
                            <table class="table display tabel-data">
                                <thead>
                                    <tr>
                                        <th class="text-left">Kode</th>
                                        <th class="text-left">Tindakan </th>
                                        <th class="text-center">Harga</th>
                                                                                                
                                    </tr>
                                </thead>
                                <tbody id="keranjang_tindakan">
                                    
                                </tbody>
                                <tfoot>
                                    <tr id="baris_kosong">
                                        <td colspan="5" class="text-center">Belum ada data</td>
                                    </tr>
                                    <tr class="baris_total" style="display: none;">
                                        <td colspan="3" class="text-right" style="font-weight: bold;">Total : <span id="total_penjualan"></span><input type="hidden" name="hidden_totalpenjualan" id="hidden_totalpenjualan"></td>
                                        <td class="td-opsi">
                                            <button type="button" class="btn-transition btn btn-outline-danger btn-sm" title="hapus semua tindakan" id="hapus_semua_tindakan">hapus</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="baris_total text-right" style="display: none;">
                                <button type="button" name="lanjut_pembayaran" id="lanjut_pembayaran" class="btn btn-link btn-sm" style="font-size: 12px;">lanjut pembayaran</button>
                                <button type="button" name="lanjut_pembayaran" id="tambah_tindakan_lagi" class="btn btn-link btn-sm" style="font-size: 12px; display: none;">tambah tindakan lagi</button>
                            </div>
                    	</div>
                    </div>
                    <div class="text-right tombol-kanan">
                        <input type="submit" name="simpan_tindakan" id="simpan_tindakan" class="btn btn-info" value="Simpan">
                    </div>
                </form>
                <br>
<h5 align="center"> Riwayat Tindakan Pasien</h5>                
        <table  id="" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>No</th>
<!--                     <th>No Reg</th> -->
                    <th>Dokter</th>
                    <th>Nama Tindakan</th>
                  <th>Harga Tindakan</th>
                  <th>Jasa Medis</th>
                </tr>
            </thead>
            <?php 

    $no_daftar = @$_GET['id'];

                $tgl_sekarang = date('Y-m-d');
                $nomor = 1;
                $query_pjltindakan = "SELECT tbl_tindakandetail.*, tbl_tindakandetail.kd_tindakan,tbl_tindakandetail.kd_tindakan, tbl_tindakan.no_daftar,tbl_tindakan.nm_dokter, data_tindakan.kd_tindakan, data_tindakan.nama_tindakan, data_tindakan.jasa_dokter FROM tbl_tindakandetail
                  LEFT JOIN tbl_tindakan ON tbl_tindakandetail.no_tindakan=tbl_tindakan.no_tindakan
                  LEFT JOIN data_tindakan ON tbl_tindakandetail.kd_tindakan=data_tindakan.kd_tindakan

                WHERE no_daftar ='$no_daftar' ";
                $sql_pjltindakan = mysqli_query($conn, $query_pjltindakan) or die ($conn->error);
             ?>
            <tbody>
            <?php  
                while($data_pjltindakan = mysqli_fetch_array($sql_pjltindakan)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
<!--                     <td><?php echo $data_pjltindakan['no_daftar']; ?></td> -->
                    <td><?php echo $data_pjltindakan['nm_dokter']; ?></td>
                    <td><?php echo $data_pjltindakan['nama_tindakan']; ?></td>
                    <td><?php echo $data_pjltindakan['hrg_tindakan']; ?></td>
                    <td><?php echo $data_pjltindakan['jasa_dokter']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_datatindakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Tindakan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="example" class="table table-striped display">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Tindakan</th>
                    <th>Harga</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
        <?php 
        require_once "koneksi.php";
            $query_tampil = "SELECT * FROM data_tindakan ";
/*            $query_tampil = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp > date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.stok > 0 ORDER BY tbl_dataobat.nm_obat ASC";*/

            $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
            while($data = mysqli_fetch_array($sql_tampil)) {
         ?>
                <tr>
                    <td><?php echo $data['kd_tindakan']; ?></td>
                    <td><?php echo $data['nama_tindakan']; ?></td>
                    <td><?php echo $data['harga_tindakan']; ?></td>
                    <td class="td-opsi">
                        <button class="btn-transition btn btn-outline-dark btn-sm" title="pilih" id="tombol_pilihtindakan" name="tombol_pilihtindakan" data-dismiss="modal"
                            data-kode="<?php echo $data['kd_tindakan']; ?>"
                            data-nama="<?php echo $data['nama_tindakan']; ?>"
                            data-harga="<?php echo $data['harga_tindakan']; ?>"
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



<script>
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
 

    $("button[name='tombol_pilihtindakan']").click(function() {
        var kode = $(this).data('kode');
        var nama = $(this).data('nama');
        var harga = $(this).data('harga');
       

        $("#kode_tindakan").val(kode);
        $("#nama_tindakan").val(nama);
        $("#harga_tindakan").val(harga);
    });

    // $("#kode_obat").click(functon() {
    //     $("#lihat_data_obat").click();
    // });

    $("#kode_tindakan").keypress(function (e) {
        var key = e.which;
        if(key == 13) {
            alert();
        }
    })

    $("#harga_tindakan").keyup(function() { hrg_obat(); });

    $("#reset_tindakan").click(function() {
        reset();
    });

    $("#tambah_tindakan").click(function() {
        var kode = $("#kode_tindakan").val();
        var nama = $("#nama_tindakan").val();
        var harga = $("#harga_tindakan").val();

        if(kode=="") {
            document.getElementById("lihat_data_tindakan").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong masukkan data obat terlebih dahulu',
              'warning'
            )
        } else if(harga=="" || harga<=0) {
            document.getElementById("harga_tindakan").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi harga obat dengan benar',
              'warning'
            )
        } else {
            // alert(kode+" / "+nama+" / "+harga+" / "+jumlah+" / "+satuan+" / "+subtotal);
            count = count+1;
            var output = "";
            output = '<tr id="row_'+count+'">';
            output += '<td>'+kode+' <input type="hidden" name="hidden_kdtindakan[]" id="td_kd_tindakan'+count+'" class="td_kd_tindakan" value="'+kode+'"></td>';
            output += '<td>'+nama+' <input type="hidden" name="hidden_nmtindakan[]" id="td_nmtindakan'+count+'" class="td_nmtindakan" value="'+nama+'"></td>';

                     output += '<td class="text-right">'+harga+' <input type="hidden" name="hidden_hrgtindakan[]" id="td_hrgtindakan'+count+'" class="td_hrgtindakan" value="'+harga+'"></td>';
            output += '<td class="td-opsi"><button type="button" class="hapus_tindakan btn-transition btn btn-outline-danger btn-sm" name="hapus_tindakan" id="'+count+'" title="hapus tindakan ini">hapus</button></td>';
            output += '</tr>';
            $("#keranjang_tindakan").append(output);
            $("#baris_kosong").hide();
            total_penjualan = total_penjualan+subtotal;
            $("#total_penjualan").text(total_penjualan);
            $("#hidden_totalpenjualan").val(total_penjualan);
            $("#total_pembayaran").text(total_penjualan);
            $(".baris_total").show();
            reset();
        }
    });

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
        var norem = $("#norem").val();
        
        if(no_tindakan=="") {
            document.getElementById("no_tindakan").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi nomor penjualan',
              'warning'
            )
        } else 
        if(tanggal_tindakan==""){
            document.getElementById("tanggal_tindakan").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi periode penjualan',
              'warning'
            )
       /* } else if(total_penjualan==0){
            document.getElementById("lihat_data_tindakan").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, anda belum mengisi daftar tindakan',
              'warning'
            )*/
        } 
       /* else if(nominal<=0 || nominal==""){
            $("#lanjut_pembayaran").click();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, anda belum mengisi jumlah uang pembayaran',
              'warning'
            )
        } */
        else {
            Swal.fire({
              title: 'Simpan ?',
              text: 'apakah anda telah mengisi data penjualan dengan benar ',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya'
            }).then((simpan) => {
              if (simpan.value) {
                var count_data = 0;
                $(".td_kd_tindakan").each(function(){
                    count_data = count_data + 1;
                });
                if(count_data > 0) {
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "ajax/simpan_tindakan.php",
                        method: "POST",
                        data: form_data,
                        success:function(data) {
                            Swal.fire({
                              title: 'Berhasil',
                              text: 'Data Berhasil Disimpan',
                              type: 'success',
                              confirmButtonColor: '#3085d6',
                              confirmButtonText: 'OK'
                            }).then((ok) => {
                              if (ok.value) {
                                // window.location='?page=entry_datapenjualan';
                                window.location='?page=perawatan';
                                
                              }
                            })
                        }
                    })
                } else {
                    alert();
                }
              }
            })
        }
    });
});
</script>