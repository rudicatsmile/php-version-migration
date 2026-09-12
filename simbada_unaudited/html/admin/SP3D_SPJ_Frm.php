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
$gREF= "SP3.".fGetDate('year').".XXXXXXXX";
$gHR = fGetDate('mday');
$gBL = fGetDate('mon');
$gTH = fGetDate('year');
$gHRd  = "00";
$gBLd  = "00";
$gTHd  = "0000";
$gNO  = "";

if ($gUPB!='')
{
	$gUNT = substr($gUPB,0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	$gSUB = substr($gUPB,0,14);
	$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
	$gUPB = substr($gUPB,0,18);
	$dUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
}
else
{
	$gUNT = substr($SkP,0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	$gSUB = substr($SkP,0,14);
	$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
	$gUPB = substr($SkP,0,18);
	$dUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
}

$gURA = "";
$gNIL = 0;
$eSDH = 0;
$eBLM = 0;
$WaR  = "";
if ($IdT)
{
	$nSQL= "SELECT P1.Referensi as A0, P1.Kd_UPB as A1, P1.Nom_SP3D as A2, P1.Tgl_SP3D as A3, P3.Deskripsi As A4, P1.Uraian, P2.Deskripsi as A6, P1.Nilai as A7 
	FROM ta_sp3d P1 
	LEFT JOIN ref_sp3d_jenis P2 ON P2.Kode=P1.KdJenis 
	LEFT JOIN ref_session P3 ON P3.Kode=P1.KdSesi 
	WHERE P1.IDT='$IdT'";
	#echo $nSQL;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	$gREF = $mRo[0];
	$gUNT = substr($mRo[1],0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	$gSUB = substr($mRo[1],0,14);
	$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
	$gUPB = substr($mRo[1],0,18);
	$dUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
	$gNO  = $mRo[2];
	$gTG  = $mRo[3];
	$gSES = $mRo[4];
	$gURA = $mRo[5];
	$gJNS = $mRo[6];
	$gNIL = $mRo[7];
	$gNIL = fGlobal("IfNull(sum(Nilai),0)","ta_sp3d_rinci","Referensi:Kd_ReknP90",$gREF.":5%","=:LIKE","","");
	
	$eSDH = fGlobal("IfNull(sum(Total),0)","ta_sp3d_spj_rinci","Referensi_SP3B",$gREF,"=","","");
	$eBLM = $gNIL-$eSDH;
	
	if ($eBLM > 0){
		$WaR = "; color:#0000FF";
	}
	else if ($eBLM < 0){
		$WaR = "; color:#FF0000";
	}
}

?>
<body onload="RefreshDATA('<?=$IdL?>','0')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="SP3D_SPJ_Frm_.php?IdT=".$IdT."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>" enctype="multipart/form-data">
<input type="hidden" name="fSave" id="fSave" style="width:20px" />
<input type="hidden" name="fCrT" id="fCrT" style="width:20px" />
<input type="hidden" name="fIdT" id="fIdT" value="<?=$LoadfIdT?>" style="width:20px" />
<input type="hidden" name="UplIdT" id="UplIdT" style="width:20px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1300px">
  <tr>
    <td width="3">&nbsp;</td>
    <td width="85">&nbsp;</td>
    <td width="24">&nbsp;</td>
    <td width="471">
	<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:100%">
	<tr>
		<td width="70">&nbsp;</td>
		<td width="50">
		<div id="asetMstCri" class="findrekn0Cri">
			<div id="asetDiv1Cri" class="findrekn1Cri"></div>
			<div id="asetDiv2Cri" class="findrekn2Cri"></div>
		</div>
		<div id="spjMstCri" class="findspj0Cri">
			<div id="spjDiv1Cri" class="findspj1Cri"></div>
			<div id="spjDiv2Cri" class="findspj2Cri"></div>
		</div>	
		<div id="spjasetMstCri" class="findspjaset0Cri">
			<div id="spjasetDiv1Cri" class="findspjaset1Cri"></div>
			<div id="spjasetDiv2Cri" class="findspjaset2Cri"></div>
			<div id="spjasetDiv3Cri" class="findspjaset3Cri"></div>
		</div>
		</td>
		<td width="50">&nbsp;</td>
		<td width="50">
		<div id="imgMstCri" class="findimg0Cri">
			<div id="imgDiv1Cri" class="findimg1Cri"></div>
			<div id="imgDiv2Cri" class="findimg2Cri"></div>
		</div>	
		</td>
		<td width="50">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	</table>
	</td>
    <td width="79">&nbsp;</td>
    <td width="25">&nbsp;</td>
    <td width="182">&nbsp;</td>
    <td width="66">&nbsp;</td>
    <td width="28">&nbsp;</td>
    <td width="335">&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">Unit Kerja</td>
    <td align="center">:</td>
    <td>
	<input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0; background:#e9f5cc"/>
	<input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" <? if ($IdT=='' && $Lev<=1){?> onclick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" <? } else {echo "readonly";}?> style="padding-left:5px; width:320px; border: 1px solid #C0C0C0; background:#e9f5cc"/>
	<div id="unitMstCri" class="find0Cri">
		<div id="unitDiv1Cri" class="find1Cri"></div>
		<div id="unitDiv2Cri" class="find2Cri"></div>
	</div>
	<div id="tranMstCri" class="findsp3d0Cri">
		<div id="tranDiv1Cri" class="findsp3d1Cri"></div>
		<div id="tranDiv2Cri" class="findsp3d2Cri"></div>
	</div>	</td>
    <td class="ar">Referensi SP3B</td>
    <td class="ac">:</td>
    <td><input name="fREF" type="text" value="<?=$gREF?>" readonly style=" width:120px; border: 1px solid #C0C0C0; background:#99FF00"/>
      <input type="button" name="B132" value="..." onclick="showDATA('','<?=$IdT?>','<?=$_GET['IdL']?>')" style="width: 30px; height:21px" /></td>
    <td class="ar">Jenis SP3B </td>
    <td class="ac">:</td>
    <td><input name="fNO2" type="text" value="<?=$gJNS?>" readonly style=" width:152px; border: 1px solid #C0C0C0; background:#e9f5cc"/></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">Sub Unit</td>
    <td align="center">:</td>
    <td>
	<input name="fSUB" id="fSUB" type="text" value="<?=$gSUB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0; background:#e9f5cc"/>
	<input name="dSUB" id="dSUB" type="text" value="<?=$dSUB?>" <? if ($IdT=='' && $Lev<=2){?> onclick="showSUB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showSUB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('sub'); return false;}" <? } else {echo "readonly";}?> style="padding-left:5px; width:320px; border: 1px solid #C0C0C0; background:#e9f5cc"/>
	<div id="subMstCri" class="find0Cri">
		<div id="subDiv1Cri" class="find1Cri"></div>
		<div id="subDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td class="ar">Tanggal SP3B</td>
    <td class="ac">:</td>
    <td><input name="fNO4" type="text" value="<? if ($gTG){ echo fConvertDateShort($gTG);}?>" readonly style=" width:152px; border: 1px solid #C0C0C0; background:#e9f5cc"/></td>
    <td class="ar">Tahap</td>
    <td class="ac">:</td>
    <td><input name="fNO3" type="text" value="<?=$gSES?>" readonly style=" width:152px; border: 1px solid #C0C0C0; background:#e9f5cc"/></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">UPB</td>
    <td align="center">:</td>
    <td>
	<input name="fUPB" id="fUPB" type="text" value="<?=$gUPB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0; background:#e9f5cc"/>
	<input name="dUPB" id="dUPB" type="text" value="<?=$dUPB?>" <? if ($IdT=='' && $Lev<=3){?> onclick="showUPB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showUPB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('upb'); return false;}" <? } else {echo "readonly";}?> style="padding-left:5px; width:320px; border: 1px solid #C0C0C0; background:#e9f5cc"/>
	<input type="hidden" name="B13" value="..." <? if (!$IdT) {?> onclick="findUPB('','<?=$_GET['IdL']?>')" <? } ?> style="width: 27px; height:21px" />
	<div id="upbMstCri" class="find0Cri">
		<div id="upbDiv1Cri" class="find1Cri"></div>
		<div id="upbDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td class="ar">Nomor SP3B</td>
    <td class="ac">:</td>
    <td><input name="fNO" type="text" readonly value="<?=$gNO?>" style=" width:152px; border: 1px solid #C0C0C0; background:#e9f5cc"/></td>
    <td class="ar">Nilai SP3B </td>
    <td class="ac">:</td>
    <td><input name="fNO5" type="text" readonly value="<?=fConvertToRupiah($gNIL)?>" style="width:152px; border: 1px solid #C0C0C0; text-align:right; padding-right:3px; background:#e9f5cc"/></td>
  </tr>
  

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div id="subMstCri" class="find0Cri">
		<div id="subDiv1Cri" class="find1Cri"></div>
		<div id="subDiv2Cri" class="find2Cri"></div>
	</div>	  
	  <div id="upbMstCri" class="find0Cri">
		<div id="upbDiv1Cri" class="find1Cri"></div>
		<div id="upbDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1300px; height:30px; background: #EAE6E6">
  <tr>
    <td width="5">&nbsp;</td>
    <!--td width="250" style="font-size:13pt; font-weight:bold; text-shadow: #fff 1px 1px 1px;">DATA SPJ</td-->
    <td>
	<input type="button" name="B39" <?=$DisA?> value="RELOAD" onclick="Save()" style="width: 80px; height: 21px" />
	<input type="button" name="B10" value="RESET" onclick="Reset()" style="width: 80px; height: 21px" />
	<input type="button" name="B11" value="REFRESH" onclick="RefreshDATA('<?=$IdL?>','0')" style="width: 80px; height: 21px" />
	<!--input type="button" name="B13" value="DAFTAR KAPITALISASI" onclick="showListDATA('<?=$_GET['IdL']?>')" style="width: 130px; height: 21px" /-->
	<!--input type="button" name="B14" <? if ($IdT=="") {echo "disabled";}?> value="CETAK" onclick="P_Dokumen('800','400','<?=$IdT?>','<?=$_GET['IdL']?>')" style="width: 120px; height: 21px; color:#0000FF" /-->
	<input type="hidden" name="B13" value="CETAK DAFTAR" onclick="choiseTANGGAL('<?=$_GET['IdL']?>')" style="width: 130px; height: 21px; color:#0000FF" />
	<div style="float:right">
	<input type="hidden" name="B16" <?=$DisB?> value="DELETE" onclick="P_Delete('<?=$IdT?>','<?=$CeK?>')" style="width: 80px; height: 21px; color:#<?=$ColB?>" />
	</div>
	</td>
	<td width="5">&nbsp;</td>
  </tr>
</table>
<!--table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:1300px; height:20px; background: #CEFBE3; font-weight:bold">
  <tr>
    <td width="30" align="center">No</td>
    <td width="104" align="left" style="padding-left:4px">Referensi</td>
    <td width="80" align="left">Tanggal</td>
    <td width="186" align="left">Nomor</td>
    <td width="100" align="left">Kode Aset</td>
    <td width="288" align="left">Nama Aset</td>
    <td width="100" align="right">Nilai SPJ</td>
    <td width="100" align="right">Nilai ASET</td>
    <td align="center">Action</td>
  </tr>
</table-->
<table border="0" cellspacing="0" cellpadding="0" align="center" style=" height:376px; width:1300px; background:#FFCC66">
  <tr height="2">
    <td valign="top" style="border-right:0px solid #ccc"></td>
    <td></td>
    <td valign="top"></td>
  </tr>
  <tr>
    <td width="430" valign="top" style="border-right:0px solid #ccc">
		<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:430px; height:30px; background: #CEFBE3; font-weight:bold">
		<tr height="20" style="text-align:center">
			<td width="85" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc">Kode</td>
			<td width="293" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc">Rekening Belanja</td>
			<td style="border-right:0px solid #ccc; border-bottom:1px solid #ccc">Pilih</td>
		<tr>
		<td valign="top" colspan="3">
			<div id="ViewLEFT" style="height:350px; width:100%; overflow:auto; border:0px"></div>		</td>
		</tr>
		</table></td>
    <td width="2">&nbsp;</td>
    <td valign="top">
		<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:100%; height:30px; background: #fff; font-weight:bold">
		<tr height="20" style="text-align:center">
		  <td colspan="4" height="50" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:left; background:#cbf9a2">
		  <div id="ViewHEAD" style="height:50px; width:100%; overflow:none; border:0px"></div>
		  </td>
		</tr>
		<!--tr height="20" style="text-align:center">
			<td width="100" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc">Kode</td>
			<td width="353" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc">Rekening Aset</td>
			<td width="103" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc">N i l a i</td>
			<td style="border-right:0px solid #ccc; border-bottom:1px solid #ccc">Action</td>
		</tr-->
		<tr>
		<td valign="top" colspan="4">
			<div id="ViewDATA" style="height:319px; width:100%; overflow:auto; border:0px"></div>
			<div id="ViewDELL" style="height:0px; width:100%; overflow:auto; border:0px"></div>		</td>
		</tr>
	  </table>	</td>
  </tr>
</table>
<!--table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1200px">
  <tr>
    <td valign="top">
	<div id="ViewDATAaX" style="height:20px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table-->
<br />
<br />
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
				$("#unitDiv2Cri").load('SP3D_Frm_Find_Unit_Mid.php?gFnD='+gFnD+'&IdL='+gIdL);
			});
		}
		else
		{
			globalClose('subMstCri');
			globalClose('upbMstCri');
			globalClose('tranMstCri');
			
			dispBLOCK('unitDiv2Cri');
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('SP3D_Frm_Find_Unit_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('SP3D_Frm_Find_Unit_Mid.php?IdL='+gIdL);
			});
			
			dispBlockOrNo('unitMstCri');
		}
		$("#dUNT").select();
	}

	function showSUB(CrT,gIdL)
	{
		var fUNT = objfrm.fUNT.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dSUB.value);
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('SP3D_Frm_Find_Sub_Mid.php?gFnD='+gFnD+'&gUNT='+fUNT+'&IdL='+gIdL);
			});
		}
		else
		{
			globalClose('upbMstCri');
			globalClose('tranMstCri');
			
			if (!fUNT) {alert('Silahkan pilih Unit Kerja terlebih dahulu..!!'); return false;}
			dispBLOCK('subDiv2Cri');
			$(document).ready(function()
			{
				$("#subDiv1Cri").load('SP3D_Frm_Find_Sub_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('SP3D_Frm_Find_Sub_Mid.php?gUNT='+fUNT+'&IdL='+gIdL);
			});
			dispBlockOrNo('subMstCri');
		}
		$("#dSUB").select();
	}

	function showUPB(CrT,gIdL)
	{
		var fSUB  = objfrm.fSUB.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dUPB.value);
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('SP3D_Frm_Find_Upb_Mid.php?gFnD='+gFnD+'&gSUB='+fSUB+'&IdL='+gIdL);
			});
		}
		else
		{
			globalClose('tranMstCri');
			
			if (!fSUB) {alert('Silahkan pilih Sub Unit terlebih dahulu..!!'); return false;}
			dispBLOCK('upbDiv2Cri');
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('SP3D_Frm_Find_Upb_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('SP3D_Frm_Find_Upb_Mid.php?gSUB='+fSUB+'&IdL='+gIdL);
			});
			
			dispBlockOrNo('upbMstCri');
		}
		$("#dUPB").select();
	}
	
	function showDELE(rIdT,fIdT,rCek,IdL)
	{
		if (rCek!=''){alert('Access denied....!!'); return false;}
		AN = confirm('Hapus data...!!!');
		if (!AN){return false;}
		
		$(document).ready(function()
		{
			$("#ViewDELL").load('SP3D_SPJ_Frm_Find_ReknP108_Rem.php?rIdT='+rIdT+'&fIdT='+fIdT+'&IdL='+IdL);
			
		});
	}
	
	function showCLICK(crt,mesg,refs,kde,nma,IdL)
	{
		if (mesg=='mesga') {alert('..!!'); return false;}
		if (mesg=='mesgb') {alert('... : '+refs); return false;}
		
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
		}
		
		if (crt=='addrekn') 
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('SP3D_SPJ_Frm_Find_ReknP108_Add.php?fIdT='+kde+'&rKD='+nma+'&IdL='+IdL);
				
			});
		}
		globalClose(crt+'MstCri');
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
	
	function Save()
	{
		objfrm.fSave.value='Refresh';
		objfrm.submit();
	}
	
	function Reset()
	{
		objfrm.fSave.value='Reset';
		objfrm.submit();
	}
	
	function showReknP108(CrT,fIdT,IdL)
	{
		gLST = 100;
		gREK = "1.3";
		gUPB = objfrm.fUPB.value;
		if (CrT=='find')
		{
			gLST = $("#fTmpRec").val();
			
			Len = objfrm.fREK.length;
			for (i=0; i<=Len; i++)
			{
				if (objfrm.fREK[i].checked) {gREK = objfrm.fREK[i].value; break; }
			}
			
			gFnD = ReplaceText(objfrm.fFindP.value);
			$(document).ready(function()
			{
				$("#asetDiv2Cri").load('SP3D_SPJ_Frm_Find_ReknP108_Mid.php?gREK='+gREK+'&gFnD='+gFnD+'&gLST='+gLST+'&fIdT='+fIdT+'&gUPB='+gUPB+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('asetDiv2Cri');
			$(document).ready(function()
			{
				$("#asetDiv1Cri").load('SP3D_SPJ_Frm_Find_ReknP108_Top.php?fIdT='+fIdT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#asetDiv2Cri").load('SP3D_SPJ_Frm_Find_ReknP108_Mid.php?gREK='+gREK+'&gLST='+gLST+'&fIdT='+fIdT+'&gUPB='+gUPB+'&IdL='+IdL);
			});
			
			dispBlockOrNo('asetMstCri');
		}
	}
	
	function RefreshDATA(IdL,PgE)
	{
		gREF = objfrm.fREF.value;
		fIdT = $("#fIdT").val();
		$(document).ready(function()
		{
			$.ajax({
				url:"SP3D_SPJ_Frm_Data.php",
				data: {PgE:PgE,fIdT:fIdT,IdL:IdL},
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
			$("#ViewHEAD").load('SP3D_SPJ_Frm_Data_Head.php?PgE='+PgE+'&gREF='+gREF+'&fIdT='+fIdT+'&IdL='+IdL);
			$("#ViewLEFT").load('SP3D_SPJ_Frm_Data_Left.php?PgE='+PgE+'&gREF='+gREF+'&fIdT='+fIdT+'&IdL='+IdL);
		});
	}
	
	function PilihDATA(fIdT,PgE,IdL)
	{
		$("#fIdT").val(fIdT);
		$(document).ready(function()
		{
			$.ajax({
				url:"SP3D_SPJ_Frm_Data.php",
				data: {PgE:PgE,fIdT:fIdT,IdL:IdL},
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
			$("#ViewHEAD").load('SP3D_SPJ_Frm_Data_Head.php?fIdT='+fIdT+'&PgE='+PgE+'&IdL='+IdL);
		});
	}
	
	function showListDATA(IdL)
	{
		gUPB = objfrm.fUPB.value;
		window.open('SP3D_SPJ.php?FrmG=DANA BOS -> LIST DATA SPJ&gUPB='+gUPB+'&IdL='+IdL,'_self');
	}
	
	function showDATA(CrT,IdT,IdL)
	{
		gUPB = objfrm.fUPB.value;
		if (CrT=='find')
		{
			FnD = ReplaceText($("#fFindSP3").val());
			$(document).ready(function()
			{
				$("#tranDiv2Cri").load('SP3D_SPJ_Find_Sp3b_Mid.php?FnD='+FnD+'&gUPB='+gUPB+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('tranDiv2Cri');
			$(document).ready(function()
			{
				$("#tranDiv1Cri").load('SP3D_SPJ_Find_Sp3b_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#tranDiv2Cri").load('SP3D_SPJ_Find_Sp3b_Mid.php?gUPB='+gUPB+'&IdL='+IdL);
			});
			
			dispBlockOrNo('tranMstCri');
		}
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
		URL='SP3D_SPJ_Frm_Data_Dok.php?IdT='+IdT+'&IdL='+IdL;
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
		URL='SP3D_Frm_Data_Dok.php?gUNT='+gUNT+'&JeNS='+JeNS+'&HR1='+HR1+'&HR2='+HR2+'&HR3='+HR3+'&BL1='+BL1+'&BL2='+BL2+'&BL3='+BL3+'&TH1='+TH1+'&TH2='+TH2+'&TH3='+TH3+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
		//closeCLICK('choise');
	}
	
	/**MID SPJ**/
	function showSPJ(CrT,eIdT,rCek,IdL)
	{
		if (CrT=='refr'){
			$(document).ready(function()
			{
				$("#spjDiv2Cri").load('SP3D_SPJ_Frm_Spj_Mid.php?eIdT='+eIdT+'&IdL='+IdL);
			});
		}
		else{
			dispBLOCK('spjDiv1Cri');
			dispBLOCK('spjDiv2Cri');
			$(document).ready(function()
			{
				$("#spjDiv1Cri").load('SP3D_SPJ_Frm_Spj_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#spjDiv2Cri").load('SP3D_SPJ_Frm_Spj_Mid.php?eIdT='+eIdT+'&IdL='+IdL);
			});
			dispBlockOrNo('spjMstCri');
		}
	}

	function SaveMidSPJ(eIdT,rCek,IdL)
	{
		fHRKon = $("#fHRKon").val();
		fBLKon = $("#fBLKon").val();
		fTHKon = $("#fTHKon").val();
		
		fHRBas = $("#fHRBas").val();
		fBLBas = $("#fBLBas").val();
		fTHBas = $("#fTHBas").val();
		
		fHRFak = $("#fHRFak").val();
		fBLFak = $("#fBLFak").val();
		fTHFak = $("#fTHFak").val();
		
		fNomKon= ReplaceText($("#fNomKon").val());
		fNomBas= ReplaceText($("#fNomBas").val());
		fNomFak= ReplaceText($("#fNomFak").val());
		
		fUrai  = ReplaceText($("#fUrai").val());
		$(document).ready(function() 
		{ 
			$("#spjDiv2Cri").load('SP3D_SPJ_Frm_Spj_Save.php?eIdT='+eIdT
			+'&fHRKon='+fHRKon+'&fBLKon='+fBLKon+'&fTHKon='+fTHKon
			+'&fHRBas='+fHRBas+'&fBLBas='+fBLBas+'&fTHBas='+fTHBas
			+'&fHRFak='+fHRFak+'&fBLFak='+fBLFak+'&fTHFak='+fTHFak
			+'&fNomKon='+fNomKon+'&fNomBas='+fNomBas+'&fNomFak='+fNomFak
			+'&fUrai='+fUrai
			+'&IdL='+IdL); 
		}); 
    }
	/**END MID SPJ**/
	
	/**MID ASET**/
	function showASET(CrT,rIdT,rCek,IdL)
	{
		if (CrT=='refr'){
			$(document).ready(function()
			{
				$("#spjasetDiv3Cri").load('SP3D_SPJ_Frm_Spjaset_Mid.php?rIdT='+rIdT+'&IdL='+IdL);
			});
		}
		else{
			//globalClose('spjMstCri');
			dispBLOCK('spjasetDiv1Cri');
			dispBLOCK('spjasetDiv2Cri');
			dispBLOCK('spjasetDiv3Cri');
			
			$(document).ready(function()
			{
				$("#spjasetDiv1Cri").load('SP3D_SPJ_Frm_Spjaset_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#spjasetDiv2Cri").load('SP3D_SPJ_Frm_Spjaset_Hea.php?rIdT='+rIdT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#spjasetDiv3Cri").load('SP3D_SPJ_Frm_Spjaset_Mid.php?rIdT='+rIdT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('spjasetMstCri');
		}
	}
	
	function AddMidASET(ReKN,TglBAS,rIdT,IdL)
	{
		if (TglBAS=='0000-00-00'){alert('Silahkan lengkapi data pada formulir berkas terlebih dahulu...!!'); return false;}
		if (ReKN=='1.3.1'){
			fL = "A";
		}
		else if (ReKN=='1.3.2'){
			fL = "B";
		}
		else if (ReKN=='1.3.3'){
			fL = "C";
		}
		else if (ReKN=='1.3.4'){
			fL = "D";
		}
		else if (ReKN=='1.3.5'){
			fL = "E";
		}
		else if (ReKN=='1.3.6'){
			fL = "F";
		}
		
		$(document).ready(function()
		{
			$("#spjasetDiv3Cri").load('SP3D_SPJ_Frm_Spjaset_Mid_'+fL+'.php?rIdT='+rIdT+'&IdL='+IdL);
		});
	}
	
	function SaveMidASET(CrtSave,IdTR,rIdT,rCek,IdL)
	{
		if (CrtSave=='E')
		{
			eNma = ReplaceText($("#eNma").val());
			
			eJud = ReplaceText($("#eJud").val());
			eDae = ReplaceText($("#eDae").val());
			eJen = ReplaceText($("#eJen").val());
			eSpe = ReplaceText($("#eSpe").val());
			ePen = ReplaceText($("#ePen").val());
			eUku = ReplaceText($("#eUku").val());
			eBah = ReplaceText($("#eBah").val());
			eThn = ReplaceText($("#eThn").val());
			
			eKet = ReplaceText($("#eKet").val());
			eMil = $("#eMil").val();
			eAsa = ReplaceText($("#eAsa").val());
			eKon = ReplaceText($("#eKon").val());
			eSat = ReplaceText($("#eSat").val());
			eHrg = ReplaceText($("#eHrg").val());
					
			$(document).ready(function()
			{
				$("#spjasetDiv3Cri").load('SP3D_SPJ_Frm_Spjaset_Mid_Save.php?CrtSave='+CrtSave
				+'&eNma='+eNma
				
				+'&eJud='+eJud
				+'&eDae='+eDae
				+'&eJen='+eJen
				+'&eSpe='+eSpe
				+'&ePen='+ePen
				+'&eUku='+eUku
				+'&eBah='+eBah
				+'&eThn='+eThn
				
				+'&eKet='+eKet
				+'&eMil='+eMil
				+'&eAsa='+eAsa
				+'&eKon='+eKon
				+'&eSat='+eSat
				+'&eHrg='+eHrg
				+'&IdTR='+IdTR+'&rIdT='+rIdT+'&IdL='+IdL
				);
			});
		}
	
	
		if (CrtSave=='F')
		{
			fNma = ReplaceText($("#fNma").val());
			fLok = ReplaceText($("#fLok").val());
			
			fTin = ReplaceText($("#fTin").val());
			fBet = ReplaceText($("#fBet").val());
			fPan = ReplaceText($("#fPan").val());
			fLeb = ReplaceText($("#fLeb").val());
			fLua = ReplaceText($("#fLua").val());
			
			fKet = ReplaceText($("#fKet").val());
			fMil = $("#fMil").val();
			fAsa = ReplaceText($("#fAsa").val());
			fSat = ReplaceText($("#fSat").val());
			fHrg = ReplaceText($("#fHrg").val());
					
			$(document).ready(function()
			{
				$("#spjasetDiv3Cri").load('SP3D_SPJ_Frm_Spjaset_Mid_Save.php?CrtSave='+CrtSave
				+'&fNma='+fNma
				+'&fLok='+fLok
				
				+'&fTin='+fTin
				+'&fBet='+fBet
				+'&fPan='+fPan
				+'&fLeb='+fLeb
				+'&fLua='+fLua
				
				+'&fKet='+fKet
				+'&fMil='+fMil
				+'&fAsa='+fAsa
				+'&fSat='+fSat
				+'&fHrg='+fHrg
				+'&IdTR='+IdTR+'&rIdT='+rIdT+'&IdL='+IdL
				);
			});
		}
	
		if (CrtSave=='D')
		{
			dNma = ReplaceText($("#dNma").val());
			dLok = ReplaceText($("#dLok").val());
			
			dKot = ReplaceText($("#dKot").val());
			dPan = ReplaceText($("#dPan").val());
			dLeb = ReplaceText($("#dLeb").val());
			dLua = ReplaceText($("#dLua").val());
			
			dKet = ReplaceText($("#dKet").val());
			dMil = $("#dMil").val();
			dKon = ReplaceText($("#dKon").val());
			dAsa = ReplaceText($("#dAsa").val());
			dSat = ReplaceText($("#dSat").val());
			dHrg = ReplaceText($("#dHrg").val());
					
			$(document).ready(function()
			{
				$("#spjasetDiv3Cri").load('SP3D_SPJ_Frm_Spjaset_Mid_Save.php?CrtSave='+CrtSave
				+'&dNma='+dNma
				+'&dLok='+dLok
				
				+'&dKot='+dKot
				+'&dPan='+dPan
				+'&dLeb='+dLeb
				+'&dLua='+dLua
				
				+'&dKet='+dKet
				+'&dMil='+dMil
				+'&dKon='+dKon
				+'&dAsa='+dAsa
				+'&dSat='+dSat
				+'&dHrg='+dHrg
				+'&IdTR='+IdTR+'&rIdT='+rIdT+'&IdL='+IdL
				);
			});
		}
	
		if (CrtSave=='C')
		{
			cNma = ReplaceText($("#cNma").val());
			cLet = ReplaceText($("#cLet").val());
			cTin = ReplaceText($("#cTin").val());
			cBet = ReplaceText($("#cBet").val());
			cLua = ReplaceText($("#cLua").val());
			cKet = ReplaceText($("#cKet").val());
			cMil = $("#cMil").val();
			cKon = ReplaceText($("#cKon").val());
			cAsa = ReplaceText($("#cAsa").val());
			cSat = ReplaceText($("#cSat").val());
			cHrg = ReplaceText($("#cHrg").val());
					
			$(document).ready(function()
			{
				$("#spjasetDiv3Cri").load('SP3D_SPJ_Frm_Spjaset_Mid_Save.php?CrtSave='+CrtSave
				+'&cNma='+cNma
				+'&cLet='+cLet
				+'&cTin='+cTin
				+'&cBet='+cBet
				+'&cLua='+cLua
				+'&cKet='+cKet
				+'&cMil='+cMil
				+'&cKon='+cKon
				+'&cAsa='+cAsa
				+'&cSat='+cSat
				+'&cHrg='+cHrg
				+'&IdTR='+IdTR+'&rIdT='+rIdT+'&IdL='+IdL
				);
			});
		}
	
		if (CrtSave=='B')
		{
			bNma = ReplaceText($("#bNma").val());
			
			bMer = ReplaceText($("#bMer").val());
			bTip = ReplaceText($("#bTip").val());
			bUku = ReplaceText($("#bUku").val());
			bBhn = ReplaceText($("#bBhn").val());
			
			bPab = ReplaceText($("#bPab").val());
			bMes = ReplaceText($("#bMes").val());
			bBpk = ReplaceText($("#bBpk").val());
			bRan = ReplaceText($("#bRan").val());
			bPol = ReplaceText($("#bPol").val());
			
			bKet = ReplaceText($("#bKet").val());
			bMil = $("#bMil").val();
			bKon = ReplaceText($("#bKon").val());
			bAsa = ReplaceText($("#bAsa").val());
			bSat = ReplaceText($("#bSat").val());
			bHrg = ReplaceText($("#bHrg").val());
					
			$(document).ready(function()
			{
				$("#spjasetDiv3Cri").load('SP3D_SPJ_Frm_Spjaset_Mid_Save.php?CrtSave='+CrtSave
				+'&bNma='+bNma
				+'&bMer='+bMer
				+'&bTip='+bTip
				+'&bUku='+bUku
				+'&bBhn='+bBhn
				+'&bPab='+bPab
				+'&bMes='+bMes
				+'&bBpk='+bBpk
				+'&bRan='+bRan
				+'&bPol='+bPol
				+'&bKet='+bKet
				+'&bMil='+bMil
				+'&bKon='+bKon
				+'&bAsa='+bAsa
				+'&bSat='+bSat
				+'&bHrg='+bHrg
				+'&IdTR='+IdTR+'&rIdT='+rIdT+'&IdL='+IdL
				);
			});
		}
		
		if (CrtSave=='A')
		{
			aNma = ReplaceText($("#aNma").val());
			aLet = ReplaceText($("#aLet").val());
			aHak = ReplaceText($("#aHak").val());
			aGun = ReplaceText($("#aGun").val());
			aLua = ReplaceText($("#aLua").val());
			aKet = ReplaceText($("#aKet").val());
			aMil = $("#aMil").val();
			aAsa = ReplaceText($("#aAsa").val());
			aSat = ReplaceText($("#aSat").val());
			aHrg = ReplaceText($("#aHrg").val());
					
			$(document).ready(function()
			{
				$("#spjasetDiv3Cri").load('SP3D_SPJ_Frm_Spjaset_Mid_Save.php?CrtSave='+CrtSave
				+'&aNma='+aNma+'&aLet='+aLet+'&aHak='+aHak+'&aGun='+aGun+'&aLua='+aLua+'&aKet='+aKet
				+'&aMil='+aMil+'&aAsa='+aAsa+'&aSat='+aSat+'&aHrg='+aHrg
				+'&IdTR='+IdTR+'&rIdT='+rIdT+'&IdL='+IdL
				);
			});
		}
	}
	
	function EditMidASET(IdTR,rIdT,fL,IdL)
	{
		$(document).ready(function()
		{
			$("#spjasetDiv3Cri").load('SP3D_SPJ_Frm_Spjaset_Mid_'+fL+'.php?IdTR='+IdTR+'&rIdT='+rIdT+'&IdL='+IdL);
		});
	}
	
	function ResetMidASET(fL,rIdT,IdL)
	{
		$(document).ready(function()
		{
			$("#spjasetDiv3Cri").load('SP3D_SPJ_Frm_Spjaset_Mid_'+fL+'.php?rIdT='+rIdT+'&IdL='+IdL);
		});
	}
	
	function DeleMidASET(IdTR,rIdT,IdL)
	{
		AN = confirm('Hapus data aset...?!!');
		if (!AN){
			return false;
		}
		$(document).ready(function()
		{
			$("#spjasetDiv3Cri").load('SP3D_SPJ_Frm_Spjaset_Mid_Rem.php?IdTR='+IdTR+'&rIdT='+rIdT+'&IdL='+IdL);
		});
	}
	/**END MID ASET**/
	
	/**UPLOAD IMAGES**/
	function showUPLOAD(CrT,eIdT,rCek,IdL)
	{
		if (CrT=='refr'){
			$(document).ready(function()
			{
				$("#imgDiv2Cri").load('SP3D_SPJ_Frm_Spjaset_Mid_Upl_Mid.php?eIdT='+eIdT+'&IdL='+IdL);
			});
		}
		else{
			dispBLOCK('imgDiv1Cri');
			dispBLOCK('imgDiv2Cri');
			$(document).ready(function()
			{
				$("#imgDiv1Cri").load('SP3D_SPJ_Frm_Spjaset_Mid_Upl_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#imgDiv2Cri").load('SP3D_SPJ_Frm_Spjaset_Mid_Upl_Mid.php?eIdT='+eIdT+'&IdL='+IdL);
			});
			dispBlockOrNo('imgMstCri');
		}
	}
	
	function addIMG(eIdT,IdL)
	{
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('SP3D_SPJ_Frm_Spjaset_Mid_Upl_Mid_Bro.php?eIdT='+eIdT+'&IdL='+IdL);
		});
	}
	
	
	function P_Upload(eIdT,IdL)
	{
		if (objfrm.imgfile.value=="")
		{
			alert('Silahkan pilih file terlebih dahulu..!!');
			return false;
		}
		
		var spl = objfrm.imgfile.value.split('.');
		var Ext = spl[1].toLowerCase();
		
		objfrm.UplIdT.value=eIdT;
		objfrm.fSave.value='Upload';
		objfrm.submit();
	}
	
	function viewIMG(rIdT,w,h,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='SP3D_SPJ_Frm_Spjaset_Mid_Upl_Mid_Vie.php?rIdT='+rIdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open(URL,'',settings);
	}
	
	function remoIMG(CrT,eIdT,rIdT,IdL)
	{
		var AN = confirm("Remove file..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('SP3D_SPJ_Frm_Spjaset_Mid_Upl_Mid_Rem.php?CrT='+CrT+'&eIdT='+eIdT+'&rIdT='+rIdT+'&IdL='+IdL);
			});
		}
	}
	/**END UPLOAD IMAGES**/
	
</script>