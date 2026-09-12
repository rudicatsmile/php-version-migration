<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
//echo $IdT;
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
$gREF = fGlobal("Referensi","ta_rpbmd_new","IDT",$kIdT,"=","","");
if ($FnD)
{
	$CrT ="AND (Referensi LIKE '%$FnD%' OR Kd_Aset LIKE '%$FnD%' OR Nm_Aset LIKE '%$FnD%'";
	if ($gTBL=='TNH') {$CrT.=" OR Alamat LIKE '%$FnD%' OR Luas_M2 LIKE '%$FnD%'";}
	if ($gTBL=='ALT') {$CrT.=" OR Merk LIKE '%$FnD%' OR Type LIKE '%$FnD%'";}
	if ($gTBL=='BNG') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Luas_Lantai LIKE '%$FnD%'";}
	if ($gTBL=='JLN') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Konstruksi LIKE '%$FnD%'";}
	if ($gTBL=='ATL') {$CrT.=" OR Bahan LIKE '%$FnD%' OR Judul LIKE '%$FnD%'";}
	if ($gTBL=='ATB') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Dokumen_Nomor LIKE '%$FnD%'";}
	if ($gTBL=='KDL') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Dokumen_Nomor LIKE '%$FnD%'";}
	$CrT.=")";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="100%" border="0" style="font-family:arial; font-size:8pt">
	<?
	$iG=1;
	if ($gTBL=='TNH') {$Fld=",Alamat,Luas_M2,Referensi";}
	if ($gTBL=='ALT') {$Fld=",Merk,Type,Referensi";}
	if ($gTBL=='BNG') {$Fld=",Lokasi,Luas_Lantai,Referensi";}
	if ($gTBL=='JLN') {$Fld=",Lokasi,Konstruksi,Referensi";}
	if ($gTBL=='ATL') {$Fld=",Bahan,Judul,Referensi";}
	if ($gTBL=='ATB') {$Fld=",Asal_Usul,Kondisi,Referensi";}
	if ($gTBL=='KDL') {$Fld=",Asal_Usul,Kondisi,Referensi";}
	
	#$nSQ = "SELECT IDT, Kd_Aset, No_Register, Nm_Aset, Tgl_Perolehan, Keterangan, Harga $Fld FROM ta_kib_".$gTBL." WHERE Kd_UPB LIKE '$gUNT%' $CrT ORDER BY Kd_Aset, No_Register, Tgl_Perolehan LIMIT 0,500";
	$nSQ = "SELECT IDT, Kd_Aset_108, No_Register, Nm_Aset, Tgl_Perolehan, Keterangan, Harga $Fld FROM ta_kib_108 WHERE Referensi LIKE '".$gTBL."%' AND Kd_UPB LIKE '$gUNT%' $CrT ORDER BY Kd_Aset_108, No_Register, Tgl_Perolehan LIMIT 0,200";
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
		if ($gNM==''){$gNM = fGlobal("nm_aset","ref_rek_aset5","kd_aset",$gKD,"=","","");}
		
		$aset = "aset";
		if ($gTBL=='c') {$g07=$g07." <sup>m</sup>";}
		
		$CeK = fGlobal("IDT","ta_rpbmd_new_aset","Referensi:Ref_Aset",$gREF.":".$gRF,"=:=","","");
		if ($CeK!=""){
			$ico = "none";
			$aset= "edit";
			$mesg= "mesga";
			$refs= "";
			$disB= "disabled";
		}
		else{
			$CeK = fGlobal("Referensi","ta_rpbmd_new_aset","Ref_Aset:Kd_Unit:Referensi",$gRF.":".$gUNT."%:".$gREF,"=:LIKE:<>","","");
			if ($CeK!=""){
				$ico = "none";
				$aset= "none";
				$mesg= "mesgb";
				$refs= $CeK;
				$disB= "disabled";
			}
			else{
				$ico = "add";
				$aset= "add";
				$mesg= "";
				$refs= "";
				$disB= "";
			}
		}
		?>
		<tr height="20">
			<td valign="top" width="30" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$iG?>.</td>
			<td valign="top" width="90" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$gRF?></td>
			<td valign="top" width="55" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$gRG?></td>
			<td valign="top" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$gNM?></td>
			<td valign="top" width="40" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=substr($gTG,0,4)?></td>
			<td valign="top" width="200" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$gKT?></td>
			<td valign="top" width="150" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$g06?></td>
			<td valign="top" width="150" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$g07?></td>
			<td valign="top" width="90" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($gHR)?></td>
			<td valign="top" width="60" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center">
			<a href="#" class="ico <?=$ico?>" onclick="showCLICK('<?=$stLOCK?>','aset','<?=$mesg?>','<?=$refs?>','<?=$IdT?>','<?=$rIdT.":".$gTBL?>','<?=$IdL?>'); return false;"><?=$aset?></a>			</td>
		    <td valign="top" align="center" width="20" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC">
			<input <?=$disB?> type="checkbox" name="sDana" value="<?=$rIdT?>" /></td>
		</tr>
		<?
		$iG++;
	}
	?>
	<? if ($iG>1) {?>
	<tr height="20" valign="top">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="7">&nbsp;</td>
		<td colspan="2" align="center" style=" border:1px solid #FF0000; vertical-align:middle; cursor: pointer" onclick="proslNIL('<?=$stLOCK?>','aset','<?=$IdT?>','<?=$gTBL?>','<?=$IdL?>'); return false;">
		<a href="#" class="ico add">PROSES</a></td>
	</tr>
	<? } ?>
	<? if ($iG==1) {?>
	<tr height="20">
		<td colspan="11" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<? } ?>
	<tr height="100%" valign="top">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="7">&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
