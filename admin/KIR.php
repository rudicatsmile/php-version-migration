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
$gUNT = substr($SkP,0,11);
$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
$gSUB = substr($SkP,0,14);
$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
$gUPB = substr($SkP,0,18);
$dUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="KIR_.php?IdT=".$IdT."&IdL=".$_GET['IdL']?>" enctype="multipart/form-data">
<input type="hidden" name="fSave" style="width:20px" />
<input type="hidden" name="fCrT" style="width:20px" />
<input type="hidden" name="fIdT" style="width:20px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td width="18">&nbsp;</td>
    <td width="67">&nbsp;</td>
    <td width="27">&nbsp;</td>
    <td width="481">&nbsp;</td>
    <td width="80">&nbsp;</td>
    <td width="31">&nbsp;</td>
    <td width="459">&nbsp;</td>
    <td width="99">&nbsp;</td>
    <td width="29">&nbsp;</td>
  </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">UNIT KERJA </td>
    <td align="center">:</td>
    <td>
	<input name="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" type="text" value="<?=$dUNT?>" onClick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" style="padding-left:5px; width:332px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="find0Cri">
		<div id="unitDiv1Cri" class="find1Cri"></div>
		<div id="unitDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">SUB UNIT</td>
    <td align="center">:</td>
    <td>
	<input name="fSUB" type="text" value="<?=$gSUB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dSUB" type="text" value="<?=$dSUB?>" onClick="showSUB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showSUB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('sub'); return false;}"  style="padding-left:5px; width:332px; border: 1px solid #C0C0C0"/>
	<div id="subMstCri" class="find0Cri">
		<div id="subDiv1Cri" class="find1Cri"></div>
		<div id="subDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td align="right">RUANGAN</td>
    <td align="center">:</td>
    <td>
	<?php
	#$gRUA='006';
	?>
	<input name="fRUA" id="fRUA" type="text" value="<?=$gRUA?>" onclick="showRUA('','<?=$_GET['IdL']?>')" readonly="readonly" style="padding-left:5px; width:40px; border: 1px solid #C0C0C0"/>
    <input name="dRUA" type="text" value="<?=$dRUA?>" onclick="showRUA('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showRUA('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('rua'); return false;}" style="padding-left:5px; width:250px; border: 1px solid #C0C0C0"/>
	<div id="ruaMstCri" class="find0Cri">
		<div id="ruaDiv1Cri" class="find1Cri"></div>
		<div id="ruaDiv2Cri" class="find2Cri"></div>
	</div>
	</td>
    <td>&nbsp;</td>
	
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">UPB</td>
    <td align="center">:</td>
    <td>
	<input name="fUPB" id="fUPB" type="text" value="<?=$gUPB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
    <input name="dUPB" type="text" value="<?=$dUPB?>" onclick="showUPB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showUPB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('upb'); return false;}" style="padding-left:5px; width:332px; border: 1px solid #C0C0C0"/>
	<div id="upbMstCri" class="find0Cri">
		<div id="upbDiv1Cri" class="find1Cri"></div>
		<div id="upbDiv2Cri" class="find2Cri"></div>
	</div>	  </td>
    <td align="right">ASET</td>
    <td align="center">:</td>
    <td>
	<label><input name="fRadio" id="fRadio" type="radio" value="B" onchange="RefreshDATA('<?=$IdL?>')" checked />PERALATAN & MESIN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
	<label><input name="fRadio" id="fRadio" type="radio" value="E" onchange="RefreshDATA('<?=$IdL?>')" />ASET LAINNYA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
	<label><input name="fRadio" id="fRadio" type="radio" value="X" onchange="RefreshDATA('<?=$IdL?>')" />ALL</label>
	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
	<div id="asetMstCri" class="findaset0Cri">
		<div id="asetDiv1Cri" class="findaset1Cri"></div>
		<div id="asetDiv2Cri" class="findaset2Cri"></div>
	</div>	
	</td>
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
	</div>	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:30px; background: #EAE6E6">
  <tr>
    <td width="5">&nbsp;</td>
    <td><input type="button" name="B391" value="REFRESH" onclick="RefreshDATA('<?=$IdL?>')" style="width: 80px; height: 21px" />
      <input type="button" name="B392"  value="ADD ITEM" onclick="showASET('','<?=$_GET['IdL']?>')" style="width: 80px; height: 21px" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="button" name="B393"  value="DOKUMEN KIR" onclick="P_KIR('650','350','<?=$_GET['IdL']?>')" style="width: 120px; height: 21px" />	</td>
    <td width="5">&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #CEFBE3; font-weight:bold">
  <tr align="center" >
    <td width="35" style="border-right:1px #999 solid">NO</td>
    <td width="110" style="border-right:1px #999 solid">KODE</td>
    <td width="56" style="border-right:1px #999 solid">REGISTER</td>
    <td width="45" style="border-right:1px #999 solid">LABEL</td>
    <td width="280" style="border-right:1px #999 solid">NAMA ASET</td>
    <td width="190" style="border-right:1px #999 solid">MERK</td>
    <td width="190" style="border-right:1px #999 solid">TYPE</td>
    <td width="80" style="border-right:1px #999 solid">PEROLEHAN</td>
    <td width="90" style="border-right:1px #999 solid">ASAL-USUL</td>
    <td width="60" style="border-right:1px #999 solid">KONDISI</td>
    <td width="110" style="border-right:1px #999 solid">HARGA</td>
    <td align="center">ACTION</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:300px">
  <tr>
    <td valign="top">
	<div id="alasMstCri" class="upload_a">
		<div id="alasDiv1Cri" class="upload_b"></div>
		<div id="alasDiv2Cri" class="upload_c"></div>
	</div>
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	<div id="ViewDATA" style="height:365px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
</form>
</body>
</html>
<script languange="javascript">
	var objfrm=document.myfrm;
	
	function showUNIT(CrT,IdL)
	{
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dUNT.value);
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('KIR_Find_Unit_Mid.php?gFnD='+gFnD+'&IdL='+IdL);
			});
		}
		else
		{
			document.getElementById('subMstCri').style.display = "none";
			document.getElementById('upbMstCri').style.display = "none";
			document.getElementById('ruaMstCri').style.display = "none";
			
			document.getElementById('unitDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('KIR_Find_Unit_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('KIR_Find_Unit_Mid.php?IdL='+IdL);
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

	function showSUB(CrT,IdL)
	{
		var fUNT = objfrm.fUNT.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dSUB.value);
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('KIR_Find_Sub_Mid.php?gFnD='+gFnD+'&gUNT='+fUNT+'&IdL='+IdL);
			});
		}
		else
		{
			document.getElementById('upbMstCri').style.display = "none";
			document.getElementById('ruaMstCri').style.display = "none";
			
			if (!fUNT) {alert('Silahkan pilih Unit Kerja terlebih dahulu..!!'); return false;}
			document.getElementById('subDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#subDiv1Cri").load('KIR_Find_Sub_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('KIR_Find_Sub_Mid.php?gUNT='+fUNT+'&IdL='+IdL);
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

	function showUPB(CrT,IdL)
	{
		var fSUB  = objfrm.fSUB.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dUPB.value);
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('KIR_Find_Upb_Mid.php?gFnD='+gFnD+'&gSUB='+fSUB+'&IdL='+IdL);
			});
		}
		else
		{
			document.getElementById('ruaMstCri').style.display = "none";
			if (!fSUB) {alert('Silahkan pilih Sub Unit terlebih dahulu..!!'); return false;}
			document.getElementById('upbDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('KIR_Find_Upb_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('KIR_Find_Upb_Mid.php?gSUB='+fSUB+'&IdL='+IdL);
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
	
	function showRUA(CrT,IdL)
	{
		var fUPB  = objfrm.fUPB.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dRUA.value);
			
			$(document).ready(function()
			{
				$("#ruaDiv2Cri").load('KIR_Find_Rua_Mid.php?gFnD='+gFnD+'&gUPB='+fUPB+'&IdL='+IdL);
			});
		}
		else
		{
			document.getElementById('unitMstCri').style.display = "none";
			document.getElementById('subMstCri').style.display = "none";
			document.getElementById('upbMstCri').style.display = "none";
			
			if (!fUPB) {alert('Silahkan pilih UPB terlebih dahulu..!!'); return false;}
			document.getElementById('ruaDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#ruaDiv1Cri").load('KIR_Find_Rua_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#ruaDiv2Cri").load('KIR_Find_Rua_Mid.php?gUPB='+fUPB+'&IdL='+IdL);
			});
			
			if (document.getElementById('ruaMstCri').style.display == "block")
			{
				document.getElementById('ruaMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('ruaMstCri').style.display = "block";
			}
		}
	}
	
	function showASET(CrT,IdL)
	{
		var fUPB = objfrm.fUPB.value;
		var fRUA = objfrm.fRUA.value;
		
		var gAST= "B";
		Len = objfrm.fRadio.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fRadio[i].checked) {gAST = objfrm.fRadio[i].value; break; }
		}
		
		if (gAST=='X'){
			alert('Pilihan Aset ALL access denied..'); return false;
		}
		
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.fFindP.value);
			
			$(document).ready(function()
			{
				$("#asetDiv2Cri").load('KIR_Find_Aset_Mid.php?gFnD='+gFnD+'&gUPB='+fUPB+'&gRUA='+fRUA+'&gAST='+gAST+'&IdL='+IdL);
			});
		}
		else
		{
			if (!fUPB) {alert('Silahkan pilih UPB terlebih dahulu..!!'); return false;}
			if (!fRUA) {alert('Silahkan pilih Ruang terlebih dahulu..!!'); return false;}
			document.getElementById('asetDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#asetDiv1Cri").load('KIR_Find_Aset_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#asetDiv2Cri").load('KIR_Find_Aset_Mid.php?gUPB='+fUPB+'&gRUA='+fRUA+'&gAST='+gAST+'&IdL='+IdL);
			});
			
			if (document.getElementById('asetMstCri').style.display == "block")
			{
				document.getElementById('asetMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('asetMstCri').style.display = "block";
			}
		}
	}
		
	function showCLICK(crt,kde,nma,IdL)
	{
		if (crt=='edit') {alert('Data aset ini sudah masuk diusulan yang sedang diolah..!!'); return false;}
		if (crt=='none') {alert('Data aset ini sudah dalam proses usulan yang lain...!!'); return false;}
		
		if (crt=='unit') 
		{
			objfrm.fUNT.value = kde;
			objfrm.dUNT.value = nma;
			
			objfrm.fSUB.value = '';
			objfrm.dSUB.value = '';
			
			objfrm.fUPB.value = '';
			objfrm.dUPB.value = '';
			
			objfrm.fRUA.value = '';
			objfrm.dRUA.value = '';
		}
		if (crt=='sub') 
		{
			objfrm.fSUB.value = kde;
			objfrm.dSUB.value = nma;
			
			objfrm.fUPB.value = '';
			objfrm.dUPB.value = '';
			
			objfrm.fRUA.value = '';
			objfrm.dRUA.value = '';
		}
		if (crt=='upb') 
		{
			objfrm.fUPB.value = kde;
			objfrm.dUPB.value = nma;
			
			objfrm.fRUA.value = '';
			objfrm.dRUA.value = '';
		}
		if (crt=='rua') 
		{
			objfrm.fRUA.value = kde;
			objfrm.dRUA.value = nma;
			RefreshDATA(IdL);
		}
		
		
		if (crt=='aset') 
		{
			var gRUA = objfrm.fRUA.value;
			$(document).ready(function()
			{
				$("#ViewDATA").load('KIR_Find_Aset_Add.php?rDTA='+kde+'&gRUA='+gRUA+'&IdL='+IdL);
			});
		}
		
		document.getElementById(crt+'MstCri').style.display = "none";
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
	
	function RefreshDATA(IdL)
	{
		var gAST= "B";
		Len = objfrm.fRadio.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fRadio[i].checked) {gAST = objfrm.fRadio[i].value; break; }
		}
		
		var gUPB = objfrm.fUPB.value;
		var gRUA = objfrm.fRUA.value;
		$(document).ready(function()
		{
			$("#ViewDATA").load('KIR_Data.php?gUPB='+gUPB+'&gRUA='+gRUA+'&gAST='+gAST+'&IdL='+IdL);
		});
	}

	function P_Delete(IdT)
	{
		if (!IdT) {alert('Error command..!!'); return false;}
		var AN = confirm("Hapus transaski usulan ini ..?!!");
		if (AN)
		{
			objfrm.fSave.value='Dell';
			objfrm.submit();
		}
	}

	function showEDIT(CrT,gIdT,IdL)
	{
		var gRF = objfrm.fREF.value;
		var gJN = objfrm.fJNS.value;
		
		document.getElementById('imgDiv1Cri').style.display = "block";
		document.getElementById('imgDiv2Cri').style.display = "block";
		$(document).ready(function()
		{
			$("#imgDiv1Cri").load('KIR_Data_Edit_Top.php?gJN='+gJN+'&CrT='+CrT+'&IdL='+IdL);
		});
		
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('KIR_Data_Edit_Mid.php?gIdT='+gIdT+'&gRF='+gRF+'&CrT='+CrT+'&IdL='+IdL);
		});
		
		if (document.getElementById('imgMstCri').style.display == "block")
		{
			document.getElementById('imgMstCri').style.display = "none";
		}
		else
		{
			document.getElementById('imgMstCri').style.display = "block";
		}
	}

	
	function formEDIT(gID,IdL)
	{
		var gUpB = objfrm.fUPB.value;
		document.getElementById('alasDiv2Cri').style.display = "block";
		$(document).ready(function()
		{
			$("#alasDiv1Cri").load('KIR_Top.php?gID='+gID+'&IdL='+IdL);
		});
		
		$(document).ready(function()
		{
			$("#alasDiv2Cri").load('KIR_Mid.php?gID='+gID+'&gUpB='+gUpB+'&IdL='+IdL);
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
	
	function closeEDIT()
	{
		var gUpB = objfrm.fUPB.value;
		document.getElementById('alasMstCri').style.display = "none";
		RefreshDATA(IdL);
	}
	
	function saveEDIT(gID,IdL)
	{
		var gUpB = objfrm.fUPB.value;
		var gNmR = ReplaceText(objfrm.fNmR.value);
		var gNoR = ReplaceText(objfrm.fNoR.value);
		var gNmP = ReplaceText(objfrm.fNmP.value);
		var gNiP = ReplaceText(objfrm.fNiP.value);
		var gJaB = ReplaceText(objfrm.fJaB.value);
		$(document).ready(function()
		{
			$("#alasDiv2Cri").load('KIR_Save.php?gID='+gID+'&gUpB='+gUpB+'&gNmR='+gNmR+'&gNoR='+gNoR+'&gNmP='+gNmP+'&gNiP='+gNiP+'&gJaB='+gJaB+'&IdL='+IdL);
		});
	}
	
	function resetEDIT(IdL)
	{
		var gUpB = objfrm.fUPB.value;
		$(document).ready(function()
		{
			$("#alasDiv2Cri").load('KIR_Mid.php?gUpB='+gUpB+'&IdL='+IdL);
		});
	}
	
	function refresEDIT(gID,IdL)
	{
		var gUpB = objfrm.fUPB.value;
		$(document).ready(function()
		{
			$("#alasDiv2Cri").load('KIR_Mid.php?gID='+gID+'&gUpB='+gUpB+'&IdL='+IdL);
		});
		RefreshDATA(IdL);
	}
	
	function formDELE(gID,IdL)
	{
		var AN = confirm("Remove data..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('KIR_Remove.php?rDTA='+gID+'&IdL='+IdL);
			});
		}
	}
	
	function P_KIR(w,h,IdL)
	{
		var gAST= "B";
		Len = objfrm.fRadio.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fRadio[i].checked) {gAST = objfrm.fRadio[i].value; break; }
		}
	
		$(document).ready(function()
		{
			fUpb = $("#fUPB").val();
			fRua = $("#fRUA").val();
		});
		if (fRua=="") {alert('error choise..!!'); return false;}
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open('KIB_'+gAST+'_Dokumen_KIR.php?gUpb='+fUpb+'&gRua='+fRua+'&IdL='+IdL,'',settings);
	}
	
	function printLABEL(w,h,IDT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open('KIR_Data_Label_New.php?IDT='+IDT+'&IdL='+IdL,'',settings);
	}

	
	function printQR(w,h,kode_kib,IDT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		// alert(mKode)
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		//window.open('Cetak_Bar_Code2.php?file=simandor/temp/qrwithlogo'+mKode+'.png','',settings);
		// window.open('Cetak_Bar_Code2.php?IDT='+IDT+'&IdL='+IdL,'',settings);
		window.open('Cetak_Bar_Code2.php?IDT='+IDT+'&kode_kib='+kode_kib+'&IdL='+IdL,'',settings);

	}
	
</script>