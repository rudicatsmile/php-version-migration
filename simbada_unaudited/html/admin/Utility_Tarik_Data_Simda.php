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
<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="#">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:800px;">
  <tr height="40">
    <td width="11">&nbsp;</td>
    <td width="150">&nbsp;</td>
    <td width="30">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="30">
    <td>&nbsp;</td>
    <td align="right"> UNIT KERJA </td>
    <td align="center">&nbsp;</td>
    <td>
	<select class="boxs" name="fUNT" tabindex="0" style="width:501px">
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
    </tr>
  <tr height="30">
    <td>&nbsp;</td>
    <td align="right">D A T A</td>
    <td align="center">&nbsp;</td>
    <td>
	<table>
	  <tr>
	  <td width="100"><label><input name="fAst" type="radio" value="prog" checked />Program</label></td>
	  <td width="100"><label><input name="fAst" type="radio" value="kegi" />Kegiatan</label></td>
	  <td width="100"><label><input name="fAst" type="radio" value="bela" />Rekening</label></td>
	  <td>&nbsp;</td>
	</tr>
	</table>  </tr>
  
  <tr height="30">
    <td>&nbsp;</td>
    <td align="right">TAHUN</td>
    <td>&nbsp;</td>
    <td>
	<select class="boxs" name="fTHN" style="width:65px" tabindex="0">
 	<?
	$gTH = 2022;
	for($i=2021; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select>	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="button" name="B392" value="PROSES" onclick="ImportDATA('<?=$IdL?>')" style="width:99px; height: 24px" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="100">
    <td colspan="4" style="padding-left:5px"><div id="ViewDATA"></div></td>
  </tr>
</table>
</form>
</body>
</html>
<script languange="javascript">
	var objfrm=document.myfrm;
	function ImportDATA(IdL)
	{
		UnT = objfrm.fUNT.value;
		Thn = objfrm.fTHN.value;
		
		Ast = "";
		Len = objfrm.fAst.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fAst[i].checked) {Ast = objfrm.fAst[i].value; break; }
		}
		
		$(document).ready(function()
		{
			$("#ViewDATA").load('Utility_Tarik_Data_Simda_Proses.php?UnT='+UnT+'&Thn='+Thn+'&Ast='+Ast+'&IdL='+IdL);
		});
		
		//LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		//TopPosition=(screen.height)?(screen.height-h)/2:100;
		//URL = 'Utility_Tarik_KIB_Dok.php?gUnT='+gUnT+'&gThn='+gThn+'&Ast='+Ast+'&IdL='+IdL;
		//settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		//window.open(URL,'',settings);
	}
	
	function errorMSG(MsG)
	{
		alert(MsG); return false;
	}
</script>