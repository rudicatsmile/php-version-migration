<?php require "Import_Time_Stamp.php"; ?>
<?php
$gMLK = "11";
$gKND = "B";
$gMSM = 0;

for ($i = 3; $i <= $data->sheets[0]['numRows']; $i++)
{
	if ($data->sheets[0]['cells'][$i][3]!="")
	{
		#$gA   = substr($data->sheets[0]['cells'][$i][3],0,11);
		#$gB   = explode(":", (str_replace('.',':',$data->sheets[0]['cells'][$i][3])));
		#$gRin = $gA.".".fMakeRegister($gB[4],3);
		
		$gNma = addslashes($data->sheets[0]['cells'][$i][5]);
		$gRin = addslashes($data->sheets[0]['cells'][$i][6]);
		$gLua = addslashes($data->sheets[0]['cells'][$i][8]);
		if ($gLua=="") {$gLua=0;}
		$gAlm = addslashes($data->sheets[0]['cells'][$i][10]);
		$gHak = addslashes($data->sheets[0]['cells'][$i][11]);
		
		$rTgl= $data->sheets[0]['cells'][$i][12];
		#if ($rTgl!="") 
		#{
		#	$gTglV = excel2timestamp($rTgl);
		#	$gTglV = date("Y-m-d",$gTglV);
		#} 
		#else
		#{
		#	$gTglV="0000-00-00";
		#}
		
		$gTglV = $rTgl;
		if ($gTglV==''){$gTglV="0000-00-00";}
		
		$gNom = addslashes($data->sheets[0]['cells'][$i][13]);
		$gGna = addslashes($data->sheets[0]['cells'][$i][14]);
		
		$gThn = addslashes($data->sheets[0]['cells'][$i][9]);
		$gTgl = $gThn."-12-15";
		
		$gAUS = addslashes($data->sheets[0]['cells'][$i][15]);
		$gKTR = addslashes($data->sheets[0]['cells'][$i][17]);
		$gTTL = $data->sheets[0]['cells'][$i][16];
		$gSTN = 1;//$data->sheets[0]['cells'][$i][4];
		if ($gTTL=="") {$gTTL=0;}
		if ($gSTN=="") {$gSTN=0;}
	
		$NewRefGrp ="";
		$NewReGAset="";
		
		#if ($gSTN > 1)		//MODUL ENTRY GROUP
		#{
			//CARI REGISTER RERAKHIR BARANG DI TABEL KIB
		#	$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_a WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
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
		#		require "Insert_KIB_A.php";
		#	}
		#}
		#else		//MODUL SINGLE ENTRY
		#{
			//CARI REGISTER RERAKHIR BARANG DI TABEL KIB
			#$nSQL = "SELECT IFNULL(MAX(No_Register),0) as LasReG FROM ta_kib_a WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
			#$nRst = mysql_query($nSQL) or die(mysql_error());
			#$nRow = mysql_fetch_assoc($nRst);
			#$NewG = $nRow['LasReG'];
			#$LastReG = ((int)$NewG) + 1;
			#$NewReGAset = fMakeRegister($LastReG,7);
			$NewReGAset = fMakeRegister($data->sheets[0]['cells'][$i][7],7);
	
			$gHRG = $gTTL;
			require "Insert_KIB_A.php";
		#}
	}
}
?>