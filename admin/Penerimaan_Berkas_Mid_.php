<?php
require('Connection.php');
require('Connection_Simkada.php');
require('FileFunction.php');

extract($_POST);
extract($_GET);

$fTRMt  = $fTRMt ?? '';
$fKe    = $fKe ?? 0;
$fPOS   = $fPOS ?? '';
$gUnt   = $gUnt ?? '';
$gIdT   = $gIdT ?? '';
$fNOM2  = $fNOM2 ?? '';
$fRK    = $fRK ?? '';
$fKG    = $fKG ?? '';
$fSB    = $fSB ?? '';
$fRP    = $fRP ?? '';
$fUT    = $fUT ?? '';
$fPer   = $fPer ?? '';
$fApb   = $fApb ?? '';
$fDN    = $fDN ?? '';
$IdL    = $IdL ?? ($_GET['IdL'] ?? '');
$Simpan = $Simpan ?? '';

if ($fTRMt=="Termin")
{
	$gKe = $fKe;
	if ($gKe==0) {$gKe=1;}
}
else
{
	$gKe = 0;
}


if ($fTRMt=="Pelunasan")
{
	$gCK = fGlobalNEW("CritBayar_PostingKe","ta_penerimaan_berkas","No_Kontrak:Kd_Rek13:Kd_Kegiatan:IDT",$fNOM2.":".$fRK.":".$fKG.":".$gIdT,"=:=:=:<>","IDT DESC LIMIT 0,1",DatabaseSB,$ConSB,"");
	if ($gCK) {$gPOS = $gCK;}
	else {$gPOS = $fPOS;}
}
else
{
	$gPOS = "KDP";
}

$fTRM = 100;

$mUnt = fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",$gUnt,"=","",DatabaseSB,$ConSB,"");
$mSKD = fGlobalNEW("Kd_Unit_Link","ref_unit","Kd_Unit",$gUnt,"=","",DatabaseSB,$ConSB,"");
$nSKD = fGlobalNEW("Nm_Unit_Link","ref_unit","Kd_Unit",$gUnt,"=","",DatabaseSB,$ConSB,"");

$nTHN = $fPer;
$nAGG = $fApb;

$gPCT = fGlobalNEW("User_ID","ta_user_log","IDT",$IdL,"=","",DatabaseSB,$ConSB,"");
$gTGL = $fThn."-".substr("00".$fBln,-2,2)."-".substr("00".$fHri,-2,2);
$gTGLB= $fThnB."-".substr("00".$fBlnB,-2,2)."-".substr("00".$fHriB,-2,2);
$gTGLK= $fThnK."-".substr("00".$fBlnK,-2,2)."-".substr("00".$fHriK,-2,2);
$fNIL = fConvertToNumeric($fNIL);
if ($Simpan=="Save")
{
	$gPR = fGlobalNEW("nmProgram","ta_apbd_program_skpd","kdUnit:idProgram:periode:apbd",$gUnt.":".$fPR.":".$nTHN.":".$nAGG,"=:=:=:=","",DatabaseSB,$ConSB,"");
	$gKG = fGlobalNEW("nmKegiatan","ta_apbd_kegiatan_skpd","kdUnit:idKegiatan:periode:apbd",$gUnt.":".$fKG.":".$nTHN.":".$nAGG,"=:=:=:=","",DatabaseSB,$ConSB,"");
	$gSB = fGlobalNEW("nmSubKegiatan","ta_apbd_kegiatan_sub_skpd","kdUnit:idSubKegiatan:periode:apbd",$gUnt.":".$fSB.":".$nTHN.":".$nAGG,"=:=:=:=","",DatabaseSB,$ConSB,"");
	$gRK = fGlobalNEW("nmRekening","ta_apbd_rekening_skpd","kdUnit:idSubKegiatan:kdRekening:periode:apbd",$gUnt.":".$fSB.":".$fRK.":".$nTHN.":".$nAGG,"=:=:=:=:=","",DatabaseSB,$ConSB,"");
	$gRP = fGlobalNEW("nmSubUnit","ta_apbd_rekening_skpd","idSubUnit",$fRP,"=","nmSubUnit LIMIT 0,1",DatabaseSB,$ConSB,"");
	
	$fAgg = fConvertToNumeric($fAgg);
	
	if ($gRP!='')
	{
		$gVaL = fGlobalNEW("IfNull(sum(Nilai),0)","ta_penerimaan_berkas","Kd_Unit:Kd_Rek13:Kd_SubKegiatan:Periode:Kd_Peruntukan",$gUnt.":".$fRK.":".$fSB.":".$nTHN.":".$gRP,"=:=:=:=:=","",DatabaseSB,$ConSB,"");
	}
	else
	{
		$gVaL = fGlobalNEW("IfNull(sum(Nilai),0)","ta_penerimaan_berkas","Kd_Unit:Kd_Rek13:Kd_SubKegiatan:Periode",$gUnt.":".$fRK.":".$fSB.":".$nTHN,"=:=:=:=","",DatabaseSB,$ConSB,"");
	}
	if ($fUR=="") {$fUR = $fKG." : ".$gKG."; ".$fRK." : ".$gRK;}
	
	if ($gIdT)
	{
		if ($fNIL<=0)
		{
			$fNIL = 0;
		}
		else
		{
			if ($gUnt=="25.08.07.02")
			{
				#Khusus RSUD no plafon
				$fNIL=$fNIL;
			}
			else
			{
				$gOlD = fGlobalNEW("Nilai","ta_penerimaan_berkas","IDT",$gIdT,"=","",DatabaseSB,$ConSB,"");
				
				$gSIS = $fAgg - ($gVaL-$gOlD);
				if ($fNIL <= $gSIS) 
				{
					$fNIL=$fNIL;
				}
				else 
				{
					$fNIL=$gOlD;
				}
			
				#if ($gPCT=='creatorXXX')
				#{
				#	echo "gOlD ".$gOlD."<br>";
				#	echo "fAgg ".$fAgg."<br>";
				#	echo "gVaL".$gVaL."<br>";
				#	echo "gSIS".$gSIS."<br>";
				#	echo "fNIL ".$fNIL;
				#	return false;
				#}
			}
		}
		
		CallConnection(DatabaseSB,$ConSB);
		
		$NoB  = fGlobalNEW("Nomor","ta_penerimaan_berkas","IDT",$gIdT,"=","",DatabaseSB,$ConSB,"");
		$eCek = fGlobalNEW("IDT","ta_pengadaan","No_Berkas",$NoB,"=","",DatabaseSB,$ConSB,"");
		
		$TP = "";
		if ($eCek=='')
		{
			$TP = "CritBayar_PostingKe='$gPOS',";
		}
		
		
		#No_Berita_Acara='$fNOM3', 
		#Tg_Berita_Acara='$gTGLB', 
		#CritBayar='$fTRMt',
		#CritBayar_Termin='$gKe',
		#CritBayar_MultiYears='$fMLT', $TP 
		
		$SQL = "UPDATE ta_penerimaan_berkas SET 
		NomorNew='$fNOMN', 
		Tanggal='$gTGL', 
		Kd_Peruntukan='$fUT',
		Nm_Satker='$nSKD', 
		Nm_Program='$gPR', 
		Nm_Kegiatan='$gKG', 
		No_Kontrak='$fNOM2', 
		Tg_Kontrak='$gTGLK', 
		Nilai='$fNIL', 
		JmlItem='$fITM', 
		Pros='100', 
		NomPros30='',
		NomPros70='',
		SmbDana='$fDN', 
		IdRekanan='$fVenK', 
		Uraian='$fUR' 
		WHERE IDT='$gIdT'";
		$rst = mysql_query($SQL) or die(mysql_error());
		
		#UPDATE PERUNTUKAN
		$mSQ = "SELECT IDT as A0, Nomor as A1, Kd_Unit as A2 FROM ta_pengadaan WHERE No_Berkas='".$NoB."' ORDER BY Nomor";
		$mRs = mysql_query($mSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($mRs, MYSQL_BOTH))
		{
			$IdT = $mRo[0];
			$NoP = $mRo[1];
			$KdU = $mRo[2];
			if ($NoP!='')
			{
				#Update ta_pengadaan
				$SW ="UPDATE ta_pengadaan SET Kd_Peruntukan='".$fUT."' WHERE IDT='".$IdT."'";
				mysql_query($SW);
				
				$CeK = fGlobalNEW("IDT","ta_kib_108_temp","No_Pengadaan",$NoP,"=","",DatabaseSB,$ConSB,"");
				if ($CeK)
				{
					#Update temporary
					$SW ="UPDATE ta_kib_108_temp SET Kd_UPB='".$fUT."' WHERE No_Pengadaan='".$NoP."'";
					mysql_query($SW);
					
					$SW= "SELECT P1.Referensi as A0, P2.Ref_Aset as A1, P3.Referensi as A2, P4.Referensi as A3 
					FROM ta_kib_108 P1 
					LEFT JOIN ta_kib_kdptoaset_data_post P2 ON P2.Ref_Aset=P1.Referensi 
					LEFT JOIN ta_kib_108_mutasi P3 ON P3.Referensi=P1.Referensi 
					LEFT JOIN ta_kib_108_merger_his P4 ON P4.Referensi=P1.Referensi 
					WHERE P1.No_Pengadaan='".$NoP."' ORDER BY P1.Referensi";
					$rs = mysql_query($SW) or die(mysql_error());
					while ($mR = mysql_fetch_array($rs, MYSQL_BOTH))
					{
						if ($mR[1]=='' && $mR[2]=='' && $mR[3]=='')
						{
							#Update ta_kib_108 & ta_kib_post_108, syarat: kode upb msh di skpd asal pengadaan, belum ada KdpToKib, belum ada Mutasi.
							$SA ="UPDATE ta_kib_108 SET Kd_UPB='".$fUT."' WHERE No_Pengadaan='".$NoP."' AND Kd_UPB LIKE '".$KdU."%'";
							mysql_query($SA);
							
							$SA ="UPDATE ta_kib_post_108 SET Kd_UPB='".$fUT."' WHERE No_Pengadaan='".$NoP."' AND Kd_UPB LIKE '".$KdU."%'";
							mysql_query($SA);
						}
					}
				}
			}
		}
		#UPDATE PERUNTUKAN END
		
		$URL="Penerimaan_Berkas_Mid.php?gIdT=".$gIdT."&IdL=".$_GET['IdL'];
	}
	else
	{
		$gUnt = $gUnt;
		$gThn = date('Y');
		
		$MaxNom = fGlobalNEW("IfNull(max(Nomor),0)","ta_penerimaan_berkas","Nomor",$gUnt.".".$gThn."%","LIKE","",DatabaseSB,$ConSB,"");
		if ($MaxNom)
		{
			$MaxNom = substr($MaxNom,-6,6);
			$MaxNom = (int)$MaxNom+1;
		}
		else
		{
			$MaxNom = 1;
		}
		$NewNom = $gUnt.".".$gThn.".".substr("000000".$MaxNom,-6,6);
		
		$MaxNew = fGlobalNEW("IfNull(max(NomorNew),0)","ta_penerimaan_berkas","NomorNew","______/PB-ASET/HST/".$gThn,"LIKE","",DatabaseSB,$ConSB,"");
		if ($MaxNew)
		{
			$MaxNew = substr($MaxNew,0,6);
			$MaxNew = (int)$MaxNew+1;
		}
		else
		{
			$MaxNew = 1;
		}
		$fNOMN = substr("000000".$MaxNew,-6,6)."/PB-ASET/HST/".$gThn;
		
		
		$gSIS = $fAgg - $gVaL;
		if ($fNIL <= $gSIS) {$fNIL = $fNIL;}
		else {$fNIL = 0;}
		
		CallConnection(DatabaseSB,$ConSB);
		
		#CritBayar='$fTRMt',
		#CritBayar_Termin='$gKe',
		#CritBayar_MultiYears='$fMLT',
		#CritBayar_PostingKe='$gPOS',
		
		#No_Berita_Acara='$fNOM3', 
		#Tg_Berita_Acara='$gTGLB', 
		
		$SQL = "INSERT INTO ta_penerimaan_berkas SET 
		Tanggal='$gTGL', 
		Nomor='$NewNom', 
		NomorNew='$fNOMN', 
		Kd_Unit='$gUnt', 
		Id_Satker='$mSKD', 
		Nm_Satker='$nSKD', 
		Kd_Program='$fPR', 
		Nm_Program='$gPR', 
		Kd_Kegiatan='$fKG', 
		Nm_Kegiatan='$gKG', 
		
		Kd_SubKegiatan='$fSB', 
		Nm_SubKegiatan='$gSB', 
		
		No_Kontrak='$fNOM2', 
		Tg_Kontrak='$gTGLK', 
		Nilai='$fNIL', 
		JmlItem='$fITM', 
		Pros='100', 
		NomPros30='',
		Kd_Rek13='$fRK', 
		Nm_Rek13='$gRK', 
		SmbDana='$fDN', 
		IdRekanan='$fVenK', 
		Kd_Peruntukan='$fRP', 
		Nm_Peruntukan='$gRP', 
		Uraian='$fUR', 
		Periode='$nTHN', 
		Perubahan='$nAGG', 
		Anggaran='$fAgg', 
		
		
		Recorded=now(), 
		Pencatat='$gPCT'";
		$rst = mysql_query($SQL) or die(mysql_error());
		
		$gIdT = fGlobalNEW("Max(IDT)","ta_penerimaan_berkas","Nomor",$gUnt."%","LIKE","",DatabaseSB,$ConSB,"");
		$URL="Penerimaan_Berkas_Mid.php?gIdT=".$gIdT."&gPR=".$fPR."&gKG=".$fKG."&gRK=".$fRK."&gUnt=".$gUnt."&IdL=".$IdL;
	}
}
else if ($Simpan=="Reset")
{
	$URL="Penerimaan_Berkas_Mid.php?gUT=".$fUT."&gPer=".$fPer."&gApb=".$fApb."&gPR=".$fPR."&gKG=".$fKG."&gSB=".$fSB."&gUnt=".$gUnt."&IdL=".$IdL;
}
else
{
	$URL="Penerimaan_Berkas_Mid.php?gUT=".$fUT."&gPer=".$fPer."&gApb=".$fApb."&gPR=".$fPR."&gKG=".$fKG."&gSB=".$fSB."&gRK=".$fRK."&gDN=".$fDN."&gRP=".$fRP."&gUnt=".$gUnt."&IdL=".$IdL;
}
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
