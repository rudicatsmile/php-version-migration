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
	$gUNT = substr($SkP,0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	$gSUB = substr($SkP,0,14);
	$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
	$gUPB = substr($SkP,0,18);
	$dUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
}
#if ($Lev > 1){
#	$gUNT = substr($SkP,0,11);
#	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
#}
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="SP3D_Veri_Frm_.php?IdL=".$_GET['IdL']?>">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td width="73">&nbsp;</td>
    <td width="21">&nbsp;</td>
    <td width="501">&nbsp;</td>
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
    <td rowspan="3" valign="bottom"><input type="button" name="B39" value="GO" onclick="RefreshDATA('<?=$IdL?>')" style="width:80px; height:25px" /></td>
    <td rowspan="3" valign="bottom" align="right" style="padding-right:10px">
	<input type="button" name="B1422" value="FORM SP3B" onclick="showLINK('<?=$_GET['IdL']?>')" style="width: 100px; height:25px" /><br>
	<input type="button" name="B1422" value="C E T A K" onclick="showPRINT('800','400','<?=$_GET['IdL']?>')" style="width: 100px; height:25px; color:#0000FF" />
	</td>
  </tr>
  <tr height="25">
    <td class="ar">SUB UNIT</td>
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
	style="padding-left:5px; width:321px; border: 1px solid #C0C0C0"/>
	<input type="button" name="B13" value="..." <?php if ($Lev<=1){?> onclick="findUPB('','<?=$_GET['IdL']?>')" <?php } ?> style="width: 27px; height:21px" />
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
    <td><input name="fFnD" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$IdL?>'); return false;}" style="padding-left:5px; width:170px; border: 1px solid #C0C0C0"/></td>
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
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #C9DCD8; font-weight:bold">
  <tr>
    <td width="28" align="center" style="border-right:1px #ccc solid">NO</td>
    <td width="110" align="center" style="border-right:1px #ccc solid">REFERENSI</td>
    <td width="70" align="center" style="border-right:1px #ccc solid">TGL. SP3B</td>
    <td width="145" align="center" style="border-right:1px #ccc solid">NOMOR SP3B</td>
    <td width="215" align="center" style="border-right:1px #ccc solid">U P B</td>
    <td width="65" align="center" style="border-right:1px #ccc solid">JENIS</td>
    <td width="56" align="center" style="border-right:1px #ccc solid">TAHAP</td>
    <td width="245" align="center" style="border-right:1px #ccc solid">URAIAN</td>
    <td width="101" align="right" style="border-right:1px #ccc solid; padding-right:2px">NILAI SP3B</td>
    <td width="101" align="right" style="border-right:1px #ccc solid; padding-right:2px">KAPITALISASI</td>
    <td align="center">ACTION</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:330px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	<div id="ViewDATA" style="height:330px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:20px; background-color:#D2DAC4">
  <tr>
    <td valign="top">
	</td>
  </tr>
</table>
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
	
	function closeCLICK(crt,IdL)
	{
		//document.getElementById(crt+'MstVeri').style.display = "none";
		document.getElementById(crt+'MstCri').style.display = "none";
		
		//if (crt=='form') {RefreshDATA(IdL);}
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
				url:"SP3D_Data.php",
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
	
	function showEDIT(IdT,IdL)
	{
		window.open('SP3D_Frm.php?FrmG=DANA BOS -> FORM INPUT SP3D&IdT='+IdT+'&IdL='+IdL,'_self');
	}
	
	function P_Dokumen(w,h,IdT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='SP3D_Frm_Data_Dok_Rinci.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
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
		URL='SP3D_Frm_Data_Dok_'+pil+'.php?gUNT='+gUNT+'&JeNS='+JeNS+'&HR1='+HR1+'&HR2='+HR2+'&HR3='+HR3+'&BL1='+BL1+'&BL2='+BL2+'&BL3='+BL3+'&TH1='+TH1+'&TH2='+TH2+'&TH3='+TH3+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
		//closeCLICK('choise');
	}
	
	function showDELE(Lock,IdT,Cek,IdL)
	{
		if (Lock=='Y'){alert('Access denied, data sudah terkunci..!!'); return false;}
		if (Cek=='NoDelA'){alert('Access denied..!!'); return false;}
		if (Cek=='NoDelS'){alert('Access denied..!!'); return false;}
		
		var AN = confirm("Hapus transaski usulan ini ..?!!");
		if (AN)
		{
			//$(document).ready(function()
			//{
			//	$("#ViewDATA").load('SP3D_Exec_Frm_Save.php?rBatal='+rBatal+'&tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
			//	//$("#formDiv2Exec").load('SP3D_Exec_Frm_Save.php?tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
			//});
			
			
			$(document).ready(function()
			{
				$.ajax({
					url:"SP3D_Data_Dell.php",
					data: {IdT:IdT,IdL:IdL},
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
			});
			
		}
	}
	
	function showUNIT(CrT,gIdL)
	{
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dUNT.value);
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('SP3D_Find_Unit_Mid.php?gFnD='+gFnD+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('subMstCri').style.display = "none";
			document.getElementById('upbMstCri').style.display = "none";
			
			document.getElementById('unitDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('SP3D_Find_Unit_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('SP3D_Find_Unit_Mid.php?IdL='+gIdL);
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
				$("#subDiv2Cri").load('SP3D_Find_Sub_Mid.php?gFnD='+gFnD+'&gUNT='+fUNT+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('upbMstCri').style.display = "none";
			
			if (!fUNT) {alert('Silahkan pilih Unit Kerja terlebih dahulu..!!'); return false;}
			document.getElementById('subDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#subDiv1Cri").load('SP3D_Find_Sub_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('SP3D_Find_Sub_Mid.php?gUNT='+fUNT+'&IdL='+gIdL);
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
				$("#upbDiv2Cri").load('SP3D_Find_Upb_Mid.php?gFnD='+gFnD+'&gSUB='+fSUB+'&IdL='+gIdL);
			});
		}
		else
		{
			if (!fSUB) {alert('Silahkan pilih Sub Unit terlebih dahulu..!!'); return false;}
			document.getElementById('upbDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('SP3D_Find_Upb_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('SP3D_Find_Upb_Mid.php?gSUB='+fSUB+'&IdL='+gIdL);
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
		document.getElementById(crt+'MstCri').style.display = "none";
	}
	
	function showLINK(IdL)
	{
		URL='SP3D_Frm.php?FrmG=DANA BOS -> FORM INPUT SP3D&IdL='+IdL;
		window.open(URL,'MidFrame','');
	}

	function showPRINT(w,h,IdL)
	{
		gUPB = objfrm.fUPB.value;;
		gJNS = objfrm.fJNS.value;
		gTHN = objfrm.fTH.value;
		gSES = objfrm.fSES.value;
		gFnD = ReplaceText(objfrm.fFnD.value);
		
		Today = new Date();
		var HR3 = Today.getDay();
		var BL3 = Today.getMonth();
		var TH3 = Today.getFullYear();
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='SP3D_Data_Dok.php?gUPB='+gUPB+'&gJNS='+gJNS+'&gTHN='+gTHN+'&gSES='+gSES+'&gFnD='+gFnD+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
		//closeCLICK('choise');
	}
</script>