<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
$gKib   = $_GET['gKib'];
if (isset($_POST['fUnt'])) {$gUnt   = $_POST['fUnt'];} else {$gUnt;}
if (isset($_POST['fSub'])) {$gSub   = $_POST['fSub'];} else {$gSub;}
if (isset($_POST['fUpb'])) {$gUpb   = $_POST['fUpb'];} else {$gUpb;}
if (isset($_POST['fThn'])) {$gThn   = $_POST['fThn'];} else {$gThn;}
if ($gThn=="") {$gThn=fGetDate('year')-1;}
?>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_upload_top.css" type="text/css" media="all" />
</head>
<body topmargin="0">
<form name="myfrm" method="post" action="<?php echo "Import_KIB_Top.php?gKib=".$gKib."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'] ?>">
<table border="0" width="1031" cellpadding="0" style="border-collapse: collapse">
  <tr> 
      <td width="174" height="30" valign="top"><img src="Images/LogoTopLitle.png" width="150" height="30" /></td>
      <td height="30" width="121" valign="top" style="font-family: Agency FB; font-size: 14pt; font-weight: bold; color: #E1F986; font-style:italic"><?php echo $_GET['FrmG']?></td>
      <td width="728" style="font-family: Calibri; font-size: 10pt; font-weight: bold; color: #ffffff"> 
        <table border="0" width="673" cellpadding="0" style="border-collapse: collapse" id="table1">
          <tr> 
            <td width="69" height="20">UNIT</td>
            <td width="567"><select class="boxs" name="fUnt" tabindex="0" style="width: 500px" onchange="this.form.submit()">
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
            <td width="29">&nbsp;</td>
          </tr>
          <tr> 
            <td height="20">SUB UNIT</td>
            <td><select class="boxs" name="fSub" tabindex="0" style="width: 500px" onchange="this.form.submit()">
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
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="20">UPB</td>
            <td><select class="boxs" name="fUpb" tabindex="0" style="width: 500px" onchange="this.form.submit()">
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
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td height="20">TAHUN</td>
            <td><select class="boxs" name="fThn" style="width: 60px" tabindex="0" onchange="this.form.submit()">
                <?php
				for($nThn=2010; $nThn<=2030; $nThn++)
				{
				$sel ="";
				if ($gThn==$nThn) {$sel ="selected";}
				echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
				}
				?>
              </select>
              &nbsp; <input type="button" name="Refresh" value="REFRESH" onclick="P_Refresh()" style="height:19px; width:100px" /></td>
            <td>&nbsp;</td>
          </tr>
        </table>	
	</td>
  </tr>
</table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	gUnt = objfrm.fUnt.value;
	gSub = objfrm.fSub.value;
	gUpb = objfrm.fUpb.value;
	gThn = objfrm.fThn.value;
	window.open("Import_KIB_Mid.php?gUnt="+gUnt+"&gSub="+gSub+"&gUpb="+gUpb+"&gThn="+gThn+"<?="&gKib=".$gKib."&IdL=".$_GET['IdL']?>","WinOpenXLS_Mid<?=$gKib?>");
	
	function P_Refresh()
	{
		window.open("Import_KIB_Mid.php?gUnt="+gUnt+"&gSub="+gSub+"&gUpb="+gUpb+"&gThn="+gThn+"<?="&gKib=".$gKib."&IdL=".$_GET['IdL']?>","WinOpenXLS_Mid<?=$gKib?>");
	}
</script>
