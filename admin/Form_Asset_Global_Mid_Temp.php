<?php
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";
extract($_GET);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="file_global.js"></script>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
</head>
<?php
if (isset($_GET['gIdT'])) {$gIdT = $_GET['gIdT'];}
if (isset($_GET['rIDT'])) {$rIDT = $_GET['rIDT'];}

$gSPP  = "N";
if ($gIdT!="")
{
	$nSQ = "SELECT Kd_Unit, Nilai, Kd_Aset, Nomor, SPP, Pros FROM ta_pengadaan WHERE IDT='$gIdT'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gUnt = $mRo[0];
		$zUnt = $mRo[0];
		$gNiL = $mRo[1];
		$gNOM = $mRo[3];
		$gSPP = $mRo[4];
		$gPRO = $mRo[5];
		$mUnt = fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",$gUnt,"=","",DatabaseSB,$ConSB,"");
		$gRin = substr($mRo[2],0,2);
		$rIDT = fGlobalNEW("IDT","ta_kib_global_temp","No_Pengadaan",$gNOM,"=","",DatabaseSB,$ConSB,"");
	}
}

$gReaD= "readonly";
$gDisB= "hidden";
if ($rIDT!="")
{
	$nSQ = "SELECT * FROM ta_kib_global_temp WHERE IDT='".$rIDT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gUnt  = substr($mRo['Kd_UPB'],0,11);
		$gSub  = substr($mRo['Kd_UPB'],0,14);
		$mSub  = fGlobalNEW("nm_sub","ref_sub_unit","kd_sub",$gSub,"=","",DatabaseSB,$ConSB,"");
		
		$gUpb  = substr($mRo['Kd_UPB'],0,18);
		$mUpb  = fGlobalNEW("nm_upb","ref_upb","kd_upb",$gUpb,"=","",DatabaseSB,$ConSB,"");
		$gReF = $mRo['Ref_Aset'];
		$gReG = $mRo['Reg_Aset'];
		$gKdA = $mRo['Kd_Aset'];
		$gNmA = $mRo['Nm_Aset'];
		$gUrA = $mRo['Uraian'];
		$gNIL = $mRo['Nil_Aset'];
		$gMeM = $mRo['Memo'];
		$gMsA = $mRo['Tmbh_Ms_Manfaat'];
	}
}

if ($gMsA=='YA')
{
	$CKA = "checked";
	$CKB = "";
}
else
{
	$CKA = "";
	$CKB = "checked";
}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Form_Asset_Global_Mid_Temp_.php?gIdT=".$gIdT."&rIDT=".$rIDT."&IdL=".$_GET['IdL'] ?>">
<input type="hidden" name="Simpan">
  <table border="0" align="center" width="900" style="font-family:Calibri; font-size:10pt">
    <tr>
      <td width="24"></td>
      <td width="150" height="5"></td>
      <td colspan="3"></td>
      <td width="24"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>UNIT KERJA</td>
      <td colspan="3"><input name="f01" type="text" readonly="readonly" value="<?=$gUnt." : ".strtoupper($mUnt)?>" style="width:450px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>SUB UNIT</td>
      <td colspan="3">
		<?php if ($rIDT!=""){?>
			<input name="fSub" id="fSub" type="hidden" value="<?=$gSub?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
			<input name="mSub" id="mSub" type="text" readonly value="<?=$gSub." : ".strtoupper($mSub)?>" style="width:450px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
		<?php }else{?>
			<select class="boxs" name="fSub" id="fSub" tabindex="0" style="width:450px" onChange="this.form.submit()">
			<?php
			if ($fSub){$gSub=$fSub;}
			$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".__' ORDER BY Kd_Sub";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				if ($gSub=="") {$gSub=$mRo[0];}
				if (substr($gSub,0,11)!=$zUnt) {$gSub=$mRo[0];}
				
				$sel ="";
				if ($mRo[0]==$gSub) 
				{
					$sel ="selected";
					$zSub=$mRo[0];
				}
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper($mRo[1]).'</option>';
			}
			?>
			</select>
		<?php } ?>
	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>UPB</td>
      <td colspan="3">
		<?php if ($rIDT!=""){?>
			<input name="fUpb" id="fUpb" type="hidden" value="<?=$gUpb?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
			<input name="mUpb" id="mUpb" type="text" readonly value="<?=$gUpb." : ".strtoupper($mUpb)?>" style="width:450px; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
		<?php }else{?>
			<select class="boxs" name="fUpb" id="fUpb" tabindex="0" style="width: 450px">
			<?php
			$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb where Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				if ($gUpb=="") {$gUpb = $mRo[0];}
				if (substr($gUpb,0,14)!=$zSub) {$gUpb = $mRo[0];}
				$sel ="";
				if ($mRo[0]==$gUpb) 
				{
				$sel ="selected";
				$zUpb=$mRo[0];
				}
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper($mRo[1]).'</option>';
			}
			?>
			</select>
		<?php } ?>
	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td> 
      <td>&nbsp;</td>
      <td colspan="3" valign="middle">&nbsp; </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>REFERENSI</td>
      <td width="115"><input name="fRef" type="text" class="text" readonly value="<?=$gReF?>" style="width:120px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background:#CCCCCC" /></td>
      <td width="35" valign="top"><input type="button" name="B1" value="..." onClick="FindData('900','400','<?=$rIDT?>','<?=$gIdT?>','<?=$_GET['IdL']?>')" style="width: 25px; height: 18px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 1px" /></td>
      <td>
		<div id="welcomeMstCri" class="finddataspp0Cri">
			<div id="welcomeDiv1Cri" class="finddataspp1Cri"></div>
			<div id="welcomeDiv2Cri" class="finddataspp2Cri"></div>
		</div>	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>NO. REGISTER</td>
      <td colspan="3"><input name="fReG" type="text" class="text" readonly value="<?php echo $gReG?>" style="width:150px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background:#CCCCCC" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>KODE ASET </td>
      <td colspan="3"><input name="fKdA" type="text" class="text" readonly value="<?php echo $gKdA?>" style="width:150px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background:#CCCCCC" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td> 
      <td>NAMA ASET </td>
      <td colspan="3"><input name="fNmA" type="text" class="text" readonly value="<?php echo $gNmA?>" style="width:450px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background:#CCCCCC" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">URAIAN</td>
      <td colspan="3"><textarea name="fUrA" rows="4" id="textarea" readonly style="border-radius:5px; width:450px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background: #CCCCCC"><?=$gUrA?></textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">NILAI AKHIR </td>
      <td colspan="3"><input name="fNiL" type="text" class="text" readonly value="<?php echo fConvertToRupiah($gNIL)?>" style="text-align:right; width:130px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background: #CCCCCC" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">MASA MANFAAT </td>
      <td colspan="3">
	  <table border="0" width="400" style="font-family:Calibri; font-size:10pt">
		<tr>
		  <td width="100"><label><input name="fRadio" <?=$CKA?> type="radio" value="YA" />&nbsp;BERTAMBAH</label></td>
		  <td><label><input name="fRadio" <?=$CKB?> type="radio" value="TIDAK" />&nbsp;TIDAK BERTAMBAH</label></td>
		</tr>
	  </table>
	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">MEMO</td>
      <td colspan="3"><textarea name="fMeM" rows="4" class="text" style="border-radius:5px; width:450px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background: #fff"><?=$gMeM?></textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top"><a href="<?="Pengadaan_Mid.php?gIdT=".$gIdT."&IdL=".$_GET['IdL']?>" class="ico back">&nbsp;&nbsp;FORM PENGADAAN</a></td>
      <td colspan="3"><input type="button" name="B2" value="SIMPAN" onClick="P_Save('<?=$gSPP?>')" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
      <input type="button" name="B40" value="RESET" onclick="P_Reset()" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td> 
      <td valign="top">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Save(spp)
	{
		if (spp=="Y")
		{
			//window.alert('Access denied, data sudah digunakan di SimKADA..!!'); 
			//return false;
		}
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}

	function P_Reset()
	{
		objfrm.Simpan.value = "Reset";
		objfrm.submit();
	}
	
	function showDiv2(gIdL)
	{
		document.getElementById('welcomeDiv2Cri').style.display = "block";
		$(document).ready(function()
		{
			$("#welcomeDiv1Cri").load('Form_Asset_Global_Mid_Temp_Top.php?IdL='+gIdL);
		});
		
		$(document).ready(function()
		{
			$("#welcomeDiv2Cri").load('Form_Asset_Global_Mid_Temp_Mid.php?IdL='+gIdL);
		});
		
		if (document.getElementById('welcomeMstCri').style.display == "block")
		{
			document.getElementById('welcomeMstCri').style.display = "none";
		}
		else
		{
			document.getElementById('welcomeMstCri').style.display = "block";
		}
	}
	
	function showDivQ2(gIdL)
	{
		var gFnD = objfrm.fFind.value;
		$(document).ready(function()
		{
			$("#welcomeDiv2Cri").load('Form_Asset_Global_Mid_Temp_Mid.php?CrT='+gFnD+'&IdL='+gIdL);
		});
		document.getElementById('welcomeDiv2Cri').style.display = "block";
	}
	
	function gClose2()
	{
		document.getElementById('welcomeMstCri').style.display = "none";
	}

	function FindData(w,h,rIDT,gIdT,IdL)
	{
		var gUpb = objfrm.fUpb.value;
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = "Form_Asset_Global_Mid_Temp_Top.php?gUpb="+gUpb+"&gIdT="+gIdT+"&rIDT="+rIDT+"&IdL="+IdL;
			URL_Mid = "Form_Asset_Global_Mid_Temp_Mid.php?gUpb="+gUpb+"&gIdT="+gIdT+"&rIDT="+rIDT+"&IdL="+IdL;
			URL_Bot = "Form_Asset_Global_Mid_Temp_Bot.php";
			txtHTML = "<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFind_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFind_Mid' src='"+URL_Mid+" scrolling='auto'><frame name='WinFind_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes></noframes></frameset></html>";
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
</script>
