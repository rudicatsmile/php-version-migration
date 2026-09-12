<?
function UpdateMsManfaat($DatabaseSB,$ConSB)
{
	mysql_select_db($DatabaseSB,$ConSB);
	$gSQ = "SELECT Kd_Aset, Ms_Manfaat FROM ref_rek_aset3 WHERE Ms_Manfaat > 0 ORDER BY Kd_Aset";
	$gRs = mysql_query($gSQ) or die(mysql_error('Error connections..!!'));
	while ($gRo = mysql_fetch_array($gRs, MYSQL_BOTH))
	{
		$KdA = $gRo[0];
		$MsA = $gRo[1];
		
		$nTBL = fNmHuruf((int)substr($KdA,0,2));
		$SQ = "UPDATE ta_kib_".$nTBL." SET Masa_Manfaat='$MsA' WHERE Kd_Aset LIKE '".$KdA.".__.___'";
		$Rs = mysql_query($SQ);
	}
}
?>