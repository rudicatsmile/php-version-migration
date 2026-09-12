<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$NiL = str_replace("**"," ",$NiL);

if ($CrT=="desk"){
	$nSQ = "update ta_apbd_program_skpd set nmProgram='$NiL' where idt='$IdT'";
	$nRs = mysql_query($nSQ);
	echo "<script type='text/javascript'>RefreshDATA('".$IdL."')</script>";
}
else{
	$KdE = fGlobal("idProgram","ta_apbd_program_skpd","IDT",$IdT,"=","","");
	if ($CrT=='kode1'){
		$KdE = $NiL.".".substr($KdE,5,13);
	}
	if ($CrT=='kode3'){
		$KdE = substr($KdE,0,15).".".$NiL;
	}
	
	$CeK = fGlobal("IDT","ta_apbd_program_skpd","idProgram:periode:IDT",$KdE.":".$gTHN.":".$IdT,"=:=:<>","","");
	if (!$CeK){
		$nSQ = "update ta_apbd_program_skpd set idProgram='".strtoupper($KdE)."' where idt='$IdT'";
		$nRs = mysql_query($nSQ);
		echo "<script type='text/javascript'>RefreshDATA('".$IdL."')</script>";
	}
	else{
		$MsG = "Kode program sudah digunakan..!!";
		echo "<script type='text/javascript'>errorMSG('".$MsG."')</script>";
		echo "<script type='text/javascript'>RefreshDATA('".$IdL."')</script>";
	}
}
$nRs = mysql_query($nSQ);
?>
