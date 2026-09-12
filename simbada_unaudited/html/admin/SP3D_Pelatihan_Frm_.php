<?
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
		$gTBL = "ta_sp3d_pendaftaran";
		$gDTA = "";
		$gDTA.= "Kd_UPB='".$fUPB."'";
		$gDTA.= ", Nama='".mysql_real_escape_string($fNma)."'";
		$gDTA.= ", NIP='".mysql_real_escape_string($fNip)."'";
		$gDTA.= ", Jabatan='".mysql_real_escape_string($fJab)."'";
		$gDTA.= ", NoHP='".mysql_real_escape_string($fNoh)."'";
		$gDTA.= ", Email='".mysql_real_escape_string($fEma)."'";
		$gDTA.= ", Tanggal='".mysql_real_escape_string($fTgl)."'";
		$gIdX = 'IDT';
		$gSyR = $IdT;
		$gOpR = '=';
		UpdateGLOBAL($gTBL,$gDTA,$gIdX,$gSyR,$gOpR,DatabaseSB,$ConSB);
		$mESG = "tUPDATE";
	}
	else
	{
		$gNeW = 1;
		$rMax = fGlobal("max(Referensi)","ta_sp3d_pendaftaran","Referensi","BOS.".fGetDate('year')."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = (int)substr($rMax,-5,5)+1;
		}
		$fRef = "BOS.".fGetDate('year').".".substr(str_repeat('0',5).$gNeW,-5,5);
		
		
		$gNeW = 1;
		$rMax = fGlobal("max(Nomor)","ta_sp3d_pendaftaran","Nomor","%/BOS/BARSEL/".fGetDate('year'),"LIKE","","");
		if ($rMax)
		{
			$gNeW = (int)substr($rMax,0,5)+1;
		}
		$fNom = substr(str_repeat('0',5).$gNeW,-5,5)."/BOS/BARSEL/".fGetDate('year');
		
		$gTBL = "ta_sp3d_pendaftaran";
		$gFLD = "";
		$gVAL = "";
		
		$gFLD = "Kd_UPB";
		$gVAL = "'$fUPB'";
		
		$gFLD.= ", Referensi";
		$gVAL.= ", '$fRef'";
		
		$gFLD.= ", Nomor";
		$gVAL.= ", '$fNom'";
		
		$gFLD.= ", Nama";
		$gVAL.= ", '".mysql_real_escape_string($fNma)."'";
		
		$gFLD.= ", NIP";
		$gVAL.= ", '".mysql_real_escape_string($fNip)."'";
		
		$gFLD.= ", Jabatan";
		$gVAL.= ", '".mysql_real_escape_string($fJab)."'";
		
		$gFLD.= ", NoHP";
		$gVAL.= ", '".mysql_real_escape_string($fNoh)."'";
		
		$gFLD.= ", Email";
		$gVAL.= ", '".mysql_real_escape_string($fEma)."'";
		
		$gFLD.= ", Tanggal";
		$gVAL.= ", '".mysql_real_escape_string($fTgl)."'";
		
		$gFLD.= ", Pencatat";
		$gVAL.= ", '".$UID."'";
		$gFLD.= ", Recorded";
		$gVAL.= ", now()";
		
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
		
		$IdT  = fGlobal("max(IDT)","ta_sp3d_pendaftaran","IDT","%","LIKE","","");
		$mESG = "tINSERT";
	}
	$URL="SP3D_Pelatihan_Frm.php?IdT=".$IdT."&FrmG=".$FrmG."&mESG=".$mESG."&IdL=".$IdL;
	header("Location: ".$URL);
}
else if ($fSave=='Reset'){
	$URL="SP3D_Pelatihan_Frm.php?FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
?>