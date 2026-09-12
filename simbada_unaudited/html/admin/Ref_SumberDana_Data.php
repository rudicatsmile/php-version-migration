<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
$FnD = str_replace('**',' ',$FnD);
$CrT = "";
if ($FnD)
{
	$CrT ="WHERE (Kode LIKE '%$FnD%' OR Kode LIKE '%$FnD%' OR Alias LIKE '%$FnD%')";
}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="400px" style="border:0px">
<?
$iG  = 1;
$nSQ = "SELECT IDT as A0, 
Kode as A1,
Deskripsi as A2,
Alias as A3 
FROM ref_sumber_dana $CrT ORDER BY Kode";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$IdT  = $mRo[0];
	
	$dele = 'dele';
	$aler = "";
	$CeK  = fGlobal("IDT","ta_penerimaan_berkas","SmbDana",$mRo[1],"=","idt LIMIT 0,1","");
	if ($CeK)
	{
		$dele='delt';
		$aler="alert('Oopps..!!'); return false; ";
	}
	?>
	<tr height="22"> 
	  <td width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
	  <td width="244" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid"><?=$mRo[2]?></td>
	  <td width="244" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid"><?=$mRo[3]?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <a href="#" onClick="formEDIT('<?=$ReO?>','<?=$IdT?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;&nbsp;edit</a>&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="<?=$aler?>formDELE('<?=$IdT?>','<?=$IdL?>'); return false" class="ico <?=$dele?>">delete</a>	  </td>
	</tr>
	<?
	$iG++;
}
?>
<? if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid">&nbsp;</td>
 <td style="border-left:1px #ccc solid">&nbsp;</td>
</tr>

<? }else{ ?>
<tr height="100%">
 <td colspan="6" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
<script>
$("#fDataFind").focus();
</script>