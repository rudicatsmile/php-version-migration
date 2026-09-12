<?php
require('Connection.php');
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
<?php
extract($_GET);
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="Ref_Usulan_Ketera.php?IdL=".$_GET['IdL']?>">
<input type="hidden" name="fSave" style="width:20px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1200px">
  <tr>
    <td width="8">&nbsp;</td>
    <td width="50">&nbsp;</td>
    <td width="27">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="99">&nbsp;</td>
    <td width="29">&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">USULAN</td>
    <td align="center">:</td>
    <td>
	<select class="boxs" name="fJNS" tabindex="0" style="width:211px" onchange="RefreshDATA('<?=$IdL?>')">
		<?php
		$nSQ="SELECT Kode, Deskripsi FROM ref_usulan_jenis ORDER BY IDT";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$sel ="";
			if ($mRo[0]==$gJNS) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[1].'</option>';
		}
		?>
    </select>
	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1200px; height:30px; background: #EAE6E6">
  <tr>
    <td width="5">&nbsp;</td>
    <td>
	<input type="button" name="B3923" value="REFRESH" onclick="RefreshDATA('<?=$IdL?>')" style="width: 80px; height: 21px" />
    <input type="button" name="B3922" value="ADD ITEM" onclick="formEDIT('<?=$ReO?>','<?=$gIDT?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
	</td>
    <td width="5">&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:1200px; height:20px; background: #CEFBE3; font-weight:bold">
  <tr>
    <td width="30" align="center">NO</td>
    <td width="100" align="center">KODE</td>
    <td align="left">&nbsp;DESKRIPSI
	<div id="alasMstCri" class="upload_a">
		<div id="alasDiv1Cri" class="upload_b"></div>
		<div id="alasDiv2Cri" class="upload_c"></div>
	</div>
	</td>
    <td width="150" align="center">&nbsp;</td>
    <td width="150" align="center">ACTION</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1199px; height:400px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	<div id="ViewDATA" style="height:400px; width:1193px; overflow:auto; border:0px; border-radius:4px"></div>
	</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1200px">
  <tr height="20">
    <td>&nbsp;</td>
  </tr>
</form>
</body>
</html>
<script languange="javascript">
	var objfrm=document.myfrm;
	function RefreshDATA(IdL)
	{
		var fJN = objfrm.fJNS.value;
		$(document).ready(function()
		{
			$("#ViewDATA").load('Ref_Usulan_Ketera_Data.php?gJN='+fJN+'&IdL='+IdL);
		});
	}
	
	function closeEDIT()
	{
		document.getElementById('alasMstCri').style.display = "none";
	}
	
	function formDELE(ReO,gID,DeL,gIdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (DeL) {alert('Access denied, data sudah digunakan...!!'); return false;}
		
		var AN = confirm("Delete record..?!!");
		if (AN)
		{
			var gJN = objfrm.fJNS.value;
			$(document).ready(function()
			{
				$("#alasDiv2Cri").load('Ref_Usulan_Ketera_Del.php?gID='+gID+'&gJN='+gJN+'&IdL='+gIdL);
			});
		}
	}
	
	function formEDIT(ReO,gID,gIdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		var gJN = objfrm.fJNS.value;
		document.getElementById('alasDiv2Cri').style.display = "block";
		$(document).ready(function()
		{
			$("#alasDiv1Cri").load('Ref_Usulan_Ketera_Top.php?gID='+gID+'&IdL='+gIdL);
		});
		
		$(document).ready(function()
		{
			$("#alasDiv2Cri").load('Ref_Usulan_Ketera_Mid.php?gID='+gID+'&gJN='+gJN+'&IdL='+gIdL);
		});
		
		if (document.getElementById('alasMstCri').style.display == "block")
		{
			document.getElementById('alasMstCri').style.display = "none";
		}
		else
		{
			document.getElementById('alasMstCri').style.display = "block";
		}
	}
	
	function resetEDIT(ReO,gIdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		var gJN = objfrm.fJNS.value;
		$(document).ready(function()
		{
			$("#alasDiv2Cri").load('Ref_Usulan_Ketera_Mid.php?gJN='+gJN+'&IdL='+gIdL);
		});
	}
	
	function refresEDIT(gID,gIdL)
	{
		var gJN = objfrm.fJNS.value;
		$(document).ready(function()
		{
			$("#alasDiv2Cri").load('Ref_Usulan_Ketera_Mid.php?gID='+gID+'&gJN='+gJN+'&IdL='+gIdL);
		});
		RefreshDATA(gIdL);
	}
	
	function saveEDIT(ReO,gID,gIdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		var gJN = objfrm.fJNS.value;
		var gDS = ReplaceText(document.getElementById('fDS').value);
		$(document).ready(function()
		{
			$("#alasDiv2Cri").load('Ref_Usulan_Ketera_Save.php?gID='+gID+'&gDS='+gDS+'&gJN='+gJN+'&IdL='+gIdL);
		});
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