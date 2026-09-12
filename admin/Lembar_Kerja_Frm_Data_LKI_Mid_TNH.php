<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$DT = fGlobal("kd_aset_108:no_register:kd_upb:tgl_perolehan:kd_pemilik:extracom:referensi:kd_ruang", "ta_kib_108_sensus_2023", "IDT", $IdT, "=", "", "");
if ($DT) {
  $DT = explode(':', $DT);
  $kdA = $DT[0];
  $noR = $DT[1];
  $upB = $DT[2];
  $tgL = $DT[3];
  $mlK = $DT[4];
  $exT = $DT[5];
  $reF = $DT[6];
  $KdR = $DT[7];
  if ($exT == 'Y') {
    $exT = '00';
  } else {
    $exT = '01';
  }

  $tgL = explode('-', $tgL);
  $thA = substr($tgL[0], 0, 1);
  $thB = substr($tgL[0], 1, 1);
  $thC = substr($tgL[0], 2, 1);
  $thD = substr($tgL[0], 3, 1);
}

$TgR = fGlobal("Recorded_map", "ta_kib_108_barcode", "referensi:Kd_UPB", $reF . ":" . $upB, "=:=", "", "");

$fLokasi = substr($mlK, 0, 1) . substr($mlK, 0, 1) . substr($mlK, -1, 1) . "." . substr($exT, 0, 1) . substr($exT, -1, 1) . '.' . substr($upB, 0, 1) . substr($upB, 1, 1) . '.' . substr($upB, 3, 1) . substr($upB, 4, 1) . '.' . substr($upB, 6, 1) . substr($upB, 7, 1) . substr($upB, 9, 1) . substr($upB, 10, 1) . substr($upB, 12, 1) . substr($upB, 13, 1) . '.' . '00' . substr($upB, -3, 1) . substr($upB, -2, 1) . substr($upB, -1, 1) . '.00' . substr($KdR, -3, 1) . substr($KdR, -2, 1) . substr($KdR, -1, 1) . '.' . $thA . $thB . $thC . $thD;

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
P1.file_size as A68,
P1.extracom as A69 
FROM ta_kib_108_sensus_2023 P1
LEFT JOIN ta_kib_post_108_sensus_2023 P2 ON P2.Referensi=P1.Referensi AND P2.Kd_UPB=P1.Kd_UPB 
WHERE P1.IDT ='" . $IdT . "'";
#echo $nSQ;
$nRs = mysql_query($nSQ);
$mRo = mysql_fetch_array($nRs, MYSQL_BOTH);

$mRo67 = fGlobal("file_name", "ta_kib_108", "Referensi:Ref_Group", $mRo[1] . ":" . $mRo[2], "=:=", "", "");
$mRo68 = fGlobal("file_size", "ta_kib_108", "Referensi:Ref_Group", $mRo[1] . ":" . $mRo[2], "=:=", "", "");

$SnsIDT = fGlobal("IDT", "tb_lembar_kerja", "Referensi:KdUPB:RefGroup", $mRo[1] . ":" . $mRo[8] . ":" . $mRo[2], "=:=:=", "", "");
if ($SnsIDT == '') {
  $SQ = "INSERT INTO tb_lembar_kerja SET 
	Referensi='" . $mRo[1] . "',
	RefGroup='" . $mRo[2] . "',
	KdUPB='" . $mRo[8] . "',
	
	KdAset108='".$mRo[9]."',
	Extracom='".$mRo[69]."',
	
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
	NilaiPerolehan='" . $mRo[65] . "',
	MerupakanAtribusi='tidak',
	Alamat='sesuai',
	
	KondisiBarangAsal='" . $mRo[41] . "',
	KondisiBarang='" . $mRo[41] . "',
	
	PenggunaanBarang='PD',
	DataTercatatGanda='tidak',
	TitikKoordinat='" . $mRo[66] . "',
	Lainnya='',
	Keterangan=''";
  $rs = mysql_query($SQ);
} else {
	if ($TgR != '') {
		#$SQ = "UPDATE tb_lembar_kerja SET TanggalSensus='" . substr($TgR, 0, 10) . "' WHERE IDT='" . $SnsIDT . "' AND TanggalSensus='0000-00-00'";
		#mysql_query($SQ);
	}
}

$SnsPGG = fGlobal("IDT", "tb_lembar_kerja_penggunaan", "Referensi:KdUPB:RefGroup", $mRo[1] . ":" . $mRo[8] . ":" . $mRo[2], "=:=:=", "", "");
if ($SnsPGG == '') {
  $SQ = "INSERT INTO tb_lembar_kerja_penggunaan SET 
	Referensi='" . $mRo[1] . "',
	RefGroup='" . $mRo[2] . "',
	KdUPB='" . $mRo[8] . "',
	
	PD_NmKuasaPenggunaLainnya='',
	
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

$SnsGND = fGlobal("IDT", "tb_lembar_kerja_tercatat_ganda", "Referensi:KdUPB:RefGroup", $mRo[1] . ":" . $mRo[8] . ":" . $mRo[2], "=:=:=", "", "");
if ($SnsGND == '') {
  $SQ = "INSERT INTO tb_lembar_kerja_tercatat_ganda SET 
	Referensi='" . $mRo[1] . "',
	RefGroup='" . $mRo[2] . "',
	KdUPB='" . $mRo[8] . "'";
  $rs = mysql_query($SQ);
}

$SnsATR = fGlobal("IDT", "tb_lembar_kerja_merupakan_biaya_atribusi", "Referensi:KdUPB:RefGroup", $mRo[1] . ":" . $mRo[8] . ":" . $mRo[2], "=:=:=", "", "");
if ($SnsATR == '') {
  $SQ = "INSERT INTO tb_lembar_kerja_merupakan_biaya_atribusi SET 
	Referensi='" . $mRo[1] . "',
	RefGroup='" . $mRo[2] . "',
	KdUPB='" . $mRo[8] . "'";
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
MerupakanAtribusi_induk as A31,
DataSensusFix as A32 

FROM tb_lembar_kerja WHERE Referensi='" . $mRo[1] . "' AND KdUPB='" . $mRo[8] . "' AND RefGroup='" . $mRo[2] . "'";
$rs = mysql_query($SQ);
$mR = mysql_fetch_array($rs, MYSQL_BOTH);

$gTG = $mR[25];
$gTG = explode('-', $gTG);
$gTH = $gTG[0];
$gBL = $gTG[1];
$gHR = $gTG[2];

$SnsIDT = $mR[0];
$CkReg1 = "";
$CkReg2 = "";
$CkRegM = "";
$CkRegR = "";
if ($mR[4] == 'sesuai') {
  $CkReg1 = "checked";
  $CkRegR = 'disabled';
} else {
  $CkReg2 = "checked";
  $CkRegM = $mR[5];
}

$CkKdb1 = "";
$CkKdb2 = "";
$CkKdbM = "";
$CkKdbR = "";
if ($mR[6] == 'sesuai') {
  $CkKdb1 = "checked";
  $CkKdbR = 'disabled';
} else {
  $CkKdb2 = "checked";
  $CkKdbM = $mR[7];
}

$CkNmb1 = "";
$CkNmb2 = "";
$CkNmbM = "";
$CkNmbR = "";
if ($mR[8] == 'sesuai') {
  $CkNmb1 = "checked";
  $CkNmbR = 'disabled';
} else {
  $CkNmb2 = "checked";
  $CkNmbM = $mR[9];
}

$CkSpc1 = "";
$CkSpc2 = "";
$CkSpcM = "";
$CkSpcR = "";
if ($mR[10] == 'sesuai') {
  $CkSpc1 = "checked";
  $CkSpcR = 'disabled';
} else {
  $CkSpc2 = "checked";
  $CkSpcM = $mR[11];
}

$JmlBRG = $mR[12];
$SatBRG = $mR[13];

$CkAda1 = "";
$CkAda2 = "";
if ($mR[14] == 'ada') {
  $CkAda1 = "checked";
} else {
  $CkAda2 = "checked";
}

$NilPER = $mR[15];

#$CkIndk1 = ""; $CkIndk2 = ""; 
#if ($mR[31]=='diketahui') {
#	$CkIndk1 = "checked";
#}
#else {
#	$CkIndk2 = "checked";
#}

$CkAtr1   = "";
$CkAtr2 = "";
$CkIndk1  = "";
$CkIndk2 = "";
$CkIndk1D = "";
$CkIndk2D = "";
if ($mR[16] == 'ya') {
  $CkAtr1 = "checked";

  if ($mR[31] == 'diketahui') {
    $CkIndk1 = "checked";
  } else {
    $CkIndk2 = "checked";
  }
} else {
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
FROM tb_lembar_kerja_merupakan_biaya_atribusi WHERE Referensi='" . $mRo[1] . "' AND KdUPB='" . $mRo[8] . "' AND RefGroup='" . $mRo[2] . "'";
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

if ($CkIndk1 == 'checked') {
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

$CkAlm1 = "";
$CkAlm2 = "";
$CkAlmM = "";
$CkAlmR = "";
if ($mR[17] == 'sesuai') {
  $CkAlm1 = "checked";
  $CkAlmR = 'disabled';
} else {
  $CkAlm2 = "checked";
  $CkAlmM = $mR[18];
}

$CkKon1 = "";
$CkKon2 = "";
$CkKon3 = "";
if ($mR[19] == 'B') {
  $CkKon1 = "checked";
} else if ($mR[19] == 'RR') {
  $CkKon2 = "checked";
} else {
  $CkKon3 = "checked";
}

$CkGun1 = "";
$CkGun2 = "";
$CkGun3 = "";
$CkGun4 = "";
if ($mR[20] == 'PD') {
  $CkGun1 = "checked";
} else if ($mR[20] == 'PP') {
  $CkGun2 = "checked";
} else if ($mR[20] == 'PDL') {
  $CkGun3 = "checked";
} else {
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
PL_dasarpenggunaan_tidakada_nama as A13 

FROM tb_lembar_kerja_penggunaan WHERE Referensi='" . $mRo[1] . "' AND KdUPB='" . $mRo[8] . "' AND RefGroup='" . $mRo[2] . "'";
$re = mysql_query($SG);
$mG = mysql_fetch_array($re, MYSQL_BOTH);
$SnsIDG  = $mG[0];

$NmKuasa  = "";
$NmKuasaR = 'disabled';

$CkDsrPP1  = "";
$CkDsrPP2 = "";
$CkDsrPPR1 = "disabled";
$CkDsrPPR2 = "disabled";

$CkDsrPDL1 = "";
$CkDsrPDL2 = "";
$CkDsrPDLR1 = "disabled";
$CkDsrPDLR2 = "disabled";

$CkDsrPL1  = "";
$CkDsrPL2  = "";
$CkDsrPLR1 = "disabled";
$CkDsrPLR2 = "disabled";

if ($CkGun1 == "checked") {
  $NmKuasa  = $mG[1];
  $NmKuasaR = '';
}

$PP_Ada_Nama  = "";
$PP_Ada_NamaR = "disabled";
$PP_Ada_NamaDoc  = "";
$PP_Ada_NamaDocR = "disabled";
$PP_TdkAda_Nama  = "";
$PP_TdkAda_NamaR = "disabled";

if ($CkGun2 == "checked") {
  $CkDsrPPR1 = "";
  $CkDsrPPR2 = "";
  if ($mG[2] == 'ada') {
    $CkDsrPP1 = "checked";

    $PP_Ada_Nama = $mG[3];
    $PP_Ada_NamaR = "";

    $PP_Ada_NamaDoc  = $mG[4];
    $PP_Ada_NamaDocR = "";
  } else {
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

if ($CkGun3 == "checked") {
  $CkDsrPDLR1 = "";
  $CkDsrPDLR2 = "";
  if ($mG[6] == 'ada') {
    $CkDsrPDL1 = "checked";
    $PDL_Ada_Nama  = $mG[7];
    $PDL_Ada_NamaR = "";
    $PDL_Ada_NamaDoc  = $mG[8];
    $PDL_Ada_NamaDocR = "";
  } else {
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
if ($CkGun4 == "checked") {
  $CkDsrPLR1 = "";
  $CkDsrPLR2 = "";
  if ($mG[10] == 'ada') {
    $CkDsrPL1 = "checked";
    $PL_Ada_Nama  = $mG[11];
    $PL_Ada_NamaR = "";
    $PL_Ada_NamaDoc  = $mG[12];
    $PL_Ada_NamaDocR = "";
  } else {
    $CkDsrPL2 = "checked";
    $PL_TdkAda_Nama  = $mG[13];
    $PL_TdkAda_NamaR = "";
  }
}

$CkGan1 = '';
$CkGan2 = '';

if ($mR[21] == 'tidak') {
  $CkGan1 = "checked";
} else {
  $CkGan2 = "checked";
}

$CkFix1 = '';
$CkFix2 = '';

if ($mR[32] == 'N') {
  $CkFix1 = "checked";
} else if ($mR[32] == 'P') {
  $CkFix2 = "checked";
} else {
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

FROM tb_lembar_kerja_tercatat_ganda WHERE Referensi='" . $mRo[1] . "' AND KdUPB='" . $mRo[8] . "' AND RefGroup='" . $mRo[2] . "'";
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
$CttGand10 = "";

$CttGand1R = "disabled";
$CttGand2R = "disabled";
$CttGand3R = "disabled";
$CttGand4R = "disabled";
$CttGand5R = "disabled";
$CttGand6R = "disabled";
$CttGand7R = "disabled";
$CttGand8R = "disabled";
$CttGand9R = "disabled";
$CttGand10R = "disabled";
if ($CkGan2 == "checked") {
  $CttGand1 = $mD[4];
  $CttGand2 = $mD[5];
  $CttGand3 = $mD[6];
  $CttGand4 = $mD[7];
  $CttGand5 = $mD[8];
  $CttGand6 = $mD[9];
  $CttGand7 = $mD[10];
  $CttGand8 = fConvertToRupiah($mD[11]);
  $CttGand9 = $mD[12];
  $CttGand10 = $mD[13];

  $CttGand1R = "";
  $CttGand2R = "";
  $CttGand3R = "";
  $CttGand4R = "";
  $CttGand5R = "";
  $CttGand6R = "";
  $CttGand7R = "";
  $CttGand8R = "";
  $CttGand9R = "";
  $CttGand10R = "";
}

$Koordinat = $mR[22];

if ($Koordinat == '') {
  $Koordinat = $mRo[66];
  if ($Koordinat == '') {
    $Koordinat = fGlobal("lat_lng", "ta_kib_108", "Referensi:Ref_Group", $mRo[1] . ":" . $mRo[2], "=:=", "", "");
  }

  $SQ = "UPDATE tb_lembar_kerja SET TitikKoordinat='" . $mRo[66] . "' WHERE IDT='" . $SnsIDT . "'";
  $rs = mysql_query($SQ);
}

$Lainnya   = $mR[23];
$Keterang  = $mR[24];

$Petugas1 = fGlobal("NmPetugas", "tb_lembar_kerja_petugas", "IdPetugas", $mR[26], "=", "", "");
$Petugas2 = fGlobal("NmPetugas", "tb_lembar_kerja_petugas", "IdPetugas", $mR[27], "=", "", "");
$Petugas3 = fGlobal("NmPetugas", "tb_lembar_kerja_petugas", "IdPetugas", $mR[28], "=", "", "");
$Petugas4 = fGlobal("NmPetugas", "tb_lembar_kerja_petugas", "IdPetugas", $mR[29], "=", "", "");
$Petugas5 = fGlobal("NmPetugas", "tb_lembar_kerja_petugas", "IdPetugas", $mR[30], "=", "", "");
?>
<table align="center" cellpadding="0" class="table-form" cellspacing="0" border="0" style="width:910px">
  <tr height="30">
    <td width="120" style="border-bottom:1px solid #ccc">
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
          <td width="818">&nbsp;</td>
          <td width="132">Format : III.A.1</td>
        </tr>
      </table>
    </td>
  </tr>

  <tr style="text-align:center; font-weight:bold; font-size:11pt">
    <td>LEMBAR KERJA INVENTARISASI (LKI)</td>
  </tr>
  <tr style="text-align:center; font-weight:bold; font-size:11pt">
    <td>TANAH</td>
  </tr>
  <tr style="text-align:center; font-weight:bold; font-size:11pt">
    <td><?= $TiDaer . " " . $NmDaer ?></td>
  </tr>
  <tr>
    <td>
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
          <td width="710">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="48">NIBAR</td>
          <td width="16">:</td>
          <td><input type="text" name="fLokasi" id="fLokasi" readonly value="<?= $mRo[1] ?>" style="width:120px; background:#fff" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr height="24">
          <td width="144">Kode Lokasi </td>
          <td width="20">:</td>
          <td><input type="text" name="fLokasi" id="fLokasi" readonly value="<?= $fLokasi ?>" style="width:250px; background:#fff" /></td>
        </tr>
        <tr height="24">
          <td>Kuasa Pengguna Barang</td>
          <td width="21">:</td>
          <td><input type="text" name="fLokasi" id="fLokasi" readonly value="<?= $fKPB ?>" style="width:250px; background:#fff" /></td>
        </tr>
        <tr height="24">
          <td>Pengguna Barang</td>
          <td>:</td>
          <td><input type="text" name="fLokasi" id="fLokasi" readonly value="<?= fGlobal("Nma_Pimpinan", "ref_unit", "Kd_Unit", substr($mRo[8], 0, 11), "=", "", "") ?>" style="width:250px; background:#fff" /></td>
        </tr>
        <tr height="24">
          <td>Pengelola Barang</td>
          <td>:</td>
          <td><input type="text" name="fLokasi" id="fLokasi" readonly value="<?= fGlobal("Nma_Pimpinan", "ref_unit", "Kd_Unit", "24.04.04.01", "=", "", "") ?>" style="width:250px; background:#fff" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="border-top:1px solid #000">&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr style="font-weight:bold">
          <td width="30">A.</td>
          <td width="130">Kode Register </td>
          <td width="20">:</td>
          <td colspan="5"><input type="text" name="fForm" id="fForm" readonly value="<?= $mRo[11] ?>" style="width:150px; background:#fff" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="128"><label><input type="radio" name="radioReg" value="sesuai" <?= $CkReg1 ?> onchange="saveDATA('KdRegister','sesuai','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Sesuai</label></td>
          <td width="145"><label><input type="radio" name="radioReg" value="tidaksesuai" <?= $CkReg2 ?> onchange="saveDATA('KdRegister','tidaksesuai','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Tidak Sesuai</label></td>
          <td width="147">Sebutkan yang seharusnya</td>
          <td width="20">:</td>
          <td><input type="text" name="tsesuaiREG" id="tsesuaiREG" value="<?= $CkRegM ?>" <?= $CkRegR ?> onkeypress="if (event.keyCode==13){saveDATA('KdRegisterMemo',this,'Y','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:280px" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr style="font-weight:bold">
          <td width="30">B.</td>
          <td width="130">Kode Barang </td>
          <td width="20">:</td>
          <td colspan="5"><input type="text" name="fForm" id="fForm" readonly value="<?= $mRo[9] ?>" style="width:150px; background:#fff" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="128"><label><input type="radio" name="radioKod" value="sesuai" <?= $CkKdb1 ?> onchange="saveDATA('KdBarang','sesuai','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Sesuai</label></td>
          <td width="145"><label><input type="radio" name="radioKod" value="tidaksesuai" <?= $CkKdb2 ?> onchange="saveDATA('KdBarang','tidaksesuai','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Tidak Sesuai</label></td>
          <td width="147">Sebutkan yang seharusnya</td>
          <td width="20">:</td>
          <td><input type="text" name="tsesuaiKOD" id="tsesuaiKOD" value="<?= $CkKdbM ?>" <?= $CkKdbR ?> onkeypress="if (event.keyCode==13){saveDATA('KdBarangMemo',this,'Y','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:280px" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr style="font-weight:bold">
          <td width="30">C.</td>
          <td width="130">Nama Barang </td>
          <td width="20">:</td>
          <td colspan="5"><input type="text" name="fForm" id="fForm" readonly value="<?= fGlobal("Nm_Aset", "ref_rek_aset108_7", "Kd_Aset", $mRo[9], "=", "", "") ?>" style="width:300px; background:#fff" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="128">
            <label><input type="radio" name="radioNma" value="sesuai" <?= $CkNmb1 ?> onchange="saveDATA('NmBarang','sesuai','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Sesuai</label>
          </td>
          <td width="145">
            <label><input type="radio" name="radioNma" value="tidaksesuai" <?= $CkNmb2 ?> onchange="saveDATA('NmBarang','tidaksesuai','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Tidak Sesuai</label>
          </td>
          <td width="147">Sebutkan yang seharusnya</td>
          <td width="20">:</td>
          <td><input type="text" name="tsesuaiNMA" id="tsesuaiNMA" value="<?= $CkNmbM ?>" <?= $CkNmbR ?> onkeypress="if (event.keyCode==13){saveDATA('NmBarangMemo',this,'Y','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:280px" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr style="font-weight:bold">
          <td width="30">D.</td>
          <td width="130">Spesifikasi Nama Barang </td>
          <td width="20">:</td>
          <td colspan="5"><input type="text" name="fForm" id="fForm" readonly value="<?= $mRo[14] ?>" style="width:300px; background:#fff" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="128">
            <label><input type="radio" name="radioSpe" value="sesuai" <?= $CkSpc1 ?> onchange="saveDATA('SpecNamaBarang','sesuai','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Sesuai</label>
          </td>
          <td width="145"><label>
              <input type="radio" name="radioSpe" value="tidaksesuai" <?= $CkSpc2 ?> onchange="saveDATA('SpecNamaBarang','tidaksesuai','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />
              Tidak Sesuai</label></td>
          <td width="147">Sebutkan yang seharusnya</td>
          <td width="20">:</td>
          <td><input type="text" name="tsesuaiSPE" id="tsesuaiSPE" value="<?= $CkSpcM ?>" <?= $CkSpcR ?> onkeypress="if (event.keyCode==13){saveDATA('SpecNamaBarangMemo',this,'Y','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:280px" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr height="24" style="font-weight:bold">
          <td width="30">E.</td>
          <td width="130">Jumlah Barang </td>
          <td width="20">:</td>
          <td><input type="text" name="JmlBRG" id="JmlBRG" value="<?= $JmlBRG ?>" onkeypress="if (event.keyCode==13){saveDATA('JmlBarang',this,'Y','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:40px; text-align:center" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr height="24" style="font-weight:bold">
          <td width="30">F.</td>
          <td width="130">Satuan Barang</td>
          <td width="20">:</td>
          <td><input type="text" name="SatBRG" id="SatBRG" value="<?= $SatBRG ?>" onkeypress="if (event.keyCode==13){saveDATA('SatuanBarang',this,'Y','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:90px" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">

        <tr style="font-weight:bold">
          <td width="30">G.</td>
          <td width="130">Keberadaan Barang </td>
          <td width="20">:</td>
          <td width="77">
            <label><input type="radio" name="radioAda" value="ada" <?= $CkAda1 ?> onchange="saveDATA('KeberadaanBarang','ada','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Ada</label>
          </td>
          <td width="196">
            <label><input type="radio" name="radioAda" value="tidakada" <?= $CkAda2 ?> onchange="saveDATA('KeberadaanBarang','tidakada','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Tidak Ada</label>
          </td>
          <td width="147">&nbsp;</td>
          <td width="20">&nbsp;</td>
          <td width="290">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr style="font-weight:bold">
          <td width="30">H.</td>
          <td width="130">Nilai Perolehan Barang</td>
          <td width="20">:</td>
          <td><input type="text" name="NilPER" id="NilPER" value="<?= fConvertToRupiah($NilPER) ?>" onkeypress="if (event.keyCode==13){saveDATA('NilaiPerolehan',this,'Y','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:120px; text-align:right" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr height="25" style="font-weight:bold">
          <td width="27" rowspan="8" valign="top">I.</td>
          <td width="130" rowspan="8" valign="top">Apakah Nilai Perolehan merupakan biaya atribusi/penambahan nilai </td>
          <td width="18" rowspan="8" valign="top">:</td>
          <td colspan="2"><label>
              <input type="radio" name="radioAtr" value="diketahui" <?= $CkAtr1 ?> onchange="saveDATA('MerupakanAtribusi','ya','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />
              Ya</label>
          </td>
          <td colspan="2"><label>
              <input type="radio" name="radioAtr" value="tidak" <?= $CkAtr2 ?> onchange="saveDATA('MerupakanAtribusi','tidak','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />
              Bukan merupakan biaya atribusi</label></td>
        </tr>
        <tr height="25" style="font-weight:bold">
          <td colspan="4"><label>
              <input type="radio" name="radioAtrInd" value="diketahui" <?= $CkIndk1 ?> <?= $CkIndk1D ?> onchange="saveDATA('MerupakanAtribusi_induk','diketahui','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />
              Diketahui data awal/induknya, sebutkan data barang induknya :???</label></td>
        </tr>
        <tr height="24" style="font-weight:bold">
          <td width="23">&nbsp;</td>
          <td width="135">Nibar</td>
          <td width="17">:</td>
          <td width="548"><input type="text" name="Atribusi1" id="Atribusi1" value="<?= $Atribusi1 ?>" <?= $Atribusi1R ?> onkeypress="if (event.keyCode==13){saveDATA('Nibar',this,'Y','TbL4','<?= $IdT ?>','<?= $SnsATR ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="24" style="font-weight:bold">
          <td width="23">&nbsp;</td>
          <td>Kode Barang </td>
          <td width="17">:</td>
          <td width="548"><input type="text" name="Atribusi2" id="Atribusi2" value="<?= $Atribusi2 ?>" <?= $Atribusi2R ?> onkeypress="if (event.keyCode==13){saveDATA('KodeBarang',this,'Y','TbL4','<?= $IdT ?>','<?= $SnsATR ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="24" style="font-weight:bold">
          <td width="23">&nbsp;</td>
          <td>Kode Lokasi </td>
          <td width="17">:</td>
          <td width="548"><input type="text" name="Atribusi3" id="Atribusi3" value="<?= $Atribusi3 ?>" <?= $Atribusi3R ?> onkeypress="if (event.keyCode==13){saveDATA('KodeLokasi',this,'Y','TbL4','<?= $IdT ?>','<?= $SnsATR ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="24" style="font-weight:bold">
          <td width="23">&nbsp;</td>
          <td>Kode Register </td>
          <td width="17">:</td>
          <td width="548"><input type="text" name="Atribusi4" id="Atribusi4" value="<?= $Atribusi4 ?>" <?= $Atribusi4R ?> onkeypress="if (event.keyCode==13){saveDATA('KodeRegister',this,'Y','TbL4','<?= $IdT ?>','<?= $SnsATR ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="24" style="font-weight:bold">
          <td width="23">&nbsp;</td>
          <td>Nama Barang </td>
          <td width="17">:</td>
          <td width="548"><input type="text" name="Atribusi5" id="Atribusi5" value="<?= $Atribusi5 ?>" <?= $Atribusi5R ?> onkeypress="if (event.keyCode==13){saveDATA('NamaBarang',this,'Y','TbL4','<?= $IdT ?>','<?= $SnsATR ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="24" style="font-weight:bold">
          <td width="23">&nbsp;</td>
          <td>Spesifikasi Nama Barang </td>
          <td width="17">:</td>
          <td width="548"><input type="text" name="Atribusi6" id="Atribusi6" value="<?= $Atribusi6 ?>" <?= $Atribusi6R ?> onkeypress="if (event.keyCode==13){saveDATA('NamaSpesifikasiBarang',this,'Y','TbL4','<?= $IdT ?>','<?= $SnsATR ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="25" style="font-weight:bold">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="4"><label>
              <input type="radio" name="radioAtrInd" value="tidakdiketahui" <?= $CkIndk2 ?> <?= $CkIndk2D ?> onchange="saveDATA('MerupakanAtribusi_induk','tidakdiketahui','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />
              Tidak diketahui nilai induknya </label></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr height="26">
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr style="font-weight:bold">
          <td width="30">J.</td>
          <td width="140">Alamat</td>
          <td width="20">:</td>
          <td colspan="5"><input type="text" name="fForm" id="fForm" readonly value="<?= $mRo[21] ?>" style="width:300px; background:#fff" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="128">
            <label><input type="radio" name="radioAlm" value="sesuai" <?= $CkAlm1 ?> onchange="saveDATA('Alamat','sesuai','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Sesuai</label>
          </td>
          <td width="145">
            <label><input type="radio" name="radioAlm" value="tidaksesuai" <?= $CkAlm2 ?> onchange="saveDATA('Alamat','tidaksesuai','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Tidak Sesuai</label>
          </td>
          <td width="147">Sebutkan yang seharusnya</td>
          <td width="20">:</td>
          <td><input type="text" name="tsesuaiALM" id="tsesuaiALM" value="<?= $CkAlmM ?>" <?= $CkAlmR ?> onkeypress="if (event.keyCode==13){saveDATA('AlamatMemo',this,'Y','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr style="font-weight:bold">
          <td width="30">K.</td>
          <td width="140">Kondisi Barang</td>
          <td width="20">:</td>
          <td colspan="5"><input type="text" name="KonBRG" id="KonBRG" value="<?= $mRo[41] ?>" readonly style="width:25px; text-align:center" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="128">
            <label><input type="radio" name="radioKon" value="B" <?= $CkKon1 ?> onchange="saveDATA('KondisiBarang','B','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Baik (B)</label>
          </td>
          <td width="145">
            <label><input type="radio" name="radioKon" value="RR" <?= $CkKon2 ?> onchange="saveDATA('KondisiBarang','RR','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Rusak Ringan (RR)</label>
          </td>
          <td width="147">
            <label><input type="radio" name="radioKon" value="RB" <?= $CkKon3 ?> onchange="saveDATA('KondisiBarang','RB','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Rusak Berat (RB)</label>
          </td>
          <td width="20"></td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
          <td width="30" style="font-weight:bold">L.</td>
          <td width="138" style="font-weight:bold">Penggunaan Barang</td>
          <td width="23">:</td>
          <td colspan="4" style="font-weight:bold">
            <label><input type="radio" name="radioGun" value="PD" <?= $CkGun1 ?> onchange="saveDATA('PenggunaanBarang','PD','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Pemerintah Daerah</label>
          </td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Pengguna / Kuasa Pengguna Barang Lainnya</td>
          <td width="16">:</td>
          <td width="417"><input type="text" name="nmKuasaLainnya" id="nmKuasaLainnya" value="<?= $NmKuasa ?>" <?= $NmKuasaR ?> onkeypress="if (event.keyCode==13){saveDATA('PD_NmKuasaPenggunaLainnya',this,'Y','TbL2','<?= $IdT ?>','<?= $SnsIDG ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td style="font-weight:bold">
            <label><input type="radio" name="radioGun" value="PP" <?= $CkGun2 ?> onchange="saveDATA('PenggunaanBarang','PP','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Pemerintah Pusat</label>
          </td>
          <td style="font-weight:bold; color:#0000FF">Dasar Penggunaan : </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td><label><input type="radio" name="radioDsrPP" value="ada" <?= $CkDsrPP1 ?> <?= $CkDsrPPR1 ?> onchange="saveDATA('PP_dasarpenggunaan','ada','N','TbL2','<?= $IdT ?>','<?= $SnsIDG ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Ada, Sebutkan</label></td>
          <td></td>
          <td>&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
          <td>:</td>
          <td>
            <input type="text" name="PP_Nama" id="PP_Nama" value="<?= $PP_Ada_Nama ?>" <?= $PP_Ada_NamaR ?> onkeypress="if (event.keyCode==13){saveDATA('PP_dasarpenggunaan_ada_nama',this,'Y','TbL2','<?= $IdT ?>','<?= $SnsIDG ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" />
          </td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Dokumen</td>
          <td>:</td>
          <td><input type="text" name="PP_NamaDoc" id="PP_NamaDoc" value="<?= $PP_Ada_NamaDoc ?>" <?= $PP_Ada_NamaDocR ?> onkeypress="if (event.keyCode==13){saveDATA('PP_dasarpenggunaan_ada_namadokumen',this,'Y','TbL2','<?= $IdT ?>','<?= $SnsIDG ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td colspan="3"><label><input type="radio" name="radioDsrPP" value="tidakada" <?= $CkDsrPP2 ?> <?= $CkDsrPPR2 ?> onchange="saveDATA('PP_dasarpenggunaan','tidakada','N','TbL2','<?= $IdT ?>','<?= $SnsIDG ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Tidak ada dasar penggunaan</label></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
          <td>:</td>
          <td><input type="text" name="PP_TdkNama" id="PP_TdkNama" value="<?= $PP_TdkAda_Nama ?>" <?= $PP_TdkAda_NamaR ?> onkeypress="if (event.keyCode==13){saveDATA('PP_dasarpenggunaan_tidakada_nama',this,'Y','TbL2','<?= $IdT ?>','<?= $SnsIDG ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="182"></td>
          <td width="104">&nbsp;</td>
          <td></td>
          <td>&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td style="font-weight:bold">
            <label><input type="radio" name="radioGun" value="PDL" <?= $CkGun3 ?> onchange="saveDATA('PenggunaanBarang','PDL','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Pemerintah Daerah Lainya</label>
          </td>
          <td style="font-weight:bold; color:#0000FF">Dasar Penggunaan:</td>
          <td></td>
          <td>&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td><label><input type="radio" name="radioDsrPDL" value="ada" <?= $CkDsrPDL1 ?> <?= $CkDsrPDLR1 ?> onchange="saveDATA('PDL_dasarpenggunaan','ada','N','TbL2','<?= $IdT ?>','<?= $SnsIDG ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Ada, Sebutkan</label></td>
          <td></td>
          <td>&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
          <td>:</td>
          <td><input type="text" name="PDL_Nama" id="PDL_Nama" value="<?= $PDL_Ada_Nama ?>" <?= $PDL_Ada_NamaR ?> onkeypress="if (event.keyCode==13){saveDATA('PDL_dasarpenggunaan_ada_nama',this,'Y','TbL2','<?= $IdT ?>','<?= $SnsIDG ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Dokumen</td>
          <td>:</td>
          <td><input type="text" name="PDL_NamaDoc" id="PDL_NamaDoc" value="<?= $PDL_Ada_NamaDoc ?>" <?= $PDL_Ada_NamaDocR ?> onkeypress="if (event.keyCode==13){saveDATA('PDL_dasarpenggunaan_ada_namadokumen',this,'Y','TbL2','<?= $IdT ?>','<?= $SnsIDG ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td colspan="3"><label><input type="radio" name="radioDsrPDL" value="tidakada" <?= $CkDsrPDL2 ?> <?= $CkDsrPDLR2 ?> onchange="saveDATA('PDL_dasarpenggunaan','tidakada','N','TbL2','<?= $IdT ?>','<?= $SnsIDG ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Tidak ada dasar penggunaan</label></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
          <td>:</td>
          <td><input type="text" name="PDL_TdkNama" id="PDL_TdkNama" value="<?= $PDL_TdkAda_Nama ?>" <?= $PDL_TdkAda_NamaR ?> onkeypress="if (event.keyCode==13){saveDATA('PDL_dasarpenggunaan_tidakada_nama',this,'Y','TbL2','<?= $IdT ?>','<?= $SnsIDG ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td style="font-weight:bold">
            <label><input type="radio" name="radioGun" value="PL" <?= $CkGun4 ?> onchange="saveDATA('PenggunaanBarang','PL','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Pihak Lain</label>
          </td>
          <td style="font-weight:bold; color:#0000FF">Dasar Penggunaan : </td>
          <td></td>
          <td>&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td><label><input type="radio" name="radioDsrPL" value="ada" <?= $CkDsrPL1 ?> <?= $CkDsrPLR1 ?> onchange="saveDATA('PL_dasarpenggunaan','ada','N','TbL2','<?= $IdT ?>','<?= $SnsIDG ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Ada, Sebutkan</label></td>
          <td></td>
          <td>&nbsp;</td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
          <td>:</td>
          <td><input type="text" name="PL_Nama" id="PL_Nama" value="<?= $PL_Ada_Nama ?>" <?= $PL_Ada_NamaR ?> onkeypress="if (event.keyCode==13){saveDATA('PL_dasarpenggunaan_ada_nama',this,'Y','TbL2','<?= $IdT ?>','<?= $SnsIDG ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Dokumen</td>
          <td>:</td>
          <td><input type="text" name="PL_NamaDoc" id="PL_NamaDoc" value="<?= $PL_Ada_NamaDoc ?>" <?= $PL_Ada_NamaDocR ?> onkeypress="if (event.keyCode==13){saveDATA('PL_dasarpenggunaan_ada_namadokumen',this,'Y','TbL2','<?= $IdT ?>','<?= $SnsIDG ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td colspan="3"><label><input type="radio" name="radioDsrPL" value="tidakada" <?= $CkDsrPL2 ?> <?= $CkDsrPLR2 ?> onchange="saveDATA('PL_dasarpenggunaan','tidakada','N','TbL2','<?= $IdT ?>','<?= $SnsIDG ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Tidak ada dasar penggunaan</label></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
          <td>:</td>
          <td><input type="text" name="PL_TdkNama" id="PL_TdkNama" value="<?= $PL_TdkAda_Nama ?>" <?= $PL_TdkAda_NamaR ?> onkeypress="if (event.keyCode==13){saveDATA('PL_dasarpenggunaan_tidakada_nama',this,'Y','TbL2','<?= $IdT ?>','<?= $SnsIDG ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
          <td width="27" style="font-weight:bold">M.</td>
          <td width="140" style="font-weight:bold">Data Barang Tercatat Ganda</td>
          <td width="22">:</td>
          <td colspan="4"><label><input type="radio" name="radioGanda" value="tidak" <?= $CkGan1 ?> onchange="saveDATA('DataTercatatGanda','tidak','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Tidak</label></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="4"><label><input type="radio" name="radioGanda" value="ya" <?= $CkGan2 ?> onchange="saveDATA('DataTercatatGanda','ya','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Ya, jika ya sebutkan pencatatan ganda dengan :</label></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="26" align="center">a.</td>
          <td width="234">NIBAR </td>
          <td width="23">: </td>
          <td width="438"><input type="text" name="GanNibar" id="GanNibar" value="<?= $CttGand1 ?>" <?= $CttGand1R ?> onkeypress="if (event.keyCode==13){saveDATA('Nibar',this,'Y','TbL3','<?= $IdT ?>','<?= $SnsGND ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">b.</td>
          <td>Kode Register</td>
          <td>:</td>
          <td><input type="text" name="GanNibar2" id="GanNibar2" value="<?= $CttGand2 ?>" <?= $CttGand2R ?> onkeypress="if (event.keyCode==13){saveDATA('KodeRegister',this,'Y','TbL3','<?= $IdT ?>','<?= $SnsGND ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">c.</td>
          <td>Kode Barang</td>
          <td>:</td>
          <td><input type="text" name="GanNibar3" id="GanNibar3" value="<?= $CttGand3 ?>" <?= $CttGand3R ?> onkeypress="if (event.keyCode==13){saveDATA('KodeBarang',this,'Y','TbL3','<?= $IdT ?>','<?= $SnsGND ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">d.</td>
          <td>Nama Barang</td>
          <td>:</td>
          <td><input type="text" name="GanNibar4" id="GanNibar4" value="<?= $CttGand4 ?>" <?= $CttGand4R ?> onkeypress="if (event.keyCode==13){saveDATA('NamaBarang',this,'Y','TbL3','<?= $IdT ?>','<?= $SnsGND ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">e.</td>
          <td>Nama Spesifikasi Barang</td>
          <td>:</td>
          <td><input type="text" name="GanNibar5" id="GanNibar5" value="<?= $CttGand5 ?>" <?= $CttGand5R ?> onkeypress="if (event.keyCode==13){saveDATA('NamaSpesifikasiBarang',this,'Y','TbL3','<?= $IdT ?>','<?= $SnsGND ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">f.</td>
          <td>Jumlah</td>
          <td>:</td>
          <td><input type="text" name="GanNibar6" id="GanNibar6" value="<?= $CttGand6 ?>" <?= $CttGand6R ?> onkeypress="if (event.keyCode==13){saveDATA('JmlBarang',this,'Y','TbL3','<?= $IdT ?>','<?= $SnsGND ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:50px" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">g.</td>
          <td>Satuan</td>
          <td>:</td>
          <td><input type="text" name="GanNibar7" id="GanNibar7" value="<?= $CttGand7 ?>" <?= $CttGand7R ?> onkeypress="if (event.keyCode==13){saveDATA('Satuan',this,'Y','TbL3','<?= $IdT ?>','<?= $SnsGND ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">h.</td>
          <td>Nilai Perolehan Barang</td>
          <td>:</td>
          <td><input type="text" name="GanNibar8" id="GanNibar8" value="<?= $CttGand8 ?>" <?= $CttGand8R ?> onkeypress="if (event.keyCode==13){saveDATA('NilaiPerolehan',this,'Y','TbL3','<?= $IdT ?>','<?= $SnsGND ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:120px; text-align:right" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">i.</td>
          <td>Tahun, Bulan, Tanggal Perolehan</td>
          <td>:</td>
          <td><input type="text" name="GanNibar9" id="GanNibar9" value="<?= $CttGand9 ?>" <?= $CttGand9R ?> onkeypress="if (event.keyCode==13){saveDATA('TanggalBulanTahunPerolehan',this,'Y','TbL3','<?= $IdT ?>','<?= $SnsGND ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:120px" /></td>
        </tr>
        <tr height="25">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">j.</td>
          <td>Kuasa Pengguna Barang Lainnya, Pengguna Barang Lainnya atau Pengelola Barang</td>
          <td>:</td>
          <td><input type="text" name="GanNibar10" id="GanNibar10" value="<?= $CttGand10 ?>" <?= $CttGand10R ?> onkeypress="if (event.keyCode==13){saveDATA('KuasaPenggunaBarang',this,'Y','TbL3','<?= $IdT ?>','<?= $SnsGND ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:250px" /></td>
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
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr height="24" style="font-weight:bold">
          <td width="30">N.</td>
          <td width="133">Titik Koordinat</td>
          <td width="25">:</td>
          <td colspan="2">
            <input type="text" name="TitikKoordinat" id="TitikKoordinat" value="<?= $Koordinat ?>" onkeypress="if (event.keyCode==13){saveDATA('TitikKoordinat',this,'Y','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:292px" />
            <a href="#" class="btn-lokasi-peta" onclick="OpenAccMAP('<?= $ReO ?>','750','450','center'); return false;"><svg class="icon-map" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
              </svg>Lokasi Pada Peta</a>
            <style>
              .btn-lokasi-peta {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                margin-left: 10px;
                padding: 5px 14px;
                font-family: Calibri, sans-serif;
                font-size: 11px;
                font-weight: 600;
                color: #fff;
                background: linear-gradient(135deg, #2563eb, #1d4ed8);
                border: 1px solid #1e40af;
                border-radius: 6px;
                text-decoration: none;
                cursor: pointer;
                transition: all 0.25s ease;
                box-shadow: 0 2px 6px rgba(37, 99, 235, 0.35);
                vertical-align: middle;
              }

              .btn-lokasi-peta:hover {
                background: linear-gradient(135deg, #1d4ed8, #1e3a8a);
                box-shadow: 0 4px 12px rgba(37, 99, 235, 0.5);
                transform: translateY(-1px);
              }

              .btn-lokasi-peta:active {
                transform: translateY(0);
                box-shadow: 0 1px 3px rgba(37, 99, 235, 0.3);
              }

              .btn-lokasi-peta .icon-map {
                width: 14px;
                height: 14px;
                transition: transform 0.3s ease;
              }

              .btn-lokasi-peta:hover .icon-map {
                transform: scale(1.2) rotate(-8deg);
              }
            </style>
          </td>
        </tr>
        <tr height="24" style="font-weight:bold">
          <td>O.</td>
          <td>Lainnya</td>
          <td>:</td>
          <td colspan="2"><input type="text" name="Lainnya" id="Lainnya" value="<?= $Lainnya ?>" onkeypress="if (event.keyCode==13){saveDATA('Lainnya',this,'Y','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:292px" /></td>
        </tr>
        <tr height="24" style="font-weight:bold">
          <td>P.</td>
          <td>Keterangan</td>
          <td>:</td>
          <td colspan="2"><input type="text" name="Keterangan" id="Keterangan" value="<?= $Keterang ?>" onkeypress="if (event.keyCode==13){saveDATA('Keterangan',this,'Y','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>');}" style="width:292px" /></td>
        </tr>
        <tr style="font-weight:bold">
          <td>Q.</td>
          <td>Foto / Denah (Max 2MB)</td>
          <td>:</td>
          <td colspan="2">
            <input id="imgfile" name="imgfile" type="file">
            <input type="button" value="Upload" onclick="P_Upload('Img','<?= $AsT ?>','<?= $SnsIDT ?>','<?= $ReO ?>','<?= $IdT ?>','<?= $IdL ?>')">
          </td>
        </tr>
        <tr style="font-weight:bold">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="319">&nbsp;</td>
          <td align="center"><?= $NmIbuk ?>,&nbsp;&nbsp;&nbsp;
            <select class="boxs" name="fHR" tabindex="0" style="width:50px" onchange="saveDATA('TanggalSensusHR',this,'Y','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')">
              <option value="00"></option>
              <?php
              for ($i = 1; $i <= 31; $i++) {
                $sel = "";
                if ($i == $gHR) {
                  $sel = "selected";
                }
                echo '<option ' . $sel . ' value="' . $i . '">' . $i . '</option>';
              }
              ?>
            </select>
            <select class="boxs" name="fBL" tabindex="0" style="width:95px" onchange="saveDATA('TanggalSensusBL',this,'Y','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')">
              <option value="00"></option>
              <?php
              for ($i = 1; $i <= 12; $i++) {
                $sel = "";
                if ($i == $gBL) {
                  $sel = "selected";
                }
                echo '<option ' . $sel . ' value="' . $i . '">' . fNmBulan($i) . '</option>';
              }
              ?>
            </select>
            <select class="boxs" name="fTH" style="width: 60px" tabindex="0" onchange="saveDATA('TanggalSensusTH',this,'Y','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')">
              <option value="0000"></option>
              <?php
              for ($i = 2020; $i <= 2030; $i++) {
                $sel = "";
                if ($i == $gTH) {
                  $sel = "selected";
                }
                echo '<option ' . $sel . ' value="' . $i . '">' . $i . '</option>';
              }
              ?>
            </select>
          </td>
        </tr>
        <tr style="font-weight:bold">
          <td rowspan="3">&nbsp;</td>
          <td colspan="3" valign="top">
            <div id="loadImgLokasi" class="loadImgLokasi" style="border:1px solid; width:454px; height:150px">
              <table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="150" border="0">
                <?php if ($mRo67 != '') { ?>
                  <tr height="18">
                    <td valign="top" style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">&nbsp;</td>
                    <td valign="top" style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px"><img src="simandor/images/<?= $mRo[0] . "xyz" . $mRo67 ?>" height="50" width="40" style="border:1px #999999 solid" /></td>
                    <td valign="top" style="border-bottom:1px dotted #CCCCCC; padding-top:5px; padding-bottom:5px"><?= $mRo67 ?></td>
                    <td valign="top" style="border-bottom:1px dotted #CCCCCC; padding-right:15px; padding-top:5px; padding-bottom:5px; text-align:right"><?= $mRo68 ?> KB</td>
                    <td valign="top" style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">
                      <a href="#" onclick="viewIMG('Smd','<?= $mRo[0] ?>','','600','400','<?= $IdL ?>'); return false;" class="ico prev">&nbsp;</a>&nbsp;&nbsp;
                      <a href="#" onclick="alert('Simador data -> Access denied...!!!'); return false;" class="ico delt">&nbsp;</a>
                    </td>
                  </tr>
                <?php } ?>
                <?php
                $iG = 1;
                $nSX = "SELECT IDT, file_name, file_content, file_type, file_size FROM tb_lembar_kerja_foto_denah WHERE Referensi='" . $mRo[1] . "' AND RefGroup ='" . $mRo[2] . "' AND KdUPB='" . $mRo[8] . "' ORDER BY file_name";
                $nRx = mysql_query($nSX);
                while ($mRx = mysql_fetch_array($nRx, MYSQL_BOTH)) {
                  $gBG  = fBackCLR($iG);
                  $rIdT = $mRx[0];
                  $gNm = $mRx[1];
                  $gCn = $mRx[2];
                  $gTy = $mRx[3];

                  $gSz = fConvertToRupiah($mRx[4] / 1025);
                ?>
                  <tr height="18">
                    <td valign="top" width="17" <?= $gBG ?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px"><?= $iG ?>.</td>
                    <td valign="top" width="70" <?= $gBG ?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">
					<img src="<?= "Lembar_Kerja_Frm_Img_Load.php?CrT=Img&rIdT=" . $rIdT ?>" height="40" width="40" style="border:1px #999999 solid" />
					</td>
                    <td width="185" valign="top" <?= $gBG ?>style="border-bottom:1px dotted #CCCCCC; padding-top:5px; padding-bottom:5px"><?= $gNm ?></td>
                    <td valign="top" width="87" <?= $gBG ?> style="border-bottom:1px dotted #CCCCCC; padding-right:15px; padding-top:5px; padding-bottom:5px; text-align:right"><?= $gSz ?> KB</td>
                    <td valign="top" width="93" <?= $gBG ?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">
                      <a href="#" onclick="viewIMG('Img','<?= $rIdT ?>','_Tabel','600','400','<?= $IdL ?>'); return false;" class="ico prev">&nbsp;</a>&nbsp;&nbsp;
                      <a href="#" onclick="remoIMG('Img','<?= $AsT ?>','_Tabel','<?= $ReO ?>','<?= $rIdT ?>','<?= $IdT ?>','<?= $IdL ?>'); return false;" class="ico dele">&nbsp;</a>
                    </td>
                  </tr>
                <?php
                  $iG++;
                }
                ?>
                <?php
				$nSX = "SELECT IDT, filename, '', filetype, filesize FROM tb_lembar_kerja_upload_img WHERE Referensi='".$mRo[1]."' AND RefGroup ='".$mRo[2]."' AND KdUPB='".$mRo[8]."' ORDER BY filename";
                $nRx = mysql_query($nSX);
                while ($mRx = mysql_fetch_array($nRx, MYSQL_BOTH)) {
                  $gBG  = fBackCLR($iG);
                  $rIdT = $mRx[0];
                  $gNm = $mRx[1];
                  $gCn = $mRx[2];
                  $gTy = $mRx[3];

                  $gSz = fConvertToRupiah($mRx[4] / 1025);
                ?>
                  <tr height="18">
                    <td valign="top" width="17" <?= $gBG ?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px"><?= $iG ?>.</td>
                    <td valign="top" width="70" <?= $gBG ?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">
					<img src="upload_img/<?=$gNm?>" height="50" width="40" style="border:1px #999999 solid" />
					</td>
                    <td width="185" valign="top" <?= $gBG ?>style="border-bottom:1px dotted #CCCCCC; padding-top:5px; padding-bottom:5px"><?= $gNm ?></td>
                    <td valign="top" width="87" <?= $gBG ?> style="border-bottom:1px dotted #CCCCCC; padding-right:15px; padding-top:5px; padding-bottom:5px; text-align:right"><?= $gSz ?> KB</td>
                    <td valign="top" width="93" <?= $gBG ?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">
                      <a href="#" onclick="viewIMG('Img','<?= $rIdT ?>','','600','400','<?= $IdL ?>'); return false;" class="ico prev">&nbsp;</a>&nbsp;&nbsp;
                      <a href="#" onclick="remoIMG('Img','<?= $AsT ?>','','<?= $ReO ?>','<?= $rIdT ?>','<?= $IdT ?>','<?= $IdL ?>'); return false;" class="ico dele">&nbsp;</a>
                    </td>
                  </tr>
                <?php
                  $iG++;
                }
                ?>
                <?php if ($iG == 1) { ?>
                  <tr height="20">
                    <td colspan="5" style="text-align:center; vertical-align:middle">Hasil upload tidak ditemukan..!!</td>
                  </tr>
                <?php } ?>
                <tr height="100%">
                  <td colspan="5" style="text-align:center">&nbsp;</td>
                </tr>
              </table>
            </div>
          </td>
          <td width="403" rowspan="3" valign="top">
            <table align="center" cellpadding="0" class="table-form" cellspacing="0" width="100%" height="30" border="0">
              <tr>
                <td colspan="3">&nbsp;</td>
              </tr>
              <tr height="30">
                <td colspan="3">Pelaksana/Petugas Inventarisasi :</td>
              </tr>
              <tr height="24">
                <td width="26">1.</td>
                <td width="259"><input type="text" name="Petugas1" id="Petugas1" readonly value="<?= $Petugas1 ?>" style="width:250px" /></td>
                <td width="118"><input type="button" value="..." onclick="showPetugas('','PetugasSensus_1','<?= $AsT ?>','<?= $SnsIDT ?>','<?= $ReO ?>','<?= $IdT ?>','<?= $IdL ?>')" style=" height:22px; width:23px"></td>
              </tr>
              <tr height="24">
                <td>2.</td>
                <td><input type="text" name="Petugas1" id="Petugas2" readonly value="<?= $Petugas2 ?>" style="width:250px" /></td>
                <td><input name="button" type="button" style=" height:22px; width:23px" onclick="showPetugas('','PetugasSensus_2','<?= $AsT ?>','<?= $SnsIDT ?>','<?= $ReO ?>','<?= $IdT ?>','<?= $IdL ?>')" value="..." /></td>
              </tr>
              <tr height="24">
                <td>3.</td>
                <td><input type="text" name="Petugas3" id="Petugas3" readonly value="<?= $Petugas3 ?>" style="width:250px" /></td>
                <td><input name="button2" type="button" style=" height:22px; width:23px" onclick="showPetugas('','PetugasSensus_3','<?= $AsT ?>','<?= $SnsIDT ?>','<?= $ReO ?>','<?= $IdT ?>','<?= $IdL ?>')" value="..." /></td>
              </tr>
              <tr height="24">
                <td>4.</td>
                <td><input type="text" name="Petugas4" id="Petugas4" readonly value="<?= $Petugas4 ?>" style="width:250px" /></td>
                <td><input name="button3" type="button" style=" height:22px; width:23px" onclick="showPetugas('','PetugasSensus_4','<?= $AsT ?>','<?= $SnsIDT ?>','<?= $ReO ?>','<?= $IdT ?>','<?= $IdL ?>')" value="..." /></td>
              </tr>
              <tr height="24">
                <td colspan="2">Penandatangan : </td>
                <td>&nbsp;</td>
              </tr>
              <tr height="24">
                <td>=&gt;</td>
                <td><input type="text" name="Petugas5" id="Petugas5" readonly value="<?= $Petugas5 ?>" style="width:250px" /></td>
                <td><input name="button4" type="button" style=" height:22px; width:23px" onclick="showPetugas('','PetugasSensus_ttd','<?= $AsT ?>','<?= $SnsIDT ?>','<?= $ReO ?>','<?= $IdT ?>','<?= $IdL ?>')" value="..." /></td>
              </tr>
              <tr height="24">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr height="24">
                <td colspan="2">Input Data Sensus?</td>
                <td>&nbsp;</td>
              </tr>
              <tr height="24">
                <td colspan="3">
                  <label><input type="radio" name="radioFIX" value="N" <?= $CkFix1 ?> onchange="saveDATA('DataSensusFix','N','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />None</label>&nbsp;&nbsp;&nbsp;&nbsp;
                  <label><input type="radio" name="radioFIX" value="P" <?= $CkFix2 ?> onchange="saveDATA('DataSensusFix','P','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Dalam Proses</label>&nbsp;&nbsp;&nbsp;
                  <label><input type="radio" name="radioFIX" value="Y" <?= $CkFix3 ?> onchange="saveDATA('DataSensusFix','Y','N','TbL1','<?= $IdT ?>','<?= $SnsIDT ?>','<?= $AsT ?>','<?= $ReO ?>','<?= $IdL ?>')" />Selesai</label>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr height="50" style="font-weight:bold">
          <td colspan="3">Upload Dokumen (<i> yang sudah ditandatangan </i>) :
            <input id="imgfile2" name="imgfile2" type="file">
            <input type="button" value="Upload" onclick="P_Upload('Pdf','<?= $AsT ?>','<?= $SnsIDT ?>','<?= $ReO ?>','<?= $IdT ?>','<?= $IdL ?>')">
          </td>
        </tr>
        <tr style="font-weight:bold">
          <td colspan="3" valign="top">
            <div id="loadImgDokumen" class="loadImgLokasi" style="border:1px solid; width:454px; height:70px">
              <table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="70" border="0">
                <?php
                $iG = 1;
                $nSX = "SELECT IDT, file_name, file_content, file_type, file_size FROM tb_lembar_kerja_dokumen WHERE Referensi='" . $mRo[1] . "' AND RefGroup ='" . $mRo[2] . "' AND KdUPB='" . $mRo[8] . "' ORDER BY file_name";
				$nRx = mysql_query($nSX);
                while ($mRx = mysql_fetch_array($nRx, MYSQL_BOTH)) {
                  $gBG  = fBackCLR($iG);
                  $rIdT = $mRx[0];
                  $gNm = $mRx[1];
                  $gCn = $mRx[2];
                  $gTy = $mRx[3];

                  $gSz = fConvertToRupiah($mRx[4] / 1025);
                ?>
                  <tr height="18">
                    <td valign="top" width="17" <?= $gBG ?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px"><?= $iG ?>.</td>
                    <td valign="top" width="10" <?= $gBG ?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px"></td>
                    <td width="185" valign="top" <?= $gBG ?>style="border-bottom:1px dotted #CCCCCC; padding-top:5px; padding-bottom:5px"><?= $gNm ?></td>
                    <td valign="top" width="87" <?= $gBG ?> style="border-bottom:1px dotted #CCCCCC; padding-right:15px; padding-top:5px; padding-bottom:5px; text-align:right"><?= $gSz ?> KB</td>
                    <td valign="top" width="93" <?= $gBG ?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">
                      <a href="#" onclick="viewIMG('Pdf','<?= $rIdT ?>','_Tabel','600','400','<?= $IdL ?>'); return false;" class="ico prev">&nbsp;</a>&nbsp;&nbsp;
                      <a href="#" onclick="remoIMG('Pdf','<?= $AsT ?>','_Tabel','<?= $ReO ?>','<?= $rIdT ?>','<?= $IdT ?>','<?= $IdL ?>'); return false;" class="ico dele">&nbsp;</a>
                    </td>
                  </tr>
                <?php
                  $iG++;
                }
                ?>
                <?php
				$nSX = "SELECT IDT, filename, '', filetype, filesize FROM tb_lembar_kerja_upload_pdf WHERE Referensi='".$mRo[1]."' AND RefGroup ='".$mRo[2]."' AND KdUPB='".$mRo[8]."' ORDER BY filename";
				$nRx = mysql_query($nSX);
                while ($mRx = mysql_fetch_array($nRx, MYSQL_BOTH)) {
                  $gBG  = fBackCLR($iG);
                  $rIdT = $mRx[0];
                  $gNm = $mRx[1];
                  $gCn = $mRx[2];
                  $gTy = $mRx[3];

                  $gSz = fConvertToRupiah($mRx[4] / 1025);
                ?>
                  <tr height="18">
                    <td valign="top" width="17" <?= $gBG ?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px"><?= $iG ?>.</td>
                    <td valign="top" width="10" <?= $gBG ?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px"><!--img src="<?= "Lembar_Kerja_Frm_Img_Load.php?CrT=Pdf&rIdT=" . $rIdT ?>" height="40" width="40" style="border:1px #999999 solid" /--> </td>
                    <td width="185" valign="top" <?= $gBG ?>style="border-bottom:1px dotted #CCCCCC; padding-top:5px; padding-bottom:5px"><?= $gNm ?></td>
                    <td valign="top" width="87" <?= $gBG ?> style="border-bottom:1px dotted #CCCCCC; padding-right:15px; padding-top:5px; padding-bottom:5px; text-align:right"><?= $gSz ?> KB</td>
                    <td valign="top" width="93" <?= $gBG ?> style="border-bottom:1px dotted #CCCCCC; text-align:center; padding-top:5px; padding-bottom:5px">
                      <a href="#" onclick="viewIMG('Pdf','<?= $rIdT ?>','','600','400','<?= $IdL ?>'); return false;" class="ico prev">&nbsp;</a>&nbsp;&nbsp;
                      <a href="#" onclick="remoIMG('Pdf','<?= $AsT ?>','','<?= $ReO ?>','<?= $rIdT ?>','<?= $IdT ?>','<?= $IdL ?>'); return false;" class="ico dele">&nbsp;</a>
                    </td>
                  </tr>
                <?php
                  $iG++;
                }
                ?>
                <?php if ($iG == 1) { ?>
                  <tr height="20">
                    <td colspan="5" style="text-align:center; vertical-align:middle">Hasil upload tidak ditemukan..!!</td>
                  </tr>
                <?php } ?>
                <tr height="100%">
                  <td colspan="5" style="text-align:center">&nbsp;</td>
                </tr>
              </table>

            </div>
          </td>
        </tr>
        <tr style="font-weight:bold">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr style="font-weight:bold">
          <td>&nbsp;</td>
          <td><a href="#" class="ico docu" onclick="formCetakDok('Report_Form_LKI_TNH','<?= $IdT ?>','900','400','<?= $IdL ?>'); return false;">&nbsp;&nbsp;DOKUMEN CETAK</a></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<script languange="javascript">
  /*
$(document).ready(function()
{
	$("#loadImgLokasi").load("Lembar_Kerja_Frm_Data_LKI_View.php?SnsIDT=<?= $SnsIDT ?>");
	var refreshId = setInterval(function() 
	{
		$("#loadImgLokasi").load('Lembar_Kerja_Frm_Data_LKI_View.php?SnsIDT=<?= $SnsIDT ?>');
	}, 5000);
});
*/

  function OpenAccMAP(ReO, w, h, pos) {
    if (ReO == 'Y') {
      alert('Access denied, akses readonly..!!');
      return false;
    }
    var win = null;
    var txtHTML = "";
    var iErrors = 0;
    LeftPosition = (screen.width) ? (screen.width - w) / 2 : 100;
    TopPosition = (screen.height) ? (screen.height - h) / 2 : 100;
    settings = 'width=' + w + ',height=' + h + ',top=' + TopPosition + ',left=' + LeftPosition + ',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
    win = window.open('', '', settings);
    if (win != null) {
      win.window.document.open()
      URL_Top = "UploadIMG_Top.php?FrmG=Lokasi Peta -> KIB A (ASET TANAH)";
      URL_Mid = "UploadMAP_Mid.php?" + "<?= "rCRT=a&rIDT=" . $IdT . "&IdL=" . $IdL . "&src=lki&SnsIDT=" . $SnsIDT ?>";
      URL_Bot = "UploadIMG_Bot.php";
      txtHTML = "<html><head><title>Sipanda BMD Kab. Balangan</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='" + URL_Top + "' scrolling='no'><frame name='WinFindAcc_Mid' src='" + URL_Mid + "' scrolling='auto'><frame name='WinFindAcc_Bot' src= '" + URL_Bot + "' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"
      win.focus()
      win.window.document.clear()
      win.window.document.write(txtHTML)
      win.window.document.close()
      win.setTimeout("self.close()", 200000000)
    }
  }
</script>