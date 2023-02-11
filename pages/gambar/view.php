<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="icon" href="dk.png">
	<title>View - Dewan Upload</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-dark bg-secondary">
	  <a class="navbar-brand" href="index.php" style="color: #fff;">
	    Dewan Komputer
	  </a>
	</nav>
 
	<div class="container mb-3">
		<h3 align="center" class="mb-3 mt-3">Semua Data</h3>
		<div class="row">
			<div class="col-sm-6 offset-sm-3">
				<table class="table table-bordered">
					<tr>
						<td>No</td>
						<td>Nma Customer</td>
						<td>Alamat</td>
						<td>Avatar</td>
					</tr>
					<?php
						include 'koneksi.php';
						$no=1;
						$query = "SELECT * FROM tbl_fileupload ORDER BY id DESC";
						$dewan1 = $db1->prepare($query);
						$dewan1->execute();
						$res1 = $dewan1->get_result();
						while ($row = $res1->fetch_assoc()) {
					?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $row['nama_customer']; ?></td>
							<td><?php echo $row['alamat']; ?></td>
							<td><img src="pages/gambar/upload/<?php echo $row['avatar']; ?>" width="100px" height="60px"></td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
 
	<div class="navbar bg-dark fixed-bottom">
		<div style="color: #fff;">© <?php echo date('Y'); ?> Copyright:
		    <a href="https://dewankomputer.com/"> Dewan Komputer</a>
		</div>
	</div>
</body>
</html>