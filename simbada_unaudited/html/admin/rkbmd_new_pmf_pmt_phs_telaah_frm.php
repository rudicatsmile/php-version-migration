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
<script type="text/javascript" src="FileFormatNum.js"></script>
</head>
<?
extract($_GET);
echo $Frm;
$gREF= "RKB.".(fGetDate('year')+1).".XXXXXXXX";
$gUNT = substr($SkP,0,11);
$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
$gURA = "";

$gTHN = fGetDate('year');
if ($IdT)
{
	$nSQL= "SELECT referensi, kd_unit, tahun, uraian, nomor FROM ta_rkbmd_new_pmf_pmt_phs WHERE idt='$IdT'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	$gREF = $mRo[0];
	$gUNT = substr($mRo[1],0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	
	$gTHN = $mRo[2];
	$gURA = $mRo[3];
	
	$stLOCK = "";//fGlobalNEW("pengadaanBMD","ta_unit_lock","kdUnit:tahunBMD:periodeBMD",$gUNT.":".$gTHN.":".$gUBH,"=:=:=","",DatabaseSB,$ConSB,"");
}

?>
<body onload="RefreshDATA('<?=$stLOCK?>','<?=$Frm?>','<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="" enctype="multipart/form-data">
<input type="hidden" name="fSave" style="width:20px" />
<input type="hidden" name="fCrT" style="width:20px" />
<input type="hidden" name="fIdT" style="width:20px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; background:#339999; color:#FFFFFF">
  <tr>
    <td width="13">&nbsp;</td>
    <td width="90">&nbsp;</td>
    <td width="22">&nbsp;</td>
    <td width="71">&nbsp;</td>
    <td width="101">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="19">&nbsp;</td>
    <td width="198">&nbsp;</td>
    <td width="60">&nbsp;</td>
    <td width="626">&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">UNIT KERJA </td>
    <td align="center">:</td>
    <td colspan="5">
	<input name="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" type="text" value="<?=$dUNT?>" <? if (!$IdT) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" <? } else {echo "readonly";}?> style="padding-left:5px; width:378px; border: 1px solid #C0C0C0; text-transform:uppercase"/>
	<div id="unitMstCri" class="find0Cri">
		<div id="unitDiv1Cri" class="find1Cri"></div>
		<div id="unitDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td>URAIAN</td>
    <td rowspan="2">
	<textarea name="fURA" readonly style="border: 1px solid #C0C0C0; height:45px; width:500px"><?=$gURA?></textarea></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">PERIODE</td>
    <td align="center">:</td>
    <td colspan="2">
		<input name="fTHN" id="fTHN" type="text" value="<?=$gTHN?>" readonly style="text-align:center; width:73px; border: 1px solid #C0C0C0"/>
		<div id="progMstCri" class="findpkr0Cri">
			<div id="progDiv1Cri" class="findpkr1Cri"></div>
			<div id="progDiv2Cri" class="findpkr2Cri"></div>
		</div>
		
		<div id="kegiMstCri" class="findpkr0Cri">
			<div id="kegiDiv1Cri" class="findpkr1Cri"></div>
			<div id="kegiDiv2Cri" class="findpkr2Cri"></div>
		</div>
		
		<div id="subkMstCri" class="findpkr0Cri">
			<div id="subkDiv1Cri" class="findpkr1Cri"></div>
			<div id="subkDiv2Cri" class="findpkr2Cri"></div>
		</div>
		
		<div id="reknMstCri" class="findpkr0Cri">
			<div id="reknDiv1Cri" class="findpkr1Cri"></div>
			<div id="reknDiv2Cri" class="findpkr2Cri"></div>
		</div>
	  </td>
    <td width="91" align="right">REFERENSI</td>
    <td align="center">&nbsp;</td>
    <td><input name="fREF" type="text" value="<?=$gREF?>" readonly style=" width:130px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
    </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td></td>
    <td colspan="2"></td>
    <td align="center">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td><div id="loadingImg" style="width:40px; height:10px; display:none"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:30px; background: #EAE6E6">
  <tr>
    <td width="5">&nbsp;</td>
    <td><input type="hidden" name="B39" <?=$DisA?> value="SAVE" onclick="Save('<?=$stLOCK?>')" style="width: 80px; height: 21px" />
      <input type="hidden" name="B10" value="RESET" onclick="Reset()" style="width: 80px; height: 21px" />
      <input type="button" name="B11" value="REFRESH" onclick="RefreshDATA('<?=$stLOCK?>','<?=$Frm?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
	  <input type="hidden" name="B12" value="ADD PROGRAM" onclick="showPROG('<?=$stLOCK?>','','<?=$IdT?>','<?=$_GET['IdL']?>')" style="width: 130px; height: 21px; color:#0000FF" /><?=str_repeat("&nbsp;",3)?>
	  <input type="button" name="B13" value="DAFTAR USULAN" onclick="showDATANew('<?=$Frm?>','<?=$_GET['IdL']?>')" style="width: 130px; height: 21px" />
	  &nbsp;&nbsp;&nbsp;
	  <input type="button" name="B14" <? if ($IdT=="") {echo "disabled";}?> value="CETAK RINCI" onclick="P_Dokumen('800','400','<?=$IdT?>','<?=$_GET['IdL']?>')" style="width: 120px; height: 21px; color:#0000FF" />
	  <input type="hidden" name="B13" value="CETAK DAFTAR" onclick="choiseTANGGAL('<?=$_GET['IdL']?>')" style="width: 130px; height: 21px; color:#0000FF" />
	  <div style="float:right">
	  <input type="hidden" name="B16" <?=$DisB?> value="DELETE" onclick="P_Delete('<?=$IdT?>','<?=$CeK?>')" style="width: 80px; height: 21px; color:#<?=$ColB?>" />
	  </div>	  </td>
    <td width="5">&nbsp;</td>
  </tr>
</table>
<? if ($IdT) {?>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #CEFBE3; font-weight:bold">
  <tr>
    <td width="30" align="center">&nbsp;</td>
    <td width="100" align="center">&nbsp;</td>
    <td width="76" align="center"></td>
    <td width="76" align="center">&nbsp;</td>
    <td width="184" align="left">&nbsp;</td>
    <td width="57" align="center">&nbsp;</td>
    <td width="350" align="left">&nbsp;</td>
    <td width="79" align="right">&nbsp;</td>
    <td width="104" align="right">&nbsp;</td>
    <td width="55" align="center">&nbsp;</td>
    <td width="100" align="center">&nbsp;</td>
    <td width="80" align="center">&nbsp;</td>
  </tr>
</table>
<? } ?>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td valign="top">
	<div id="ViewDATA" style="height:380px; width:100%; overflow:auto; border:0px"></div>
	<div id="ViewDELL" style="height:30px; width:900px; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
</form>
</body>
</html>
<script languange="javascript">
	objfrm=document.myfrm;
	
	function RefreshDATA(stLOCK,Frm,IdL)
	{
		gREF = objfrm.fREF.value;
		gTHN = objfrm.fTHN.value;
		
		$(document).ready(function()
		{
			$.ajax({
				url:"rkbmd_new_pmf_pmt_phs_telaah_frm_data.php",
				data: {Frm:Frm,stLOCK:stLOCK,gREF:gREF,gTHN:gTHN,IdL:IdL},
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
	
	function Save(stLOCK)
	{
		if (stLOCK=='1'){alert('Access denied, data sudah terkunci..!!'); return false;}
		objfrm.fSave.value='Save';
		objfrm.submit();
	}
	
	function showDATANew(Frm,IdL)
	{
		gUNT = objfrm.fUNT.value;
		if (Frm=='PMF'){xD="PEMINDAHTANGANAN";}
		if (Frm=='PMT'){xD="PEMANFAATAN";}
		if (Frm=='PHS'){xD="PENGHAPUSAN";}
		window.open('rkbmd_new_pmf_pmt_phs_telaah.php?FrmG=DAFTAR USULAN '+xD+' (TELAAH)&Frm='+Frm+'&gUNT='+gUNT+'&IdL='+IdL,'_self');
	}
	
	function closeIMG(crt)
	{
		document.getElementById('imgMst'+crt).style.display = "none";
	}

	function P_Dokumen(w,h,IdT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='rkbmd_new_pmf_pmt_phs_telaah_dokumen.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function saveRECO(stLOCK,crt,fld,rIdT,IdL)
	{
		if (stLOCK=='1'){alert('Access denied, data sudah terkunci..!!'); return false;}
		fld = ReplaceText(fld.value);
		//alert(fld); return false;
		$(document).ready(function()
		{
			$("#ViewDELL").load('rkbmd_new_pmf_pmt_phs_telaah_frm_find_pkrk_save.php?stLOCK='+stLOCK+'&crt='+crt+'&fld='+fld+'&rIdT='+rIdT+'&IdL='+IdL);
		});
	}
	
</script>