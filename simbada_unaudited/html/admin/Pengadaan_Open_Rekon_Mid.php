<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<? if ($_POST['Simpan']=="Close") {?>
	<script LANGUAGE="JavaScript">            
	this.setTimeout("self.close()",0)
	</script>
<? } ?>

<?
if (isset($_POST['fUnt'])) {$gUnt  = $_POST['fUnt'];}

$rHri = fGetDate('mday');
$rBln = fGetDate('mon');
$rThn = fGetDate('year');

#if ($gThA=="") {$gThA  = (fGetDate('year'))-1;}
if ($gThA=="") {$gThA  = fGetDate('year')-1;}
?>

<body>
<form name="myfrm" method="post" action="<?php echo "Open_KIB_Choise_Mid.php?IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Simpan">
  <table border="0" align="center" style="width:640px">
    <tr> 
      <td width="11">&nbsp;</td>
      <td width="113">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>UNIT KERJA</td>
      <td> 
        <select name="fUnt" tabindex="0" style="width: 420px">
        <?
		if ($Lev <= 1 ) {echo "<option value='All'>All</option>";}
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
				$gUnt=$mRo['Kd_Unit'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.$mRo['Kd_Unit']." : ".$mRo['Nm_Unit'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
    </tr>
    
    
    <tr> 
      <td>&nbsp;</td>
      <td>TAHUN</td>
      <td width="502" valign="middle">
		<select class="boxs" name="fThA" style="width: 60px" tabindex="0">
		<?
		for($nThn=2016; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($gThA==$nThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>	  </td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td>DOKUMEN</td>
      <td colspan="3" valign="middle">
	  <select class="boxs" name="fDoK" style="width:200px" tabindex="0">
	  <option value="0">Pilih..!!</option>
	  <option value="">Rekap Aset (Program Kegiatan)</option>
	  <option value="_Rinci">Rinci Aset (Program Kegiatan)</option>
	  <option value="_Reken">Rekapitulasi Rekening</option>
	  <option value="_Reken_Rinci">Rekapitulasi Rekening (Rinci) *</option>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>TANGGAL CETAK</td>
      <td colspan="3" valign="middle">
		<select class="boxs" name="fHriC" tabindex="0">
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
		<select class="boxs" name="fBlnC" tabindex="0">
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
		<select class="boxs" name="fThnC" style="width: 60px" tabindex="0">
		<?
		for($nThn=1900; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$rThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="middle">
	<input type="button" name="B01" value="DOKUMEN" onclick="P_OpenDoc('800','400','<?=$_GET['IdL']?>')"  style="width: 100px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	<input type="button" name="B02" value="TUTUP" onclick="P_Close()"  style="width: 100px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />	  </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_OpenDoc(w,h,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		
		var gUnt=objfrm.fUnt.value;
		var gThA=objfrm.fThA.value;
		var gDoK=objfrm.fDoK.value;
		if (gDoK=='0'){alert('Silahkan pilih jenis dokumen..!!'); return false;}
		var gTh =objfrm.fThnC.value;
		var gBl =objfrm.fBlnC.value;
		var gHr =objfrm.fHriC.value;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= "Pengadaan_Rekon"+gDoK+".php?gUnt="+gUnt+"&gThA="+gThA+"&gTh="+gTh+"&gBl="+gBl+"&gHr="+gHr+"&IdL="+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
	}

</script>

<?php require('Connection_Close.php');?>
