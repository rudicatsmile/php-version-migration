<?
require "Connection.php";
require "FileFunction.php";

extract($_GET);
//echo $fUnt." : ".$fSub." : ".$fUpb;

if ($fUpb!="All"){
	$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit ='$fUpb' AND kd_aset like '04%' AND status_aset_tetap_lainnya='N' ORDER BY kd_aset, kib_noreg1";
}
else
{
	if ($fSub=="All"){
		$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fUnt.".__.___' AND kd_unit NOT LIKE '".$fSub.".000' AND kd_aset like '04%' AND status_aset_tetap_lainnya='N' ORDER BY kd_aset, kib_noreg1";
	}
	else{
		$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fSub.".___' AND kd_unit NOT LIKE '".$fSub.".000' AND kd_aset like '04%' AND status_aset_tetap_lainnya='N' ORDER BY kd_aset, kib_noreg1";
	}
}
//$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '%' AND kd_aset like '04%' AND status_aset_tetap_lainnya='N' ORDER BY kd_aset, kib_noreg1";
$nRsB = mysql_query($SQDB);
while ($mRoB = mysql_fetch_array($nRsB, MYSQL_BOTH))
{
	$gIdK = $mRoB[0];
	$gUpb = $mRoB[1];
	$gRin = $mRoB[2];
	
	$gNma = mysql_real_escape_string($mRoB[3]);#nama

	$gKNS = "";
	$gPJG = 0;
	$gLBR = "";
	$gLUA = "";
	
	$gKND = "B";
	$gKTR = "";
	
	$gTglD= "0000-00-00";
	$gNoD = "";
	$gSTT = "";
	$gLKS = "";
	
	$gDTA = fGlobal("kibd_konstruksi:kibd_panjang:kibd_lebar:kibb_luasb:kibb_kondisi:kibb_ket:kibb_tgldok:kibb_nodok:kibb_statust:kibb_letak","kib_data_asal_bangunan","kib_urut",$gIdK,"=","","");
	if ($gDTA){
		$gDTA = explode(":",$gDTA);
		
		$gKNS = $gDTA[0];
		$gPJG = $gDTA[1];
		if (is_null($gPJG) || $gPJG==""){$gPJG=0;}
		
		$gLBR = $gDTA[2];
		if (is_null($gLBR) || $gLBR==""){$gLBR=0;}
		
		$gLUA = $gDTA[3];
		if (is_null($gLUA) || $gLUA==""){$gLUA=0;}
		
		$gKND = $gDTA[4];
		if ($gKND=="B"){$gKND="B";}
		if ($gKND=="R"){$gKND="R";}
		if ($gKND=="H"){$gKND="RR";}
		if ($gKND=="T"){$gKND="TD";}
		
		$gKTR = mysql_real_escape_string($gDTA[5]);
		$gKTR = str_replace("(Buah) ()","",$gKTR);
		$gKTR = str_replace("(Unit) ()","",$gKTR);
		
		$gTglD= substr($gDTA[6],0,10);
		$gNoD = $gDTA[7];
		$gSTT = $gDTA[8];
		$gLKS = $gDTA[9];
	}
	
	$gMLK = $mRoB[4];#milik
	
	$gMSM  = findMasaManfaat($gRin,DatabaseSB,$ConSB);
	if (!$gMSM) {$gMSM=0;}
	
	$gSTN  = $mRoB[5];#jumlah item barang
	if ($gSTN == 0) {$gSTN=1;}
	
	$gTTL  = $mRoB[6];#total
	$gHRG  = 0;
	if ($gTTL>0 && $gSTN>0){
		$gHRG  = round($gTTL/$gSTN,2);
	}
	$gTgl  = substr($mRoB[7],0,10);#tgl perolehan-> ok
	$gAUS  = $mRoB[8];#asal-usul	
	
	if (is_null($gAUS)) {$gAUS="APBD";}
	else if ($gAUS=="1" || $gAUS=="2" || $gAUS=="3" || $gAUS=="4" || $gAUS=="5" || $gAUS=="6" || $gAUS=="7" || $gAUS=="8" || $gAUS=="9" || $gAUS=="10") {$gAUS="APBD";}
	else if ($gAUS=="11" || $gAUS=="12" || $gAUS=="13" || $gAUS=="14" || $gAUS=="15" || $gAUS=="16" || $gAUS=="17" || $gAUS=="18" || $gAUS=="19" || $gAUS=="20") {$gAUS="APBD";}
	else if ($gAUS=="21" || $gAUS=="22" || $gAUS=="23" || $gAUS=="24" || $gAUS=="25" || $gAUS=="26" || $gAUS=="27" || $gAUS=="28" || $gAUS=="29" || $gAUS=="30") {$gAUS="APBD";}
	else if ($gAUS > 23) {$gAUS="APBD";}
	
	InsertKIBD($gUpb,$gRin,$gNma,$gKNS,$gTgl,$gTglD,$gNoD,$gPJG,$gLBR,$gLUA,$gSTT,$gKTR,$gLKS,$gMLK,$gKND,$gAUS,$gMSM,$gSTN,$gHRG,$gTTL);
	
}

function InsertKIBD($gUpb,$gRin,$gNma,$gKNS,$gTgl,$gTglD,$gNoD,$gPJG,$gLBR,$gLUA,$gSTT,$gKTR,$gLKS,$gMLK,$gKND,$gAUS,$gMSM,$gSTN,$gHRG,$gTTL)
{
	$NewRefGrp ="";
	$NewReGAset="";
	
	if ($gSTN > 1)
	{
		$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_d WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
		$nRst = mysql_query($nSQL) or die(mysql_error());
		$nRow = mysql_fetch_assoc($nRst);
		$NewG = $nRow['LasReG'];
		$LastReGrp = ((int)$NewG) + 1;
		$NewReGrp  = ($LastReGrp + $gSTN)-1;
		
		$nSQL = "SELECT IFNULL(MAX(Referensi),0) AS LasRef FROM ta_kib_group";
		$nRst = mysql_query($nSQL) or die(mysql_error());
		$nRow = mysql_fetch_assoc($nRst);
		$NewK = $nRow['LasRef'];
		$NewK = substr($NewK, 5,11);
		$NewK = ((int)$NewK) + 1;
		$NewRefGrp = "GRP.".fMakeReferensi($NewK,11);
		
		$SQL = "INSERT INTO ta_kib_group SET 
		Referensi='$NewRefGrp',
		Kd_UPB='$gUpb',
		Kd_Aset='$gRin',
		Jml_Item='$gSTN',
		Nilai_Total='$gTTL',
		RegFrom='$LastReGrp',
		RegTo='$NewReGrp'";
		$rst = mysql_query($SQL) or die(mysql_error());
		
		for($iG=$LastReGrp; $iG<=$NewReGrp; $iG++)
		{
			$NewReGAset = fMakeRegister($iG,7);
			require "Insert_KIB_D.php";
		}
	}
	else
	{
		$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_d WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
		$nRst = mysql_query($nSQL) or die(mysql_error());
		$nRow = mysql_fetch_assoc($nRst);
		$NewG = $nRow['LasReG'];
		$LastReG = ((int)$NewG) + 1;
		$NewReGAset = fMakeRegister($LastReG,7);
		require "Insert_KIB_D.php";
	}	
}
echo "PROSES DONE..!!";
?>
<script language="javascript">
P_Find()
</script>