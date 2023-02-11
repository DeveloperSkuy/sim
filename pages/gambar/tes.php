
	<div class="container mb-3">
		<h3 align="center" class="mb-3 mt-3">Upload File / Image pada PHP</h3>
		<div class="row">
			<div class="col-sm-6 offset-sm-3">
				<form id="form-data">
					<div class="form-group">
						<input type="button" name="view" id="view" value="View Data" onClick="location='?page=view'" class="btn btn-info mt-3" />
					</div>

					<div class="form-group">
						<label>Nama Customer</label>
						<input type="text" name="nama_customer" id="nama_customer" class="form-control" />
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control" id="alamat" name="alamat"></textarea>
					</div>
					<div class="form-group">
						<label>File Upload</label>
						<input type="file" name="fileupload" id="fileupload" class="form-control" />
					</div>
					<div class="form-group">
						<input type="button" name="simpan" id="simpan" value="Simpan" class="btn btn-info mt-3" />
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="navbar bg-dark fixed-bottom">
		<div style="color: #fff;">© <?php echo date('Y'); ?> Copyright:
		    <a href="https://dewankomputer.com/"> Dewan Komputer</a>
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script>
		$(document).ready( function () {
    		$("#simpan").click(function(){
				const fileupload = $('#fileupload').prop('files')[0];

		        let formData = new FormData();
		        formData.append('fileupload', fileupload);
		        formData.append('nama_customer', $('#nama_customer').val());
		        formData.append('alamat', $('#alamat').val());

		        $.ajax({
		            type: 'POST',
		            url: "pages/gambar/upload.php",
		            data: formData,
		            cache: false,
		            processData: false,
		            contentType: false,
		            success: function (msg) {
		                alert(msg);
		                document.getElementById("form-data").reset();
		            },
		            error: function () {
		                alert("Data Gagal Diupload");
		            }
		        });
	        });
        });
  </script>