<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
#echo $SmS;
if ($SmS=="I"){
	$LoD = "NO";
	$TGa = "";
	$TGb = "";
	
	$TgA = $fTH."-01-01";
	$TgB = $fTH."-06-30";
}
else{
	$LoD = "YA";
	$tgA = $fTH."-01-01";
	$tgB = $fTH."-06-30";
	
	$TgA = $fTH."-07-01";
	$TgB = $fTH."-12-31";
}
$NmUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$UpB,"=","","");
?>
<table align="center" border="0" width="1000" cellspacing="1" style="font-size:10pt; font-family: Calibri; border-collapse: collapse">
<tr>
	<td style="font-size: 11pt; font-weight: bold" align="center">NILAI BELANJA DANA BOS DAN KAPITALISASI ASET</td>
</tr>
<tr>
	<td style="font-size: 11pt; font-weight: bold" align="center"><?=strtoupper($NmUPB)?></td>
</tr>
<tr>
	<td style="font-size: 11pt; font-weight: bold" align="center">SEMESTER <?=$SmS?> TAHUN ANGGARAN <?=$fTH?></td>
</tr>
<tr>
  <td style="font-size: 12pt; font-weight: bold" align="center">&nbsp;</td>
</tr>
<table align="center" border="0" width="1000" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-family: Calibri; font-size:10pt">
  <tr style="text-align:center; font-weight:bold; height:30px">
    <td width="30" style="border:1px solid #000">No</td>
    <td style="border:1px solid #000">Referensi</td>
    <td width="70" style="border:1px solid #000">Jenis</td>
    <td width="100" style="border:1px solid #000">Kode</td>
    <td width="375" style="border:1px solid #000">Rekening Belanja</td>
    <td width="90" style="border:1px solid #000">Nilai<br>Belanja</td>
    <td width="90" style="border:1px solid #000">Nilai<br>Kapitalisasi</td>
    <td width="90" style="border:1px solid #000">Nilai<br>KIB</td>
    <td width="90" style="border:1px solid #000">Selisih <u>+</u></td>
    <td width="90" style="border:1px solid #000">Selisih <u>+</u></td>
  </tr>
  <tr style="text-align:center">
    <td style="border:1px solid #000; border-bottom:3px double #000">1</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">2</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">3</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">4</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">5</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">6</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">7</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">8</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">9 ( 6-7 )</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">10 ( 7-8 )</td>
  </tr>
	<?
	$A = "";
	$B = "";
	$iG = 1;
	
	$nSQ = "SELECT 
	P1.Referensi as A0, 
	P1.KdSesi as A1, 
	P3.Deskripsi as A2, 
	P1.Nom_SP3D as A3, 
	P1.Nilai as A4, 
	P2.Kd_ReknP90 as A5, 
	P2.Nm_ReknP90 as A6, 
	P2.Nilai as A7 
	FROM ta_sp3d P1 
	LEFT JOIN ta_sp3d_rinci P2 ON P2.Referensi=P1.Referensi AND P2.Kd_UPB=P1.Kd_UPB 
	LEFT JOIN ref_sp3d_jenis P3 ON P3.Kode=P1.KdJenis 
	WHERE P1.Kd_UPB='".$UpB."' AND P2.Kd_ReknP90 LIKE '5%' ORDER BY P1.Tgl_SP3D, P1.Referensi";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$A = $mRo[0];
		//ta_sp3d_spj_rinci
		$mRo8 = fGlobal("IfNull(sum(Total),0)","ta_sp3d_spj_rinci","Referensi_SP3B:Kd_ReknP90",$mRo[0].":".$mRo[5],"=:=","","");
		$mBE  = $mRo[7] - $mRo8;
		$WrN = "";
		if ($mRo8 < $mRo[7]){
			$WrN = "color:#0000ff";
		}
		if ($mRo8 > $mRo[7]){
			$WrN = "color:#ff0000";
		}
		
		$mRo9 = fGlobal("IfNull(sum(Total),0)","ta_sp3d_spj_rinci","Referensi_SP3B:Kd_ReknP90:Aprove",$mRo[0].":".$mRo[5].":Aproved","=:=:=","","");
		$mBA  = $mRo8 - $mRo9;
		$WrW = "";
		if ($mRo9 < $mRo8){
			$WrW = "color:#0000ff";
		}
		if ($mRo9 > $mRo8){
			$WrW = "color:#ff0000";
		}
		?>
		<tr height="30" style="">
		<td style="border:1px solid #000; text-align:center"><? if ($B != $A){echo $iG.".";}?></td>
		<td style="border:1px solid #000; padding-left:3px"><? if ($B != $A){echo $mRo[0];}?></td>
		<td style="border:1px solid #000; padding-left:3px"><? if ($B != $A){echo $mRo[2];}?></td>
		<td style="border:1px solid #000; text-align:center"><?=$mRo[5]?></td>
		<td style="border:1px solid #000; padding-left:2px"><?=$mRo[6]?></td>
		<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($mRo[7])?></td>
		<td style="border:1px solid #000; text-align:right; padding-right:2px; <?=$WrN?>"><?=fConvertToRupiahBulat($mRo8)?></td>
		<td style="border:1px solid #000; text-align:right; padding-right:2px; <?=$WrW?>"><?=fConvertToRupiahBulat($mRo9)?></td>
		<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($mBE)?></td>
		<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($mBA)?></td>
		</tr>
		<?
		if ($B != $A){
			$iG++;
		}
		$B = $A;
		
		$tRo6 = $tRo6 + $mRo[7];
		$tRo7 = $tRo7 + $mRo8;
		$tRo8 = $tRo8 + $mRo9;
		$tRo9 = $tRo9 + $mBE;
		$tRo10= $tRo10+ $mBA;
	}
	?>
  <tr height="30" style="font-weight:bold">
    <td colspan="5" style="border:1px solid #000; text-align:right; padding-right:20px">JUMLAH</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($tRo6)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($tRo7)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($tRo8)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($tRo9)?></td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($tRo10)?></td>
  </tr>
</table>
<?
function sumNIL($UpB,$fTH,$TgA,$TgB,$fJN,$fRK,$fSH)
{
	$SW = "SELECT IfNull(sum(P2.Nilai),0) as JM FROM ta_sp3d P1 LEFT JOIN ta_sp3d_rinci P2 ON P2.Referensi=P1.Referensi 
	WHERE P1.Kd_UPB='".$UpB."' AND P1.Tahun='".$fTH."' AND (P1.Tgl_SP3D BETWEEN '".$TgA."' AND '".$TgB."') AND P1.KdJenis LIKE '".$fJN."' AND P2.Kd_ReknP90 LIKE '".$fRK."%'";
	if ($fSH) echo $SW."<br>";
	$rs = mysql_query($SW);
	$mR = mysql_fetch_array($rs);
	return $mR[0];
}
?>