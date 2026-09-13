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
<body onload="RefreshDATA('a','<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="#">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; background-color:#D2DAC4">
  <tr>
    <td width="3">&nbsp;</td>
    <td width="632">&nbsp;</td>
    <td width="52">&nbsp;</td>
    <td width="50">&nbsp;</td>
    <td width="277">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td><textarea name="fFnDa" onkeypress="if (event.keyCode==13) {RefreshDATA('a','<?=$IdL?>'); return false;}" style="font-family:verdana; width:630px; height:60px; font-size:9pt"></textarea></td>
    <td><input type="button" name="B392" value="GO" onclick="RefreshDATA('a','<?=$IdL?>'); return false;" style="width: 40px; height: 65px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    <td width="50"><div id="loadingImg" style="width:30px; height:30px; display:none; vertical-align:middle; text-align:center"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
    <td><textarea name="fFnDc" onkeypress="if (event.keyCode==13) {RefreshDATA('c','<?=$IdL?>'); return false;}" style="color:#fff; background:#000; font-family:verdana; width:580px; height:60px; font-size:9pt"></textarea></td>
    <td><input type="button" name="B3923" value="GO" onclick="RefreshDATA('c','<?=$IdL?>'); return false;" style="width: 40px; height: 65px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td>
	<!--input name="fFnD" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$IdL?>'); return false;}" style="padding-left:5px; width:210px; border: 1px solid #C0C0C0"/-->
	<textarea name="fFnDb" onkeypress="if (event.keyCode==13) {RefreshDATA('b','<?=$IdL?>'); return false;}" style="font-family:verdana; width:630px; height:80px; font-size:9pt"></textarea>	</td>
    
	<td><input type="button" name="B3922" value="GO" onclick="RefreshDATA('b','<?=$IdL?>'); return false;" style="width: 40px; height: 85px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
	<td>&nbsp;</td>
	<td><textarea name="fFnDd" onkeypress="if (event.keyCode==13) {RefreshDATA('d','<?=$IdL?>'); return false;}" style="font-family:verdana; width:580px; height:80px; font-size:9pt">select p1.kd_aset, saldoAkhir, p2.kd_aset, sum(p2.debet) from ta_kib_post_saldo_mutasi p1 left join ta_kib_post p2 on p2.kd_aset=p1.kd_aset where p1.kd_unit like '24.04.08.01%' and p2.kd_upb like '24.04.08.01%' and p1.kd_aset like '02%' and p1.tahun='2017' and p2.extracom='N' and p2.tanggal<='2017-12-31' group by p1.kd_aset</textarea></td>
    <td><input type="button" name="B39222" value="GO" onclick="RefreshDATA('d','<?=$IdL?>'); return false;" style="width: 40px; height: 85px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #C9DCD8; font-weight:bold">
  <tr>
    <td><a href="#" class="ico merg" onclick="injectDATA('KibB','500','600','<?=$_GET['IdL']?>'); return false">INJEK KIB</a></td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%;">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	<div id="ViewDATA" style="height:300px; width:1350px; overflow: hidden; border:0px"></div>
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
		if (crt=='a'){
			var gFnD = ReplaceText(objfrm.fFnDa.value);
		}
		if (crt=='b'){
			var gFnD = ReplaceText(objfrm.fFnDb.value);
		}
		if (crt=='c'){
			var gFnD = ReplaceText(objfrm.fFnDc.value);
		}
		if (crt=='d'){
			var gFnD = ReplaceText(objfrm.fFnDd.value);
		}
		$(document).ready(function()
		{
			$.ajax({
				url:"Utility_QueryData_Frm_Data.php",
				data: {gFnD:gFnD,IdL:IdL},
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

	function injectDATA(crt,w,h,IdL)
	{
		//alert(tbl); return false;
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= 'Utility_QueryData_Frm_Inject.php?crt='+crt+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
</script>