    <nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-light">
    <li class="breadcrumb-item"><a href="./"><i class="fas fa-home"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="?page=data_labor"><i class="fas fa-briefcase-medical"></i> Data labor</a></li>
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-edit"></i> Form Edit Data labor</li>
  </ol>
</nav>
<div class="page-content">
    <div class="row">
        <div class="col-6"><h4>Form Tambah Data labor</h4></div>
        <div class="col-6 text-right">
            <a href="?page=data_labor">
                <button class="btn btn-sm btn-info">Data labor</button>
            </a>
        </div>
    </div>
            <div class="row">
                <div class="col-5">
                    <div class="card">
                        <div class="card-body">
                            <form id="form-input">

    <?php 
  
                    $carikode = mysqli_query($conn, "SELECT MAX(kd_labor) as kodeTerbesar FROM data_labor ") ;
                    $datakode = mysqli_fetch_array($carikode);
          $kd_labor = $datakode['kodeTerbesar'];
          $urutan = (int) substr($kd_labor, 3, 3);
          $urutan =$urutan+1;
          $huruf = "LEB";
$kd_tindak = $huruf . sprintf("%03s", $urutan);


                 ?>

<div class="form-group">
                                    <label for="">Kode</label>
                                    <input type="text" id="kd_labor" name="kd_labor" class="form-control" value="<?php echo $kd_tindak; ?>"   >
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama labor</label>
                                    <input type="text" class="form-control" id="nm_labor" name="nm_labor" placeholder="Input Nama">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Satuan</label>
                                    <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Input Satuan">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nilai Normal</label>
                                    <input type="text" class="form-control" id="nilai_normal" name="nilai_normal" placeholder="Nilai Normal">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Kategori</label>
                                    <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Nilai Normal">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputPassword1">Harga</label>
                                    <input type="text" class="form-control" id="harga_labor" name="harga_labor"
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
                            url: "pages/labor/simpan_master_labor.php",
                            data: $('#form-input').serialize(),
                            success: function () {
/*                window.location='?page=data_labor' ;*/
                window.location='?page=tambah_datalabor' ;
                                
                                //setelah simpan data, update data terbaru
                                update()
                            }
                        });
                        //kosongkan form nama dan jurusan
                        document.getElementById("nm_labor").value = "";
                        document.getElementById("satuan").value = "";
                        document.getElementById("nilai_normal").value = "";
                        document.getElementById("kategori").value = "";
                        document.getElementById("harga_labor").value = "";
                        return false;
                    }
                });
            });
    
            //fungsi tampil data
            function update() {
                $.ajax({
                    url: 'pages/labor/labor.php',
                    type: 'get',
                    success: function(data) {
                        $('#tabeldata').html(data);
                    }
                });
            }
        </script>
    </body>
    
    </html>