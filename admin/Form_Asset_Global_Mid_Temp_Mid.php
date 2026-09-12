<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
</head>
<?php
require "Connection.php";
require "FileFunction.php";

extract($_POST);
extract($_GET);

$gRin = fGlobalNEW("Kd_Aset","ta_pengadaan","IDT",$gIdT,"=","",DatabaseSB,$ConSB,"");
$gTmp = strtolower(fNmHuruf((int)substr($gRin,0,2)));

if ($TakeOff=="Ya")
{
	$gNOM = fGlobalNEW("Nomor","ta_pengadaan","IDT",$gIdT,"=","",DatabaseSB,$ConSB,"");
	if ($gNOM)
	{
		//Data Pengadaan
		$gTGL = fGlobalNEW("Tanggal","ta_pengadaan","IDT",$gIdT,"=","",DatabaseSB,$ConSB,"");
		$gNIL = fGlobalNEW("Nilai","ta_pengadaan","IDT",$gIdT,"=","",DatabaseSB,$ConSB,"");
		
		//Data Aset
		#$gReF = fGlobalNEW("Referensi","ta_kib_".strtolower($gTmp),"IDT",$gKeY,"=","",DatabaseSB,$ConSB,"");
		#$gUPB = fGlobalNEW("Kd_UPB","ta_kib_".strtolower($gTmp),"IDT",$gKeY,"=","",DatabaseSB,$ConSB,"");
		#$gKdA = fGlobalNEW("Kd_Aset","ta_kib_".strtolower($gTmp),"IDT",$gKeY,"=","",DatabaseSB,$ConSB,"");
		#$gNmA = fGlobalNEW("Nm_Aset","ta_kib_".strtolower($gTmp),"IDT",$gKeY,"=","",DatabaseSB,$ConSB,"");
		
		$gReF = fGlobalNEW("Referensi","ta_kib_108","IDT",$gKeY,"=","",DatabaseSB,$ConSB,"");
		$gUPB = fGlobalNEW("Kd_UPB","ta_kib_108","IDT",$gKeY,"=","",DatabaseSB,$ConSB,"");
		$gKdA = fGlobalNEW("Kd_Aset","ta_kib_108","IDT",$gKeY,"=","",DatabaseSB,$ConSB,"");
		$gNmA = fGlobalNEW("Nm_Aset","ta_kib_108","IDT",$gKeY,"=","",DatabaseSB,$ConSB,"");
		
		if (!$gNmA)
		{$gNmA= fGlobalNEW("Nm_Aset","ref_rek_aset5","Kd_Aset",$gKdA,"=","",DatabaseSB,$ConSB,"");}
		#$gReG = fGlobalNEW("No_Register","ta_kib_".strtolower($gTmp),"IDT",$gKeY,"=","",DatabaseSB,$ConSB,"");
		#$gUrA = fGlobalNEW("Keterangan","ta_kib_".strtolower($gTmp),"IDT",$gKeY,"=","",DatabaseSB,$ConSB,"");
		
		$gReG = fGlobalNEW("No_Register","ta_kib_108","IDT",$gKeY,"=","",DatabaseSB,$ConSB,"");
		$gUrA = fGlobalNEW("Keterangan","ta_kib_108","IDT",$gKeY,"=","",DatabaseSB,$ConSB,"");
		
		//Nilai Akhir
		$gNiA = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi",$gReF,"=","",DatabaseSB,$ConSB,"");
		$gNiA = $gNiA - fGlobalNEW("IfNull(sum(Kredit),0)","ta_kib_post_108","Referensi",$gReF,"=","",DatabaseSB,$ConSB,"");
		
		//$gCEK = fGlobalNEW("IDT","ta_kib_global_temp","No_Pengadaan",$gNOM,"=","",DatabaseSB,$ConSB,"");
		if ($rIDT)
		{
			$nSQ="UPDATE ta_kib_global_temp SET 
			No_Pengadaan='$gNOM',
			Tanggal='$gTGL',
			Nilai_Pengadaan='$gNIL',
			Kd_UPB='$gUPB',
			Ref_Aset='$gReF',
			Reg_Aset='$gReG',
			Kd_Aset='$gKdA',
			Nm_Aset='$gNmA', 
			Uraian='$gUrA', 
			Nil_Aset='$gNiA' WHERE IDT='".$rIDT."'";
			$nRs = mysql_query($nSQ) or die(mysql_error());
		}
		else
		{
			$nSQ="INSERT INTO ta_kib_global_temp SET 
			No_Pengadaan='$gNOM',
			Tanggal='$gTGL',
			Nilai_Pengadaan='$gNIL',
			Kd_UPB='$gUPB',
			Ref_Aset='$gReF',
			Reg_Aset='$gReG',
			Kd_Aset='$gKdA',
			Nm_Aset='$gNmA',
			Uraian='$gUrA',
			Nil_Aset='$gNiA'";
			$nRs = mysql_query($nSQ) or die(mysql_error());
		}
	}
	$URL = "Form_Asset_Global_Mid_Temp.php?gIdT=".$gIdT."&rIDT=".$rIDT."&IdL=".$IdL;
	?>
	<script language="JavaScript">  	
	this.window.open ('<?php echo $URL ?>','WinFormPNG_Mid')
	this.window.focus()
	this.window.document.clear()
	this.window.document.close() 
	this.setTimeout("self.close()",1)
	</script>
	<?php
}

?>
<body>
<table align="center" cellpadding="0" cellspacing="0" width="100%" height="200" border="0">
  <?php
	if ($fFind) 
	{
		$SyT = "AND (P1.Referensi LIKE '%$fFind%' OR P1.No_Register LIKE '%$fFind%' OR P1.Keterangan LIKE '%$fFind%' OR P2.Nm_Aset LIKE '%$fFind%')";
		$LmT = "";
	}
	else 
	{
		$SyT = "";
		$LmT = " LIMIT 0,100";
	}
	
	$iG=1;
	$nSQ = "SELECT P1.Referensi, P1.No_Register, P1.Kd_Aset, P2.Nm_Aset, P1.Keterangan, P1.IDT 
	FROM ta_kib_".$gTmp." P1 INNER JOIN ref_rek_aset5 P2 ON P2.Kd_Aset=P1.Kd_Aset 
	WHERE P1.Kd_UPB='".$gUpb."' AND P1.Kd_Aset='".$gRin."' ".$SyT." ORDER BY P1.Kd_Aset, P1.No_Register".$LmT;
	
	$nSQ = "SELECT P1.Referensi, P1.No_Register, P1.Kd_Aset, P2.Nm_Aset, P1.Keterangan, P1.IDT 
	FROM ta_kib_108 P1 INNER JOIN ref_rek_aset5 P2 ON P2.Kd_Aset=P1.Kd_Aset 
	WHERE P1.Kd_UPB='".$gUpb."' AND P1.Kd_Aset='".$gRin."' ".$SyT." ORDER BY P1.Kd_Aset, P1.No_Register".$LmT;
	//echo $nSQ;
	$nRs = mysql_query($nSQ);
	
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gKeY = $mRo[5];
		$mRf  = $mRo[0];
		$gBG  = fBackCLR($iG);
		if ($gCK!="") {$DeL="NoDell";} else {$DeL="";}
		$mJmL  = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB",$mRf.":".$gUpb,"=:=","",DatabaseSB,$ConSB,"");
		$mJmL  = $mJmL - fGlobalNEW("IfNull(sum(Kredit),0)","ta_kib_post_108","Referensi:Kd_UPB",$mRf.":".$gUpb,"=:=","",DatabaseSB,$ConSB,"");
		?>
		  <tr height="20"> 
			<td valign="top" class="ac" width="70" style="border-bottom:1px dotted #999999" <?=$gBG?>><?=$mRo[1]?></td>
			<td valign="top" class="al" width="100" style="text-align:justify; border-bottom:1px dotted #999999" <?=$gBG?>><?=$mRo[2]?></td>
			<td valign="top" class="al" style="text-align:justify; border-bottom:1px dotted #999999" <?=$gBG?>><?=$mRo[3]?></td>
			<td valign="top" class="al" width="100" style="text-align:right; border-bottom:1px dotted #999999; padding-right:10px" <?=$gBG?>><?=fConvertToRupiah($mJmL)?></td>
			<td valign="top" class="al" width="250" style="border-bottom:1px dotted #999999; padding-right:10px" <?=$gBG?>><?=$mRo[4]?></td>
			<td valign="top" class="ac" width="50" style="border-bottom:1px dotted #999999" <?=$gBG?>>
			<a href="<?="Form_Asset_Global_Mid_Temp_Mid.php?TakeOff=Ya&gKeY=".$gKeY."&gIdT=".$gIdT."&rIDT=".$rIDT."&IdL=".$IdL?>" title="<?=$mRf?>" class="ico use" target="_top">ADD</a>
			</td>
		  </tr>
		  <?php
		$iG++;
	}
	?>
  <tr> 
    <td colspan="5">&nbsp;</td>
  </tr>
</table>
</body>
</html>