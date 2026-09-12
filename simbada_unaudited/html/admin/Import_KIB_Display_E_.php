<? require "Import_Time_Stamp.php"; ?>
<?
$gMLK = "12";
$gKND = "B";
$gMSM = 0;
$gPCT = "ImportPart1-46";

for ($i = 3; $i <= $data->sheets[0]['numRows']; $i++)
{
	if ($data->sheets[0]['cells'][$i][3]!="")
	{
		#$gA = substr($data->sheets[0]['cells'][$i][3],0,11);
		#$gB = explode(":", (str_replace('.',':',$data->sheets[0]['cells'][$i][3])));
		#$gRin = $gA.".".fMakeRegister($gB[4],3);
		
		$gNma = addslashes($data->sheets[0]['cells'][$i][5]);
		$gRin = addslashes($data->sheets[0]['cells'][$i][6]);
		$gJDL = addslashes($data->sheets[0]['cells'][$i][8]);
		$gSPS = addslashes($data->sheets[0]['cells'][$i][9]);
		$gBHN = addslashes($data->sheets[0]['cells'][$i][12]);
		
		$gThnC= $data->sheets[0]['cells'][$i][15];
		$gTgl = $gThnC."-12-31";
		
		#if ($gDT!="") 
		#{
		#	$gDT  = excel2timestamp($gDT);
		#	$gTgl = date("Y-m-d",$gDT);
		#} 
		
		$gDRH = addslashes($data->sheets[0]['cells'][$i][10]);
		$gPCP = addslashes($data->sheets[0]['cells'][$i][11]);
		$gJNS = addslashes($data->sheets[0]['cells'][$i][13]);
		$gUKU = addslashes($data->sheets[0]['cells'][$i][14]);
		$gAUS = addslashes($data->sheets[0]['cells'][$i][16]);
		$gTTL = $data->sheets[0]['cells'][$i][17];
		$gKTR = addslashes($data->sheets[0]['cells'][$i][18]);
		$gSTN = 1;//$data->sheets[0]['cells'][$i][4];
		if ($gUKU=="") {$gUKU=0;}
		if ($gTTL=="") {$gTTL=0;}
		if ($gSTN=="") {$gSTN=0;}
		
		#$gBid = substr($gRin,0,5);
		$FldUpdt="
		Judul='".$gJDL."',
		Spesifikasi='".$gSPS."',
		Tahun='".$gThnC."',
		Daerah_Asal='".$gDRH."',
		Pencipta='".$gPCP."',
		Bahan='".$gBHN."',
		Jenis='".$gJNS."',
		Ukuran='".$gUKU."'";
		
		$NewRefGrp ="";
		$NewReGAset="";
		
		#if ($gSTN > 1)		//MODUL ENTRY GROUP
		#{
			//CARI REGISTER RERAKHIR BARANG DI TABEL KIB
		#	$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_e WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
		#	$nRst = mysql_query($nSQL) or die(mysql_error());
		#	$nRow = mysql_fetch_assoc($nRst);
		#	$NewG = $nRow['LasReG'];
		#	$LastReGrp = ((int)$NewG) + 1;
		#	$NewReGrp  = ($LastReGrp + $gSTN)-1;
			
			//MAKE REFERENSI GROUP
		#	$nSQL = "SELECT IFNULL(MAX(Referensi),0) AS LasRef FROM ta_kib_group";
		#	$nRst = mysql_query($nSQL) or die(mysql_error());
		#	$nRow = mysql_fetch_assoc($nRst);
		#	$NewK = $nRow['LasRef'];
		#	$NewK = substr($NewK, 5,11);
		#	$NewK = ((int)$NewK) + 1;
		#	$NewRefGrp = "GRP.".fMakeReferensi($NewK,11);
			
			//INSERT
		#	$SQL = "INSERT INTO ta_kib_group SET 
		#	Referensi='$NewRefGrp',
		#	Kd_UPB='$gUpb',
		#	Kd_Aset='$gRin',
		#	Jml_Item='$gSTN',
		#	Nilai_Total='$gTTL',
		#	RegFrom='$LastReGrp',
		#	RegTo='$NewReGrp',
		#	Recorded=now(),
		#	Pencatat='$gPCT'";
		#	$rst = mysql_query($SQL);
			
		#	$gHRG = $gTTL/$gSTN;
		#	for($iG=$LastReGrp; $iG<=$NewReGrp; $iG++)
		#	{
		#		$NewReGAset = fMakeRegister($iG,7);
		#		require "Insert_KIB_E.php";
		#	}
		#}
		#else		//MODUL SINGLE ENTRY
		#{
			//CARI REGISTER RERAKHIR BARANG DI TABEL KIB
		#	$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_e WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
		#	$nRst = mysql_query($nSQL) or die(mysql_error());
		#	$nRow = mysql_fetch_assoc($nRst);
		#	$NewG = $nRow['LasReG'];
		#	$LastReG = ((int)$NewG) + 1;
			#$NewReGAset = fMakeRegister($LastReG,7);
			$NewReGAset = fMakeRegister($data->sheets[0]['cells'][$i][7],7);
			
			//HARGA ARAHKAN LANGSUNG KE NILAI PEROLEHAN
			$gHRG = $gTTL;
			
			//LIBATKAN FILE INSERT BARU	
			require "Insert_KIB_E.php";
		#}
	}
}
?>