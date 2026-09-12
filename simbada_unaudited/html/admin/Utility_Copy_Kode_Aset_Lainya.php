<?
function CopyKodeAsetLainya3($DatabaseSB,$ConSB)
{
	mysql_select_db($DatabaseSB,$ConSB);
	//$gSQ = "DELETE FROM ref_rek_aset3 WHERE Kd_Aset LIKE '07%'";
	//echo $gSQ."<br>";
	//$gRs = mysql_query($gSQ) or die(mysql_error('Error connections..!!'));
	
	$iG=1;
	$gSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset3 WHERE Kd_Aset NOT LIKE '06%' AND Kd_Aset NOT LIKE '07%' ORDER BY Kd_Aset";
	$gRs = mysql_query($gSQ) or die(mysql_error('Error connections..!!'));
	while ($gRo = mysql_fetch_array($gRs, MYSQL_BOTH))
	{
		$KdA = $gRo[0];
		$NmA = $gRo[1];
		$KdN = "07.21.".substr('00'.$iG,-2,2);
		
		$SQ = "INSERT INTO ref_rek_aset3 SET Kd_Aset='$KdN', Nm_Aset='$NmA', Link_Kib_AE='$KdA'";
		echo $SQ."<br>";
		$Rs = mysql_query($SQ) or die(mysql_error('Error connections..!!'));
		$iG++;
	}
}

function CopyKodeAsetLainya4($DatabaseSB,$ConSB)
{
	mysql_select_db($DatabaseSB,$ConSB);
	$gSQ = "SELECT Kd_Aset, Link_Kib_AE, Nm_Aset FROM ref_rek_aset3 WHERE Kd_Aset LIKE '07%' AND Link_Kib_AE<>'' ORDER BY Kd_Aset";
	$gRs = mysql_query($gSQ) or die(mysql_error('Error connections..!!'));
	while ($gRo = mysql_fetch_array($gRs, MYSQL_BOTH))
	{
		$KdA = $gRo[0];
		$KdN = $gRo[1];
		$NmA = $gRo[2];
		//echo $KdA." : ".$KdN." -> ".$NmA."<br>";
		CopyKodeAsetLainya4A($KdA,$KdN,$DatabaseSB,$ConSB);
	}
}

function CopyKodeAsetLainya4A($KdA,$KdN,$DatabaseSB,$ConSB)
{
	$gSQA = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset4 WHERE Kd_Aset LIKE '$KdN%' ORDER BY Kd_Aset";
	$gRsA = mysql_query($gSQA) or die(mysql_error('Error connections..!!'));
	while ($gRoA = mysql_fetch_array($gRsA, MYSQL_BOTH))
	{
		$rKdA = $gRoA[0];
		$rNmA = $gRoA[1];
		$rKdN = $KdA.".".substr($rKdA,-2,2);
		
		//echo $rKdA.":".$rKdN.":".$rNmA."<br>";
		$SQA = "INSERT INTO ref_rek_aset4 SET Kd_Aset='$rKdN', Nm_Aset='$rNmA', Link_Kib_AE='$rKdA'";
		echo $SQA."<br>";
		$RsA = mysql_query($SQA) or die(mysql_error('Error connections..!!'));
	}
}

function CopyKodeAsetLainya5($DatabaseSB,$ConSB)
{
	mysql_select_db($DatabaseSB,$ConSB);
	$gSQ = "SELECT Kd_Aset, Link_Kib_AE, Nm_Aset FROM ref_rek_aset4 WHERE Kd_Aset LIKE '07%' AND Link_Kib_AE<>'' ORDER BY Kd_Aset";
	$gRs = mysql_query($gSQ) or die(mysql_error('Error connections..!!'));
	while ($gRo = mysql_fetch_array($gRs, MYSQL_BOTH))
	{
		$KdA = $gRo[0];
		$KdN = $gRo[1];
		$NmA = $gRo[2];
		CopyKodeAsetLainya5A($KdA,$KdN,$DatabaseSB,$ConSB);
	}
}

function CopyKodeAsetLainya5A($KdA,$KdN,$DatabaseSB,$ConSB)
{
	$gSQA = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset5 WHERE Kd_Aset LIKE '$KdN%' ORDER BY Kd_Aset";
	$gRsA = mysql_query($gSQA) or die(mysql_error('Error connections..!!'));
	while ($gRoA = mysql_fetch_array($gRsA, MYSQL_BOTH))
	{
		$rKdA = $gRoA[0];
		$rNmA = mysql_real_escape_string($gRoA[1]);
		$rKdN = $KdA.".".substr($rKdA,-3,3);
		
		$CeK = fGlobal("IDT","ref_rek_aset5","Kd_Aset",$rKdN,"=","","");
		if (!$CeK)
		{
			$SQA = "INSERT INTO ref_rek_aset5 SET Kd_Aset='$rKdN', Nm_Aset='$rNmA', Link_Kib_AE='$rKdA'";
			echo $SQA."<br>";
			$RsA = mysql_query($SQA) or die(mysql_error('Error connections..!!'));
		}
	}
}

?>







