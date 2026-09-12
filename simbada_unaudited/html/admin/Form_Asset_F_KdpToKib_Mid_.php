<?
require "Connection.php";
require "FileFunction.php";

extract($_POST);
extract($_GET);

if ($Simpan=="Proses")
{
	$rReF = fGlobalNEW("Referensi","ta_kib_f_to_aset","IDT",$IDT,"=","",DatabaseSB,$ConSB,"");
	$gTTL = 0;
	$tTGL = date('Y')."-"."12-31";
	$gKTR = "";
	$gKTR2= "";
	$gNma = "";
	$gLKS = "";
	
	$gPJG = 0;
	$gLBR = 0;
	$gLUA = 0;
	$gTglD= "0000-00-00";
	$gNoD = "";
	$iGG  = 1;
	
	$SQL = "SELECT P3.Tg_Berita_Acara as A0, 
	P3.CritBayar as A1, 
	P3.Uraian as A2, 
	P3.No_Berita_Acara as A3, 
	P3.Tg_Berita_Acara as A4, 
	P1.Nilai_KDP as A5, 
	P4.Panjang as A6, 
	P4.Lebar as A7, 
	P4.Luas as A8, 
	P4.Lokasi as A9,
	P4.Dokumen_Tanggal as A10,
	P4.Dokumen_Nomor as A11,
	P4.Keterangan as A12,
	P4.Nm_Aset as A13,
	P4.Tgl_Perolehan as A14 
	FROM ta_kib_f_to_aset_rinci P1 
	LEFT JOIN ta_pengadaan P2 ON P2.Nomor=P1.No_Pengadaan 
	LEFT JOIN ta_penerimaan_berkas P3 ON P3.Nomor=P2.No_Berkas 
	LEFT JOIN ta_kib_108 P4 ON P4.Referensi=P1.Ref_KDP 
	WHERE P1.Referensi='$rReF' ORDER BY P2.Tanggal";
	$nRs = mysql_query($SQL) or die(mysql_error());
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$tTGL  = $mRo[0];
		if ($iGG==1){
			$gTglD = $mRo[10];
		}
		
		if ($tTGL==''){
			$tTGL  = $mRo[14];
		}
		
		if ($gNoD!=""){
			$gNoD.= "; ".$mRo[11];
		}
		else{
			$gNoD = $mRo[11];
		}
		$gTTL = $gTTL + $mRo[5];
		
		if ($gKTR=="") {
			$gKTR = "Pembayaran: ".$mRo[1].", No.BAST: ".$mRo[3].", Tanggal ".fConvertDateLongsBln($mRo[4]).", Pekerjaan :".$mRo[2];
		} else {
			$gKTR.= "<br>"."Pembayaran: ".$mRo[1].", No.BAST: ".$mRo[3].", Tanggal ".fConvertDateLongsBln($mRo[4]).", Pekerjaan :".$mRo[2];
		}
		
		if ($gKTR2=="") 
		{
			$gKTR2 = $mRo[12];
		}
		else{
			$gKTR2.= "; ".$mRo[12];
		}
		
		if ($gNma=="") 
		{
			$gNma = $mRo[13];
		}
		else{
			$gNma.= "; ".$mRo[13];
		}
		
		if ($gLKS!=""){
			$gLKS.= "; ".$mRo[9];
		}
		else{
			$gLKS = $mRo[9];
		}

		$gPJG = $gPJG + $mRo[6];
		$gLBR = $gLBR + $mRo[7];
		$gLUA = $gLUA + $mRo[8];
		
		$iGG++;
	}
	
	$gKTR.= "; [ ".$gKTR2." ]";
	
	if ($gTTL==0){
		$gTTL = fGlobalNEW("IfNull(sum(Nilai_KDP),0)","ta_kib_f_to_aset_rinci","Referensi",$rReF,"=","",DatabaseSB,$ConSB,"");
	}
	$gUpb = fGlobalNEW("Kd_UPB","ta_kib_f_to_aset","IDT",$IDT,"=","",DatabaseSB,$ConSB,"");
	$gRin = fGlobalNEW("Kd_Aset","ta_kib_f_to_aset","IDT",$IDT,"=","",DatabaseSB,$ConSB,"");
	#$gMSM = fGlobalNEW("Ms_Manfaat","ref_rek_aset3","Kd_Aset",substr($gRin,0,8),"=","",DatabaseSB,$ConSB,"");
	
	$rCR = (int)substr($gRin,0,2);
	$nTBL= fNmHuruf($rCR);
	
	//Make Register
	$nSQL = "SELECT IFNULL(max(No_Register),0) AS LasReG FROM ta_kib_108 WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
	
	$nRst = mysql_query($nSQL) or die(mysql_error());
	$nRow = mysql_fetch_assoc($nRst);
	$NewG = $nRow['LasReG'];
	$LastReG = ((int)$NewG) + 1;
	$NewReGAset = fMakeRegister($LastReG,7);
	
	if ($nTBL=="c"){
		$NewRefGrp = "";
		$gTKT = "";
		$gBTN = "";
		$gKTR = $gKTR;
		$gTgl = $tTGL;
		$gTglD= $gTglD;
		$gNoD = $gNoD;
		$gLti = 0;
		$gSTT = "";
		$gLKS = $gLKS;
		$gMLK = "12";
		$gKND = "B";
		$gAUS = "APBD";
		#$gMSM = $gMSM;
		$gHRG = $gTTL;
		$gPCT = "KDPtoAset";
		
		#sementara konversi ke rek 108
		$gRin = fGlobal("kd_aset108","ref_rek_aset5_maping","kd_aset17",$gRin,"=","","");
		$gMSM = fGlobalNEW("Ms_Manfaat","ref_rek_aset108_7","Kd_Aset",$gRin,"=","",DatabaseSB,$ConSB,"");
		
		require "Insert_KIB_C.php";
		$rIDT = fGlobal("IDT","ta_kib_108","Referensi:Kd_UPB",$NewRefKIB.":".$gUpb,"=:=","","");
	}
	
	if ($nTBL=="d"){
		$NewRefGrp = "";
		
		$gKNS = "";	#Konstruksi
		$gPJG = $gPJG; 	#Panjang
		$gLBR = $gLBR;	#Lebar
		$gLUA = $gLUA;	#Luas
		
		$gTglM = "0000-00-00";	#Tgl_Mutasi
		$gTglD = $gTglD;	#Dokumen_Tanggal
	
		$gTKT = "";
		$gBTN = "";
		$gKTR = $gKTR;
		$gTgl = $tTGL;
		$gNoD = $gNoD;
		
		$gSTT = "";
		$gLKS = $gLKS;
		$gMLK = "12";
		$gKND = "B";
		$gAUS = "APBD";
		#$gMSM = $gMSM;
		$gHRG = $gTTL;
		$gPCT = "KDPtoAset108";
		
		#sementara konversi ke rek 108
		$gRin = fGlobal("kd_aset108","ref_rek_aset5_maping","kd_aset17",$gRin,"=","","");
		$gMSM = fGlobalNEW("Ms_Manfaat","ref_rek_aset108_7","Kd_Aset",$gRin,"=","",DatabaseSB,$ConSB,"");
		
		require "Insert_KIB_D.php";
		$rIDT = fGlobal("IDT","ta_kib_108","Referensi:Kd_UPB",$NewRefKIB.":".$gUpb,"=:=","","");
	}
	
	if ($CrtKDP=="DellYA")
	{
		$nSQ= "SELECT Ref_KDP, Kd_UPB FROM ta_kib_f_to_aset_rinci WHERE Referensi='$rReF' ORDER BY Ref_KDP";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$SQ="UPDATE ta_kib_108 SET KdpToAset='Y' WHERE Referensi='".$mRo[0]."' AND Kd_UPB='".$mRo[1]."'";
			$Rs = mysql_query($SQ) or die(mysql_error());
		}
	}
}
?>
<script language="JavaScript">  	
this.setTimeout("self.close()",1)
</script>
