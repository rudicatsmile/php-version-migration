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
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="#">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; background-color:#D2DAC4">
  <tr>
    <td width="16">&nbsp;</td>
    <td width="75">&nbsp;</td>
    <td width="17">&nbsp;</td>
    <td width="218">&nbsp;</td>
    <td width="227">&nbsp;</td>
    <td width="738">&nbsp;</td>
    </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right"> UNIT KERJA </td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<select class="boxs" name="fUNT" tabindex="0" style="width:500px">
      <option value="ALL">ALL</option>
      <?php
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
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">FIND</td>
    <td align="center">&nbsp;</td>
    <td><input name="fFnD" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$IdL?>'); return false;}" style="padding-left:5px; width:210px; border: 1px solid #C0C0C0"/></td>
    <td><input type="button" name="B39" value="GO" onclick="RefreshDATA('<?=$IdL?>')" style="width: 40px; height: 21px" /></td>
    <td rowspan="2"><div id="loadingImg" style="width:200px; height:30px; display:none; vertical-align:middle; text-align:center"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #C9DCD8; font-weight:bold">
  <tr>
    <td width="30">NO</td>
    <td width="98">REFERENSI</td>
    <td width="100">KODE</td>
    <td width="65">REGISTER</td>
    <td width="220">NAMA ASET</td>
    <td width="70">PEROLEHAN</td>
    <td width="250">SKPD</td>
    <td width="100">AWAL</td>
    <td width="90">AKHIR</td>
    <td width="147">NO.PENGADAAN</td>
    <td>MUTASI DARI</td>
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
	
	function RefreshDATA(IdL)
	{
		var gUnT = objfrm.fUNT.value;
		var gFnD = ReplaceText(objfrm.fFnD.value);
		
		/*
		$(document).ready(function()
		{
			$("#ViewDATA").load('Utility_FindData_Frm_Data.php?gUnT='+gUnT+'&gFnD='+gFnD+'&IdL='+IdL);
		});
		*/
		
		$(document).ready(function()
		{
			$.ajax({
				url:"Utility_FindData_Frm_Data.php",
				data: {gUnT:gUnT,gFnD:gFnD,IdL:IdL},
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
</script>