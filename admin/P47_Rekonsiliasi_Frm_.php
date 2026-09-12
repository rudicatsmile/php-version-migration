<?php
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";

extract($_GET);
extract($_POST);

$gSmp   = $_POST['CrSaveData']; 
$gID    = $_GET['gID']; 
$model  = $_GET['model']; 

$f02 = $f02c."-".substr('00'.$f02b,-2,2)."-".substr('00'.$f02a,-2,2); 
$f02x= $f02cx."-".substr('00'.$f02bx,-2,2)."-".substr('00'.$f02ax,-2,2); 
if ($gSmp=="Save") 
{
	if ($gID=="") 
    {
		#PIHAK I : 
		if ($f03v=='V1' || $f03v=='V2' || $f03v=='V3')
		{
			#Pengurus Barang Pengguna
			$fP1Nma  = fGlobal("Nm_Pengurus","ref_unit","Kd_Unit",$fUNT,"=","","");
			$fP1Nip  = fGlobal("Nip_Pengurus","ref_unit","Kd_Unit",$fUNT,"=","","");
			$fP1Pkt  = fGlobal("Pkt_Pengurus","ref_unit","Kd_Unit",$fUNT,"=","","");
			$fP1Jab  = fGlobal("Jbt_Pengurus","ref_unit","Kd_Unit",$fUNT,"=","","");
		}
		else if ($f03v=='V4')
		{
			#Pengurus Barang Pengelola (Setda)
			$eUNT = "24.04.04.01";
			$fP1Nma  = fGlobal("Nm_Pengurus","ref_unit","Kd_Unit",$eUNT,"=","","");
			$fP1Nip  = fGlobal("Nip_Pengurus","ref_unit","Kd_Unit",$eUNT,"=","","");
			$fP1Pkt  = fGlobal("Pkt_Pengurus","ref_unit","Kd_Unit",$eUNT,"=","","");
			$fP1Jab  = fGlobal("Jbt_Pengurus","ref_unit","Kd_Unit",$eUNT,"=","","");
		}
		
		#PIHAK II : 
		if ($f03v=='V1')
		{
			#Penyimpan Barang Pengguna
			$fP2Nma  = fGlobal("Nm_Penyimpan","ref_unit","Kd_Unit",$fUNT,"=","","");
			$fP2Nip  = fGlobal("Nip_Penyimpan","ref_unit","Kd_Unit",$fUNT,"=","","");
			$fP2Pkt  = fGlobal("Pkt_Penyimpan","ref_unit","Kd_Unit",$fUNT,"=","","");
			$fP2Jab  = fGlobal("Jbt_Penyimpan","ref_unit","Kd_Unit",$fUNT,"=","","");
		}
		else if ($f03v=='V2')
		{
			#Pengurus Barang Pengelola (Setda)
			$eUNT = "24.04.04.01";
			$fP2Nma  = fGlobal("Nm_Pengurus","ref_unit","Kd_Unit",$eUNT,"=","","");
			$fP2Nip  = fGlobal("Nip_Pengurus","ref_unit","Kd_Unit",$eUNT,"=","","");
			$fP2Pkt  = fGlobal("Pkt_Pengurus","ref_unit","Kd_Unit",$eUNT,"=","","");
			$fP2Jab  = fGlobal("Jbt_Pengurus","ref_unit","Kd_Unit",$eUNT,"=","","");
		}
		else if ($f03v=='V3')
		{
			#Pelaksana Akuntansi SKPD
			$fP2Nma  = fGlobal("Nm_Akuntan","ref_unit","Kd_Unit",$fUNT,"=","","");
			$fP2Nip  = fGlobal("Nip_Akuntan","ref_unit","Kd_Unit",$fUNT,"=","","");
			$fP2Pkt  = fGlobal("Pkt_Akuntan","ref_unit","Kd_Unit",$fUNT,"=","","");
			$fP2Jab  = fGlobal("Jbt_Akuntan","ref_unit","Kd_Unit",$fUNT,"=","","");
		}
		else if ($f03v=='V4')
		{
			#Pelaksana Akuntansi Pengelola (Setda)
			$eUNT = "24.04.04.01";
			$fP2Nma  = fGlobal("Nm_Akuntan","ref_unit","Kd_Unit",$eUNT,"=","","");
			$fP2Nip  = fGlobal("Nip_Akuntan","ref_unit","Kd_Unit",$eUNT,"=","","");
			$fP2Pkt  = fGlobal("Pkt_Akuntan","ref_unit","Kd_Unit",$eUNT,"=","","");
			$fP2Jab  = fGlobal("Jbt_Akuntan","ref_unit","Kd_Unit",$eUNT,"=","","");
		}
	
        $gNO = fGlobal("Max(Nomor)","tb_rekonsiliasi","Nomor","%/RKO/".substr("00".date('m'),-2,2)."/".date('Y'),"LIKE","",""); 
        if ($gNO!="") {$gNO = (int)substr($gNO,0,5)+1;} 
        else {$gNO = 1;} 
        $gNO = substr("0000000".$gNO,-5,5)."/RKO/".substr("00".date('m'),-2,2)."/".date('Y'); 
		
		
        $SQ = "INSERT INTO tb_rekonsiliasi SET  
        KdSkpd='".$fUNT."',
        Nomor='".$gNO."',
        Tanggal='".$f02."',
		Tanggal_BMD='".$f02x."',
        Model='".$f03v."',
		PI_Nama='".$fP1Nma."',
		PI_Nip='".$fP1Nip."',
		PI_PangkatGol='".$fP1Pkt."',
		PI_Jabatan='".$fP1Jab."',
		PII_Nama='".$fP2Nma."',
		PII_Nip='".$fP2Nip."',
		PII_PangkatGol='".$fP2Pkt."',
		PII_Jabatan='".$fP2Jab."',
        Recorded=now(),
        Pencatat='$gUser'";
		#echo $SQ;
        mysql_query($SQ);

        $gID = fGlobal("Max(IDT)","tb_rekonsiliasi","Nomor","%","LIKE","",""); 
        $MsG = 10; 
    }
    else
    { 
		$SQ = "UPDATE tb_rekonsiliasi SET  
        Tanggal='".$f02."',
		Tanggal_BMD='".$f02x."',
		PI_Nama='".$fP1Nma."',
		PI_Nip='".$fP1Nip."',
		PI_PangkatGol='".$fP1Pkt."',
		PI_Jabatan='".$fP1Jab."',
		PII_Nama='".$fP2Nma."',
		PII_Nip='".$fP2Nip."',
		PII_PangkatGol='".$fP2Pkt."',
		PII_Jabatan='".$fP2Jab."',
		Recorded=now(),
		Pencatat='$gUser' WHERE IDT='$gID'"; 
		echo $SQ;
		mysql_query($SQ);
		
		$MsG = 10; 
    } 
	$URL="P47_Rekonsiliasi_Frm.php?gID=".$gID."&model=".$model."&FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
else
{
	$URL="P47_Rekonsiliasi_Frm.php?model=".$model."&FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
?>
