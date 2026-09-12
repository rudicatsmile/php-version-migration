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
#$Lev=3;
extract($_GET);
$gUNT = substr($SkP,0,11);
$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");

#$gSUB = substr($SkP,0,14);
#$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
$gTH = $tTbl;
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="Invent_Usulan_Frm_.php?IdT=".$IdT."&IdL=".$_GET['IdL']?>" enctype="multipart/form-data">
<!--input type="hidden" name="fSave" style="width:20px" /-->
<!--input type="hidden" name="fCrT" style="width:20px" /-->
<!--input type="hidden" name="fIdT" style="width:20px" /-->
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1200px">
  <tr>
    <td width="21">&nbsp;</td>
    <td width="68">&nbsp;</td>
    <td width="17">&nbsp;</td>
    <td width="73">&nbsp;</td>
    <td width="94">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="158">&nbsp;</td>
    <td width="38">&nbsp;</td>
    <td width="120">&nbsp;</td>
    <td width="62">&nbsp;</td>
  </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">PERIODE</td>
    <td align="center">&nbsp;</td>
    <td>
	<select class="boxs" name="fTHN" style="width: 63px" tabindex="0" onchange="changeDATA('<?=$IdL?>')">
      <?php
	for($i=2019; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select>
	<!--div id="kegiMstCri" class="findaset0Cri">
		<div id="kegiDiv1Cri" class="findaset1Cri"></div>
		<div id="kegiDiv2Cri" class="findaset2Cri"></div>
	</div-->	
	</td>
    <td>
	<select class="boxs" name="fAPB" id="fAPB" style="width:90px" tabindex="0" onchange="RefreshDATA('<?=$IdL?>')">
      <option value="0" <?php if ($uTbl=='0') {echo "selected";}?>>Murni</option>
      <option value="1" <?php if ($uTbl=='1') {echo "selected";}?>>Perubahan</option>
    </select></td>
    <td width="547">&nbsp;</td>
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
	<input name="fUNT" type="text" value="<?=$gUNT?>" <?php if ($Lev<=2) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" type="text" value="<?=$dUNT?>" <?php if ($Lev<=2) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:520px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="find0Cri" style="width:647px">
		<div id="unitDiv1Cri" class="find1Cri" style="width:647px"></div>
		<div id="unitDiv2Cri" class="find2Cri" style="width:647px"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">PROGRAM</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<input name="fPRG" type="text" value="<?=$gPRG?>" onClick="showPROG('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showPROG('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('prog'); return false;}" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dPRG" type="text" value="<?=$dPRG?>" onClick="showPROG('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showPROG('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('prog'); return false;}" style="padding-left:5px; text-transform:uppercase; width:520px; border: 1px solid #C0C0C0"/>
	<div id="progMstCri" class="find0Cri" style="width:647px">
		<div id="progDiv1Cri" class="find1Cri" style="width:647px"></div>
		<div id="progDiv2Cri" class="find2Cri" style="width:647px"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">KEGIATAN</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<input name="fKEG" type="text" value="<?=$gKEG?>" onClick="showKEGI('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showKEGI('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('kegi'); return false;}" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dKEG" type="text" value="<?=$dKEG?>" onClick="showKEGI('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showKEGI('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('kegi'); return false;}" style="padding-left:5px; text-transform:uppercase; width:520px; border: 1px solid #C0C0C0"/>
	<div id="kegiMstCri" class="find0Cri" style="width:647px">
		<div id="kegiDiv1Cri" class="find1Cri" style="width:647px"></div>
		<div id="kegiDiv2Cri" class="find2Cri" style="width:647px"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
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
	  <!--input type="button" name="B12" value="ADD KEGIATAN" onclick="showKEGI('','<?=$_GET['IdL']?>')" style="width: 120px; height: 21px" /-->
	  <input type="button" name="B12" disabled value="ADD KEGIATAN" onclick="addITEM('<?=$_GET['IdL']?>')" style="width: 120px; height: 21px" />
	  <input type="hidden" name="B13" value="CETAK" onclick="choiseTANGGAL('<?=$_GET['IdL']?>')" style="width: 120px; height: 21px; color:#0000FF" />
	</td>
    <td width="5">&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:1200px; height:20px; background: #CEFBE3; font-weight:bold">
  <tr>
    <td width="30" align="center">NO</td>
    <td width="140" align="center">KODE</td>
    <td align="left">SUB KEGIATAN</td>
    <td width="110" align="right">BELANJA</td>
    <td width="105" align="center">ACTION</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1200px; height:330px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:300px; overflow:auto"></div>
	<div id="ViewDATA" style="height:420px; width:100%; overflow:auto; border:0px"></div>
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
				$("#unitDiv2Cri").load('Ref_SubKegiatanSKPD_Find_Unit_Mid.php?gFnD='+gFnD+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('progMstCri').style.display = "none";
			document.getElementById('unitDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('Ref_SubKegiatanSKPD_Find_Unit_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('Ref_SubKegiatanSKPD_Find_Unit_Mid.php?IdL='+gIdL);
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
	
	function showPROG(CrT,gIdL)
	{
		var fUNT = objfrm.fUNT.value;
		var fTHN = objfrm.fTHN.value;
		var fAPB = objfrm.fAPB.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dPRG.value);
			$(document).ready(function()
			{
				$("#progDiv2Cri").load('Ref_SubKegiatanSKPD_Find_Prog_Mid.php?gFnD='+gFnD+'&gUNT='+fUNT+'&gTHN='+fTHN+'&gAPB='+fAPB+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('kegiMstCri').style.display = "none";
			document.getElementById('progDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#progDiv1Cri").load('Ref_SubKegiatanSKPD_Find_Prog_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#progDiv2Cri").load('Ref_SubKegiatanSKPD_Find_Prog_Mid.php?gUNT='+fUNT+'&gTHN='+fTHN+'&gAPB='+fAPB+'&IdL='+gIdL);
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
	
	function showKEGI(CrT,gIdL)
	{
		var fUNT = objfrm.fUNT.value;
		var fTHN = objfrm.fTHN.value;
		var fAPB = objfrm.fAPB.value;
		var fPRG = objfrm.fPRG.value;
		if (fPRG==''){alert('Silahkan pilih program..!!'); return false;}
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dKEG.value);
			$(document).ready(function()
			{
				$("#kegiDiv2Cri").load('Ref_SubKegiatanSKPD_Find_Kegi_Mid.php?gFnD='+gFnD+'&gUNT='+fUNT+'&gTHN='+fTHN+'&gAPB='+fAPB+'&gPRG='+fPRG+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('kegiDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#kegiDiv1Cri").load('Ref_SubKegiatanSKPD_Find_Kegi_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#kegiDiv2Cri").load('Ref_SubKegiatanSKPD_Find_Kegi_Mid.php?gUNT='+fUNT+'&gTHN='+fTHN+'&gAPB='+fAPB+'&gPRG='+fPRG+'&IdL='+gIdL);
			});
			
			if (document.getElementById('kegiMstCri').style.display == "block")
			{
				document.getElementById('kegiMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('kegiMstCri').style.display = "block";
			}
		}
	}
	
	function showCLICK(crt,kde,nma,IdL)
	{
		var fUNT = objfrm.fUNT.value;
		var fTHN = objfrm.fTHN.value;
		
		if (crt=='unit') 
		{
			objfrm.fUNT.value = kde;
			objfrm.dUNT.value = nma;
			
			objfrm.fPRG.value = '';
			objfrm.dPRG.value = '';
			
			objfrm.fKEG.value = '';
			objfrm.dKEG.value = '';
			
			RefreshDATA(IdL);
		}
		if (crt=='prog') 
		{
			objfrm.fPRG.value = kde;
			objfrm.dPRG.value = nma;
			
			objfrm.fKEG.value = '';
			objfrm.dKEG.value = '';
			
			RefreshDATA(IdL);
		}
		if (crt=='kegi') 
		{
			objfrm.fKEG.value = kde;
			objfrm.dKEG.value = nma;
			RefreshDATA(IdL);
		}
		if (crt=='kegi_x') 
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('Ref_SubKegiatanSKPD_Find_Kegi_Add.php?IdT='+kde+'&gUNT='+fUNT+'&gTHN='+fTHN+'&IdL='+IdL);
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
	
	function showKEGI_xxxxxxx(CrT,IdL)
	{
		var gPRG = objfrm.fPRG.value;
		var gTHN = objfrm.fTHN.value;
		if (gPRG==''){alert('Program belum dipilih..!!'); return false;}
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.fFindP.value);
			$(document).ready(function()
			{
				$("#kegiDiv2Cri").load('Ref_SubKegiatanSKPD_Find_Kegi_Mid.php?gFnD='+gFnD+'&gPRG='+gPRG+'&gTHN='+gTHN+'&IdL='+IdL);
			});
		}
		else
		{
			document.getElementById('kegiDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#kegiDiv1Cri").load('Ref_SubKegiatanSKPD_Find_Kegi_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#kegiDiv2Cri").load('Ref_SubKegiatanSKPD_Find_Kegi_Mid.php?gPRG='+gPRG+'&gTHN='+gTHN+'&IdL='+IdL);
			});
			
			if (document.getElementById('kegiMstCri').style.display == "block")
			{
				document.getElementById('kegiMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('kegiMstCri').style.display = "block";
			}
		}
	}
	
	function RefreshDATA(IdL)
	{
		var fUNT = objfrm.fUNT.value;
		var fTHN = objfrm.fTHN.value;
		var fAPB = objfrm.fAPB.value;
		var fPRG = objfrm.fPRG.value;
		var fKEG = objfrm.fKEG.value;
		$(document).ready(function()
		{
			$("#ViewDATA").load('Ref_SubKegiatanSKPD_Data.php?gUNT='+fUNT+'&gPRG='+fPRG+'&gKEG='+fKEG+'&gTHN='+fTHN+'&gAPB='+fAPB+'&IdL='+IdL);
		});
	}
	
	function P_Remove(IdT,DeL,IdL)
	{
		if (DeL!="") {alert('Access denied...!!'); return false;}
		var AN = confirm("Remove Kegiatan..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('Ref_SubKegiatanSKPD_Data_Del.php?IdT='+IdT+'&IdL='+IdL);
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
	
	function addITEM(IdL)
	{
		var fUNT = objfrm.fUNT.value;
		var fTHN = objfrm.fTHN.value;
		var fPRG = objfrm.fPRG.value;
		var dPRG = objfrm.dPRG.value;
		
		if (CekX(fPRG,'X')=='no'){alert('Kode program error, input kegiatan belum diperbolehkan!'); return false;}
		if (CekX(dPRG.toUpperCase(),'nama program...')=='no'){alert('Nama program error, input kegiatan belum diperbolehkan!'); return false;}
		
		$(document).ready(function()
		{
			$("#ViewDELL").load('Ref_SubKegiatanSKPD_Data_Add_Item.php?gUNT='+fUNT+'&gPRG='+fPRG+'&gTHN='+fTHN+'&IdL='+IdL);
		});
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
		if (CrT=='kode2'){
			lent = field.value.length;
			anys = field.value.toUpperCase();
			if (lent<3) {alert('Input kode harus 3 digit!'); return false;}
			if (CekX(anys,'X')=='no'){alert('Input kode error'); return false;}
			if (CekX(anys,'.')=='no'){alert('Format kode error'); return false;}
		}

		if (CrT=='desk'){
			txt = $("#fKEG1"+IdT).val();
			txt = txt+'.'+$("#fKEG2"+IdT).val();
			if (CekX(txt,'X')=='no'){alert('Kode kegiatan error!'); return false;}
		}
		
		var NiL = ReplaceText(field.value);
		var fTHN= objfrm.fTHN.value;
		
		if (DeL!="") {alert('Access denied...!!'); return false;}
		$(document).ready(function()
		{
			$("#ViewDATA").load('Ref_SubKegiatanSKPD_Data_Save.php?NiL='+NiL+'&gTHN='+fTHN+'&CrT='+CrT+'&IdT='+IdT+'&IdL='+IdL);
		});
	}
	
	function changeDATA(IdL)
	{
		objfrm.fPRG.value = "";
		objfrm.dPRG.value = "";
		
		objfrm.fKEG.value = '';
		objfrm.dKEG.value = '';
			
		RefreshDATA(IdL);
	}
	
</script>