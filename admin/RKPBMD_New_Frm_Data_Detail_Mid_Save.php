<?php
require('Connection.php');
extract($_GET);
$fld = str_replace('**',' ',$fld);
if ($IdR)
{
	if ($crt=='gunakan')
	{
		$CeK = fGlobal("Gunakan","ta_rkpbmd_new_rekening_detail","IDT",$IdR,"=","","");
		if ($CeK=='N')
		{
			$nSQ = "UPDATE ta_rkpbmd_new_rekening_detail SET Gunakan='Y' WHERE IDT = '$IdR'";
			$nRs = mysql_query($nSQ);
		}
		else
		{
			$nSQ = "UPDATE ta_rkpbmd_new_rekening_detail SET Gunakan='N' WHERE IDT = '$IdR'";
			$nRs = mysql_query($nSQ);
		}
		#echo $nSQ;
		
		$DtA = fGlobalNEW("Kd_Sub_Kegiatan:Referensi:Tahun:Apbd:Kd_Rekening:Kd_Unit","ta_rkpbmd_new_rekening","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
		$DtA = explode(':',$DtA);
		$IdK = $DtA[0];
		$ReF = $DtA[1];
		$ThN = $DtA[2];
		$ApB = $DtA[3];
		$ReK = $DtA[4];
		$KdU = $DtA[5];
		
		$nSQ ="SELECT COUNT(*) FROM ta_rkpbmd_new_rekening_detail 
		WHERE Referensi='".$ReF."' AND Kd_Unit='".$KdU."' AND Tahun='".$ThN."' 
		AND Apbd='".$ApB."' AND Kd_Sub_Kegiatan='".$IdK."' AND Kd_Rekening='".$ReK."' AND Gunakan='Y'";
		$nRs = mysql_query($nSQ);
		
		$New = fGlobal("count(*)","ta_rkpbmd_new_rekening_detail","Referensi:Kd_Unit:Tahun:Apbd:Kd_Sub_Kegiatan:Kd_Rekening:Gunakan",$ReF.":".$KdU.":".$ThN.":".$ApB.":".$IdK.":".$ReK.":Y","=:=:=:=:=:=:=","","");
		
		$nSQ = "UPDATE ta_rkpbmd_new_rekening SET UsulanKebthan_Jumlah='$New' WHERE IDT = '$IdT'";
		$nRs = mysql_query($nSQ);
	}
	else
	{
		$nSQ = "UPDATE ta_rkpbmd_new_rekening_detail SET $crt='".$fld."' WHERE IDT = '$IdR'";
		$nRs = mysql_query($nSQ);
	}
}

?>

<script languange="javascript">
//alert('berhasil');
//formDetail('refr','<?=$stLOCK?>','<?=$IdT?>','<?=$IdL?>');
</script>