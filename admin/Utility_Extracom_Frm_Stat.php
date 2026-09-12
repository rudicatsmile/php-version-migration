<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
//echo $gThN;

if ($gNoN=="Y"){
	$tTi="REMOVE DARI EXTRA";
}
else{
	$tTi="PROSES KE EXTRA";
}
#if ($gExT=='1.3.2'){
#	if ($gThN=="B"){
#		$ExTR = fGlobal("nilaiExtracom","ref_rek_aset108_3","Kd_Aset",$gExT,"=","","");
#	}
#	else{
#		$ExTR = 1000000;
#	}
#}
#else{
	$ExTR = fConvertToRupiah(fGlobal("nilaiExtracom","ref_rek_aset108_3","Kd_Aset",$gExT,"=","",""));
	if ($gExT=='1.5.4' || $gExT=='1.3.5'){$ExTR='Kolom Parameter&nbsp;';}
#}

?>
<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:100%; height:50px; font-size:15px">
<tr>
<td width="30"></td>
<td width="120">Parameter KIB-<?=strtoupper(fNmHuruf108($gExT))?></td>
<td width="20">Rp.</td>
<td width="130" style="text-align:right; font-weight:bold">
<input name="fFnD" type="text" value="<?=$ExTR?>" readonly style="padding-right:4px; width:110px; border: 1px solid #C0C0C0; text-align:right"/>
</td>
<td width="175">&nbsp;</td>
<td width="200">Nilai Extracomptable KIB-<?=strtoupper(fNmHuruf108($gExT))?></td>
<td width="20">Rp.</td>
<td width="130" style="text-align:right; font-weight:bold">
<input name="fFnD" type="text" value="<?=fConvertToRupiah($Nil)?>" readonly style="padding-right:4px; width:110px; border: 1px solid #C0C0C0; text-align:right"/>
</td>
<td>&nbsp;</td>
<td width="150"><input type="button" name="B39" value="<?=$tTi?>" onclick="ExecDATA('<?=$IdL?>')" style="width: 140px; height: 24px; color:#FF0000" /></td>
<td width="5">&nbsp;</td>
</tr>
</table>