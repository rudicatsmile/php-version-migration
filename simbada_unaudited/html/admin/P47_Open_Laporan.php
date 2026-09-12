<?
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

#$gROB = "0.0.0.00.00";
#$gSRO = "0.0.0.00.00.00";
#$gSSR = "0.0.0.00.00.00.000";

#$dROB = "ALL";
#$dSRO = "ALL";
#$dSSR = "ALL";

if ($model=='L1'){
	$Txt="LAPORAN BMD";
	$Fil="P47_Laporan_BMD";
}
else if ($model=='L2'){
	$Txt="LAPORAN PEROLEHAN BMD";
	$Fil="P47_Laporan_Perolehan_BMD";
}
else if ($model=='L3'){
	$Txt="LAPORAN PENERIMAAN INTERNAL BMD";
	$Fil="P47_Laporan_Penerimaan_Internal_BMD";
}
else if ($model=='L4'){
	$Txt="LAPORAN PENGELUARAN INTERNAL BMD";
	$Fil="P47_Laporan_Pengeluaran_Internal_BMD";
}
else if ($model=='L5'){
	$Txt="LAPORAN KOREKSI BMD";
	$Fil="P47_Laporan_Koreksi_BMD";
}
else if ($model=='L6'){
	$Txt="LAPORAN PENGHAPUSAN BMD";
	$Fil="P47_Laporan_Penghapusan_BMD";
}
else if ($model=='L7'){
	$Txt="LAPORAN PENYUSUTAN BMD";
	$Fil="P47_Laporan_Penyusutan_BMD";
}
else if ($model=='L8'){
	$Txt="LAPORAN PENAMBAHAN AKIBAT REKLAS";
	$Fil="P47_Laporan_Penambahan_Akibat_Reklas_BMD";
}
else if ($model=='L9'){
	$Txt="LAPORAN PENGURANGAN AKIBAT REKLAS";
	$Fil="P47_Laporan_Pengurangan_Akibat_Reklas_BMD";
}
?>
<body>
<?php require "FileMenu.php";?>
<form name="myfrm" id="myfrm" method="POST" enctype="multipart/form-data">
<br><br>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:800px; color:#fff; background:#79a86a">
  <tr height="8">
    <td width="100">&nbsp;</td>
    <td width="15"></td>
    <td width="177"></td>
    <td width="366">
	<!--div id="lembMstCri" class="lmbrkerja0Cri">
		<div id="lembDiv1Cri" class="lmbrkerja1Cri"></div>
		<div id="lembDiv2Cri" class="lmbrkerja2Cri"></div>
	</div-->	
	<!--div id="mapsMstCri" class="maps0Cri">
		<div id="mapsDiv1Cri" class="maps1Cri"></div>
		<div id="mapsDiv2Cri" class="maps2Cri"></div>
	</div-->	</td>
    <td width="40"></td>
    <td></td>
    </tr>
  <tr height="23">
    <td class="ar">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    </tr>
  <tr height="23">
    <td class="ar">Unit Kerja  </td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:3px; width:105px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" readonly <? if ($Lev <= 1) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" <? } else {echo "readonly";}?> style="padding-left:3px; width:450px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="Unit0Cri">
		<div id="unitDiv1Cri" class="Unit1Cri"></div>
		<div id="unitDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
    </tr>
  <tr height="23">
    <td align="right">Sub Unit </td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<input name="fSUB" id="fSUB" type="text" value="<?=$gSUB?>" readonly style="padding-left:3px; width:105px; border: 1px solid #C0C0C0"/>
    <input name="dSUB" id="dSUB" type="text" value="<?=$dSUB?>" <? if ($Lev <= 2) {?> onclick="showSUB('','<?=$_GET['IdL']?>')" <? } else {echo "readonly";}?> style="padding-left:3px; width:450px; border: 1px solid #C0C0C0"/>
	<div id="subMstCri" class="Unit0Cri">
		<div id="subDiv1Cri" class="Unit1Cri"></div>
		<div id="subDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
    </tr>
  <tr height="23">
    <td align="right">UPB</td>
    <td align="center">&nbsp;</td>
    <td colspan="2">
	<input name="fUPB" id="fUPB" type="text" value="<?=$gUPB?>" readonly style="padding-left:3px; width:105px; border: 1px solid #C0C0C0"/>
	<input name="dUPB" id="dUPB" type="text" value="<?=$dUPB?>" <? if ($Lev <= 2) {?> onClick="showUPB('','<?=$_GET['IdL']?>')" <? } else {echo "readonly";}?> style="padding-left:3px; width:420px; border: 1px solid #C0C0C0"/>
	<div id="upbMstCri" class="Unit0Cri">
		<div id="upbDiv1Cri" class="Unit1Cri"></div>
		<div id="upbDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td><input type="button" name="BtnFN" id="BtnFN" value="..." <? if ($Lev <= 1) {?> onclick="cariUPB('','<?=$IdL?>')" <? } else {echo "disabled";}?> style="width:29px; height:22px" /></td>
    <td align="right">&nbsp;</td>
    </tr>
  <tr height="8">
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr height="24">
    <td align="right">Semester</td>
    <td></td>
    <td>
	<select name="fExT" id="fExT" tabindex="0" style="width:100px; height:22px; font-size:9pt">
      <?
	echo '<option selected value="I">Semester I</option>';
	echo '<option value="II">Semester II</option>';
	?>
    </select>	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr height="24">
    <td align="right">Tahun</td>
    <td></td>
    <td>
	<select class="boxs" name="fThn" id="fThn" style="width:60px; text-align:center" tabindex="0">
	<?
		for($iG=2020; $iG<=date('Y'); $iG++)
		{
			$sel ="";
			if ($gThn==$iG) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$iG.'</option>';
		}
	?>
	</select>
	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    </tr>
  <tr height="8">
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    </tr>
  <tr height="8">
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:800px">
  <tr height="25">
    <td width="72">&nbsp;</td>
    <td width="435">&nbsp;</td>
    <td width="291">&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td><a href="#" class="ico open" onclick="formCetakDok('<?=$Fil?>','800','400','<?=$_GET['IdL']?>'); return false;">&nbsp;&nbsp;<?=$Txt?></a></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<script languange="javascript">
	objfrm=document.myfrm;
	function showUNIT(CrT,IdL)
	{
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findUnT").val());
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('P47_Open_Laporan_Find_Unit_Mid.php?FnD='+FnD+'&IdL='+IdL);
			});
		}
		else
		{
			dispNO('subMstCri');
			dispNO('upbMstCri');
			dispBLOCK('unitDiv2Cri');
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('P47_Open_Laporan_Find_Unit_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('P47_Open_Laporan_Find_Unit_Mid.php?IdL='+IdL);
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
				$("#subDiv2Cri").load('P47_Open_Laporan_Find_Sub_Mid.php?FnD='+FnD+'&gUNT='+fUNT+'&IdL='+IdL);
			});
		}
		else
		{
			dispNO('upbMstCri');
			dispBLOCK('subDiv2Cri');
			$(document).ready(function()
			{
				$("#subDiv1Cri").load('P47_Open_Laporan_Find_Sub_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('P47_Open_Laporan_Find_Sub_Mid.php?gUNT='+fUNT+'&IdL='+IdL);
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
				$("#upbDiv2Cri").load('P47_Open_Laporan_Find_Upb_Mid.php?FnD='+FnD+'&gSUB='+fSUB+'&IdL='+IdL);
			});
		}
		else
		{
			if (fSUB=='00.00.00.00.00') {alert('Silahkan pilih Sub Unit terlebih dahulu..!!'); return false;}
			dispBLOCK('upbDiv2Cri');
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('P47_Open_Laporan_Find_Upb_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('P47_Open_Laporan_Find_Upb_Mid.php?gSUB='+fSUB+'&IdL='+IdL);
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
		
		if (crt=='upb_cr') 
		{
			$("#fUPB").val(kde);
			$("#dUPB").val(nma);
			crt = crt.substr(0,3);
			leavejson(kde,IdL);
		}
		document.getElementById(crt+'MstCri').style.display = "none";
		
		$("#BtnGO").click();
	}
	
	function closeCLICK(crt)
	{
		document.getElementById(crt+'MstCri').style.display = "none";
	}
	
	function cariUPB(CrT,IdL)
	{
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findUpBA").val());
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('P47_Open_Laporan_Find_Upb_Mid_All.php?FnD='+FnD+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('upbDiv2Cri');
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('P47_Open_Laporan_Find_Upb_Top_All.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('P47_Open_Laporan_Find_Upb_Mid_All.php?IdL='+IdL);
			});
			
			dispBlockOrNo('upbMstCri');
		}
	}
	
	function leavejson(kde,IdL)
	{
		$(document).ready(function()
		{
			//alert('xx');
			$.post("P47_Open_Laporan_Find_Upb_Mid_All_Json.php",
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

	function formCetakDok(doc,w,h,IdL)
	{
		//alert(doc); return false;
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= 'report/'+doc+'.php?IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open(URL,'',settings);
	}
	
</script>