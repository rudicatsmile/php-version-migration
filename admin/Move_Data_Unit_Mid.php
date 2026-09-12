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
if (isset($_GET['gUnt'])) {$gUnt  = $_GET['gUnt'];}
if (isset($_GET['gSub'])) {$gSub  = $_GET['gSub'];}
if (isset($_GET['gUpb'])) {$gUpb  = $_GET['gUpb'];}
?>

<body>
<form name="myfrm" method="post" action="<?php echo "Move_Data_Unit_Mid_.php?IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Proses">
  <table width="1165" border="0" align="center">
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="14">&nbsp;</td>
    </tr>
    <tr> 
      <td width="26">&nbsp;</td>
      <td width="133">UNIT KERJA</td>
      <td colspan="14"> 
        <select name="fUnt" id="fUnt" tabindex="0" style="width:400px" onchange="NameChange()">
          <?php
		$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
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
      <td>&nbsp;</td>
      <td align="center" valign="middle">&nbsp;</td>
      <td align="center" valign="middle">&nbsp;</td>
      <td align="center" valign="middle">&nbsp;</td>
      <td align="center" valign="middle">&nbsp;</td>
      <td align="center" valign="middle">&nbsp;</td>
      <td align="center" valign="middle">&nbsp;</td>
      <td align="center" valign="middle">&nbsp;</td>
      <td align="center" valign="middle">&nbsp;</td>
      <td align="center" valign="middle">&nbsp;</td>
      <td align="center" valign="middle">&nbsp;</td>
      <td align="center" valign="middle">&nbsp;</td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>KODE  BARU </td>
      <td width="20" align="center" valign="middle"><input name="fKd1" type="text" id="fKd1" value="<?=$KdProp?>" style="text-align: center; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; width:20px" maxlength="2" /></td>
      <td width="10" align="center" valign="middle">.</td>
      <td width="20" align="center" valign="middle"><input name="fKd2" type="text" id="fKd2" value="<?=$KdKabK?>" style="text-align: center; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; width:20px" maxlength="2" /></td>
      <td width="10" align="center" valign="middle">.</td>
      <td width="20" align="center" valign="middle"><input name="fKd3" type="text" id="fKd3" value="" style="text-align: center; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; width:20px" maxlength="2" /></td>
      <td width="10" align="center" valign="middle">.</td>
      <td width="20" align="center" valign="middle"><input name="fKd4" type="text" id="fKd4" value="" style="text-align: center; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; width:20px" maxlength="2" /></td>
      <td width="10" align="center" valign="middle">.</td>
      <td width="20" align="center" valign="middle">&nbsp;</td>
      <td width="10" align="center" valign="middle">.</td>
      <td width="20" align="center" valign="middle">&nbsp;</td>
      <td width="10" valign="middle">&nbsp;</td>
      <td width="5" valign="middle">&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
    
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="14" valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="14" valign="middle" style="color:#FF0000">
	  <input type="button" name="B1" value="PROSES" onclick="P_Proses()"  style="width: 60px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B3" value="TUTUP" onclick="P_Close()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  &nbsp;&nbsp;<?php if (isset($_REQUEST['MsG'])) {echo $_REQUEST['MsG'];}?>
	  </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="14" valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="14" valign="middle">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;

	function P_Proses()
	{
		AN = confirm('Lanjutkan proses?');
		if (!AN){return false;}
		objfrm.Proses.value = "Proses";
		objfrm.submit();
	}

	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.Proses.value = "Close";
		objfrm.submit();
	}
	
	function NameChange()
	{
		$("#fNma").val('');
	}
</script>

<?php require('Connection_Close.php');?>
