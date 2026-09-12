<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?
$rIDT = $_REQUEST['rIDT'];

$nSQ = "SELECT * FROM ta_penghapusan_usulan WHERE IDT='".$rIDT."'";
$nRs = mysql_query($nSQ) or die(mysql_error());
$mRo = mysql_fetch_assoc($nRs);
$tRo = mysql_num_rows($nRs);
if ($tRo > 0)
{
	$gREF  = $mRo['Referensi'];
	$gTGL  = fConvertDateShort($mRo['Tanggal']);
	$gNMR  = $mRo['Nomor'];
	$gNIL  = fGlobal("IfNull(sum(Nilai),0)","ta_penghapusan_usulan_rinc","Referensi",$gREF,"=","","");
	
	$gSTA  = $mRo['Status'];
	$gNoSK = $mRo['No_SK'];
	$gTgSK = fConvertDateShort($mRo['Tgl_SK']);
	if ($mRo['Eksekusi']=="Y") {$gEXE="<i>Executed</i>";} else {$gEXE="";}
}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Form_Execute_Usulan_Mid_.php?rIDT=".$rIDT."&gThn=".$_REQUEST['gThn']."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL'] ?>">
<input type="hidden" name="Simpan">
<table border="0" width="865" cellspacing="2" style="font-family: Calibri; font-size:9pt; border-collapse: collapse">
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="3">&nbsp;</td>
    </tr>
	<tr>
	  <td width="6">&nbsp;</td>
		<td width="123">TANGGAL USULAN </td>
      <td width="260"><input name="fTGL" type="text" class="text" id="fTGL" readonly style="font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gTGL?>" size="30" maxlength="100" /></td>
	  <td width="140">STATUS USULAN </td>
	  <td width="314"><input name="fTGL2" type="text" class="text" id="fTGL2" readonly="readonly" style="font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gSTA?>" size="30" maxlength="100" /></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>NOMOR USULAN </td>
	  <td><input name="fNMR" type="text" class="text" id="fNMR" readonly style="font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gNMR?>" size="30" maxlength="100" /></td>
      <td> NOMOR SK </td>
      <td><input name="fNoSK2" type="text" class="text" id="fNoSK2" style="font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gNoSK?>" size="30" maxlength="100" /></td>
	</tr>
	
	<tr>
	  <td>&nbsp;</td>
	  <td>NILAI  </td>
	  <td><input name="fNIL" type="text" class="text" id="fNIL" readonly style="text-align: right; font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo fConvertToRupiah($gNIL)?>" size="30" maxlength="100" /></td>
      <td>TANGGAL SK </td>
      <td><input name="fTGL22" type="text" class="text" id="fTGL22" readonly="readonly" style="font-size:9pt; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gTgSK?>" size="30" maxlength="100" /></td>
	</tr>
	<tr>
	  <td colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <th width="43">No</th>
          <th width="137">Referensi</th>
          <th width="106">Kode</th>
          <th width="369">Nama Barang </th>
          <th width="105" class="ar">Nilai</th>
          <th width="99" class="ac">Status</th>
        </tr>
        <?
	  	$gTtL = 0;
	  	$iG = 1;
		$nSQL= "SELECT * FROM ta_penghapusan_usulan_rinc WHERE Referensi = '".$gREF."' ORDER BY Kd_Aset, Referensi";
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			$rNIL = $mRo['Nilai'];
			$gTtL = $gTtL + $rNIL;
			if ($mRo['Eksekusi']=="Y") {$rEXE="<i>Executed</i>";}
			?>
			<tr style="cursor: pointer" onmouseover="this.style.cursor='pointer'">
			  <td valign="top"><? echo $iG++?>.</td>
			  <td valign="top"><? echo $mRo['Ref_Aset']?></td>
			  <td valign="top"><? echo $mRo['Kd_Aset']?></td>
			  <td valign="top"><? echo $mRo['Nm_Aset']?></td>
			  <td valign="top" class="ar"><? echo fConvertToRupiah($rNIL)?></td>
			  <td valign="top" align="center"><? echo $rEXE?></td>
			</tr>
			<?
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
		else
		{
		?>
        <tr>
          <td></td>
          <td colspan="2">Data tidak ditemukan..!!</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <?
		}
		?>
        <tr>
          <td colspan="6"><hr size="0" /></td>
        </tr>
        <tr>
          <td colspan="4" style="font-weight:bold; text-align:center">TOTAL</td>
          <td style="text-align:right; font-weight:bold"><?=fConvertToRupiah($gTtL)?></td>
          <td>&nbsp;</td>
        </tr>
        
      </table></td>
    </tr>
	<? if ($gEXE!="") {?>
	<tr>
	  <td colspan="5" style="font-size:12pt; color:#FF0000; text-align:center"><?=$gEXE?></td>
    </tr>
	<? } ?>
	<tr>
	  <td colspan="5"><input type="button" name="B1" value="EXEKUSI" onclick="P_Execute('<?=$gEXE?>','<?=$ReO?>')" style="width: 90px; height: 20px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	    <input type="button" name="B13" value="BATALKAN" onclick="P_Cancel('<?=$ReO?>')" style="width: 90px; height: 20px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
        <input type="button" name="B12" value="TUTUP" onclick="P_Close()" style="width: 90px; height: 20px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
</table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Execute(pExe,xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		if (pExe!="")
		{
			window.alert('Access denied..!!');
		}
		else
		{
			var AN = confirm("Eksekusi penghapusan data aset..?!!");
			if (AN)
			{
			objfrm.Simpan.value = "Eksekusi";
			objfrm.submit();
			}
		}
	}
	
	function P_Cancel(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		var AN = confirm("Batalkan eksekusi penghapusan data aset..?!!");
		if (AN)
		{
		objfrm.Simpan.value = "Batalkan";
		objfrm.submit();
		}
	}
	
	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
	}
</script>

<?php require('Connection_Close.php');?>
