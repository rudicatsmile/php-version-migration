<?
require('Connection.php');
$Smpn  = $_POST['Simpan'];
$rIDT = $_REQUEST['rIDT'];
$gIDT = $_REQUEST['gIDT'];

if ($Smpn=="Save")
	{
		$gALS  = $_POST['fALS'];
		$gKET  = $_POST['fKET'];
		$gUid=fGlobal("User_ID","Ta_User_Log","IDT",$_REQUEST['IdL'],"=","","");
		
		$SQ = "UPDATE ta_penghapusan_usulan_rinc SET 
		Alasan='$gALS',
		Keterangan='$gKET',
		Recorded=now(),
		Pencatat='$gUid' WHERE IDT='".$gIDT."'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$URL="Form_Edit_Usulan_Mid.php?gIDT=".$gIDT."&rIDT=".$rIDT."&IdL=".$_REQUEST['IdL'];
		header("Location: ".$URL);
	}
else if ($Smpn=="Close")
	{
	$URL="Usulan_Penghapusan.php?rIDT=".$rIDT."&IdL=".$_REQUEST['IdL'];
	?>
	<script LANGUAGE="JavaScript">
	this.window.open ('<? echo $URL ?>','MidFrame')
	this.setTimeout("self.close()",0)
	</script>
	<?
	}

?>

<?php require('Connection_Close.php');?>
