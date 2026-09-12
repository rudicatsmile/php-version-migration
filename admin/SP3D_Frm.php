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
$gREF= "SP3.".fGetDate('year').".XXXXXXXX";
$gHR = fGetDate('mday');
$gBL = fGetDate('mon');
$gTH = fGetDate('year');
$gHRd  = "00";
$gBLd  = "00";
$gTHd  = "0000";
$gNO  = "";
$fSLA = 0;

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
$gCNT = 0;
if ($IdT)
{
	$nSQL= "SELECT Referensi,Kd_UPB,Nom_SP3D,Tgl_SP3D,KdSesi,Uraian,KdJenis FROM ta_sp3d WHERE IDT='$IdT'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	$gREF = $mRo[0];
	$gUNT = substr($mRo[1],0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	$gSUB = substr($mRo[1],0,14);
	$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
	$gUPB = substr($mRo[1],0,18);
	$dUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
	
	$gNO  = $mRo[2];
	
	$gTG  = $mRo[3];
	$gTG  = explode("-",$gTG);
	$gTH  = $gTG[0];
	$gBL  = $gTG[1];
	$gHR  = $gTG[2];
	
	
	$gCNT = fGlobal("IfNull(count(*),0)","ta_sp3d_rinci","Referensi",$gREF,"=","","");
	if ($gCNT==0){
		$gSES = $mRo[4];
		$gJNS = $mRo[6];
	}
	else{
		$gSES = $mRo[4];
		$gJNS = $mRo[6];
		
		$dSES = fGlobal("Deskripsi","ref_session","Kode",$mRo[4],"=","","");
		$dJNS = fGlobal("Deskripsi","ref_sp3d_jenis","Kode",$mRo[6],"=","","");
	}
	$gURA = $mRo[5];
	
	$fSLA = fGlobal("Nilai","ta_sp3d_saldo_awal","Kd_UPB:KdJenis:KdTahap:Tahun",$gUPB.":".$gJNS.":".$gSES.":".$gTH,"=:=:=:=","","");
	$Lock = fGlobal($dJNS,"ta_sp3d_lock","Kd_UPB:Tahun",$gUPB.":".$gTH,"=:=","","");
	if ($Lock=='N')
	{
		#Lock by tahap selanjutnya
		$Lock = fGlobal("IDT","ta_sp3d","Kd_UPB:Tahun:KdJenis:KdSesi",$gUPB.":".$gTH.":".$gJNS.":".$gSES,"=:=:=:>","IDT LIMIT 0,1","");
		if ($Lock){$Lock='Y';}
	}
}

?>
<body onload="RefreshDATA('<?=$IdL?>','0')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="SP3D_Frm_.php?IdT=".$IdT."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>" enctype="multipart/form-data">
<input type="hidden" name="fSave" style="width:20px" />
<input type="hidden" name="fCrT" style="width:20px" />
<input type="hidden" name="fIdT" style="width:20px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px">
  <tr>
    <td width="3">&nbsp;</td>
    <td width="107">
	<div id="findupbMstCri" class="findupb0Cri">
		<div id="findupbDiv1Cri" class="findupb1Cri"></div>
		<div id="findupbDiv2Cri" class="findupb2Cri"></div>
	</div>	</td>
    <td width="29">&nbsp;</td>
    <td width="251">
	<div id="asetMstCri" class="findrekn0Cri">
		<div id="asetDiv1Cri" class="findrekn1Cri"></div>
		<div id="asetDiv2Cri" class="findrekn2Cri"></div>
	</div>	</td>
    <td width="43">&nbsp;</td>
    <td width="28">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">UNIT KERJA </td>
    <td align="center">:</td>
    <td colspan="5">
	<input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" 
	<?php if ($IdT=='' && $Lev<=1){?>
	onclick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" 
	<?php } else 
	{echo "readonly";}?> 
	style="padding-left:5px; width:320px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="find0Cri">
		<div id="unitDiv1Cri" class="find1Cri"></div>
		<div id="unitDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">SUB UNIT </td>
    <td align="center">:</td>
    <td colspan="5">
	<input name="fSUB" id="fSUB" type="text" value="<?=$gSUB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dSUB" id="dSUB" type="text" value="<?=$dSUB?>" 
	<?php if ($IdT=='' && $Lev<=2){?>
	onclick="showSUB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showSUB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('sub'); return false;}" 
	<?php } else {echo "readonly";}?> 
	style="padding-left:5px; width:320px; border: 1px solid #C0C0C0"/>
	<div id="subMstCri" class="find0Cri">
		<div id="subDiv1Cri" class="find1Cri"></div>
		<div id="subDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">UPB</td>
    <td align="center">:</td>
    <td colspan="5">
	<input name="fUPB" id="fUPB" type="text" value="<?=$gUPB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUPB" id="dUPB" type="text" value="<?=$dUPB?>" 
	<?php if ($IdT=='' && $Lev<=3){?>
	onclick="showUPB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showUPB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('upb'); return false;}" 
	<?php } else {echo "readonly";}?> 
	style="padding-left:5px; width:291px; border: 1px solid #C0C0C0"/>
	<input type="button" name="B13" value="..." <?php if ($IdT=='' && $Lev<=1){?> onclick="findUPB('','<?=$_GET['IdL']?>')" <?php } ?> style="width: 27px; height:21px" />
	<div id="upbMstCri" class="find0Cri">
		<div id="upbDiv1Cri" class="find1Cri"></div>
		<div id="upbDiv2Cri" class="find2Cri"></div>
	</div>
	<div id="dataMstCri" class="editrekn0Cri">
		<div id="dataDiv1Cri" class="editrekn1Cri"></div>
		<div id="dataDiv2Cri" class="editrekn2Cri"></div>
	</div>	</td>
    </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">REFERENSI</td>
    <td align="center">:</td>
    <td>
	<input name="fREF" type="text" value="<?=$gREF?>" readonly style=" width:150px; border: 1px solid #C0C0C0; background:#99FF00"/>
	<input type="hidden" name="B13" value="..." onclick="showDATAxx('','<?=$IdT?>','<?=$_GET['IdL']?>')" style="width: 30px; height:21px" />
	<div id="tranMstCri" class="findtran0Cri">
		<div id="tranDiv1Cri" class="findtran1Cri"></div>
		<div id="tranDiv2Cri" class="findtran2Cri"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="2" valign="top">&nbsp;</td>
    </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">TANGGAL </td>
    <td align="center">:</td>
    <td><select class="boxs" name="fHR" tabindex="0" style="width:50px">
      <?php
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gHR) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fBL" tabindex="0" style="width:95px">
	<?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBL) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTH" id="fTH" style="width:60px" tabindex="0">
      <?php
	for($i=2014; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select></td>
    <td align="right">URAIAN</td>
    <td align="center">:</td>
    <td width="348" rowspan="3" valign="top"><textarea name="fURA" style="border: 1px solid #C0C0C0; height:60px; width:320px"><?=$gURA?></textarea></td>
    <td width="189" valign="top">SALDO AWAL :</td>
    </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">NOMOR </td>
    <td align="center">:</td>
    <td><input name="fNO" type="text" value="<?=$gNO?>" style=" width:205px; border: 1px solid #C0C0C0"/></td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td width="189" valign="top"><input name="fSLA" type="text" value="<?=fConvertToRupiah($fSLA)?>" readonly="readonly" style="width:110px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/></td>
  </tr>
  
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">JENIS </td>
    <td align="center">:</td>
    <td>
	<?php if ($gCNT==0){?>
	<select class="boxs" name="fJNS" tabindex="0" style="width:212px">
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
      <option <?=$ES?> value="<?=$mRo[0]?>" ><?=$mRo[1]?></option>
      <?php 
	} 
	?>
    </select>
	<?php } else {?>
	<input name="fJNS" type="hidden" value="<?=$gJNS?>" readonly style="width:50px; border: 1px solid #C0C0C0"/>
	<input name="dJNS" type="text" value="<?=$dJNS?>" readonly style="width:205px; border: 1px solid #C0C0C0"/>
	<?php } ?>	</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td width="189" valign="top">&nbsp;</td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">TAHAP</td>
    <td align="center">:</td>
    <td>
	<?php if ($gCNT==0){?>
	<select class="boxs" name="fSES" tabindex="0" style="width:212px">
      <option value=""></option>
      <?php
	$nSQ = "SELECT Kode, Deskripsi FROM ref_session ORDER BY Kode";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$ES = "";
		if ($gSES==$mRo[0]){
			$ES = "selected";
		}
		?>
      <option <?=$ES?> value="<?=$mRo[0]?>" >
      <?=$mRo[1]?>
      </option>
      <?php 
	} 
	?>
    </select>
	<?php } else {?>
	<input name="fSES" type="hidden" value="<?=$gSES?>" readonly style="width:50px; border: 1px solid #C0C0C0"/>
	<input name="dSES" type="text" value="<?=$dSES?>" readonly style="width:205px; border: 1px solid #C0C0C0"/>
	<?php } ?>	</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td width="348" valign="top">Tata kelola form : <i style="color:#FF3300">Perlu diketahui bahwa data tahap ini TERKUNCI oleh tahap setelahnya. Terima kasih.</i></td>
    <td width="189" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
	<!--div id="subMstCri" class="find0Cri">
		<div id="subDiv1Cri" class="find1Cri"></div>
		<div id="subDiv2Cri" class="find2Cri"></div>
	</div>	  
	  <div id="upbMstCri" class="find0Cri">
		<div id="upbDiv1Cri" class="find1Cri"></div>
		<div id="upbDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td>
	<div id="imgMstCri" class="upload_a">
		<div id="imgDiv1Cri" class="upload_b"></div>
		<div id="imgDiv2Cri" class="upload_c"></div>
	</div>	  
	<div id="imgMstView" class="upload_a">
		<div id="imgDiv1View" class="upload_b"></div>
		<div id="imgDiv2View" class="upload_c"></div>
	</div>	  
	<div id="alasMstCri" class="upload_a">
		<div id="alasDiv1Cri" class="upload_b"></div>
		<div id="alasDiv2Cri" class="upload_c"></div>
	</div-->	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px; height:30px; background: #EAE6E6">
  <tr>
    <td width="5">&nbsp;</td>
    <td>
	<input type="button" name="B39" <?=$DisA?> value="SAVE" onclick="Save()" style="width: 80px; height: 21px" />
	<input type="button" name="B10" value="RESET" onclick="Reset()" style="width: 80px; height: 21px" />
	<input type="button" name="B11" value="REFRESH" onclick="RefreshDATA('<?=$IdL?>','0')" style="width: 80px; height: 21px" />
	<input type="button" name="B12" <?=$DisA?> value="ADD REKENING" <?php if ($Lock=='Y'){echo "disabled";}?> onclick="showReknP90('','<?=$IdT?>','<?=$_GET['IdL']?>')" style="width:100px; height: 21px; color:#0000FF" />
	<?=str_repeat("&nbsp;",10)?>
	<input type="button" name="B13" value="DAFTAR " onclick="showDATANew('<?=$_GET['IdL']?>')" style="width: 130px; height: 21px" />
	
	<div style="float:right">
	<input type="button" name="B14" <?php if ($IdT=="") {echo "disabled";}?> value="POSISI SALDO AKHIR" onclick="editSALDO('','<?=$Lock?>','<?=$IdT?>','<?=$IdL?>')" style="width:120px; height:21px" />
	<input type="button" name="B14" <?php if ($IdT=="") {echo "disabled";}?> value="CETAK" onclick="P_Dokumen('800','400','<?=$IdT?>','<?=$IdL?>')" style="width:80px; height: 21px" />
	</div>
	</td>
    <td width="5">&nbsp;</td>
  </tr>
</table>
<?php if ($IdT) {?>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:1000px; height:20px; background: #CEFBE3; font-weight:bold">
  <tr>
    <td width="30" align="center">NO</td>
    <td width="90" align="left" style="padding-left:10px">KODE</td>
    <td width="405" align="left">REKENING</td>
    <td width="290" align="left">URAIAN</td>
    <td width="104" align="left">NILAI </td>
    <td align="center">ACTION</td>
  </tr>
</table>
<?php } ?>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:300px; overflow:auto; border:0px"></div>
	<div id="ViewDATA" style="height:250px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
<br>
<!--table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px">
  <tr>
    <td valign="top">
	<div id="ViewDATAaX" style="height:20px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table-->
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
	
	function proslNIL(crt,IdT,gTBL,IdL,AmBiL)
	{
		if (AmBiL=="ALL")
		{
			gFnD = ReplaceText($("#fFindP").val());
			gTHN = $("#fThnAst").val();
			gLST = $("#fTmpRec").val();
			gUNT = $("#fUNT").val();
			
			var AN = confirm("Proses semua data aset yang tampil ke usulan..?!!");
			if (!AN)
			{
				return false;
			}
			
			$(document).ready(function()
			{
				$("#loadingImg").show();
				$("#ViewDATA").load('SP3D_Frm_Find_Aset_Mid_CheckList.php?IdT='+IdT+'&gTBL='+gTBL+'&gUNT='+gUNT+'&AmBiL='+AmBiL+'&gFnD='+gFnD+'&gTHN='+gTHN+'&gLST='+gLST+'&IdL='+IdL);
			});
		}
		else
		{
			var mDana="";
			for (i = 0; i < objfrm.sDana.length; i++)
			{
				if (objfrm.sDana[i].checked)
				{
					mDana += objfrm.sDana[i].value+"-";
				}
			}
			
			gCrID = mDana;
			if (gCrID==''){alert('Data aset belum ada yang ditandai..!!');return false;}
			var AN = confirm("Proses data aset yang ditandai ke usulan..?!!");
			if (!AN)
			{
				return false;
			}
			
			$(document).ready(function()
			{
				$("#loadingImg").show();
				//$("#ViewDELL").load('SP3D_Frm_Find_Aset_Mid_CheckList.php?IdT='+IdT+'&gTBL='+gTBL+'&gCrID='+gCrID+'&IdL='+IdL);
				$("#ViewDATA").load('SP3D_Frm_Find_Aset_Mid_CheckList.php?AmBiL='+AmBiL+'&IdT='+IdT+'&gTBL='+gTBL+'&gCrID='+gCrID+'&IdL='+IdL);
			});
		}
		document.getElementById(crt+'MstCri').style.display = "none";
	}
	
	function showDELE(rIdT,Lock,rCek,IdL)
	{
		if (Lock=='Y') {alert('Access denied, data sudah terkunci...!'); return false;}
		if (rCek!=''){alert('Access denied....!!'); return false;}
		AN = confirm('Remove record...!!!');
		if (!AN){return false;}
		
		$(document).ready(function()
		{
			$("#ViewDELL").load('SP3D_Frm_Find_ReknP90_Rem.php?rIdT='+rIdT+'&IdL='+IdL);
			
		});
	}
	
    function SaveRecord(field,CrT,Lock,rIdT,IdL)
    { 
        gVL = ReplaceText(field.value);
		if (Lock=='Y') {alert('Access denied, data sudah terkunci...!'); return false;}
		
        $(document).ready(function() 
        { 
            $("#ViewDATA").load('SP3D_Frm_Find_ReknP90_Save.php?gVL='+gVL+'&CrT='+CrT+'&rIdT='+rIdT+'&IdL='+IdL); 
        }); 
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
		if (objfrm.fJNS.value=='') {alert('Silakan pilih jenis SP3D...!!'); return false;}
		if (objfrm.fSES.value=='') {alert('Silakan pilih tahap...!!'); return false;}
		objfrm.fSave.value='Save';
		objfrm.submit();
	}
	
	function Reset()
	{
		objfrm.fSave.value='Reset';
		objfrm.submit();
	}
	
	function showReknP90(CrT,IdT,IdL)
	{
		gLST = 100;
		gREK = "4_5";
		if (!IdT) {alert('Data belum tersimpan...!'); return false;}
		
		gUPB = objfrm.fUPB.value;
		if (CrT=='find')
		{
			gLST = $("#fTmpRec").val();
			
			Len = objfrm.fREK.length;
			for (i=0; i<=Len; i++)
			{
				if (objfrm.fREK[i].checked) {gREK = objfrm.fREK[i].value; break; }
			}
			
			gFnD = ReplaceText(objfrm.fFindP.value);
			$(document).ready(function()
			{
				$("#asetDiv2Cri").load('SP3D_Frm_Find_ReknP90_Mid.php?gREK='+gREK+'&gFnD='+gFnD+'&gLST='+gLST+'&IdT='+IdT+'&gUPB='+gUPB+'&IdL='+IdL);
			});
		}
		else
		{
			document.getElementById('asetDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#asetDiv1Cri").load('SP3D_Frm_Find_ReknP90_Top.php?IdT='+IdT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#asetDiv2Cri").load('SP3D_Frm_Find_ReknP90_Mid.php?gREK='+gREK+'&gLST='+gLST+'&IdT='+IdT+'&gUPB='+gUPB+'&IdL='+IdL);
			});
			
			if (document.getElementById('asetMstCri').style.display == "block")
			{
				document.getElementById('asetMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('asetMstCri').style.display = "block";
			}
		}
	}
	
	function RefreshDATA(IdL,PgE)
	{
		var gREF = objfrm.fREF.value;
		$(document).ready(function()
		{
			$.ajax({
				url:"SP3D_Frm_Data.php",
				data: {PgE:PgE,gREF:gREF,IdL:IdL},
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
			//$("#ViewDATAaX").load('SP3D_Frm_Data_Pages.php?PgE='+PgE+'&gREF='+gREF+'&IdL='+IdL);
		});
	}
	
	function P_Remove(PgE,rIdT,DeL,IdL)
	{
		if (DeL=="DelVer") {
			var AN = confirm("Data sedang diverifikasi oleh pengelola, lanjutkan pembatalan..?!!");
			if (AN)
			{
				$(document).ready(function()
				{
					$("#ViewDELL").load('SP3D_Frm_Del.php?PgE='+PgE+'&DelVer=Ya&rIdT='+rIdT+'&IdL='+IdL);
				});
			}
		}
		else{
			if (DeL!="") {alert('Data usulan sudah diproses, aksi remove data ditolak...!!'); return false;}
			var AN = confirm("Remove item dari usulan..?!!");
			if (AN)
			{
				$(document).ready(function()
				{
					$("#ViewDELL").load('SP3D_Frm_Del.php?PgE='+PgE+'&rIdT='+rIdT+'&IdL='+IdL);
				});
			}
		}
	}

	function showDATANew(IdL)
	{
		gUPB = objfrm.fUPB.value;
		window.open('SP3D.php?FrmG=DANA BOS -> LIST DATA SP3D&gUPB='+gUPB+'&IdL='+IdL,'_self');
	}
	
	function showDATA(CrT,IdT,gIdL)
	{
		var gUPB = objfrm.fUNT.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.fFindA.value);
			$(document).ready(function()
			{
				$("#tranDiv2Cri").load('SP3D_Frm_Data_Mid.php?gFnD='+gFnD+'&gUPB='+gUPB+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('tranDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#tranDiv1Cri").load('SP3D_Frm_Data_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#tranDiv2Cri").load('SP3D_Frm_Data_Mid.php?gUPB='+gUPB+'&IdL='+gIdL);
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
	
	function showLINK(IdT,IdL)
	{
		URL='SP3D_Frm.php?IdT='+IdT+'&IdL='+IdL;
		window.open(URL,'MidFrame','');
	}

	function P_Delete(IdT,CeK)
	{
		if (!IdT) {alert('Error command..!!'); return false;}
		if (CeK=="DelVer")
		{
			var AN = confirm("Transaksi dalam proses verifikasi, lanjutkan hapus usulan ini ..?!!");
			if (AN)
			{
				objfrm.fSave.value='DelVer';
				//objfrm.submit();
			}
		}
		else
		{
			var AN = confirm("Hapus transaski usulan ini ..?!!");
			if (AN)
			{
				objfrm.fSave.value='Dell';
				objfrm.submit();
			}
		}
	}
	
	function addIMG(CrT,gIdT,gIdL)
	{
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('SP3D_Frm_Data_Edit_Upl_Mid_Bro.php?gIdT='+gIdT+'&CrT='+CrT+'&IdL='+gIdL);
		});
	}
	
	function showREF(CrT,gIdT,gIdL)
	{
		var gRF = objfrm.fREF.value;
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('SP3D_Frm_Data_Edit_Mid.php?gIdT='+gIdT+'&gRF='+gRF+'&CrT='+CrT+'&IdL='+gIdL);
		});
	}
	
	function showEDIT(CrT,gIdT,gIdL)
	{
		var gRF = objfrm.fREF.value;
		var gJN = objfrm.fJNS.value;
		
		document.getElementById('imgDiv1Cri').style.display = "block";
		document.getElementById('imgDiv2Cri').style.display = "block";
		$(document).ready(function()
		{
			$("#imgDiv1Cri").load('SP3D_Frm_Data_Edit_Top.php?gJN='+gJN+'&CrT='+CrT+'&IdL='+gIdL);
		});
		
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('SP3D_Frm_Data_Edit_Mid.php?gIdT='+gIdT+'&gRF='+gRF+'&CrT='+CrT+'&IdL='+gIdL);
		});
		
		if (document.getElementById('imgMstCri').style.display == "block")
		{
			document.getElementById('imgMstCri').style.display = "none";
		}
		else
		{
			document.getElementById('imgMstCri').style.display = "block";
		}
	}
	
	function P_Upload(CrT,gIdT)
	{
		if (objfrm.imgfile.value=="")
		{
			alert('Silahkan pilih file terlebih dahulu..!!');
			return false;
		}
		var spl = objfrm.imgfile.value.split('.');
		var Ext = spl[1].toLowerCase();
		
		if (CrT=='Pdf') {
			if (Ext!='pdf') {alert('File yang anda pilih bukan file pdf....!!'); return false;}
		}
		
		if (CrT=='Img') {
			if (Ext!='jpg' && Ext!='jpeg' && Ext!='png' && Ext!='bmp' && Ext!='gif') {alert('File yang di perbolehkan hanya (ext: jpg, jpeg, png, bmp, gif)....!!'); return false;}
		}
		
		objfrm.fCrT.value=CrT;
		objfrm.fIdT.value=gIdT;
		
		objfrm.fSave.value='Upload';
		objfrm.submit();
	}
	
	function remoIMG(CrT,gIdT,rIdT,gIdL)
	{
		var AN = confirm("Remove file..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('SP3D_Frm_Data_Edit_Upl_Rem.php?CrT='+CrT+'&gIdT='+gIdT+'&rIdT='+rIdT+'&IdL='+gIdL);
			});
		}
	}
	
	function viewIMG(rIdT,w,h,gIdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='SP3D_Frm_Data_Edit_Upl_Top_Vie.php?rIdT='+rIdT+'&IdL='+gIdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open(URL,'',settings);
	}
	
	function closeIMG(crt)
	{
		document.getElementById('imgMst'+crt).style.display = "none";
	}
	
	function choiseFIND(Frm,CrT,gid,kde,nma,IdL)
	{
		$(document).ready(function()
		{
			$("#ViewDELL").load('SP3D_Frm_Data_Edit_Mid_Find_Add.php?gFrm='+Frm+'&gID='+gid+'&gKD='+kde+'&IdL='+IdL);
		});
		
		document.getElementById(CrT+'MstCri').style.display = "none";
	}
	
	function findEDIT(rMsT,Frm,CrT,gID,gIdL)
	{
		var vMsT = "";
		if (rMsT)
		{
			vMsT  = document.getElementById(rMsT).value;
			if (Frm=='rekn'){
				vMKiB = document.getElementById('fKIBb').value;
				if (vMKiB=='') {alert('KIB tujuan belum dipilih..!!'); return false;}
			}
		}
		
		
		var gJN = objfrm.fJNS.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.fFindDTA.value);
			$(document).ready(function()
			{
				$("#alasDiv2Cri").load('SP3D_Frm_Data_Edit_Mid_Find_Mid.php?rMsT='+rMsT+'&vMsT='+vMsT+'&gFnD='+gFnD+'&gFrm='+Frm+'&gID='+gID+'&gJN='+gJN+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('alasDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#alasDiv1Cri").load('SP3D_Frm_Data_Edit_Mid_Find_Top.php?rMsT='+rMsT+'&vMsT='+vMsT+'&gFrm='+Frm+'&gID='+gID+'&IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#alasDiv2Cri").load('SP3D_Frm_Data_Edit_Mid_Find_Mid.php?rMsT='+rMsT+'&vMsT='+vMsT+'&gFrm='+Frm+'&gID='+gID+'&gJN='+gJN+'&IdL='+gIdL);
			});
			
			if (document.getElementById('alasMstCri').style.display == "block")
			{
				document.getElementById('alasMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('alasMstCri').style.display = "block";
			}
		}
	}
	
	function P_Dokumen(w,h,IdT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='SP3D_Frm_Data_Dok.php?IdT='+IdT+'&IdL='+IdL;
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
		URL='SP3D_Frm_Data_Dok.php?gUNT='+gUNT+'&JeNS='+JeNS+'&HR1='+HR1+'&HR2='+HR2+'&HR3='+HR3+'&BL1='+BL1+'&BL2='+BL2+'&BL3='+BL3+'&TH1='+TH1+'&TH2='+TH2+'&TH3='+TH3+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
		//closeCLICK('choise');
	}
	
	function findUPB(CrT,IdL)
	{
		if (CrT=='find'){
			FnD = ReplaceText($("#fFindUPB").val());
			$(document).ready(function()
			{
				$("#findupbDiv2Cri").load('SP3D_Frm_Find_All_Upb_Mid.php?FnD='+FnD+'&IdL='+IdL);
			});
		}
		else
		{
			//globalClose('spjMstCri');
			dispBLOCK('findupbDiv1Cri');
			dispBLOCK('findupbDiv2Cri');
			
			$(document).ready(function()
			{
				$("#findupbDiv1Cri").load('SP3D_Frm_Find_All_Upb_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#findupbDiv2Cri").load('SP3D_Frm_Find_All_Upb_Mid.php?IdL='+IdL);
			});
			
			dispBlockOrNo('findupbMstCri');
		}
	
	}
	
	function editSALDO(CrT,Lock,IdT,IdL)
	{
		if (CrT=='refr')
		{
			$(document).ready(function()
			{
				$("#dataDiv2Cri").load('SP3D_Frm_Saldo_Akhir_Mid.php?IdT='+IdT+'&IdL='+IdL);
			});
		}
		else
		{
			if (Lock=='Y') {alert('Access denied, data sudah terkunci...!'); return false;}
			dispBLOCK('dataDiv2Cri');
			$(document).ready(function()
			{
				$("#dataDiv1Cri").load('SP3D_Frm_Saldo_Akhir_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#dataDiv2Cri").load('SP3D_Frm_Saldo_Akhir_Mid.php?IdT='+IdT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('dataMstCri');
		}
	}
	
	function saveSALDO(IdT,IdL)
	{
		fBan = ReplaceText($("#fBan").val());
		fBen = ReplaceText($("#fBen").val());
		$(document).ready(function()
		{
			$("#dataDiv2Cri").load('SP3D_Frm_Saldo_Akhir_Save.php?fBan='+fBan+'&fBen='+fBen+'&IdT='+IdT+'&IdL='+IdL);
		});
	}
</script>