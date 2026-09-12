<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
#$Lev = 2;
#echo $AsT;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="global.js"></script>
</head>
<?
extract($_GET);
#echo $AsT;
$gUNT = substr($SkP,0,11);
$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");

$gSUB = substr($SkP,0,14);
$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
#$gSUB = "00.00.00.00.00";
#$dSUB = "ALL";

$gUPB = substr($SkP,0,18);
$dUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
#$gUPB = "00.00.00.00.00.000";
#$dUPB = "ALL";

$gHR = fGetDate('mday');
$gBL = fGetDate('mon');
$gTH = fGetDate('year');
?>
<body onload="RefreshDATA('<?=$AsT?>','<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" id="myfrm" method="POST" enctype="multipart/form-data">
<input type="hidden" name="fA" id="fA" value="0" readonly style="width:50px"/>
<input type="hidden" name="fB" id="fB" value="0" readonly style="width:50px"/>

<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px; height:24px; background: #EAE6E6">
  <tr>
    <td width="30" align="center"><img src="css/images/bukk.png" /></td>
    <td style="font-weight:bold">LAPORAN HASIL INVENTARISASI</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px; color:#fff; background:#79a86a">
  <tr>
    <td width="91">&nbsp;</td>
    <td width="23">&nbsp;</td>
    <td colspan="9">&nbsp;</td>
  </tr>
  <tr height="23">
    <td class="ar">Unit Kerja  </td>
    <td align="center">:</td>
    <td colspan="9">
	<input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:3px; width:105px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" readonly <? if ($Lev <= 1) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" <? } else {echo "readonly";}?> style="padding-left:3px; width:450px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="Unit0Cri">
		<div id="unitDiv1Cri" class="Unit1Cri"></div>
		<div id="unitDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
  </tr>
  <tr height="23">
    <td align="right">Sub Unit </td>
    <td align="center">:</td>
    <td colspan="9">
	<input name="fSUB" id="fSUB" type="text" value="<?=$gSUB?>" readonly style="padding-left:3px; width:105px; border: 1px solid #C0C0C0"/>
    <input name="dSUB" id="dSUB" type="text" value="<?=$dSUB?>" <? if ($Lev <= 2) {?> onclick="showSUB('','<?=$_GET['IdL']?>')" <? } else {echo "readonly";}?> style="padding-left:3px; width:450px; border: 1px solid #C0C0C0"/>
	<div id="subMstCri" class="Unit0Cri">
		<div id="subDiv1Cri" class="Unit1Cri"></div>
		<div id="subDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
  </tr>
  <tr height="23">
    <td align="right">UPB</td>
    <td align="center">:</td>
    <td colspan="9">
	<input name="fUPB" id="fUPB" type="text" value="<?=$gUPB?>" readonly style="padding-left:3px; width:105px; border: 1px solid #C0C0C0"/>
	<input name="dUPB" id="dUPB" type="text" value="<?=$dUPB?>" <? if ($Lev <= 2) {?> onClick="showUPB('','<?=$_GET['IdL']?>')" <? } else {echo "readonly";}?> style="padding-left:3px; width:450px; border: 1px solid #C0C0C0"/>
	<div id="upbMstCri" class="Unit0Cri">
		<div id="upbDiv1Cri" class="Unit1Cri"></div>
		<div id="upbDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
  </tr>
  <tr height="23">
    <td align="right">Aset</td>
    <td align="center">:</td>
    <td width="217"><select class="boxs" name="AsT" id="AsT" tabindex="0" style="width:205px">
      <option value="0.0.0">ALL</option>
      <option value="1.3.1">TANAH</option>
      <option value="1.3.2">PERALATAN DAN MESIN</option>
      <option value="1.3.3">GEDUNG DAN BANGUNAN</option>
      <option value="1.3.4">JALAN, JARINGAN DAN IRIGASI</option>
      <option value="1.3.5">ASET TETAP LAINNYA</option>
      <option value="1.5.3">ASET TIDAK BERWUJUD</option>
      <option value="1.5.4">ASET LAIN-LAIN</option>
    </select></td>
    <td width="90" rowspan="2" align="right" style="font-weight:bold; color:#0000FF">Kondisi Sebelum Inventarisasi </td>
    <td width="22" rowspan="2" align="center">:</td>
    <td width="70"><label><input type="radio" name="fKondisiAwal" id="fKondisiAwal" value="00" checked />All</label></td>
    <td width="129"><label><input type="radio" name="fKondisiAwal" id="fKondisiAwal" value="RR" />Rusak Ringan (RR)</label></td>
    <td width="90" rowspan="2" align="right" style="font-weight:bold; color:#0000FF">Kondisi Sesudah Inventarisasi </td>
    <td width="20" rowspan="2" align="center">:</td>
    <td width="70"><label><input type="radio" name="fKondisiAkhir" id="fKondisiAkhir" value="00" checked />All</label></td>
    <td><label><input type="radio" name="fKondisiAkhir" id="fKondisiAkhir" value="RR" />Rusak Ringan (RR)</label></td>
  </tr>
  <tr height="23">
    <td align="right">Tgl. Cetak</td>
    <td align="center">:</td>
    <td>
	<select class="boxs" name="fHR" id="fHR" tabindex="0" style="width:45px">
	<option value="00"></option>
	<?
	for($i=1; $i<=31; $i++)
	{
		$sel ="";
		if ($i==$gHR) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select>
	<select class="boxs" name="fBL" id="fBL" tabindex="0" style="width:95px">
	<option value="00"></option>
  	<?
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBL) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTH" id="fTH" style="width: 60px" tabindex="0">
	<option value="0000"></option>
  	<?
	for($i=2020; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select>	</td>
    <td><label><input type="radio" name="fKondisiAwal" id="fKondisiAwal" value="B" />Baik (B)</label></td>
    <td><label><input type="radio" name="fKondisiAwal" id="fKondisiAwal" value="RB" />Rusak Berat(RB)</label></td>
    <td><label><input type="radio" name="fKondisiAkhir" id="fKondisiAkhir" value="B" />Baik (B)</label></td>
    <td><label><input type="radio" name="fKondisiAkhir" id="fKondisiAkhir" value="RB" />Rusak Berat (RB)</label></td>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px">
  <tr height="10">
    <td width="34" valign="top"></td>
    <td width="764" valign="top"></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top"><a href="#" class="ico docu" onclick="OpenReport('Report_LHI_III_B_1','800','400','<?=$IdL?>'); return false;">&nbsp;&nbsp;&nbsp;LHI (III.B.1) - Rekapitulasi BMD Hilang Karena Kecurian</a></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top"><a href="#" class="ico docu" onclick="OpenReport('Report_LHI_III_B_2','800','400','<?=$IdL?>'); return false;">&nbsp;&nbsp;&nbsp;LHI (III.B.2) - Rekapitulasi BMD Tidak Ada Karena Tidak Ditemukan</a></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top"><a href="#" class="ico docu" onclick="OpenReport('Report_LHI_III_B_3','800','400','<?=$IdL?>'); return false;">&nbsp;&nbsp;&nbsp;LHI (III.B.3) - Rekapitulasi BMD Belum Dikapitalisasi dan Diketahui Data Awal/Data Induknya</a></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top"><a href="#" class="ico docu" onclick="OpenReport('Report_LHI_III_B_4','800','400','<?=$IdL?>'); return false;">&nbsp;&nbsp;&nbsp;LHI (III.B.4) - Rekapitulasi BMD Belum Dikapitalisasi dan <i>Tidak</i> Diketahui Data Awal/Data Induknya</a></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top"><a href="#" class="ico docu" onclick="OpenReport('Report_LHI_III_B_5','800','400','<?=$IdL?>'); return false;">&nbsp;&nbsp;&nbsp;LHI (III.B.5) - Rekapitulasi BMD Dalam Digunakan Oleh Pegawai Pemerintah Daerah Yang Bersangkutan</a></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top"><a href="#" class="ico docu" onclick="OpenReport('Report_LHI_III_B_6','800','400','<?=$IdL?>'); return false;">&nbsp;&nbsp;&nbsp;LHI (III.B.6) - Rekapitulasi BMD Dalam Digunakan Oleh Pemerintah Pusat/Pemerintah Daerah Lainnya/Pihak Lain</a></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top"><a href="#" class="ico docu" onclick="OpenReport('Report_LHI_III_B_7','800','400','<?=$IdL?>'); return false;">&nbsp;&nbsp;&nbsp;LHI (III.B.7) - Rekapitulasi BMD Terjadi Perubahan Kondisi Fisik Barang</a></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top"><a href="#" class="ico docu" onclick="OpenReport('Report_LHI_III_B_8','800','400','<?=$IdL?>'); return false;">&nbsp;&nbsp;&nbsp;LHI (III.B.8) - Rekapitulasi BMD Terkait Perubahan Data</a></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top"><a href="#" class="ico docu" onclick="OpenReport('Report_LHI_III_B_9','800','400','<?=$IdL?>'); return false;">&nbsp;&nbsp;&nbsp;LHI (III.B.9) - Rekapitulasi BMD Tercatat Ganda</a></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top"><a href="#" class="ico docu" onclick="OpenReport('Report_LHI_III_B_10','800','400','<?=$IdL?>'); return false;">&nbsp;&nbsp;&nbsp;LHI (III.B.10) - Rekapitulasi BMD Berdiri Diatas Tanah Bukan Milik Pemerintah Daerah</a></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top"><a href="#" class="ico docu" onclick="OpenReport('Report_LHI_III_B_11','800','400','<?=$IdL?>'); return false;">&nbsp;&nbsp;&nbsp;LHI (III.B.11) - Rekapitulasi BMD Belum Tercatat</a></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top"><a href="#" class="ico docu" onclick="OpenReport('Report_LHI_III_B_12','800','400','<?=$IdL?>'); return false;">&nbsp;&nbsp;&nbsp;LHI (III.B.12) - Rekapitulasi BMD <i>Tidak</i> Terjadi Perubahan Kondisi Fisik Barang</a></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top"><a href="#" class="ico docu" onclick="OpenReport('Report_LHI_III_B_13','800','400','<?=$IdL?>'); return false;">&nbsp;&nbsp;&nbsp;LHI (III.B.13) - Rekapitulasi BMD Kondisi Akhir Fisik Barang Sesudah Inventarisasi**</a></td>
  </tr>
  <tr height="24">
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<script languange="javascript">
	objfrm = document.myfrm;
	function showUNIT(CrT,IdL)
	{
		Rpt = 'Y';
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findUnT").val());
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('Lembar_Kerja_Frm_Find_Unit_Mid.php?FnD='+FnD+'&Rpt='+Rpt+'&IdL='+IdL);
			});
		}
		else
		{
			dispNO('subMstCri');
			dispNO('upbMstCri');
			dispBLOCK('unitDiv2Cri');
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('Lembar_Kerja_Frm_Find_Unit_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('Lembar_Kerja_Frm_Find_Unit_Mid.php?Rpt='+Rpt+'&IdL='+IdL);
			});
			
			dispBlockOrNo('unitMstCri');
		}
	}
	
	function showSUB(CrT,IdL)
	{
		fUNT  = $("#fUNT").val();
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findSuB").val());
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('Lembar_Kerja_Frm_Find_Sub_Mid.php?FnD='+FnD+'&gUNT='+fUNT+'&IdL='+IdL);
			});
		}
		else
		{
			if (fUNT=='00.00.00.00') {alert('Silahkan pilih Unit terlebih dahulu..!!'); return false;}
			dispNO('upbMstCri');
			dispBLOCK('subDiv2Cri');
			$(document).ready(function()
			{
				$("#subDiv1Cri").load('Lembar_Kerja_Frm_Find_Sub_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('Lembar_Kerja_Frm_Find_Sub_Mid.php?gUNT='+fUNT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('subMstCri');
		}
	}
	
	function showUPB(CrT,IdL)
	{
		fSUB  = $("#fSUB").val();
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findUpB").val());
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('Lembar_Kerja_Frm_Find_Upb_Mid.php?FnD='+FnD+'&gSUB='+fSUB+'&IdL='+IdL);
			});
		}
		else
		{
			if (fSUB=='00.00.00.00.00') {alert('Silahkan pilih Sub Unit terlebih dahulu..!!'); return false;}
			dispBLOCK('upbDiv2Cri');
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('Lembar_Kerja_Frm_Find_Upb_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('Lembar_Kerja_Frm_Find_Upb_Mid.php?gSUB='+fSUB+'&IdL='+IdL);
			});
			
			dispBlockOrNo('upbMstCri');
		}
	}
	
	function showCLICK(crt,kde,nma,IdL)
	{
		if (crt=='unit') 
		{
			$("#fUNT").val(kde);
			$("#dUNT").val(nma);
		
			$("#fSUB").val('00.00.00.00.00');
			$("#dSUB").val('ALL');
			
			$("#fUPB").val('00.00.00.00.00.000');
			$("#dUPB").val('ALL');
		}
		if (crt=='sub') 
		{
			$("#fSUB").val(kde);
			$("#dSUB").val(nma);
			
			$("#fUPB").val('00.00.00.00.00.000');
			$("#dUPB").val('ALL');
		}
		if (crt=='upb') 
		{
			$("#fUPB").val(kde);
			$("#dUPB").val(nma);
		}
		dispNO(crt+'MstCri');
		
	}
	
	function closeCLICK(crt)
	{
		document.getElementById(crt+'MstCri').style.display = "none";
	}	
	
	function OpenReport(doc,w,h,IdL)
	{
		fUnt = $("#fUNT").val();
		if ((doc=='Report_LHI_III_B_12' || doc=='Report_LHI_III_B_13') && fUnt=='00.00.00.00') {alert('Silahkan pilih Unit terlebih dahulu..!!'); return false;}
		
		fUpb = $("#fUPB").val();
		fSub = $("#fSUB").val();
		
		fAsT = $("#AsT").val();
		
		fHR  = $("#fHR").val();
		fBL  = $("#fBL").val();
		fTH  = $("#fTH").val();
		
		fKoNA = "";
		Len  = myfrm.fKondisiAwal.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fKondisiAwal[i].checked) 
			{
				fKoNA = objfrm.fKondisiAwal[i].value; break;
			}
		}
		
		fKoNB = "";
		Len  = myfrm.fKondisiAkhir.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fKondisiAkhir[i].checked) 
			{
				fKoNB = objfrm.fKondisiAkhir[i].value; break;
			}
		}
		
		if ((doc=='Report_LHI_III_B_11' || doc=='Report_LHI_III_B_12') && fKoNA!=fKoNB)
		{
			alert('Pilihan Kondisi Fisik harus diseragamkan sebelum dan sesudah inventarisasi untuk dokumen ini..!!'); return false;
		}
		LeftPosition=(screen.width)?(screen.width-800)/2:100; 
		TopPosition=(screen.height)?(screen.height-400)/2:100;
		
		URL = 'report/'+doc+'.php?doc='+doc+'&fKoNA='+fKoNA+'&fKoNB='+fKoNB+'&fHR='+fHR+'&fBL='+fBL+'&fTH='+fTH+'&fAsT='+fAsT+'&fUpb='+fUpb+'&fSub='+fSub+'&fUnt='+fUnt+'&IdL='+IdL;
		window.open(URL,'WinDOC'+doc+fAsT+fKoNA+fKoNB,'toolbar=no,menubar=yes, top='+TopPosition+',left='+LeftPosition+' location=no, scrollbars=yes, resizable, width=800, height='+400);
	}
</script>