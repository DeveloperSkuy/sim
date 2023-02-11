<?php
error_reporting(0);// taruh disini ya  bagian atas sekali


session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../config/database.php";
// panggil fungsi untuk format tanggal
include "../config/fungsi_tanggal.php";
// panggil fungsi untuk format rupiah
include "../config/fungsi_rupiah.php";


$hari_ini = date("d-m-Y");


    $no_daftar = @$_GET['no_daftar'];

   $query_daft = mysqli_query($mysqli,"SELECT * from tbl_daftarpasien   WHERE no_daftar ='$no_daftar' ");
    while ($dat = mysqli_fetch_assoc($query_daft)) {

    $nama = $dat['nama_pas'];
    $antrian =$dat['no_antrian'];
        $poli =$dat['proses'];
} 

?>

<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


        <link rel="stylesheet" type="text/css" href="../asset/laporan.css" />
    </head>
    <body>
        <div id="title">
        ANTRIAN PASIEN 
        </div>
        <div id="title-tanggal">
                    No Reg. : <?php echo $no_daftar; ?> , <?php echo $hari_ini; ?>
<br>
              Pasien: <?php echo $nama; ?> 
</div>

        <div id="title">
        NOMOR 
        <h1> A-<?php echo $antrian; ?></h1>
                <small> Poli-<?php echo $poli; ?> </small>
                
        </div>


<div class="terimakasih">
    Budayakan Antri Untuk Kenyamanan Bersama
            <br>
            TERIMA KASIH, SEMOGA CEPAT SEMBUH
        </div>


    </body>

</html><!-- Akhir halaman HTML yang akan di konvert -->



<?php
$filename="antrian.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif " >'.($content).'</page>';
// panggil library html2pdf

require_once('../asset/html2pdf_v4.03/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P','A8','en', false, 'ISO-8859-15');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>