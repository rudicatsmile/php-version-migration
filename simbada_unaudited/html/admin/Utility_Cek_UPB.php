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
<?
$gnSQL= "SELECT Kd_UPB, IfNull(sum(Harga),0) AS Jumlah FROM ta_kib_b group by Kd_UPB ORDER BY Kd_UPB";
$gnRs = mysql_query($gnSQL) or die(mysql_error());
$gmRo = mysql_fetch_assoc($gnRs);
$gtRo = mysql_num_rows($gnRs);
if ($gtRo > 0)
{
	do
	{
		$gNma = fGlobal("Nm_UPB","Ref_Upb","Kd_UPB",$gmRo['Kd_UPB'],"=","","");
		if ($gNma =="" )
		{
			$nKD = $gmRo['Kd_UPB'];
			$nSQ= "INSERT INTO ref_upb set Kd_UPB='$nKD', Nm_UPB='???????? --> UPB di Simda tidak ada'";
			$nRs = mysql_query($nSQ) or die(mysql_error());
		}
		echo $gmRo['Kd_UPB']." : ".$gmRo['Jumlah']." --> ".$gNma."<br>";
	}
	while ($gmRo = mysql_fetch_assoc($gnRs));	
}
?>
</body>
</html>

<?php require('Connection_Close.php');?>
