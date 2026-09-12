<?
require "Connection.php";
#require "Connection_Simkada.php";
require "FileFunction.php";

header('Content-Type: text/xml');
$CrT = $_GET['CrT'];
$gMS = $_GET['gMST'];
if ($CrT=="CrUPB")
{
	CallConnection(DatabaseSB,$ConSB);
	$nSQ = "SELECT kd_upb, nm_upb FROM ref_upb WHERE kd_upb LIKE '".$gMS.".%' ORDER BY kd_upb";
	$nRs = mysql_query($nSQ);
	echo '<output>';
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		echo "<ArrMisi>".$mRo[0]." : ".strtoupper($mRo[1])."</ArrMisi>";
		echo "<ArrMisiKey>".$mRo[0]."</ArrMisiKey>";
	}
	echo '</output>';
}

if ($CrT=="CrJNS64" || $CrT=="CrJNS13")
{
	$nN = "64";
	if ($CrT=="CrJNS13"){$nN = "13";}
	
	CallConnection(DatabaseSB,$ConSB);
	$nSQ = "SELECT Kd_Rek, Nm_Rek FROM ref_rek_".$nN."_4 WHERE Kd_Rek LIKE '$gMS%' ORDER BY Kd_Rek";
	$nRs = mysql_query($nSQ);
	echo '<output>';
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		echo "<ArrMisi>".$mRo[0]." : ".$mRo[1]."</ArrMisi>";
		echo "<ArrMisiKey>".$mRo[0]."</ArrMisiKey>";
	}
	echo '</output>';
}

if ($CrT=="CrOBJ64" || $CrT=="CrOBJ13")
{
	$nN = "64";
	if ($CrT=="CrOBJ13"){$nN = "13";}
	CallConnection(DatabaseSB,$ConSB);
	$nSQ = "SELECT Kd_Rek, Nm_Rek FROM ref_rek_".$nN."_5 WHERE Kd_Rek LIKE '$gMS%' ORDER BY Kd_Rek";
	$nRs = mysql_query($nSQ);
	echo '<output>';
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		echo "<ArrMisi>".$mRo[0]." : ".$mRo[1]."</ArrMisi>";
		echo "<ArrMisiKey>".$mRo[0]."</ArrMisiKey>";
	}
	echo '</output>';
}
?>