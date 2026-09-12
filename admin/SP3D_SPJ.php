<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
//echo $Lev;
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
$gHR  = 1;     //fGetDate('mday');
$gBL  = 1;     //fGetDate('mon');
$gTH  = 2021;  //fGetDate('year');
$gHRd = 31;    //fGetDate('mday');
$gBLd = 12;    //fGetDate('mon');
$gTHd = 2021;  //fGetDate('year');
$gJNS = "AA";
if ($gUPB!=''){
	$gUNT = substr($gUPB,0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	$gSUB = substr($gUPB,0,14);
	$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
	$gUPB = substr($gUPB,0,18);
	$dUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
}
else{
	#$SkP  = "24.04.08.01.11.201";
	$gUNT = substr($SkP,0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	$gSUB = substr($SkP,0,14);
	$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
	$gUPB = substr($SkP,0,18);
	$dUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
}
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="SP3D_SPJ_.php?IdL=".$_GET['IdL']?>" enctype="multipart/form-data">
<input type="hidden" name="fSave" style="width:50px" />
<input type="hidden" name="UplIdT" id="UplIdT" style="width:20px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td width="73">&nbsp;</td>
    <td width="21">&nbsp;</td>
    <td width="501">
	<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:100%">
	<tr>
		<td width="70">&nbsp;</td>
		<td width="50">
		<div id="spjMstCri" class="findspj0Cri">
			<div id="spjDiv1Cri" class="findspj1Cri"></div>
			<div id="spjDiv2Cri" class="findspj2Cri"></div>
		</div>	
		<div id="spjasetMstCri" class="findspjaset0Cri">
			<div id="spjasetDiv1Cri" class="findspjaset1Cri"></div>
			<div id="spjasetDiv2Cri" class="findspjaset2Cri"></div>
			<div id="spjasetDiv3Cri" class="findspjaset3Cri"></div>
		</div>
		</td>
		<td width="50">&nbsp;</td>
		<td width="50">
		<div id="imgMstCri" class="findimg0Cri">
			<div id="imgDiv1Cri" class="findimg1Cri"></div>
			<div id="imgDiv2Cri" class="findimg2Cri"></div>
		</div>
		<div id="aproveMstCri" class="aprove0Cri">
			<div id="aproveDiv1Cri" class="aprove1Cri"></div>
			<div id="aproveDiv2Cri" class="aprove2Cri"></div>
		</div>
		
		</td>
		<td width="50">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	</table>
	</td>
    <td width="42">&nbsp;</td>
    <td width="17">&nbsp;</td>
    <td width="104">&nbsp;</td>
    <td width="52">&nbsp;</td>
    <td width="20">&nbsp;</td>
    <td width="184">&nbsp;</td>
    <td width="113">&nbsp;</td>
    <td width="181">&nbsp;</td>
  </tr>
  
  <tr height="25">
    <td class="ar">UNIT KERJA </td>
    <td align="center">&nbsp;</td>
    <td>
	<input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" 
	<?php if ($Lev<=1){?>
	onclick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" 
	<?php } else {echo "readonly";} ?>
	style="padding-left:5px; width:350px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="find0Cri">
		<div id="unitDiv1Cri" class="find1Cri"></div>
		<div id="unitDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td class="ar">SUB UNI </td>
    <td align="center">&nbsp;</td>
    <td>
	<input name="fSUB" id="fSUB" type="text" value="<?=$gSUB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dSUB" id="dSUB" type="text" value="<?=$dSUB?>" 
	<?php if ($Lev<=2){?>
	onclick="showSUB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showSUB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('sub'); return false;}" 
	<?php } else {echo "readonly";} ?>
	style="padding-left:5px; width:350px; border: 1px solid #C0C0C0"/>
	<div id="subMstCri" class="find0Cri">
		<div id="subDiv1Cri" class="find1Cri"></div>
		<div id="subDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td align="right">TAHUN</td>
    <td align="center">&nbsp;</td>
    <td><select class="boxs" name="fTH" style="width:80px" tabindex="0" onchange="RefreshDATA('<?=$IdL?>')">
      <?php
	for($i=2020; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select></td>
    <td class="ar">TAHAP</td>
    <td>&nbsp;</td>
    <td><select class="boxs" name="fSES" tabindex="0" style="width:80px" onchange="RefreshDATA('<?=$IdL?>')">
      <option value="AA">ALL</option>
      <?php
		$nSQ="SELECT Kode, Deskripsi FROM ref_session ORDER BY Kode";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$sel ="";
			if ($mRo[0]==$gJNS) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[1].'</option>';
		}
		?>
    </select></td>
    <td>&nbsp;</td>
    <td><input type="hidden" name="B142" value="CETAK" onclick="showDOC('1','800','400','<?=$_GET['IdL']?>')" style="width: 100px; height: 21px; color:#0000FF" /></td>
  </tr>
  <tr height="25">
    <td class="ar">UPB</td>
    <td align="center">&nbsp;</td>
    <td>
	<input name="fUPB" id="fUPB" type="text" value="<?=$gUPB?>" readonly style="padding-left:5px; width:110px; border: 1px solid #C0C0C0"/>
	<input name="dUPB" id="dUPB" type="text" value="<?=$dUPB?>" 
	<?php if ($Lev<=3){?>
	onclick="showUPB('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13){ showUPB('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('upb'); return false;}" 
	<?php } else {echo "readonly";} ?>
	style="padding-left:5px; width:350px; border: 1px solid #C0C0C0"/>
	<input type="hidden" name="B13" value="..." onclick="findUPB('','<?=$_GET['IdL']?>')" style="width: 27px; height:21px" />
	<div id="upbMstCri" class="find0Cri">
		<div id="upbDiv1Cri" class="find1Cri"></div>
		<div id="upbDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td align="right">JENIS</td>
    <td align="center">&nbsp;</td>
    <td><select class="boxs" name="fJNS" tabindex="0" style="width:80px" onchange="RefreshDATA('<?=$IdL?>')">
      <option value="AA">ALL</option>
      <?php
		$nSQ="SELECT Kode, Deskripsi FROM ref_sp3d_jenis ORDER BY Kode";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$sel ="";
			if ($mRo[0]==$gJNS) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[1].'</option>';
		}
		?>
    </select></td>
    <td class="ar">FIND</td>
    <td>&nbsp;</td>
    <td><input name="fFnD" id="fFnD" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$IdL?>'); return false;}" style="padding-left:5px; width:170px; border: 1px solid #C0C0C0"/></td>
    <td><input type="button" name="B39" value="GO" onclick="RefreshDATA('<?=$IdL?>')" style="width:80px; height:22px" /></td>
    <td><input type="hidden" name="B14" value="CETAK RINCI" onclick="showDOC('2','800','400','<?=$_GET['IdL']?>')" style="width: 100px; height: 21px; color:#0000FF" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
	<!--div id="imgMstCri" class="upload_a">
		<div id="imgDiv1Cri" class="upload_b"></div>
		<div id="imgDiv2Cri" class="upload_c"></div>
	</div-->	</td>
    <td align="center"><div id="loadingImg" style="width:40px; height:10px; display:none; text-align:center"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background:#418406; color:#fff; font-weight:bold">
  <tr>
    <td width="97" align="left" style="border-left:0px solid #ccc; padding-left:3px">Ref./No. SP3B</td>
    <td width="230" align="left" style="border-left:1px solid #ccc; padding-left:3px">Rekening Belanja SP3B</td>
    <td width="230" align="left" style="border-left:1px solid #ccc; padding-left:3px">Rekening Aset (108)</td>
    <td width="230" align="left" style="border-left:1px solid #ccc; padding-left:3px">Nama Aset</td>
    <td width="47" align="left" style="border-left:1px solid #ccc; padding-left:3px">Satuan</td>
    <td width="90" align="center" style="border-left:1px solid #ccc; padding-left:3px">Harga</td>
    <td width="100" align="center" style="border-left:1px solid #ccc; padding-left:3px">Total</td>
    <td width="187" align="center" style="border-left:1px solid #ccc; padding-left:3px">Verifikasi Data</td>
    <td align="center" style="border-left:1px solid #ccc; padding-left:3px">Action</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:400px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	<div id="ViewDATA" style="height:400px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
<!--table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:20px; background-color:#D2DAC4">
  <tr>
    <td valign="top"></td>
  </tr>
</table-->
<br>
</form>
</body>
</html>
<script languange="javascript">
	var objfrm=document.myfrm;
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
	
	function RefreshDATA(IdL)
	{
		gUNT = objfrm.fUNT.value;
		gSUB = objfrm.fSUB.value;
		gUPB = objfrm.fUPB.value;
		gTH  = objfrm.fTH.value;
		gFnD = ReplaceText(objfrm.fFnD.value);
		gJNS = objfrm.fJNS.value;
		gSES = objfrm.fSES.value;
		
		$(document).ready(function()
		{
			$.ajax({
				url:"SP3D_SPJ_Data.php",
				data: {gUPB:gUPB,gSUB:gSUB,gUNT:gUNT,gTH:gTH,gFnD:gFnD,gJNS:gJNS,gSES:gSES,IdL:IdL},
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
		});
		
	}
	/*
	function showDOC(pil,w,h,IdL)
	{
		var gUNT = objfrm.fUNT.value;;
		var JeNS = objfrm.fJNS.value;
		
		var HR1 = objfrm.fHR.value;
		var BL1 = objfrm.fBL.value;
		var TH1 = objfrm.fTH.value;
		
		var HR2 = objfrm.fHRd.value;
		var BL2 = objfrm.fBLd.value;
		var TH2 = objfrm.fTHd.value;
		
		Today = new Date();
		
		var HR3 = Today.getDay();
		var BL3 = Today.getMonth();
		var TH3 = Today.getFullYear();
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='SP3D_SPJ_Frm_Data_Dok_'+pil+'.php?gUNT='+gUNT+'&JeNS='+JeNS+'&HR1='+HR1+'&HR2='+HR2+'&HR3='+HR3+'&BL1='+BL1+'&BL2='+BL2+'&BL3='+BL3+'&TH1='+TH1+'&TH2='+TH2+'&TH3='+TH3+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
		//closeCLICK('choise');
	}
	*/
	
	function showUNIT(CrT,gIdL)
	{
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dUNT.value);
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('SP3D_SPJ_Find_Unit_Mid.php?gFnD='+gFnD+'&IdL='+gIdL);
			});
		}
		else
		{
			globalClose('subMstCri');
			globalClose('upbMstCri');
			
			dispBLOCK('unitDiv2Cri');
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('SP3D_SPJ_Find_Unit_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('SP3D_SPJ_Find_Unit_Mid.php?IdL='+gIdL);
			});
			
			dispBlockOrNo('unitMstCri');
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
				$("#subDiv2Cri").load('SP3D_SPJ_Find_Sub_Mid.php?gFnD='+gFnD+'&gUNT='+fUNT+'&IdL='+gIdL);
			});
		}
		else
		{
			globalClose('upbMstCri');
			
			if (!fUNT) {alert('Silahkan pilih Unit Kerja terlebih dahulu..!!'); return false;}
			dispBLOCK('subDiv2Cri');
			
			$(document).ready(function()
			{
				$("#subDiv1Cri").load('SP3D_SPJ_Find_Sub_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('SP3D_SPJ_Find_Sub_Mid.php?gUNT='+fUNT+'&IdL='+gIdL);
			});
			
			dispBlockOrNo('subMstCri');
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
				$("#upbDiv2Cri").load('SP3D_SPJ_Find_Upb_Mid.php?gFnD='+gFnD+'&gSUB='+fSUB+'&IdL='+gIdL);
			});
		}
		else
		{
			if (!fSUB) {alert('Silahkan pilih Sub Unit terlebih dahulu..!!'); return false;}
			dispBLOCK('upbDiv2Cri');
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('SP3D_SPJ_Find_Upb_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('SP3D_SPJ_Find_Upb_Mid.php?gSUB='+fSUB+'&IdL='+gIdL);
			});
			
			dispBlockOrNo('upbMstCri');
		}
		$("#dUPB").select();
	}
	
	function showCLICK(crt,mesg,refs,kde,nma,IdL)
	{
		if (crt=='unit') 
		{
			objfrm.fUNT.value = kde;
			objfrm.dUNT.value = nma;
			
			objfrm.fSUB.value = 'ALL';
			objfrm.dSUB.value = 'ALL';
			
			objfrm.fUPB.value = 'ALL';
			objfrm.dUPB.value = 'ALL';
		}
		if (crt=='sub') 
		{
			objfrm.fSUB.value = kde;
			objfrm.dSUB.value = nma;
			
			objfrm.fUPB.value = 'ALL';
			objfrm.dUPB.value = 'ALL';
		}
		if (crt=='upb') 
		{
			objfrm.fUPB.value = kde;
			objfrm.dUPB.value = nma;
		}
		
		globalClose(crt+'MstCri');
	}
	
	/**MID SPJ**/
	function showSPJ(CrT,eIdT,rCek,IdL)
	{
		if (eIdT==''){alert('Belum ada entri data kapitalisasi...!!'); return false;}
		if (CrT=='refr'){
			$(document).ready(function()
			{
				$("#spjDiv2Cri").load('SP3D_SPJ_Data_Spj_Mid.php?eIdT='+eIdT+'&IdL='+IdL);
			});
		}
		else{
			dispBLOCK('spjDiv1Cri');
			dispBLOCK('spjDiv2Cri');
			$(document).ready(function()
			{
				$("#spjDiv1Cri").load('SP3D_SPJ_Data_Spj_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#spjDiv2Cri").load('SP3D_SPJ_Data_Spj_Mid.php?eIdT='+eIdT+'&IdL='+IdL);
			});
			dispBlockOrNo('spjMstCri');
		}
	}

	function SaveMidSPJ(eIdT,rCek,IdL)
	{
		fHRKon = $("#fHRKon").val();
		fBLKon = $("#fBLKon").val();
		fTHKon = $("#fTHKon").val();
		
		fHRBas = $("#fHRBas").val();
		fBLBas = $("#fBLBas").val();
		fTHBas = $("#fTHBas").val();
		
		fHRFak = $("#fHRFak").val();
		fBLFak = $("#fBLFak").val();
		fTHFak = $("#fTHFak").val();
		
		fNomKon= ReplaceText($("#fNomKon").val());
		fNomBas= ReplaceText($("#fNomBas").val());
		fNomFak= ReplaceText($("#fNomFak").val());
		
		fUrai  = ReplaceText($("#fUrai").val());
		$(document).ready(function() 
		{ 
			$("#spjDiv2Cri").load('SP3D_SPJ_Data_Spj_Save.php?eIdT='+eIdT
			+'&fHRKon='+fHRKon+'&fBLKon='+fBLKon+'&fTHKon='+fTHKon
			+'&fHRBas='+fHRBas+'&fBLBas='+fBLBas+'&fTHBas='+fTHBas
			+'&fHRFak='+fHRFak+'&fBLFak='+fBLFak+'&fTHFak='+fTHFak
			+'&fNomKon='+fNomKon+'&fNomBas='+fNomBas+'&fNomFak='+fNomFak
			+'&fUrai='+fUrai
			+'&IdL='+IdL); 
		}); 
    }
	/**END MID SPJ**/
	
	/**ASET**/
	function showASET(CrT,rIdT,IdTR,rCek,eFL,IdL)
	{
		if (IdTR==''){alert('Belum ada entri data kapitalisasi...!!'); return false;}
		if (CrT=='refr'){
			$(document).ready(function()
			{
				$("#spjasetDiv3Cri").load('SP3D_SPJ_Data_Mid_'+eFL+'.php?rIdT='+rIdT+'&IdTR='+IdTR+'&IdL='+IdL);
			});
		}
		else{
			
			dispBLOCK('spjasetDiv1Cri');
			dispBLOCK('spjasetDiv2Cri');
			dispBLOCK('spjasetDiv3Cri');
			
			$(document).ready(function()
			{
				$("#spjasetDiv1Cri").load('SP3D_SPJ_Data_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#spjasetDiv2Cri").load('SP3D_SPJ_Data_Hea.php?rIdT='+rIdT+'&IdTR='+IdTR+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#spjasetDiv3Cri").load('SP3D_SPJ_Data_Mid_'+eFL+'.php?rIdT='+rIdT+'&IdTR='+IdTR+'&IdL='+IdL);
			});
			
			dispBlockOrNo('spjasetMstCri');
		}
	}
	
	function SaveMidASET(CrtSave,IdTR,rIdT,rCek,IdL)
	{
		if (CrtSave=='E')
		{
			eNma = ReplaceText($("#eNma").val());
			
			eJud = ReplaceText($("#eJud").val());
			eDae = ReplaceText($("#eDae").val());
			eJen = ReplaceText($("#eJen").val());
			eSpe = ReplaceText($("#eSpe").val());
			ePen = ReplaceText($("#ePen").val());
			eUku = ReplaceText($("#eUku").val());
			eBah = ReplaceText($("#eBah").val());
			eThn = ReplaceText($("#eThn").val());
			
			eKet = ReplaceText($("#eKet").val());
			eMil = $("#eMil").val();
			eAsa = ReplaceText($("#eAsa").val());
			eKon = ReplaceText($("#eKon").val());
			eSat = ReplaceText($("#eSat").val());
			eHrg = ReplaceText($("#eHrg").val());
					
			$(document).ready(function()
			{
				$("#spjasetDiv3Cri").load('SP3D_SPJ_Data_Mid_Save.php?CrtSave='+CrtSave
				+'&eNma='+eNma
				
				+'&eJud='+eJud
				+'&eDae='+eDae
				+'&eJen='+eJen
				+'&eSpe='+eSpe
				+'&ePen='+ePen
				+'&eUku='+eUku
				+'&eBah='+eBah
				+'&eThn='+eThn
				
				+'&eKet='+eKet
				+'&eMil='+eMil
				+'&eAsa='+eAsa
				+'&eKon='+eKon
				+'&eSat='+eSat
				+'&eHrg='+eHrg
				+'&IdTR='+IdTR+'&rIdT='+rIdT+'&IdL='+IdL
				);
			});
		}
	
	
		if (CrtSave=='F')
		{
			fNma = ReplaceText($("#fNma").val());
			fLok = ReplaceText($("#fLok").val());
			
			fTin = ReplaceText($("#fTin").val());
			fBet = ReplaceText($("#fBet").val());
			fPan = ReplaceText($("#fPan").val());
			fLeb = ReplaceText($("#fLeb").val());
			fLua = ReplaceText($("#fLua").val());
			
			fKet = ReplaceText($("#fKet").val());
			fMil = $("#fMil").val();
			fAsa = ReplaceText($("#fAsa").val());
			fSat = ReplaceText($("#fSat").val());
			fHrg = ReplaceText($("#fHrg").val());
					
			$(document).ready(function()
			{
				$("#spjasetDiv3Cri").load('SP3D_SPJ_Data_Mid_Save.php?CrtSave='+CrtSave
				+'&fNma='+fNma
				+'&fLok='+fLok
				
				+'&fTin='+fTin
				+'&fBet='+fBet
				+'&fPan='+fPan
				+'&fLeb='+fLeb
				+'&fLua='+fLua
				
				+'&fKet='+fKet
				+'&fMil='+fMil
				+'&fAsa='+fAsa
				+'&fSat='+fSat
				+'&fHrg='+fHrg
				+'&IdTR='+IdTR+'&rIdT='+rIdT+'&IdL='+IdL
				);
			});
		}
	
		if (CrtSave=='D')
		{
			dNma = ReplaceText($("#dNma").val());
			dLok = ReplaceText($("#dLok").val());
			
			dKot = ReplaceText($("#dKot").val());
			dPan = ReplaceText($("#dPan").val());
			dLeb = ReplaceText($("#dLeb").val());
			dLua = ReplaceText($("#dLua").val());
			
			dKet = ReplaceText($("#dKet").val());
			dMil = $("#dMil").val();
			dKon = ReplaceText($("#dKon").val());
			dAsa = ReplaceText($("#dAsa").val());
			dSat = ReplaceText($("#dSat").val());
			dHrg = ReplaceText($("#dHrg").val());
					
			$(document).ready(function()
			{
				$("#spjasetDiv3Cri").load('SP3D_SPJ_Data_Mid_Save.php?CrtSave='+CrtSave
				+'&dNma='+dNma
				+'&dLok='+dLok
				
				+'&dKot='+dKot
				+'&dPan='+dPan
				+'&dLeb='+dLeb
				+'&dLua='+dLua
				
				+'&dKet='+dKet
				+'&dMil='+dMil
				+'&dKon='+dKon
				+'&dAsa='+dAsa
				+'&dSat='+dSat
				+'&dHrg='+dHrg
				+'&IdTR='+IdTR+'&rIdT='+rIdT+'&IdL='+IdL
				);
			});
		}
	
		if (CrtSave=='C')
		{
			cNma = ReplaceText($("#cNma").val());
			cLet = ReplaceText($("#cLet").val());
			cTin = ReplaceText($("#cTin").val());
			cBet = ReplaceText($("#cBet").val());
			cLua = ReplaceText($("#cLua").val());
			cKet = ReplaceText($("#cKet").val());
			cMil = $("#cMil").val();
			cKon = ReplaceText($("#cKon").val());
			cAsa = ReplaceText($("#cAsa").val());
			cSat = ReplaceText($("#cSat").val());
			cHrg = ReplaceText($("#cHrg").val());
					
			$(document).ready(function()
			{
				$("#spjasetDiv3Cri").load('SP3D_SPJ_Data_Mid_Save.php?CrtSave='+CrtSave
				+'&cNma='+cNma
				+'&cLet='+cLet
				+'&cTin='+cTin
				+'&cBet='+cBet
				+'&cLua='+cLua
				+'&cKet='+cKet
				+'&cMil='+cMil
				+'&cKon='+cKon
				+'&cAsa='+cAsa
				+'&cSat='+cSat
				+'&cHrg='+cHrg
				+'&IdTR='+IdTR+'&rIdT='+rIdT+'&IdL='+IdL
				);
			});
		}
	
		if (CrtSave=='B')

		{
			bNma = ReplaceText($("#bNma").val());
			
			bMer = ReplaceText($("#bMer").val());
			bTip = ReplaceText($("#bTip").val());
			bUku = ReplaceText($("#bUku").val());
			bBhn = ReplaceText($("#bBhn").val());
			
			bPab = ReplaceText($("#bPab").val());
			bMes = ReplaceText($("#bMes").val());
			bBpk = ReplaceText($("#bBpk").val());
			bRan = ReplaceText($("#bRan").val());
			bPol = ReplaceText($("#bPol").val());
			
			bKet = ReplaceText($("#bKet").val());
			bMil = $("#bMil").val();
			bKon = ReplaceText($("#bKon").val());
			bAsa = ReplaceText($("#bAsa").val());
			bSat = ReplaceText($("#bSat").val());
			bHrg = ReplaceText($("#bHrg").val());
					
			$(document).ready(function()
			{
				$("#spjasetDiv3Cri").load('SP3D_SPJ_Data_Mid_Save.php?CrtSave='+CrtSave
				+'&bNma='+bNma
				+'&bMer='+bMer
				+'&bTip='+bTip
				+'&bUku='+bUku
				+'&bBhn='+bBhn
				+'&bPab='+bPab
				+'&bMes='+bMes
				+'&bBpk='+bBpk
				+'&bRan='+bRan
				+'&bPol='+bPol
				+'&bKet='+bKet
				+'&bMil='+bMil
				+'&bKon='+bKon
				+'&bAsa='+bAsa
				+'&bSat='+bSat
				+'&bHrg='+bHrg
				+'&IdTR='+IdTR+'&rIdT='+rIdT+'&IdL='+IdL
				);
			});
		}
		
		if (CrtSave=='A')
		{
			aNma = ReplaceText($("#aNma").val());
			aLet = ReplaceText($("#aLet").val());
			aHak = ReplaceText($("#aHak").val());
			aGun = ReplaceText($("#aGun").val());
			aLua = ReplaceText($("#aLua").val());
			aKet = ReplaceText($("#aKet").val());
			aMil = $("#aMil").val();
			aAsa = ReplaceText($("#aAsa").val());
			aSat = ReplaceText($("#aSat").val());
			aHrg = ReplaceText($("#aHrg").val());
					
			$(document).ready(function()
			{
				$("#spjasetDiv3Cri").load('SP3D_SPJ_Data_Mid_Save.php?CrtSave='+CrtSave
				+'&aNma='+aNma+'&aLet='+aLet+'&aHak='+aHak+'&aGun='+aGun+'&aLua='+aLua+'&aKet='+aKet
				+'&aMil='+aMil+'&aAsa='+aAsa+'&aSat='+aSat+'&aHrg='+aHrg
				+'&IdTR='+IdTR+'&rIdT='+rIdT+'&IdL='+IdL
				);
			});
		}
	}
	
	function EditMidASET(IdTR,rIdT,fL,IdL)
	{
		$(document).ready(function()
		{
			$("#spjasetDiv3Cri").load('SP3D_SPJ_Data_Mid_'+fL+'.php?IdTR='+IdTR+'&rIdT='+rIdT+'&IdL='+IdL);
		});
	}
	
	function ResetMidASET(fL,rIdT,IdL)
	{
		$(document).ready(function()
		{
			$("#spjasetDiv3Cri").load('SP3D_SPJ_Data_Mid_'+fL+'.php?rIdT='+rIdT+'&IdL='+IdL);
		});
	}
	/**END ASET**/
	
	/**UPLOAD IMAGES**/
	function showUPLOAD(CrT,eIdT,rCek,IdL)
	{
		if (eIdT==''){alert('Belum ada entri data kapitalisasi...!!'); return false;}
		if (CrT=='refr'){
			$(document).ready(function()
			{
				$("#imgDiv2Cri").load('SP3D_SPJ_Data_Mid_Upl_Mid.php?eIdT='+eIdT+'&IdL='+IdL);
			});
		}
		else{
			dispBLOCK('imgDiv1Cri');
			dispBLOCK('imgDiv2Cri');
			$(document).ready(function()
			{
				$("#imgDiv1Cri").load('SP3D_SPJ_Data_Mid_Upl_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#imgDiv2Cri").load('SP3D_SPJ_Data_Mid_Upl_Mid.php?eIdT='+eIdT+'&IdL='+IdL);
			});
			dispBlockOrNo('imgMstCri');
		}
	}
	
	function addIMG(eIdT,IdL)
	{
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('SP3D_SPJ_Data_Mid_Upl_Mid_Bro.php?eIdT='+eIdT+'&IdL='+IdL);
		});
	}
	
	
	function P_Upload(eIdT,IdL)
	{
		if (objfrm.imgfile.value=="")
		{
			alert('Silahkan pilih file terlebih dahulu..!!');
			return false;
		}
		
		var spl = objfrm.imgfile.value.split('.');
		var Ext = spl[1].toLowerCase();
		
		objfrm.UplIdT.value=eIdT;
		objfrm.fSave.value='Upload';
		objfrm.submit();
	}
	
	function viewIMG(rIdT,w,h,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='SP3D_SPJ_Data_Mid_Upl_Mid_Vie.php?rIdT='+rIdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open(URL,'',settings);
	}
	
	function remoIMG(CrT,eIdT,rIdT,IdL)
	{
		var AN = confirm("Remove file..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('SP3D_SPJ_Data_Mid_Upl_Mid_Rem.php?CrT='+CrT+'&eIdT='+eIdT+'&rIdT='+rIdT+'&IdL='+IdL);
			});
		}
	}
	/**END UPLOAD IMAGES**/
	
	/**APROVE**/
	function showAPROVE(CrT,eIdT,IdTR,rCek,IdL)
	{
		if (eIdT==''){alert('Belum ada entri data kapitalisasi...!!'); return false;}
		if (CrT=='refr'){
			$(document).ready(function()
			{
				$("#aproveDiv2Cri").load('SP3D_SPJ_Data_Aprove_Mid.php?eIdT='+eIdT+'&IdTR='+IdTR+'&IdL='+IdL);
			});
		}
		else{
			dispBLOCK('aproveDiv1Cri');
			dispBLOCK('aproveDiv2Cri');
			$(document).ready(function()
			{
				$("#aproveDiv1Cri").load('SP3D_SPJ_Data_Aprove_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#aproveDiv2Cri").load('SP3D_SPJ_Data_Aprove_Mid.php?eIdT='+eIdT+'&IdTR='+IdTR+'&IdL='+IdL);
			});
			dispBlockOrNo('aproveMstCri');
		}
	}
	
	function prosesAPROVE(CrT,eIdT,IdTR,rCek,IdL)
	{
		AN = confirm('Proses data..??');
		if (!AN){
			return false;
		}
		
		Pro = "";
		Len = objfrm.radioApp.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.radioApp[i].checked) {Pro = objfrm.radioApp[i].value; break; }
		}
		
		$(document).ready(function()
		{
			//$("#aproveDiv2Cri").load('SP3D_SPJ_Data_Aprove_Save.php?eIdT='+eIdT+'&IdTR='+IdTR+'&Pro='+Pro+'&IdL='+IdL);
			$.ajax({
				url:"SP3D_SPJ_Data_Aprove_Save.php",
				data: {eIdT:eIdT,IdTR:IdTR,Pro:Pro,IdL:IdL},
				type:"get",
				beforeSend:function()
				{
					$("#loadingImg2").show();
				},
				success:function(data)
				{
					$("#loadingImg2").hide();
					$("#aproveDiv2Cri").html(data);
					$("#aproveDiv2Cri").show("fast");
				}
			});
		});
	}
	
	/**END APROVE**/
	
	$("#fFnD").focus();
</script>