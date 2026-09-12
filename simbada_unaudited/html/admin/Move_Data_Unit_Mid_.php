<?
require('Connection.php');
$Smp    = $_POST['Proses'];
$gUnt   = $_POST['fUnt'];

if ($Smp=="Proses")
{
	$gKd1 = fMakeDigit($_POST['fKd1'],2);
	$gKd2 = fMakeDigit($_POST['fKd2'],2);
	$gKd3 = fMakeDigit($_POST['fKd3'],2);
	$gKd4 = fMakeDigit($_POST['fKd4'],2);
	
	$NewBid = $gKd1.".".$gKd2.".".$gKd3;
	$NewUnt = $gKd1.".".$gKd2.".".$gKd3.".".$gKd4;
	
	$CekUnt = fGlobal("IDT","Ref_Unit","Kd_Unit",$NewUnt,"=","","");
	if ($CekUnt=="")
	{
		$SQ = "UPDATE ref_unit SET Kd_Unit='".$NewUnt."' WHERE Kd_Unit='".$gUnt."'";
		mysql_query($SQ);
		
		$nSQ ="SELECT IDT, Kd_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt."%' ORDER BY IDT";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs))
		{
			$OlD = $mRo[1];
			$NeW = $NewUnt.substr($OlD,-3,3);
			
			$SQ = "UPDATE ref_sub_unit SET Kd_Sub='".$NeW."' WHERE Kd_Sub = '".$OlD."'";
			mysql_query($SQ);
		}
		
		$nSQ ="SELECT IDT, Kd_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt."%' ORDER BY IDT";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs))
		{
			$OlD = $mRo[1];
			$NeW = $NewUnt.substr($OlD,-7,7);
			
			$SQ = "UPDATE ta_upb SET Kd_Upb='".$NeW."' WHERE Kd_Upb = '".$OlD."'";
			mysql_query($SQ);
			
			$SQ = "UPDATE ta_kib_108 SET Kd_UPB='".$NeW."' WHERE Kd_UPB='".$OlD."'";
			mysql_query($SQ);
			
			$SQ = "UPDATE ta_kib_post_108 SET Kd_UPB='".$NeW."' WHERE Kd_UPB='".$OlD."'";
			mysql_query($SQ);
			
			$SQ = "UPDATE ta_kib_post_penyusutan_108 SET Kd_UPB='".$NeW."' WHERE Kd_UPB='".$OlD."'";
			mysql_query($SQ);
			
			$SQ = "UPDATE ta_user SET Kode='".$NeW."' WHERE Kode='".$OlD."'";
			mysql_query($SQ);
			
			$SQ = "UPDATE ref_upb SET Kd_Upb='".$NeW."' WHERE Kd_Upb = '".$OlD."'";
			mysql_query($SQ);
		}
		
		
		$MsG = "Pindah Unit dan Data KIB, berhasil..!!";
		$URL="Move_Data_Unit_Mid.php?MsG=".$MsG."&gUnt=".$NewUnt."&IdL=".$_GET['IdL'];
	}
	else
	{
		$MsG = "Kode Unit sudah digunakan, proses dibatalkan..!!";
		$URL="Move_Data_Unit_Mid.php?MsG=".$MsG."&gUnt=".$NewUnt."&IdL=".$_GET['IdL'];
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
	$URL="Move_Data_Unit_Mid.php?gUnt=".$gUnt."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}

function fMakeDigit($gDGT,$nDgT)
{
	$NewKRg = substr("000".$gDGT,-$nDgT,strlen("000".$gDGT));
	return $NewKRg;
}
?>

<?php require('Connection_Close.php');?>
