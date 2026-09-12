<?php
$FotA[3];
$FotB[3];
$FotC[3];

if ($uNT==""){
	$FotC[1]= "BUPATI ".$TiDaer." ".$NmDaer;
	$FotC[2]= "SAMSUL RIZAL";
	$FotC[3]= "";$mRo['Nip_Pengurus'];
}
else{
	$nSQ = "SELECT * FROM ref_unit where Kd_Unit = '".$uNT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		//PIMPINAN
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
}
?>