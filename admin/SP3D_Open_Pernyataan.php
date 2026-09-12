<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
$gTH = fGetDate('year');
$gBL = fGetDate('mon');
$gHR = fGetDate('mday');
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
?>
<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST">
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:670px">
  <tr height="30">
    <td width="3">&nbsp;</td>
    <td width="107">
	<div id="findupbMstCri" class="findupb0Cri">
		<div id="findupbDiv1Cri" class="findupb1Cri"></div>
		<div id="findupbDiv2Cri" class="findupb2Cri"></div>
	</div>	</td>
    <td width="29">&nbsp;</td>
    <td>
	<div id="asetMstCri" class="findrekn0Cri">
		<div id="asetDiv1Cri" class="findrekn1Cri"></div>
		<div id="asetDiv2Cri" class="findrekn2Cri"></div>
	</div>	</td>
    </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">UNIT KERJA </td>
    <td align="center">:</td>
    <td>
	<input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" <?php if (!$IdT) {?> onclick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:320px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="find0Cri">
		<div id="unitDiv1Cri" class="find1Cri"></div>
		<div id="unitDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">SUB UNIT </td>
    <td align="center">:</td>
    <td>
	<input name="fSUB" id="fSUB" type="text" value="<?=$gSUB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dSUB" id="dSUB" type="text" value="<?=$dSUB?>" <?php if (!$IdT) {?> onclick="showSUB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showSUB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('sub'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:320px; border: 1px solid #C0C0C0"/>
	<div id="subMstCri" class="find0Cri">
		<div id="subDiv1Cri" class="find1Cri"></div>
		<div id="subDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">UPB</td>
    <td align="center">:</td>
    <td>
	<input name="fUPB" id="fUPB" type="text" value="<?=$gUPB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUPB" id="dUPB" type="text" value="<?=$dUPB?>" <?php if (!$IdT) {?> onclick="showUPB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showUPB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('upb'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:291px; border: 1px solid #C0C0C0"/>
	<input type="button" name="B13" value="..." <?php if (!$IdT) {?> onclick="findUPB('','<?=$_GET['IdL']?>')" <?php } ?> style="width: 27px; height:21px" />
	<div id="upbMstCri" class="find0Cri">
		<div id="upbDiv1Cri" class="find1Cri"></div>
		<div id="upbDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">TAHUN</td>
    <td align="center">:</td>
    <td>
	<select class="boxs" name="fTH" id="fTH" style="width:60px" tabindex="0">
	<?php
	for($i=2019; $i<=2030; $i++)
	{
		$sel ="";
		if ($i==$gTH) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select></td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">JENIS BOS </td>
    <td align="center">&nbsp;</td>
    <td>
	<select class="boxs" name="fJNS" id="fJNS" tabindex="0" style="width:120px">
	<option value="1">Reguler</option>
	<option value="2">Afirmasi</option>
	<option value="3">Kinerja</option>
	</select></td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">SEMESTER</td>
    <td align="center">:</td>
    <td>
	<select class="boxs" name="fSMS" id="fSMS" tabindex="0" style="width:120px">
	<option value="I">Semester I</option>
	<option value="II">Semester II</option>
    </select></td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">NOMOR SURAT </td>
    <td align="center">&nbsp;</td>
    <td><input name="fNoM" id="fNoM" type="text" value="<?=$dSES?>" style="width:204px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">TGL. CETAK</td>
    <td align="center">:</td>
    <td>
	<select class="boxs" name="eHR" id="eHR" tabindex="0" style="width:50px">
      <?php
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gHR) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="eBL" id="eBL" tabindex="0" style="width:95px">
	<?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBL) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="eTH" id="eTH" style="width:60px" tabindex="0">
      <?php
	for($i=2014; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select>	</td>
  </tr>
  <tr height="20px">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="20px">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="B11" value="OPEN" onclick="P_Dokumen('800','400','<?=$IdL?>')" style="width: 80px; height: 21px" /></td>
  </tr>
  <tr height="50px">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:670px; height:30px; background: #EAE6E6">
  <tr>
    <td width="5">&nbsp;</td>
    <td></td>
    <td width="5">&nbsp;</td>
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
	
	function P_Dokumen(w,h,IdL)
	{
		fTH = $("#fTH").val();
		UpB = $("#fUPB").val();
		SmS = $("#fSMS").val();
		NoM = ReplaceText($("#fNoM").val());
		JnS = $("#fJNS").val();
		
		eHR = $("#eHR").val();
		eBL = $("#eBL").val();
		eTH = $("#eTH").val();
		
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='SP3D_Open_Pernyataan_Dok.php?NoM='+NoM+'&eHR='+eHR+'&eBL='+eBL+'&eTH='+eTH+'&fTH='+fTH+'&UpB='+UpB+'&SmS='+SmS+'&JnS='+JnS+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function findUPB(CrT,IdL)
	{
		if (CrT=='find'){
			FnD = ReplaceText($("#fFindUPB").val());
			$(document).ready(function()
			{
				$("#findupbDiv2Cri").load('SP3D_Open_Pernyataan_Find_All_Upb_Mid.php?FnD='+FnD+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('findupbDiv1Cri');
			dispBLOCK('findupbDiv2Cri');
			
			$(document).ready(function()
			{
				$("#findupbDiv1Cri").load('SP3D_Open_Pernyataan_Find_All_Upb_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#findupbDiv2Cri").load('SP3D_Open_Pernyataan_Find_All_Upb_Mid.php?IdL='+IdL);
			});
			
			dispBlockOrNo('findupbMstCri');
		}
	}
</script>