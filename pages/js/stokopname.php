<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-capsules"></i> Data Obat</li>
  </ol>
</nav>
<div class="page-content">
	<div class="row">
		<div class="col-6"><h4>Data Informasi Stok Obat</h4></div>
		<div class="col-6 text-right">
			<a href="?page=info_kadaluarsa">
				<button class="btn btn-sm btn-danger">Info Kadaluarsa Obat</button>
			</a>
			 <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
			<!-- <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal" title="<under maintenance>">
				<i class="far fa-file-excel"></i> Import Excel
			</button> -->
			<?php } ?>
		</div>
	</div>
	<div class="table-container">
		<table id="tabel_dataobat" class="table table-striped display tabel-data">
			<thead>
		        <tr>
                                            <th>No</th>
                                            <th>Kode </th>
                                            <th>Nama Obat</th>
                                            <th>Kategori</th>
                                            <th>Satuan</th>
	                                   <th>Stok Awal</th>
                                            <th>Stok Masuk</th>
                                            <th>Stok Keluar</th>
	                                            <th>Sisa Stok</th>
	<!-- 	            <th>Opsi</th> -->
		        </tr>
		    </thead>
		    <tbody>
		<?php 
                                        $no =1;
			$query_tampil = "SELECT tbl_dataobat.kd_obat, tbl_dataobat.nm_obat, tbl_dataobat.ktg_obat, tbl_dataobat.sat_obat, tbl_dataobat.stk_obat, SUM(tbl_pembeliandetail.jml_beli) AS stok_masuk, stok_awal, stok_ubat, stok_racik,stok_keluar
FROM tbl_dataobat 
LEFT JOIN tbl_pembeliandetail ON tbl_dataobat.kd_obat=tbl_pembeliandetail.kd_obat

LEFT JOIN
(SELECT tbl_dataobat.kd_obat, SUM(tbl_stokawaldetail.jml_beli) AS stok_awal
FROM tbl_dataobat, tbl_stokawaldetail
WHERE tbl_dataobat.kd_obat=tbl_stokawaldetail.kd_obat
GROUP BY tbl_stokawaldetail.kd_obat ASC) AS paketawal
ON tbl_dataobat.kd_obat=paketawal.kd_obat
LEFT JOIN
(SELECT tbl_dataobat.kd_obat, SUM(tbl_pengobatandetail.jml_jual) AS stok_ubat
FROM tbl_dataobat, tbl_pengobatandetail
WHERE tbl_dataobat.kd_obat=tbl_pengobatandetail.kd_obat
GROUP BY tbl_pengobatandetail.kd_obat ASC) AS pake
ON tbl_dataobat.kd_obat=pake.kd_obat
LEFT JOIN
(SELECT tbl_dataobat.kd_obat, SUM(tbl_nama_racikandetail.stokini) AS stok_racik
FROM tbl_dataobat, tbl_nama_racikandetail
WHERE tbl_dataobat.kd_obat=tbl_nama_racikandetail.kd_obat
GROUP BY tbl_nama_racikandetail.kd_obat ASC) AS pakein
ON tbl_dataobat.kd_obat=pakein.kd_obat

LEFT JOIN
(SELECT tbl_dataobat.kd_obat, SUM(tbl_penjualandetail.jml_jual) AS stok_keluar
FROM tbl_dataobat, tbl_penjualandetail
WHERE tbl_dataobat.kd_obat=tbl_penjualandetail.kd_obat
GROUP BY tbl_penjualandetail.kd_obat ASC) AS pakai
ON tbl_dataobat.kd_obat=pakai.kd_obat
GROUP BY tbl_dataobat.kd_obat ASC";
			$sql_tampil = mysqli_query($conn, $query_tampil) or die ($conn->error);
			while($data = mysqli_fetch_array($sql_tampil)) {
$stokkeluar =$data['stok_keluar']+$data['stok_ubat']+$data['stok_racik'];

		 ?>
		 		<tr>
		 			 <td><?php echo $no++;?></td>
                                            <td><?php echo $data['kd_obat']?></td>
                                            <td><?php echo $data['nm_obat']?></td>
                                            <td><?php echo $data['ktg_obat']?></td>
                                            <td><?php echo $data['sat_obat']?></td>
                                            <td><?php echo $data['stok_awal']?></td>
                                            <td><?php echo $data['stok_masuk']?></td>
                                            <td><?php echo $stokkeluar ?></td>
                                            <td><?php echo $data['stok_awal']+ $data['stok_masuk'] - $stokkeluar ?></td>	



		 		</tr>
		 <?php 
			} 
		 ?>
		    </tbody>
		</table>
	</div>
</div>