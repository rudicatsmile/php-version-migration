<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
if ($gUnT=="ALL"){$gUnT="%";}

$FnD = str_replace('**',' ',$gFnD);
$gTA = $gTH."-".substr('0'.$gBL,-2,2)."-".substr('0'.$gHR,-2,2);
$gTB = $gTHd."-".substr('0'.$gBLd,-2,2)."-".substr('0'.$gHRd,-2,2);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (P1.Nomor LIKE '%$gFnD%' OR P1.Uraian LIKE '%$FnD%' OR P2.Kd_Program LIKE '%$FnD%' OR P2.Nm_Program LIKE '%$FnD%' OR P2.Kd_Kegiatan LIKE '%$FnD%' OR P2.Nm_Kegiatan LIKE '%$FnD%' OR P2.Kd_Rek13 LIKE '%$FnD%' OR P2.Nm_Rek13 LIKE '%$FnD%')";
}
if ($gJNS=='AA') {$gJNS="__";}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="385px" style="border:0px">
<?php
$iG=1;
$tJmL= 0;
$nSQ = "SELECT P1.IDT as A0,
P1.Nomor as A1,
P1.Tanggal as A2,
P1.Tgl_Cair as A3,
P1.No_BKU as A4,
P2.Kd_Program as A5,
P2.Nm_Program as A6,
P2.Kd_Kegiatan as A7,
P2.Nm_Kegiatan as A8,
P2.Kd_Rek13 as A9,
P2.Nm_Rek13 as A10,
P1.Faktur_Nomor as A11,
P1.Faktur_Tanggal as A12,
P1.Nilai as A13,
P1.JmlPencairan as A14,
P1.Uraian as A15,
P1.Kd_Unit as A16,
P3.Nm_Unit as A17,
P2.NomorNew as A18 
FROM ta_pengadaan P1 
LEFT JOIN ta_penerimaan_berkas P2 ON P2.Nomor=P1.No_Berkas 
LEFT JOIN ref_unit P3 ON P3.Kd_Unit=P1.Kd_Unit 
WHERE P1.Kd_Unit LIKE '$gUnT%' AND (P1.Tanggal BETWEEN '$gTA' AND '$gTB') $CrT ORDER BY P1.Tanggal DESC,P1.IDT DESC";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG = fBackCLR($iG);
	$IdT = $mRo[0];
	$Ref = $mRo[1];
	
	$TmB = "";
	if ($gUnT=="%"){
		$TmB = "<tr valign='top'><td width='95'>".$mRo[16]."</td><td style='color:#0000ff'>".$mRo[17]."</td></tr>";
	}
	$mRo5 = "
	<table border='0' width='100%' style='border-collapse:collapse'>
	$TmB
	<tr valign='top'><td width='95'>".$mRo[5]."</td><td>".$mRo[6]."</td></tr>
	<tr valign='top'><td>".$mRo[7]."</td><td>".$mRo[8]."</td>
	</tr><tr valign='top'><td>".$mRo[9]."</td><td><b>".$mRo[10]."</b></td></tr>
	</table>";
	
	?>
	<tr height="80" valign="top"> 
	  <td width="29" <?=$gBG?>  style="border-bottom:1px #999 dotted; border-right:1px #ccc solid; text-align:center"><?=$iG?>.</td>
	  <td width="146" <?=$gBG?> style="border-bottom:1px #999 dotted; border-right:1px #ccc solid; text-align:center"><?=$mRo[1]."<br><b><font style='color:#0000ff'>".$mRo[18]?></td>
	  <td width="70" <?=$gBG?>  style="border-bottom:1px #999 dotted; border-right:1px #ccc solid; text-align:center"><?=fConvertDateShort($mRo[2])?></td>
	  <td width="70" <?=$gBG?>  style="border-bottom:1px #999 dotted; border-right:1px #ccc solid; text-align:center"><?php if ($mRo[3]!='0000-00-00') {echo fConvertDateShort($mRo[3]);}?></td>
	  <td width="70" <?=$gBG?> style="border-bottom:1px #999 dotted; border-right:1px #ccc solid; text-align:center"><?php if ($mRo[4]!='') {echo $mRo[4];}else{echo "<font style='color:#ff0000'>....????";}?></td>
	  <td width="397" <?=$gBG?>  style="border-bottom:1px #999 dotted; border-right:1px #ccc solid; padding-left:3px"><?=$mRo5?></td>
	  <td width="247" <?=$gBG?>  style="border-bottom:1px #999 dotted; border-right:1px #ccc solid; padding-left:3px"><?=$mRo[15]?></td>
	  <td width="107" <?=$gBG?> style="border-bottom:1px #999 dotted; border-right:1px #ccc solid; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[13])?></td>
	  <td width="107" <?=$gBG?> style="border-bottom:1px #999 dotted; border-right:1px #ccc solid; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[14])?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999 dotted; text-align:center;">
	  <!--a href="#" onClick="alert('Under construction..!!'); return false" class="ico edit">Rekon</a-->
	  <a href="#" class="ico edit" onclick="showRECO('','<?=$Ref?>','<?=$IdT?>','<?=$IdL?>'); return false;">Rekon</a>
	  </td>
    </tr>
	<?php
	$iG++;
	$tJmL =$tJmL + $mRo[13];
	$rJmL =$rJmL + $mRo[14];
}
?>
<?php if ($iG>1) {?>
<tr height="100%">
 <td style="border-right:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-right:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-right:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-right:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-right:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-right:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-right:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-right:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-right:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-right:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 </tr>
<tr height="30" style="font-weight:bold">
  <td colspan="7" style="border-bottom:1px #ccc solid; border-right:1px #ccc solid; text-align:right; padding-right:10px">T O T A L</td>
  <td style="border-bottom:1px #ccc solid; border-right:1px #ccc solid; text-align:right; padding-right:3px"><?=fConvertToRupiah($tJmL)?></td>
  <td style="border-bottom:1px #ccc solid; border-right:1px #ccc solid; text-align:right; padding-right:3px"><?=fConvertToRupiah($rJmL)?></td>
  <td style="border-right:0px #ccc solid; border-bottom:1px #ccc solid">&nbsp;</td>
  </tr>
<?php }else{ ?>
<tr height="100%">
 <td colspan="11" align="center">Data tidak ditemukan..!!</td>
</tr>
<?php } ?>
</table>
<script languange="javascript">
$("#fFnD").focus();
</script>