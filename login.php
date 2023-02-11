<?php 
  session_start();
  if(@$_SESSION['posisi_peg']) {
    echo "<script>window.location='./';</script>";
  } else {
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <link rel="stylesheet" href="assets/css/style.css">

    <link rel="shortcut icon" href="images/logos.png">
            <script type="text/javascript" src="login/js/jquery.js"></script>
            <script type="text/javascript" src="login/js/bootstrap.min.js"></script>
           
            <link rel="stylesheet" href="login/css/bootstrap.min.css">
            <link rel="stylesheet" href="login/font-awesome-4.1.0/css/font-awesome.min.css">
                <link rel="stylesheet" href="asset/sweetalert/dist/sweetalert2.min.css">
            <style type="text/css">
                body{
                    background-image: url(images/logis.jpg);
                }

            </style>
            <title>Klinik</title>
        </head>
        <body>
            <div align="center">
                <br>
                

                <div align="center" style="width:320px;margin-top:5%;">
                    <form name="login_form" method="post" class="well well-lg" action="login.php" style="-webkit-box-shadow: 0px 0px 20px #0bb0ea;">
                                      <h4><label>SIM Klinik & Apotek</label></h4>

<div class="mdl-card__title" style="text-align: center; border: 0;">
                  <img src="images/logo.PNG" width="100" alt="" >

</div>
                                              <br>
                                              <br>
                        <?php 
                        if(isset($_GET['error'])){
                            echo '<div class="alert alert-warning alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
      Password atau username kurang tepat
    </div>';
                        }
                                ?>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input name="username" id="username" class="form-control" type="text" placeholder="Username" autocomplete="off" autofocus="" />
                        </div>
                        <br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input name="password" id="password" class="form-control" type="password" placeholder="Password" autocomplete="off" />
                        </div>
                        <br />



                         <div class="form-group tombol-login">
              <a href="javascript:void(0)">        
                <div class="btn btn-sm btn-info" id="tombol_login">LOGIN</div>
              </a>

                </div>
            </div>
            <br>
            <br>
            <br>

            <footer align="center">
<!--                 Repost Download<a href="www.lapakcode.net" title="Sedot Code, source code php gratis">Lapakcode</a> || Created by <a href="http://dendicious.com">dendicious</a> -->
            </footer>
        </body>
    </html>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="asset/Jquery/jquery-3.3.1.min.js"></script>
    <script src="asset/bootstrap_4/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="asset/sweetalert/dist/sweetalert2.min.js"></script>

    <script>
      $("#tombol_login").click(function() {
        var username = $("#username").val();
        var password = $("#password").val();

        $.ajax({
          type: "GET",
          url: "ajax/ceklogin.php",
          data: "username="+username+"&password="+password,
          success: function(hasil) {
            if(hasil=="berhasil") {
              window.location='./';
            } else {
              document.getElementById("username").focus();
              Swal.fire({
                type: 'error',
                title: 'Gagal',
                text: 'Periksa kembali username dan password anda',
                showConfirmButton: true
                // timer: 1500
              })
            }
          }
        });
      });
    </script>
  </body>
</html>
<?php } ?>