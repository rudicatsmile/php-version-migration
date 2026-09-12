<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
</head>
</head>
<?php
#extract($_GET);
#echo $JusV;

$zKeg = $_GET['zKeg'];
$zUpb = $_GET['zUpb'];
$zThn = $_GET['zThn'];
$JusV = $_GET['JusV'];
?>
<body>
<?php if ($JusV=="0") { ?>
<form name="myfrm" method="post" action="<?="RKBMD_Mid_.php?JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'] ?>">
<input type="hidden" name="Simpan">

<table border="0" width="1220" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse">
	<?php
	$JmlRc = fGlobal("COUNT(*)","ta_rkbmd","Kd_UPB:Kd_Kegiatan:Tahun",$zUpb.":".$zKeg.":".$zThn,"=:=:=","","");
	if ($JmlRc==0)
	{
		$DibB = "disabled";
	}
	else
	{
		$DibB = "";
	}
	?>
	<?php
	$tJml = 0;
	$nSQL= "SELECT * FROM ta_rkbmd WHERE Kd_UPB='".$zUpb."' AND Kd_Kegiatan = '".$zKeg."' AND Tahun = '".$zThn."' ORDER BY IDO";
	#echo $nSQL;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
	$iG=1;
	do
		{
			$IDO  = $mRo['IDO'];
			$rCod = $mRo['Kd_Aset'];
			$rNma = $mRo['Nm_Aset'];
			$rDes = $mRo['Deskripsi'];
			$rMrk = $mRo['Merk_Type'];
			$rUkr = $mRo['Ukuran'];
			$rQty = $mRo['Qty'];
			$rSat = $mRo['Satuan'];
			$rHrg = $mRo['Harga'];
			$rJml = $mRo['Jumlah'];
			$tJml = $tJml + $rJml;
			?>
				<script Language="javascript">
				function P_Acc<?php echo $IDO?>(w,h,xR)
				{
					if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
					var win=null;
					var txtHTML = "";
					var iErrors=0;
					LeftPosition = (screen.width-w)/2;
					TopPosition	 = (screen.height-h)/2;
					settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=yes,menubar=no,toolbar=no,resizable=yes';
					win=window.open('','',settings);
					if (win!=null)
					{
						win.window.document.open()
						<?php
							$URL_Top = "Find_AccRKB_Top.php?IDO=".$IDO."&JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'];
							$URL_Mid = "Find_AccRKB_Mid.php?IDO=".$IDO."&JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'];
							$URL_Bot = "Find_AccRKB_Bot.php";
						?>       			
						txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title><meta name='GENERATOR' content='Microsoft FrontPage 5.0'><meta name='ProgId' content='FrontPage.Editor.Document'></head><frameset framespacing='0' border='0' rows='30,*,25' frameborder='0'><frame name='FormRKBTop' target='FormRKBMid' noresize scrolling='no' src='<?php echo $URL_Top?>'><frame name='FormRKBMid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='FormRKBBot' src='<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>This page uses frames, but your browser doesn't support them.</p></body></noframes></frameset></html>"            
						win.focus()
						win.window.document.clear()
						win.window.document.write(txtHTML)
						win.window.document.close() 
						win.setTimeout("self.close()",200000000)
					}
				}
				</script>
			<tr>
				<td><input type="text" name="fNomo" size="2" value="<?php echo $iG?>." style="text-align:center; font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #C0C0C0" /></td>
				<td width="60"><input type="text" name="fKode" size="13" value="<?php echo $rCod?>" readonly onclick="P_Acc<?php echo $IDO?>('600','500'); return false" style="width:90px; font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" /></td>
				<td width="22"><input type="button" name="B352" value="...." onclick="P_Acc<?=$IDO?>('600','500','<?=$ReO?>'); return false" style="width: 20px; height: 19px; border: 1px solid #F00000; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
				<td><input type="text" name="fNama<?php echo $IDO?>" value="<?=$rNma?>" readonly style="width:240px; font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" /></td>
				<td><input type="text" name="fDesk<?=$IDO?>" value="<?=$rDes?>" style="width:200px; font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFFF" /></td>
				<td><input type="text" name="fMerk<?=$IDO?>" value="<?=$rMrk?>" style="width:100px; font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFFF" /></td>
				<td><input type="text" name="fUkur<?=$IDO?>" value="<?=$rUkr?>" style="width:100px; font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFFF" /></td>
				<td><input type="text" name="fQuan<?=$IDO?>" value="<?=$rQty?>" onBlur="NumValidate(this)" style="width:50px; font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFFF; text-align:center" /></td>
				<td><input type="text" name="fSatu<?=$IDO?>" value="<?=$rSat?>" style="width:90px; font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFFF; text-align: center" /></td>
				<td><input type="text" name="fHarg<?=$IDO?>" value="<?=fConvertToRupiah($rHrg)?>" onBlur="NumValidate(this)" onKeyUp="addSeparator(this)" style="width:90px; font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #FFFFFF; text-align: right" /></td>
				<td><input type="text" name="fJuml<?=$IDO?>" value="<?=fConvertToRupiah($rJml)?>" readonly style="width:90px; font-family: calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986; text-align: right" /></td>
				<td width="50" align="center" background="css/images/mnewheader.gif"><input type="checkbox" name="CheckB<?=$IDO?>" value="ON" /></td>
			</tr>
			<?php
			$iG++;
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	?>
	<tr>
		<td width="20">&nbsp;</td>
		<td colspan="2">&nbsp;</td>
		<td width="189">&nbsp;</td>
		<td width="189">&nbsp;</td>
		<td width="68">&nbsp;</td>
		<td width="68">&nbsp;</td>
		<td width="47">&nbsp;</td>
		<td width="70">&nbsp;</td>
		<td width="118" align="center">TOTAL</td>
		<td width="97"><input type="text" name="fTota" size="17" value="<?=fConvertToRupiah($tJml)?>" readonly="readonly" style="font-family: Arial; font-size: 9pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #99CC00; text-align: right" /></td>
		<td width="50" background="css/images/mnewheader.gif"><input type="checkbox" name="CheckAll" onclick="P_CkAll()" value="ON" /></td>
	</tr>
	<tr>
	  <td height="10" colspan="12"><hr color="#C0C0C0" size="1" /></td>
    </tr>
	<tr>
	  <td height="27" colspan="12">
	  <input type="button" name="B3522" value="SIMPAN" <?=$DibB?> onclick="P_Save('<?=$ReO?>')" style="width: 80px; height: 21px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B3523" value="TAMBAH ITEM" onclick="P_Add('<?=$ReO?>')" style="width: 80px; height: 21px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B3524" value="HAPUS ITEM" <?=$DibB?> onclick="P_Del('<?=$ReO?>')" style="width: 80px; height: 21px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />	  </td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td colspan="2">&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
</table>
</form>
<?php } ?>
</body>
</html>
<script language="JavaScript">
	var objfrm=document.myfrm;
	function P_Save(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}	
	
	function P_Add(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		objfrm.Simpan.value = "Add";
		objfrm.submit();
	}	
	
	function P_Del(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		var AN = confirm("Hapus baris data yang ditandai..?!!");
		if (AN)	
		{
		objfrm.Simpan.value = "Del";
		objfrm.submit();
		}
	}	

	function P_CkAll()
	{
		<?php
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			do
				{
					$IDO = $mRo['IDO'];
					?>
					if (objfrm.CheckAll.checked==false)
						{objfrm.CheckB<?=$IDO ?>.checked=false;}
					else
						{objfrm.CheckB<?=$IDO ?>.checked=true;}
					
					<?php
				}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
		?>
	}
</script>
<?php require "FileFormatNum.php"?>
<?php require('Connection_Close.php');?>
