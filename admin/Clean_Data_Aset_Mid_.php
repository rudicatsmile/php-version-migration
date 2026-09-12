<?php
require('Connection.php');
$Smp    = $_POST['Proses'];
$gUnt   = $_POST['fUnt'];
$gSub   = $_POST['fSub'];
$gUpb   = $_POST['fUpb'];

if ($Smp=="Proses")
{
	#echo $gUnt."<br>";
	#echo $gSub."<br>";
	#echo $gUpb."<br>";
	
	if ($gSub=="All"){
		$rUpb = $gUnt.".__.___";
	}
	else{
		if ($gUpb=="All"){
			$rUpb = $gSub.".___";
		}
		else{
			$rUpb = $gUpb;
		}
	}
	
	#return false;
	
	if ($_POST['KIB_A']=="ON")
	{
		$SQ = "DELETE FROM ta_kib_a WHERE Kd_UPB LIKE '".$rUpb."'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_kib_group WHERE Kd_UPB LIKE '".$rUpb."' AND Kd_Aset LIKE '01.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_kib_post WHERE Kd_UPB LIKE '".$rUpb."' AND Referensi LIKE 'TNH.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_rekap_mutasi WHERE Kd_UPB LIKE '".$rUpb."' AND Kd_Aset LIKE '01.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
	}
	
	if ($_POST['KIB_B']=="ON")
	{
		$SQ = "DELETE FROM ta_kib_b WHERE Kd_UPB LIKE '".$rUpb."'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_kib_group WHERE Kd_UPB LIKE '".$rUpb."' AND Kd_Aset LIKE '02.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_kib_post WHERE Kd_UPB LIKE '".$rUpb."' AND Referensi LIKE 'ALT.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_rekap_mutasi WHERE Kd_UPB LIKE '".$rUpb."' AND Kd_Aset LIKE '02.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
	}
	
	if ($_POST['KIB_C']=="ON")
	{
		$SQ = "DELETE FROM ta_kib_c WHERE Kd_UPB LIKE '".$rUpb."'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_kib_group WHERE Kd_UPB LIKE '".$rUpb."' AND Kd_Aset LIKE '03.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_kib_post WHERE Kd_UPB LIKE '".$rUpb."'  AND Referensi LIKE 'BNG.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_rekap_mutasi WHERE Kd_UPB LIKE '".$rUpb."' AND Kd_Aset LIKE '03.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
	}
	
	if ($_POST['KIB_D']=="ON")
	{
		$SQ = "DELETE FROM ta_kib_d WHERE Kd_UPB LIKE '".$rUpb."'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_kib_group WHERE Kd_UPB LIKE '".$rUpb."' AND Kd_Aset LIKE '04.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_kib_post WHERE Kd_UPB LIKE '".$rUpb."'  AND Referensi LIKE 'JLN.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_rekap_mutasi WHERE Kd_UPB LIKE '".$rUpb."' AND Kd_Aset LIKE '04.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
	}
	
	if ($_POST['KIB_E']=="ON")
	{
		$SQ = "DELETE FROM ta_kib_e WHERE Kd_UPB LIKE '".$rUpb."'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_kib_group WHERE Kd_UPB LIKE '".$rUpb."' AND Kd_Aset LIKE '05.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_kib_post WHERE Kd_UPB LIKE '".$rUpb."' AND Referensi LIKE 'ATL.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_rekap_mutasi WHERE Kd_UPB LIKE '".$rUpb."' AND Kd_Aset LIKE '05.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
	}
	
	if ($_POST['KIB_F']=="ON")
	{
		$SQ = "DELETE FROM ta_kib_f WHERE Kd_UPB LIKE '".$rUpb."'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_kib_group WHERE Kd_UPB LIKE '".$rUpb."' AND Kd_Aset LIKE '06.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_kib_post WHERE Kd_UPB LIKE '".$rUpb."' AND Referensi LIKE 'KDP.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_rekap_mutasi WHERE Kd_UPB LIKE '".$rUpb."' AND Kd_Aset LIKE '06.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
	}
	
	if ($_POST['KIB_G']=="ON")
	{
		$SQ = "DELETE FROM ta_kib_g WHERE Kd_UPB LIKE '".$rUpb."'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_kib_group WHERE Kd_UPB LIKE '".$rUpb."' AND Kd_Aset LIKE '07.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_kib_post WHERE Kd_UPB LIKE '".$rUpb."' AND Kd_Aset LIKE '07.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$SQ = "DELETE FROM ta_rekap_mutasi WHERE Kd_UPB LIKE '".$rUpb."' AND Kd_Aset LIKE '07.%'";
		$rs = mysql_query($SQ) or die(mysql_error());
	}
	
	$URL="Clean_Data_Aset_Mid.php?gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}
else if ($Smp=="Close")
{
	?>
	<script LANGUAGE="JavaScript">            
	this.setTimeout("self.close()",0)
	</script>
	<?php
}
else
{
	$URL="Clean_Data_Aset_Mid.php?gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}

function fMakeDigit($gDGT,$nDgT)
{
	$NewKRg = substr("000".$gDGT,-$nDgT,strlen("000".$gDGT));
	return $NewKRg;
}
?>

<?php require('Connection_Close.php');?>
