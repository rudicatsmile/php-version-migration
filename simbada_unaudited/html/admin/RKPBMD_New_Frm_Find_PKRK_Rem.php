<?
require('Connection.php');
extract($_GET);
if ($rIdT){
	if ($crt=='prog'){
		$DtA = fGlobalNEW("Kd_Program:Referensi:Tahun:Apbd","ta_rkpbmd_new_program","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		$DtA = explode(':',$DtA);
		$IdP = $DtA[0];
		$Ref = $DtA[1];
		$Thn = $DtA[2];
		$Apb = $DtA[3];
		
		#kegiatan
		$nSQ = "DELETE FROM ta_rkpbmd_new_kegiatan WHERE Referensi = '$Ref' AND Kd_Kegiatan LIKE '$IdP%' AND Tahun='$Thn' AND Apbd='$Apb'";
		$nRs = mysql_query($nSQ);
		
		#sub kegiatan
		$nSQ = "DELETE FROM ta_rkpbmd_new_kegiatan_sub WHERE Referensi = '$Ref' AND Kd_Kegiatan LIKE '$IdP%' AND Tahun='$Thn' AND Apbd='$Apb'";
		$nRs = mysql_query($nSQ);
		
		#detail rekening
		$nSQ = "DELETE FROM ta_rkpbmd_new_rekening_detail Referensi = '$Ref' AND Kd_Kegiatan LIKE '$IdP%' AND Tahun='$Thn' AND Apbd='$Apb'";
		$nRs = mysql_query($nSQ);
		
		#rekening
		$nSQ = "DELETE FROM ta_rkpbmd_new_rekening WHERE Referensi  = '$Ref' AND Kd_Kegiatan LIKE '$IdP%' AND Tahun='$Thn' AND Apbd='$Apb'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_rkpbmd_new_program WHERE IDT='$rIdT'";
		$nRs = mysql_query($nSQ);
	}
	
	if ($crt=='kegi'){
		$DtA = fGlobalNEW("Kd_Kegiatan:Referensi:Tahun:Apbd","ta_rkpbmd_new_kegiatan","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		$DtA = explode(':',$DtA);
		$IdK = $DtA[0];
		$Ref = $DtA[1];
		$Thn = $DtA[2];
		$Apb = $DtA[3];
		
		#sub kegiatan
		$nSQ = "DELETE FROM ta_rkpbmd_new_kegiatan_sub WHERE Referensi = '$Ref' AND Kd_Kegiatan = '$IdK' AND Tahun='$Thn' AND Apbd='$Apb'";
		$nRs = mysql_query($nSQ);
		
		#detail rekening
		$nSQ = "DELETE FROM ta_rkpbmd_new_rekening_detail Referensi = '$Ref' AND Kd_Kegiatan = '$IdK' AND Tahun='$Thn' AND Apbd='$Apb'";
		$nRs = mysql_query($nSQ);
		
		#rekening
		$nSQ = "DELETE FROM ta_rkpbmd_new_rekening WHERE  Referensi = '$Ref' AND Kd_Kegiatan = '$IdK' AND Tahun='$Thn' AND Apbd='$Apb'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_rkpbmd_new_kegiatan WHERE IDT='$rIdT'";
		$nRs = mysql_query($nSQ);
	}
	
	if ($crt=='subk'){
		$DtA = fGlobalNEW("Kd_Sub_Kegiatan:Referensi:Tahun:Apbd","ta_rkpbmd_new_kegiatan_sub","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		$DtA = explode(':',$DtA);
		$IdK = $DtA[0];
		$Ref = $DtA[1];
		$Thn = $DtA[2];
		$Apb = $DtA[3];
		
		#detail rekening
		$nSQ = "DELETE FROM ta_rkpbmd_new_rekening_detail Referensi = '$Ref' AND Kd_Sub_Kegiatan = '$IdK' AND Tahun='$Thn' AND Apbd='$Apb'";
		$nRs = mysql_query($nSQ);
		
		#rekening
		$nSQ = "DELETE FROM ta_rkpbmd_new_rekening WHERE Referensi = '$Ref' AND Kd_Sub_Kegiatan = '$IdK' AND Tahun='$Thn' AND Apbd='$Apb'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_rkpbmd_new_kegiatan_sub WHERE IDT='$rIdT'";
		$nRs = mysql_query($nSQ);
	}
	
	if ($crt=='rekn')
	{
		$DtA = fGlobalNEW("Kd_Sub_Kegiatan:Referensi:Tahun:Apbd:Kd_Rekening:Kd_Unit","ta_rkpbmd_new_rekening","IDT",$rIdT,"=","",DatabaseSB,$ConSB,"");
		$DtA = explode(':',$DtA);
		$IdK = $DtA[0];
		$ReF = $DtA[1];
		$ThN = $DtA[2];
		$ApB = $DtA[3];
		$ReK = $DtA[4];
		$KdU = $DtA[5];
		
		$nSQ = "DELETE FROM ta_rkpbmd_new_rekening_detail WHERE Referensi='".$ReF."' AND Kd_Unit='".$KdU."' AND Tahun='".$ThN."' 
		AND Apbd='".$ApB."' AND Kd_Sub_Kegiatan='".$IdK."' AND Kd_Rekening='".$ReK."'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_rkpbmd_new_rekening WHERE IDT='$rIdT'";
		$nRs = mysql_query($nSQ);
	}
}
?>
<script languange="javascript">
	RefreshDATA('<?=$stLOCK?>','<?=$IdL?>');
</script>