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
        <div class="col-6"><h4>Tagihan Pasien Ranap</h4></div>
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
                        <div class="position-relative form-group col-md-3">
                            <label for="no_daftar" class="">Nomor Registrasi <small>(nomor  pendaftaran)</small></label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm" id="no_rawat" name="no_rawat" value="<?php echo $no_daftar; ?>" disabled="">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-file-signature"></i></span>
                                </div>
                            </div>
   
                        </div>

                  <?php 
                    $query_tampil = "SELECT * FROM tbl_daftarpasienranap WHERE no_daftar='$no_daftar'";
                    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                    $data = mysqli_fetch_array($sql_tampil);
                   ?>


                        <div class="position-relative form-group col-md-3">
                            <label for="nama_pas" class="">Nama Pasien</label>
                            <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="nama_pasien" name="nama_pasien" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nama_pas']; ?>" disabled="">
                                </div>
                           
                        </div>
                        <div class="position-relative form-group col-md-3">
                            <label for="nomor_rm" class="">Nomor RM</label>
                            <div class="input-group ">
                              <input type="text" class="form-control form-control-sm" id="norem" name="norem" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nomor_rm']; ?>" disabled="">
                            </div>
                        </div>

                        <div class="position-relative form-group col-md-3">
                            <label for="nama_pas" class="">Dokter DPJP</label>
                            <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="dokter" name="dokter" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['dokter']; ?>" disabled="">
                                </div>
                           
                        </div>

                    </div>

 <h5><i class="fas fa-list-alt"></i> Biaya Hari Rawatan</h5>
        <table id="tbl_pjlobat2" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Reg</th>
                    <th>Jlh Hari</th>
                    <th>Tarif</th>
                  <th>Harga</th>
                </tr>
            </thead>
            <?php 

    $no_daftar = @$_GET['id'];

$hariBay = 0; 
                $tgl_sekarang = date('Y-m-d');
                $nomor = 1;
                    $query_hari = "SELECT * FROM tbl_daftarpasienranap 


/*INNER JOIN ruangan ON tbl_daftarpasienranap.kamar = ruangan.id_kamar
      INNER JOIN bed ON tbl_daftarpasienranap.no_bed = bed.id_bed
*/
      where ket = 'open' AND no_daftar='$no_daftar'";

                $sql_hari = mysqli_query($conn, $query_hari) or die ($conn->error);
             ?>
            <tbody>
            <?php  
                while($data_rawat = mysqli_fetch_array($sql_hari)) {
$tarif=$data_rawat['trf_kamar'];
$tareg    =new DateTime($data_rawat['tgl_masuk']);
                        $today        =new DateTime();
                        $diff = $today->diff($tareg);

$total_hari = $data_rawat['trf_kamar']*($diff->d+1);
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $data_rawat['no_daftar']; ?></td>
                         <td><?php 
$tareg    =new DateTime($data_rawat['tgl_masuk']);
                        $today        =new DateTime();
                        $diff = $today->diff($tareg);
                        echo $diff->d+1; echo " Hari";?>

                    <td><?php echo $tarif; ?></td>
                    <td><?php echo $total_hari; ?></td>
                </tr>
            <?php } ?>
            </tbody>
<!--   <tr>
    <td colspan="6" align="right"><strong>Total Obat (Rp) : </strong></td>
    <td colspan="1" align="left" bgcolor="#F5F5F5"><?php echo $totalBayar; ?></td>
  </tr> -->

        </table>




 <h5><i class="fas fa-list-alt"></i> Riwayat Obat Pasien</h5>
        <table id="tbl_pjlobat2" class="table table-striped display tabel-data">
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

        <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">
<h5><i class="fas fa-list-alt"></i> Riwayat Obat Racik </h5>
        <table id="tbl_pjlobat3" class="table table-striped display tabel-data">
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
                $query_pjlobat = "SELECT tbl_racikandetail.*, tbl_racikandetail.kd_racik, tbl_racikan.no_daftar, tbl_obatracik.kd_obat, tbl_nama_racikan.nama_racikan, tbl_obatracik.hrg_obat FROM tbl_racikandetail
                  LEFT JOIN tbl_racikan ON tbl_racikandetail.no_pengobatan=tbl_racikan.no_pengobatan
                  LEFT JOIN tbl_obatracik ON tbl_racikandetail.kd_racik=tbl_obatracik.kd_obat
                    LEFT JOIN tbl_nama_racikan ON tbl_racikandetail.kd_racik=tbl_nama_racikan.kd_racik

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
    <td colspan="6" align="right"><strong>Total Obat Racik (Rp) : </strong></td>
    <td colspan="1" align="left" bgcolor="#F5F5F5"><?php echo $totel_bayar; ?></td>
  </tr>

        </table>
    </div>
</div>

        <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">

<h5><i class="fas fa-list-alt"></i> Riwayat Tindakan Pasien</h5>                
        <table  id="example222" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Registrasi</th>
                    <th>Dokter</th>
                    <th>Nama Tindakan</th>
                  <th>Harga </th>
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
    <td colspan="4" align="right"><strong>Total Tindakan (Rp) : </strong></td>
    <td colspan="1" align="left" bgcolor="#F5F5F5"><?php echo $tot_bayar; ?></td>
  </tr>
        </table>
    </div>
</div>

        <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">

<h5><i class="fas fa-list-alt"></i> Riwayat Pemeriksaan Laboratorium</h5>                
        <table  id="example222" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Labor</th>
                    <th>Dokter</th>
                    <th>Pemeriksaan</th>
                  <th>Harga </th>
                </tr>
            </thead>

            <?php 

    $no_daftar = @$_GET['id'];

$total_lab = 0;
     $tot_bayar_lab = 0;
                $tgl_sekarang = date('Y-m-d');
                $nomor = 1;
               $query_labor = "SELECT tbl_hematologidetail.*, tbl_hematologidetail.kd_hematologi,tbl_hematologidetail.no_lab, tbl_hematologi.no_daftar,tbl_hematologi.nm_dokter, tbl_nama_hematologi.kd_hematologi, tbl_nama_hematologi.nama_hematologi FROM tbl_hematologidetail
                  LEFT JOIN tbl_hematologi ON tbl_hematologidetail.no_lab=tbl_hematologi.no_lab
                  LEFT JOIN tbl_nama_hematologi ON tbl_hematologidetail.kd_hematologi=tbl_nama_hematologi.kd_hematologi

                WHERE no_daftar ='$no_daftar' ";
                $sql_labor = mysqli_query($conn, $query_labor) or die ($conn->error);

             ?>
            <tbody>
            <?php  
                while($datalab = mysqli_fetch_array($sql_labor)) {
            
   
$total_lab = $datalab['hrg_labor'];
      // total bayar adalah penjumlahan dari keseluruhan total
      $tot_bayar_lab += $total_lab;

            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $datalab['no_lab']; ?></td>
                    <td><?php echo $datalab['nm_dokter']; ?></td>
                    <td><?php echo $datalab['nama_hematologi']; ?></td>
                    <td><?php echo $datalab['hrg_labor']; ?></td>
                </tr>
            <?php } ?>
            </tbody>

            <tr>
    <td colspan="4" align="right"><strong>Total Labor (Rp) : </strong></td>
    <td colspan="1" align="left" bgcolor="#F5F5F5"><?php echo $tot_bayar_lab; ?></td>
  </tr>
        </table>
    </div>
</div>

        <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">

<h5><i class="fas fa-list-alt"></i> Riwayat Pemeriksaan Radiologi</h5>                
        <table  id="example222" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Radiologi</th>
                    <th>Dokter</th>
                    <th>Pemeriksaan</th>
                  <th>Harga </th>
                </tr>
            </thead>

            <?php 

    $no_daftar = @$_GET['id'];

$total_rad = 0;
     $tot_bayar_rad = 0;
                $tgl_sekarang = date('Y-m-d');
                $nomor = 1;
                $query_radiologi = "SELECT tbl_radiologidetail.*, tbl_radiologidetail.kd_radiologi,tbl_radiologidetail.kd_radiologi, tbl_radiologi.no_daftar,tbl_radiologi.nm_dokter, data_radiologi.kd_radiologi, data_radiologi.nama_radiologi FROM tbl_radiologidetail
                  LEFT JOIN tbl_radiologi ON tbl_radiologidetail.no_radiologi=tbl_radiologi.no_radiologi
                  LEFT JOIN data_radiologi ON tbl_radiologidetail.kd_radiologi=data_radiologi.kd_radiologi

                WHERE no_daftar ='$no_daftar' ";
                $sql_radiologi = mysqli_query($conn, $query_radiologi) or die ($conn->error);

             ?>
            <tbody>
            <?php  
                while($datarad = mysqli_fetch_array($sql_radiologi)) {
            
   
$total_rad = $datarad['hrg_radiologi'];
      // total bayar adalah penjumlahan dari keseluruhan total
      $tot_bayar_rad += $total_rad;

            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
                    <td><?php echo $datarad['no_radiologi']; ?></td>
                    <td><?php echo $datarad['nm_dokter']; ?></td>
                    <td><?php echo $datarad['nama_radiologi']; ?></td>
                    <td><?php echo $datarad['hrg_radiologi']; ?></td>
                </tr>
            <?php } ?>
            </tbody>

            <tr>
    <td colspan="4" align="right"><strong>Total Radiologi (Rp) : </strong></td>
    <td colspan="1" align="left" bgcolor="#F5F5F5"><?php echo $tot_bayar_rad; ?></td>
  </tr>
        </table>
    </div>
</div>


        <div class="row" style="padding:  0 16px; 
        right: 0; font-size: 24px">
            <div class="col-md-12 vertical-form">
                

<tr>

    <td colspan="4" align="right"><strong>Total Billing (Rp) : </strong></td>
    <td colspan="8" align="right" bgcolor="#F5F5F5" ><strong><?php echo number_format ($tot_bayar+$totel_bayar+$totalBayar+$total_hari+$tot_bayar_lab+$tot_bayar_rad); ?></strong></td>
</tr>

        <form action="javascrip:void(0);"  autocomplete="off">
     
                              <input  id="no_transaksi" placeholder="nomor transaksi" type="hidden" class="form-control form-control-sm" value="<?php echo $no_daftar; ?>">
    <?php 
error_reporting(0);
      $query_tampil = " SELECT tbl_transaksi_ranap.*, tbl_transaksi_ranap.no_daftar, tbl_transaksi_ranap.total_penjualan, tbl_transaksi_ranap.jml_uang, tbl_transaksi_ranap.jml_kembali,  tbl_daftarpasienranap.nama_pas, tbl_daftarpasienranap.asuransi_pas FROM tbl_transaksi_ranap

                  LEFT JOIN tbl_daftarpasienranap ON tbl_transaksi_ranap.no_daftar=tbl_daftarpasienranap.no_daftar  where tbl_transaksi_ranap.no_daftar ='$no_daftar'  ";


      $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
      while($datang = mysqli_fetch_array($sql_tampil)) {
$tunai =$datang['jml_uang'];
$kembali =$datang['jml_kembali'];
$adminis =$datang['administrasi'];
$pembayar =$datang['total_penjualan']+$datang['administrasi'];
     ?>
            <?php } ?>

      <div class="form-group row">
            <label for="nama_pas" class="col-sm-2 col-form-label">Total Billing</label>
            <div class="col-sm-4">
                                    <div class="input-group">

                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                      </div>
                                      <input  id="total_penjualan"  onkeyup="sum();" placeholder="" type="text" value="<?php echo  ($tot_bayar+$totel_bayar+$totalBayar+$total_hari); ?>" class="form-control" placeholder="0">
                                    </div>

          </div>
          <label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: right;">Administrasi</label>
            <div class="col-sm-4">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                      </div>
                                      <input  id="administrasi"  onkeyup="sum();" value="<?php echo $adminis; ?>" placeholder="" type="number" class="form-control" placeholder="0">
                                    </div>
          </div>
          </div>


      <div class="form-group row">
            <label for="nama_pas" class="col-sm-2 col-form-label">Total Pembayaran</label>
            <div class="col-sm-4">
                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                      </div>
                                      <input type="text" class="form-control" id="total_bayar"   aria-label="Sizing example input" value="<?php echo $pembayar; ?>" aria-describedby="inputGroup-sizing-sm" >
                                    </div>

          </div>
          <label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: right;"></label>
            <div class="col-sm-4">
          </div>
          </div>

      <div class="form-group row">

          <label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: left;">Tunai</label>
            <div class="col-sm-4">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                      </div>
                                      <input  id="jml_uang"  onkeyup="sum();" placeholder="" type="number" class="form-control" value="<?php echo $tunai; ?>" placeholder="0">
                                    </div>
          </div>
          </div>
     <div class="form-group row">

          <label for="nomor_rm" class="col-sm-2 col-form-label" style="text-align: left;">Kembalian </label>
            <div class="col-sm-4">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                      </div>
                                      <input type="text" class="form-control" id="jml_kembali"  value="<?php echo $kembali; ?>" aria-label="Sizing example input"  aria-describedby="inputGroup-sizing-sm" >
                                    </div>
          </div>
          </div>

                    <div class="text-right tombol-kanan">
            <div class="col-sm-12 text-right">
              <button class="btn btn-danger btn-sm" id="btn_reset">Reset</button>
              <button class="btn btn-info btn-sm" id="btn_simpan">Simpan</button>
<!--               <button class="btn btn-info btn-sm" id="btn_edit">Update</button> -->
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
        url: "ajax/simpan_transaksi_ranap.php",
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
                    window.location='?page=kasir_ranap' ;
                  }
                })
            
          
        }
      });
    }
  });
</script>
