<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
if (isset($_POST['fThn'])) {$gThn  = $_POST['fThn'];}
if (isset($_REQUEST['gThn'])) {$gThn  = $_REQUEST['gThn'];}
if ($gThn=="") {$gThn  = fGetDate('year');}
?>
<body>
<?php require "FileMenu.php";?>
<?php
$SQL="ALTER TABLE `ta_kib_a` ADD COLUMN `Status` varchar(20) NULL DEFAULT '' AFTER `Post`";
//$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_b` ADD COLUMN `Status` varchar(20) NULL DEFAULT '' AFTER `Post`";
//$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_c` ADD COLUMN `Status` varchar(20) NULL DEFAULT '' AFTER `Post`";
//$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_d` ADD COLUMN `Status` varchar(20) NULL DEFAULT '' AFTER `Post`";
//$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_e` ADD COLUMN `Status` varchar(20) NULL DEFAULT '' AFTER `Post`";
//$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_f` ADD COLUMN `Status` varchar(20) NULL DEFAULT '' AFTER `Post`";
//$rs = mysql_query($SQL) or die(mysql_error());

//PENGHAPUSAN USULAN
$SQL="CREATE TABLE `ta_penghapusan_usulan` (
  `IDT` int(11) NOT NULL AUTO_INCREMENT,
  `Referensi` varchar(15) DEFAULT '',
  `Kd_UPB` varchar(17) DEFAULT '',
  `Tahun` smallint(4) DEFAULT NULL,
  `Nomor` varchar(50) DEFAULT NULL,
  `Tanggal` datetime DEFAULT NULL,
  `Nm_Pggna_Barang` varchar(150) DEFAULT '',
  `Jab_Pggna_Barang` varchar(100) DEFAULT '',
  `Nip_Pggna_Barang` varchar(35) DEFAULT NULL,
  `Keterangan` varchar(255) DEFAULT NULL,
  `Status` varchar(20) DEFAULT '',
  `No_SK` varchar(50) DEFAULT '',
  `Tgl_SK` date DEFAULT '0000-00-00',
  `Catatan_Stat` text,
  `Eksekusi` enum('Y','N') NOT NULL DEFAULT 'N',
  `Recorded_Stat` datetime DEFAULT '0000-00-00 00:00:00',
  `Pencatat_Stat` varchar(30) DEFAULT '',
  `Recorded` datetime DEFAULT '0000-00-00 00:00:00',
  `Pencatat` varchar(30) DEFAULT '',
  PRIMARY KEY (`IDT`),
  KEY `Tahun` (`Tahun`),
  KEY `Referensi` (`Referensi`),
  KEY `Kd_UPB` (`Kd_UPB`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC";
//$rs = mysql_query($SQL) or die(mysql_error());

//PENGHAPUSAN USULAN RINC
$SQL="CREATE TABLE `ta_penghapusan_usulan_rinc` (
  `IDT` int(11) NOT NULL AUTO_INCREMENT,
  `ID` varchar(11) DEFAULT '',
  `KIB` char(1) DEFAULT '',
  `Referensi` varchar(15) DEFAULT '',
  `Ref_Aset` varchar(15) DEFAULT '',
  `Ref_Group` varchar(15) DEFAULT '',
  `Kd_UPB` varchar(17) DEFAULT '',
  `Kd_Aset` varchar(15) DEFAULT '',
  `Nm_Aset` varchar(150) DEFAULT '',
  `Uraian` varchar(255) DEFAULT '',
  `No_Register` varchar(7) DEFAULT '',
  `Kd_Pemilik` varchar(2) DEFAULT NULL,
  `Tgl_Perolehan` date DEFAULT NULL,
  `Kondisi` varchar(20) DEFAULT NULL,
  `Alasan` varchar(255) DEFAULT NULL,
  `Keterangan` varchar(255) DEFAULT NULL,
  `Nilai` double(19,2) NOT NULL DEFAULT '0.00',
  `Eksekusi` enum('Y','N') DEFAULT 'N',
  `Recorded` datetime DEFAULT '0000-00-00 00:00:00',
  `Pencatat` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`IDT`),
  KEY `ID` (`ID`),
  KEY `KIB` (`KIB`),
  KEY `Referensi` (`Referensi`),
  KEY `Ref_Aset` (`Ref_Aset`),
  KEY `Kd_UPB` (`Kd_UPB`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC";
//$rs = mysql_query($SQL) or die(mysql_error());

//PENGHAPUSAN NEW
$SQL="CREATE TABLE `ta_penghapusan_new` (
  `IDT` int(11) NOT NULL AUTO_INCREMENT,
  `Referensi` varchar(15) DEFAULT '',
  `Tahun` smallint(6) DEFAULT NULL,
  `No_SK` varchar(50) DEFAULT NULL,
  `Tgl_SK` datetime DEFAULT NULL,
  `Keterangan` varchar(255) DEFAULT NULL,
  `Recorded` datetime DEFAULT '0000-00-00 00:00:00',
  `Pencatat` varchar(30) DEFAULT '',
  PRIMARY KEY (`IDT`),
  KEY `Tahun` (`Tahun`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1";
//$rs = mysql_query($SQL) or die(mysql_error());

//PENGHAPUSAN NEW RINC
$SQL="CREATE TABLE `ta_penghapusan_rinc_new` (
  `IDT` int(11) NOT NULL AUTO_INCREMENT,
  `Tahun` smallint(6) DEFAULT NULL,
  `Ref_Usulan` varchar(15) DEFAULT NULL,
  `Ref_Aset` varchar(15) DEFAULT '',
  `Ref_Group` varchar(15) DEFAULT '',
  `No_SK` varchar(50) DEFAULT NULL,
  `Tg_SK` date DEFAULT '0000-00-00',
  `No_ID` smallint(6) DEFAULT NULL,
  `Kd_UPB` varchar(17) DEFAULT '',
  `Kd_Aset` varchar(15) DEFAULT '',
  `Nm_Aset` varchar(150) DEFAULT '',
  `Nilai` double(19,2) DEFAULT '0.00',
  `No_Register` varchar(7) DEFAULT '',
  `Kd_Pemilik` varchar(2) DEFAULT NULL,
  `Tgl_Perolehan` date DEFAULT NULL,
  `Kondisi` varchar(20) DEFAULT NULL,
  `Alasan` varchar(255) DEFAULT NULL,
  `Keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IDT`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1";
//$rs = mysql_query($SQL) or die(mysql_error());
?>
</body>
</html>
