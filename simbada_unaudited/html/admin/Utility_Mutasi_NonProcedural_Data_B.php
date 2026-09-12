<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$FnD = str_replace('**',' ',$gFnD);

$CrT = "";
if ($FnD)
{
	$CrT ="AND (nm_aset LIKE '%$FnD%' OR referensi LIKE '%$FnD%' OR kd_aset LIKE '%$FnD%' OR harga LIKE '$FnD%')";
}

if ($gUPB){$gSkP = $gUPB;}
else{
	if ($gSUB){$gSkP = $gSUB;}
	else{$gSkP = $gUNT;}
}
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" class="table-list" style="width:100%; height:100%">
<?
$iG=$PgE+1;
if ($gSkP)
{
	$nSQ = "SELECT idt,referensi,kd_aset,no_register,nm_aset,harga,tgl_perolehan,kd_upb FROM ta_kib_".$gTbL." WHERE kd_upb LIKE '$gSkP%' $CrT ORDER BY tgl_perolehan,kd_aset,no_register LIMIT $PgE,500";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gId = $mRo[0];
		$gRf = $mRo[1];
		$gKd = $mRo[2];
		$gRg = $mRo[3];
		$gNm = $mRo[4];
		$gHg = $mRo[5];
		$gTh = substr($mRo[6],0,4);
		$rUP = $mRo[7];
		$gBc = "; ".TxBckCLR($iG);
		$imG ="";
		$gHA  = fGlobalNEW("IfNull(sum(debet),0)","ta_kib_post","referensi:kd_upb",$gRf.":".$rUP,"=:=","",DatabaseSB,$ConSB,"");
		$CeKD = "";//fGlobalNEW("idt","ta_kib_".$gTbL."_mutasi","referensi_to",$gRf,"=","",DatabaseSC,$ConSC,"adf");
		if ($CeKD!=""){
			$imG="<img height='8' width='10' src='css/images/okey.gif' />";
		}
		
		$rC="";
		if ($gHA > $gHg){
			$rC = "; color:#0000ff";
		}
		else if ($gHA < $gHg){
			$rC = "; color:#ff0000";
		}
	?>
	<tr height="40px">
	  <td valign="top" style="text-align:center; border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; <?=$gBc?>"><?=$iG?>.</td>
	  <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; padding-left:4px; <?=$gBc?>"><?=$gRf."<br>".$gKd?></td>
	  <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; padding-left:4px; <?=$gBc?>"><?=$gNm?></td>
	  <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; padding-left:4px; text-align:center; <?=$gBc?>"><?=$gTh?></td>
	  <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; padding-left:4px; text-align:center; <?=$gBc?>"><?=$imG?></td>
	  <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; padding-right:2px; text-align:right <?=$gBc?>"><?=fConvertToRupiahBulat($gHg)?></td>
	  <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc; padding-right:4px; text-align:right <?=$gBc.$rC?>"><?=fConvertToRupiahBulat($gHA)?></td>
	  <td valign="top" style="border-bottom:1px dotted #ccc"><input type="checkbox" name="rDana" value="<?=$gId?>"  /></td>
	</tr>
	<?
		$iG++;
	}
}
?>
<? if ($iG==1){?>
<tr height="20px">
  <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc">&nbsp;</td>
  <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc">&nbsp;</td>
  <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc">&nbsp;</td>
  <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc">&nbsp;</td>
  <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc">&nbsp;</td>
  <td valign="top" style="border-bottom:1px dotted #ccc">&nbsp;</td>
  <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc">&nbsp;</td>
  <td valign="top" style="border-bottom:1px dotted #ccc">&nbsp;</td>
</tr>
<? } ?>
<tr height="100%">
  <td width="28" valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc">&nbsp;</td>
  <td width="100" valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc">&nbsp;</td>
  <td valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc">&nbsp;</td>
  <td width="50" valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc">&nbsp;</td>
  <td width="30" valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc">&nbsp;</td>
  <td width="90" valign="top" style="border-bottom:1px dotted #ccc; text-align:right; font-weight:bold; color:#0000FF"><? if ($iG!=1){?>Tandai Semua<? } ?></td>
  <td width="90" valign="top" style="border-bottom:1px dotted #ccc; border-right:1px dotted #ccc">&nbsp;</td>
  <td width="20" valign="top" style="border-bottom:1px dotted #ccc"><? if ($iG!=1){?><input type="checkbox" name="rDana" value="" onclick="CheckAllb()" /><? } ?></td>
</tr>
</table>
<script languange="javascript">
//RefreshDATAa('<?=IdL?>','0');
</script>