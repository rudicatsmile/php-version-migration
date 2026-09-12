<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT = "AND (Kd_Unit LIKE '%$FnD%' OR Nm_Unit LIKE '%$FnD%')";
}
?>
<table align="center" class="table-form" border="0" cellspacing="0" cellpadding="0" style="width:100%">
  <?
	$iG=1;
	$nSQ = "SELECT IDT, Kd_Unit, Nm_Unit FROM ref_unit WHERE aktif='Y' $CrT ORDER BY Kd_Unit";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$kdU = $mRo[1];
		$CeK = fGlobalNEW("IDT","ta_unit_lock","kdUnit:tahunBMD:periodeBMD",$kdU.":".$gTHN.":".$gUBH,"=:=:=","",DatabaseSB,$ConSB,"");
		if (!$CeK){
			$SQ="INSERT INTO ta_unit_lock SET 
			kdUnit='".$kdU."',
			pengadaanBMD='0',
			pemeliharaanBMD='0',
			pemindahtangananBMD='0',
			tahunBMD='$gTHN',
			periodeBMD='$gUBH'";
			$Rs = mysql_query($SQ);
		}
		
		$rID = fGlobalNEW("IDT","ta_unit_lock","kdUnit:tahunBMD:periodeBMD",$kdU.":".$gTHN.":".$gUBH,"=:=:=","",DatabaseSB,$ConSB,"");
		$rPenga = fGlobalNEW("pengadaanBMD","ta_unit_lock","kdUnit:tahunBMD:periodeBMD",$kdU.":".$gTHN.":".$gUBH,"=:=:=","",DatabaseSB,$ConSB,"");
		//echo $rPenga."<br>";
		$rPenga1= "";
		$rPenga2= "checked";
		
		$rPengaC1= "";
		$rPengaC2= "style='color:#0000ff'";
		
		if ($rPenga == "1"){
			$rPenga1= "checked";
			$rPenga2= "";
			
			$rPengaC1= "style='color:#ff0000'";
			$rPengaC2= "";
		}
		#echo $rPenga1."<br>";
		$rPemel = fGlobalNEW("pemeliharaanBMD","ta_unit_lock","kdUnit:tahunBMD:periodeBMD",$kdU.":".$gTHN.":".$gUBH,"=:=:=","",DatabaseSB,$ConSB,"");
		$rPemel1= "";
		$rPemel2= "checked";
		
		$rPemelC1= "";
		$rPemelC2= "style='color:#0000ff'";
			
		if ($rPemel == 1){
			$rPemel1= "checked";
			$rPemel2= "";
			
			$rPemelC1= "style='color:#ff0000'";
			$rPemelC2= "";
		}
		
		$rPemin = fGlobalNEW("pemindahtangananBMD","ta_unit_lock","kdUnit:tahunBMD:periodeBMD",$kdU.":".$gTHN.":".$gUBH,"=:=:=","",DatabaseSB,$ConSB,"");
		$rPemin1= "";
		$rPemin2= "checked";
		
		$rPeminC1= "";
		$rPeminC2= "style='color:#0000ff'";
			
		if ($rPemin == 1){
			$rPemin1= "checked";
			$rPemin2= "";
			
			$rPeminC1= "style='color:#ff0000'";
			$rPeminC2= "";
		}
		
		?>
		<tr height="25" style="cursor: pointer"> 
		<td <?=fBackCLR($iG)?> style="border-bottom: 1px dotted #ccc; border-right: 1px solid #ccc; text-align:center"><?=$mRo[0]?>.</td>
		<td style="border-bottom: 1px dotted #ccc; border-right: 1px solid #ccc; text-align:center" <?=fBackCLR($iG)?>><?=$mRo[1]?></td>
		<td style="border-bottom: 1px dotted #ccc; border-right: 1px solid #ccc; padding-left:3px; text-transform:uppercase" <?=fBackCLR($iG)?>><?=$mRo[2]?></td>
		<td style="border-bottom: 1px dotted #ccc; border-right: 1px solid #ccc; text-align:center" <?=fBackCLR($iG)?>>
			<label <?=$rPengaC1?>><input name="rPengadaan<?=$mRo[0]?>" type="radio" value="1" <?=$rPenga1?> onclick="saveDATA('1','pengadaanBMD','<?=$rID?>','<?=$IdL?>')" />&nbsp;Lock</label>
			<label <?=$rPengaC2?>><input name="rPengadaan<?=$mRo[0]?>" type="radio" value="0" <?=$rPenga2?> onclick="saveDATA('0','pengadaanBMD','<?=$rID?>','<?=$IdL?>')" />&nbsp;UnLock</label>				
		</td>
		<td style="border-bottom: 1px dotted #ccc; text-align:center; border-right: 1px solid #ccc" <?=fBackCLR($iG)?>>
			<label <?=$rPemelC1?>><input name="rPemeliharaan<?=$mRo[0]?>" type="radio" value="1" <?=$rPemel1?> onclick="saveDATA('1','pemeliharaanBMD','<?=$rID?>','<?=$IdL?>')" />&nbsp;Lock</label>
			<label <?=$rPemelC2?>><input name="rPemeliharaan<?=$mRo[0]?>" type="radio" value="0" <?=$rPemel2?> onclick="saveDATA('0','pemeliharaanBMD','<?=$rID?>','<?=$IdL?>')" />&nbsp;UnLock</label>
		</td>
		<td style="border-bottom: 1px dotted #ccc; text-align:center" <?=fBackCLR($iG)?>>
			<label <?=$rPeminC1?>><input name="rPemindahtangan<?=$mRo[0]?>" type="radio" value="1" <?=$rPemin1?> onclick="saveDATA('1','pemindahtangananBMD','<?=$rID?>','<?=$IdL?>')" />&nbsp;Lock</label>
			<label <?=$rPeminC2?>><input name="rPemindahtangan<?=$mRo[0]?>" type="radio" value="0" <?=$rPemin2?> onclick="saveDATA('0','pemindahtangananBMD','<?=$rID?>','<?=$IdL?>')" />&nbsp;UnLock</label>
		</td>
		</tr>
		<?
		$iG++;
	}
	?>
  <tr height="100%"> 
	<td width="30"></td>
	<td width="76"></td>
	<td width="440"></td>
	<td width="150"></td>
	<td width="150"></td>
	<td></td>
  </tr>
</table>
