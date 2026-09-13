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
<script type="text/javascript" src="global.js"></script>
</head>
<?php
extract($_GET);
#echo $KdR1;
if ($rKdR==''){$rKdR=1;}
$KdR1 = substr($rKdR,0,1);
$NmR1 = fGlobal("Nm_Rek","ref_rek_1","Kd_Rek",$KdR1,"=","","");

$KdR2 = substr($rKdR,0,3);
$NmR2 = fGlobal("Nm_Rek","ref_rek_2","Kd_Rek",$KdR2,"=","","");

$KdR3 = substr($rKdR,0,6);
$NmR3 = fGlobal("Nm_Rek","ref_rek_3","Kd_Rek",$KdR3,"=","","");

$KdR4 = $rKdR;
$NmR4 = fGlobal("Nm_Rek","ref_rek_4","Kd_Rek",$KdR4,"=","","");
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1200px">
  <tr>
    <td width="100">&nbsp;</td>
    <td width="20">&nbsp;</td>
    <td width="511">&nbsp;</td>
    <td width="35">&nbsp;</td>
    <td width="20">&nbsp;</td>
    <td width="202">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="23">
    <td class="ar">BIDANG</td>
    <td class="ac">:</td>
    <td>
	<input name="fKdR1" id="fKdR1" type="text" value="<?=$KdR1?>" readonly="readonly" style="padding-left:5px; width:60px; border: 1px solid #C0C0C0"/>
	<input name="dKdR1" id="dKdR1" type="text" value="<?=$NmR1?>" onclick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" style="padding-left:5px; width:350px; border: 1px solid #C0C0C0"/>
	&nbsp;&nbsp;&nbsp;<a href="<?="Ref_Kode_Rekn_13_1.php?FrmG=REFERENSI -> KODE REKENING PERMENDAGRI 13/2006&IdL=".$_GET['IdL']?>" class="ico prev"></a>
	</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="23">
    <td class="ar">KELOMPOK</td>
    <td class="ac">:</td>
    <td>
	<input name="fKdR2" id="fKdR2" type="text" value="<?=$KdR2?>" readonly="readonly" style="padding-left:5px; width:60px; border: 1px solid #C0C0C0"/>
	<input name="dKdR2" id="dKdR2" type="text" value="<?=$NmR2?>" onclick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" style="padding-left:5px; width:350px; border: 1px solid #C0C0C0"/>
	&nbsp;&nbsp;&nbsp;<a href="<?="Ref_Kode_Rekn_13_2.php?FrmG=REFERENSI -> KODE REKENING PERMENDAGRI 13/2006&rKdR=".$KdR1."&IdL=".$_GET['IdL']?>" class="ico prev"></a>
	</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="23">
    <td class="ar">JENIS</td>
    <td class="ac">:</td>
    <td>
	<input name="fKdR3" id="fKdR3" type="text" value="<?=$KdR3?>" readonly="readonly" style="padding-left:5px; width:60px; border: 1px solid #C0C0C0"/>
	<input name="dKdR3" id="dKdR3" type="text" value="<?=$NmR3?>" onclick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" style="padding-left:5px; width:350px; border: 1px solid #C0C0C0"/>
	&nbsp;&nbsp;&nbsp;<a href="<?="Ref_Kode_Rekn_13_3.php?FrmG=REFERENSI -> KODE REKENING PERMENDAGRI 13/2006&rKdR=".$KdR2."&IdL=".$_GET['IdL']?>" class="ico prev"></a>
	</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="23">
    <td class="ar">OBJEK</td>
    <td class="ac">:</td>
    <td>
	<input name="fKdR4" id="fKdR4" type="text" value="<?=$KdR4?>" readonly="readonly" style="padding-left:5px; width:60px; border: 1px solid #C0C0C0"/>
	<input name="dKdR4" id="dKdR4" type="text" value="<?=$NmR4?>" onclick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" style="padding-left:5px; width:350px; border: 1px solid #C0C0C0"/>
	&nbsp;&nbsp;&nbsp;<a href="<?="Ref_Kode_Rekn_13_4.php?FrmG=REFERENSI -> KODE REKENING PERMENDAGRI 13/2006&rKdR=".$KdR3."&IdL=".$_GET['IdL']?>" class="ico prev"></a>
	</td>
    <td class="ar">FIND</td>
    <td class="ac">:</td>
    <td><input name="fFnD" id="fFnD" type="text" value="" placeholder='search' onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$IdL?>'); return false;}" style="padding-left:5px; width:180px; border: 1px solid #C0C0C0"/></td>
    <td><input type="button" name="B39" value="GO" onclick="RefreshDATA('<?=$IdL?>')" style="width:80px; height:21px" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:1200px; height:20px; background: #C9DCD8; font-weight:bold">
  <tr>
    <td width="30" class="ac">NO</td>
    <td width="100" class="ac">KODE</td>
    <td width="425" class="al" style="padding-left:6px">RINCIAN OBJEK (<i>Sumber : P13 Kab. Hulu Sungai Tengah</i>)
	<div id="dataMstCri" class="editrekn0Cri">
		<div id="dataDiv1Cri" class="editrekn1Cri"></div>
		<div id="dataDiv2Cri" class="editrekn2Cri"></div>
	</div>
	</td>
    <td width="525" class="al">MAPPING PERMENDAGRI 90/2019 (<i>Sumber : Mapping Kab. Hulu Sungai Tengah</i>)</td>
    <td class="al">ACTION</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1200px; height:300px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	<div id="ViewDATA" style="height:300px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1200px; height:30px">
  <tr>
    <td>&nbsp;&nbsp;&nbsp;
	<a href="#" onClick="editDATA('5','addnew','','','<?=$IdL?>'); return false" class="ico add">&nbsp;Add Item</a>&nbsp;&nbsp;&nbsp;
	<a href="#" onClick="prinDATA('800','400','<?=$IdL?>'); return false" class="ico docu">&nbsp;Dokumen</a>
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
	
	function closeCLICK(crt,IdL)
	{
		document.getElementById(crt+'MstVeri').style.display = "none";
		if (crt=='form') {RefreshDATA(IdL);}
	}
	
	function RefreshDATA(IdL)
	{
		KdR4 = $("#fKdR4").val();
		gFnD = ReplaceText(objfrm.fFnD.value);
		$(document).ready(function()
		{
			$.ajax({
				url:"Ref_Kode_Rekn_13_5_Data.php",
				data: {KdR4:KdR4,gFnD:gFnD,IdL:IdL},
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
	
	function editDATA(Lev,CrT,IdT,rCek,IdL)
	{
		if (CrT=='refr')
		{
			$(document).ready(function()
			{
				$("#dataDiv2Cri").load('Ref_Kode_Rekn_13_All_Data_Mid.php?Lev='+Lev+'&IdT='+IdT+'&IdL='+IdL);
			});
		}
		else if (CrT=='reset')
		{
			fKdM = $("#fKdR4").val();
			$(document).ready(function()
			{
				$("#dataDiv2Cri").load('Ref_Kode_Rekn_13_All_Data_Mid.php?fKdM='+fKdM+'&Lev='+Lev+'&IdL='+IdL);
			});
		}
		else
		{
			fKdM = $("#fKdR4").val();
			dispBLOCK('dataDiv2Cri');
			$(document).ready(function()
			{
				$("#dataDiv1Cri").load('Ref_Kode_Rekn_13_All_Data_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#dataDiv2Cri").load('Ref_Kode_Rekn_13_All_Data_Mid.php?fKdM='+fKdM+'&Lev='+Lev+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('dataMstCri');
		}
	}
	
	function saveDATA(Lev,IdT,IdL)
	{
		KdR = ReplaceText($("#fKdR").val());
		NmR = ReplaceText($("#fNmR").val());
				
		$(document).ready(function()
		{
			$("#dataDiv2Cri").load('Ref_Kode_Rekn_13_All_Data_Save.php?KdR='+KdR+'&NmR='+NmR+'&Lev='+Lev+'&IdT='+IdT+'&IdL='+IdL
			);
		});
	}
	
	function deleteDATA(Lev,IdT,rCek,IdL)
	{
		if (rCek!=''){alert('Acces denied...!'); return false;}
		AN = confirm('Delete data rekening..?');
		if (!AN){return false;}
		$(document).ready(function()
		{
			$("#ViewDELL").load('Ref_Kode_Rekn_13_All_Data_Del.php?Lev='+Lev+'&IdT='+IdT+'&IdL='+IdL
			);
		});
	}
	
	function prinDATA(w,h,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		eKD = $("#fKdR4").val();
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL = 'Ref_Kode_Rekn_13_Doc.php?Lev=4&eKD='+eKD+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
</script>