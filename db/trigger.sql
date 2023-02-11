
DROP TRIGGER IF EXISTS `Racik1`;
CREATE TRIGGER `Racik1` BEFORE UPDATE ON `tbl_nama_racikandetail` FOR EACH ROW BEGIN
   UPDATE tbl_dataobat SET tbl_dataobat.stk_obat = tbl_dataobat.stk_obat - new.stokini
   WHERE tbl_dataobat.kd_obat = new.kd_obat;
END;

#
# Trigger "Racik2"
#

DROP TRIGGER IF EXISTS `Racik2`;
CREATE TRIGGER `Racik2` AFTER UPDATE ON `tbl_nama_racikandetail` FOR EACH ROW bEGIN
   UPDATE tbl_dataobat SET tbl_dataobat.stk_obat = tbl_dataobat.stk_obat + old.stokini
   WHERE tbl_dataobat.kd_obat = old.kd_obat;
END;

#
# Trigger "Returan1"
#

DROP TRIGGER IF EXISTS `Returan1`;
CREATE TRIGGER `Returan1` BEFORE UPDATE ON `tbl_pengobatandetail` FOR EACH ROW BEGIN
   UPDATE tbl_dataobat SET tbl_dataobat.stk_obat = tbl_dataobat.stk_obat - new.jml_jual
   WHERE tbl_dataobat.kd_obat = new.kd_obat;
END;

#
# Trigger "returan2"
#

DROP TRIGGER IF EXISTS `returan2`;
CREATE TRIGGER `returan2` AFTER UPDATE ON `tbl_pengobatandetail` FOR EACH ROW bEGIN
   UPDATE tbl_dataobat SET tbl_dataobat.stk_obat = tbl_dataobat.stk_obat + old.jml_jual
   WHERE tbl_dataobat.kd_obat = old.kd_obat;
END;
