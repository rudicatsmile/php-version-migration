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
	$gTGD = $fTHd."-".$fBLd."-".$fHRd;
	if ($IdT)
	{
		$gTBL = "ta_usulan_108";
		$gDTA = "";
		$gDTA = "Tanggal='".$gTGL."' ";
		$gDTA.= ", Nma_Pengguna=''";
		$gDTA.= ", Jab_Pengguna=''";
		$gDTA.= ", Nip_Pengguna=''";
		$gDTA.= ", Jenis='".$fJNS."'";
		$gDTA.= ", Dokumen_Nom='".$fNOd."'";
		$gDTA.= ", Dokumen_Tgl='".$gTGD."'";
		$gDTA.= ", Uraian='".mysql_real_escape_string($fURA)."'";
		
		$gIdX = 'IDT';
		$gSyR = $IdT;
		$gOpR = '=';
		UpdateGLOBAL($gTBL,$gDTA,$gIdX,$gSyR,$gOpR,DatabaseSB,$ConSB);
	}
	else
	{
		$gNeW = 1;
		$rMax = fGlobal("max(Referensi)","ta_usulan_108","Referensi","PHM.".fGetDate('year')."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = (int)substr($rMax,-8,8)+1;
		}
		$gREF = "PHM.".fGetDate('year').".".substr(str_repeat('0',8).$gNeW,-8,8);
		
		$gNeW = 1;
		$rMax = fGlobal("max(Nomor)","ta_usulan_108","Nomor","%/PHM/".fGetDate('year'),"LIKE","","");
		if ($rMax)
		{
			$gNeW = (int)substr($rMax,0,8)+1;
		}
		$gNOM = substr(str_repeat('0',8).$gNeW,-8,8)."/PHM/".fGetDate('year');
		
		$gTBL = "ta_usulan_108";
		$gFLD = "";
		$gVAL = "";
		$gFLD = "Referensi";
		$gVAL = "'$gREF'";
		$gFLD.= ", Kd_UPB";
		$gVAL.= ", '$fUPB'";
		$gFLD.= ", Nomor";
		$gVAL.= ", '$gNOM'";
		$gFLD.= ", Tanggal";
		$gVAL.= ", '$gTGL'";
		$gFLD.= ", Nma_Pengguna";
		$gVAL.= ", ''";
		$gFLD.= ", Jab_Pengguna";
		$gVAL.= ", ''";
		$gFLD.= ", Nip_Pengguna";
		$gVAL.= ", ''";
		$gFLD.= ", Jenis";
		$gVAL.= ", '$fJNS'";
		$gFLD.= ", Dokumen_Nom";
		$gVAL.= ", '$fNOd'";
		$gFLD.= ", Dokumen_Tgl";
		$gVAL.= ", '$gTGD'";
		$gFLD.= ", Uraian";
		$gVAL.= ", '".mysql_real_escape_string($fURA)."'";
		$gFLD.= ", Pencatat";
		$gVAL.= ", '".$UID."'";
		
		$gFLD.= ", Recorded";
		$gVAL.= ", now()";
		
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
		
		$IdT = fGlobal("max(IDT)","ta_usulan_108","IDT","%","LIKE","","");
	}
	$URL="Penghapusan_Usulan_Frm.php?IdT=".$IdT."&IdL=".$IdL;
	header("Location: ".$URL);
}
else if ($fSave=='Dell')
{
	$Ref = fGlobal("Referensi","ta_usulan_108","IDT",$IdT,"=","","");
	$nSQ = "DELETE FROM ta_usulan_rinci_108 WHERE Referensi='$Ref'";
	$nRs = mysql_query($nSQ);
	
	$nSQ = "DELETE FROM ta_usulan_108 WHERE IDT='$IdT'";
	$nRs = mysql_query($nSQ);
	
	$URL="Penghapusan_Usulan_Frm.php?IdL=".$IdL;
	header("Location: ".$URL);
}
else
{
	$URL="Penghapusan_Usulan_Frm.php?IdL=".$IdL;
	header("Location: ".$URL);
}
?>