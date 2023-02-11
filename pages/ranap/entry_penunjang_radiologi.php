<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="?page=entry_penunjang_radiologi"><i class="fas fa-align-left"></i> Form Entry Data Radiologi</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-shopping-bag"></i> Data Radiologi</li>
  </ol>
</nav>

 
 <?php 
    $no_daftar = @$_GET['id'];
 ?>

              
<div class="page-content">
    <div class="row">
        <div class="col-6"><h4>Form Radiologi </h4></div>
        <div class="col-6 text-right">
            <a href="?page=perawatan_ranap">
                <button class="btn btn-sm btn-info">Data Perawatan</button>
            </a>
        </div>
    </div>

   <?php 
                    $query_tampil = "SELECT * FROM tbl_daftarpasienranap WHERE no_daftar='$no_daftar'";
                    $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
                    $data = mysqli_fetch_array($sql_tampil);
                   ?>

  <form method="post" id="form_radiologi" autocomplete="off">
                    <div class="row data-radiologi">
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
                    $tgl_radiologi = gmdate('Y-m-d', time() + 60 * 60 * 7);
                    $hari= substr($tgl_radiologi, 8, 2);
                    $bulan = substr($tgl_radiologi, 5, 2);
                    $tahun = substr($tgl_radiologi, 0, 4);
                    $tgl = $tahun.$bulan.$hari;
                    $carikode = mysqli_query($conn, "SELECT MAX(no_radiologi) FROM tbl_radiologi WHERE tgl_radiologi = '$tgl_radiologi'") or die (mysql_error());
                    $datakode = mysqli_fetch_array($carikode);
                    if($datakode) {
                        $nilaikode = substr($datakode[0], 13);
                        $kode = (int) $nilaikode;
                        $kode = $kode + 1;
                        $no_radiologi = "Rad/".$tgl."/".str_pad($kode, 2, "0", STR_PAD_LEFT);
                    } else {
                        $no_radiologi = "Rad/".$tgl."/01";
                    }
                 ?>

                <div style="text-align: right;">
                    No radiologi : <b><?php echo $no_radiologi; ?></b> Tanggal : <b><?php echo tgl_indo(date('Y-m-d')); ?></b>
                </div>
              
                    <div class="position-relative row form-group">
                        <!-- <label for="no_penjualan" class="col-sm-2 col-form-label">Nomor Penjualan</label> -->
                        <div class="col-sm-4">
                            <input name="no_radiologi" id="no_radiologi" placeholder="nomor radiologi" type="hidden" class="form-control form-control-sm" value="<?php echo $no_radiologi; ?>">
                        </div>
                        <!-- <label for="tanggal_pjl" class="col-sm-2 col-form-label">Periode Penjualan</label> -->
                        <div class="col-sm-4">
                            <input name="tanggal_radiologi" id="tanggal_radiologi" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                    <!-- <h6><i class="fas fa-list-alt"></i> Masukkan daftar obat terjual</h6> -->
                    <div class="row kotak-form-tabel-radiologi">
                        <div class="col-md-3 kotak-form-radiologi-terjual" style="display: ;">
                            <!-- <div class="judul-form">Form data obat terjual</div> -->
                            <!-- <form action="javascript:void(0);">  -->
                                <div class="position-relative form-group">
                                    <label for="kode_radiologi" class="">Kode radiologi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" id="kode_radiologi">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_dataradiologi" id="lihat_data_radiologi"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative form-group">
                                    <label for="nama_radiologi" class="">Nama radiologi</label>
                                    <input name="nama_radiologi" id="nama_radiologi" placeholder="" type="text" class="form-control form-control-sm" disabled="">
                                </div>
                                <div class="position-relative form-group">
                                    <label for="harga_radiologi" class="">Harga</label>
                                    <div class="input-group input-group-sm">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                      </div>
                                      <input type="number" class="form-control" id="harga_radiologi" name="harga_radiologi" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                  </div>
                                </div>
<!--                                 <div class="position-relative form-group">
                                    <label for="jml_radiologi" class="">Jumlah</label>
                                    <div class="input-group input-group-sm">
                                      <input type="number" class="form-control" id="jml_radiologi" name="jml_radiologi" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
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
                                    <button type="button" class="btn btn-danger btn-sm" id="reset_radiologi">reset</button>
                                    <button type="button" class="btn btn-info btn-sm" id="tambah_radiologi">tambah</button>
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
                        <div class="col-md-9 kotak-tabel-radiologi-terjual">
                            <table class="table display tabel-data">
                                <thead>
                                    <tr>
                                        <th class="text-left">Kode</th>
                                        <th class="text-left">radiologi </th>
                                        <th class="text-center">Harga</th>
                                                                            
                                    </tr>
                                </thead>
                                <tbody id="keranjang_radiologi">
                                    
                                </tbody>
                                <tfoot>
                                    <tr id="baris_kosong">
                                        <td colspan="5" class="text-center">Belum ada data</td>
                                    </tr>
                                    <tr class="baris_total" style="display: none;">
                                        <td colspan="3" class="text-right" style="font-weight: bold;">Total : <span id="total_penjualan"></span><input type="hidden" name="hidden_totalpenjualan" id="hidden_totalpenjualan"></td>
                                        <td class="td-opsi">
                                            <button type="button" class="btn-transition btn btn-outline-danger btn-sm" title="hapus semua radiologi" id="hapus_semua_radiologi">hapus</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="baris_total text-right" style="display: none;">
                                <button type="button" name="lanjut_pembayaran" id="lanjut_pembayaran" class="btn btn-link btn-sm" style="font-size: 12px;">lanjut pembayaran</button>
                                <button type="button" name="lanjut_pembayaran" id="tambah_radiologi_lagi" class="btn btn-link btn-sm" style="font-size: 12px; display: none;">tambah radiologi lagi</button>
                            </div>
                        </div>
                    </div>
                    <div class="text-right tombol-kanan">
                        <input type="submit" name="simpan_radiologi" id="simpan_radiologi" class="btn btn-info" value="Simpan">
                    </div>
                </form>
                <br>
<h5 align="center"> Riwayat radiologi Pasien</h5>                
        <table  id="" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>No</th>
<!--                     <th>No Reg</th> -->
                    <th>Dokter</th>
                    <th>Nama radiologi</th>
                  <th>Harga radiologi</th>
                </tr>
            </thead>
            <?php 

    $no_daftar = @$_GET['id'];

                $tgl_sekarang = date('Y-m-d');
                $nomor = 1;
                $query_pjlradiologi = "SELECT tbl_radiologidetail.*, tbl_radiologidetail.kd_radiologi,tbl_radiologidetail.kd_radiologi, tbl_radiologi.no_daftar,tbl_radiologi.nm_dokter, data_radiologi.kd_radiologi, data_radiologi.nama_radiologi FROM tbl_radiologidetail
                  LEFT JOIN tbl_radiologi ON tbl_radiologidetail.no_radiologi=tbl_radiologi.no_radiologi
                  LEFT JOIN data_radiologi ON tbl_radiologidetail.kd_radiologi=data_radiologi.kd_radiologi

                WHERE no_daftar ='$no_daftar' ";
                $sql_pjlradiologi = mysqli_query($conn, $query_pjlradiologi) or die ($conn->error);
             ?>
            <tbody>
            <?php  
                while($data_pjlradiologi = mysqli_fetch_array($sql_pjlradiologi)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
<!--                     <td><?php echo $data_pjlradiologi['no_daftar']; ?></td> -->
                    <td><?php echo $data_pjlradiologi['nm_dokter']; ?></td>
                    <td><?php echo $data_pjlradiologi['nama_radiologi']; ?></td>
                    <td><?php echo $data_pjlradiologi['hrg_radiologi']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
 

<!-- Modal -->
<div class="modal fade" id="modal_dataradiologi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data radiologi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="example" class="table table-striped display">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama radiologi</th>
                    <th>Harga</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
        <?php 
        require_once "koneksi.php";
            $query_tampil = "SELECT * FROM data_radiologi ";
/*            $query_tampil = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp > date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.stok > 0 ORDER BY tbl_dataobat.nm_obat ASC";*/

            $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
            while($data = mysqli_fetch_array($sql_tampil)) {
         ?>
                <tr>
                    <td><?php echo $data['kd_radiologi']; ?></td>
                    <td><?php echo $data['nama_radiologi']; ?></td>
                    <td><?php echo $data['harga_radiologi']; ?></td>
                    <td class="td-opsi">
                        <button class="btn-transition btn btn-outline-dark btn-sm" title="pilih" id="tombol_pilihradiologi" name="tombol_pilihradiologi" data-dismiss="modal"
                            data-kode="<?php echo $data['kd_radiologi']; ?>"
                            data-nama="<?php echo $data['nama_radiologi']; ?>"
                            data-harga="<?php echo $data['harga_radiologi']; ?>"
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




          </div>
        </div>
    </div>
</div>




<div class="modal fade" id="detail_pembelian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Detail Obat</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="tabel-profil">
                <tr>
                    <th>No Faktur</th>
                    <td id="no_fakturdetail">PJL00001</td>
                    <th>Tanggal</th>
                    <td id="tgl_pembeliandetail">20/11/19</td>
                </tr>
                <tr>
                    <th>Supplier</th>
                    <td id="nm_supplierdetail">Faizal Abidin</td>
                    <th>Status</th>
                    <td id="status_pembeliandetail">Lunas</td>
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
                <tbody id="data_detailpembelian">
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

<!-- tambahan  -->
        <div class="tab-pane fade" id="dpembelian_bayar" role="tabpanel" aria-labelledby="dpembelian_bayar-tab">
            <div class="table-container">
                <table id="example3" class="table table-striped display tabel-data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Faktur</th>
                            <th>Tanggal</th>
                            <th>Supplier</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Jth Tempo</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                  
                    </tbody>
                </table>
            </div>
          </div>
      </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
  $("#dpembelian_lunas-tab").click(function(){
      $("#dpembelian_lunas").show();
      $("#dpembelian_utang").hide();
      $("#dpembelian_bayar").hide();

  });
  $("#dpembelian_utang-tab").click(function(){
      $("#dpembelian_utang").show();
      $("#dpembelian_lunas").hide();
      $("#dpembelian_bayar").hide();

  });
  $("#dpembelian_bayar-tab").click(function(){
      $("#dpembelian_bayar").show();
      $("#dpembelian_lunas").hide();
      $("#dpembelian_utang").hide();
  });

});
</script>

<script>
    $("button[name='tombol_detail']").click(function() {
        var no_faktur = $(this).data("no_faktur");
        var tgl_pembelian = $(this).data("tgl_pembelian");
        var nama_supp = $(this).data("nama_supp");
        var status_byr = $(this).data("status_byr");
        $("#no_fakturdetail").html(no_faktur);
        $("#tgl_pembeliandetail").html(tgl_pembelian);
        $("#nm_supplierdetail").html(nama_supp);
        $("#status_pembeliandetail").html(status_byr);

        $("#data_detailpembelian").html("");
        $.ajax({
            type: "GET",
            url: "ajax/detail.php?page=pembelian",
            data: "no_faktur="+no_faktur,
            success : function(data) {
                // console.log(data);
                var total_pembelian = 0;
                var objData = JSON.parse(data);
                $.each(objData, function(key,val){
                    // $("#data_detailpjl").append(val.nm_obat+"/"+val.hrg_jual+"/"+val.jml_jual+"/"+val.sat_jual+"/"+val.subtotal+"<br>");
                    var baris_baru = '';
                    baris_baru += '<tr>';
                    baris_baru +=   '<td>'+val.nm_obat+'</td>';
                    baris_baru +=   '<td class="text-right">'+val.hrg_beli+'</td>';
                    baris_baru +=   '<td class="text-center">'+val.jml_beli+'</td>';
                    baris_baru +=   '<td>'+val.sat_beli+'</td>';
                    baris_baru +=   '<td class="text-right">'+val.subtotal+'</td>';
                    baris_baru += '</tr>';

                    total_pembelian = total_pembelian + Number(val.subtotal);
                    $("#data_detailpembelian").append(baris_baru);
                    $("#total_pembeliandetail").html(total_pembelian);
                })
            }
        });
    });

    $("button[name='tombol_hapus']").click(function() {
        var no_faktur = $(this).data("no_faktur");
        Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda akan menghapus data pembelian '+no_faktur+', anda tidak dapat mengembalikan data yang telah dihapus.',
          type: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#3085d6',
          cancelButtonText: 'Tidak',
          confirmButtonText: 'Hapus'
        }).then((hapus) => {
          if (hapus.value) {
            $.ajax({
              type: "POST",
              url: "ajax/hapus.php?page=datapembelian",
              data: "id="+no_faktur,
              success: function(hasil) {
                Swal.fire({
                  title: 'Berhasil',
                  text: 'Data Berhasil Dihapus',
                  type: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                }).then((ok) => {
                  if (ok.value) {
                    window.location='?page=datapembelian';
                  }
                })
              }
            })  
          }
        })
    });

    $("button[name='tombol_pelunasan']").click(function() {
        var no_faktur = $(this).data("no_faktur");
        var nama_supp = $(this).data("nama_supp");
        Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda telah melunasi pembelian '+no_faktur+' dengan pihak '+nama_supp+', data ini tidak dapat dirubah kembali.',
          type: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#28A745',
          cancelButtonText: 'Tidak',
          confirmButtonText: 'Lunas'
        }).then((lunas) => {
          if (lunas.value) {
            $.ajax({
              type: "POST",
              url: "ajax/detail.php?page=pelunasan_pembelian",
              data: "no_faktur="+no_faktur,
              success: function(hasil2) {
                Swal.fire({
                  title: 'Berhasil',
                  text: 'Pembelian Telah Lunas',
                  type: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                }).then((ok_lunas) => {
                  if (ok_lunas.value) {
                    window.open("laporan/?page=nota_pembelian&no_faktur="+no_faktur);
                    window.location='?page=datapembelian';
                  }
                })
              }
            })  
          }
        })
    });
</script>




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
        $("#kode_radiologi").val("");
        $("#nama_radiologi").val("");
        $("#harga_radiologi").val("");
    }

    $("button[name='tombol_pilihdokter']").click(function() {
        var kd = $(this).data('kd');
        var nm = $(this).data('nm');
       

        $("#kd_dokter").val(kd);
        $("#nm_dokter").val(nm);
    });
 

    $("button[name='tombol_pilihradiologi']").click(function() {
        var kode = $(this).data('kode');
        var nama = $(this).data('nama');
        var harga = $(this).data('harga');
       

        $("#kode_radiologi").val(kode);
        $("#nama_radiologi").val(nama);
        $("#harga_radiologi").val(harga);
    });

    // $("#kode_obat").click(functon() {
    //     $("#lihat_data_obat").click();
    // });

    $("#kode_radiologi").keypress(function (e) {
        var key = e.which;
        if(key == 13) {
            alert();
        }
    })

    $("#harga_radiologi").keyup(function() { hrg_obat(); });

    $("#reset_radiologi").click(function() {
        reset();
    });

    $("#tambah_radiologi").click(function() {
        var kode = $("#kode_radiologi").val();
        var nama = $("#nama_radiologi").val();
        var harga = $("#harga_radiologi").val();

        if(kode=="") {
            document.getElementById("lihat_data_radiologi").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong masukkan data obat terlebih dahulu',
              'warning'
            )
        } else if(harga=="" || harga<=0) {
            document.getElementById("harga_radiologi").focus();
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
            output += '<td>'+kode+' <input type="hidden" name="hidden_kdradiologi[]" id="td_kd_radiologi'+count+'" class="td_kd_radiologi" value="'+kode+'"></td>';
            output += '<td>'+nama+' <input type="hidden" name="hidden_nmradiologi[]" id="td_nmradiologi'+count+'" class="td_nmradiologi" value="'+nama+'"></td>';

                     output += '<td class="text-right">'+harga+' <input type="hidden" name="hidden_hrgradiologi[]" id="td_hrgradiologi'+count+'" class="td_hrgradiologi" value="'+harga+'"></td>';
            output += '<td class="td-opsi"><button type="button" class="hapus_radiologi btn-transition btn btn-outline-danger btn-sm" name="hapus_radiologi" id="'+count+'" title="hapus radiologi ini">hapus</button></td>';
            output += '</tr>';
            $("#keranjang_radiologi").append(output);
            $("#baris_kosong").hide();
            total_penjualan = total_penjualan+subtotal;
            $("#total_penjualan").text(total_penjualan);
            $("#hidden_totalpenjualan").val(total_penjualan);
            $("#total_pembayaran").text(total_penjualan);
            $(".baris_total").show();
            reset();
        }
    });

    $(document).on("click", ".hapus_radiologi", function() {
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
            $("#tambah_radiologi_lagi").click();
        }
    });

    $("#hapus_semua_radiologi").click(function() {
        Swal.fire({
          title: 'Hapus Semua ?',
          text: 'apakah anda yakin menghapus semua daftar radiologi',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $("#keranjang_radiologi > tr").remove();
            total_penjualan = 0;
            $("#hidden_totalpenjualan").val("0");
            $("#total_pembayaran").text(total_penjualan);
            $("#baris_kosong").show();
            $(".baris_total").hide();
            $("#tambah_radiologi_lagi").click();
          }
        })
    });

    $("#lanjut_pembayaran").click(function() {
        // alert();
        $(".kotak-form-radiologi-terjual").hide();
        $(".kotak-form-pembayaran").show();
        document.getElementById("jml_uang").focus();
        $("#tambah_radiologi_lagi").show();
        $("#lanjut_pembayaran").hide();
    });

    $("#tambah_radiologi_lagi").click(function() {
        // alert();
        $(".kotak-form-radiologi-terjual").show();
        $(".kotak-form-pembayaran").hide();
        $("#jml_uang").val("");
        $("#jml_kembali").val("");
        $("#tambah_radiologi_lagi").hide();
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

    $("#form_radiologi").on("submit", function(event){
        event.preventDefault();
        var no_radiologi = $("#no_radiologi").val();
        var tanggal_radiologi = $("#tanggal_radiologi").val();
        var no_rawat = $("#no_rawat").val();
        var nominal = $("#jml_uang").val();
        var kembali = $("#jml_kembali").val();
        var nm_dokter = $("#nm_dokter").val();
        var norem = $("#norem").val();

        if(no_radiologi=="") {
            document.getElementById("no_radiologi").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi nomor penjualan',
              'warning'
            )
        } else 
        if(tanggal_radiologi==""){
            document.getElementById("tanggal_radiologi").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi periode penjualan',
              'warning'
            )
       /* } else if(total_penjualan==0){
            document.getElementById("lihat_data_radiologi").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, anda belum mengisi daftar radiologi',
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
                $(".td_kd_radiologi").each(function(){
                    count_data = count_data + 1;
                });
                if(count_data > 0) {
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "ajax/simpan_radiologi.php",
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
                                window.location='?page=perawatan_ranap';
                                
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
            </div>   
          </div>

