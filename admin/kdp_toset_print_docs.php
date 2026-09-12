<?php
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
<title>Sipanda BMD Kab. Balangan</title>
<table border="0" align="center" cellpadding="0" cellspacing="0" style="width:1200px; border-collapse:collapse; font-family:calibri; font-size:10pt">
<tr style=" font-weight:bold">
 <td style="font-size:13pt">LAPORAN KDP TO ASET</td>
</tr>
<tr style=" font-weight:bold">
  <td style="text-align:center">&nbsp;</td>
</tr>
</table>
<table border="0" align="center" cellpadding="0" cellspacing="0" style="width:1200px; border-collapse:collapse; font-family:calibri; font-size:10pt">
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

<table border="0" align="center" cellpadding="0" cellspacing="0" style="width:1200px; border-collapse:collapse; font-family:calibri; font-size:9pt">
<tr height="20" style=" font-weight:bold">
 <td width="35" style="border:1px solid #000; text-align:center">No</td>
 <td width="70" style="border:1px solid #000; text-align:center">Tanggal</td>
 <td width="100" style="border:1px solid #000; text-align:center">Referensi</td>
 <td width="100" style="border:1px solid #000; text-align:center">Ke Ref. Aset</td>
 <td width="110" style="border:1px solid #000; text-align:center">Ke Rek. Aset</td>
 <td width="110" style="border:1px solid #000; text-align:center">Posting</td>
 <td width="100" style="border:1px solid #000; text-align:center">Ref. Kdp </td>
 <td width="135" style="border:1px solid #000; text-align:center">No. Pengadaan</td>
 <td style="border:1px solid #000; text-align:center">Uraian</td>
 <td width="110" style="border:1px solid #000; text-align:center">Nilai</td>
 </tr>
<?php
$iG  = 0;
$tRo7= 0;
$tRo9= 0;

$SQ="select 
p1.tanggal as A0,
p1.referensi as A1,
p1.kereferensi as A2,
p1.kerekening as A3,
p1.uraian as A4,
p2.ref_aset as A5,
p2.nm_aset as A6,
p2.nilai as A7,
p3.no_pengadaan as A8 
from ta_kib_kdptoaset p1 
left join ta_kib_kdptoaset_data p2 on p2.referensi=p1.referensi 
left join ta_kib_108 p3 on p3.referensi=p2.ref_aset and left(p3.kd_upb,11)=left(p1.kd_upb,11)
where p1.kd_upb like '".$SkP."%' and (p1.tanggal between '".$TgA."' and '".$TgB."') and p1.kd_rek like '".$ReK."%' and p1.execute='Y'
order by p1.referensi";
$rs = mysql_query($SQ);
while ($mRo = mysql_fetch_array($rs, MYSQL_BOTH))
{
	$mRo1 = $mRo[1];
	$TmP="N";
	$mRo9 = 0;
	$mRo10= 0;
	if ($mRo1x != $mRo1)
	{
		$TmP="Y";
		$mRo9  = fGlobal("sum(debet)","ta_kib_post_108","Referensi",$mRo[2],"=","","");
		$mRo10 = fGlobal("sum(nilai)","ta_kib_kdptoaset_data","Referensi",$mRo[1],"=","","");
		$tRo9  = $tRo9+$mRo9;
		$iG++;
	}
	

	$Tnd="";
	if ($mRo9!=$mRo10)
	{
		$Tnd=" **";
	}
	?>
	<tr height="20">
	 <td style="border:1px solid #000; text-align:center"><?php if ($TmP=="Y"){echo $iG.".";}?></td>
	 <td style="border:1px solid #000; text-align:center"><?php if ($TmP=="Y"){echo fConvertDateShort($mRo[0]);}?></td>
	 <td style="border:1px solid #000; text-align:center"><?php if ($TmP=="Y"){echo $mRo[1];}?></td>
	 <td style="border:1px solid #000; text-align:center"><?php if ($TmP=="Y"){echo $mRo[2];}?></td>
	 <td style="border:1px solid #000; text-align:center"><?php if ($TmP=="Y"){echo $mRo[3];}?></td>
	 <td style="border:1px solid #000; text-align:right; padding-right:3px"><?php if ($TmP=="Y"){echo fConvertToRupiah($mRo9).$Tnd;}?></td>
	 <td style="border:1px solid #000; padding-left:3px"><?=$mRo[5]?></td>
	 <td style="border:1px solid #000; padding-left:3px"><?=$mRo[8]?></td>
	 <td style="border:1px solid #000; padding-left:3px"><?=$mRo[6]?></td>
	 <td style="border:1px solid #000; padding-left:3px; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[7])?></td>
    </tr>
	<?php
	$mRo1x = $mRo1;
	
	$tRo7=$tRo7+$mRo[7];
	
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
  <td style="border:1px solid #000; text-align:right; padding-right:3px; font-weight:bold"><?=fConvertToRupiah($tRo9)?></td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000; text-align:right; padding-right:3px; font-weight:bold"><?=fConvertToRupiah($tRo7)?></td>
  </tr>
</table>
<br>
<br>