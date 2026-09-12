<?php
require('Connection.php');
require('CheckLogin.php');
extract($_GET);
if ($crt=='rekn')
{
	if ($IdT)
	{
		$NmK = fGlobalNEW("nm_aset","ref_rek_aset108_7","kd_aset",$iD,"=","",DatabaseSB,$ConSB,"");
		$DtA = fGlobalNEW("referensi:kd_unit:tahun:kd_sub_kegiatan:Apbd","ta_rkpbmd_new_kegiatan_sub","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
		if ($DtA)
		{
			$DtA = explode(":",$DtA);
			$Ref = $DtA[0];
			$IdU = $DtA[1];
			$ThN = $DtA[2];
			$IdK = $DtA[3];
			$ApB = $DtA[4];
		}
		
		$cEK = fGlobalNEW("IDT","ta_rkpbmd_new_rekening","Referensi:Kd_Unit:Kd_Sub_Kegiatan:Kd_Rekening:Tahun:Apbd",$Ref.":".$IdU.":".$IdK.":".$iD.":".$ThN.":".$ApB,"=:=:=:=:=:=","",DatabaseSB,$ConSB,"");
		if (!$cEK)
		{
			$JmL = fGlobalNEW("count(*)","ta_kib_108","Kd_UPB:Kd_Aset_108",$IdU."%:".$iD,"LIKE:=","",DatabaseSB,$ConSB,"");
			
			$SQ="SELECT IfNull(sum(p2.jml_barang),0) 
			FROM ta_rkbmd_new_pmf_pmt_phs p1 
			LEFT JOIN ta_rkbmd_new_pmf_pmt_phs_rinci p2 ON p2.referensi=p1.referensi 
			WHERE p1.kd_unit = '".$IdU."' AND p1.tahun='".$ThN."' AND p2.kd_aset='".$iD."'";
			$rs = mysql_query($SQ); 
			$mR = mysql_fetch_array($rs);
			$PPP = $mR[0];
			$JmL = $JmL-$PPP;
			
			$nSQ = "INSERT INTO ta_rkpbmd_new_rekening SET 
			Referensi='$Ref',
			Kd_Unit='$IdU',
			Tahun='$ThN',
			Apbd='$ApB',
			Kd_Kegiatan='".substr($IdK,0,12)."',
			Kd_Sub_Kegiatan='$IdK',
			Kd_Rekening='$iD',
			Nm_Rekening='$NmK',
			Usulan_Jumlah='".$JmL."',
			Recorded=now(),
			Pencatat='$UID'";
			$nRs = mysql_query($nSQ);
			
			if ($JmL!=0)
			{
				$nSQ = "SELECT Referensi, No_Register FROM ta_kib_108 WHERE Kd_UPB LIKE '".$IdU."%' AND Kd_Aset_108='".$iD."' ORDER BY referensi";
				$nRs = mysql_query($nSQ);
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$SQ = "INSERT INTO ta_rkpbmd_new_rekening_detail SET 
					Referensi='".$Ref."',
					Kd_Unit='".$IdU."',
					Tahun='".$ThN."',
					Apbd='".$ApB."',
					Kd_Kegiatan='".substr($IdK,0,12)."',
					Kd_Sub_Kegiatan='".$IdK."',
					Kd_Rekening='".$iD."',
					Ref_Aset='".$mRo[0]."',
					No_Register='".$mRo[1]."',
					Gunakan='N'";
					$rs = mysql_query($SQ);
				}
			}
		}
	}
}
if ($crt=='subk'){
	if ($IdT)
	{
		$DtA = fGlobalNEW("referensi:kd_unit:tahun:apbd","ta_rkpbmd_new_kegiatan","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
		if ($DtA){
			$DtA = explode(":",$DtA);
			$Ref = $DtA[0];
			$IdU = $DtA[1];
			$ThN = $DtA[2];
			$ApB = $DtA[3];
		}
		
		#$NmK = fGlobalNEW("nmSubKegiatan","ta_apbd_kegiatan_sub_skpd","kdUnit:idSubKegiatan",$IdU.":".$iD,"=:=","",DatabaseSB,$ConSB,"");
		#$nSQ = "SELECT nmSubKegiatan FROM ta_apbd_kegiatan_sub_skpd WHERE kdUnit='".$IdU."' AND idSubKegiatan='".$iD."'";
		#$nRs = mysql_query($nSQ);
		#$mRo = mysql_fetch_array($nRs);
		#$NmK = $mRo[0];
		
		$NmK = fGlobalNEW("Deskripsi","ref_keg_90_5","Kode",$iD,"=","",DatabaseSB,$ConSB,"");
		
		$kD  = $iD;
		
		$CeK = fGlobalNEW("IDT","ta_rkpbmd_new_kegiatan_sub","Referensi:Kd_Sub_Kegiatan:Tahun:Apbd",$Ref.":".$kD.":".$ThN.":".$ApB,"=:=:=:=","",DatabaseSB,$ConSB,"");
		if (!$CeK){
			$nSQ = "INSERT INTO ta_rkpbmd_new_kegiatan_sub SET 
			Referensi='$Ref',
			Kd_Unit='$IdU',
			Tahun='$ThN',
			Apbd='$ApB',
			Kd_Program='".substr($kD,0,7)."',
			Kd_Kegiatan='".substr($kD,0,12)."',
			Kd_Sub_Kegiatan='$kD',
			Nm_Sub_Kegiatan='$NmK',
			Recorded=now(),
			Pencatat='$UID'";
			$nRs = mysql_query($nSQ);
		}
	}
}

if ($crt=='kegi'){
	if ($IdT)
	{
		$DtA = fGlobalNEW("referensi:kd_unit:tahun:apbd","ta_rkpbmd_new_program","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
		if ($DtA){
			$DtA = explode(":",$DtA);
			$Ref = $DtA[0];
			$IdU = $DtA[1];
			$ThN = $DtA[2];
			$ApB = $DtA[3];
		}
		
		#$nSQ = "SELECT Deskripsi FROM ref_keg_90_4 WHERE Kode='".$iD."'";
		#$nSQ = "SELECT nmKegiatan FROM ta_apbd_kegiatan_skpd WHERE kdUnit='".$IdU."' AND idKegiatan='".$iD."'";
		$nSQ = "SELECT Deskripsi FROM ref_keg_90_4 WHERE Kode='".$iD."'";
		$nRs = mysql_query($nSQ);
		$mRo = mysql_fetch_array($nRs);
		$NmK = $mRo[0];
		$kD  = $iD;
		
		$CeK = fGlobalNEW("IDT","ta_rkpbmd_new_kegiatan","Referensi:Kd_Kegiatan:Tahun:Apbd",$Ref.":".$kD.":".$ThN.":".$ApB,"=:=:=:=","",DatabaseSB,$ConSB,"");
		if (!$CeK){
			$nSQ = "INSERT INTO ta_rkpbmd_new_kegiatan SET 
			Referensi='$Ref',
			Kd_Unit='$IdU',
			Tahun='$ThN',
			Apbd='$ApB',
			Kd_Kegiatan='$kD',
			Nm_Kegiatan='$NmK',
			Recorded=now(),
			Pencatat='$UID'";
			$nRs = mysql_query($nSQ);
		}
	}
}

if ($crt=='prog'){
	if ($IdT)
	{
		$DtA = fGlobalNEW("referensi:kd_unit:tahun:apbd","ta_rkpbmd_new","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
		if ($DtA){
			$DtA = explode(":",$DtA);
			$Ref = $DtA[0];
			$IdU = $DtA[1];
			$ThN = $DtA[2];
			$ApB = $DtA[3];
		}
		
		#$nSQ = "SELECT nmProgram FROM ta_apbd_program_skpd WHERE kdUnit='".$IdU."' AND idProgram='".$iD."'";
		$nSQ = "SELECT Deskripsi FROM ref_keg_90_3 WHERE Kode='".$iD."'";
		$nRs = mysql_query($nSQ);
		$mRo = mysql_fetch_array($nRs);
		$NmP = $mRo[0];
		$kD  = $iD;
		
		$CeK = fGlobalNEW("IDT","ta_rkpbmd_new_program","Referensi:Kd_Program:Tahun:Apbd",$Ref.":".$kD.":".$ThN.":".$ApB,"=:=:=:=","",DatabaseSB,$ConSB,"");
		if (!$CeK){
			$nSQ = "INSERT INTO ta_rkpbmd_new_program SET 
			Referensi='$Ref',
			Kd_Unit='$IdU',
			Tahun='$ThN',
			Apbd='$ApB',
			Kd_Program='$kD',
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