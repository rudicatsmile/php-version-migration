<?
require('Connection.php');
require('FileFunction.php');
$rIDT  = $_REQUEST['rIDT'];
$Smp   = $_POST['Simpan'];
$gUnt  = $_POST['fUnt'];
$gSub  = $_POST['fSub'];
$gUpb  = $_POST['fUpb'];


if ($Smp=="Save")
{
	$gHri  = $_POST['fHri'];
	$gBln  = $_POST['fBln'];
	$gThn  = $_POST['fThn'];
	
	$gNom  = $_POST['fNom'];
	$gPgn  = fGlobal("Nm_Pimpinan","ta_upb","Kd_UPB:Tahun",$gUpb.":".$gThn,"=:=","","");
	$gNip  = fGlobal("Nip_Pimpinan","ta_upb","Kd_UPB:Tahun",$gUpb.":".$gThn,"=:=","","");
	$gTgl  = $gThn."-".fMakeRegister($gBln,2)."-".fMakeRegister($gHri,2);
	$gKet  = $_POST['fKet'];
	
	if ($rIDT=="")
	{
		$nSQL = "SELECT IFNULL(MAX(Referensi),0) AS LasRef FROM ta_penghapusan_usulan";
		$nRst = mysql_query($nSQL) or die(mysql_error());
		$nRow = mysql_fetch_assoc($nRst);
		$NewK = $nRow['LasRef'];
		$NewK = substr($NewK, 5,11);
		$NewK = ((int)$NewK) + 1;
		$NewRef = "PHS.".fMakeReferensi($NewK,11);
		
		$SQL = "INSERT INTO ta_penghapusan_usulan SET 
		Referensi='$NewRef',
		Kd_UPB='$gUpb',
		Tahun='$gThn',
		Tanggal='$gTgl',
		Nomor='$gNom',
		Nm_Pggna_Barang='$gPgn',
		Nip_Pggna_Barang='$gNip',
		Keterangan='$gKet',
		Recorded=now(),
		Pencatat='-'";
		$rst = mysql_query($SQL) or die(mysql_error());
		
		$rIDT = fGlobal("IDT","ta_penghapusan_usulan","IDT","%","LIKE","IDT desc limit 1","");
	}
	else
	{
		$SQL = "UPDATE ta_penghapusan_usulan SET 
		Tanggal='$gTgl',
		Tahun='$gThn',
		Nomor='$gNom',
		Nm_Pggna_Barang='$gPgn',
		Nip_Pggna_Barang='$gNip',
		Keterangan='$gKet',
		Recorded=now(),
		Pencatat='-' WHERE IDT='".$rIDT."'";
		$rst = mysql_query($SQL) or die(mysql_error());
	}
	$URL="Usulan_Penghapusan.php?rIDT=".$rIDT."&FrmG=".$_REQUEST['FrmG']."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&IdL=".$_REQUEST['IdL'];
	header("Location: ".$URL);
}
else if ($Smp=="RemoveRecord")
{
	$DeLIDT = $_REQUEST['CritIDT'];
	$SQL = "DELETE FROM ta_penghapusan_usulan_rinc WHERE IDT='".$DeLIDT."'";
	$rst = mysql_query($SQL) or die(mysql_error());
	
	$URL="Usulan_Penghapusan.php?rIDT=".$rIDT."&FrmG=".$_REQUEST['FrmG']."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&IdL=".$_REQUEST['IdL'];
	header("Location: ".$URL);
}
else
{
	$URL="Usulan_Penghapusan.php?FrmG=".$_REQUEST['FrmG']."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&IdL=".$_REQUEST['IdL'];
	header("Location: ".$URL);
}
?>

<?php require('Connection_Close.php');?>
