<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_new.css" type="text/css" media="all" />
</head>
<?php
$eIdT = $_GET['eIdT'];
$IdL  = $_GET['IdL'];
$Adm  = fFindUID($IdL,"Admin");
$Lev  = fFindUID($IdL,"Level");
$ReO  = fFindUID($IdL,"Readonly");
if ($Lev=="")  {$diB="disabled";} else {$diB="";}

$fGbg= "";
$nSQL= "SELECT * FROM ta_user WHERE IDT='".$eIdT."'";
$nRs = mysql_query($nSQL) or die(mysql_error());
$mRo = mysql_fetch_assoc($nRs);
$tRo = mysql_num_rows($nRs);
if ($tRo > 0)
{
	$gAct = $mRo['Active'];
	$gRed = $mRo['Readonly'];
	$Levl = $mRo['Level'];
	$Admi = $mRo['Admin'];
	$fGbg = $Levl.$Admi;
	$gUid = $mRo['User_ID'];
	$gNmA = $mRo['Full_Name'];
	$gUnt = substr($mRo['Kode'],0,11)." : ".fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo['Kode'],0,11),"=","","");
	$gSub = substr($mRo['Kode'],0,14)." : ".fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",substr($mRo['Kode'],0,14),"=","","");
	$gUpb = $mRo['Kode']." : ".fGlobal("Nm_Upb","ref_upb","Kd_Upb",$mRo['Kode'],"=","","");
	$gCetak_Barcode = $mRo['Cetak_Barcode'];
	$gUsrSKLH = $mRo['User_Sekolah'];
}
else
{
	$gAct ="";
	$gRed ="";
	$fGbg = 40;
	$gUid = "";
	$gNmA = "";
	$gUnt = "";
	$gSub = "";
	$gUpb = "";
	$gCetak_Barcode = "";
	$gUsrSKLH = "";
}

if ($gAct=="Y") {$gAc="checked";} else {$gAc="";}
if ($gRed=="Y") {$gRe="checked";} else {$gRe="";}
if ($gCetak_Barcode=="Y") {$gCet="checked";} else {$gCet="";}
if ($gUsrSKLH=="Y") {$gSen="checked";} else {$gSen="";}


if ($fGbg==11)
{
	$Chk_11="checked";
	$Chk_10="";
	$Chk_21="";
	$Chk_20="";
	$Chk_31="";
	$Chk_30="";
	$Chk_41="";
	$Chk_40="";
}
elseif ($fGbg==10)
{
	$Chk_11="";
	$Chk_10="checked";
	$Chk_21="";
	$Chk_20="";
	$Chk_31="";
	$Chk_30="";
	$Chk_41="";
	$Chk_40="";
}
elseif ($fGbg==21)
{
	$Chk_11="";
	$Chk_10="";
	$Chk_21="checked";
	$Chk_20="";
	$Chk_31="";
	$Chk_30="";
	$Chk_41="";
	$Chk_40="";
}
elseif ($fGbg==20)
{
	$Chk_11="";
	$Chk_10="";
	$Chk_21="";
	$Chk_20="checked";
	$Chk_31="";
	$Chk_30="";
	$Chk_41="";
	$Chk_40="";
}
elseif ($fGbg==31)
{
	$Chk_11="";
	$Chk_10="";
	$Chk_21="";
	$Chk_20="";
	$Chk_31="checked";
	$Chk_30="";
	$Chk_41="";
	$Chk_40="";
}
elseif ($fGbg==30)
{
	$Chk_11="";
	$Chk_10="";
	$Chk_21="";
	$Chk_20="";
	$Chk_31="";
	$Chk_30="checked";
	$Chk_41="";
	$Chk_40="";
}
elseif ($fGbg==41)
{
	$Chk_11="";
	$Chk_10="";
	$Chk_21="";
	$Chk_20="";
	$Chk_31="";
	$Chk_30="";
	$Chk_41="checked";
	$Chk_40="";
}
else
{
	$Chk_11="";
	$Chk_10="";
	$Chk_21="";
	$Chk_20="";
	$Chk_31="";
	$Chk_30="";
	$Chk_41="";
	$Chk_40="checked";
}


$URLA = "Reg_User_Bot.php?IdL=".$IdL."&eIdT=".$eIdT;
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Reg_User_Mid_.php?eIdT=".$eIdT."&IdL=".$IdL?>">
<input type="hidden" name="fSimpan">
<table border="0" width="677" cellspacing="3" cellpadding="0" style="font-family:Calibri; font-size:9pt">
	<tr>
		<td width="83">User ID </td>
		<td width="13">:</td>
		<td colspan="3"><input readonly name="fUid" type="text" value="<?php echo $gUid?>" size="40"/></td>
		<td width="34">&nbsp;</td>
	</tr>
	<tr>
		<td width="83">Nama Lengkap </td>
		<td width="13">:</td>
		<td colspan="3"><input readonly name="fNmA" type="text" value="<?php echo $gNmA?>" size="40"/></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td width="83">Unit Kerja </td>
		<td width="13">:</td>
		<td colspan="3"><input readonly name="fUnt" type="text" value="<?php echo $gUnt?>" size="60"/></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td width="83">Sub Unit </td>
		<td width="13">:</td>
		<td colspan="3"><input readonly name="fSub" type="text" value="<?php echo $gSub?>" size="60"/></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
	  <td>UPB</td>
	  <td>:</td>
	  <td colspan="3"><input readonly name="fUpb" type="text" value="<?php echo $gUpb?>" size="60"/></td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="3">&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>Aktivasi User </td>
	  <td>:</td>
	  <td colspan="3"><label><input type="checkbox" name="fAct" value="ON" <?php echo $gAc?> />&nbsp;&nbsp;AKTIF</label></td>
	  <td>&nbsp;</td>
    </tr>
	
	<tr>
	  <td>Akses Data </td>
	  <td>&nbsp;</td>
	  <td colspan="3"><label><input type="checkbox" name="fRed" value="ON" <?php echo $gRe?> />&nbsp;&nbsp;READONLY</label></td>
	  <td>&nbsp;</td>
    </tr>
	<?php if ($Lev<=2){?>
	<tr>
	  <td>Cetak Bar Kode </td>
	  <td>&nbsp;</td>
	  <td width="184"><label><input type="checkbox" name="fCet" value="ON" <?php echo $gCet?> />&nbsp;&nbsp;AKTIF BAR KODE</label></td>
	  <td width="252"><label><input type="checkbox" name="fSen" value="ON" <?php echo $gSen?> />&nbsp;&nbsp;USER SEKOLAH</label></td>
	  <td width="90"> </td>
	  <td>&nbsp;</td>
    </tr>
	<?php } ?>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="3">&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="3">
		<table border="0" width="345" cellspacing="0">
			
			<tr height="20">
			  <td bgcolor="#CC0000" style="font-weight: bold; color: #FFFFFF; border-left: 1px solid #808000; border-top: 1px solid #808000; border-bottom: 1px solid #808000">&nbsp;JENIS USER </td>
			  <td colspan="2" bgcolor="#CC0000" style="font-weight: bold; color: #FFFFFF;  border-right: 1px solid #808000; border-top: 1px solid #808000; border-bottom: 1px solid #808000">HAK AKSES / LEVEL </td>
		    </tr>
		  	<?php if ($Lev <= 1 && $Lev!="") { ?>
			<tr height="22">
			  <td width="149" style="border-left: 1px solid #808000">&nbsp;ADMINISTRATOR</td>
			  <td width="105"><label><input name="RB_AR" type="radio" <?php echo $Chk_11?> value="11" />&nbsp;&nbsp;Admin</label></td>
			  <td width="85" style="border-right: 1px solid #808000"><label><input name="RB_AR" type="radio" <?php echo $Chk_10?> value="10" disabled />&nbsp;&nbsp;Reguler</label></td>
			</tr>
			<?php } ?>
		  	<?php if ($Lev <= 2 && $Lev!="") { ?>
			<tr height="22">
			  <td style="border-left: 1px solid #808000">&nbsp;UNIT/ SKPD </td>
			  <td><label><input name="RB_AR" type="radio" <?php echo $Chk_21?> value="21" />&nbsp;&nbsp;Admin</label></td>
			  <td style="border-right: 1px solid #808000"><label><input name="RB_AR" type="radio" <?php echo $Chk_20?> value="20" />&nbsp;&nbsp;Reguler</label></td>
		  	</tr>
			<?php } ?>
		  	<?php if ($Lev <= 3 && $Lev!="") { ?>
		  	<tr height="22">
			  <td style="border-left: 1px solid #808000">&nbsp;SUB UNIT </td>
			  <td><label><input name="RB_AR" type="radio" <?php echo $Chk_31?> value="31" />&nbsp;&nbsp;Admin</label></td>
			  <td style="border-right: 1px solid #808000"><label><input name="RB_AR" type="radio" <?php echo $Chk_30?> value="30" />&nbsp;&nbsp;Reguler</label></td>
		  	</tr>
			<?php } ?>
		  	<?php if ($Lev <= 4 && $Lev!="") { ?>
		  	<tr height="22">
			  <td style="border-left: 1px solid #808000; border-bottom: 1px solid #808000">&nbsp;UPB </td>
			  <td style="border-bottom: 1px solid #808000"><?php if ($Adm=='1'){?><label><input name="RB_AR" type="radio" <?php echo $Chk_41?> value="41" />&nbsp;&nbsp;Admin</label><?php } ?></td>
			  <td style="border-bottom: 1px solid #808000; border-right: 1px solid #808000"><label><input name="RB_AR" type="radio" <?php echo $Chk_40?> value="40" />&nbsp;&nbsp;Reguler</label></td>
		  	</tr>
			<?php } ?>
			<?php if ($Lev=="") { ?>
		  	<tr height="22">
		  	  <td style="border-left: 1px solid #808000; border-bottom: 1px solid #808000">Ilegal Operation...!! </td>
		  	  <td style="border-bottom: 1px solid #808000">&nbsp;</td>
		  	  <td style="border-bottom: 1px solid #808000; border-right: 1px solid #808000">&nbsp;</td>
	  	  </tr>
			<?php } ?>
		</table>	  </td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="3" style="color:#FF0000"><?php if (isset($_REQUEST['MsG'])) {echo $_REQUEST['MsG'];}?></td>
	  <td>&nbsp;</td>
    </tr>
	<?php if ($Lev!="") {?>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="3"><input <?php echo $diB?> type="button" name="B39" value="SIMPAN" style="width:80px" onclick="P_Save('<?=$ReO?>')"/>&nbsp;&nbsp;
	  <input <?php echo $diB?> type="hidden" name="B392" value="RESET" style="width:80px" onclick="P_Reset('<?=$ReO?>')"/></td>
	  <td>&nbsp;</td>
    </tr>
	<?php } ?>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td colspan="3">&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
</table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Save(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		//var AN = confirm("Simpan data..?!!");
		//if (AN)
		//{
			objfrm.fSimpan.value = "Save";
			objfrm.submit();
		//}
	}
	function P_Reset(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		//var AN = confirm("Reset data..?!!");
		//if (AN)
		//{
			objfrm.fSimpan.value = "Reset";
			objfrm.submit();
		//}
	}
</script>

<script language="JavaScript">	
	window.open("<?php echo $URLA ?>","WinFormUser_Bot");
</script>

<?php require('Connection_Close.php');?>
