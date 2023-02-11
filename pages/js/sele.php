<?php include 'koneksi.php'; ?>
 
  
    <script src="js/jquery.tabledit.min.js"></script>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-briefcase-medical"></i> Data Dokter</li>
  </ol>
</nav>

<div class="page-content">
  <div class="row">
    <div class="col-6" id="judul"><h4>Data Tindakan</h4></div>
    <div class="col-6 text-right">
<button class="btn-transition btn btn-outline-success btn-xl" title="detail tindakan" id="tombol_detail" name="tombol_detail" data-toggle="modal" data-target="#detail_tindakan">
Tambah Tindakan</i>
                        </button>

<!--      <a href="?page=tambah_datadokter">
        <button class="btn btn-sm btn-info">Tambah Dokter</button> -->
      </a>
    </div>

  <div class="container">  
      <table id="editable_table" class="table table-bordered table-striped">
         <thead>
            <tr>
             <th>ID</th>
             <th>Nama Tindakan</th>
             <th>Harga Tindakan</th>
            </tr>
         </thead>
         <tbody>
            <?php
              $query = "SELECT * FROM data_tindakan ORDER BY id ASC";
              $dewan1 = $db1->prepare($query);
              $dewan1->execute();
              $res1 = $dewan1->get_result();
              while ($row = $res1->fetch_assoc()) {
                echo '
                <tr>
                 <td>'.$row["id"].'</td>
                 <td>'.$row["nama_tindakan"].'</td>
                 <td>'.$row["harga_tindakan"].'</td>
                </tr>
                ';
             }
            ?>
         </tbody>
      </table>
    </div>  
  </div>


<div class="modal fade" id="detail_tindakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Input Data Tindakan</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <div class="form-container">
    <div class="row">
      <div class="col-md-10 offset-md-1 offset-form">
        <h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data Tindakan baru</h6>
        <?php 
                   
                    $carikode = mysqli_query($conn, "SELECT MAX(kd_tindakan) as kodeTerbesar FROM data_tindakan ") ;
                    $datakode = mysqli_fetch_array($carikode);
          $kd_tindakan = $datakode['kodeTerbesar'];
          $urutan = (int) substr($kd_tindakan, 3, 3);
          $urutan =$urutan+1;
          $huruf = "TDK";
$kd_tindakan = $huruf . sprintf("%03s", $urutan);


                 ?>
        <form action="javascrip:void(0);"  autocomplete="off">
          <div class="form-group row pt-3">
            <label for="kd_dokter" class="col-sm-3 col-form-label">Kode Tindakan</label>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm"  name="kd_tindakan" id="kd_tindakan" value="<?php echo $kd_tindakan; ?>" placeholder="masukkan kode tindakan" autofocus="">
            </div>
          </div>
  <div class="col-sm-4">
                            <input name="tgl_input" id="tgl_input" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                        </div>

          <div class="form-group row pt-3">
            <label for="nama_tindakan" class="col-sm-3 col-form-label">Nama Tindakan</label>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm"  id="nama_tindakan" placeholder="masukkan nama tindakan"  autofocus="">
            </div>
          </div>

          <div class="form-group row pt-3">
            <label for="harga_tindakan" class="col-sm-3 col-form-label">Harga Tindakan</label>
            <div class="col-sm-9">
              <input type="number" class="form-control form-control-sm"  id="harga_tindakan" placeholder="masukkan Harga Tindakan" autofocus="">
            </div>
          </div>


          <div class="form-group row">
            <div class="col-sm-12 text-right">
              <button class="btn btn-danger btn-sm" id="btn_reset">Reset</button>
              <button class="btn btn-primary btn-sm" id="btn_save">Save</button>
            </div>
          </div>
        </form>





<script>
    function reset_form() {
    $("#nama_tindakan").val("");
    $("#harga_tindakan").val("");

  }

  $("#btn_reset").click(function() {
    reset_form();
    document.getElementById("nama_tindakan").focus();
  });

  $("#btn_save").click(function() {
    var kode = $("#kd_tindakan").val();
    var nama_tindakan = $("#nama_tindakan").val();
            var tgl_input = $("#tgl_input").val();
    var harga_tindakan = $("#harga_tindakan").val();


    // alert(nama+"/"+posisi+"/"+jk+"/"+tgl_lahir+"/"+alamat+"/"+username+"/"+password);
    if(kode=="") {
      document.getElementById("kd_tindakan").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong isi kode tindakan',
        'warning'
      )

    }else if(nama_tindakan=="") {
      document.getElementById("nama_tindakan").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong isi nama dokter',
        'warning'
      )
    } else if (harga_tindakan=="") {
      document.getElementById("harga_tindakan").focus();
      Swal.fire(
        'Data Belum Lengkap',
        'maaf, tolong isi harga_tindakan',
        'warning'
      )

    } else {
      $.ajax({
        type: "POST",
        url: "pages/js/simpan_tindakan.php",
        data: "kode="+kode+"&nama_tindakan="+nama_tindakan+"&harga_tindakan="+harga_tindakan+"&tgl_input="+tgl_input,
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
                   window.location='?page=data_tindakan' ;
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
<script type="text/javascript">
    $(document).ready(function(){  
      $('#editable_table').Tabledit({
        url:'pages/js/action.php',
        columns:{
          identifier:[0, "kd_tindakan"],
          editable:[[1, 'nama_tindakan'], [2, 'harga_tindakan'], [3, 'tgl_input']]
        },
        restoreButton:true,
        onSuccess:function(data, textStatus, jqXHR){
          if(data.action == 'delete'){
            $('#'+data.kd_tindakan).remove();
          }
        }
      });
    });
  </script>
