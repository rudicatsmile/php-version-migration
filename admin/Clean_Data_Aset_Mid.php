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
<?php
if (isset($_GET['gUnt'])) {$gUnt  = $_GET['gUnt'];}
if (isset($_GET['gSub'])) {$gSub  = $_GET['gSub'];}
if (isset($_GET['gUpb'])) {$gUpb  = $_GET['gUpb'];}
?>

<body>
<form name="myfrm" method="post" action="<?php echo "Clean_Data_Aset_Mid_.php?IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Proses">
  <table width="1165" border="0" align="center">
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="10">&nbsp;</td>
    </tr>
    <tr> 
      <td width="26">&nbsp;</td>
      <td width="100">UNIT KERJA</td>
      <td colspan="10">
	  <select name="fUnt" tabindex="0" style="width: 400px" onchange="this.form.submit()">
		<?php
		$dG = 55;
		$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
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
				$NmA = $mRo['Nm_Unit'];
				if (strlen($NmA)>$dG){
					$NmA = substr($NmA,0,$dG).".....";
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.$mRo['Kd_Unit']." : ".$NmA.'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>SUB UNIT</td>
      <td colspan="10">
		<select class="boxs" name="fSub" tabindex="0" style="width: 400px" onchange="this.form.submit()">
		<option value="All">All</option>
		<?php
		$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".__' ORDER BY Kd_Sub";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gSub=="") {$gSub=$mRo['Kd_Sub'];}
			#if (substr($gSub,0,11)!=$gUnt) {$gSub=$mRo['Kd_Sub'];}
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
      <td>UPB</td>
      <td colspan="10"> <select class="boxs" name="fUpb" tabindex="0" style="width: 400px" onchange="this.form.submit()">
		<option value="All">All</option>
		<?php
		$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUpb=="") {$gUpb = $mRo['Kd_Upb'];}
			#if (substr($gUpb,0,14)!=$gSub) {$gUpb = $mRo['Kd_Upb'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Upb']==$gUpb) 
				{
				$sel ="selected";
				$gUpb=$mRo['Kd_Upb'];
				$gNma=$mRo['Nm_Upb'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Upb'].'">'.$mRo['Kd_Upb']." : ".$mRo['Nm_Upb'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td colspan="11"><hr /></td>
    </tr>
	<?php
	if ($gSub=="All"){
		$rUpb = $gUnt.".__.___";
	}
	else{
		if ($gUpb=="All"){
			$rUpb = $gSub.".___";
		}
		else{
			$rUpb = $gUpb;
		}
	}
	?>
    <tr> 
      <td>&nbsp;</td>
      <td>Ta KIB-A</td>
      <td width="60" class="ar" valign="middle"><?php echo fConvertToRupiahBulat(fGlobal("count(*)","ta_kib_a","Kd_UPB",$rUpb,"LIKE","",""))?>
      </td>
      <td width="20" valign="middle">&nbsp;</td>
      <td width="34" valign="middle"><i>record</i></td>
      <td width="34" valign="middle">&nbsp;</td>
      <td width="34" valign="middle">Posting</td>
      <td width="60" class="ar" valign="middle"> 
        <?php echo fConvertToRupiahBulat(fGlobal("count(*)","ta_kib_post","Kd_UPB:Referensi",$rUpb.":TNH.%","LIKE:LIKE","",""))?>
      </td>
      <td width="16" valign="middle">&nbsp;</td>
      <td width="70" valign="middle"><i>record</i></td>
      <td width="30" valign="middle"><input type="checkbox" name="KIB_A" value="ON" /> 
      </td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>Ta KIB-B</td>
      <td class="ar" valign="middle"> 
        <?php echo fConvertToRupiahBulat(fGlobal("count(*)","ta_kib_b","Kd_UPB",$rUpb,"LIKE","",""))?>
      </td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle"><i>record</i></td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle">Posting</td>
      <td class="ar" valign="middle"> 
        <?php echo fConvertToRupiahBulat(fGlobal("count(*)","ta_kib_post","Kd_UPB:Referensi",$rUpb.":ALT.%","LIKE:LIKE","",""))?>
      </td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle"><i>record</i></td>
      <td valign="middle"><input type="checkbox" name="KIB_B" value="ON" /> </td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>Ta KIB-C</td>
      <td class="ar" valign="middle"> 
        <?php echo fConvertToRupiahBulat(fGlobal("count(*)","ta_kib_c","Kd_UPB",$rUpb,"LIKE","",""))?>
      </td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle"><i>record</i></td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle">Posting</td>
      <td class="ar" valign="middle"> 
        <?php echo fConvertToRupiahBulat(fGlobal("count(*)","ta_kib_post","Kd_UPB:Referensi",$rUpb.":BNG.%","LIKE:LIKE","",""))?>
      </td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle"><i>record</i></td>
      <td valign="middle"><input type="checkbox" name="KIB_C" value="ON" /> </td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>Ta KIB-D</td>
      <td class="ar" valign="middle"> 
        <?php echo fConvertToRupiahBulat(fGlobal("count(*)","ta_kib_d","Kd_UPB",$rUpb,"LIKE","",""))?>
      </td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle"><i>record</i></td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle">Posting</td>
      <td class="ar" valign="middle"> 
        <?php echo fConvertToRupiahBulat(fGlobal("count(*)","ta_kib_post","Kd_UPB:Referensi",$rUpb.":JLN.%","LIKE:LIKE","",""))?>
      </td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle"><i>record</i></td>
      <td valign="middle"><input type="checkbox" name="KIB_D" value="ON" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>Ta KIB-E</td>
      <td class="ar" valign="middle"> 
        <?php echo fConvertToRupiahBulat(fGlobal("count(*)","ta_kib_e","Kd_UPB",$rUpb,"LIKE","",""))?>
      </td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle"><i>record</i></td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle">Posting</td>
      <td class="ar" valign="middle"> 
        <?php echo fConvertToRupiahBulat(fGlobal("count(*)","ta_kib_post","Kd_UPB:Referensi",$rUpb.":ATL.%","LIKE:LIKE","",""))?>
      </td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle"><i>record</i></td>
      <td valign="middle"><input type="checkbox" name="KIB_E" value="ON" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>Ta KIB-F</td>
      <td class="ar" valign="middle"> 
        <?php echo fConvertToRupiahBulat(fGlobal("count(*)","ta_kib_f","Kd_UPB",$rUpb,"LIKE","",""))?>
      </td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle"><i>record</i></td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle">Posting</td>
      <td class="ar" valign="middle"> 
        <?php echo fConvertToRupiahBulat(fGlobal("count(*)","ta_kib_post","Kd_UPB:Referensi",$rUpb.":KDP.%","LIKE:LIKE","",""))?>
      </td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle"><i>record</i></td>
      <td valign="middle"><input type="checkbox" name="KIB_F" value="ON" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>Ta KIB-G</td>
      <td class="ar" valign="middle"> 
        <?php echo fConvertToRupiahBulat(fGlobal("count(*)","ta_kib_g","Kd_UPB",$rUpb,"LIKE","",""))?>
      </td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle"><i>record</i></td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle">Posting</td>
      <td class="ar" valign="middle"> 
        <?php echo fConvertToRupiahBulat(fGlobal("count(*)","ta_kib_post","Kd_UPB:Kd_Aset",$rUpb.":07.%","LIKE:LIKE","",""))?>
      </td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle"><i>record</i></td>
      <td valign="middle"><input type="checkbox" name="KIB_G" value="ON" /></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td colspan="11"><hr /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="10" valign="middle" style="color:#FF0000"> 
        <?php if (isset($_GET['MsG'])) {echo $_GET['MsG'];}?>
        &nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="10" valign="middle">
        <input type="button" name="B32" value="REFRESH" onclick="this.form.submit()" style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
        <input type="button" name="B3" value="TUTUP" onclick="P_Close()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
		<?=str_repeat('&nbsp;',33)?><input type="button" name="B1" value="CLEAN" onclick="P_Proses('<?=$UID?>')"  style="color:#FF0000; width: 100px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
		</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;

	function P_Proses(uid)
	{
		if (uid!='creator') {alert('Access denied..!!'); return false;}
		var AN = confirm("Proses ini akan MENGHAPUS semua data aset yang ditandai pada UPB bersangkutan, Lanjutkan penghapusan..?!!");
		if (AN)
		{
			objfrm.Proses.value = "Proses";
			objfrm.submit();
		}
	}

	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.Proses.value = "Close";
		objfrm.submit();
	}
</script>

<?php require('Connection_Close.php');?>
