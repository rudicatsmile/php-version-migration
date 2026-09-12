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
$gJNS= $fJNS;
$gTH = $fTH;
if ($gTH==''){$gTH = fGetDate('year');}

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
	$SkP = "24.04.08.01";
	$gUNT = substr($SkP,0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	$gSUB = "";//substr($SkP,0,14);
	$dSUB = "";//fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
	$gUPB = "";//substr($SkP,0,18);
	$dUPB = "";//fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
}

$Cap = "DAFTAR";
$fRef = "BOS.".fGetDate('year').".XXXXX";
$fNom = "XXXXX/BOS/BARSEL/".fGetDate('year');
$fTgl = fGetDate('year')."-".fGetDate('mon')."-".fGetDate('mday');
if ($IdT)
{
	$Cap = "UPDATE";
	$nSQL= "SELECT Referensi, Nomor, Tanggal, Kd_UPB, Nama, NIP, Jabatan, NoHP, Email FROM ta_sp3d_pendaftaran WHERE IDT='$IdT'";
	#echo $nSQL;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	
	
	$gUNT = substr($mRo[3],0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	
	$gSUB = substr($mRo[3],0,14);
	$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
	
	$gUPB = substr($mRo[3],0,18);
	$dUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
	
	$fRef = $mRo[0];
	$fNom = $mRo[1];
	$fTgl = $mRo[2];
	$fNma = $mRo[4];
	$fNip = $mRo[5];
	$fJab = $mRo[6];
	$fNoh = $mRo[7];
	$fEma = $mRo[8];
}

?>
<body onload="RefreshDATA('<?=$IdL?>','0')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="SP3D_Pelatihan_Frm_.php?IdT=".$IdT."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>" enctype="multipart/form-data">
<input type="hidden" name="fSave" style="width:20px" />
<input type="hidden" name="fCrT" style="width:20px" />
<input type="hidden" name="fIdT" style="width:20px" />
<!--table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:700px; height:30px; background: #EAE6E6">
<tr>
  <td width="5">&nbsp;</td>
</tr>
</table-->
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:700px">
  <tr height="40">
    <td width="7">&nbsp;</td>
    <td width="97">
	<div id="findupbMstCri" class="findupb0Cri">
		<div id="findupbDiv1Cri" class="findupb1Cri"></div>
		<div id="findupbDiv2Cri" class="findupb2Cri"></div>
	</div>	</td>
    <td width="36">&nbsp;</td>
    <td width="558">
	<div id="asetMstCri" class="findrekn0Cri">
		<div id="asetDiv1Cri" class="findrekn1Cri"></div>
		<div id="asetDiv2Cri" class="findrekn2Cri"></div>
	</div>	</td>
  </tr>
  <tr height="30">
    <td>&nbsp;</td>
    <td class="ar">Referensi</td>
    <td align="center">:</td>
    <td>
	<input name="fRef" id="fRef" type="text" value="<?=$fRef?>" readonly style="width:100px; border: 1px solid #C0C0C0; background:#ccc"/>
	</td>
  </tr>
  <tr height="30">
    <td>&nbsp;</td>
    <td class="ar">Nomor / Tanggal</td>
    <td align="center">:</td>
    <td>
	<input name="fNom" id="fNom" type="text" value="<?=$fNom?>" readonly style="width:150px; border: 1px solid #C0C0C0; background:#ccc"/>
	<input name="fTgl" id="fTgl" type="text" value="<?=$fTgl?>" readonly style="text-align:center; width:70px; border: 1px solid #C0C0C0; background:#ccc"/>
	</td>
  </tr>
  <tr height="30">
    <td>&nbsp;</td>
    <td class="ar">UNIT KERJA </td>
    <td align="center">:</td>
    <td>
	<input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" id="dUNT" type="text" readonly value="<?=$dUNT?>" <?php if (!$IdTx) {?> onclick="showUNITx('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:320px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="find0Cri">
		<div id="unitDiv1Cri" class="find1Cri"></div>
		<div id="unitDiv2Cri" class="find2Cri"></div>
	</div>	</td>
  </tr>
  <tr height="30">
    <td>&nbsp;</td>
    <td class="ar">SUB UNIT </td>
    <td align="center">:</td>
    <td>
	<input name="fSUB" id="fSUB" type="text" value="<?=$gSUB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dSUB" id="dSUB" type="text" value="<?=$dSUB?>" <?php if (!$IdTx) {?> onclick="showSUB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showSUB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('sub'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:320px; border: 1px solid #C0C0C0"/>
	<div id="subMstCri" class="find0Cri">
		<div id="subDiv1Cri" class="find1Cri"></div>
		<div id="subDiv2Cri" class="find2Cri"></div>
	</div>	</td>
  </tr>
  <tr height="30">
    <td>&nbsp;</td>
    <td class="ar">UPB / SEKOLAH</td>
    <td align="center">:</td>
    <td>
	<input name="fUPB" id="fUPB" type="text" value="<?=$gUPB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUPB" id="dUPB" type="text" value="<?=$dUPB?>" <?php if (!$IdTx) {?> onclick="showUPB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showUPB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('upb'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:291px; border: 1px solid #C0C0C0"/>
	<input type="button" name="B13" value="..." <?php if (!$IdT) {?> onclick="findUPB('','<?=$_GET['IdL']?>')" <?php } ?> style="width: 27px; height:21px; background:#FF9900" />
	<div id="upbMstCri" class="find0Cri">
		<div id="upbDiv1Cri" class="find1Cri"></div>
		<div id="upbDiv2Cri" class="find2Cri"></div>
	</div>	</td>
  </tr>
  <tr height="30">
    <td>&nbsp;</td>
    <td class="ar">NAMA LENGKAP </td>
    <td align="center">:</td>
    <td><input name="fNma" id="fNma" type="text" value="<?=$fNma?>" style=" width:300px; border: 1px solid #C0C0C0"/> *</td>
  </tr>
  <tr height="30">
    <td>&nbsp;</td>
    <td class="ar">N I P</td>
    <td align="center">:</td>
    <td><input name="fNip" id="fNip" type="text" value="<?=$fNip?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="30">
    <td>&nbsp;</td>
    <td class="ar">JABATAN</td>
    <td align="center">:</td>
    <td><input name="fJab" id="fJab" type="text" value="<?=$fJab?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="30">
    <td>&nbsp;</td>
    <td class="ar">NO HP / NO WA </td>
    <td align="center">:</td>
    <td><input name="fNoh" id="fNoh" type="text" value="<?=$fNoh?>" style=" width:300px; border: 1px solid #C0C0C0"/> *</td>
  </tr>
  <tr height="30">
    <td>&nbsp;</td>
    <td class="ar">E-MAIL (Jika Ada) </td>
    <td align="center">:</td>
    <td><input name="fEma" id="fEma" type="text" value="<?=$fEma?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="50">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="color:#FF0000; font-weight:bold">
	<?php
	if ($mESG=="tINSERT"){
		echo "Pendaftaran berhasil, nomor pendaftaran $fNom";
	}
	if ($mESG=="tUPDATE"){
		echo "Update data pendaftaran berhasil";
	}
	?>
	</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:700px; height:30px; background: #EAE6E6">
  <tr>
    <td width="5">&nbsp;</td>
    <td>
	<input type="button" name="B39" <?=$DisA?> value="<?=$Cap?>" onclick="Save()" style="width:120px; height: 21px" />
    <input type="button" name="B10" value="RESET" onclick="Reset()" style="width:120px; height: 21px" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="<?="SP3D_Pelatihan.php?FrmG=DANA BOS -> LIST DATA PENDAFTARAN CALON PESERTA PELATIHAN&IdL=".$_GET['IdL']?>" class="ico spj">LIST DATA</a>
    </td>
    <td width="5">&nbsp;</td>
  </tr>
</table>
<br>
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
			document.getElementById('subMstCri').style.display = "none";
			document.getElementById('upbMstCri').style.display = "none";
			
			document.getElementById('unitDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('SP3D_Frm_Find_Unit_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('SP3D_Frm_Find_Unit_Mid.php?IdL='+gIdL);
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
			document.getElementById('upbMstCri').style.display = "none";
			
			if (!fUNT) {alert('Silahkan pilih Unit Kerja terlebih dahulu..!!'); return false;}
			document.getElementById('subDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#subDiv1Cri").load('SP3D_Frm_Find_Sub_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('SP3D_Frm_Find_Sub_Mid.php?gUNT='+fUNT+'&IdL='+gIdL);
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
			if (!fSUB) {alert('Silahkan pilih Sub Unit terlebih dahulu..!!'); return false;}
			document.getElementById('upbDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('SP3D_Frm_Find_Upb_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('SP3D_Frm_Find_Upb_Mid.php?gSUB='+fSUB+'&IdL='+gIdL);
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
		$("#dUPB").select();
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
		
		if (crt=='addrekn') 
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('SP3D_Frm_Find_ReknP90_Add.php?IdT='+kde+'&rIdT='+nma+'&IdL='+IdL);
				
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
		if (objfrm.fUPB.value=='') {alert('Silakan pilih UPB / SEKOLAH...!!'); return false;}
		if (objfrm.fNma.value=='') {alert('Silakan isi nama lengkap...!!'); return false;}
		if (objfrm.fNoh.value=='') {alert('Silakan isi nomor HP / Nomor WA...!!'); return false;}
		
		objfrm.fSave.value='Save';
		objfrm.submit();
	}
	
	function Reset()
	{
		objfrm.fSave.value='Reset';
		objfrm.submit();
	}
	
	function findUPB(CrT,IdL)
	{
		if (CrT=='find'){
			FnD = ReplaceText($("#fFindUPB").val());
			$(document).ready(function()
			{
				$("#findupbDiv2Cri").load('SP3D_Pelatihan_Frm_Find_All_Upb_Mid.php?FnD='+FnD+'&IdL='+IdL);
			});
		}
		else
		{
			//globalClose('spjMstCri');
			dispBLOCK('findupbDiv1Cri');
			dispBLOCK('findupbDiv2Cri');
			
			$(document).ready(function()
			{
				$("#findupbDiv1Cri").load('SP3D_Pelatihan_Frm_Find_All_Upb_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#findupbDiv2Cri").load('SP3D_Pelatihan_Frm_Find_All_Upb_Mid.php?IdL='+IdL);
			});
			
			dispBlockOrNo('findupbMstCri');
		}
	
	}	
</script>