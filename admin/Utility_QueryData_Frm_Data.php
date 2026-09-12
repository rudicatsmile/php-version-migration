<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$LbTB="100%";
$QrY = str_replace('**',' ',$gFnD);
$QrY = stripslashes(str_replace('','',$QrY));

if (strstr($QrY, "delete") or strstr($QrY, "insert") or strstr($QrY, "update")){
	#insert, delete
	$SQ = $QrY;
	$nR = mysql_query($SQ);
	if ($nR){
		echo "execute done...!!";
	}
	return false;
}

$dt = explode("from",strtolower($QrY));
$ts = $dt[0];
$NmF=array();
$JmF = 0;

$JmL =fHiSplitT2K($QrY,"*");

if ($JmL!=0){
	$tb = $dt[1];
	$tb = explode(" ",$tb);
	$tb = $tb[1];
	
	$iG=0;
	$SQ ="SHOW Fields FROM ".$tb;
	$nR = mysql_query($SQ) or die(mysql_error());
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$iG++;
		$NmF[$iG] = $mR['Field'];
	}
	$JmF = $iG;
}
else{
	$ts = explode("select",strtolower($ts));
	
	$ts = $ts[1];
	$JmF = fHiSplitT2K($ts,",");
	$ty = explode(",",$ts);
}

$LbTB=($JmF*120)."px";
?>
<div id="ViewDATA2" style="height:300px; width:1350px; overflow: auto; border:0px">
<table align="center" border="0" width="<?=$LbTB?>" class="table-list" cellspacing="0" cellpadding="0" style="border:0px; font-size:9pt">
<?php
if ($QrY!=""){
?>
	<tr style="background: #CCFF33; height:20px">
	<td style="width:30px; font-weight:bold; text-align:center; border-bottom:1px dotted #ccc">NO</td>
	<?php
	for ($i=0; $i<=$JmF; $i++)
	{
		if ($JmL>0){
			$vFld = $NmF[$i];
		}
		else{
			$vFld = $ty[$i];
		}
		$vFld = strtolower(trim($vFld));
		$vFld = str_replace("p1.","",$vFld);
		$vFld = str_replace("p2.","",$vFld);
		if ($vFld=="nm_aset" || $vFld=="keterangan" || $vFld=="uraian"){$wd=250;} else {$wd=100;}
		?>
			<td style="width:<?=$wd?>px; font-weight:bold; border-left:1px solid #ccc; text-align:center; border-bottom:1px dotted #ccc"><?=strtoupper($vFld)?></td>
		<?php
	}
	?>
	</tr>
<?php } ?>
<?php
if ($QrY!=""){
	$eG=1;
	$nRs = mysql_query($QrY);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		?>
		<tr <?=fBackCLR($eG)?>>
		<td width="24" valign="top" style="text-align:center; border-bottom:1px dotted #ccc"><?=$eG?>.</td>
		<?php
		for ($i=0; $i<=$JmF; $i++){
			$rRG = "";
			if ($JmL>0){
				$rFL = $NmF[$i];
				$rDT = $mRo[$NmF[$i]];
			}
			else{
				$rFL = $ty[$i];
				$rDT = $mRo[$i];
			}
			
			$rFL = trim(strtolower($rFL));
			$rFL = str_replace("p1.","",$rFL);
			$rFL = str_replace("p2.","",$rFL);
			if ($rFL=='harga' || $rFL=='nilai_akhir' || $rFL=='debet' || $rFL=='sum(debet)' || $rFL=='saldoakhir' || $rFL=='sum(saldoakhir)' || $rFL=='sum(nilai_tambah)' || $rFL=='nilai_tambah' || $rFL=='sum(nilai_perolehan)' || $rFL=='nilai_perolehan'){
				$rDT = fConvertToRupiah($rDT);
				$rRG = "right";
			}
			echo "<td align='".$rRG."' valign='top' style='padding:2px; border-bottom:1px dotted #ccc; border-left:1px solid #ccc; padding-left:3px'>".$rDT."</td>";
		}
		?>
		<td style='border-bottom:1px dotted #ccc'>&nbsp;</td>
		</tr>
		<?php
		$eG++;
	}
}
?>
</table>
</div>
<?php
if ($eG==1){echo "Data tidak ditemukan..!";}
?>
