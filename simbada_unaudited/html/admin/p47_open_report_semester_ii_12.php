<?
// require "checklogin.php"; 
// require "checkusertype.php"; 

require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");

extract($_GET);

$gUNT = substr($SkP,0,11);
$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");

if (isset($_GET['rIDT'])) {$gIDT=$_GET['rIDT'];} 
if (isset($_GET['rDELL'])) {$gDELL=$_GET['rDELL'];} 

$fHri = date('d'); 
$fBln = date('m'); 
$fThn = date('Y'); 

$rSem = 1;
$rThn = date('Y'); 

#$g02v = substr($rBD,0,11);
#$g03v = $rBD;
#$g02  = fGlobal("bidang","tb_bidang","kode",$g02v,"=","","");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="global.js"></script>
<body>
<?php require "FileMenu.php";?>

<form name="myfrm" method="POST" action=""> 
<br><br>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:900px; color:#fff; background:#79a86a">
  <tr>
    <td width="150">&nbsp;</td>
    <td width="19">&nbsp;</td>
    <td width="550">&nbsp;</td>
    </tr>
  <tr height="24">
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
 
  <tr height="23">
      <td class="ar">Unit Kerja  </td>
      <td align="center">&nbsp;</td>
      <td colspan="3">
    <input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:3px; width:105px; border: 1px solid #C0C0C0"/>
    <input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" readonly 
      <? if ($Lev <= 1) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" 
      <? } else {echo "readonly";}?> style="padding-left:3px; width:450px; border: 1px solid #C0C0C0"/>
    <div id="unitMstCri" class="Unit0Cri">
      <div id="unitDiv1Cri" class="Unit1Cri"></div>
      <div id="unitDiv2Cri" class="Unit2Cri"></div>
    </div>  </td>
  </tr>
  <tr height="24">
    <td align="right">Tahun</td>
    <td>&nbsp;</td>
    <td><select name="fThn" id="fThn" style="width:63px" tabindex="1">
          <? 
        for ($iG=2022; $iG<=date('Y'); $iG++) 
        { 
            if ($rThn==$iG) {$gSL="selected";} else {$gSL="";} 
            echo "<option value='$iG' $gSL >".$iG."</option>"; 
        } 
        ?>
        </select>    </td>
  </tr>
  <tr height="24">
    <td align="right">Laporan BMD</td>
    <td>&nbsp;</td>
    <td>
	<label><input name="radiOnOff" id="radiOnOff" type="radio" value="V1" checked />Kuasa Pengguna</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label><input name="radiOnOff" id="radiOnOff" type="radio" value="V2" />Pengguna</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label><input name="radiOnOff" id="radiOnOff" type="radio" value="V3" />Pengelola</label>	</td>
    </tr>
  <tr height="24">
    <td align="right">Tanggal TTD</td>
    <td>&nbsp;</td>
    <td>
	  <select name="fHriA" id="fHriA" style="width:45px; text-align:center" tabindex="1">
        <? 
        for ($iG=1; $iG<=31; $iG++) 
        { 
            if ($fHri==$iG) {$gSL="selected";} else {$gSL="";} 
            echo "<option value='$iG' $gSL>".$iG."</option>"; 
        } 
        ?>
      </select>
        <select name="fBlnA" id="fBlnA" style="width:85px; text-align:center" tabindex="1">
          <? 
        for ($iG=1; $iG<=12; $iG++) 
        { 
            if ($fBln==$iG) {$gSL="selected";} else {$gSL="";} 
            echo "<option value='$iG' $gSL>".fNmBulanLong($iG)."</option>"; 
        } 
        ?>
        </select>
        <select name="fThnA" id="fThnA" style="width:58px; text-align:center" tabindex="1">
          <? 
        for ($iG=2020; $iG<=date('Y'); $iG++) 
        { 
            if ($fThn==$iG) {$gSL="selected";} else {$gSL="";} 
            echo "<option value='$iG' $gSL>".$iG."</option>"; 
        } 
        ?>
        </select>	</td>
    </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:900px">

  <tr>
    <td width="126">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('Format_II_L_5','<?=$IdL?>'); return false;">Format II.L.5 - Daftar Penggunaan/Pemakaian BMD (Peralatan & Mesin)</a></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onClick="showDoc('Format_II_L_6','<?=$IdL?>'); return false;">Format II.L.6 - Daftar Penggunaan/Pemakaian BMD (Gedung & Bangunan)</a></td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="22">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
<script languange="javascript">
var objfrm=document.myfrm; 

function showUnit_old(fnD,CrDiv,IdL) 
{ 
	if (fnD!=''){
		FnD = ReplaceText($("#fFndUnit").val());
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv2").load('rekap_persemester_find_mid.php?CrT='+FnD+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
	}
	else
	{
		dispBLOCK(CrDiv+'MstDiv2');
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv1").load('rekap_persemester_find_top.php?CrDiv='+CrDiv+'&IdL='+IdL);
			$("#"+CrDiv+"MstDiv2").load('rekap_persemester_find_mid.php?CrDiv='+CrDiv+'&IdL='+IdL);
		});
		dispBlockOrNo(CrDiv+'MstDiv0');
	}
}

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
			 dispBLOCK('unitDiv2Cri');
      
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('P47_Open_Laporan_Find_Unit_Top.php?IdL='+IdL);
        		$("#unitDiv2Cri").load('P47_Open_Laporan_Find_Unit_Mid.php?IdL='+IdL);
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

function showList(fnD,CrDiv,IdL) 
{ 
	SkP = $("#f02v").val();
	if (fnD!='')
	{
		FnD = ReplaceText($("#fFndLst").val());

		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv2").load('rekap_persemester_find_mid.php?SkP='+SkP+'&CrT='+FnD+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
	}
	else
	{
		dispBLOCK(CrDiv+'MstDiv2');
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv1").load('rekap_persemester_find_top.php?CrDiv='+CrDiv+'&IdL='+IdL);
			$("#"+CrDiv+"MstDiv2").load('rekap_persemester_find_mid.php?SkP='+SkP+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
		dispBlockOrNo(CrDiv+'MstDiv0');
	}
}

function showLst_Add(KdE,NmA,CrDiv,IdL)
{
	dispBlockOrNo(CrDiv+'MstDiv0');
	
	if (CrDiv=='unit'){
		$("#f02v").val(KdE);
		$("#f02").val(NmA);
		
		$("#f03v").val('');
		$("#f03").val('');
	}
	else if (CrDiv=='depo'){
		$("#f03v").val(KdE);
		$("#f03").val(NmA);
	}
	else {
		alert('Kriteria belum dikonfigurasi..'); return false;
	}
}

function showDoc(doc,IdL)
{
	KdS  = $("#fUNT").val();
	Thn  = $("#fThn").val();
	HriA = $("#fHriA").val();
	BlnA = $("#fBlnA").val();
	ThnA = $("#fThnA").val();
	
	RdB = "";
	Len = objfrm.radiOnOff.length;
	for (i=0; i<=Len; i++)
	{
		if (objfrm.radiOnOff[i].checked) {RdB = objfrm.radiOnOff[i].value; break;}
	}
	
	LeftPosition=(screen.width)?(screen.width-800)/2:100; 
	TopPosition=(screen.height)?(screen.height-400)/2:100;
	
	URL = 'report/permen_47/'+doc+'.php?KdS='+KdS+'&Thn='+Thn+'&RdB='+RdB+'&ThnA='+ThnA+'&BlnA='+BlnA+'&HriA='+HriA+'&IdL='+IdL;
	window.open(URL,'WinDOC'+doc+KdS+RdB+Thn,'toolbar=no,menubar=yes, top='+TopPosition+',left='+LeftPosition+' location=no, scrollbars=yes, resizable, width=800, height='+400);
}


function showCLICK(crt,kde,nma,IdL)
	{
		if (crt=='unit') 
		{
			$("#fUNT").val(kde);
			$("#dUNT").val(nma);
		
			// $("#fSUB").val('00.00.00.00.00');
			// $("#dSUB").val('ALL');
			
			// $("#fUPB").val('00.00.00.00.00.000');
			// $("#dUPB").val('ALL');
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
</script>
