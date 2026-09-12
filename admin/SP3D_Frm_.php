<?php
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
require("CheckLogin.php");
extract($_POST);
extract($_GET);
if ($fSave=='Save')
{
	$gTGL = $fTH."-".$fBL."-".$fHR;
	if ($IdT)
	{
		$gTBL = "ta_sp3d";
		$gDTA = "";
		$gDTA = "Tgl_SP3D='".$gTGL."' ";
		$gDTA.= ", Kd_UPB='".$fUPB."'";
		$gDTA.= ", Nom_SP3D='".$fNO."'";
		
		$gCNT = fGlobal("IfNull(count(*),0)","ta_sp3d_rinci","Referensi",$fREF,"=","","");
		if ($gCNT==0){
			$gDTA.= ", KdSesi='".$fSES."'";
			$gDTA.= ", KdJenis='".$fJNS."'";
		}
		$gDTA.= ", Uraian='".mysql_real_escape_string($fURA)."'";
		$gIdX = 'IDT';
		$gSyR = $IdT;
		$gOpR = '=';
		UpdateGLOBAL($gTBL,$gDTA,$gIdX,$gSyR,$gOpR,DatabaseSB,$ConSB);
	}
	else
	{
		$gNeW = 1;
		$rMax = fGlobal("max(Referensi)","ta_sp3d","Referensi","SP3.".fGetDate('year')."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = (int)substr($rMax,-8,8)+1;
		}
		$gREF = "SP3.".fGetDate('year').".".substr(str_repeat('0',8).$gNeW,-8,8);
		
		$gTBL = "ta_sp3d";
		$gFLD = "";
		$gVAL = "";
		$gFLD = "Referensi";
		$gVAL = "'$gREF'";
		$gFLD.= ", Kd_UPB";
		$gVAL.= ", '$fUPB'";
		$gFLD.= ", KdSesi";
		$gVAL.= ", '$fSES'";
		$gFLD.= ", KdJenis";
		$gVAL.= ", '$fJNS'";
		$gFLD.= ", Tahun";
		$gVAL.= ", '$fTH'";
		$gFLD.= ", Nom_SP3D";
		$gVAL.= ", '$fNO'";
		$gFLD.= ", Tgl_SP3D";
		$gVAL.= ", '$gTGL'";
		$gFLD.= ", Uraian";
		$gVAL.= ", '".mysql_real_escape_string($fURA)."'";
		$gFLD.= ", Pencatat";
		$gVAL.= ", '".$UID."'";
		
		$gFLD.= ", Recorded";
		$gVAL.= ", now()";
		
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
		
		$IdT = fGlobal("max(IDT)","ta_sp3d","IDT","%","LIKE","","");
	}
	$URL="SP3D_Frm.php?IdT=".$IdT."&FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
else
{
	$URL="SP3D_Frm.php?FrmG=".$FrmG."&gUPB=".$fUPB."&IdL=".$IdL;
	header("Location: ".$URL);
}
?>