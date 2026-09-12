<?
require('Connection.php');
require('FileFunction.php');
$Smpn  = $_POST['Simpan'];
$rIDT = $_REQUEST['rIDT'];

if ($Smpn=="Save")
	{
		$gSTA  = $_POST['fSTA'];
		$gNoSK = $_POST['fNoSK'];
		
		$rHri  = $_POST['fHri'];
		$rBln  = $_POST['fBln'];
		$rThn  = $_POST['fThn'];
		$gTgSK = $rThn."-".fMakeRegister($rBln,2)."-".fMakeRegister($rHri,2);
		if ($rHri=="0" ||$rBln=="0" ||$rThn=="0000") {$gTgSK="0000-00-00";}
		$gCTT  = $_POST['fCTT'];
		$gUid=fGlobal("User_ID","Ta_User_Log","IDT",$_REQUEST['IdL'],"=","","");
		
		$SQ = "UPDATE ta_penghapusan_usulan SET 
		Status='$gSTA',
		No_SK='$gNoSK',
		Tgl_SK='$gTgSK',
		Catatan_Stat='$gCTT',
		Recorded_Stat=now(),
		Pencatat_Stat='$gUid' WHERE IDT='".$rIDT."'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$URL="Form_Status_Usulan_Mid.php?rIDT=".$rIDT."&gThn=".$_REQUEST['gThn']."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL'];
		header("Location: ".$URL);
	}
else if ($Smpn=="Close")
	{
	$URL="Usulan_Penghapusan_Status.php?gThn=".$_REQUEST['gThn']."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL'];
	?>
	<script LANGUAGE="JavaScript">
	this.window.open ('<? echo $URL ?>','MidFrame')
	this.setTimeout("self.close()",0)
	</script>
	<?
	}

?>

<?php require('Connection_Close.php');?>
