# Host: localhost  (Version 5.5.5-10.1.19-MariaDB)
# Date: 2022-04-07 11:25:18
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "tbl_daftarpasien"
#

DROP TABLE IF EXISTS `tbl_daftarpasien`;
CREATE TABLE `tbl_daftarpasien` (
  `no_daftar` varchar(15) NOT NULL DEFAULT '',
  `tgl_daftar` date DEFAULT NULL,
  `nama_pas` varchar(50) NOT NULL DEFAULT '',
  `nik` varchar(26) NOT NULL DEFAULT '',
  `jk_pas` varchar(10) NOT NULL DEFAULT '',
  `tpt_lahir` varchar(50) NOT NULL DEFAULT '',
  `lhr_pas` date NOT NULL DEFAULT '0000-00-00',
  `pekerjaan` varchar(50) NOT NULL DEFAULT '',
  `asuransi_pas` varchar(50) NOT NULL DEFAULT '',
  `no_bpjs` varchar(16) NOT NULL DEFAULT '',
  `no_hp` varchar(16) NOT NULL DEFAULT '',
  `alm_pas` text NOT NULL,
  `nomor_rm` varchar(50) NOT NULL DEFAULT '',
  `keluhan` varchar(100) NOT NULL DEFAULT '',
  `dokter` text NOT NULL,
  `diagnosa` varchar(100) NOT NULL DEFAULT '',
  `tinggi_badan` varchar(50) NOT NULL DEFAULT '',
  `berat_badan` varchar(50) NOT NULL DEFAULT '',
  `temp` varchar(10) DEFAULT '',
  `goldarah` varchar(10) DEFAULT '',
  `tekanan_darah` varchar(10) DEFAULT '',
  `no_antrian` smallint(6) NOT NULL DEFAULT '0',
  `status` varchar(12) NOT NULL DEFAULT '',
  `cara_masuk` varchar(1000) NOT NULL DEFAULT '',
  `desa` varchar(1000) NOT NULL,
  `kec` varchar(1000) NOT NULL,
  `kab_kota` varchar(1000) NOT NULL,
  `provinsi` varchar(1000) NOT NULL,
  `id_pas` varchar(16) NOT NULL DEFAULT '',
  `id_peg` varchar(11) NOT NULL,
  PRIMARY KEY (`no_daftar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

#
# Data for table "tbl_daftarpasien"
#

INSERT INTO `tbl_daftarpasien` VALUES ('REG/20220331/01','2022-03-31','Andika Pohan','','Laki-laki','','2021-07-09','Wiraswasta','Pribadi','','0978686','Medan','000008','Mual-mual','dr. Ade Rahmat','','162','67','37','B','182/i',1,'rawat','Datang Sendiri','Adin Tengah','Salapian','Langkat','Sumatera Utara','000008','ADM01970215'),('REG/20220401/01','2022-04-01','Mufti','1278687675756','Laki-laki','Jatinegara','1992-06-09','Wiraswasta','BPJS Kesehatan','888826786767','0812676767','Jl. Cipto Mangunkusumo No. 12','000024','Batuk','dr. Ade Rahmat','','156','57','37','A','182/i',1,'rawat','Datang Sendiri','Jatinegara Kaum','Pulo Gadung','Jakarta Timur','DKI Jakarta','000024','ADM01970215'),('REG/20220402/01','2022-04-02','Andriani','','Perempuan','','2021-07-16','','Pribadi','','7968686','Medan','000005','','dr. Ade Rahmat','','','','','0','',1,'daftar','Datang Sendiri','Aek Bamban','Aek Songsongan','Asahan','Sumatera Utara','000005','ADM01970215'),('REG/20220402/02','2022-04-02','Indra Syafira','1276767575','Laki-laki','','1965-07-06','','Pribadi','','08868767575','Medan','000016','','dr. Ade Rahmat','','','','','0','',2,'daftar','Datang Sendiri','Sei Kerah Hilir I','Medan Perjuangan','Medan','Sumatera Utara','000016','ADM01970215'),('REG/20220402/03','2022-04-02','Syariah','','Perempuan','','2021-07-16','','BPJS Kesehatan','','79696969','Medan','000004','','dr. Ade Rahmat','','','','','0','',3,'daftar','Datang Sendiri','Adian Nangka','Siempat Nempu','Dairi','Sumatera Utara','000004','ADM01970215'),('REG/20220402/04','2022-04-02','Faisal','','Laki-laki','','2021-07-08','','Pribadi','','79796868','Medan','000006','','dr. Ade Rahmat','','','','','0','',4,'daftar','Datang Sendiri','Adin Tengah','Salapian','Langkat','Sumatera Utara','000006','ADM01970215'),('REG/20220402/05','2022-04-02','Iqbal','12716868686','Laki-laki','','2021-06-29','','Pribadi','',' 628089766878','Medan Tuntungan','000014','','dr. Ade Rahmat','','','','','0','',5,'daftar','Datang Sendiri','Adian Nangka','Siempat Nempu','Dairi','Sumatera Utara','000014','ADM01970215'),('REG/20220402/06','2022-04-02','Asriani','127671119668','Laki-laki','','2021-08-02','','BPJS Kesehatan','','08686757','Medan','000018','','dr. Ade Rahmat','','','','','0','',6,'daftar','Datang Sendiri','Sei/Sungai','Air','Asahan','Sumatera','000018','ADM01970215'),('REG/20220402/07','2022-04-02','Maria','','Laki-laki','','2021-07-14','','BPJS Kesehatan','','97969','Medan Maimun','RM000001','','dr. Ade Rahmat','','','','','0','',7,'daftar','Datang Sendiri','','','','','000001','ADM01970215'),('REG/20220402/08','2022-04-02','Riko Syahputra','1271676757','Laki-laki','Medan','1966-06-07','Wiraswasta','BPJS Kesehatan','088883675757','09883757575','Medan','000026','','dr. Ade Rahmat','','','','','A','',8,'daftar','Datang Sendiri','Tembung','Percut Sei Tuan','Deli Serdang','Sumatera Utara','000026','ADM01970215'),('REG/20220402/09','2022-04-02','Arjun Ariyansyah','127867567575','Laki-laki','','1992-06-03','','BPJS Kesehatan','','08676575757','Jatinegara','000022','','dr. Ade Rahmat','','','','','0','',9,'daftar','Datang Sendiri','Jatinegara Kaum','Pulo Gadung','Jakarta Timur','DKI Jakarta','000022','ADM01970215'),('REG/20220402/10','2022-04-02','Syariah','','Perempuan','','2021-07-16','','BPJS Kesehatan','','79696969','Medan','000004','','dr. Ade Rahmat','','','','','0','',10,'daftar','Datang Sendiri','Adian Nangka','Siempat Nempu','Dairi','Sumatera Utara','000004','ADM01970215'),('REG/20220402/11','2022-04-02','Maria','','Laki-laki','','2021-07-14','','BPJS Kesehatan','','97969','Medan Maimun','RM000001','','dr. Ade Rahmat','','','','','0','',11,'daftar','Datang Sendiri','','','','','000001','ADM01970215'),('REG/20220402/12','2022-04-02','Kimono','','Laki-laki','','2021-07-15','','Pribadi','','79686','Medan','000002','','dr. Ade Rahmat','','','','','0','',12,'daftar','Puskesmas','Aek Bamban','Aek Songsongan','Asahan','Sumatera Utara','000002','ADM01970215');
