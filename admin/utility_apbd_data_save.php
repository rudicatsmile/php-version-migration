<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$nma = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$val,"=","",$DatabaseSA,$ConSA,""); 
$old = fGlobal("kdUnit","ta_apbd_rekening_skpd","idSubUnit:periode:apbd",$SuB.":".$ThN.":".$ApB,"=:=:=","IDT LIMIT 0,1",$DatabaseSA,$ConSA,""); 

#DELETE DI SKPD LAMA
$nSQ="DELETE FROM ta_apbd_program_skpd WHERE kdUnit='".$old."' AND periode='".$ThN."' AND apbd='".$ApB."'";
mysql_query($nSQ);

$nSQ="DELETE FROM ta_apbd_kegiatan_skpd WHERE kdUnit='".$old."' AND periode='".$ThN."' AND apbd='".$ApB."'";
mysql_query($nSQ);

$nSQ="DELETE FROM ta_apbd_kegiatan_sub_skpd WHERE kdUnit='".$old."' AND periode='".$ThN."' AND apbd='".$ApB."'";
mysql_query($nSQ);

#UPDATE APBD REKENING
$SQ="UPDATE ta_apbd_rekening_skpd SET 
kdUnit='".$val."', nmopd='".$nma."' 
WHERE kdUnit<>'".$val."' AND idSubUnit='".$SuB."' AND periode='".$ThN."' AND apbd='".$ApB."'";
mysql_query($SQ);

#PROGRAM
$nSQ="SELECT idProgram, nmProgram 
FROM ta_apbd_rekening_skpd
WHERE kdUnit='".$val."' AND periode='".$ThN."' AND apbd='".$ApB."' GROUP BY idProgram";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$ck = fGlobal("idt","ta_apbd_program_skpd","kdUnit:idProgram:periode:apbd",$val.":".$mRo[0].":".$ThN.":".$ApB,"=:=:=:=","",$DatabaseSA,$ConSA,"");
	if ($ck=='')
	{
		$SQ="INSERT INTO ta_apbd_program_skpd SET 
		kdUnit='".$val."',
		idProgram='".$mRo[0]."',
		nmProgram='".$mRo[1]."',
		periode='".$ThN."',
		apbd='".$ApB."'";
		mysql_query($SQ);
	}
}

#KEGIATAN
$nSQ="SELECT idKegiatan, nmKegiatan 
FROM ta_apbd_rekening_skpd
WHERE kdUnit='".$val."' AND periode='".$ThN."' AND apbd='".$ApB."' GROUP BY idKegiatan";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$ck = fGlobal("idt","ta_apbd_kegiatan_skpd","kdUnit:idKegiatan:periode:apbd",$val.":".$mRo[0].":".$ThN.":".$ApB,"=:=:=:=","",$DatabaseSA,$ConSA,"");
	if ($ck=='')
	{
		$SQ="INSERT INTO ta_apbd_kegiatan_skpd SET 
		kdUnit='".$val."',
		idProgram='".substr($mRo[0],0,7)."',
		idKegiatan='".$mRo[0]."',
		nmKegiatan='".$mRo[1]."',
		periode='".$ThN."',
		apbd='".$ApB."'";
		mysql_query($SQ);
	}
}

#SUB KEGIATAN
$nSQ="SELECT idSubKegiatan, nmSubKegiatan 
FROM ta_apbd_rekening_skpd
WHERE kdUnit='".$val."' AND periode='".$ThN."' AND apbd='".$ApB."' GROUP BY idSubKegiatan";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$ck = fGlobal("idt","ta_apbd_kegiatan_sub_skpd","kdUnit:idSubKegiatan:periode:apbd",$val.":".$mRo[0].":".$ThN.":".$ApB,"=:=:=:=","",$DatabaseSA,$ConSA,"");
	if ($ck=='')
	{
		$SQ="INSERT INTO ta_apbd_kegiatan_sub_skpd SET 
		kdUnit='".$val."',
		idKegiatan='".substr($mRo[0],0,12)."',
		idSubKegiatan='".$mRo[0]."',
		nmSubKegiatan='".$mRo[1]."',
		periode='".$ThN."',
		apbd='".$ApB."'";
		mysql_query($SQ);
	}
}
?>
<script languange="javascript">
Btn1.click();
</script>