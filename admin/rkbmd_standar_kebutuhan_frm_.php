<?php
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
require("CheckLogin.php");
extract($_POST);
extract($_GET);
#echo $fJNS;
#return false;
if ($fSave=='Upload')
{
	/*
	$file_name = $_FILES['imgfile']['name']; 		//nama file (tanpa path)
	$tmp_name  = $_FILES['imgfile']['tmp_name']; 	//nama local temp file di server
	$file_size = $_FILES['imgfile']['size']; 		//ukuran file (dalam bytes)
	$file_type = $_FILES['imgfile']['type']; 		//tipe filenya (langsung detect MIMEnya)
	$fp = fopen($tmp_name, 'r'); 				// open file (read-only, binary)
	$file_content = fread($fp, $file_size) or die("Tidak dapat membaca source file..!!"); // read file
	$file_content = mysql_real_escape_string($file_content) or die("Tidak dapat membaca source file..!!"); // parse image ke string
	fclose($fp);
	
	$gRA = fGlobal("Ref_Aset","ta_usulan_rinci_108","IDT",$fIdT,"=","","");
	$gCK = fGlobal("IDT","ta_usulan_rinci_file_108","Referensi:Ref_Aset:file_name",$fREF.":".$gRA.":".$file_name,"=:=:=","","");
	if (!$gCK)
	{
		$nSQL = "INSERT INTO ta_usulan_rinci_file_108 SET 
		Referensi='$fREF',
		Ref_Aset='$gRA',
		Kd_UPB='$fUPB',
		Memo='x-x-x',
		Crit='$fCrT',
		file_content='$file_content', 
		file_name='$file_name', 
		file_type='$file_type', 
		file_size='$file_size'";
		$nRs = mysql_query($nSQL) or die(mysql_error());
	}
	
	$URL="rkbmd_new_pmf_pmt_phs_frm.php?Upl=YA&Frm=".$Frm."&IdT=".$IdT."&IdL=".$IdL."&FrmG=".$FrmG;
	header("Location: ".$URL);
	*/
}
else if ($fSave=='Save')
{
	$gTGL = $fTH."-".$fBL."-".$fHR;
	$gTGD = $fTHd."-".$fBLd."-".$fHRd;
	
	if ($IdT)
	{
		$gTBL = "ta_rkbmd_standar_kebutuhan";
		$gDTA = "";
		$gDTA = "tanggal='".$gTGL."' ";
		$gDTA.= ", tahun='".$fThN."' ";
		$gDTA.= ", nomor='".$fNO."' ";
		$gDTA.= ", uraian='".mysql_real_escape_string($fURA)."'";
		
		$gIdX = 'IDT';
		$gSyR = $IdT;
		$gOpR = '=';
		UpdateGLOBAL($gTBL,$gDTA,$gIdX,$gSyR,$gOpR,DatabaseSB,$ConSB);
	}
	else
	{
		$gNeW = 1;
		$rMax = fGlobal("max(referensi)","ta_rkbmd_standar_kebutuhan","referensi","SKB.".fGetDate('year')."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = (int)substr($rMax,-8,8)+1;
		}
		$gREF = $Frm."SKB.".fGetDate('year').".".substr(str_repeat('0',8).$gNeW,-8,8);
		
		#$gNeW = 1;
		#$rMax = fGlobal("max(nomor)","ta_rkbmd_new_pmf_pmt_phs","nomor","%/".$Frm."/".fGetDate('year'),"LIKE","","");
		#if ($rMax)
		#{
		#	$gNeW = (int)substr($rMax,0,8)+1;
		#}
		$gNOM = $fNO;//substr(str_repeat('0',8).$gNeW,-8,8)."/".$Frm."/".fGetDate('year');
		
		$gTBL = "ta_rkbmd_standar_kebutuhan";
		$gFLD = "";
		$gVAL = "";
		$gFLD = "referensi";
		$gVAL = "'$gREF'";
		$gFLD.= ", kd_unit";
		$gVAL.= ", '$fUNT'";
		$gFLD.= ", nomor";
		$gVAL.= ", '$gNOM'";
		
		$gFLD.= ", tanggal";
		$gVAL.= ", '$gTGL'";
		$gFLD.= ", tahun";
		$gVAL.= ", '$fThN'";
		
		$gFLD.= ", uraian";
		$gVAL.= ", '".mysql_real_escape_string($fURA)."'";
		$gFLD.= ", pencatat";
		$gVAL.= ", '".$UID."'";
		
		$gFLD.= ", recorded";
		$gVAL.= ", now()";
		
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
		
		$IdT = fGlobal("max(IDT)","ta_rkbmd_standar_kebutuhan","IDT","%","LIKE","","");
	}
	$URL="rkbmd_standar_kebutuhan_frm.php?Frm=".$Frm."&IdT=".$IdT."&IdL=".$IdL."&FrmG=".$FrmG;;
	header("Location: ".$URL);
}
else
{
	$URL="rkbmd_standar_kebutuhan_frm.php?Frm=".$Frm."&IdL=".$IdL."&FrmG=".$FrmG;;
	header("Location: ".$URL);
}
?>