<?
if ($gNoM!="" && $RfTMP!=""){
	$SQL = "UPDATE ta_kib_group SET 
	Nilai_Total='$gNiL'
	WHERE No_Pengadaan='$gNoM' AND Ref_Temp='$RfTMP'";
	$rst = mysql_query($SQL) or die(mysql_error());
	
	$SQL = "UPDATE ta_kib_post_108 SET 
	Debet='$gHRG'
	WHERE No_Pengadaan='$gNoM' AND Ref_Temp='$RfTMP'";
	$rst = mysql_query($SQL) or die(mysql_error());
}
?>