<?php
require('Connection.php');
require('FileFunction.php');

$data = array();
extract($_GET);
extract($_POST);

if ($IdT)
{
	$nSQ="UPDATE ta_rekanan SET 
	Nma_Perusahaan='".$Nmpr."',
	Nma_Pimpinan='".$Nmpi."',
	NPWP='".$Npwp."',
	NPWPD='".$Npwd."',
	Alamat='".$Alam."',
	No_Telp='".$Telp."',
	No_Fax='".$Faxs."',
	Email='".$Mail."' 
	WHERE IDT='$IdT'";
	mysql_query($nSQ);
	$Mss = "Proses berhasil..!!";
}
else
{
	$gNO = fGlobal("max(kode)","ta_rekanan","kode","R%","LIKE","","");
	if ($gNO)
	{
		$gNO = ((int)substr($gNO,-3,3))+1;
	}
	else
	{
		$gNO = 1;
	}
	$gKD = "R".substr('000'.$gNO,-3,3);
	
	$nSQ="INSERT INTO ta_rekanan SET 
	Kode='".$gKD."',
	Nma_Perusahaan='".$Nmpr."',
	Nma_Pimpinan='".$Nmpi."',
	NPWP='".$Npwp."',
	NPWPD='".$Npwd."',
	Alamat='".$Alam."',
	No_Telp='".$Telp."',
	No_Fax='".$Faxs."',
	Email='".$Mail."'";
	mysql_query($nSQ);
	
	$IdT = fGlobal("max(IDT)","ta_rekanan","kode","%","LIKE","","");
	$Mss = "Proses berhasil..!!";
}
$data['IdT'] = $IdT;
$data['mess']= $Mss;
echo json_encode($data);
?>
