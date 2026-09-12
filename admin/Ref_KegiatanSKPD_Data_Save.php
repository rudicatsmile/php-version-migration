<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$NiL = str_replace("**"," ",$NiL);

if ($CrT=="desk"){
	$nSQ = "update ta_apbd_kegiatan_skpd set nmKegiatan='$NiL' where idt='$IdT'";
	$nRs = mysql_query($nSQ);
	echo "<script type='text/javascript'>RefreshDATA('".$IdL."')</script>";
}
else{
	$KdE = fGlobal("idKegiatan","ta_apbd_kegiatan_skpd","IDT",$IdT,"=","","");
	$KdE = substr($KdE,0,18).".".$NiL;
	
	$CeK = fGlobal("IDT","ta_apbd_kegiatan_skpd","idKegiatan:periode:IDT",$KdE.":".$gTHN.":".$IdT,"=:=:<>","","");
	if (!$CeK){
		$nSQ = "update ta_apbd_kegiatan_skpd set idKegiatan='".strtoupper($KdE)."' where idt='$IdT'";
		$nRs = mysql_query($nSQ);
		echo "<script type='text/javascript'>RefreshDATA('".$IdL."')</script>";
	}
	else{
		$MsG = "Kode kegiatan sudah digunakan..!!";
		echo "<script type='text/javascript'>errorMSG('".$MsG."')</script>";
		echo "<script type='text/javascript'>RefreshDATA('".$IdL."')</script>";
	}
}
?>
