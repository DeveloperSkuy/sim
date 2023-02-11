    <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=data_tindakan"><i class="fas fa-briefcase-medical"></i> Data Tindakan</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data Tindakan</li>
  </ol>
</nav>
<div class="page-content">
    <div class="row">
        <div class="col-6"><h4>Form Tambah Data Tindakan</h4></div>
        <div class="col-6 text-right">
            <a href="?page=data_tindakan">
                <button class="btn btn-sm btn-info">Data Tindakan</button>
            </a>
        </div>
    </div>
            <div class="row">
                <div class="col-5">
                    <div class="card">
                        <div class="card-body">
                            <form id="form-input">

    <?php 

                   
                    $carikode = mysqli_query($conn, "SELECT MAX(kd_tindakan) as kodeTerbesar FROM data_tindakan ") ;
                    $datakode = mysqli_fetch_array($carikode);
          $kd_tindakan = $datakode['kodeTerbesar'];
          $urutan = (int) substr($kd_tindakan, 3, 3);
          $urutan =$urutan+1;
          $huruf = "TDK";
$kd_tindak = $huruf . sprintf("%03s", $urutan);


                 ?>

<div class="form-group">
                                    <label for="">Kode</label>
                                    <input type="text" id="kd_tindakan" name="kd_tindakan" class="form-control" value="<?php echo $kd_tindak; ?>"   >
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Tindakan</label>
                                    <input type="text" class="form-control" id="nama_tindakan" name="nama_tindakan" placeholder="Input Nama">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Harga Tindakan</label>
                                    <input type="text" class="form-control" onkeyup="sum();" id="harga_tindakan" name="harga_tindakan"
                                        placeholder="Input Harga">
                                      <input type="hidden" name="tgl_input" id="tgl_input"  class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">

                                </div>
    
                                    <div class="form-group">
                                    <label for="exampleInputPassword1">Persen (%)</label>
                                    <input type="percent" class="form-control" onkeyup="sum();" id="persen" name="persen" placeholder="Persen">
 
                                </div>

    
                                    <div class="form-group">
                                    <label for="exampleInputPassword1">Jasa Dokter</label>
                                    <input type="text" class="form-control" id="jasa_dokter" name="jasa_dokter" placeholder="">
 
                                </div>


                                <button type="submit" id="tombol-simpan" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-7">
                    <div id="tabeldata">
                    
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
    
<script>

function sum() {
      var txtFirstNumberValue = document.getElementById('harga_tindakan').value;
        var txtSecondNumberValue = document.getElementById('persen').value;
      var result =  parseInt(txtFirstNumberValue)*(parseInt(txtSecondNumberValue)/100);
         document.getElementById('jasa_dokter').value = result;
      }

</script>


        <script>
            $(document).ready(function () {
                update();
            });
            $("#tombol-simpan").click(function () {
                //validasi form
                $('#form-input').validate({
                    rules: {
                        nama: {
                            required: true
                        },
                        jurusan: {
                            required: true
                        }
                    },
                    //jika validasi sukses maka lakukan
                    submitHandler: function (form) {
                        $.ajax({
                            type: 'POST',
                            url: "pages/js/simpan_master_tindakan.php",
                            data: $('#form-input').serialize(),
                            success: function () {
                window.location='?page=data_tindakan' ;
                                
                                //setelah simpan data, update data terbaru
                                update()
                            }
                        });
                        //kosongkan form nama dan jurusan
                        document.getElementById("nama_tindakan").value = "";
                        document.getElementById("harga_tindakan").value = "";
     document.getElementById("persen").value = "";
          document.getElementById("jasa_dokter").value = "";
                        return false;
                    }
                });
            });
    
            //fungsi tampil data
            function update() {
                $.ajax({
                    url: 'pages/js/data_tindakan.php',
                    type: 'get',
                    success: function(data) {
                        $('#tabeldata').html(data);
                    }
                });
            }
        </script>
    </body>
    
    </html>