<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<?
ini_set('max_execution_time', 300);
?>
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
$gUID = fFindUID($_REQUEST['IdL'],"User_ID");

fRekaMutasi();
function fRekaMutasi()
{
	$gnSQL= "SELECT Kd_UPB, Kd_Aset, SUBSTR(Tanggal,1,4) as Tahun, 
	count(*) as JmlR, IFNULL(SUM(Debet),0) as Debet, IFNULL(SUM(Kredit),0) as Kredit from ta_kib_post  
	GROUP BY Kd_UPB, SUBSTR(Tanggal,1,4), Kd_Aset";
	$gnRs = mysql_query($gnSQL) or die(mysql_error());
	$gmRo = mysql_fetch_assoc($gnRs);
	$gtRo = mysql_num_rows($gnRs);
	if ($gtRo > 0)
	{
		do
		{
			$gUPB = $gmRo['Kd_UPB'];
			$gAST = $gmRo['Kd_Aset'];
			$gTHN = $gmRo['Tahun'];
			$gHRD = $gmRo['Debet'];
			$gHRK = $gmRo['Kredit'];
			$gITM = $gmRo['JmlR'];
			$gIDT = fGlobal("IDT","Ta_Rekap_Mutasi","Kd_UPB:Kd_Aset:Tahun",$gUPB.":".$gAST.":".$gTHN,"=:=:=","Kd_UPB,Kd_Aset,Tahun","");
			if ($gIDT=="")
			{
				$nSQ = "INSERT INTO ta_rekap_mutasi set 
				Kd_UPB='$gUPB', 
				Kd_Aset='$gAST', 
				Tahun='$gTHN', 
				Total_Item_D='$gITM', 
				Total_Item_K='0', 
				Total_Harga_D='$gHRD',
				Total_Harga_K='$gHRK',
				Recorded=now(),
				Pencatat='$gUID'";
				$nRs = mysql_query($nSQ) or die(mysql_error());
			}
			else
			{
				$nSQ = "UPDATE ta_rekap_mutasi set 
				Total_Item_D='$gITM', 
				Total_Item_K='0', 
				Total_Harga_D='$gHRD',
				Total_Harga_K='$gHRK',
				Recorded=now(),
				Pencatat='$gUID' WHERE IDT='".$gIDT."'";
				$nRs = mysql_query($nSQ) or die(mysql_error());
			}
		}
		while ($gmRo = mysql_fetch_assoc($gnRs));	
	}
}

echo "DONE...!!";
?>
</body>
</html>

<?php require('Connection_Close.php');?>
