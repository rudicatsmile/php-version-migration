<?php
require('Connection.php');
require('FileFunction.php');

$data = array();
extract($_GET);
extract($_POST);

if ($IdT)
{
	$nSQ="UPDATE ref_sumber_dana SET 
	Deskripsi='".$NmSB."',
	Alias='".$AlIA."' 
	WHERE IDT='$IdT'";
	mysql_query($nSQ);
	$Mss = "Proses berhasil..!!";
}
else
{
	$gNO = fGlobal("max(kode)","ref_sumber_dana","kode","%","LIKE","","");
	if ($gNO)
	{
		$gNO = (int)$gNO+1;
	}
	else
	{
		$gNO = 1;
	}
	$gKD = $gNO;
	
	$nSQ="INSERT INTO ref_sumber_dana SET 
	Kode='".$gKD."',
	Deskripsi='".$NmSB."',
	Alias='".$AlIA."'";
	mysql_query($nSQ);
	
	$IdT = fGlobal("max(IDT)","ref_sumber_dana","kode","%","LIKE","","");
	$Mss = "Proses berhasil..!!";
}
$data['IdT'] = $IdT;
$data['mess']= $Mss;
echo json_encode($data);
?>
