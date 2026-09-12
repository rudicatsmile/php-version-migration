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

//REPAIR REK. ASET
$gnSQL= "SELECT * FROM ".$NmTBL." WHERE Proses='N' order by IDT limit 100";
$gnRs = mysql_query($gnSQL) or die(mysql_error());
$gmRo = mysql_fetch_assoc($gnRs);
$gtRo = mysql_num_rows($gnRs);
if ($gtRo > 0)
{
	do
	{
		echo $gmRo['IDT']."<br>";
		$NewRefGrp ="";
		$NewReGAset="";
		$gUpb = "24.00.15.01.01.01";		//KODE BAPPEDA
		
		$gRin = $gmRo['Kode'];
		$gSTN = $gmRo['Register'];
		$gTTL = $gmRo['Harga'];
		$gNmB = $gmRo['Nm_Aset'];
		$gMrk = $gmRo['Merk_Type'];
		$gTyp = "";
		$gUCC = $gmRo['Ukuran_CC'];
		$gBHN = $gmRo['Bahan'];
		$gPBR = $gmRo['No_Pabrik'];
		$gRKA = $gmRo['No_Rangka'];
		$gMSN = $gmRo['No_Mesin'];
		$gPLS = $gmRo['No_Polisi'];
		$gBPK = $gmRo['No_BPKB'];
		$gKTR = $gmRo['Keterangan'];
		$gTgl = $gmRo['Tahun']."-10-15";
		$gMLK = "11";
		$gKND = "B";
		$gAUS = "Pembelian";
		$gMSM = 0;
		
		if ($gSTN > 1)		//MODUL ENTRY GROUP
		{
			//CARI REGISTER RERAKHIR BARANG DI TABEL KIB
			$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_b WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
			$nRst = mysql_query($nSQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewG = $nRow['LasReG'];
			$LastReGrp = ((int)$NewG) + 1;
			$NewReGrp  = ($LastReGrp + $gSTN)-1;
			
			//MAKE REFERENSI GROUP
			$nSQL = "SELECT IFNULL(MAX(Referensi),0) AS LasRef FROM ta_kib_group";
			$nRst = mysql_query($nSQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewK = $nRow['LasRef'];
			$NewK = substr($NewK, 5,11);
			$NewK = ((int)$NewK) + 1;
			$NewRefGrp = "GRP.".fMakeReferensi($NewK,11);
			
			//INSERT
			$SQL = "INSERT INTO ta_kib_group SET 
			Referensi='$NewRefGrp',
			Kd_UPB='$gUpb',
			Kd_Aset='$gRin',
			Jml_Item='$gSTN',
			Nilai_Total='$gTTL',
			RegFrom='$LastReGrp',
			RegTo='$NewReGrp'";
			$rst = mysql_query($SQL) or die(mysql_error());
			
			$gHRG = $gTTL / $gSTN;
			for($iG=$LastReGrp; $iG<=$NewReGrp; $iG++)
			{
				$NewReGAset = fMakeRegister($iG,7);
				require "Insert_KIB_B.php";
			}
		}
		else		//MODUL SINGLE ENTRY
		{
			//CARI REGISTER RERAKHIR BARANG DI TABEL KIB
			$nSQL = "SELECT IFNULL(MAX(No_Register),0) as LasReG FROM ta_kib_b WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
			$nRst = mysql_query($nSQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewG = $nRow['LasReG'];
			$LastReG = ((int)$NewG) + 1;
			$NewReGAset = fMakeRegister($LastReG,7);
			
			//HARGA ARAHKAN LANGSUNG KE NILAI PEROLEHAN
			$gHRG = $gTTL;
			
			//LIBATKAN FILE INSERT BARU	
			require "Insert_KIB_B.php";
		}
		
		//UPDATE Proses
		$SQ = "update ".$NmTBL." set Proses='Y' where IDT='".$gmRo['IDT']."'";
		$rs = mysql_query($SQ) or die(mysql_error());		
		echo $SQ."<br>";
	}
	while ($gmRo = mysql_fetch_assoc($gnRs));	
}
*/
?>
</body>
</html>

<?php require('Connection_Close.php');?>
