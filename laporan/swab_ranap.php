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
<link type="text/css" href="./isi/style_css/covid.css" rel="stylesheet">

<page backtop="15px">
    <page_header class="page_header">
        (Lampiran Surat Swab Antigen)
    </page_header>
    <page_footer>
    </page_footer>
    <div class="page-content">
        <div class="data-apotek">
<img src='../images/zt.png' width='640'> 

        </div>
        <div class="judul-surat">
            <span class="judul" ><u>SURAT KETERANGAN DOKTER </u></span>

        </div>

        <div class="data-transaksi" style="line-height: 1.0; margin-bottom: 4px;">
            <p>Yang bertanda tangan di bawah ini, dokter Klinik Kimia Farma menyatakan bahwa : </p>
            <?php 
    $query = "Select * from tbl_daftarpasienranap where no_daftar='$no_daftar'";
                $sql = mysqli_query($conn, $query) or die ($conn->error);
                $data = mysqli_fetch_array($sql);

             ?>
            <table class="data-nota">
                <tr>
                    <td>Nama </td>
                    <td>: <?php echo $data['nama_pas']; ?></td>
                     <td width="20px">&nbsp;&nbsp;&nbsp; </td>
                    <td width="20px">&nbsp;&nbsp;&nbsp;</td>
                    <td width='50%'>Nomor MR </td>
                    <td>: <?php echo $data['nomor_rm']; ?></td>
                </tr>
                <tr>
                    <td>Tempat/ Tgl Lahir</td>
                    <td>: <?php echo $data['tpt_lahir']; ?>/<?php echo tgl_indo($data['lhr_pas']); ?></td>

                    <td width="20px"> </td>
                    <td width="20px"></td>
                    <td width='50%'>Tanggal Pemeriksaan </td>
                    <td>: <?php echo tgl_indo($data['tgl_daftar']); ?></td>

                </tr>
                <tr>
                    <td>Jenis Kelamin </td>
                    <td>: <?php echo $data['jk_pas']; ?></td>

                    <td width="20px" > </td>
                    <td width="20px"></td>
                    <td width='50%'>Dokter Pengirim</td>
                    <td>: <?php echo $data['dokter']; ?></td>

                </tr>

                <tr>
                    <td>Alamat </td>
                    <td>: <?php echo $data['alm_pas']; ?></td>
                </tr>
                <tr>
                    <td>No NIK </td>
                    <td>: <?php echo $data['nik']; ?></td>
                </tr>
             </table>

<br>
        <table class="data-item data-item-pembelian" border="1">
            <tr>
                <th class="col_nmobat">Pemeriksaan</th>
                <th class="col_jml">Hasil </th>
                <th class="col_jml">Nilai Rujukan</th>
                <th class="col_sat">Tanggal Keluar Hasil</th>
            </tr>
    <?php 
 $query = "select * from tbl_hematologi_pasien where no_daftar ='$no_daftar' and kategori ='Covid' ";


$sql_lihat = mysqli_query($conn, $query) or die ($conn->error);
        while($data = mysqli_fetch_array($sql_lihat)) {

             ?>

            <tr>
                <td class="col_nmobat" ><?php echo $data['nm_labor']; ?></td>
                <td class="col_jml" ><?php echo $data['hasil']; ?></td>
                <td class="col_jml"><?php echo $data['nilai_normal']; ?></td>
                <td class="col_sat"><?php echo tgl_indo($data['tgl_hematologi']); ?></td>
            </tr>
    <?php } ?>
        </table>


            <?php 
$query_p = "SELECT tbl_hematologidetail.*, tbl_hematologidetail.kd_hematologi, tbl_hematologi.no_daftar, tbl_hematologi.no_lab,  tbl_hematologi.nm_dokter,tbl_hematologi.tgl_labor,  tbl_nama_hematologi.nama_hematologi FROM tbl_hematologidetail
                  LEFT JOIN tbl_hematologi ON tbl_hematologidetail.no_lab=tbl_hematologi.no_lab

                    LEFT JOIN tbl_nama_hematologi ON tbl_hematologidetail.kd_hematologi=tbl_nama_hematologi.kd_hematologi

                WHERE no_daftar ='$no_daftar' ";


                $sql = mysqli_query($conn, $query_p) or die ($conn->error);
                $datang = mysqli_fetch_array($sql);

             ?>

        <div class="pernyataan">
            <b>Sumber : Swab Nasofaring</b>
            <br><b>Waktu pengambilan spesimen :<?php echo $datang['expired']; ?> </b> 

<br style="text-align: justify;">
Demikian surat keterangan ini dibuat untuk digunakan sebagaimana mestinya. Terima kasih atas perhatiannya.  
<br>
<br>
Catatan & Saran :
<ol>
  <li>Hasil pemeriksaan Rapid Test Swab Antigen tidak dapat dipergunakaan untuk menegakkan diagnosis Covid-19.</li>
  <li>Hasil negatif tidak menyingkirkan kemungkinan terinfeksi SARS-Cov-2 sehingga masih beresiko menularkan ke orang lain.</li>
  <li>Hasil negatif pada pasien bergejala SARS-CoV-2 (batuk, deman, anosmia, nyeri ternggorokan) dan/atau memiliki kontak dengan pasien terkonfirmasi Covid-19 harus diperiksa dengan metode deteksi molekuler /NAAT (Nucleic Acid Amplification Test) yaitu pemeriksaan RT-PCR.</li>
  <li>Hasil negatif dapat terjadi pada kondisi kuantitas antigen pada spesimen dibawah level deteksi alat.</li>
  <li>Menerapkan PHBS (Perilaku Hidup Bersih dan Sehat), seperti : mencuci tangan, menggunakan masker, menjaga jarak, dan menjaga stamina.</li>
</ol>

Catatan & Saran (bila hasil Positif):
<ol>
  <li>Lakukan pemeriksaan konfirmasi dengan pemeriksaan RT PCR</li>
  <li>Lakukan karantina atau isolasi sesuai dengan kriteria</li>
  <li>Menerapkan PHBS (Perilaku Hidup Bersih dan Sehat), seperti : mencuci tangan, menggunakan masker, menjaga jarak, dan menjaga stamina.</li>
</ol>

        </div>
            <?php 
    $querys = "Select * from tbl_hematologi where no_daftar='$no_daftar'";
                $sql = mysqli_query($conn, $querys) or die ($conn->error);
                $datas = mysqli_fetch_array($sql);

             ?>


        <div class="paraf">
            <table class="tabel-paraf">
                <tr>
                    <td class="keterangan-paraf"></td>
                    <td class="keterangan-paraf kanan">Medan, 20 Maret 2022</td>
                </tr>
                <tr>
                    <td class="isi-paraf"></td>
                    <td class="isi-paraf kanan">Dokter Pemeriksa</td>
                </tr>
 
                 <tr>
                    <td class="nama-paraf"><?php echo $data['']; ?></td>
                    <td class="nama-paraf kanan"><?php echo $datas['nm_dokter']; ?></td>
                </tr>
            </table>
        </div>
    </div>
        </div>
</page>















<!--     $html2pdf = new HTML2PDF('P','A8','en', false, 'ISO-8859-15',array(20, 10, 13, 15)); -->
<?php
$filename="Tes-Swab.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();

// panggil library html2pdf

require_once('../asset/html2pdf_v4.03/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(20, 5, 20, 10));
    $html2pdf->setDefaultFont('Times');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>