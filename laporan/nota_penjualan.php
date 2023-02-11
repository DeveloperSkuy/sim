<?php 
	include '../koneksi.php';
	$no_pjl = @$_GET['no_pjl'];
	error_reporting(0);// taruh disini ya  bagian atas sekali


session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../config/database.php";
// panggil fungsi untuk format tanggal
include "../config/fungsi_tanggal.php";
// panggil fungsi untuk format rupiah
include "../config/fungsi_rupiah.php";
?>

 <link type="text/css" href="./isi/style_css/nota_penjualan.css" rel="stylesheet" >

 <page backleft="-10px" backright="-10px" backtop="-16px" backbottom="-16px" style="font-size: 6px;">
	<page_header class="page_header">

	</page_header>
	<page_footer>

	</page_footer>
	<div class="page-content page-nota-penjualan">
		<div class="nama-apotek-nopenjualan">
			<table class="tabel-nama-apotek-nopenjualan">
				<tr>
					<td>
						<span class="nama_apotek">APOTEK .........</span><br>
						Jl. Padang Bulan Kec. Padang Bulan, Medan 20231 <br>
						(Telp) 085361703106
					</td>
					<td class="nopenjualan">
						NOTA PENJUALAN <br> <?php echo $no_pjl; ?>
					</td>
				</tr>
			</table>
		</div>
		<div class="data-penjualan">
			<table class="tabel-data-penjualan">
			<?php 
				$query_pjl = "SELECT tbl_penjualan.tgl_penjualan, tbl_penjualan.total_penjualan, tbl_penjualan.tunai, tbl_penjualan.kembali, tbl_pegawai.username FROM tbl_penjualan INNER JOIN tbl_pegawai ON tbl_penjualan.id_peg = tbl_pegawai.id_peg WHERE tbl_penjualan.no_penjualan = '$no_pjl'";
				$sql_pjl = mysqli_query($conn, $query_pjl) or die ($conn->error);
				$data_pjl = mysqli_fetch_array($sql_pjl);
			 ?>
				<tr>
					<td class="isi tanggal">
						tgl : [<?php echo tgl_indo($data_pjl['tgl_penjualan']); ?>]
					</td>
					<td>/</td>
					<td class="isi nama-pegawai">
						kasir : <?php echo $data_pjl['username']; ?>
					</td>
				</tr>
			</table>
		</div>
		<div class="data-barang">
			<table class="tabel-data-barang">
			<?php 
				$query_dpjl = "SELECT tbl_dataobat.nm_obat, tbl_penjualandetail.jml_jual, tbl_penjualandetail.sat_jual, tbl_penjualandetail.hrg_jual, tbl_penjualandetail.subtotal FROM tbl_penjualandetail INNER JOIN tbl_dataobat ON tbl_penjualandetail.kd_obat = tbl_dataobat.kd_obat WHERE tbl_penjualandetail.no_penjualan = '$no_pjl'";
				$sql_dpjl = mysqli_query($conn, $query_dpjl) or die ($conn->error);
				while($data_dpjl = mysqli_fetch_array($sql_dpjl)) {
			 ?>
				<tr>
					<td align="left" class="nama_obat">
						<?php echo $data_dpjl['nm_obat']; ?>
					</td>
					<td class="jml_obat">
						<?php echo $data_dpjl['jml_jual']; ?>
					</td>
					<td class="sat_obat">
						<?php echo $data_dpjl['sat_jual']; ?>
					</td>
					<td align="right" class="hrg_obat">
						<?php echo $data_dpjl['hrg_jual']; ?>
					</td>
					<td align="right" class="subt_obat">
						<?php echo $data_dpjl['subtotal']; ?>
					</td>
				</tr>
			<?php } ?>
				<tr class="baris-total">
					<td colspan="4">Total :</td>
					<td class="total">
						<?php echo $data_pjl['total_penjualan']; ?>
					</td>
				</tr>
				<tr class="baris-tunai">
					<td colspan="4">Tunai :</td>
					<td class="tunai">
						<?php echo $data_pjl['tunai']; ?>
					</td>
				</tr>
				<tr class="baris-kembali">
					<td colspan="4">Kembali :</td>
					<td class="kembali">
						<?php echo $data_pjl['kembali']; ?>
					</td>
				</tr>
			</table>
		</div>
		<div class="terimakasih">
			TERIMA KASIH, SEMOGA OBAT YANG DIBELI DAPAT BERMANFAAT
		</div>
		</div>
	</page>


















<!--     $html2pdf = new HTML2PDF('P','A8','en', false, 'ISO-8859-15',array(20, 10, 13, 15)); -->
<?php
$filename="LAPORAN PENJUALAN.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();

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