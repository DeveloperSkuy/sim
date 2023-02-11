<link rel="stylesheet" href="agoi/select2.min.css">
    <script src="agoi/select2.min.js"></script>
   

<?php 
    $no_daftar = @$_GET['id'];
  

 ?>
  <script src="js/jquery.tabledit.min.js"></script>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Perawatan</li>
  </ol>
</nav>

<div class="page-content">
    <div class="row">
        <div class="col-6"><h4>Laboratorium Rajal </h4></div>
        <div class="col-6 text-right">
            <a href="?page=perawatan">
                <button class="btn btn-sm btn-info">Data Perawatan</button>
            </a>
        </div>
    </div>

<div class="form-container">
        <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">


  <form method="post" id="form_pengobatan" autocomplete="off">
                    <div class="row data-pengobatan">
                        <div class="position-relative form-group col-md-4">
                            <label for="no_daftar" class="">Nomor Registrasi <small>(nomor  pendaftaran)</small></label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm" id="no_rawat" name="no_rawat" value="<?php echo $no_daftar; ?>" >
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
                              <input type="text" class="form-control form-control-sm" id="norem" name="norem" placeholder="masukkan nama pasien" autofocus="" value="<?php echo $data['nomor_rm']; ?>" >
                            </div>
                        </div>
                    </div>


<div class="row" style="padding: 0 20px;">
      <div class="col-md-12 vertical-form">
                <?php 
                    $tgl_labor = gmdate("Y-m-d", time() + 60 * 60 * 7);
                    $hari= substr($tgl_labor, 8, 2);
                    $bulan = substr($tgl_labor, 5, 2);
                    $tahun = substr($tgl_labor, 0, 4);
                    $tgl = $tahun.$bulan.$hari;
                    $carikode = mysqli_query($conn, "SELECT MAX(no_lab) FROM tbl_hematologi WHERE tgl_labor = '$tgl_labor'") or die (mysql_error());
                    $datakode = mysqli_fetch_array($carikode);
                    if($datakode) {
                        $nilaikode = substr($datakode[0], 13);
                        $kode = (int) $nilaikode;
                        $kode = $kode + 1;
                        $no_lab = "LAB/".$tgl."/".str_pad($kode, 2, "0", STR_PAD_LEFT);
                    } else {
                        $no_lab = "LAB/".$tgl."/01";
                    }
                 ?>

                <div style="text-align: right;">
                    No Pengobatan : <b><?php echo $no_lab; ?></b>                     Tanggal : <b><?php echo $tgl_labor; ?></b>
                </div>
              
                    <div class="position-relative row form-group">
                        <!-- <label for="no_penjualan" class="col-sm-2 col-form-label">Nomor Penjualan</label> -->
                        <div class="col-sm-4">
                            <input name="no_lab" id="no_lab" placeholder="nomor pengobatan" type="hidden" class="form-control form-control-sm" value="<?php echo $no_lab; ?>">
                        </div>
                        <!-- <label for="tanggal_pjl" class="col-sm-2 col-form-label">Periode Penjualan</label> -->
                        <div class="col-sm-4">
                            <input name="tanggal_pengobatan" id="tanggal_pengobatan" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                        </div>



   <div class="table-responsive">  
                              <table class="table table-bordered" id="dynamic_field">  

  <?php 
        require_once "koneksi.php";
                $nomor = 1;
                     $query_tamp = "SELECT tbl_hematologi_pesan.kd_hematologi, tbl_hematologi_pesan.hasil, tbl_hematologi_pesan.hrg_jual,tbl_hematologi_pesan.satuan, tbl_hematologi_pesan.nilai_normal,tbl_hematologi_pesan.subtotal ,tbl_hematologi_pesan.keterangan,tbl_hematologi_pesan.kategori,tbl_nama_hematologi.kd_hematologi, tbl_nama_hematologi.nama_hematologi,  data_labor.nm_labor, data_labor.kd_labor FROM tbl_hematologi_pesan
                  LEFT JOIN tbl_nama_hematologi ON tbl_hematologi_pesan.kd_hematologi=tbl_nama_hematologi.kd_hematologi
                  LEFT JOIN data_labor ON tbl_hematologi_pesan.kd_labor=data_labor.kd_labor ";
                  $sql_tamp = mysqli_query($conn, $query_tamp) or die ($conn->error);
            while($data = mysqli_fetch_array($sql_tamp)) {
                $kode =$data['kd_hematologi'];
                $tgl_hematologi = date("Y-m-d");
                $ket =$data['keterangan'];
         ?>
          

                                   <tr>  
                                        <td>   

                                        <input style="width:200px"  name="name[]"  value="<?php echo $data['nama_hematologi'];?>" class="col-sm-2 col-form-label">
                                        <input type="text" style="width:200px" name="nm_labor[]"  value="<?php echo $data['nm_labor'];?>" class="col-sm-2 col-form-label" placeholder="Input Nilai"/>
                                        <label>Hasil :</label>
                                        <input style="width:100px; background-color: yellow " name="hasil[]"  value="<?php echo $data['hasil'];?>"  class="col-sm-2 col-form-label">
                                        <input style="width:80px " name="satuan[]"  value="<?php echo $data['satuan'];?>"  class="col-sm-2 col-form-label">
                                        <input style="width:90px" name="nilai_normal[]"  value="<?php echo $data['nilai_normal'];?>"  class="col-sm-2 col-form-label">
                                        <input type="hidden" style="width:130px" name="no_lab[]"  value="<?php echo $no_lab; ?>"  class="col-sm-2 col-form-label">
                                        <input type="hidden" style="width:150px" name="no_daftar[]"  value="<?php echo $no_daftar; ?>"  class="col-sm-2 col-form-label">
                                        <input type="hidden" style="width:120px" name="tgl_hematologi[]"  value="<?php echo $tgl_hematologi; ?>"  class="col-sm-2 col-form-label">
                                         
                                         <input type="hidden" style="width:120px" name="kd_hematologi[]"  value="<?php echo $kode; ?>"  class="col-sm-2 col-form-label"> 
                                         <label>Ket:</label>
                                        <input style="width:180px; background-color: yellow" name="keterangan[]"  value="<?php echo $ket; ?>"  class="col-sm-2 col-form-label">
                                        <input type="hidden"  style="width:80px" name="kd_labor[]"  value="<?php echo $data['kd_labor'];?>"  class="col-sm-2 col-form-label">
                                        </td>  
                                        <input type="hidden"  style="width:80px" name="kategori[]"  value="<?php echo $data['kategori'];?>"  class="col-sm-2 col-form-label">
                                        </td>  
                                        <td>
                                        <button type="button" name="add" id="add" class="btn btn-success">+</button></td>  
                                   </tr>  
                 <?php } ?>

                              </table>  

  <input type="button" name="submit" id="submit" class="btn btn-info btn-sm" value="Save" />  

  <button class="btn btn-danger btn-sm hapus_data" title="Hapus" id="tombol_hapus_hematologi" name="tombol_hapus_hematologi" data-id="<?php echo $data['kd_hematologi']; ?>" >
     <i class="fa fa-trash"></i> Hapus </button>
                         </div>  
                    </form>  
               </div>  




        <table  id="table" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>No</th>
<!--                     <th>No Reg</th> -->
                    <th>Nama hematologi</th>
<!--                     <th>Nilai Normal</th>
                    <th>Hasil</th> -->

                  <th>Kesan</th>
                    <th>Proses</th>
            </thead>
            <?php 
        require_once "koneksi.php";
    $no_daftar = @$_GET['id'];

                $tgl_sekarang = date('Y-m-d');
                $nomor = 1;
                $query_pjlobat = "SELECT tbl_hematologidetail.*, tbl_hematologidetail.kd_hematologi, tbl_hematologi.no_daftar,  tbl_nama_hematologi.nama_hematologi FROM tbl_hematologidetail
                  LEFT JOIN tbl_hematologi ON tbl_hematologidetail.no_lab=tbl_hematologi.no_lab

                    LEFT JOIN tbl_nama_hematologi ON tbl_hematologidetail.kd_hematologi=tbl_nama_hematologi.kd_hematologi

                WHERE no_daftar ='$no_daftar' ";
                $sql_pjlobat = mysqli_query($conn, $query_pjlobat) or die ($conn->error);
             ?>
            <tbody>
            <?php  
                while($data = mysqli_fetch_array($sql_pjlobat)) {
            ?>
                <tr>
                    <td><?php echo $nomor++; ?></td>
<!--                     <td><?php echo $data_pjlobat['no_daftar']; ?></td> -->
                    <td><?php echo $data['nama_hematologi']; ?></td>
<!--                     <td><?php echo $data['nilai_normal']; ?></td>
                    <td><?php echo $data['hasil']; ?></td> -->

                    <td><?php echo $data['kesan']; ?></td>
<td>

   <button class="btn-transition btn btn-outline-success btn-sm" title="Edit Hematologi" id="tombol_hematologi_pasien" name="tombol_hematologi_pasien" data-id="<?php echo $data['kd_hematologi']; ?>">
                              <i class="fas fa-medkit"></i>
                          </button>
</td>


<td>
<button class="btn-transition btn btn-outline-primary btn-sm" title="Isi Kesan" id="tombol_edit" name="tombol_edit" data-id="<?php echo $data['no']; ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
         <?php 
            } 
         ?>
            </tbody>
        </table>
    </div>


 </div>
        <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">
 <h5> Riwayat Hematologi </h5>
        

        <table  id="editable_table" class="table table-striped display tabel-data">
            <thead>
                <tr>
                                         <th>No</th>
                    <th>Nama Hematologi</th>
                    <th>Nama Pemeriksaan</th>
                    <th>Hasil</th>
                   <th>Satuan</th> 
                  <th>Nilai Normal</th>
                     <th>No Reg</th> 
                                  </tr>
            </thead>
                  <?php 
        require_once "koneksi.php";
                $nomor = 1;
$query_pjlobat = "SELECT * FROM tbl_hematologi_pasien

                WHERE no_daftar ='$no_daftar' ";
          
              $dewan1 = mysqli_query($conn, $query_pjlobat) or die ($conn->error);
          
            while($row = mysqli_fetch_array($dewan1)) {

/* $dewan1 = $conn->prepare($query_pjlobat);
         $dewan1->execute();
              $res1 = $dewan1->get_result();
              while ($row = $res1->fetch_assoc()) {*/

                echo '
                <tr>
                 <td>'.$row["id"].'</td>
                 <td>'.$row["name"].'</td>
                 <td>'.$row["nm_labor"].'</td>
                  <td>'.$row["hasil"].'</td>
                  <td>'.$row["satuan"].'</td>
                  <td>'.$row["nilai_normal"].'</td>
                  <td>'.$row["no_daftar"].'</td>
                </tr>
                ';
             }
            ?>
            </tbody>
        </table>
</div>
</div>

<script>  
$(document).ready(function(){  
     var i=1;  
     $('#add').click(function(){  
          i++;  

          $('#dynamic_field').append('<tr id="row'+i+'"><td><input style="width:300px" name="name[]" class="col-sm-2 col-form-label"><input style="width:200px" type="text" name="nm_obat[]" class="col-sm-2 col-form-label" placeholder="Input Nilai"/><input style="width:200px" name="hasil[]" class="col-sm-2 col-form-label" ><input style="width:200px" name="hematologi[]" class="col-sm-2 col-form-label" ></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
     });  
     $(document).on('click', '.btn_remove', function(){  
          var button_id = $(this).attr("id");   
          $('#row'+button_id+'').remove();  
     });  
     $('#submit').click(function(){            
          $.ajax({  
               url:"pages/js/name_hematologi.php",  
               method:"POST",  
               data:$('#form_pengobatan').serialize(),  
               success:function(data)  
               {  

                                // window.location='?page=entry_datapenjualan';
/*                                window.location='?page=lab_hematologi&id='+no_daftar;*/

                                window.location='?page=labor_rajal';                                
                              
                              alert(data);  
                    $('#form_pengobatan')[0].reset();  
               }  
          });  
     });  
});  
</script>




<script type="text/javascript">
$(document).ready(function(){
  $("#rekam_obat-tab").click(function(){
      $("#rekam_obat").show();
      $("#rekam_tindakan").hide();
      $("#rekam_soap").hide();

  });
  $("#rekam_tindakan-tab").click(function(){
      $("#rekam_tindakan").show();
            $("#rekam_obat").hide();
                $("#rekam_soap").hide();

  });
  $("#rekam_soap-tab").click(function(){
      $("#rekam_soap").show();
      $("#rekam_obat").hide();
      $("#rekam_tindakan").hide();
  });

});
</script>

<script type="text/javascript">

        $("button[name='tombol_hapus']").click(function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var exp = $(this).data('exp');
                var stok = $(this).data('stok');
        var subtot = $(this).data('subtot');
        // alert(id);
        if(id==id_session) {
            Swal.fire({
              title: 'Error !',
              text: 'Anda tidak bisa menghapus data anda sendiri, mintalah admin atau manajer untuk menghapusnya',
              type: 'error',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            }).then((baik) => {
              if (baik.value) {

              }
            })
        } else {
            Swal.fire({
              title: 'Apakah Anda Yakin?',
              text: 'anda akan menghapus data '+nama+' dan stok '+stok+', semua data transaksi yang berkaitan dengan pasien ini akan ikut terhapus',
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya'
            }).then((hapus) => {
              if (hapus.value) {
                $.ajax({
                  type: "POST",
                  url: "ajax/hapus.php?page=pengobatanan",
                  data: "id="+id+"&exp="+exp+"&stok="+stok+"&subtot="+subtot,
                  success: function(hasil) {
                    Swal.fire({
                      title: 'Berhasil',
                      text: 'Data Berhasil Dihapus',
                      type: 'success',
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'OK'
                    }).then((ok) => {
                      if (ok.value) {
                        window.location='?page=perawatan';
                      }
                    })
                  }
                })  
              }
            })
        }
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
        $("#kode_obat").val("");
        $("#nm_obat").val("");
        $("#hrg_obat").val("");
        $("#jml_obat").val("");
        $("#span_satuan").text("satuan");
        $("#toth_obat").val("");
        $("#stok_obat").val("");
        $("#exp_obat").val("");
    }

    function jml_obat() {
        var jml = Number($("#jml_obat").val());
        var harga = Number ($("#hrg_obat").val());
        if (jml>=0) {
            var sub_total = jml*harga;
            $("#toth_obat").val(sub_total);
        } else {
            $("#toth_obat").val("");
        }
    }
    function hrg_obat() {
        var jml = Number($("#jml_obat").val());
        var harga = Number ($("#hrg_obat").val());
        if (harga>=0) {
            var sub_total = jml*harga;
            $("#toth_obat").val(sub_total);
        } else {
            $("#toth_obat").val("");
        }
    }

$("button[name='tombol_hematologi_pasien']").click(function() {
    var id = $(this).data('id');
    window.location='?page=farmasi_edit_hematologi&id='+id;
  });





    $("button[name='tombol_pilihobat']").click(function() {
        var kode = $(this).data('kode');
        var nama = $(this).data('nama');
        var harga = $(this).data('harga');
        var satuan = $(this).data('satuan');
        var stok = $(this).data('stok');
        var exp = $(this).data('exp');

        $("#kode_obat").val(kode);
        $("#nm_obat").val(nama);
        $("#stok_obat").val(stok);
        $("#exp_obat").val(exp);
        $("#hrg_obat").val(harga);
        $("#span_satuan").text(satuan);
        $("#jml_obat").val(1);
        $("#toth_obat").val(harga);
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
        var exp = $("#exp_obat").val();
                var akai = $("#akai").val();
        var harga = $("#hrg_obat").val();
        var hasil = Number($("#jml_obat").val());
        var satuan = $("#span_satuan").text();
        var subtotal = Number($("#toth_obat").val());

        if(kode=="") {
            document.getElementById("lihat_data_obat").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong masukkan data obat terlebih dahulu',
              'warning'
            )
        } else if(harga=="" || harga<=0) {
            document.getElementById("hrg_obat").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi harga obat dengan benar',
              'warning'
            )
        } else if(hasil=="" || hasil<=0) {
            document.getElementById("jml_obat").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi hasil lab dengan benar',
              'warning'
            )
        } else if(subtotal=="" || subtotal<=0 || subtotal<harga) {
            document.getElementById("toth_obat").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi total harga dengan benar',
              'warning'
            )
        } else if(jumlah>stok) {
            document.getElementById("toth_obat").focus();
            Swal.fire(
              'Stok tidak cukup',
              'maaf, jumlah '+jumlah+' stok tidak mencukupi. stok yang tersedia sebanyak '+stok+' '+satuan,
              'warning'
            )
        } else {
            // alert(kode+" / "+nama+" / "+harga+" / "+jumlah+" / "+satuan+" / "+subtotal);
            count = count+1;
            var output = "";
            output = '<tr id="row_'+count+'">';
            output += '<td>'+kode+' <input type="hidden" name="hidden_kdobat[]" id="td_kd_obat'+count+'" class="td_kd_obat" value="'+kode+'"></td>';
            output += '<td>'+nama+' <input type="hidden" name="hidden_nmobat[]" id="td_nmobat'+count+'" class="td_nmobat" value="'+nama+'"></td>';
            output += '<td>'+exp+' <input type="hidden" name="hidden_expobat[]" id="td_expobat'+count+'" class="td_expobat" value="'+exp+'"></td>';
            output += '<td class="text-right">'+harga+' <input type="hidden" name="hidden_hrgobat[]" id="td_hrgobat'+count+'" class="td_hrgobat" value="'+harga+'"></td>';
            output += '<td class="text-center">'+jumlah+' <input type="hidden" name="hidden_jmlobat[]" id="td_jmlobat'+count+'" class="td_jmlobat" value="'+jumlah+'"></td>';
            output += '<td class="text-center">'+satuan+' <input type="hidden" name="hidden_satobat[]" id="td_satobat'+count+'" class="td_satobat" value="'+satuan+'"></td>';
            output += '<td class="text-center">'+akai+' <input type="hidden" name="hidden_akai[]" id="td_akai'+count+'" class="td_akai" value="'+akai+'"></td>';
            output += '<td class="text-right">'+subtotal+' <input type="hidden" name="hidden_subtotal[]" id="td_subtotal'+count+'" class="td_subtotal" value="'+subtotal+'"></td>';
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

    $("#form_pengobatan").on("submit", function(event){
        event.preventDefault();
        var no_lab = $("#no_lab").val();
        var tanggal_pengobatan = $("#tanggal_pengobatan").val();
        var no_rawat = $("#no_rawat").val();
                var akai = $("#akai").val();
        var nominal = $("#jml_uang").val();
        var kembali = $("#jml_kembali").val();
        var nama_pasien = $("#nama_pasien").val();
                var norem = $("#norem").val();

        if(no_lab=="") {
            document.getElementById("no_lab").focus();
            Swal.fire(
              'Data Belum Lengkap',
              'maaf, tolong isi nomor penjualan',
              'warning'
            )
        } else 
        if(tanggal_pengobatan==""){
            document.getElementById("tanggal_pengobatan").focus();
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
                        url: "ajax/simpan_pengobatan.php",
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

    $("button[name='tombol_edit']").click(function() {
        var id = $(this).data('id');
        window.location='?page=edit_datahematologi&id='+id;
    });

    $("button[name='tombol_hapus_hematologi']").click(function() {
        var id = $(this).data('id');
        window.location='?page=hapus_data_hema';
    });

</script>



<!------------------------- cari Aturan Pakai -------------------->


<script type="text/javascript">
    $(function () {
        $(".search").keyup(function ()
        {
            var searchid = $(this).val();
            var dataString = 'search=' + searchid;
            if (searchid != '')
            {
                $.ajax({
                    type: "POST",
                    url: "ajax/cari_akai.php",
                    data: dataString,
                    cache: false,
                    success: function (html)
                    {
                        $("#result").html(html).show();
                    }
                });
            }
            return false;
        });

        jQuery("#result").live("click", function (e) {
            var $clicked = $(e.target);
            var $id = $clicked.find('.id').html();
            var $nama = $clicked.find('.nama').html();
            var dec_id = $("<div/>").html($id).text();
            var dec_nama = $("<div/>").html($nama).text();
            $('#id_akai_hidden').val(dec_id);
            $('#searchid').val(dec_nama);
        });
        jQuery(document).live("click", function (e) {
            var $clicked = $(e.target);
            if (!$clicked.hasClass("search")) {
                jQuery("#result").fadeOut();
            }
        });
        $('#searchid').click(function () {
            jQuery("#result").fadeIn();
        });
    });
</script>

    <script>
        $(".theSelect").select2();
    </script>



 <script>  
    $(document).ready(function(){  
      $('#editable_table').Tabledit({
        url:'pages/js/action_hema.php',
        columns:{
          identifier:[0, "id"],
          editable:[[1, 'name'], [2, 'nm_labor'], [3, 'hasil'], [4, 'satuan']]
        },
        restoreButton:true,
        onSuccess:function(data, textStatus, jqXHR){
          if(data.action == 'delete'){
            $('#'+data.id).remove();
          }
        }
      });
    });


$(document).on('click', '.hapus_data', function(){
    var id = $(this).attr('id');
    $.ajax({
        type: 'POST',
        url: "pages/js/hapus_data_hema.php",
        data: {id:id},
        success: function() {
            $('.data').load("lab_hematologi_jalan.php");
        }, error: function(response){
            console.log(response.responseText);
        }
    });
});


  </script>



