<?php
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
extract($_POST);
extract($_GET);
$rKib  = $rKib;
$rIDT  = $rIDT;

$gSub   = $gSub;
$gUpb   = $gUpb;

if ($rIDT!="")
{
	$gDAT = fGlobal("Referensi:Ref_Group:Kd_UPB:No_Register","ta_kib_108","IDT",$rIDT,"=","","");
	$gDAT = explode(':',$gDAT);
	
	$gNma = fGlobal("nm_upb","ref_upb","kd_upb",$gDAT[2],"=","","");
	$gUnt = substr($gDAT[2],0,11);
	$dUnt = fGlobal("nm_unit","ref_unit","kd_unit",$gUnt,"=","","");
	if ($gSub==""){$gSub=substr($gDAT[2],0,14);}
	if ($gUpb==""){$gUpb=$gDAT[2];}
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

if ($CrT=="A") {$CrT="01";}
if ($CrT=="B") {$CrT="02";}
if ($CrT=="C") {$CrT="03";}
if ($CrT=="D") {$CrT="04";}
if ($CrT=="E") {$CrT="05";}
if ($CrT=="F") {$CrT="06";}
if ($CrT=="G") {$CrT="07";}
?>

<body>
<form name="myfrm" method="post" action="<?php echo "Move_Upb_Kib_Mid_.php?rIDT=".$rIDT."&rKib=".$rKib."&IdL=".$_GET['IdL']?>">
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
				<td width="126"><b>
				  <?=$gDAT[0]?>
				</b></td>
				<td width="87">&nbsp;</td>
				<td width="12">&nbsp;</td>
				<td width="151">&nbsp;</td>
				<td width="149">&nbsp;</td>
			</tr>
			<tr height="20">
				<td width="96">REF. GROUP </td>
				<td width="16">:</td>
				<td width="126"><?php if ($gDAT[1]=="") {echo "-";} else {echo "<b>".$gDAT[1]."</b>";}?></td>
				<td width="87">&nbsp;</td>
				<td width="12">&nbsp;</td>
				<td width="151">&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr height="20">
				<td width="96">KODE UPB </td>
				<td width="16">:</td>
				<td width="126"><?=$gDAT[2]?></td>
				<td width="87">NO.REGISTER</td>
				<td width="12">:</td>
				<td width="151"><?=$gDAT[3]?></td>
				<td>&nbsp;</td>
			</tr>
			<tr height="20">
				<td width="96">NAMA UPB </td>
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
    <tr height="25">
      <td>&nbsp;</td>
      <td>UNIT KERJA </td>
      <td>&nbsp;</td>
      <td colspan="2">
	  <input name="fUnt" type="text" value="<?=$gUnt?>" readonly style="width:70px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="dUnt" type="text" value="<?=$dUnt?>" readonly style="width:301px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px" />
	  </td>
    </tr>
    <tr height="25">
      <td width="37">&nbsp;</td>
      <td width="86">SUB UNIT</td>
      <td width="16">&nbsp;</td>
      <td colspan="2">
	  <select class="boxs" name="fSub" tabindex="0" style="width:390px" onchange="this.form.submit()">
        <?php
		$mSQ = "SELECT kd_sub, nm_sub FROM ref_sub_unit WHERE kd_sub LIKE '".$gUnt.".__' ORDER BY kd_sub";
		$mRs = mysql_query($mSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($mRs, MYSQL_BOTH))
		{
			if ($gSub=="") {$gSub=$mRo[0];}
			if (substr($gSub,-2,2)=="00"){$gSub=$mRo[0];}
			$sel ="";
			if ($mRo[0]==$gSub) 
			{
			$sel ="selected";
			$zSub=$mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper($mRo[1]).'</option>';
		}
	  ?>
      </select></td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td>UPB</td>
      <td valign="middle">&nbsp;</td>
      <td width="354" valign="middle">
	  <select class="boxs" name="fUpb" tabindex="0" style="width:390px">
        <?php
		$mSQ = "SELECT kd_upb, nm_upb FROM ref_upb WHERE kd_upb LIKE '".$zSub."%' ORDER BY kd_upb";
		$mRs = mysql_query($mSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($mRs, MYSQL_BOTH))
		{
            if ($gUpb=="") {$gUpb=$mRo[0];}
			if (substr($gUpb,0,14)!=$gSub) {$gUpb=$mRo[0];}
			
			$sel ="";
			if ($mRo[0]==$gUpb) 
			{
				$sel ="selected";
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper($mRo[1]).'</option>';
		}
	  ?>
      </select></td>
      <td width="165" valign="middle">&nbsp;</td>
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
	  <input type="button" name="B36" value="PINDAHKAN" onclick="P_Move()" style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
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
		var AN = confirm("Lanjutkan proses..?!!");
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
</script>
