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
        <div class="col-6"><h4>Tambah Pemeriksaan Lab</h4></div>
        <div class="col-6 text-right">
            <a href="?page=perawatan">
                <button class="btn btn-sm btn-info">Data Pemeriksaan LAB</button>
            </a>
        </div>
    </div>




<div class="form-container">
<!--         <div class="row" style="padding: 0 16px;"> -->


  <form method="post" id="form_hematologi" autocomplete="off">

        <div class="row" style="padding: 0 20px;">
            <div class="col-md-12 vertical-form">
                <?php 
                      $carikode = mysqli_query($conn, "SELECT MAX(kd_hematologi) as kodeTerbesar FROM tbl_nama_hematologi ") ;
                    $datakode = mysqli_fetch_array($carikode);
                    $kd_hematologi = $datakode['kodeTerbesar'];
                    $urutan = (int) substr($kd_hematologi, 3, 3);
                    $urutan =$urutan+1;
                    $huruf = "PEM";
$kd_hematologi = $huruf . sprintf("%03s", $urutan);

                 ?>

                <div style="text-align: right;">
                    No Hematologi : <b><?php echo $kd_hematologi; ?></b>                     
                    Tanggal : <b><?php echo date('Y-m-d'); ?></b>
                </div>
<div class="row data-hematologi">
 <div class="position-relative form-group col-md-6">

 <label for="nama_hematologi" class="">Nama Hematologi</label>
                            <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="nama_hematologi" name="nama_hematologi" placeholder="masukkan nama pasien" autofocus="" value="" >
                                </div>
</div>
<!--   <div class="position-relative form-group col-md-4">
     <label for="nama_hematologi" class="">Stok</label>
                            <div class="input-group">
                                    <input type="number" class="form-control form-control-sm" id="stk_obat" name="stk_obat" placeholder="masukkan stok hematologi" autofocus="" value="" >
                                </div>
</div> -->
  <div class="position-relative form-group col-md-4">
     <label for="nama_hematologi" class="">Harga Hematologi</label>
                            <div class="input-group">
                                    <input type="number" class="form-control form-control-sm" id="hrg_hematologi" name="hrg_hematologi" placeholder="masukkan stok hematologi" autofocus="" value="" >
                                </div>
</div>

                            <div class="input-group">
                                    <input type="hidden" class="form-control form-control-sm" id="status" name="status" placeholder="masukkan stok hematologi" autofocus="" value="aktif" >
                                </div>

</div>


                    <div class="position-relative row form-group">
                        <!-- <label for="no_penjualan" class="col-sm-2 col-form-label">Nomor Penjualan</label> -->
                        <div class="col-sm-4">
                           
                            <input name="kd_hematologi" id="kd_hematologi" placeholder="kode hematologi" type="hidden" class="form-control form-control-sm" value="<?php echo $kd_hematologi; ?>">
                        </div>


                        <!-- <label for="tanggal_pjl" class="col-sm-2 col-form-label">Periode Penjualan</label> -->
                        <div class="col-sm-4">
                            <input name="tanggal_hematologi" id="tanggal_hematologi" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                    <!-- <h6><i class="fas fa-list-alt"></i> Masukkan daftar obat terjual</h6> -->
                    <div class="row kotak-form-tabel-hematologi">
                        <div class="col-md-3 kotak-form-obat-terjual" style="display: ;">
                            <!-- <div class="judul-form">Form data obat terjual</div> -->
                            <!-- <form action="javascript:void(0);">  -->
                                <div class="position-relative form-group">
                                    <label for="kode_obat" class="">Pemeriksaan</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" id="kode_obat">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal_dataobat" id="lihat_data_obat"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative form-group">
                                    <label for="nm_obat" class="">Nama Labor</label>
                                    <input name="nm_obat" id="nm_obat" placeholder="" type="text" class="form-control form-control-sm" disabled="">
                                    <input type="hidden" id="stok_obat">
                                    <input type="hidden" id="exp_obat">
                                </div>
                                <div class="position-relative form-group">
                                    <label for="satuan" class="">Satuan</label>
                                    <input name="satuan" id="satuan" placeholder="" type="text" class="form-control form-control-sm" >
                                </div>
                                <div class="position-relative form-group">
                                    <label for="satuan" class="">Kategori</label>
                                    <input name="kategori" id="kategori" placeholder="" type="text" class="form-control form-control-sm" >
                                </div>


                                <div class="position-relative form-group">
                                    <label for="nilai_normal" class="">Nilai Normal</label>
                                    <div class="input-group input-group-sm">
                                      <div class="input-group-prepend">
                                        
                                      </div>
                                      <input type="text" class="form-control" id="nilai_normal" name="nilai_normal" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                  </div>
                                </div>
                                <div class="position-relative form-group text-right mt-2 mb-2">
                                    <button type="button" class="btn btn-danger btn-sm" id="reset_obat">reset</button>
                                    <button type="button" class="btn btn-info btn-sm" id="tambah_obat">tambah</button>
                                </div>
                            <!-- </form> -->
                        </div>

                        <div class="col-md-9 kotak-tabel-obat-terjual">
                            <table class="table display tabel-data">
                                <thead>
                                    <tr>
                                        <th class="text-left">Kode</th>
                                        <th class="text-left">Nama</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">Nilai</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody id="keranjang_obat">
                                    
                                </tbody>
                                <tfoot>
                                    <tr id="baris_kosong">
                                        <td colspan="8" class="text-center">Belum ada data</td>
                                    </tr>
                                    <tr class="baris_total" style="display: none;">

                                 
                                    </tr>
                                </tfoot>
                            </table>
                    <div class="text-right tombol-kanan">
                        <input type="submit" name="simpan_obathematologi" id="simpan_obathematologi" class="btn btn-info" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_dataobat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="tabel_dataobat" class="table table-striped display">
            <thead>
                <tr>
                   <th>Kode</th>
                    <th>Nama Obat</th>
                    <th>Satuan</th>
                    <th>Kategori</th>
                    <th>Nilai</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
        <?php 
        $no=1;
           $query_tampil = "SELECT * FROM data_labor";
            $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
            while($data = mysqli_fetch_array($sql_tampil)) {
         ?>
                <tr>
                    <td><?php echo $data['kd_labor']; ?></td>
                    <td><?php echo $data['nm_labor']; ?></td>
                    <td><?php echo $data['satuan']; ?></td>
                  <td><?php echo $data['kategori']; ?></td>
                    <td><?php echo $data['nilai_normal']; ?></td>

                    <td class="td-opsi">
                        <button class="btn-transition btn btn-outline-dark btn-sm" title="pilih" id="tombol_pilihobat" name="tombol_pilihobat" data-dismiss="modal"
                            data-kode="<?php echo $data['kd_labor']; ?>"
                            data-nama="<?php echo $data['nm_labor']; ?>"
                            data-satuan="<?php echo $data['satuan']; ?>"
                            data-nilai="<?php echo $data['nilai_normal']; ?>"
                            data-kategori="<?php echo $data['kategori']; ?>"
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
        $("#kode_obat").val("");
        $("#nm_obat").val("");
        $("#hrg_obat").val("");
        $("#jml_obat").val("");
        $("#span_satuan").text("satuan");
        $("#toth_obat").val("");

    }


    $("button[name='tombol_pilihobat']").click(function() {
        var kode = $(this).data('kode');
        var nama = $(this).data('nama');
        var satuan = $(this).data('satuan');
        var nilai = $(this).data('nilai');
        var kategori = $(this).data('kategori');

        $("#kode_obat").val(kode);
        $("#nm_obat").val(nama);
        $("#nilai_normal").val(nilai);
        $("#satuan").val(satuan);
        $("#kategori").val(kategori);
    });

    // $("#kode_obat").click(functon() {
    //     $("#lihat_data_obat").click();
    // });

    $("#kode_obat").keypress(function (e) {
        var key = e.which;
        if(key == 13) {
            alert();
        }
    })

    $("#hrg_obat").keyup(function() { hrg_obat(); });
    $("#hrg_obat").change(function() { hrg_obat(); });
    $("#jml_obat").keyup(function() { jml_obat(); });
    $("#jml_obat").change(function() { jml_obat(); });

    $("#reset_obat").click(function() {
        reset();
    });

    $("#tambah_obat").click(function() {
        var kode = $("#kode_obat").val();
        var nama = $("#nm_obat").val();
        var stok = Number($("#stok_obat").val());
        var nilai = $("#nilai_normal").val();
        var satuan = $("#satuan").val();
        var kategori = $("#kategori").val();
        var subtotal = Number($("#toth_obat").val());

        if(kode=="") {
            document.getElementById("lihat_data_obat").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong masukkan data obat terlebih dahulu',
              'warning'
            )

        } else {
            // alert(kode+" / "+nama+" / "+nilai+" / "+jumlah+" / "+satuan+" / "+subtotal);
            count = count+1;
            var output = "";
            output = '<tr id="row_'+count+'">';
            output += '<td>'+kode+' <input type="hidden" name="hidden_kdobat[]" id="td_kd_obat'+count+'" class="td_kd_obat" value="'+kode+'"></td>';
            output += '<td>'+nama+' <input type="hidden" name="hidden_nmobat[]" id="td_nmobat'+count+'" class="td_nmobat" value="'+nama+'"></td>';
            output += '<td class="text-center">'+satuan+' <input type="hidden" name="hidden_satuan[]" id="td_satuan'+count+'" class="td_satuan" value="'+satuan+'"></td>';
            output += '<td class="text-right">'+kategori+' <input type="hidden" name="hidden_kategori[]" id="td_kategori'+count+'" class="td_kategori" value="'+kategori+'"></td>';

            output += '<td class="text-right">'+nilai+' <input type="hidden" name="hidden_nilainormal[]" id="td_nilainormal'+count+'" class="td_nilainormal" value="'+nilai+'"></td>';




            output += '<td class="td-opsi"><button type="button" class="hapus_obat btn-transition btn btn-outline-danger btn-sm" name="hapus_obat" id="'+count+'" title="hapus obat ini">hapus</button></td>';
            output += '</tr>';
            $("#keranjang_obat").append(output);
            $("#baris_kosong").hide();
            total_penjualan = total_penjualan+subtotal;
            $("#total_penjualan").text(total_penjualan);
            $("#hidden_totalpenjualan").val(total_penjualan);
            $("#total_pembayaran").text(total_penjualan);
            $(".baris_total").show();
            reset();
        }
    });

    $(document).on("click", ".hapus_obat", function() {
        var row_id = $(this).attr("id");
        var subtotal = Number($("#td_subtotal"+row_id).val());

        total_penjualan = total_penjualan-subtotal;
        $("#total_penjualan").text(total_penjualan);
        $("#hidden_totalpenjualan").val(total_penjualan);
        $("#total_pembayaran").text(total_penjualan);
        $("#row_"+row_id).remove();
        if(total_penjualan==0)
        {
            $("#baris_kosong").show();
            $(".baris_total").hide();
            $("#tambah_obat_lagi").click();
        }
    });

    $("#hapus_semua_obat").click(function() {
        Swal.fire({
          title: 'Hapus Semua ?',
          text: 'apakah anda yakin menghapus semua daftar obat',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((hapus) => {
          if (hapus.value) {
            $("#keranjang_obat > tr").remove();
            total_penjualan = 0;
            $("#hidden_totalpenjualan").val("0");
            $("#total_pembayaran").text(total_penjualan);
            $("#baris_kosong").show();
            $(".baris_total").hide();
            $("#tambah_obat_lagi").click();
          }
        })
    });

    $("#lanjut_pembayaran").click(function() {
        // alert();
        $(".kotak-form-obat-terjual").hide();
        $(".kotak-form-pembayaran").show();
        document.getElementById("jml_uang").focus();
        $("#tambah_obat_lagi").show();
        $("#lanjut_pembayaran").hide();
    });

    $("#tambah_obat_lagi").click(function() {
        // alert();
        $(".kotak-form-obat-terjual").show();
        $(".kotak-form-pembayaran").hide();
        $("#jml_uang").val("");
        $("#jml_kembali").val("");
        $("#tambah_obat_lagi").hide();
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

    $("#form_hematologi").on("submit", function(event){
        event.preventDefault();
        var kd_hematologi = $("#kd_hematologi").val();
        var tanggal_hematologi = $("#tanggal_hematologi").val();
        var nama_hematologi = $("#nama_hematologi").val();
var hrg_hematologi = $("#hrg_hematologi").val();
                var stk_obat = $("#stk_obat").val();
                var satuan = $("#satuan").val();
        var nominal = $("#jml_uang").val();
        var nilai_normal = $("#nilai_normal").val();
        var nama_pasien = $("#nama_pasien").val();
                var status = $("#status").val();
        var kategori = $("#kategori").val();

        if(kd_hematologi=="") {
            document.getElementById("kd_hematologi").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi nomor penjualan',
              'warning'
            )
        } else 
        if(tanggal_hematologi==""){
            document.getElementById("tanggal_hematologi").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi periode penjualan',
              'warning'
            )
        } else if(total_penjualan==0){
            document.getElementById("lihat_data_obat").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, anda belum mengisi daftar obat',
              'warning'
            )
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
                $(".td_kd_obat").each(function(){
                    count_data = count_data + 1;
                });
                if(count_data > 0) {
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "ajax/simpan_hematologi.php",
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
                                window.location='?page=tabel_pemeriksaanlab';
                                
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

