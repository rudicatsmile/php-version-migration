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
<script type="text/javascript" src="global.js"></script>
</head>
<?php
extract($_GET);
$gURU = substr($rKdR,0,1);
$dURU = fGlobal("Deskripsi","ref_keg_90_1","Kode",$gURU,"=","","");
$gBDG = $rKdR;
$dBDG = fGlobal("Deskripsi","ref_keg_90_2","Kode",$gBDG,"=","","");
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px">
  <tr>
    <td width="73">&nbsp;</td>
    <td width="20">&nbsp;</td>
    <td width="526">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td width="50">&nbsp;</td>
    <td width="20">&nbsp;</td>
    <td width="193">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td class="ar">URUSAN</td>
    <td class="ac">&nbsp;</td>
    <td class="al">
	<input name="fURU" id="fURU" type="text" value="<?=$gURU?>" readonly="readonly" style="padding-left:5px; width:30px; border: 1px solid #C0C0C0"/>
    <input name="dURU" id="dURU" type="text" value="<?=$dURU?>" 	
	onclick="showURUS('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showURUS('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" 
	style="padding-left:5px; width:460px; border: 1px solid #C0C0C0"/>
	<div id="urusMstCri" class="find0Cri">
		<div id="urusDiv1Cri" class="find1Cri"></div>
		<div id="urusDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td class="al"><a href="#" class="ico left" onclick="openLINK('1','','<?=$_GET['IdL']?>')">&nbsp;</a></td>
    <td class="ar">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td class="ar">BIDANG</td>
    <td class="ac">&nbsp;</td>
    <td class="al">
	<input name="fBDG" id="fBDG" type="text" value="<?=$gBDG?>" readonly="readonly" style="padding-left:5px; width:30px; border: 1px solid #C0C0C0"/>
    <input name="dBDG" id="dBDG" type="text" value="<?=$dBDG?>" 	
	onclick="showBIDA('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showBIDA('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('bida'); return false;}" 
	style="padding-left:5px; width:460px; border: 1px solid #C0C0C0"/>
	<div id="bidaMstCri" class="find0Cri">
		<div id="bidaDiv1Cri" class="find1Cri"></div>
		<div id="bidaDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td class="al"><a href="#" class="ico left" onclick="openLINK('2','URU','<?=$_GET['IdL']?>')">&nbsp;</a></td>
    <td class="ar">FIND</td>
    <td>&nbsp;</td>
    <td><input name="fFnD" id="fFnD" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$IdL?>'); return false;}" style="padding-left:5px; width:180px; border: 1px solid #C0C0C0"/></td>
    <td><input type="button" name="B39" value="GO" onclick="RefreshDATA('<?=$IdL?>')" style="width:50px; height:21px" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
    <td width="670" align="left" style="padding-left:6px">PROGRAM
	<div id="dataMstCri" class="editrekn0Cri">
		<div id="dataDiv1Cri" class="editrekn1Cri"></div>
		<div id="dataDiv2Cri" class="editrekn2Cri"></div>
	</div>
	</td>
    <td class="ac">ACTION</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px; height:350px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	<div id="ViewDATA" style="height:350px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px; height:30px">
  <tr>
    <td>&nbsp;&nbsp;&nbsp;
	<a href="#" onClick="editDATA('<?=$ReO?>','3','addnew','','','<?=$IdL?>'); return false" class="ico add">&nbsp;Add Item</a>&nbsp;&nbsp;&nbsp;
	<!--a href="#" onClick="prinDATA('<?=$IdL?>'); return false" class="ico docu">&nbsp;Dokumen</a-->
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
		//gFnD = ReplaceText(objfrm.fFnD.value);
		gFnD = ReplaceText($("#fFnD").val());
		gIdM = ReplaceText($("#fBDG").val());
		$(document).ready(function()
		{
			$.ajax({
				url:"Ref_ProKeg_90_3_Data.php",
				data: {gFnD:gFnD,gIdM:gIdM,IdL:IdL},
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
				$("#dataDiv2Cri").load('Ref_ProKeg_90_All_Data_Mid.php?Lev='+Lev+'&IdT='+IdT+'&IdL='+IdL);
			});
		}
		else if (CrT=='reset')
		{
			fKdM = $("#fBDG").val();
			$(document).ready(function()
			{
				$("#dataDiv2Cri").load('Ref_ProKeg_90_All_Data_Mid.php?fKdM='+fKdM+'&Lev='+Lev+'&IdL='+IdL);
			});
		}
		else
		{
			fKdM = $("#fBDG").val();
			if (fKdM==''){alert('Error bidang..!!'); return false;}
			dispBLOCK('dataDiv2Cri');
			$(document).ready(function()
			{
				$("#dataDiv1Cri").load('Ref_ProKeg_90_All_Data_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#dataDiv2Cri").load('Ref_ProKeg_90_All_Data_Mid.php?fKdM='+fKdM+'&Lev='+Lev+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('dataMstCri');
		}
	}
	
	function saveDATA(ReO,Lev,IdT,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		KdR = ReplaceText($("#fKdR").val());
		NmR = ReplaceText($("#fNmR").val());
				
		$(document).ready(function()
		{
			$("#dataDiv2Cri").load('Ref_ProKeg_90_All_Data_Save.php?KdR='+KdR+'&NmR='+NmR+'&Lev='+Lev+'&IdT='+IdT+'&IdL='+IdL
			);
		});
	}
	
	function deleteDATA(ReO,Lev,IdT,rCek,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (rCek!=''){alert('Access denied...!!'); return false;}
		AN = confirm('Delete data ..?');
		if (!AN){return false;}
		$(document).ready(function()
		{
			$("#ViewDELL").load('Ref_ProKeg_90_All_Data_Del.php?Lev='+Lev+'&IdT='+IdT+'&IdL='+IdL
			);
		});
	}
	
	function showURUS(CrT,IdL)
	{
		
		if (CrT=='find'){
			gFnD = ReplaceText($("#dURU").val());
			$(document).ready(function()
			{
				$("#urusDiv2Cri").load('Ref_ProKeg_90_All_Urus_Mid.php?gFnD='+gFnD+'&IdL='+IdL);
			});
		}
		else {
			dispNO('bidaMstCri');
			dispBLOCK('urusDiv2Cri');
			$(document).ready(function()
			{
				$("#urusDiv1Cri").load('Ref_ProKeg_90_All_Urus_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#urusDiv2Cri").load('Ref_ProKeg_90_All_Urus_Mid.php?IdL='+IdL);
			});
			dispBlockOrNo('urusMstCri');
		}
		$("#dURU").select();
	}
	
	function showBIDA(CrT,IdL)
	{
		KdID = $("#fURU").val()
		if (CrT=='find'){
			gFnD = ReplaceText($("#dBDG").val());
			$(document).ready(function()
			{
				$("#bidaDiv2Cri").load('Ref_ProKeg_90_All_Bida_Mid.php?KdID='+KdID+'&gFnD='+gFnD+'&IdL='+IdL);
			});
		}
		else {
			dispBLOCK('bidaDiv2Cri');
			$(document).ready(function()
			{
				$("#bidaDiv1Cri").load('Ref_ProKeg_90_All_Bida_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#bidaDiv2Cri").load('Ref_ProKeg_90_All_Bida_Mid.php?KdID='+KdID+'&IdL='+IdL);
			});
			dispBlockOrNo('bidaMstCri');
		}
		$("#dBDG").select();
	}
	
	function showCLICK(crt,mesg,refs,kde,nma,IdL)
	{
		if (crt=='urus') 
		{
			objfrm.fURU.value = kde;
			objfrm.dURU.value = nma;
			
			objfrm.fBDG.value = '';
			objfrm.dBDG.value = '';
		}
		if (crt=='bida') 
		{
			objfrm.fBDG.value = kde;
			objfrm.dBDG.value = nma;
			
		}
		dispNO(crt+'MstCri');
		RefreshDATA(IdL);
	}	
	
	function openLINK(Lev,FrM,IdL)
	{
		if (FrM!=''){
			KdM = $("#f"+FrM).val();
			window.open('Ref_ProKeg_90_'+Lev+'.php?FrmG=REFERENSI -> REFERENSI PROGRAM KEGIATAN 90/2019&rKdR='+KdM+'&IdL='+IdL,'_self');
		}
		else{
			window.open('Ref_ProKeg_90_'+Lev+'.php?FrmG=REFERENSI -> REFERENSI PROGRAM KEGIATAN 90/2019&IdL='+IdL,'_self');
		}
	}
</script>