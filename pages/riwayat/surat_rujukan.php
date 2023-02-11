<?php 
    $no_daftar = @$_GET['id'];
 ?>

 <script src="js/jquery.tabledit.min.js"></script>
 
<div class="page-content">
    <div class="row">
        <div class="col-6"><h4>Form Nomor Surat Rujukan</h4></div>
        <div class="col-6 text-right">
            <a href="?page=perawatan_ranap">
                <button class="btn btn-sm btn-info">Data Perawatan</button>
            </a>
        </div>
    </div>




        <div class="row" style="padding: 0 20px;">
            <div class="col-md-12 vertical-form">
          <?php
        include "config/fungsi_romawi.php";
        $bulan = date('n');
        $romawi = getRomawi($bulan);
        $tahun = date ('Y');
        $nomor = "/SKSH/KA/".$romawi."/".$tahun;
        
        // membaca kode / nilai tertinggi dari penomoran yang ada didatabase berdasarkan tanggal
        $hasil = mysqli_query($conn,"SELECT max(no_surat) as maxKode FROM tbl_suratrujukan WHERE month(tgl_surat)='$bulan'") or die (mysql_error());
        $datakode = mysqli_fetch_array($hasil);
        $no= $datakode['maxKode'];
        $noUrut= $no + 1;
        
        //membuat Nomor Surat Otomatis dengan awalan depan 0 misalnya , 01,02 
        //jika ingin 003 ,tinggal ganti %03
        $kode =  sprintf("%03s", $noUrut);
        $nomorbaru = $kode.$nomor;
    ?>


                <div style="text-align: right;">
                    No Surat : <b><?php echo $nomorbaru; ?></b> Tanggal : <b><?php echo tgl_indo(date('Y-m-d')); ?></b>
                </div>


  <form method="post" id="form_tindakan" autocomplete="off">
            <div class="col-md-10 offset-md-1 offset-form">

                  <div class="form-group row pt-3">

                    <div class="col-sm-9">

                      <input name="no_surat" id="no_surat" placeholder="nomor surat" type="hidden" class="form-control form-control-sm" value="<?php echo $nomorbaru; ?>">

                      <input type="hidden" class="form-control form-control-sm" id="id_pas" placeholder="masukkan nama pasien" value="<?php echo $id_pas; ?>" disabled="">
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


 <div class="form-group row">
                    <label for="nama_pas" class="col-sm-2 col-form-label">RS Tujuan</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control form-control-sm" name = "rs_tujuan" id="rs_tujuan" placeholder="masukkan RS Tujuan" autofocus="" value="">

                    </div>
                    <label for="dokter" class="col-sm-2 col-form-label" style="text-align: right;">Dokter Tujuan</label>
                    <div class="col-sm-4">
                               <div class="input-group-append">
            <input type="text" class="form-control form-control-sm" id="dokter_tujuan" value="" name="dokter_tujuan">
                        <input type="hidden" class="form-control form-control-sm" id="nm_dokter" value="<?php echo $data['dokter']; ?>" name="nm_dokter">
                         
</div>
 


            <input name="tgl_surat" id="tgl_surat" type="hidden" class="form-control form-control-sm" value="<?php echo gmdate("Y-m-d", time() + 60 * 60 * 7); ?>">

                         </div>


      </div>

                          <div class="text-right tombol-kanan">
                  <button class="btn btn-info btn-sm" id="btn_simpan">Simpan</button>

<!-- 
                        <input type="submit" name="simpan_diagnosa" id="simpan_diagnosa" class="btn btn-info" value="Simpan"> -->
                    </div>
                </form>
                            </div>

                        
 <h5 align="center"> Surat Sehat</h5>
        <table  id="editable_table" class="table table-striped display tabel-data">
            <thead>
                <tr>
                     <th>No Reg</th>
                     <th>No Surat</th>
                    <th>RS Tujuan</th>
                    <th>Tgl Surat</th>
                    <th>Dokter</th>
                </tr>
            </thead>
            <?php 
    $no_daftar = @$_GET['id'];

                $nomor = 1;
                $query_pjlobat = "SELECT * From tbl_suratrujukan

                WHERE no_daftar ='$no_daftar' ";

   $dewan1 = mysqli_query($conn, $query_pjlobat) or die ($conn->error);
          
            while($row = mysqli_fetch_array($dewan1)) {
                
                echo '
                <tr>
                 <td>'.$row["no_surat"].'</td>
                  <td>'.$row["tgl_surat"].'</td>
                 <td>'.$row["rs_tujuan"].'</td>
                  <td>'.$row["dokter_tujuan"].'</td>

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







     <script type="text/javascript">
         

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
        var no_surat = $("#no_surat").val();
        var tanggal_tindakan = $("#tanggal_tindakan").val();
        var no_rawat = $("#no_rawat").val();
        var nominal = $("#jml_uang").val();
        var kembali = $("#jml_kembali").val();
        var nm_dokter = $("#nm_dokter").val();

    });
});

    $("#btn_simpan").click(function() {
        var no_surat = $("#no_surat").val();

        var rs_tujuan = $("#rs_tujuan").val();
        var dokter_tujuan = $("#dokter_tujuan").val();
        var tgl_lahir = $("#tlahir_pas").val();
        var nomor_rm = $("#nomor_rm").val();
        var nama_pas = $("#nama_pas").val();
        var no_daftar = $("#no_daftar").val();
        var nm_dokter = $("#nm_dokter").val();
        var tgl_surat = $("#tgl_surat").val();

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
                url: "ajax/simpan_rujukan.php",
                data: "no_surat="+no_surat+"&tgl_surat="+tgl_surat+"&rs_tujuan="+rs_tujuan+"&dokter_tujuan="+dokter_tujuan+"&no_daftar="+no_daftar+"&nm_dokter="+nm_dokter+"&nama_pas="+nama_pas+"&nomor_rm="+nomor_rm+"&tgl_lahir="+tgl_lahir,
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
                            window.location='?page=riwayatmedis' ;
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
