<?
require "Connection.php";
require "FileFunction.php";
extract($_GET);

if ($Upb!='All')
{
	$SkP = $Upb;
}
else
{
	if ($Sub!='All')
	{
		$SkP = $Sub;
	}
	else
	{
		$SkP = $Unt;
	}
}

if ($Rin!='All')
{
	$ReK = $Rin;
}
else
{
	if ($OBJ!='All')
	{
		$ReK = $OBJ;
	}
	else
	{
		if ($Kel!='All')
		{
			$ReK = $Kel;
		}
		else
		{
			if ($Bid!='All')
			{
				$ReK= $Bid;
			}
			else
			{
				$ReK= '1.3.6.01';
			}
		}
	}
}
#echo $ReK;

$TgA = $ThA."-".substr('0'.$BnA,-2,2)."-".substr('0'.$HrA,-2,2);
$TgB = $ThB."-".substr('0'.$BnB,-2,2)."-".substr('0'.$HrB,-2,2);
#echo $TgA.":".$TgB;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<table border="0" align="center" cellpadding="0" cellspacing="0" style="width:1000px; border-collapse:collapse">
<tr style=" font-weight:bold">
 <td style="font-size:13pt">LAPORAN KDP TO ASET</td>
</tr>
<tr style=" font-weight:bold">
  <td style="text-align:center">&nbsp;</td>
</tr>
</table>
<table border="0" align="center" cellpadding="0" cellspacing="0" style="width:1000px; border-collapse:collapse">
<tr height="18">
 <td width="83">SKPD</td>
 <td width="31">:</td>
 <td width="886"><?=fGlobal("nm_unit","ref_unit","kd_unit",$Unt,"=","","")?></td>
</tr>
<tr height="18">
  <td>Tanggal</td>
  <td>:</td>
  <td><?=fConvertDateLongsBln($TgA)?></td>
</tr>
<tr height="18">
  <td>Sd. Tanggal</td>
  <td>:</td>
  <td><?=fConvertDateLongsBln($TgB)?></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>

<table border="0" align="center" cellpadding="0" cellspacing="0" style="width:1000px; border-collapse:collapse">
<tr height="20" style=" font-weight:bold">
 <td width="40" style="border:1px solid #000; text-align:center">No</td>
 <td width="70" style="border:1px solid #000; text-align:center">Tanggal</td>
 <td width="100" style="border:1px solid #000; text-align:center">Referensi</td>
 <td width="110" style="border:1px solid #000; text-align:center">Ke Ref. Aset</td>
 <td width="110" style="border:1px solid #000; text-align:center">Ke Rek. Aset</td>
 <td width="120" style="border:1px solid #000; text-align:center">Nilai</td>
 <td style="border:1px solid #000; text-align:center">Uraian</td>
</tr>
<?
$iG  = 1;
$tRo4= 0;

$SQ="select 
p1.tanggal as A0,
p1.referensi as A1,
p1.kereferensi as A2,
p1.kerekening as A3,
sum(debet) as A4,
p1.uraian as A5 
from ta_kib_kdptoaset p1 
left join ta_kib_post_108 p2 on p2.referensi=p1.kereferensi and left(p2.kd_upb,11)=left(p1.kd_upb,11)
where p1.kd_upb like '".$SkP."%' and (p1.tanggal between '".$TgA."' and '".$TgB."') and p1.kd_rek like '".$ReK."%' and p1.execute='Y'
group by p1.referensi";
$rs = mysql_query($SQ);
while ($mRo = mysql_fetch_array($rs, MYSQL_BOTH))
{
	?>
	<tr height="20">
	 <td style="border:1px solid #000; text-align:center"><?=$iG?>.</td>
	 <td style="border:1px solid #000; text-align:center"><?=fConvertDateShort($mRo[0])?></td>
	 <td style="border:1px solid #000; text-align:center"><?=$mRo[1]?></td>
	 <td style="border:1px solid #000; text-align:center"><?=$mRo[2]?></td>
	 <td style="border:1px solid #000; text-align:center"><?=$mRo[3]?></td>
	 <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiah($mRo[4])?></td>
	 <td style="border:1px solid #000; padding-left:3px"><?=$mRo[5]?></td>
	</tr>
	<?
	$tRo4=$tRo4+$mRo[4];
	$iG++;
}
?>
<!--tr>
 <td style="border:1px solid #000">&nbsp;</td>
 <td style="border:1px solid #000">&nbsp;</td>
 <td style="border:1px solid #000">&nbsp;</td>
 <td style="border:1px solid #000">&nbsp;</td>
 <td style="border:1px solid #000">&nbsp;</td>
 <td style="border:1px solid #000">&nbsp;</td>
 <td style="border:1px solid #000">&nbsp;</td>
</tr-->
<tr height="25">
  <td colspan="5" style="border:1px solid #000; text-align:center; font-weight:bold">T O T A L</td>
  <td style="border:1px solid #000; text-align:right; padding-right:2px; font-weight:bold"><?=fConvertToRupiah($tRo4)?></td>
  <td style="border:1px solid #000">&nbsp;</td>
</tr>
</table>
<br>
<br>