<?
require('Connection.php');
require('CheckLogin.php');

extract($_POST);
$Smp    = $_POST['Proses'];
$gUnt   = $_POST['fUnt'];
$gThn   = $_POST['fThn'];

if ($Smp=="Proses")
{
	$SQ="UPDATE ta_kib_lock SET 
	Kib_A='$fKibA',
	Kib_B='$fKibB',
	Kib_C='$fKibC',
	Kib_D='$fKibD',
	Kib_E='$fKibE',
	Kib_F='$fKibF',
	Kib_G='$fKibG',
	Recorded=now(), 
	Pencatat='$UID' 
	WHERE SKPD='$gUnt' AND Tahun='2014'";
	$rs=mysql_query($SQ);

	$SQ="UPDATE ta_kib_lock SET 
	Kib_A='$fKibAb',
	Kib_B='$fKibBb',
	Kib_C='$fKibCb',
	Kib_D='$fKibDb',
	Kib_E='$fKibEb',
	Kib_F='$fKibFb',
	Kib_G='$fKibGb',
	Recorded=now(), 
	Pencatat='$UID' 
	WHERE SKPD='$gUnt' AND Tahun='$gThn'";
	$rs=mysql_query($SQ);
	
	$URL="Kunci_Data_Aset_Mid.php?gUnt=".$gUnt."&gThn=".$gThn."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}
else if ($Smp=="Close")
{
	?>
	<script LANGUAGE="JavaScript">            
	this.setTimeout("self.close()",0)
	</script>
	<?
}
else
{
	$URL="Kunci_Data_Aset_Mid.php?gUnt=".$gUnt."&gThn=".$gThn."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}
?>

<?php require('Connection_Close.php');?>
