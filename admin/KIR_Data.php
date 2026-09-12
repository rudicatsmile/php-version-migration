<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
#echo $gAST;
if ($gRUA==""){$gRUA="XXX";}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="100%" style="border:0px">
<?php
$iG=1;
$tJmL=0;

#echo $gAST."<br>";
if ($gAST=='B')
{
	$ReK = "AND Kd_Aset_108 NOT LIKE '1.5.3%' AND Kd_Aset_108 NOT LIKE '1.5.4%'";
}
else if ($gAST=='E')
{
	$ReK = "AND (Kd_Aset_108 LIKE '1.5.3%' OR Kd_Aset_108 LIKE '1.5.4%')";
}
else if ($gAST=='X')
{
	$ReK = "";
}

#if ($gAST=='B' || $gAST=='X')
#{
	$nSQ = "SELECT IDT, Kd_Aset_108, No_Register, Nm_Aset, Merk, Type, Tgl_Perolehan, Asal_Usul, Kondisi, Harga, kode_bar 
	FROM ta_kib_108 WHERE Kd_UPB LIKE '".$gUPB."' $ReK AND Kd_Ruang='$gRUA' ORDER BY Kd_Aset_108, No_Register";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gBG  = fBackCLR($iG);
		$gIDT = $mRo[0];
		$DeL  = "";
		?>
		<tr height="26"> 
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[2]?></td>
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
			<a href="#" class="ico prev" onClick="printLABEL('650','350','<?=$gIDT?>','<?=$IdL?>'); return false;"></a>
			<?php
			if($mRo[10]!=''){
			?>
				&nbsp;&nbsp;<a href="#" class="ico oke" onClick="printQR('650','350','','<?=$gIDT?>','<?=$IdL?>'); return false;"></a>
			<?php
			}else{
			?>
				&nbsp;&nbsp;<a href="#" class="ico open" onClick="printQR('650','350','<?=$mRo[1]?>','<?=$gIDT?>','<?=$IdL?>'); return false;"></a>
			<?php
			}
			?>
			
		  </td>
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; border-left:1px #ccc solid; text-align:left"><?=$mRo[3]?></td>
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid"><?=$mRo[4]?></td>
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid"><?=$mRo[5]?></td>
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=fConvertDateShort($mRo[6])?></td>
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[7]?></td>
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[8]?></td>
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:2px; text-align:right"><?=fConvertToRupiah($mRo[9])?></td>
		  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
		  <a href="#" onClick="formDELE('<?=$gIDT?>:b','<?=$IdL?>'); return false" class="ico dele">rem</a>	  </td>
		</tr>
		<?php
		$iG++;
	}
#}

?>
<tr height="100%">
 <td width="35" style="border-left:0px #ccc solid">&nbsp;</td>
 <td width="110" style="border-left:1px #ccc solid">&nbsp;</td>
 <td width="56" style="border-left:1px #ccc solid">&nbsp;</td>
 <td width="45" style="border-left:1px #ccc solid">&nbsp;</td>
 <td width="280" style="border-left:1px #ccc solid">&nbsp;</td>
 <td width="190" style="border-left:1px #ccc solid">&nbsp;</td>
 <td width="190" style="border-left:1px #ccc solid">&nbsp;</td>
 <td width="80" style="border-left:1px #ccc solid">&nbsp;</td>
 <td width="90" style="border-left:1px #ccc solid">&nbsp;</td>
 <td width="60" style="border-left:1px #ccc solid">&nbsp;</td>
 <td width="110" style="border-left:1px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid">&nbsp;</td>
</tr>


</table>
