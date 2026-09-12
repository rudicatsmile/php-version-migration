<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
if ($gUPB=="ALL"){
	if ($gSUB=="ALL"){
		$gUPB = $gUNT."%";
	}
	else{
		$gUPB = $gSUB."%";
	}
}
else{
	$gUPB = $gUPB;
}
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT ="WHERE (P1.Email LIKE '%$gFnD%' OR P1.NoHP LIKE '%$gFnD%' OR P1.Referensi LIKE '%$gFnD%' OR P1.Nomor LIKE '%$FnD%' OR P1.Nama LIKE '%$FnD%' OR P2.Nm_UPB LIKE '%$FnD%' OR P1.Jabatan LIKE '%$FnD%' OR P1.NIP LIKE '%$FnD%')"; 
}
if ($gJNS=='AA') {$gJNS="%";}
if ($gSES=='AA') {$gSES="%";}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="380px" style="border:0px">
<?php
$iG=1;
$tJmL= 0;
$nSQ = "SELECT P1.IDT, P1.Nomor, P1.Tanggal, P1.Nama, P1.NIP, P1.Jabatan, P1.NoHP, P1.Email, P2.Nm_UPB
FROM ta_sp3d_pendaftaran P1 
LEFT JOIN ref_upb P2 ON P2.Kd_UPB=P1.Kd_UPB 
$CrT ORDER BY P1.Kd_UPB, P1.IDT LIMIT 0,500";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$gIdT = $mRo[0];
	$DeL  = "";
	?>
	<tr height="25"> 
	  <td width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="135" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
	  <td width="70" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=fConvertDateShort($mRo[2])?></td>
	  <td width="250" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[3]?></td>
	  <td width="130" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[4]?></td>
	  <td width="150" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[5]?></td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid"><?=$mRo[6]?></td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid"><?=$mRo[7]?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:5px"><?=$mRo[8]?></td>
      <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:5px">
	  <a href="<?="SP3D_Pelatihan_Frm.php?FrmG=DANA BOS -> FORM PENDAFTARAN MENGIKUTI PELATIHAN&IdT=".$gIdT."&IdL=".$_GET['IdL']?>" class="ico edit">&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="showDELE('<?=$gIdT?>','<?=$DeL?>','<?=$IdL?>'); return false" class="ico dele">delete</a>
	  </td>
	</tr>
	<?php
	$iG++;
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
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
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