<?
require "Connection.php";
require "FileFunction.php";
extract($_GET);

if ($fUpb!="All"){
	$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode, ru_kode FROM kib_data_asal WHERE kd_unit ='$fUpb' AND kd_aset like '02%' AND status_aset_tetap_lainnya='N' ORDER BY kd_aset, kib_noreg1";
}
else
{
	if ($fSub=="All"){
		$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode, ru_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fUnt.".__.___' AND kd_unit NOT LIKE '".$fSub.".000' AND kd_aset like '02%' AND status_aset_tetap_lainnya='N' ORDER BY kd_aset, kib_noreg1";
	}
	else{
		$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode, ru_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fSub.".___' AND kd_unit NOT LIKE '".$fSub.".000' AND kd_aset like '02%' AND status_aset_tetap_lainnya='N' ORDER BY kd_aset, kib_noreg1";
	}
}
//$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '%' AND kd_aset like '02%' AND status_aset_tetap_lainnya='N' ORDER BY kd_aset, kib_noreg1";
$nRsB = mysql_query($SQDB);
while ($mRoB = mysql_fetch_array($nRsB, MYSQL_BOTH))
{
	$gIdK = $mRoB[0];
	$gUpb = $mRoB[1];
	$gRin = $mRoB[2];
	
	$gNma = mysql_real_escape_string($mRoB[3]);#nama
	$gKir = "";#kir
	$gMrk = "";#merk
	$gTyp = "";#type
	$gUCC = "";#cc
	$gBHN = "";#bahan
	$gPBR = "";#tidak ada pabrik--
	$gRKA = "";#rangka
	$gMSN = "";#mesin
	$gPLS = "";#polisi
	$gBPK = "";#BPKB
	$gKTR = "";#keterangan
	$gKND = "B";#kondisi
	$gDTA = fGlobal("kibk_merek:kibk_tipe:kibk_cc:kibk_bahan:kibk_norangka:kibk_nomesin:kibk_nopol:kibk_nobpkb:kibk_ket:kibk_kondisi","kib_data_asal_kendaraan","kib_urut",$gIdK,"=","","");
	if ($gDTA){
		$gDTA = explode(":",$gDTA);
		$gMrk = $gDTA[0];#merk
		$gTyp = $gDTA[1];#type
		$gUCC = $gDTA[2];#cc
		$gBHN = $gDTA[3];#bahan
		$gRKA = $gDTA[4];#rangka
		$gMSN = $gDTA[5];#mesin
		$gPLS = $gDTA[6];#polisi
		$gBPK = $gDTA[7];#BPKB
		$gKTR = mysql_real_escape_string($gDTA[8]);#keterangan
		$gKTR = str_replace("(Buah) ()","",$gKTR);
		$gKTR = str_replace("(Unit) ()","",$gKTR);
		
		$gKND = $gDTA[9];#kondisi
		if ($gKND=="B"){$gKND="B";}
		if ($gKND=="R"){$gKND="R";}
		if ($gKND=="H"){$gKND="RR";}
		if ($gKND=="T"){$gKND="TD";}
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
	$gTgl  = substr($mRoB[7],0,10);#tgl perolehan

	$gAUS  = $mRoB[8];#asal-usul
	$gKir  = substr("000".$mRoB[9],-3,3);#kode ruang
	
	if (is_null($gAUS)) {$gAUS="APBD";}
	else if ($gAUS=="1" || $gAUS=="2" || $gAUS=="3" || $gAUS=="4" || $gAUS=="5" || $gAUS=="6" || $gAUS=="7" || $gAUS=="8" || $gAUS=="9" || $gAUS=="10") {$gAUS="APBD";}
	else if ($gAUS=="11" || $gAUS=="12" || $gAUS=="13" || $gAUS=="14" || $gAUS=="15" || $gAUS=="16" || $gAUS=="17" || $gAUS=="18" || $gAUS=="19" || $gAUS=="20") {$gAUS="APBD";}
	else if ($gAUS=="21" || $gAUS=="22" || $gAUS=="23" || $gAUS=="24" || $gAUS=="25" || $gAUS=="26" || $gAUS=="27" || $gAUS=="28" || $gAUS=="29" || $gAUS=="30") {$gAUS="APBD";}
	else if ($gAUS > 23) {$gAUS="APBD";}
	
	InsertKIBB($gUpb,$gRin,$gNma,$gKir,$gMrk,$gTyp,$gUCC,$gBHN,$gPBR,$gRKA,$gMSN,$gPLS,$gBPK,$gKTR,$gMLK,$gKND,$gAUS,$gMSM,$gSTN,$gHRG,$gTTL,$gTgl);
}

function InsertKIBB($gUpb,$gRin,$gNma,$gKir,$gMrk,$gTyp,$gUCC,$gBHN,$gPBR,$gRKA,$gMSN,$gPLS,$gBPK,$gKTR,$gMLK,$gKND,$gAUS,$gMSM,$gSTN,$gHRG,$gTTL,$gTgl)
{
	$NewRefGrp ="";
	$NewReGAset="";
	
	if ($gSTN > 1)
	{
		$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_b WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
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
			require "Insert_KIB_B.php";
		}
	}
	else
	{
		$nSQL = "SELECT IFNULL(MAX(No_Register),0) as LasReG FROM ta_kib_b WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
		$nRst = mysql_query($nSQL) or die(mysql_error());
		$nRow = mysql_fetch_assoc($nRst);
		$NewG = $nRow['LasReG'];
		$LastReG = ((int)$NewG) + 1;
		$NewReGAset = fMakeRegister($LastReG,7);
		require "Insert_KIB_B.php";
	}
}
echo "PROSES DONE..!!";
?>
<script language="javascript">
P_Find()
</script>