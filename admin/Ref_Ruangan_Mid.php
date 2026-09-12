<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
//echo $gID;
$gKoD = "XXX";
$gNmR = "";
$gNoR = "";
$gNmP = "";
$gNiP = "";
$gJaB = "";
if ($gID)
{
	$nSQL= "SELECT Kd_Ruang,Nm_Ruang,No_Ruang,Nm_Pejabat,Nip_Pejabat,Nm_Jabatan 
	FROM ref_ruangan WHERE IDT='$gID'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	$gKoD = $mRo[0];
	$gNmR = $mRo[1];
	$gNoR = $mRo[2];
	$gNmP = $mRo[3];
	$gNiP = $mRo[4];
	$gJaB = $mRo[5];
}
?>
<table border="0" class="table-form" cellspacing="0" cellpadding="0" align="center" style="width:500px; height:30px">
  <tr height="25">
    <td width="6">&nbsp;</td>
    <td width="119">&nbsp;</td>
    <td width="26">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">KODE</td>
    <td>&nbsp;</td>
    <td><input name="fKoD" id="fKoD" type="text" value="<?=$gKoD?>" readonly style=" width:50px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">NAMA RUANG</td>
    <td>&nbsp;</td>
    <td><input name="fNmR" id="fNmR" type="text" value="<?=$gNmR?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">NOMOR RUANG</td>
    <td>&nbsp;</td>
    <td><input name="fNoR" id="fNoR" type="text" value="<?=$gNoR?>" style=" width:50px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">PNGG. JAWAB </td>
    <td>&nbsp;</td>
    <td><input name="fNmP" id="fNmP" type="text" value="<?=$gNmP?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">NIP</td>
    <td>&nbsp;</td>
    <td><input name="fNiP" id="fNiP" type="text" value="<?=$gNiP?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">PANGKAT</td>
    <td>&nbsp;</td>
    <td><input name="fJaB" id="fJaB" type="text" value="<?=$gJaB?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td>
	<input type="button" name="B1" value="Save" onclick="saveEDIT('<?=$ReO?>','<?=$gID?>','<?=$_GET['IdL']?>')" style="width: 70px; height: 21px" />
	<input type="button" name="B2" value="Reset" onclick="resetEDIT('<?=$ReO?>','<?=$_GET['IdL']?>')" style="width: 70px; height: 21px" />	</td>
  </tr>
</table>
