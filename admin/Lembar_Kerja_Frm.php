<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
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
<?php
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

$gROB = "0.0.0.00.00";
$gSRO = "0.0.0.00.00.00";
$gSSR = "0.0.0.00.00.00.000";

$dROB = "ALL";
$dSRO = "ALL";
$dSSR = "ALL";

?>
<body onload="RefreshDATA('<?=$AsT?>','<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" id="myfrm" method="POST" enctype="multipart/form-data">
<input type="hidden" name="fA" id="fA" value="0" readonly style="width:50px"/>
<input type="hidden" name="fB" id="fB" value="0" readonly style="width:50px"/>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; color:#fff; background:#79a86a">
  <tr height="8">
    <td width="60"></td>
    <td width="13"></td>
    <td width="123"></td>
    <td width="323">
	<div id="lembMstCri" class="lmbrkerja0Cri">
		<div id="lembDiv1Cri" class="lmbrkerja1Cri"></div>
		<div id="lembDiv2Cri" class="lmbrkerja2Cri"></div>
	</div>	
	<div id="mapsMstCri" class="maps0Cri">
		<div id="mapsDiv1Cri" class="maps1Cri"></div>
		<div id="mapsDiv2Cri" class="maps2Cri"></div>
	</div>	
	<div id="newfMstCri" class="newfkerja0Cri">
		<div id="newfDiv1Cri" class="newfkerja1Cri"></div>
		<div id="newfDiv2Cri" class="newfkerja2Cri"></div>
	</div>	</td>
    <td width="45">
	</td>
    <td width="75">&nbsp;</td>
    <td width="11"></td>
    <td width="420"></td>
    <td width="45"></td>
    <td width="12"></td>
    <td width="144"></td>
    <td></td>
  </tr>
  <tr height="23">
    <td class="ar">Unit Kerja  </td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:3px; width:105px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" readonly <?php if ($Lev <= 1) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" <?php } else {echo "readonly";}?> style="padding-left:3px; width:350px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="Unit0Cri">
		<div id="unitDiv1Cri" class="Unit1Cri"></div>
		<div id="unitDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td align="right">Rincian Objek </td>
    <td align="right">&nbsp;</td>
    <td>
	<input name="fROB" id="fROB" type="text" value="<?=$gROB?>" readonly style="padding-left:3px; width:103px; border: 1px solid #C0C0C0"/>
	<input name="dROB" id="dROB" type="text" value="<?=$dROB?>" readonly onClick="showROBJ('','<?=$AsT?>','<?=$_GET['IdL']?>')" style="padding-left:3px; width:300px; border: 1px solid #C0C0C0"/>
	<div id="robjMstCri" class="Unit0Cri">
		<div id="robjDiv1Cri" class="Unit1Cri"></div>
		<div id="robjDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td align="right">Data</td>
    <td align="center">&nbsp;</td>
    <td>
	<select name="fExT" id="fExT" tabindex="0" style="width:100px; font-size:9pt; background:#FFFFFF; border:1px solid #999999" onChange="BtnGO.click()">
	<?php
	echo '<option value="%">All</option>';
	echo '<option selected value="N">Aset</option>';
	echo '<option value="Y">Extracom</option>';
	?>
	</select>	</td>
    <td><div id="loadingImg" style="width:40px; height:10px; display:none"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
    </tr>
  <tr height="23">
    <td align="right">Sub Unit </td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<input name="fSUB" id="fSUB" type="text" value="<?=$gSUB?>" readonly style="padding-left:3px; width:105px; border: 1px solid #C0C0C0"/>
    <input name="dSUB" id="dSUB" type="text" value="<?=$dSUB?>" <?php if ($Lev <= 2) {?> onclick="showSUB('','<?=$_GET['IdL']?>')" <?php } else {echo "readonly";}?> style="padding-left:3px; width:350px; border: 1px solid #C0C0C0"/>
	<div id="subMstCri" class="Unit0Cri">
		<div id="subDiv1Cri" class="Unit1Cri"></div>
		<div id="subDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td align="right">Sub R. Objek </td>
    <td align="right">&nbsp;</td>
    <td>
	<input name="fSRO" id="fSRO" type="text" value="<?=$gSRO?>" readonly style="padding-left:3px; width:103px; border: 1px solid #C0C0C0"/>
	<input name="dSRO" id="dSRO" type="text" value="<?=$dSRO?>" readonly onClick="showSROB('','<?=$_GET['IdL']?>')" style="padding-left:3px; width:300px; border: 1px solid #C0C0C0"/>
	<div id="srobMstCri" class="Unit0Cri">
		<div id="srobDiv1Cri" class="Unit1Cri"></div>
		<div id="srobDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td align="right">Tampil</td>
    <td align="center">&nbsp;</td>
    <td>
	<select name="fPaG" id="fPaG" tabindex="0" style="width:100px; font-size:9pt; background:#FFFFFF; border:1px solid #999999" onChange="changePAGE('<?=$AsT?>','<?=$IdL?>')">
	<?php
	echo '<option selected value="100">100 Record</option>';
	echo '<option value="200">200 Record</option>';
	echo '<option value="300">300 Record</option>';
	echo '<option value="400">400 Record</option>';
	echo '<option value="500">500 Record</option>';
	?>
	</select>	</td>
    <td>&nbsp;</td>
    </tr>
  <tr height="23">
    <td align="right">UPB</td>
    <td align="center">&nbsp;</td>
    <td colspan="2">
	<input name="fUPB" id="fUPB" type="text" value="<?=$gUPB?>" readonly style="padding-left:3px; width:105px; border: 1px solid #C0C0C0"/>
	<input name="dUPB" id="dUPB" type="text" value="<?=$dUPB?>" <?php if ($Lev <= 3) {?> onClick="showUPB('','<?=$_GET['IdL']?>')" <?php } else {echo "readonly";}?> style="padding-left:3px; width:320px; border: 1px solid #C0C0C0"/>
	<div id="upbMstCri" class="Unit0Cri">
		<div id="upbDiv1Cri" class="Unit1Cri"></div>
		<div id="upbDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td><input type="button" name="BtnFN" id="BtnFN" value="..." <?php if ($Lev <= 1) {?> onclick="cariUPB('','<?=$IdL?>')" <?php } else {echo "disabled";}?> style="width:26px; height:22px" /></td>
    <td align="right">Sub Sub ROBJ </td>
    <td align="right">&nbsp;</td>
    <td>
	<input name="fSSR" id="fSSR" type="text" value="<?=$gSSR?>" readonly style="padding-left:3px; width:103px; border: 1px solid #C0C0C0"/>
	<input name="dSSR" id="dSSR" type="text" value="<?=$dSSR?>" readonly onClick="showSSRO('','<?=$_GET['IdL']?>')" style="padding-left:3px; width:300px; border: 1px solid #C0C0C0"/>
	<div id="ssroMstCri" class="Unit0Cri">
		<div id="ssroDiv1Cri" class="Unit1Cri"></div>
		<div id="ssroDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td align="right">Cari</td>
    <td align="center">&nbsp;</td>
    <td><input type="text" name="fFinM" id="fFinM" placeholder='Search' onkeypress="if (event.keyCode==13){findDATA('<?=$AsT?>','<?=$IdL?>');}" style="width:135px" /></td>
    <td><input type="button" name="BtnGO" id="BtnGO" value="GO" onclick="findDATA('<?=$AsT?>','<?=$IdL?>')" style="width:30px; height: 21px" /></td>
    </tr>
  <tr height="8">
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #CEFBE3; font-weight:bold">
  <?php if ($AsT=='x.x.x'){?>
  <tr style="text-align:center">
    <td width="39" style="border-right:1px solid #ccc">No</td>
    <td width="101" style="border-right:1px solid #ccc">Referensi</td>
    <td width="101" style="border-right:1px solid #ccc">Kode</td>
    <td width="56" style="border-right:1px solid #ccc">Register</td>
    <td width="207" style="border-right:1px solid #ccc">Nama Aset</td>
    <td width="76" style="border-right:1px solid #ccc">Perolehan</td>
    <td width="333" style="border-right:1px solid #ccc">Uraian</td>
    <td width="43" style="border-right:1px solid #ccc">Jumlah</td>
    <td width="107" style="border-right:1px solid #ccc">Harga Satuan</td>
    <td width="107" style="border-right:1px solid #ccc">Nilai Perolehan</td>
    <td>Action</td>
  </tr>
  <?php } else {?>
  <tr style="text-align:center">
    <td width="39" style="border-right:1px solid #ccc">No</td>
    <td width="101" style="border-right:1px solid #ccc">Referensi</td>
    <td width="101" style="border-right:1px solid #ccc">Kode</td>
    <td width="56" style="border-right:1px solid #ccc">Register</td>
    <td width="207" style="border-right:1px solid #ccc">Nama Aset</td>
    <td width="76" style="border-right:1px solid #ccc">Perolehan</td>
    <td width="306" style="border-right:1px solid #ccc">Uraian</td>
    <td width="107" style="border-right:1px solid #ccc">Harga</td>
    <td width="107" style="border-right:1px solid #ccc">Nilai Akhir</td>
    <td width="43" style="border-right:1px solid #ccc">Sensus</td>
    <td width="63" style="border-right:1px solid #ccc">Fisik</td>
    <td width="50" style="border-right:1px solid #ccc">Foto</td>
    <td width="50" style="border-right:1px solid #ccc">Dok</td>
    <td>Action</td>
  </tr>
  <?php } ?>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:300px; overflow:auto; border:0px"></div>
	<div id="ViewDATA" style="height:340px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td valign="top">
	<div id="ViewPAGE" style="height:50px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
</form>
</body>
</html>
<script languange="javascript">
	objfrm=document.myfrm;
	
	function findDATA(AsT,IdL)
	{
		$("#fA").val('0');
		$("#fB").val('0');
		RefreshDATA(AsT,IdL)
	}
	
	function changePAGE(AsT,IdL)
	{
		$("#fA").val('0');
		$("#fB").val('0');
		RefreshDATA(AsT,IdL)
	}
	
	function pageDATA(xA,xB,AsT,IdL)
	{
		$("#fA").val(xA);
		$("#fB").val(xB);
		
		RefreshDATA(AsT,IdL)
	}
	
	function RefreshDATA(AsT,IdL)
	{
		//alert(AsT);
		PerPage = $("#fPaG").val();
		
		PagA = $("#fA").val();
		PagB = $("#fB").val();
		
		FnD = ReplaceText($("#fFinM").val());
		UnT = ReplaceText($("#fUNT").val());
		SuB = ReplaceText($("#fSUB").val());
		UpB = ReplaceText($("#fUPB").val());
		
		RoB = ReplaceText($("#fROB").val());
		SrO = ReplaceText($("#fSRO").val());
		SsR = ReplaceText($("#fSSR").val());
		
		ExT = $("#fExT").val();
		
		FiLoad='Lembar_Kerja_Frm_Data.php';
		if (AsT=='x.x.x')
		{
			FiLoad='Lembar_Kerja_Frm_Data_New.php';
		}
		$(document).ready(function()
		{
			$.ajax({
				url:FiLoad,
				data: {PerPage:PerPage,PagA:PagA,PagB:PagB,FnD:FnD,UnT:UnT,SuB:SuB,UpB:UpB,RoB:RoB,SrO:SrO,SsR:SsR,AsT:AsT,ExT:ExT,IdL:IdL},
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
			$("#ViewPAGE").load('Lembar_Kerja_Frm_Data_Pages.php?PerPage='+PerPage+'&PagA='+PagA+'&PagB='+PagB+'&UnT='+UnT+'&SuB='+SuB+'&UpB='+UpB+'&RoB='+RoB+'&SrO='+SrO+'&SsR='+SsR+'&AsT='+AsT+'&FnD='+FnD+'&ExT='+ExT+'&IdL='+IdL);
		});
	}	

	function showUNIT(CrT,IdL)
	{
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findUnT").val());
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('Lembar_Kerja_Frm_Find_Unit_Mid.php?FnD='+FnD+'&IdL='+IdL);
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
				$("#unitDiv2Cri").load('Lembar_Kerja_Frm_Find_Unit_Mid.php?IdL='+IdL);
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
	
	function showROBJ(CrT,AsT,IdL)
	{
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findROBJ").val());
			$(document).ready(function()
			{
				$("#robjDiv2Cri").load('Lembar_Kerja_Frm_Find_Robj_Mid.php?FnD='+FnD+'&AsT='+AsT+'&IdL='+IdL);
			});
		}
		else
		{
			dispNO('srobMstCri');
			dispNO('ssroMstCri');
			dispBLOCK('robjDiv2Cri');
			$(document).ready(function()
			{
				$("#robjDiv1Cri").load('Lembar_Kerja_Frm_Find_Robj_Top.php?AsT='+AsT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#robjDiv2Cri").load('Lembar_Kerja_Frm_Find_Robj_Mid.php?AsT='+AsT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('robjMstCri');
		}
	}
	
	function showSROB(CrT,IdL)
	{
		MsT = $("#fROB").val();
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findSROB").val());
			$(document).ready(function()
			{
				$("#srobDiv2Cri").load('Lembar_Kerja_Frm_Find_Srob_Mid.php?FnD='+FnD+'&MsT='+MsT+'&IdL='+IdL);
			});
		}
		else
		{
			if (MsT=='0.0.0.00.00') {alert('Silahkan pilih rincian objek terlebih dahulu..!!'); return false;}
			dispNO('ssroMstCri');
			dispBLOCK('srobDiv2Cri');
			$(document).ready(function()
			{
				$("#srobDiv1Cri").load('Lembar_Kerja_Frm_Find_Srob_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#srobDiv2Cri").load('Lembar_Kerja_Frm_Find_Srob_Mid.php?MsT='+MsT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('srobMstCri');
		}
	}
	
	function showSSRO(CrT,IdL)
	{
		MsT = $("#fSRO").val();
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findSSRO").val());
			$(document).ready(function()
			{
				$("#ssroDiv2Cri").load('Lembar_Kerja_Frm_Find_Ssro_Mid.php?FnD='+FnD+'&MsT='+MsT+'&IdL='+IdL);
			});
		}
		else
		{
			if (MsT=='0.0.0.00.00.00') {alert('Silahkan pilih sub rincian objek terlebih dahulu..!!'); return false;}
			dispBLOCK('ssroDiv2Cri');
			$(document).ready(function()
			{
				$("#ssroDiv1Cri").load('Lembar_Kerja_Frm_Find_Ssro_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#ssroDiv2Cri").load('Lembar_Kerja_Frm_Find_Ssro_Mid.php?MsT='+MsT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('ssroMstCri');
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
		
		if (crt=='upb_cr') 
		{
			$("#fUPB").val(kde);
			$("#dUPB").val(nma);
			crt = crt.substr(0,3);
			leavejson(kde,IdL);
		}
		
		if (crt=='robj') 
		{
			$("#fROB").val(kde);
			$("#dROB").val(nma);
			
			$("#fSRO").val('0.0.0.00.00.00');
			$("#dSRO").val('ALL');
			
			$("#fSSR").val('0.0.0.00.00.00.000');
			$("#dSSR").val('ALL');
		}
		if (crt=='srob') 
		{
			$("#fSRO").val(kde);
			$("#dSRO").val(nma);
			
			$("#fSSR").val('0.0.0.00.00.00.000');
			$("#dSSR").val('ALL');
		}
		if (crt=='ssro') 
		{
			$("#fSSR").val(kde);
			$("#dSSR").val(nma);
		}
		document.getElementById(crt+'MstCri').style.display = "none";
		
		$("#BtnGO").click();
	}
	
	function closeCLICK(crt)
	{
		document.getElementById(crt+'MstCri').style.display = "none";
	}

	function showLKI(CrT,AsT,ReO,IdT,IdL)
	{
		if (CrT=='refr')
		{
			$(document).ready(function()
			{
				$("#lembDiv2Cri").load('Lembar_Kerja_Frm_Data_LKI_Mid_'+AsT+'.php?IdT='+IdT+'&AsT='+AsT+'&ReO='+ReO+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('lembDiv2Cri');
			$(document).ready(function()
			{
				$("#lembDiv1Cri").load('Lembar_Kerja_Frm_Data_LKI_Top.php?AsT='+AsT+'&IdT='+IdT+'&AsT='+AsT+'&ReO='+ReO+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#lembDiv2Cri").load('Lembar_Kerja_Frm_Data_LKI_Mid_'+AsT+'.php?IdT='+IdT+'&AsT='+AsT+'&ReO='+ReO+'&IdL='+IdL);
			});
			
			dispBlockOrNo('lembMstCri');
		}
	}
	
	function saveDATA(crt,val,frm,TbL,IdT,SnsIDT,AsT,ReO,IdL)
	{
		if (frm=='Y'){
			val = ReplaceText(val.value);
		}
		
		$(document).ready(function()
		{
			$.ajax({
				url:"Lembar_Kerja_Frm_Data_LKI_Save.php",
				data: {fld:crt,val:val,frm:frm,IdT:IdT,TbL:TbL,SnsIDT:SnsIDT,AsT:AsT,ReO:ReO,IdL:IdL},
				type:"get",
				beforeSend:function()
				{
					$("#loadingImg").show();
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#ViewDELL").html(data);
					$("#ViewDELL").show("fast");
					//$("#lembDiv2Cri").html(data);
					//$("#lembDiv2Cri").show("fast");
				}
			});
		})
	}
	
	function P_Upload(CrT,AsT,SnsIDT,ReO,IdT,IdL)
	{
		
		if (CrT=='Img') 
		{
			if (objfrm.imgfile.value=="")
			{
				alert('Silahkan pilih file terlebih dahulu..!!');
				return false;
			}
			spl = objfrm.imgfile.value.split('.');
		}
		else
		{
			if (objfrm.imgfile2.value=="")
			{
				alert('Silahkan pilih file terlebih dahulu..!!');
				return false;
			}
			spl = objfrm.imgfile2.value.split('.');
		}
		Ext = spl[1].toLowerCase();
		
		if (CrT=='Pdf') {
			if (Ext!='pdf') {alert('File yang anda pilih bukan file pdf....!!'); return false;}
		}
		
		if (CrT=='Img') {
			if (Ext!='jpg' && Ext!='jpeg' && Ext!='png' && Ext!='bmp' && Ext!='gif') {alert('File yang di perbolehkan hanya (ext: jpg, jpeg, png, bmp, gif)....!!'); return false;}
		}
		
		if (CrT=='Img') 
		{
			//imgfile = objfrm.imgfile.value;
		}
		else
		{
			//imgfile = objfrm.imgfile2.value;
		}
        form = $('#myfrm')[0];
        data = new FormData(form);
		
		$(document).ready(function()
		{
			$.ajax({
				url:'Lembar_Kerja_Frm_Img_Upload.php?CrT='+CrT+'&SnsIDT='+SnsIDT+'&AsT='+AsT+'&ReO='+ReO+'&IdT='+IdT+'&IdL='+IdL,
				type:'post',
				enctype: 'multipart/form-data',
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				beforeSend:function()
				{
					$("#loadingImg").show();
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#ViewDELL").html(data);
					$("#ViewDELL").show("fast");
					
					//$("#ViewDATA").html(data);
					//$("#ViewDATA").show("fast");
				}
			});
		})
	}

	function remoIMG(CrT,AsT,Tbl,ReO,rIdT,IdT,IdL)
	{
		AN = confirm('Remove image..?');
		if (!AN){return false;}
		$(document).ready(function()
		{
			$.ajax({
				url:"Lembar_Kerja_Frm_Img_Remove"+Tbl+".php",
				data: {CrT:CrT,rIdT:rIdT,IdT:IdT,AsT:AsT,ReO:ReO,IdL:IdL},
				type:"get",
				beforeSend:function()
				{
					$("#loadingImg").show();
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#ViewDELL").html(data);
					$("#ViewDELL").show("fast");
					//$("#lembDiv2Cri").html(data);
					//$("#lembDiv2Cri").show("fast");
				}
			});
		})
	}

	function viewIMG(CrT,rIdT,Tbl,w,h,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='Lembar_Kerja_Frm_Img_View'+Tbl+'.php?CrT='+CrT+'&rIdT='+rIdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open(URL,'',settings);
	}
	
	function showPetugas(CrT,fld,AsT,SnsIDT,ReO,IdT,IdL)
	{
		//alert(fld+':'+AsT+':'+SnsIDT+':'+ReO+':'+IdT+':'+IdL);
		
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findPeT").val());
			$(document).ready(function()
			{
				$("#petuDiv2Cri").load('Lembar_Kerja_Frm_Find_Petu_Mid.php?FnD='+FnD+'&fld='+fld+'&AsT='+AsT+'&ReO='+ReO+'&SnsIDT='+SnsIDT+'&IdT='+IdT+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('petuDiv2Cri');
			$(document).ready(function()
			{
				$("#petuDiv1Cri").load('Lembar_Kerja_Frm_Find_Petu_Top.php?fld='+fld+'&AsT='+AsT+'&ReO='+ReO+'&SnsIDT='+SnsIDT+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#petuDiv2Cri").load('Lembar_Kerja_Frm_Find_Petu_Mid.php?fld='+fld+'&AsT='+AsT+'&ReO='+ReO+'&SnsIDT='+SnsIDT+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('petuMstCri');
		}
	}	
	
	function showPetugasChoise(div,gKd,fld,AsT,ReO,SnsIDT,IdT,IdL)
	{
		$(document).ready(function()
		{
			$.ajax(
			{
				url:"Lembar_Kerja_Frm_Find_Petu_Save.php",
				data: {gKd:gKd,fld:fld,AsT:AsT,ReO:ReO,SnsIDT:SnsIDT,IdT:IdT,IdL:IdL},
				type:"get",
				beforeSend:function()
				{
					$("#loadingImg").show();
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#ViewDELL").html(data);
					$("#ViewDELL").show("fast");
					//$("#lembDiv2Cri").html(data);
					//$("#lembDiv2Cri").show("fast");
				}
			});
		})
		
		globalClose('petuMstCri');
		
	}
	
	function NewAset(CrT,ReO,IdT,IdL)
	{
		fUPB = $("#fUPB").val();
		if (IdT=='' && fUPB=='00.00.00.00.00.000'){alert('Silahkan pilih UPB..!!'); return false;}
		
		if (CrT=='refr')
		{
			$(document).ready(function()
			{
				$("#newfDiv2Cri").load('Lembar_Kerja_Frm_Data_New_Mid.php?ReO='+ReO+'&IdT='+IdT+'&IdL='+IdL);
			});
		}
		else if (CrT=='reset')
		{
			$(document).ready(function()
			{
				$("#newfDiv2Cri").load('Lembar_Kerja_Frm_Data_New_Mid.php?ReO='+ReO+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('newfDiv2Cri');
			$(document).ready(function()
			{
				$("#newfDiv1Cri").load('Lembar_Kerja_Frm_Data_New_Top.php?ReO='+ReO+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#newfDiv2Cri").load('Lembar_Kerja_Frm_Data_New_Mid.php?ReO='+ReO+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('newfMstCri');
		}
	}	
	
	function P_LoadKd(CrT,ReO,IdT,IdL)
	{
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findRekN").val());
			$(document).ready(function()
			{
				$("#loadDiv2Cri").load('Lembar_Kerja_Frm_Data_New_Mid_Find_Mid.php?FnD='+FnD+'&ReO='+ReO+'&IdT='+IdT+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('loadDiv2Cri');
			$(document).ready(function()
			{
				$("#loadDiv1Cri").load('Lembar_Kerja_Frm_Data_New_Mid_Find_Top.php?ReO='+ReO+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#loadDiv2Cri").load('Lembar_Kerja_Frm_Data_New_Mid_Find_Mid.php?ReO='+ReO+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('loadMstCri');
		}
	}
	
	function closeCLICK(CrT,gKd,gNm,ReO,IdT,IdL)
	{
		$("#frmKode").val(gKd);
		$("#frmNama").val(gNm);
		$("#frmSpec").val(gNm);
		dispBlockOrNo('loadMstCri');
	}
	
	function P_SaveNewAset(ReO,IdT,IdL)
	{
		fUPB = $("#fUPB").val();
		fKdE = $("#frmKode").val();
		
		fNmA = ReplaceText($("#frmNama").val());
		fNmS = ReplaceText($("#frmSpec").val());
		fReG = ReplaceText($("#frmRegi").val());
		fMeR = ReplaceText($("#frmMerk").val());
		fTyP = ReplaceText($("#frmType").val());
		
		fPoL = ReplaceText($("#frmNopo").val());
		fRaN = ReplaceText($("#frmNora").val());
		fMeS = ReplaceText($("#frmNome").val());
		
		fJmL = ReplaceText($("#frmJumb").val());
		fSaT = ReplaceText($("#frmSatu").val());
		fHaR = ReplaceText($("#frmHarg").val());
		fNiL = ReplaceText($("#frmNila").val());
		
		fHrI = ReplaceText($("#frmHari").val());
		fBlN = ReplaceText($("#frmBula").val());
		fThN = ReplaceText($("#frmTahu").val());
		
		fAlM = ReplaceText($("#frmAlam").val());
		fDaS = ReplaceText($("#frmDasa").val());
		
		fLaI = ReplaceText($("#frmLain").val());
		fKeT = ReplaceText($("#frmKetr").val());
		
		fKoN = "";
		Len = objfrm.radioKon.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.radioKon[i].checked) {fKoN = objfrm.radioKon[i].value; break; }
		}
		
		//if (fUPB=='00.00.00.00.00.000'){alert('Silahkan pilih UPB..!!'); return false;}
		if (fKdE==''){alert('Silahkan pilih kode barang terlebih dahulu..!!'); return false;}
		$(document).ready(function()
		{
			$.ajax(
			{
				url:"Lembar_Kerja_Frm_Data_New_Mid_Find_Save.php",
				data: {fUPB:fUPB,fKdE:fKdE,fNmA:fNmA,fNmS:fNmS,fReG:fReG,fTyP:fTyP,fMeR:fMeR,fPoL:fPoL,fRaN:fRaN,fMeS:fMeS,fJmL:fJmL,fSaT:fSaT,fHaR:fHaR,fNiL:fNiL,fHrI:fHrI,fBlN:fBlN,fThN:fThN,fAlM:fAlM,fDaS:fDaS,fKoN:fKoN,fLaI:fLaI,fKeT:fKeT,ReO:ReO,IdT:IdT,IdL:IdL},
				type:"get",
				beforeSend:function()
				{
					$("#loadingImg").show();
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#ViewDELL").html(data);
					$("#ViewDELL").show("fast");
					//$("#newfDiv2Cri").html(data);
					//$("#newfDiv2Cri").show("fast");
				}
			});
		})
	}
	
	function P_UploadAstNew(CrT,ReO,IdT,IdL)
	{
		if (IdT==''){alert('Data belum disimpan...!!'); return false;}
		
		if (CrT=='Img'){
			if (objfrm.imgfile.value=="")
			{
				alert('Silahkan pilih file terlebih dahulu..!!');
				return false;
			}
			
			spl = objfrm.imgfile.value.split('.');
			Ext = spl[1].toLowerCase();
			
			if (Ext!='jpg' && Ext!='jpeg' && Ext!='png' && Ext!='bmp' && Ext!='gif') 
			{
				alert('File yang di perbolehkan hanya (ext: jpg, jpeg, png, bmp, gif)....!!'); return false;
			}
		}
		else
		{
			if (objfrm.imgfile2.value=="")
			{
				alert('Silahkan pilih file terlebih dahulu..!!');
				return false;
			}
			
			spl = objfrm.imgfile2.value.split('.');
			Ext = spl[1].toLowerCase();
			
			if (Ext!='pdf') 
			{
				alert('File yang di perbolehkan hanya (ext: pdf)....!!'); return false;
			}
		}
		
        form = $('#myfrm')[0];
        data = new FormData(form);
		
		$(document).ready(function()
		{
			$.ajax(
			{
				url:'Lembar_Kerja_Frm_Data_New_Mid_Img_Upload.php?CrT='+CrT+'&ReO='+ReO+'&IdT='+IdT+'&IdL='+IdL,
				type:'post',
				enctype: 'multipart/form-data',
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				beforeSend:function()
				{
					$("#loadingImg").show();
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#ViewDELL").html(data);
					$("#ViewDELL").show("fast");
				}
			});
		})
	}	
	
	function viewIMGnewAst(CrT,rIdT,w,h,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='Lembar_Kerja_Frm_Data_New_Mid_Img_View.php?CrT='+CrT+'&rIdT='+rIdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open(URL,'',settings);
	}
	
	function remoIMGnewAst(CrT,ReO,rIdT,IdT,IdL)
	{
		AN = confirm('Remove image..?');
		if (!AN){return false;}
		$(document).ready(function()
		{
			$.ajax({
				url:"Lembar_Kerja_Frm_Data_New_Mid_Img_Remove.php",
				data: {CrT:CrT,rIdT:rIdT,IdT:IdT,ReO:ReO,IdL:IdL},
				type:"get",
				beforeSend:function()
				{
					$("#loadingImg").show();
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#ViewDELL").html(data);
					$("#ViewDELL").show("fast");
					//$("#lembDiv2Cri").html(data);
					//$("#lembDiv2Cri").show("fast");
				}
			});
		})
	}
	
	function showPetugasNewAset(CrT,fld,ReO,IdT,IdL)
	{
		if (IdT==''){alert('Data belum disimpan...!!'); return false;}
		
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findPeTU").val());
			$(document).ready(function()
			{
				$("#petu2Div2Cri").load('Lembar_Kerja_Frm_Data_New_Mid_Find_Petu_Mid.php?FnD='+FnD+'&fld='+fld+'&ReO='+ReO+'&IdT='+IdT+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('petu2Div2Cri');
			$(document).ready(function()
			{
				$("#petu2Div1Cri").load('Lembar_Kerja_Frm_Data_New_Mid_Find_Petu_Top.php?fld='+fld+'&ReO='+ReO+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#petu2Div2Cri").load('Lembar_Kerja_Frm_Data_New_Mid_Find_Petu_Mid.php?fld='+fld+'&ReO='+ReO+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('petu2MstCri');
		}
	}	
	
	function showPetugasChoiseNewAset(div,gKd,fld,ReO,IdT,IdL)
	{
		$(document).ready(function()
		{
			$.ajax(
			{
				url:"Lembar_Kerja_Frm_Data_New_Mid_Find_Petu_Save.php",
				data: {gKd:gKd,fld:fld,ReO:ReO,IdT:IdT,IdL:IdL},
				type:"get",
				beforeSend:function()
				{
					$("#loadingImg").show();
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#ViewDELL").html(data);
					$("#ViewDELL").show("fast");
				}
			});
		})
		
		globalClose('petu2MstCri');
		
	}
	
	function saveDATANewAset(crt,val,IdT,ReO,IdL)
	{
		if (IdT==''){alert('Data belum disimpan...!!'); return false;}
		
		val = ReplaceText(val.value);
		$(document).ready(function()
		{
			$.ajax({
				url:"Lembar_Kerja_Frm_Data_New_Mid_Save.php",
				data: {fld:crt,val:val,IdT:IdT,ReO:ReO,IdL:IdL},
				type:"get",
				beforeSend:function()
				{
					$("#loadingImg").show();
					
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#ViewDELL").html(data);
					$("#ViewDELL").show("fast");
				}
			});
		})
	}	
	
	function NewAsetDelete(ReO,IdT,IdL)
	{
		AN = confirm('Delete data?');
		if (!AN){return false;}
		
		$(document).ready(function()
		{
			$.ajax({
				url:"Lembar_Kerja_Frm_Data_New_Mid_Dell.php",
				data: {IdT:IdT,ReO:ReO,IdL:IdL},
				type:"get",
				beforeSend:function()
				{
					$("#loadingImg").show();
					
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#ViewDELL").html(data);
					$("#ViewDELL").show("fast");
				}
			});
		})
	}
	
	function formCetakDok(CrT,IdT,w,h,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= 'report/'+CrT+'.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open(URL,'',settings);
	}
	
	function cariUPB(CrT,IdL)
	{
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findUpBA").val());
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('Lembar_Kerja_Frm_Find_Upb_Mid_All.php?FnD='+FnD+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('upbDiv2Cri');
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('Lembar_Kerja_Frm_Find_Upb_Top_All.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('Lembar_Kerja_Frm_Find_Upb_Mid_All.php?IdL='+IdL);
			});
			
			dispBlockOrNo('upbMstCri');
		}
	}
	
	function leavejson(kde,IdL)
	{
		$(document).ready(function()
		{
			//alert('xx');
			$.post("Lembar_Kerja_Frm_Find_Upb_Mid_All_Json.php",
			{"kde":kde,"IdL":IdL},
			function( data ) 
			{
				//alert(data['kdUnt']);
				$("#fUNT").val(data['kdUnt']);
				$("#dUNT").val(data['nmUnt']);
				
				$("#fSUB").val(data['kdSub']);
				$("#dSUB").val(data['nmSub']);
			},"json");
		});		
	}
	
	
	function showMAPS(ref,upb,rfg,IdL)
	{
		dispBLOCK('mapsDiv2Cri');
		$(document).ready(function()
		{
			$("#mapsDiv1Cri").load('Lembar_Kerja_Frm_Data_LKI_Map_Top.php?ref='+ref+'&upb='+upb+'&rfg='+rfg+'&IdL='+IdL);
		});
		
		$(document).ready(function()
		{
			$("#mapsDiv2Cri").load('Lembar_Kerja_Frm_Data_LKI_Map_Mid.php?ref='+ref+'&upb='+upb+'&rfg='+rfg+'&IdL='+IdL);
		});
		
		dispBlockOrNo('mapsMstCri');
	}
</script>