<?php
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
require("CheckLogin.php");
extract($_POST);
extract($_GET);
#echo $fJNS;
#return false;
if ($fSave=='Save')
{
	$gTGL = $fTH."-".$fBL."-".$fHR;
	$gTGD = $fTHd."-".$fBLd."-".$fHRd;
	if ($IdT)
	{
		$gTBL = "ta_surat_usulan_penghentian";
		$gDTA = "";
		$gDTA = "Tanggal='".$gTGL."' ";
		$gDTA.= ", Nomor='".$fNO."'";
		$gDTA.= ", Lampiran='".$fLAM."'";
		$gDTA.= ", Perihal='".$fPER."'";
		$gDTA.= ", KpdYth='".$fKPD."'";
		$gDTA.= ", Sebab='".$fSBB."'";
		$gDTA.= ", NmKepala='".$fNMA."'";
		$gDTA.= ", JbKepala='".$fJAB."'";
		$gDTA.= ", NiKepala='".$fNIP."'";
		
		$gIdX = 'IDT';
		$gSyR = $IdT;
		$gOpR = '=';
		UpdateGLOBAL($gTBL,$gDTA,$gIdX,$gSyR,$gOpR,DatabaseSB,$ConSB);
	}
	else
	{
		$gNeW = 1;
		$rMax = fGlobal("max(Referensi)","ta_surat_usulan_penghentian","Referensi","PHT.".fGetDate('year')."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = (int)substr($rMax,-8,8)+1;
		}
		$gREF = "PHT.".fGetDate('year').".".substr(str_repeat('0',8).$gNeW,-8,8);
		
		$gTBL = "ta_surat_usulan_penghentian";
		$gFLD = "";
		$gVAL = "";
		$gFLD = "Referensi";
		$gVAL = "'".$gREF."'";
		
		$gFLD.= ", KdUnit";
		$gVAL.= ", '".$fUNT."'";
		
		$gFLD.= ", Nomor";
		$gVAL.= ", '".$fNO."'";
		
		$gFLD.= ", Tanggal";
		$gVAL.= ", '".$gTGL."'";
		
		$gFLD.= ", Lampiran";
		$gVAL.= ", '".$fLAM."'";
		
		$gFLD.= ", Perihal";
		$gVAL.= ", '".$fPER."'";
		
		$gFLD.= ", KpdYth";
		$gVAL.= ", '".$fKPD."'";
		
		$gFLD.= ", Sebab";
		$gVAL.= ", '".$fSBB."'";
		
		$gFLD.= ", NmKepala";
		$gVAL.= ", '".$fNMA."'";
		
		$gFLD.= ", JbKepala";
		$gVAL.= ", '".$fJAB."'";
		
		$gFLD.= ", NiKepala";
		$gVAL.= ", '".$fNIP."'";
		
		$gFLD.= ", Pencatat";
		$gVAL.= ", '".$UID."'";
		
		$gFLD.= ", Recorded";
		$gVAL.= ", now()";
		
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
		
		$IdT = fGlobal("max(IDT)","ta_surat_usulan_penghentian","IDT","%","LIKE","","");
	}
	$URL="Surat_permohonan_penghentian_frm.php?IdT=".$IdT."&FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
else
{
	$URL="Surat_permohonan_penghentian_frm.php?FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
?>