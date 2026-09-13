<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");


$gBid = "01";
$dBid = fGlobal("nm_aset","ref_rek_aset1","kd_aset",$gBid,"=","","");

$gKel = "01.01";
$dKel = fGlobal("nm_aset","ref_rek_aset2","kd_aset",$gKel,"=","","");

$gJen = "01.01.01";
$dJen = fGlobal("nm_aset","ref_rek_aset3","kd_aset",$gJen,"=","","");
extract($_GET);
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
<body onload="LoadPage('ViewDATA','ref_kode_aset_maping_108_data','IdL=<?=$_GET['IdL']?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="">
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td width="15">&nbsp;</td>
    <td width="94">&nbsp;</td>
    <td width="24">&nbsp;</td>
    <td></td>
    <td>
	<div id="mappDivShow0" class="find0Map">
		<div id="mappDivShow1" class="find1Map"></div>
		<div id="mappDivShow2" class="find2Map"></div>
	</div>
	</td>
    <td width="113">&nbsp;</td>
    <td width="28">&nbsp;</td>
    <td width="403">&nbsp;</td>
    <td width="85">&nbsp;</td>
    <td width="33">&nbsp;</td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">BIDANG</td>
    <td align="center">:</td>
    <td colspan="2">
	<input name="fBid" id="fBid" type="text" value="<?=$gBid?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
	<input name="dBid" id="dBid" type="text" value="<?=$dBid?>" readonly onClick="closePopup('keloDivShow0'); closePopup('jeniDivShow0'); showGlobalPopupBID('view','bidaDivShow','ref_kode_aset_maping_108_find_mid','ref_kode_aset_maping_108_find_top','','Lev=bida&IdL=<?=$_GET['IdL']?>')" style="padding-left:5px; width:375px; border: 1px solid #C0C0C0; text-transform:uppercase"/>
	<div id="bidaDivShow0" class="find0Cri">
		<div id="bidaDivShow1" class="find1Cri"></div>
		<div id="bidaDivShow2" class="find2Cri"></div>
	</div>	</td>
    <td><a href="#" onclick="P_Document('800','400','center','BDG','<?=$_GET['IdL']?>');return false" class="ico docu">&nbsp;DOKUMEN CETAK</a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">KELOMPOK</td>
    <td align="center">:</td>
    <td colspan="2">
	<input name="fKel" id="fKel" type="text" value="<?=$gKel?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
	<input name="dKel" id="dKel" type="text" value="<?=$dKel?>" readonly onClick="closePopup('jeniDivShow0'); showGlobalPopupKEL('view','keloDivShow','ref_kode_aset_maping_108_find_mid','ref_kode_aset_maping_108_find_top','','Lev=kelo&IdL=<?=$_GET['IdL']?>')" style="padding-left:5px; width:375px; border: 1px solid #C0C0C0; text-transform:uppercase"/>
	<div id="keloDivShow0" class="find0Cri">
		<div id="keloDivShow1" class="find1Cri"></div>
		<div id="keloDivShow2" class="find2Cri"></div>
	</div>	</td>
    <td><a href="#" onclick="P_Document('800','400','center','KEL','<?=$_GET['IdL']?>');return false" class="ico docu">&nbsp;DOKUMEN CETAK</a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">JENIS</td>
    <td align="center">:</td>
    <td colspan="2">
	<input name="fJen" id="fJen" type="text" value="<?=$gJen?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
	<input name="dJen" id="dJen" type="text" value="<?=$dJen?>" readonly onClick="showGlobalPopupJEN('view','jeniDivShow','ref_kode_aset_maping_108_find_mid','ref_kode_aset_maping_108_find_top','','Lev=jeni&IdL=<?=$_GET['IdL']?>')" style="padding-left:5px; width:332px; border: 1px solid #C0C0C0; text-transform:uppercase"/>
	<div id="jeniDivShow0" class="find0Cri">
		<div id="jeniDivShow1" class="find1Cri"></div>
		<div id="jeniDivShow2" class="find2Cri"></div>
	</div>
	<input type="button" name="B1" value="GO" style="width:40px; height:22px" onclick="LoadPage('ViewDATA','ref_kode_aset_maping_108_data','IdL=<?=$_GET['IdL']?>')" /></td>
    <td><a href="#" onclick="P_Document('800','400','center','JNS','<?=$_GET['IdL']?>');return false" class="ico docu">&nbsp;DOKUMEN CETAK</a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="449">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #CEFBE3; font-weight:bold">
  <tr>
    <td colspan="2" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc">REKENING 17</td>
    <td colspan="2" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc">REKENING 108 </td>
    <td rowspan="2" align="center">ACTION</td>
  </tr>
  <tr>
    <td width="117" align="center" style="border-right:1px solid #ccc">KODE</td>
    <td width="452" align="center" style="border-right:1px solid #ccc">DESKRIPSI</td>
    <td width="134" align="center" style="border-right:1px solid #ccc">KODE</td>
    <td width="452" align="center" style="border-right:1px solid #ccc">DESKRIPSI</td>
    </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:100%; overflow:auto; border:0px"></div>
	<div id="ViewDATA" style="height:380px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
</form>
</body>
</html>
<script languange="javascript">
function LoadPage(eDiv,FileMid,eGet)
{
	Bid = $("#fBid").val();
	Kel = $("#fKel").val();
	Jen = $("#fJen").val();
	if (Bid==''){alert('Pilih Bidang terlebih dahulu...!'); return false;}
	if (Kel==''){alert('Pilih kelompok terlebih dahulu...!'); return false;}
	$(document).ready(function()
	{
		$("#"+eDiv).load(FileMid+'.php?Bid='+Bid+'&Kel='+Kel+'&Jen='+Jen+'&'+eGet);
	});
}

function showGlobalPopup(CrT,nmDiv,fileMid,fileTop,topText,eGet) 
{
	if (CrT=='find'){
		eKD="";
		if (topText=='fndRkn')
		{
			eKD = $("#LisFilter").val()
		}
		
		TxFnD = "";
		if (topText!=''){
			TxFnD = eReplaceText($("#"+topText).val());
		}
		
		$(document).ready(function() 
		{
			$("#"+nmDiv+"2").load(fileMid+'.php?eKD='+eKD+'&TxFnD='+TxFnD+'&nmDiv='+nmDiv+'&fileMid='+fileMid+'&fileTop='+fileTop+'&'+eGet);
		});
	}
	else if (CrT=='reset' || CrT=='refr' || CrT=='edit'){
		$(document).ready(function() 
		{
			$("#"+nmDiv+"1").load(fileTop+'.php?nmDiv='+nmDiv+'&fileMid='+fileMid+'&fileTop='+fileTop+'&'+eGet);
			$("#"+nmDiv+"2").load(fileMid+'.php?nmDiv='+nmDiv+'&fileMid='+fileMid+'&fileTop='+fileTop+'&'+eGet);
		});
	}
	else if (CrT=='add')
	{
		displayBLOCK(nmDiv+'2');
		$(document).ready(function() 
		{
			$("#"+nmDiv+"1").load(fileTop+'.php?nmDiv='+nmDiv+'&fileMid='+fileMid+'&fileTop='+fileTop+'&'+eGet);
			$("#"+nmDiv+"2").load(fileMid+'.php?nmDiv='+nmDiv+'&fileMid='+fileMid+'&fileTop='+fileTop+'&'+et);
		});
		displayBlockOrNo(nmDiv+'0');
	}
	else if (CrT=='view')
	{
		displayBLOCK(nmDiv+'2');
		$(document).ready(function() 
		{
			$("#"+nmDiv+"1").load(fileTop+'.php?nmDiv='+nmDiv+'&fileMid='+fileMid+'&fileTop='+fileTop+'&'+eGet);
			$("#"+nmDiv+"2").load(fileMid+'.php?nmDiv='+nmDiv+'&fileMid='+fileMid+'&fileTop='+fileTop+'&'+eGet);
		});
		displayBlockOrNo(nmDiv+'0');
	}
	else if (CrT=='back'){
		$(document).ready(function() 
		{
			$("#"+nmDiv+"1").load(fileTop+'.php?nmDiv='+nmDiv+'&fileMid='+fileMid+'&fileTop='+fileTop+'&'+eGet);
			$("#"+nmDiv+"2").load(fileMid+'.php?nmDiv='+nmDiv+'&fileMid='+fileMid+'&fileTop='+fileTop+'&'+eGet);
		});
	}
}

function closePopup(xY) 
{
	document.getElementById(xY).style.display = "none"; 
} 

function displayBLOCK(xY)
{
	document.getElementById(xY).style.display = "block"; 
}
 
function displayBlockOrNo(xY)
{
	if (document.getElementById(xY).style.display == "block") 
	{
		document.getElementById(xY).style.display = "none"; 
	}
	else
	{
		document.getElementById(xY).style.display = "block";
	}
}

function eReplaceText(Txt)
{
	for (iGx=0; iGx<=100; iGx++)
	{
		Txt = Txt.replace(' ','**');
	}
	return Txt;
}

function showGlobalPopupBID(CrT,nmDiv,fileMid,fileTop,topText,eGet) 
{
	showGlobalPopup(CrT,nmDiv,fileMid,fileTop,topText,eGet);
}

function showGlobalPopupKEL(CrT,nmDiv,fileMid,fileTop,topText,eGet) 
{
	Bid = $("#fBid").val();
	eGet = 'Bid='+Bid+'&'+eGet;
	showGlobalPopup(CrT,nmDiv,fileMid,fileTop,topText,eGet);
}

function showGlobalPopupJEN(CrT,nmDiv,fileMid,fileTop,topText,eGet) 
{
	Bid = $("#fBid").val();
	Kel = $("#fKel").val();
	if (Kel==''){alert('Pilih kelompok terlebih dahulu...!'); return false;}
	
	eGet = 'Bid='+Bid+'&Kel='+Kel+'&'+eGet;
	showGlobalPopup(CrT,nmDiv,fileMid,fileTop,topText,eGet);
}

function showGlobalPopupClick(kde,nma,Lev,nmDiv,IdL)
{
	if (Lev=='bida'){
		$("#fBid").val(kde);
		$("#dBid").val(nma);
		
		$("#fKel").val('');
		$("#dKel").val('');
		
		$("#fJen").val('');
		$("#dJen").val('');
	}
	else if (Lev=='kelo'){
		$("#fKel").val(kde);
		$("#dKel").val(nma);
		
		$("#fJen").val('');
		$("#dJen").val('');
	}
	else if (Lev=='jeni'){
		$("#fJen").val(kde);
		$("#dJen").val(nma);
		LoadPage('ViewDATA','ref_kode_aset_maping_108_data','IdL='+IdL);
	}
	closePopup(nmDiv+'0');
}

//////////***************/////////////
function showGlobalPopupKELO(CrT,nmDiv,fileMid,fileTop,topText,eGet) 
{
	BidE = $("#fMapBidE").val();
	eGet = 'BidE='+BidE+'&'+eGet;
	showGlobalPopup(CrT,nmDiv,fileMid,fileTop,topText,eGet);
}

function showGlobalPopupJENI(CrT,nmDiv,fileMid,fileTop,topText,eGet) 
{
	KelE = $("#fMapKelE").val();
	eGet = 'KelE='+KelE+'&'+eGet;
	showGlobalPopup(CrT,nmDiv,fileMid,fileTop,topText,eGet);
}

function showGlobalPopupOBJE(CrT,nmDiv,fileMid,fileTop,topText,eGet) 
{
	JenE = $("#fMapJenE").val();
	if (JenE==''){alert('Level jenis belum dipilih');return false;}
	eGet = 'JenE='+JenE+'&'+eGet;
	showGlobalPopup(CrT,nmDiv,fileMid,fileTop,topText,eGet);
}

function showGlobalPopupRINC(CrT,nmDiv,fileMid,fileTop,topText,eGet) 
{
	ObjE = $("#fMapObjE").val();
	if (ObjE==''){alert('Level objek belum dipilih');return false;}
	eGet = 'ObjE='+ObjE+'&'+eGet;
	showGlobalPopup(CrT,nmDiv,fileMid,fileTop,topText,eGet);
}

function showGlobalPopupSUB1(CrT,nmDiv,fileMid,fileTop,topText,eGet) 
{
	RinE = $("#fMapRinE").val();
	if (RinE==''){alert('Level rincian objek belum dipilih');return false;}
	eGet = 'RinE='+RinE+'&'+eGet;
	showGlobalPopup(CrT,nmDiv,fileMid,fileTop,topText,eGet);
}

function showGlobalPopupSUB2(CrT,nmDiv,fileMid,fileTop,topText,eGet) 
{
	Su1E = $("#fMapSu1E").val();
	if (Su1E==''){alert('Level sub rincian objek belum dipilih');return false;}
	eGet = 'Su1E='+Su1E+'&'+eGet;
	showGlobalPopup(CrT,nmDiv,fileMid,fileTop,topText,eGet);
}


function showGlobalPopupClickMapi(kde,nma,Lev,nmDiv,IdL)
{
	if (Lev=='kelo'){
		$("#fMapKelE").val(kde);
		$("#dMapKelE").val(nma);
		
		$("#fMapJenE").val('');
		$("#dMapJenE").val('');
		
		$("#fMapObjE").val('');
		$("#dMapObjE").val('');
		
		$("#fMapRinE").val('');
		$("#dMapRinE").val('');
		
		$("#fMapSu1E").val('');
		$("#dMapSu1E").val('');
		
		$("#fMapSu2E").val('');
		$("#dMapSu2E").val('');
	}
	else if (Lev=='jeni'){
		$("#fMapJenE").val(kde);
		$("#dMapJenE").val(nma);
		
		$("#fMapObjE").val('');
		$("#dMapObjE").val('');
		
		$("#fMapRinE").val('');
		$("#dMapRinE").val('');
		
		$("#fMapSu1E").val('');
		$("#dMapSu1E").val('');
		
		$("#fMapSu2E").val('');
		$("#dMapSu2E").val('');
	}
	else if (Lev=='obje'){
		$("#fMapObjE").val(kde);
		$("#dMapObjE").val(nma);
		
		$("#fMapRinE").val('');
		$("#dMapRinE").val('');
		
		$("#fMapSu1E").val('');
		$("#dMapSu1E").val('');
		
		$("#fMapSu2E").val('');
		$("#dMapSu2E").val('');
	}
	else if (Lev=='rinc'){
		$("#fMapRinE").val(kde);
		$("#dMapRinE").val(nma);
		
		$("#fMapSu1E").val('');
		$("#dMapSu1E").val('');
		
		$("#fMapSu2E").val('');
		$("#dMapSu2E").val('');
	}
	else if (Lev=='sub1'){
		$("#fMapSu1E").val(kde);
		$("#dMapSu1E").val(nma);
		
		$("#fMapSu2E").val('');
		$("#dMapSu2E").val('');
	}
	else if (Lev=='sub2'){
		$("#fMapSu2E").val(kde);
		$("#dMapSu2E").val(nma);
	}
	
	closePopup(nmDiv+'0');
}

function SaveMapi(nmDiv,fileSave,eGet)
{
	MapSu2E = $("#fMapSu2E").val();
	if (MapSu2E==''){alert('Sub sub rincian objek error...!!'); return false;}
	$(document).ready(function() 
	{
		$("#"+nmDiv).load(fileSave+'.php?MapSu2E='+MapSu2E+'&'+eGet);
	});
}

function ClearMapi(nmDiv,fileClear,eGet)
{
	//alert(eGet); return false;
	AN = confirm('Clear data mapping rekening ini..??');
	if (AN){
		$(document).ready(function() 
		{
			$("#"+nmDiv).load(fileClear+'.php?'+eGet);
		});
	}
}

function showGlobalPopupClickSearch(A1,A2,A3,A4,A5,A6,A7,A8,A9,A10,A11,A12,nmDiv,IdL)
{
	$("#dMapKelE").val(A12);
	$("#fMapKelE").val(A11);
	
	$("#dMapJenE").val(A10);
	$("#fMapJenE").val(A9);
	
	$("#dMapObjE").val(A8);
	$("#fMapObjE").val(A7);
	
	$("#dMapRinE").val(A6);
	$("#fMapRinE").val(A5);
	
	$("#dMapSu1E").val(A4);
	$("#fMapSu1E").val(A3);
	
	$("#dMapSu2E").val(A2);
	$("#fMapSu2E").val(A1);
	
	closePopup(nmDiv+'0');

}

	function P_Document(w,h,pos,CrT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		if (CrT=='BDG'){
			gKD = $("#fBid").val();
		}
		else if (CrT=='KEL'){
			gKD = $("#fKel").val();
		}
		else{
			gKD = $("#fJen").val();
		}
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL = "ref_kode_aset_maping_108_doc.php?CrT="+CrT+"&gKD="+gKD+"&IdL="+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}

</script>