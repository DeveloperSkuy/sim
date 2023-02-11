<?php 
    $nomor_rm = @$_GET['id'];
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
                        <div class="position-relative form-group col-md-3">
                            <label for="nomor_rm" class="">Nomor RM </label>
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm" id="no_rawat" name="no_rawat" value="<?php echo $nomor_rm; ?>" disabled="">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-file-signature"></i></span>
                                </div>
                            </div>
   
                        </div>

                  <?php 
                    $query_tampil = "SELECT * FROM tbl_daftarpasien WHERE nomor_rm='$nomor_rm'";
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
                            <label for="nomor_rm" class="">Jenis Kelamin</label>
                            <div class="input-group ">
                              <input type="text" class="form-control form-control-sm" id="norem" name="norem" placeholder="masukkan jenis Kelamin" autofocus="" value="<?php echo $data['jk_pas']; ?>" disabled="">
                            </div>
                        </div>

                        <div class="position-relative form-group col-md-3">
                            <label for="nomor_rm" class="">Alamat</label>
                            <div class="input-group ">
                              <input type="text" class="form-control form-control-sm" id="norem" name="norem" placeholder="masukkan jenis Kelamin" autofocus="" value="<?php echo $data['alm_pas']; ?>" disabled="">
                            </div>
                        </div>
                    </div>


 <h5><i class="fas fa-list-alt"></i> Riwayat Kunjungan Berobat Pasien</h5>
        <table id="example" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>No Reg</th>
                    <th>Nama</th>
                    <th>No RM</th>
                    <th>Keluhan</th>
                    <th>Diagnosa</th>
                    <th>Asuransi</th>
                    <th>No HP</th>
                    <th>Tgl Daftar</th>
                    <th>Ket</th>

                        </tr>
            </thead>
            <tbody>
        <?php 
    $nomor_rm = @$_GET['id'];        
            $query_tampil = "SELECT * FROM tbl_daftarpasien  WHERE nomor_rm ='$nomor_rm' ORDER BY tgl_daftar asC"  ;
            $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
            while($data = mysqli_fetch_array($sql_tampil)) {
         ?>
                <tr>
                    <td><?php echo $data['no_daftar']; ?></td>
                    <td width="15%"><?php echo $data['nama_pas']; ?></td>
                    <td><?php echo $data['nomor_rm']; ?></td>
                    <td width="13%"><?php echo $data['keluhan']; ?></td>
                    <td width="20%"><?php echo $data['diagnosa']; ?></td>
                    <td><?php echo $data['asuransi_pas']; ?></td>
                    <td><?php echo $data['no_hp']; ?></td>
                    <td><?php echo $data['tgl_daftar']; ?></td>
                    <td>
                <button class="btn-transition btn btn-outline-primary btn-sm" title="Rekam Medis" id="tombol_rekammedis" name="tombol_rekammedis" data-id="<?php echo $data['no_daftar']; ?>">
                                <i class="fas fa-plus-circle"></i>
                            </button> </td>

                    <?php } ?>
                </tr>
         
            </tbody>
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

    $nomor_rm = @$_GET['id'];

$totalBayar = 0; 
                $tgl_sekarang = date('Y-m-d');
                $nomor = 1;
                $query_pjlobat = "SELECT tbl_pengobatandetail.*, tbl_pengobatandetail.kd_obat, tbl_pengobatan.no_daftar, tbl_dataobat.kd_obat, tbl_dataobat.nm_obat, tbl_dataobat.hrg_obat FROM tbl_pengobatandetail
                  LEFT JOIN tbl_pengobatan ON tbl_pengobatandetail.no_pengobatan=tbl_pengobatan.no_pengobatan
                  LEFT JOIN tbl_dataobat ON tbl_pengobatandetail.kd_obat=tbl_dataobat.kd_obat

                WHERE nomor_rm ='$nomor_rm' ";
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
        <table id="tbl_pjlobat3" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Reg</th>
                    <th>Racikan </th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Subtotal</th>
                </tr>
            </thead>
            <?php 

    $nomor_rm = @$_GET['id'];

$totel = 0;
     $totel_bayar = 0;

                $tgl_sekarang = date('Y-m-d');
                $nomor = 1;
                $query_pjlobat = "SELECT tbl_racikandetail.*, tbl_racikandetail.kd_racik, tbl_racikan.no_daftar, tbl_obatracik.kd_obat, tbl_nama_racikan.nama_racikan, tbl_obatracik.hrg_obat FROM tbl_racikandetail
                  LEFT JOIN tbl_racikan ON tbl_racikandetail.no_pengobatan=tbl_racikan.no_pengobatan
                  LEFT JOIN tbl_obatracik ON tbl_racikandetail.kd_racik=tbl_obatracik.kd_obat
                    LEFT JOIN tbl_nama_racikan ON tbl_racikandetail.kd_racik=tbl_nama_racikan.kd_racik
                WHERE nomor_rm ='$nomor_rm' ";


/* $query_pjlobat = "SELECT * From tbl_racikan_pasien WHERE nomor_rm ='$nomor_rm' ";*/



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
        <table  id="example222" class="table table-striped display tabel-data">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Reg</th>
                    <th>Dokter</th>
                    <th>Nama Tindakan</th>
                  <th>Harga </th>
                </tr>
            </thead>

            <?php 

    $nomor_rm = @$_GET['id'];

$total = 0;
     $tot_bayar = 0;
                $tgl_sekarang = date('Y-m-d');
                $nomor = 1;
                $query_pjltindakan = "SELECT tbl_tindakandetail.*, tbl_tindakandetail.kd_tindakan,tbl_tindakandetail.kd_tindakan, tbl_tindakan.nomor_rm, tbl_tindakan.no_daftar,tbl_tindakan.nm_dokter, data_tindakan.kd_tindakan, data_tindakan.nama_tindakan FROM tbl_tindakandetail
                  LEFT JOIN tbl_tindakan ON tbl_tindakandetail.no_tindakan=tbl_tindakan.no_tindakan
                  LEFT JOIN data_tindakan ON tbl_tindakandetail.kd_tindakan=data_tindakan.kd_tindakan

                WHERE nomor_rm ='$nomor_rm' ";
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

    $nomor_rm = @$_GET['id'];

$total_lab = 0;
     $tot_bayar_lab = 0;
                $tgl_sekarang = date('Y-m-d');
                $nomor = 1;
                $query_labor = "SELECT tbl_hematologidetail.*, tbl_hematologidetail.kd_hematologi,tbl_hematologidetail.no_lab, tbl_hematologi.no_daftar,tbl_hematologi.nm_dokter, tbl_nama_hematologi.kd_hematologi, tbl_nama_hematologi.nama_hematologi FROM tbl_hematologidetail
                  LEFT JOIN tbl_hematologi ON tbl_hematologidetail.no_lab=tbl_hematologi.no_lab
                  LEFT JOIN tbl_nama_hematologi ON tbl_hematologidetail.kd_hematologi=tbl_nama_hematologi.kd_hematologi

                WHERE nomor_rm ='$nomor_rm' ";
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
        <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">

<h5><i class="fas fa-list-alt"></i> Riwayat Foto Medis</h5>                


        <table id="example" class="table table-striped display tabel-data">
            <thead>
                    <tr>
                         <th>No</th>
                    <th>No Daftar</th>
                    <th>Nama Pasien</th>
                    <th>Keterangan</th>
                    <th>Foto (Klik untu Memperbesar Gbr)</th>
                    <th></th>
                    </tr>
                    </thead>
            <tbody>
                    <?php
                
                            $no_daftar = @$_GET['id'];
                        $no=1;
                
                    $query_gambar = "SELECT * FROM tbl_uploadgambar  WHERE no_daftar='$no_daftar'";
                    $res1 = mysqli_query($conn, $query_gambar) or die ($conn->error);
                   
                    while ($row = $res1->fetch_assoc()) {
                   ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['no_daftar']; ?></td>
                            <td><?php echo $row['nama_pas']; ?></td>
                            <td><?php echo $row['ket']; ?></td>
                            <td>
<a href="#" class="pop">                                    
   <img width="80" height="80" 
src="pages/gambar/upload/<?php echo $row['avatar']; ?>">
</a>
                            <td>
 <button class="btn-transition btn btn-outline-danger btn-sm" title="hapus" id="tombol_hapus" name="tombol_hapus" data-id="<?php echo $row['id']; ?>" data-nama="<?php echo $row['nama_pas']; ?>">
                            <i class="fas fa-trash"></i>
                        </button>

                    </td>

 <?php } ?>
                </tr>
         
            </tbody>
        </table>
            </div>
        </div>
   



<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">                               
    <div class="modal-content">                                       
     <div class="modal-body">
                                         
       <button type="button" class="close" data-dismiss="modal"><span 
       aria-hidden="true">&times;</span><span class="sr- 
       only">Close</span></button>                              
      <img src="" class="imagepreview" style="width: 100%;">
                                      
     </div>                             
   </div>                                  
  </div>
</div>

<script>

$("button[name='tombol_rekammedis']").click(function() {
        var id = $(this).data('id');
        window.location='?page=rekammedis_sele&id='+id;
    });

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
                  url: "ajax/hapus.php?page=gambarrajal",
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
                        window.location='?page=entry_gambar&id='+$no_daftar;
                      }
                    })
                  }
                })  
              }
            })
        }
    });
    
   $(function() {
     $('.pop').on('click', function() {
       $('.imagepreview').attr('src',$(this).find('img').attr('src'));
       $('#imagemodal').modal('show');   
       });      
   });
</script>




        <div class="row" style="padding:  0 16px; 
        right: 0; font-size: 24px">
            <div class="col-md-12 vertical-form">
                

<tr>

    <td colspan="4" align="right"><strong>Total Billing (Rp) : </strong></td>
    <td colspan="8" align="right" bgcolor="#F5F5F5" ><strong><?php echo number_format ($tot_bayar+$totel_bayar+$totalBayar+$tot_bayar_lab+$tot_bayar_rad); ?></strong></td>
</tr>

</div>