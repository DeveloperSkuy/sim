<?php include 'koneksi.php'; ?>
 
  
    <script src="js/jquery.tabledit.min.js"></script>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-briefcase-medical"></i> Data Transaksi</li>
  </ol>
</nav>

<div class="page-content">
  <div class="row">
    <div class="col-6" id="judul"><h4>Data Transaksi</h4></div>
    <div class="col-6 text-right">
<!-- <button class="btn-transition btn btn-outline-success btn-xl" title="detail tindakan" id="tombol_detail" name="tombol_detail" data-toggle="modal" data-target="#detail_tindakan">
Tambah Transaksi</i>
                        </button> -->

<!--      <a href="?page=tambah_datadokter">
        <button class="btn btn-sm btn-info">Tambah Dokter</button> -->
      </a>
    </div>

  <div class="container">  
      <table id="editable_table" class="table table-bordered table-striped">
         <thead>
            <tr>
               <th>No. Reg</th>
             <th>Total Bayar</th>
             <th>Total Uang</th>
             <th>Kembali</th>
            </tr>
         </thead>
         <tbody>
            <?php
              $query = "SELECT * FROM tbl_transaksi ORDER BY no_daftar ASC";
              $dewan1 = $conn->prepare($query);
              $dewan1->execute();
              $res1 = $dewan1->get_result();
              while ($row = $res1->fetch_assoc()) {
                echo '
                <tr>
                 <td>'.$row["no_daftar"].'</td>
                 <td>'.$row["total_penjualan"].'</td>

                 <td>'.$row["jml_uang"].'</td>
                 <td>'.$row["jml_kembali"].'</td>
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
      $('#editable_table').Tabledit({
        url:'pages/js/actiontrans.php',
        columns:{
          identifier:[0, "no_daftar"],
          editable:[[1, 'total_penjualan'], [2,'jml_uang']]
        },
        restoreButton:true,
        onSuccess:function(data, textStatus, jqXHR){
          if(data.action == 'delete'){
            $('#'+data.no_daftar).remove();
          }
        }
      });
    });
  </script>
 </body>
</html>
