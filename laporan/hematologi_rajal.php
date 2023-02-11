<?php
// memanggil library FPDF
require('../fpdf17/fpdf.php');
include "../config/fungsi_indotgl.php";
date_default_timezone_set('Asia/Jakarta');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);



include("koneksi.php");
$no_daftar =$_GET['no_daftar'];

$thn = date("Y");

$result = mysqli_query($conn,"Select * from tbl_daftarpasien where no_daftar='$no_daftar'");



$pdf = new FPDF('P','mm',array(297,210)); //L For Landscape / P For Portrait
$pdf->AddPage();

$pdf->SetMargins(10,10,18);






/*$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,6,'NIM',1,0);
$pdf->Cell(85,6,'NAMA MAHASISWA',1,0);
$pdf->Cell(27,6,'NO HP',1,0);
$pdf->Cell(25,6,'TANGGAL LHR',1,1);*/

$pdf->SetFont('Arial','',10);


while ($data=$result->fetch_assoc()) {

    $lahir    =new DateTime($data['lhr_pas']);
                        $today        =new DateTime();
                        $umur = $today->diff($lahir) ;
   /* echo $umur->y; echo " Tahun, "; echo $umur->m; echo " Bulan";*/
                    
// $mahasiswa = mysqli_query($connect, "select * from akta");
// while ($row = mysqli_fetch_array($mahasiswa)){
/*    $pdf->Cell(20,6,$data['nama'],1,0);
    $pdf->Cell(85,6,$data['norm'],1,0);
    $pdf->Cell(27,6,$data['no_telp'],1,0);
    $pdf->Cell(25,6,$data['tgl_lahir'],1,1); */



 $pdf->SetTextColor(0,0,0);

        $pdf->Image('../images/zt.png',12,1);
        $pdf->Cell(0,25,'  ',0,1,'C');
        $pdf->SetFont('Arial','B','13');
        $pdf->Cell(0,20,' HASIL PEMERIKSAAN LABORATORIUM',0,1,'C');
        $pdf->SetFont('Arial','B','10');
        $pdf->Cell(0,6,'  ',0,1,'C');

        $pdf->SetFont('Arial','','10');


$jam = date('H:i:s');
 $query_pjlobat = "SELECT tbl_hematologidetail.*, tbl_hematologidetail.kd_hematologi, tbl_hematologi.no_daftar, tbl_hematologi.no_lab,  tbl_hematologi.nm_dokter,tbl_hematologi.tgl_labor,  tbl_nama_hematologi.nama_hematologi FROM tbl_hematologidetail
                  LEFT JOIN tbl_hematologi ON tbl_hematologidetail.no_lab=tbl_hematologi.no_lab

                    LEFT JOIN tbl_nama_hematologi ON tbl_hematologidetail.kd_hematologi=tbl_nama_hematologi.kd_hematologi

                WHERE no_daftar ='$no_daftar' ";
                $sql_pjlobat = mysqli_query($conn, $query_pjlobat) or die ($conn->error);
while ($datas = mysqli_fetch_array($sql_pjlobat)){

        $kd_hema = $datas['nama_hematologi'];
                $kesan = $datas['kesan'];
                $dokter = $datas['nm_dokter'];
                $tgl = $datas['tgl_labor'];
                 $nolab = $datas['no_lab'];
}



        $pdf->Cell(15);
        $pdf->Cell(0,-15,'No Lab ',0,1,'L');
        $pdf->Cell(50);
        $pdf->Cell(2,15,': '.$nolab,0,1,'L');
        $pdf->Cell(15);
        $pdf->Cell(0,-2,'Nama  ',0,1,'L');
        $pdf->Cell(50);
        $pdf->Cell(0,2,': '.$data['nama_pas'] ,0,1,'L');
        $pdf->Cell(15);
        $pdf->Cell(0,11,'Umur ',0,1,'L');
        $pdf->Cell(50);
        $pdf->Cell(0,-11,': '.$umur->y.' tahun',0,1,'L');
        $pdf->Cell(15);
        $pdf->Cell(0,22,'Jenis Kelamin ',0,1,'L');
        $pdf->Cell(50);
        $pdf->Cell(0,-22,': '.$data['jk_pas'],0,1,'L');
        $pdf->Cell(15);
        $pdf->Cell(0,32,'Alamat ',0,1,'L');
        $pdf->Cell(50);
        $pdf->Cell(0,-32,': '.$data['alm_pas'],0,1,'L');
        $pdf->Cell(15);


        $pdf->Cell(90);
        $pdf->Cell(0,-15,'Dokter Pengirim ',0,1,'L');
        $pdf->Cell(140);
        $pdf->Cell(2,15,': '.$dokter,0,1,'L');
        $pdf->Cell(105);
        $pdf->Cell(0,-2,'Tgl Periksa  ',0,1,'L');
        $pdf->Cell(140);
        $pdf->Cell(0,2,': '.tgl_indo($tgl) ,0,1,'L');
        $pdf->Cell(105);
        $pdf->Cell(0,11,'Jam Periksa ',0,1,'L');
        $pdf->Cell(140);
        $pdf->Cell(0,-11,': '.$jam,0,1,'L');
        $pdf->Cell(105);
        $pdf->Cell(0,22,'Tgl Cetak',0,1,'L');
        $pdf->Cell(140);
        $pdf->Cell(0,-22,': '.tgl_indo($tgl),0,1,'L');
        $pdf->Cell(15);

$pdf->Cell(15,23,'',0,1);
        $pdf->Cell(8);


           $pdf->Cell(8);



// Memberikan space kebawah agar tidak terlalu rapat

$pdf->SetFont('Arial','B',10);
 $pdf->Cell(18);
$pdf->Cell(25,5,'',0,1);
 $pdf->Cell(8);

$pdf->Cell(60,6,'Pemeriksaan',1,0,'L');
$pdf->Cell(20,6,'Hasil',1,0,'C');
$pdf->Cell(24,6,'Satuan',1,0,'C');
$pdf->Cell(35,6,'Nilai Normal',1,0,'C');
$pdf->Cell(35,6,'Keterangan',1,1,'C');
$pdf->SetFont('Arial','',10);


$mahasiswa = mysqli_query($conn, "select * from tbl_hematologi_pasien where no_daftar ='$no_daftar' ");
while ($row = mysqli_fetch_array($mahasiswa)){


        $pdf->Cell(8);

    $pdf->Cell(60,6,$row['nm_labor'],1,0,'L');

    $pdf->Cell(20,6,$row['hasil'],1,0,'C');
    $pdf->Cell(24,6,$row['satuan'],1,0,'C');
    $pdf->Cell(35,6,$row['nilai_normal'],1,0,'C'); 
    $pdf->Cell(35,6,$row['keterangan'],1,1,'C'); 
}



        $pdf->Cell(8);

        $pdf->Cell(0,13,'Kesan : '.$kesan.'  ',0,1,'L');
        $pdf->Cell(15);

         $pdf->Cell(110);

        $pdf->Cell(0,45,'Medan,  '.tgl_indo($data['tgl_daftar']),0,1,'L');
        $pdf->Cell(15);
        $pdf->Cell(0,-5,'  ',0,1,'L');
        $pdf->Cell(125);
        $pdf->Cell(0,5,'',0,1,'L');
        $pdf->Cell(15);

        $pdf->Cell(0,-35,'  ',0,1,'L');
        $pdf->Cell(125);
        $pdf->Cell(0,35,'Dokter Pemeriksa,  ',0,1,'L');
        $pdf->Cell(15);

        $pdf->Cell(0,-25,'  ',0,1,'L');
        $pdf->Cell(125);
        $pdf->Cell(0,25,'  ',0,1,'L');
        $pdf->Cell(15);


        $pdf->Cell(0,30,'' ,0,1,'L');
        $pdf->Cell(125);
        $pdf->Cell(0,-30,'',0,1,'L');
        $pdf->Cell(15);

        $pdf->Cell(0,20,'' ,0,1,'L');
        $pdf->Cell(125);
        $pdf->Cell(0,-20,''.$dokter,0,1,'L');


        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(15);

/*$pdf->Image('../images/radio.png',60,30,89);*/


//Drink

$pdf->Ln(10);
//Gender
}
$pdf->Output();
?>