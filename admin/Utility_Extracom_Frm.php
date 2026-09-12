<?php
require('Connection.php');
require('FileFunction.php');
//require("CheckLogin.php");
#echo $Lev."<br>";
#echo $SkP."<br>";
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
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="#">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; background-color:#D2DAC4">
  <tr>
    <td width="11">&nbsp;</td>
    <td width="61">&nbsp;</td>
    <td width="12">&nbsp;</td>
    <td width="501">&nbsp;</td>
    <td width="105">&nbsp;</td>
    <td width="121">&nbsp;</td>
    <td width="208">&nbsp;</td>
    <td width="199">&nbsp;</td>
    <td width="73" rowspan="2"><div id="loadingImg" style="width:30px; height:30px; display:none; vertical-align:middle; text-align:center"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
  </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right"> UNIT KERJA </td>
    <td align="center">&nbsp;</td>
    <td>
	<select class="boxs" name="fUNT" tabindex="0" style="width:501px">
      <!--option value="ALL">ALL</option-->
      <?php
		if ($Lev<=1)
		{
			$nSQ="SELECT kd_unit, nm_unit FROM ref_unit ORDER BY kd_unit";
		}
		else
		{
			$nSQ="SELECT kd_unit, nm_unit FROM ref_unit WHERE kd_unit='".substr($SkP,0,11)."' ORDER BY kd_unit";
		}
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
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">ASET</td>
    <td align="center">&nbsp;</td>
    <td colspan="4">
	<table>
	<tr>
	<td width="70"><label><input name="fExT" type="radio" value="1.3.2" checked />KIB-B</label></td>
	<td width="70"><label><input name="fExT" type="radio" value="1.3.3" />KIB-C</label></td>
	<td width="70"><label><input name="fExT" type="radio" value="1.3.5" />KIB-E</label></td>
	<td width="70"><label><input name="fExT" type="radio" value="1.5.4" />KIB-G</label></td>
	<td width="120" valign="bottom"><label><input type="checkbox" name="fMuT" value="ON" />SUDAH MUTASI</label></td>
	<td width="100"><label><input name="fNoN" type="radio" value="Y" checked />SUDAH EXTRA</label></td>
	<td width="120"><label><input name="fNoN" type="radio" value="N"/>BELUM EXTRA</label></td>
	<td width="122"><label style="color:#FF0000"><input type="checkbox" name="fReS" value="ON" />Reset Extracom</label></td>
	<td width="153"><input type="button" name="B39" value="P R E V I E W" onclick="RefreshDATA('<?=$IdL?>')" style="width:99px; height: 24px" /></td>
	</tr>
	</table>
    <td>&nbsp;</td>
    <td><input type="hidden" name="B392" value="RESET" onclick="ResetDATA('<?=$IdL?>')" style="width: 60px; height: 24px; color:#FF0000" /></td>
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
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #C9DCD8; font-weight:bold">
  <tr>
    <td width="30" align="center">NO</td>
    <td width="92" align="center">REFERENSI</td>
    <td width="90" align="center">KODE</td>
    <td width="55" align="center">REGISTER</td>
    <td width="300" align="center">NAMA ASET</td>
    <td width="100" align="center">PEROLEHAN</td>
    <td width="80" align="right">NILAI AWAL</td>
    <td width="100" align="right">NILAI AKHIR</td>
    <td width="100" align="right">PARAMETER</td>
    <td width="80" align="center">EXTRA</td>
    <td align="center">URAIAN</td>
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
	
	function RefreshDATAreff(Nil,IdL)
	{
		gUnT = objfrm.fUNT.value;
		Len = objfrm.fExT.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fExT[i].checked) {gExT = objfrm.fExT[i].value; break; }
		}
		
		Len = objfrm.fNoN.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fNoN[i].checked) {gNoN = objfrm.fNoN[i].value; break; }
		}
		
		//Len = objfrm.fThN.length;
		//for (i=0; i<=Len; i++)
		//{
		//	if (objfrm.fThN[i].checked) {gThN = objfrm.fThN[i].value; break; }
		//}
		//alert(gThN); return false;
		
		$(document).ready(function()
		{
			$("#ViewBOTT").load('Utility_Extracom_Frm_Stat.php?gUnT='+gUnT+'&gExT='+gExT+'&gNoN='+gNoN+'&Nil='+Nil+'&IdL='+IdL);
		});
	}
	
	function RefreshDATA(IdL)
	{
		var gUnT = objfrm.fUNT.value;
		if (objfrm.fMuT.checked==true){
			eMuT = "_mutasi";
		}
		else{
			eMuT = "";
		}
		
		eReS = "";
		if (objfrm.fReS.checked==true){eReS = "reset";}
		if (eReS!='')
		{
			AN=confirm('Reset extracom jadi aset..??');
			if (!AN){return false;}
		}
		
		Len = objfrm.fExT.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fExT[i].checked) {gExT = objfrm.fExT[i].value; break; }
		}
		
		Len = objfrm.fNoN.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fNoN[i].checked) {gNoN = objfrm.fNoN[i].value; break; }
		}
		
		//Len = objfrm.fThN.length;
		//for (i=0; i<=Len; i++)
		//{
		//	if (objfrm.fThN[i].checked) {gThN = objfrm.fThN[i].value; break; }
		//}
		/*
		$(document).ready(function()
		{
			$("#ViewDATA").load('Utility_Extracom_Frm_Data.php?gUnT='+gUnT+'&gNoN='+gNoN+'&gExT='+gExT+'&eMuT='+eMuT+'&eReS='+eReS+'&IdL='+IdL);
		});
		*/
		
		$(document).ready(function()
		{
			$.ajax({
				url:"Utility_Extracom_Frm_Data.php",
				data: {gNoN:gNoN,gUnT:gUnT,gExT:gExT,eMuT:eMuT,eReS:eReS,IdL:IdL},
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
		objfrm.fUNT.focus();
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
		
		Len = objfrm.fNoN.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fNoN[i].checked) {gNoN = objfrm.fNoN[i].value; break; }
		}
		
	 	var gComP="";
		Len = objfrm.fComP.length;
		for (i = 0; i < Len; i++)
		{
			if (objfrm.fComP[i].checked)
			{
				gComP += objfrm.fComP[i].value+"-";
			}
		}
		var gCrID = gComP;
		if (gCrID==''){alert('Data aset belum ada yang ditandaix..!!');return false;}
		var AN = confirm("Proses extracomptable..?!!");
		if (!AN)
		{
			return false;
		}
		
		
		$(document).ready(function()
		{
			$("#ViewDATA").load('Utility_Extracom_Frm_Exec.php?gCrID='+gCrID+'&gUnT='+gUnT+'&gExT='+gExT+'&eMuT='+eMuT+'&gNoN='+gNoN+'&IdL='+IdL);
		});
		
		/*
		$(document).ready(function()
		{
			$.ajax({
				url:"Utility_Extracom_Frm_Exec.php",
				data: {gCrID:gCrID,gUnT:gUnT,gExT:gExT,gNoN:gNoN,eMuT:eMuT,IdL:IdL},
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