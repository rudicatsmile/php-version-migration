<?
require('Connection.php');
require('FileFunction.php');
require('CheckLogin.php');
extract($_GET);

$LRef = "%";
if ($AsT=='1.3.1'){$LRef="TNH";}
if ($AsT=='1.3.2'){$LRef="ALT";}
if ($AsT=='1.3.3'){$LRef="BNG";}
if ($AsT=='1.3.4'){$LRef="JLN";}
if ($AsT=='1.3.5'){$LRef="ATL";}
if ($AsT=='1.5.3'){$LRef="ATB";}

if ($RoB=='0.0.0.00.00')
{
	$AsT = $AsT;
	$FiD = "AND (Kd_Aset_108 LIKE '".$AsT."%' OR Referensi LIKE '".$LRef."%')";
}
else
{
	if ($SsR=='0.0.0.00.00.00.000')
	{
		if ($SrO=='0.0.0.00.00.00')
		{
			$AsT = $RoB;
		}
		else
		{
			$AsT = $SrO;
		}
	}
	else
	{
		$AsT = $SsR;
	}
	$FiD = "AND Kd_Aset_108 LIKE '".$AsT."%'";
}

if ($UpB=='00.00.00.00.00.000')
{
	if ($SuB=='00.00.00.00.00')
	{
		$UnT = $UnT;
	}
	else
	{
		$UnT = $SuB;
	}
}
else
{
	$UnT = $UpB;
}

$SyT = "";

if ($AsT=='x.x.x')
{
	if ($FnD)
	{
		$SyT = " 
		AND (KdBarang LIKE '%".$FnD."%' OR Referensi LIKE '%".$FnD."%' OR NmBarang LIKE '%".$FnD."%' OR NmBarang_Spec LIKE '%".$FnD."%' OR KdRegister LIKE '%".$FnD."%' OR Alamat LIKE '%".$FnD."%' 
		OR Merk LIKE '%".$FnD."%' OR Type LIKE '%".$FnD."%' OR NoPolisi LIKE '%".$FnD."%' OR NoRangka LIKE '%".$FnD."%' OR NoMesin LIKE '%".$FnD."%' OR Alamat LIKE '%".$FnD."%')
		";
	}
	
	$nSQ = "SELECT count(*) as JmlR FROM tb_lembar_kerja_belum_tercatat WHERE TglPerolehan NOT LIKE '2023-%' AND KdUPB LIKE '".$UnT."%' $SyT";
	#if ($UID =="creator") {echo $nSQ;}
	$nRs = mysql_query($nSQ);
	$mRo = mysql_fetch_array($nRs, MYSQL_BOTH);
	$JmREC = $mRo[0];
	$JumData = $JmREC;
	if ($JumData>$PerPage)
	{
		$PaG = ceil($JumData/$PerPage);
	}
}
else
{
	if ($FnD)
	{
		$SyT = " 
		AND (Kd_Aset_108 LIKE '%".$FnD."%' OR Referensi LIKE '%".$FnD."%' OR Nm_Aset LIKE '%".$FnD."%' OR No_Register LIKE '%".$FnD."%' OR Alamat LIKE '%".$FnD."%' 
		OR Nomor_Polisi LIKE '%".$FnD."%' OR Merk LIKE '%".$FnD."%' OR Harga LIKE '%".$FnD."%' OR No_Pengadaan LIKE '%".$FnD."%' OR Tgl_Perolehan LIKE '%".$FnD."%' OR Harga LIKE '%".$FnD."%')
		";
	}
	
	$nSQ = "SELECT Referensi, Ref_Group, count(*) as JmlR FROM ta_kib_108 
	WHERE Tgl_Perolehan NOT LIKE '2023-%' AND Kd_UPB LIKE '".$UnT."%' $FiD AND Extracom LIKE '".$ExT."' $SyT GROUP BY Referensi, Ref_Group" ;
	$nRs = mysql_query($nSQ);
	#if ($UID =="creator") {echo $nSQ;}
	$mRo = mysql_fetch_assoc($nRs);
	$JmREC = mysql_num_rows($nRs);
	$JumData = $JmREC;
	if ($JumData>$PerPage)
	{
		$PaG = ceil($JumData/$PerPage);
	}
}
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:100%">
  <tr height="28">
	<td valign="middle">
	
	<? if ($JumData>0)
	{
		?>
		<div class="pagging">
		<?
		if ($JmREC < $PerPage)
		{
			$d="style='color:#ff0000;'";
			?>
			<a href="#" <?=$d?> onclick="pageDATA('0','<?=$PerPage?>','<?=$AsT?>','<?=$IdL?>');return false;">01</a>
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
					<a href="#" <?=$d?> onclick="pageDATA('<?=$iB?>','<?=$iA*$PerPage?>','<?=$AsT?>','<?=$IdL?>');return false;"><?=substr("00".($iA+1),-2,2)?></a>
					<?
				}
				else if (($PaG-1) < 1000)
				{
					?>
					<a href="#" <?=$d?> onclick="pageDATA('<?=$iB?>','<?=$iA*$PerPage?>','<?=$AsT?>','<?=$IdL?>');return false;"><?=substr("000".($iA+1),-3,3)?></a>
					<?
				} else {
					?>
					<a href="#" <?=$d?> onclick="pageDATA('<?=$iB?>','<?=$iA*$PerPage?>','<?=$AsT?>','<?=$IdL?>');return false;"><?=substr("0000".($iA+1),-4,4)?></a>
					<? 
				}
			}
		}
		?>
		</div>
		<? 
	} 
	?>	</td>
	<? if ($AsT=='x.x.x'){?>
	<td width="100" align="center"><a href="#" class="ico add" onclick="NewAset('','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>')">Add Item</a></td>
	<? } ?>
  </tr>
</table>

