<?
require "Connection.php";
require "FileFunction.php";

extract($_GET);

if ($fUpb!="All"){
	$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit ='$fUpb' AND kd_aset LIKE '01%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
	$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit ='$fUpb' AND kd_aset LIKE '02%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
	$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit ='$fUpb' AND kd_aset LIKE '03%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
	$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit ='$fUpb' AND kd_aset LIKE '04%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
	$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit ='$fUpb' AND kd_aset LIKE '05%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
}
else
{
	if ($fSub=="All"){
		$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fUnt.".__.___' AND kd_aset LIKE '01%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
		$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fUnt.".__.___' AND kd_aset LIKE '02%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
		$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fUnt.".__.___' AND kd_aset LIKE '03%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
		$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fUnt.".__.___' AND kd_aset LIKE '04%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
		$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fUnt.".__.___' AND kd_aset LIKE '05%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
	}
	else{
		$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fSub.".___' AND kd_aset LIKE '01%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
		$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fSub.".___' AND kd_aset LIKE '02%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
		$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fSub.".___' AND kd_aset LIKE '03%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
		$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fSub.".___' AND kd_aset LIKE '04%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
		$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fSub.".___' AND kd_aset LIKE '05%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
	}
}
#$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fSub.".___' AND kd_aset LIKE '01%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
#$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fSub.".___' AND kd_aset LIKE '02%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
#$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fSub.".___' AND kd_aset LIKE '03%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
#$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fSub.".___' AND kd_aset LIKE '04%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
#$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fSub.".___' AND kd_aset LIKE '05%' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode FROM kib_data_asal WHERE kd_unit LIKE '".$fUnt.".__.___' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
$SQDB="SELECT kib_urut, KD_UNIT, KD_ASET, nama_barang, pem_kode, kib_jml, kib_nilai, tgl_perolehan, au_kode, susut2013 FROM kib_data_asal WHERE kd_unit LIKE '".$fUnt.".__.___' AND status_aset_tetap_lainnya='Y' ORDER BY kd_aset, kib_noreg1";
#echo $SQDB;
$nRsB = mysql_query($SQDB);
while ($mRoB = mysql_fetch_array($nRsB, MYSQL_BOTH))
{
	$gIdK = $mRoB[0];
	$gUpb = $mRoB[1];
	$gReK = $mRoB[2];
	
	$gRin = fGlobal("kd_aset","ref_rek_aset5","Link_Kib_AE",$gReK,"=","","");
	if ($gRin=="") 
	{
		$gRin="99.99.99.99.999";
		$gNma = mysql_real_escape_string($mRoB[3]).":::>".$gIdK;	#nama
	}
	else
	{
		$gNma = mysql_real_escape_string($mRoB[3]);	#nama
	}
	
	if (substr($gReK,0,2)=="01")
	{
		$gLua  = 0;		#kibt_luas
		$gAlm  = "";	#kibt_letak
		$gHak  = "";	#kibt_stanah
		$gTglV = "";	#kibt_tglsert
		$gNom  = "";	#kibt_nosert
		$gGna  = "";	#kibt_penggunaan
		$gKTR  = "";	#kibt_ket
		
		$gDTA = fGlobal("kibt_luas:kibt_letak:kibt_stanah:kibt_tglsert:kibt_nosert:kibt_penggunaan:kibt_ket","kib_data_asal_tanah","kib_urut",$gIdK,"=","","");
		if ($gDTA){
			$gDTA = explode(":",$gDTA);
			$gLua  = $gDTA[0];	#kibt_luas
			$gAlm  = $gDTA[1];	#kibt_letak
			$gHak  = $gDTA[2];	#kibt_stanah
			$gTglV = $gDTA[3];	#kibt_tglsert
			$gNom  = $gDTA[4];	#kibt_nosert
			$gGna  = $gDTA[5];	#kibt_penggunaan
			$gKTR = mysql_real_escape_string($gDTA[6]);#kibt_ket
			$gKTR = str_replace("(Buah) ()","",$gKTR);
			$gKTR = str_replace("(Unit) ()","",$gKTR);
		}
		
		$gMLK = $mRoB[4];#milik
		
		$gSTN  = $mRoB[5];#jumlah item barang
		if ($gSTN == 0) {$gSTN=1;}
		
		$gTTL  = $mRoB[6];#total
		$gHRG  = 0;
		if ($gTTL>0 && $gSTN>0){
			$gHRG  = round($gTTL/$gSTN,2);
		}
		
		$gFLD  = $mRoB[9];#akhir
		$gAHR  = 0;
		if ($gFLD>0 && $gSTN>0){
			$gAHR  = round($gFLD/$gSTN,2);
		}
		
		$gTgl  = substr($mRoB[7],0,10);#tgl perolehan
		$gAUS  = $mRoB[8];#asal-usul
		
		if (is_null($gAUS)) {$gAUS="APBD";}
		else if ($gAUS=="1" || $gAUS=="2" || $gAUS=="3" || $gAUS=="4" || $gAUS=="5" || $gAUS=="6" || $gAUS=="7" || $gAUS=="8" || $gAUS=="9" || $gAUS=="10") {$gAUS="APBD";}
		else if ($gAUS=="11" || $gAUS=="12" || $gAUS=="13" || $gAUS=="14" || $gAUS=="15" || $gAUS=="16" || $gAUS=="17" || $gAUS=="18" || $gAUS=="19" || $gAUS=="20") {$gAUS="APBD";}
		else if ($gAUS=="21" || $gAUS=="22" || $gAUS=="23" || $gAUS=="24" || $gAUS=="25" || $gAUS=="26" || $gAUS=="27" || $gAUS=="28" || $gAUS=="29" || $gAUS=="30") {$gAUS="APBD";}
		else if ($gAUS > 23) {$gAUS="APBD";}
		
		InsertKIBG_A($gUpb,$gRin,$gNma,$gLua,$gAlm,$gHak,$gTglV,$gNom,$gGna,$gKTR,$gMLK,$gTgl,$gAUS,$gSTN,$gHRG,$gTTL,$gAHR);
	}
	else if (substr($gReK,0,2)=="02")
	{
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
		
		$gFLD  = $mRoB[9];#akhir
		$gAHR  = 0;
		if ($gFLD>0 && $gSTN>0){
			$gAHR  = round($gFLD/$gSTN,2);
		}
		
		$gTgl  = substr($mRoB[7],0,10);#tgl perolehan
	
		$gAUS  = $mRoB[8];#asal-usul
		$gKir  = substr("000".$mRoB[9],-3,3);#kode ruang
		
		if (is_null($gAUS)) {$gAUS="APBD";}
		else if ($gAUS=="1" || $gAUS=="2" || $gAUS=="3" || $gAUS=="4" || $gAUS=="5" || $gAUS=="6" || $gAUS=="7" || $gAUS=="8" || $gAUS=="9" || $gAUS=="10") {$gAUS="APBD";}
		else if ($gAUS=="11" || $gAUS=="12" || $gAUS=="13" || $gAUS=="14" || $gAUS=="15" || $gAUS=="16" || $gAUS=="17" || $gAUS=="18" || $gAUS=="19" || $gAUS=="20") {$gAUS="APBD";}
		else if ($gAUS=="21" || $gAUS=="22" || $gAUS=="23" || $gAUS=="24" || $gAUS=="25" || $gAUS=="26" || $gAUS=="27" || $gAUS=="28" || $gAUS=="29" || $gAUS=="30") {$gAUS="APBD";}
		else if ($gAUS > 23) {$gAUS="APBD";}
		
		InsertKIBG_B($gUpb,$gRin,$gNma,$gKir,$gMrk,$gTyp,$gUCC,$gBHN,$gPBR,$gRKA,$gMSN,$gPLS,$gBPK,$gKTR,$gMLK,$gKND,$gAUS,$gMSM,$gSTN,$gHRG,$gTTL,$gAHR,$gTgl);	
	}
	else if (substr($gReK,0,2)=="03")
	{
		$gTKT = "Tidak";	#kibb_kons		(B,T=>Bertingkat,Tidak)
		$gBTN = "Tidak";	#kibb_beton	(B,T=>Beton,Tidak)
		$gTglD= "";			#kibb_tgldok
		$gNoD = "";			#kibb_nodok
		$gLti = 0;			#kibb_luasb
		$gSTT = "";			#kibb_statust
		$gLKS = "";			#kibb_letak
		$gKND = "B";		#kibb_kondisi
		$gKTR = "";			#kibb_ket
		
		$gDTA = fGlobal("kibb_kons:kibb_beton:kibb_tgldok:kibb_nodok:kibb_luasb:kibb_statust:kibb_letak:kibb_kondisi:kibb_ket","kib_data_asal_bangunan","kib_urut",$gIdK,"=","","");
		if ($gDTA){
			$gDTA = explode(":",$gDTA);
			$gTKT = $gDTA[0];		#kibb_kons		(B,T=>Bertingkat,Tidak)
			if ($gTKT=="B"){$gTKT="Bertingkat";} else {$gTKT="Tidak";}
			
			$gBTN = $gDTA[1];		#kibb_beton	(B,T=>Beton,Tidak)
			if ($gBTN=="B"){$gBTN="Beton";} else {$gBTN="Tidak";}
			
			$gTglD= substr($gDTA[2],0,10);		#kibb_tgldok
			$gNoD = str_replace("No:","",mysql_real_escape_string($gDTA[3]));#kibb_nodok
			
			$gLti = $gDTA[4];		#kibb_luasb
			$gSTT = $gDTA[5];		#kibb_statust
			$gLKS = str_replace(":"," ",mysql_real_escape_string($gDTA[6]));#kibb_letak
			
			$gKND = $gDTA[7];		#kibb_kondisi
			if ($gKND=="B"){$gKND="B";}
			if ($gKND=="R"){$gKND="R";}
			if ($gKND=="H"){$gKND="RR";}
			if ($gKND=="T"){$gKND="TD";}
			
			$gKTR = mysql_real_escape_string($gDTA[8]);		#kibb_ket
			$gKTR = str_replace("(Buah) ()","",$gKTR);
			$gKTR = str_replace("(Unit) ()","",$gKTR);
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
		
		$gFLD  = $mRoB[9];#akhir
		$gAHR  = 0;
		if ($gFLD>0 && $gSTN>0){
			$gAHR  = round($gFLD/$gSTN,2);
		}
		
		$gTgl  = substr($mRoB[7],0,10);#tgl perolehan
		$gAUS  = $mRoB[8];#asal-usul
		
		if (is_null($gAUS)) {$gAUS="APBD";}
		else if ($gAUS=="1" || $gAUS=="2" || $gAUS=="3" || $gAUS=="4" || $gAUS=="5" || $gAUS=="6" || $gAUS=="7" || $gAUS=="8" || $gAUS=="9" || $gAUS=="10") {$gAUS="APBD";}
		else if ($gAUS=="11" || $gAUS=="12" || $gAUS=="13" || $gAUS=="14" || $gAUS=="15" || $gAUS=="16" || $gAUS=="17" || $gAUS=="18" || $gAUS=="19" || $gAUS=="20") {$gAUS="APBD";}
		else if ($gAUS=="21" || $gAUS=="22" || $gAUS=="23" || $gAUS=="24" || $gAUS=="25" || $gAUS=="26" || $gAUS=="27" || $gAUS=="28" || $gAUS=="29" || $gAUS=="30") {$gAUS="APBD";}
		else if ($gAUS > 23) {$gAUS="APBD";}
		
		InsertKIBG_C($gUpb,$gRin,$gNma,$gTKT,$gBTN,$gKTR,$gTgl,$gTglD,$gNoD,$gLti,$gSTT,$gLKS,$gMLK,$gKND,$gAUS,$gMSM,$gSTN,$gHRG,$gTTL,$gAHR);
	}
	else if (substr($gReK,0,2)=="04")
	{
		########
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
		
		$gFLD  = $mRoB[9];#akhir
		$gAHR  = 0;
		if ($gFLD>0 && $gSTN>0){
			$gAHR  = round($gFLD/$gSTN,2);
		}
		
		$gTgl  = substr($mRoB[7],0,10);#tgl perolehan-> ok
		$gAUS  = $mRoB[8];#asal-usul	
		
		if (is_null($gAUS)) {$gAUS="APBD";}
		else if ($gAUS=="1" || $gAUS=="2" || $gAUS=="3" || $gAUS=="4" || $gAUS=="5" || $gAUS=="6" || $gAUS=="7" || $gAUS=="8" || $gAUS=="9" || $gAUS=="10") {$gAUS="APBD";}
		else if ($gAUS=="11" || $gAUS=="12" || $gAUS=="13" || $gAUS=="14" || $gAUS=="15" || $gAUS=="16" || $gAUS=="17" || $gAUS=="18" || $gAUS=="19" || $gAUS=="20") {$gAUS="APBD";}
		else if ($gAUS=="21" || $gAUS=="22" || $gAUS=="23" || $gAUS=="24" || $gAUS=="25" || $gAUS=="26" || $gAUS=="27" || $gAUS=="28" || $gAUS=="29" || $gAUS=="30") {$gAUS="APBD";}
		else if ($gAUS > 23) {$gAUS="APBD";}
		
		InsertKIBG_D($gUpb,$gRin,$gNma,$gKNS,$gTgl,$gTglD,$gNoD,$gPJG,$gLBR,$gLUA,$gSTT,$gKTR,$gLKS,$gMLK,$gKND,$gAUS,$gMSM,$gSTN,$gHRG,$gTTL,$gAHR);	
		#######
	}
	else if (substr($gReK,0,2)=="05")
	{
		############
		$gJDL  = "";	#kibe_judul
		$gSPS  = "";	#kibe_spesifikasi
		$gBHN  = "";	#kibe_bahan
		$gThnC = "0";	#
		$gDRH  = "";	#kibe_asal_daerah
		$gJNS  = "";	#kibe_jenis
		$gPCP  = "";	#kibe_pencipta
		$gUKU  = "0";	#kibe_ukuran
		$gKND  = "B";	#kibr_kondisi
		$gKTR  = "";	#kibr_ket
		
		$gDTA = fGlobal("kibe_judul:kibe_spesifikasi:kibe_bahan:kibe_asal_daerah:kibe_jenis:kibe_pencipta:kibe_ukuran:kibr_kondisi:kibr_ket","kib_data_asal_e_barang_new","kib_urut",$gIdK,"=","","");
		if ($gDTA){
			$gDTA = explode(":",$gDTA);
			$gJDL  = mysql_real_escape_string($gDTA[0]);#kibe_judul
			$gSPS  = mysql_real_escape_string($gDTA[1]);#kibe_spesifikasi
			$gBHN  = mysql_real_escape_string($gDTA[2]);#kibe_bahan
			$gThnC = "0";#
			$gDRH  = mysql_real_escape_string($gDTA[3]);#kibe_asal_daerah
			$gJNS  = mysql_real_escape_string($gDTA[4]);#kibe_jenis
			$gPCP  = mysql_real_escape_string($gDTA[5]);#kibe_pencipta
			$gUKU  = $gDTA[6];	#kibe_ukuran
			if (is_null($gUKU) || $gUKU=="") {$gUKU=0;}
			$gKND = $gDTA[7];	#kibb_kondisi
			if ($gKND=="B"){$gKND="B";}
			if ($gKND=="R"){$gKND="R";}
			if ($gKND=="H"){$gKND="RR";}
			if ($gKND=="T"){$gKND="TD";}
			
			$gKTR = mysql_real_escape_string($gDTA[8]);		#kibr_ket
			$gKTR = str_replace("(Buah) ()","",$gKTR);
			$gKTR = str_replace("(Unit) ()","",$gKTR);
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
		
		$gFLD  = $mRoB[9];#akhir
		$gAHR  = 0;
		if ($gFLD>0 && $gSTN>0){
			$gAHR  = round($gFLD/$gSTN,2);
		}
		
		$gTgl  = substr($mRoB[7],0,10);#tgl perolehan
		$gAUS  = $mRoB[8];#asal-usul
		
		if (is_null($gAUS)) {$gAUS="APBD";}
		else if ($gAUS=="1" || $gAUS=="2" || $gAUS=="3" || $gAUS=="4" || $gAUS=="5" || $gAUS=="6" || $gAUS=="7" || $gAUS=="8" || $gAUS=="9" || $gAUS=="10") {$gAUS="APBD";}
		else if ($gAUS=="11" || $gAUS=="12" || $gAUS=="13" || $gAUS=="14" || $gAUS=="15" || $gAUS=="16" || $gAUS=="17" || $gAUS=="18" || $gAUS=="19" || $gAUS=="20") {$gAUS="APBD";}
		else if ($gAUS=="21" || $gAUS=="22" || $gAUS=="23" || $gAUS=="24" || $gAUS=="25" || $gAUS=="26" || $gAUS=="27" || $gAUS=="28" || $gAUS=="29" || $gAUS=="30") {$gAUS="APBD";}
		else if ($gAUS > 23) {$gAUS="APBD";}
	
		InsertKIBG_E($gUpb,$gRin,$gNma,$gTgl,$gJDL,$gSPS,$gBHN,$gThnC,$gDRH,$gJNS,$gPCP,$gUKU,$gMLK,$gKND,$gAUS,$gMSM,$gSTN,$gHRG,$gTTL,$gAHR);
		############
	}
}

function InsertKIBG_A($gUpb,$gRin,$gNma,$gLua,$gAlm,$gHak,$gTglV,$gNom,$gGna,$gKTR,$gMLK,$gTgl,$gAUS,$gSTN,$gHRG,$gTTL,$gAHR)
{
	$NewRefGrp ="";
	$NewReGAset="";
	
	if ($gSTN > 1)
	{
		$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_g WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
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
			require "Insert_KIB_GA.php";
		}
	}
	else
	{
		$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_g WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
		$nRst = mysql_query($nSQL) or die(mysql_error());
		$nRow = mysql_fetch_assoc($nRst);
		$NewG = $nRow['LasReG'];
		$LastReG = ((int)$NewG) + 1;
		$NewReGAset = fMakeRegister($LastReG,7);
		
		require "Insert_KIB_GA.php";
	}
}

function InsertKIBG_B($gUpb,$gRin,$gNma,$gKir,$gMrk,$gTyp,$gUCC,$gBHN,$gPBR,$gRKA,$gMSN,$gPLS,$gBPK,$gKTR,$gMLK,$gKND,$gAUS,$gMSM,$gSTN,$gHRG,$gTTL,$gAHR,$gTgl)
{
	$NewRefGrp ="";
	$NewReGAset="";
	
	if ($gSTN > 1)
	{
		$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_g WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
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
			require "Insert_KIB_GB.php";
		}
	}
	else
	{
		$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_g WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
		$nRst = mysql_query($nSQL) or die(mysql_error());
		$nRow = mysql_fetch_assoc($nRst);
		$NewG = $nRow['LasReG'];
		$LastReG = ((int)$NewG) + 1;
		$NewReGAset = fMakeRegister($LastReG,7);
		
		require "Insert_KIB_GB.php";
	}
}

function InsertKIBG_C($gUpb,$gRin,$gNma,$gTKT,$gBTN,$gKTR,$gTgl,$gTglD,$gNoD,$gLti,$gSTT,$gLKS,$gMLK,$gKND,$gAUS,$gMSM,$gSTN,$gHRG,$gTTL,$gAHR)
{
	$NewRefGrp ="";
	$NewReGAset="";
	
	if ($gSTN > 1)
	{
		$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_g WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
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
			require "Insert_KIB_GC.php";
		}
	}
	else
	{
		$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_g WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
		$nRst = mysql_query($nSQL) or die(mysql_error());
		$nRow = mysql_fetch_assoc($nRst);
		$NewG = $nRow['LasReG'];
		$LastReG = ((int)$NewG) + 1;
		$NewReGAset = fMakeRegister($LastReG,7);
		
		require "Insert_KIB_GC.php";
	}
}

function InsertKIBG_D($gUpb,$gRin,$gNma,$gKNS,$gTgl,$gTglD,$gNoD,$gPJG,$gLBR,$gLUA,$gSTT,$gKTR,$gLKS,$gMLK,$gKND,$gAUS,$gMSM,$gSTN,$gHRG,$gTTL,$gAHR)
{
	$NewRefGrp ="";
	$NewReGAset="";
	
	if ($gSTN > 1)
	{
		$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_g WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
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
			require "Insert_KIB_GD.php";
		}
	}
	else
	{
		$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_g WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
		$nRst = mysql_query($nSQL) or die(mysql_error());
		$nRow = mysql_fetch_assoc($nRst);
		$NewG = $nRow['LasReG'];
		$LastReG = ((int)$NewG) + 1;
		$NewReGAset = fMakeRegister($LastReG,7);
		
		require "Insert_KIB_GD.php";
	}
}

function InsertKIBG_E($gUpb,$gRin,$gNma,$gTgl,$gJDL,$gSPS,$gBHN,$gThnC,$gDRH,$gJNS,$gPCP,$gUKU,$gMLK,$gKND,$gAUS,$gMSM,$gSTN,$gHRG,$gTTL,$gAHR)
{
	$NewRefGrp ="";
	$NewReGAset="";
	
	$FldUpdt="";
	$FldUpdt.="Judul='$gJDL',Spesifikasi='$gSPS',Tahun='$gThnC',";
	$FldUpdt.="Daerah_Asal='$gDRH',Pencipta='$gPCP',Bahan='$gBHN',";
	$FldUpdt.="Jenis='$gJNS',Ukuran='$gUKU'";
	
	#if ($gSTN>500) {$gSTN=1;}
	if ($gSTN > 1)
	{
		$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_g WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
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
			require "Insert_KIB_GE.php";
		}
	}
	else
	{
		$nSQL = "SELECT IFNULL(MAX(No_Register),0) AS LasReG FROM ta_kib_g WHERE Kd_Aset='".$gRin."' AND Kd_Upb='".$gUpb."'";
		$nRst = mysql_query($nSQL) or die(mysql_error());
		$nRow = mysql_fetch_assoc($nRst);
		$NewG = $nRow['LasReG'];
		$LastReG = ((int)$NewG) + 1;
		$NewReGAset = fMakeRegister($LastReG,7);
		
		require "Insert_KIB_GE.php";
	}
}
echo "PROSES DONE..!!";
?>
<script language="javascript">
P_Find()
</script>