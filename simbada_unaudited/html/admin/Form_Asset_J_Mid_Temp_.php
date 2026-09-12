<?
require "Connection.php";
require "FileFunction.php";
require "Form_Asset_J_Mid_Temp_Posting.php";
require "HitungSisaNilaiPengadaan.php";

extract($_GET);
extract($_POST);
$rIDT   = $rIDT;
$gIdT   = $gIdT;
$Smp    = $Simpan;

$gUpb   = $fUpb;
$gNma   = $fNama;
$gKTR   = $fKeterangan;

$gMLK   = $fMilik;
$gKND   = $fKondisi;
$gAUS   = $fAsalUsul;
$gMSM   = $fManfaat;

$gSTN   = fConvertToNumeric($fSatuan);
$fTotal = fConvertToNumeric($fTotal);

$urI = "";
if ($Smp=="Save")
{
	$gRin = "";
	$gNiL = "";
	$gTgL = "";
	$gNoM = "";
	$gPRO = "";	
	
	$nSQ = "SELECT No_Berkas, Nomor, Kd_Aset_108, Nilai, Pros FROM ta_pengadaan WHERE IDT='$gIdT'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gBRK = $mRo[0];
		$gTgL = fGlobalNEW("Tg_Berita_Acara","ta_penerimaan_berkas","Nomor",$gBRK,"=","",DatabaseSB,$ConSB,"");
		$gNoM = $mRo[1];
		$gRin = $mRo[2];
		$gNiL = $mRo[3];
		$gPRO = $mRo[4];
		
		if ($gPRO=="70")
		{
			$gR30 = fGlobalNEW("NomPros30","ta_penerimaan_berkas","Nomor",$gBRK,"=","",$DatabaseSB,$ConSB,"");
			$gN30 = fGlobalNEW("Nilai","ta_penerimaan_berkas","Nomor:Pros",$gR30.":30","=:=","",$DatabaseSB,$ConSB,"");
			if ($gN30) {$gNiL = $gNiL + $gN30;}
		}
		if ($gPRO=="100")
		{
			$gR70 = fGlobalNEW("NomPros70","ta_penerimaan_berkas","Nomor",$gBRK,"=","",$DatabaseSB,$ConSB,"");
			$gN70 = fGlobalNEW("Nilai","ta_penerimaan_berkas","Nomor:Pros",$gR70.":70","=:=","",$DatabaseSB,$ConSB,"");
			if ($gN70) {$gNiL = $gNiL + $gN70;}
			
			$gR30 = fGlobalNEW("NomPros30","ta_penerimaan_berkas","Nomor",$gR70,"=","",$DatabaseSB,$ConSB,"");
			$gN30 = fGlobalNEW("Nilai","ta_penerimaan_berkas","Nomor:Pros",$gR30.":30","=:=","",$DatabaseSB,$ConSB,"");
			if ($gN30) {$gNiL = $gNiL + $gN30;}
		}
	}
	
	if ($rIDT) {$gNiL = fHitSisaD("ta_kib_108_temp",$gNoM,$gNiL,$fTotal,$rIDT,DatabaseSB,$ConSB);}	//''**''//
	else {$gNiL = fHitSisaD("ta_kib_108_temp",$gNoM,$gNiL,$fTotal,"",DatabaseSB,$ConSB);}				//''**''//
	$gHRG = 0;																						//''**''//
	
	if ($gNiL > 0)
	{
		$gHRG = $gNiL/$gSTN;
	}
	
	if ($gKTR=="") {$gKTR="Pengadaan Nomor : ".$gNoM;}
	if ($rIDT)
	{
		$rSTN = fGlobalNEW("Jumlah_Unit","ta_kib_108_temp","IDT",$rIDT,"=","",DatabaseSB,$ConSB,"");
		$rUpb = fGlobalNEW("Kd_UPB","ta_kib_108_temp","IDT",$rIDT,"=","",DatabaseSB,$ConSB,"");
		$RfTMP= fGlobalNEW("Referensi","ta_kib_108_temp","IDT",$rIDT,"=","",DatabaseSB,$ConSB,"");	//'''''''''''''''''''
		
		$SQL = "UPDATE ta_kib_108_temp SET 
		Tanggal='$gTgL',
		Kd_UPB='$gUpb',
		Nm_Aset='".mysql_real_escape_string($gNma)."',
		Kd_Pemilik='$gMLK',
		Asal_Usul='$gAUS',
		Kondisi='$gKND',
		Masa_Manfaat='$gMSM',
		Keterangan='$gKTR',
		No_SP2D='',
		Jumlah_Unit='$gSTN',
		Nilai_Pengadaan='$gNiL', Harga_Satuan='$gHRG' WHERE IDT='".$rIDT."'";
		$rst = mysql_query($SQL) or die(mysql_error());
		
		if (($gSTN != $rSTN) || ($gUpb != $rUpb)) {DeleteData("ta_kib_108",$rIDT,$gNoM,$RfTMP,DatabaseSB,$ConSB);}	//'''''''''''''''''''
		else
		{
			//''''''''''''''''''''''''' {Harga => Ref_Temp}
			$SQL = "UPDATE ta_kib_108 SET 
			Kd_UPB='$gUpb',
			Nm_Aset='".mysql_real_escape_string($gNma)."',
			Kd_Pemilik='$gMLK',
			Asal_Usul='$gAUS',
			Kondisi='$gKND',
			Masa_Manfaat='$gMSM',
			Keterangan='$gKTR', 
			Harga='$gHRG', 
			Nilai_Akhir='$gNiL' 
			WHERE No_Pengadaan='$gNoM' AND Ref_Temp='$RfTMP'";
			$rst = mysql_query($SQL) or die(mysql_error());
			
			//'''''''''''''''''''''''''
			require "UpdateRecordDataPostGroup.php";
		}
	}
	else
	{
		//'''''''''''''''''''''''''
		$gNmTBL="ta_kib_108_temp";
		$nSQL = "SELECT IFNULL(MAX(Referensi),0) as LasRef FROM ".$gNmTBL." WHERE No_Pengadaan='".$gNoM."'";
		$nRst = mysql_query($nSQL) or die(mysql_error());
		$nRow = mysql_fetch_assoc($nRst);
		$NeRf = $nRow['LasRef'];
		$LastRef = ((int)substr($NeRf,-3,3)) + 1;
		$NewRfTMP= $gNoM."-".fMakeRegister($LastRef,3);
	
		//''''''''''''''''''''''''' {Referensi}
		$SQL = "INSERT INTO ta_kib_108_temp SET 
		No_Pengadaan='$gNoM',
		Referensi='$NewRfTMP',
		Tanggal='$gTgL',
		Kd_UPB='$gUpb',
		Kd_Aset_108='$gRin',
		Nm_Aset='".mysql_real_escape_string($gNma)."',
		Kd_Pemilik='$gMLK',
		Asal_Usul='$gAUS',
		Kondisi='$gKND',
		Masa_Manfaat='$gMSM',
		Keterangan='$gKTR',
		No_SP2D='',
		Jumlah_Unit='$gSTN',
		Nilai_Pengadaan='$gNiL', 
		Harga_Satuan='$gHRG'";
		$rst = mysql_query($SQL) or die(mysql_error());
		
		$rIDT = fGlobalNEW("Max(IDT)","ta_kib_108_temp","Kd_UPB",$gUpb,"=","",DatabaseSB,$ConSB,"");
	}
	
	if ($gPRO=="70" || $gPRO=="100")
	{
		PostingDataKIB($gIdT,$rIDT,$gPRO,$gNiL,$gNoM,DatabaseSB,$ConSB);
	}
}
else if ($Smp=="Reset")
{
	$rIDT="";
}
else{
	$urI = "fSub=".$fSub."&";
}
$URL="Form_Asset_G_Mid_Temp.php?".$urI."gIdT=".$gIdT."&rIDT=".$rIDT."&IdL=".$IdL;
header("Location: ".$URL);

?>
