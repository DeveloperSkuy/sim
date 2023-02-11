<?php 
    session_start();
    include "../koneksi.php";

    $nama_pas = @mysqli_real_escape_string($conn, $_POST['nama_pas']);
    $rma = @mysqli_real_escape_string($conn, $_POST['rma']);
    $nik = @mysqli_real_escape_string($conn, $_POST['nik']);
    $asuransi_pas = @mysqli_real_escape_string($conn, $_POST['asuransi_pas']);
    $no_bpjs = @mysqli_real_escape_string($conn, $_POST['no_bpjs']);
    $no_hp = @mysqli_real_escape_string($conn, $_POST['no_hp']);
    $nomor_rm = @mysqli_real_escape_string($conn, $_POST['nomor_rm']);
        
    $alm_pas = @mysqli_real_escape_string($conn, $_POST['alm_pas']);
    $jk = @mysqli_real_escape_string($conn, $_POST['jk']);
    $tpt_lahir = @mysqli_real_escape_string($conn, $_POST['tpt_lahir']);
    $tgl_lahir = @mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
    $desa = @mysqli_real_escape_string($conn, $_POST['desa']);
    $kec = @mysqli_real_escape_string($conn, $_POST['kec']);
    $kab_kota = @mysqli_real_escape_string($conn, $_POST['kab_kota']);
    $provinsi = @mysqli_real_escape_string($conn, $_POST['provinsi']);
    $poscode = @mysqli_real_escape_string($conn, $_POST['poscode']);
    $pekerjaan = @mysqli_real_escape_string($conn, $_POST['pekerjaan']);
    $goldarah = @mysqli_real_escape_string($conn, $_POST['goldarah']);



/*                    $carikode = mysqli_query($conn, "SELECT MAX(nomor_rma) FROM tbl_pasien WHERE   msk_pas ='$tgl_masuk'  ") or die (mysql_error());*/

                    $tgl_masuk = date("Y-m-d");
                    $hari= substr($tgl_masuk, 8, 2);
                    $bulan = substr($tgl_masuk, 5, 2);
                    $tahun = substr($tgl_masuk, 2, 2);
                    $tgl = $tahun;
        $rma ="A" ;                   

/*        $rama =substr($rma, 0,1) ;*/
        $pas=substr($rma, 0,1);

                    $carikode = mysqli_query($conn, "SELECT MAX(nomor_rma) FROM tbl_pasien WHERE     msk_pas ='$tgl_masuk' AND rma='$rma' ORDER BY nomor_rma DESC  ") or die (mysql_error());
                    $datakode = mysqli_fetch_array($carikode);
                    if($datakode) {
                        $nilaikode = substr($datakode[0], 2,3);
                        $kode = (int) $nilaikode;
                        $kode = $kode + 1;
                        $id = $pas."-".str_pad($kode, 3, "0", STR_PAD_LEFT)."-".$tgl;
                    } else {
                        $id = $pas."-001"."-".$tgl;
                    }

                    echo $id;
                 ?>