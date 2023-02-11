<?php
// memanggil library FPDF
require('../fpdf17/fpdf.php');
include "../config/fungsi_indotgl.php";

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);


include("koneksi.php");
$no_daftar =$_GET['no_daftar'];

$thn = date("Y");

?>

 <?php 
    $query_diagnosa = "Select * from tbl_diagnosa where no_daftar='$no_daftar'";
                $sql_diag = mysqli_query($conn, $query_diagnosa) or die ($conn->error);
                $data_diag = mysqli_fetch_array($sql_diag);
$diagnosa = $data_diag['diagnosa'];
             ?>

 <?php 
    $query_narkoba = "Select * from tbl_suratsehat where no_daftar='$no_daftar'";
                $sql_mu = mysqli_query($conn, $query_narkoba) or die ($conn->error);
                $datasu = mysqli_fetch_array($sql_mu);
$nomor = $datasu['no_surat'];
$keperluan = $datasu['kebutuhan'];
             ?>
<?php 
$result = mysqli_query($conn,"Select * from tbl_daftarpasien where no_daftar='$no_daftar'");

while ($data=$result->fetch_assoc()) {

    $lahir    =new DateTime($data['lhr_pas']);
                        $today        =new DateTime();
                        $umur = $today->diff($lahir) ;


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
        $pdf->SetFont('Times','B','14');
        $pdf->Cell(0,20,' SURAT KETERANGAN SEHAT ',0,1,'C');
        $pdf->SetFont('Times','B','12');

        $pdf->Cell(0,-7,' Nomor : '.$nomor.' ',0,1,'C');

        $pdf->SetFont('Times','','12');

        $pdf->Cell(15);
        $pdf->Cell(0,35,'Yang bertanda tangan di bawah ini Dokter Pemeriksa Klinik Al-Hadi Menerangkan Bahwa : ',0,1,'L');
        $pdf->Cell(15);
        $pdf->Cell(0,-15,'Nama ',0,1,'L');
        $pdf->Cell(60);
        $pdf->Cell(2,15,': '.$data['nama_pas'],0,1,'L');
        $pdf->Cell(15);
        $pdf->Cell(0,-2,'Umur  ',0,1,'L');
        $pdf->Cell(60);
        $pdf->Cell(0,2,': '.$umur->y.' tahun',0,1,'L');
        $pdf->Cell(15);
        $pdf->Cell(0,11,'Jenis Kelamin ',0,1,'L');
        $pdf->Cell(60);
        $pdf->Cell(0,-11,': '.$data['jk_pas'],0,1,'L');
        $pdf->Cell(15);
        $pdf->Cell(0,22,'Pekerjaan ',0,1,'L');
        $pdf->Cell(60);
        $pdf->Cell(0,-22,': '.$data['pekerjaan'],0,1,'L');
        $pdf->Cell(15);
        $pdf->Cell(0,32,'Alamat ',0,1,'L');
        $pdf->Cell(60);
        $pdf->Cell(0,-32,': '.$data['alm_pas'],0,1,'L');
        $pdf->Cell(15);

        $pdf->Cell(0,45,'Hasil pemeriksaan fisik kami tanggal '.tgl_indo($data['tgl_daftar']).' di Klinik Al-Hadi adalah sebagai berikut: ',0,1,'L');
        $pdf->Cell(15);
        $pdf->Cell(0,-25,'Berat Badan ',0,1,'L');
        $pdf->Cell(60);
        $pdf->Cell(0,25,': '.$data_diag['berat_badan'].' kg',0,1,'L');
        $pdf->Cell(15);
        $pdf->Cell(0,-14,'Tinggi Badan ',0,1,'L');
        $pdf->Cell(60);
        $pdf->Cell(0,14,': '.$data_diag['tinggi_badan'].' cm',0,1,'L');
        $pdf->Cell(15);
        $pdf->Cell(0,-2,'Tekanan Darah ',0,1,'L');
        $pdf->Cell(60);
        $pdf->Cell(0,2,': '.$data_diag['tekanan_darah'],0,1,'L');
        $pdf->Cell(15);
        $pdf->Cell(0,11,'Golongan Darah ',0,1,'L');
        $pdf->Cell(60);
        $pdf->Cell(0,-11,': '.$data_diag['goldarah'],0,1,'L');
        $pdf->Cell(15);



        $pdf->Cell(5,10,'',0,1,'L');
        $pdf->Cell(15);
        $pdf->MultiCell(0,8,'Surat Keterangan Sehat ini dipergunakan sebagai '.$keperluan.' ');
         $pdf->Cell(15);
        $pdf->MultiCell(0,12,'Demikian Surat Keterangan Sehat dibuat untuk dapat dipergunakan sebagaimana mestinya ');
         $pdf->Cell(125);







        $pdf->Cell(0,45,'Medan, '.tgl_indo($data['tgl_daftar']),0,1,'L');
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
        $pdf->Cell(0,-20,''.$data['dokter'],0,1,'L');

        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(15);


}


$pdf->Output();
?>