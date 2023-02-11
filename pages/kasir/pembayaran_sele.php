<?php 
    $no_daftar = @$_GET['id'];
 ?>


<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Perawatan</li>
  </ol>
</nav>

<div class="page-content">
    <div class="row">
        <div class="col-6"><h4>Rekam Medis Pasien</h4></div>
        <div class="col-6 text-right">
            <a href="?page=riwayatmedis">
                <button class="btn btn-sm btn-info">Riwayat Medis Pasien</button>
            </a>
        </div>
    </div>




<div class="form-container">
        <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">

                    <div class="row data-pengobatan">
                        <div class="position-relative form-group col-md-4">
                            <label for="no_daftar" class="">Nomor Registrasi <small>(nomor  pendaftaran)</small></label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm" id="no_rawat" name="no_rawat" value="<?php echo $no_daftar; ?>" disabled="">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-file-signature"></i></span>
                                </div>
                            </div>
   
                        </div>

                  <?php 
                    $query_tampil = "SELECT * FROM tbl_daftarpasien WHERE no_daftar='$no_daftar'";
                    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                    $data = mysqli_fetch_array($sql_tampil);
                   ?>


                        <div class="position-relative form-group col-md-4">
                            <label for="nama_pas" class="">Nama Pasien</label>
                            <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="nama_pasien" name="nama_pasien" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nama_pas']; ?>" disabled="">
                                </div>
                           
                        </div>
                        <div class="position-relative form-group col-md-4">
                            <label for="nomor_rm" class="">Nomor RM</label>
                            <div class="input-group ">
                              <input type="text" class="form-control form-control-sm" id="norem" name="norem" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nomor_rm']; ?>" disabled="">
                            </div>
                        </div>
                    </div>

 <h5><i class="fas fa-list-alt"></i> Riwayat Obat Pasien</h5>
        <table id="tbl_pjlobat" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Reg</th>
                    <th>Nama Obat</th>
                    <th>Aturan Pakai</th>
                    <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Subtotal</th>
                </tr>
            </thead>
            <?php 

    $no_daftar = @$_GET['id'];

$totalBayar = 0; 
                $tgl_sekarang = date('Y-m-d');
                $nomor = 1;
                $query_pjlobat = "SELECT tbl_pengobatandetail.*, tbl_pengobatandetail.kd_obat, tbl_pengobatan.no_daftar, tbl_dataobat.kd_obat, tbl_dataobat.nm_obat, tbl_dataobat.hrg_obat FROM tbl_pengobatandetail
                  LEFT JOIN tbl_pengobatan ON tbl_pengobatandetail.no_pengobatan=tbl_pengobatan.no_pengobatan
                  LEFT JOIN tbl_dataobat ON tbl_pengobatandetail.kd_obat=tbl_dataobat.kd_obat

                WHERE no_daftar ='$no_daftar' ";
                $sql_pjlobat = mysqli_query($conn, $query_pjlobat) or die ($conn->error);
             ?>
            <tbody>
            <?php  
                while($data_pjlobat = mysqli_fetch_array($sql_pjlobat)) {

                        $subtotal   = $data_pjlobat['jml_jual']* $data_pjlobat['hrg_jual'];
    $totalBayar = $totalBayar + $subtotal;
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $data_pjlobat['no_daftar']; ?></td>
                    <td><?php echo $data_pjlobat['nm_obat']; ?></td>
                    <td><?php echo $data_pjlobat['akai']; ?></td>
                    <td><?php echo $data_pjlobat['jml_jual']; ?></td>
                    <td><?php echo $data_pjlobat['hrg_jual']; ?></td>
                    <td><?php echo $subtotal; ?></td>
                </tr>
            <?php } ?>
            </tbody>
  <tr>
    <td colspan="6" align="right"><strong>Total Obat (Rp) : </strong></td>
    <td colspan="1" align="left" bgcolor="#F5F5F5"><?php echo $totalBayar; ?></td>
  </tr>

        </table>
    </div>
</div>
</div>

        <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">
<h5><i class="fas fa-list-alt"></i> Riwayat Obat Racik </h5>
        <table id="tbl_pjlobat" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Reg</th>
                    <th>Nama Obat</th>
                    <th>Aturan Pakai</th>
                    <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Subtotal</th>
                </tr>
            </thead>
            <?php 

    $no_daftar = @$_GET['id'];

$totel = 0;
     $totel_bayar = 0;

                $tgl_sekarang = date('Y-m-d');
                $nomor = 1;
                $query_pjlobat = "SELECT tbl_racikandetail.*, tbl_racikandetail.kd_obat, tbl_racikan.no_daftar, tbl_obatracik.kd_obat, tbl_nama_racikan.nama_racikan, tbl_obatracik.hrg_obat FROM tbl_racikandetail
                  LEFT JOIN tbl_racikan ON tbl_racikandetail.no_pengobatan=tbl_racikan.no_pengobatan
                  LEFT JOIN tbl_obatracik ON tbl_racikandetail.kd_obat=tbl_obatracik.kd_obat
                    LEFT JOIN tbl_nama_racikan ON tbl_racikandetail.kd_obat=tbl_nama_racikan.kd_racik

                WHERE no_daftar ='$no_daftar' ";
                $sql_pjlobat = mysqli_query($conn, $query_pjlobat) or die ($conn->error);
             ?>
            <tbody>
            <?php  
                while($data_pjlobat = mysqli_fetch_array($sql_pjlobat)) {

$totel = $data_pjlobat['jml_jual'] *$data_pjlobat['hrg_jual'];
      // total bayar adalah penjumlahan dari keseluruhan total
      $totel_bayar += $totel;
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $data_pjlobat['no_daftar']; ?></td>
                    <td><?php echo $data_pjlobat['nama_racikan']; ?></td>
                    <td><?php echo $data_pjlobat['akai']; ?></td>
                    <td><?php echo $data_pjlobat['jml_jual']; ?></td>
                    <td><?php echo $data_pjlobat['hrg_jual']; ?></td>
                    <td><?php echo $totel; ?></td>
                </tr>
            <?php } ?>
            </tbody>
              <tr>
    <td colspan="6" align="right"><strong>Total Obat (Rp) : </strong></td>
    <td colspan="1" align="left" bgcolor="#F5F5F5"><?php echo $totel_bayar; ?></td>
  </tr>

        </table>
    </div>
</div>

        <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">

<h5><i class="fas fa-list-alt"></i> Riwayat Tindakan Pasien</h5>                
        <table  id="example" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Reg</th>
                    <th>Dokter</th>
                    <th>Nama Tindakan</th>
                  <th>Harga Tindakan</th>
                </tr>
            </thead>

            <?php 

    $no_daftar = @$_GET['id'];

$total = 0;
     $tot_bayar = 0;
                $tgl_sekarang = date('Y-m-d');
                $nomor = 1;
                $query_pjltindakan = "SELECT tbl_tindakandetail.*, tbl_tindakandetail.kd_tindakan,tbl_tindakandetail.kd_tindakan, tbl_tindakan.no_daftar,tbl_tindakan.nm_dokter, data_tindakan.kd_tindakan, data_tindakan.nama_tindakan FROM tbl_tindakandetail
                  LEFT JOIN tbl_tindakan ON tbl_tindakandetail.no_tindakan=tbl_tindakan.no_tindakan
                  LEFT JOIN data_tindakan ON tbl_tindakandetail.kd_tindakan=data_tindakan.kd_tindakan

                WHERE no_daftar ='$no_daftar' ";
                $sql_pjltindakan = mysqli_query($conn, $query_pjltindakan) or die ($conn->error);

             ?>
            <tbody>
            <?php  
                while($data_pjltindakan = mysqli_fetch_array($sql_pjltindakan)) {
            
   
$total = $data_pjltindakan['hrg_tindakan'];
      // total bayar adalah penjumlahan dari keseluruhan total
      $tot_bayar += $total;

            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $data_pjltindakan['no_daftar']; ?></td>
                    <td><?php echo $data_pjltindakan['nm_dokter']; ?></td>
                    <td><?php echo $data_pjltindakan['nama_tindakan']; ?></td>
                    <td><?php echo $data_pjltindakan['hrg_tindakan']; ?></td>
                </tr>
            <?php } ?>
            </tbody>

            <tr>
    <td colspan="4" align="right"><strong>Total Obat (Rp) : </strong></td>
    <td colspan="1" align="left" bgcolor="#F5F5F5"><?php echo $tot_bayar; ?></td>
  </tr>
        </table>
    </div>
</div>

        <div class="row" style="padding:  0 16px; 
        right: 0; font-size: 24px">
            <div class="col-md-12 vertical-form">
                

<tr>

    <td colspan="4" align="right"><strong>Total Billing (Rp) : </strong></td>
    <td colspan="8" align="right" bgcolor="#F5F5F5" ><strong><?php echo ($tot_bayar+$totel_bayar+$totalBayar); ?></strong></td>
</tr>

</div>
        <form action="javascrip:void(0);"  autocomplete="off">
     
                              <input  id="no_transaksi" placeholder="nomor transaksi" type="hidden" class="form-control form-control-sm" value="<?php echo $no_daftar; ?>">

                                <div class="position-relative form-group">
                                    <label for="totalBayar" class="">Total Billing</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                      </div>
                                      <input  id="total_penjualan"  onkeyup="sum();" placeholder="" type="text" value="<?php echo ($tot_bayar+$totel_bayar+$totalBayar); ?>" class="form-control" placeholder="0">
                                    </div>
                                <div class="position-relative form-group">
                                    <label for="jml_uang" class="">Uang Administrasi</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                      </div>
                                      <input  id="administrasi"  onkeyup="sum();" placeholder="" type="number" class="form-control" placeholder="0">
                                    </div>
                                 <div class="position-relative form-group">
                                    <label for="total_bayar" class="">Total Bayar</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                      </div>
                                      <input type="text" class="form-control" id="total_bayar"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                                    </div> 

                                <div class="position-relative form-group">
                                    <label for="jml_uang" class="">Jumlah Uang</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                      </div>
                                      <input  id="jml_uang"  onkeyup="sum();" placeholder="" type="number" class="form-control" placeholder="0">
                                    </div>
                                <div class="position-relative form-group">
                                    <label for="jml_kembali" class="">Kembalian</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                      </div>
                                      <input type="text" class="form-control" id="jml_kembali"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" >
                                    </div>

                    <div class="text-right tombol-kanan">
            <div class="col-sm-12 text-right">
              <button class="btn btn-danger btn-sm" id="btn_reset">Reset</button>
              <button class="btn btn-info btn-sm" id="btn_simpan">Simpan</button>
            </div>
          </div>
        </form>

<script>

function sum() {
      var txtFirstNumberValue = document.getElementById('total_penjualan').value;
        var txtSecondNumberValue = document.getElementById('administrasi').value;
        var txtThreeNumberValue = document.getElementById('jml_uang').value;
        var tambah=parseInt(txtFirstNumberValue)+parseInt(txtSecondNumberValue);
      var result =  parseInt(txtThreeNumberValue)-tambah;
         document.getElementById('total_bayar').value = tambah;
      if (!isNaN(result)) {
         document.getElementById('jml_kembali').value = result;
      }
}
</script>
<script>
function reset_form() {
    $("#jml_uang").val("");
  }
  $("#btn_reset").click(function() {
    reset_form();
    document.getElementById("jml_uang").focus();
  });

  $("#btn_simpan").click(function() {
    var kode = $("#no_transaksi").val();
    var total_penjualan = $("#total_penjualan").val();
    var jml_uang = $("#jml_uang").val();
    var jml_kembali = $("#jml_kembali").val();
    var administrasi = $("#administrasi").val();

    // alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);

    if(kode=="") {
      document.getElementById("no_transaksi").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong isi nama supplier',
        'warning'
      )
    } else if (total_penjualan=="") {
      document.getElementById("total_penjualan").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong isi nama petugas supplier',
        'warning'
      )
    } else if (jml_uang=="") {
      document.getElementById("jml_uang").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong isi nama petugas supplier',
        'warning'
      )
    } else if (jml_kembali=="") {
      document.getElementById("jml_kembali").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong isi alamat supplier',
        'warning'
      )
          } else if (administrasi=="") {
      document.getElementById("administrasi").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong isi administrasi',
        'warning'
      )
    } else {
      $.ajax({
        type: "POST",
        url: "ajax/simpan_transaksi.php",
        data: "total_penjualan="+total_penjualan+"&kode="+kode+"&jml_uang="+jml_uang+"&jml_kembali="+jml_kembali+"&administrasi="+administrasi,
        success: function(hasil) {
            Swal.fire({
                  title: 'Berhasil',
                  text: 'Data Berhasil Disimpan',
                  type: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                }).then((ok) => {
                  if (ok.value) {
                    window.location='?page=kasir' ;
                  }
                })
            
          
        }
      });
    }
  });
</script>