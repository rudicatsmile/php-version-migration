<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
#echo $rIdT."xxxxx";
#return false;

$gREF = fGlobal("Referensi","ta_sp3d_spj","IDT",$rIdT,"=","","");
$gRKN = fGlobal("Kd_ReknP108","ta_sp3d_spj","IDT",$rIdT,"=","","");
$eNIL = 0;//fGlobal("Nilai","ta_sp3d_spj","IDT",$rIdT,"=","","");

$CrtSave = strtoupper(fNmHuruf(substr($gRKN,4,1)));
$AL = "Alamat";
$AK = "Luas_M2";
$M2 = "NO";
$ALN = "";

if ($CrtSave=='A'){
	$AL="Alamat";
	$AK="Luas_M2";
	$M2="YA";
	$ALN = "; text-align:right; padding-right:3px";
}
if ($CrtSave=='B'){
	$AL="Merk";
	$AK="Nomor_Polisi";
	$M2="NO";
	$ALN = "; text-align:left; padding-left:3px";
}
if ($CrtSave=='C' || $CrtSave=='D' || $CrtSave=='F'){
	$AL="Lokasi";
	if ($CrtSave=='D' || $CrtSave=='F'){$AK="Luas";}
	if ($CrtSave=='C'){$AK="Luas_Lantai";}
	$M2="YA";
	$ALN = "; text-align:right; padding-right:3px";
}
if ($CrtSave=='E'){
	$AL="Judul";
	$AK="Spesifikasi";
	$M2="NO";
	$ALN = "; text-align:left; padding-left:3px";
}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="100%" style="border:0px">
<?php
$iG=1;
$tJmL= 0;
$nSQ = "SELECT IDT as A0, Referensi as A1, Kd_Aset_108 as A2, Nm_Aset as A3, Total as A4, $AL as A5, $AK as A6, Tgl_Perolehan as A7 
FROM ta_sp3d_spj_rinci 
WHERE Referensi_SPJ='".$gREF."' ORDER BY IDT";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$IdTR = $mRo[0];
	#$ReKN = substr($mRo[2],0,5);
	#if ($ReKN=='1.3.1'){$fL = "A";}
	#else if ($ReKN=='1.3.2'){$fL = "B";}
	#else if ($ReKN=='1.3.3'){$fL = "C";}
	#else if ($ReKN=='1.3.4'){$fL = "D";}
	#else if ($ReKN=='1.3.5'){$fL = "E";}
	#else if ($ReKN=='1.3.6'){$fL = "F";}
	$mRo6 = $mRo[6];
	if ($M2=='YA'){
		$mRo6 = fConvertToRupiah($mRo6);
	}
	$DeL  = "";
	$rDel = "dele";
	$rCek = "";
	?>
	<tr height="26"> 
	  <td width="27" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="103" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
	  <td width="65" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=fConvertDateShort($mRo[7])?></td>
	  <td width="240" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[3]?></td>
	  <td width="200" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px"><?=$mRo[5]?></td>
	  <td width="95" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid <?=$ALN?>"><?=$mRo6?><?php if ($M2=="YA"){?>&nbsp;m<sup>2</sup><?php } ?></td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[4])?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <a href="#" onClick="EditMidASET('<?=$IdTR?>','<?=$rIdT?>','<?=$CrtSave?>','<?=$IdL?>'); return false" class="ico edit">Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="DeleMidASET('<?=$IdTR?>','<?=$rIdT?>','<?=$IdL?>'); return false" class="ico <?=$rDel?>">del</a>	  </td>
    </tr>
	<?php
	$iG++;
	$tJmL = $tJmL + $mRo[4];
}

?>
<?php if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 </tr>
<tr height="18">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="6">T O T A L</td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJmL)?></td>
  <td style="border-left:1px #ccc solid">&nbsp;</td>
  </tr>
<?php }else{ ?>
<tr height="100%">
 <td colspan="9" align="center">Data aset tidak ditemukan..!!</td>
</tr>
<?php } ?>
</table>
