<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$PaG=1;
$DataPerPage = 100;
$rPgE = $PgE/$DataPerPage;

$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	if ($eInV=="Invert"){
		$CrT ="AND (Referensi LIKE '%$gFnD%' OR Nm_Aset LIKE '%$FnD%' OR Kd_Aset LIKE '%$FnD%')";
	}
	else{
		$CrT ="AND (Referensi LIKE '%$gFnD%' OR Kd_Aset LIKE '%$FnD%')";
	}
}

$ExTR = fGlobal("nilaiExtracom","ref_rek_aset1","Kd_Aset",$gExT,"=","","");


if ($eMuT){
	$rMuT="_mutasi";
}
else{
	$rMuT="";
}

if ($eInV=="Invert"){
	$nSQ = "select count(*) as JmLD 
	FROM ta_kib_108_108 
	WHERE Kd_UPB LIKE '$gUnT%' AND Kd_aset like '".$gExT."%'".$CrT;
}
else{
	$nSQ = "select count(*) as JmLD 
	FROM ta_kib_post_108".$rMuT." 
	WHERE Kd_UPB LIKE '$gUnT%' AND kd_aset like '".$gExT."%'".$CrT;
}
#echo $nSQ;
$nRs = mysql_query($nSQ);
$mRo = mysql_fetch_assoc($nRs);
$JumData=$mRo['JmLD'];

if ($JumData>$DataPerPage)
{
	$PaG = ceil($JumData/$DataPerPage);
}
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" class="table-link" style="width:100%; height:50px">
<tr>
<td width="14"></td>
<td>
<?php if ($JumData>1)
{
	echo "<div class='pagging'>";
	for ($iA = 0; $iA <= $PaG-1; $iA++)
	{
	if ($iA==$rPgE){
		$iK = "style='color:#ff0000; font-weight:bold'";
	}
	else{
		$iK = "";
	}
	?>
	<a href="#" onclick="RefreshDATA('<?=($iA*$DataPerPage)?>','<?=$IdL?>');return false;" <?=$iK?>><?=($iA+1)?></a>
	<?php }
	echo "</div>";
}
?>

</td>
<td width="14">&nbsp;</td>
<td width="151" style="font-size:15px">Nilai KIB-<?=strtoupper(fNmHuruf((int)$gExT))?></td>
<td width="28">Rp.</td>
<td width="132" style="text-align:right">
<input name="fFnD" type="text" value="<?=fConvertToRupiah($Nil)?>" readonly style="padding-right:4px; width:130px; border: 1px solid #C0C0C0; text-align:right"/></td>
<td width="10">&nbsp;</td>
<td width="9">&nbsp;</td>
</tr>
</table>
