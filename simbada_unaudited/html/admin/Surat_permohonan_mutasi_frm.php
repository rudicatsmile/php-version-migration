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
$gREF= "SRT.".fGetDate('year').".XXXXXXXX";
$gHR = fGetDate('mday');
$gBL = fGetDate('mon');
$gTH = fGetDate('year');
$gHRd  = "00";
$gBLd  = "00";
$gTHd  = "0000";
$gNO  = "";

$gUNT = substr($SkP,0,11);
#echo $gUNT;
$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
$dNMA = fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit",$gUNT,"=","","");
$dNIP = fGlobal("Nip_Pimpinan","ref_unit","Kd_Unit",$gUNT,"=","","");
$dJAB = fGlobal("Jab_Pimpinan","ref_unit","Kd_Unit",$gUNT,"=","","");

$gPER = "Permohonan Mutasi BMD";
$gLAM = "3";
$gKPD = "Sekretaris Daerah c.q Kepala BPKPAD ".ucfirst(strtolower($TiDaer))." ".ucfirst(strtolower($NmDaer));
$gSBB = "";

#$IdT = 3;
if ($IdT)
{
	$nSQL= "SELECT 
	KdUnit as A0,
	KdUnitKe as A1,
	Referensi as A2,
	Tanggal as A3,
	Nomor as A4,
	Lampiran as A5,
	Perihal as A6,
	KpdYth as A7,
	Sebab as A8,
	NmKepala as A9,
	JbKepala as A10,
	NiKepala as A11 
	FROM ta_surat_usulan_mutasi WHERE IDT='$IdT'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	$gREF = $mRo[2];
	
	$gUNT = $mRo[0];
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	
	$gUNT2 = $mRo[1];
	$dUNT2 = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT2,"=","","");
	$gTG  = $mRo[3];
	$gTG  = explode("-",$gTG);
	$gTH  = $gTG[0];
	$gBL  = $gTG[1];
	$gHR  = $gTG[2];
	$gNO  = $mRo[4];
	
	$gLAM = $mRo[5];
	$gPER = $mRo[6];
	$gKPD = $mRo[7];
	$gSBB = $mRo[8];
	
	$dNMA = $mRo[9];
	$dJAB = $mRo[10];
	$dNIP = $mRo[11];
}

$ColB="0000ff";
$CeK = fGlobal("IDT","ta_usulan_verifikasi_108","Ref_Usulan",$gREF,"=","","");
if ($CeK){
	#$DisA="disabled";
	$DisA="";
	$DisB="disabled";
	$ColB="999";
	
	$CeB = fGlobal("count(*)","ta_usulan_rinci_108","Referensi",$gREF,"=","","");
	if ($CeB==0){
		$DisB="";
		$CeK="DelVer";
		$ColB="ff0000";
	}
}

?>
<body onload="RefreshDATA('<?=$IdL?>','0')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="Surat_permohonan_mutasi_frm_.php?IdT=".$IdT."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>" enctype="multipart/form-data">
<input type="hidden" name="fSave" style="width:20px" />

<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:750px; height:20px; background:#006666">
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:750px; color:#fff; background:#669999">
  <tr height="25">
    <td width="17">&nbsp;</td>
    <td width="100">
	<div id="tranMstCri" class="findsurat0Cri">
		<div id="tranDiv1Cri" class="findsurat1Cri"></div>
		<div id="tranDiv2Cri" class="findsurat2Cri"></div>
	</div>	
	</td>
    <td width="20">&nbsp;</td>
    <td>
	<div id="asetMstCri" class="findaset0Cri">
		<div id="asetDiv1Cri" class="findaset1Cri"></div>
		<div id="asetDiv2Cri" class="findaset2Cri"></div>
	</div>
	</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">REFERENSI</td>
    <td align="center">&nbsp;</td>
    <td>
	<input name="fREF" type="text" value="<?=$gREF?>" readonly style=" width:170px; border: 1px solid #C0C0C0"/>
	<input type="button" name="B13" value="...." onclick="showDATA('','<?=$IdT?>','<?=$_GET['FrmG']?>','<?=$_GET['IdL']?>')" style="width: 30px; height:21px; color:#FF0000" />
	</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">TANGGAL</td>
    <td align="center">&nbsp;</td>
    <td><select class="boxs" name="fHR" tabindex="0" style="width:50px">
      <?
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gHR) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fBL" tabindex="0" style="width:95px">
	<?
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBL) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTH" style="width: 60px" tabindex="0">
 	<?
	for($i=2014; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select></td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">NOMOR</td>
    <td align="center">&nbsp;</td>
    <td><input name="fNO" type="text" value="<?=$gNO?>" style=" width:205px; border: 1px solid #C0C0C0"/>	</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">LAMPIRAN</td>
    <td align="center">&nbsp;</td>
    <td><div id="desMstCri" class="find0Cri">
		<div id="desDiv1Cri" class="find1Cri"></div>
		<div id="desDiv2Cri" class="find2Cri"></div>
	</div>	
      <input name="fLAM" id="fLAM" type="text" value="<?=$gLAM?>" style="text-align:center; width:20px; border: 1px solid #C0C0C0"/> BERKAS</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">PERIHAL</td>
    <td align="center">&nbsp;</td>
    <td><input name="fPER" type="text" value="<?=$gPER?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">KEPADA YTH </td>
    <td align="center">&nbsp;</td>
    <td rowspan="2">
	<input name="fKPD" type="text" value="<?=$gKPD?>" style=" width:450px; border: 1px solid #C0C0C0"/>	</td>
    </tr>
  <tr height="5">
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td width="4" valign="top">&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">UNIT KERJA </td>
    <td align="center">&nbsp;</td>
    <td>
	<input name="fUNT" id="fUNT" type="hidden" value="<?=$gUNT?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" <? if ($IdT=='' && $Lev <= 1) {?> onClick="showUNIT('','unit','','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','unit','','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" <? } else {echo "readonly";}?> style="padding-left:5px; width:450px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="find0Cri">
		<div id="unitDiv1Cri" class="find1Cri"></div>
		<div id="unitDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">KE UNIT KERJA </td>
    <td align="center">&nbsp;</td>
    <td>
	<input name="fUNT2" id="fUNT2" type="hidden" value="<?=$gUNT2?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
	<input name="dUNT2" id="dUNT2" type="text" value="<?=$dUNT2?>" onClick="showUNIT('','unik','2','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','unik','2','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unik'); return false;}" style="padding-left:5px; width:450px; border: 1px solid #C0C0C0"/>
	<div id="unikMstCri" class="find0Cri">
		<div id="unikDiv1Cri" class="find1Cri"></div>
		<div id="unikDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">SEBAB</td>
    <td align="center">&nbsp;</td>
    <td><input name="fSBB" type="text" value="<?=$gSBB?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">KEPALA SKPD</td>
    <td class="ac">&nbsp;</td>
    <td><input name="fNMA" type="text" value="<?=$dNMA?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">JABATAN</td>
    <td class="ac">&nbsp;</td>
    <td><input name="fJAB" type="text" value="<?=$dJAB?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">NIP</td>
    <td class="ac">&nbsp;</td>
    <td><input name="fNIP" type="text" value="<?=$dNIP?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    </tr>
  <tr height="30">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:750px; height:30px; background: #EAE6E6">
  <tr>
    <td width="5">&nbsp;</td>
    <td width="687">
	<input type="button" name="B39" <?=$DisA?> value="SAVE" onclick="Save('<?=$ReO?>')" style="width: 80px; height: 21px" />
    <input type="button" name="B10" value="RESET" onclick="Reset()" style="width: 80px; height: 21px" />
	&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="button" name="B14" <? if ($IdT=="") {echo "disabled";}?> value="CETAK" onclick="P_Dokumen('800','400','<?=$IdT?>','<?=$_GET['IdL']?>')" style="width: 120px; height: 21px; color:#0000FF" />	</td>
    </tr>
</table>
</form>
</body>
</html>
<script languange="javascript">
	var objfrm=document.myfrm;
	
	function showUNIT(CrT,div,fr,IdL)
	{
		if (CrT=='find')
		{
			FnD = ReplaceText($("#dUNT"+fr).val());
			
			$(document).ready(function()
			{
				$("#"+div+"Div2Cri").load('Surat_permohonan_mutasi_frm_find_unit_mid.php?gFnD='+FnD+'&div='+div+'&IdL='+IdL);
			});
		}
		else
		{
			 if (div=='unit') {document.getElementById('unikMstCri').style.display = "none";}
			
			document.getElementById(div+'Div2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#"+div+"Div1Cri").load('Surat_permohonan_mutasi_frm_find_unit_top.php?div='+div+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#"+div+"Div2Cri").load('Surat_permohonan_mutasi_frm_find_unit_mid.php?div='+div+'&IdL='+IdL);
			});
			
			if (document.getElementById(div+'MstCri').style.display == "block")
			{
				document.getElementById(div+'MstCri').style.display = "none";
			}
			else
			{
				document.getElementById(div+'MstCri').style.display = "block";
			}
		}
	}
	
	function showDATA(CrT,IdT,FrmG,IdL)
	{
		
		gUnt = objfrm.fUNT.value;
		FrmG = ReplaceText(FrmG);
		if (CrT=='find')
		{
			gFnD = ReplaceText(objfrm.fFindA.value);
			$(document).ready(function()
			{
				$("#tranDiv2Cri").load('Surat_permohonan_mutasi_frm_data_mid.php?gFnD='+gFnD+'&gUnt='+gUnt+'&FrmG='+FrmG+'&IdL='+IdL);
			});
		}
		else
		{
			document.getElementById('tranDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#tranDiv1Cri").load('Surat_permohonan_mutasi_frm_data_top.php?FrmG='+FrmG+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#tranDiv2Cri").load('Surat_permohonan_mutasi_frm_data_mid.php?gUnt='+gUnt+'&FrmG='+FrmG+'&IdL='+IdL);
			});
			
			if (document.getElementById('tranMstCri').style.display == "block")
			{
				document.getElementById('tranMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('tranMstCri').style.display = "block";
			}
		}
	}
	
	function showCLICK(crt,mesg,refs,kde,nma,NmP,NiP,JbP,IdL)
	{
		if (crt=='unit') 
		{
			objfrm.fUNT.value = kde;
			objfrm.dUNT.value = nma;
			
			objfrm.fNMA.value = NmP;
			objfrm.fNIP.value = NiP;
			objfrm.fJAB.value = JbP;
		}
		if (crt=='unik') 
		{
			objfrm.fUNT2.value = kde;
			objfrm.dUNT2.value = nma;
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
	
	function Save(ReO)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (objfrm.fUNT2.value=='') {alert('Silakan pilih UNIT KERJA TUJUAN...!!'); return false;}
		objfrm.fSave.value='Save';
		objfrm.submit();
	}
	
	function Reset()
	{
		objfrm.fSave.value='Reset';
		objfrm.submit();
	}
	
	function P_Dokumen(w,h,IdT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='Surat_permohonan_mutasi_frm_data_dok.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function showLINK(IdT,FrmG,IdL)
	{
		URL='Surat_permohonan_mutasi_frm.php?IdT='+IdT+'&FrmG='+FrmG+'&IdL='+IdL;
		window.open(URL,'MidFrame','');
	}
	
</script>