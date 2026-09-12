<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
$gKD = $gJN."XXX";
$gDS = "";
if ($gID)
{
	$nSQL= "SELECT Kode, Deskripsi 
	FROM ref_usulan_jenis_rinci WHERE IDT='$gID'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	$gKD = $mRo[0];
	$gDS = $mRo[1];
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
    <td>KODE</td>
    <td><input name="fKD" type="text" readonly="readonly" value="<?=$gKD?>" style=" width:50px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td>DEKSRIPSI</td>
    <td><input name="fDS" id="fDS" type="text" value="<?=$gDS?>" style=" width:350px; border: 1px solid #C0C0C0"/></td>
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
