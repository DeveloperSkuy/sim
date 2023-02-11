<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-align-left"></i> Form Perawatan</li>
  </ol>
</nav>

<div class="page-content">
  <div class="row">
    <div class="col-6"><h4>Pendaftaran Pasien Ranap</h4></div>
    <div class="col-6 text-right">
      <a href="?page=perawatan">
        <button class="btn btn-sm btn-info">Data Perawatan</button>
      </a>
            <a href="?page=datapasien">
        <button class="btn btn-sm btn-success">Data Pasien</button>
      </a>
    </div>
  </div>

<div class="form-container">
        <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">
                    <div class="row data-pengobatan">
                        <div class="position-relative form-group col-md-3">
                            <label for="no_daftar" class="">Cari Nama, No. RM, HP (tekan Enter) </label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm" id="search"   >

                              </div>
                            </div>
                          </div>

                        <div class="position-relative form-group col-md-12">
                                <ul id="result"></ul>
                                
                            </div>

                </form>
              </div>
            </div>
  <div class="table-container">
    <table id="example" class="table table-striped display tabel-data">
      <thead>
              <th>No Reg</th>
                <th>Tgl Daftar</th>
                <th>Nama</th>
                <th>No RM</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Dokter</th>
                <th>Ruangan</th>
                <th>Opsi</th>
                </tr>
        </thead>
        <tbody>
    <?php 
      $query_tampil = "SELECT * FROM tbl_daftarpasienranap 


      where ket ='open' ";
      $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
      while($data = mysqli_fetch_array($sql_tampil)) {
     ?>
        <tr>
          <td><?php echo $data['no_daftar']; ?></td>
          <td><?php echo $data['tgl_daftar']; ?></td>
          <td width="12%"><?php echo $data['nama_pas']; ?></td>
          <td><?php echo $data['nomor_rm']; ?></td>
          <td width="13%"><?php echo $data['jk_pas']; ?></td>
          <td width="15%"><?php echo $data['alm_pas']; ?></td>
          <td><?php echo $data['lhr_pas']; ?></td>
          <td width="12%"><?php echo $data['dokter']; ?></td>
          <td><?php echo $data['kamar']; ?>
            <br>
                                            <small><?php echo $data['no_bed']; ?></small>

          </td>
          <td width="10%" class="td-opsi">
                        <!-- <button class="btn-transition btn btn-outline-success btn-sm" title="lihat detail" id="tombol_detail">
                            <i class="fas fa-info-circle"></i>
                        </button> -->
                        <!-- <a href="?page=edit_datapasien&id=<?php echo $data['id_peg']; ?>"> -->
                          <!-- <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit"> -->

                                    <button class="btn-transition btn btn-outline-success btn-sm" title="Perawatan" id="tombol_rawat" name="tombol_rawat" data-no_daftar="<?php echo $data['no_daftar']; ?>" data-nama_pas="<?php echo $data['nama_pas']; ?>">
                                        <i class="fas fa-check-square"></i>
                                    </button>


                          <button class="btn-transition btn btn-outline-primary btn-sm" title="edit" id="tombol_edit" name="tombol_edit" data-id="<?php echo $data['no_daftar']; ?>">
                              <i class="fas fa-user-edit"></i>
                          </button>
                        <!-- </a> -->
                        <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $data['no_daftar']; ?>" data-nama="<?php echo $data['nama_pas']; ?>">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                    <?php } ?>
        </tr>
     
        </tbody>
    </table>
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
            text: 'anda akan menghapus data '+nama+', semua data transaksi yang berkaitan dengan pasien ini akan ikut terhapus',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya'
          }).then((hapus) => {
            if (hapus.value) {
              $.ajax({
                type: "POST",
                url: "ajax/hapus.php?page=datapendaftaran_ranap",
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
                  window.location='?page=datapasien_ranap';
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
    window.location='?page=edit_pendaftaran_ranap&id='+id;
  });

 $("button[name='tombol_rawat']").click(function() {
        var no_daftar = $(this).data("no_daftar");
        var nama_pas = $(this).data("nama_pas");
        Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda telah Merawat '+no_daftar+' dengan nama '+nama_pas+', data ini tidak dapat dirubah kembali.',
          type: 'warning',
          showCancelButton: true,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#28A745',
          cancelButtonText: 'Tidak',
          confirmButtonText: 'Daftar'
        }).then((lunas) => {
          if (lunas.value) {
            $.ajax({
              type: "POST",
              url: "ajax/detail.php?page=rawat",
              data: "no_daftar="+no_daftar,
              success: function(hasil2) {
                Swal.fire({
                  title: 'Berhasil',
                  text: 'Pasien telah dirawat',
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
    });

</script>
      </div>
    </div>
  </div>
</div>



        <script type="text/javascript">
            $(document).ready(function(){
                 
                 function search(){

                      var nama_pas=$("#search").val();
                       var nomor_rm=$("#search").val();
                       var no_hp=$("#search").val();

                      if(nama_pas!=""){
                        $("#result").html("<img src='img/ajax-loader.gif'/>");
                         $.ajax({
                            type:"post",
                            url:"ajax/search.php",
                            data:"nama_pas="+nama_pas+"&nomor_rm="+nomor_rm+"&no_hp="+no_hp,
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
        </script>
