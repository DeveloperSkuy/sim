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
  $rma=substr($nama_pas, 0, 1);

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



 
/*$tahun = substr($tgl_lahir, 2, 2);
		$bulan = substr($tgl_lahir, 5, 2);
		$hari = substr($tgl_lahir, 8, 2);
		$tgl = $tahun.$bulan;

		$pas=substr($nama_pas, 0, 1);



		$query_id = "SELECT nomor_rma FROM tbl_pasien WHERE nama_pas='$pas' ORDER BY id_pas DESC";
		$sql_id = mysqli_query($conn, $query_id) or die ($conn->error);
		$data_id = mysqli_fetch_array($sql_id);
		if($data_id) {
			$indeks = substr($data_id[0], 3, 2);
			$no_indeks = (int) $indeks;
			$no_indeks = $no_indeks + 1;
			$id = $pas.str_pad($no_indeks, 2, "0", STR_PAD_LEFT).$tgl;
		} else {
			$id = strtoupper($pas)."-".$tgl."-".$hari;
		}
*/

	$query = "INSERT INTO tbl_pasien VALUES('$nomor_rm', '$nama_pas', '$jk','$tpt_lahir','$tgl_lahir', '$pekerjaan', '$goldarah', '$asuransi_pas', '$no_bpjs','$no_hp', '$alm_pas','$nomor_rm','$nik','$desa','$kec','$kab_kota','$provinsi','$poscode','$tgl_masuk','$id','$rma')";
	$sql = mysqli_query($conn, $query) or die ($conn->error);
	if($sql) {
		echo "berhasil";
	} else {
		echo "gagal";
	}
 ?>