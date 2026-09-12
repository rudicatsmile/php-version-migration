<?php
require "Connection.php";
require "FileFunction.php";

extract($_GET);
extract($_POST);

if ($Simpan=="AddRc")
{
	$nSQL = "SELECT IFNULL(MAX(Nomor_Rci),0) as LasRef FROM ta_pengadaan_rinci WHERE Nomor='$gNOR'";
	$nRst = mysql_query($nSQL) or die(mysql_error());
	$nRow = mysql_fetch_assoc($nRst);
	$NeRf = $nRow['LasRef'];
	
	$LastR = ((int)substr($NeRf,-2,2)) + 1;
	$NewR  = $gNOR.".".substr("00".$LastR,-2,2);
	
	$PeR  = substr($rNOM,12,4);
	$NoM  = substr($rNOM,0,23);
	
	$SQ = "INSERT INTO ta_pengadaan_rinci SET 
	Nomor='$gNOR',
	Nomor_Rci='$NewR',
	SmbDana='',
	Nilai='0',
	Uraian='-',
	Periode='$PeR',
	SPP='N',
	Recorded=now(),
	Pencatat='$gPCT'";
	$Rs = mysql_query($SQ) or die(mysql_error());
}
elseif ($Simpan=="SaveRc")
{
	//$mNiL = $gNiL;
	$nSQ = "SELECT IDT FROM ta_pengadaan_rinci WHERE Nomor='$gNOR' ORDER BY IDT";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rDNA = $_POST['fDnA'.$mRo[0]];
		$rNiL = fConvertToNumeric($_POST['fNIL'.$mRo[0]]);
		//if ($rNiL<=$mNiL)
		//{
		//	$rNiL = $rNiL;
		//	$mNiL = $mNiL-$rNiL;
		//}
		//else
		//{
		//	$rNiL = $mNiL;
		//}
		
		$SQ = "UPDATE ta_pengadaan_rinci SET 
		SmbDana='$rDNA', Nilai='$rNiL' WHERE IDT='".$mRo[0]."'";
		$Rs = mysql_query($SQ) or die(mysql_error());
	}
}
else if ($Simpan=="DellRc")
{
	$SQ = "DELETE FROM ta_pengadaan_rinci WHERE IDT='".$CriteR."'";
	$Rs = mysql_query($SQ) or die(mysql_error());
}
$URL="Pengadaan_Mid_Dana_Mid.php?gNOR=".$gNOR."&IdL=".$IdL;
header("Location: ".$URL);
?>