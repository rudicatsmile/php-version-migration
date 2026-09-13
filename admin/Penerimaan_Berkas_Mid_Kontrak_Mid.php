<?php
require "Connection.php";
require "Connection_Simkada.php";
require "FileFunction.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_mid.css" type="text/css" media="all" />
</head>
<?php
if (isset($_GET['gKG'])) {$gKG  = $_GET['gKG'];}
if (isset($_GET['gRK'])) {$gRK  = $_GET['gRK'];}
if (isset($_GET['gDL'])) {$gDL  = $_GET['gDL'];}

if ($gDL)
{
	$gID = $_GET['gID'];
	$nSQ = "DELETE FROM ta_kontrak WHERE IDT='$gID'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Penerimaan_Berkas_Mid_Kontrak_Mid_.php?gKG=".$gKG."&gRK=".$gRK."&IdL=".$_GET['IdL'] ?>">
  <input type="hidden" name="Simpan">
  <table border="0" align="center" cellpadding="0" cellspacing="0" style="width:770px">
	<?php
	$rCEK = fGlobalNEW("IDT","ta_kontrak","Nomor","%","LIKE","IDT LIMIT 0,1",DatabaseSB,$ConSB,"");
	if (!$rCEK)
	{
		CallConnection(DatabaseSB,$ConSB);
		$nSQ = "SELECT Periode, Kd_Kegiatan, Kd_Rek13, No_Kontrak FROM ta_penerimaan_berkas where no_kontrak<>'' and  no_kontrak<>'-' 
		GROUP by Periode, Kd_Kegiatan, Kd_Rek13, No_Kontrak";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$dKG = $mRo[1];
			$dRK = $mRo[2];
			
			$rUR = fGlobalNEW("Nama_Kegiatan","kegiatan","Id_Kegiatan",$dKG,"=","",DatabaseSA,$ConSA,"");
			$rUR.= "; ".fGlobalNEW("Nama_COA","coa_kota","No_Rekening",$dRK,"=","",DatabaseSA,$ConSA,"");
			
			CallConnection(DatabaseSB,$ConSB);
			$SW = "INSERT INTO ta_kontrak SET 
			Nomor='".$mRo[3]."',
			Tanggal='0000-00-00',
			SKPD='".substr($mRo[1],5,7)."',
			Kegiatan='".$mRo[1]."',
			Rekening='".$mRo[2]."',
			Uraian='".$rUR."',
			Periode='".$mRo[0]."'";
			$Rs = mysql_query($SW) or die(mysql_error());
		}
	}
	
	$iG = 1;  	
	$nSQ = "SELECT IDT,Nomor,Tanggal,Uraian,Periode,Kegiatan,Rekening FROM ta_kontrak WHERE Kegiatan='$gKG' AND Rekening='$gRK' ORDER BY Nomor";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gDeL= "";
		$rNo = $mRo[1];
		$rKG = $mRo[5];
		$rRK = $mRo[6];
		$rPD = $mRo[4];
		$gDeL = fGlobalNEW("IDT","ta_penerimaan_berkas","No_Kontrak:Kd_Kegiatan:Kd_Rek13:Periode",$rNo.":".$rKG.":".$rRK.":".$rPD,"=:=:=:=","",DatabaseSB,$ConSB,"");
		$gID = $mRo[0];
		?>
		<tr height="18"> 
		  <td valign="top" width="30" <?=fBackCLR($iG)?> style="border-bottom: 1px dotted #999999"><?=$iG?></td>
		  <td valign="top" width="200" <?=fBackCLR($iG)?> style="border-bottom: 1px dotted #999999"><?=$mRo[1]?></td>
		  <td valign="top" width="80" <?=fBackCLR($iG)?> style="border-bottom: 1px dotted #999999"><?=fConvertDateShort($mRo[2])?></td>
		  <td width="375" valign="top" style="border-bottom: 1px dotted #999999" <?=fBackCLR($iG)?>><?=$mRo[3]?></td>
		  <td width="65" valign="top" style="border-bottom: 1px dotted #999999; text-align:center; font-weight:bold; color:#FF0000" <?=fBackCLR($iG)?>><?=$mRo[4]?></td>
		  <td valign="top" width="120" <?=fBackCLR($iG)?> style="text-align:center; border-bottom: 1px dotted #999999">
			<a href="#" class="ico edit" onclick="EditData('<?=$gID?>','<?=$gKG?>','<?=$gRK?>','<?=$_GET['IdL']?>'); return false">&nbsp;Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="#" class="ico del" onclick="DellData('<?=$gDeL?>','<?=$gID?>','<?=$gKG?>','<?=$gRK?>','<?=$_GET['IdL']?>'); return false">&nbsp;Delete</a>			
		  </td>
		</tr>
		<?php 
  		$iG++;
	}
	?>
	<tr height="28">
	  <td colspan="6" <?=fBackCLR($iG)?> style="vertical-align:middle; text-align:center; border-bottom: 1px dotted #999999">
	  <a href="<?="penerimaan_berkas_mid_kontrak_mid_frm.php?gID=&gKG=".$gKG."&gRK=".$gRK."&IdL=".$_GET['IdL']?>" class="ico add">&nbsp;&nbsp;Add Item</a>
	  <?php
	  /*onclick="EditData('','<?=$gKG?>','<?=$gRK?>','<?=$_GET['IdL']?>'); return false"*/
	  ?>
	  </td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function EditData(gID,gKG,gRK,IdL)
	{
		window.open('Penerimaan_Berkas_Mid_Kontrak_Mid_frm.php?gID='+gID+'&gKG='+gKG+'&gRK='+gRK+'&IdL='+IdL,'_self');
	}
	function DellData(gDel,gID,gKG,gRK,IdL)
	{
		if (gDel!="") {window.alert('Access denied..!!'); return false;}
		var AN = confirm("Delete record..?!!");
		if (AN)
		{
			window.open('Penerimaan_Berkas_Mid_Kontrak_Mid.php?gDL=YA&gID='+gID+'&gKG='+gKG+'&gRK='+gRK+'&IdL='+IdL,'_self');
		}
	}
</script>

