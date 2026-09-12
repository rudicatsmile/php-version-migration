<?
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
require("CheckLogin.php");
extract($_POST);
extract($_GET);
#echo $fJNS;
#return false;
if ($fSave=='UploadX')
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
	
	$gRA = fGlobal("Ref_Aset","ta_usulan_rinci","IDT",$fIdT,"=","","");
	$gCK = fGlobal("IDT","ta_usulan_rinci_file","Referensi:Ref_Aset:file_name",$fREF.":".$gRA.":".$file_name,"=:=:=","","");
	if (!$gCK)
	{
		$nSQL = "INSERT INTO ta_usulan_rinci_file SET 
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
	$URL="Invent_Usulan_Frm.php?Upl=YA&IdT=".$IdT."&IdL=".$IdL;
	header("Location: ".$URL);
	*/
}
else if ($fSave=='Save')
{
	if ($IdT)
	{
		$gTBL = "ta_rpbmd_new";
		$gDTA.= "Uraian='".mysql_real_escape_string($fURA)."'";
		
		$gIdX = 'IDT';
		$gSyR = $IdT;
		$gOpR = '=';
		UpdateGLOBAL($gTBL,$gDTA,$gIdX,$gSyR,$gOpR,DatabaseSB,$ConSB);
	}
	else
	{
		$gNeW = 1;
		$rMax = fGlobal("max(Referensi)","ta_rpbmd_new","Referensi","RPB.".(fGetDate('year')+1)."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = (int)substr($rMax,-8,8)+1;
		}
		$gREF = "RPB.".(fGetDate('year')+1).".".substr(str_repeat('0',8).$gNeW,-8,8);
		
		
		$gTBL = "ta_rpbmd_new";
		$gFLD = "";
		$gVAL = "";
		$gFLD = "Referensi";
		$gVAL = "'$gREF'";
		$gFLD.= ", Kd_Unit";
		$gVAL.= ", '$fUNT'";
		$gFLD.= ", Tahun";
		$gVAL.= ", '$fTHN'";
		$gFLD.= ", Uraian";
		$gVAL.= ", '".mysql_real_escape_string($fURA)."'";
		$gFLD.= ", Pencatat";
		$gVAL.= ", '".$UID."'";
		
		$gFLD.= ", Recorded";
		$gVAL.= ", now()";
		
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
		
		$IdT = fGlobal("max(IDT)","ta_rpbmd_new","Kd_Unit",$fUNT,"=","","");
	}
	$URL="RPBMD_New_Frm.php?FrmG=".$FrmG."&IdT=".$IdT."&IdL=".$IdL;
	header("Location: ".$URL);
}
else if ($fSave=='Dell')
{
}
else if ($fSave=='DelVer')
{
}
else
{
	$URL="RPBMD_New_Frm.php?FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
?>