<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
if (isset($_GET['gBid'])) {$gBid  = $_GET['gBid'];}
if (isset($_GET['gKel'])) {$gKel  = $_GET['gKel'];}
if (isset($_GET['gJen'])) {$gJen  = $_GET['gJen'];}

if (isset($_GET['gBid2'])) {$gBid2  = $_GET['gBid2'];}
if (isset($_GET['gKel2'])) {$gKel2  = $_GET['gKel2'];}
if (isset($_GET['gJen2'])) {$gJen2  = $_GET['gJen2'];}
?>

<body>
<form name="myfrm" method="post" action="<?php echo "WinExportRek_Mid_.php?IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Proses">
  <table width="1165" border="0" align="center">
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="10">&nbsp;</td>
    </tr>
    <tr> 
      <td width="26">&nbsp;</td>
      <td width="100">JENIS (108) </td>
      <td colspan="10">
	  <select name="fBid" tabindex="0" style="width: 400px" onchange="this.form.submit()">
		<?php
		$dG = 55;
		#$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset1 ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '1.3%' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gBid=="") {$gBid=$mRo['Kd_Aset'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gBid) 
				{
				$sel ="selected";
					$gBid=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>OBJEK (108) </td>
      <td colspan="10">
		<select class="boxs" name="fKel" tabindex="0" style="width: 400px" onchange="this.form.submit()">
		<?php
		#$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset2 WHERE Kd_Aset LIKE '".$gBid.".__' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '$gBid%' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gKel=="") {$gKel=$mRo['Kd_Aset'];}
			if (substr($gKel,0,5)!=$gBid) {$gKel=$mRo['Kd_Aset'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gKel) 
				{
				$sel ="selected";
				$gKel=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>RCN OBJEK  (108)</td>
      <td colspan="10"> 
	  <select class="boxs" name="fJen" id="fJen" tabindex="0" style="width: 400px">
		<option value=""></option>
		<?php
		#$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset3 WHERE Kd_Aset LIKE '".$gBid.".".substr($gKel,3,2).".__' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '".$gBid.".".substr($gKel,-2,2).".__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUpb=="") {$gUpb = $mRo['Kd_Aset'];}
			#if (substr($gUpb,0,14)!=$gSub) {$gUpb = $mRo['Kd_Upb'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gJen) 
				{
				$sel ="selected";
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td colspan="11"><hr /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="10">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="10">&nbsp;</td>
    </tr>
    <tr> 
      <td width="26">&nbsp;</td>
      <td width="100">JENIS (108) </td>
      <td colspan="10">
	  <select name="fBid2" tabindex="0" style="width: 400px" onchange="this.form.submit()">
		<?php
		$dG = 55;
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '1.5.4%' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gBid2=="") {$gBid2=$mRo['Kd_Aset'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gBid2) 
				{
				$sel ="selected";
					$gBid2=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>OBJEK (108)</td>
      <td colspan="10">
		<select class="boxs" name="fKel2" tabindex="0" style="width: 400px" onchange="this.form.submit()">
		<?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '".$gBid2.".__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gKel2=="") {$gKel2=$mRo['Kd_Aset'];}
			if (substr($gKel2,0,5)!=$gBid2) {$gKel2=$mRo['Kd_Aset'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gKel2) 
				{
				$sel ="selected";
				$gKel2=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>RCN OBJEK  (108)</td>
      <td colspan="10"> 
	  <select class="boxs" name="fJen2" id="fJen2" tabindex="0" style="width: 400px">
		<option value=""></option>
		<?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '".$gBid2.".".substr($gKel2,-2,2).".__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			#if ($gJen2=="") {$gJen2 = $mRo['Kd_Aset'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gJen2) 
				{
				$sel ="selected";
				}
				
				$mNm = $mRo['Nm_Aset'];
				if (strlen($mNm)>50){
					$mNm = substr($mNm,0,50)." .....";
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mNm.'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="60" valign="middle" class="ar">&nbsp;</td>
      <td width="20" valign="middle">&nbsp;</td>
      <td width="34" valign="middle">&nbsp;</td>
      <td width="34" valign="middle">&nbsp;</td>
      <td width="34" valign="middle">&nbsp;</td>
      <td width="60" valign="middle" class="ar">&nbsp;</td>
      <td width="16" valign="middle">&nbsp;</td>
      <td width="70" valign="middle">&nbsp;</td>
      <td width="30" valign="middle">&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td colspan="11"><hr /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="10" valign="middle" style="color:#FF0000"> 
        <?php if (isset($_GET['MsG'])) {echo $_GET['MsG'];}?>
        &nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="10" valign="middle">
        <input type="button" name="B2" value="EXPORT" onclick="P_Proses('creator')" style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
        <input type="button" name="B3" value="TUTUP" onclick="P_Close()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />		</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;

	function P_Proses(uid)
	{
		if ($("#fJen").val()=='') {alert('Rincian sumber belum dipilih..!!'); return false;}
		if ($("#fJen2").val()=="") {alert('Rincian tujuan belum dipilih..!!'); return false;}
		
		if (uid!='creator') {alert('Access denied..!!'); return false;}
		var AN = confirm("Proses..?!!");
		if (AN)
		{
			objfrm.Proses.value = "Proses";
			objfrm.submit();
		}
	}

	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.Proses.value = "Close";
		objfrm.submit();
	}
</script>

<?php require('Connection_Close.php');?>
