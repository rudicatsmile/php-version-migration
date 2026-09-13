<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php if ($_POST['Simpan']=="Close") {?>
	<script LANGUAGE="JavaScript">            
	this.setTimeout("self.close()",0)
	</script>
<?php } ?>

<?php
if (isset($_POST['fUnt'])) {$gUnt  = $_POST['fUnt'];}
if (isset($_POST['fSub'])) {$gSub  = $_POST['fSub'];}
if (isset($_POST['fUpb'])) {$gUpb  = $_POST['fUpb'];}

if (isset($_POST['fBid'])) {$gBid  = $_POST['fBid'];}
if (isset($_POST['fKel'])) {$gKel  = $_POST['fKel'];}
if (isset($_POST['fJns'])) {$gJns  = $_POST['fJns'];}
if (isset($_POST['fOBJ'])) {$gOBJ  = $_POST['fOBJ'];}
if (isset($_POST['fRin'])) {$gRin  = $_POST['fRin'];}
if (isset($_POST['fThN'])) {$gThN  = $_POST['fThN'];}

if ($gThN=="") 
{
	$gThN  = fGetDate('year')-1;
}
?>

<body>
<form name="myfrm" method="post" action="<?php echo "Open_KIB_Choise_N_Mid.php?IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Simpan">
  <table border="0" style="width:640px">
    <tr> 
      <td width="8">&nbsp;</td>
      <td width="97">&nbsp;</td>
      <td width="28">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td align="right">UNIT KERJA</td>
      <td>&nbsp;</td>
      <td colspan="2"> 
        <select name="fUnt" tabindex="0" style="width: 420px" onchange="this.form.submit()">
        <?php
		if ($Lev <= 1 ) {echo "<option value='All'>All</option>";}
		if ($Lev > 1 )
			{$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit WHERE Kd_Unit = '".substr($SkP,0,11)."' ORDER BY Kd_Unit";}
		else
			{$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUnt=="") {$gUnt=$mRo['Kd_Unit'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Unit']==$gUnt) 
				{
				$sel ="selected";
				$gUnt=$mRo['Kd_Unit'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.$mRo['Kd_Unit']." : ".$mRo['Nm_Unit'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td align="right">SUB UNIT</td>
      <td>&nbsp;</td>
      <td colspan="2"> 
        <select class="boxs" name="fSub" tabindex="0" style="width: 420px" onchange="this.form.submit()">
		<option value="All">All</option>
        <?php
		if ($Lev <=3 ) {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".__' ORDER BY Kd_Sub";}
		else {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".".substr($SkP,12,2)."' ORDER BY Kd_Sub";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gSub=="") {$gSub=$mRo['Kd_Sub'];}
			if ((substr($gSub,0,11)!=$gUnt) && ($gSub!="All")) {$gSub=$mRo['Kd_Sub'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Sub']==$gSub) 
				{
				$sel ="selected";
				$gSub=$mRo['Kd_Sub'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Sub'].'">'.$mRo['Kd_Sub']." : ".$mRo['Nm_Sub'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td align="right">UPB</td>
      <td>&nbsp;</td>
      <td colspan="2"> 
        <select class="boxs" name="fUpb" tabindex="0" style="width: 420px" onchange="this.form.submit()">
		<option value="All">All</option>
        <?php
		#$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";
		
		if ($Lev <=3 ) {$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";}
		else {$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".".substr($SkP,-3,3)."' ORDER BY Kd_Upb";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUpb=="") {$gUpb = $mRo['Kd_Upb'];}
			if ((substr($gUpb,0,14)!=$gSub) && ($gUpb!="All")) {$gUpb = $mRo['Kd_Upb'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Upb']==$gUpb) 
				{
				$sel ="selected";
				$gUpb=$mRo['Kd_Upb'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Upb'].'">'.$mRo['Kd_Upb']." : ".$mRo['Nm_Upb'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
    </tr>
    <tr height="10">
      <td></td>
      <td></td>
      <td></td>
      <td colspan="2" valign="middle"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right">BIDANG</td>
      <td>&nbsp;</td>
      <td colspan="2" valign="middle">
	    <select class="boxs" name="fBid" tabindex="0" style="width: 420px" onchange="this.form.submit()">
        <option <?php if ($gBid=="All") {echo "selected";} ?> value="All">All</option>
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset1 ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
            if ($gBid!="All")
            {
			if ($gBid=="") {$gBid=$mRo['Kd_Aset'];}
            }
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gBid) 
				{
				$sel ="selected";
				$zBid=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right">KELOMPOK</td>
      <td>&nbsp;</td>
      <td colspan="2" valign="middle">
	    <select class="boxs" name="fKel" tabindex="0" style="width: 420px" onchange="this.form.submit()">
        <option <?php if ($gKel=="All") {echo "selected";} ?> value="All">All</option>
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset2 WHERE Kd_Aset LIKE '".$zBid.".__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
            if ($gKel!="All")
            {
				if ($gKel=="") {$gKel=$mRo['Kd_Aset'];}
                #if (substr($gKel,0,2)!=$gBid) {$gKel=$mRo['Kd_Aset'];}
            }
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gKel) 
				{
				$sel ="selected";
				$zKel=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right">JENIS</td>
      <td>&nbsp;</td>
      <td colspan="2" valign="middle">
	    <select class="boxs" name="fJns" tabindex="0" style="width: 420px" onchange="this.form.submit()">
        <option <?php if ($gJen=="All") {echo "selected";} ?> value="All">All</option>
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset3 WHERE Kd_Aset LIKE '".$zKel.".__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gJns!="All")
            {
                if ($gJns=="") {$gJns=$mRo['Kd_Aset'];}
                if (substr($gJns,0,5)!=$gKel) {$gJns=$mRo['Kd_Aset'];}
            }
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gJns) 
				{
				$sel ="selected";
				$zJns=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right">OBJEK</td>
      <td>&nbsp;</td>
      <td colspan="2" valign="middle">
	  <select class="boxs" name="fOBJ" tabindex="0" style="width: 420px" onchange="this.form.submit()">
        <option <?php if ($gOBJ=="All") {echo "selected";} ?> value="All">All</option>
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset4 WHERE Kd_Aset LIKE '".$gKel.".".substr($zJns,6,2).".__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
            if ($gOBJ!="All")
            {  
			if ($gOBJ=="") {$gOBJ=$mRo['Kd_Aset'];}
			if (substr($gOBJ,0,8)!=$gJns) {$gOBJ=$mRo['Kd_Aset'];}
            }
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gOBJ) 
				{
				$sel ="selected";
				$zOBJ=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right">RINCIAN</td>
      <td>&nbsp;</td>
      <td colspan="2" valign="middle">
	    <select class="boxs" name="fRin" tabindex="0" style="width: 420px">
        <option <?php if ($gRin=="All") {echo "selected";} ?> value="All">All</option>
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset5 WHERE Kd_Aset LIKE '".$gKel.".".substr($zJns,6,2).".".substr($zOBJ,9,2).".___' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gRin!="All")
            {
            if ($gRin=="") {$gRin=$mRo['Kd_Aset'];}
			if (substr($gRin,0,11)!=$gOBJ) {$gRin=$mRo['Kd_Aset'];}
            }
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gRin) 
				{
				$sel ="selected";
				$zRin=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select></td>
    </tr>
    
    
    <tr> 
      <td>&nbsp;</td>
      <td align="right">TAHUN</td>
      <td>&nbsp;</td>
      <td width="76" valign="middle">
		<select class="boxs" name="fThN" style="width: 60px" tabindex="0">
		<?php
		for($nThn=2017; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($gThN==$nThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select></td>
      <td width="409" valign="bottom">
	  <label style="color:#FF0000"><input type="checkbox" name="breakd" value="ON" />Breakdown Ke Rincian</label></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2" valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2" valign="middle">
	  <input type="button" name="B01" value="DOKUMEN KIB" onclick="P_OpenDoc('800','400')"  style="width: 100px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
        <input type="hidden" name="B012" value="EXPORT DATA (*.XLS)" onclick="P_ToExcel('800','400')"  style="width: 100px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
        <input type="button" name="B02" value="TUTUP" onclick="P_Close()"  style="width: 100px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />	  </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	
	function P_ToExcel(w,h)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		
		var rUnt=objfrm.fUnt.value;
		var rSub=objfrm.fSub.value;
		var rUpb=objfrm.fUpb.value;
		
		var rBid=objfrm.fBid.value;
		var rKel=objfrm.fKel.value;
		var rJns=objfrm.fJns.value;
		var rOBJ=objfrm.fOBJ.value;
		var rRin=objfrm.fRin.value;

		var rMLK=objfrm.fMlk.value;
		var rThA=objfrm.fThA.value;
		var rThB=objfrm.fThB.value;
		
		rPil=parseInt(rBid);
		switch(rPil)
		{
		case 1 :
			fDoc ="KIB_A_ToExcel_Choise"
			break;
		case 2 :
			fDoc ="KIB_B_ToExcel_Choise"
			break;
		case 3 :
			fDoc ="KIB_C_ToExcel_Choise"
			break;
		case 4 :
			fDoc ="KIB_D_ToExcel_Choise"
			break;
		case 5 :
			fDoc ="KIB_E_ToExcel_Choise"
			break;
		case 6 :
			fDoc ="KIB_F_ToExcel_Choise"
			break;
		//case 7 :
		//	fDoc ="ToExcel/KIB_G_ToExcel_Choise"
		//	break;
		}
		
		if (fDoc=="")
		{
			window.alert('Under construction...!!');
			return false;
		}
		
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= "ToExcel/KIB_X_ToExcel_Count.php?gDoc="+fDoc+"&gUnt="+rUnt+"&gSub="+rSub+"&gUpb="+rUpb+"&gThA="+rThA+"&gThB="+rThB+"&gMLK="+rMLK+"&gBid="+rBid+"&gKel="+rKel+"&gJns="+rJns+"&gOBJ="+rOBJ+"&gRin="+rRin+"<?="&IdL=".$_GET['IdL']?>";
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function P_OpenDoc(w,h)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		
		var rUnt=objfrm.fUnt.value;
		var rSub=objfrm.fSub.value;
		var rUpb=objfrm.fUpb.value;
		
		var rBid=objfrm.fBid.value;
		var rKel=objfrm.fKel.value;
		var rJns=objfrm.fJns.value;
		var rOBJ=objfrm.fOBJ.value;
		var rRin=objfrm.fRin.value;

		var rThN=objfrm.fThN.value;
		if (objfrm.breakd.checked==true){
			rBrk = 'YA';
		}
		else{
			rBrk = 'NO';
		}
		//alert(rBrk); return false;
		
		LeftPosition=(screen.width)?(screen.width-w)/2:100;
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL = "KIB_Tahun_N.php?rBrk="+rBrk+"&gUnt="+rUnt+"&gSub="+rSub+"&gUpb="+rUpb+"&gThN="+rThN+"&gBid="+rBid+"&gKel="+rKel+"&gJns="+rJns+"&gOBJ="+rOBJ+"&gRin="+rRin+"<?="&IdL=".$_GET['IdL']?>";
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
	}

</script>

<?php require('Connection_Close.php');?>
