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
</head>
<?
extract($_GET);
$gHR  = 1;//fGetDate('mday');
$gBL  = 1;//fGetDate('mon');
$gTH  = fGetDate('year');
$gHRd = fGetDate('mday');
$gBLd = fGetDate('mon');
$gTHd = fGetDate('year');
$gJNS = "AA";

if ($gUNT==""){
	$gUNT="24.04.01.01";
}

if ($Lev > 1){
	$gUNT = substr($SkP,0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
}
?>
<body onload="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="P47_Rekonsiliasi.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td width="20">&nbsp;</td>
    <td width="91">&nbsp;</td>
    <td width="16">&nbsp;</td>
    <td width="223">&nbsp;</td>
    <td width="93">&nbsp;</td>
    <td width="18">&nbsp;</td>
    <td width="209">&nbsp;</td>
    <td width="35">&nbsp;</td>
    <td width="586">&nbsp;</td>
    </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">TANGGAL</td>
    <td align="center">&nbsp;</td>
    <td><select class="boxs" name="fHR" tabindex="0" style="width:50px" onchange="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
      <?
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gHR) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fBL" tabindex="0" style="width:95px" onchange="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
	<?
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBL) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTH" style="width: 60px" tabindex="0" onchange="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
 	<?
	for($i=2014; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select></td>
    <td align="right"> UNIT KERJA </td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<? if ($Lev <= 1) {?>
		<select class="boxs" name="fUNT" tabindex="0" style="width:496px" onchange="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
		  <option value="ALL">ALL</option>
		  <?
			$nSQ="SELECT kd_unit, nm_unit FROM ref_unit ORDER BY kd_unit";
			$nRs = mysql_query($nSQ);
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$sel ="";
				if ($mRo[0]==$gUNT) {$sel ="selected";}
				
				$mRo1 = $mRo[1];
				if (strlen($mRo1)>70)
				{$mRo1=substr($mRo[1],0,70);}
				
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo1.'</option>';
			}
			?>
		</select>
    <? } else {?>
	<input name="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" type="text" value="<?=$dUNT?>" readonly style="padding-left:5px; width:406px; border: 1px solid #C0C0C0"/>
    <? } ?>
	</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">S.D TANGGAL </td>
    <td align="center">&nbsp;</td>
    <td>
	<!--div id="formMstVeri" class="findaset0Veri" style="background-color: #C9DCD8">
		<div id="formDiv1Veri" class="findaset1Veri"></div>
		<div id="formDiv2Veri" class="findaset2Veri" style="background-color: #C9DCD8"></div>
	</div>	
	<div id="formMstExec" class="findaset0Veri" style="background-color: #C9DCD8">
		<div id="formDiv1Exec" class="findaset1Veri"></div>
		<div id="formDiv2Exec" class="findaset2Veri" style="background-color: #C9DCD8"></div>
	</div>	
	<div id="editMstVeri" class="findaset0Veri" style="background-color: #C9DCD8; height:450px; width:900px; top:51px; left:200px">
		<div id="editDiv1Veri" class="findaset1Veri" style="width:900px"></div>
		<div id="editDiv2Veri" class="findaset2Veri" style="background-color: #C9DCD8; height:410px; width:900px"></div>
	</div-->	
      <select class="boxs" name="fHRd" tabindex="0" style="width:50px" onchange="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
        <?
	for($i=1; $i<=31; $i++)
	{
		$sel ="";
		if ($i==$gHRd) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
      </select>
      <select class="boxs" name="fBLd" tabindex="0" style="width:95px" onchange="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
        <?
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBLd) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
      </select>
      <select class="boxs" name="fTHd" tabindex="0" style="width:60px" onchange="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
        <?
	for($i=2014; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTHd) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
      </select></td>
    <td align="right">JENIS USULAN </td>
    <td align="center">&nbsp;</td>
    <td>
	<select class="boxs" name="fJNS" tabindex="0" style="width:180px" onchange="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
	<option value="00">All</option>
	<option value="V1" <? if ($model=='V1'){echo "selected";}?>>Format V.1 </option>
	<option value="V2" <? if ($model=='V2'){echo "selected";}?>>Format V.2 </option>
	<option value="V3" <? if ($model=='V3'){echo "selected";}?>>Format V.3 </option>
	<option value="V4" <? if ($model=='V4'){echo "selected";}?>>Format V.4 </option>
    </select></td>
    <td>FIND</td>
    <td style="padding-right:5px"><input name="fFnD" id="fFnD" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$FrmG?>','<?=$IdL?>'); return false;}" style="padding-left:5px; width:140px; border: 1px solid #C0C0C0"/>
	<input type="button" name="B39" value="GO" onclick="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')" style="width: 40px; height: 21px" />
	</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #C9DCD8; font-weight:bold">
  <tr style="text-align:center">
    <td width="28" style="border-right:1px solid #999">NO</td>
    <td width="70" style="border-right:1px solid #999">TANGGAL</td>
    <td width="120" style="border-right:1px solid #999">NOMOR RKO</td>
    <td width="50" style="border-right:1px solid #999">MODEL</td>
    <td width="70" style="border-right:1px solid #999">TGL.BMD</td>
    <td width="223" style="border-right:1px solid #999">PIHAK I / PIHAK II</td>
    <td width="133" style="border-right:1px solid #999">NIP</td>
    <td width="223" style="border-right:1px solid #999">PANGKAT / GOL.</td>
    <td width="253" style="border-right:1px solid #999">JABATAN</td>
    <td>ACTION</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:390px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	<div id="ViewDATA" style="height:390px; width:100%; overflow:auto; border:0px"></div>
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
		document.getElementById(crt+'MstVeri').style.display = "none";
		if (crt=='form') {RefreshDATA(IdL);}
	}
	
	function RefreshDATA(FrmG,IdL)
	{
		var gJNS = "";
		var gUnT = objfrm.fUNT.value;
		var gHR  = objfrm.fHR.value;
		var gBL  = objfrm.fBL.value;
		var gTH  = objfrm.fTH.value;
		var gHRd = objfrm.fHRd.value;
		var gBLd = objfrm.fBLd.value;
		var gTHd = objfrm.fTHd.value;
		var gFnD = ReplaceText(objfrm.fFnD.value);
		gJNS = objfrm.fJNS.value;
		$(document).ready(function()
		{
			$.ajax({
				url:"P47_Rekonsiliasi_Data.php",
				data: {FrmG:FrmG,gUnT:gUnT,gHR:gHR,gBL:gBL,gTH:gTH,gHRd:gHRd,gBLd:gBLd,gTHd:gTHd,gFnD:gFnD,gJNS:gJNS,IdL:IdL},
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
	
	function showEDIT(FrmG,IdT,IdL)
	{
		//alert(IdT); return false;
		window.open('P47_Rekonsiliasi_Frm.php?gID='+IdT+'&FrmG='+FrmG+'&IdL='+IdL,'_self');
	}
	
	function P_Dokumen(w,h,IdT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='P47_Rekonsiliasi_Frm_Data_Dok_Rinci.php?IdT='+IdT+'&IdL='+IdL;
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
		URL='P47_Rekonsiliasi_Frm_Data_Dok_'+pil+'.php?gUNT='+gUNT+'&JeNS='+JeNS+'&HR1='+HR1+'&HR2='+HR2+'&HR3='+HR3+'&BL1='+BL1+'&BL2='+BL2+'&BL3='+BL3+'&TH1='+TH1+'&TH2='+TH2+'&TH3='+TH3+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
		//closeCLICK('choise');
	}
	
	function showDELE(FrmG,ReO,IdT,Cek,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (Cek=='NoDelA'){alert('Access denied, transaksi usulan sudah dieksekusi..!!'); return false;}
		if (Cek=='NoDelS'){alert('Access denied, transaksi usulan sudah dieksekusi sebagian..!!'); return false;}
		
		var AN = confirm("Hapus transaski usulan ini ..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$.ajax({
					url:"P47_Rekonsiliasi_Data_Dell.php",
					data: {FrmG:FrmG,IdT:IdT,IdL:IdL},
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
	}
	
	function showDELEAll(FrmG,IdT,Cek,IdL)
	{
		var AN = confirm("Hapus bypass..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$.ajax({
					url:"P47_Rekonsiliasi_Data_Dell_All.php",
					data: {FrmG:FrmG,IdT:IdT,IdL:IdL},
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
	/*
	function closeEXEC(crt,IdL)
	{
		document.getElementById('formMstExec').style.display = "none";
		//if (crt=='form') {RefreshDATA(IdL);}
	}
	
	function showFORM(crt,IdT,gIdL)
	{
		if (crt=='refr')
		{
			$(document).ready(function()
			{
				$("#formDiv2Veri").load('P47_Rekonsiliasi_Veri_Frm_Veri_Mid.php?IdT='+IdT+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('formDiv2Veri').style.display = "block";
			$(document).ready(function()
			{
				$("#formDiv1Veri").load('P47_Rekonsiliasi_Veri_Frm_Veri_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#formDiv2Veri").load('P47_Rekonsiliasi_Veri_Frm_Veri_Mid.php?IdT='+IdT+'&IdL='+gIdL);
			});
			
			if (document.getElementById('formMstVeri').style.display == "block")
			{
				document.getElementById('formMstVeri').style.display = "none";
			}
			else
			{
				document.getElementById('formMstVeri').style.display = "block";
			}
		}
	}
	*/
	/*
	function showEXEC_RefR(crt,IdT,gIdL)
	{
		$(document).ready(function()
		{
			$("#formDiv2Exec").load('P47_Rekonsiliasi_Exec_Frm_Mid.php?IdT='+IdT+'&IdL='+gIdL);
		});
	}
	
	function showEXEC(crt,IdT,gIdL)
	{
		document.getElementById('formDiv2Exec').style.display = "block";
		$(document).ready(function()
		{
			$("#formDiv1Exec").load('P47_Rekonsiliasi_Exec_Frm_Top.php?crt='+crt+'&IdL='+gIdL);
		});
		
		$(document).ready(function()
		{
			$("#formDiv2Exec").load('P47_Rekonsiliasi_Exec_Frm_Mid.php?IdT='+IdT+'&IdL='+gIdL);
		});
		
		if (document.getElementById('formMstExec').style.display == "block")
		{
			document.getElementById('formMstExec').style.display = "none";
		}
		else
		{
			document.getElementById('formMstExec').style.display = "block";
		}
	}
	
	function SaveDATA(rID,IdT,gIdL)
	{
		var gH  = objfrm.fH.value;
		var gB  = objfrm.fB.value;
		var gT  = objfrm.fT.value;
		var nO  = ReplaceText(objfrm.fNoM.value);
		var mE  = ReplaceText(objfrm.fMeM.value);
		var gNm = ReplaceText(objfrm.fNmA.value);
		var gJb = ReplaceText(objfrm.fJbT.value);
		var gNi = ReplaceText(objfrm.fNiP.value);
		
		$(document).ready(function()
		{
			$.ajax({
				url:"P47_Rekonsiliasi_Veri_Frm_Veri_Save.php",
				data: {gNm:gNm,gJb:gJb,gNi:gNi,nO:nO,mE:mE,gH:gH,gB:gB,gT:gT,rID:rID,IdT:IdT,IdL:gIdL},
				type:"get",
				beforeSend:function()
				{
					$("#loadingImg").show();
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#formDiv2Veri").html(data);
					$("#formDiv2Veri").show("fast");
				}
			});
		});
	}
	

	function unexecFORM(tID,IdT,IdL)
	{
		rBatal = 'YA';
		var AN = confirm("Batalkan eksekusi...?!!");
		if (AN)
		{
			//$(document).ready(function()
			//{
			//	$("#ViewDATA").load('P47_Rekonsiliasi_Exec_Frm_Save.php?rBatal='+rBatal+'&tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
			//	//$("#formDiv2Exec").load('P47_Rekonsiliasi_Exec_Frm_Save.php?tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
			//});
			
			
			$(document).ready(function()
			{
				$.ajax({
					url:"P47_Rekonsiliasi_Exec_Frm_Save.php",
					data: {rBatal:rBatal,tID:tID,IdT:IdT,IdL:IdL},
					type:"get",
					beforeSend:function()
					{
						$("#loadingImg").show();
					},
					success:function(data)
					{
						$("#loadingImg").hide();
						$("#formDiv2Exec").html(data);
						$("#formDiv2Exec").show("fast");
					}
				});
			});
			
		}
	}
	
	function editFORM(crt,mS,tID,gIdL)
	{
		for (i=1; i<=100; i++)
		{
			mS = mS.replace('**',' ');
			mS = mS.replace('*^*','\n');
		}
		
		if (mS!=""){
			alert(mS); return false;
		}
		if (crt=='refr')
		{
			$(document).ready(function()
			{
				$("#editDiv2Veri").load('P47_Rekonsiliasi_Veri_Frm_Veri_Mid_Edit_Mid.php?tID='+tID+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('editDiv2Veri').style.display = "block";
			if (document.getElementById('editMstVeri').style.display == "block")
			{
				document.getElementById('editMstVeri').style.display = "none";
			}
			else
			{
				document.getElementById('editMstVeri').style.display = "block";
			}
			
			$(document).ready(function()
			{
				$("#editDiv1Veri").load('P47_Rekonsiliasi_Veri_Frm_Veri_Mid_Edit_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#editDiv2Veri").load('P47_Rekonsiliasi_Veri_Frm_Veri_Mid_Edit_Mid.php?tID='+tID+'&IdL='+gIdL);
			});
		}
	}
	
	function saveRECO(fLD,rVal,mID,tID,gIdL)
	{
		var gVer="NO";
		if (fLD=='Memo') {
			rVal = ReplaceText(document.getElementById('fMeM'+mID).value);
		}
		if (fLD=='Fisik') {
			rVal = rVal;
		}
		
		if (fLD=='Status') {
			rVal = rVal;
		}
		
		$(document).ready(function()
		{
			$("#editDiv2Veri").load('P47_Rekonsiliasi_Veri_Frm_Veri_Mid_Edit_Save.php?gVer='+gVer+'&fLD='+fLD+'&rVal='+rVal+'&mID='+mID+'&tID='+tID+'&IdL='+gIdL);
		});
	}
	
	function saveVERI(fLD,JnS,rVal,tID,gIdL)
	{
		var UnTo = objfrm.fUniT.value;
		if (JnS=="MS" && UnTo==""){alert('UNIT KERJA TUJUAN MUTASI belum lengkapi pada tahap usulan mutasi..!!');return false;}
		
		var gVer="YA";
		if (rVal=='Disetujui'){
			var mHri = document.getElementById('mHri').value;
			var mBln = document.getElementById('mBln').value;
			var mThn = document.getElementById('mThn').value;
			if (mHri=='00' || mBln=='00' || mThn=='0000'){
				alert('Silahkan tentukan tanggal mutasi terlebih dahulu..!!'); 
				return false;
			}
		}
		$(document).ready(function()
		{
			$("#editDiv2Veri").load('P47_Rekonsiliasi_Veri_Frm_Veri_Mid_Edit_Save.php?gVer='+gVer+'&fLD='+fLD+'&rVal='+rVal+'&tID='+tID+'&IdL='+gIdL);
		});
	}

	function saveVERItgl(fLD,field,tID,gIdL)
	{
		var gVer="YA";
		var rVal = field.value
		$(document).ready(function()
		{
			$("#editDiv2Veri").load('P47_Rekonsiliasi_Veri_Frm_Veri_Mid_Edit_Save.php?gVer='+gVer+'&fLD='+fLD+'&rVal='+rVal+'&tID='+tID+'&IdL='+gIdL);
		});
	}
	
	function closeIMG()
	{
		document.getElementById('imgMstCri').style.display = "none";
	}
	
	function showIMG(CrT,tID,gIdL)
	{
		document.getElementById('imgDiv2Cri').style.display = "block";
		if (document.getElementById('imgMstCri').style.display == "block")
		{
			document.getElementById('imgMstCri').style.display = "none";
		}
		else
		{
			document.getElementById('imgMstCri').style.display = "block";
		}
		
		$(document).ready(function()
		{
			$("#imgDiv1Cri").load('P47_Rekonsiliasi_Veri_Frm_Data_Img_Top.php?CrT='+CrT+'&IdL='+gIdL);
		});
		
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('P47_Rekonsiliasi_Veri_Frm_Data_Img_Mid.php?CrT='+CrT+'&tID='+tID+'&IdL='+gIdL);
		});
	}
	
	
	function viewIMG(rIdT,w,h,gIdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='P47_Rekonsiliasi_Frm_Data_Edit_Upl_Top_Vie.php?rIdT='+rIdT+'&IdL='+gIdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open(URL,'',settings);
	}

	function execFORM(KdA,JenS,tbl,wrn,exc,tID,IdT,IdL)
	{
		//alert(KdA.substring(0,2)); return false;
		if (JenS=="MK" && KdA.substring(0,2)!="07"){
			alert('Eksekusi MUTASI ANTAR KIB baru bisa digunakan dari KIB LAINNYA ke KIB (A,B,C,D,E), tools masih dalam proses..!!');
			return false;
		}
		if (tbl!='a' && tbl!='b' && tbl!='c' && tbl!='d' && tbl!='e' && tbl!='g'){
			alert('Eksekusi kib-'+tbl+' belum bisa dilakukan, tools masih dalam proses..!!');
			return false;
		}
		
		if (wrn=='Executed'){
			alert('Eksekusi sudah dilakukan..!!');
			return false;
		}
		if (exc!='Disetujui'){
			alert('Eksekusi belum bisa dilakukan, status verifikasi belum DISETUJUI..!!');
			return false;
		}
		var AN = confirm("Lanjutkan proses eksekusi usulan..?!!");
		if (AN)
		{
			//$(document).ready(function()
			//{
			//	$("#ViewDATA").load('P47_Rekonsiliasi_Exec_Frm_Save.php?tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
			//	//$("#formDiv2Exec").load('P47_Rekonsiliasi_Exec_Frm_Save.php?tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
			//});
						
			$(document).ready(function()
			{
				$.ajax({
					url:"P47_Rekonsiliasi_Exec_Frm_Save.php",
					data: {tID:tID,IdT:IdT,IdL:IdL},
					type:"get",
					beforeSend:function()
					{
						$("#loadingImg").show();
					},
					success:function(data)
					{
						$("#loadingImg").hide();
						$("#formDiv2Exec").html(data);
						$("#formDiv2Exec").show("fast");
					}
				});
			});
		}
	}
	*/
</script>