<?
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";

extract($_POST);
extract($_GET);

$rIDT  = $rIDT;
$rKib  = $rKib;
$gUnt  = $gUnt;

$Smp   = $Simpan;
$gURA  = $fUraian;
$gKET  = $fKeterangan;
$rRef  = $rRef;

$gHri = $fHri;
$gBln = $fBln;
$gThn = $fThn;

$gHriB = $fHriB;
$gBlnB = $fBlnB;
$gThnB = $fThnB;

$gHriM = $fHriM;
$gBlnM = $fBlnM;
$gThnM = $fThnM;

$gHriD = $fHriD;
$gBlnD = $fBlnD;
$gThnD = $fThnD;

$gNIL = fConvertToNumeric($fNilai);
$gNIK = 0;
$gTgl = $gThn."-".$gBln."-".$gHri;
$gTglB = $gThnB."-".$gBlnB."-".$gHriB;
$gTglM = $gThnM."-".$gBlnM."-".$gHriM;
$gTglD = $gThnD."-".$gBlnD."-".$gHriD;

$gMSA = "YA";
if ($gCR=='SLD'){$gMSA = "TIDAK";}

$rDta = fGlobal("Ref_Group:Kd_UPB:Kd_Aset_108:No_Register:Ref_Usulan:Ref_Usulan_His:Ref_HIstory:Ref_Mutasi","ta_kib_post_108","Referensi:Crit:Kd_UPB",$rRef.":SLD:".$gUnt."%","=:=:LIKE","","");
if ($rDta=="")
{
	$rDta = fGlobal("Ref_Group:Kd_UPB:Kd_Aset_108:No_Register:Ref_Usulan:Ref_Usulan:Ref_Usulan:Ref_Mutasi","ta_kib_108","Referensi:Kd_UPB",$rRef.":".$gUnt."%","=:LIKE","","");	
}

if ($rDta!="")
{
	$sDta = explode(':', $rDta);
	$gRef = $sDta[0];
	$gUPB = $sDta[1];
	$gAss = $sDta[2];
	$gNom = $sDta[3];
	
	$RefU = $sDta[4];
	$ReUH = $sDta[5];
	$ReHI = $sDta[6];
	$RefM = $sDta[7];
}
else
{
	$gRef = "";
	$gUPB = "";
	$gAss = "";
	$gNom = "";
	$RefU = "";
	$ReUH = "";
	$ReHI = "";
	$RefM = "";
}

$gCR = $_POST['fCriteria'];
$gDK  = "D";
$gNID = $gNIL;
$gNIK = $gNIK;
if ($gNIK>0){$gDK  = "K";}
if ($Smp=="Save")
{
	if ($rIDT!="")
	{
		$eDTA = fGlobal("HasilMerger:Mrg_Ref_History:Ref_Mutasi:Kd_UPB:Kd_Aset_108:Referensi","ta_kib_post_108","IDT",$rIDT,"=","","");
		$eDTA = explode(":",$eDTA);
		$rMrG = $eDTA[0];
		$rReF = $eDTA[1];
		$rReM = $eDTA[2];
		$eUpB = $eDTA[3];
		$rUpB = substr($eDTA[3],0,11);
		$rAsT = $eDTA[4];
		$rReA = $eDTA[5];
		
		if ($rMrG=="Y"){
			if (substr($gAss,0,5)=="1.3.1"){
				$SQW="UPDATE ta_kib_108_merger_his SET Sertifikat_Nomor='".$fNOD."', Sertifikat_Tanggal='".$gTglD."' WHERE Referensi='".$rReF."' AND Kd_UPB LIKE '".$rUpB."%'";
				$rsW = mysql_query($SQW);
			}
			if (substr($gAss,0,5)=="1.3.3"){
				$SQW="UPDATE ta_kib_108_merger_his SET Dokumen_Nomor='".$fNOD."', Dokumen_Tanggal='".$gTglD."' WHERE Referensi='".$rReF."' AND Kd_UPB LIKE '".$rUpB."%'";
				$rsW = mysql_query($SQW);
			}
		}
		if ($rReM!=""){
			
			$SQW="UPDATE ta_kib_108_mutasi SET Kd_Aset_To='".$rAsT."' WHERE Referensi='".$rReM."' AND Kd_UPB_To LIKE '".$rUpB."%'";
			$rsW = mysql_query($SQW);
			
			$SQW="UPDATE ta_kib_post_108_mutasi SET Kd_Aset_To='".$rAsT."' WHERE Referensi='".$rReM."' AND Kd_UPB_To LIKE '".$rUpB."%'";
			$rsW = mysql_query($SQW);
		}
		
		$SQL = "UPDATE ta_kib_post_108 SET 
		Tanggal='$gTgl', 
		Tanggal_BAST='$gTglB', 
		Tgl_Mutasi='$gTglM', 
		Ref_Group='$gRef',
		Kd_UPB='$gUPB', 
		Kd_Aset_108='$gAss', 
		No_Register='$gNom', 
		DK='$gDK', 
		Crit='$gCR',
		Debet='$gNID', 
		Kredit='$gNIK', 
		Tmbh_Ms_Manfaat='$gMSA', 
		Uraian='$gURA', 
		IdAsalUsul='$fAsal', 
		Keterangan='$gKET', 
		Recorded=now(), 
		Pencatat='$UID' WHERE IDT='".$rIDT."'";
		$rst = mysql_query($SQL);
		
		if ($gCR=='SLD')
		{
			$DeK = fGlobal("perolehan","ref_perolehan","IDT",$fAsal,"=","","");
			$SQL = "UPDATE ta_kib_108 SET asal_usul='".$DeK."' WHERE referensi='".$rReA."' AND kd_upb='".$eUpB."'";
			$rst = mysql_query($SQL);
		}
		
		$MsG = "Perubahan Nilai berhasil...!!";
	}
	else
	{
		if ($gCR=='SLD'){
			$SQL = "INSERT INTO ta_kib_post_108 SET 
			Referensi='$rRef',
			Ref_Group='$gRef',
			Kd_UPB='$gUPB',
			Ref_Usulan='$RefU', 
			Ref_Usulan_His='$ReUH',
			Ref_HIstory='$ReHI',
			Ref_Mutasi='$RefM',
			Kd_Aset_108='$gAss',
			No_Register='$gNom',
			Tanggal='$gTgl', 
			Tanggal_BAST='$gTglB', 
			Tgl_Mutasi='$gTglM', 
			Uraian='$gURA',
			IdAsalUsul='$fAsal', 
			DK='$gDK',
			Crit='$gCR',
			Keterangan='$gKET',
			Debet='$gNID', 
			Kredit='$gNIK', 
			Tmbh_Ms_Manfaat='$gMSA', 
			No_Pengadaan='$fNOM',
			Recorded=now(),
			Pencatat='$UID'";
		}
		else{
			$SQL = "INSERT INTO ta_kib_post_108 SET 
			Referensi='$rRef',
			Ref_Group='$gRef',
			Kd_UPB='$gUPB',
			Kd_Aset_108='$gAss',
			No_Register='$gNom',
			Tanggal='$gTgl', 
			Tanggal_BAST='$gTglB', 
			Tgl_Mutasi='$gTglM', 
			Uraian='$gURA',
			IdAsalUsul='$fAsal', 
			DK='$gDK',
			Crit='$gCR',
			Keterangan='$gKET',
			Debet='$gNID', 
			Kredit='$gNIK', 
			Tmbh_Ms_Manfaat='$gMSA', 
			No_Pengadaan='$fNOM',
			Recorded=now(),
			Pencatat='$UID'";
		}
		$rst = mysql_query($SQL);
		
		//Identitas Record Baru
		$rIDT = fGlobal("IDT","Ta_Kib_Post_108","Referensi:Kd_UPB",$rRef.":".$gUnt."%","=:LIKE","IDT desc limit 0,1","");
		
		$MsG = "Perubahan Nilai berhasil...!!";
	}
	
	$URL="Form_Invent_Asset_Ubh_Mid.php?MsG=".$MsG."&rIDT=".$rIDT."&rRef=".$rRef."&rKib=".$rKib."&gUnt=".$gUnt."&IdL=".$IdL;
	header("Location: ".$URL);
}
else if ($Smp=="Close")
{
	?>
	<script language="JavaScript">
	this.window.focus()
	this.window.document.close()
	this.setTimeout("self.close()",0)
	</script>
	<?
}
?>

<?php require('Connection_Close.php');?>
