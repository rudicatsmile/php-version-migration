<?
require "MakeRegister.php";
require "DeleteRecordData.php";

function PostingDataKIB($gIdT,$rIDT,$gPRO,$gNiL,$gNoM,$DatabaseSB,$ConSB)
{
	CallConnection($DatabaseSB,$ConSB);
	$gSTN = fGlobalNEW("Jumlah_Bidang","ta_kib_108_temp","IDT",$rIDT,"=","",$DatabaseSB,$ConSB,"");
	if ($gSTN > 1)
	{
		PostingGroup($gIdT,$rIDT,$gSTN,$gPRO,$gNiL,$gNoM,$DatabaseSB,$ConSB);
	}
	else
	{
		PostingNonGroup($gIdT,$rIDT,$gPRO,$gNiL,$gNoM,$DatabaseSB,$ConSB);
	}
}

function PostingNonGroup($gIdT,$rIDT,$gPRO,$gNiL,$gNoM,$DatabaseSB,$ConSB)
{
	CallConnection($DatabaseSB,$ConSB);
	$NmTBL = "ta_kib_108";
	
	$gUpb = fGlobalNEW("Kd_UPB",$NmTBL."_temp","IDT",$rIDT,"=","",$DatabaseSB,$ConSB,"");
	$gRin = fGlobalNEW("Kd_Aset_108",$NmTBL."_temp","IDT",$rIDT,"=","",$DatabaseSB,$ConSB,"");
	$RfTMP= fGlobalNEW("Referensi",$NmTBL."_temp","IDT",$rIDT,"=","",$DatabaseSB,$ConSB,"");					//'''''''''''''
	$rKIB = fGlobalNEW("IDT",$NmTBL,"No_Pengadaan:Ref_Temp",$gNoM.":".$RfTMP,"=:=","",$DatabaseSB,$ConSB,"");	//'''''''''''''
	
	$gNiL = $gNiL;
	
	if (!$rKIB)
	{
		$gTTL = $gNiL;
		$gHRG = $gTTL;
		
		$SQL = "SELECT * FROM ".$NmTBL."_temp WHERE IDT='$rIDT'";
		$nRs = mysql_query($SQL) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$gNmB = $mRo['Nm_Aset_108'];
			$gKTR = $mRo['Keterangan'];
			$gTgl = $mRo['Tanggal'];
			
			$gLua = $mRo['Luas_M2'];
			$gHak = $mRo['Hak_Tanah'];
			$gAlm = $mRo['Alamat'];
			$gGna = $mRo['Penggunaan'];
			$gTglV= "0000-00-00";
			$gNom = "";
			
			$gMLK = $mRo['Kd_Pemilik'];
			$gKND = $mRo['Kondisi'];
			$gAUS = $mRo['Asal_Usul'];
			$gPCT = "Extract";
		}
		
		#$nSQL = "SELECT IFNULL(MAX(No_Register),0) as LasReG FROM ".$NmTBL." WHERE Kd_Aset_108='".$gRin."' AND Kd_Upb='".$gUpb."'";
		$nSQL = "SELECT IFNULL(MAX(No_Register),0) as LasReG FROM ".$NmTBL." WHERE No_Register NOT LIKE '%HEX%'";
		$nRst = mysql_query($nSQL) or die(mysql_error());
		$nRow = mysql_fetch_assoc($nRst);
		$NewG = $nRow['LasReG'];
		$LastReG = ((int)$NewG) + 1;
		$NewReGAset = fMakeRegister($LastReG,7);
		
		require "Insert_KIB_A_Extract.php";
		
		$SQL = "UPDATE ".$NmTBL."_temp SET Extract='Sudah' WHERE IDT='$rIDT'";
		$nRs = mysql_query($SQL) or die(mysql_error());
	}
}

function PostingGroup($gIdT,$rIDT,$gSTN,$gPRO,$gNiL,$gNoM,$DatabaseSB,$ConSB)
{
	CallConnection($DatabaseSB,$ConSB);
	$NmTBL = "ta_kib_108";
	
	$gUpb = fGlobalNEW("Kd_UPB",$NmTBL."_temp","IDT",$rIDT,"=","",$DatabaseSB,$ConSB,"");
	$gRin = fGlobalNEW("Kd_Aset_108",$NmTBL."_temp","IDT",$rIDT,"=","",$DatabaseSB,$ConSB,"");
	$RfTMP= fGlobalNEW("Referensi",$NmTBL."_temp","IDT",$rIDT,"=","",$DatabaseSB,$ConSB,"");	//'''''''''''''
	$rKIB = fGlobalNEW("IDT",$NmTBL,"No_Pengadaan:Ref_Temp",$gNoM.":".$RfTMP,"=:=","",$DatabaseSB,$ConSB,"");	//'''''''''''''
	
	$gNiL = $gNiL;
	
	if (!$rKIB)
	{
		//CARI REGISTER RERAKHIR BARANG DI TABEL KIB
		$LastReGrp = funcLastReGrp($NmTBL,$gRin,$gUpb,$DatabaseSB,$ConSB);
		$NewReGrp  = ($LastReGrp + $gSTN)-1;
		
		//MAKE REFERENSI GROUP
		$NewRefGrp = funcNewRefGrp($DatabaseSB,$ConSB);
		
		//''''''''''''' {Ref_Temp}
		$SQL = "INSERT INTO ta_kib_group SET 
		Referensi='$NewRefGrp',
		No_Pengadaan='$gNoM',
		Ref_Temp='$RfTMP',
		Kd_UPB='$gUpb',
		Kd_Aset='$gRin',
		Jml_Item='$gSTN',
		Nilai_Total='$gNiL',
		RegFrom='$LastReGrp',
		RegTo='$NewReGrp'";
		$rst = mysql_query($SQL) or die(mysql_error());
		
		
		$gTTL = $gNiL;
		$gHRG = $gTTL / $gSTN;
		
		$SQL = "SELECT * FROM ".$NmTBL."_temp WHERE IDT='$rIDT'";
		$nRs = mysql_query($SQL) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$gNmB = $mRo['Nm_Aset_108'];
			$gKTR = $mRo['Keterangan'];
			$gTgl = $mRo['Tanggal'];
			
			$gLua = $mRo['Luas_M2'];
			$gHak = $mRo['Hak_Tanah'];
			$gAlm = $mRo['Alamat'];
			$gGna = $mRo['Penggunaan'];
			$gTglV= "0000-00-00";
			$gNom = "";
			
			$gMLK = $mRo['Kd_Pemilik'];
			$gKND = $mRo['Kondisi'];
			$gAUS = $mRo['Asal_Usul'];
			$gPCT = "Extract";
		}
		
		for($iG=$LastReGrp; $iG<=$NewReGrp; $iG++)
		{
			$NewReGAset = fMakeRegister($iG,7);
			require "Insert_KIB_A_Extract.php";
		}
		
		$SQL = "UPDATE ".$NmTBL."_temp SET Extract='Sudah' WHERE IDT='$rIDT'";
		$nRs = mysql_query($SQL) or die(mysql_error());
	}
}
?>