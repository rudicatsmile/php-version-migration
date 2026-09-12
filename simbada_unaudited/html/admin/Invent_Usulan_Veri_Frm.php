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
$gHR  = 1;    //fGetDate('mday');
$gBL  = 1;    //fGetDate('mon');
$gTH  = (fGetDate('year'));
$gHRd = 31;   //fGetDate('mday');
$gBLd = 12;   //fGetDate('mon');
$gTHd = (fGetDate('year'));
$gJNS = "AA";
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="Invent_Usulan_Veri_Frm_.php?IdL=".$_GET['IdL']?>">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; background-color:#D2DAC4">
  <tr>
    <td width="20">&nbsp;</td>
    <td width="91">&nbsp;</td>
    <td width="16">&nbsp;</td>
    <td width="223">&nbsp;</td>
    <td width="93">&nbsp;</td>
    <td width="18">&nbsp;</td>
    <td width="284">&nbsp;</td>
    <td width="51">&nbsp;</td>
    <td width="495">&nbsp;</td>
    </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">TANGGAL</td>
    <td align="center">&nbsp;</td>
    <td><select class="boxs" name="fHR" tabindex="0" style="width:50px" onclick="RefreshDATA('<?=$IdL?>')">
      <?
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gHR) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fBL" tabindex="0" style="width:95px" onclick="RefreshDATA('<?=$IdL?>')">
	<?
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBL) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTH" style="width: 60px" tabindex="0" onclick="RefreshDATA('<?=$IdL?>')">
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
	<select class="boxs" name="fUNT" tabindex="0" style="width:570px" onchange="RefreshDATA('<?=$IdL?>')">
      <option value="ALL">ALL</option>
      <?
		$nSQ="SELECT kd_unit, nm_unit FROM ref_unit ORDER BY kd_unit";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$sel ="";
			if ($mRo[0]=="24.04.01.01") {$sel ="selected";}
			if ($mRo[0]=="24.04.07.03"){
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".substr($mRo[1],0,70).'....</option>';
			}
			else{
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo[1].'</option>';
			}
			#echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[1].'</option>';
		}
		?>
    </select></td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">S.D TANGGAL </td>
    <td align="center">&nbsp;</td>
    <td>
	<div id="formMstVeri" class="findaset0Veri" style="background-color: #C9DCD8">
		<div id="formDiv1Veri" class="findaset1Veri"></div>
		<div id="formDiv2Veri" class="findaset2Veri" style="background-color: #C9DCD8"></div>
		<div id="formDiv3Veri" class="findaset3Veri" style="background-color: #C9DCD8"></div>
	</div>	
	<div id="formMstExec" class="findaset0Veri" style="background-color: #C9DCD8">
		<div id="formDiv1Exec" class="findaset1Veri"></div>
		<div id="formDiv2Exec" class="findaset2Veri" style="background-color: #C9DCD8"></div>
		<div id="formDiv3Exec" class="findaset3Veri" style="background-color: #C9DCD8"></div>
	</div>	
	<div id="editMstVeri" class="findaset0Veri" style="background-color: #C9DCD8; height:450px; width:900px; top:51px; left:200px">
		<div id="editDiv1Veri" class="findaset1Veri" style="width:900px"></div>
		<div id="editDiv2Veri" class="findaset2Veri" style="background-color: #C9DCD8; height:410px; width:900px"></div>
	</div>	
      <select class="boxs" name="fHRd" tabindex="0" style="width:50px" onclick="RefreshDATA('<?=$IdL?>')">
        <?
	for($i=1; $i<=31; $i++)
	{
		$sel ="";
		if ($i==$gHRd) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
      </select>
      <select class="boxs" name="fBLd" tabindex="0" style="width:95px" onclick="RefreshDATA('<?=$IdL?>')">
        <?
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBLd) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
      </select>
      <select class="boxs" name="fTHd" tabindex="0" style="width:60px" onclick="RefreshDATA('<?=$IdL?>')">
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
    <td><select class="boxs" name="fJNS" tabindex="0" style="width:250px" onchange="RefreshDATA('<?=$IdL?>')">
      <option value="AA">ALL</option>
      <?
		$nSQ="SELECT Kode, Deskripsi FROM ref_usulan_jenis WHERE Aktif='Y' ORDER BY Urut";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$sel ="";
			if ($mRo[0]==$gJNS) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[1].'</option>';
		}
		?>
    </select></td>
    <td>FIND</td>
    <td><input name="fFnD" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$IdL?>'); return false;}" style="padding-left:5px; width:140px; border: 1px solid #C0C0C0"/>
      <input type="button" name="B39" value="GO" onclick="RefreshDATA('<?=$IdL?>')" style="width: 40px; height: 21px" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
	<div id="imgMstCri" class="upload_a">
		<div id="imgDiv1Cri" class="upload_b"></div>
		<div id="imgDiv2Cri" class="upload_c"></div>
	</div>	</td>
    <td align="right"><div id="loadingImg" style="width:0px; height:0px; display:none; vertical-align:middle; text-align:center"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #C9DCD8; font-weight:bold">
  <tr style="text-align:center">
    <td width="28" style="border-right:1px solid #999">No</td>
    <td width="70" style="border-right:1px solid #999">Tanggal</td>
    <td width="120" style="border-right:1px solid #999">Referensi</td>
    <td width="170" style="border-right:1px solid #999">Nomor / Tgl. Dokumen</td>
    <td width="233" style="border-right:1px solid #999">SKPD</td>
    <td width="154" style="border-right:1px solid #999">Usulan</td>
    <td width="273" style="border-right:1px solid #999">Uraian</td>
    <td width="103" style="border-right:1px solid #999">Nilai</td>
    <td align="center">Action</td>
  </tr>
</table>
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
	
	function closeEXEC(crt,IdL)
	{
		document.getElementById('formMstExec').style.display = "none";
		//if (crt=='form') {RefreshDATA(IdL);}
	}
	
	function RefreshDATA(IdL)
	{
		var gJNS = "";
		var gUnT = objfrm.fUNT.value;
		var gHR  = objfrm.fHR.value;
		var gBL  = objfrm.fBL.value;
		var gTH  = objfrm.fTH.value;
		var gHRd = objfrm.fHRd.value;
		var gBLd = objfrm.fBLd.value;
		var gTHd = objfrm.fTHd.value;
		gJNS     = objfrm.fJNS.value;
		var gFnD = ReplaceText(objfrm.fFnD.value);
		
		/*Len = objfrm.fJNS.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fJNS[i].checked) {gJNS = objfrm.fJNS[i].value; break; }
		}
		*/
		/*
		$(document).ready(function()
		{
			$("#ViewDATA").load('Invent_Usulan_Veri_Frm_Data.php?gUnT='+gUnT+'&gHR='+gHR+'&gBL='+gBL+'&gTH='+gTH+'&gHRd='+gHRd+'&gBLd='+gBLd+'&gTHd='+gTHd+'&gFnD='+gFnD+'&gJNS='+gJNS+'&IdL='+IdL);
		});
		*/
		$(document).ready(function()
		{
			$.ajax({
				url:"Invent_Usulan_Veri_Frm_Data.php",
				data: {gUnT:gUnT,gHR:gHR,gBL:gBL,gTH:gTH,gHRd:gHRd,gBLd:gBLd,gTHd:gTHd,gFnD:gFnD,gJNS:gJNS,IdL:IdL},
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
	
	function showFORM(ReO,crt,PgE,IdT,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (crt=='refr')
		{
			$(document).ready(function()
			{
				$("#formDiv2Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid.php?PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
				$("#formDiv3Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid_Pages.php?PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
			});
			//$(document).ready(function()
			//{
			//	$("#formDiv3Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid_Pages.php?PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
			//});
		}
		else
		{
			document.getElementById('formDiv2Veri').style.display = "block";
			document.getElementById('formDiv3Veri').style.display = "block";
			$(document).ready(function()
			{
				$("#formDiv1Veri").load('Invent_Usulan_Veri_Frm_Veri_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#formDiv2Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid.php?PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#formDiv3Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid_Pages.php?ReO='+ReO+'&PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
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
	
	/*
	function showEXEC_FIND(crt,PgE,IdT,IdL)
	{
		var gFnD = ReplaceText(objfrm.fFnDT.value);
		$(document).ready(function()
		{
			$("#formDiv2Exec").load('Invent_Usulan_Exec_Frm_Mid.php?gFnD='+gFnD+'&PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
		});
		$(document).ready(function()
		{
			$("#formDiv3Exec").load('Invent_Usulan_Exec_Frm_Mid_Pages.php?gFnD='+gFnD+'&PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
		});
	}
	*/
	
	function showEXEC_RefR(crt,PgE,IdT,IdL)
	{
		var gFnD = ReplaceText(objfrm.fFnDT.value);
		$(document).ready(function()
		{
			$("#formDiv2Exec").load('Invent_Usulan_Exec_Frm_Mid.php?gFnD='+gFnD+'&PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
		});
		
		/*
		$(document).ready(function()
		{
			$.ajax({
				url:"Invent_Usulan_Exec_Frm_Mid.php",
				data: {gFnD:gFnD,PgE:PgE,IdT:IdT,IdL:IdL},
				type:"get",
				beforeSend:function()
				{
					$("#loadingImg3").show();
				},
				success:function(data)
				{
					$("#loadingImg3").hide();
					$("#formDiv2Exec").html(data);
				}
			});
		});
		*/
			
		$(document).ready(function()
		{
			$("#formDiv3Exec").load('Invent_Usulan_Exec_Frm_Mid_Pages.php?gFnD='+gFnD+'&PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
		});
	}
	
	function showEXEC(ReO,crt,PgE,IdT,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		var gFnD = "";
		document.getElementById('formDiv2Exec').style.display = "block";
		document.getElementById('formDiv3Exec').style.display = "block";
		$(document).ready(function()
		{
			$("#formDiv1Exec").load('Invent_Usulan_Exec_Frm_Top.php?crt='+crt+'&gFnD='+gFnD+'&PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
		});
		
		$(document).ready(function()
		{
			$("#formDiv2Exec").load('Invent_Usulan_Exec_Frm_Mid.php?gFnD='+gFnD+'&PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
		});
		
		$(document).ready(function()
		{
			$("#formDiv3Exec").load('Invent_Usulan_Exec_Frm_Mid_Pages.php?gFnD='+gFnD+'&PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
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
	
	function SaveDATA(PgE,rID,IdT,gIdL)
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
				url:"Invent_Usulan_Veri_Frm_Veri_Save.php",
				data: {PgE:PgE,gNm:gNm,gJb:gJb,gNi:gNi,nO:nO,mE:mE,gH:gH,gB:gB,gT:gT,rID:rID,IdT:IdT,IdL:gIdL},
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
	
	function unexecFORMRepairKib(MdL,PgE,tID,IdT,IdL)
	{
		//alert('repair proses '+MdL); return false;
		$(document).ready(function()
		{
			$("#ViewDELL").load('Invent_Usulan_Exec_Frm_Save_RepairKib.php?MdL='+MdL+'&PgE='+PgE+'&tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
			//$("#formDiv2Exec").load('Invent_Usulan_Exec_Frm_Save_RepairKib.php?MdL='+MdL+'&PgE='+PgE+'&tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
		});
	}
	
	function removeFORM(PgE,tID,IdT,IdL)
	{
		var AN = confirm("Remove record...?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				//$("#ViewDELL").load('Invent_Usulan_Exec_Frm_Save_RepairKib.php?MdL='+MdL+'&PgE='+PgE+'&tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
				$("#formDiv2Exec").load('Invent_Usulan_Exec_Frm_Save_RemoveRec.php?PgE='+PgE+'&tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
			});
		}
	}
	
	function unexecFORM(DeM,WrM,MdL,PgE,tID,IdT,IdL)
	{
		rBatal = 'YA';
		if (DeM=="AsetNone"){
			alert('Pembatalan ditolak, aset sudah tidak diposisi skpd tujuan mutasi..!!');
			return false;
		}
		
		if (WrM!=""){
			alert(WrM+' : '+MdL);
			/*
			var AN = confirm("Eksekusi repair data...?!!");
			if (AN)
			{
				if (MdL=='RepairKib-RB' || MdL=='RepairKib-HB' || MdL=='RepairKib-PH' || MdL=='RepairKib-LE' || MdL=='RepairKib-PL' || MdL=='RepairKib-KR' || MdL=='RepairKib-HL' || MdL=='RepairKib-AR'){
					unexecFORMRepairKib(MdL,PgE,tID,IdT,IdL);
				}
				else if (MdL=='RepairKib-MS'){
					alert('Rekomendasi: batalkan mutasi keluar terkait aset tersebut di skpd tujuan terlebih dahulu..')
				}
				else{
					alert('Repair tools '+MdL+' under construction..!!');
				}
			}
			*/
			return false;
		}
		
		var AN = confirm("Batalkan eksekusi...?!!");
		if (AN)
		{
			/*
			$(document).ready(function()
			{
				//$("#ViewDELL").load('Invent_Usulan_Exec_Frm_Save.php?rBatal='+rBatal+'&PgE='+PgE+'&tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
				$("#formDiv2Exec").load('Invent_Usulan_Exec_Frm_Save.php?rBatal='+rBatal+'&PgE='+PgE+'&tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
			});
			*/
			
			$(document).ready(function()
			{
				$.ajax({
					url:"Invent_Usulan_Exec_Frm_Save.php",
					data: {rBatal:rBatal,PgE:PgE,tID:tID,IdT:IdT,IdL:IdL},
					type:"get",
					beforeSend:function()
					{
						$("#loadingImg").show();
					},
					success:function(data)
					{
						$("#loadingImg").hide();
						//$("#formDiv2Exec").html(data);
						//$("#formDiv2Exec").show("fast");
						$("#ViewDELL").html(data);
						$("#ViewDELL").show("fast");
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
				$("#editDiv2Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid_Edit_Mid.php?tID='+tID+'&IdL='+gIdL);
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
				$("#editDiv1Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid_Edit_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#editDiv2Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid_Edit_Mid.php?tID='+tID+'&IdL='+gIdL);
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
			$("#editDiv2Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid_Edit_Save.php?gVer='+gVer+'&fLD='+fLD+'&rVal='+rVal+'&mID='+mID+'&tID='+tID+'&IdL='+gIdL);
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
			$("#editDiv2Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid_Edit_Save.php?gVer='+gVer+'&fLD='+fLD+'&rVal='+rVal+'&tID='+tID+'&IdL='+gIdL);
		});
	}

	function saveVERItgl(fLD,field,tID,gIdL)
	{
		var gVer="YA";
		var rVal = field.value
		$(document).ready(function()
		{
			$("#editDiv2Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid_Edit_Save.php?gVer='+gVer+'&fLD='+fLD+'&rVal='+rVal+'&tID='+tID+'&IdL='+gIdL);
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
			$("#imgDiv1Cri").load('Invent_Usulan_Veri_Frm_Data_Img_Top.php?CrT='+CrT+'&IdL='+gIdL);
		});
		
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('Invent_Usulan_Veri_Frm_Data_Img_Mid.php?CrT='+CrT+'&tID='+tID+'&IdL='+gIdL);
		});
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

	function repairDATA(CrT,TbS,TbT,PgE,tID,IdT,IdL)
	{
		$(document).ready(function()
		{
			$("#formDiv2Exec").load('Invent_Usulan_Exec_Frm_Save_RepairNew.php?CrT='+CrT+'&TbS='+TbS+'&TbT='+TbT+'&PgE='+PgE+'&tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
		});
	}
			
	function creatorEXE(Ref,IdL)
	{
		document.getElementById('exceDiv2Veri').style.display = "block";
		document.getElementById('exceDiv3Veri').style.display = "block";
		$(document).ready(function()
		{
			$("#exceDiv1Veri").load('Invent_Usulan_Veri_Frm_Veri_Crea_Top.php?IdL='+IdL);
		});
		
		$(document).ready(function()
		{
			$("#exceDiv2Veri").load('Invent_Usulan_Veri_Frm_Veri_Crea_Mid.php?Ref='+Ref+'&IdL='+IdL);
		});
		
		if (document.getElementById('exceMstVeri').style.display == "block")
		{
			document.getElementById('exceMstVeri').style.display = "none";
		}
		else
		{
			document.getElementById('exceMstVeri').style.display = "block";
		}
	}
	
	function exeALL(Ref,IdL)
	{
		mHri = $("#mHri").val();
		mBln = $("#mBln").val();
		mThn = $("#mThn").val();
		if (mHri=='00'){alert('Pilihan tanggal belum benar..!!'); return false;}
		if (mBln=='00'){alert('Pilihan bulan belum benar..!!'); return false;}
		if (mThn=='0000'){alert('Pilihan tahun belum benar..!!'); return false;}
		
		Len = objfrm.fProT.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fProT[i].checked) {ProT = objfrm.fProT[i].value; break; }
		}
		
		var AN = confirm("Lanjutkan proses..?!!");
		if (AN)
		{
			/*
			$(document).ready(function()
			{
				$("#ViewDELL").load('Invent_Usulan_Veri_Frm_Veri_Crea_Save.php?ProT='+ProT+'&Ref='+Ref+'&mHri='+mHri+'&mBln='+mBln+'&mThn='+mThn+'&IdL='+IdL);
				
			});
			*/
			
			$(document).ready(function()
			{
				$.ajax({
					url:"Invent_Usulan_Veri_Frm_Veri_Crea_Save.php",
					data: {ProT:ProT,Ref:Ref,mHri:mHri,mBln:mBln,mThn:mThn,IdL:IdL},
					type:"get",
					beforeSend:function()
					{
						$("#loadingImg2").show();
					},
					success:function(data)
					{
						$("#loadingImg2").hide();
						$("#ViewDELL").html(data);
						//$("#formDiv2Exec").show("fast");
					}
				});
			});
		}
	}
	
	function execFORM_All(ExecAll,RefU,PgE,IdT,IdL)
	{
		//alert('Under construction..!'); return false;
		gFnD="";
		if (ExecAll!=''){
			alert('Execute All tidak bisa dilakukan, karena ada transaksi yg belum difasilitasi ..!!'); return false;
		}
		var AN = confirm("Eksekusi semua sesuai record halaman ini..?!!");
		if (AN)
		{
			ProsT=2;
			if (ProsT==1)
			{
				$(document).ready(function()
				{
					$("#formDiv2Exec").load('Invent_Usulan_Exec_Frm_Exe_All_Save.php?gFnD='+gFnD+'&PgE='+PgE+'&RefU='+RefU+'&IdT='+IdT+'&IdL='+IdL);
					//$("#ViewDELL").load('Invent_Usulan_Exec_Frm_Exe_All_Save.php?gFnD='+gFnD+'&PgE='+PgE+'&RefU='+RefU+'&IdT='+IdT+'&IdL='+IdL);
				});
			}
			else
			{
				$(document).ready(function()
				{
					$.ajax({
						url:"Invent_Usulan_Exec_Frm_Exe_All_Save.php",
						data: {gFnD:gFnD,PgE:PgE,RefU:RefU,IdT:IdT,IdL:IdL},
						type:"get",
						beforeSend:function()
						{
							$("#loadingImg3").show();
						},
						success:function(data)
						{
							$("#loadingImg3").hide();
							$("#ViewDELL").html(data);
						}
					});
				});
			}
		}
	}
	
	function execFORM(LeNon,DeN,PgE,KdA,JenS,tbl,wrn,exc,tID,IdT,IdL)
	{
		//alert(''); return false;
		if (LeNon!=''){
			alert(LeNon);
			return false;
		}
		if (DeN=="YA"){
			alert('Eksekusi ditolak, aset tidak ada..!!');
			return false;
		}
		
		/*
		if (JenS=="MK" && KdA.substring(0,3)!="1.5"){
			alert('Eksekusi MUTASI ANTAR KIB hanya bisa digunakan KIB LAINNYA ke KIB (A,B,C,D,E)..!!');
			return false;
		}
		*/
		
		if (wrn=='Executed'){
			alert('Eksekusi sudah dilakukan..!!');
			return false;
		}
		if (exc!='Disetujui'){
			alert('Eksekusi belum bisa dilakukan, status verifikasi belum DISETUJUI..!!');
			return false;
		}
		var AN = confirm("Lanjutkan proses eksekusi usulan.?!!");
		if (AN)
		{
			ProsT = 2;
			if (ProsT==1){
				$(document).ready(function()
				{
					//$("#formDiv2Exec").load('Invent_Usulan_Exec_Frm_Save.php?PgE='+PgE+'&tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
					$("#ViewDELL").load('Invent_Usulan_Exec_Frm_Save.php?PgE='+PgE+'&tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
				});
			}
			else
			{
				$(document).ready(function()
				{
					$.ajax({
						url:"Invent_Usulan_Exec_Frm_Save.php",
						data: {PgE:PgE,tID:tID,IdT:IdT,IdL:IdL},
						type:"get",
						beforeSend:function()
						{
							$("#loadingImg").show();
						},
						success:function(data)
						{
							$("#loadingImg3").hide();
							$("#ViewDELL").html(data);
							//$("#loadingImg").hide();
							//$("#formDiv2Exec").html(data);
						}
					});
				});
			}
		}
	}
	
	
</script>