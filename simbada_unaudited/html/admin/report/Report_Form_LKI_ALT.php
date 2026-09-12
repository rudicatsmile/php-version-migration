<?
require('../Connection.php');
require('../FileFunction.php');
extract($_GET);

$DT = fGlobal("kd_aset_108:no_register:kd_upb:tgl_perolehan:kd_pemilik:extracom:referensi:kd_ruang","ta_kib_108_sensus_2023","IDT",$IdT,"=","","");
if ($DT)
{
	$DT = explode(':',$DT);
	$kdA = $DT[0];
	$noR = $DT[1];
	$upB = $DT[2];
	$tgL = $DT[3];
	$mlK = $DT[4];
	$exT = $DT[5];
	$reF = $DT[6];
	$KdR = $DT[7];
	if ($exT=='Y'){
		$exT = '00';
	}
	else{
		$exT = '01';
	}
	
	$tgL = explode('-',$tgL);
	$thA = substr($tgL[0],0,1);
	$thB = substr($tgL[0],1,1);
	$thC = substr($tgL[0],2,1);
	$thD = substr($tgL[0],3,1);
}

$fLokasi = substr($mlK,0,1).substr($mlK,0,1).substr($mlK,-1,1).".".substr($exT,0,1).substr($exT,-1,1).'.'.substr($upB,0,1).substr($upB,1,1).'.'.substr($upB,3,1).substr($upB,4,1).'.'.substr($upB,6,1).substr($upB,7,1).substr($upB,9,1).substr($upB,10,1).substr($upB,12,1).substr($upB,13,1).'.'.'00'.substr($upB,-3,1).substr($upB,-2,1).substr($upB,-1,1).'.00'.substr($KdR,-3,1).substr($KdR,-2,1).substr($KdR,-1,1).'.'.$thA.$thB.$thC.$thD;
$nSQ = "SELECT 
P1.IDT as A0,
P1.Referensi as A1,
P1.Ref_Group as A2,
P1.Ref_Mutasi as A3,
P1.Ref_Usulan as A4,
P1.Ref_History as A5,
P1.Ref_Usulan_His as A6,
P1.Ref_KdpToAset as A7,
P1.Kd_UPB as A8,
P1.Kd_Aset_108 as A9,
P1.Kd_Ruang as A10,
P1.No_Register as A11,
P1.No_Pengadaan as A12,
P1.Ref_Temp as A13,
P1.Nm_Aset as A14,
P1.Kd_Pemilik as A15,
P1.Tgl_Perolehan as A16,
P1.Tgl_Mutasi as A17,
P1.Tgl_Mulai as A18,
P1.Tahun as A19,
P1.Luas_M2 as A20,
P1.Alamat as A21,
P1.Hak_Tanah as A22,
P1.Sertifikat as A23,
P1.Sertifikat_Tanggal as A24,
P1.Sertifikat_Nomor as A25,
P1.Penggunaan as A26,
P1.Asal_Usul as A27,
P1.Harga as A28,
P1.Merk as A29,
P1.Type as A30,
P1.Ukuran_CC as A31,
P1.Bahan as A32,
P1.Nomor_Pabrik as A33,
P1.Nomor_Rangka as A34,
P1.Nomor_Mesin as A35,
P1.Nomor_Polisi as A36,
'' as A37,
P1.Nomor_BPKB as A38,
P1.Pemegang as A39,
P1.Pemegang_Lama as A40,
P1.Kondisi as A41,
P1.Masa_Manfaat as A42,
P1.Nilai_Akhir as A43,
P1.Bertingkat as A44,
P1.Beton as A45,
P1.Luas_Lantai as A46,
P1.Lokasi as A47,
P1.Dokumen_Tanggal as A48,
P1.Dokumen_Nomor as A49,
P1.Status_Tanah as A50,
P1.Luas_Tanah as A51,
P1.Kode_Tanah as A52,
P1.Konstruksi as A53,
P1.Panjang as A54,
P1.Lebar as A55,
P1.Luas as A56,
P1.Judul as A57,
P1.Spesifikasi as A58,
P1.Pencipta as A59,
P1.Daerah_Asal as A60,
P1.Jenis as A061,
P1.Tipe_Bangunan as A62,
P1.Ukuran as A63,
P1.Keterangan as A64,
ifnull(sum(P2.Debet),0) as A65,
P1.lat_lng as A66,
P1.file_name as A67,
P1.file_size as A68 
FROM ta_kib_108_sensus_2023 P1
LEFT JOIN ta_kib_post_108_sensus_2023 P2 ON P2.Referensi=P1.Referensi AND P2.Kd_UPB=P1.Kd_UPB 
WHERE P1.IDT ='".$IdT."'";
#echo $nSQ;
$nRs = mysql_query($nSQ);
$mRo = mysql_fetch_array($nRs, MYSQL_BOTH);

$mRo67 = fGlobal("file_name","ta_kib_108","Referensi:Ref_Group",$mRo[1].":".$mRo[2],"=:=","","");
$mRo68 = fGlobal("file_size","ta_kib_108","Referensi:Ref_Group",$mRo[1].":".$mRo[2],"=:=","","");

$SnsIDT = fGlobal("IDT","tb_lembar_kerja","Referensi:KdUPB:RefGroup",$mRo[1].":".$mRo[8].":".$mRo[2],"=:=:=","","");
if ($SnsIDT=='')
{
	$SQ = "INSERT INTO tb_lembar_kerja SET 
	Referensi='".$mRo[1]."',
	RefGroup='".$mRo[2]."',
	KdUPB='".$mRo[8]."',
	
	KdRegister='sesuai',
	KdRegisterMemo='',
	KdBarang='sesuai',
	KdBarangMemo='',
	NmBarang='sesuai',
	NmBarangMemo='',
	SpecNamaBarang='sesuai',
	SpecNamaBarangMemo='',
	JmlBarang='1',
	SatuanBarang='-',
	KeberadaanBarang='ada',
	NilaiPerolehan='".$mRo[65]."',
	MerupakanAtribusi='tidak',
	Alamat='sesuai',
	
	KondisiBarangAsal='".$mRo[41]."',
	KondisiBarang='".$mRo[41]."',
	
	PenggunaanBarang='PD',
	DataTercatatGanda='tidak',
	TitikKoordinat='".$mRo[66]."',
	Lainnya='',
	Keterangan='',
	NoPolisi='sesuai',
	NoRangka='sesuai',
	NoBPKB='sesuai'
	
	";
	#echo $SQ;
	$rs = mysql_query($SQ);
	
}

$SnsPGG = fGlobal("IDT","tb_lembar_kerja_penggunaan","Referensi:KdUPB:RefGroup",$mRo[1].":".$mRo[8].":".$mRo[2],"=:=:=","","");
if ($SnsPGG=='')
{
	$SQ = "INSERT INTO tb_lembar_kerja_penggunaan SET 
	Referensi='".$mRo[1]."',
	RefGroup='".$mRo[2]."',
	KdUPB='".$mRo[8]."',
	
	PD_NmKuasaPenggunaLainnya='',
	PD_NmPemakai='',
	PD_StatusPemakai='',
	PD_BastPemakaian='tidakada',
	
	PP_dasarpenggunaan='tidakada',
	PP_dasarpenggunaan_ada_nama='',
	PP_dasarpenggunaan_ada_namadokumen='',
	PP_dasarpenggunaan_tidakada_nama='',
	
	PDL_dasarpenggunaan='tidakada',
	PDL_dasarpenggunaan_ada_nama='',
	PDL_dasarpenggunaan_ada_namadokumen='',
	PDL_dasarpenggunaan_tidakada_nama='',
	
	PL_dasarpenggunaan='tidakada',
	PL_dasarpenggunaan_ada_nama='',
	PL_dasarpenggunaan_ada_namadokumen='',
	PL_dasarpenggunaan_tidakada_nama=''";
	$rs = mysql_query($SQ);
}

$SnsGND = fGlobal("IDT","tb_lembar_kerja_tercatat_ganda","Referensi:KdUPB:RefGroup",$mRo[1].":".$mRo[8].":".$mRo[2],"=:=:=","","");
if ($SnsGND=='')
{
	$SQ = "INSERT INTO tb_lembar_kerja_tercatat_ganda SET 
	Referensi='".$mRo[1]."',
	RefGroup='".$mRo[2]."',
	KdUPB='".$mRo[8]."'";
	$rs = mysql_query($SQ);
}

$SnsATR = fGlobal("IDT","tb_lembar_kerja_merupakan_biaya_atribusi","Referensi:KdUPB:RefGroup",$mRo[1].":".$mRo[8].":".$mRo[2],"=:=:=","","");
if ($SnsATR=='')
{
	$SQ = "INSERT INTO tb_lembar_kerja_merupakan_biaya_atribusi SET 
	Referensi='".$mRo[1]."',
	RefGroup='".$mRo[2]."',
	KdUPB='".$mRo[8]."'";
	$rs = mysql_query($SQ);
}

$SQ = "SELECT 
IDT as A0,
Referensi as A1,
RefGroup as A2,
KdUPB as A3,

KdRegister as A4,
KdRegisterMemo as A5,
KdBarang as A6,
KdBarangMemo as A7,
NmBarang as A8,
NmBarangMemo as A9,
SpecNamaBarang as A10,
SpecNamaBarangMemo as A11,
JmlBarang as A12,
SatuanBarang as A13,
KeberadaanBarang as A14,
NilaiPerolehan as A15,
MerupakanAtribusi as A16,
Alamat as A17,
AlamatMemo as A18,
KondisiBarang as A19,
PenggunaanBarang as A20,
DataTercatatGanda as A21,
TitikKoordinat as A22,
Lainnya as A23,
Keterangan as A24,
TanggalSensus as A25,

PetugasSensus_1 as A26,
PetugasSensus_2 as A27,
PetugasSensus_3 as A28,
PetugasSensus_4 as A29,
PetugasSensus_ttd as A30,

NoPolisi as A31,
NoPolisiMemo as A32,
NoRangka as A33,
NoRangkaMemo as A34,
NoBPKB as A35, 
NoBPKBMemo as A36,
MerupakanAtribusi_induk as A37,
DataSensusFix as A38,
KeberadaanBarang_tidakada_jmlh as A39,
KeberadaanBarang_tidakada as A40 

FROM tb_lembar_kerja WHERE Referensi='".$mRo[1]."' AND KdUPB='".$mRo[8]."' AND RefGroup='".$mRo[2]."'";
$rs = mysql_query($SQ);
$mR = mysql_fetch_array($rs, MYSQL_BOTH);

$gTG = $mR[25];
$gTG = explode('-',$gTG);
$gTH = $gTG[0];
$gBL = $gTG[1];
$gHR = $gTG[2];

$SnsIDT = $mR[0];

$CkPol1 = ""; $CkPol2 = ""; 
$CkPolM = ""; $CkPolR = "";
if ($mR[31]=='sesuai') {
	$CkPol1 = "checked"; $CkPolR = 'disabled';
}
else {
	$CkPol2 = "checked"; $CkPolM = $mR[32];
}

$CkRan1 = ""; $CkRan2 = ""; 
$CkRanM = ""; $CkRanR = "";
if ($mR[33]=='sesuai') {
	$CkRan1 = "checked"; $CkRanR = 'disabled';
}
else {
	$CkRan2 = "checked"; $CkRanM = $mR[34];
}

$CkBpk1 = ""; $CkBpk2 = ""; 
$CkBpkM = ""; $CkBpkR = "";
if ($mR[35]=='sesuai') {
	$CkBpk1 = "checked"; $CkBpkR = 'disabled';
}
else {
	$CkBpk2 = "checked"; $CkBpkM = $mR[36];
}

$CkReg1 = ""; $CkReg2 = "";
$CkRegM = ""; $CkRegR = "";
if ($mR[4]=='sesuai') {
	$CkReg1 = "checked"; $CkRegR='disabled';
}
else {
	$CkReg2 = "checked"; $CkRegM = $mR[5];
}

$CkKdb1 = ""; $CkKdb2 = ""; 
$CkKdbM = ""; $CkKdbR = "";
if ($mR[6]=='sesuai') {
	$CkKdb1 = "checked"; $CkKdbR = 'disabled';
}
else {
	$CkKdb2 = "checked"; $CkKdbM = $mR[7];
}

$CkNmb1 = ""; $CkNmb2 = ""; 
$CkNmbM = ""; $CkNmbR = "";
if ($mR[8]=='sesuai') {
	$CkNmb1 = "checked"; $CkNmbR = 'disabled';
}
else {
	$CkNmb2 = "checked"; $CkNmbM = $mR[9];
}

$CkSpc1 = ""; $CkSpc2 = ""; 
$CkSpcM = ""; $CkSpcR = "";
if ($mR[10]=='sesuai') {
	$CkSpc1 = "checked"; $CkSpcR = 'disabled';
}
else {
	$CkSpc2 = "checked"; $CkSpcM = $mR[11];
}

$JmlBRG = $mR[12];
$SatBRG = $mR[13];

$CkAda1 = ""; $CkAda2 = ""; 
$JmlBRGJmL   = "0";
$JmlBRGJmLR  = "readonly";
$CktidkAda1 = "";
$CktidkAda2 = "";
$CktidkAda1D = "disabled";
$CktidkAda2D = "disabled";

if ($mR[14]=='ada') {
	$CkAda1 = "checked";
	
}
else {
	
	$CkAda2 = "checked";
	
	$JmlBRGJmL  = $mR[39];
	$JmlBRGJmLR = "";
	
	$CktidkAda1D = "";
	$CktidkAda2D = "";
	
	
	if ($mR[40]=='hilang')
	{
		$CktidkAda1 = "checked";
	}
	else if ($mR[40]=='tidakditemukan')
	{
		$CktidkAda2 = "checked";
	}
}

$NilPER = $mR[15];

#$CkIndk1 = ""; $CkIndk2 = ""; 
#if ($mR[37]=='diketahui') {
#	$CkIndk1 = "checked";
#}
#else {
#	$CkIndk2 = "checked";
#}

$CkAtr1   = ""; $CkAtr2 = ""; 
$CkIndk1  = ""; $CkIndk2 = ""; 
$CkIndk1D = ""; $CkIndk2D = ""; 
if ($mR[16]=='ya') 
{
	$CkAtr1 = "checked";
	
	if ($mR[37]=='diketahui') 
	{
		$CkIndk1 = "checked";
	}
	else 
	{
		$CkIndk2 = "checked";
	}
}
else 
{
	$CkAtr2   = "checked";
	$CkIndk1D = "disabled"; 
	$CkIndk2D = "disabled"; 
}


$SA = "SELECT 
IDT as A0,
Referensi as A1,
RefGroup as A2,
KdUPB as A3,
Nibar as A4,
KodeBarang as A5,
KodeLokasi as A6,
KodeRegister as A7,
NamaBarang as A8,
NamaSpesifikasiBarang as A9 
FROM tb_lembar_kerja_merupakan_biaya_atribusi WHERE Referensi='".$mRo[1]."' AND KdUPB='".$mRo[8]."' AND RefGroup='".$mRo[2]."'";
$rA = mysql_query($SA);
$mA = mysql_fetch_array($rA, MYSQL_BOTH);
$SnsATR    = $mA[0];

$Atribusi1 = "";
$Atribusi2 = "";
$Atribusi3 = "";
$Atribusi4 = "";
$Atribusi5 = "";
$Atribusi6 = "";

$Atribusi1R = "disabled";
$Atribusi2R = "disabled";
$Atribusi3R = "disabled";
$Atribusi4R = "disabled";
$Atribusi5R = "disabled";
$Atribusi6R = "disabled";

if ($CkIndk1=='checked')
{
	$Atribusi1 = $mA[4]; 
	$Atribusi2 = $mA[5]; 
	$Atribusi3 = $mA[6]; 
	$Atribusi4 = $mA[7]; 
	$Atribusi5 = $mA[8]; 
	$Atribusi6 = $mA[9]; 
	
	$Atribusi1R = "";
	$Atribusi2R = "";
	$Atribusi3R = "";
	$Atribusi4R = "";
	$Atribusi5R = "";
	$Atribusi6R = "";
}

$CkAlm1 = ""; $CkAlm2 = ""; 
$CkAlmM = ""; $CkAlmR = "";
if ($mR[17]=='sesuai') {
	$CkAlm1 = "checked"; $CkAlmR = 'disabled';
}
else {
	$CkAlm2 = "checked"; $CkAlmM = $mR[18];
}

$CkKon1 = ""; $CkKon2 = ""; $CkKon3 = ""; 
if ($mR[19]=='B') {
	$CkKon1 = "checked";
}
else if ($mR[19]=='RR') {
	$CkKon2 = "checked";
}
else {
	$CkKon3 = "checked";
}

$CkGun1 = ""; $CkGun2 = ""; $CkGun3 = ""; $CkGun4 = ""; 
if ($mR[20]=='PD') {
	$CkGun1 = "checked";
}
else if ($mR[20]=='PP') {
	$CkGun2 = "checked";
}
else if ($mR[20]=='PDL') {
	$CkGun3 = "checked";
}
else {
	$CkGun4 = "checked";
}

$SG = "SELECT 
IDT as A0,
PD_NmKuasaPenggunaLainnya as A1,
PP_dasarpenggunaan as A2,
PP_dasarpenggunaan_ada_nama as A3,
PP_dasarpenggunaan_ada_namadokumen as A4,
PP_dasarpenggunaan_tidakada_nama as A5,

PDL_dasarpenggunaan as A6,
PDL_dasarpenggunaan_ada_nama as A7,
PDL_dasarpenggunaan_ada_namadokumen as A8,
PDL_dasarpenggunaan_tidakada_nama as A9,

PL_dasarpenggunaan as A10,
PL_dasarpenggunaan_ada_nama as A11,
PL_dasarpenggunaan_ada_namadokumen as A12,
PL_dasarpenggunaan_tidakada_nama as A13,

PD_NmPemakai as A14,
PD_StatusPemakai as A15,
PD_BastPemakaian as A16 

FROM tb_lembar_kerja_penggunaan WHERE Referensi='".$mRo[1]."' AND KdUPB='".$mRo[8]."' AND RefGroup='".$mRo[2]."'";
$re = mysql_query($SG);
$mG = mysql_fetch_array($re, MYSQL_BOTH);
$SnsIDG  = $mG[0];

$NmKuasa  = "";
$NmKuasaR = 'disabled';
$NmPemakai  = "";
$NmPemakaiR = 'disabled';
$StPemakai  = "";
$StPemakaiR = 'disabled';

$CkDsrPP1  = ""; $CkDsrPP2 = "";
$CkDsrPPR1 = "disabled"; $CkDsrPPR2 = "disabled";

$CkDsrPDL1 = ""; $CkDsrPDL2 = "";
$CkDsrPDLR1 = "disabled"; $CkDsrPDLR2 = "disabled";

$CkDsrPL1  = ""; $CkDsrPL2  = "";
$CkDsrPLR1 = "disabled"; $CkDsrPLR2 = "disabled";

if ($CkGun1 == "checked")
{
	$NmKuasa  = $mG[1];
	$NmKuasaR = '';
	
	$NmPemakai  = $mG[14];
	$NmPemakaiR = '';

	$StPemakai  = $mG[15];
	$StPemakaiR = '';
}

$PP_Ada_Nama  = "";
$PP_Ada_NamaR = "disabled";
$PP_Ada_NamaDoc  = "";
$PP_Ada_NamaDocR = "disabled";
$PP_TdkAda_Nama  = "";
$PP_TdkAda_NamaR = "disabled";

$CkBasPD1 = ""; $CkBasPDR1 = "";
$CkBasPD2 = ""; $CkBasPDR2 = "";

if ($mG[16]=='ada') 
{
	$CkBasPD1 = "checked";
}
else
{
	$CkBasPD2 = "checked";
}


if ($CkGun2 == "checked")
{
	$CkBasPD1 = "";
	$CkBasPD2 = "";

	$CkBasPDR1 = "disabled";
	$CkBasPDR2 = "disabled";

	$CkDsrPPR1 = ""; $CkDsrPPR2 = "";
	if ($mG[2]=='ada') {
		$CkDsrPP1 = "checked";
		
		$PP_Ada_Nama = $mG[3];
		$PP_Ada_NamaR= "";
		
		$PP_Ada_NamaDoc  = $mG[4];
		$PP_Ada_NamaDocR = "";
	}
	else 
	{
		$CkDsrPP2 = "checked";
		$PP_TdkAda_Nama  = $mG[5];
		$PP_TdkAda_NamaR = "";
	}
}

$PDL_Ada_Nama  = "";
$PDL_Ada_NamaR = "disabled";
$PDL_Ada_NamaDoc  = "";
$PDL_Ada_NamaDocR = "disabled";
$PDL_TdkAda_Nama  = "";
$PDL_TdkAda_NamaR = "disabled";

if ($CkGun3 == "checked")
{
	$CkDsrPDLR1 = ""; $CkDsrPDLR2 = "";
	if ($mG[6]=='ada') {
		$CkDsrPDL1 = "checked";
		$PDL_Ada_Nama  = $mG[7];
		$PDL_Ada_NamaR = "";
		$PDL_Ada_NamaDoc  = $mG[8];
		$PDL_Ada_NamaDocR = "";
	}
	else {
		$CkDsrPDL2 = "checked";
		$PDL_TdkAda_Nama  = $mG[9];
		$PDL_TdkAda_NamaR = "";
	}
}

$PL_Ada_Nama  = "";
$PL_Ada_NamaR = "disabled";
$PL_Ada_NamaDoc  = "";
$PL_Ada_NamaDocR = "disabled";
$PL_TdkAda_Nama  = "";
$PL_TdkAda_NamaR = "disabled";
if ($CkGun4 == "checked")
{
	$CkDsrPLR1 = ""; $CkDsrPLR2 = "";
	if ($mG[10]=='ada') {
		$CkDsrPL1 = "checked";
		$PL_Ada_Nama  = $mG[11];
		$PL_Ada_NamaR = "";
		$PL_Ada_NamaDoc  = $mG[12];
		$PL_Ada_NamaDocR = "";
	}
	else {
		$CkDsrPL2 = "checked";
		$PL_TdkAda_Nama  = $mG[13];
		$PL_TdkAda_NamaR = "";
	}
}

$CkGan1=''; 
$CkGan2='';

if ($mR[21]=='tidak') {
	$CkGan1 = "checked";
}
else {
	$CkGan2 = "checked";
}

$CkFix1=''; 
$CkFix2='';

if ($mR[38]=='N') {
	$CkFix1 = "checked";
}
else if ($mR[38]=='P') {
	$CkFix2 = "checked";
}
else {
	$CkFix3 = "checked";
}

$SD = "SELECT 
IDT as A0,
Referensi as A1,
RefGroup as A2,
KdUPB as A3,
Nibar as A4,
KodeRegister as A5,
KodeBarang as A6,
NamaBarang as A7,
NamaSpesifikasiBarang as A8,
JmlBarang as A9,
Satuan as A10,
NilaiPerolehan as A11,
TanggalBulanTahunPerolehan as A12,
KuasaPenggunaBarang as A13 

FROM tb_lembar_kerja_tercatat_ganda WHERE Referensi='".$mRo[1]."' AND KdUPB='".$mRo[8]."' AND RefGroup='".$mRo[2]."'";
$rD = mysql_query($SD);
$mD = mysql_fetch_array($rD, MYSQL_BOTH);
$SnsGND   = $mD[0];

$CttGand1 = "";
$CttGand2 = "";
$CttGand3 = "";
$CttGand4 = "";
$CttGand5 = "";
$CttGand6 = "";
$CttGand7 = "";
$CttGand8 = "";
$CttGand9 = "";
$CttGand10= "";

$CttGand1R = "disabled";
$CttGand2R = "disabled";
$CttGand3R = "disabled";
$CttGand4R = "disabled";
$CttGand5R = "disabled";
$CttGand6R = "disabled";
$CttGand7R = "disabled";
$CttGand8R = "disabled";
$CttGand9R = "disabled";
$CttGand10R= "disabled";
if ($CkGan2 == "checked")
{
	$CttGand1 = $mD[4];
	$CttGand2 = $mD[5];
	$CttGand3 = $mD[6];
	$CttGand4 = $mD[7];
	$CttGand5 = $mD[8];
	$CttGand6 = $mD[9];
	$CttGand7 = $mD[10];
	$CttGand8 = fConvertToRupiah($mD[11]);
	$CttGand9 = $mD[12];
	$CttGand10= $mD[13];
	
	$CttGand1R = "";
	$CttGand2R = "";
	$CttGand3R = "";
	$CttGand4R = "";
	$CttGand5R = "";
	$CttGand6R = "";
	$CttGand7R = "";
	$CttGand8R = "";
	$CttGand9R = "";
	$CttGand10R= "";
}

$Koordinat = $mR[22];
$Lainnya   = $mR[23];
$Keterang  = $mR[24];

$Petugas = fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$mR[30],"=","","");
$Nipetug = fGlobal("NiPetugas","tb_lembar_kerja_petugas","IdPetugas",$mR[30],"=","","");
?>
<table align="center" cellpadding="0" cellspacing="0" border="0" style="width:800px; border:1px solid #000; font-family:calibri">
	<tr height="20">
	  <td width="10" style="border-bottom:1px solid #000">&nbsp;</td>
	  <td width="684" style="border-bottom:1px solid #000">
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
          <td>&nbsp;</td>
          <td width="100">Format : III.A.2</td>
        </tr>
      </table>	  </td>
	</tr>
	<tr style="text-align:center; font-weight:bold; font-size:11pt">
	  <td>&nbsp;</td>
		<td>LEMBAR KERJA INVENTARISASI (LKI)</td>
	</tr>
	<tr style="text-align:center; font-weight:bold; font-size:11pt">
	  <td>&nbsp;</td>
		<td>PERALATAN DAN MESIN</td>
	</tr>
	<tr style="text-align:center; font-weight:bold; font-size:11pt">
	  <td>&nbsp;</td>
		<td><?=$TiDaer." ".$NmDaer?></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
	  <tr>
	    <td width="600">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td width="121">&nbsp;</td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td width="48">NIBAR</td>
	    <td width="16">:</td>
	    <td><?=$mRo[1]?></td>
	  </tr>
	  </table>	  </td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr height="24">
          <td width="144">Kode Lokasi</td>
          <td width="20">:</td>
          <td><?=$fLokasi?></td>
        </tr>
        <tr height="24">
          <td>Kuasa Pengguna Barang</td>
          <td width="21">:</td>
          <td><?=$fKPB?></td>
        </tr>
        <tr height="24">
          <td>Pengguna Barang</td>
          <td>:</td>
          <td><?=fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit",substr($mRo[8],0,11),"=","","")?></td>
        </tr>
        <tr height="24">
          <td>Pengelola Barang</td>
          <td>:</td>
          <td><?=fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit","24.04.04.01","=","","")?></td>
        </tr>
      </table>	  </td>
  </tr>
	<tr height="10">
	  <td></td>
	  <td></td>
	</tr>
	<tr>
	  <td style="border-top:1px solid #000">&nbsp;</td>
		<td style="border-top:1px solid #000">&nbsp;</td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td><table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
          <td width="30">A.</td>
          <td width="130">Kode Register </td>
          <td width="20">:</td>
          <td colspan="5"><?=$mRo[11]?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="128"><?=TChek($CkReg1,'Sesuai','80')?></td>
          <td width="100"><?=TChek($CkReg2,'Tidak Sesuai','100')?></td>
          <td width="135">Sebutkan yang seharusnya</td>
          <td width="20">:</td>
          <td><?=$CkRegM?></td>
        </tr>
      </table></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
          <td width="30">B.</td>
          <td width="130">Kode Barang </td>
          <td width="20">:</td>
          <td colspan="5"><?=$mRo[9]?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="128"><?=TChek($CkKdb1,'Sesuai','80')?></td>
          <td width="100"><?=TChek($CkKdb2,'Tidak Sesuai','100')?></td>
          <td width="135">Sebutkan yang seharusnya</td>
          <td width="20">:</td>
          <td><?=$CkKdbM?></td>
        </tr>
      </table></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td><table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
          <td width="30">C.</td>
          <td width="130">Nama Barang </td>
          <td width="20">:</td>
          <td colspan="5"><?=fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$mRo[9],"=","","")?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="128"><?=TChek($CkNmb1,'Sesuai','80')?></td>
          <td width="100"><?=TChek($CkNmb2,'Tidak Sesuai','100')?></td>
          <td width="135">Sebutkan yang seharusnya</td>
          <td width="20">:</td>
          <td><?=$CkNmbM?></td>
        </tr>
      </table></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td><table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
          <td width="30">D.</td>
          <td width="130">Spesifikasi Nama Barang </td>
          <td width="20">:</td>
          <td colspan="5"><?=$mRo[14]?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="128"><?=TChek($CkSpc1,'Sesuai','80')?></td>
          <td width="100"><?=TChek($CkSpc2,'Tidak Sesuai','100')?></td>
          <td width="135">Sebutkan yang seharusnya</td>
          <td width="20">:</td>
          <td><?=$CkSpcM?></td>
        </tr>
      </table></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr height="24">
          <td width="30">E.</td>
          <td width="130">Jumlah Barang </td>
          <td width="20">:</td>
          <td><?=$JmlBRG?></td>
        </tr>
      </table>	  </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr height="24">
          <td width="30">F.</td>
          <td width="130">Satuan Barang</td>
          <td width="20">:</td>
          <td><?=$SatBRG?></td>
        </tr>
      </table>	  </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        
        <tr>
          <td width="30">G.</td>
          <td width="130">Keberadaan Barang </td>
          <td width="20">:</td>
          <td width="77"><?=TChek($CkAda1,'Ada','80')?></td>
          <td width="146"><?=TChek($CkAda2,'Tidak Ada','80')?></td>
          <td width="71">Jumlahnya </td>
          <td width="20">:</td>
          <td><?=$JmlBRGJmL?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>a.</td>
          <td><?=TChek($CktidkAda1,'Hilang','80')?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>b</td>
          <td><?=TChek($CktidkAda2,'Tidak Ditemukan','120')?></td>
        </tr>
      </table></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td><table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
          <td width="30">H.</td>
          <td width="130">Nilai Perolehan Barang</td>
          <td width="20">:</td>
          <td><?=fConvertToRupiah($NilPER)?></td>
        </tr>
      </table></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr height="25">
          <td width="30" rowspan="8" valign="top">I.</td>
          <td width="130" rowspan="8" valign="top">Apakah Nilai Perolehan merupakan biaya atribusi/penambahan nilai </td>
          <td width="18" rowspan="8" valign="top">:</td>
          <td colspan="2"><?=TChek($CkAtr1,'Ya','80')?></td>
          <td colspan="2"><?=TChek($CkAtr2,'Bukan merupakan biaya atribusi','200')?></td>
        </tr>
        <tr height="25">
          <td colspan="4"><?=TChek($CkIndk1,'Diketahui data awal/induknya, sebutkan data barang induknya :','350')?></td>
        </tr>
        <tr height="24">
          <td width="23">&nbsp;</td>
          <td width="135">NIBAR</td>
          <td width="17">:</td>
          <td><?=$Atribusi1?></td>
        </tr>
        <tr height="24">
          <td>&nbsp;</td>
          <td>Kode Barang</td>
          <td>:</td>
          <td><?=$Atribusi2?></td>
        </tr>
        <tr height="24">
          <td>&nbsp;</td>
          <td>Kode Lokasi </td>
          <td>:</td>
          <td><?=$Atribusi3?></td>
        </tr>
        <tr height="24">
          <td>&nbsp;</td>
          <td>Kode Register </td>
          <td>:</td>
          <td><?=$Atribusi4?></td>
        </tr>
        <tr height="24">
          <td>&nbsp;</td>
          <td>Nama Barang </td>
          <td>:</td>
          <td><?=$Atribusi5?></td>
        </tr>
        <tr height="24">
          <td>&nbsp;</td>
          <td>Spesifikasi Nama Barang </td>
          <td>:</td>
          <td><?=$Atribusi6?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="4"><?=TChek($CkIndk2,'Tidak diketahui nilai induknya','200')?></td>
        </tr>
      </table></td>
  </tr>
	<tr height="26">
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
          <td width="30">J.</td>
          <td width="140">Alamat</td>
          <td width="20">:</td>
          <td colspan="5"><?=$mRo[21]?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="128"><?=TChek($CkAlm1,'Sesuai','100')?></td>
          <td width="100"><?=TChek($CkAlm2,'Tidak Sesuai','100')?></td>
          <td width="135">Sebutkan yang seharusnya</td>
          <td width="20">:</td>
          <td><?=$CkAlmM?></td>
        </tr>
      </table>	  </td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
          <td width="30">K.</td>
          <td width="140">Kondisi Barang</td>
          <td width="20">:</td>
          <td colspan="5"><?=$mRo[41]?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="128"><?=TChek($CkKon1,'Baik (B)','120')?></td>
          <td width="145"><?=TChek($CkKon2,'Rusak Ringan (RR)','120')?></td>
          <td width="147"><?=TChek($CkKon3,'Rusak Berat (RB)','120')?></td>
          <td width="20"></td>
          <td>&nbsp;</td>
        </tr>
      </table>	  </td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
  <tr>
	  <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr height="24">
          <td width="30">L.</td>
          <td width="130">Merk / Type</td>
          <td width="20">:</td>
          <td><?=$mRo[29]." / ".$mRo[30]?></td>
        </tr>
      </table>	  
	  </td>
  </tr>
  <tr>
	  <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr height="24">
          <td width="30">M.</td>
          <td width="130">Nomor Polisi</td>
          <td width="20">:</td>
          <td colspan="5"><?=$mRo[36]?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="128"><?=TChek($CkPol1,'Sesuai','100')?></td>
          <td width="100"><?=TChek($CkPol2,'Tidak Sesuai','100')?></td>
          <td width="135">Sebutkan yang seharusnya</td>
          <td width="20">:</td>
          <td><?=$CkPolM?></td>
        </tr>
      </table>	  
	  </td>
  </tr>
  <tr>
	  <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr height="24">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr height="24">
          <td width="30">N.</td>
          <td width="130">Nomor Rangka</td>
          <td width="20">:</td>
          <td colspan="5"><?=$mRo[34]?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="128"><?=TChek($CkRan1,'Sesuai','100')?></td>
          <td width="100"><?=TChek($CkRan2,'Tidak Sesuai','100')?></td>
          <td width="135">Sebutkan yang seharusnya</td>
          <td width="20">:</td>
          <td><?=$CkRanM?></td>
        </tr>
      </table>	  
	  </td>
  </tr>
  <tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
  <tr>
	  <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr height="24">
          <td width="30">O.</td>
          <td width="130">Nomor BPKB</td>
          <td width="20">:</td>
          <td colspan="5"><?=$mRo[38]?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="128"><?=TChek($CkBpk1,'Sesuai','100')?></td>
          <td width="100"><?=TChek($CkBpk2,'Tidak Sesuai','100')?></td>
          <td width="135">Sebutkan yang seharusnya</td>
          <td width="20">:</td>
          <td><?=$CkBpkM?></td>
        </tr>
      </table>	  
	  </td>
  </tr>

  <tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
          <td width="30">P.</td>
          <td width="130">Penggunaan Barang</td>
          <td width="23">:</td>
          <td colspan="5"><?=TChek($CkGun1,'Pemerintah Daerah','170')?></td>
        </tr>
		<!---->
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Nama Pengguna / Kuasa Pengguna Barang Lainnya</td>
          <td width="16">:</td>
          <td colspan="2"><?=$NmKuasa?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Nama Pemakai</td>
          <td width="16">:</td>
          <td colspan="2"><?=$NmPemakai?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c. Status Pemakai</td>
          <td width="16">:</td>
          <td colspan="2"><?=$StPemakai?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;d. BAST Pemakaian/Dokumen Lainnya</td>
          <td width="16">:</td>
          <td width="70"><?=TChek($CkBasPD1,'Ada','70')?></td>
          <td><?=TChek($CkBasPD2,'Tidak Ada','90')?></td>
        </tr>
		<!---->
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><?=TChek($CkGun2,'Pemerintah Pusat','150')?></td>
          <td>Dasar Penggunaan : </td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td><?=TChek($CkDsrPP1,'Ada, Sebutkan','100')?></td>
          <td></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
          <td>:</td>
          <td colspan="2"><?=$PP_Ada_Nama?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Dokumen</td>
          <td>:</td>
          <td colspan="2"><?=$PP_Ada_NamaDoc?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td colspan="4"><?=TChek($CkDsrPP2,'Tidak ada dasar penggunaan','180')?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
          <td>:</td>
          <td colspan="2"><?=$PP_TdkAda_Nama?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="207"></td>
          <td width="150">&nbsp;</td>
          <td></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><?=TChek($CkGun3,'Pemerintah Daerah Lainya','170')?></td>
          <td>Dasar Penggunaan:</td>
          <td></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td><?=TChek($CkDsrPDL1,'Ada, Sebutkan','100')?></td>
          <td></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
          <td>:</td>
          <td colspan="2"><?=$PDL_Ada_Nama?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Dokumen</td>
          <td>:</td>
          <td colspan="2"><?=$PDL_Ada_NamaDoc?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td colspan="4"><?=TChek($CkDsrPDL2,'Tidak ada dasar penggunaan','180')?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
          <td>:</td>
          <td colspan="2"><?=$PDL_TdkAda_Nama?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;</td>
          <td></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;</td>
          <td></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><?=TChek($CkGun4,'Pihak Lain','170')?></td>
		  <td>Dasar Penggunaan : </td>
          <td></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td><?=TChek($CkDsrPL1,'Ada, Sebutkan','180')?></td>
          <td></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
          <td>:</td>
          <td colspan="2"><?=$PL_Ada_Nama?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Dokumen</td>
          <td>:</td>
          <td colspan="2"><?=$PL_Ada_NamaDoc?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td colspan="4"><?=TChek($CkDsrPL2,'Tidak ada dasar penggunaan','180')?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
          <td>:</td>
          <td colspan="2"><?=$PL_TdkAda_Nama?></td>
        </tr>
      </table>	  </td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
          <td width="27">Q.</td>
          <td width="140">Data Barang Tercatat Ganda</td>
          <td width="22">:</td>
          <td colspan="4"><?=TChek($CkGan1,'Tidak','180')?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="4"><?=TChek($CkGan2,'Ya, jika ya sebutkan pencatatan ganda dengan :','280')?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="26" align="center">a.</td>
          <td width="205">NIBAR </td>
          <td width="15">:		  </td>
          <td><?=$CttGand1?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">b.</td>
          <td>Kode Register</td>
          <td>:</td>
          <td><?=$CttGand2?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">c.</td>
          <td>Kode Barang</td>
          <td>:</td>
          <td><?=$CttGand3?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">d.</td>
          <td>Nama Barang</td>
          <td>:</td>
          <td><?=$CttGand4?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">e.</td>
          <td>Nama Spesifikasi Barang</td>
          <td>:</td>
          <td><?=$CttGand5?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">f.</td>
          <td>Jumlah</td>
          <td>:</td>
          <td><?=$CttGand6?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">g.</td>
          <td>Satuan</td>
          <td>:</td>
          <td><?=$CttGand7?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">h.</td>
          <td>Nilai Perolehan Barang</td>
          <td>:</td>
          <td><?=$CttGand8?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">i.</td>
          <td>Tahun, Bulan, Tanggal Perolehan</td>
          <td>:</td>
          <td><?=$CttGand9?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">j.</td>
          <td>Kuasa Pengguna Barang Lainnya, Pengguna Barang Lainnya atau Pengelola Barang</td>
          <td>:</td>
          <td><?=$CttGand10?></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td></td>
          <td></td>
          <td>&nbsp;</td>
        </tr>
      </table>	  </td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr height="24">
          <td width="30">R.</td>
          <td width="133">Lainnya</td>
          <td>:</td>
          <td colspan="2"><?=$Lainnya?></td>
        </tr>
        <tr height="24">
          <td>S.</td>
          <td>Keterangan</td>
          <td>:</td>
          <td colspan="2"><?=$Keterang?></td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td rowspan="4" style="text-align:center">
		  <? if ($mRo67!='') {?>
		  <img src="../simandor/images/<?=$mRo[0]."xyz".$mRo67?>" height="140" width="115" style="border:1px #000 solid" />
		  <? } ?>
		  </td>
          <td>&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center"><?=$NmIbuk?>,&nbsp;&nbsp;&nbsp;<?=fConvertDateLongsBln($gTH."-".$gBL."-".$gHR)?></td>
        </tr>
        
        
        <tr>
          <td>&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td width="403" valign="top">
            <table align="center" cellpadding="0" class="table-form" cellspacing="0" width="100%" height="30" border="0">
			
			<tr height="30">
			<td width="3627" colspan="3" align="center">Petugas Inventarisasi</td>
			</tr>
			<tr height="60">
			  <td colspan="3">&nbsp;</td>
			  </tr>
			<tr>
			<td colspan="3" align="center" style="text-decoration:underline; font-weight:bold"><?=$Petugas?></td>
			</tr>
			<tr>
			  <td colspan="3" align="center">NIP. <?=$Nipetug?></td>
			  </tr>
			</table>			</td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>	  </td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
</table>
