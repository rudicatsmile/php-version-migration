<?php
require "Connection.php";
require "FileFunction.php";

extract($_GET);
extract($_POST);
$rIDT   = $rIDT;
$gIdT   = $gIdT;
$Smp    = $Simpan;
$gMSA   = $fRadio;
$gMeM   = $fMeM;
$urI = "";
if ($Smp=="Save")
{
	if ($rIDT)
	{
		$gBRK = fGlobalNEW("No_Berkas","ta_pengadaan","IDT",$gIdT,"=","",DatabaseSB,$ConSB,"");
		$gTGL = fGlobalNEW("Tg_Berita_Acara","ta_penerimaan_berkas","Nomor",$gBRK,"=","",DatabaseSB,$ConSB,"");
		
		$SQL = "UPDATE ta_kib_global_temp SET 
		Tanggal='$gTGL', Memo='$gMeM' WHERE IDT='".$rIDT."'";
		$rst = mysql_query($SQL) or die(mysql_error());
	}
	
	$gPRO = fGlobalNEW("Pros","ta_pengadaan","IDT",$gIdT,"=","",DatabaseSB,$ConSB,"");
	//if ($gPRO=="70" || $gPRO=="100")
	if ($gPRO=="100")
	{
		PostingDataKIB($gIdT,$rIDT,$gPRO,$gMSA,DatabaseSB,$ConSB);
	}

}
else if ($Smp=="Reset")
{
	$rIDT = "";
}
else{
	$urI = "fSub=".$fSub."&";
}
$URL="Form_Asset_Global_Mid_Temp.php?".$urI."gIdT=".$gIdT."&rIDT=".$rIDT."&IdL=".$IdL;
header("Location: ".$URL);

function PostingDataKIB($gIdT,$rIDT,$gPRO,$gMSA,$DatabaseSB,$ConSB)
{
	CallConnection($DatabaseSB,$ConSB);
	$nSQ="SELECT * FROM ta_kib_global_temp WHERE IDT='$rIDT'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gNOM = $mRo['No_Pengadaan'];
		$gTGL = $mRo['Tanggal'];
		$gNIL = $mRo['Nilai_Pengadaan'];
		$gUPB = $mRo['Kd_UPB'];
		$gREF = $mRo['Ref_Aset'];
		$gREG = $mRo['Reg_Aset'];
		$gAST = $mRo['Kd_Aset'];
		$gNMA = $mRo['Nm_Aset'];
		$gURA = $mRo['Uraian'];
		$gEXT = $mRo['Extract'];
		
		if ($gPRO=="70")	//Cari Nilai 30%
		{
			$gBRK = fGlobalNEW("No_Berkas","ta_pengadaan","IDT",$gIdT,"=","",$DatabaseSB,$ConSB,"");
			$gR30 = fGlobalNEW("NomPros30","ta_penerimaan_berkas","Nomor",$gBRK,"=","",$DatabaseSB,$ConSB,"");
			$gN30 = fGlobalNEW("Nilai","ta_penerimaan_berkas","Nomor:Pros",$gR30.":30","=:=","",$DatabaseSB,$ConSB,"");
			if ($gN30) {$gNIL = $gNIL+$gN30;}
		}
		if ($gPRO=="100")	//Cari Nilai 30%, 70%
		{
			$gBRK = fGlobalNEW("No_Berkas","ta_pengadaan","IDT",$gIdT,"=","",$DatabaseSB,$ConSB,"");
			$gR70 = fGlobalNEW("NomPros70","ta_penerimaan_berkas","Nomor",$gBRK,"=","",$DatabaseSB,$ConSB,"");
			$gN70 = fGlobalNEW("Nilai","ta_penerimaan_berkas","Nomor:Pros",$gR70.":70","=:=","",$DatabaseSB,$ConSB,"");
			if ($gN70) {$gNIL = $gNIL+$gN70;}
			
			$gR30 = fGlobalNEW("NomPros30","ta_penerimaan_berkas","Nomor",$gR70,"=","",$DatabaseSB,$ConSB,"");
			$gN30 = fGlobalNEW("Nilai","ta_penerimaan_berkas","Nomor:Pros",$gR30.":30","=:=","",$DatabaseSB,$ConSB,"");
			if ($gN30) {$gNIL = $gNIL+$gN30;}
		}
	}
	
	//Posting data kib
	$gURA = "Penambahan Nilai.";
	$gKTR = "Penambahan Nilai dari Pengadaan Barang Nomor. : ".$gNOM;
	
	if ($gEXT=="Belum")
	{
		if ($gREF!=""){
			$SQ="INSERT INTO ta_kib_post SET 
			Referensi='$gREF',
			Ref_Group='',
			Kd_UPB='$gUPB',
			Kd_Aset='$gAST',
			No_Register='$gREG',
			Crit='INV',
			Tanggal='$gTGL',
			Tmbh_Ms_Manfaat='$gMSA',
			Uraian='$gURA',
			DK='D',
			Debet='$gNIL',
			Kredit=0,
			No_Pengadaan='$gNOM',
			Keterangan='$gKTR',
			Recorded=now(),
			Pencatat='Extract.'";
			$Rs = mysql_query($SQ) or die(mysql_error());
		}
		$SQ="UPDATE ta_kib_global_temp SET Extract='Sudah', Tmbh_Ms_Manfaat='$gMSA' WHERE IDT='$rIDT'";
		$Rs = mysql_query($SQ) or die(mysql_error());
	}
	else
	{
		if ($gNOM!="" && $gREF!=""){
			$SQ="UPDATE ta_kib_post SET 
			Referensi='$gREF',
			Ref_Group='',
			Kd_UPB='$gUPB',
			Kd_Aset='$gAST',
			No_Register='$gREG',
			Tanggal='$gTGL',
			Tmbh_Ms_Manfaat='$gMSA',
			Uraian='$gURA',
			Debet='$gNIL',
			Keterangan='$gKTR', 
			Recorded=now(),
			Pencatat='Extract.' 
			WHERE No_Pengadaan='$gNOM'";
			$Rs = mysql_query($SQ) or die(mysql_error());
		}		
		$SQ="UPDATE ta_kib_global_temp SET Tmbh_Ms_Manfaat='$gMSA' WHERE IDT='$rIDT'";
		$Rs = mysql_query($SQ) or die(mysql_error());
	}
}
?>
