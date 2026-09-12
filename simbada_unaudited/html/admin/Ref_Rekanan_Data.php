<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
$FnD = str_replace('**',' ',$FnD);
$CrT = "";
if ($FnD)
{
	$CrT ="WHERE (Kode LIKE '%$FnD%' OR Nma_Perusahaan LIKE '%$FnD%' OR Nma_Pimpinan LIKE '%$FnD%' OR NPWP LIKE '%$FnD%' OR NPWPD LIKE '%$FnD%' OR Alamat LIKE '%$FnD%')";
}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="400px" style="border:0px">
<?
$iG  = 1;
$nSQ = "SELECT IDT, 
Kode as A1,
Nma_Perusahaan as A2,
Nma_Pimpinan as A3,
NPWP as A4,
NPWPD as A5,
Alamat as A6,
No_Telp as A7,
No_Fax as A8,
Email as A9 
FROM ta_rekanan $CrT ORDER BY Kode";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$IdT  = $mRo[0];
	
	$dele = 'dele';
	$aler = "";
	$CeK  = fGlobal("IDT","ta_penerimaan_berkas","IdRekanan",$mRo[1],"=","idt LIMIT 0,1","");
	if ($CeK)
	{
		$dele='delt';
		$aler="alert('Oopps..!!'); return false; ";
	}
	?>
	<tr height="22"> 
	  <td width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid"><?=$mRo[2]?></td>
	  <td width="200" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid"><?=$mRo[3]?></td>
	  <td width="200" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid"><?=$mRo[4]?></td>
	  <td width="160" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
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
 <td style="border-left:1px #ccc solid">&nbsp;</td>
</tr>

<? }else{ ?>
<tr height="100%">
 <td colspan="7" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
<script>
$("#fDataFind").focus();
</script>