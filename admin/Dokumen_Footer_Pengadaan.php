<?php
$rHri = $_GET['rHri'];
$rBln = $_GET['rBln'];
$rThn = $_GET['rThn'];
if ($rHri==""){$rHri=fGetDate('mday');}
if ($rBln==""){$rBln=fGetDate('mon');}
if ($rThn==""){$rThn=fGetDate('year');}

$FotA[3];
$FotB[3];
$FotC[3];

$nSQ = "SELECT * FROM ref_unit where Kd_Unit = '".substr($gUnt,0,11)."'";
$nRs = mysql_query($nSQ) or die(mysql_error());
$mRo = mysql_fetch_assoc($nRs);
$tRo = mysql_num_rows($nRs);
if ($tRo > 0)
{
	//PIMPINAN
	#$FotA[1]= $mRo['Jab_Pimpinan'];
	#$FotA[2]= $mRo['Nm_Pimpinan'];
	$FotA[1]= $mRo['Jab_Pimpinan'];
	$FotA[2]= $mRo['Nma_Pimpinan'];
	$FotA[3]= $mRo['Nip_Pimpinan'];
	//PENYIMPAN
	$FotB[1]= $mRo['Jbt_Penyimpan'];
	if ($FotB[1]=="") {$FotB[1]="Penyimpan Barang";}
	$FotB[2]= $mRo['Nm_Penyimpan'];
	$FotB[3]= $mRo['Nip_Penyimpan'];
	//PENGURUS
	$FotC[1]= $mRo['Jbt_Pengurus'];
	if ($FotC[1]=="") {$FotC[1]="Pengurus Barang";}
	$FotC[2]= $mRo['Nm_Pengurus'];
	$FotC[3]= $mRo['Nip_Pengurus'];
}
else
{
	//PIMPINAN
	$FotA[1]= "-";
	$FotA[2]= "-";
	$FotA[3]= "-";
	//PENYIMPAN
	$FotB[1]= "-";
	$FotB[2]= "-";
	$FotB[3]= "-";
	//PENGURUS
	$FotC[1]= "-";
	$FotC[2]= "-";
	$FotC[3]= "-";
}
$nSQ = "SELECT IbuKota FROM ref_pemda";
$nRs = mysql_query($nSQ) or die(mysql_error());
$mRo = mysql_fetch_assoc($nRs);
$tRo = mysql_num_rows($nRs);
if ($tRo > 0)
{
	$NmIbKt = $mRo['IbuKota'];
}

?>