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
</head>
<?
#$Lev=3;
extract($_GET);
$gUNT = substr($SkP,0,11);
$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
$gTH = $tTbl;
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="Invent_Usulan_Frm_.php?IdT=".$IdT."&IdL=".$_GET['IdL']?>" enctype="multipart/form-data">
<!--input type="hidden" name="fSave" style="width:20px" /-->
<!--input type="hidden" name="fCrT" style="width:20px" /-->
<!--input type="hidden" name="fIdT" style="width:20px" /-->
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1200px; ">
  <tr>
    <td width="24">&nbsp;</td>
    <td width="71">&nbsp;</td>
    <td width="20">&nbsp;</td>
    <td width="75">&nbsp;</td>
    <td width="49">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="183">&nbsp;</td>
    <td width="44">&nbsp;</td>
    <td width="139">&nbsp;</td>
    <td width="65">&nbsp;</td>
  </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">PERIODE</td>
    <td align="center">&nbsp;</td>
    <td>
	<select class="boxs" name="fTHN" style="width: 63px" tabindex="0" onchange="RefreshDATA('<?=$IdL?>')">
      <?
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
	<select class="boxs" name="fAPB" id="fAPB" style="width:90px" tabindex="0" onchange="RefreshDATA('<?=$IdL?>')">
	<option value="0" <? if ($uTbl=='0') {echo "selected";}?>>Murni</option>
	<option value="1" <? if ($uTbl=='1') {echo "selected";}?>>Perubahan</option>
    </select>
	</td>
    <td width="621">&nbsp;</td>
    <td></td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">UNIT KERJA </td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<input name="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" type="text" value="<?=$dUNT?>" <? if ($Lev<=2) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" <? } else {echo "readonly";}?> style="padding-left:5px; width:510px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="find0Cri" style="width:600px">
		<div id="unitDiv1Cri" class="find1Cri" style="width:600px"></div>
		<div id="unitDiv2Cri" class="find2Cri" style="width:600px"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1200px; height:30px; background: #EAE6E6">
  <tr>
    <td width="5">&nbsp;</td>
    <td>
      <input type="button" name="B11" value="REFRESH" onclick="RefreshDATA('<?=$IdL?>')" style="width: 120px; height: 21px" />
	  <!--input type="button" name="B12" <?=$DisA?> value="ADD PROGRAM" onclick="showPROG('','<?=$_GET['IdL']?>')" style="width: 120px; height: 21px" /><?=str_repeat("&nbsp;",10)?> &nbsp;&nbsp;&nbsp;&nbsp;-->
	  <input type="button" disabled name="B12" <?=$DisA?> value="ADD PROGRAM" onclick="addITEM('<?=$_GET['IdL']?>')" style="width: 120px; height: 21px" />
	  <input type="hidden" name="B13" value="CETAK" onclick="choiseTANGGAL('<?=$_GET['IdL']?>')" style="width: 120px; height: 21px; color:#0000FF" />
	</td>
    <td width="5">&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:1200px; height:20px; background: #CEFBE3; font-weight:bold">
  <tr>
    <td width="30" align="center">NO</td>
    <td width="133" align="center">KODE</td>
    <td align="left">NAMA PROGRAM</td>
    <td width="90" align="right">BELANJA</td>
    <td width="120" align="center">ACTION</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1200px; height:330px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:300px; overflow:auto"></div>
	<div id="ViewDATA" style="height:400px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
</form>
</body>
</html>
<script languange="javascript">
	var objfrm=document.myfrm;
	
	function showUNIT(CrT,gIdL)
	{
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dUNT.value);
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('Ref_ProgramSKPD_Find_Unit_Mid.php?gFnD='+gFnD+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('unitDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('Ref_ProgramSKPD_Find_Unit_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('Ref_ProgramSKPD_Find_Unit_Mid.php?IdL='+gIdL);
			});
			
			if (document.getElementById('unitMstCri').style.display == "block")
			{
				document.getElementById('unitMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('unitMstCri').style.display = "block";
			}
		}
	}
	
	function showCLICK(crt,kde,nma,IdL)
	{
		fUNT = objfrm.fUNT.value;
		fTHN = objfrm.fTHN.value;
		fAPB = objfrm.fAPB.value;
		
		if (crt=='unit') 
		{
			objfrm.fUNT.value = kde;
			objfrm.dUNT.value = nma;
			RefreshDATA(IdL);
		}
		if (crt=='prog') 
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('Ref_ProgramSKPD_Find_Prog_Add.php?IdT='+kde+'&gUNT='+fUNT+'&gTHN='+fTHN+'&gAPB='+fAPB+'&IdL='+IdL);
			});
		}
		document.getElementById(crt+'MstCri').style.display = "none";
	}
	
	function closeCLICK(crt)
	{
		document.getElementById(crt+'MstCri').style.display = "none";
	}
	
	function addITEM(IdL)
	{
		var fUNT = objfrm.fUNT.value;
		var fTHN = objfrm.fTHN.value;
		$(document).ready(function()
		{
			$("#ViewDELL").load('Ref_ProgramSKPD_Data_Add_Item.php?gUNT='+fUNT+'&gTHN='+fTHN+'&IdL='+IdL);
		});
	}
	
	function showPROG(CrT,IdL)
	{
		var gUNT = objfrm.fUNT.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.fFindP.value);
			$(document).ready(function()
			{
				$("#progDiv2Cri").load('Ref_ProgramSKPD_Find_Prog_Mid.php?gFnD='+gFnD+'&gUNT='+gUNT+'&IdL='+IdL);
			});
		}
		else
		{
			document.getElementById('progDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#progDiv1Cri").load('Ref_ProgramSKPD_Find_Prog_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#progDiv2Cri").load('Ref_ProgramSKPD_Find_Prog_Mid.php?gUNT='+gUNT+'&IdL='+IdL);
			});
			
			if (document.getElementById('progMstCri').style.display == "block")
			{
				document.getElementById('progMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('progMstCri').style.display = "block";
			}
		}
	}
	
	function RefreshDATA(IdL)
	{
		fUNT = objfrm.fUNT.value;
		fTHN = objfrm.fTHN.value;
		fAPB = objfrm.fAPB.value;
		$(document).ready(function()
		{
			$("#ViewDATA").load('Ref_ProgramSKPD_Data.php?gUNT='+fUNT+'&gTHN='+fTHN+'&gAPB='+fAPB+'&IdL='+IdL);
		});
	}
	
	function P_Remove(IdT,DeL,IdL)
	{
		if (DeL!="") {alert('Access denied...!!'); return false;}
		var AN = confirm("Remove program..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('Ref_ProgramSKPD_Data_Del.php?IdT='+IdT+'&IdL='+IdL);
			});
		}
	}
	
	function P_Dokumen(w,h,IdT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='Invent_Usulan_Frm_Data_Dok_Rinci.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function showDOC(w,h,IdL)
	{
		var gUNT = objfrm.fUNT.value;;
		var JeNS = objfrm.fJeNS.value;
		
		var HR1 = objfrm.fHR1.value;
		var BL1 = objfrm.fBL1.value;
		var TH1 = objfrm.fTH1.value;
		
		var HR2 = objfrm.fHR2.value;
		var BL2 = objfrm.fBL2.value;
		var TH2 = objfrm.fTH2.value;
		
		var HR3 = objfrm.fHR3.value;
		var BL3 = objfrm.fBL3.value;
		var TH3 = objfrm.fTH3.value;
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='Invent_Usulan_Frm_Data_Dok.php?gUNT='+gUNT+'&JeNS='+JeNS+'&HR1='+HR1+'&HR2='+HR2+'&HR3='+HR3+'&BL1='+BL1+'&BL2='+BL2+'&BL3='+BL3+'&TH1='+TH1+'&TH2='+TH2+'&TH3='+TH3+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
		//closeCLICK('choise');
	}
	
	function errorMSG(MsG)
	{
		alert(MsG); return false;
	}
	
	function CekX(xY,yX)
	{
		ret = "";
		if (xY.indexOf(yX.toUpperCase())!="-1"){ret="no";}
		return ret;
	}
	
	function P_Save(field,IdT,CrT,DeL,IdL)
	{
		if (CrT=='kode1' || CrT=='kode3'){
			
			lent = field.value.length;
			anys = field.value.toUpperCase();
			
			if (CrT=='kode1'){
				if (lent<4) {alert('Input kode harus 4 digit!'); return false;}
				if (field.value.substring(2,1)!=".") {alert('Format kode error!'); return false;}
			}
			
			if (CrT=='kode3' && lent<2){
				alert('Input kode harus 2 digit!'); return false;
			}
			
			if (CekX(anys,'X')=='no'){alert('Input kode error'); return false;}
			
		}
		
		if (CrT=='desk'){
			txt = $("#fPRO1"+IdT).val();
			txt = txt+'.'+$("#fPRO2"+IdT).val();
			txt = txt+'.'+$("#fPRO3"+IdT).val();
			if (CekX(txt,'X')=='no'){alert('Kode program error!'); return false;}
		}
		
		var NiL  = ReplaceText(field.value);
		var fTHN = objfrm.fTHN.value;
		
		if (DeL!="") {alert('Access denied...!!'); return false;}
		$(document).ready(function()
		{
			$("#ViewDATA").load('Ref_ProgramSKPD_Data_Save.php?NiL='+NiL+'&gTHN='+fTHN+'&CrT='+CrT+'&IdT='+IdT+'&IdL='+IdL);
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