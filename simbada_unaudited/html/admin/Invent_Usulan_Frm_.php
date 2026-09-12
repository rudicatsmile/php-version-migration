<?
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
	$file_name = $_FILES['imgfile']['name']; 		//nama file (tanpa path)
	$tmp_name  = $_FILES['imgfile']['tmp_name']; 	//nama local temp file di server
	$file_size = $_FILES['imgfile']['size']; 		//ukuran file (dalam bytes)
	$file_type = $_FILES['imgfile']['type']; 		//tipe filenya (langsung detect MIMEnya)
	$fp = fopen($tmp_name, 'r'); 					//open file (read-only, binary)
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
	$URL="Invent_Usulan_Frm.php?Upl=YA&IdT=".$IdT."&FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
else if ($fSave=='Save')
{
	$gTGL = $fTH."-".$fBL."-".$fHR;
	$gTGD = $fTHd."-".$fBLd."-".$fHRd;
	if ($IdT)
	{
		$gTBL = "ta_usulan_108";
		$gDTA = "";
		$gDTA = "Tanggal='".$gTGL."' ";
		$gDTA.= ", Nma_Pengguna=''";
		$gDTA.= ", Kd_UPB='".$fUNT."'";
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
		#$rMax = fGlobal("max(Referensi)","ta_usulan_108","Referensi","PHM.".fGetDate('year')."%","LIKE","","");
		$rMax = fGlobal("max(Referensi)","ta_usulan_108","Referensi","PHM.".$fTH."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = (int)substr($rMax,-8,8)+1;
		}
		$gREF = "PHM.".$fTH.".".substr(str_repeat('0',8).$gNeW,-8,8);
		
		$gNeW = 1;
		#$rMax = fGlobal("max(Nomor)","ta_usulan_108","Nomor","%/PHM/".fGetDate('year'),"LIKE","","");
		$rMax = fGlobal("max(Nomor)","ta_usulan_108","Nomor","%/PHM/".$fTH,"LIKE","","");
		if ($rMax)
		{
			$gNeW = (int)substr($rMax,0,8)+1;
		}
		$gNOM = substr(str_repeat('0',8).$gNeW,-8,8)."/PHM/".$fTH;
		
		$gTBL = "ta_usulan_108";
		$gFLD = "";
		$gVAL = "";
		$gFLD = "Referensi";
		$gVAL = "'$gREF'";
		$gFLD.= ", Kd_UPB";
		$gVAL.= ", '$fUNT'";
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
		$gVAL.= ", '".$fJNS."'";
		
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
	$URL="Invent_Usulan_Frm.php?IdT=".$IdT."&FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
else
{
	$URL="Invent_Usulan_Frm.php?FrmG=".$FrmG."&IdL=".$IdL;
	header("Location: ".$URL);
}
?>