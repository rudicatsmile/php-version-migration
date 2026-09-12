<?
require('Connection.php');
require('ConnectionMysql.php');
require('FileFunction.php');
require("CheckLogin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?
extract($_GET);
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="#">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; background-color:#D2DAC4">
  <tr>
    <td width="15">&nbsp;</td>
    <td width="77">&nbsp;</td>
    <td width="16">&nbsp;</td>
    <td width="269">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="657" rowspan="2"><div id="loadingImg" style="width:200px; height:30px; display:none; vertical-align:middle; text-align:center"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">DB SUMBER</td>
    <td align="center">&nbsp;</td>
    <td>
	<select class="boxs" name="fDBA" id="fDBA" tabindex="0" style="width:250px">
	<option value=""></option>
	<?
	CallConnection(DatabaseMY,$ConMY);
	$nSQ="Show Databases";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$sel ="";
		echo '<option '.$sel.' value="'.$mRo[0].'">'.strtoupper($mRo[0]).'</option>';
	}
	?>
    </select></td>
    <td width="38">&nbsp;</td>
    <td width="219">&nbsp;</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">DB TARGET</td>
    <td align="center">&nbsp;</td>
    <td>
	<select class="boxs" name="fDBB" id="fDBB" tabindex="0" style="width:250px">
	<option value=""></option>
	<?
	$nSQ="Show Databases";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$sel ="";
		echo '<option '.$sel.' value="'.$mRo[0].'">'.strtoupper($mRo[0]).'</option>';
	}
	?>
    </select></td>
    <td>FIND</td>
    <td><input name="fFnD" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$IdL?>'); return false;}" style="padding-left:5px; width:210px; border: 1px solid #C0C0C0"/></td>
    <td><input type="button" name="B39" value="GO" onclick="RefreshDATA('<?=$IdL?>')" style="width: 40px; height: 21px" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #C9DCD8; font-weight:bold">
  <tr>
    <td width="672">&nbsp;DB SUMBER</td>
    <td>&nbsp;DB TARGET</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:390px">
  <tr>
    <td valign="top">
	<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center">
		<tr>
		<td valign="top"><div id="ViewDATA" style="height:390px; width:650px; overflow:auto; border:0px"></div></td>
		<td valign="top" width="10" style="background:#C9DCD8">&nbsp;</td>
		<td valign="top"><div id="ViewDATB" style="height:390px; width:650px; overflow:auto; border:0px"></div></td>
		</tr>
	</table>
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	
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
	
	function RefreshDATA(IdL)
	{
		var fDBA = objfrm.fDBA.value;
		var fDBB = objfrm.fDBB.value;
		var gFnD = ReplaceText(objfrm.fFnD.value);
		
		/*
		$(document).ready(function()
		{
			$("#ViewDATA").load('Utility_FindData_Frm_Data.php?gUnT='+gUnT+'&gFnD='+gFnD+'&IdL='+IdL);
		});
		*/
		
		$(document).ready(function()
		{
			$.ajax({
				url:"Utility_CopyData_DataA.php",
				data: {fDBA:fDBA,fDBB:fDBB,gFnD:gFnD,IdL:IdL},
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
		
		$(document).ready(function()
		{
			$.ajax({
				url:"Utility_CopyData_DataB.php",
				data: {fDBA:fDBA,fDBB:fDBB,gFnD:gFnD,IdL:IdL},
				type:"get",
				beforeSend:function()
				{
					$("#loadingImg").show();
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#ViewDATB").html(data);
					$("#ViewDATB").show("fast");
				}
			});
		});
	}
	
	function copydata(iD,IdL)
	{
		//alert(x0);
		fDBA = objfrm.fDBA.value;
		fDBB = objfrm.fDBB.value;
		gFnD = ReplaceText(objfrm.fFnD.value);
		AN=confirm('Copy data?');
		if (AN){
			$(document).ready(function()
			{
				$("#ViewDELL").load('Utility_CopyData_Copy.php?iD='+iD+'&fDBA='+fDBA+'&fDBB='+fDBB+'&gFnD='+gFnD+'&IdL='+IdL);
			});
		}
	}
</script>