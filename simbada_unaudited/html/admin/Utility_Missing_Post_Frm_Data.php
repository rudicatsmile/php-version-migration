<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

if ($gUnT=="ALL"){$gUnT="%";}
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	if ($eInV=="Invert"){
		$CrT ="AND (P1.Referensi LIKE '%$gFnD%' OR P1.Nm_Aset LIKE '%$FnD%' OR P1.Kd_Aset_108 LIKE '%$FnD%')";
	}
	else{
		$CrT ="AND (P1.Referensi LIKE '%$gFnD%' OR P2.Nm_Aset LIKE '%$FnD%' OR P1.Kd_Aset_108 LIKE '%$FnD%')";
	}
}

?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="355px" style="border:0px">
	<?
	$x=array();
	$iG=$PgE+1;
	$tJmL= 0;

	$Nil = 0;
	if ($eMuT){
		$rMuT="_mutasi";
	}
	else{
		$rMuT="";
	}
	
	if ($eInV=="Invert"){
		$nSQ = "select P2.Referensi as A0, 
		IfNull(sum(P2.Debet),0) as A1, 
		P1.Referensi as A2, 
		P1.Harga as A3, 
		P1.Kd_Aset_108 as A4, 
		P1.Nm_Aset as A5, 
		P1.Tgl_Perolehan as A6 
		FROM ta_kib_108".$rMuT." P1 
		LEFT JOIN ta_kib_post_108".$rMuT." P2 ON P2.Referensi=P1.Referensi AND LEFT(P2.Kd_UPB,11)=LEFT(P1.Kd_UPB,11) 
		WHERE P1.Kd_UPB LIKE '$gUnT%' AND P1.Kd_aset_108 like '".$gExT."%' $CrT group BY P1.Referensi ORDER BY P2.Referensi LIMIT $PgE,5000";
		
		$nSQ = "select P1.Referensi as A0, 
		IfNull(sum(P1.Debet),0) as A1, 
		P2.Referensi as A2, 
		P2.Harga as A3, 
		P2.Kd_Aset_108 as A4, 
		P2.Nm_Aset as A5, 
		P2.Tgl_Perolehan as A6 
		FROM ta_kib_post_108".$rMuT." P1 
		LEFT JOIN ta_kib_108".$rMuT." P2 ON P2.Referensi=P1.Referensi AND LEFT(P2.Kd_UPB,11)=LEFT(P1.Kd_UPB,11) 
		WHERE P1.Kd_UPB LIKE '$gUnT%' AND P1.Kd_aset_108 like '".$gExT."%' $CrT group BY P1.Referensi ORDER BY P2.Referensi LIMIT $PgE,5000";
	}
	else{
		$nSQ = "select P1.Referensi as A0, 
		IfNull(sum(P1.Debet),0) as A1, 
		P2.Referensi as A2, 
		P2.Harga as A3, 
		P2.Kd_Aset_108 as A4, 
		P2.Nm_Aset as A5, 
		P2.Tgl_Perolehan as A6 
		FROM ta_kib_post_108".$rMuT." P1 
		LEFT JOIN ta_kib_108".$rMuT." P2 ON P2.Referensi=P1.Referensi AND LEFT(P2.Kd_UPB,11)=LEFT(P1.Kd_UPB,11) 
		WHERE P1.Kd_UPB LIKE '$gUnT%' AND P1.kd_aset_108 like '".$gExT."%' $CrT group BY P1.Referensi ORDER BY P2.Referensi LIMIT $PgE,5000";
	}
	#echo $nSQ."<br>";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$xB = "";
		$x[1]=""; $x[2]=""; $x[3]=""; $x[4]=""; $x[5]=""; $x[6]=0; $x[7]=0; $x[8]=""; $x[9]="";
		$tREF = $mRo[0];
		$x[1] = $mRo[0];
		$x[2] = $mRo[1];
		$x[3] = $mRo[2];
		$x[4] = $mRo[3];
		$x[5] = $mRo[4];
		if ($eInV=="Invert"){
			if ($x[1]==""){
				$x[6] = "<font style='color:#ff0000'>==> Missing data posting ......????????##&^%</font>";
				$x[7] = "";
				$rCeK = "checked";
				$rDiS = "";
			}
			else{
				$x[6] = $mRo[5];
				$x[7] = fConvertDateShort($mRo[6]);
				$rCeK = "";
				$rDiS = "disabled";
			}
		}
		else{
			if ($x[3]==""){
				$x[6] = "<font style='color:#ff0000'>==> Missing data kib ......????????##&^%</font>";
				#$SWE = "DELETE FROM ta_kib_post_108".$rMuT." WHERE referensi='".$tREF."' AND Kd_UPB LIKE '$gUnT%'";
				#$nRE = mysql_query($SWE);
				#echo $SWE."<br>";
				$x[7] = "";
				$rCeK = "checked";
				$rDiS = "";
			}
			else{
				$x[6] = $mRo[5];
				$x[7] = fConvertDateShort($mRo[6]);
				$rCeK = "";
				$rDiS = "disabled";
			}
		}
		
		$rC1="";
		$rC2="";
		if ($x[2]> $x[4]){
			$rC1="; color:#0000ff";
			$rC2="";
		}
		else if ($x[2] < $x[4]){
			$rC1="";
			$rC2="; color:#ff0000";
		}
		
		#$x[5] = fConvertDateShort($mRo[5]);
		#$x[6] = $mRo[6];
		#$x[7] = $mRo[7];
		
		#$x[8] = "<font style='color:#ff0000'>?????</font>";
		#if ($mRo[8]=="Y"){
		#	$x[8] = "<i>extracom</i>";
		#}
		#$rCeK = "checked";
		#$rDiS = "";
		#if ($eMuT!=""){
		#	$x[9] = $mRo[9]." <font style='background:#000; color:#fff'><i>&nbsp;sudah mutasi&nbsp;</i><font> Ke : ".$mRo[10]."&nbsp;";
		#}
		#else{
		#	$x[9] = $mRo[10]." : ".$mRo[9];
		#}
		rinciDATA($x[1],$x[2],$x[3],$x[4],$x[5],$x[6],$x[7],$x[8],$x[9],$iG,$tREF,$rC1,$rC2,$rCeK,$rDiS,$xB);
		//$Nil = $Nil+$x[7];
		$iG++;
	}
	#}

?>
<? function rinciDATA($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$iG,$ref,$rC1,$rC2,$rCeK,$rDiS,$xB){?>
	<?
	$gBG  = fBackCLR($iG);
	?>
	<tr height="22"> 
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x1?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:right; padding-right:3px <?=$rC1?>"><?=fConvertToRupiah($x2)?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x3?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right <?=$rC2?>"><?=fConvertToRupiah($x4)?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x5?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px"><?=$x6?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x7?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px"><?=$x9?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:6px"><input type="checkbox" <?=$rCeK?> <?=$rDiS?> name="fComP" value="<?=$idt?>" /></td>
	</tr>
<? } ?>
<? if ($iG==1) {?>
<tr height="100%">
 <td colspan="11" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
<tr height="100%">
 <td width="25" style="border-bottom:0px #999999 dotted">&nbsp;</td>
 <td width="110" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="120" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="110" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="120" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="100" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="370" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="90" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
 <td width="30" style="border-bottom:0px #999999 dotted; border-left:0px #ccc solid">&nbsp;</td>
</tr>
</table>
<script languange="javascript">
	RefreshDATAreff('<?=$PgE?>','<?=$IdL?>');
</script>