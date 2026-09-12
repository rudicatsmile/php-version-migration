<?php
function funcNewRefGrp($DatabaseSB,$ConSB)
{
	CallConnection($DatabaseSB,$ConSB);
	$nSQL = "SELECT IFNULL(MAX(Referensi),0) AS LasRef FROM ta_kib_group";
	$nRst = mysql_query($nSQL) or die(mysql_error());
	$nRow = mysql_fetch_assoc($nRst);
	$NewK = $nRow['LasRef'];
	$NewK = substr($NewK, 5,11);
	$NewK = ((int)$NewK) + 1;
	return "GRP.".fMakeReferensi($NewK,11);
}

function funcLastReGrp($NmTBL,$gRin,$gUpb,$DatabaseSB,$ConSB)
{
	CallConnection($DatabaseSB,$ConSB);
	#$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ".$NmTBL." WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
	$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ".$NmTBL." WHERE No_Register NOT LIKE '%HEX%'";
	$nRst = mysql_query($nSQL) or die(mysql_error());
	$nRow = mysql_fetch_assoc($nRst);
	$NewG = $nRow['LasReG'];
	return ((int)$NewG) + 1;
}
?>