<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php if ($_REQUEST['Simpan']=="Close") {?>
	<script LANGUAGE="JavaScript">            
	this.setTimeout("self.close()",0)
	</script>
<?php } ?>

<?php
if (isset($_REQUEST['gUpb']))
{
	$gUnt  = $_REQUEST['gUnt'];
	$gSub  = $_REQUEST['gSub'];
	$gUpb  = $_REQUEST['gUpb'];
}
else
{
	$gUnt  = $_REQUEST['fUnt'];
	$gSub  = $_REQUEST['fSub'];
	$gUpb  = $_REQUEST['fUpb'];
}
if (isset($_POST['fHriC'])) {$rHri = $_POST['fHriC'];} else {$rHri  = fGetDate('mday');}
if (isset($_POST['fBlnC'])) {$rBln = $_POST['fBlnC'];} else {$rBln  = fGetDate('mon');}
if (isset($_POST['fThnC'])) {$rThn = $_POST['fThnC'];} else {$rThn  = fGetDate('year');}

$gThn  = $_REQUEST['fThn'];

if ($gThn=="") {$gThn  = fGetDate('year');}

$gMLK = $_REQUEST['fMilik'];
?>

<body>
<form name="myfrm" method="post" action="<?php echo "Open_KKR_Mid.php?IdL=".$_REQUEST['IdL']?>">
  <input type="hidden" name="Simpan">
  <table width="800" border="0" align="center">
    <tr> 
      <td width="15">&nbsp;</td>
      <td width="120">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>UNIT KERJA</td>
      <td> 
        <select name="fUnt" tabindex="0" style="width: 420px" onchange="this.form.submit()">
        <?php
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
      <td>SUB UNIT</td>
      <td> 
        <select class="boxs" name="fSub" tabindex="0" style="width: 420px" onchange="this.form.submit()">
        <?php
		if ($Lev <= 1 ) {echo "<option value='All'>All</option>";}
		if ($Lev <=3 ) {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".__' ORDER BY Kd_Sub";}
		else {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".".substr($SkP,12,2)."' ORDER BY Kd_Sub";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gSub=="") {$gSub=$mRo['Kd_Sub'];}
			if ((substr($gSub,0,11)!=$gUnt) && ($gSub!="All")) {$gSub=$mRo['Kd_Sub'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Sub']==$gSub) 
				{
				$sel ="selected";
				$gSub=$mRo['Kd_Sub'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Sub'].'">'.$mRo['Kd_Sub']." : ".$mRo['Nm_Sub'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>UPB</td>
      <td> 
        <select class="boxs" name="fUpb" tabindex="0" style="width: 420px" onchange="this.form.submit()">
        <?php
		if ($Lev <= 1 ) {echo "<option value='All'>All</option>";}
		$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUpb=="") {$gUpb = $mRo['Kd_Upb'];}
			if ((substr($gUpb,0,14)!=$gSub) && ($gUpb!="All")) {$gUpb = $mRo['Kd_Upb'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Upb']==$gUpb) 
				{
				$sel ="selected";
				$gUpb=$mRo['Kd_Upb'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Upb'].'">'.$mRo['Kd_Upb']." : ".$mRo['Nm_Upb'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>MILIK</td>
      <td valign="middle"><select class="boxs" name="fMilik" style="width: 250px" tabindex="0" onchange="this.form.submit()">
          <option value="All">All</option>
          <?php
		$nSQ = "SELECT * FROM ref_pemilik ORDER BY Kd_Pemilik";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			//if ($gMLK=="") {$gMLK=$mRo['Kd_Pemilik'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Pemilik']==$gMLK) 
				{
				$sel ="selected";
				$gMLK=$mRo['Kd_Pemilik'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Pemilik'].'">'.$mRo['Nm_Pemilik'].'</option>';
			}
			  while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>THN. PEROLEHAN</td>
      <td valign="middle">
	  <select class="boxs" name="fThn" style="width: 60px" tabindex="0" onchange="this.form.submit()">
          <?php if ($gUnt!="All") {?>
		  <option <?php if ($gThn=="All") {echo "selected";} ?> value="All">All</option>
		  <?php } ?>
          <?php
			$gX = fGetDate('year')+1;
			for($nThn=$gX; $nThn>=1900; $nThn--)
			{
			$sel ="";
			if ($gThn==$nThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
        </select> </td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td>S.D TANGGAL </td>
      <td valign="middle">
		<select class="boxs" name="fHriC" tabindex="0" onchange="this.form.submit()">
		<?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$rHri) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		&nbsp;
		<select class="boxs" name="fBlnC" tabindex="0" onchange="this.form.submit()">
		<?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$rBln) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		&nbsp;
		<select class="boxs" name="fThnC" style="width: 60px" tabindex="0" onchange="this.form.submit()">
		<?php
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
      <td colspan="2" align="center">
	  <input type="button" name="B02" value="KIB-B" onclick="P_OpenDoc('800','400','center','KIB_B_KK_Penyusutan')"  style="width: 60px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B03" value="KIB-C" onclick="P_OpenDoc('800','400','center','KIB_C_KK_Penyusutan')"  style="width: 60px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B04" value="KIB-D" onclick="P_OpenDoc('800','400','center','KIB_D_KK_Penyusutan')"  style="width: 60px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B05" value="KIB-E" onclick="P_OpenDoc('800','400','center','KIB_E_KK_Penyusutan')"  style="width: 60px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B07" value="LAINNYA" onclick="P_OpenDoc('800','400','center','KIB_G_KK_Penyusutan')"  style="width: 60px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_OpenDoc(w,h,pos,doc)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= doc +"<?=".php?rHri=".$rHri."&rBln=".$rBln."&rThn=".$rThn."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gMLK=".$gMLK."&IdL=".$_REQUEST['IdL']?>";
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
