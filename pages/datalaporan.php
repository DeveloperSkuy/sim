<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-users"></i> Data Pasien</li>
  </ol>
</nav>

<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Form Laporan</h4></div>
		<div class="col-6 text-right">
		</div>
	</div>
<div class="table-container">
        <table id="tabel_dataobat" class="table table-striped display">
            <thead>
                <tr>
     <!--             <th>No</th> -->
                    <th>Nama Laporan</th>
                    <th>Go</th>
                </tr>
            </thead>
            <tbody>
        <?php 
$no=1;
          $query_tampil = "SELECT * FROM tbl_laporan";
            $sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
            while($data = mysqli_fetch_array($sql_tampil)) {
         ?>
                <tr>
<!--                     <td><?php echo $no++; ?></td> -->
                    <td><?php echo $data['laporan']; ?></td>
                    <td><?php echo $data['exp']; ?></td>
                 
                </tr>
         <?php 
            } 
         ?>
            </tbody>
        </table>
      </div>
</div>


    