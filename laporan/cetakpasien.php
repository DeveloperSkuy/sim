<?php
session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../config/database.php";
// panggil fungsi untuk format tanggal
include "../config/fungsi_tanggal.php";
// panggil fungsi untuk format rupiah
include "../config/fungsi_rupiah.php";

$hari_ini = date("d-m-Y");

// ambil data hasil submit dari form
$tgl1     = $_GET['tgl_awal'];
$explode  = explode('-',$tgl1);
$tgl_awal = $explode[2]."-".$explode[1]."-".$explode[0];

$tgl2      = $_GET['tgl_akhir'];
$explode   = explode('-',$tgl2);
$tgl_akhir = $explode[2]."-".$explode[1]."-".$explode[0];

$asuransi      = $_GET['asuransi'];

if (isset($_GET['tgl_awal'])) {
    $no    = 1;

   /* $query_tampil = "SELECT * FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_peg = tbl_pegawai.id_peg ORDER BY tbl_penjualan.tgl_penjualan DESC, tbl_penjualan.no_penjualan DESC";*/
    // fungsi query untuk menampilkan data dari tabel obat masuk

    $query = mysqli_query($mysqli, "SELECT * FROM tbl_daftarpasien INNER JOIN tbl_pegawai ON tbl_daftarpasien.id_peg = tbl_pegawai.id_peg  WHERE tbl_daftarpasien.tgl_daftar BETWEEN '$tgl_awal' AND '$tgl_akhir' AND asuransi_pas ='$asuransi'  
                                    ") 
                                    or die('Ada kesalahan pada query tampil Transaksi : '.mysqli_error($mysqli));
    $count  = mysqli_num_rows($query);
}
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>LAPORAN DATA PASIEN BEROBAT</title>
        <link rel="stylesheet" type="text/css" href="../asset/laporan.css" />
    </head>
    <body>
        <div id="title">
            LAPORAN DATA PASIEN BEROBAT 
        </div>
    <?php  
    if ($tgl_awal==$tgl_akhir) { ?>
        <div id="title-tanggal">
            Tanggal <?php echo tgl_eng_to_ind($tgl1); ?>
        </div>
    <?php
    } else { ?>
        <div id="title-tanggal">
            Tanggal <?php echo tgl_eng_to_ind($tgl1); ?> s.d. <?php echo tgl_eng_to_ind($tgl2); ?>
        </div>
    <?php
    }
    ?>
        
        <hr><br>
        <div id="isi">
            <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
                <thead style="background:#e8ecee">
                    <tr class="tr-title">
                        <th height="20" align="center" valign="middle">NO.</th>
                        <th height="20" align="center" valign="middle">NO REG</th>
                        <th height="20" align="center" valign="middle">TGL DAFTAR</th>
                        <th height="20" align="center" valign="middle">NAMA PASIEN</th>
                        <th height="20" align="center" valign="middle">NO RM</th>
                        <th height="20" align="center" valign="middle">NO HP / TELP</th>
                        <th height="20" align="center" valign="middle">ASURANSI</th>
                        <th height="20" align="center" valign="middle">DIAGNOSA</th>
                        <th height="20" align="center" valign="middle">Pegawai</th>
                    </tr>
                </thead>
                <tbody>
<?php
    // jika data ada
    if($count == 0) {
        echo "  <tr>
                    <td width='40' height='13' align='center' valign='middle'></td>
                    <td width='120' height='13' align='center' valign='middle'></td>
                    <td width='80' height='13' align='center' valign='middle'></td>
                    <td width='80' height='13' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='30' height='13' valign='middle'></td>
                    <td style='padding-right:10px;' width='80' height='13' align='right' valign='middle'></td>
                    <td style='padding-right:10px;' width='100' height='13' align='right' valign='middle'></td>
                <td style='padding-right:10px;' width='100' height='13' align='center' valign='middle'></td>
                <td style='padding-right:10px;' width='80' height='13' align='right' valign='middle'></td>


                </tr>";
    }
    // jika data tidak ada
    else {
        // tampilkan data
        while ($data = mysqli_fetch_assoc($query)) {
            $tanggal       = $data['tgl_daftar'];
$nama       = $data['nama_peg'];

            $exp           = explode('-',$tanggal);
            $tanggal_masuk = $exp[2]."-".$exp[1]."-".$exp[0];

            // menampilkan isi tabel dari database ke tabel di aplikasi
            echo "  <tr>
                        <td width='20' height='13' align='center' valign='middle'>$no</td>
                        <td width='90' height='13' align='center' valign='middle'>$data[no_daftar]</td>
                        <td width='60' height='13' align='center' valign='middle'>$tanggal_masuk</td>
                        <td style='padding-left:5px;' width='155' height='13' valign='middle'>$data[nama_pas]</td>

                        <td width='40' height='13' align='center' valign='middle'>$data[nomor_rm]</td>
                        <td style='padding-right:10px;' width='60' height='13' align='right' valign='middle'>$data[no_hp]</td>
                        <td style='padding-right:10px;' width='60' height='13' align='center' valign='middle'>$data[asuransi_pas]</td>
                            <td style='padding-right:10px;' width='60' height='13' align='left' valign='middle'>$data[diagnosa]</td>
                            <td style='padding-right:10px;' width='40' height='13' align='right' valign='middle'>$data[nama_peg]</td>
                    </tr>";
            $no++;
        }
    }
?>	
                </tbody>
            </table>
<br>
            <div id="footer-tanggal">
                Medan, <?php echo tgl_eng_to_ind("$hari_ini"); ?>
            </div>
            <div id="footer-jabatan">
                 
            </div>
    <br>
    <br>        
            <div id="footer-nama">
                <?php echo $nama; ?>
            </div>
        </div>
    </body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename="LAPORAN DATA PASIEN PER BULAN.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.($content).'</page>';
// panggil library html2pdf
require_once('../asset/html2pdf_v4.03/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P','F4','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>