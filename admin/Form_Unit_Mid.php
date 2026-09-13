<?php
require "CheckSession.php";
require "Connection.php";
require "Connection_Simkada.php";
require "FileFunction.php";
require "CheckLogin.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="global.js"></script>
</head>
<?php
$gBid = $_GET['gBid'];
$rIDT = $_GET['rIDT'];
$Sbmt = "";

if ($rIDT!="")
{
	$nSQ = "SELECT * FROM ref_unit WHERE IDT='".$rIDT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gCod = $mRo['Kd_Unit'];
		$gNma = $mRo['Nm_Unit'];
		$gBid = substr($gCod,0,8);
		
		$NmA  = $mRo['Nma_Pimpinan'];
		$NiP  = $mRo['Nip_Pimpinan'];
		$JaB  = $mRo['Jab_Pimpinan'];
		$PkT  = $mRo['Pkt_Pimpinan'];
		$gLNK = $mRo['Kd_Unit_Link'];
		$mLNK = $mRo['Nm_Unit_Link'];
		
		$gPimD = $mRo['Hp_Pimpinan'];
		$gPimF = $mRo['Ema_Pimpinan'];
		
		$gPrsA = $mRo['Nm_Pengurus'];
		$gPrsB = $mRo['Nip_Pengurus'];
		$gPrsC = $mRo['Jbt_Pengurus'];

		$gPrsD = $mRo['Hp_Pengurus'];
		$gPrsF = $mRo['Ema_Pengurus'];
		$gPrsG = $mRo['Pkt_Pengurus'];

		$gPnyA = $mRo['Nm_Penyimpan'];
		$gPnyB = $mRo['Nip_Penyimpan'];
		$gPnyC = $mRo['Jbt_Penyimpan'];
		
		$gPnyD = $mRo['Hp_Penyimpan'];
		$gPnyF = $mRo['Ema_Penyimpan'];
		$gPnyG = $mRo['Pkt_Penyimpan'];
		
		$gAkuA = $mRo['Nm_Akuntan'];
		$gAkuB = $mRo['Nip_Akuntan'];
		$gAkuC = $mRo['Jbt_Akuntan'];

		$gAkuD = $mRo['Hp_Akuntan'];
		$gAkuF = $mRo['Ema_Akuntan'];
		$gAkuG = $mRo['Pkt_Akuntan'];

	}
}
else
{
	$NmA  = "";
	$NiP  = "";
	$JaB  = "";
	$PkT  = "";
	if ($gBid=="") {$gBid=$KdProp.".".$KdKabK.".XX";}
	$gCod = $gBid.".XX";
	$gLNK = "";
	$Sbmt = "onchange='this.form.submit()'";
}
?>
<body>
<form name="myfrm" method="post" action="<?="Form_Unit_Mid_.php?IdL=".$_REQUEST['IdL']."&rIDT=".$rIDT ?>">
  <input type="hidden" name="Simpan">
  <table border="0" width="925" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse">
    <tr> 
      <td width="111">&nbsp;</td>
      <td width="14">&nbsp;</td>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Bidang</td>
      <td>&nbsp;</td>
      <td width="323">
	  <select class="boxs" name="fBid" tabindex="0" style="width: 300px" <?php echo $Sbmt?>>
        <?php
		$nSQ = "SELECT * FROM ref_bidang ORDER BY Kd_Bidang";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gBid=="") {$gBid=$mRo['Kd_Bidang'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Bidang']==$gBid) 
				{
				$sel ="selected";
				$zBid=$mRo['Kd_Bidang'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Bidang'].'">'.$mRo['Kd_Bidang']." : ".strtoupper($mRo['Nm_Bidang']).'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select></td>
      <td width="105" align="right"></td>
      <td width="16"></td>
      <td width="337">KODE UNIT (<i>SIMDA</i>) : </td>
    </tr>
    <tr> 
      <td align="right">Kode </td>
      <td>&nbsp;</td>
      <td><input name="fKode" type="text" class="text" style="border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; width:80px" value="<?php echo $gCod?>" readonly /></td>
      <td align="right">KODE UNIT</td>
      <td>&nbsp;</td>
      <td><input name="fLINK" type="text" class="text" onkeyup="addSeparatorSkpd(this)" maxlength="7" style="border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; width:60px" value="<?php echo $gLNK?>" /></td>
    </tr>
    <tr> 
      <td align="right">Nama Unit/SKPD </td>
      <td>&nbsp;</td>
      <td><input name="fNama" type="text" class="text" style="border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; width:300px" value="<?php echo $gNma?>" /></td>
      <td align="right">NAMA UNIT </td>
      <td>&nbsp;</td>
      <td><input name="fLIND" type="text" class="text" style="border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; width:300px" value="<?=$mLNK?>" /></td>
    </tr>
    <tr> 
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td align="right">Nama Pimpinan </td>
      <td>&nbsp;</td>
      <td><input name="fNmA" type="text" class="text" style="border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; width:300px" value="<?=$NmA?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">NIP Pimpinan  </td>
      <td>&nbsp;</td>
      <td><input name="fNiP" type="text" class="text" style="border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; width:300px" value="<?=$NiP?>" /></td>
      <td align="right">NOMOR HP</td>
      <td>&nbsp;</td>
      <td><input name="fHp_Pimpinan" type="text" class="text" id="fHp_Pimpinan" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gPimD?>" /></td>
    </tr>
    <tr>
      <td align="right">Pangkat / Gol.   </td>
      <td>&nbsp;</td>
      <td><input name="fPkT" type="text" class="text" style="border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; width:300px" value="<?=$PkT?>" /></td>
      <td align="right">EMAIL ADDRES</td>
      <td>&nbsp;</td>
      <td><input name="fEma_Pimpinan" type="text" class="text" id="fEma_Pimpinan" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gPimF?>" /></td>
    </tr>
    <tr>
      <td align="right">Jabatan</td>
      <td>&nbsp;</td>
      <td><input name="fJaB" type="text" class="text" style="border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; width:300px" value="<?=$JaB?>" /></td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Nama Pengurus </td>
      <td>&nbsp;</td>
      <td><input name="fNm_Pengurus" type="text" class="text" id="fNm_Pengurus" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gPrsA?>" /></td>
      <td align="right">NOMOR HP </td>
      <td>&nbsp;</td>
      <td><input name="fHp_Pengurus" type="text" class="text" id="fHp_Pengurus" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gPrsD?>" /></td>
    </tr>
    <tr>
      <td align="right">NIP Pengurus </td>
      <td>&nbsp;</td>
      <td><input name="fNip_Pengurus" type="text" class="text" id="fNip_Pengurus" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gPrsB?>" /></td>
      <td align="right">EMAIL ADDRES</td>
      <td>&nbsp;</td>
      <td><input name="fEma_Pengurus" type="text" class="text" id="fEma_Pengurus" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gPrsF?>" /></td>
    </tr>
    <tr>
      <td align="right">Pangkat / Gol. </td>
      <td>&nbsp;</td>
      <td><input name="fPkt_Pengurus" type="text" class="text" style="border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; width:250px" value="<?=$gPrsG?>" /></td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Jabatan</td>
      <td>&nbsp;</td>
      <td><input name="fJbt_Pengurus" type="text" class="text" id="fJbt_Pengurus" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gPrsC?>" /></td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Nama Penyimpan </td>
      <td>&nbsp;</td>
      <td><input name="fNm_Penyimpan" type="text" class="text" id="fNm_Penyimpan" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gPnyA?>" /></td>
      <td align="right">NOMOR HP</td>
      <td>&nbsp;</td>
      <td><input name="fHp_Penyimpan" type="text" class="text" id="fHp_Penyimpan" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gPnyD?>" /></td>
    </tr>
    <tr>
      <td align="right">NIP Penyimpan </td>
      <td>&nbsp;</td>
      <td><input name="fNip_Penyimpan" type="text" class="text" id="fNip_Penyimpan" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gPnyB?>" /></td>
      <td align="right">EMAIL ADDRES</td>
      <td>&nbsp;</td>
      <td><input name="fEma_Penyimpan" type="text" class="text" id="fEma_Penyimpan" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gPnyF?>" /></td>
    </tr>
    <tr>
      <td align="right">Pangkat / Gol. </td>
      <td>&nbsp;</td>
      <td><input name="fPkT_Penyimpan" type="text" class="text" style="border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; width:250px" value="<?=$gPnyG?>" /></td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Jabatan</td>
      <td>&nbsp;</td>
      <td><input name="fJbt_Penyimpan" type="text" class="text" id="fJbt_Penyimpan" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gPnyC?>" /></td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Nama Akuntan </td>
      <td>&nbsp;</td>
      <td><input name="fNm_Akuntan" type="text" class="text" id="fNm_Akuntan" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gAkuA?>" /></td>
      <td align="right">NOMOR HP</td>
      <td>&nbsp;</td>
      <td><input name="fHp_Akuntan" type="text" class="text" id="fHp_Akuntan" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gAkuD?>" /></td>
    </tr>
    <tr>
      <td align="right">NIP Akuntan </td>
      <td>&nbsp;</td>
      <td><input name="fNip_Akuntan" type="text" class="text" id="fNip_Akuntan" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gAkuB?>" /></td>
      <td align="right">EMAIL ADDRES</td>
      <td>&nbsp;</td>
      <td><input name="fEma_Akuntan" type="text" class="text" id="fEma_Akuntan" style="width:200px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gAkuF?>" /></td>
    </tr>
    <tr>
      <td align="right">Pangkat / Gol. </td>
      <td>&nbsp;</td>
      <td><input name="fPkT_Akuntan" type="text" class="text" style="border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; width:250px" value="<?=$gAkuG?>" /></td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Jabatan</td>
      <td>&nbsp;</td>
      <td><input name="fJbt_Akuntan" type="text" class="text" id="fJbt_Akuntan" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gAkuC?>" /></td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="4">
	    <input type="button" name="B391" value="SIMPAN" onclick="P_Save('<?=$ReO?>')" style="width: 60px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
        <input type="button" name="B392" value="RESET" onclick="P_Reset('<?=$ReO?>')" style="width: 60px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
        <input type="button" name="B393" value="TUTUP" onclick="P_Tutup()" style="width: 60px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="4">&nbsp;</td>
    </tr>
  </table>	
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Save(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}

	function P_Reset(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		objfrm.Simpan.value = "Reset";
		objfrm.submit();
	}
	
	function P_Tutup()
	{
		objfrm.Simpan.value = "Close";
		objfrm.target="_top";
		objfrm.submit();
	}
</script>

<?php require('Connection_Close.php');?>
