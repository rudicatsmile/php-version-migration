<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
#$Lev = 2;
#echo $AsT;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>SiCAPER</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="global.js"></script>
</head>
<?php
#$Lev=3;
extract($_GET);
$gUNT = substr($SkP,0,11);
#$dUNT = fGlobal("bidang","tb_bidang","kode",$gUNT,"=","",DatabaseSA,$ConSA,"");

$gTH = $tTbl;
$gPe = $tPer;
?>
<body onload="Btn1.click()">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="" enctype="multipart/form-data">
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1200px; ">
  <tr>
    <td width="74">&nbsp;</td>
    <td width="17">&nbsp;</td>
    <td width="65">&nbsp;</td>
    <td width="132">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  
  <tr height="25">
    <td class="ar">PERIODE</td>
    <td align="center">&nbsp;</td>
    <td>
	<select class="boxs" name="fTHN" id="fTHN" style="width: 63px; padding-left:3px" tabindex="0" onchange="RefreshDATA('<?=$IdL?>')">
      <?php
	for($i=2021; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select>
	<div id="progMstCri" class="findaset0Cri">
		<div id="progDiv1Cri" class="findaset1Cri"></div>
		<div id="progDiv2Cri" class="findaset2Cri"></div>
	</div>	</td>
    <td>
	<select name="fAPB" id="fAPB" style="width:90px; padding-left:3px" tabindex="0" onchange="RefreshDATA('<?=$IdL?>')">
	<?php
	for ($iX=0; $iX<=1; $iX++)
	{
	if ($iX==$gPe) {$sel ="selected";} else {$sel ="";}
	echo '<option '.$sel.' value="'.$iX.'">'.gNmPrBG($iX).'</option>';
	}
	?>
	</select>	</td>
    <td width="219"><input type="text" name="fFndDT" id="fFndDT" placeholder='Search' onkeypress="if (event.keyCode==13){Btn1.click();return false;}" style="width:188px; padding-left:20px; background-image: url('css/images/prev.gif'); background-position:2px 2px; background-repeat: no-repeat" tabindex="30"/></td>
    <td><input type="button" name="Btn1" id="Btn1" value="..." onClick="RefreshDATA('<?=$IdL?>')" style="width:25px; height:20px" tabindex="2" /></td>
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
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:1200px; height:20px; background: #CEFBE3; font-weight:bold">
  <tr style="font-weight:bold">
    <th width="30" style="border-right:1px solid #fff; text-align:center">NO</th>
    <th width="80" style="border-right:1px solid #fff; text-align:center">Kode</th>
    <th width="340" style="border-right:1px solid #fff; text-align:center">SKPD</th>
    <th width="130" style="border-right:1px solid #fff; text-align:center">Kode</th>
    <th width="340" style="border-right:1px solid #fff; text-align:center">Sub Unit</th>
    <th width="130"  style="border-right:1px solid #fff; text-align:center">APBD</th>
    <th style="text-align:center">KODE SKPD BARU</th>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1200px; height:375px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:300px; overflow:auto"></div>
	<div id="ViewDATA" style="height:375px; width:100%; overflow:auto; border:0px"></div>
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
		ThN = $("#fTHN").val();
		ApB = $("#fAPB").val();
		FnD = ReplaceText($("#fFndDT").val());
		$(document).ready(function()
		{
			$("#ViewDATA").load('utility_apbd_data.php?FnD='+FnD+'&ThN='+ThN+'&ApB='+ApB+'&IdL='+IdL);
		});
	}
	
	function P_Edit(val,SuB,DeL,IdL)
	{
		val = val.value;
		nva = val.length;
		ThN = $("#fTHN").val();
		ApB = $("#fAPB").val();
		if (nva!=11){alert('Input kode error...!!'); return false;}
		
		if (DeL!="") {alert('Access denied...!!'); return false;}
		var AN = confirm("Edit kode skpd..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('utility_apbd_data_save.php?val='+val+'&ThN='+ThN+'&ApB='+ApB+'&SuB='+SuB+'&IdL='+IdL);
			});
		}
	}
	
	function errorMSG(MsG)
	{
		alert(MsG); return false;
	}
	$("#fFndDT").focus();
</script>