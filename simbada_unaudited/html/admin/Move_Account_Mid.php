<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?
extract($_POST);
extract($_GET);
$rKib = $rKib;
$rIDT = $rIDT;

$gBid = $gBid;
$gKel = $gKel;
$gObj = $gObj;
$gRin = $gRin;
$gSub = $gSub;

if ($rIDT!="")
{
	$gDAT = fGlobal("Referensi:Ref_Group:Kd_Aset_108:No_Register","ta_kib_108","IDT",$rIDT,"=","","");
	$gDAT = explode(':',$gDAT);
	$gNma = fGlobal("Nm_Aset","Ref_Rek_Aset108_7","Kd_Aset",$gDAT[2],"=","","");
	
	if ($gBid==""){$gBid=substr($gDAT[2],0,5);}
	if ($gKel==""){$gKel=substr($gDAT[2],0,8);}
	if ($gObj==""){$gObj=substr($gDAT[2],0,11);}
	if ($gRin==""){$gRin=substr($gDAT[2],0,14);}
	if ($gSub==""){$gSub=substr($gDAT[2],0,18);}
}
else
{
	$gDAT[0]="";
	$gDAT[1]="";
	$gDAT[2]="";
	$gDAT[3]="";
}

if (strlen($rKib)==6){
	$CrT = strtoupper(substr($rKib,-2,1));
	$XrT = $CrT;
}
else{
	$CrT = strtoupper(substr($rKib,-1,1));
	$XrT = $CrT;
}

#if ($CrT=="A") {$CrT="01";}
#if ($CrT=="B") {$CrT="02";}
#if ($CrT=="C") {$CrT="03";}
#if ($CrT=="D") {$CrT="04";}
#if ($CrT=="E") {$CrT="05";}
#if ($CrT=="F") {$CrT="06";}
#if ($CrT=="G") {$CrT="07";}

if ($CrT=="A") {$CrT="1.3.1";}
if ($CrT=="B") {$CrT="1.3.2";}
if ($CrT=="C") {$CrT="1.3.3";}
if ($CrT=="D") {$CrT="1.3.4";}
if ($CrT=="E") {$CrT="1.3.5";}
if ($CrT=="F") {$CrT="1.3.6";}
if ($CrT=="G") {$CrT="1.5.4";}
if ($CrT=="J") {$CrT="1.5.3";}
?>

<body>
<form name="myfrm" method="post" action="<?php echo "Move_Account_Mid_.php?rIDT=".$rIDT."&rKib=".$rKib."&IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Simpan">
  <table border="0" align="center" style="width:680px">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td valign="top" style="font-weight:bold; text-decoration:underline">DATA DETAIL</td>
      <td>&nbsp;</td>
      <td colspan="2">
		<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse">
			<tr height="20">
				<td width="96">REFERENSI</td>
				<td width="16">:</td>
				<td width="126" style="font-weight:bold"><?=$gDAT[0]?></td>
				<td width="87">&nbsp;</td>
				<td width="12">&nbsp;</td>
				<td width="151">&nbsp;</td>
				<td width="149">&nbsp;</td>
			</tr>
			<tr height="20">
				<td width="96">REF. GROUP </td>
				<td width="16">:</td>
				<td width="126"><? if ($gDAT[1]=="") {echo "-";} else {echo "<b>".$gDAT[1]."</b>";}?></td>
				<td width="87">&nbsp;</td>
				<td width="12">&nbsp;</td>
				<td width="151">&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr height="20">
				<td width="96">KODE ASET </td>
				<td width="16">:</td>
				<td width="126"><?=$gDAT[2]?></td>
				<td width="87">NO.REGISTER</td>
				<td width="12">:</td>
				<td width="151"><?=$gDAT[3]?></td>
				<td>&nbsp;</td>
			</tr>
			<tr height="20">
				<td width="96">NAMA ASET</td>
				<td width="16">:</td>
				<td colspan="5"><?=$gNma?></td>
			</tr>
		</table>	  </td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td style="font-weight:bold; text-decoration:underline">PINDAHKAN KE</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr> 
      <td width="37">&nbsp;</td>
      <td width="86">BIDANG</td>
      <td width="16">&nbsp;</td>
      <td colspan="2">
	  <select class="boxs" name="fBid" tabindex="0" style="width:415px" onchange="this.form.submit()">
        <?
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gBid=="") {$gBid=$mRo['Kd_Aset'];}
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
      <td width="37">&nbsp;</td>
      <td width="86">KELOMPOK</td>
      <td width="16">&nbsp;</td>
      <td colspan="2">
	  <select class="boxs" name="fKel" tabindex="0" style="width:415px" onchange="this.form.submit()">
        <?
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '".$zBid."%' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gKel=="") {$gKel=$mRo['Kd_Aset'];}
			if (substr($gKel,0,5)!=$gBid) {$gKel=$mRo['Kd_Aset'];}
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
      <td width="37">&nbsp;</td>
      <td width="86">JENIS</td>
      <td width="16">&nbsp;</td>
      <td colspan="2">
	  <select class="boxs" name="fObj" tabindex="0" style="width: 415px" onchange="this.form.submit()">
        <?
		#$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset3 WHERE Kd_Aset LIKE '".$gBid.".__' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '".$zKel.".__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gObj=="") {$gObj=$mRo['Kd_Aset'];}
			if (substr($gObj,0,8)!=$gKel) {$gObj=$mRo['Kd_Aset'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gObj) 
				{
				$sel ="selected";
				$zObj=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select></td>
    </tr>
    <tr> 
      <td width="37">&nbsp;</td>
      <td width="86">R. OBJEK</td>
      <td width="16">&nbsp;</td>
      <td colspan="2">
	  <select class="boxs" name="fRin" tabindex="0" style="width: 415px" onchange="this.form.submit()">
        <?
		#$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset4 WHERE Kd_Aset LIKE '".$gBid.".".substr($gKel,6,2).".__' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '".$zObj.".__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gRin=="") {$gRin=$mRo['Kd_Aset'];}
			if (substr($gRin,0,11)!=$gObj) {$gRin=$mRo['Kd_Aset'];}
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
      <td>SUB R.OBJEK </td>
      <td valign="middle">&nbsp;</td>
      <td width="354" valign="middle">
	  <select class="boxs" name="fSub" tabindex="0" style="width: 360px" onchange="this.form.submit()">
        <?
		#$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset5 WHERE Kd_Aset LIKE '".$gBid.".".substr($gKel,6,2).".".substr($gOBJ,9,2).".___' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_7 WHERE Kd_Aset LIKE '".$zRin.".%' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
            if ($gSub=="") {$gSub=$mRo['Kd_Aset'];}
			if (substr($gSub,0,14)!=$gRin) {$gSub=$mRo['Kd_Aset'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gSub) 
				{
				$sel ="selected";
				$zSub=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select></td>
      <td width="165" valign="middle"><input type="button" name="B392" value="FIND" onclick="OpenAccNumb('600','500','<?=$XrT?>','<?=$rKib?>','<?=$rIDT?>','<?=$_GET['IdL']?>')" style="width: 50px; height: 22px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="middle">&nbsp;</td>
      <td colspan="2" valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="middle">&nbsp;</td>
      <td colspan="2" valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="middle">&nbsp;</td>
      <td colspan="2" valign="middle">
	  <input type="button" name="B36" value="PINDAHKAN" onclick="P_Move()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B362" value="TUTUP" onclick="P_Close()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />      </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="middle">&nbsp;</td>
      <td colspan="2" valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="middle">&nbsp;</td>
      <td colspan="2" valign="middle">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;

	function P_Move()
	{
		var AN = confirm("Proses pemindahan rekening aset..?!!");
		if (AN)
		{
			objfrm.Simpan.value = "Move";
			objfrm.submit();
		}
	}
	
	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
	}

	function OpenAccNumb(w,h,XrT,rKib,rIDT,IdL)
	{
		var win=null;
		var txtHTML = "";
  		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100;
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = 'Find_Acc_Top.php?CrAcc=Move_Account_Mid_'+XrT+'&rIDT='+rIDT+'&rKib='+rKib+'&IdL='+IdL;
			URL_Mid = 'Find_Acc_Mid.php?CrAcc=Move_Account_Mid_'+XrT+'&rIDT='+rIDT+'&rKib='+rKib+'&IdL='+IdL;
			URL_Bot = 'Find_Acc_Bot.php';
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFindAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFindAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
</script>

<?php require('Connection_Close.php');?>
