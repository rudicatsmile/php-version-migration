<?
require('Connection.php');
require('FileFunction.php');
require('CheckLogin.php');
extract($_GET);

if ($SeM=='1')
{
	$TgA = $ThN."-01-01";
	$TgB = $ThN."-06-30";
}
else if ($SeM=='2')
{
	$TgA = $ThN."-07-01";
	$TgB = $ThN."-12-31";
}
else 
{
	$TgA = $ThN."-01-01";
	$TgB = $ThN."-12-31";
}

$SyT = "";
if ($FnD){
	$SyT = " AND (P1.Faktur_Nomor LIKE '%".$FnD."%' 
	OR P1.Kd_Program LIKE '%".$FnD."%' 
	OR P1.Nm_Program LIKE '%".$FnD."%' 
	OR P1.Kd_Kegiatan LIKE '%".$FnD."%' 
	OR P1.Nm_Kegiatan LIKE '%".$FnD."%' 
	OR P1.Kd_SubKegiatan LIKE '%".$FnD."%' 
	OR P1.Nm_SubKegiatan LIKE '%".$FnD."%' 
	OR P1.Kd_Rek13 LIKE '%".$FnD."%' 
	OR P1.Nm_Rek13 LIKE '%".$FnD."%')";
}

$nSQ = "SELECT count(*) 
FROM ta_penerimaan_non_apbd WHERE Kd_Unit='".$UnT."' AND JenisNonApbd='".$JnsNon."' AND (Tanggal BETWEEN '".$TgA."' AND '".$TgB."') $SyT ";
$nRs = mysql_query($nSQ);
$mRo = mysql_fetch_array($nRs);
$JmREC   = $mRo[0];
if ($JmREC>$PerPage)
{
	$PaG = ceil($JmREC/$PerPage);
}
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:100%">
  <tr height="28">
	<td valign="middle">
	
	<? if ($JmREC>0)
	{
		?>
		<div class="pagging">
		<?
		if ($JmREC < $PerPage)
		{
			$d="style='color:#ff0000;'";
			?>
			<a href="#" <?=$d?> onclick="pageDATA('0','<?=$PerPage?>','<?=$JnsNon?>','<?=$IdL?>');return false;">01</a>
			<?
		}
		else
		{
			for ($iA = 0; $iA <= $PaG-1; $iA++)
			{
				if ($iA==($PagB/$PerPage)){$d="style='color:#ff0000;'";}
				else {$d="";}
				
				if ($iA==0) {$iB = $iA;}
				else {$iB = $iA*$PerPage;}
				
				if (($PaG-1) < 100)
				{
					?>
					<a href="#" <?=$d?> onclick="pageDATA('<?=$iB?>','<?=$iA*$PerPage?>','<?=$JnsNon?>','<?=$IdL?>');return false;"><?=substr("00".($iA+1),-2,2)?></a>
					<?
				}
				else if (($PaG-1) < 1000)
				{
					?>
					<a href="#" <?=$d?> onclick="pageDATA('<?=$iB?>','<?=$iA*$PerPage?>','<?=$JnsNon?>','<?=$IdL?>');return false;"><?=substr("000".($iA+1),-3,3)?></a>
					<?
				} else {
					?>
					<a href="#" <?=$d?> onclick="pageDATA('<?=$iB?>','<?=$iA*$PerPage?>','<?=$JnsNon?>','<?=$IdL?>');return false;"><?=substr("0000".($iA+1),-4,4)?></a>
					<? 
				}
			}
		}
		?>
		</div>
		<? 
	} 
	?>	</td>
  </tr>
</table>

