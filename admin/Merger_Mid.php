<?php
require "CheckSession.php";
require "Connection.php";
require "Connection_Simkada.php";
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
if (isset($_GET['rIDT'])) {$rIDT = $_GET['rIDT'];}
if (isset($_GET['rIDT2'])) {$rIDT2 = $_GET['rIDT2'];}
if (isset($_GET['CrT']))  {$CrT  = $_GET['CrT'];}


$nSQ = "SELECT Referensi,Ref_Group,Kd_UPB,Kd_Aset_108,No_Register,Nm_Aset,Tgl_Perolehan,Keterangan FROM ta_kib_108 WHERE IDT='$rIDT'";
$nRs = mysql_query($nSQ) or die(mysql_error());
$mRo = mysql_fetch_assoc($nRs);
$rReF = $mRo['Referensi'];
$rKoD = $mRo['Kd_Aset_108'];
$rReG = $mRo['No_Register'];
$rNaM = $mRo['Nm_Aset'];
if ($rNaM=="") {$rNaM = fGlobalNEW("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$rKoD,"=","",DatabaseSB,$ConSB,"");}
$rKeT = $rNaM." (".$mRo['Keterangan'].")";
$rTgL = $mRo['Tgl_Perolehan'];
$rNiA = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Crit",$rReF.":SLD","=:=","",DatabaseSB,$ConSB,"");
$rNiD = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi",$rReF,"=","",DatabaseSB,$ConSB,"");
$rNiK = fGlobalNEW("IfNull(sum(Kredit),0)","ta_kib_post_108","Referensi",$rReF,"=","",DatabaseSB,$ConSB,"");
$rNiB = $rNiD-$rNiK;

$nSQ2 = "SELECT Referensi,Ref_Group,Kd_UPB,Kd_Aset_108,No_Register,Nm_Aset,Tgl_Perolehan,Keterangan FROM ta_kib_108 WHERE IDT='$rIDT2'";
$nRs2 = mysql_query($nSQ2) or die(mysql_error());
$mRo2 = mysql_fetch_assoc($nRs2);
$tRo2 = mysql_num_rows($nRs2);
if ($tRo2 > 0)
{
	$rReF2 = $mRo2['Referensi'];
	$rKoD2 = $mRo2['Kd_Aset_108'];
	$rReG2 = $mRo2['No_Register'];
	$rNaM2 = $mRo2['Nm_Aset'];
	if ($rNaM2=="") {$rNaM2 = fGlobalNEW("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$rKoD2,"=","",DatabaseSB,$ConSB,"");}
	$rKeT2 = $mRo2['Keterangan'];
	$rTgL2 = fConvertDateShort($mRo2['Tgl_Perolehan']);
	$rNiA2 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Crit",$rReF2.":SLD","=:=","",DatabaseSB,$ConSB,"");
	$rNiD2 = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi",$rReF2,"=","",DatabaseSB,$ConSB,"");
	$rNiK2 = fGlobalNEW("IfNull(sum(Kredit),0)","ta_kib_post_108","Referensi",$rReF2,"=","",DatabaseSB,$ConSB,"");
	$rNiB2 = $rNiD2-$rNiK2;
}
else
{
	$rReF2 = "";
	$rKoD2 = "";
	$rReG2 = "";
	$rNaM2 = "";
	$rKeT2 = "";
	$rTgL2 = "";
	$rNiA2 = 0;
	$rNiB2 = 0;
}
?>
<form name="myfrm" method="post" action="<?="Merger_Mid_.php?rIDT=".$rIDT."&rIDT2=".$rIDT2."&CrT=".$CrT."&IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Simpan">
  <table border="0" cellpadding="0" align="center" style="width:900px">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="134">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">REFERENSI</td>
    <td>&nbsp;</td>
    <td colspan="2"><input name="fReF" type="text" value="<?=$rReF?>" readonly="readonly" style="width:110px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td width="15" style="">&nbsp;</td>
    <td align="right" width="116">KODE/REGISTER</td>
    <td width="19">&nbsp;</td>
    <td colspan="2"><input name="fKoD" type="text" value="<?=$rKoD?>" readonly="readonly" style="width:110px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
      <input name="fReG" type="text" value="<?=$rReG?>" readonly="readonly" style="width:55px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    <td></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">NAMA ASET</td>
    <td>&nbsp;</td>
    <td colspan="2"><input name="fNaM" type="text" value="<?=$rNaM?>" readonly="readonly" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">URAIAN</td>
    <td>&nbsp;</td>
    <td colspan="2"><input name="fKeT" type="text" value="<?=$rKeT?>" readonly="readonly" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">TGL. PEROLEHAN </td>
    <td>&nbsp;</td>
    <td colspan="2"><input name="fTgL" type="text" value="<?=fConvertDateShort($rTgL)?>" readonly="readonly" style="width:140px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">NILAI AWAL </td>
    <td>&nbsp;</td>
    <td colspan="2"><input name="fNiA" type="text" value="<?=fConvertToRupiah($rNiA)?>" readonly="readonly" style="text-align:right; width:140px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">NILAI AKHIR </td>
    <td>&nbsp;</td>
    <td width="147"><input name="fNiB" type="text" value="<?=fConvertToRupiah($rNiB)?>" readonly="readonly" style="text-align:right; width:140px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    <td width="455">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" cellpadding="0" align="center" style="width:900px">
  <tr>
    <td width="3">&nbsp;</td>
    <td width="127">&nbsp;</td>
    <td width="21">&nbsp;</td>
    <td colspan="2" style="font-size:16pt; font-weight:bold">GABUNGKAN (MERGER) DATA KE:</td>
    <td width="134">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="112">&nbsp;</td>
    <td width="489">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">REFERENSI</td>
    <td>&nbsp;</td>
    <td><input name="fReF2" type="text" value="<?=$rReF2?>" readonly="readonly" style="width:110px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    <td><input type="button" name="B3923" value="Find" onclick="FindDATA('900','400','<?=$rIDT?>','<?=$CrT?>','<?=$_GET['IdL']?>')" style="width:40px; height: 19px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" cellpadding="0" align="center" style="width:900px">
  <tr>
    <td width="3"></td>
    <td width="127"></td>
    <td width="21"></td>
    <td colspan="2" style="font-size:18pt"></td>
    <td width="134"></td>
  </tr>
  <tr>
    <td style="">&nbsp;</td>
    <td align="right" width="127">KODE/REGISTER</td>
    <td>&nbsp;</td>
    <td colspan="2"><input name="fKoD2" type="text" value="<?=$rKoD2?>" readonly="readonly" style="width:110px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
        <input name="fReG2" type="text" value="<?=$rReG2?>" readonly="readonly" style="width:55px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    <td></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">NAMA ASET</td>
    <td>&nbsp;</td>
    <td colspan="2"><input name="fNaM2" type="text" value="<?=$rNaM2?>" readonly="readonly" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">URAIAN</td>
    <td>&nbsp;</td>
    <td colspan="2"><input name="fKeT2" type="text" value="<?=$rKeT2?>" readonly="readonly" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">TGL. PEROLEHAN </td>
    <td>&nbsp;</td>
    <td colspan="2"><input name="fTgL2" type="text" value="<?=$rTgL2?>" readonly="readonly" style="width:140px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">NILAI AWAL </td>
    <td>&nbsp;</td>
    <td colspan="2"><input name="fNiA3" type="text" value="<?=fConvertToRupiah($rNiA2)?>" readonly="readonly" style="text-align:right; width:140px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">NILAI AKHIR </td>
    <td>&nbsp;</td>
    <td width="147"><input name="fNiB2" type="text" value="<?=fConvertToRupiah($rNiB2)?>" readonly="readonly" style="text-align:right; width:140px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    <td width="455"><label><input type="checkbox" name="CeBOX" value="ON" />Menambah Masa Manfaat</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">
	<table border="0" cellpadding="0" align="center" style="width:300px">
	  <tr>
       <td width="20"></td>
       <td></td>
	  </tr>
	</table>	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><input type="button" name="B39222" value="PROSES" onclick="P_Proses('<?=$rIDT?>','<?=$rIDT2?>')" style="width:70px; height: 19px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
      <input type="button" name="B392222" value="BATAL" onclick="P_Batal()" style="width:70px; height: 19px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Proses(rIDT,rIDT2)
	{
		if (!rIDT2) 
		{
			alert('Silahkan tentukan dahulu data master/tujuan..!!');
			return false;
		}
		
		var AN = confirm("Merger data menyebabkan bergabungnya data ke item tujuan, lanjutkan proses..?!!");
		if (AN)
		{
			objfrm.Simpan.value = "Save";
			objfrm.target = "_top";
			objfrm.submit();
		}
	}

	function P_Batal()
	{
		objfrm.Simpan.value = "Batal";
		objfrm.target = "_top";
		objfrm.submit();
	}
	
	function FindDATA(w,h,rIDT,CrT,IdL)
	{	var win=null;
		var txtHTML = "";
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
			win=window.open('','',settings);
			if (win!=null)
    			{
      				win.window.document.open()       			
					URL_Top = "Merger_Mid_Find_Top.php?rIDT="+rIDT+"&CrT="+CrT+"&IdL="+IdL;
					URL_Mid = "Merger_Mid_Find_Mid.php?rIDT="+rIDT+"&CrT="+CrT+"&IdL="+IdL;
					URL_Bot = "Merger_Mid_Find_Bot.php";
       			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='"+URL_Top+" scrolling='no'><frame name='WinFindAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFindAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}
</script>