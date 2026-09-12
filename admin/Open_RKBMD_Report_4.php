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
<script type="text/javascript" src="FileFormatNum.js"></script>
</head>
<?php
extract($_GET);
$gUNT = substr($SkP,0,11);
$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");

$gTHN = fGetDate('year')+1;
$Hri  = fGetDate('mday');
$Bln  = fGetDate('mon');
$Thn  = fGetDate('year');

?>
<body onload="RefreshDATA('<?=$stLOCK?>','<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="">
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:700px; height:30px; background: #EAE6E6">
  <tr>
    <td width="5">&nbsp;</td>
    <td>&nbsp;</td>
	<td width="5">&nbsp;</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:700px">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="88">&nbsp;</td>
    <td width="22">&nbsp;</td>
    <td width="588">&nbsp;</td>
    </tr>
  <tr height="25">
    <td class="ar">UNIT KERJA </td>
    <td align="center">:</td>
    <td>
	<input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" <?php if ($Lev <= 1) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" onkeypress="if (event.keyCode==13) {showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" <?php } ?> style="padding-left:5px; width:450px; border: 1px solid #C0C0C0; text-transform:uppercase"/>
	<div id="unitMstCri" class="find0Cri">
		<div id="unitDiv1Cri" class="find1Cri"></div>
		<div id="unitDiv2Cri" class="find2Cri"></div>
	</div>	</td>
    </tr>
  <tr height="25">
    <td class="ar">PERIODE</td>
    <td align="center">:</td>
    <td>
		<select class="boxs" name="fTHN" id="fTHN" tabindex="0" style="width:60px">
		<?php
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
		
		<select class="boxs" name="fUBH" id="fUBH" tabindex="0" style="width:100px">
		<option value="0">Murni</option>
		<option value="1">Perubahan</option>
		</select>	</td>
  </tr>
  <tr height="25">
    <td class="ar">TGL. CETAK </td>
    <td class="ac">:</td>
    <td>
	  <select class="boxs" name="tHri" id="tHri" tabindex="0" style="width:45px">
		<option value="00"></option>
        <?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$Hri) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
      </select>
        <select class="boxs" name="tBln" id="tBln" tabindex="0" style="width:90px">
		<option value="00"></option>
          <?php
			for($nBln=1; $nBln<=12; $nBln++)
			{
				$sel ="";
				if ($nBln==$Bln) {$sel ="selected";}
				echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
			}
			?>
        </select>
        <select class="boxs" name="tThn" id="tThn" style="width: 60px" tabindex="0">
		<option value="0000"></option>
          <?php
			for($nThn=1900; $nThn<=2030; $nThn++)
			{
			$sel ="";
			if ($nThn==$Thn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
        </select>			
	</td>
  </tr>  
  <tr height="25">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onclick="P_Dokumen('800','400','RKBMD_Usulan_Pemeliharaan_PENGELOLA','<?=$_GET['IdL']?>'); return false;">&nbsp;&nbsp;&nbsp;RKBMD USULAN ( PEMELIHARAAN BMD ) *</a></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a href="#" class="ico docu" onclick="P_Dokumen('800','400','RKBMD_Usulan_Pemeliharaan_PENGELOLA_Telaah','<?=$_GET['IdL']?>'); return false;">&nbsp;&nbsp;&nbsp;TELAAH RKBMD USULAN ( PEMELIHARAAN BMD ) *</a></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:700px; height:30px; background: #EAE6E6">
  <tr>
    <td width="5">&nbsp;</td>
    <td></td>
	<td width="5">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
<script languange="javascript">
	var objfrm=document.myfrm;
	
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
	

	function P_Dokumen(w,h,dok,IdL)
	{
		fUNT = $("#fUNT").val();
		fTHN = $("#fTHN").val();
		fUBH = $("#fUBH").val();
		
		Hri = $("#tHri").val();
		Bln = $("#tBln").val();
		Thn = $("#tThn").val();
		
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		file = "";
		if (fUBH=='1'){
			file = "_Abt";
		}
		URL= "report/"+dok+file+'.php?fUNT='+fUNT+'&fTHN='+fTHN+'&Hri='+Hri+'&Bln='+Bln+'&Thn='+Thn+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
</script>