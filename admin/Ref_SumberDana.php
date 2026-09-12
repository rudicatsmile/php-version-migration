<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>SimB@DA</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="global.js"></script>
</head>
<?php
extract($_GET);
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="Ref_SumberDana.php?IdL=".$_GET['IdL']?>">
<input type="hidden" name="fSave" style="width:20px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:800px">
  <tr>
    <td width="8">&nbsp;</td>
    <td width="50">&nbsp;</td>
    <td width="27">&nbsp;</td>
    <td width="231">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">Find</td>
    <td align="center">&nbsp;</td>
    <td><input type="text" name="fDataFind" id="fDataFind" placeholder='Search' onkeypress="if (event.keyCode==13){B3923.click(); return false;}" style="width:200px; padding: 1px 1px 3px 25px; background-image: url('css/images/prev.gif'); background-position: 3px 3px; background-repeat: no-repeat" /></td>
    <td><input type="button" name="B3923" id="B3923" value="GO" onclick="RefreshDATA('<?=$IdL?>')" style="width:25px; height: 21px" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:800px; height:30px; background: #EAE6E6">
  <tr>
    <td width="5">&nbsp;</td>
    <td><input type="button" name="B3922" value="ADD ITEM" onclick="formEDIT('','','<?=$IdL?>')" style="width: 80px; height: 21px" />
	</td>
    <td width="5">&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:800px; height:20px; background: #CEFBE3; font-weight:bold">
  <tr>
    <td width="28" style="border-right:1px #ccc solid; text-align:center">No</td>
    <td width="100" style="border-right:1px #ccc solid; text-align:center">Kode
	<div id="alasMstCri" class="upload_a">
		<div id="alasDiv1Cri" class="upload_b"></div>
		<div id="alasDiv2Cri" class="upload_c"></div>
	</div>
	</td>
    <td width="250" style="border-right:1px #ccc solid; text-align:center">Sumber Dana</td>
    <td width="250" style="border-right:1px #ccc solid; text-align:center">Alias</td>
    <td align="center">ACTION</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:799px; height:400px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	<div id="ViewDATA" style="height:400px; width:799px; overflow:auto; border:0px; border-radius:4px"></div>
	</td>
  </tr>
</table>
</form>
</body>
</html>
<script languange="javascript">
	var objfrm=document.myfrm;
	function RefreshDATA(IdL)
	{
		FnD = ReplaceText($("#fDataFind").val());
		
		$(document).ready(function()
		{
			$("#ViewDATA").load('Ref_SumberDana_Data.php?FnD='+FnD+'&IdL='+IdL);
		});
	}
	
	function closeEDIT()
	{
		document.getElementById('alasMstCri').style.display = "none";
	}
	
	function formDELE(IdT,IdL)
	{
		//alert(IdT); return false;
		AN = confirm("Delete record..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('Ref_SumberDana_Del.php?IdT='+IdT+'&IdL='+IdL);
			});
		}
	}
	
	function formEDIT(CrT,IdT,IdL)
	{
		if (CrT=='refr')
		{
			$(document).ready(function()
			{
				$("#alasDiv2Cri").load('Ref_SumberDana_Mid.php?IdT='+IdT+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('alasDiv2Cri');

			$(document).ready(function()
			{
				$("#alasDiv1Cri").load('Ref_SumberDana_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#alasDiv2Cri").load('Ref_SumberDana_Mid.php?IdT='+IdT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('alasMstCri');
		}
	}
	
	function resetEDIT(ReO,IdL)
	{
		$(document).ready(function()
		{
			$("#alasDiv2Cri").load('Ref_SumberDana_Mid.php?IdL='+IdL);
		});
	}
	
	function refresEDIT(IdT,IdL)
	{
		$(document).ready(function()
		{
			$("#alasDiv2Cri").load('Ref_SumberDana_Mid.php?IdT='+IdT+'&IdL='+IdL);
		});
		RefreshDATA(gIdL);
	}
	
	function saveEDIT(ReO,IdT,IdL)
	{
		NmSB = $("#fNmSB").val();
		AlIA = $("#fAlIA").val();

		$(document).ready(function()
		{
			$.post('Ref_SumberDana_Save.php',
			{"NmSB":NmSB,"AlIA":AlIA,"IdT":IdT,"IdL":IdL},
			function( data )
			{
				IdT= data['IdT'];
				formEDIT('refr',IdT,IdL);
			},"json");
		})
	}
	
	function ReplaceText(gFnD)
	{
		for (i=1; i<=100; i++)
		{
			gFnD = gFnD.replace(' ','**');
		}
		return gFnD;
	}
</script>