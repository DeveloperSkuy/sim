    <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=data_radiologi"><i class="fas fa-briefcase-medical"></i> Data radiologi</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data radiologi</li>
  </ol>
</nav>
<div class="page-content">
    <div class="row">
        <div class="col-6"><h4>Form Tambah Data radiologi</h4></div>
        <div class="col-6 text-right">
            <a href="?page=data_radiologi">
                <button class="btn btn-sm btn-info">Data radiologi</button>
            </a>
        </div>
    </div>
            <div class="row">
                <div class="col-5">
                    <div class="card">
                        <div class="card-body">
                            <form id="form-input">

    <?php 

                    $carikode = mysqli_query($conn, "SELECT MAX(kd_radiologi) as kodeTerbesar FROM data_radiologi ") ;
                    $datakode = mysqli_fetch_array($carikode);
          $kd_radiologi = $datakode['kodeTerbesar'];
          $urutan = (int) substr($kd_radiologi, 3, 3);
          $urutan =$urutan+1;
          $huruf = "RAD";
$kd_tindak = $huruf . sprintf("%03s", $urutan);


                 ?>

<div class="form-group">
                                    <label for="">Kode</label>
                                    <input type="text" id="kd_radiologi" name="kd_radiologi" class="form-control" value="<?php echo $kd_tindak; ?>"   >
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama radiologi</label>
                                    <input type="text" class="form-control" id="nama_radiologi" name="nama_radiologi" placeholder="Input Nama">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Harga</label>
                                    <input type="text" class="form-control" id="harga_radiologi" name="harga_radiologi"
                                        placeholder="Input Harga">
                                      <input type="hidden" name="tgl_input" id="tgl_input"  class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">

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
                            url: "pages/radiologi/simpan_master_radiologi.php",
                            data: $('#form-input').serialize(),
                            success: function () {
                window.location='?page=data_radiologi' ;
                                
                                //setelah simpan data, update data terbaru
                                update()
                            }
                        });
                        //kosongkan form nama dan jurusan
                        document.getElementById("nama_radiologi").value = "";
                        document.getElementById("harga_radiologi").value = "";
                        return false;
                    }
                });
            });
    
            //fungsi tampil data
            function update() {
                $.ajax({
                    url: 'pages/radiologi/radiologi.php',
                    type: 'get',
                    success: function(data) {
                        $('#tabeldata').html(data);
                    }
                });
            }
        </script>
    </body>
    
    </html>