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
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1020px">
  <tr>
    <th width="16">&nbsp;</th>
    <th width="67">&nbsp;</th>
    <th width="16">&nbsp;</th>
    <th width="78">&nbsp;</th>
    <th width="39">&nbsp;</th>
    <th width="130">&nbsp;</th>
    <th width="41">&nbsp;</th>
    <th width="904">&nbsp;</th>
    </tr>
  
  <tr height="25">
    <th>&nbsp;</th>
    <th align="right">PERIODE</th>
    <th align="center">&nbsp;</th>
    <th>
	
	<select class="boxs" name="fTHN" id="fTHN" tabindex="0" style="width:60px; background:#99FF00" onchange="RefreshDATA('<?=$IdL?>')">
	<?php
	for ($i=2019; $i<=2030; $i++)
	{
		$sel ="";
		#if ($mRo[0]==$gJNS) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select>	</th>
    <th>DATA</th>
    <th>
	<select class="boxs" name="fUBH" id="fUBH" tabindex="0" style="width:100px; background:#99FF00" onchange="RefreshDATA('<?=$IdL?>')">
	<option value="0">Murni</option>
	<option value="1">Perubahan</option>
	</select>
	</th>
    <th>FIND</th>
    <th style="padding-right:5px">
	  <input name="fFnD" id="fFnD" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$IdL?>'); return false;}" style="padding-left:5px; width:200px; border: 1px solid #C0C0C0"/>
      <input type="button" name="B39" value="GO" onclick="RefreshDATA('<?=$IdL?>')" style="width: 40px; height: 21px" />
	</th>
    </tr>
  <tr>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th align="center"><div id="loadingImg" style="width:40px; height:10px; display:none; text-align:center"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:1020px; height:20px; background: #C9DCD8; font-weight:bold">
  <tr>
    <td width="30" align="center">NO</td>
    <td width="80" align="center">KODE</td>
    <td width="460">UNIT KERJA</td>
    <td width="142">USULAN PENGADAAN </td>
    <td width="142">USULAN PEMELIHARAAN</td>
    <td>USULAN PEMINDAHTANGAN </td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1020px; height:390px">
  <tr>
    <td valign="top" align="center">
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	<div id="ViewDATA" style="height:430px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1020px; height:22px; background-color:#D2DAC4">
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
	function ReplaceText(FnD)
	{
		for (i=1; i<=100; i++)
		{
			FnD = FnD.replace(' ','**');
		}
		return FnD;
	}
	
	function RefreshDATA(IdL)
	{
		gTHN = $("#fTHN").val();
		gUBH = $("#fUBH").val();
		gFnD = $("#fFnD").val();
		gFnD = ReplaceText(gFnD);
		
		$(document).ready(function()
		{
			$("#ViewDATA").load('RKBMD_New_Security_Data.php?gFnD='+gFnD+'&gTHN='+gTHN+'&gUBH='+gUBH+'&IdL='+IdL);
		});
		
		/*
		$(document).ready(function()
		{
			$.ajax({
				url:"Invent_Usulan_Data.php",
				data: {gUnT:gUnT,gHR:gHR,gBL:gBL,gTH:gTH,gHRd:gHRd,gBLd:gBLd,gTHd:gTHd,gFnD:gFnD,gJNS:gJNS,IdL:IdL},
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
		*/
	}
	
	function saveDATA(NiL,Crt,IdT,IdL)
	{
		//alert(NiL+' : '+Crt+' : '+IdT+' : '+IdL);
		$(document).ready(function()
		{
			$("#ViewDELL").load('RKBMD_New_Security_Data_Save.php?NiL='+NiL+'&Crt='+Crt+'&IdT='+IdT+'&IdL='+IdL);
		});
	}
</script>