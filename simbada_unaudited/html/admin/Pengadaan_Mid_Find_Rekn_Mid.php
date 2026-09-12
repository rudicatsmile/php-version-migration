<?
require('Connection.php');
require('FileFunction.php');
require ('CheckLogin.php');

extract($_GET);
#echo $Jns;
$FnD = str_replace('**',' ',$FnD);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (Kd_Aset LIKE '%$FnD%' OR Nm_Aset LIKE '%$FnD%')";
	if ($Jns=='Tb8')
	{
		$CrT ="AND (P1.Kd_Aset LIKE '%$FnD%' OR P1.Nm_Aset LIKE '%$FnD%')";
	}
	
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="240" border="0">
	<?
	$iG=1;
	if ($Jns=='Tb3')
	{
		$eRK="(Kd_Aset = '1.3.1' OR
		Kd_Aset = '1.3.2' OR
		Kd_Aset = '1.3.3' OR
		Kd_Aset = '1.3.4' OR
		Kd_Aset = '1.3.5' OR
		Kd_Aset = '1.3.6' OR
		Kd_Aset = '1.5.3')";
		
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE $eRK $CrT ORDER by Kd_Aset";
		$w = 50;
	}
	else if ($Jns=='Tb8')
	{
		$eRK="(P1.Kd_Aset LIKE '1.3.1%' OR
		P1.Kd_Aset LIKE '1.3.2%' OR
		P1.Kd_Aset LIKE '1.3.3%' OR
		P1.Kd_Aset LIKE '1.3.4%' OR
		P1.Kd_Aset LIKE '1.3.5%' OR
		P1.Kd_Aset LIKE '1.3.6%' OR
		P1.Kd_Aset LIKE '1.5.3%')";
		
		$nSQ = "SELECT P1.Kd_Aset as A0, P1.Nm_Aset as A1, P2.Nm_Aset as A2 
		FROM ref_rek_aset108_7 P1 
		LEFT JOIN ref_rek_aset108_6 P2 ON P2.Kd_Aset=left(P1.Kd_Aset,14) 
		WHERE $eRK $CrT ORDER by P1.Kd_Aset LIMIT 0,200";
		$w = 110;
	}
	else if ($Jns=='Tb4' || $Jns=='Tb5' || $Jns=='Tb6' || $Jns=='Tb7')
	{
		$nSQ = "SELECT Kd_Aset, Nm_Aset 
		FROM ref_rek_aset108_".substr($Jns,-1,1)." 
		WHERE Kd_Aset LIKE '".$VsT."%' $CrT ORDER by Kd_Aset";
		
		if (substr($Jns,-1,1)==4){$w = 70;}
		if (substr($Jns,-1,1)==5){$w = 90;}
		if (substr($Jns,-1,1)==6){$w = 100;}
		if (substr($Jns,-1,1)==7){$w = 110;}
	}
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gKd = $mRo[0];
		$gNm = $mRo[1];
		$gNn = $mRo[1];
		$h = 20;
		if ($Jns=='Tb8')
		{
			$gNn = "<b>".$gNn."</b><br><i>".ucwords(strtolower($mRo[2]));
			$h = 35;
		}
		?>
		<tr height="<?=$h?>" onclick="showCLICK('<?=$Jns?>','<?=$gKd?>','<?=$gNm?>','<?=$IdT?>','<?=$IdL?>'); return false;">
			<td width="<?=$w?>" style="border-bottom:1px dotted #ccc; text-align:center"><?=$gKd?></td>
			<td style="border-bottom:1px dotted #CCCCCC; padding-right:15px"><?=$gNn?></td>
			<td width="40" style="border-bottom:1px dotted #ccc">&nbsp;</td>
		</tr>
		<?
		$iG++;
	}
	?>
	<? if ($iG==1) {?>
	<tr height="20">
		<td colspan="3" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<? } ?>
	<tr height="100%">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
<script>
$("#fDataRekn").focus();
</script>