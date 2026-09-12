<?php
require('Connection.php');
require('CheckLogin.php');
extract($_GET);
//require('Connection_SimRAL_'.$gTHN.'.php');

if ($crt=='rekn'){
	if ($IdT){
		$NmK = fGlobalNEW("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$iD,"=","",DatabaseSB,$ConSB,"");
		$DtA = fGlobalNEW("referensi:kd_unit:tahun:kd_sub_kegiatan:apbd","ta_rkbmd_new_kegiatan_sub","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
		if ($DtA){
			$DtA = explode(":",$DtA);
			$Ref = $DtA[0];
			$IdU = $DtA[1];
			$ThN = $DtA[2];
			$IdK = $DtA[3];
			$ApB = $DtA[4];
		}
		
		$Idd = fGlobalNEW("IDT","ta_rkbmd_new_rekening","Kd_Unit:Tahun:Apbd:Kd_Rekening",$IdU.":".$ThN.":".$ApB.":".$iD,"=:=:=:=","",DatabaseSB,$ConSB,"");
		if ($Idd!='')
		{
			#Ambil jumlah optimalisasi dari input paling awal
			$Opt = fGlobalNEW("Optimalisasi_Jumlah","ta_rkbmd_new_rekening","IDT",$Idd,"=","",DatabaseSB,$ConSB,"");
			$OpU = fGlobalNEW("Optimalisasi_Satuan","ta_rkbmd_new_rekening","IDT",$Idd,"=","",DatabaseSB,$ConSB,"");
			$Max = fGlobalNEW("Maksimum_Jumlah","ta_rkbmd_new_rekening","IDT",$Idd,"=","",DatabaseSB,$ConSB,"");
			$MaU = fGlobalNEW("Maksimum_Satuan","ta_rkbmd_new_rekening","IDT",$Idd,"=","",DatabaseSB,$ConSB,"");
		}
		else
		{
			#Hitung jumlah aset optimalisasi
			$Opt = fGlobalNEW("count(*)","ta_kib_108","Kd_UPB:Kd_Aset_108",$IdU."%:".$iD,"LIKE:=","",DatabaseSB,$ConSB,"");
			$OpU = "";
			$Max = fGlobalNEW("jumlah","ta_rkbmd_standar_kebutuhan_rinci","kd_unit:kd_aset:tahun",$IdU.":".$iD.":".$ThN,"=:=:=","",DatabaseSB,$ConSB,"");
			if ($Max==''){$Max=0;}
			$MaU = "";
		}
		
		$SQ="SELECT IfNull(sum(p2.jml_barang),0) 
		FROM ta_rkbmd_new_pmf_pmt_phs p1 
		LEFT JOIN ta_rkbmd_new_pmf_pmt_phs_rinci p2 ON p2.referensi=p1.referensi 
		WHERE p1.kd_unit = '".$IdU."' AND p1.tahun='".$ThN."' AND p2.kd_aset='".$iD."'";
		$rs = mysql_query($SQ); 
		$mR = mysql_fetch_array($rs);
		$PPP = $mR[0];
		$Opt= $Opt-$PPP;
		
		$nSQ = "INSERT INTO ta_rkbmd_new_rekening SET 
		Referensi='$Ref',
		Kd_Unit='$IdU',
		Tahun='$ThN',
		Apbd='$ApB',
		Kd_Kegiatan='".substr($IdK,0,12)."',
		Kd_Sub_Kegiatan='$IdK',
		Kd_Rekening='$iD',
		Nm_Rekening='$NmK',
		
		Optimalisasi_Jumlah='$Opt',
		Optimalisasi_Satuan='$OpU',
		
		Maksimum_Jumlah='$Max',
		Maksimum_Satuan='$MaU',
		
		Recorded=now(),
		Pencatat='$UID'";
		$nRs = mysql_query($nSQ);
	}
}

if ($crt=='subk'){
	if ($IdT){
		$DtA = fGlobalNEW("referensi:kd_unit:tahun:kd_kegiatan:apbd","ta_rkbmd_new_kegiatan","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
		if ($DtA){
			$DtA = explode(":",$DtA);
			$Ref = $DtA[0];
			$IdU = $DtA[1];
			$ThN = $DtA[2];
			$IdK = $DtA[3];
			$ApB = $DtA[4];
		}
		
		#$NmK = fGlobalNEW("nmSubKegiatan","ta_apbd_kegiatan_sub_skpd","kdUnit:idSubKegiatan",$IdU.":".$iD,"=:=","",DatabaseSB,$ConSB,"");
		$NmK = fGlobalNEW("Deskripsi","ref_keg_90_5","Kode",$iD,"=","",DatabaseSB,$ConSB,"");
				
		$CeK = fGlobalNEW("IDT","ta_rkbmd_new_kegiatan_sub","Referensi:Kd_Sub_Kegiatan:Tahun:Apbd",$Ref.":".$iD.":".$ThN.":".$ApB,"=:=:=:=","",DatabaseSB,$ConSB,"");
		if (!$CeK){
			$nSQ = "INSERT INTO ta_rkbmd_new_kegiatan_sub SET 
			Referensi='$Ref',
			Kd_Unit='$IdU',
			Tahun='$ThN',
			Apbd='$ApB',
			Kd_Program='".substr($IdK,0,7)."',
			Kd_Kegiatan='$IdK',
			Kd_Sub_Kegiatan='$iD',
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
		$DtA = fGlobalNEW("referensi:kd_unit:tahun:apbd","ta_rkbmd_new_program","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
		if ($DtA){
			$DtA = explode(":",$DtA);
			$Ref = $DtA[0];
			$IdU = $DtA[1];
			$ThN = $DtA[2];
			$ApB = $DtA[3];
		}
		
		#$nSQ = "SELECT nmKegiatan FROM ta_apbd_kegiatan_skpd WHERE kdUnit='".$IdU."' AND idKegiatan='".$iD."'";
		$nSQ = "SELECT Deskripsi FROM ref_keg_90_4 WHERE Kode='".$iD."'";
		$nRs = mysql_query($nSQ);
		$mRo = mysql_fetch_array($nRs);
		$NmK = $mRo[0];
		$kD  = $iD;
		
		$CeK = fGlobalNEW("IDT","ta_rkbmd_new_kegiatan","Referensi:Kd_Kegiatan:Tahun:Apbd",$Ref.":".$kD.":".$ThN.":".$ApB,"=:=:=:=","",DatabaseSB,$ConSB,"");
		if (!$CeK){
			$nSQ = "INSERT INTO ta_rkbmd_new_kegiatan SET 
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
		$DtA = fGlobalNEW("referensi:kd_unit:tahun:apbd","ta_rkbmd_new","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
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
		
		$CeK = fGlobalNEW("IDT","ta_rkbmd_new_program","Referensi:Kd_Program:Tahun:Apbd",$Ref.":".$kD.":".$ThN.":".$ApB,"=:=:=:=","",DatabaseSB,$ConSB,"");
		if (!$CeK){
			$nSQ = "INSERT INTO ta_rkbmd_new_program SET 
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