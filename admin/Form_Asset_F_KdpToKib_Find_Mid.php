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
<link rel="stylesheet" href="css/style_mid.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
extract($_GET);
extract($_POST);

$TakeOff = $TakeOff;
if ($IDT)
{
	$rReF = fGlobalNEW("Referensi","ta_kib_f_to_aset","IDT",$IDT,"=","",DatabaseSB,$ConSB,"");
	$rUPB = fGlobalNEW("Kd_UPB","ta_kib_f_to_aset","IDT",$IDT,"=","",DatabaseSB,$ConSB,"");
}

if ($TakeOff=="Ya")
{
	$gREF = $_GET['gREF'];
	$nKDP = fGlobalNEW("Harga","ta_kib_108","Referensi:Kd_UPB",$gREF.":".$rUPB,"=:=","",DatabaseSB,$ConSB,"");
	$rNoP = fGlobalNEW("No_Pengadaan","ta_kib_108","Referensi:Kd_UPB",$gREF.":".$rUPB,"=:=","",DatabaseSB,$ConSB,"");
	$nURA = fGlobalNEW("Keterangan","ta_kib_108","Referensi:Kd_UPB",$gREF.":".$rUPB,"=:=","",DatabaseSB,$ConSB,"");
	
	$gCK = fGlobalNEW("IDT","ta_kib_f_to_aset_rinci","Referensi:Ref_KDP:Kd_UPB",$rReF.":".$gREF.":".$rUPB,"=:=:=","IDT LIMIT 0,1",DatabaseSB,$ConSB,"");
	if (!$gCK)
	{
		$SQ="INSERT INTO ta_kib_f_to_aset_rinci SET 
		Referensi='$rReF',
		No_Pengadaan='$rNoP',
		Kd_UPB='$rUPB',
		Ref_KDP='$gREF',
		Nilai_KDP='$nKDP',
		Uraian='$nURA',
		Pencatat='$UID',
		Recorded=now()";
		$nRs = mysql_query($SQ) or die(mysql_error());
	}
		
	$URLK = "Form_Asset_F_KdpToKib_Mid.php?IDT=".$IDT."&IdL=".$IdL;
	$gTrGt="WinFormKDP_Mid";
	?>
	<script language="JavaScript">  	
	this.window.open ('<?php echo $URLK ?>','<?=$gTrGt?>')
	this.window.focus()
	this.window.document.close() 
	this.setTimeout("self.close()",1)
	</script>
	<?php
	return false;
}
?>

<body>
<table width="1165" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
if ($fFind=="") 
{
	$gLimit = " LIMIT 0,50";
	$gFindD = "";
} 
else 
{
	$gLimit = " LIMIT 0,250";
	$gFindD = " AND (Referensi LIKE '%$fFind%' OR Nm_Aset LIKE '%$fFind%' OR No_Pengadaan LIKE '%$fFind%' OR Keterangan LIKE '%$fFind%' OR Harga LIKE '%$fFind%' OR Nilai_Akhir LIKE '%$fFind%')";
}

$iG=1;
$nSQL= "SELECT Referensi,No_Pengadaan,Nm_Aset,Harga,Keterangan FROM ta_kib_108 WHERE referensi LIKE 'KDP%' AND Kd_UPB='$rUPB' ".$gFindD." ORDER BY Referensi ".$gLimit;
#echo $nSQL;
$nRs = mysql_query($nSQL) or die(mysql_error());
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gREF = $mRo[0];
	$URL  = "Form_Asset_F_KdpToKib_Find_Mid.php?TakeOff=Ya&gREF=".$gREF."&IDT=".$IDT."&IdL=".$_GET['IdL'];
	?>
	<tr height="18"> 
	  <td valign="top" width="140" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #666666"><a href="<?=$URL?>" target="_top"><?=$mRo[0]?></a></td>
	  <td valign="top" width="120" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #666666"><a href="<?=$URL?>" target="_top"><?=$mRo[1]?></a></td>
	  <td valign="top" width="95" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #666666"><a href="<?=$URL?>" target="_top"><?=$mRo[2]?></a></td>
	  <td valign="top" width="95" <?=fBackCLR($iG)?>  style="border-bottom:1px dotted #666666; text-align:right; padding-right:15px"><a href="<?=$URL?>" target="_top"><?=fConvertToRupiah($mRo[3])?></a></td>
	  <td valign="top" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #666666"><a href="<?php echo $URL?>" target="_top"><?=$mRo[4]?></a>
	  </td>
	</tr>
	<?php
	$iG++;
}
?>
</table>
</body>
</html>
