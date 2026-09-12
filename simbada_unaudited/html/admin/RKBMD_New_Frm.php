<?
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
<script type="text/javascript" src="FileFormatNum.js"></script>
</head>
<?
extract($_GET);
$gREF= "RKB.".(fGetDate('year')+1).".XXXXXXXX";
$gUNT = substr($SkP,0,11);
$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
$gURA = "";

$gTHN = fGetDate('year')+1;
if ($IdT)
{
	$nSQL= "SELECT Referensi, Kd_Unit, Tahun, Uraian, Apbd FROM ta_rkbmd_new WHERE IDT='$IdT'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	$gREF = $mRo[0];
	$gUNT = substr($mRo[1],0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	
	$gTHN = $mRo[2];
	$gURA = $mRo[3];
	$gUBH = $mRo[4];
	
	$stLOCK = fGlobalNEW("pengadaanBMD","ta_unit_lock","kdUnit:tahunBMD:periodeBMD",$gUNT.":".$gTHN.":".$gUBH,"=:=:=","",DatabaseSB,$ConSB,"");
}

?>
<body onload="RefreshDATA('<?=$stLOCK?>','<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="RKBMD_New_Frm_.php?FrmG=".$_GET['FrmG']."&IdT=".$IdT."&IdL=".$_GET['IdL']?>" enctype="multipart/form-data">
<input type="hidden" name="fSave" style="width:20px" />
<input type="hidden" name="fCrT" style="width:20px" />
<input type="hidden" name="fIdT" style="width:20px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; background:#6892BC; color:#FFFFFF">
  <tr>
    <td width="13">&nbsp;</td>
    <td width="90">&nbsp;</td>
    <td width="22">&nbsp;</td>
    <td width="71">&nbsp;</td>
    <td width="101">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="19">&nbsp;</td>
    <td width="198">&nbsp;</td>
    <td width="60">&nbsp;</td>
    <td width="626">&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">UNIT KERJA </td>
    <td align="center">:</td>
    <td colspan="5">
	<input name="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" type="text" value="<?=$dUNT?>" <? if ($IdT=='' && $Lev <= 1) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" <? } else {echo "readonly";}?> style="padding-left:5px; width:372px; border: 1px solid #C0C0C0; text-transform:uppercase"/>
	<div id="unitMstCri" class="find0Cri">
		<div id="unitDiv1Cri" class="find1Cri"></div>
		<div id="unitDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    <td>URAIAN</td>
    <td rowspan="2">
	<textarea name="fURA" style="border: 1px solid #C0C0C0; height:45px; width:500px"><?=$gURA?></textarea></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">PERIODE</td>
    <td align="center">:</td>
    <td colspan="2">
	<? if ($IdT){?>
		<input name="fTHN" id="fTHN" type="text" value="<?=$gTHN?>" readonly style="text-align:center; width:73px; border: 1px solid #C0C0C0"/>
		<input name="fUBH" id="fUBH" type="hidden" value="<?=$gUBH?>" style="text-align:center; width:45px; border: 1px solid #C0C0C0"/>
		<input name="dUBH" id="dUBH" type="text" value="<? if ($gUBH=="1") {echo "Perubahan";} else {echo "Murni";}?>" readonly style="width:78px; border: 1px solid #C0C0C0; padding-left:5px; background:#99FF00"/>
	<? } else {?>
		<select class="boxs" name="fTHN" id="fTHN" tabindex="0" style="width:78px; background:#99FF00">
		<?
		for ($i=2019; $i<=2030; $i++)
		{
			$sel ="";
			if ($gTHN==$i){
				$sel="selected";
			}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
		</select>
		
		<select class="boxs" name="fUBH" id="fUBH" tabindex="0" style="width:90px">
		<option value="0">Murni</option>
		<!--option value="1">Perubahan</option-->
		</select>
	<? } ?>
	<div id="progMstCri" class="findpkr0Cri">
		<div id="progDiv1Cri" class="findpkr1Cri"></div>
		<div id="progDiv2Cri" class="findpkr2Cri"></div>
	</div>
	
	<div id="kegiMstCri" class="findpkr0Cri">
		<div id="kegiDiv1Cri" class="findpkr1Cri"></div>
		<div id="kegiDiv2Cri" class="findpkr2Cri"></div>
	</div>
	
	<div id="subkMstCri" class="findpkr0Cri">
		<div id="subkDiv1Cri" class="findpkr1Cri"></div>
		<div id="subkDiv2Cri" class="findpkr2Cri"></div>
	</div>
	
	<div id="reknMstCri" class="findpkr0Cri">
		<div id="reknDiv1Cri" class="findpkr1Cri"></div>
		<div id="reknDiv2Cri" class="findpkr2Cri"></div>
	</div>
	  </td>
    <td width="91" align="right">REFERENSI</td>
    <td align="center">&nbsp;</td>
    <td><input name="fREF" type="text" value="<?=$gREF?>" readonly style=" width:130px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
    </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td></td>
    <td colspan="2"></td>
    <td align="center">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    <td><div id="loadingImg" style="width:40px; height:10px; display:none"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:30px; background: #EAE6E6">
  <tr>
    <td width="5">&nbsp;</td>
    <td><input type="button" name="B39" <?=$DisA?> value="SAVE" onclick="Save('<?=$stLOCK?>')" style="width: 80px; height: 21px" />
      <input type="button" name="B10" value="RESET" onclick="Reset()" style="width: 80px; height: 21px" />
      <input type="button" name="B11" value="REFRESH" onclick="RefreshDATA('<?=$stLOCK?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
	  <input type="button" name="B12" value="ADD PROGRAM" onclick="showPROG('<?=$stLOCK?>','','<?=$IdT?>','<?=$_GET['IdL']?>')" style="width: 130px; height: 21px; color:#0000FF" /><?=str_repeat("&nbsp;",10)?>
	  <input type="button" name="B13" value="DAFTAR USULAN" onclick="showDATANew('<?=$_GET['IdL']?>')" style="width: 130px; height: 21px" />
	  	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type="button" name="B14" <? if ($IdT=="") {echo "disabled";}?> value="CETAK RINCI ( I )" onclick="P_Dokumen('800','400','<?=$gUBH?>','RKBMD_New_Dokumen','<?=$IdT?>','<?=$_GET['IdL']?>')" style="width: 120px; height: 21px; color:#0000FF" />
	  <input type="button" name="B14" <? if ($IdT=="") {echo "disabled";}?> value="CETAK RINCI ( II )" onclick="P_Dokumen('800','400','<?=$gUBH?>','RKBMD_New_Dokumen_ii','<?=$IdT?>','<?=$_GET['IdL']?>')" style="width: 120px; height: 21px; color:#0000FF" />
	  <input type="hidden" name="B13" value="CETAK DAFTAR" onclick="choiseTANGGAL('<?=$_GET['IdL']?>')" style="width: 130px; height: 21px; color:#0000FF" />
	  <div style="float:right">
	  <input type="hidden" name="B16" <?=$DisB?> value="DELETE" onclick="P_Delete('<?=$IdT?>','<?=$CeK?>')" style="width: 80px; height: 21px; color:#<?=$ColB?>" />
	  </div>	  </td>
    <td width="5">&nbsp;</td>
  </tr>
</table>
<? if ($IdT) {?>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #CEFBE3; font-weight:bold">
  <tr>
    <td width="30" align="center">&nbsp;</td>
    <td width="100" align="center">&nbsp;</td>
    <td width="76" align="center"></td>
    <td width="76" align="center">&nbsp;</td>
    <td width="184" align="left">&nbsp;</td>
    <td width="57" align="center">&nbsp;</td>
    <td width="350" align="left">&nbsp;</td>
    <td width="79" align="right">&nbsp;</td>
    <td width="104" align="right">&nbsp;</td>
    <td width="55" align="center">&nbsp;</td>
    <td width="100" align="center">&nbsp;</td>
    <td width="80" align="center">&nbsp;</td>
  </tr>
</table>
<? } ?>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td valign="top">
	<div id="ViewDATA" style="height:380px; width:100%; overflow:auto; border:0px"></div>
	<div id="ViewDELL" style="height:30px; width:900px; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
<!--table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td valign="top">
	<div id="ViewDATAaX" style="height:50px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table-->
</form>
</body>
</html>
<script languange="javascript">
	var objfrm=document.myfrm;
	
	function RefreshDATA(stLOCK,IdL)
	{
		var gREF = objfrm.fREF.value;
		var gTHN = objfrm.fTHN.value;
		var gUBH = objfrm.fUBH.value;
		
		$(document).ready(function()
		{
			$.ajax({
				url:"RKBMD_New_Frm_Data.php",
				data: {stLOCK:stLOCK,gREF:gREF,gTHN:gTHN,gUBH:gUBH,IdL:IdL},
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
	
	function showUNIT(CrT,gIdL)
	{
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.dUNT.value);
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('RKBMD_New_Frm_Find_Unit_Mid.php?gFnD='+gFnD+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('unitDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('RKBMD_New_Frm_Find_Unit_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('RKBMD_New_Frm_Find_Unit_Mid.php?IdL='+gIdL);
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

	/*
	function proslNIL(crt,IdT,gTBL,IdL)
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
			$("#ViewDELL").load('Invent_Usulan_Frm_Find_Aset_Mid_CheckList.php?IdT='+IdT+'&gTBL='+gTBL+'&gCrID='+gCrID+'&IdL='+IdL);
			
		});
		document.getElementById(crt+'MstCri').style.display = "none";
	}
	*/
	
	function showCLICK(crt,mesg,refs,kde,nma,IdL)
	{
		if (mesg=='mesga') {alert('Data aset ini sudah masuk diusulan yang sedang proses..!!'); return false;}
		if (mesg=='mesgb') {alert('Data aset ini sudah dalam proses usulan : '+refs); return false;}
		
		if (crt=='unit') 
		{
			objfrm.fUNT.value = kde;
			objfrm.dUNT.value = nma;
			
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
	
	function Save(stLOCK)
	{
		if (stLOCK=='1'){alert('Access denied, data sudah terkunci..!!'); return false;}
		objfrm.fSave.value='Save';
		objfrm.submit();
	}
	
	function Reset()
	{
		objfrm.fSave.value='Reset';
		objfrm.submit();
	}
	
	function P_Remove(PgE,rIdT,DeL,IdL)
	{
		if (DeL=="DelVer") {
			var AN = confirm("Data sedang diverifikasi oleh pengelola, lanjutkan pembatalan..?!!");
			if (AN)
			{
				$(document).ready(function()
				{
					$("#ViewDELL").load('Invent_Usulan_Frm_Del.php?PgE='+PgE+'&DelVer=Ya&rIdT='+rIdT+'&IdL='+IdL);
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
					$("#ViewDELL").load('Invent_Usulan_Frm_Del.php?PgE='+PgE+'&rIdT='+rIdT+'&IdL='+IdL);
				});
			}
		}
	}

	function choiseTANGGAL(IdL)
	{
		document.getElementById('choiseDiv2Cri').style.display = "block";
		$(document).ready(function()
		{
			$("#choiseDiv1Cri").load('Invent_Usulan_Frm_Choise_Top.php');
		});
		
		$(document).ready(function()
		{
			$("#choiseDiv2Cri").load('Invent_Usulan_Frm_Choise_Mid.php?IdL='+IdL);
		});
		
		if (document.getElementById('choiseMstCri').style.display == "block")
		{
			document.getElementById('choiseMstCri').style.display = "none";
		}
		else
		{
			document.getElementById('choiseMstCri').style.display = "block";
		}
	}
	
	function showDATANew(IdL)
	{
		gUNT = objfrm.fUNT.value;
		window.open('RKBMD_New.php?FrmG=DAFTAR USULAN PENGADAAN BMD&gUNT='+gUNT+'&IdL='+IdL,'_self');
	}
	
	function showLINK(IdT,IdL)
	{
		URL='Invent_Usulan_Frm.php?IdT='+IdT+'&IdL='+IdL;
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
			$("#imgDiv2Cri").load('Invent_Usulan_Frm_Data_Edit_Upl_Mid_Bro.php?gIdT='+gIdT+'&CrT='+CrT+'&IdL='+gIdL);
		});
	}
	
	function showREF(CrT,gIdT,gIdL)
	{
		var gRF = objfrm.fREF.value;
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('Invent_Usulan_Frm_Data_Edit_Mid.php?gIdT='+gIdT+'&gRF='+gRF+'&CrT='+CrT+'&IdL='+gIdL);
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
			$("#imgDiv1Cri").load('Invent_Usulan_Frm_Data_Edit_Top.php?gJN='+gJN+'&CrT='+CrT+'&IdL='+gIdL);
		});
		
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('Invent_Usulan_Frm_Data_Edit_Mid.php?gIdT='+gIdT+'&gRF='+gRF+'&CrT='+CrT+'&IdL='+gIdL);
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
	
	function viewIMG(rIdT,w,h,gIdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='Invent_Usulan_Frm_Data_Edit_Upl_Top_Vie.php?rIdT='+rIdT+'&IdL='+gIdL;
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
			//$("#ViewDELL").load('Invent_Usulan_Frm_Data_Edit_Mid_Find_Add.php?gFrm='+Frm+'&gID='+gid+'&gKD='+kde+'&IdL='+IdL);
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
				$("#alasDiv2Cri").load('Invent_Usulan_Frm_Data_Edit_Mid_Find_Mid.php?rMsT='+rMsT+'&vMsT='+vMsT+'&gFnD='+gFnD+'&gFrm='+Frm+'&gID='+gID+'&gJN='+gJN+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('alasDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#alasDiv1Cri").load('Invent_Usulan_Frm_Data_Edit_Mid_Find_Top.php?rMsT='+rMsT+'&vMsT='+vMsT+'&gFrm='+Frm+'&gID='+gID+'&IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#alasDiv2Cri").load('Invent_Usulan_Frm_Data_Edit_Mid_Find_Mid.php?rMsT='+rMsT+'&vMsT='+vMsT+'&gFrm='+Frm+'&gID='+gID+'&gJN='+gJN+'&IdL='+gIdL);
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
	
	function P_Dokumen(w,h,Ubh,FlD,IdT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		Abt = "";
		if (Ubh=='1'){
			Abt = "_Abt";
		}
		URL=FlD+Abt+'.php?IdT='+IdT+'&IdL='+IdL;
		//URL='RKBMD_New_Dokumen.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function showPROG(stLOCK,CrT,IdT,IdL)
	{
		if (stLOCK=='1'){alert('Access denied, data sudah terkunci..!!'); return false;}
		document.getElementById('kegiMstCri').style.display = "none";
		document.getElementById('reknMstCri').style.display = "none";
		if (!IdT) {alert('Data belum tersimpan...!'); return false;}
		var gUNT = objfrm.fUNT.value;
		var gTHN = objfrm.fTHN.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.fFindPR.value);
			$(document).ready(function()
			{
				$("#progDiv2Cri").load('RKBMD_New_Frm_Find_PKRK_Mid.php?gFrm=prog&gFnD='+gFnD+'&gTHN='+gTHN+'&stLOCK='+stLOCK+'&IdT='+IdT+'&gUNT='+gUNT+'&IdL='+IdL);
			});
		}
		else
		{
			document.getElementById('progDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#progDiv1Cri").load('RKBMD_New_Frm_Find_PKRK_Top.php?gFrm=prog&stLOCK='+stLOCK+'&gUNT='+gUNT+'&gTHN='+gTHN+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#progDiv2Cri").load('RKBMD_New_Frm_Find_PKRK_Mid.php?gFrm=prog&stLOCK='+stLOCK+'&IdT='+IdT+'&gUNT='+gUNT+'&gTHN='+gTHN+'&IdL='+IdL);
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
	
	function showPKRK_add(stLOCK,crt,iD,IdT,IdP,IdL)
	{
		document.getElementById(crt+'MstCri').style.display = "none";
		var gTHN = objfrm.fTHN.value;
		$(document).ready(function()
		{
			$("#ViewDATA").load('RKBMD_New_Frm_Find_PKRK_Add.php?stLOCK='+stLOCK+'&gTHN='+gTHN+'&crt='+crt+'&iD='+iD+'&IdT='+IdT+'&IdP='+IdP+'&IdL='+IdL);
			//$("#ViewDELL").load('RKBMD_New_Frm_Find_PKRK_Add.php?stLOCK='+stLOCK+'&gTHN='+gTHN+'&crt='+crt+'&iD='+iD+'&IdT='+IdT+'&IdP='+IdP+'&IdL='+IdL);
		});
	}
	
	function remoPKRK(stLOCK,Link,eCek,crt,rIdT,IdL)
	{
		var gTHN = objfrm.fTHN.value;
		var gUBH = objfrm.fUBH.value;
		if (stLOCK=='1'){alert('Access denied, data sudah terkunci..!!'); return false;}
		if (Link=='Ya'){alert('Access denied, data terkait data murni..!!'); return false;}
		if (eCek!=''){alert('Access denied, data terkait data perubahan..!!'); return false;}
		var AN = confirm("Remove..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('RKBMD_New_Frm_Find_PKRK_Rem.php?stLOCK='+stLOCK+'&crt='+crt+'&rIdT='+rIdT+'&IdL='+IdL);
			});
		}
	}
	
	function showKEGI(stLOCK,CrT,rIdT,IdL)
	{
		if (stLOCK=='1'){alert('Access denied, data sudah terkunci..!!'); return false;}
		document.getElementById('progMstCri').style.display = "none";
		document.getElementById('reknMstCri').style.display = "none";
		
		gUNT = objfrm.fUNT.value;
		gTHN = objfrm.fTHN.value;
		gUBH = objfrm.fUBH.value;
		
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.fFindKG.value);
			$(document).ready(function()
			{
				$("#kegiDiv2Cri").load('RKBMD_New_Frm_Find_PKRK_Mid.php?gFrm=kegi&gFnD='+gFnD+'&stLOCK='+stLOCK+'&rIdT='+rIdT+'&gUNT='+gUNT+'&gTHN='+gTHN+'&gUBH='+gUBH+'&IdL='+IdL);
			});
		}
		else
		{
			document.getElementById('kegiDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#kegiDiv1Cri").load('RKBMD_New_Frm_Find_PKRK_Top.php?gFrm=kegi&stLOCK='+stLOCK+'&rIdT='+rIdT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#kegiDiv2Cri").load('RKBMD_New_Frm_Find_PKRK_Mid.php?gFrm=kegi&stLOCK='+stLOCK+'&rIdT='+rIdT+'&gUNT='+gUNT+'&gTHN='+gTHN+'&gUBH='+gUBH+'&IdL='+IdL);
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
	
	function showREKN(stLOCK,CrT,rIdT,IdL)
	{
		if (stLOCK=='1'){alert('Access denied, data sudah terkunci..!!'); return false;}
		document.getElementById('progMstCri').style.display = "none";
		document.getElementById('kegiMstCri').style.display = "none";
		document.getElementById('subkMstCri').style.display = "none";
		gUNT = objfrm.fUNT.value;
		gTHN = objfrm.fTHN.value;
		gUBH = objfrm.fUBH.value;
		
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.fFindRK.value);
			$(document).ready(function()
			{
				$("#reknDiv2Cri").load('RKBMD_New_Frm_Find_PKRK_Mid.php?gFrm=rekn&gFnD='+gFnD+'&stLOCK='+stLOCK+'&rIdT='+rIdT+'&gUNT='+gUNT+'&gTHN='+gTHN+'&gUBH='+gUBH+'&IdL='+IdL);
			});
		}
		else
		{
			document.getElementById('reknDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#reknDiv1Cri").load('RKBMD_New_Frm_Find_PKRK_Top.php?gFrm=rekn&stLOCK='+stLOCK+'&rIdT='+rIdT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#reknDiv2Cri").load('RKBMD_New_Frm_Find_PKRK_Mid.php?gFrm=rekn&stLOCK='+stLOCK+'&rIdT='+rIdT+'&gUNT='+gUNT+'&gTHN='+gTHN+'&gUBH='+gUBH+'&IdL='+IdL);
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

	function saveRECO(stLOCK,crt,fld,rIdT,IdL)
	{
		if (stLOCK=='1'){alert('Access denied, data sudah terkunci..!!'); return false;}
		fld = ReplaceText(fld.value);
		//alert(crt+' : '+fld+' : '+rIdT+' : '+IdL);
		$(document).ready(function()
		{
			$("#ViewDELL").load('RKBMD_New_Frm_Find_PKRK_Save.php?stLOCK='+stLOCK+'&crt='+crt+'&fld='+fld+'&rIdT='+rIdT+'&IdL='+IdL);
		});
	}
	
	function showSUBK(stLOCK,CrT,rIdT,IdL)
	{
		if (stLOCK=='1'){alert('Access denied, data sudah terkunci..!!'); return false;}
		document.getElementById('progMstCri').style.display = "none";
		document.getElementById('kegiMstCri').style.display = "none";
		gUNT = objfrm.fUNT.value;
		gTHN = objfrm.fTHN.value;
		gUBH = objfrm.fUBH.value;
		
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.fFindSB.value);
			$(document).ready(function()
			{
				$("#subkDiv2Cri").load('RKBMD_New_Frm_Find_PKRK_Mid.php?gFrm=subk&gFnD='+gFnD+'&stLOCK='+stLOCK+'&rIdT='+rIdT+'&gUNT='+gUNT+'&gTHN='+gTHN+'&gUBH='+gUBH+'&IdL='+IdL);
			});
		}
		else
		{
			document.getElementById('subkDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#subkDiv1Cri").load('RKBMD_New_Frm_Find_PKRK_Top.php?gFrm=subk&stLOCK='+stLOCK+'&rIdT='+rIdT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#subkDiv2Cri").load('RKBMD_New_Frm_Find_PKRK_Mid.php?gFrm=subk&stLOCK='+stLOCK+'&rIdT='+rIdT+'&gUNT='+gUNT+'&gTHN='+gTHN+'&gUBH='+gUBH+'&IdL='+IdL);
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
</script>