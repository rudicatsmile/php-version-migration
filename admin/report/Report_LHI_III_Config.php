<?php
if ($fKoNA=='00')
{
	$KoNA = "%";
	$NmKA = 'SEMUA KONDISI';
}
else
{
	$KoNA = $fKoNA;
	$NmKA = strtoupper(fNmKondisi($fKoNA));
}

if ($fKoNB=='00')
{
	$KoNB = "%";
	$NmKB = 'SEMUA KONDISI';
}
else
{
	$KoNB = $fKoNB;
	$NmKB = strtoupper(fNmKondisi($fKoNB));
}

if ($fAsT=='0.0.0')
{
	$AsT = "%";
	$NmA = 'BMD BERUPA ASET : SEMUA JENIS ASET';
}
else
{
	$AsT = $fAsT;
	$NmA = "BMD BERUPA ASET : ".fGlobal("Nm_Aset","ref_rek_aset108_3","Kd_Aset",$AsT,"=","","");
}
?>