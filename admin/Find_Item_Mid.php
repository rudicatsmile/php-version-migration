<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_mid.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
$rIDT  = $_REQUEST['rIDT'];
$gUnt  = $_REQUEST['gUnt'];
$gSub  = $_REQUEST['gSub'];
$gUpb  = $_REQUEST['gUpb'];
$CrAcc = $_REQUEST['CrAcc'];
$gFin  = $_REQUEST['fFind'];
$gAst  = $_REQUEST['fAst'];
if ($gAst=="") {$gAst="1";}
//echo $gAst;
$TakeOff = $_REQUEST['TakeOff'];

if ($TakeOff=="Ya")
{
	$KiB  = $_REQUEST['KiB'];
	$gIDT = $_REQUEST['gIDT'];
	//echo $KiB."<br>";
	//echo $gIDT."<br>";
	$rReF = fGlobal("Referensi","ta_penghapusan_usulan","IDT",$rIDT,"=","","");
	
	$nSQ = "SELECT * FROM ta_kib_".$KiB." WHERE IDT = '".$gIDT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gRef = $mRo['Referensi'];
		$gReG = $mRo['Ref_Group'];
		$gKdA = $mRo['Kd_Aset'];
		$gNmA = $mRo['Nm_Aset'];
		$gNoR = $mRo['No_Register'];
		$gKdP = $mRo['Kd_Pemilik'];
		$gTgP = $mRo['Tgl_Perolehan'];
		$gKdD = $mRo['Kondisi'];
		if ($KiB=="b")
		{
			$gUra = $mRo['Merk'];
			$gTyp = $mRo['Type'];
			if ($gUra!="") {$gUra=$gUra;} else {$gUra="";}
			if ($gTyp!="") {$gTyp="/".$gTyp;} else {$gTyp="";}
			$gUra = $gUra.$gTyp;
			$rUra= "Uraian='$gUra',";
		}
		
		$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi",$gRef,"=","","");
		$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi",$gRef,"=","","");
		if ($gNIb != 0) {$gNIL = $gNIa - $gNIb;}
		else {$gNIL=$gNIa;}
		$gCEK = fGlobal("IDT","ta_penghapusan_usulan_rinc","ID:KIB",$gIDT.":".$KiB,"=:=","","");
		if ($gCEK=="")
		{
			$SQ="INSERT INTO ta_penghapusan_usulan_rinc SET
			ID='$gIDT',
			KIB='$KiB',
			Referensi='$rReF',
			Ref_Aset='$gRef',
			Ref_Group='$gReG',
			Kd_UPB='$gUpb',
			Kd_Aset='$gKdA', ".$rUra."
			Nm_Aset='$gNmA',
			No_Register='$gNoR',
			Kd_Pemilik='$gKdP',
			Tgl_Perolehan='$gTgP',
			Kondisi='$gKdD',
			Alasan='',
			Keterangan='',
			Nilai='$gNIL',
			Recorded=now(),
			Pencatat='-'";
			$rs = mysql_query($SQ) or die(mysql_error());
		}
	}
	$URL  = "Usulan_Penghapusan.php?rIDT=".$rIDT."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb;
	?>
	<script language="JavaScript">  	
	this.window.open ('<?php echo $URL ?>','MidFrame')
	this.window.focus()
	this.window.document.clear()
	this.window.document.close() 
	this.setTimeout("self.close()",1)
	</script>
	<?php
}
?>

<body>
<div class="table">
<?php if ($gAst=="1") {?>  
  <table width="1165" border="0" align="center">
    <?php
	if ($gFin=="") {$gLimit=" LIMIT 0,50";} else {$gLimit="";}
	$iG=1;
	$nSQL= "SELECT * FROM ta_kib_a WHERE (
	Kd_Aset LIKE '%".$gFin."%' OR 
	Nm_Aset LIKE '%".$gFin."%' OR 
	Alamat LIKE '%".$gFin."%' OR 
	Keterangan LIKE '%".$gFin."%' OR 
	Sertifikat_Nomor LIKE '%".$gFin."%' OR 
	Penggunaan LIKE '%".$gFin."%' OR 
	Tgl_Perolehan LIKE '%".$gFin."%' OR 
	Harga LIKE '%".$gFin."%') AND Kd_UPB='".$gUpb."' ORDER BY Kd_Aset, No_Register".$gLimit;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			$gIDT = $mRo['IDT'];
			$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi",$mRo['Referensi'],"=","","");
			$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi",$mRo['Referensi'],"=","","");
			if ($gNIb != 0) {$gNIL = $gNIa - $gNIb;}
			else {$gNIL=$gNIa;}
			
			$gCEK = fGlobal("IDT","ta_penghapusan_usulan_rinc","ID:KIB",$gIDT.":a","=:=","","");
			if ($gCEK=="")
			{
				$URL = "Find_Item_Mid.php?TakeOff=Ya&KiB=a&gIDT=".$gIDT."&rIDT=".$rIDT."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb;
				$TRG = "target='_top'";
				$CLK = "";
			}
			else
			{
				$URL = "#";
				$TRG = "";
				$CLK = "onclick='P_Mess();return false'";
			}
			?>
			<tr>
			  <td width="103" height="18" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Kd_Aset']?></a></td>
			  <td width="58" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['No_Register']?></a></td>
			  <td width="450" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Nm_Aset']?>&nbsp;</a></td>
			  <td width="285" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Alamat']?></a></td>
			  <td width="50" valign="top" align="center"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo substr($mRo['Tgl_Perolehan'],0,4)?></a></td>
			  <td width="146" valign="top" align="right"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?=fConvertToRupiah($gNIL)?></a></td>
			</tr>
			<?php
			$iG++;
		}
		while ($mRo = mysql_fetch_assoc($nRs));	
	}
	?>
  </table>
<?php } ?>
<?php if ($gAst=="2") {?>  
  <table width="1165" border="0" align="center">
    <?php
	if ($gFin=="") {$gLimit=" LIMIT 0,50";} else {$gLimit="";}
	$iG=1;
	$nSQL= "SELECT * FROM ta_kib_b WHERE (
	Kd_Aset LIKE '%".$gFin."%' OR 
	Nm_Aset LIKE '%".$gFin."%' OR 
	Merk LIKE '%".$gFin."%' OR 
	Type LIKE '%".$gFin."%' OR 
	Ukuran_CC LIKE '%".$gFin."%' OR
	Nomor_Rangka LIKE '%".$gFin."%' OR
	Nomor_Mesin LIKE '%".$gFin."%' OR
	Nomor_Polisi LIKE '%".$gFin."%' OR
	Nomor_BPKB LIKE '%".$gFin."%' OR
	Tgl_Perolehan LIKE '%".$gFin."%' OR 
	Harga LIKE '%".$gFin."%') AND Kd_UPB='".$gUpb."' ORDER BY Kd_Aset, No_Register".$gLimit;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			$gIDT = $mRo['IDT'];
			$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi",$mRo['Referensi'],"=","","");
			$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi",$mRo['Referensi'],"=","","");
			if ($gNIb != 0) {$gNIL = $gNIa - $gNIb;}
			else {$gNIL=$gNIa;}
			
			$gCEK = fGlobal("IDT","ta_penghapusan_usulan_rinc","ID:KIB",$gIDT.":b","=:=","","");
			if ($gCEK=="")
			{
				$URL = "Find_Item_Mid.php?TakeOff=Ya&KiB=b&gIDT=".$gIDT."&rIDT=".$rIDT."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb;
				$TRG = "target='_top'";
				$CLK = "";
			}
			else
			{
				$URL = "#";
				$TRG = "";
				$CLK = "onclick='P_Mess();return false'";
			}
			?>
			<tr>
			  <td width="103" height="18" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Kd_Aset']?></a></td>
			  <td width="58" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['No_Register']?></a></td>
			  <td width="601" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Nm_Aset']?>&nbsp;</a></td>
			  <td width="285" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Merk']?></a></td>
			  <td width="50" valign="top" align="center"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo substr($mRo['Tgl_Perolehan'],0,4)?></a></td>
			  <td width="50" valign="top" align="center"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Kondisi']?></a></td>
			  <td width="146" valign="top" align="right"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?=fConvertToRupiah($gNIL)?></a></td>
			</tr>
			<?php
			$iG++;
		}
		while ($mRo = mysql_fetch_assoc($nRs));	
	}
	?>
  </table>
<?php } ?>
<?php if ($gAst=="3") {?>  
  <table width="1165" border="0" align="center">
    <?php
	if ($gFin=="") {$gLimit=" LIMIT 0,50";} else {$gLimit="";}
	$iG=1;
	$nSQL= "SELECT * FROM ta_kib_c WHERE (
	Kd_Aset LIKE '%".$gFin."%' OR 
	Nm_Aset LIKE '%".$gFin."%' OR 
	Lokasi LIKE '%".$gFin."%' OR 
	Luas_Lantai LIKE '%".$gFin."%' OR 
	Tgl_Perolehan LIKE '%".$gFin."%' OR 
	Harga LIKE '%".$gFin."%') AND Kd_UPB='".$gUpb."' ORDER BY Kd_Aset, No_Register".$gLimit;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			$gIDT = $mRo['IDT'];
			$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi",$mRo['Referensi'],"=","","");
			$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi",$mRo['Referensi'],"=","","");
			if ($gNIb != 0) {$gNIL = $gNIa - $gNIb;}
			else {$gNIL=$gNIa;}
			
			$gCEK = fGlobal("IDT","ta_penghapusan_usulan_rinc","ID:KIB",$gIDT.":c","=:=","","");
			if ($gCEK=="")
			{
				$URL = "Find_Item_Mid.php?TakeOff=Ya&KiB=c&gIDT=".$gIDT."&rIDT=".$rIDT."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb;
				$TRG = "target='_top'";
				$CLK = "";
			}
			else
			{
				$URL = "#";
				$TRG = "";
				$CLK = "onclick='P_Mess();return false'";
			}
			?>
			<tr>
			  <td width="103" height="18" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Kd_Aset']?></a></td>
			  <td width="58" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['No_Register']?></a></td>
			  <td width="350" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Nm_Aset']?>&nbsp;</a></td>
			  <td width="300" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Lokasi']?></a></td>
			  <td width="100" valign="top" align="right"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Luas_Lantai']?></a></td>
			  <td width="70" valign="top" align="center"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo substr($mRo['Tgl_Perolehan'],0,4)?></a></td>
			  <td width="60" valign="top" align="center"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Kondisi']?></a></td>
			  <td width="146" valign="top" align="right"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?=fConvertToRupiah($gNIL)?></a></td>
			</tr>
			<?php
			$iG++;
		}
		while ($mRo = mysql_fetch_assoc($nRs));	
	}
	?>
  </table>
<?php } ?>
<?php if ($gAst=="4") {?>  
  <table width="1165" border="0" align="center">
    <?php
	if ($gFin=="") {$gLimit=" LIMIT 0,50";} else {$gLimit="";}
	$iG=1;
	$nSQL= "SELECT * FROM ta_kib_d WHERE (
	Kd_Aset LIKE '%".$gFin."%' OR 
	Nm_Aset LIKE '%".$gFin."%' OR 
	Lokasi LIKE '%".$gFin."%' OR 
	Luas LIKE '%".$gFin."%' OR 
	Tgl_Perolehan LIKE '%".$gFin."%' OR 
	Harga LIKE '%".$gFin."%') AND Kd_UPB='".$gUpb."' ORDER BY Kd_Aset, No_Register".$gLimit;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			$gIDT = $mRo['IDT'];
			$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi",$mRo['Referensi'],"=","","");
			$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi",$mRo['Referensi'],"=","","");
			if ($gNIb != 0) {$gNIL = $gNIa - $gNIb;}
			else {$gNIL=$gNIa;}
			
			$gCEK = fGlobal("IDT","ta_penghapusan_usulan_rinc","ID:KIB",$gIDT.":d","=:=","","");
			if ($gCEK=="")
			{
				$URL = "Find_Item_Mid.php?TakeOff=Ya&KiB=d&gIDT=".$gIDT."&rIDT=".$rIDT."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb;
				$TRG = "target='_top'";
				$CLK = "";
			}
			else
			{
				$URL = "#";
				$TRG = "";
				$CLK = "onclick='P_Mess();return false'";
			}
			?>
			<tr>
			  <td width="103" height="18" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Kd_Aset']?></a></td>
			  <td width="58" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['No_Register']?></a></td>
			  <td width="350" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Nm_Aset']?>&nbsp;</a></td>
			  <td width="300" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Lokasi']?></a></td>
			  <td width="70" valign="top" align="center"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo substr($mRo['Tgl_Perolehan'],0,4)?></a></td>
			  <td width="100" valign="top" align="right"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Luas']?></a></td>
			  <td width="10" valign="top">&nbsp;</td>
			  <td width="60" valign="top" align="center"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Kondisi']?></a></td>
			  <td width="146" valign="top" align="right"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?=fConvertToRupiah($gNIL)?></a></td>
			</tr>
			<?php
			$iG++;
		}
		while ($mRo = mysql_fetch_assoc($nRs));	
	}
	?>
  </table>
<?php } ?>
<?php if ($gAst=="5") {?>  
  <table width="1165" border="0" align="center">
    <?php
	if ($gFin=="") {$gLimit=" LIMIT 0,50";} else {$gLimit="";}
	$iG=1;
	$nSQL= "SELECT * FROM ta_kib_e WHERE (
	Kd_Aset LIKE '%".$gFin."%' OR 
	Nm_Aset LIKE '%".$gFin."%' OR 
	Judul LIKE '%".$gFin."%' OR 
	Spesifikasi LIKE '%".$gFin."%' OR 
	Pencipta LIKE '%".$gFin."%' OR 
	Daerah_Asal LIKE '%".$gFin."%' OR 
	Bahan LIKE '%".$gFin."%' OR 
	Jenis LIKE '%".$gFin."%' OR 
	Ukuran LIKE '%".$gFin."%' OR 
	Tgl_Perolehan LIKE '%".$gFin."%' OR 
	Harga LIKE '%".$gFin."%') AND Kd_UPB='".$gUpb."' ORDER BY Kd_Aset, No_Register".$gLimit;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			$gIDT = $mRo['IDT'];
			$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi",$mRo['Referensi'],"=","","");
			$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi",$mRo['Referensi'],"=","","");
			if ($gNIb != 0) {$gNIL = $gNIa - $gNIb;}
			else {$gNIL=$gNIa;}
			
			$gCEK = fGlobal("IDT","ta_penghapusan_usulan_rinc","ID:KIB",$gIDT.":e","=:=","","");
			if ($gCEK=="")
			{
				$URL = "Find_Item_Mid.php?TakeOff=Ya&KiB=e&gIDT=".$gIDT."&rIDT=".$rIDT."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb;
				$TRG = "target='_top'";
				$CLK = "";
			}
			else
			{
				$URL = "#";
				$TRG = "";
				$CLK = "onclick='P_Mess();return false'";
			}
			?>
			<tr>
			  <td width="103" height="18" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Kd_Aset']?></a></td>
			  <td width="58" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['No_Register']?></a></td>
			  <td width="350" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Nm_Aset']?>&nbsp;</a></td>
			  <td width="300" valign="top"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Lokasi']?></a></td>
			  <td width="70" valign="top" align="center"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo substr($mRo['Tgl_Perolehan'],0,4)?></a></td>
			  <td width="100" valign="top" align="right"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Luas']?></a></td>
			  <td width="10" valign="top">&nbsp;</td>
			  <td width="60" valign="top" align="center"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?php echo $mRo['Kondisi']?></a></td>
			  <td width="146" valign="top" align="right"><a href="<?php echo $URL?>" <?=$TRG?> <?=$CLK?>><?=fConvertToRupiah($gNIL)?></a></td>
			</tr>
			<?php
			$iG++;
		}
		while ($mRo = mysql_fetch_assoc($nRs));	
	}
	?>
  </table>
<?php } ?>
</div>
</body>
</html>
<script language="javascript">
	function P_Mess()
	{
		window.alert('Item sudah masuk diusulan penghaspusan...!!');
	}
</script>
