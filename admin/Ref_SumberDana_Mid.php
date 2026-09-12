<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
$Kode = "X";
if ($IdT)
{
	$nSQL= "SELECT idt as A0,
	Kode as A1,
	Deskripsi as A2,
	Alias as A3 
	FROM ref_sumber_dana WHERE IDT='$IdT'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	$Kode = $mRo[1];
	$NmSB = $mRo[2];
	$AlIA = $mRo[3];
	$CeK  = fGlobal("IDT","ta_penerimaan_berkas","SmbDana",$Kode,"=","idt LIMIT 0,1","");
}
?>
<table border="0" class="table-form" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:30px">
  <tr height="25">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td width="20">&nbsp;</td>
    <td width="110">&nbsp;</td>
    <td width="15">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="50">&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">Id Sumber</td>
    <td>&nbsp;</td>
    <td align="left"><input name="fKode" id="fKode" type="text" readonly="readonly" value="<?=$Kode?>" style=" width:40px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">Sumber Dana</td>
    <td>&nbsp;</td>
    <td align="left"><input name="fNmSB" id="fNmSB" type="text" value="<?=$NmSB?>" <?php if ($CeK!=''){echo "readonly";}?> style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">Alias</td>
    <td>&nbsp;</td>
    <td align="left"><input name="fAlIA" id="fAlIA" type="text" value="<?=$AlIA?>" <?php if ($CeK!=''){echo "readonly";}?> style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td align="left">
	<input type="button" name="B1" value="Save" onclick="saveEDIT('<?=$ReO?>','<?=$IdT?>','<?=$_GET['IdL']?>')" style="width: 70px; height: 21px" />
	<input type="button" name="B2" value="Reset" onclick="resetEDIT('<?=$ReO?>','<?=$_GET['IdL']?>')" style="width: 70px; height: 21px" />	</td>
    <td>&nbsp;</td>
  </tr>
</table>
<script>
$("#fNmpr").focus();
</script>