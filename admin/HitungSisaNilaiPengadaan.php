<?php
function fHitSisaD($rTBL,$gNoM,$gNiL,$fTotal,$rIDT,$DatabaseSB,$ConSB)
{
	$vUse = fGlobalNEW("IfNull(sum(Nilai_Pengadaan),0)",$rTBL,"No_Pengadaan",$gNoM,"=","",$DatabaseSB,$ConSB,"");
	$nVaL = 0;
	if ($rIDT)
	{
		$nVaL = fGlobalNEW("Nilai_Pengadaan",$rTBL,"IDT",$rIDT,"=","",$DatabaseSB,$ConSB,"");
	}
	
	$tSis = $gNiL - ($vUse-$nVaL);
	if ($fTotal == 0)
	{
		$gNiL = $fTotal;
	}
	else 
	{
		if ($fTotal<=$tSis) {$gNiL = $fTotal;}
		else {$gNiL = $tSis;}
	}
	return $gNiL;
}
?>