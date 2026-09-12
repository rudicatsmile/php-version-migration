<?php
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
	$SyT = " AND (P1.Referensi LIKE '%".$FnD."%' 
	OR P1.Id_Rekanan LIKE '%".$FnD."%' 
	OR P1.No_Kontrak LIKE '%".$FnD."%' 
	OR P1.No_BAST LIKE '%".$FnD."%' 
	OR P1.Dokumen_Nama LIKE '%".$FnD."%' 
	OR P1.Dokumen_Nomor LIKE '%".$FnD."%' 
	OR P1.No_BAHI LIKE '%".$FnD."%' 
	OR P1.DokPendukung_Nama LIKE '%".$FnD."%' 
	OR P1.DokPendukung_Nomor LIKE '%".$FnD."%' 
	OR P1.Penyebab_Perolehan LIKE '%".$FnD."%' 
	OR P1.Memo LIKE '%".$FnD."%' 
	OR P1.TotalNilai LIKE '%".$FnD."%')";
}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="100%">
<?php
$A = $_GET['PagA'];
$B = $_GET['PerPage'];
$iG= $A+1;

$nSQ = "SELECT IDT as A0,
P1.Tanggal as A1,
P1.Referensi as A2,
P1.Kd_Unit as A3,
P1.Sumber_Dana as A4,
P1.Id_Rekanan as A5,
P1.No_Kontrak as A6,
P1.Tg_Kontrak as A7,
P1.No_BAST as A8,
P1.Tg_BAST as A9,
P1.Dokumen_Nama as A10,
P1.Dokumen_Nomor as A11,
P1.Dokumen_Tanggal as A12,
P1.No_BAHI as A13,
P1.Tg_BAHI as A14,
P1.DokPendukung_Nama as A15,
P1.DokPendukung_Nomor as A16,
P1.DokPendukung_Tanggal as A17,
P1.Dasar_Hukum as A18,
P1.Penyebab_Perolehan as A19,
P1.Memo as A20,
P1.JumlahBarang as A21,
P1.SatuanBarang as A22,
P1.HargaSatuan as A23,
P1.TotalNilai as A24,
P1.Recorded as A25,
P1.Pencatat as A26 
FROM ta_penerimaan_non_apbd P1 
WHERE P1.Kd_Unit='".$UnT."' AND P1.JenisNonApbd='".$JnsNon."' AND (P1.Tanggal BETWEEN '".$TgA."' AND '".$TgB."') $SyT 
ORDER BY P1.Referensi LIMIT $A,$B";
#echo $nSQ;
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG = fBackCLR($iG);
	$IdT = $mRo[0];
	
	$KonT = "-";
	if ($mRo[6]!='')
	{
		$KonT = $mRo[6]."<br> Tanggal :<br>".fConvertDateShort($mRo[7]);
	}
	
	$BasT = "-";
	if ($mRo[8]!='')
	{
		$BasT = $mRo[8]."<br> Tanggal :<br>".fConvertDateShort($mRo[9]);
	}
	
	$DokK = "-";
	if ($mRo[10]!='' || $mRo[11]!='')
	{
		$DokK = $mRo[10]."<br>".$mRo[11]."<br> Tanggal :<br>".fConvertDateShort($mRo[11]);
	}
	
	$BahI = "-";
	if ($mRo[13]!='')
	{
		$BahI = $mRo[13]."<br> Tanggal :<br>".fConvertDateShort($mRo[14]);
	}
	
	$DokL = "-";
	if ($mRo[15]!='' || $mRo[16]!='')
	{
		$DokL = $mRo[15]."<br>".$mRo[16]."<br>Tanggal :<br>".fConvertDateShort($mRo[17]);
	}
	
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
	$IdTA = fGlobal("IDT","ta_kib_108_temp","no_pengadaan",$mRo[2],"=","","");
	?>
	<tr height="68" valign="top"> 
	  <td width="32" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="65" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=fConvertDateShort($mRo[1])?></td>
	  <td width="130" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[2]?></td>
	  <td width="220" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:3px" <?=$gBG?>><?=$mRo[5]?></td>
	  <td width="120" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$KonT?></td>
	  <td width="120" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$BasT?></td>
	  <td width="120" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$DokK?></td>
	  <td width="120" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$BahI?></td>
	  <td width="120" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$DokL?></td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right"><?=fConvertToRupiah($mRo[24])?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <a href="#" onClick="formAddItem('','<?=$ReO?>','<?=$JnsNon?>','<?=$IdT?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;II.A.<?=substr($JnsNon,-2,2)?></a>&nbsp;&nbsp;
	  <a href="#" onClick="formCetakDok('Format_II_A_<?=substr($JnsNon,-2,2)?>','<?=$IdT?>','800','400','<?=$IdL?>'); return false" class="ico docu">&nbsp;II.A.<?=substr($JnsNon,-2,2)?></a>&nbsp;&nbsp;
	  <a href="#" onClick="formAddAset('','<?=$ReO?>','<?=$JnsNon?>','<?=$IdT?>','<?=$IdTA?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;Aset</a>
	  </td>
	</tr>
	<?php
	$iG++;
}
?>
<?php if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
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
<?php }else{ ?>
<tr height="100%">
 <td colspan="12" align="center">Data tidak ditemukan..!!</td>
</tr>
<?php } ?>
</table>
<script languange="javascript">
$("#fFinM").focus();
</script>