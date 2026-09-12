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
?>
<body onload="RefreshDATA('0','<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="#">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; background-color:#D2DAC4">
  <tr>
    <td width="13">&nbsp;</td>
    <td width="67">&nbsp;</td>
    <td width="14">&nbsp;</td>
    <td width="356">&nbsp;</td>
    <td width="111">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="397">&nbsp;</td>
    <td width="59" rowspan="4"><div id="loadingImg" style="width:30px; height:30px; display:none; vertical-align:middle; text-align:center"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
  </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right"> UNIT KERJA </td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<select class="boxs" name="fUNT" tabindex="0" style="width:501px" onchange="RefreshDATA('0','<?=$IdL?>')">
      <!--option value="ALL">ALL</option-->
      <?
		$nSQ="SELECT kd_unit, nm_unit FROM ref_unit ORDER BY kd_unit";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$sel ="";
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">ASET</td>
    <td align="center">&nbsp;</td>
    <td>
	<label><input name="fExT" type="radio" value="1.3.1" onclick="RefreshDATA('0','<?=$IdL?>')" checked />KIB-A</label>&nbsp;&nbsp;
	<label><input name="fExT" type="radio" value="1.3.2" onclick="RefreshDATA('0','<?=$IdL?>')" />KIB-B</label>&nbsp;&nbsp;
	<label><input name="fExT" type="radio" value="1.3.3" onclick="RefreshDATA('0','<?=$IdL?>')" />KIB-C</label>&nbsp;&nbsp;
	<label><input name="fExT" type="radio" value="1.3.4" onclick="RefreshDATA('0','<?=$IdL?>')" />KIB-D</label>&nbsp;&nbsp;
	<label><input name="fExT" type="radio" value="1.3.5" onclick="RefreshDATA('0','<?=$IdL?>')" />KIB-E</label>&nbsp;&nbsp;
	<!--label><input name="fExT" type="radio" value="06" onclick="RefreshDATA('0','<?=$IdL?>')" />KIB-F</label>&nbsp;&nbsp;-->
	<label><input name="fExT" type="radio" value="1.5" onclick="RefreshDATA('0','<?=$IdL?>')" />KIB-G</label></td>
    <td valign="bottom"><label><input type="checkbox" name="fMuT" value="ON" onclick="RefreshDATA('0','<?=$IdL?>')" />DATA MUTASI</label></td>
    <td valign="bottom" width="94"><label><input type="checkbox" name="fInV" value="ON" onclick="RefreshDATA('0','<?=$IdL?>')" />INVERT</label></td>
    <td width="47">FIND</td>
    <td width="133"><input name="fFnDT" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('0','<?=$IdL?>'); return false;}" style="padding-left:5px; width:120px; border: 1px solid #C0C0C0"/></td>
    <td><input type="button" name="B39" value="GO" onclick="RefreshDATA('0','<?=$IdL?>')" style="width:40px; height: 24px" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
	<div id="imgMstCri" class="upload_a">
		<div id="imgDiv1Cri" class="upload_b"></div>
		<div id="imgDiv2Cri" class="upload_c"></div>
	</div>	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #C9DCD8; font-weight:bold">
  <tr>
    <td width="34" style="padding-left:3px">NO</td>
    <td width="110">REF. POST </td>
    <td width="105" style="text-align:right; padding-right:13px">VAL. POST </td>
    <td width="110">REF. KIB</td>
    <td width="106" style="text-align:right; padding-right:15px">VAL. KIB</td>
    <td width="95">KD. ASET</td>
    <td width="380">NAMA ASET</td>
    <td width="90">PEROLEHAN</td>
    <td>KETERANGAN</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:360px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	<div id="ViewDATA" style="height:355px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
<br>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:50px; background-color:#D2D89B">
  <tr>
    <td valign="top">
	<div id="ViewBOTT" style="height:50px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
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
	
	function RefreshDATAreff(PgE,IdL)
	{
		var gFnD = ReplaceText(objfrm.fFnDT.value);
		var gUnT = objfrm.fUNT.value;
		if (objfrm.fMuT.checked==true){
			eMuT = "_mutasi";
		}
		else{
			eMuT = "";
		}
		
		if (objfrm.fInV.checked==true){
			eInV = "Invert";
		}
		else{
			eInV = "";
		}
		
		
		Len = objfrm.fExT.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fExT[i].checked) {gExT = objfrm.fExT[i].value; break; }
		}
		$(document).ready(function()
		{
			$("#ViewBOTT").load('Utility_Missing_Post_Frm_Stat.php?PgE='+PgE+'&gFnD='+gFnD+'&gUnT='+gUnT+'&gExT='+gExT+'&eMuT='+eMuT+'&eInV='+eInV+'&IdL='+IdL);
		});
	}
	
	function RefreshDATA(PgE,IdL)
	{
		var gFnD = ReplaceText(objfrm.fFnDT.value);
		var gUnT = objfrm.fUNT.value;
		
		if (objfrm.fMuT.checked==true){
			eMuT = "_mutasi";
		}
		else{
			eMuT = "";
		}
		
		if (objfrm.fInV.checked==true){
			eInV = "Invert";
		}
		else{
			eInV = "";
		}
		Len = objfrm.fExT.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fExT[i].checked) {gExT = objfrm.fExT[i].value; break; }
		}
		/*
		$(document).ready(function()
		{
			$("#ViewDATA").load('Utility_Extracom_Frm_Data.php?PgE='+PgE+'&gFnD='+gFnD+'&gUnT='+gUnT+'&gExT='+gExT+'&eMuT='+eMuT+'&eInV='+eInV+'&IdL='+IdL);
		});
		*/
		
		$(document).ready(function()
		{
			$.ajax({
				url:"Utility_Missing_Post_Frm_Data.php",
				data: {PgE:PgE,gFnD:gFnD,gUnT:gUnT,gExT:gExT,eMuT:eMuT,eInV:eInV,IdL:IdL},
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
	
	function ExecDATA(IdL)
	{
		var gUnT = objfrm.fUNT.value;
		var Len = objfrm.fExT.length;
		
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fExT[i].checked) {gExT = objfrm.fExT[i].value; break; }
		}
		if (objfrm.fMuT.checked==true){
			eMuT = "_mutasi";
		}
		else{
			eMuT = "";
		}
		
	 	var gComP="";
		for (i = 0; i < objfrm.fComP.length; i++)
		{
			if (objfrm.fComP[i].checked)
			{
				gComP += objfrm.fComP[i].value+"-";
			}
		}
		var gCrID = gComP;
		
		if (gCrID==''){alert('Data aset belum ada yang ditandai..!!');return false;}
		var AN = confirm("Proses extracomptable..?!!");
		if (!AN)
		{
			return false;
		}
		
		
		$(document).ready(function()
		{
			$("#ViewDATA").load('#Utility_Extracom_Frm_Exec.php?gCrID='+gCrID+'&gUnT='+gUnT+'&gExT='+gExT+'&eMuT='+eMuT+'&IdL='+IdL);
		});
		
		/*
		$(document).ready(function()
		{
			$.ajax({
				url:"Utility_Extracom_Frm_Exec.php",
				data: {gCrID:gCrID,gUnT:gUnT,gExT:gExT,eMuT:eMuT,IdL:IdL},
				type:"get",
				beforeSend:function()
				{
					$("#loadingImg").show();
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#ViewDELL").html(data);
					//$("#ViewDATA").show("fast");
				}
			});
		});
		*/
	}
</script>