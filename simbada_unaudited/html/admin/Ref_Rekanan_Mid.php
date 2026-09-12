<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
$Kode = "RXXX";
if ($IdT)
{
	$nSQL= "SELECT idt as A0,
	Kode as A1,
	Nma_Perusahaan as A2,
	Nma_Pimpinan as A3,
	NPWP as A4,
	NPWPD as A5,
	Alamat as A6,
	No_Telp as A7,
	No_Fax as A8,
	Email as A19 
	FROM ta_rekanan WHERE IDT='$IdT'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	$Kode = $mRo[1];
	$Nmpr = $mRo[2];
	$Nmpi = $mRo[3];
	$Npwp = $mRo[4];
	$Npwd = $mRo[5];
	$Alam = $mRo[6];
	$Telp = $mRo[7];
	$Faxs = $mRo[8];
	$Mail = $mRo[9];
	$CeK  = fGlobal("IDT","ta_penerimaan_berkas","IdRekanan",$Kode,"=","idt LIMIT 0,1","");
}
?>
<table border="0" class="table-form" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:30px">
  <tr height="25">
    <td width="20">&nbsp;</td>
    <td width="110">&nbsp;</td>
    <td width="15">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="50">&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">Id Rekanan</td>
    <td>&nbsp;</td>
    <td><input name="fKode" id="fKode" type="text" readonly="readonly" value="<?=$Kode?>" style=" width:40px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">Nama Rekanan</td>
    <td>&nbsp;</td>
    <td><input name="fNmpr" id="fNmpr" type="text" value="<?=$Nmpr?>" <? if ($CeK!=''){echo "readonly";}?> style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">Nama Pimpinan</td>
    <td>&nbsp;</td>
    <td><input name="fNmpi" id="fNmpi" type="text" value="<?=$Nmpi?>" <? if ($CeK!=''){echo "readonly";}?> style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">NPWP</td>
    <td>&nbsp;</td>
    <td><input name="fNpwp" id="fNpwp" type="text" value="<?=$Npwp?>" style=" width:210px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">NPWPD</td>
    <td>&nbsp;</td>
    <td><input name="fNpwd" id="fNpwd" type="text" value="<?=$Npwd?>" style=" width:210px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">Alamat</td>
    <td>&nbsp;</td>
    <td><input name="fAlam" id="fAlam" type="text" value="<?=$Alam?>" style=" width:210px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">No. Telp / Fax</td>
    <td>&nbsp;</td>
    <td><input name="fTelp" id="fTelp" type="text" value="<?=$Telp?>" style=" width:100px; border: 1px solid #C0C0C0"/>
    <input name="fFaxs" id="fFaxs" type="text" value="<?=$Faxs?>" style=" width:100px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">e-Mail</td>
    <td>&nbsp;</td>
    <td><input name="fMail" id="fMail" type="text" value="<?=$Mail?>" style=" width:210px; border: 1px solid #C0C0C0"/></td>
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
    <td>
	<input type="button" name="B1" value="Save" onclick="saveEDIT('<?=$ReO?>','<?=$IdT?>','<?=$_GET['IdL']?>')" style="width: 70px; height: 21px" />
	<input type="button" name="B2" value="Reset" onclick="resetEDIT('<?=$ReO?>','<?=$_GET['IdL']?>')" style="width: 70px; height: 21px" />	</td>
    <td>&nbsp;</td>
  </tr>
</table>
<script>
$("#fNmpr").focus();
</script>