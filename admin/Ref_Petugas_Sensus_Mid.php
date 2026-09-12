<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
$gKD = "PXXXX";
$gDS = "";
$gUS = "Y";
if ($gID)
{
	$nSQL= "SELECT IdPetugas, NmPetugas, NiPetugas, NoHP 
	FROM tb_lembar_kerja_petugas WHERE IDT='$gID'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	$gKD = $mRo[0];
	$gDS = $mRo[1];
	$gNP = $mRo[2];
	$gHP = $mRo[3];
}
?>
<table border="0" class="table-form" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:30px">
  <tr height="25">
    <td width="20">&nbsp;</td>
    <td width="80">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="50">&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td>ID</td>
    <td><input name="fKD" type="text" readonly="readonly" value="<?=$gKD?>" style=" width:40px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td>NAMA</td>
    <td><input name="fDS" id="fDS" type="text" value="<?=$gDS?>" style=" width:350px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td>NIP</td>
    <td><input name="fNP" id="fNP" type="text" value="<?=$gNP?>" style=" width:200px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td>NO. HP</td>
    <td><input name="fHP" id="fHP" type="text" value="<?=$gHP?>" style=" width:200px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td></td>
    <td>
	<input type="button" name="B1" value="Save" onclick="saveEDIT('<?=$ReO?>','<?=$gID?>','<?=$_GET['IdL']?>')" style="width: 70px; height: 21px" />
	<input type="button" name="B2" value="Reset" onclick="resetEDIT('<?=$ReO?>','<?=$_GET['IdL']?>')" style="width: 70px; height: 21px" />
	</td>
    <td>&nbsp;</td>
  </tr>
</table>
