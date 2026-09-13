<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="global.js"></script>
</head>
<?php
extract($_GET);
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
	$gUNT = substr($SkP,0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	$gSUB = substr($SkP,0,14);
	$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
	$gUPB = substr($SkP,0,18);
	$dUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
}

if ($IdT==''){$IdT = fGlobal("IDT","ta_upb","Kd_UPB:Tahun",$gUPB.":".$gTH,"=:=","","");}
if ($IdT)
{
	$nSQL= "SELECT Nm_Pimpinan, Nip_Pimpinan, Jbt_Pimpinan, Nm_Bend_BOS, Nip_Bend_BOS, Jbt_Bend_BOS 
	FROM ta_upb WHERE IDT='$IdT'";
	#echo $nSQL;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	
	$NmaP = $mRo[0];
	$NipP = $mRo[1];
	$JabP = $mRo[2];
	$NmaB = $mRo[3];
	$NipB = $mRo[4];
	$JabB = $mRo[5];
}

?>
<body onload="RefreshDATA('<?=$IdL?>','0')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="SP3D_Open_Wilayah_Administrasi_Frm_.php?IdT=".$IdT."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>" enctype="multipart/form-data">
<input type="hidden" name="fSave" style="width:20px" />
<input type="hidden" name="fCrT" style="width:20px" />
<input type="hidden" name="fIdT" style="width:20px" />
<!--table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:700px; height:30px; background: #EAE6E6">
<tr>
  <td width="5">&nbsp;</td>
</tr>
</table-->
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:800px">
  <tr height="30">
    <td width="6">&nbsp;</td>
    <td width="116">
	<div id="findupbMstCri" class="findupb0Cri">
		<div id="findupbDiv1Cri" class="findupb1Cri"></div>
		<div id="findupbDiv2Cri" class="findupb2Cri"></div>
	</div>	</td>
    <td width="30">&nbsp;</td>
    <td colspan="4">
	<div id="asetMstCri" class="findrekn0Cri">
		<div id="asetDiv1Cri" class="findrekn1Cri"></div>
		<div id="asetDiv2Cri" class="findrekn2Cri"></div>
	</div>	</td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">UNIT KERJA </td>
    <td align="center">:</td>
    <td colspan="4">
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
    <td colspan="4">
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
    <td colspan="4">
	<input name="fUPB" id="fUPB" type="text" value="<?=$gUPB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUPB" id="dUPB" type="text" value="<?=$dUPB?>" <?php if (!$IdT) {?> onclick="showUPB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showUPB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('upb'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:320px; border: 1px solid #C0C0C0"/>
	<input type="hidden" name="B13" value="..." <?php if (!$IdT) {?> onclick="findUPB('','<?=$_GET['IdL']?>')" <?php } ?> style="width: 27px; height:21px" />
	<div id="upbMstCri" class="find0Cri">
		<div id="upbDiv1Cri" class="find1Cri"></div>
		<div id="upbDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    </tr>
  
  <tr height="17">
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">KECAMATAN</td>
    <td align="center">&nbsp;</td>
    <td colspan="4">
	<input name="fUNT22" id="fUNT22" type="text" value="<?=$gUNT?>" readonly="readonly" style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUNT22" id="dUNT22" type="text" value="<?=$dUNT?>" <?php if (!$IdT) {?> onclick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:320px; border: 1px solid #C0C0C0"/>	</td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">DESA / KELURAHAN </td>
    <td align="center">&nbsp;</td>
    <td colspan="4">
	<input name="fUNT2" id="fUNT2" type="text" value="<?=$gUNT?>" readonly="readonly" style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUNT2" id="dUNT2" type="text" value="<?=$dUNT?>" <?php if (!$IdT) {?> onclick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:320px; border: 1px solid #C0C0C0"/>	</td>
  </tr>
  <tr height="17">
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">TAHUN</td>
    <td align="center">:</td>
    <td colspan="4">
	<select class="boxs" name="fTH" style="width:70px" tabindex="0" onchange="this.form.submit()">
 	<?php
	for($i=2020; $i<=2030; $i++)
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
    <td class="ar">NAMA PIMPINAN </td>
    <td align="center">:</td>
    <td width="189"><input name="fTHP3" id="fTHP3" type="text" value="<?=$NmaP?>" style="width:180px; border: 1px solid #C0C0C0"/></td>
    <td width="138" class="ar">NAMA BENDAHARA BOS </td>
    <td width="31" class="ac">:</td>
    <td width="288"><input name="fTHP34" id="fTHP34" type="text" value="<?=$NmaB?>" style="width:180px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">NIP PIMPINAN </td>
    <td align="center">:</td>
    <td><input name="fTHP32" id="fTHP32" type="text" value="<?=$NipP?>" style="width:180px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">NIP BENDAHARA </td>
    <td class="ac">:</td>
    <td><input name="fTHP322" id="fTHP322" type="text" value="<?=$NipB?>" style="width:180px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">JABATAN</td>
    <td align="center">:</td>
    <td><input name="fTHP33" id="fTHP33" type="text" value="<?=$JabP?>" style="width:180px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">JABATAN</td>
    <td class="ac">:</td>
    <td><input name="fTHP332" id="fTHP332" type="text" value="<?=$JabB?>" style="width:180px; border: 1px solid #C0C0C0"/></td>
  </tr>
  

  
  
  <tr height="30">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:800px; height:30px; background: #EAE6E6">
  <tr>
    <td width="5">&nbsp;</td>
    <td>
	<input type="button" name="B39" <?=$DisA?> value="SAVE" onclick="Save()" style="width: 80px; height: 21px" />
    <input type="button" name="B10" value="RESET" onclick="Reset()" style="width:80px; height: 21px" />
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
		if (objfrm.fJNS.value=='') {alert('Silakan pilih jenis BOS...!!'); return false;}
		objfrm.fSave.value='Save';
		objfrm.submit();
	}
	
	function Reset()
	{
		objfrm.fSave.value='Reset';
		objfrm.submit();
	}
	
</script>