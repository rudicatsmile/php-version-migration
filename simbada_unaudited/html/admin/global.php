<?
require "Connection.php";
require "FileFunction.php";

header('Content-Type: text/xml');
$CrT = $_GET['CrT'];
$gMS = $_GET['gMS'];

if ($CrT=="CrSub")
{
	$SQL = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gMS.".%' ORDER BY Kd_Sub";
	$nRs = mysql_query($SQL);
	echo '<output>';
	while ($mRo = mysql_fetch_array($nRs))
	{
		echo "<ArrGlobKey>".$mRo[0]."</ArrGlobKey>";
		echo "<ArrGlobNma>".strtoupper($mRo[1])."</ArrGlobNma>";
	}
	echo '</output>';
}

if ($CrT=="CrUpb")
{
	if ($gMS!="All" || $gMS!="")
	{
		$SQL = "SELECT Kd_UPB, Nm_UPB FROM ref_upb WHERE Kd_UPB LIKE '".$gMS.".%' GROUP BY Kd_UPB";
		$nRs = mysql_query($SQL);
		echo '<output>';
		while ($mRo = mysql_fetch_array($nRs))
		{
			echo "<ArrGlobKey>".$mRo[0]."</ArrGlobKey>";
			echo "<ArrGlobNma>".strtoupper($mRo[1])."</ArrGlobNma>";
		}
		echo '</output>';
	}
	else
	{
		echo '<output>';
		echo '</output>';
	}
}

if ($CrT=="CrKLP")
{
		echo '<output>';
		echo "<ArrGlobKey>A</ArrGlobKey>";
		echo "<ArrGlobNma>B</ArrGlobNma>";
		echo '</output>';
	/*
	$SQL = "SELECT kd_aset, nm_aset FROM ref_rek_aset2 WHERE kd_aset LIKE '02%' ORDER BY kd_aset";
	$nRs = mysql_query($SQL);
	echo '<output>';
	while ($mRo = mysql_fetch_array($nRs))
	{
		echo "<ArrGlobKey>".$mRo[0]."</ArrGlobKey>";
		echo "<ArrGlobNma>".strtoupper($mRo[1])."</ArrGlobNma>";
	}
	echo '</output>';
	*/
}

?>