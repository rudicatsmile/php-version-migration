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
$gHR  = 1;    //fGetDate('mday');
$gBL  = 1;    //fGetDate('mon');
$gTH  = fGetDate('year');
$gHRd = fGetDate('mday');
$gBLd = fGetDate('mon');
$gTHd = fGetDate('year');

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
    <td width="211">&nbsp;</td>
    <td width="41">&nbsp;</td>
    <td width="578">&nbsp;</td>
    </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">TANGGAL</td>
    <td align="center">&nbsp;</td>
    <td><select class="boxs" name="fHR" tabindex="0" style="width:50px" onclick="RefreshDATA('<?=$IdL?>')">
      <?php
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gHR) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fBL" tabindex="0" style="width:95px" onclick="RefreshDATA('<?=$IdL?>')">
	<?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBL) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTH" style="width: 60px" tabindex="0" onclick="RefreshDATA('<?=$IdL?>')">
 	<?php
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
      <?php
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
        <?php
	for($i=1; $i<=31; $i++)
	{
		$sel ="";
		if ($i==$gHRd) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
      </select>
      <select class="boxs" name="fBLd" tabindex="0" style="width:95px" onclick="RefreshDATA('<?=$IdL?>')">
        <?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBLd) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
      </select>
      <select class="boxs" name="fTHd" tabindex="0" style="width:60px" onclick="RefreshDATA('<?=$IdL?>')">
        <?php
	for($i=2014; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTHd) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
      </select></td>
    <td align="right">FIND</td>
    <td align="center">&nbsp;</td>
    <td><input name="fFnD" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$IdL?>'); return false;}" style="padding-left:5px; width:140px; border: 1px solid #C0C0C0"/>
      <input type="button" name="B39" value="GO" onclick="RefreshDATA('<?=$IdL?>')" style="width: 40px; height: 21px" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
  <tr>
    <td width="30" align="center">NO</td>
    <td width="80" align="left">TANGGAL</td>
    <td width="120" align="left">REFERENSI</td>
    <td width="118" align="left">NOMOR</td>
    <td align="left">SKPD</td>
    <td width="160" align="left">NOMOR DOKUMEN</td>
    <td width="70" align="left">TGL.DOC</td>
    <td width="100" align="center">JML.REK</td>
    <td width="170" align="center">ACTION</td>
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
	
	function closeEXEC(crt,IdL)
	{
		document.getElementById('formMstExec').style.display = "none";
		//if (crt=='form') {RefreshDATA(IdL);}
	}
	
	function RefreshDATA(IdL)
	{
		var gUnT = objfrm.fUNT.value;
		var gHR  = objfrm.fHR.value;
		var gBL  = objfrm.fBL.value;
		var gTH  = objfrm.fTH.value;
		var gHRd = objfrm.fHRd.value;
		var gBLd = objfrm.fBLd.value;
		var gTHd = objfrm.fTHd.value;
		var gFnD = ReplaceText(objfrm.fFnD.value);
		
		/*
		$(document).ready(function()
		{
			$("#ViewDATA").load('Invent_Usulan_Veri_Frm_Data.php?gUnT='+gUnT+'&gHR='+gHR+'&gBL='+gBL+'&gTH='+gTH+'&gHRd='+gHRd+'&gBLd='+gBLd+'&gTHd='+gTHd+'&gFnD='+gFnD+'&IdL='+IdL);
		});
		*/
		$(document).ready(function()
		{
			$.ajax({
				url:"Rekn108_Usulan_Exec_Frm_Data.php",
				data: {gUnT:gUnT,gHR:gHR,gBL:gBL,gTH:gTH,gHRd:gHRd,gBLd:gBLd,gTHd:gTHd,gFnD:gFnD,IdL:IdL},
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
	
	function showFORM(crt,PgE,IdT,IdL)
	{
		if (crt=='refr')
		{
			$(document).ready(function()
			{
				$("#formDiv2Veri").load('Rekn108_Usulan_Veri_Frm_Veri_Mid.php?PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
				$("#formDiv3Veri").load('Rekn108_Usulan_Veri_Frm_Veri_Mid_Pages.php?PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
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
				$("#formDiv1Veri").load('Rekn108_Usulan_Veri_Frm_Veri_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#formDiv2Veri").load('Rekn108_Usulan_Veri_Frm_Veri_Mid.php?PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#formDiv3Veri").load('Rekn108_Usulan_Veri_Frm_Veri_Mid_Pages.php?PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
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
	
	function showEXEC_FIND(crt,PgE,IdT,IdL)
	{
		var gFnD = ReplaceText(objfrm.fFnDT.value);
		$(document).ready(function()
		{
			$("#formDiv2Exec").load('Rekn108_Usulan_Exec_Frm_Mid.php?gFnD='+gFnD+'&PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
		});
		$(document).ready(function()
		{
			$("#formDiv3Exec").load('Rekn108_Usulan_Exec_Frm_Pages.php?gFnD='+gFnD+'&PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
		});
	}
	
	function showEXEC_RefR(crt,PgE,IdT,IdL)
	{
		var gFnD = ReplaceText(objfrm.fFnDT.value);
		//$(document).ready(function()
		//{
		//	$("#formDiv2Exec").load('Rekn108_Usulan_Exec_Frm_Mid.php?gFnD='+gFnD+'&PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
		//});
		
		$(document).ready(function()
		{
			$.ajax({
				url:"Rekn108_Usulan_Exec_Frm_Mid.php",
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
			
		$(document).ready(function()
		{
			$("#formDiv3Exec").load('Rekn108_Usulan_Exec_Frm_Mid_Pages.php?gFnD='+gFnD+'&PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
		});
	}
	
	function showEXEC(crt,PgE,IdT,IdL)
	{
		var gFnD = "";
		document.getElementById('formDiv2Exec').style.display = "block";
		document.getElementById('formDiv3Exec').style.display = "block";
		$(document).ready(function()
		{
			$("#formDiv1Exec").load('Rekn108_Usulan_Exec_Frm_Top.php?crt='+crt+'&gFnD='+gFnD+'&PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
		});
		
		$(document).ready(function()
		{
			$("#formDiv2Exec").load('Rekn108_Usulan_Exec_Frm_Mid.php?gFnD='+gFnD+'&PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
		});
		
		$(document).ready(function()
		{
			$("#formDiv3Exec").load('Rekn108_Usulan_Exec_Frm_Mid_Pages.php?gFnD='+gFnD+'&PgE='+PgE+'&IdT='+IdT+'&IdL='+IdL);
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
				url:"Rekn108_Usulan_Veri_Frm_Veri_Save.php",
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
	
	function editCLICK(crt,PgE,tID,IdT,IdL)
	{
		if (tID==''){
			AN=confirm('Anda yakin akan merubah semua record?');
			if (!AN){return false;}
		}
		$(document).ready(function()
		{
			$("#ViewDELL").load('Rekn108_Usulan_Veri_Frm_Veri_Mid_Save.php?crt='+crt+'&PgE='+PgE+'&tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
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
	
	function execFORM_All(RefU,PgE,IdT,IdL)
	{
		alert('Under constructions...!!'); return false;
		gFnD="";
		var AN = confirm("Eksekusi semua..?!!");
		if (AN)
		{
			//$(document).ready(function()
			//{
			//	$("#formDiv2Exec").load('Invent_Usulan_Exec_Frm_Exe_All_Save.php?gFnD='+gFnD+'&PgE='+PgE+'&RefU='+RefU+'&IdT='+IdT+'&IdL='+IdL);
			//});
			
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
	
	function exeRECORD(ePros,eIdT,gFnD,PgE,IdT,IdL)
	{
		if (ePros=='none'){alert('Data belum disetujui, exsekusi data ditolak..!!');return false;}
		var AN = confirm("Eksekusi..?!!");
		if (AN)
		{
			/*
			$(document).ready(function()
			{
				$("#formDiv2Exec").load('Rekn108_Usulan_Exec_Frm_Mid_Exec_Rec.php?gFnD='+gFnD+'&PgE='+PgE+'&eIdT='+eIdT+'&IdT='+IdT+'&IdL='+IdL);
			});
			*/
			
			$(document).ready(function()
			{
				$.ajax({
					url:"Rekn108_Usulan_Exec_Frm_Mid_Exec_Rec.php",
					data: {gFnD:gFnD,PgE:PgE,eIdT:eIdT,IdT:IdT,IdL:IdL},
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
	
</script>