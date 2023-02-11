<?php 
  require_once "koneksi.php";

  session_start();
  if(!@$_SESSION['posisi_peg']) {
    echo "<script>window.location='login.php';</script>";
  } else {
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Required meta tags -->
 <!--     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <link rel="icon" type="image/png" href="images/logos.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="asset/bootstrap_4/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/private_style/style_index.css">
    <link rel="stylesheet" href="asset/font_awesome/css/all.css">
    <link rel="stylesheet" href="asset/DataTables/datatables.min.css">
    <link rel="stylesheet" href="asset/sweetalert/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="asset/bootstrap_datepicker1.9.0/css/bootstrap-datepicker.min.css">

          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  


<!--         <link rel="stylesheet" href="assets/bootstrap-add.min.css"> -->
    <script src="assets/ajax-jquery.js"></script>
    
    <script src="js/jquery.tabledit.min.js"></script>

    <!--    <script src="agoi/jquery.js"></script> -->
     
<!--             <link rel="stylesheet" href="assets/css/style.css"> -->
    
    <title>
      Aplikasi Klinik & Apotek | 
      <?php 
        if(@$_GET['page']=='') {
          echo "Dashboard";
        } else if(@$_GET['page']=='dataobat' || @$_GET['page']=='tambah_dataobat' || @$_GET['page']=='edit_dataobat') {
          echo "Data Obat";
        } else if(@$_GET['page']=='datapegawai' || @$_GET['page']=='tambah_datapegawai' || @$_GET['page']=='edit_datapegawai') {
          echo "Data Pegawai";

        } else if(@$_GET['page']=='data_tindakan' || @$_GET['page']=='tambah_datatindakan' || @$_GET['page']=='edit_datatindakan') {
          echo "Data Tindakan";

        } else if(@$_GET['page']=='datapenjualan' || @$_GET['page']=='entry_datapenjualan' || @$_GET['page']=='form_laporanpenjualan' || @$_GET['page']=='laporpenjualan' || @$_GET['page']=='datapenjualan_perobat') {
          echo "Data Penjualan";
        } else if(@$_GET['page']=='datapembelian' || @$_GET['page']=='entry_datapembelian' || @$_GET['page']=='form_laporanpembelian' || @$_GET['page']=='laporpembelian') {
          echo "Data Pembelian";
        } else if(@$_GET['page']=='laporan') {
          echo "Laporan";
        }
      ?>
    </title>
  </head>
  <body class="bg-light">
  	<!-- <div class="logo bg-info">
  		<span class="navbar-brand logo-atas text-white" href="#">Aplikasi Sales Forecasting - Apotek Margo Saras</span>
  	</div> -->
  	<div id="container">
  	<div id="main">
  	<div class="col-md-12 bg-success p-1 title">
  		<!-- <div class="container"> -->
  		<div class="row">
  			<div class="col-md-6">
          <img src="images/logos.png" width="50" alt="">

  				<span class="text-white font-weight-light"><b>SIM KLINIK & APOTEK</span>
  			</b></div>
  			<div class="col-md-6 text-right">
  				<!-- <button class="btn btn-sm bg-light text-info">
  					<i class="fas fa-user-circle"></i> Admin
  				</button> -->

        <?php 

          $query_10 = "SELECT * FROM tbl_dataobat INNER JOIN tbl_stokexpobat ON tbl_dataobat.kd_obat = tbl_stokexpobat.kd_obat WHERE tbl_stokexpobat.tgl_exp>CURDATE() AND tbl_stokexpobat.tgl_exp<=date_add(CURDATE(), INTERVAL 10 DAY) AND tbl_stokexpobat.stok > 0";
          $sql_10 = mysqli_query($conn, $query_10) or die ($conn->error);
          $jml_10 = mysqli_num_rows($sql_10);

          $query_telahexp = "SELECT * FROM tbl_dataobat WHERE stk_obat <= '10'";
          $sql_telahexp = mysqli_query($conn, $query_telahexp) or die ($conn->error);
          $jml_mauhabis = mysqli_num_rows($sql_telahexp);
         ?>

    

          <span class="text-white tanggal-jam" id="tanggal"><?php echo gmdate("d-m-Y", time() + 60 * 60 * 7); ?> -</span><span class="text-white tanggal-jam" id="jam"></span>
          <div class="btn-group">

                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_diagnosa" id="lihat_data_diagnosa"><sup>( <?php echo $jml_10; ?> )</sup><i class="fas fa-bell icon"></i></button>

    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_obathabis" id="lihat_data_diagnosa"><sup>( <?php echo $jml_mauhabis; ?> )</sup><i class="fas fa-bell icon"></i></button>



  				  <button type="button" class="btn btn-light btn-sm dropdown-toggle font-weight-light" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
  				    <i class="fas fa-user-circle"></i> <?php echo $_SESSION['posisi_peg']; ?>
  				  </button>



  				  <div class="dropdown-menu dropdown-menu-right p-1">
  				    <!-- <button class="dropdown-item" type="button">Lihat Profil</button>
  				    <button class="dropdown-item" type="button">Logout</button> -->



  				    <div class="col-12 text-center nama-posisi">
  				    	<h2>
  				    		<i class="fas fa-user-circle"></i>
  				    	</h2>

  				    	<span class="nama"><?php echo $_SESSION['nama_peg']; ?></span><br>
                <span class="poli"><?php echo $_SESSION['jenis_poli']; ?></span><br>
  				    	<span class="posisi">ID : <span id="id_session" class="posisi"><?php echo $_SESSION['id_peg']; ?></span></span>
  				    </div>
  				    <div class="row tombol">
  				    	<div class="col-3">
  				    		<button class="btn btn-sm btn-success" id="tombol_profil" data-toggle="modal" data-target="#profil_user">Profil</button>
  				    	</div>
                  <div class="col-4 text-center">
              <button class="btn btn-sm btn-primary" id="tombol_password" data-toggle="modal" data-target="#password_user">UPass</button>
                </div>
  				    	<div class="col-3 text-right">
  				    		<button class="btn btn-sm btn-danger" id="tombol_keluar">Logout</button>
  				    	</div>
  				    </div>
  				  </div>
  				</div>
  			</div>
  		</div>


  		<!-- </div> -->
  	</div>
  	<div class="row">
  		<div class="col-md-2 sidebar">
        <div class="accordion" id="menu">
          <ul class="list-group">
            <li href="#" class="list-group-item list-group-item-action menu-utama" data-toggle="collapse" data-target="#menu-collapse" aria-expanded="true" aria-controls="menu-collapse" style="border-radius: 5px 5px 0 0;">
              Menu <i class="fas fa-list float-right mt-1"></i>
            </li>
          </ul>
          <div id="menu-collapse" class="collapse show" aria-labelledby="" data-parent="#menu">
            <div class="accordion" id="daftar_menu">
              <ul class="list-group">
                <a href="./" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='') {echo "active";} ?>" style="border-radius: 0;">
                  <i class="fas fa-home"></i> Home
                </a>



               <?php if($_SESSION['posisi_peg'] == 'Admin'   ) { ?>


                <a href="#" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='datapegawai' || @$_GET['page']=='datapasien' || @$_GET['page']=='data_tindakan' || @$_GET['page']=='bankdata'  || @$_GET['page']=='tambah_pemeriksaanlab'  || @$_GET['page']=='tambah_datatindakan'|| @$_GET['page']=='edit_datatindakan'|| @$_GET['page']=='tambah_datapegawai' || @$_GET['page']=='edit_datapegawai' || @$_GET['page']=='tambah_datapasien' || @$_GET['page']=='edit_datapasien' || @$_GET['page']=='edit_dataobat' || @$_GET['page']=='edit_racikan' || @$_GET['page']=='datasupplier' || @$_GET['page']=='tambah_datasupplier' || @$_GET['page']=='edit_datasupplier' || @$_GET['page']=='datadokter' || @$_GET['page']=='tambah_datadokter' || @$_GET['page']=='edit_datadokter' || @$_GET['page']=='info_kadaluarsa') {echo "show";} ?>" data-toggle="collapse" data-target="#menu-collapse-master" aria-expanded="true" aria-controls="menu-collapse-master">
                  <i class="fas fa-folder"></i> Data Master <i class="fas fa-angle-down float-right mt-1"></i>
                </a>
                <div id="menu-collapse-master" class="collapse <?php if(@$_GET['page']=='data_tindakan'  || @$_GET['page']=='datapegawai' || @$_GET['page']=='datapasien' || @$_GET['page']=='bankdata'  || @$_GET['page']=='info_kadaluarsa' || @$_GET['page']=='tambah_datapegawai' || @$_GET['page']=='edit_datapegawai' || @$_GET['page']=='edit_dataobat' || @$_GET['page']=='datasupplier' || @$_GET['page']=='tambah_datasupplier' || @$_GET['page']=='edit_datasupplier'|| @$_GET['page']=='datadokter' || @$_GET['page']=='tambah_datadokter' || @$_GET['page']=='edit_datadokter'|| @$_GET['page']=='tambah_datatindakan' || @$_GET['page']=='edit_datatindakan' || @$_GET['page']=='data_radiologi' || @$_GET['page']=='tambah_dataradiologi' ) {echo "show";} ?>" aria-labelledby="" data-parent="#daftar_menu">

                  

                  <ul class="list-group list-group-collapse">
                    <a href="?page=data_tindakan" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='data_tindakan' || @$_GET['page']=='tambah_datatindakan' || @$_GET['page']=='edit_datatindakan' ) {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Data Tindakan <i class="fas fa-capsules float-right mt-1"></i>
                    </a>

                  <ul class="list-group list-group-collapse">
                    <a href="?page=data_radiologi" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='data_radiologi' || @$_GET['page']=='tambah_dataradiologi' || @$_GET['page']=='edit_dataradiologi' ) {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Master Radiologi <i class="fas fa-capsules float-right mt-1"></i>
                    </a>
                  <ul class="list-group list-group-collapse">


                    <a href="?page=datapegawai" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datapegawai' || @$_GET['page']=='tambah_datapegawai' || @$_GET['page']=='edit_datapegawai') {echo "active";} ?>">
                      <i class="fas fa-angle-right"></i> Data Pegawai <i class="fas fa-users float-right mt-1"></i>
                    </a>

                    <a href="?page=datapasien" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datapasien' || @$_GET['page']=='tambah_datapasien' || @$_GET['page']=='edit_datapasien') {echo "active";} ?>">
                      <i class="fas fa-angle-right"></i> Data Pasien <i class="fas fa-users float-right mt-1"></i>
                    </a>

                    <a href="?page=bankdata" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='bankdata' || @$_GET['page']=='daftar_pasien') {echo "active";} ?>">
                      <i class="fas fa-angle-right"></i> Bank Data <i class="fas fa-users float-right mt-1"></i>
                    </a>



                    <a href="?page=datasupplier" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datasupplier' || @$_GET['page']=='tambah_datasupplier' || @$_GET['page']=='edit_datasupplier') {echo "active";} ?>">
                      <i class="fas fa-angle-right"></i> Data Supplier <i class="fas fa-briefcase-medical float-right mt-1"></i>
                    </a>

                    <a href="?page=datadokter" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datadokter' || @$_GET['page']=='tambah_datadokter' || @$_GET['page']=='edit_datadokter') {echo "active";} ?>">
                      <i class="fas fa-angle-right"></i> Data Dokter <i class="fas fa-briefcase-medical float-right mt-1"></i>
                    </a>
                  </ul>
                </div>
              <?php } ?>


               <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Rekam Medis'  ) { ?>

               <a href="#" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='daftarpasien' || @$_GET['page']=='daftarpasien_ranap' ) {echo "show";} ?>" data-toggle="collapse" data-target="#menu-collapse-pendaftaran" aria-expanded="true" aria-controls="menu-collapse-pendaftaran">
                  <i class="fas fa-bed"></i> Pendaftaran <i class="fas fa-angle-down float-right mt-1"></i>
                </a>

                <div id="menu-collapse-pendaftaran" class="collapse <?php if(@$_GET['page']=='daftarpasien' || @$_GET['page']=='daftarpasien_ranap'  ) {echo "show";} ?>" aria-labelledby="" data-parent="#daftar_menu">
                  
                  <ul class="list-group list-group-collapse">
                     <a href="?page=daftarpasien" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='daftarpasien'|| @$_GET['page']=='nomor-antrian'|| @$_GET['page']=='edit_daftarpasien') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Pendaftaran Rajal <i class="fas fa-wheelchair float-right mt-1"></i>
                    </a>

                  <ul class="list-group list-group-collapse">
                    <a href="?page=daftarpasien_ranap" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='daftarpasien_ranap'|| @$_GET['page']=='nomor-antrian'|| @$_GET['page']=='edit_daftarpasien_ranap') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Pendaftaran Ranap <i class="fas fa-wheelchair float-right mt-1"></i>
                    </a>

                  </ul>
                </div>
              <?php } ?>


    
               <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Perawat' || $_SESSION['posisi_peg'] == 'Dokter'  ) { ?>

                <a href="?page=antrian" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='antrian'|| @$_GET['page']=='nomor-antrian'|| @$_GET['page']=='panggilan-antrian') {echo "active";} ?>">
                  <i class="fas fa-bullhorn"></i> Panggil Antrian
                </a>


                <a href="#" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='datapendaftaran' || @$_GET['page']=='perawatan' ) {echo "show";} ?>" data-toggle="collapse" data-target="#menu-collapse-rajal" aria-expanded="true" aria-controls="menu-collapse-rajal">
                  <i class="fas fa-wheelchair"></i> Rawat Jalan <i class="fas fa-angle-down float-right mt-1"></i>
                </a>
                <div id="menu-collapse-rajal" class="collapse <?php if(@$_GET['page']=='datapendaftaran' || @$_GET['page']=='perawatan'  ) {echo "show";} ?>" aria-labelledby="" data-parent="#daftar_menu">
                  
                  <ul class="list-group list-group-collapse">
                    <a href="?page=datapendaftaran" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datapendaftaran'|| @$_GET['page']=='edit_pendaftaran') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Pasien Rajal <i class="fas fa-wheelchair float-right mt-1"></i>
                    </a>

                  <ul class="list-group list-group-collapse">
                    <a href="?page=perawatan" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='perawatan'|| @$_GET['page']=='edit_pendaftaran') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Rawat Rajal <i class="fas fa-wheelchair float-right mt-1"></i>
                    </a>

                  </ul>
                </div>

              <?php } ?>

               <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Perawat' || $_SESSION['posisi_peg'] == 'Dokter' ) { ?>

                <a href="#" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='datapendaftaran_ranap' || @$_GET['page']=='perawatan_ranap' ) {echo "show";} ?>" data-toggle="collapse" data-target="#menu-collapse-ranap" aria-expanded="true" aria-controls="menu-collapse-ranap">
                  <i class="fas fa-bed"></i> Rawat Inap <i class="fas fa-angle-down float-right mt-1"></i>
                </a>

                <div id="menu-collapse-ranap" class="collapse <?php if(@$_GET['page']=='datapendaftaran_ranap' || @$_GET['page']=='perawatan_ranap'  ) {echo "show";} ?>" aria-labelledby="" data-parent="#daftar_menu">
                  
                  <ul class="list-group list-group-collapse">
                    <a href="?page=datapendaftaran_ranap" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='datapendaftaran_ranap'|| @$_GET['page']=='edit_pendaftaran_ranap') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Pasien Ranap <i class="fas fa-bed float-right mt-1"></i>
                    </a>

                  <ul class="list-group list-group-collapse">
                    <a href="?page=perawatan_ranap" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='perawatan_ranap'|| @$_GET['page']=='edit_pendaftaran_ranap') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Rawat Ranap <i class="fas fa-bed float-right mt-1"></i>
                    </a>

                  </ul>
                </div>
                  <?php } ?>


               <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Apoteker' ) { ?>

                <a href="#" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='farmasi_rajal' || @$_GET['page']=='farmasi_ranap' || @$_GET['page']=='data_akai' || @$_GET['page']=='tambah_dataakai' || @$_GET['page']=='dataobat' || @$_GET['page']=='tabelracikan' || @$_GET['page']=='tambah_dataobat' || @$_GET['page']=='tambah_dataobat' || @$_GET['page']=='tambah_racikan' || @$_GET['page']=='racikanobat'   ) {echo "show";} ?>" data-toggle="collapse" data-target="#menu-collapse-farmasi" aria-expanded="true" aria-controls="menu-collapse-farmasi">
                  <i class="fas fa-medkit"></i> Farmasi <i class="fas fa-angle-down float-right mt-1"></i>
                </a>

                <div id="menu-collapse-farmasi" class="collapse <?php if(@$_GET['page']=='farmasi_rajal' || @$_GET['page']=='farmasi_ranap'|| @$_GET['page']=='stokopname'|| @$_GET['page']=='entry_datastokawal'  || @$_GET['page']=='data_akai' || @$_GET['page']=='tambah_dataakai' || @$_GET['page']=='dataobat' || @$_GET['page']=='tabelracikan' || @$_GET['page']=='tambah_dataobat'  || @$_GET['page']=='racikanobat' ) {echo "show";} ?>" aria-labelledby="" data-parent="#daftar_menu">
                  
                  <ul class="list-group list-group-collapse">
                    <a href="?page=farmasi_rajal" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='farmasi_rajal'|| @$_GET['page']=='farmasi_obat_rajal') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Farmasi Rajal<i class="fas fa-medkit float-right mt-1"></i>
                    </a>

                  <ul class="list-group list-group-collapse">
                    <a href="?page=farmasi_ranap" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='farmasi_ranap'|| @$_GET['page']=='farmasi_obat_ranap') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Farmasi Ranap <i class="fas fa-medkit float-right mt-1"></i>
                    </a>

                                      <ul class="list-group list-group-collapse">
                    <a href="?page=stokopname" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='stokopname') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Informasi Stok <i class="fas fa-medkit float-right mt-1"></i>
                    </a>

                                    <a href="?page=entry_datastokawal" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='entry_datastokawal' || @$_GET['page']=='entry_datastokawal' || @$_GET['page']=='form_laporanstokawal') {echo "active";} ?>">
                  <i class="fas fa-angle-right"></i> Stokopname <i class="fas fa-medkit float-right mt-1"></i>
                </a>
                  
                    <a href="?page=dataobat" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='dataobat' || @$_GET['page']=='tambah_dataobat' || @$_GET['page']=='edit_dataobat' || @$_GET['page']=='info_kadaluarsa') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Data Obat <i class="fas fa-capsules float-right mt-1"></i>
                    </a>
                    <a href="?page=data_akai" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='data_akai' || @$_GET['page']=='tambah_dataakai' || @$_GET['page']=='edit_dataakai' ) {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Aturan Pakai<i class="fas fa-capsules float-right mt-1"></i>
                    </a>

                    <a href="?page=tabelracikan" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='tabelracikan' || @$_GET['page']=='tambah_racikan' || @$_GET['page']=='edit_racikan' || @$_GET['page']=='racikanobat' || @$_GET['page']=='info_kadaluarsa') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Data Obat Racikan <i class="fas fa-capsules float-right mt-1"></i>

                    </a>



                  </ul>
                </div>

              <?php } ?>

               <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Analis'  ) { ?>


                <a href="#" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='labor_rajal' || @$_GET['page']=='labor_ranap' || @$_GET['page']=='data_labor' || @$_GET['page']=='tambah_datalabor' || @$_GET['page']=='tabel_pemeriksaanlab' || @$_GET['page']=='tambah_pemeriksaanlab') {echo "show";} ?>" data-toggle="collapse" data-target="#menu-collapse-labor" aria-expanded="true" aria-controls="menu-collapse-labor">
                  <i class="fas fa-medkit"></i> Laboratorium <i class="fas fa-angle-down float-right mt-1"></i>
                </a>

                <div id="menu-collapse-labor" class="collapse <?php if(@$_GET['page']=='labor_rajal' || @$_GET['page']=='labor_ranap'|| @$_GET['page']=='data_labor' || @$_GET['page']=='tambah_datalabor' || @$_GET['page']=='tabel_pemeriksaanlab' || @$_GET['page']=='tambah_pemeriksaanlab' ) {echo "show";} ?>" aria-labelledby="" data-parent="#daftar_menu">
                  
                  <ul class="list-group list-group-collapse">
                    <a href="?page=labor_rajal" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='labor_rajal'|| @$_GET['page']=='lab_hematologi_jalan') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Labor Rajal<i class="fas fa-medkit float-right mt-1"></i>
                    </a>

                  <ul class="list-group list-group-collapse">
                    <a href="?page=labor_ranap" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='labor_ranap'|| @$_GET['page']=='lab_hematologi') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Labor Ranap <i class="fas fa-medkit float-right mt-1"></i>
                    </a>
                  <ul class="list-group list-group-collapse">

                                        <a href="?page=data_labor" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='data_labor' || @$_GET['page']=='tambah_datalabor' || @$_GET['page']=='edit_datalabor' ) {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Master Laboratorium <i class="fas fa-capsules float-right mt-1"></i>
                    </a>

                  <ul class="list-group list-group-collapse">

                    <a href="?page=tabel_pemeriksaanlab" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='tabel_pemeriksaanlab' || @$_GET['page']=='tambah_pemeriksaanlab' || @$_GET['page']=='edit_pemeriksaanlab' ) {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Pemeriksaan Lab <i class="fas fa-capsules float-right mt-1"></i>

                    </a>


                  </ul>
                </div>

              <?php } ?>

               <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Kasir' ) { ?>


                <a href="#" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='kasir' || @$_GET['page']=='kasir_ranap' || @$_GET['page']=='transaksi' || @$_GET['page']=='transaksi_ranap' ) {echo "show";} ?>" data-toggle="collapse" data-target="#menu-collapse-kasir" aria-expanded="true" aria-controls="menu-collapse-kasir">
                  <i class="fas fa-file-invoice-dollar"></i> Kasir <i class="fas fa-angle-down float-right mt-1"></i>
                </a>

                <div id="menu-collapse-kasir" class="collapse <?php if(@$_GET['page']=='kasir' || @$_GET['page']=='kasir_ranap' || @$_GET['page']=='transaksi' || @$_GET['page']=='transaksi_ranap'  ) {echo "show";} ?>" aria-labelledby="" data-parent="#daftar_menu">
                  
                  <ul class="list-group list-group-collapse">
                    <a href="?page=kasir" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='kasir'|| @$_GET['page']=='pembayaran') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Kasir Rajal<i class="fas fa-file-invoice-dollar float-right mt-1"></i>
                    </a>

                  <ul class="list-group list-group-collapse">
                    <a href="?page=kasir_ranap" class="list-group-item list-group-item-action list-group-item-collapse  <?php if(@$_GET['page']=='pembayaran_ranap'|| @$_GET['page']=='kasir_ranap') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Kasir Ranap <i class="fas fa-file-invoice-dollar float-right mt-1"></i>
                    </a>

                  <ul class="list-group list-group-collapse">

                    <a href="?page=transaksi" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='transaksi' || @$_GET['page']=='tambah_transaksi' || @$_GET['page']=='edit_transaksi') {echo "active";} ?>">
                      <i class="fas fa-angle-right"></i> Transaksi Rajal <i class="fas fa-users float-right mt-1"></i>
                    </a> 
                  <ul class="list-group list-group-collapse">

                    <a href="?page=transaksi_ranap" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='transaksi_ranap' || @$_GET['page']=='edit_transaksi_ranap') {echo "active";} ?>">
                      <i class="fas fa-angle-right"></i> Transaksi Ranap <i class="fas fa-users float-right mt-1"></i>
                    </a> 
                  </ul>
                </div>

              <?php } ?>

               <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Rekam Medis' ) { ?>

                <a href="#" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='riwayatmedis' || @$_GET['page']=='riwayatmedis_ranap' ) {echo "show";} ?>" data-toggle="collapse" data-target="#menu-collapse-medis" aria-expanded="true" aria-controls="menu-collapse-medis">
                  <i class="fas fa-bed"></i> Rekam Medis <i class="fas fa-angle-down float-right mt-1"></i>
                </a>

                <div id="menu-collapse-medis" class="collapse <?php if(@$_GET['page']=='riwayatmedis' || @$_GET['page']=='riwayatmedis_ranap'  ) {echo "show";} ?>" aria-labelledby="" data-parent="#daftar_menu">
                  
                  <ul class="list-group list-group-collapse">
                    <a href="?page=riwayatmedis" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='riwayatmedis'|| @$_GET['page']=='rekammedis') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Riwayat Medis Rajal<i class="fas fa-medkit float-right mt-1"></i>
                    </a>

                  <ul class="list-group list-group-collapse">
                    <a href="?page=riwayatmedis_ranap" class="list-group-item list-group-item-action list-group-item-collapse <?php if(@$_GET['page']=='riwayatmedis_ranap'|| @$_GET['page']=='rekammedis_ranap') {echo "active";} ?>" style="border-radius: 0px;">
                      <i class="fas fa-angle-right"></i> Riwayat Medis Ranap <i class="fas fa-medkit float-right mt-1"></i>
                    </a>

                  </ul>
                </div>

              <?php } ?>




               <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Apoteker' ) { ?>

           <a href="?page=datalaporan" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='datalaporan' ) {echo "active";} ?>">
                  <i class="fas fa-book"></i> Laporan
                </a>


            <a href="?page=entry_datapenjualan" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='datapenjualan' || @$_GET['page']=='entry_datapenjualan' || @$_GET['page']=='form_laporanpenjualan' || @$_GET['page']=='datapenjualan_perobat') {echo "active";} ?>">
                  <i class="fas fa-medkit"></i> Transaksi Penjualan Obat
                </a>
 

                <a href="?page=entry_datapembelian" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='datapembelian' || @$_GET['page']=='entry_datapembelian' || @$_GET['page']=='form_laporanpembelian') {echo "active";} ?>">
                  <i class="fas fa-shopping-bag"></i> Transaksi Pembelian Obat
                </a>
                
                <a href="?page=peramalan" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='peramalan' || @$_GET['page']=='hasil_peramalan' || @$_GET['page']=='riwayat_peramalan') {echo "active";} ?>">
                  <i class="fas fa-chart-bar"></i> Peramalan Penjualan
                </a>

              <?php } ?>

                <!-- <a href="?page=laporan" class="list-group-item list-group-item-action <?php if(@$_GET['page']=='laporan') {echo "active";} ?>">
                  <i class="fas fa-file-alt"></i> Test Page
                </a>  -->
              </ul>
            </div>
          </div>
        </div>
  		</div>

      <script src="asset/Jquery/jquery-3.3.1.min.js"></script>
      <script src="asset/sweetalert/dist/sweetalert2.min.js"></script>
      <script src="asset/bootstrap_datepicker1.9.0/js/bootstrap-datepicker.min.js"></script>
      <script src="asset/bootstrap_datepicker1.9.0/locales/bootstrap-datepicker.id.min.js"></script>
      <script src="asset/ChartJs/Chart.min.js"></script>

  		<div class="col-md-10 content">
  			<?php 
  				if(@$_GET['page']=='') {
    					include 'pages/home.php';
    					// echo "Halaman Dashboard";
    				} else if(@$_GET['page']=='dataobat') {
    					include 'pages/dataobat.php';
    				} else if(@$_GET['page']=='info_kadaluarsa') {
              include 'pages/info_kadaluarsa.php';

            } else if(@$_GET['page']=='data_tindakan') {
              include 'pages/js/datatindakan.php';

            } else if(@$_GET['page']=='edit_datatindakan') {
              include 'pages/js/form_editdatatindakan.php';



            } else if(@$_GET['page']=='transaksi') {
              include 'pages/js/datatransaksi.php';

            } else if(@$_GET['page']=='transaksi_ranap') {
              include 'pages/js/datatransaksi_ranap.php';


            } else if(@$_GET['page']=='percobaan') {
              include 'pages/coba/percobaan.php';

            } else if(@$_GET['page']=='percobaandua') {
              include 'pages/coba/percobaandua.php';


            } else if(@$_GET['page']=='datapasien') {
              include 'pages/datapasien.php';
            } else if(@$_GET['page']=='tambah_datapasien') {
              include 'pages/form_tmbdatapasien.php';
            } else if(@$_GET['page']=='tambah_datapasien') {
              include 'pages/form_tmbdatapasien.php';
            } else if(@$_GET['page']=='edit_datapasien') {
              include 'pages/form_editdatapasien.php';

            } else if(@$_GET['page']=='bankdata') {
              include 'pages/bankdata.php';

            } else if(@$_GET['page']=='daftar_pasien') {
              include 'pages/form_daftarpasien.php';

            } else if(@$_GET['page']=='daftar_pasien_ranap') {
              include 'pages/ranap/form_daftarpasien_ranap.php';

            } else if(@$_GET['page']=='belajar') {
              include 'pages/tambah/tabel.php';

            } else if(@$_GET['page']=='belajardua') {
              include 'pages/tambah/belajardua.php';


            } else if(@$_GET['page']=='riwayatmedis') {
              include 'pages/riwayat/riwayatmedis.php';

            } else if(@$_GET['page']=='rekammedis') {
              include 'pages/riwayat/rekammedis.php';

            } else if(@$_GET['page']=='rekammedis_sele') {
              include 'pages/riwayat/rekammedis_sele.php';


            } else if(@$_GET['page']=='riwayatmedis_ranap') {
              include 'pages/riwayat/riwayatmedis_ranap.php';
            } else if(@$_GET['page']=='rekammedis_ranap') {
              include 'pages/riwayat/rekammedis_ranap.php';


            } else if(@$_GET['page']=='kasir') {
              include 'pages/kasir/kasir.php';
            } else if(@$_GET['page']=='pembayaran') {
              include 'pages/kasir/pembayaran.php';

            } else if(@$_GET['page']=='kasir_ranap') {
              include 'pages/kasir/kasir_ranap.php';
            } else if(@$_GET['page']=='pembayaran_ranap') {
              include 'pages/kasir/pembayaran_ranap.php';

            } else if(@$_GET['page']=='daftarpasien') {
              include 'pages/daftarpasien.php';
            } else if(@$_GET['page']=='edit_daftarpasien') {
              include 'pages/form_editdaftarpasien.php';

            } else if(@$_GET['page']=='daftarpasien_ranap') {
              include 'pages/ranap/daftarpasien_ranap.php';
            } else if(@$_GET['page']=='edit_daftarpasien_ranap') {
              include 'pages/ranap/form_editdaftarpasien_ranap.php';



            } else if(@$_GET['page']=='tambah_datatindakan') {
              include 'pages/js/form_tmbdatatindakan.php';

            } else if(@$_GET['page']=='datapendaftaran') {
              include 'pages/pendaftaran.php';
            } else if(@$_GET['page']=='edit_pendaftaran') {
              include 'pages/form_editpendaftaran.php';

            } else if(@$_GET['page']=='datapendaftaran_ranap') {
              include 'pages/ranap/pendaftaran_ranap.php';
              
            } else if(@$_GET['page']=='edit_pendaftaran_ranap') {
              include 'pages/ranap/form_editpendaftaran_ranap.php';

            } else if(@$_GET['page']=='diagnosa') {
              include 'pages/ranap/diagnosa.php';

            } else if(@$_GET['page']=='diagnosa_rajal') {
              include 'pages/ranap/diagnosa_rajal.php';


            } else if(@$_GET['page']=='assesmen') {
              include 'pages/ranap/assesmen.php';



         } else if(@$_GET['page']=='perawatan') {
              include 'pages/perawatan_pasien.php';
         } else if(@$_GET['page']=='entry_obatpasien') {
              include 'pages/js/entry_obatpasien.php';

         } else if(@$_GET['page']=='entry_obatpasienranap') {
              include 'pages/js/entry_obatpasienranap.php';

         } else if(@$_GET['page']=='farmasi_rajal') {
              include 'pages/js/farmasi_rajal.php';

         } else if(@$_GET['page']=='farmasi_obat_rajal') {
              include 'pages/js/farmasi_obat_rajal.php';

         } else if(@$_GET['page']=='farmasi_ranap') {
              include 'pages/js/farmasi_ranap.php';

         } else if(@$_GET['page']=='labor_ranap') {
              include 'pages/labor/labor_ranap.php';

         } else if(@$_GET['page']=='labor_rajal') {
              include 'pages/labor/labor_rajal.php';


         } else if(@$_GET['page']=='farmasi_obat_ranap') {
              include 'pages/js/farmasi_obat_ranap.php';

         } else if(@$_GET['page']=='farmasi_obatracik_ranap') {
              include 'pages/js/farmasi_obatracik_ranap.php';

         } else if(@$_GET['page']=='lab_hematologi') {
              include 'pages/js/lab_hematologi.php';

         } else if(@$_GET['page']=='lab_hematologi_jalan') {
              include 'pages/js/lab_hematologi_jalan.php';

         } else if(@$_GET['page']=='farmasi_obatracik_rajal') {
              include 'pages/js/farmasi_obatracik_rajal.php';


       } else if(@$_GET['page']=='entry_tindakanpasien_ranap') {
              include 'pages/ranap/entry_tindakanpasien_ranap.php';

       } else if(@$_GET['page']=='entry_penunjang_ranap') {
              include 'pages/ranap/entry_penunjang_ranap.php';

       } else if(@$_GET['page']=='entry_penunjang_radiologi') {
              include 'pages/ranap/entry_penunjang_radiologi.php';


       } else if(@$_GET['page']=='entry_penunjang') {
              include 'pages/js/entry_penunjang.php';



       } else if(@$_GET['page']=='entry_tindakanpasien') {
              include 'pages/entry_tindakanpasien.php';
 
  } else if(@$_GET['page']=='entry_obatracik') {
              include 'pages/entry_obatracik.php';

  } else if(@$_GET['page']=='entry_obatracik_ranap') {
              include 'pages/js/entry_obatracikranap.php';

  } else if(@$_GET['page']=='edit_racikan_obat') {
              include 'pages/js/edit_racikan_obat.php';



  } else if(@$_GET['page']=='edit_racikan_obat_rajal') {
              include 'pages/js/edit_racikan_obat_rajal.php';

  } else if(@$_GET['page']=='farmasi_edit_hematologi') {
              include 'pages/js/farmasi_edit_hematologi.php';

  } else if(@$_GET['page']=='farmasi_edit_racikan_obat') {
              include 'pages/js/farmasi_edit_racikan_obat.php';


  } else if(@$_GET['page']=='simpanan_racikan') {
              include 'pages/js/simpanan_racikan.php';

  } else if(@$_GET['page']=='simpanan_hematologi') {
              include 'pages/js/simpanan_hematologi.php';

  } else if(@$_GET['page']=='tambah_racikanobat') {
              include 'pages/tambah_racikanobat.php';

  } else if(@$_GET['page']=='gambar') {
              include 'pages/gambar/tes.php';
  } else if(@$_GET['page']=='view') {
              include 'pages/gambar/view.php';
 
       } else if(@$_GET['page']=='entry_gambar') {
              include 'pages/gambar/entry_gambarpasien.php';

       } else if(@$_GET['page']=='entry_gambar_ranap') {
              include 'pages/gambar/entry_gambarpasien_ranap.php';


  } else if(@$_GET['page']=='racikanobat') {
              include 'pages/racikan_obat.php';

  } else if(@$_GET['page']=='tabelracikan') {
              include 'pages/tabel_racikan.php';


    } else if(@$_GET['page']=='tabel_pemeriksaanlab') {
  include 'pages/pemeriksaan/tabel_pemeriksaanlab.php';

      } else if(@$_GET['page']=='tambah_pemeriksaanlab') {
  include 'pages/pemeriksaan/tambah_pemeriksaanlab.php';

  } else if(@$_GET['page']=='edit_pemeriksaanlab') {
              include 'pages/pemeriksaan/edit_pemeriksaanlab.php';



         } else if(@$_GET['page']=='perawatan_ranap') {
              include 'pages/ranap/perawatan_pasien_ranap.php';
         } else if(@$_GET['page']=='entry_obatpasien_ranap') {
              include 'pages/ranap/entry_obatpasien_ranap.php';
       } else if(@$_GET['page']=='entry_tindakanpasien_ranap') {
              include 'pages/ranap/entry_tindakanpasien_ranap.php';
  } else if(@$_GET['page']=='entry_obatracik_ranap') {
              include 'pages/ranap/entry_obatracik_ranap.php';



/*  } else if(@$_GET['page']=='transaksi') {
              include 'pages/kasir/transaksi.php';*/

  } else if(@$_GET['page']=='tambah_transaksi') {
              include 'pages/kasir/kasirPembayaran.php';
              

            } else if(@$_GET['page']=='antrian') {
              include 'panggilan-antrian/index.php';
/*              include 'pages/panggilan-antrian/index.php';*/
            } else if(@$_GET['page']=='nomor-antrian') {
              include 'nomor-antrian/index.php';
            } else if(@$_GET['page']=='panggilan-antrian') {
              include 'panggilan-antrian/index.php';

            } else if(@$_GET['page']=='datadokter') {
                include 'pages/datadokter.php';
            } else if(@$_GET['page']=='tambah_datadokter') {
                include 'pages/form_tmbdatadokter.php';
            } else if(@$_GET['page']=='edit_datadokter') {
                include 'pages/form_editdatadokter.php';

            } else if(@$_GET['page']=='data_radiologi') {
                include 'pages/radiologi/data_radiologi.php';
            } else if(@$_GET['page']=='tambah_dataradiologi') {
                include 'pages/radiologi/form_tmbdataradiologi.php';
            } else if(@$_GET['page']=='edit_dataradiologi') {
                include 'pages/radiologi/form_editdataradiologi.php';

 } else if(@$_GET['page']=='suratsehat') {
              include 'pages/riwayat/suratsehat.php';
              
 } else if(@$_GET['page']=='suratberobat') {
              include 'pages/riwayat/surat_berobat.php';

            } else if(@$_GET['page']=='suratsakit') {
              include 'pages/riwayat/suratsakit.php';

            } else if(@$_GET['page']=='suratnarkoba') {
              include 'pages/riwayat/suratnarkoba.php';
              
} else if(@$_GET['page']=='suratrujukan') {
              include 'pages/riwayat/surat_rujukan.php';

            } else if(@$_GET['page']=='data_labor') {
                include 'pages/labor/data_labor.php';
            } else if(@$_GET['page']=='tambah_datalabor') {
                include 'pages/labor/form_tmbdatalabor.php';
            } else if(@$_GET['page']=='edit_datalabor') {
                include 'pages/labor/form_editdatalabor.php';

            } else if(@$_GET['page']=='data_akai') {
                include 'pages/akai/data_akai.php';
            } else if(@$_GET['page']=='tambah_dataakai') {
                include 'pages/akai/form_tmbdataakai.php';
            } else if(@$_GET['page']=='edit_dataakai') {
                include 'pages/akai/form_editdataakai.php';

            } else if(@$_GET['page']=='edit_datahematologi') {
                include 'pages/akai/form_edit_datahematologi.php';

            } else if(@$_GET['page']=='hapus_data_hema') {
                include 'pages/js/hapus_data_hema.php';

            } else if(@$_GET['page']=='hapus_data_racik') {
                include 'pages/js/hapus_data_racik.php';


            } else if(@$_GET['page']=='datapegawai') {
          		include 'pages/datapegawai.php';
        		} else if(@$_GET['page']=='tambah_datapegawai') {
          		include 'pages/form_tmbdatapegawai.php';
        		} else if(@$_GET['page']=='tambah_datapegawai') {
          		include 'pages/form_tmbdatapegawai.php';
        		} else if(@$_GET['page']=='edit_datapegawai') {
    					include 'pages/form_editdatapegawai.php';
    				} else if(@$_GET['page']=='tambah_dataobat') {
    					include 'pages/form_tmbdataobat.php';
    				} else if(@$_GET['page']=='edit_dataobat') {
  		        	include 'pages/form_editdataobat.php';
		        } else if(@$_GET['page']=='datasupplier') {
		            include 'pages/datasupplier.php';
		        } else if(@$_GET['page']=='tambah_datasupplier') {
		            include 'pages/form_tmbdatasupplier.php';
		        } else if(@$_GET['page']=='edit_datasupplier') {
		            include 'pages/form_editdatasupplier.php';
		        } else if(@$_GET['page']=='datapenjualan') {
		            include 'pages/datapenjualan.php';
		        } else if(@$_GET['page']=='datapenjualan_perobat') {
                include 'pages/datapjl_perobat.php';

            } else if(@$_GET['page']=='datapembelian') {
		            include 'pages/datapembelian.php';
		        } else if(@$_GET['page']=='entry_datapenjualan') {
		            include 'pages/form_entrypenjualan.php';
		        } else if(@$_GET['page']=='entry_datapembelian') {
		            include 'pages/form_entrypembelian.php';
		        } else if(@$_GET['page']=='form_laporanpenjualan') {
		            include 'pages/form_laporanpenjualan.php';

            } else if(@$_GET['page']=='stokopname') {
                include 'pages/js/stokopname.php';

            } else if(@$_GET['page']=='datastokawal') {
                include 'pages/stokawal/datastokawal.php';
            } else if(@$_GET['page']=='laporstokawal') {
                include 'pages/stokawal/laporstokawal.php';
            } else if(@$_GET['page']=='entry_datastokawal') {
                include 'pages/form_entrystokawal.php';

            } else if(@$_GET['page']=='datalaporan') {
                include 'pages/datalaporan.php';

            } else if(@$_GET['page']=='laporpenjualan') {
                include 'pages/laporpenjualan.php';

            } else if(@$_GET['page']=='lapor_pemakaian_obat_rajal') {
                include 'pages/ranap/lapor_pemakaian_obat_rajal.php';

            } else if(@$_GET['page']=='laporan_pemeriksaan_rajal') {
                include 'pages/ranap/laporan_pemeriksaan_rajal.php';


            } else if(@$_GET['page']=='lapor_pemakaian_obat_pasien') {
                include 'pages/ranap/lapor_pemakaian_obat_pasien.php';

            } else if(@$_GET['page']=='lapor_pemakaian_obat_racik') {
                include 'pages/ranap/lapor_pemakaian_obat_racik.php';


            } else if(@$_GET['page']=='ubahpassword') {
                include 'pages/user/ubahpassword.php';

            } else if(@$_GET['page']=='laporpembelian') {
                include 'pages/laporpembelian.php';

            } else if(@$_GET['page']=='laporpasien') {
                include 'pages/laporpasien.php';

            } else if(@$_GET['page']=='laporbiling') {
                include 'pages/lapor_bilingpasien.php';

            } else if(@$_GET['page']=='laporan_jasadokter') {
                include 'pages/laporan_jasadokter.php';

            } else if(@$_GET['page']=='laporbiling_ranap') {
                include 'pages/laporan_biling_ranap.php';


		        } else if(@$_GET['page']=='form_laporanpembelian') {
		            include 'pages/form_laporanpembelian.php';
		        } else if(@$_GET['page']=='peramalan') {
                if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Apoteker') {
  		            include 'pages/peramalan.php';
                } else {

                }
		        } else if(@$_GET['page']=='hasil_peramalan') {
		            include 'pages/hasilperamalan.php';
		        } else if(@$_GET['page']=='riwayat_peramalan') {
		            include 'pages/riwayat_peramalan.php';
		        } else if(@$_GET['page']=='laporan') {
		            include 'pages/laporan.php';
		        } 
  			 ?>
  		</div>

      <!-- Modal -->
      <div class="modal fade" id="profil_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Profil Pegawai</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="tabel-profil">
                <?php 
                  $query = "SELECT * FROM tbl_pegawai WHERE id_peg = '$_SESSION[id_peg]'";
                  $sql = mysqli_query($conn, $query) or die ($conn->error);
                  $data = mysqli_fetch_array($sql);
                ?>
                <tr>
                  <th>ID</th>
                  <td> <?php echo $data['id_peg']; ?></td>
                </tr>
                <tr>
                  <th>Nama</th>
                  <td> <?php echo $data['nama_peg']; ?></td>
                </tr>
                <tr>
                  <th>Nama</th>
                  <td> <?php echo $data['jenis_poli']; ?></td>
                </tr>

                <tr>
                  <th>Posisi</th>
                  <td> <?php echo $data['pos_peg']; 
                    if ($data['pos_peg']=="Manager" || $data['pos_peg']=="Admin") {
                  ?> 
                    <i class="fas fa-check-circle text-info"></i>
                  <?php } ?>
                  </td>
                </tr>
                <tr>
                  <th>Jenis Kelamin</th>
                  <td> <?php echo $data['jk_peg']; ?></td>
                </tr>
                <tr>
                  <th>Tanggal Lahir</th>
                  <td> <?php echo $data['lhr_peg']; ?></td>
                </tr>
                <tr>
                  <th style="vertical-align: top;">Alamat</th>
                  <td> <?php echo $data['alamat_peg']; ?></td>
                </tr>
                <tr>
                  <th>No Handphone</th>
                  <td> <?php echo $data['hp_peg']; ?></td>
                </tr>
                <tr>
                  <th>Username</th>
                  <td> <?php echo $data['username']; ?></td>
                </tr>
                <tr>
                  <th>Password</th>
                  <td> xxxxxxxx</td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              <a href="?page=edit_datapegawai&id=<?php echo $_SESSION['id_peg'] ?>" class="">
              <button type="button" class="btn btn-primary btn-sm">Edit</button>
              </a>
            </div>
          </div>
        </div>
      </div>
  	</div>
  	</div>
  	</div>


      <div class="modal fade" id="password_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ganti Password Anda</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <?php 
                  $query = "SELECT * FROM tbl_pegawai WHERE id_peg = '$_SESSION[id_peg]'";
                  $sql = mysqli_query($conn, $query) or die ($conn->error);
                  $data = mysqli_fetch_array($sql);
                ?>
      
     <form class="form-horizontal" action="" method="post" data-parsley-validate="true">
        <div class="form-group">
          <div class="col-md-12">
            <div class="input-group input-group">
              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="password" name="password1" class="form-control" value="<?php echo $data['password']; ?>" placeholder="Password Lama" title="Password Lama" required autofocus>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="input-group input-group">
              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="password" name="password2" class="form-control" value="" placeholder="Password Baru" title="Password Baru" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="input-group input-group">
              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="password" name="password3" class="form-control" value="" placeholder="Konfirmasi Password Baru" title="Konfirmasi Password Baru" required>
            </div>
          </div>
        </div>
        <button type="submit" name="btnup" class="btn btn-info" style="width:100%">Update</button>
      </form>
      <br><br>
    </div>
    <div class="col-md-4"></div>

  </div>
</div>

<?php

if (isset($_POST['btnup'])):
  $password1 = htmlentities(strip_tags($_POST['password1']));
  $password2 = htmlentities(strip_tags($_POST['password2']));
  $password3 = htmlentities(strip_tags($_POST['password3']));

 $query = "SELECT * FROM tbl_pegawai WHERE id_peg='$_SESSION[id_peg]' AND password='$password1'";
                  $sql = mysqli_query($conn, $query) or die ($conn->error);

/*$cek_data = mysqli_query($conn, "SELECT * FROM tbl_pegawai WHERE username='$_SESSION[username]' AND password='$password1'");*/
  if (mysqli_num_rows($sql)==0) {
    echo "<script>alert('Gagal! Password Lama tidak cocok'); window.location='?page=';</script>";
    exit;
  }else {
    if ($password2 <> $password3) {
      echo "<script>alert('Gagal! Konfirmasi Password Baru tidak cocok'); window.location='?page=';</script>";
      exit;
    }else {
      $update = mysqli_query($conn, "UPDATE tbl_pegawai SET password='$password2' WHERE id_peg='$_SESSION[id_peg]'");
      if ($update) {
        echo "<script>alert('Password berhasil diperbarui!'); window.location='?page=';</script>";
        exit;
      }else {
        echo "<script>alert('Gagal! Silahkan coba lagi'); window.location='?page=';</script>";
        exit;
      }
    }
  }
endif;
?>


          </div>
        </div>
      </div>
    </div>
    </div>
    </div>

  	<footer>
  		<i class="fas fa-copyright"></i> <?php echo $_SESSION['id_peg'] ?> | SUPPORT TIM IT
  	</footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="asset/bootstrap_4/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="asset/DataTables/datatables.min.js"></script>
    <script>
      var id_session = $("#id_session").text();
    	$(document).ready(function() {
		    $('#example').DataTable({
          
        });
        $('#example2').DataTable({
          
        });
        $('#example3').DataTable({
          
        });

        $('#tbldata_penjualan').DataTable({
           lengthMenu : [[25, 50, -1], [25, 50, "All"]]
        });

        $('#tbl_riwayatperamalan').DataTable({
           lengthMenu : [[30, 50, -1], [30, 50, "All"]]
        });

        $('#tbl_pjlobat').DataTable({
           lengthMenu : [[50, -1], [50, "All"]]
        });

        $('#tabel_dataobat').DataTable({
          // ordering: false,
          lengthMenu : [[30, 50, 100, -1], [30, 50, 100, "All"]],
          order: [[1, "asc"]]
        });

        $('#tabl_datareg').DataTable({
          // ordering: false,
          lengthMenu : [[40, 50, 100, -2], [40, 50, 100, "All"]],
          order: [[1, "asc"]]
        });
        
		  });
      $("#tombol_keluar").click(function(){
        // alert("Log Out");
        Swal.fire({
          title: 'Apakah Anda Yakin?',
          text: 'anda akan keluar dari aplikasi',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya'
        }).then((tes) => {
          if (tes.value) {
            $.ajax({
              type: "POST",
              url: "ajax/logout.php",
              success: function(hasil) {
                window.location='login.php';
              }
            })  
          }
        })
      });
      function checkTime(i) {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
      }
      function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        // add a zero in front of numbers<10
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('jam').innerHTML = h + ":" + m + ":" + s;
        t = setTimeout(function() {
          startTime()
        }, 500);
      }
      startTime();
    </script>
  </body>
</html>
<?php 
  }
?>


<div class="modal fade" id="modal_diagnosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">


  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Kadaluarsa Obat Kurang 10 Hari</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">


                  <div class="table-container">
                <table id="example2" class="table table-striped display tabel-data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Obat</th>
                            <th>Exp Date</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Kategori</th>
                            <th>Sisa Hari</th>
                            <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
                        <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $nomor = 1;
                        while($data_10 = mysqli_fetch_array($sql_10)) {
                          $exp = date_create($data_10['tgl_exp']);
                  $today = date_create(date("Y-m-d"));
                  $sisa = date_diff($today,$exp);
                  $sisa_hari = $sisa->format("%a");
                       ?>
                          <tr>
                            <td><?php echo $nomor++; ?></td>
                            <td><?php echo $data_10['kd_obat']; ?></td>
                            <td><?php echo $data_10['nm_obat']; ?></td>
                            <td><?php echo $data_10['tgl_exp']; ?></td>
                            <td><?php echo $data_10['stok']; ?></td>
                            <td><?php echo $data_10['sat_obat']; ?></td>
                            <td><?php echo $data_10['ktg_obat']; ?></td>
                            <td><?php echo $sisa_hari; ?> Hari</td>
                                    <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
                                 <?php } ?>
                          </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>   
                            </div>
   
                        </div>



                </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal_obathabis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">


  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Stok Obat Kurang 10 </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  <div class="row" style="padding: 0 16px;">
            <div class="col-md-12 vertical-form">


                  <div class="table-container">
                <table id="example2" class="table table-striped display tabel-data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Obat</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Kategori</th>
                            <?php if($_SESSION['posisi_peg'] == 'Admin' || $_SESSION['posisi_peg'] == 'Manager' || $_SESSION['posisi_peg'] == 'Apoteker') { ?>
                        <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $nomor = 1;
                        while($data = mysqli_fetch_array($sql_telahexp)) {
                       ?>
                          <tr>
                            <td><?php echo $nomor++; ?></td>
                            <td><?php echo $data['kd_obat']; ?></td>
                            <td><?php echo $data['nm_obat']; ?></td>
                            <td><?php echo $data['stk_obat']; ?></td>
                            <td><?php echo $data['sat_obat']; ?></td>
                            <td><?php echo $data['ktg_obat']; ?></td>

                          </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>   
                            </div>
   
                        </div>



                </form>
      </div>
    </div>
  </div>
</div>
