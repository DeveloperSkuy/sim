<link rel="stylesheet" href="agoi/select2.min.css">
    <script src="agoi/select2.min.js"></script>
   

<?php 
    $kd_racik = @$_GET['id'];
    include 'koneksi.php'; 

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
        <div class="col-6"><h4>Form Pemberian Obat 22</h4></div>
        <div class="col-6 text-right">
            <a href="?page=perawatan">
                <button class="btn btn-sm btn-info">Data Perawatan</button>
            </a>
        </div>
    </div>



        <div class="row" style="padding: 0 16px;">
                <div class="col-md-12 vertical-form">

 <h5 align="center"> Riwayat Obat Pasien</h5>
        <table  id="editable_table" class="table table-striped display tabel-data">
            <thead>
<tr>
                    <th>No</th>
                    <th>Kd Racik</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                  <th>Harga</th>
                                    <th>Subtotal</th>
                                  </tr>
            </thead>
            <?php 
        require_once "koneksi.php";
                $nomor = 1;
                     $query_pjlobat = "SELECT tbl_nama_racikandetail.kd_racik,tbl_nama_racikandetail.no, tbl_nama_racikandetail.jumlah, tbl_nama_racikandetail.subtotal,tbl_nama_racikandetail.hrg_jual, tbl_dataobat.nm_obat, tbl_nama_racikan.kd_racik FROM tbl_nama_racikandetail
                  LEFT JOIN tbl_nama_racikan ON tbl_nama_racikandetail.kd_racik=tbl_nama_racikan.kd_racik
                  LEFT JOIN tbl_dataobat ON tbl_nama_racikandetail.kd_obat=tbl_dataobat.kd_obat where tbl_nama_racikandetail.kd_racik='$kd_racik'
";
          

 $dewan1 = $conn->prepare($query_pjlobat);
         $dewan1->execute();
              $res1 = $dewan1->get_result();
              while ($row = $res1->fetch_assoc()) {

        $kode=$row['kd_racik'];        
                echo '
                <tr>
                 <td>'.$row["no"].'</td>
                 <td>'.$row["kd_racik"].'</td>
                 <td>'.$row["nm_obat"].'</td>
                  <td>'.$row["jumlah"].'</td>
                  <td>'.$row["hrg_jual"].'</td>
                  <td>'.$row["subtotal"].'</td>
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
        url:'pages/js/actionobat_racik.php',
        columns:{
          identifier:[0, "no"],
          editable:[[3, 'jumlah'], [4, 'hrg_jual'], [5, 'subtotal']]
        },
        restoreButton:true,
        onSuccess:function(data, textStatus, jqXHR){
          if(data.action == 'delete'){
            $('#'+data.no).remove();
          }
        }
      });
    });
  </script>