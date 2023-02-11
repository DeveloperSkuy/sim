<?php 
        include 'koneksi.php';
$no_daftar =$_GET['no_daftar'];
    error_reporting(0);// taruh disini ya  bagian atas sekali


session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../config/database.php";
// panggil fungsi untuk format tanggal
include "../config/fungsi_indotgl.php";
// panggil fungsi untuk format rupiah

?>
<link type="text/css" href="./isi/style_css/narkoba.css" rel="stylesheet">

<page backtop="15px">
    <page_header class="page_header">
        (Lampiran Surat Bebas Narkoba)
    </page_header>
    <page_footer>
    </page_footer>
    <div class="page-content">
        <div class="data-apotek">
<img src='../images/zt.png' width='640'> 

        </div>

 <?php 
 
    $query_narko = "SELECT tbl_hematologidetail.*, tbl_hematologidetail.kd_hematologi, tbl_hematologi.no_daftar, tbl_hematologi.no_lab, tbl_hematologidetail.no_lab,  tbl_hematologi.nm_dokter,tbl_hematologi.tgl_labor,  tbl_nama_hematologi.nama_hematologi FROM tbl_hematologidetail
                  LEFT JOIN tbl_hematologi ON tbl_hematologidetail.no_lab=tbl_hematologi.no_lab

                    LEFT JOIN tbl_nama_hematologi ON tbl_hematologidetail.kd_hematologi=tbl_nama_hematologi.kd_hematologi

                WHERE no_daftar ='$no_daftar' and tbl_hematologidetail.kd_hematologi ='PEM002' ";
                $sql_re = mysqli_query($conn, $query_narko) or die ($conn->error);
                $datakes = mysqli_fetch_array($sql_re);
$kesan = $datakes['kesan'];
             ?>

 <?php 
    $query_narkoba = "Select * from tbl_suratnarkoba where no_daftar='$no_daftar'";
                $sql_mu = mysqli_query($conn, $query_narkoba) or die ($conn->error);
                $datasu = mysqli_fetch_array($sql_mu);
$nomor = $datasu['no_surat'];
$keperluan = $datasu['kebutuhan'];
             ?>


        <div class="judul-surat">
            <span class="judul" ><u>Surat Keterangan Bebas Narkoba</u></span>
                        <br ><small> Nomor : <?php echo $nomor; ?> </small><br>
        </div>

        <div class="data-transaksi" style="line-height: 1.2; margin-bottom: 8px;">
            <p>Yang bertanda tangan di bawah ini, menerangkan bahwa : </p>
            <?php 
    $query = "Select * from tbl_daftarpasien where no_daftar='$no_daftar'";
                $sql = mysqli_query($conn, $query) or die ($conn->error);
                $data = mysqli_fetch_array($sql);

             ?>
            <table class="data-nota">
                <tr>
                    <td>Nama </td>
                    <td>: <?php echo $data['nama_pas']; ?></td>
                </tr>
                <tr>
                    <td>Tempat/ Tgl Lahir</td>
                    <td>: <?php echo $data['tpt_lahir']; ?>/<?php echo tgl_indo($data['lhr_pas']); ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin </td>
                    <td>: 
<label><input type="radio" name='Laki-laki' value='Laki-laki' <?php if($data['jk_pas']=='Laki-laki') echo 'checked="checked"'?>>Laki-laki</label>
      <label><input type="radio" name='Perempuan' value='Perempuan' <?php if($data['jk_pas']=='Perempuan') echo 'checked="checked"'?>>Perempuan</label>
</td>
                </tr>

                <tr>
                    <td>Alamat </td>
                    <td>: <?php echo $data['alm_pas']; ?></td>
                </tr>
                <tr>
                    <td>Pekerjaan </td>
                    <td>: <?php echo $data['pekerjaan']; ?></td>
                </tr>
             </table>



<p>Telah dilakukan pemeriksaan Zat Adiktif / Narkoba pada Urine yang bersangkutan dengan hasil sebagai berikut </p>
        </div>
        <div class="data-transaksi" style="line-height: 1.2; margin-bottom: 12px;">

        <table class="data-nota"  border="0">
            <tr>
                <th class="col_no">Pemeriksaan </th>
                <th class="col_nmobat">Hasil</th>
            </tr>


            <?php 

 $query = "select * from tbl_hematologi_pasien where no_daftar ='$no_daftar' and kategori ='Narkoba' ";


$sql_lihat = mysqli_query($conn, $query) or die ($conn->error);
        while($dataku = mysqli_fetch_array($sql_lihat)) {

             ?>
 
                <tr>
                            <td  ><?php echo $dataku['nm_labor']; ?></td>

<td>:<label><input type="radio" name='Laki-laki' value='Laki-laki' <?php if($dataku['hasil']=='Negatif') echo 'checked="checked"'?>>Negatif</label>
<label><input type="radio" name='Laki-laki' value='Laki-laki' <?php if($dataku['hasil']=='Positif') echo 'checked="checked"'?>>Positif</label>
</td>
                </tr>


        <?php } ?>
             </table>
        </div>
    
        <div class="pernyataan">
            Kesimpulan : Yang bersangkutan <b> <?php echo $kesan; ?> </b> menggunakan Zat Adiktif / Narkoba tersebut.

<p>Untuk keperluan : <?php echo $keperluan; ?> </p>

<p style="text-align: justify;">Demikianlah keterangan ini kami buat, agar dapat dipergunakan sebagaimana mestinya sesuai peraturan yang berlaku  </p>
        </div>
<br>
<br>
        <div class="paraf">
            <table class="tabel-paraf">
                <tr>
                    <td class="keterangan-paraf"></td>
                    <td class="keterangan-paraf kanan">Medan, 20 Maret 2022</td>
                </tr>
                <tr>
                    <td class="isi-paraf"></td>
                    <td class="isi-paraf kanan"></td>
                </tr>
                <tr>
                    <td class="nama-paraf"><?php echo $data['nm_dokter']; ?></td>
                    <td class="nama-paraf kanan"><?php echo $data['dokter']; ?></td>
                </tr>
            </table>
        </div>
    </div>
</page>















<!--     $html2pdf = new HTML2PDF('P','A8','en', false, 'ISO-8859-15',array(20, 10, 13, 15)); -->
<?php
$filename="Bebas_Narkoba.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();

// panggil library html2pdf

require_once('../asset/html2pdf_v4.03/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(20, 0, 20, 10));
    $html2pdf->setDefaultFont('Times');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>