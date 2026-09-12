<?php
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
require("CheckLogin.php");
extract($_POST);
extract($_GET);
if ($fSave=='Save')
{
	if ($IdT)
	{
		$gTBL = "ta_rkbmd_new";
		$gDTA.= "Uraian='".mysql_real_escape_string($fURA)."'";
		
		$gIdX = 'IDT';
		$gSyR = $IdT;
		$gOpR = '=';
		UpdateGLOBAL($gTBL,$gDTA,$gIdX,$gSyR,$gOpR,DatabaseSB,$ConSB);
	}
	else
	{
		$gNeW = 1;
		$rMax = fGlobal("max(Referensi)","ta_rkbmd_new","Referensi","RKB.".$fTHN."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = (int)substr($rMax,-8,8)+1;
		}
		$gREF = "RKB.".$fTHN.".".substr(str_repeat('0',8).$gNeW,-8,8);
		
		
		
		$gTBL = "ta_rkbmd_new";
		$gFLD = "";
		$gVAL = "";
		$gFLD = "Referensi";
		$gVAL = "'$gREF'";
		$gFLD.= ", Kd_Unit";
		$gVAL.= ", '$fUNT'";
		$gFLD.= ", Tahun";
		$gVAL.= ", '$fTHN'";
		$gFLD.= ", Apbd";
		$gVAL.= ", '$fUBH'";
		$gFLD.= ", Uraian";
		$gVAL.= ", '".mysql_real_escape_string($fURA)."'";
		$gFLD.= ", Pencatat";
		$gVAL.= ", '".$UID."'";
		
		$gFLD.= ", Recorded";
		$gVAL.= ", now()";
		
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
		
		$IdT = fGlobal("max(IDT)","ta_rkbmd_new","Kd_Unit",$fUNT,"=","","");
	}
	$URL="RKBMD_New_Frm.php?FrmG=".$FrmG."&IdT=".$IdT."&IdL=".$IdL;
	header("Location: ".$URL);
}
else
{
	$URL="RKBMD_New_Frm.php?FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
?>