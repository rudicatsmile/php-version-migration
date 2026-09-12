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
#$Lev=3;
extract($_GET);
$gUNT = substr($SkP,0,11);
$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");

#$gSUB = substr($SkP,0,14);
#$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
$gTH = $tTbl;
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="Invent_Usulan_Frm_.php?IdT=".$IdT."&IdL=".$_GET['IdL']?>" enctype="multipart/form-data">
<!--input type="hidden" name="fSave" style="width:20px" /-->
<!--input type="hidden" name="fCrT" style="width:20px" /-->
<!--input type="hidden" name="fIdT" style="width:20px" /-->
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td width="27">&nbsp;</td>
    <td width="82">&nbsp;</td>
    <td width="23">&nbsp;</td>
    <td width="87">&nbsp;</td>
    <td width="91">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="270">&nbsp;</td>
    <td width="22">&nbsp;</td>
  </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">PERIODE</td>
    <td align="center">&nbsp;</td>
    <td>
	<select class="boxs" name="fTHN" style="width: 63px" tabindex="0" onchange="changeDATA('<?=$IdL?>')">
      <?php
	for($i=2019; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select>
	</td>
    <td>
	<select class="boxs" name="fAPB" id="fAPB" style="width:90px" tabindex="0" onchange="RefreshDATA('<?=$IdL?>')">
      <option value="0" <?php if ($uTbl=='0') {echo "selected";}?>>Murni</option>
      <option value="1" <?php if ($uTbl=='1') {echo "selected";}?>>Perubahan</option>
    </select></td>
    <td width="689">&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">UNIT KERJA </td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:128px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" <?php if ($Lev<=2) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:500px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="find0Cri" style="width:647px">
		<div id="unitDiv1Cri" class="find1Cri" style="width:647px"></div>
		<div id="unitDiv2Cri" class="find2Cri" style="width:647px"></div>
	</div>
	<div id="reknMstCri" class="finddome0Cri">
		<div id="reknDiv1Cri" class="finddome1Cri"></div>
		<div id="reknDiv2Cri" class="finddome2Cri"></div>
	</div>	
	</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">PROGRAM</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<input name="fPRG" id="fPRG" type="text" value="<?=$gPRG?>" readonly style="padding-left:5px; width:128px; border: 1px solid #C0C0C0"/>
	<input name="dPRG" id="dPRG" type="text" value="<?=$dPRG?>" onClick="showPROG('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showPROG('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('prog'); return false;}" style="padding-left:5px; text-transform:uppercase; width:500px; border: 1px solid #C0C0C0"/>
	<div id="progMstCri" class="find0Cri" style="width:647px">
		<div id="progDiv1Cri" class="find1Cri" style="width:647px"></div>
		<div id="progDiv2Cri" class="find2Cri" style="width:647px"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">KEGIATAN</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<input name="fKEG" id="fKEG" type="text" value="<?=$gKEG?>" readonly style="padding-left:5px; width:128px; border: 1px solid #C0C0C0"/>
	<input name="dKEG" id="dKEG" type="text" value="<?=$dKEG?>" onClick="showKEGI('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showKEGI('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('kegi'); return false;}" style="padding-left:5px; text-transform:uppercase; width:500px; border: 1px solid #C0C0C0"/>
	<div id="kegiMstCri" class="find0Cri" style="width:647px">
		<div id="kegiDiv1Cri" class="find1Cri" style="width:647px"></div>
		<div id="kegiDiv2Cri" class="find2Cri" style="width:647px"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">SUB KEGIATAN</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<input name="fSUB" id="fSUB" type="text" value="<?=$gSUB?>" readonly style="padding-left:5px; width:128px; border: 1px solid #C0C0C0"/>
	<input name="dSUB" id="dSUB" type="text" value="<?=$dSUB?>" onClick="showSUBK('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showSUBK('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('subk'); return false;}" style="padding-left:5px; text-transform:uppercase; width:500px; border: 1px solid #C0C0C0"/>
	<div id="subkMstCri" class="find0Cri" style="width:647px">
		<div id="subkDiv1Cri" class="find1Cri" style="width:647px"></div>
		<div id="subkDiv2Cri" class="find2Cri" style="width:647px"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">PERUNTUKAN</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<input name="fPER" id="fPER" type="text" value="<?=$gPER?>" readonly style="padding-left:5px; width:128px; border: 1px solid #C0C0C0"/>
	<input name="dPER" id="dPER" type="text" value="<?=$dPER?>" onClick="showPERU('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showPERU('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('kegi'); return false;}" style="padding-left:5px; text-transform:uppercase; width:500px; border: 1px solid #C0C0C0"/>
	<div id="peruMstCri" class="find0Cri" style="width:647px">
		<div id="peruDiv1Cri" class="find1Cri" style="width:647px"></div>
		<div id="peruDiv2Cri" class="find2Cri" style="width:647px"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="text-align:right; font-style:italic"><!--Tekan &quot;Enter&quot; untuk menyimpan data nilai belanja--></td>
    </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:30px; background: #EAE6E6">
  <tr>
    <td width="5">&nbsp;</td>
    <td>
      <input type="button" name="B11" value="REFRESH" onclick="RefreshDATA('<?=$IdL?>')" style="width: 120px; height: 21px" />
	  <input type="button" name="B12" value="ADD REKENING" onclick="showREKN('','<?=$_GET['IdL']?>')" style="width: 120px; height: 21px" /><?=str_repeat("&nbsp;",10)?> &nbsp;&nbsp;&nbsp;&nbsp;
	  <input type="hidden" name="B13" value="CETAK" onclick="choiseTANGGAL('<?=$_GET['IdL']?>')" style="width: 120px; height: 21px; color:#0000FF" />
	</td>
    <td width="5">&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #CEFBE3; font-weight:bold">
  <tr>
    <td width="30" align="center">NO</td>
    <td width="110" align="center">KODE SUBKGT</td>
    <td width="100" align="center">KODE</td>
    <td align="left">NAMA REKENING</td>
    <td width="110" align="right">BELANJA</td>
    <td width="105" align="center">ACTION</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:330px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:300px; overflow:auto"></div>
	<div id="ViewDATA" style="height:400px; width:100%; overflow:auto; border:0px"></div>
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
				$("#unitDiv2Cri").load('Ref_RekeningSKPD_Find_Unit_Mid.php?gFnD='+gFnD+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('progMstCri').style.display = "none";
			document.getElementById('kegiMstCri').style.display = "none";
			document.getElementById('unitDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('Ref_RekeningSKPD_Find_Unit_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('Ref_RekeningSKPD_Find_Unit_Mid.php?IdL='+gIdL);
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
	
	function showPROG(CrT,IdL)
	{
		var fUNT = objfrm.fUNT.value;
		var fTHN = objfrm.fTHN.value;
		var fAPB = objfrm.fAPB.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dPRG.value);
			$(document).ready(function()
			{
				$("#progDiv2Cri").load('Ref_RekeningSKPD_Find_Prog_Mid.php?gFnD='+gFnD+'&gUNT='+fUNT+'&gTHN='+fTHN+'&gAPB='+fAPB+'&IdL='+IdL);
			});
		}
		else
		{
			document.getElementById('kegiMstCri').style.display = "none";
			document.getElementById('progDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#progDiv1Cri").load('Ref_RekeningSKPD_Find_Prog_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#progDiv2Cri").load('Ref_RekeningSKPD_Find_Prog_Mid.php?gUNT='+fUNT+'&gTHN='+fTHN+'&gAPB='+fAPB+'&IdL='+IdL);
			});
			
			if (document.getElementById('progMstCri').style.display == "block")
			{
				document.getElementById('progMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('progMstCri').style.display = "block";
			}
		}
	}
	
	function showKEGI(CrT,IdL)
	{
		var fUNT = objfrm.fUNT.value;
		var fPRG = objfrm.fPRG.value;
		var fTHN = objfrm.fTHN.value;
		var fAPB = objfrm.fAPB.value;
		if (fPRG==''){alert('Program belum dipilih..!!'); return false;}
		objfrm.dKEG.select();
		
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dKEG.value);
			$(document).ready(function()
			{
				$("#kegiDiv2Cri").load('Ref_RekeningSKPD_Find_Kegi_Mid.php?gFnD='+gFnD+'&gUNT='+fUNT+'&gPRG='+fPRG+'&gTHN='+fTHN+'&gAPB='+fAPB+'&IdL='+IdL);
			});
		}
		else
		{
			document.getElementById('kegiDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#kegiDiv1Cri").load('Ref_RekeningSKPD_Find_Kegi_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#kegiDiv2Cri").load('Ref_RekeningSKPD_Find_Kegi_Mid.php?gUNT='+fUNT+'&gPRG='+fPRG+'&gTHN='+fTHN+'&gAPB='+fAPB+'&IdL='+IdL);
			});
			
			if (document.getElementById('kegiMstCri').style.display == "block")
			{
				document.getElementById('kegiMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('kegiMstCri').style.display = "block";
			}
		}
	}
	
	function showSUBK(CrT,IdL)
	{
		var fUNT = objfrm.fUNT.value;
		var fPRG = objfrm.fPRG.value;
		var fKEG = objfrm.fKEG.value;
		var fTHN = objfrm.fTHN.value;
		var fAPB = objfrm.fAPB.value;
		
		if (fPRG==''){alert('Program belum dipilih..!!'); return false;}
		if (fKEG==''){alert('Kegiatan belum dipilih..!!'); return false;}
		objfrm.dSUB.select();
		
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dSUB.value);
			$(document).ready(function()
			{
				$("#subkDiv2Cri").load('Ref_RekeningSKPD_Find_Subk_Mid.php?gFnD='+gFnD+'&gUNT='+fUNT+'&gPRG='+fPRG+'&gKEG='+fKEG+'&gTHN='+fTHN+'&gAPB='+fAPB+'&IdL='+IdL);
			});
		}
		else
		{
			document.getElementById('subkDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#subkDiv1Cri").load('Ref_RekeningSKPD_Find_Subk_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#subkDiv2Cri").load('Ref_RekeningSKPD_Find_Subk_Mid.php?gUNT='+fUNT+'&gPRG='+fPRG+'&gKEG='+fKEG+'&gTHN='+fTHN+'&gAPB='+fAPB+'&IdL='+IdL);
			});
			
			if (document.getElementById('subkMstCri').style.display == "block")
			{
				document.getElementById('subkMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('subkMstCri').style.display = "block";
			}
		}
	}
	
	function showPERU(CrT,IdL)
	{
		var fUNT = objfrm.fUNT.value;
		var fPRG = objfrm.fPRG.value;
		var fKEG = objfrm.fKEG.value;
		var fSUB = objfrm.fSUB.value;
		var fTHN = objfrm.fTHN.value;
		if (fPRG==''){alert('Program belum dipilih..!!'); return false;}
		if (fKEG==''){alert('Kegiatan belum dipilih..!!'); return false;}
		if (fSUB==''){alert('Sub Kegiatan belum dipilih..!!'); return false;}
		objfrm.dPER.select();
		
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dPER.value);
			$(document).ready(function()
			{
				$("#peruDiv2Cri").load('ref_rekeningskpd_find_peru_mid.php?gFnD='+gFnD+'&gUNT='+fUNT+'&gPRG='+fPRG+'&gKEG='+fKEG+'&gSUB='+fSUB+'&gTHN='+fTHN+'&IdL='+IdL);
			});
		}
		else
		{
			document.getElementById('peruDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#peruDiv1Cri").load('Ref_RekeningSKPD_Find_Peru_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#peruDiv2Cri").load('Ref_RekeningSKPD_Find_Peru_Mid.php?gUNT='+fUNT+'&gPRG='+fPRG+'&gKEG='+fKEG+'&gSUB='+fSUB+'&gTHN='+fTHN+'&IdL='+IdL);
			});
			
			if (document.getElementById('peruMstCri').style.display == "block")
			{
				document.getElementById('peruMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('peruMstCri').style.display = "block";
			}
		}
	}
	
	function showREKN(CrT,IdL)
	{
		fPRG = objfrm.fPRG.value;
		fKEG = objfrm.fKEG.value;
		fSUB = objfrm.fSUB.value;
		fPER = objfrm.fPER.value;
		fTHN = objfrm.fTHN.value;
		fAPB = objfrm.fAPB.value;
		
		if (fPRG==''){alert('Program belum dipilih..!!'); return false;}
		if (fKEG==''){alert('Kegiatan belum dipilih..!!'); return false;}
		if (fSUB==''){alert('Sub Kegiatan belum dipilih..!!'); return false;}
		if (fPER==''){alert('Peruntukan belum dipilih..!!'); return false;}
		
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.fFindPR.value);
			$(document).ready(function()
			{
				$("#reknDiv2Cri").load('Ref_RekeningSKPD_Find_Rekn_Mid.php?gFnD='+gFnD+'&fSUB='+fSUB+'&fTHN='+fTHN+'&fAPB='+fAPB+'&IdL='+IdL);
			});
		}
		else
		{
			//alert('');
			document.getElementById('reknDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#reknDiv1Cri").load('Ref_RekeningSKPD_Find_Rekn_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#reknDiv2Cri").load('Ref_RekeningSKPD_Find_Rekn_Mid.php?fSUB='+fSUB+'&fTHN='+fTHN+'&fAPB='+fAPB+'&IdL='+IdL);
			});
			
			if (document.getElementById('reknMstCri').style.display == "block")
			{
				document.getElementById('reknMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('reknMstCri').style.display = "block";
			}
		}
	}
		
	function showCLICK(crt,kde,nma,IdL)
	{
		//var fUNT = objfrm.fUNT.value;
		//var fKEG = objfrm.fKEG.value;
		//var fTHN = objfrm.fTHN.value;
		
		var fUNT = objfrm.fUNT.value;
		var fPRG = objfrm.fPRG.value;
		var fKEG = objfrm.fKEG.value;
		var fSUB = objfrm.fSUB.value;
		var fPER = objfrm.fPER.value;
		var fTHN = objfrm.fTHN.value;
		
		if (crt=='unit') 
		{
			objfrm.fUNT.value = kde;
			objfrm.dUNT.value = nma;
			
			objfrm.fPRG.value = '';
			objfrm.dPRG.value = '';
			
			objfrm.fKEG.value = '';
			objfrm.dKEG.value = '';
			
			objfrm.fSUB.value = '';
			objfrm.dSUB.value = '';
			
			objfrm.fPER.value = '';
			objfrm.dPER.value = '';
			
			RefreshDATA(IdL);
		}
		if (crt=='prog') 
		{
			objfrm.fPRG.value = kde;
			objfrm.dPRG.value = nma;
			
			objfrm.fKEG.value = '';
			objfrm.dKEG.value = '';
			
			objfrm.fSUB.value = '';
			objfrm.dSUB.value = '';
			
			objfrm.fPER.value = '';
			objfrm.dPER.value = '';
			
			RefreshDATA(IdL);
		}
		if (crt=='kegi') 
		{
			objfrm.fKEG.value = kde;
			objfrm.dKEG.value = nma;
			
			objfrm.fSUB.value = '';
			objfrm.dSUB.value = '';
			
			objfrm.fPER.value = '';
			objfrm.dPER.value = '';
			
			RefreshDATA(IdL);
		}
		if (crt=='subk') 
		{
			objfrm.fSUB.value = kde;
			objfrm.dSUB.value = nma;
			
			objfrm.fPER.value = '';
			objfrm.dPER.value = '';
			
			RefreshDATA(IdL);
		}
		if (crt=='peru') 
		{
			objfrm.fPER.value = kde;
			objfrm.dPER.value = nma;
			
			RefreshDATA(IdL);
		}
		if (crt=='rekn') 
		{
			$(document).ready(function()
			{
				//$("#ViewDELL").load('Ref_RekeningSKPD_Find_Rekn_Add.php?IdT='+kde+'&gUNT='+fUNT+'&gKEG='+fKEG+'&gTHN='+fTHN+'&IdL='+IdL);
				//alert('');
				$("#ViewDELL").load('Ref_RekeningSKPD_Find_Rekn_Add.php?kde='+kde+'&gUNT='+fUNT+'&gPRG='+fPRG+'&gKEG='+fKEG+'&gSUB='+fSUB+'&gPER='+fPER+'&gTHN='+fTHN+'&IdL='+IdL);
			});
		}
		if (crt=='save') 
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('Ref_RekeningSKPD_Find_Rekn_Save.php?IdT='+kde+'&gUNT='+fUNT+'&gKEG='+fKEG+'&gTHN='+fTHN+'&IdL='+IdL);
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
	
	function CekX(xY,yX)
	{
		ret = "";
		if (xY.indexOf(yX.toUpperCase())!="-1"){ret="no";}
		return ret;
	}
	
	function RefreshDATA(IdL)
	{
		var fUNT = objfrm.fUNT.value;
		var fTHN = objfrm.fTHN.value;
		var fAPB = objfrm.fAPB.value;
		var fPRG = objfrm.fPRG.value;
		var fKEG = objfrm.fKEG.value;
		var fSUB = objfrm.fSUB.value;
		var fPER = objfrm.fPER.value;
		$(document).ready(function()
		{
			$("#ViewDATA").load('Ref_RekeningSKPD_Data.php?gUNT='+fUNT+'&gPRG='+fPRG+'&gKEG='+fKEG+'&gSUB='+fSUB+'&gPER='+fPER+'&gTHN='+fTHN+'&gAPB='+fAPB+'&IdL='+IdL);
		});
	}
	
	function P_Remove(IdT,DeL,IdL)
	{
		if (DeL!="") {alert('Access denied...!!'); return false;}
		var AN = confirm("Remove Kegiatan..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('Ref_RekeningSKPD_Data_Del.php?IdT='+IdT+'&IdL='+IdL);
			});
		}
	}
	
	function P_Save(field,IdT,DeL,IdL)
	{
		var NiL = field.value;
		
		if (DeL!="") {alert('Access denied...!!'); return false;}
		$(document).ready(function()
		{
			$("#ViewDELL").load('Ref_RekeningSKPD_Data_Save.php?NiL='+NiL+'&IdT='+IdT+'&IdL='+IdL);
		});
	}
	
	function P_Dokumen(w,h,IdT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='Invent_Usulan_Frm_Data_Dok_Rinci.php?IdT='+IdT+'&IdL='+IdL;
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
	
	function changeDATA(IdL)
	{
		objfrm.fPRG.value = "";
		objfrm.dPRG.value = "";
		
		objfrm.fKEG.value = "";
		objfrm.dKEG.value = "";
		
		RefreshDATA(IdL);
	}
	
</script>