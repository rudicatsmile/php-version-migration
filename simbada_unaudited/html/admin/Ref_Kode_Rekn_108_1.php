<?
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
<script type="text/javascript" src="global.js"></script>
</head>
<?
extract($_GET);

?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px">
  <tr>
    <td width="73">&nbsp;</td>
    <td width="21">&nbsp;</td>
    <td width="220">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  
  <tr>
    <td class="ar">FIND</td>
    <td>&nbsp;</td>
    <td><input name="fFnD" id="fFnD" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$IdL?>'); return false;}" style="padding-left:5px; width:200px; border: 1px solid #C0C0C0"/></td>
    <td><input type="button" name="B39" value="GO" onclick="RefreshDATA('<?=$IdL?>')" style="width:80px; height:21px" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:1000px; height:20px; background: #C9DCD8; font-weight:bold">
  <tr>
    <td width="30" align="center">NO</td>
    <td width="100" align="center">KODE</td>
    <td width="670" align="left" style="padding-left:6px">NAMA KELOMPOK
	  <div id="dataMstCri" class="editrekn0Cri">
		<div id="dataDiv1Cri" class="editrekn1Cri"></div>
		<div id="dataDiv2Cri" class="editrekn2Cri"></div>
	</div>
	</td>
    <td class="ac">ACTION</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px; height:370px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	<div id="ViewDATA" style="height:370px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px; height:30px">
  <tr>
    <td>&nbsp;&nbsp;&nbsp;
	<a href="#" onClick="editDATA('<?=$ReO?>','1','addnew','','','<?=$IdL?>'); return false" class="ico add">&nbsp;Add Item</a>&nbsp;&nbsp;&nbsp;
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
		gFnD = ReplaceText(objfrm.fFnD.value);
		$(document).ready(function()
		{
			$.ajax({
				url:"Ref_Kode_Rekn_108_1_Data.php",
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
	
	function editDATA(ReO,Lev,CrT,IdT,rCek,IdL)
	{
		//if (rCek){alert('Access denied..!!'); return false;}
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (CrT=='refr')
		{
			$(document).ready(function()
			{
				$("#dataDiv2Cri").load('Ref_Kode_Rekn_108_All_Data_Mid.php?ReO='+ReO+'&Lev='+Lev+'&IdT='+IdT+'&IdL='+IdL);
			});
		}
		else if (CrT=='reset')
		{
			fKdM = "1";
			$(document).ready(function()
			{
				$("#dataDiv2Cri").load('Ref_Kode_Rekn_108_All_Data_Mid.php?ReO='+ReO+'&fKdM='+fKdM+'&Lev='+Lev+'&IdL='+IdL);
			});
		}
		else
		{
			//alert(''); return false;
			fKdM = "1";
			dispBLOCK('dataDiv2Cri');
			$(document).ready(function()
			{
				$("#dataDiv1Cri").load('Ref_Kode_Rekn_108_All_Data_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#dataDiv2Cri").load('Ref_Kode_Rekn_108_All_Data_Mid.php?ReO='+ReO+'&fKdM='+fKdM+'&Lev='+Lev+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('dataMstCri');
		}
	}
	
	function saveDATA(ReO,Lev,IdT,IdL)
	{
		KdR = ReplaceText($("#fKdR").val());
		NmR = ReplaceText($("#fNmR").val());
				
		$(document).ready(function()
		{
			$("#dataDiv2Cri").load('Ref_Kode_Rekn_108_All_Data_Save.php?ReO='+ReO+'&KdR='+KdR+'&NmR='+NmR+'&Lev='+Lev+'&IdT='+IdT+'&IdL='+IdL
			);
		});
	}
	
	function deleteDATA(ReO,Lev,IdT,rCek,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (rCek!=''){alert('Acces denied...!'); return false;}
		AN = confirm('Delete data rekening..?');
		if (!AN){return false;}
		$(document).ready(function()
		{
			$("#ViewDELL").load('Ref_Kode_Rekn_108_All_Data_Del.php?Lev='+Lev+'&IdT='+IdT+'&IdL='+IdL
			);
		});
	}
	
	function prinDATA(w,h,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL = "Ref_Kode_Rekn_108_Doc.php?Lev=1&IdL="+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
</script>