<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
$FnD = str_replace('**',' ',$FnD);

$UnT = $UnT;
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
	$SyT = " AND (P1.Nomor LIKE '%".$FnD."%' 
	OR P1.No_Berkas LIKE '%".$FnD."%' 
	OR P1.Faktur_Nomor LIKE '%".$FnD."%' 
	OR P1.Kd_Program LIKE '%".$FnD."%' 
	OR P1.Nm_Program LIKE '%".$FnD."%' 
	OR P1.Kd_Kegiatan LIKE '%".$FnD."%' 
	OR P1.Nm_Kegiatan LIKE '%".$FnD."%' 
	OR P1.Kd_SubKegiatan LIKE '%".$FnD."%' 
	OR P1.Nm_SubKegiatan LIKE '%".$FnD."%' 
	OR P1.Kd_Rek13 LIKE '%".$FnD."%' 
	OR P1.Nm_Rek13 LIKE '%".$FnD."%')";
}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="340px">
<?
$A = $_GET['PagA'];
$B = $_GET['PerPage'];
$iG= $A+1;

$nSQ = "SELECT 
P1.IDT as A0,
P1.Nomor as A1,
P1.Tanggal as A2,
P2.Nomor as A3,
P2.Tanggal as A4,
P1.Kd_Program as A5,
P1.Nm_Program as A6,
P1.Kd_Kegiatan as A7,
P1.Nm_Kegiatan as A8,
P1.Kd_SubKegiatan as A9,
P1.Nm_SubKegiatan as A10,
P1.Kd_Rek13 as A11,
P1.Nm_Rek13 as A12,
P2.No_Kontrak as A13,
P2.Tg_Kontrak as A14,
P2.No_Berita_Acara as A15,
P2.Tg_Berita_Acara as A16,
P1.Nilai as A17 
FROM ta_pengadaan P1 
LEFT JOIN ta_penerimaan_berkas P2 ON P2.Nomor=P1.No_Berkas 
WHERE P1.Kd_Rek13 LIKE '".$RaB."%' AND (P1.Tanggal BETWEEN '".$TgA."' AND '".$TgB."') AND P1.Kd_Unit LIKE '".$UnT."' $SyT 
ORDER BY P1.Nomor LIMIT $A,$B";
#echo $nSQ;
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG = fBackCLR($iG);
	$IdT = $mRo[0];
	
	/*
	$TnD = "";
	$SnsCEK = "";
	if ($SnsCEK=='P')
	{
		$TnD = "<font style='color:#0000ff'>dalam proses</font>";
	}
	if ($SnsCEK=='Y')
	{
		$TnD = "<font style='color:#ff0000'>selesai</font>";
	}
	*/
	
	?>
	<tr height="68" valign="top"> 
	  <td width="32" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="65" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=fConvertDateShort($mRo[2])?></td>
	  <td width="130" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]."<br><i>Ref. Berkas:<br>".$mRo[3]?></td>
	  <td width="430" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:3px" <?=$gBG?>><?=$mRo[5]." : ".$mRo[6]."<br>".$mRo[7]." : ".$mRo[8]."<br>".$mRo[9]." : ".$mRo[10]."<br>".$mRo[11]." : ".$mRo[12]?></td>
	  <td width="150" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo[13]."<br>Tanggal :<br>".fConvertDateShort($mRo[14])?></td>
	  <td width="150" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo[15]."<br>Tanggal :<br>".fConvertDateShort($mRo[16])?></td>
	  <td width="120" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right"><?=fConvertToRupiah($mRo[17])?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <a href="#" onClick="formCetakDok('Format_II_A_11','<?=$IdT?>','800','400','<?=$IdL?>'); return false" class="ico docu">&nbsp;&nbsp;II.A.11</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="formVerifikasi('','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;&nbsp;II.A.11.1</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="formPernyataan('','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;&nbsp;II.A.11.2</a>&nbsp;&nbsp;&nbsp;
	  </td>
	</tr>
	<?
	$iG++;
}
?>
<? if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
</tr>
<!--tr height="20">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="7"><div style="float:left; font-weight:normal; font-style:italic"><font style="color:#FF0000">&nbsp;**</font> &lt;-- Aset sudah tidak ada pada skpd bersangkuatn.</div>
    T O T A L</td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJmL)?></td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJmA)?></td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid">&nbsp;</td>
  <td style="border-left:1px #ccc solid"></td>
  <td colspan="3"></td>
</tr-->
<? }else{ ?>
<tr height="100%">
 <td colspan="9" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
<script languange="javascript">
$("#fFinM").focus();
</script>