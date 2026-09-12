<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_header_top.css" type="text/css" media="all" />
</head>
<?php
$gUnt  = $_REQUEST['fUnt'];
$gSub  = $_REQUEST['fSub'];
$gUpb  = $_REQUEST['fUpb'];
$gThn  = $_REQUEST['fThn'];
if ($gThn=="") {$gThn = fGetDate('year');}

$gUru  = $_REQUEST['fUru'];
$gPro  = $_REQUEST['fPro'];
$gKeg  = $_REQUEST['fKeg'];
?>
<body background="css/images/newheader.gif" topmargin="0" text="#FFFFFF">
<form name="myfrm" method="post" action="<?php echo "RKBMD_Top.php?IdL=".$_REQUEST['IdL'] ?>">
<input type="hidden" name="Simpan">
<table border="0" width="1313" cellpadding="0" style="border-collapse: collapse">
  <tr>
	<td width="167" height="30"><img src="Images/LogoTopLitle.png" width="150" height="30" /></td>
	<td width="1140" height="30" style="font-family: Agency FB; font-size: 14pt; font-weight: bold; color: #E1F986; font-style:italic">RKBMD (Rencana Kebutuhan Barang Milik Daerah) TAHUN <?php echo $gThn?></td>
	</tr>
  <tr>
    <td height="30" colspan="2">
	<table border="0" width="1313" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" id="table1">
		<tr>
		  <td height="5"></td>
		  <td></td>
		  <td></td>
		  <td colspan="3"></td>
		  </tr>
		<tr>
			<td width="62" height="23">UNIT</td>
			<td width="480">
		<select class="boxs" name="fUnt" tabindex="0" style="font-family:calibri; font-size:10pt; width: 470px" onchange="P_Change()">
        <?php
		if ($Lev > 1 )
			{$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit WHERE Kd_Unit = '".substr($SkP,0,11)."' ORDER BY Kd_Unit";}
		else
			{$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUnt=="") {$gUnt=$mRo['Kd_Unit'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Unit']==$gUnt) 
				{
				$sel ="selected";
				$zUnt=$mRo['Kd_Unit'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.$mRo['Kd_Unit']." : ".$mRo['Nm_Unit'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
            </select></td>
			<td width="67">URUSAN</td>
			<td width="487">
			<select class="boxs" name="fUru" tabindex="0" style="font-family:calibri; font-size:10pt; width: 485px" onchange="P_Change()">
              <?php
		$nSQ = "SELECT Id_Referensi, Nm_Referensi FROM ref_kegiatan where Id_Referensi like '_.__.__' ORDER BY Urut";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUru=="") {$gUru=$mRo['Id_Referensi'];}
			do
			{
				$sel ="";
				if ($mRo['Id_Referensi']==$gUru) 
				{
				$sel ="selected";
				$zUru=$mRo['Id_Referensi'];
				}
				echo '<option '.$sel.' value="'.$mRo['Id_Referensi'].'">'.$mRo['Id_Referensi']." : ".$mRo['Nm_Referensi'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
            </select></td>
		    <td width="57">TAHUN</td>
		    <td width="103">
			<select class="boxs" name="fThn" style="font-family:calibri; font-size:10pt; width: 60px" tabindex="0" onchange="P_Change()">
            <?php
			for($nThn=2018; $nThn<=2030; $nThn++)
			{
			$sel ="";
			if ($gThn==$nThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
            </select></td>
		</tr>
		<tr>
			<td width="62" height="23">SUB UNIT </td>
			<td width="480"><select class="boxs" name="fSub" tabindex="0" style="font-family:calibri; font-size:10pt; width: 470px" onchange="P_Change()">
              <?php
		if ($Lev <=3 ) {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".__' ORDER BY Kd_Sub";}
		else {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".".substr($SkP,12,2)."' ORDER BY Kd_Sub";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gSub=="") {$gSub=$mRo['Kd_Sub'];}
			if (substr($gSub,0,11)!=$gUnt) {$gSub=$mRo['Kd_Sub'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Sub']==$gSub) 
				{
				$sel ="selected";
				$zSub=$mRo['Kd_Sub'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Sub'].'">'.$mRo['Kd_Sub']." : ".$mRo['Nm_Sub'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
            </select></td>
			<td width="67">PROGRAM</td>
			<td width="487">
			<select class="boxs" name="fPro" tabindex="0" style="font-family:calibri; font-size:10pt; width: 485px" onchange="P_Change()">
              <?php
		$nSQ = "SELECT Id_Referensi, Nm_Referensi FROM ref_kegiatan where Id_Referensi like '".$zUru.".__' ORDER BY Id_Referensi";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gPro=="") {$gPro=$mRo['Id_Referensi'];}
			if (substr($gPro,0,7)!=$zUru) {$gPro=$mRo['Id_Referensi'];}
			do
			{
				$sel ="";
				if ($mRo['Id_Referensi']==$gPro) 
				{
				$sel ="selected";
				$zPro=$mRo['Id_Referensi'];
				}
				echo '<option '.$sel.' value="'.$mRo['Id_Referensi'].'">'.$mRo['Id_Referensi']." : ".$mRo['Nm_Referensi'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
            </select></td>
		    <td colspan="2"><input type="button" name="B35" value="DOKUMEN" onclick="P_ViewRKBMD('800','400','center')"  style="width: 120px; height: 21px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
	      </tr>
		<tr>
		  <td height="23">UPB</td>
		  <td><select class="boxs" name="fUpb" tabindex="0" style="font-family:calibri; font-size:10pt; width: 470px" onchange="P_Change()">
            <?php
		$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUpb=="") {$gUpb = $mRo['Kd_Upb'];}
			if (substr($gUpb,0,14)!=$gSub) {$gUpb = $mRo['Kd_Upb'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Upb']==$gUpb) 
				{
				$sel ="selected";
				$zUpb=$mRo['Kd_Upb'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Upb'].'">'.$mRo['Kd_Upb']." : ".$mRo['Nm_Upb'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
          </select></td>
		  <td>KEGIATAN</td>
		  <td>
		  <select class="boxs" name="fKeg" tabindex="0" style="font-family:calibri; font-size:10pt; width: 485px" onchange="P_Change()">
            <?php
		$nSQ = "SELECT Id_Referensi, Nm_Referensi FROM ref_kegiatan where Id_Referensi like '".$zUru.".".substr($zPro,8,2).".__' ORDER BY Id_Referensi";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gKeg=="") {$gKeg=$mRo['Id_Referensi'];}
			if (substr($gKeg,0,10)!=$gPro) {$gKeg=$mRo['Id_Referensi'];}
			do
			{
				$sel ="";
				if ($mRo['Id_Referensi']==$gKeg) 
				{
				$sel ="selected";
				$zKeg=$mRo['Id_Referensi'];
				}
				echo '<option '.$sel.' value="'.$mRo['Id_Referensi'].'">'.$mRo['Id_Referensi']." : ".$mRo['Nm_Referensi'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
          </select></td>
		  <td colspan="2"><input type="button" name="B352" value="NEXT" onclick="P_Next()" style="width: 120px; height: 21px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
		  </tr>
	</table>
	</td>
    </tr>
</table>
<table border="0" width="1282" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse; font-weight:bold" cellpadding="0">
	<tr>
	  <td style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" height="5"></td>
	  <td style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"></td>
	  <td style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"></td>
	  <td style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"></td>
	  <td style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"></td>
	  <td style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"></td>
	  <td style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"></td>
	  <td style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"></td>
	  <td style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"></td>
	  <td colspan="2" style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"></td>
    </tr>
	<tr>
		<td width="55" style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="center">NO</td>
		<td width="129" style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		KODE</td>
		<td width="245" style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">NAMA 
		BARANG</td>
		<td width="248" style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">DESKRIPSI</td>
		<td width="82" style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		MERK/TYPE</td>
		<td width="86" style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
		UKURAN</td>
		<td width="73" style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">QUANTITY</td>
		<td width="79" style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">SATUAN</td>
		<td width="105" style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="right">
		HARGA</td>
		<td width="123" style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="right">
		JUMLAH</td>
	    <td width="33" style="padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" align="right">&nbsp;</td>
	</tr>
</table>
</form>
</body>
</html>
<script language="JavaScript">
	var objfrm=document.myfrm;
	function P_Next()
	{
		objfrm.Simpan.value = "Next";
		objfrm.submit();
	}	
	
	function P_Change()
	{
		objfrm.Simpan.value = "View";
		objfrm.submit();
	}
	
	function P_ViewRKBMD(w,h,pos)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		<?php
		$URL="RKBMD_Dokumen.php?zKeg=".$zKeg."&zUpb=".$zUpb."&zThn=".$gThn."&IdL=".$_REQUEST['IdL'];
		?>
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open('<?php echo $URL?>','',settings);
	}
</script>
<?php if ($_REQUEST['Simpan']=="View") {?>
	<script language="JavaScript">
		window.open("<?php echo "RKBMD_Mid.php?JusV=1&IdL=".$_REQUEST['IdL'] ?>","WinOpenRKB_Mid");
	</script>
<?php } ?>
<?php if ($_REQUEST['Simpan']=="Next") {?>
	<script language="JavaScript">
		window.open("<?php echo "RKBMD_Mid.php?JusV=0&zKeg=".$zKeg."&zUpb=".$zUpb."&zThn=".$gThn."&IdL=".$_REQUEST['IdL'] ?>","WinOpenRKB_Mid");
	</script>
<?php } ?>