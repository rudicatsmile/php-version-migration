<?php
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
require("CheckLogin.php");
extract($_POST);
extract($_GET);
if ($fSave=='Save')
{
	$fNIL = fConvertToNumeric($fNIL);
	if ($IdT)
	{
		$gTBL = "ta_sp3d_saldo_awal";
		$gDTA = "";
		$gDTA.= "Kd_UPB='".$fUPB."'";
		$gDTA.= ", Tahun='".$fTH."'";
		$gDTA.= ", KdJenis='".$fJNS."'";
		$gDTA.= ", Nilai='".$fNIL."'";
		$gDTA.= ", Uraian='".mysql_real_escape_string($fURA)."'";
		$gIdX = 'IDT';
		$gSyR = $IdT;
		$gOpR = '=';
		UpdateGLOBAL($gTBL,$gDTA,$gIdX,$gSyR,$gOpR,DatabaseSB,$ConSB);
	}
	else
	{
		$gTBL = "ta_sp3d_saldo_awal";
		$gFLD = "";
		$gVAL = "";
		
		$gFLD = "Kd_UPB";
		$gVAL = "'$fUPB'";
		
		$gFLD.= ", Tahun";
		$gVAL.= ", '$fTH'";
		
		$gFLD.= ", KdJenis";
		$gVAL.= ", '$fJNS'";
		
		$gFLD.= ", KdTahap";
		$gVAL.= ", '1'";
		
		$gFLD.= ", Nilai";
		$gVAL.= ", '$fNIL'";
		
		$gFLD.= ", Uraian";
		$gVAL.= ", '".mysql_real_escape_string($fURA)."'";
		
		$gFLD.= ", Pencatat";
		$gVAL.= ", '".$UID."'";
		$gFLD.= ", Recorded";
		$gVAL.= ", now()";
		
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
		
		$IdT = fGlobal("max(IDT)","ta_sp3d_saldo_awal","Kd_UPB:KdTahap",$fUPB.":1","=:=","","");
	}
	$URL="SP3D_Saldo_Awal_Frm.php?IdT=".$IdT."&FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
else if ($fSave=='Reset'){
	$URL="SP3D_Saldo_Awal_Frm.php?FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
else
{
	$IdT = fGlobal("IDT","ta_sp3d_saldo_awal","Kd_UPB:KdJenis:KdTahap:Tahun",$fUPB.":".$fJNS.":1:".$fTH,"=:=:=:=","","");
	$URL="SP3D_Saldo_Awal_Frm.php?IdT=".$IdT."&FrmG=".$FrmG."&gUPB=".$fUPB."&fJNS=".$fJNS."&fTH=".$fTH."&IdL=".$IdL;
	header("Location: ".$URL);
}
?>