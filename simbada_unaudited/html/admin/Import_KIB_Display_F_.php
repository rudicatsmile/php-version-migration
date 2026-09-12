<?
$gMLK = "12";
$gKND = "P";
$gMSM = 0;
			
define("MIN_DATES_DIFF", 25569);	// Numbers of second in a day:
define("SEC_IN_DAY", 86400);

function excel2timestamp($excelDate)
{
	if ($excelDate <= MIN_DATES_DIFF) {return 0;}
	return  ($excelDate - MIN_DATES_DIFF) * SEC_IN_DAY;
}  

for ($i = 3; $i <= $data->sheets[0]['numRows']; $i++)
{
	if ($data->sheets[0]['cells'][$i][3]!="")
	{
		#$gProses ="Yes";
		#$gA = substr($data->sheets[0]['cells'][$i][3],0,11);
		#$gB = split(":", (str_replace('.',':',$data->sheets[0]['cells'][$i][3])));
		#$gRin = $gA.".".fMakeRegister($gB[4],3);
		
		$gNma = $data->sheets[0]['cells'][$i][5];
		$gRin = $data->sheets[0]['cells'][$i][6];
		
		$rTgl = $data->sheets[0]['cells'][$i][13];
		$rThn = $data->sheets[0]['cells'][$i][15];
		if ($rTgl!="") 
		{
			#$gTglD = excel2timestamp($rTgl);
			$gTglD = $rTgl;
			#$gTglD = date("Y-m-d",$gTglD);
			#$rThn  = substr($gTglD,0,4);
		} 
		else
		{
			$gTglD="0000-00-00";
			#$rThn=$gThn;
		}

		$gTgl = $rThn."-12-31";
		$gTglM= "0000-00-00";
		
		$gNoD = $data->sheets[0]['cells'][$i][14];
		$gTKT = $data->sheets[0]['cells'][$i][9];
		$gTKT = str_replace("Tidak Bertingkat","Tidak",$gTKT);
		$gBTN = $data->sheets[0]['cells'][$i][10];
		$gPJG = 0;
		$gLBR = 0;
		$gLUA = $data->sheets[0]['cells'][$i][11];
		$gKTR = $data->sheets[0]['cells'][$i][21];
		
		$gSTT = $data->sheets[0]['cells'][$i][17];
		$gLKS = $data->sheets[0]['cells'][$i][12];
		$gMLK = "12";
		$gKND = "P";
		$gAUS = $data->sheets[0]['cells'][$i][19];

		$gTTL = $data->sheets[0]['cells'][$i][20];
		$gSTN = 1;//$data->sheets[0]['cells'][$i][4];
		if ($gTTL=="") {$gTTL=0;}
		if ($gSTN=="") {$gSTN=0;}
		
		$NewRefGrp ="";
		$NewReGAset="";
		
		#if ($gSTN > 1)		//MODUL ENTRY GROUP
		#{
			//CARI REGISTER RERAKHIR BARANG DI TABEL KIB
		#	$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_f WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
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
		#	$rst = mysql_query($SQL) or die(mysql_error());
			
		#	$gHRG = $gTTL/$gSTN;
		#	for($iG=$LastReGrp; $iG<=$NewReGrp; $iG++)
		#	{
		#		$NewReGAset = fMakeRegister($iG,7);
		#		require "Insert_KIB_F.php";
		#	}
		#}
		#else		//MODUL SINGLE ENTRY
		#{
			//CARI REGISTER RERAKHIR BARANG DI TABEL KIB
		#	$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_f WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
		#	$nRst = mysql_query($nSQL) or die(mysql_error());
		#	$nRow = mysql_fetch_assoc($nRst);
		#	$NewG = $nRow['LasReG'];
		#	$LastReG = ((int)$NewG) + 1;
		#	$NewReGAset = fMakeRegister($LastReG,7);
			$NewReGAset = fMakeRegister($data->sheets[0]['cells'][$i][7],7);
			
			//HARGA ARAHKAN LANGSUNG KE NILAI PEROLEHAN
			$gHRG = $gTTL;
			
			//LIBATKAN FILE INSERT BARU	
			require "Insert_KIB_F.php";
		#}
	}
}
?>