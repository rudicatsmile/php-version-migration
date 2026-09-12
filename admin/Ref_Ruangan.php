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
<form name="myfrm" method="POST" action="<?="Ref_Ruangan_.php?IdT=".$IdT."&IdL=".$_GET['IdL']?>" enctype="multipart/form-data">
<input type="hidden" name="fSave" style="width:20px" />
<input type="hidden" name="fCrT" style="width:20px" />
<input type="hidden" name="fIdT" style="width:20px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td width="18"></td>
    <td width="67"></td>
    <td width="27"></td>
    <td width="481"></td>
    <td width="80"></td>
    <td width="31"></td>
    <td width="459"></td>
    <td width="99"></td>
    <td width="29"></td>
  </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">UNIT KERJA </td>
    <td align="center">:</td>
    <td>
	<input name="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" type="text" value="<?=$dUNT?>" <?php if (!$IdT) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:332px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="find0Cri">
		<div id="unitDiv1Cri" class="find1Cri"></div>
		<div id="unitDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">SUB UNIT</td>
    <td align="center">:</td>
    <td>
	<input name="fSUB" type="text" value="<?=$gSUB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dSUB" type="text" value="<?=$dSUB?>" <?php if (!$IdT) {?> onClick="showSUB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showSUB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('sub'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:332px; border: 1px solid #C0C0C0"/>
	<div id="subMstCri" class="find0Cri">
		<div id="subDiv1Cri" class="find1Cri"></div>
		<div id="subDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">UPB</td>
    <td align="center">:</td>
    <td>
	<input name="fUPB" type="text" value="<?=$gUPB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUPB" type="text" value="<?=$dUPB?>" <?php if (!$IdT) {?> onClick="showUPB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showUPB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('upb'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:332px; border: 1px solid #C0C0C0"/>
	<div id="upbMstCri" class="find0Cri">
		<div id="upbDiv1Cri" class="find1Cri"></div>
		<div id="upbDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
    <td><input type="button" name="B3923" value="REFRESH" onclick="RefreshDATA('<?=$IdL?>')" style="width: 80px; height: 21px" />
	  <input type="button" name="B3922"  value="ADD ITEM" onclick="formEDIT('<?=$ReO?>','','<?=$IdL?>')" style="width: 80px; height: 21px" />
	  </td>
    <td width="5">&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #CEFBE3; font-weight:bold">
  <tr>
    <td width="30" align="center">NO</td>
    <td width="54" align="left">KODE</td>
    <td width="420" align="left">NAMA RUANGAN</td>
    <td width="65" align="left">NOMOR</td>
    <td width="217" align="left">PENAGGUNG JAWAB</td>
    <td width="218" align="left">NIP</td>
    <td width="205" align="left">PANGKAT</td>
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
	<div id="ViewDATA" style="height:370px; width:100%; overflow:auto; border:0px"></div>
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
				$("#unitDiv2Cri").load('Ref_Ruangan_Find_Unit_Mid.php?gFnD='+gFnD+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('subMstCri').style.display = "none";
			document.getElementById('upbMstCri').style.display = "none";
			
			document.getElementById('unitDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('Ref_Ruangan_Find_Unit_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('Ref_Ruangan_Find_Unit_Mid.php?IdL='+gIdL);
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

	function showSUB(CrT,gIdL)
	{
		var fUNT = objfrm.fUNT.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dSUB.value);
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('Ref_Ruangan_Find_Sub_Mid.php?gFnD='+gFnD+'&gUNT='+fUNT+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('upbMstCri').style.display = "none";
			
			if (!fUNT) {alert('Silahkan pilih Unit Kerja terlebih dahulu..!!'); return false;}
			document.getElementById('subDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#subDiv1Cri").load('Ref_Ruangan_Find_Sub_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('Ref_Ruangan_Find_Sub_Mid.php?gUNT='+fUNT+'&IdL='+gIdL);
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

	function showUPB(CrT,gIdL)
	{
		var fSUB  = objfrm.fSUB.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dUPB.value);
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('Ref_Ruangan_Find_Upb_Mid.php?gFnD='+gFnD+'&gSUB='+fSUB+'&IdL='+gIdL);
			});
		}
		else
		{
			if (!fSUB) {alert('Silahkan pilih Sub Unit terlebih dahulu..!!'); return false;}
			document.getElementById('upbDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('Ref_Ruangan_Find_Upb_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('Ref_Ruangan_Find_Upb_Mid.php?gSUB='+fSUB+'&IdL='+gIdL);
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
	
	function showCLICK(crt,kde,nma,IdL)
	{
		//Kondisi add item pilih aset
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
		}
		if (crt=='sub') 
		{
			objfrm.fSUB.value = kde;
			objfrm.dSUB.value = nma;
			
			objfrm.fUPB.value = '';
			objfrm.dUPB.value = '';
		}
		if (crt=='upb') 
		{
			objfrm.fUPB.value = kde;
			objfrm.dUPB.value = nma;
			RefreshDATA(IdL);
		}
		
		/*
		if (crt=='aset') 
		{
			$(document).ready(function()
			{
				$("#ViewDATA").load('Ref_Ruangan_Find_Aset_Add.php?IdT='+kde+'&rDTA='+nma+'&IdL='+IdL);
			});
		}
		*/
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
	
	function Save_XXXXXXXXXXXXXXX()
	{
		if (objfrm.fJNS.value=='') {alert('Silakan pilih jenis usulan...!!'); return false;}
		objfrm.fSave.value='Save';
		objfrm.submit();
	}
	
	function Reset_XXXXXXXXXXXXXXX()
	{
		objfrm.fSave.value='Reset';
		objfrm.submit();
	}
	
	function showASET_XXXXXXXXXXXXXXX(CrT,Jns,IdT,gIdL)
	{
		if (!IdT) {alert('Data belum tersimpan...!'); return false;}
		var gUPB = objfrm.fUPB.value;
		if (CrT=='find')
		{
			var gTBL = "";
			if (Jns=='PH'){
				gTBL = "g";
			}
			else
			{
				Len = objfrm.fKIB.length;
				for (i=0; i<=Len; i++)
				{
					if (objfrm.fKIB[i].checked) {gTBL = objfrm.fKIB[i].value; break; }
				}
			}
			var gFnD = ReplaceText(objfrm.fFindP.value);
			$(document).ready(function()
			{
				$("#asetDiv2Cri").load('Ref_Ruangan_Find_Aset_Mid.php?gTBL='+gTBL+'&gFnD='+gFnD+'&IdT='+IdT+'&gUPB='+gUPB+'&Jns='+Jns+'&IdL='+gIdL);
			});
		}
		else
		{
			if (Jns=='PH') {gTBL='g';} else {gTBL='a';}
			document.getElementById('asetDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#asetDiv1Cri").load('Ref_Ruangan_Find_Aset_Top.php?IdT='+IdT+'&Jns='+Jns+'&IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#asetDiv2Cri").load('Ref_Ruangan_Find_Aset_Mid.php?gTBL='+gTBL+'&IdT='+IdT+'&gUPB='+gUPB+'&Jns='+Jns+'&IdL='+gIdL);
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
	
	function RefreshDATA(IdL)
	{
		var gUPB = objfrm.fUPB.value;
		$(document).ready(function()
		{
			$("#ViewDATA").load('Ref_Ruangan_Data.php?gUPB='+gUPB+'&IdL='+IdL);
		});
	}
	
	function P_Remove_XXXXXXXXXXXXXXX(rIdT,DeL,IdL)
	{
		if (DeL) {alert('Data usulan sudah diproses, aksi remove data ditolak...!!'); return false;}
		var AN = confirm("Remove item dari usulan..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('Ref_Ruangan_Del.php?rIdT='+rIdT+'&IdL='+IdL);
			});
		}
	}
	
	function showDATA_XXXXXXXXXXXXXXX(CrT,IdT,gIdL)
	{
		var gUPB = objfrm.fUPB.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.fFindA.value);
			$(document).ready(function()
			{
				$("#asetDiv2Cri").load('Ref_Ruangan_Data_Mid.php?gFnD='+gFnD+'&gUPB='+gUPB+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('asetDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#asetDiv1Cri").load('Ref_Ruangan_Data_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#asetDiv2Cri").load('Ref_Ruangan_Data_Mid.php?gUPB='+gUPB+'&IdL='+gIdL);
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
	
	function showLINK_XXXXXXXXXXXXXXX(IdT,IdL)
	{
		URL='Invent_Usulan_Frm.php?IdT='+IdT+'&IdL='+IdL;
		window.open(URL,'MidFrame','');
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
	
	function addIMG_XXXXXXXXXXXXXXX(CrT,gIdT,gIdL)
	{
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('Ref_Ruangan_Data_Edit_Upl_Mid_Bro.php?gIdT='+gIdT+'&CrT='+CrT+'&IdL='+gIdL);
		});
	}
	
	function showREF_XXXXXXXXXXXXXXX(CrT,gIdT,gIdL)
	{
		var gRF = objfrm.fREF.value;
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('Ref_Ruangan_Data_Edit_Mid.php?gIdT='+gIdT+'&gRF='+gRF+'&CrT='+CrT+'&IdL='+gIdL);
		});
	}
	
	function showEDIT(CrT,gIdT,gIdL)
	{
		var gRF = objfrm.fREF.value;
		var gJN = objfrm.fJNS.value;
		
		document.getElementById('imgDiv1Cri').style.display = "block";
		document.getElementById('imgDiv2Cri').style.display = "block";
		$(document).ready(function()
		{
			$("#imgDiv1Cri").load('Ref_Ruangan_Data_Edit_Top.php?gJN='+gJN+'&CrT='+CrT+'&IdL='+gIdL);
		});
		
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('Ref_Ruangan_Data_Edit_Mid.php?gIdT='+gIdT+'&gRF='+gRF+'&CrT='+CrT+'&IdL='+gIdL);
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
	
	function P_Upload_XXXXXXXXXXXXXXX(CrT,gIdT)
	{
		if (objfrm.imgfile.value=="")
		{
			alert('Silahkan pilih file terlebih dahulu..!!');
			return false;
		}
		var spl = objfrm.imgfile.value.split('.');
		var Ext = spl[1].toLowerCase();
		
		if (CrT=='Pdf') {
			if (Ext!='pdf') {alert('File yang anda pilih bukan file pdf....!!'); return false;}
		}
		
		if (CrT=='Img') {
			if (Ext!='jpg' && Ext!='jpeg' && Ext!='png' && Ext!='bmp' && Ext!='gif') {alert('File yang di perbolehkan hanya (ext: jpg, jpeg, png, bmp, gif)....!!'); return false;}
		}
		
		objfrm.fCrT.value=CrT;
		objfrm.fIdT.value=gIdT;
		
		objfrm.fSave.value='Upload';
		objfrm.submit();
	}
	
	function remoIMG_XXXXXXXXXXXXXXX(CrT,gIdT,rIdT,gIdL)
	{
		var AN = confirm("Remove file..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('Ref_Ruangan_Data_Edit_Upl_Rem.php?CrT='+CrT+'&gIdT='+gIdT+'&rIdT='+rIdT+'&IdL='+gIdL);
			});
		}
	}
	
	function viewIMG_XXXXXXXXXXXXXXX(rIdT,w,h,gIdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='Ref_Ruangan_Data_Edit_Upl_Top_Vie.php?rIdT='+rIdT+'&IdL='+gIdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open(URL,'',settings);
	}
	
	function closeIMG_XXXXXXXXXXXXXXX(crt)
	{
		document.getElementById('imgMst'+crt).style.display = "none";
	}
	
	function choiseFIND_XXXXXXXXXXXXXXX(Frm,CrT,gid,kde,nma,IdL)
	{
		$(document).ready(function()
		{
			$("#ViewDELL").load('Ref_Ruangan_Data_Edit_Mid_Find_Add.php?gFrm='+Frm+'&gID='+gid+'&gKD='+kde+'&IdL='+IdL);
		});
		
		document.getElementById(CrT+'MstCri').style.display = "none";
	}
	
	function findEDIT_XXXXXXXXXXXXXXX(rMsT,Frm,CrT,gID,gIdL)
	{
		var vMsT = "";
		if (rMsT)
		{
			vMsT  = document.getElementById(rMsT).value;
			if (Frm=='rekn'){
				vMKiB = document.getElementById('fKIBb').value;
				if (vMKiB=='') {alert('KIB tujuan belum dipilih..!!'); return false;}
			}
		}
		
		
		var gJN = objfrm.fJNS.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.fFindDTA.value);
			$(document).ready(function()
			{
				$("#alasDiv2Cri").load('Ref_Ruangan_Data_Edit_Mid_Find_Mid.php?rMsT='+rMsT+'&vMsT='+vMsT+'&gFnD='+gFnD+'&gFrm='+Frm+'&gID='+gID+'&gJN='+gJN+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('alasDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#alasDiv1Cri").load('Ref_Ruangan_Data_Edit_Mid_Find_Top.php?rMsT='+rMsT+'&vMsT='+vMsT+'&gFrm='+Frm+'&gID='+gID+'&IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#alasDiv2Cri").load('Ref_Ruangan_Data_Edit_Mid_Find_Mid.php?rMsT='+rMsT+'&vMsT='+vMsT+'&gFrm='+Frm+'&gID='+gID+'&gJN='+gJN+'&IdL='+gIdL);
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
	}
	
	function formEDIT(ReO,gID,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		var gUpB = objfrm.fUPB.value;
		document.getElementById('alasDiv2Cri').style.display = "block";
		$(document).ready(function()
		{
			$("#alasDiv1Cri").load('Ref_Ruangan_Top.php?gID='+gID+'&IdL='+IdL);
		});
		
		$(document).ready(function()
		{
			$("#alasDiv2Cri").load('Ref_Ruangan_Mid.php?gID='+gID+'&gUpB='+gUpB+'&IdL='+IdL);
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
	
	function saveEDIT(ReO,gID,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		var gUpB = objfrm.fUPB.value;
		var gNmR = ReplaceText(objfrm.fNmR.value);
		var gNoR = ReplaceText(objfrm.fNoR.value);
		var gNmP = ReplaceText(objfrm.fNmP.value);
		var gNiP = ReplaceText(objfrm.fNiP.value);
		var gJaB = ReplaceText(objfrm.fJaB.value);
		$(document).ready(function()
		{
			$("#alasDiv2Cri").load('Ref_Ruangan_Save.php?gID='+gID+'&gUpB='+gUpB+'&gNmR='+gNmR+'&gNoR='+gNoR+'&gNmP='+gNmP+'&gNiP='+gNiP+'&gJaB='+gJaB+'&IdL='+IdL);
		});
	}
	
	function resetEDIT(ReO,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		var gUpB = objfrm.fUPB.value;
		$(document).ready(function()
		{
			$("#alasDiv2Cri").load('Ref_Ruangan_Mid.php?gUpB='+gUpB+'&IdL='+IdL);
		});
	}
	
	function refresEDIT(gID,IdL)
	{
		var gUpB = objfrm.fUPB.value;
		$(document).ready(function()
		{
			$("#alasDiv2Cri").load('Ref_Ruangan_Mid.php?gID='+gID+'&gUpB='+gUpB+'&IdL='+IdL);
		});
		RefreshDATA(IdL);
	}
	
	function formDELE(ReO,gID,DeL,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (DeL) {alert('Access denied, data sudah digunakan...!!'); return false;}
		var AN = confirm("Delete ruangan..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$("#alasDiv2Cri").load('Ref_Ruangan_Del.php?gID='+gID+'&IdL='+IdL);
			});
		}
	}
	
</script>