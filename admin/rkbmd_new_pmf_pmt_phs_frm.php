<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>SimB@DA</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="global.js"></script>
</head>
<?php
extract($_GET);

$gREF= $Frm.".".fGetDate('year').".XXXXXXXX";
$gHR = fGetDate('mday');
$gBL = fGetDate('mon');
$gTH = fGetDate('year');
$gPR = fGetDate('year')+1;
$gHRd  = "00";
$gBLd  = "00";
$gTHd  = "0000";
$gNO  = "";
$gJNS = "";
$dJNS = "";
$gUNT = substr($SkP,0,11);
$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");

$gURA = "";
if ($IdT)
{
	$nSQL= "SELECT referensi,kd_unit,nomor,tanggal,uraian,tahun,jenis  
	FROM ta_rkbmd_new_pmf_pmt_phs WHERE IDT='$IdT'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	$gREF = $mRo[0];
	$gUNT = substr($mRo[1],0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	$gSUB = substr($mRo[1],0,14);
	$gNO  = $mRo[2];
	
	$gTG  = $mRo[3];
	$gTG  = explode("-",$gTG);
	$gTH  = $gTG[0];
	$gBL  = $gTG[1];
	$gHR  = $gTG[2];
	
	$gURA = $mRo[4];
	$gPR  = $mRo[5];
	$gJNS = $mRo[6];
}
?>
<body onload="B11.click()">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="rkbmd_new_pmf_pmt_phs_frm_.php?Frm=".$Frm."&Crit=".$Crit."&IdT=".$IdT."&IdL=".$_GET['IdL']."&FrmG=".$_GET['FrmG']?>" enctype="multipart/form-data">
<input type="hidden" name="fSave" style="width:20px" />
<input type="hidden" name="fCrT" style="width:20px" />
<input type="hidden" name="fIdT" style="width:20px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td width="16">&nbsp;</td>
    <td width="96">
	<div id="asetMstCri" class="findaset0CriByPage">
		<div id="asetDiv1Cri" class="findaset1CriByPage"></div>
		<div id="asetDiv2Cri" class="findaset2CriByPage"></div>
		<div id="asetDiv3Cri" class="findaset3CriByPage"></div>
	</div>	</td>
    <td width="25">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
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
    <td colspan="3">
	<input name="fREF" id="fREF" type="text" value="<?=$gREF?>" readonly style=" width:170px; border: 1px solid #C0C0C0"/>
	<input type="button" name="B13" value="..." disabled onclick="showDATA('','<?=$IdT?>','<?=$_GET['IdL']?>')" style="width: 30px; height: 23px" />
	<div id="tranMstCri" class="findtran0Cri">
		<div id="tranDiv1Cri" class="findtran1Cri"></div>
		<div id="tranDiv2Cri" class="findtran2Cri"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">TANGGAL</td>
    <td align="center">:</td>
    <td colspan="3"><select class="boxs" name="fHR" tabindex="0" style="width:50px">
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
	for($i=2023; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select></td>
    <td align="right">URAIAN</td>
    <td align="center">:</td>
    <td rowspan="3"><textarea name="fURA" style="border: 1px solid #C0C0C0; height:65px; width:400px"><?=$gURA?></textarea></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">NOMOR</td>
    <td align="center">:</td>
    <td width="224"><input name="fNO" type="text" value="<?=$gNO?>" style=" width:205px; border: 1px solid #C0C0C0"/>	</td>
    <td width="61">
	<div id="choiseMstCri" class="tgl0Cri">
		<div id="choiseDiv1Cri" class="tgl1Cri"></div>
		<div id="choiseDiv2Cri" class="tgl2Cri"></div>
	</div>
	<div id="edtMstCri" class="editrkb_a">
		<div id="edtDiv1Cri" class="editrkb_b"></div>
		<div id="edtDiv2Cri" class="editrkb_c"></div>
	</div>	  
	PERIODE :	</td>
    <td width="185">
	<select class="boxs" name="fThN" style="width: 60px" tabindex="0">
      <?php
	for($i=2023; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gPR) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select></td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">UNIT KERJA </td>
    <td align="center">:</td>
    <td colspan="3">
	<input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" <?php if ($IdT=='' && $Lev <= 1) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:332px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="find0Cri">
		<div id="unitDiv1Cri" class="find1Cri"></div>
		<div id="unitDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td><div id="loadingImg" style="width:40px; height:10px; display:none"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td colspan="3">&nbsp;</td>
    <td>	</td>
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
      <input type="button" name="B10" id="B10" value="RESET" onclick="Reset()" style="width: 80px; height: 21px" />
      <input type="button" name="B11" id="B11" value="REFRESH" onclick="RefreshDATA('<?=$IdL?>','0')" style="width: 80px; height: 21px" />
	  <input type="button" name="B12" id="B12" <?=$DisA?> value="ADD ITEM" onclick="showASET('','0','<?=$Frm?>','<?=$IdT?>','<?=$_GET['IdL']?>')" style="width: 80px; height: 21px; color:#0000FF" /><?=str_repeat("&nbsp;",10)?>
	  <input type="button" name="B13" id="B13" value="DAFTAR TRANSAKSI" onclick="showDATANew('<?=$Frm?>','<?=$Crit?>','<?=$_GET['IdL']?>')" style="width: 130px; height: 21px" />
	  &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type="button" name="B15" id="B15" <?php if ($IdT=="") {echo "disabled";}?> value="CETAK" onclick="P_Dokumen('800','400','<?=$Frm?>','<?=$Crit?>','<?=$IdT?>','<?=$_GET['IdL']?>')" style="width: 120px; height: 21px; color:#0000FF" />
	  </td>
    <td width="5">&nbsp;</td>
  </tr>
</table>
<?php if ($IdT) {?>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #CEFBE3; font-weight:bold">
  <?php if ($Frm=="PMF") {?>
  <tr style="text-align:center">
    <td width="28" style="border-right:1px #ccc solid">No</td>
    <td width="100" style="border-right:1px #ccc solid">Kode</td>
    <td width="210" style="border-right:1px #ccc solid">Nama Barang / Spesifikasi</td>
    <td width="95" style="border-right:1px #ccc solid">NIBAR</td>
    <td width="60" style="border-right:1px #ccc solid">Register</td>
    <td width="45" style="border-right:1px #ccc solid">Jumlah</td>
    <td width="105" style="border-right:1px #ccc solid">Nilai</td>
    <td width="180" style="border-right:1px #ccc solid">Lokasi</td>
    <td width="130" style="border-right:1px #ccc solid">Peruntukan</td>
    <td width="130" style="border-right:1px #ccc solid">Bentuk Pemanfaatan</td>
    <td width="100" style="border-right:1px #ccc solid">Jangka Waktu</td>
    <td align="center">Action</td>
  </tr>
  <?php } ?>
  <?php if ($Frm=="PMT") {?>
  <tr style="text-align:center">
    <td width="28" style="border-right:1px #ccc solid">No</td>
    <td width="100" style="border-right:1px #ccc solid">Kode</td>
    <td width="210" style="border-right:1px #ccc solid">Nama Barang / Spesifikasi</td>
    <td width="95" style="border-right:1px #ccc solid">NIBAR</td>
    <td width="60" style="border-right:1px #ccc solid">Register</td>
    <td width="45" style="border-right:1px #ccc solid">Jumlah</td>
    <td width="105" style="border-right:1px #ccc solid">Nilai</td>
    <td width="180" style="border-right:1px #ccc solid">Lokasi</td>
    <td width="180" style="border-right:1px #ccc solid">Bentuk Pemindahtanganan</td>
    <td width="180" style="border-right:1px #ccc solid">Alasan Pemindahtanganan</td>
    <td align="center">Action</td>
  </tr>
  <?php } ?>
  <?php if ($Frm=="PHS") {?>
  <tr style="text-align:center">
    <td width="28" style="border-right:1px #ccc solid">No</td>
    <td width="100" style="border-right:1px #ccc solid">Kode</td>
    <td width="300" style="border-right:1px #ccc solid">Nama Barang / Spesifikasi</td>
    <td width="95" style="border-right:1px #ccc solid">NIBAR</td>
    <td width="60" style="border-right:1px #ccc solid">Register</td>
    <td width="45" style="border-right:1px #ccc solid">Jumlah</td>
    <td width="105" style="border-right:1px #ccc solid">Nilai</td>
    <td width="250" style="border-right:1px #ccc solid">Lokasi</td>
    <td width="200" style="border-right:1px #ccc solid">Alasan Rencana Penghapusan</td>
    <td align="center">Action</td>
  </tr>
<?php } ?>
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
	<div id="ViewDATAaX" style="height:30px; width:100%; overflow:auto; border:0px"></div>
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
				$("#unitDiv2Cri").load('rkbmd_new_pmf_pmt_phs_frm_find_unit_mid.php?gFnD='+gFnD+'&IdL='+gIdL);
			});
		}
		else
		{
			//document.getElementById('subMstCri').style.display = "none";
			//document.getElementById('upbMstCri').style.display = "none";
			
			document.getElementById('unitDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('rkbmd_new_pmf_pmt_phs_frm_find_unit_top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('rkbmd_new_pmf_pmt_phs_frm_find_unit_mid.php?IdL='+gIdL);
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
		fUNT = $("#fUNT").val();
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dSUB.value);
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('rkbmd_new_pmf_pmt_phs_frm_find_sub_mid.php?gFnD='+gFnD+'&gUNT='+fUNT+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('upbMstCri').style.display = "none";
			
			if (!fUNT) {alert('Silahkan pilih Unit Kerja terlebih dahulu..!!'); return false;}
			document.getElementById('subDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#subDiv1Cri").load('rkbmd_new_pmf_pmt_phs_frm_find_sub_top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('rkbmd_new_pmf_pmt_phs_frm_find_sub_mid.php?gUNT='+fUNT+'&IdL='+gIdL);
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
				$("#upbDiv2Cri").load('rkbmd_new_pmf_pmt_phs_frm_find_upb_mid.php?gFnD='+gFnD+'&gSUB='+fSUB+'&IdL='+gIdL);
			});
		}
		else
		{
			if (!fSUB) {alert('Silahkan pilih Sub Unit terlebih dahulu..!!'); return false;}
			document.getElementById('upbDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('rkbmd_new_pmf_pmt_phs_frm_find_upb_top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('rkbmd_new_pmf_pmt_phs_frm_find_upb_mid.php?gSUB='+fSUB+'&IdL='+gIdL);
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
	
	function proslNIL(crt,PgE,IdT,gAsT,gLhI,gExT,IdL,AmBiL)
	{
		if (AmBiL=="ALL")
		{
			gFnD = ReplaceText($("#fFindP").val());
			gTHN = $("#fThnAst").val();
			gLST = $("#fTmpRec").val();
			gUNT = $("#fUNT").val();
			rUpb = $("#rUpb").val();
			
			var AN = confirm("Proses semua data aset yang tampil ke usulan..?!!");
			if (!AN)
			{
				return false;
			}
			
			$(document).ready(function()
			{
				$("#loadingImg").show();
				$("#ViewDATA").load('rkbmd_new_pmf_pmt_phs_frm_find_aset_mid_checklist.php?rUpb='+rUpb+'&gExT='+gExT+'&gLhI='+gLhI+'&PgE='+PgE+'&IdT='+IdT+'&gAsT='+gAsT+'&gUNT='+gUNT+'&AmBiL='+AmBiL+'&gFnD='+gFnD+'&gTHN='+gTHN+'&gLST='+gLST+'&IdL='+IdL);
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
				//$("#ViewDELL").load('rkbmd_new_pmf_pmt_phs_frm_find_aset_mid_checklist.php?AmBiL='+AmBiL+'&PgE='+PgE+'&IdT='+IdT+'&gCrID='+gCrID+'&IdL='+IdL);
				$("#ViewDATA").load('rkbmd_new_pmf_pmt_phs_frm_find_aset_mid_checklist.php?AmBiL='+AmBiL+'&PgE='+PgE+'&IdT='+IdT+'&gCrID='+gCrID+'&IdL='+IdL);
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
			$("#fUNT").val(kde);
			$("#dUNT").val(nma);
		}
		
		if (crt=='aset') 
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('rkbmd_new_pmf_pmt_phs_frm_find_aset_add.php?IdT='+kde+'&rDTA='+nma+'&IdL='+IdL);
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
	
	function Reset()
	{
		objfrm.fSave.value='Reset';
		objfrm.submit();
	}
	
	function showASET(CrT,PgE,Jns,IdT,IdL)
	{
		//alert(Jns); return false;
		gLhI = "";
		if (!IdT) {alert('Data belum tersimpan...!'); return false;}
		gUPB = $("#fUNT").val();
		gTHN = "";
		gLST = 100;
		gEXT = "";
		if (CrT=='find')
		{
			gTHN = $("#fThnAst").val();
			gLST = $("#fTmpRec").val();
			gEXT = $("#fExtra").val();
			gTBL = "";
			gAsT = $("#fAsT").val();
			rUpb = $("#rUpb").val();
			gLhI = "";//$("#fLhI").val();
			
			gFnD = ReplaceText(objfrm.fFindP.value);
			$(document).ready(function()
			{
				$("#asetDiv2Cri").load('rkbmd_new_pmf_pmt_phs_frm_find_aset_mid.php?rUpb='+rUpb+'&gLhI='+gLhI+'&PgE='+PgE+'&gEXT='+gEXT+'&gLST='+gLST+'&gTHN='+gTHN+'&gAsT='+gAsT+'&gFnD='+gFnD+'&IdT='+IdT+'&gUPB='+gUPB+'&Jns='+Jns+'&IdL='+IdL);
				$("#asetDiv3Cri").load('rkbmd_new_pmf_pmt_phs_frm_find_aset_page.php?rUpb='+rUpb+'&gLhI='+gLhI+'&PgE='+PgE+'&gEXT='+gEXT+'&gLST='+gLST+'&gTHN='+gTHN+'&gAsT='+gAsT+'&gFnD='+gFnD+'&IdT='+IdT+'&gUPB='+gUPB+'&Jns='+Jns+'&IdL='+IdL);
			});
		}
		else
		{
			PgE=0;
			if (Jns=='PHS') {gAsT='1.5.4';} else {gAsT='1.3.1';}
			
			dispBLOCK('asetDiv2Cri');
			$(document).ready(function()
			{
				$("#asetDiv1Cri").load('rkbmd_new_pmf_pmt_phs_frm_find_aset_top.php?PgE='+PgE+'&IdT='+IdT+'&Jns='+Jns+'&gAsT='+gAsT+'&IdL='+IdL);
				$("#asetDiv2Cri").load('rkbmd_new_pmf_pmt_phs_frm_find_aset_mid.php?gLhI='+gLhI+'&PgE='+PgE+'&gEXT='+gEXT+'&gLST='+gLST+'&gTHN='+gTHN+'&gAsT='+gAsT+'&IdT='+IdT+'&gUPB='+gUPB+'&Jns='+Jns+'&IdL='+IdL);
				$("#asetDiv3Cri").load('rkbmd_new_pmf_pmt_phs_frm_find_aset_page.php?gLhI='+gLhI+'&PgE='+PgE+'&gEXT='+gEXT+'&gLST='+gLST+'&gTHN='+gTHN+'&gAsT='+gAsT+'&IdT='+IdT+'&gUPB='+gUPB+'&Jns='+Jns+'&IdL='+IdL);
			});
			dispBlockOrNo('asetMstCri');
		}
	}
	
	function RefreshDATA(IdL,PgE)
	{
		gREF = $("#fREF").val();
		$(document).ready(function()
		{
			$.ajax({
				url:"rkbmd_new_pmf_pmt_phs_frm_data.php",
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
			$("#ViewDATAaX").load('rkbmd_new_pmf_pmt_phs_frm_data_pages.php?PgE='+PgE+'&gREF='+gREF+'&IdL='+IdL);
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
					$("#ViewDELL").load('rkbmd_new_pmf_pmt_phs_frm_del.php?PgE='+PgE+'&DelVer=Ya&rIdT='+rIdT+'&IdL='+IdL);
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
					$("#ViewDELL").load('rkbmd_new_pmf_pmt_phs_frm_del.php?PgE='+PgE+'&rIdT='+rIdT+'&IdL='+IdL);
				});
			}
		}
	}

	function choiseTANGGAL(IdL)
	{
		dispBLOCK('choiseDiv2Cri');
		$(document).ready(function()
		{
			$("#choiseDiv1Cri").load('rkbmd_new_pmf_pmt_phs_frm_choise_top.php');
		});
		
		$(document).ready(function()
		{
			$("#choiseDiv2Cri").load('rkbmd_new_pmf_pmt_phs_frm_choise_mid.php?IdL='+IdL);
		});
		
		dispBlockOrNo('choiseMstCri');
	}
	
	function showDATANew(Frm,Crit,IdL)
	{
		if (Frm=='PMF'){fR="PEMANFAATAN";}
		if (Frm=='PMT'){fR="PEMINDAHTANGANAN";}
		if (Frm=='PHS'){fR="PENGHAPUSAN";}
		
		//if (Crit=='kuasa'){fE="( KUASA PENGGUNA )";}
		//if (Crit=='pengguna'){fE="( PENGGUNA BARANG )";}
		fE="";
		gUNT = $("#fUNT").val();
		window.open('rkbmd_new_pmf_pmt_phs.php?FrmG=RENCANA '+fR+' BARANG MILIK DAERAH '+fE+'&Frm='+Frm+'&Crit='+Crit+'&gUNT='+gUNT+'&IdL='+IdL,'_self');
	}
	
	function showDATA(CrT,IdT,gIdL)
	{
		gUPB = $("#fUNT").val();
		if (CrT=='find')
		{
			gFnD = ReplaceText(objfrm.fFindA.value);
			$(document).ready(function()
			{
				$("#tranDiv2Cri").load('rkbmd_new_pmf_pmt_phs_frm_data_mid.php?gFnD='+gFnD+'&gUPB='+gUPB+'&IdL='+gIdL);
			});
		}
		else
		{
			dispBLOCK('tranDiv2Cri');
			$(document).ready(function()
			{
				$("#tranDiv1Cri").load('rkbmd_new_pmf_pmt_phs_frm_data_top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#tranDiv2Cri").load('rkbmd_new_pmf_pmt_phs_frm_data_mid.php?gUPB='+gUPB+'&IdL='+gIdL);
			});
			
			dispBlockOrNo('tranMstCri');
		}
	}
	
	function showREF(CrT,gIdT,gIdL)
	{
		gRF = $("#fREF").val();
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('rkbmd_new_pmf_pmt_phs_frm_data_edit_mid.php?gIdT='+gIdT+'&gRF='+gRF+'&CrT='+CrT+'&IdL='+gIdL);
		});
	}
	
	function showEDIT(CrT,IdT,IdL)
	{
		gRF = $("#fREF").val();
		
		if (CrT=='refr')
		{
			$(document).ready(function()
			{
				$("#edtDiv2Cri").load('rkbmd_new_pmf_pmt_phs_frm_data_edit_mid.php?IdT='+IdT+'&gRF='+gRF+'&CrT='+CrT+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('edtDiv1Cri');
			dispBLOCK('edtDiv2Cri');
			$(document).ready(function()
			{
				$("#edtDiv1Cri").load('rkbmd_new_pmf_pmt_phs_frm_data_edit_top.php?CrT='+CrT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#edtDiv2Cri").load('rkbmd_new_pmf_pmt_phs_frm_data_edit_mid.php?IdT='+IdT+'&gRF='+gRF+'&CrT='+CrT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('edtMstCri');
		}
	}
	
	function SaveEDIT(gRF,JeN,IdT,IdL)
	{
		Peru = "";
		Bent = "";
		fJml = "";
		fWkt = "";
		BenP = "";
		AlaP = "";
		AlaD = "";
		if (JeN=='PMF')
		{
			Peru = $("#fPeru").val();
			Bent = $("#fBent").val();
			fJml = $("#fJml").val();
			fWkt = $("#fWkt").val();
		}
		else if (JeN=='PMT')
		{
			BenP = $("#fBenP").val();
			AlaP = $("#fAlaP").val();
		}
		else if (JeN=='PHS')
		{
			AlaD = $("#fAlaD").val();
		}
		
		$(document).ready(function()
		{
			filepost = "rkbmd_new_pmf_pmt_phs_frm_data_edit_save_json.php";
			$.post(filepost,
			{"Peru":Peru,"Bent":Bent,"fJml":fJml,"fWkt":fWkt,"BenP":BenP,"AlaP":AlaP,"AlaD":AlaD,"gRF":gRF,"JeN":JeN,"IdT":IdT,"IdL":IdL},
			function( data ) 
			{
				alert(data['mess']);
			},"json");
		});		
	}
	
	function choiseFIND_xxxx(Frm,CrT,gid,kde,nma,IdL)
	{
		$(document).ready(function()
		{
			$("#ViewDELL").load('rkbmd_new_pmf_pmt_phs_frm_data_edit_mid_find_add.php?gFrm='+Frm+'&gID='+gid+'&gKD='+kde+'&IdL='+IdL);
		});
		
		dispNO(CrT+'MstCri');
	}
	
	function P_Dokumen(w,h,Frm,Crit,IdT,IdL)
	{
		if (Frm=="PMF"){dk="rkbmd_new_pmf_pmt_phs_frm_data_dok_pmf";}
		if (Frm=="PMT"){dk="rkbmd_new_pmf_pmt_phs_frm_data_dok_pmt";}
		if (Frm=="PHS"){dk="rkbmd_new_pmf_pmt_phs_frm_data_dok_phs";}
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL=dk+'.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	

</script>