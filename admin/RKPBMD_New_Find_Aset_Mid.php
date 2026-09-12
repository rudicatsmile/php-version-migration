<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
//$gTBL= "b";
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";

//$gREF = fGlobal("Referensi","ta_usulan","IDT",$IdT,"=","","");
if ($FnD)
{
	$CrT ="AND (Kd_Aset LIKE '%$gFnD%' OR Nm_Aset LIKE '%$FnD%'";
	if ($gTBL=='a') {$CrT.=" OR Alamat LIKE '%$FnD%' OR Luas_M2 LIKE '%$FnD%'";}
	if ($gTBL=='b') {$CrT.=" OR Merk LIKE '%$FnD%' OR Type LIKE '%$FnD%'";}
	if ($gTBL=='c') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Luas_Lantai LIKE '%$FnD%'";}
	if ($gTBL=='d') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Konstruksi LIKE '%$FnD%'";}
	if ($gTBL=='e') {$CrT.=" OR Bahan LIKE '%$FnD%' OR Judul LIKE '%$FnD%'";}
	if ($gTBL=='g') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Dokumen_Nomor LIKE '%$FnD%'";}
	$CrT.=")";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="240" border="0" style="font-family:arial; font-size:8pt">
	<?php
	$iG=1;
	if ($gTBL=='a') {$Fld=",Alamat,Luas_M2,Referensi";}
	if ($gTBL=='b') {$Fld=",Merk,Type,Referensi";}
	if ($gTBL=='c') {$Fld=",Lokasi,Luas_Lantai,Referensi";}
	if ($gTBL=='d') {$Fld=",Lokasi,Konstruksi,Referensi";}
	if ($gTBL=='e') {$Fld=",Bahan,Judul,Referensi";}
	if ($gTBL=='g') {$Fld=",Asal_Usul,Kondisi,Referensi";}
	
	$nSQ = "SELECT IDT, Kd_Aset, No_Register, Nm_Aset, Tgl_Perolehan, Keterangan, Harga $Fld FROM ta_kib_".$gTBL." WHERE Kd_UPB LIKE '".substr($gUPB,0,11)."%' $CrT ORDER BY Kd_Aset, No_Register, Tgl_Perolehan LIMIT 0,200";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rIdT= $mRo[0];
		$gKD = $mRo[1];
		$gRG = $mRo[2];
		$gNM = $mRo[3];
		$gTG = $mRo[4];
		$gKT = $mRo[5];
		$gHR = $mRo[6];
		$g06 = $mRo[7];
		$g07 = $mRo[8];
		$gRF = $mRo[9];
		
		if ($gTBL=='c') {$g07=$g07." <sup>m</sup>";}
		?>
		<tr height="20">
			<td valign="top" width="30" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$iG?>.</td>
			<td valign="top" width="90" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$gKD?></td>
			<td valign="top" width="55" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$gRG?></td>
			<td valign="top" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$gNM?></td>
			<td valign="top" width="40" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=substr($gTG,0,4)?></td>
			<td valign="top" width="200" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$gKT?></td>
			<td valign="top" width="150" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$g06?></td>
			<td valign="top" width="150" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$g07?></td>
			<td valign="top" width="90" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($gHR)?></td>
			<td valign="top" width="50" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; text-align:center">
			<a href="#" class="ico add" onclick="P_AddItemAsetNext('<?=$gRF?>','<?=$IdL?>'); return false;">Add</a>
			</td>
		</tr>
		<?php
		$iG++;
	}
	?>
	<?php if ($iG==1) {?>
	<tr height="20">
		<td colspan="10" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<?php } ?>
	<tr height="100%">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="7">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
