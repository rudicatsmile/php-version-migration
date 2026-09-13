<?php
require "Connection.php";
require "CheckLogin.php";
require "FileFunction.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_top.css" type="text/css" media="all" />
</head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
</head>
<?php
if (isset($_POST['fUnt'])) {$gUnt = $_POST['fUnt'];} else {$gUnt = $_GET['gUnt'];}
if (isset($_POST['fSub'])) {$gSub = $_POST['fSub'];} else {$gSub = $_GET['gSub'];}
if (isset($_POST['fUpb'])) {$gUpb = $_POST['fUpb'];} else {$gUpb = $_GET['gUpb'];}

if (isset($_POST['fKlS'])) {$gKlS = $_POST['fKlS'];} else {$gKlS = $_GET['gKlS'];}
if (isset($_POST['fKeL'])) {$gKeL = $_POST['fKeL'];} else {$gKeL = $_GET['gKeL'];}
if (isset($_POST['fJeN'])) {$gJeN = $_POST['fJeN'];} else {$gJeN = $_GET['gJeN'];}
if (isset($_POST['fObJ'])) {$gObJ = $_POST['fObJ'];} else {$gObJ = $_GET['gObJ'];}
if (isset($_POST['fRiN'])) {$gRiN = $_POST['fRiN'];} else {$gRiN = $_GET['gRiN'];}

if ($_POST['Simpan']=="Reset")
{
	$dID = $_POST['CrtDell'];
	$dRF = fGlobalNEW("Referensi","ta_kib_f_to_aset","IDT",$dID,"=","",DatabaseSB,$ConSB,"");
	
	$SQ = "DELETE FROM ta_kib_f_to_aset WHERE IDT='$dID'";
	$rst = mysql_query($SQ) or die(mysql_error());
	
	$SQ = "DELETE FROM ta_kib_f_to_aset_rinci WHERE Referensi='$dRF'";
	$rst = mysql_query($SQ) or die(mysql_error());
	?>
	<script language="javascript">
		P_NextX('','<?=$_GET['IdL']?>');
		function P_NextX(IDT,IdL)
		{
			window.open("Form_Asset_F_KdpToKib_Mid.php?IDT="+IDT+"&IdL="+IdL,"WinFormKDP_Mid");
		}
	</script>
	<?php
}
if ($_POST['Simpan']=="Save")
{
	$gTH= fGetDate('year');
	$CK = fGlobalNEW("max(Referensi)","ta_kib_f_to_aset","Referensi",$gUpb.".".$gTH."%","LIKE","",DatabaseSB,$ConSB,"");
	if ($CK) {
		$CK = (int)substr($CK,-5,5)+1;
		$gRF= $gUpb.".".$gTH.".".substr("00000".$CK,-5,5);
	}
	else {
		$gRF= $gUpb.".".$gTH.".00001";
	}
	
	$SQ = "INSERT INTO ta_kib_f_to_aset SET 
	Referensi='$gRF',
	Kd_UPB='$gUpb',
	Kd_Aset='$gRiN',
	Pencatat='$UID',
	Recorded=now()";
	$rst = mysql_query($SQ) or die(mysql_error());
	
	$IDT = fGlobalNEW("max(IDT)","ta_kib_f_to_aset","Referensi",$gUpb.".".$gTH."%","LIKE","",DatabaseSB,$ConSB,"");
	
	$UPB = fGlobalNEW("Kd_UPB","ta_kib_f_to_aset","IDT",$IDT,"=","",DatabaseSB,$ConSB,"");
	$AST = fGlobalNEW("Kd_Aset","ta_kib_f_to_aset","IDT",$IDT,"=","",DatabaseSB,$ConSB,"");
	?>
	<script language="javascript">
		P_NextX('<?=$IDT?>','<?=$_GET['IdL']?>');
		function P_NextX(IDT,IdL)
		{
			window.open("Form_Asset_F_KdpToKib_Mid.php?IDT="+IDT+"&IdL="+IdL,"WinFormKDP_Mid");
		}
	</script>
	<?php
}
?>
<body background="css/images/newheader.gif" topmargin="0" onload="javascript:myfrm.fFind.focus()">
<form name="myfrm" method="post" action="<?php echo "Form_Asset_F_KdpToKib_Top.php?IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CrtDell">
  <table width="930" border="0" align="center">
    <tr> 
      <td valign="middle">
	  <table border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; color:#CCCCCC; font-weight:bold; font-family:calibri; font-size:9pt">
          <tr height="23">
            <td width="67" align="right">UNIT</td>
            <td width="19">&nbsp;</td>
            <td colspan="2">
			<?php if ($IDT) {?>
				<input name="fUnt" type="text" readonly value="<?=substr($UPB,0,11)?>" style="width:110px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
				<input name="dUnt" type="text" readonly value="<?=strtoupper(fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",substr($UPB,0,11),"=","",DatabaseSB,$ConSB,""))?>" style="width:548px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
			<?php } else {?>
				<select name="fUnt" style="width:680px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
				<?php
				$zUnt = "";
				$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
				$nRs = mysql_query($nSQ) or die(mysql_error());
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$sel = "";
					if ($gUnt == "") {$gUnt = $mRo[0];}
					if ($mRo[0]==$gUnt) 
					{
						$sel = "selected";
						$zUnt = $mRo[0];
					}
					echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
				}
				?>
				</select>
			<?php } ?>
			</td>
          </tr>
          <tr height="23">
            <td align="right">SUB UNIT</td>
            <td>&nbsp;</td>
            <td colspan="2">
			<?php if ($IDT) {?>
				<input name="fSub" type="text" readonly value="<?=substr($UPB,0,14)?>" style="width:110px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
				<input name="dSub" type="text" readonly value="<?=strtoupper(fGlobalNEW("Nm_Sub","ref_sub_unit","Kd_Sub",substr($UPB,0,14),"=","",DatabaseSB,$ConSB,""))?>" style="width:548px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
			<?php } else {?>
				<select name="fSub" style="width:680px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
				<?php
				$zSub = "";
				//CallConnection(DatabaseSA,$ConSA);
				$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$zUnt.".__' ORDER BY Kd_Sub";
				$nRs = mysql_query($nSQ) or die(mysql_error());
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$sel = "";
					if ($gSub=="") {$gSub=$mRo[0];}
					if (substr($gSub,0,11)!=$gUnt) {$gSub=$mRo[0];}
					if ($mRo[0]==$gSub) 
					{
						$sel = "selected";
						$zSub = $mRo[0];
					}
					echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
				}
				?>
				</select>
			<?php } ?>
			</td>
          </tr>
          
          <tr height="23">
            <td align="right">UPB</td>
            <td>&nbsp;</td>
            <td colspan="2">
			<?php if ($IDT) {?>
				<input name="fUpb" type="text" readonly value="<?=$UPB?>" style="width:110px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
				<input name="dUpb" type="text" readonly value="<?=strtoupper(fGlobalNEW("Nm_UPb","ref_upb","Kd_UPb",$UPB,"=","",DatabaseSB,$ConSB,""))?>" style="width:548px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
			<?php } else {?>
				<select name="fUpb" style="width:680px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px">
				<?php
				$zUpb = "";
				$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$zUnt.".".substr($zSub,12,2).".___' ORDER BY Kd_Upb";
				$nRs = mysql_query($nSQ) or die(mysql_error());
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$sel = "";
					if ($gUpb=="" || $gUpb=="All") {$gUpb=$mRo[0];}
					if (substr($gUpb,0,14)!=$gSub) {$gUpb=$mRo[0];}
					if ($mRo[0]==$gUpb) 
					{
						$sel ="selected";
						$zUpb = $mRo[0];
					}
					echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
				}
				?>
				</select>
			<?php } ?>
			</td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td>&nbsp;</td>
            <td width="558">&nbsp;</td>
            <td width="280">&nbsp;</td>
          </tr>
          <tr height="23">
            <td align="right">KLASIFIKASI</td>
            <td>&nbsp;</td>
            <td>
			<?php if ($IDT) {?>
				<input name="fKlS" type="text" readonly value="<?=substr($AST,0,2)?>" style="width:110px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
				<input name="dKlS" type="text" readonly value="<?=fGlobalNEW("Nm_Aset","ref_rek_aset1","Kd_Aset",substr($AST,0,2),"=","",DatabaseSB,$ConSB,"");?>" style="width:419px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
			<?php } else {?>
				<select name="fKlS" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
				<?php
				$zKlS = "";
				$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset1 WHERE Kd_Aset <> '01' AND Kd_Aset <> '02' AND Kd_Aset <> '05' AND Kd_Aset <> '06' AND Kd_Aset <> '07' ORDER BY Kd_Aset";
				$nRs = mysql_query($nSQ) or die(mysql_error());
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$sel = "";
					if ($gKlS=="") {$gKlS=$mRo[0];}
					if ($mRo[0]==$gKlS) 
					{
						$sel ="selected";
						$zKlS= $mRo[0];
					}
					echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo[1].'</option>';
				}
				?>
				</select>
			<?php } ?>
			</td>
            <td rowspan="5">
			<input type="button" name="B1" value="CANCEL" onclick="P_Reset('<?=$IDT?>')" style="width: 120px; height: 55px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /><br>
            <input type="button" name="B2" value="NEXT" onclick="P_Submit('<?=$IDT?>')" style="width: 120px; height: 55px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
          </tr>
          <tr height="23">
            <td align="right">KELOMPOK</td>
            <td>&nbsp;</td>
            <td>
			<?php if ($IDT) {?>
				<input name="fKeL" type="text" readonly value="<?=substr($AST,0,5)?>" style="width:110px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
				<input name="dKeL" type="text" readonly value="<?=fGlobalNEW("Nm_Aset","ref_rek_aset2","Kd_Aset",substr($AST,0,5),"=","",DatabaseSB,$ConSB,"");?>" style="width:419px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
			<?php } else {?>
				<select name="fKeL" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
				<?php
				$zKeL = "";
				$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset2 WHERE Kd_Aset LIKE '".$zKlS.".%' ORDER BY Kd_Aset";
				$nRs = mysql_query($nSQ) or die(mysql_error());
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$sel = "";
					if ($gKeL=="") {$gKeL=$mRo[0];}
					if (substr($gKeL,0,2)!=$gKlS) {$gKeL=$mRo[0];}
					if ($mRo[0]==$gKeL) 
					{
						$sel ="selected";
						$zKeL= $mRo[0];
					}
					echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo[1].'</option>';
				}
				?>
				</select>
			<?php } ?>
			</td>
          </tr>
          <tr height="23">
            <td align="right">JENIS</td>
            <td>&nbsp;</td>
            <td>
			<?php if ($IDT) {?>
				<input name="fJeN" type="text" readonly value="<?=substr($AST,0,8)?>" style="width:110px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
				<input name="dJeN" type="text" readonly value="<?=fGlobalNEW("Nm_Aset","ref_rek_aset3","Kd_Aset",substr($AST,0,8),"=","",DatabaseSB,$ConSB,"");?>" style="width:419px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
			<?php } else {?>
				<select name="fJeN" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
				<?php
				$zJeN = "";
				$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset3 WHERE Kd_Aset LIKE '".$zKeL.".%' ORDER BY Kd_Aset";
				$nRs = mysql_query($nSQ) or die(mysql_error());
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$sel = "";
					if ($gJeN=="") {$gJeN=$mRo[0];}
					if (substr($gJeN,0,5)!=$gKeL) {$gJeN=$mRo[0];}
					if ($mRo[0]==$gJeN) 
					{
						$sel ="selected";
						$zJeN = $mRo[0];
					}
					echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo[1].'</option>';
				}
				?>
				</select>
			<?php } ?>
			</td>
          </tr>
          <tr height="23">
            <td align="right">OBJEK</td>
            <td>&nbsp;</td>
            <td>
			<?php if ($IDT) {?>
				<input name="fObJ" type="text" readonly value="<?=substr($AST,0,11)?>" style="width:110px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
				<input name="dObJ" type="text" readonly value="<?=fGlobalNEW("Nm_Aset","ref_rek_aset4","Kd_Aset",substr($AST,0,11),"=","",DatabaseSB,$ConSB,"");?>" style="width:419px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
			<?php } else {?>
				<select name="fObJ" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
				<?php
				$zObJ= "";
				$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset4 WHERE Kd_Aset LIKE '".$zJeN.".%' ORDER BY Kd_Aset";
				$nRs = mysql_query($nSQ) or die(mysql_error());
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$sel = "";
					if ($gObJ=="") {$gObJ=$mRo[0];}
					if (substr($gObJ,0,8)!=$gJeN) {$gObJ=$mRo[0];}
					if ($mRo[0]==$gObJ) 
					{
						$sel ="selected";
						$zObJ = $mRo[0];
					}
					echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo[1].'</option>';
				}
				?>
				</select>
			<?php } ?>
			</td>
          </tr>
          <tr height="23">
            <td align="right">RINCIAN</td>
            <td>&nbsp;</td>
            <td>
			<?php if ($IDT) {?>
				<input name="fRiN" type="text" readonly value="<?=$AST?>" style="width:110px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
				<input name="dRiN" type="text" readonly value="<?=fGlobalNEW("Nm_Aset","ref_rek_aset5","Kd_Aset",$AST,"=","",DatabaseSB,$ConSB,"");?>" style="width:419px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
			<?php } else {?>
				<select name="fRiN" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px">
				<?php
				$zRiN= "";
				$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset5 WHERE Kd_Aset LIKE '".$zObJ.".%' ORDER BY Kd_Aset";
				$nRs = mysql_query($nSQ) or die(mysql_error());
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$sel = "";
					if ($gRiN=="") {$gRiN=$mRo[0];}
					if (substr($gRiN,0,11)!=$gObJ) {$gRiN=$mRo[0];}
					if ($mRo[0]==$gRiN) 
					{
						$sel ="selected";
						$zRiN= $mRo[0];
					}
					echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo[1].'</option>';
				}
				?>
				</select>
			<?php } ?>
			</td>
          </tr>
        </table>
	  </td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" style="font-size:12px; font-family:calibri; border-collapse: collapse; color:#000; background:#999999; font-weight:bold">
    <tr>
	  <td width="30">NO.</td>
	  <td width="119">REF. KDP</td>
	  <td width="143" style="text-align:right; padding-right:15px">NILAI</td>
	  <td>KETERANGAN</td>
	</tr>
	</table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Reset(idt)
	{
		var AN = confirm("Proses akan meremove data temporary, lanjutkan pembatalan..?!!");
		{
			objfrm.CrtDell.value = idt;
			objfrm.Simpan.value = "Reset";
			objfrm.submit();
		}
	}
	function P_Submit(idt)
	{
		if (idt) {alert('Silahkan lanjutkan dengan menambahkan item KDP,\natau Click CANCEL untuk mengulangi proses..!!'); return false;}
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}
</script>