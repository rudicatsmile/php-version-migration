<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="400px" style="border:0px">
<?php
$iG=1;
$tJmL=0;
$nSQ = "SELECT IDT, Kode, Deskripsi, fUse FROM ref_usulan_syarat WHERE Kode LIKE '$gJN%' ORDER BY Kode";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$gIDT = $mRo[0];
	$mRo1 = $mRo[1];
	$mRo2 = $mRo[2];
	$mRo3 = $mRo[3];
	if ($mRo3=='Y') {$mRo3='<b>Digunakan</b>';} else {$mRo3='Tidak';}
	$DeL  = fGlobal("IDT","ta_usulan_verifikasi_rinci_syarat","Kd_Syarat",$mRo1,"=","","");

	?>
	<tr height="22"> 
	  <td valign="top" width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td valign="top" width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid"><?=$mRo[2]?></td>
	  <td valign="top" width="160" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center; font-style:italic"><?=$mRo3?></td>
	  <td valign="top" width="140" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <a href="#" onClick="formEDIT('<?=$ReO?>','<?=$gIDT?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="formDELE('<?=$ReO?>','<?=$gIDT?>','<?=$DeL?>','<?=$IdL?>'); return false" class="ico dele">delete</a>	  </td>
	</tr>
	<?php
	$iG++;
}
?>
<?php if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid">&nbsp;</td>
</tr>

<?php }else{ ?>
<tr height="100%">
 <td colspan="6" align="center">Data tidak ditemukan..!!</td>
</tr>
<?php } ?>
</table>
