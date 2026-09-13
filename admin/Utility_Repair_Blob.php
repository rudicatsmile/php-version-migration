<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
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
//A
$SQL="ALTER TABLE `ta_kib_a` ADD COLUMN `file_content` longblob NULL";
//$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_a` ADD COLUMN `file_name` varchar(100) NULL DEFAULT '';";
//$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_a` ADD COLUMN `file_type` varchar(100) NULL DEFAULT ''";
//$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_a` ADD COLUMN `file_size` int(11) NULL DEFAULT 0";
//$rs = mysql_query($SQL) or die(mysql_error());

//B
$SQL="ALTER TABLE `ta_kib_b` ADD COLUMN `file_content` longblob NULL";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_b` ADD COLUMN `file_name` varchar(100) NULL DEFAULT '';";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_b` ADD COLUMN `file_type` varchar(100) NULL DEFAULT ''";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_b` ADD COLUMN `file_size` int(11) NULL DEFAULT 0";
$rs = mysql_query($SQL) or die(mysql_error());

//C
$SQL="ALTER TABLE `ta_kib_c` ADD COLUMN `file_content` longblob NULL";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_c` ADD COLUMN `file_name` varchar(100) NULL DEFAULT '';";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_c` ADD COLUMN `file_type` varchar(100) NULL DEFAULT ''";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_c` ADD COLUMN `file_size` int(11) NULL DEFAULT 0";
$rs = mysql_query($SQL) or die(mysql_error());

//D
$SQL="ALTER TABLE `ta_kib_d` ADD COLUMN `file_content` longblob NULL";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_d` ADD COLUMN `file_name` varchar(100) NULL DEFAULT '';";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_d` ADD COLUMN `file_type` varchar(100) NULL DEFAULT ''";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_d` ADD COLUMN `file_size` int(11) NULL DEFAULT 0";
$rs = mysql_query($SQL) or die(mysql_error());

//E
$SQL="ALTER TABLE `ta_kib_e` ADD COLUMN `file_content` longblob NULL";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_e` ADD COLUMN `file_name` varchar(100) NULL DEFAULT '';";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_e` ADD COLUMN `file_type` varchar(100) NULL DEFAULT ''";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_e` ADD COLUMN `file_size` int(11) NULL DEFAULT 0";
$rs = mysql_query($SQL) or die(mysql_error());

//F
$SQL="ALTER TABLE `ta_kib_f` ADD COLUMN `file_content` longblob NULL";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_f` ADD COLUMN `file_name` varchar(100) NULL DEFAULT '';";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_f` ADD COLUMN `file_type` varchar(100) NULL DEFAULT ''";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_f` ADD COLUMN `file_size` int(11) NULL DEFAULT 0";
$rs = mysql_query($SQL) or die(mysql_error());

//G
$SQL="ALTER TABLE `ta_kib_g` ADD COLUMN `file_content` longblob NULL";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_g` ADD COLUMN `file_name` varchar(100) NULL DEFAULT '';";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_g` ADD COLUMN `file_type` varchar(100) NULL DEFAULT ''";
$rs = mysql_query($SQL) or die(mysql_error());

$SQL="ALTER TABLE `ta_kib_g` ADD COLUMN `file_size` int(11) NULL DEFAULT 0";
$rs = mysql_query($SQL) or die(mysql_error());
?>
</body>
</html>
