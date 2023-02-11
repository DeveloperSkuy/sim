<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-users"></i> Data Pasien</li>
  </ol>
</nav>

<div class="page-content">
  <div class="row">
    <div class="col-6" id="judul"><h4>Data Tindakan</h4></div>
    <div class="col-6 text-right">
      <a href="?page=tambah_datatindakan">
        <button class="btn btn-sm btn-info">Tambah Data</button>
      </a>

    </div>

  </div>
  <div class="table-container">
    <table id="example" class="table table-striped display tabel-data">
      <thead>
            <tr>

                <th>Kode</th>
                <th>Nama Tindakan</th>
                <th>Harga Tindakan</th>
                <th>Persen</th>
                <th>Jasa Dokter</th>
                                <th></th>
                </tr>
        </thead>
        <tbody>
    <?php 
      $query_tampil = "SELECT * FROM data_tindakan";
      $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
      while($data = mysqli_fetch_array($sql_tampil)) {
     ?>
        <tr>
          <td><?php echo $data['kd_tindakan']; ?></td>
          <td><?php echo $data['nama_tindakan']; ?></td>
          <td><?php echo $data['harga_tindakan']; ?></td>
          <td><?php echo $data['persen']; ?></td>
                    <td><?php echo $data['jasa_dokter']; ?></td>

          <td class="td-opsi">

                          <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit" name="tombol_edit" data-id="<?php echo $data['kd_tindakan']; ?>">
                              <i class="fas fa-user-edit"></i>
                          </button>
                        <!-- </a> -->
                        <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['kd_tindakan']; ?>" data-nama="<?php echo $data['nama_tindakan']; ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                    <?php } ?>
        </tr>
     
        </tbody>
    </table>
  </div>
</div>



<div class="modal fade" id="detail_obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <h6><i class="fas fa-list-alt"></i> Lengkapi form ini untuk menambah data tindakan baru</h6>
        <?php 
                   
                    $carikode = mysqli_query($conn, "SELECT MAX(kd_tindakan) as kodeTerbesar FROM data_tindakan ") ;
                    $datakode = mysqli_fetch_array($carikode);
          $kd_tindakan = $datakode['kodeTerbesar'];
          $urutan = (int) substr($kd_tindakan, 3, 4);
          $urutan =$urutan+1;
          $huruf = "TDK";
$kd_tindak = $huruf . sprintf("%03s", $urutan);


                 ?>
        <form action="javascrip:void(0);"  autocomplete="off">
          <div class="form-group row pt-3">
            <label for="kd_tindakan" class="col-sm-3 col-form-label">Kode tindakan</label>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm"  name="kd_tindakan" id="kd_tindakan" value="<?php echo $kd_tindak; ?>" placeholder="masukkan kode tindakan" autofocus="">
            </div>
          </div>
  <div class="col-sm-4">
                            <input name="tgl_input" id="tgl_input" type="hidden" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                        </div>

          <div class="form-group row pt-3">
            <label for="nm_dokter" class="col-sm-3 col-form-label">Nama Tindakan</label>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm"  id="nama_tindakan" placeholder="masukkan nama tindakan"  autofocus="">
            </div>
          </div>
      
          <div class="form-group row pt-3">
            <label for="no_hp" class="col-sm-3 col-form-label">Harga </label>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm"  id="harga_tindakan" placeholder="masukkan Harga" autofocus="">
            </div>
          </div>
    <div class="col-sm-12 text-right">
              <button class="btn btn-info btn-sm" id="btn_save" name="btn_save" >Simpan</button>

            </div>
          </div>
        </form>
      </div>
    </div>
    </div>
  </div>
</div>
</div>







<script>
  $("button[name='tombol_hapus']").click(function() {
    var id = $(this).data('id');
    var nama = $(this).data('nama');
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
            text: 'anda akan menghapus data '+nama+', semua data tindakan yang berkaitan dengan tindakan ini akan ikut terhapus',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya'
          }).then((hapus) => {
            if (hapus.value) {
              $.ajax({
                type: "POST",
                url: "ajax/hapus.php?page=data_tindakan",
                data: "id="+id,
                success: function(hasil) {
                  Swal.fire({
                title: 'Berhasil',
                text: 'Data Berhasil Dihapus',
                type: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              }).then((ok) => {
                if (ok.value) {
                  window.location='?page=data_tindakan';
                }
              })
                }
              })  
            }
          })
      }
  });

  $("button[name='tombol_edit']").click(function() {
    var id = $(this).data('id');
    window.location='?page=edit_datatindakan&id='+id;
  });


    function reset_form() {
    $("#kd_tindakan").val("");
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
        'maaf, tolong isi kode obat',
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
        'maaf, tolong isi nomor hp dokter',
        'warning'
      )

    } else {
      $.ajax({
        type: "POST",
        url: "ajax/simpan_master_tindakan.php",
        data: "nama_tindakan="+nama_tindakan+"&kode="+kode+"&harga_tindakan="+harga_tindakan+"&tgl_input="+tgl_input,
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

</script>