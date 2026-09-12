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

<body>
<?php require "FileMenu.php"?>
<?php
/*
$NmTBL = "bappeda_kib_b";
$nSQL= "delete from ta_kib_b where Kd_UPB='24.00.15.01.01.01'";
$nRs = mysql_query($nSQL) or die(mysql_error());

$nSQL= "delete from ta_kib_post where referensi like 'ALT%' and Kd_UPB='24.00.15.01.01.01'";
$nRs = mysql_query($nSQL) or die(mysql_error());

$nSQL= "delete from ta_kib_group where Kd_Aset like '02%' and Kd_UPB='24.00.15.01.01.01'";
$nRs = mysql_query($nSQL) or die(mysql_error());

$nSQL= "update bappeda_kib_b set proses='N'";
$nRs = mysql_query($nSQL) or die(mysql_error());
*/
?>
</body>
</html>

<?php require('Connection_Close.php');?>
