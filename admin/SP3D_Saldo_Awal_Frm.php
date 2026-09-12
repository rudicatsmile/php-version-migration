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
	$gUNT = substr($SkP,0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	$gSUB = substr($SkP,0,14);
	$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
	$gUPB = substr($SkP,0,18);
	$dUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
}

$gURA = "";
if ($IdT)
{
	$nSQL= "SELECT Kd_UPB, Tahun, KdJenis, Nilai, Uraian FROM ta_sp3d_saldo_awal WHERE IDT='$IdT'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	
	
	$gUNT = substr($mRo[0],0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	
	$gSUB = substr($mRo[0],0,14);
	$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
	
	$gUPB = substr($mRo[0],0,18);
	$dUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
	
	$gTH  = $mRo[1];
	$gJNS = $mRo[2];
	$gNIL = $mRo[3];
	$gURA = $mRo[4];
}

?>
<body onload="RefreshDATA('<?=$IdL?>','0')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="SP3D_Saldo_Awal_Frm_.php?IdT=".$IdT."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>" enctype="multipart/form-data">
<input type="hidden" name="fSave" style="width:20px" />
<input type="hidden" name="fCrT" style="width:20px" />
<input type="hidden" name="fIdT" style="width:20px" />
<!--table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:700px; height:30px; background: #EAE6E6">
<tr>
  <td width="5">&nbsp;</td>
</tr>
</table-->
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:700px">
  <tr height="30">
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
	<input name="dUPB" id="dUPB" type="text" value="<?=$dUPB?>" <?php if (!$IdT) {?> onclick="showUPB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showUPB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('upb'); return false;}" <?php } else {echo "readonly";}?> style="padding-left:5px; width:320px; border: 1px solid #C0C0C0"/>
	<input type="hidden" name="B13" value="..." <?php if (!$IdT) {?> onclick="findUPB('','<?=$_GET['IdL']?>')" <?php } ?> style="width: 27px; height:21px" />
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
	<select class="boxs" name="fTH" style="width:70px" tabindex="0" onchange="this.form.submit()">
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
    <td class="ar">JENIS BOS</td>
    <td align="center">:</td>
    <td><select class="boxs" name="fJNS" tabindex="0" style="width:110px" onchange="this.form.submit()">
      <option value=""></option>
      <?php
	$nSQ = "SELECT Kode, Deskripsi FROM ref_sp3d_jenis ORDER BY Kode";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$ES = "";
		if ($gJNS==$mRo[0]){
			$ES = "selected";
		}
		?>
      <option <?=$ES?> value="<?=$mRo[0]?>" >
      <?=$mRo[1]?>
      </option>
      <?php 
	} 
	?>
    </select></td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">TAHAP</td>
    <td align="center">&nbsp;</td>
    <td><input name="fTHP" id="fTHP" type="text" value="<?="Tahap 1"?>" readonly style=" width:103px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">SALDO AWAL</td>
    <td align="center">:</td>
    <td><input name="fNIL" id="fNIL" type="text" value="<?=fConvertToRupiahBulat($gNIL)?>" onKeyUp="addSeparatorNum(this)" onkeypress="if (event.keyCode==13){ Save();}" style=" width:100px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/></td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">URAIAN</td>
    <td align="center">:</td>
    <td rowspan="4">
	<textarea name="fURA" style="border: 1px solid #C0C0C0; height:100px; width:320px"><?=$gURA?></textarea></td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td align="center">&nbsp;</td>
    </tr>
  <tr height="30">
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  
  
  
  <tr height="30">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:700px; height:30px; background: #EAE6E6">
  <tr>
    <td width="5">&nbsp;</td>
    <td>
	<input type="button" name="B39" <?=$DisA?> value="SAVE" onclick="Save()" style="width: 80px; height: 21px" />
    <input type="button" name="B10" value="RESET" onclick="Reset()" style="width: 80px; height: 21px" />
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