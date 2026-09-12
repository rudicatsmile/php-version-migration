<?
require('Connection.php');
require('Connection_Simkada.php');
require('CheckLogin.php');
extract($_GET);
if ($crt=='rekn'){
	if ($IdT){
		$NmK = fGlobalNEW("nm_aset","ref_rek_aset5","kd_aset",$iD,"=","",DatabaseSB,$ConSB,"");
		$DtA = fGlobalNEW("referensi:kd_unit:tahun:kd_kegiatan","ta_rkpbmd_new_kegiatan","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
		if ($DtA){
			$DtA = explode(":",$DtA);
			$Ref = $DtA[0];
			$IdU = $DtA[1];
			$ThN = $DtA[2];
			$IdK = $DtA[3];
		}
		#$CeK = fGlobalNEW("IDT","ta_rkpbmd_new_rekening","Referensi:Kd_Kegiatan:Kd_Rekening",$Ref.":".$IdK.":".$iD,"=:=:=","",DatabaseSB,$ConSB,"");
		#if (!$CeK){
			$nSQ = "INSERT INTO ta_rkpbmd_new_rekening SET 
			Referensi='$Ref',
			Kd_Unit='$IdU',
			Tahun='$ThN',
			Kd_Kegiatan='$IdK',
			Kd_Rekening='$iD',
			Nm_Rekening='$NmK',
			Recorded=now(),
			Pencatat='$UID'";
			$nRs = mysql_query($nSQ);
		#}
	}
}
if ($crt=='kegi'){
	if ($IdT){
		//$NmK = fGlobalNEW("Nama_Kegiatan","kegiatan","Id_Kegiatan",$iD,"=","",DatabaseSA,$ConSA,"");
		$NmK = fGlobalNEW("nama_referensi","referensi_kegiatan","Id_referensi",$iD,"=","",DatabaseSA,$ConSA,"");
		
		$DtA = fGlobalNEW("referensi:kd_unit:tahun","ta_rkpbmd_new_program","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
		if ($DtA){
			$DtA = explode(":",$DtA);
			$Ref = $DtA[0];
			$IdU = $DtA[1];
			$ThN = $DtA[2];
		}
		
		$iD = $IdP.substr($iD,-3,3);
		
		$CeK = fGlobalNEW("IDT","ta_rkpbmd_new_kegiatan","Referensi:Kd_Kegiatan",$Ref.":".$iD,"=:=","",DatabaseSB,$ConSB,"");
		if (!$CeK){
			$nSQ = "INSERT INTO ta_rkpbmd_new_kegiatan SET 
			Referensi='$Ref',
			Kd_Unit='$IdU',
			Tahun='$ThN',
			Kd_Kegiatan='$iD',
			Nm_Kegiatan='$NmK',
			Recorded=now(),
			Pencatat='$UID'";
			$nRs = mysql_query($nSQ);
		}
	}
}
if ($crt=='prog'){
	if ($IdT){
		$NmP = fGlobalNEW("Nama_Program","program","Id_Program",$iD,"=","",DatabaseSA,$ConSA,"");
		$DtA = fGlobalNEW("referensi:kd_unit:tahun","ta_rkpbmd_new","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
		if ($DtA){
			$DtA = explode(":",$DtA);
			$Ref = $DtA[0];
			$IdU = $DtA[1];
			$ThN = $DtA[2];
		}
		$CeK = fGlobalNEW("IDT","ta_rkpbmd_new_program","Referensi:Kd_Program",$Ref.":".$iD,"=:=","",DatabaseSB,$ConSB,"");
		if (!$CeK){
			$nSQ = "INSERT INTO ta_rkpbmd_new_program SET 
			Referensi='$Ref',
			Kd_Unit='$IdU',
			Tahun='$ThN',
			Kd_Program='$iD',
			Nm_Program='$NmP',
			Recorded=now(),
			Pencatat='$UID'";
			$nRs = mysql_query($nSQ);
		}
	}
}
?>

<script languange="javascript">
	RefreshDATA('<?=$stLOCK?>','<?=$IdL?>');
</script>