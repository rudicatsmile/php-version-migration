<?
require('Connection.php');
$Smp    = $_POST['Proses'];
$gUnt   = $_POST['fUnt'];
$gSub   = $_POST['fSub'];
$gUpb   = $_POST['fUpb'];
if ($Smp=="Proses")
{
	$gNma = $_POST['fNma'];
	$gKd1 = fMakeDigit($_POST['fKd1'],2);
	$gKd2 = fMakeDigit($_POST['fKd2'],2);
	$gKd3 = fMakeDigit($_POST['fKd3'],2);
	$gKd4 = fMakeDigit($_POST['fKd4'],2);
	$gKd5 = fMakeDigit($_POST['fKd5'],2);
	$gKd6 = fMakeDigit($_POST['fKd6'],3);
	
	$gNewBid = $gKd1.".".$gKd2.".".$gKd3;
	$gNewUnt = $gKd1.".".$gKd2.".".$gKd3.".".$gKd4;
	$gNewSub = $gKd1.".".$gKd2.".".$gKd3.".".$gKd4.".".$gKd5;
	$gNewUpb = $gKd1.".".$gKd2.".".$gKd3.".".$gKd4.".".$gKd5.".".$gKd6;
	
	$CekUpb = fGlobal("IDT","Ref_UPB","Kd_UPB",$gNewUpb,"=","","");
	if ($CekUpb!="")
	{
		$SQ = "UPDATE ta_kib_108 SET Kd_UPB='".$gNewUpb."' WHERE Kd_UPB='".$gUpb."'";
		mysql_query($SQ);
		
		$SQ = "UPDATE ta_kib_post_108 SET Kd_UPB='".$gNewUpb."' WHERE Kd_UPB='".$gUpb."'";
		mysql_query($SQ);
		
		$MsG = "Pindah data KIB, berhasil..!!";
		$URL="Move_Data_UPB_Mid.php?MsG=".$MsG."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&IdL=".$_GET['IdL'];
	}
	else
	{
		$SQ = "INSERT INTO ref_UPB SET Kd_UPB='".$gNewUpb."', Nm_UPB='".$gNma."'";
		mysql_query($SQ);
		
		$SQ = "UPDATE ta_kib_108 SET Kd_UPB='".$gNewUpb."' WHERE Kd_UPB='".$gUpb."'";
		mysql_query($SQ);
		
		$SQ = "UPDATE ta_kib_post_108 SET Kd_UPB='".$gNewUpb."' WHERE Kd_UPB='".$gUpb."'";
		mysql_query($SQ);
		
		$MsG = "Insert baru UPB ( ".$gNewUpb." ) dan Pindah data KIB, berhasil..!!";
		$URL="Move_Data_UPB_Mid.php?MsG=".$MsG."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&IdL=".$_GET['IdL'];
	}
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
	$URL="Move_Data_UPB_Mid.php?gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}

function fMakeDigit($gDGT,$nDgT)
{
	$NewKRg = substr("000".$gDGT,-$nDgT,strlen("000".$gDGT));
	return $NewKRg;
}
?>

<?php require('Connection_Close.php');?>
