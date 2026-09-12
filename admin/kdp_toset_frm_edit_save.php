<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

#echo $Rin."<br>";
#echo $Upb."<br>";
#echo $Hri."<br>";
#echo $Bln."<br>";
#echo $Thn."<br>";
$Mem  = str_replace('**',' ',$Mem);
#echo $Mem."<br>";
#echo $IdT;

$gB = date('m'); 
$gT = date('Y'); 

$Tgl = $Thn."-".substr('0'.$Bln,-2,2)."-".substr('0'.$Hri,-2,2);

if ($IdT=='')
{
	$gRF = fGlobalNEW("max(Referensi)","ta_kib_kdptoaset","Referensi","KDPTA%","LIKE","",DatabaseSB,$ConSB,"");
	if ($gRF!="") {$gRF = (int)substr($gRF,-8,8)+1;}
	else {$gRF = 1;}
	$gRF = "KDPTA.".substr("00000000".$gRF,-8,8);
	
	$gNO = fGlobalNEW("max(Nomor)","ta_kib_kdptoaset","Nomor","%/HST/KDPTA/".$gB."/".$gT,"LIKE","",DatabaseSB,$ConSB,"");
	if ($gNO!="") {$gNO = (int)substr($gNO,0,4)+1;}
	else {$gNO = 1;}
	$Nom = substr("000".$gNO,-4,4)."/HST/KDPTA/".$gB."/".$gT;
	
	$SQ = "INSERT INTO ta_kib_kdptoaset SET 
	Referensi='".$gRF."',
	Kd_UPB='".$Upb."',
	Kd_REK='".$Rin."',
	Nomor='".$Nom."',
	Tanggal='".$Tgl."',
	Uraian='".$Mem."',
	Execute='N',
	Recorded=now(),
	Pencatat='".$UID."'";
	$rs = mysql_query($SQ);
	
	$IdT = fGlobalNEW("max(IDT)","ta_kib_kdptoaset","IDT","%","LIKE","",DatabaseSB,$ConSB,"");
}
else
{
	$SQ = "UPDATE ta_kib_kdptoaset SET 
	Nomor='".$Nom."',
	Tanggal='".$Tgl."',
	Uraian='".$Mem."',
	Recorded=now(),
	Pencatat='".$UID."' WHERE IDT='".$IdT."'";
	$rs = mysql_query($SQ);
}
?>

<script language="javascript">
	showKDPTA('refr','<?=$IdT?>','<?=$CrDiv?>','<?=$IdL?>');
</script>