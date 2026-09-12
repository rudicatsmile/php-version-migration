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
<title>Sipanda-BMD</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="global.js"></script>
</head>
<?php
extract($_GET);

$gUNT = substr($SkP,0,11);
$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");

$gSUB = substr($SkP,0,14);
$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");


$gHR = fGetDate('mday');
$gBL = fGetDate('mon');
$gTH = fGetDate('year');
?>
<body onload="RefreshDATA('<?=$AsT?>','<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" id="myfrm" method="POST" enctype="multipart/form-data">
<input type="hidden" name="fA" id="fA" value="0" readonly style="width:50px"/>
<input type="hidden" name="fB" id="fB" value="0" readonly style="width:50px"/>

<!--table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px; height:24px; background: #EAE6E6">
  <tr>
    <td width="30" align="center"><img src="css/images/bukk.png" /></td>
    <td style="font-weight:bold">LAPORAN HASIL INVENTARISASI</td>
  </tr>
</table-->
<br>
<br>
<br>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:800px; color:#fff; background:#79a86a">
  <tr>
    <td width="85">&nbsp;</td>
    <td width="29">&nbsp;</td>
    <td width="684">&nbsp;</td>
  </tr>
  <tr height="23">
    <td class="ar">Unit Kerja  </td>
    <td align="center">:</td>
    <td>
	<input name="fUNT" id="fUNT" type="hidden" value="<?=$gUNT?>" readonly style="padding-left:3px; width:105px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" readonly <?php if ($Lev <= 1) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" <?php } else {echo "readonly";}?> style="padding-left:3px; width:450px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="Unit0Cri">
		<div id="unitDiv1Cri" class="Unit1Cri"></div>
		<div id="unitDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
    </tr>
  <tr height="23">
    <td class="ar">Sub Unit</td>
    <td align="center">:</td>
    <td>
	<input name="fSUB" id="fSUB" type="hidden" value="<?=$gSUB?>" readonly style="padding-left:3px; width:105px; border: 1px solid #C0C0C0"/>
	<input name="dSUB" id="dSUB" type="text" value="<?=$dSUB?>" readonly <?php if ($Lev <= 2) {?> onClick="showSUB('','<?=$_GET['IdL']?>')" <?php } else {echo "readonly";}?> style="padding-left:3px; width:450px; border: 1px solid #C0C0C0"/>
	<div id="subMstCri" class="Unit0Cri">
		<div id="subDiv1Cri" class="Unit1Cri"></div>
		<div id="subDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
    </tr>
  <tr height="23">
    <td align="right">Aset / Extra </td>
    <td align="center">:</td>
    <td>
	<select class="boxs" name="ExT" id="ExT" tabindex="0" style="width:100px">
	<?php
	echo '<option value="%">All</option>';
	echo '<option selected value="N">Aset</option>';
	echo '<option value="Y">Extracom</option>';
	?>
	</select>
    </td>
  </tr>
  <tr height="23">
    <td align="right">Tgl. Cetak</td>
    <td align="center">:</td>
    <td>
	<select class="boxs" name="fHR" id="fHR" tabindex="0" style="width:45px">
	<option value="00"></option>
	<?php
	for($i=1; $i<=31; $i++)
	{
		$sel ="";
		if ($i==$gHR) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select>
	<select class="boxs" name="fBL" id="fBL" tabindex="0" style="width:95px">
	<option value="00"></option>
  	<?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBL) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTH" id="fTH" style="width: 60px" tabindex="0">
	<option value="0000"></option>
  	<?php
	for($i=2020; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select>	</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:800px">
  <tr height="10">
    <td width="34" valign="top"></td>
    <td width="764" valign="top"></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top"><a href="#" class="ico docu" onclick="OpenReport('Report_LHI_III_C_1','800','400','<?=$IdL?>')">&nbsp;&nbsp;&nbsp;LAPORAN HASIL INVENTARISASI</a></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top"><a href="#" class="ico docu" onclick="OpenReport('Report_LHI_III_C_2','800','400','<?=$IdL?>')">&nbsp;&nbsp;&nbsp;REKAPITULASI LAPORAN HASIL INVENTARISASI</a></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr height="100">
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<script languange="javascript">
	objfrm = document.myfrm;
	function showUNIT(CrT,IdL)
	{
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findUnT").val());
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('Lembar_Kerja_Open_Rekap_Find_Unit_Mid.php?FnD='+FnD+'&IdL='+IdL);
			});
		}
		else
		{
			dispNO('subMstCri');
			dispBLOCK('unitDiv2Cri');
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('Lembar_Kerja_Open_Rekap_Find_Unit_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('Lembar_Kerja_Open_Rekap_Find_Unit_Mid.php?IdL='+IdL);
			});
			
			dispBlockOrNo('unitMstCri');
		}
	}
	
	function showSUB(CrT,IdL)
	{
		fUNT  = $("#fUNT").val();
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findSuB").val());
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('Lembar_Kerja_Open_Rekap_Find_Sub_Mid.php?FnD='+FnD+'&gUNT='+fUNT+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('subDiv2Cri');
			$(document).ready(function()
			{
				$("#subDiv1Cri").load('Lembar_Kerja_Open_Rekap_Find_Sub_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('Lembar_Kerja_Open_Rekap_Find_Sub_Mid.php?gUNT='+fUNT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('subMstCri');
		}
	}
	
	function showCLICK(crt,kde,nma,IdL)
	{
		if (crt=='unit') 
		{
			$("#fUNT").val(kde);
			$("#dUNT").val(nma);
		
			$("#fSUB").val('00.00.00.00.00');
			$("#dSUB").val('ALL');
		}
		if (crt=='sub') 
		{
			$("#fSUB").val(kde);
			$("#dSUB").val(nma);
		
		}
		dispNO(crt+'MstCri');
		
	}
	
	function closeCLICK(crt)
	{
		document.getElementById(crt+'MstCri').style.display = "none";
	}	
	
	function OpenReport(doc,w,h,IdL)
	{
		fUnt = $("#fUNT").val();
		fSub = $("#fSUB").val();
		fHR  = $("#fHR").val();
		fBL  = $("#fBL").val();
		fTH  = $("#fTH").val();
		ExT  = $("#ExT").val();
		
		LeftPosition=(screen.width)?(screen.width-800)/2:100; 
		TopPosition=(screen.height)?(screen.height-400)/2:100;
		
		URL = 'report/'+doc+'.php?ExT='+ExT+'&fHR='+fHR+'&fBL='+fBL+'&fTH='+fTH+'&fUnt='+fUnt+'&fSub='+fSub+'&IdL='+IdL;
		window.open(URL,'WinDOC'+ExT+doc+fUnt,'toolbar=no,menubar=yes, top='+TopPosition+',left='+LeftPosition+' location=no, scrollbars=yes, resizable, width=800, height='+400);
	}
</script>