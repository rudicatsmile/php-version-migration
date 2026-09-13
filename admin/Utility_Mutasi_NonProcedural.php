<?php
require('Connection.php');
require('Connection_CopyData.php');
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
<body onload="RefreshDT('<?=$IdL?>','0')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="">
<input type="hidden" name="fSave" style="width:20px" />
<input type="hidden" name="fPage" style="width:90px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1340px">
  <tr height="2">
    <td width="18"></td>
    <td width="75"></td>
    <td width="30"></td>
    <td width="540"></td>
    <td width="90"></td>
    <td width="31"></td>
    <td width="481"></td>
    <td></td>
  </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">DATA BASE</td>
    <td align="center">:</td>
    <td><input name="fDbA" type="text" value="<?=DatabaseSC?>" readonly="readonly" style="text-transform:uppercase; padding-left:5px; width:250px; border: 1px solid #C0C0C0"/>&nbsp;<=== <font style="font-size:11pt; font-weight:bold; color:#FF0000; text-shadow: 1px 1px #999999">SUMBER</font></td>
    <td align="right">DATA BASE </td>
    <td align="center">:</td>
    <td><input name="fDbB" type="text" value="<?=DatabaseSB?>" readonly="readonly" style="text-transform:uppercase; padding-left:5px; width:170px; border: 1px solid #C0C0C0"/>&nbsp;<=== <font style="font-size:11pt; font-weight:bold; color:#0000FF; text-shadow: 1px 1px #999999">TUJUAN</font></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">UNIT KERJA </td>
    <td align="center">:</td>
    <td>
	<input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" onClick="showUNIT('','<?=$_GET['IdL']?>')" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" type="text" value="<?=$dUNT?>" onClick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" style="padding-left:5px; width:332px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="find0Cri">
		<div id="unitDiv1Cri" class="find1Cri"></div>
		<div id="unitDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td align="right">UNIT KERJA</td>
    <td align="center">:</td>
    <td><input name="fUNT2" id="fUNT2" type="text" value="<?=$gUNT2?>" onclick="showUNIT2('','<?=$_GET['IdL']?>')" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
      <input name="dUNT2" type="text" value="<?=$dUNT2?>" onclick="showUNIT2('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT2('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" style="padding-left:5px; width:332px; border: 1px solid #C0C0C0"/>
	<div id="unit2MstCri" class="find0Cri">
		<div id="unit2Div1Cri" class="find1Cri"></div>
		<div id="unit2Div2Cri" class="find2Cri"></div>
	</div>	  </td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">SUB UNIT</td>
    <td align="center">:</td>
    <td>
	<input name="fSUB" id="fSUB" type="text" value="<?=$gSUB?>" onClick="showSUB('','<?=$_GET['IdL']?>')" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dSUB" type="text" value="<?=$dSUB?>" onClick="showSUB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showSUB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('sub'); return false;}" style="padding-left:5px; width:332px; border: 1px solid #C0C0C0"/>
	<div id="subMstCri" class="find0Cri">
		<div id="subDiv1Cri" class="find1Cri"></div>
		<div id="subDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td align="right">SUB UNIT</td>
    <td align="center">:</td>
    <td>
	<input name="fSUB2" id="fSUB2" type="text" value="<?=$gSUB2?>" onclick="showSUB2('','<?=$_GET['IdL']?>')" readonly="readonly" style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
    <input name="dSUB2" type="text" value="<?=$dSUB2?>" onclick="showSUB2('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showSUB2('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('sub'); return false;}" style="padding-left:5px; width:332px; border: 1px solid #C0C0C0"/>
	<div id="sub2MstCri" class="find0Cri">
		<div id="sub2Div1Cri" class="find1Cri"></div>
		<div id="sub2Div2Cri" class="find2Cri"></div>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">UPB</td>
    <td align="center">:</td>
    <td>
	<input name="fUPB" id="fUPB" type="text" value="<?=$gUPB?>" onClick="showUPB('','<?=$_GET['IdL']?>')" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUPB" type="text" value="<?=$dUPB?>" onClick="showUPB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showUPB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('upb'); return false;}" style="padding-left:5px; width:332px; border: 1px solid #C0C0C0"/>
	<div id="upbMstCri" class="find0Cri">
		<div id="upbDiv1Cri" class="find1Cri"></div>
		<div id="upbDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td align="right">UPB</td>
    <td align="center">:</td>
    <td>
	<input name="fUPB2" id="fUPB2" type="text" value="<?=$gUPB2?>" onclick="showUPB2('','<?=$_GET['IdL']?>')" readonly="readonly" style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
    <input name="dUPB2" type="text" value="<?=$dUPB2?>" onclick="showUPB2('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showUPB2('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('upb'); return false;}" style="padding-left:5px; width:332px; border: 1px solid #C0C0C0"/>
	<div id="upb2MstCri" class="find0Cri">
		<div id="upb2Div1Cri" class="find1Cri"></div>
		<div id="upb2Div2Cri" class="find2Cri"></div>
	</div>	</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
	<div id="imgMstCri" class="upload_a">
		<div id="imgDiv1Cri" class="upload_b"></div>
		<div id="imgDiv2Cri" class="upload_c"></div>
	</div>	  
	<div id="imgMstView" class="upload_a">
		<div id="imgDiv1View" class="upload_b"></div>
		<div id="imgDiv2View" class="upload_c"></div>
	</div>	  
	<div id="alasMstCri" class="upload_a">
		<div id="alasDiv1Cri" class="upload_b"></div>
		<div id="alasDiv2Cri" class="upload_c"></div>
	</div>
	<div id="loadingImg" style="width:40px;height:10px;display:none"><img src="Images/loading3.gif" alt="" width="40" height="40"></div>	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1340px; height:28px; background: #EBEDF2">
  <tr style="font-weight:bold; text-shadow: 1px 0px #999999">
    <td width="5">&nbsp;</td>
    <td width="50">DATA&nbsp;:</td>
    <td width="70"><label><input name="fKiBa" type="radio" value="a" onclick="RefreshDATAa('<?=$IdL?>','0')" checked />KIB-A</label></td>
    <td width="70"><label><input name="fKiBa" type="radio" value="b" onclick="RefreshDATAa('<?=$IdL?>','0')"/>KIB-B</label></td>
    <td width="70"><label><input name="fKiBa" type="radio" value="c" onclick="RefreshDATAa('<?=$IdL?>','0')"/>KIB-C</label></td>
    <td width="70"><label><input name="fKiBa" type="radio" value="d" onclick="RefreshDATAa('<?=$IdL?>','0')"/>KIB-D</label></td>
    <td width="70"><label><input name="fKiBa" type="radio" value="e" onclick="RefreshDATAa('<?=$IdL?>','0')"/>KIB-E</label></td>
    <td width="275">
	<input name="fCriA" id="fCriA" type="text" value="" onkeypress="if (event.keyCode==13){RefreshDATAa('<?=$IdL?>','0'); return false;}" style="padding-left:5px; width:143px; height:15px; border: 1px solid #C0C0C0"/>
	<input name="fBtnA" type="button" value="GO" onclick="RefreshDATAa('<?=$IdL?>','0')" style="padding-left:5px; width:40px; height:20px; border: 1px solid #C0C0C0; color:#FF0000"/>
	<input name="fBtAA" type="button" value="COPY" onclick="displayResult('<?=$IdL?>')" style="padding-left:5px; width:60px; height:20px; border: 1px solid #C0C0C0; color:#0000ff"/>
	
	</td>
    <td width="50">DATA&nbsp;:</td>
    <td width="70"><label><input name="fKiBb" type="radio" value="a" onclick="RefreshDATAb('<?=$IdL?>','0')" checked />KIB-A</label></td>
    <td width="70"><label><input name="fKiBb" type="radio" value="b" onclick="RefreshDATAb('<?=$IdL?>','0')"/>KIB-B</label></td>
    <td width="70"><label><input name="fKiBb" type="radio" value="c" onclick="RefreshDATAb('<?=$IdL?>','0')"/>KIB-C</label></td>
    <td width="70"><label><input name="fKiBb" type="radio" value="d" onclick="RefreshDATAb('<?=$IdL?>','0')"/>KIB-D</label></td>
    <td width="70"><label><input name="fKiBb" type="radio" value="e" onclick="RefreshDATAb('<?=$IdL?>','0')"/>KIB-E</label></td>
    <td>
	<input name="fCriB" id="fCriB" type="text" value="" onkeypress="if (event.keyCode==13){RefreshDATAb('<?=$IdL?>','0'); return false;}" style="padding-left:5px; width:130px; height:15px; border: 1px solid #C0C0C0"/>
	<input name="fBtnB" type="button" value="GO" onclick="RefreshDATAb('<?=$IdL?>','0')" style="padding-left:5px; width:40px; height:20px; border: 1px solid #C0C0C0; color:#0000FF"/>
	<input name="fBtAB" type="button" value="DELETE" onclick="displayCancel('<?=$IdL?>')" style="padding-left:5px; width:70px; height:20px; border: 1px solid #C0C0C0; color:#ff0000"/>
	</td>
  </tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:1340px; height:325px">
  <tr>
    <td valign="top">
	<table border="0" class="table-link" cellspacing="0" cellpadding="0" style="width:665px">
	  <tr>
		<td valign="top"><div id="ViewDATAa" style="height:322px; width:100%; overflow:auto; border:0px"></div></td>
	  </tr>
	</table>
	</td>
    <td valign="top" width="20">&nbsp;</td>
    <td valign="top" align="right">
	<table border="0" class="table-link" cellspacing="0" cellpadding="0" style="width:665px">
	  <tr>
		<td valign="top"><div id="ViewDATAb" style="height:322px; width:100%; overflow:auto; border:0px"></div></td>
	  </tr>
	</table>
	</td>
  </tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:1340px; height:30px">
  <tr>
    <td valign="top">
	<table border="0" class="table-link" cellspacing="0" cellpadding="0" style="width:665px">
	  <tr>
		<td valign="top"><div id="ViewDATAaX" style="height:60px; width:100%; overflow:auto; border:0px"></div></td>
	  </tr>
	</table>
	</td>
    <td valign="top" width="20">&nbsp;</td>
    <td valign="top" align="right">
	<table border="0" class="table-link" cellspacing="0" cellpadding="0" style="width:665px">
	  <tr>
		<td valign="top"><div id="ViewDATAbX" style="height:60px; width:100%; overflow:auto; border:0px"></div></td>
	  </tr>
	</table>
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
				$("#unitDiv2Cri").load('Utility_Mutasi_NonProcedural_Find_Unit_Mid.php?gFnD='+gFnD+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('subMstCri').style.display = "none";
			document.getElementById('upbMstCri').style.display = "none";
			
			document.getElementById('unitDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('Utility_Mutasi_NonProcedural_Find_Unit_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('Utility_Mutasi_NonProcedural_Find_Unit_Mid.php?IdL='+gIdL);
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
	
	function showUNIT2(CrT,gIdL)
	{
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dUNT2.value);
			$(document).ready(function()
			{
				$("#unit2Div2Cri").load('Utility_Mutasi_NonProcedural_Find_Unit_Mid.php?TJN=Ya&gFnD='+gFnD+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('sub2MstCri').style.display = "none";
			document.getElementById('upb2MstCri').style.display = "none";
			
			document.getElementById('unit2Div2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#unit2Div1Cri").load('Utility_Mutasi_NonProcedural_Find_Unit_Top.php?TJN=Ya&IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#unit2Div2Cri").load('Utility_Mutasi_NonProcedural_Find_Unit_Mid.php?TJN=Ya&IdL='+gIdL);
			});
			
			if (document.getElementById('unit2MstCri').style.display == "block")
			{
				document.getElementById('unit2MstCri').style.display = "none";
			}
			else
			{
				document.getElementById('unit2MstCri').style.display = "block";
			}
		}
	}

	function showSUB(CrT,gIdL)
	{
		var fUNT = objfrm.fUNT.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dSUB.value);
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('Utility_Mutasi_NonProcedural_Find_Sub_Mid.php?gFnD='+gFnD+'&gUNT='+fUNT+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('upbMstCri').style.display = "none";
			
			if (!fUNT) {alert('Silahkan pilih Unit Kerja terlebih dahulu..!!'); return false;}
			document.getElementById('subDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#subDiv1Cri").load('Utility_Mutasi_NonProcedural_Find_Sub_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('Utility_Mutasi_NonProcedural_Find_Sub_Mid.php?gUNT='+fUNT+'&IdL='+gIdL);
			});
			
			if (document.getElementById('subMstCri').style.display == "block")
			{
				document.getElementById('subMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('subMstCri').style.display = "block";
			}
		}
	}
	
	function showSUB2(CrT,gIdL)
	{
		var fUNT = objfrm.fUNT2.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dSUB2.value);
			
			$(document).ready(function()
			{
				$("#sub2Div2Cri").load('Utility_Mutasi_NonProcedural_Find_Mid.php?TJN=Ya&gFnD='+gFnD+'&gUNT='+fUNT+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('upb2MstCri').style.display = "none";
			
			if (!fUNT) {alert('Silahkan pilih Unit Kerja terlebih dahulu..!!'); return false;}
			document.getElementById('sub2Div2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#sub2Div1Cri").load('Utility_Mutasi_NonProcedural_Find_Sub_Top.php?TJN=Ya&IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#sub2Div2Cri").load('Utility_Mutasi_NonProcedural_Find_Sub_Mid.php?TJN=Ya&gUNT='+fUNT+'&IdL='+gIdL);
			});
			
			if (document.getElementById('sub2MstCri').style.display == "block")
			{
				document.getElementById('sub2MstCri').style.display = "none";
			}
			else
			{
				document.getElementById('sub2MstCri').style.display = "block";
			}
		}
	}
	
	function showUPB(CrT,gIdL)
	{
		var fSUB  = objfrm.fSUB.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dUPB.value);
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('Utility_Mutasi_NonProcedural_Find_Upb_Mid.php?gFnD='+gFnD+'&gSUB='+fSUB+'&IdL='+gIdL);
			});
		}
		else
		{
			if (!fSUB) {alert('Silahkan pilih Sub Unit terlebih dahulu..!!'); return false;}
			document.getElementById('upbDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('Utility_Mutasi_NonProcedural_Find_Upb_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('Utility_Mutasi_NonProcedural_Find_Upb_Mid.php?gSUB='+fSUB+'&IdL='+gIdL);
			});
			
			if (document.getElementById('upbMstCri').style.display == "block")
			{
				document.getElementById('upbMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('upbMstCri').style.display = "block";
			}
		}
	}
	
	function showUPB2(CrT,gIdL)
	{
		var fSUB  = objfrm.fSUB2.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dUPB2.value);
			
			$(document).ready(function()
			{
				$("#upb2Div2Cri").load('Utility_Mutasi_NonProcedural_Find_Upb_Mid.php?TJN=Ya&gFnD='+gFnD+'&gSUB='+fSUB+'&IdL='+gIdL);
			});
		}
		else
		{
			if (!fSUB) {alert('Silahkan pilih Sub Unit terlebih dahulu..!!'); return false;}
			document.getElementById('upb2Div2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#upb2Div1Cri").load('Utility_Mutasi_NonProcedural_Find_Upb_Top.php?TJN=Ya&IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#upb2Div2Cri").load('Utility_Mutasi_NonProcedural_Find_Upb_Mid.php?TJN=Ya&gSUB='+fSUB+'&IdL='+gIdL);
			});
			
			if (document.getElementById('upb2MstCri').style.display == "block")
			{
				document.getElementById('upb2MstCri').style.display = "none";
			}
			else
			{
				document.getElementById('upb2MstCri').style.display = "block";
			}
		}
	}
	
	function showCLICK(crt,kde,nma,IdL)
	{
		document.getElementById(crt+'MstCri').style.display = "none";
		if (crt=='unit')
		{
			objfrm.fUNT.value = kde;
			objfrm.dUNT.value = nma;
			
			objfrm.fSUB.value = '';
			objfrm.dSUB.value = '';
			
			objfrm.fUPB.value = '';
			objfrm.dUPB.value = '';
			RefreshDATAa(IdL,'0');
		}
		if (crt=='unit2') 
		{
			objfrm.fUNT2.value = kde;
			objfrm.dUNT2.value = nma;
			
			objfrm.fSUB2.value = '';
			objfrm.dSUB2.value = '';
			
			objfrm.fUPB2.value = '';
			objfrm.dUPB2.value = '';
			RefreshDATAb(IdL,'0');
		}
		
		if (crt=='sub') 
		{
			objfrm.fSUB.value = kde;
			objfrm.dSUB.value = nma;
			objfrm.fUPB.value = '';
			objfrm.dUPB.value = '';
			if (nma=='ALL') {objfrm.dUPB.value = 'ALL';}
			RefreshDATAa(IdL,'0');
		}
		if (crt=='sub2') 
		{
			objfrm.fSUB2.value = kde;
			objfrm.dSUB2.value = nma;
			
			objfrm.fUPB2.value = '';
			objfrm.dUPB2.value = '';
			if (nma=='ALL') {objfrm.dUPB2.value = 'ALL';}
			RefreshDATAb(IdL,'0');
		}
		
		if (crt=='upb') 
		{
			objfrm.fUPB.value = kde;
			objfrm.dUPB.value = nma;
			RefreshDATAa(IdL,'0');
		}
		if (crt=='upb2') 
		{
			objfrm.fUPB2.value = kde;
			objfrm.dUPB2.value = nma;
			RefreshDATAb(IdL,'0');
		}
		
	}
	
	function ReplaceText(gFnD)
	{
		for (i=1; i<=100; i++)
		{
			gFnD = gFnD.replace(' ','**');
		}
		return gFnD;
	}
	
	function closeCLICK(crt)
	{
		document.getElementById(crt+'MstCri').style.display = "none";
	}
	
	function displayResult(IdL)
	{
		var PgE  = objfrm.fPage.value;
		var gUNT = objfrm.fUNT.value;
		var nUNT = objfrm.fUNT2.value;
		var nSUB = objfrm.fSUB2.value;
		var nUPB = objfrm.fUPB2.value;
		
		if (gUNT==''){alert('Unit kerja belm dipilih..!!');return false;}
		//if (nUPB==''){alert('Kode UPB tujuan belm dipilih..!!');return false;}
		
	 	var mDana="";
		for (i = 0; i < objfrm.sDana.length; i++)
		{
			if (objfrm.sDana[i].checked)
			{
				mDana += objfrm.sDana[i].value+"-";
			}
		}
		
		gCrID = mDana;
		if (gCrID==''){alert('Data aset belum ada yang ditandai..!!');return false;}
		for (i = 0; i <= objfrm.fKiBa.length; i++)
		{
			if (objfrm.fKiBa[i].checked) {gTbL = objfrm.fKiBa[i].value; break; }
		}
		
		var AN = confirm("Copy data aset..?!!");
		if (!AN)
		{
			return false;
		}
		
		$(document).ready(function()
		{
			$("#loadingImg").show();
			$("#ViewDATAaX").load('Utility_Mutasi_NonProcedural_Execute.php?PgE='+PgE+'&gCrID='+gCrID+'&gTbL='+gTbL+'&nUPB='+nUPB+'&nSUB='+nSUB+'&nUNT='+nUNT+'&IdL='+IdL);
		});
	}
	
	function displayCancel(IdL)
	{
		var PgE  = objfrm.fPage.value;
		var nUNT = objfrm.fUNT2.value;
		if (nUNT==''){alert('Unit Kerja belum dipilih..!!');return false;}
		
	 	var mDana="";
		for (i = 0; i < objfrm.rDana.length; i++)
		{
			if (objfrm.rDana[i].checked)
			{
				mDana += objfrm.rDana[i].value+"-";
			}
		}
		gCrID = mDana;
		if (gCrID==''){alert('Data aset belum ada yang dipilih..!!');return false;}
		
		var Len = objfrm.fKiBb.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fKiBb[i].checked) {gTbL = objfrm.fKiBb[i].value; break; }
		}
		
		var AN = confirm("Remove data..?!!");
		if (!AN)
		{
			return false;
		}
		
		$(document).ready(function()
		{
			$("#loadingImg").show();
			$("#ViewDATAbX").load('Utility_Mutasi_NonProcedural_UnExecute.php?PgE='+PgE+'&gCrID='+gCrID+'&gTbL='+gTbL+'&IdL='+IdL);
		});
	}
		
	function RefreshDT(IdL,PgE)
	{
		RefreshDATAa(IdL,PgE);
		RefreshDATAb(IdL,PgE);
	}
	
	function RefreshDATAa(IdL,PgE)
	{
		objfrm.fPage.value=PgE;
		var Len = objfrm.fKiBa.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fKiBa[i].checked) {gTbL = objfrm.fKiBa[i].value; break; }
		}
		var gFnD = ReplaceText(objfrm.fCriA.value);
		var gUNT = document.getElementById('fUNT').value;
		var gSUB = document.getElementById('fSUB').value;
		var gUPB = document.getElementById('fUPB').value;
		
		var gUNI = document.getElementById('fUNT2').value;
		
		$(document).ready(function()
		{
			$("#ViewDATAa").load('Utility_Mutasi_NonProcedural_Data_A.php?PgE='+PgE+'&gFnD='+gFnD+'&gTbL='+gTbL+'&gUNT='+gUNT+'&gSUB='+gSUB+'&gUPB='+gUPB+'&gUNI='+gUNI+'&IdL='+IdL);
			$("#ViewDATAaX").load('Utility_Mutasi_NonProcedural_Data_A_Pages.php?PgE='+PgE+'&gTbL='+gTbL+'&gUNT='+gUNT+'&gSUB='+gSUB+'&gUPB='+gUPB+'&IdL='+IdL);
		});
		//RefreshDATAb(IdL,'0');
	}
	
	function RefreshDATAb(IdL,PgE)
	{
		objfrm.fPage.value=PgE;
		var Len = objfrm.fKiBb.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fKiBb[i].checked) {gTbL = objfrm.fKiBb[i].value; break; }
		}
		var gFnD = ReplaceText(objfrm.fCriB.value);
		var gUNT = document.getElementById('fUNT2').value;
		var gSUB = document.getElementById('fSUB2').value;
		var gUPB = document.getElementById('fUPB2').value;
		
		var gUNI = document.getElementById('fUNT').value;
		
		$(document).ready(function()
		{
			$("#ViewDATAb").load('Utility_Mutasi_NonProcedural_Data_B.php?PgE='+PgE+'&gFnD='+gFnD+'&gTbL='+gTbL+'&gUNT='+gUNT+'&gSUB='+gSUB+'&gUPB='+gUPB+'&gUNI='+gUNI+'&IdL='+IdL);
			$("#ViewDATAbX").load('Utility_Mutasi_NonProcedural_Data_B_Pages.php?PgE='+PgE+'&gTbL='+gTbL+'&gUNT='+gUNT+'&gSUB='+gSUB+'&gUPB='+gUPB+'&IdL='+IdL);
		});
		//RefreshDATAa(IdL,'0');
	}
	
	function CheckAlla()
	{
		for (i = 0; i < objfrm.sDana.length; i++)
		{
			if (objfrm.sDana[i].disabled==false)
			{
				
				if (objfrm.sDana[i].checked){
					objfrm.sDana[i].checked = false;
				}
				else{
					objfrm.sDana[i].checked = true;
				}
			}
		}
	}
	function CheckAllb()
	{
		for (i = 0; i < objfrm.rDana.length; i++)
		{
			if (objfrm.rDana[i].disabled==false)
			{
				if (objfrm.rDana[i].checked){
					objfrm.rDana[i].checked = false;
				}
				else{
				
					objfrm.rDana[i].checked = true;
				}
			}
		}
	}
	
	function vewtest(x)
	{
		alert(x);
	}
</script>