<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
extract($_GET);
extract($_POST);
$unt = $fUNT;
$sub = $fSUB;
$upb = $fUPB;
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="Utility_ImportPostgreSQL.php?FrmG=".$FrmG."&IdL=".$IdL?>">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; background-color:#D2DAC4">
  <tr>
    <td width="25">&nbsp;</td>
    <td width="80">&nbsp;</td>
    <td width="26">&nbsp;</td>
    <td width="517">&nbsp;</td>
    <td width="643">&nbsp;</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right"> UNIT KERJA </td>
    <td align="center">&nbsp;</td>
    <td>
	<select class="boxs" name="fUNT" tabindex="0" style="width:500px" onchange="this.form.submit()">
      <?php
		$nSQ="SELECT kd_unit, nm_unit FROM ref_unit ORDER BY kd_unit";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			if ($unt==''){$unt = $mRo[0];}
			$sel ="";
			if ($unt==$mRo[0]){
				$sel  = "selected";
				$zunt = $mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo[1].'</option>';
		}
		?>
    </select></td>
    <td rowspan="2">
	<div id="loadingImg" style="width:200px; height:30px; display:none; vertical-align:middle; text-align:center"><img src="Images/loading3.gif" alt="" width="30" height="30"></div>
	</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">SUB UNIT</td>
    <td align="center">&nbsp;</td>
    <td>
	<select class="boxs" name="fSUB" tabindex="0" style="width:500px" onchange="this.form.submit()">
      <?php
		$nSQ="SELECT kd_sub, nm_sub FROM ref_sub_unit WHERE kd_sub LIKE '".$zunt."%' ORDER BY kd_sub";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			if ($unt != substr($sub,0,11)){$sub = $mRo[0];}
			$sel ="";
			if ($sub==$mRo[0]){
				$sel  = "selected";
				$zsub = $mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo[1].'</option>';
		}
		?>
    </select></td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">UPB</td>
    <td align="center">&nbsp;</td>
    <td>
	<select class="boxs" name="fUPB" id="fUPB" tabindex="0" style="width:500px" onchange="RefreshDATA('view','<?=$IdL?>')">
	<!--option value=""></option-->
	<?php
		$nSQ="SELECT kd_upb, nm_upb FROM ref_upb WHERE kd_upb LIKE '".$zsub."%' ORDER BY kd_upb";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			if ($sub != substr($upb,0,14)){$upb = $mRo[0];}
			$sel ="";
			if ($upb==$mRo[0]){
				$sel  = "selected";
				$zupb = $mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo[1].'</option>';
		}
		?>
    </select></td>
    <td>
	<input type="button" name="B39" value="REFRESH" onclick="RefreshDATA('view','<?=$IdL?>')" style="width:80px; height: 21px" />&nbsp;&nbsp;
	<input type="button" name="B392" value="IMPORT" onclick="RefreshDATA('import','<?=$IdL?>')" style="width:80px; height: 21px" />
	</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #C9DCD8; font-weight:bold">
  <tr>
    <td width="30" align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:390px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	<div id="ViewDATA" style="height:390px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:20px; background-color:#D2DAC4">
  <tr>
    <td valign="top">
	</td>
  </tr>
</table>
</form>
</body>
</html>
<script languange="javascript">
	var objfrm=document.myfrm;
	function ReplaceText(gFnD)
	{
		for (i=1; i<=100; i++)
		{
			gFnD = gFnD.replace(' ','**');
		}
		return gFnD;
	}
	
	function RefreshDATA(crt,IdL)
	{
		var gUnT = objfrm.fUNT.value;
		var gSuB = objfrm.fSUB.value;
		var gUpB = objfrm.fUPB.value;
		var gFnD = "";//ReplaceText(objfrm.fFnD.value);
		
		if (crt=='import')
		{
			$(document).ready(function()
			{
				$("#ViewDATA").load('Utility_ImportPostgreSQL_Import.php?gUnT='+gUnT+'&gSuB='+gSuB+'&gUpB='+gUpB+'&IdL='+IdL);
			});
		}
		else
		{
			$(document).ready(function()
			{
				$.ajax({
					url:"Utility_ImportPostgreSQL_Data.php",
					data: {gUnT:gUnT,gSuB:gSuB,gUpB:gUpB,IdL:IdL},
					type:"get",
					beforeSend:function()
					{
						$("#loadingImg").show();
					},
					success:function(data)
					{
						$("#loadingImg").hide();
						$("#ViewDATA").html(data);
						$("#ViewDATA").show("fast");
					}
				});
			});
		}
	}
	$("#fUPB").focus();
</script>