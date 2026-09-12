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
$gREF= "PRB.".fGetDate('year').".XXXXXXXX";
$gHR = fGetDate('mday');
$gBL = fGetDate('mon');
$gTH = fGetDate('year');
$gHRd  = "00";
$gBLd  = "00";
$gTHd  = "0000";
$gNO  = "XXXXXXXX/PRB/".fGetDate('year');
$gNOd = "";
$gJNS = "";
$dJNS = "";
$gUNT = substr($SkP,0,11);
$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
$gSUB = substr($SkP,0,14);
$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
$gUPB = substr($SkP,0,18);
$dUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
$gURA = "";
if ($IdT)
{
	$nSQL= "SELECT Referensi,Kd_Unit,Nomor,Tanggal,Dokumen_Nom,Dokumen_Tgl,Uraian 
	FROM ta_permohonan_repla_rek_aset WHERE IDT='$IdT'";
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
	$gTG  = explode("-",$gTG);
	$gTH  = $gTG[0];
	$gBL  = $gTG[1];
	$gHR  = $gTG[2];
	
	$gNOd = $mRo[4];
	
	$gTGd = $mRo[5];
	$gTGd = explode("-",$gTGd);
	$gTHd = $gTGd[0];
	$gBLd = $gTGd[1];
	$gHRd = $gTGd[2];
	
	$gURA = $mRo[6];
}

$ColB="0000ff";
/*
$CeK = fGlobal("IDT","ta_usulan_verifikasi","Ref_Usulan",$gREF,"=","","");
if ($CeK){
	#$DisA="disabled";
	$DisA="";
	$DisB="disabled";
	$ColB="999";
	
	$CeB = fGlobal("count(*)","ta_usulan_rinci","Referensi",$gREF,"=","","");
	if ($CeB==0){
		$DisB="";
		$CeK="DelVer";
		$ColB="ff0000";
	}
}
*/
#if ($gJNS=='RB') {$gTL="ALASAN";}
#if ($gJNS=='MK') {$gTL="ALASAN";}
#if ($gJNS=='MS') {$gTL="KE SKPD";}
#if ($gJNS=='HB') {$gTL="HIBAH KE";}
#if ($gJNS=='PH') {$gTL="ALASAN";}
?>
<body onload="RefreshDATA('<?=$IdL?>','0')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="Rekn108_Usulan_Frm_.php?IdT=".$IdT."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>" enctype="multipart/form-data">
<input type="hidden" name="fSave" style="width:20px" />
<input type="hidden" name="fCrT" style="width:20px" />
<input type="hidden" name="fIdT" style="width:20px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td width="16">&nbsp;</td>
    <td width="96">&nbsp;</td>
    <td width="25">&nbsp;</td>
    <td colspan="2">
	<div id="asetMstCri" class="findaset0Cri">
		<div id="asetDiv1Cri" class="findaset1Cri"></div>
		<div id="asetDiv2Cri" class="findaset2Cri"></div>
	</div>	</td>
    <td width="117">&nbsp;</td>
    <td width="29">&nbsp;</td>
    <td width="418">&nbsp;</td>
    <td width="89">&nbsp;</td>
    <td width="31">&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">REFERENSI</td>
    <td align="center">:</td>
    <td colspan="2">
	<input name="fREF" type="text" value="<?=$gREF?>" readonly style=" width:120px; border: 1px solid #C0C0C0"/>
	</td>
    <td align="right">NOMOR DOKUMEN </td>
    <td align="center">:</td>
    <td><input name="fNOd" type="text" value="<?=$gNOd?>" style=" width:400px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">TANGGAL</td>
    <td align="center">:</td>
    <td colspan="2"><select class="boxs" name="fHR" tabindex="0" style="width:50px">
      <?php
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gHR) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fBL" tabindex="0" style="width:95px">
	<?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBL) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTH" style="width: 60px" tabindex="0">
 	<?php
	for($i=2014; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select></td>
    <td align="right"> TANGGAL DOKUMEN </td>
    <td align="center">:</td>
    <td>
	<select class="boxs" name="fHRd" tabindex="0" style="width:50px">
	<option value="00"></option>
	<?php
	for($i=1; $i<=31; $i++)
	{
		$sel ="";
		if ($i==$gHRd) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select>
	<select class="boxs" name="fBLd" tabindex="0" style="width:95px">
	<option value="00"></option>
  	<?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBLd) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTHd" style="width: 60px" tabindex="0">
	<option value="0000"></option>
  	<?php
	for($i=2014; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTHd) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">NOMOR</td>
    <td align="center">:</td>
    <td width="328"><input name="fNO" type="text" value="<?=$gNO?>" readonly style=" width:205px; border: 1px solid #C0C0C0"/>	</td>
    <td width="142">
	<div id="choiseMstCri" class="tgl0Cri">
		<div id="choiseDiv1Cri" class="tgl1Cri"></div>
		<div id="choiseDiv2Cri" class="tgl2Cri"></div>
	</div>	</td>
    <td align="right">URAIAN</td>
    <td align="center">:</td>
    <td rowspan="3" valign="top">
	<textarea name="fURA" style="border: 1px solid #C0C0C0; height:45px; width:400px"><?=$gURA?></textarea></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">UNIT KERJA</td>
    <td align="center">:</td>
    <td colspan="2">
	<input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" <?php if (!$IdT) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:372px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="find0Cri">
		<div id="unitDiv1Cri" class="find1Cri"></div>
		<div id="unitDiv2Cri" class="find2Cri"></div>
	</div>	
	</td>
    <td><div id="loadingImg" style="width:40px; height:10px; display:none"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="15">
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">
	<input name="fSUB" type="hidden" value="<?=$gSUB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dSUB" type="hidden" value="<?=$dSUB?>" <?php if (!$IdT) {?> onClick="showSUB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showSUB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('sub'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:332px; border: 1px solid #C0C0C0"/>
	<div id="subMstCri" class="find0Cri">
		<div id="subDiv1Cri" class="find1Cri"></div>
		<div id="subDiv2Cri" class="find2Cri"></div>
	</div>	  
	<input name="fUPB" type="hidden" value="<?=$gUPB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUPB" type="hidden" value="<?=$dUPB?>" <?php if (!$IdT) {?> onClick="showUPB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showUPB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('upb'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:332px; border: 1px solid #C0C0C0"/>
	<div id="upbMstCri" class="find0Cri">
		<div id="upbDiv1Cri" class="find1Cri"></div>
		<div id="upbDiv2Cri" class="find2Cri"></div>
	</div>	</td>
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
    <td><input type="button" name="B39" <?=$DisA?> value="SAVE" onclick="Save()" style="width: 80px; height: 21px" />
      <input type="button" name="B10" value="RESET" onclick="Reset()" style="width: 80px; height: 21px" />
      <input type="button" name="B11" value="REFRESH" onclick="RefreshDATA('<?=$IdL?>','0')" style="width: 80px; height: 21px" /><?=str_repeat("&nbsp;",5)?>
	  <input type="button" name="B39" <?=$DisA?> value="RETRIVE REKENING ASET" onclick="Load('<?=$IdT?>')" style="width: 180px; height: 21px; color:#0000FF" />
	  <input type="button" name="B13" value="DAFTAR TRANSAKSI" onclick="showDATANew('<?=$_GET['IdL']?>')" style="width: 130px; height: 21px" />
	  	  &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="B14" <?php if ($IdT=="") {echo "disabled";}?> value="CETAK" onclick="P_Dokumen('800','400','<?=$IdT?>','<?=$_GET['IdL']?>')" style="width: 120px; height: 21px; color:#0000FF" />
	  
	  <div style="float:right">
	  <input type="hidden" name="B16" <?=$DisB?> value="DELETE" onclick="P_Delete('<?=$IdT?>','<?=$CeK?>')" style="width: 80px; height: 21px; color:#<?=$ColB?>" />
	  </div>	  </td>
    <td width="5">&nbsp;</td>
  </tr>
</table>
<?php if ($IdT) {?>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #CEFBE3; font-weight:bold">
  <tr>
    <td width="29" rowspan="2" align="center" style="border-right:1px solid #ccc">NO</td>
    <td colspan="2" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; color:#0000FF">PERMENDAGRI 17</td>
    <td width="100" rowspan="2" align="center" style="border-right:1px solid #ccc">ASET</td>
    <td colspan="2" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc; color:#0000FF">PERMENDAGRI 108</td>
    <td width="100" rowspan="2" align="center" style="border-right:1px solid #ccc">STATUS</td>
    <td width="100" rowspan="2" align="center">ACTION</td>
  </tr>
  <tr>
    <td width="100" align="center" style="border-right:1px solid #ccc">KODE</td>
    <td width="303" align="center" style="border-right:1px solid #ccc">NAMA REKENING</td>
    <td width="105" align="center" style="border-right:1px solid #ccc">KODE</td>
    <td align="center" style="border-right:1px solid #ccc">NAMA REKENING</td>
    </tr>
</table>
<?php } ?>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:300px; overflow:auto; border:0px"></div>
	<div id="ViewDATA" style="height:300px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td valign="top">
	<div id="ViewDATAaX" style="height:50px; width:100%; overflow:auto; border:0px"></div>
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
				$("#unitDiv2Cri").load('Invent_Usulan_Frm_Find_Unit_Mid.php?gFnD='+gFnD+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('subMstCri').style.display = "none";
			document.getElementById('upbMstCri').style.display = "none";
			
			document.getElementById('unitDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('Invent_Usulan_Frm_Find_Unit_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('Invent_Usulan_Frm_Find_Unit_Mid.php?IdL='+gIdL);
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
				$("#subDiv2Cri").load('Invent_Usulan_Frm_Find_Sub_Mid.php?gFnD='+gFnD+'&gUNT='+fUNT+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('upbMstCri').style.display = "none";
			
			if (!fUNT) {alert('Silahkan pilih Unit Kerja terlebih dahulu..!!'); return false;}
			document.getElementById('subDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#subDiv1Cri").load('Invent_Usulan_Frm_Find_Sub_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('Invent_Usulan_Frm_Find_Sub_Mid.php?gUNT='+fUNT+'&IdL='+gIdL);
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
				$("#upbDiv2Cri").load('Invent_Usulan_Frm_Find_Upb_Mid.php?gFnD='+gFnD+'&gSUB='+fSUB+'&IdL='+gIdL);
			});
		}
		else
		{
			if (!fSUB) {alert('Silahkan pilih Sub Unit terlebih dahulu..!!'); return false;}
			document.getElementById('upbDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('Invent_Usulan_Frm_Find_Upb_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('Invent_Usulan_Frm_Find_Upb_Mid.php?gSUB='+fSUB+'&IdL='+gIdL);
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
	
	function proslNIL(crt,IdT,gTBL,IdL,AmBiL)
	{
		if (AmBiL=="ALL")
		{
			gFnD = ReplaceText($("#fFindP").val());
			gTHN = $("#fThnAst").val();
			gLST = $("#fTmpRec").val();
			gUNT = $("#fUNT").val();
			
			var AN = confirm("Proses semua data aset yang tampil ke usulan..?!!");
			if (!AN)
			{
				return false;
			}
			
			$(document).ready(function()
			{
				$("#loadingImg").show();
				$("#ViewDATA").load('Invent_Usulan_Frm_Find_Aset_Mid_CheckList.php?IdT='+IdT+'&gTBL='+gTBL+'&gUNT='+gUNT+'&AmBiL='+AmBiL+'&gFnD='+gFnD+'&gTHN='+gTHN+'&gLST='+gLST+'&IdL='+IdL);
			});
		}
		else
		{
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
			var AN = confirm("Proses data aset yang ditandai ke usulan..?!!");
			if (!AN)
			{
				return false;
			}
			
			$(document).ready(function()
			{
				$("#loadingImg").show();
				//$("#ViewDELL").load('Invent_Usulan_Frm_Find_Aset_Mid_CheckList.php?IdT='+IdT+'&gTBL='+gTBL+'&gCrID='+gCrID+'&IdL='+IdL);
				$("#ViewDATA").load('Invent_Usulan_Frm_Find_Aset_Mid_CheckList.php?AmBiL='+AmBiL+'&IdT='+IdT+'&gTBL='+gTBL+'&gCrID='+gCrID+'&IdL='+IdL);
			});
		}
		document.getElementById(crt+'MstCri').style.display = "none";
	}
	
	function showCLICK(crt,mesg,refs,kde,nma,IdL)
	{
		if (mesg=='mesga') {alert('Data aset ini sudah masuk diusulan yang sedang proses..!!'); return false;}
		if (mesg=='mesgb') {alert('Data aset ini sudah dalam proses usulan : '+refs); return false;}
		
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
		
		if (crt=='aset') 
		{
			$(document).ready(function()
			{
				$("#ViewDATA").load('Invent_Usulan_Frm_Find_Aset_Add.php?IdT='+kde+'&rDTA='+nma+'&IdL='+IdL);
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
	
	function Save()
	{
		objfrm.fSave.value='Save';
		objfrm.submit();
	}
	
	function Load(IdT)
	{
		if (IdT==''){alert('Error code IDT..!!'); return false;}
		objfrm.fSave.value='Load';
		objfrm.submit();
	}
	
	function Reset()
	{
		objfrm.fSave.value='Reset';
		objfrm.submit();
	}
	
	function RefreshDATA(IdL,PgE)
	{
		var gREF = objfrm.fREF.value;
		//$(document).ready(function()
		//{
		//	$("#ViewDATA").load('Invent_Usulan_Frm_Data.php?gREF='+gREF+'&IdL='+IdL);
		//});
		
		$(document).ready(function()
		{
			$.ajax({
				url:"Rekn108_Usulan_Frm_Data.php",
				data: {PgE:PgE,gREF:gREF,IdL:IdL},
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
			$("#ViewDATAaX").load('Rekn108_Usulan_Frm_Data_Pages.php?PgE='+PgE+'&gREF='+gREF+'&IdL='+IdL);
		});
	}
	
	function P_Remove(PgE,rIdT,DeL,IdL)
	{
		if (DeL=="DelVer") {
			var AN = confirm("Data sedang diverifikasi oleh pengelola, lanjutkan pembatalan..?!!");
			if (AN)
			{
				$(document).ready(function()
				{
					$("#ViewDELL").load('Invent_Usulan_Frm_Del.php?PgE='+PgE+'&DelVer=Ya&rIdT='+rIdT+'&IdL='+IdL);
				});
			}
		}
		else{
			if (DeL!="") {alert('Data usulan sudah diproses, aksi remove data ditolak...!!'); return false;}
			var AN = confirm("Remove item dari usulan..?!!");
			if (AN)
			{
				$(document).ready(function()
				{
					$("#ViewDELL").load('Invent_Usulan_Frm_Del.php?PgE='+PgE+'&rIdT='+rIdT+'&IdL='+IdL);
				});
			}
		}
	}

	function choiseTANGGAL(IdL)
	{
		document.getElementById('choiseDiv2Cri').style.display = "block";
		$(document).ready(function()
		{
			$("#choiseDiv1Cri").load('Invent_Usulan_Frm_Choise_Top.php');
		});
		
		$(document).ready(function()
		{
			$("#choiseDiv2Cri").load('Invent_Usulan_Frm_Choise_Mid.php?IdL='+IdL);
		});
		
		if (document.getElementById('choiseMstCri').style.display == "block")
		{
			document.getElementById('choiseMstCri').style.display = "none";
		}
		else
		{
			document.getElementById('choiseMstCri').style.display = "block";
		}
	}
	
	function showDATANew(IdL)
	{
		gUNT = objfrm.fUNT.value;
		window.open('Rekn108_Usulan.php?FrmG=DAFTAR USULAN MUTASI&gUNT='+gUNT+'&IdL='+IdL,'_self');
	}
	
	function showLINK(IdT,IdL)
	{
		URL='Rekn108_Usulan_Frm.php?IdT='+IdT+'&IdL='+IdL;
		window.open(URL,'MidFrame','');
	}

	function P_Delete(IdT,CeK)
	{
		if (!IdT) {alert('Error command..!!'); return false;}
		if (CeK=="DelVer")
		{
			var AN = confirm("Transaksi dalam proses verifikasi, lanjutkan hapus usulan ini ..?!!");
			if (AN)
			{
				objfrm.fSave.value='DelVer';
				//objfrm.submit();
			}
		}
		else
		{
			var AN = confirm("Hapus transaski usulan ini ..?!!");
			if (AN)
			{
				objfrm.fSave.value='Dell';
				objfrm.submit();
			}
		}
	}
	
	/*
	function addIMG(CrT,gIdT,gIdL)
	{
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('Invent_Usulan_Frm_Data_Edit_Upl_Mid_Bro.php?gIdT='+gIdT+'&CrT='+CrT+'&IdL='+gIdL);
		});
	}
	
	function showREF(CrT,gIdT,gIdL)
	{
		var gRF = objfrm.fREF.value;
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('Invent_Usulan_Frm_Data_Edit_Mid.php?gIdT='+gIdT+'&gRF='+gRF+'&CrT='+CrT+'&IdL='+gIdL);
		});
	}
	
	function showEDIT(CrT,gIdT,IdL)
	{
		var gRF = objfrm.fREF.value;
		var gJN = objfrm.fJNS.value;
		
		document.getElementById('imgDiv1Cri').style.display = "block";
		document.getElementById('imgDiv2Cri').style.display = "block";
		$(document).ready(function()
		{
			$("#imgDiv1Cri").load('Invent_Usulan_Frm_Data_Edit_Top.php?gJN='+gJN+'&CrT='+CrT+'&IdL='+gIdL);
		});
		
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('Invent_Usulan_Frm_Data_Edit_Mid.php?gIdT='+gIdT+'&gRF='+gRF+'&CrT='+CrT+'&IdL='+gIdL);
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
	
	function P_Upload(CrT,gIdT)
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
	
	function remoIMG(CrT,gIdT,rIdT,gIdL)
	{
		var AN = confirm("Remove file..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('Invent_Usulan_Frm_Data_Edit_Upl_Rem.php?CrT='+CrT+'&gIdT='+gIdT+'&rIdT='+rIdT+'&IdL='+gIdL);
			});
		}
	}
	
	function viewIMG(rIdT,w,h,gIdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='Invent_Usulan_Frm_Data_Edit_Upl_Top_Vie.php?rIdT='+rIdT+'&IdL='+gIdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open(URL,'',settings);
	}
	
	function closeIMG(crt)
	{
		document.getElementById('imgMst'+crt).style.display = "none";
	}
	
	function choiseFIND(Frm,CrT,gid,kde,nma,IdL)
	{
		$(document).ready(function()
		{
			$("#ViewDELL").load('Invent_Usulan_Frm_Data_Edit_Mid_Find_Add.php?gFrm='+Frm+'&gID='+gid+'&gKD='+kde+'&IdL='+IdL);
		});
		
		document.getElementById(CrT+'MstCri').style.display = "none";
	}
	
	function findEDIT(rMsT,Frm,CrT,gID,gIdL)
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
				$("#alasDiv2Cri").load('Invent_Usulan_Frm_Data_Edit_Mid_Find_Mid.php?rMsT='+rMsT+'&vMsT='+vMsT+'&gFnD='+gFnD+'&gFrm='+Frm+'&gID='+gID+'&gJN='+gJN+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('alasDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#alasDiv1Cri").load('Invent_Usulan_Frm_Data_Edit_Mid_Find_Top.php?rMsT='+rMsT+'&vMsT='+vMsT+'&gFrm='+Frm+'&gID='+gID+'&IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#alasDiv2Cri").load('Invent_Usulan_Frm_Data_Edit_Mid_Find_Mid.php?rMsT='+rMsT+'&vMsT='+vMsT+'&gFrm='+Frm+'&gID='+gID+'&gJN='+gJN+'&IdL='+gIdL);
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
	
	function P_Dokumen(w,h,IdT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='Rekn108_Usulan_Frm_Data_Dok_Rinci.php?IdT='+IdT+'&IdL='+IdL;
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
	
	function P_Rinci(w,h,RF,UnT,nRK,IdL)
	{
		//alert(w+':'+h+':'+UnT+':'+nRK+':'+IdL); return false;
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='Rekn108_Usulan_Frm_Data_Dok_Rinci_Aset.php?RF='+RF+'&UnT='+UnT+'&nRK='+nRK+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	*/
</script>