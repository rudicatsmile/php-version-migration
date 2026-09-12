<?php
require('Connection.php');
require('Connection_Simkada.php');
require('FileFunction.php');

extract($_POST);
extract($_GET);

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
$nTHN = $tTbl;	//fGlobalNEW("Periode","peraturan_daerah","Activated","Y","=","",DatabaseSA,$ConSA,"");
$nAGG = $uTbl;	//fGlobalNEW("Perubahan","peraturan_daerah","Activated","Y","=","",DatabaseSA,$ConSA,"");

$gPCT = fGlobalNEW("User_ID","ta_user_log","IDT",$IdL,"=","",DatabaseSB,$ConSB,"");
$gTGL = $fThn."-".substr("00".$fBln,-2,2)."-".substr("00".$fHri,-2,2);
$gTGLB= $fThnB."-".substr("00".$fBlnB,-2,2)."-".substr("00".$fHriB,-2,2);
$gTGLK= $fThnK."-".substr("00".$fBlnK,-2,2)."-".substr("00".$fHriK,-2,2);
$fNIL = fConvertToNumeric($fNIL);
if ($Simpan=="Save")
{
	$gPR = fGlobalNEW("nmProgram","ta_apbd_program_skpd","kdUnit:idProgram:periode",$gUnt.":".$fPR.":".$nTHN,"=:=:=","",DatabaseSB,$ConSB,"");
	$gKG = fGlobalNEW("nmKegiatan","ta_apbd_kegiatan_skpd","kdUnit:idKegiatan:periode",$gUnt.":".$fKG.":".$nTHN,"=:=:=","",DatabaseSB,$ConSB,"");
	$gSB = fGlobalNEW("nmSubKegiatan","ta_apbd_kegiatan_sub_skpd","kdUnit:idSubKegiatan:periode",$gUnt.":".$fSB.":".$nTHN,"=:=:=","",DatabaseSB,$ConSB,"");
	$gRK = fGlobalNEW("nmRekening","ta_apbd_rekening_skpd","kdUnit:idSubKegiatan:kdRekening:periode",$gUnt.":".$fSB.":".$fRK.":".$nTHN,"=:=:=:=","",DatabaseSB,$ConSB,"");
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
			$gOlD = fGlobalNEW("Nilai","ta_penerimaan_berkas","IDT",$gIdT,"=","",DatabaseSB,$ConSB,"");
			
			$gSIS = $fAgg - ($gVaL-$gOlD);
			if ($fNIL <= $gSIS) {$fNIL=$fNIL;}
			else {$fNIL=$gOlD;}
			
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
		
		CallConnection(DatabaseSB,$ConSB);
		
		$NoB  = fGlobalNEW("Nomor","ta_penerimaan_berkas","IDT",$gIdT,"=","",DatabaseSB,$ConSB,"");
		$eCek = fGlobalNEW("IDT","ta_pengadaan","No_Berkas",$NoB,"=","",DatabaseSB,$ConSB,"");
		$TP = "";
		if ($eCek=='')
		{
			$TP = "CritBayar_PostingKe='$gPOS',";
		}
		
		
		$SQL = "UPDATE ta_penerimaan_berkas SET 
		NomorNew='$fNOMN', 
		Tanggal='$gTGL', 
		Nm_Satker='$nSKD', 
		Nm_Program='$gPR', 
		Nm_Kegiatan='$gKG', 
		No_Kontrak='$fNOM2', 
		Tg_Kontrak='$gTGLK', 
		No_Berita_Acara='$fNOM3', 
		Tg_Berita_Acara='$gTGLB', 
		SmbDana='$gDN', 
		Nilai='$fNIL', 
		JmlItem='$fITM', 
		Pros='100', 
		NomPros30='',
		NomPros70='',
		SmbDana='$gDN', 
		CritBayar='$fTRMt',
		CritBayar_Termin='$gKe',
		CritBayar_MultiYears='$fMLT', $TP 
		
		Uraian='$fUR' 
		WHERE IDT='$gIdT'";
		
		$rst = mysql_query($SQL) or die(mysql_error());
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
		No_Berita_Acara='$fNOM3', 
		Tg_Berita_Acara='$gTGLB', 
		Nilai='$fNIL', 
		JmlItem='$fITM', 
		Pros='100', 
		NomPros30='',
		Kd_Rek13='$fRK', 
		Nm_Rek13='$gRK', 
		SmbDana='$gDN', 
		Kd_Peruntukan='$fRP', 
		Nm_Peruntukan='$gRP', 
		Uraian='$fUR', 
		Periode='$nTHN', 
		Perubahan='$nAGG', 
		Anggaran='$fAgg', 
		
		CritBayar='$fTRMt',
		CritBayar_Termin='$gKe',
		CritBayar_MultiYears='$fMLT',
		CritBayar_PostingKe='$gPOS',
		
		Recorded=now(), 
		Pencatat='$gPCT'";
		$rst = mysql_query($SQL) or die(mysql_error());
		
		$gIdT = fGlobalNEW("Max(IDT)","ta_penerimaan_berkas","Nomor",$gUnt."%","LIKE","",DatabaseSB,$ConSB,"");
		$URL="Penerimaan_Berkas_Mid.php?gIdT=".$gIdT."&gPR=".$fPR."&gKG=".$fKG."&gRK=".$fRK."&gUnt=".$gUnt."&IdL=".$_GET['IdL'];
	}
}
else if ($Simpan=="Reset")
{
	$URL="Penerimaan_Berkas_Mid.php?gPR=".$fPR."&gKG=".$fKG."&gSB=".$fSB."&gUnt=".$gUnt."&IdL=".$_GET['IdL'];
}
else
{
	$URL="Penerimaan_Berkas_Mid.php?gPR=".$fPR."&gKG=".$fKG."&gSB=".$fSB."&gRK=".$fRK."&gDN=".$fDN."&gRP=".$fRP."&gUnt=".$gUnt."&IdL=".$_GET['IdL'];
}
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
