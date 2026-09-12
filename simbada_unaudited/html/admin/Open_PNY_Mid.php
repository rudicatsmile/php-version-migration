<?
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="global.js"></script>
</head>
<?
if (isset($_GET['gUnt'])) {$gUnt = $_GET['gUnt'];}
if (isset($_GET['gThn'])) {$gThn = $_GET['gThn'];}
if (isset($_GET['gAst'])) {$gAst = $_GET['gAst'];}
if ($gThn=="") {$gThn  = fGetDate('year');}
if (isset($_GET['MsG'])) {$MsG = $_GET['MsG'];} else {$MsG="";}
$rHri = date('d');
$rBln = date('m');
$rThn = date('Y');
$gX = fGetDate('year');
$gSst="BLN";
?>
<body onload="P_Mess('<?=$MsG?>')">
<form name="myfrm" method="post" action="<?php echo "Open_PNY_Mid_.php?IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Simpan">
  <table border="0" align="center" style="width:850px">
    <tr>
      <td width="49">&nbsp;</td>
      <td width="161">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    
    <tr> 
      <td>&nbsp;</td>
      <td>UNIT KERJA</td>
      <td colspan="2"> 
        <select name="fUnt" id="fUnt" tabindex="0" style="width: 420px">
        <option value="">SEMUA UNIT KERJA</option>
		<?
		if ($Lev > 1 )
			{$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit WHERE Kd_Unit = '".substr($SkP,0,11)."' ORDER BY Kd_Unit";}
		else
			{$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			//if ($gUnt=="") {$gUnt=$mRo['Kd_Unit'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Unit']==$gUnt) 
				{
				$sel ="selected";
				$gUnt=$mRo['Kd_Unit'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.strtoupper($mRo['Nm_Unit']).'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
    </tr>
    
    <tr> 
      <td>&nbsp;</td>
      <td>THN. PELAPORAN</td>
      <td colspan="2" valign="middle"><select class="boxs" name="fThn" style="width: 60px" tabindex="0">
        <?
			for($nThn=2013; $nThn<=$gX+1; $nThn++)
			{
				$sel ="";
				if ($gThn==$nThn) {$sel ="selected";}
				echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>TANGGAL CETAK </td>
      <td colspan="2" valign="middle">
	  <select class="boxs" name="fHriC" tabindex="0" style="width:50px">
        <?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$rHri) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
      </select>
		&nbsp;
		<select class="boxs" name="fBlnC" tabindex="0" style="width:100px">
  		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$rBln) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		&nbsp;
		<select class="boxs" name="fThnC" tabindex="0" style="width:60px">
  		<?
		for($nThn<= date('Y')+1; $nThn>=2010; $nThn--)
		{
			$sel ="";
			if ($nThn==$rThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select></td>
    </tr>
    <tr height="20px"> 
      <td colspan="4" valign="middle" align="center"><div id="loadingImg" style="width:20px; height:20px; display:none; vertical-align:middle; text-align:center"><img src="Images/loading3.gif" alt="" width="20" height="20"></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"></td>
      <td valign="top"><input type="hidden" name="B01" value="REKAP" onclick="execFORM('<?=$_GET['IdL']?>')"  style="width: 60px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
      <input type="button" name="B02" value="CLOSE" onclick="P_Close()"  style="width: 60px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"></td>
      <td valign="top">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td align="center"></td>
      <td width="255" valign="top">
	  <a href="#" class="ico prev" onclick="P_Rekap('1','850','450','2','','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( KIB ALL - BIDANG)</a><br>
	  <a href="#" class="ico prev" onclick="P_RekapX('2','850','450','2','','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( KIB ALL - KELOMPOK)</a><br> 
	  <a href="#" class="ico prev" onclick="P_RekapX('3','850','450','2','','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( KIB ALL - JENIS)</a><br>
	  <a href="#" class="ico prev" onclick="P_RekapX('4','850','450','2','','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( KIB ALL - OBJEK)</a>	  </td>
      <td width="367">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" valign="middle" align="center"><div style="color:#FF0000; height:0px; width:100%" id="formDiv2Exec"></div></td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Rekap(crt,w,h,nm,mts,IdL)
	{
		var gHriC = objfrm.fHriC.value;
		var gBlnC = objfrm.fBlnC.value;
		var gThnC = objfrm.fThnC.value;
		var rTH = objfrm.fThn.value;
		var uNT = objfrm.fUnt.value;
		
		nmF="Tabel_Rekap_Penyusutan";
		//nmF="Tabel_Masa_Manfaat_Rekap_Bulan_All_Test";
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(nmF+'.php?mts='+mts+'&crt='+crt+'&gHriC='+gHriC+'&gBlnC='+gBlnC+'&gThnC='+gThnC+'&uNT='+uNT+'&rTH='+rTH+'&IdL='+IdL,'',settings);
	}
	
	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
	}

	function P_Mess(MsG)
	{
		if (MsG) {alert(MsG); return false;}
	}
	

</script>
