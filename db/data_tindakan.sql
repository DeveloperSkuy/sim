# Host: localhost  (Version 5.5.5-10.1.19-MariaDB)
# Date: 2022-04-17 10:25:55
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "data_tindakan"
#

DROP TABLE IF EXISTS `data_tindakan`;
CREATE TABLE `data_tindakan` (
  `kd_tindakan` varchar(20) NOT NULL DEFAULT '',
  `nama_tindakan` varchar(50) NOT NULL,
  `harga_tindakan` int(11) NOT NULL,
  `persen` int(11) NOT NULL DEFAULT '0',
  `jasa_dokter` int(11) NOT NULL DEFAULT '0',
  `tgl_input` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`kd_tindakan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "data_tindakan"
#

INSERT INTO `data_tindakan` VALUES ('TDK005','Heacting12',20000,0,0,'2022-04-02'),('TDK006','Suntik',20000,0,0,'2022-04-02'),('TDK007','ada',11,0,0,'2022-04-02'),('TDK008','Data',1000,0,0,'2022-04-02'),('TDK017','ada',10000,0,0,'2022-04-03'),('TDK018','Heacting',20000,80,16000,'2022-04-16'),('TDK019','Jasa Dokter',20000,100,20000,'2022-04-16'),('TDK020','Bedah',50000,75,37500,'2022-04-16');
