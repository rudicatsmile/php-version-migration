<?
require('Connection.php');
extract($_GET);
if ($rIdT){
	if ($crt=='prog'){
		$DtA = fGlobalNEW("Kd_Program:Referensi:Tahun:Apbd","ta_rkbmd_new_program","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		$DtA = explode(':',$DtA);
		$IdP = $DtA[0];
		$Ref = $DtA[1];
		$Thn = $DtA[2];
		$Apb = $DtA[3];
		
		#if (substr($IdP,0,3)=='000'){
		#	$IdP = "___.".substr($IdP,-2,2);
		#}
		
		#kegiatan
		$nSQ = "DELETE FROM ta_rkbmd_new_kegiatan WHERE Referensi = '$Ref' AND Kd_Kegiatan LIKE '$IdP%' AND Tahun='$Thn' AND Apbd='$Apb'";
		$nRs = mysql_query($nSQ);
		
		#kegiatan
		$nSQ = "DELETE FROM ta_rkbmd_new_kegiatan_sub WHERE Referensi = '$Ref' AND Kd_Sub_Kegiatan LIKE '$IdP%' AND Tahun='$Thn' AND Apbd='$Apb'";
		$nRs = mysql_query($nSQ);
		
		#rekening
		$nSQ = "DELETE FROM ta_rkbmd_new_rekening WHERE Referensi = '$Ref' AND Kd_Kegiatan LIKE '$IdP%' AND Tahun='$Thn' AND Apbd='$Apb'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_rkbmd_new_program WHERE IDT='$rIdT'";
		$nRs = mysql_query($nSQ);
	}
	
	if ($crt=='kegi'){
		$DtA = fGlobalNEW("Kd_Kegiatan:Referensi:Tahun:Apbd","ta_rkbmd_new_kegiatan","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		$DtA = explode(':',$DtA);
		$IdK = $DtA[0];
		$Ref = $DtA[1];
		$Thn = $DtA[2];
		$Apb = $DtA[3];
		
		#sub kegiatan
		$nSQ = "DELETE FROM ta_rkbmd_new_kegiatan_sub WHERE Referensi = '$Ref' AND Kd_Kegiatan = '$IdK' AND Tahun='$Thn' AND Apbd='$Apb'";
		$nRs = mysql_query($nSQ);
		
		#rekening
		$nSQ = "DELETE FROM ta_rkbmd_new_rekening WHERE Referensi = '$Ref' AND Kd_Kegiatan = '$IdK' AND Tahun='$Thn' AND Apbd='$Apb'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_rkbmd_new_kegiatan WHERE IDT='$rIdT'";
		$nRs = mysql_query($nSQ);
	}
	
	if ($crt=='subk'){
		$DtA = fGlobalNEW("Kd_Sub_Kegiatan:Referensi:Tahun:Apbd","ta_rkbmd_new_kegiatan_sub","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		$DtA = explode(':',$DtA);
		$IdK = $DtA[0];
		$Ref = $DtA[1];
		$Thn = $DtA[2];
		$Apb = $DtA[3];
		
		#rekening
		$nSQ = "DELETE FROM ta_rkbmd_new_rekening WHERE Referensi = '$Ref' AND Kd_Sub_Kegiatan = '$IdK' AND Tahun='$Thn' AND Apbd='$Apb'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_rkbmd_new_kegiatan_sub WHERE IDT='$rIdT'";
		$nRs = mysql_query($nSQ);
	}
	
	if ($crt=='rekn'){
		$nSQ = "DELETE FROM ta_rkbmd_new_rekening WHERE IDT='$rIdT'";
		$nRs = mysql_query($nSQ);
	}
}
?>

<script languange="javascript">
	RefreshDATA('<?=$stLOCK?>','<?=$IdL?>');
</script>