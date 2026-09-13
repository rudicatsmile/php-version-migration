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

<body>
<?php require "FileMenu.php"?>

<?php
$KdUPBa  = "24.00.04.01.06.01";	//Biro Umum 100
$KdUPBb  = "24.00.04.01.09.01";	//Biro Umum 200

//DELETE RECORD KIB D,E
$SQ = "delete from ta_kib_b where Kd_Upb='".$KdUPBb."'";
$rs = mysql_query($SQ) or die(mysql_error());

//$SQ = "delete from ta_kib_e where Kd_Upb='".$KdUPB."'";
//$rs = mysql_query($SQ) or die(mysql_error());		

$SQ = "delete from ta_kib_post where Kd_Upb='".$KdUPBb."' and Kd_Aset like '02%'";
$rs = mysql_query($SQ) or die(mysql_error());		

$SQ = "delete from ta_kib_group where Kd_Upb='".$KdUPBb."' and Kd_Aset like '02%'";
$rs = mysql_query($SQ) or die(mysql_error());		

//INSERT DATA KIB B
$gnSQL= "SELECT * FROM ta_kib_b_100 WHERE Kd_UPB='".$KdUPBa."' order by Referensi";
$gnRs = mysql_query($gnSQL) or die(mysql_error());
$gmRo = mysql_fetch_assoc($gnRs);
$gtRo = mysql_num_rows($gnRs);
if ($gtRo > 0)
{
	do
	{
		$gRef = $gmRo['Referensi'];
		$gAda = fGlobal("IDT","ta_kib_b","Referensi",$gRef,"=","","");
		if ($gAda == "")
		{
			$NewRefKIB = $gRef;
		}
		else
		{
			//MAKE REFERENSI KIB
			$SQL  = "SELECT IFNULL(MAX(Referensi),0) AS LasRef FROM ta_kib_b";
			$nRst = mysql_query($SQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewK = $nRow['LasRef'];
			$NewK = substr($NewK, 5,11);
			$NewK = ((int)$NewK) + 1;
			$NewRefKIB = "ALT.".fMakeReferensi($NewK,11);
		}
		
		$gUpb = $KdUPBb;
		$gRin = $gmRo['Kd_Aset'];
		$gNmB = $gmRo['Nm_Aset'];
		if ($gNmB=="") {$gNmB=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$gRin,"=","","");}
		$ReGB = $gmRo['No_Register'];
		$gMrk = addslashes($gmRo['Merk']);
		$gTyp = addslashes($gmRo['Type']);
		$gUCC = addslashes($gmRo['Ukuran_CC']);
		$gBHN = addslashes($gmRo['Bahan']);
		$gPBR = $gmRo['Nomor_Pabrik'];
		$gRKA = $gmRo['Nomor_Rangka'];
		$gMSN = $gmRo['Nomor_Mesin'];
		$gPLS = $gmRo['Nomor_Polisi'];
		$gBPK = $gmRo['Nomor_BPKB'];
		$gKTR = addslashes($gmRo['Keterangan']);
		$gTgl = $gmRo['Tgl_Perolehan'];
		$gMLK = $gmRo['Kd_Pemilik'];
		$gKND = $gmRo['Kondisi'];
		$gAUS = $gmRo['Asal_Usul'];
		$gMSM = $gmRo['Masa_Manfaat'];
		$gHRG = $gmRo['Harga'];
		
		//INSERT TA-KIB B
		$SQL = "INSERT INTO ta_kib_b SET 
		Referensi='$NewRefKIB',
		Ref_Group='',
		Kd_UPB='$gUpb',
		Kd_Aset='$gRin',
		Nm_Aset='$gNmB',
		No_Register='$ReGB',
		Merk='$gMrk',
		Type='$gTyp',
		Ukuran_CC='$gUCC',
		Bahan='$gBHN',
		Nomor_Pabrik='$gPBR',
		Nomor_Rangka='$gRKA',
		Nomor_Mesin='$gMSN',			
		Nomor_Polisi='$gPLS',
		Nomor_BPKB='$gBPK',
		Keterangan='$gKTR',
		Tgl_Perolehan='$gTgl',
		Kd_Pemilik='$gMLK',
		Kondisi='$gKND',
		Asal_Usul='$gAUS',
		Masa_Manfaat='$gMSM',
		Harga='$gHRG',
		Post='Y'";
		$rst = mysql_query($SQL) or die(mysql_error());
		
		//INSERT TA-KIB-POST
		$SQL = "INSERT INTO ta_kib_post SET 
		Referensi='$NewRefKIB',
		Ref_Group='',
		Kd_UPB='$gUpb',
		Kd_Aset='$gRin',
		No_Register='$ReGB',
		Crit='SLD',
		Tanggal='$gTgl',
		Uraian='Saldo awal (nilai perolehan)',
		DK='D',
		Debet='$gHRG',
		Kredit='0',
		Keterangan='$gKTR',
		Recorded=now(),
		Pencatat='-'";
		$rst = mysql_query($SQL) or die(mysql_error());
	}
	while ($gmRo = mysql_fetch_assoc($gnRs));
}

//INSERT DATA KIB E
/*$gnSQL= "SELECT * FROM ta_kib_e_old WHERE Kd_UPB='".$KdUPB."' order by Referensi";
$gnRs = mysql_query($gnSQL) or die(mysql_error());
$gmRo = mysql_fetch_assoc($gnRs);
$gtRo = mysql_num_rows($gnRs);
if ($gtRo > 0)
{
	do
	{
		$gRef = $gmRo['Referensi'];
		$gAda = fGlobal("IDT","ta_kib_e","Referensi",$gRef,"=","","");
		if ($gAda == "")
		{
			$NewRefKIB = $gRef;
		}
		else
		{
			//MAKE REFERENSI KIB
			$SQL  = "SELECT IFNULL(MAX(Referensi),0) AS LasRef FROM ta_kib_e";
			$nRst = mysql_query($SQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewK = $nRow['LasRef'];
			$NewK = substr($NewK, 5,11);
			$NewK = ((int)$NewK) + 1;
			$NewRefKIB = "ATL.".fMakeReferensi($NewK,11);
		}

		$gUpb = $KdUPB;
		$gRin = $gmRo['Kd_Aset'];
		$gNmB = $gmRo['Nm_Aset'];
		if ($gNmB=="") {$gNmB=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$gRin,"=","","");}
		$ReGB = $gmRo['No_Register'];
		$gJDL = $gmRo['Judul'];
		$gSPE = $gmRo['Spesifikasi'];
		$gPCT = $gmRo['Pencipta'];
		$gADR = $gmRo['Daerah_Asal'];
		$gBHN = $gmRo['Bahan'];
		$gJNS = $gmRo['Jenis'];
		$gUKU = $gmRo['Ukuran'];
		$gTHN = $gmRo['Tahun'];
		$gKTR = $gmRo['Keterangan'];
		$gTgl = $gmRo['Tgl_Perolehan'];
		$gMLK = $gmRo['Kd_Pemilik'];
		$gKND = $gmRo['Kondisi'];
		$gAUS = $gmRo['Asal_Usul'];
		$gMSM = $gmRo['Masa_Manfaat'];
		$gHRG = $gmRo['Harga'];
		
		//INSERT TA-KIB E
		$SQL = "INSERT INTO ta_kib_e SET 
		Referensi='$NewRefKIB',
		Ref_Group='',
		Kd_UPB='$gUpb',
		Kd_Aset='$gRin',
		No_Register='$ReGB',
		Nm_Aset='$gNmB',
		Judul='$gJDL',
		Spesifikasi='$gSPE',
		Pencipta='$gPCT',
		Daerah_Asal='$gADR',
		Bahan='$gBHN',
		Jenis='$gJNS',
		Ukuran='$gUKU',
		Tahun='$gTHN',
		Keterangan='$gKTR',
		Tgl_Perolehan='$gTgl',
		Kd_Pemilik='$gMLK',
		Kondisi='$gKND',
		Asal_Usul='$gAUS',
		Masa_Manfaat='$gMSM',
		Harga='$gHRG',
		Post='Y'";
		$rst = mysql_query($SQL) or die(mysql_error());
		
		//INSERT TA-KIB E POST
		$SQL = "INSERT INTO ta_kib_post SET 
		Referensi='$NewRefKIB',
		Ref_Group='',
		Kd_UPB='$gUpb',
		Kd_Aset='$gRin',
		No_Register='$ReGB',
		Crit='SLD',
		Tanggal='$gTgl',
		Uraian='Saldo awal (nilai perolehan)',
		DK='D',
		Debet='$gHRG',
		Kredit='0',
		Keterangan='$gKTR',
		Recorded=now(),
		Pencatat='-'";
		$rst = mysql_query($SQL) or die(mysql_error());
	}
	while ($gmRo = mysql_fetch_assoc($gnRs));
}
*/
?>
</body>
</html>

<?php require('Connection_Close.php');?>
