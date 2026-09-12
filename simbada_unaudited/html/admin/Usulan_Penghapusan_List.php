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
if (isset($_REQUEST['gUnt'])) {$gUnt  = $_REQUEST['gUnt'];} else {$gUnt  ="";}
if (isset($_REQUEST['gSub'])) {$gSub  = $_REQUEST['gSub'];} else {$gSub  ="";}
if (isset($_REQUEST['gUpb'])) {$gUpb  = $_REQUEST['gUpb'];} else {$gUpb  ="";}

if (isset($_REQUEST['rIDT'])) {$rIDT  = $_REQUEST['rIDT'];} else {$rIDT  ="";}

if ($rIDT=="")
{
	$gHri  = fGetDate('mday');
	$gBln  = fGetDate('mon');
	$gThn  = fGetDate('year');
}
else
{
	$nSQ = "SELECT * FROM ta_penghapusan_usulan WHERE IDT='".$rIDT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gHri  = (int)substr($mRo['Tanggal'],8,10);
		$gBln  = (int)substr($mRo['Tanggal'],5,-3);
		$gThn  = (int)substr($mRo['Tanggal'],0,-6);
		$gRef  = $mRo['Referensi'];
		$gNom  = $mRo['Nomor'];
		$gKet  = $mRo['Keterangan'];
	}
}
?>

<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?php echo "Usulan_Penghapusan_List_.php?rIDT=".$rIDT."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL'] ?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
  <table border="0" align="center" width="900px">
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="669">&nbsp;</td>
    </tr>
    <tr> 
      <td width="81">UNIT</td>
      <td width="506"> 
        <select class="boxs" name="fUnt" tabindex="0" style="width: 470px" onchange="this.form.submit()">
        <?
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
				$zUnt=$mRo['Kd_Unit'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.$mRo['Kd_Unit']." : ".$mRo['Nm_Unit'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
      <td align="right">&nbsp;</td>
    </tr>
    <tr> 
      <td width="81">SUB UNIT</td>
      <td width="506"> 
        <select class="boxs" name="fSub" tabindex="0" style="width: 470px" onchange="this.form.submit()">
          <?
		if ($Lev <=3 ) {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".__' ORDER BY Kd_Sub";}
		else {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".".substr($SkP,12,2)."' ORDER BY Kd_Sub";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gSub=="") {$gSub=$mRo['Kd_Sub'];}
			if (substr($gSub,0,11)!=$gUnt) {$gSub=$mRo['Kd_Sub'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Sub']==$gSub) 
				{
				$sel ="selected";
				$zSub=$mRo['Kd_Sub'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Sub'].'">'.$mRo['Kd_Sub']." : ".$mRo['Nm_Sub'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
      <td><input type="button" name="B12" value="FORMULIR" onclick="P_Form()" style="width: 90px; height: 20px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td width="81">UPB</td>
      <td width="506"> 
        <select class="boxs" name="fUpb" tabindex="0" style="width: 470px" onchange="this.form.submit()">
          <?
		$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUpb=="") {$gUpb = $mRo['Kd_Upb'];}
			if (substr($gUpb,0,14)!=$gSub) {$gUpb = $mRo['Kd_Upb'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Upb']==$gUpb) 
				{
				$sel ="selected";
				$zUpb=$mRo['Kd_Upb'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Upb'].'">'.$mRo['Kd_Upb']." : ".$mRo['Nm_Upb'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
      <td><input type="button" name="B1" value="VIEW" onclick="P_Change()" style="width: 90px; height: 20px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	</table>
	
        <!-- Content -->
        <!-- Table -->
        <div class="table"> 
          
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <th width="33">No</th>
        <th width="135">Referensi</th>
        <th width="81">Tanggal</th>
        <th width="151">Nomor</th>
        <th width="243">Keterangan</th>
        <th width="102" class="ar">Nilai</th>
        <th width="113" class="ac">Status</th>
        <th width="168" class="ac">Actions</th>
      </tr>
      <?
	  	$iG = 1;
		$nSQL= "SELECT * FROM ta_penghapusan_usulan WHERE Kd_UPB='".$zUpb."' ORDER BY Tanggal";
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			$rIDT= $mRo['IDT'];
			$NiL = fGlobal("IfNull(sum(Nilai),0)","ta_penghapusan_usulan_rinc","Referensi",$mRo['Referensi'],"=","","");
			?>
			  <tr style="cursor: pointer" onmouseover="this.style.cursor=&#39;pointer&#39" <?=fBackCLR($iG)?>> 
				<td valign="top"><? echo $iG++?>.</td>
				<td valign="top"><? echo $mRo['Referensi']?></td>
				<td valign="top"><? echo fConvertDateShort($mRo['Tanggal'])?></td>
				<td valign="top"><? echo $mRo['Nomor'] ?></td>
				<td valign="top"><? echo $mRo['Keterangan']?></td>
				<td valign="top" class="ar"><? echo fConvertToRupiah($NiL)?></td>
				<td valign="top" class="ac"><? echo $mRo['Status']?></td>
				<td valign="top" align="center">
				<a href="#" class="ico docu" onclick="P_DOC('800','400','center','<?=$rIDT?>'); return false">&nbsp;DOKUMEN</a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="#" class="ico del" onclick="P_DeleteR('<?=$rIDT?>','<? echo $RegGrp?>','<?=$ReO?>'); return false">&nbsp;DELETE</a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo "Usulan_Penghapusan.php?rIDT=".$rIDT."&FrmG=".$_REQUEST['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_REQUEST['IdL'];?>" class="ico edit">&nbsp;EDIT</a></td>
			  </tr>
			  <?
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
		else
		{
		?>
      <tr> 
        <td></td>
        <td colspan="3">Data tidak ditemukan..!!</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <?
		}
		?>
      <tr>
        <td colspan="8">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="8">&nbsp;
		<a href="#" class="ico reff" onclick="P_Refresh()">&nbsp;&nbsp;REFRESH</a></td>
      </tr>
    </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Change()
	{
		objfrm.submit();
	}
	
	function P_DeleteR(xA,xB,xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		if (xB!="")
			{window.alert("Access denied...!");}
		else
		{
			var AN = confirm("Hapus Data Usulan..?!!");
			if (AN)
			{
			objfrm.CritIDT.value = xA;
			objfrm.Simpan.value = "DeleteRecord";
			objfrm.submit();
			}
		}
	}
	
	function P_Refresh()
	{
		
		window.open('<?php echo $_SERVER['PHP_SELF']."?rIDT=".$rIDT."&FrmG=".$_REQUEST['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_REQUEST['IdL'];?>','_self');
	}
	
	function P_Form()
	{
		
		window.open('<?php echo "Usulan_Penghapusan.php?FrmG=".$_REQUEST['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_REQUEST['IdL'];?>','_self');
	}
	
	function P_Comming()
	{
		window.alert('Under construction...!!');
	}
	
	function P_DOC(w,h,pos,IDT)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL="Usulan_Penghaspusan_Doc.php?rIDT="+IDT+"<?="&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&IdL=".$_REQUEST['IdL']?>";
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
</script>
<?php require "Connection_Close.php"?>

