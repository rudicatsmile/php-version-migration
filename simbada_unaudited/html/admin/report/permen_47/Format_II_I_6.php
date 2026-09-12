<?
require "../../connfile.php";
require "../../configfile.php";
require "../../functionfile.php";
require "../../checkuser.php";

#Posisi di Nota permintaan
extract($_GET);
$DtA = fGlobal("KdBidang:Nomor:Tanggal","tb_nota_permintaan","IDT",$gID,"=","",DatabaseSA,$ConSA,"");
$DtA = explode(':',$DtA);
$BiD = $DtA[0];
$NoM = $DtA[1];
$TgS = fConvertDateLongBln($DtA[2]);
$SkB = fGlobal("sub_bidang","tb_bidang_sub","kode",$BiD,"=","",DatabaseSA,$ConSA,"");
$SkP.= fGlobal("bidang","tb_bidang","kode",substr($BiD,0,11),"=","",DatabaseSA,$ConSA,"");
$SkB.= "<br> ".$SkP;
?> 
<body>
<table border="0" width="950" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td style="text-align:right">Format II.I.6</td>
  </tr>
</table>
<table border="0" width="950" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:verdana">PEMERINTAH <?=strtoupper($NmTING." ".$NmDAER)?></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri"><?=strtoupper($SkP)?></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">NOTA PERMINTAAN BARANG</td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-family:calibri; text-decoration:underline">Nomor : <?=$NoM?></td>
  </tr>
  
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="129" valign="top">Pihak Yang Meminta</td>
    <td width="20" valign="top">:</td>
    <td width="801" valign="top"><?=ucwords(strtolower($SkB))?></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="950" align="center" cellspacing="0" cellpadding="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr height="25" style="font-weight:bold; text-align:center">
    <td style="border:1px solid #000">No</td>
    <td style="border:1px solid #000">Spesifikasi Nama Barang </td>
    <td style="border:1px solid #000">Jumlah</td>
    <td style="border:1px solid #000">Satuan</td>
    <td style="border:1px solid #000">Keperluan</td>
    <td style="border:1px solid #000">Keterangan</td>
  </tr>
  <tr style="text-align:center">
    <td width="40" style="border:1px solid #000; border-bottom:3px double #000">1</td>
    <td width="350" style="border:1px solid #000; border-bottom:3px double #000">2</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">3</td>
    <td width="80" style="border:1px solid #000; border-bottom:3px double #000">4</td>
    <td width="200" style="border:1px solid #000; border-bottom:3px double #000">5</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">6</td>
  </tr>
	<?
	$iG=1;
	$nSQ = "SELECT 
	P1.KdPersediaan as A0, 
	P2.Nm_Rek as A1, 
	P3.Nm_Rek as A2, 
	P1.QTY as A3, 
	P3.Satuan as A4, 
	P1.Keperluan as A5 
	FROM tb_nota_permintaan_rinci P1 
	LEFT JOIN ref_rek_90_7_persediaan P2 ON P2.Kd_Rek=left(P1.KdPersediaan,19) 
	LEFT JOIN ref_rek_90_8_persediaan P3 ON P3.Kd_Rek=P1.KdPersediaan 
	WHERE P1.Nomor='".$NoM."' ORDER BY P1.Referensi";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs)) 
	{ 
		?>
		<tr height="22">
		<td style="border:1px solid #000; text-align:center"><?=$iG?>.</td>
		<td style="border:1px solid #000; padding-left:3px"><?="<b><i>".$mRo[1]."</b></i> -> ".$mRo[2]?></td>
		<td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo[3])?></td>
		<td style="border:1px solid #000; text-align:center"><?=$mRo[4]?></td>
		<td style="border:1px solid #000; padding-left:3px"><?=$mRo[5]?></td>
		<td style="border:1px solid #000; padding-left:3px">-</td>
		</tr>
		<?
		$iG++;
		$mRo3 = $mRo3+$mRo[3];
	}
	?>
	<? if ($iG==1){?>
	<tr height="100">
	<td style="border:1px solid #000; text-align:center">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
	<td style="border:1px solid #000">&nbsp;</td>
	</tr>
	<? } ?>
  <tr height="25" style="font-weight:bold">
    <td colspan="2" style="border:1px solid #000; text-align:center">Jumlah</td>
    <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo3)?></td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
  </tr>
</table>
<table border="0" width="950" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td width="300">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="300">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center"><?=$NmIBUK?>
    , <?=$TgS?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center"><?=$JbB?></td>
  </tr>
  <tr height="60">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" style="font-weight:bold">( <?=$gNmUs?> )</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>