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
extract($_POST);
$unt = $fUNT;
#echo $unt;
$sub = $fSUB;
$upb = $fUPB;
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="Utility_Import_SQL_EFN.php?FrmG=".$FrmG."&IdL=".$IdL?>">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; background-color:#D2DAC4">
  <tr>
    <td width="14">&nbsp;</td>
    <td width="58">&nbsp;</td>
    <td width="15">&nbsp;</td>
    <td width="530">&nbsp;</td>
    <td width="58">&nbsp;</td>
    <td width="18">&nbsp;</td>
    <td width="163">&nbsp;</td>
    <td width="53">&nbsp;</td>
    <td width="90">&nbsp;</td>
    <td width="85">&nbsp;</td>
    <td width="260">&nbsp;</td>
    <td width="114">&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">Unit Kerja </td>
    <td align="center">&nbsp;</td>
    <td>
	<select class="boxs" name="fUNT" id="fUNT" tabindex="0" style="width:500px" onchange="this.form.submit()">
      <?php
		$nSQ="SELECT kd_unit, nm_unit FROM ref_unit ORDER BY kd_unit";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			if ($unt==''){$unt = $mRo[0];}
			$sel ="";
			if ($unt==$mRo[0]){
				$sel  = "selected";
				$zunt = $mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo[1].'</option>';
		}
		?>
    </select></td>
    <td>Kondisi </td>
    <td>&nbsp;</td>
    <td><select class="boxs" name="fKON" id="fKON" tabindex="0" style="width:140px" onchange="RefreshDATA('view','<?=$IdL?>')">
      <option value="0">0</option>
      <option value="1">1. Baik</option>
      <option value="2">2. Kurang Baik</option>
      <option value="3" selected>3. Rusak Berat</option>
      <option value="4">4. Hilang</option>
      <option value="5">5. Tidak Diketemukan</option>
      <option value="6">6. Lainnya</option>
    </select></td>
    <td width="53">Record</td>
    <td width="90"><select class="boxs" name="fREC" id="fREC" tabindex="0" style="width:80px" onchange="RefreshDATA('view','<?=$IdL?>')">
      <option value="50">50</option>
      <option value="100">100</option>
      <option value="500">500</option>
      <option value="1000" selected>1000</option>
      <option value="1500">1500</option>
      <option value="2000">2000</option>
      <option value="5000">5000</option>
      <option value="10000">10000</option>
    </select></td>
    <td width="85" rowspan="3">
	<input type="button" name="B39" id="B39" value="REFRESH" onclick="RefreshDATA('view','<?=$IdL?>')" style="width:80px; height:45px" />
	<br></td>
    <td width="260" rowspan="3">
	<input type="button" name="B392" value="IMPORT" disabled onclick="RefreshDATA('import','<?=$IdL?>')" style="width:80px; height:20px" />
      <br>
	<input type="button" name="B3922" value="BATALKAN" disabled onclick="RefreshDATA('batal','<?=$IdL?>')" style="width:80px; height:20px" /></td>
    <td rowspan="3"><div id="loadingImg" style="width:50px; height:50px; display:none; vertical-align:middle; text-align:center"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">Sub Unit </td>
    <td align="center">&nbsp;</td>
    <td>
	<select class="boxs" name="fSUB" tabindex="0" style="width:500px" onchange="this.form.submit()">
	<option value="">ALL</option>
      <?php
		$nSQ="SELECT kd_sub, nm_sub FROM ref_sub_unit WHERE kd_sub LIKE '".$zunt."%' ORDER BY kd_sub";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			#if ($unt != substr($sub,0,11)){$sub = $mRo[0];}
			$sel ="";
			if ($sub==$mRo[0]){
				$sel  = "selected";
				$zsub = $mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo[1].'</option>';
		}
		?>
    </select></td>
    <td>Kd KA </td>
    <td>&nbsp;</td>
    <td>
	<select class="boxs" name="fKKA" id="fKKA" tabindex="0" style="width:140px" onchange="RefreshDATA('view','<?=$IdL?>')">
      <option value="" selected>ALL</option>
      <option value="0">0. Extracom</option>
      <option value="1">1. Non Extra</option>
    </select></td>
    <td>Tahun</td>
    <td>
	<select class="boxs" name="fTHN" id="fTHN" tabindex="0" style="width:80px" onchange="RefreshDATA('view','<?=$IdL?>')">
	  <option value="2019">2019</option>
	  <option value="2020">2020</option>
	  <option value="2021">2021</option>
	  <option value="2022">2022</option>
	  <option value="2023">2023</option>
	  <option value="2024">2024</option>
	  <option value="2030" selected>2030</option>
	  <option value="2026">2026</option>
    </select>	</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">UPB</td>
    <td align="center">&nbsp;</td>
    <td>
	<select class="boxs" name="fUPB" id="fUPB" tabindex="0" style="width:500px" onchange="RefreshDATA('view','<?=$IdL?>')">
	<option value="">ALL</option>
	<?php
		if ($zsub)
		{
			$nSQ="SELECT kd_upb, nm_upb FROM ref_upb WHERE kd_upb LIKE '".$zsub."%' ORDER BY kd_upb";
			$nRs = mysql_query($nSQ);
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				#if ($sub != substr($upb,0,14)){$upb = $mRo[0];}
				$sel ="";
				if ($upb==$mRo[0]){
					$sel  = "selected";
					$zupb = $mRo[0];
				}
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo[1].'</option>';
			}
		}
		?>
    </select></td>
    <td>Miss</td>
    <td>&nbsp;</td>
    <td><input type="text" name="fMIS" id="fMIS" style="width:74px" /></td>
    <td>Page</td>
    <td><select class="boxs" name="fPAG" id="fPAG" tabindex="0" style="width:80px" onchange="RefreshDATA('view','<?=$IdL?>')">
      <option value="1" selected>1</option>
      <?php for ($iG=2; $iG<=200; $iG++){?>
      <option value="<?=$iG?>">
      <?=$iG?>
      </option>
      <?php } ?>
    </select></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
    <td width="30" align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:390px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	<div id="ViewDATA" style="height:435px; width:100%; overflow:auto; border:0px"></div>
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
	
	function RefreshDATA(crt,IdL)
	{
		gUnT = objfrm.fUNT.value;
		gSuB = objfrm.fSUB.value;
		gUpB = objfrm.fUPB.value;
		gReC = objfrm.fREC.value;
		gPaG = objfrm.fPAG.value;
		
		gKoN = objfrm.fKON.value;
		gKkA = objfrm.fKKA.value;
		gThN = objfrm.fTHN.value;
		gFnD = "";

		if (crt=='import')
		{
			//fil = "Utility_Import_SQL_EFN_Import";
			//vie = "ViewDELL";
			//AN=confirm('Import?');
			//if (!AN){return false;}
			return false;
		}
		else if (crt=='batal')
		{
			//fil = "Utility_Import_SQL_EFN_Batal";
			//vie = "ViewDELL";
			//AN=confirm('Batalkan?');
			//if (!AN){return false;}
			return false;
		}
		else
		{
			fil = "Utility_Import_SQL_EFN_Data";
			vie = "ViewDATA";
		}
		
		$(document).ready(function()
		{
			$.ajax({
				url:fil+".php",
				data: {gUnT:gUnT,gSuB:gSuB,gUpB:gUpB,gReC:gReC,gPaG:gPaG,gKoN:gKoN,gKkA:gKkA,gThN:gThN,IdL:IdL},
				type:"get",
				beforeSend:function()
				{
					$("#loadingImg").show();
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#"+vie).html(data);
				}
			});
		});
	}
</script>