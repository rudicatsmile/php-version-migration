<?php
require('Connection.php');
require('FileFunction.php');
require('Connection_SQL.php');
extract($_GET);

$gUnL=$gUnT;
if ($gUnT=='25.08.13.03') #BADAN PENGELOLA PAJAK DAN RETRIBUSI DAERAH baru
{
	$gUnT='25.08.13.01';	#BADAN PENGELOLA PAJAK DAN RETRIBUSI lama
}
else if ($gUnT=='25.08.13.01') #BADAN PENGELOLAAN KEUANGAN DAN PENDAPATAN DAERAH baru
{
	$gUnT='25.08.04.04';	#BADAN PENGELOLAAN KEUANGAN DAN PENDAPATAN DAERAH lama
}
else if ($gUnT=='25.08.13.04') #PENGELOLA BARANG baru
{
	$gUnT='25.08.04.05';	#PENGELOLA BARANG lama
}

$kd_prv = substr($gUnT,0,2);
$kd_kab = (int)substr($gUnT,4,2);
$kd_bdg = (int)substr($gUnT,6,2);
$kd_unt = (int)substr($gUnT,9,2); 

if ($gSuB!='')
{
	$kd_sub = (int)substr($gSuB,12,2);
}
else
{
	$kd_sub = "%";
}

if ($gUpB!='')
{
	$kd_upb = (int)substr($gUpB,15,3); 
}
else
{
	$kd_upb = "%"; 
}

$iG=1;

$PageNumber = $gPaG;
$RowspPage  = $gReC;
$iG = ($PageNumber*$gReC)-$gReC+1;

if ($gMsL!='null'){$MsL = "AND P1.Kd_Masalah=".$gMsL;}
else {$MsL = "AND P1.Kd_Masalah IS NULL";}

$nSQ = "SELECT 
P1.IDPemda as A0
,P1.Kd_Prov as A1
,P1.Kd_Kab_Kota as A2
,P1.Kd_Bidang as A3
,P1.Kd_Unit as A4
,P1.Kd_Sub as A5
,P1.Kd_UPB as A6

,P1.Kd_Aset8 as A7
,P1.Kd_Aset80 as A8
,P1.Kd_Aset81 as A9
,P1.Kd_Aset82 as A10
,P1.Kd_Aset83 as A11
,P1.Kd_Aset84 as A12
,P1.Kd_Aset85 as A13

,P1.No_Reg8 as A14
,P1.No_Register as A15

,P1.Kd_Ruang as A16
,P1.Kd_Pemilik as A17
,P1.Merk as A18
,P1.Type as A19
,P1.CC as A20
,P1.Bahan as A21
,P1.Tgl_Perolehan as A22
,P1.Nomor_Pabrik as A23
,P1.Nomor_Rangka as A24
,P1.Nomor_Mesin as A25
,P1.Nomor_Polisi as A26
,P1.Nomor_BPKB as A27
,P1.Asal_usul as A28
,P1.Kondisi as A29
,P1.Harga as A30
,P1.Masa_Manfaat as A31
,P1.Nilai_Sisa as A32
,P1.Keterangan as A33
,P1.Tahun as A34
,P1.No_SP2D as A35
,P1.No_ID as A36
,P1.Tgl_Pembukuan as A37
,P1.Kd_Kecamatan as A38
,P1.Kd_Desa as A39
,P1.Invent as A40
,P1.No_SKGuna as A41
,P1.Kd_Penyusutan as A42
,P1.Kd_Data as A43
,P1.Kd_Masalah as A44
,P1.Ket_Masalah as A45
,P1.Kd_KA as A46
,P1.No_SIPPT as A47
,P1.Dev_Id as A48
,P1.Kd_Hapus as A49
,P1.IDData as A50
,P1.Tg_Update8 as A51 
,P2.Nm_Aset5 as A52 

FROM ta_kib_b P1 
LEFT JOIN Ref_Rek5_108 P2 ON 
P2.Kd_Aset =P1.Kd_Aset8
AND P2.Kd_Aset0=P1.Kd_Aset80
AND P2.Kd_Aset1=P1.Kd_Aset81
AND P2.Kd_Aset2=P1.Kd_Aset82
AND P2.Kd_Aset3=P1.Kd_Aset83
AND P2.Kd_Aset4=P1.Kd_Aset84
AND P2.Kd_Aset5=P1.Kd_Aset85  
WHERE P1.Kd_Prov='".$kd_prv."' AND P1.Kd_Kab_Kota = '".$kd_kab."' AND P1.Kd_Bidang = '".$kd_bdg."' AND P1.Kd_Unit = '".$kd_unt."' AND P1.Kd_Sub LIKE '".$kd_sub."' AND P1.Kd_UPB LIKE '".$kd_upb."'  
AND P1.Kd_Hapus=$gHpS 
AND P1.Kd_Data=$gDtA $MsL 
ORDER BY P1.IDPemda
OFFSET (($PageNumber - 1) * $RowspPage) ROWS
FETCH NEXT $RowspPage ROWS ONLY";

$rst = sqlsrv_query($conn,$nSQ);
while($mRo = sqlsrv_fetch_array($rst))
{
	$Upb= $gUnL.".".substr('0'.$mRo[5],-2,2).".".substr('00'.$mRo[6],-3,3);
	$Rek= $mRo[7].".".$mRo[8].".".$mRo[9].".".substr('0'.$mRo[10],-2,2).".".substr('0'.$mRo[11],-2,2).".".substr('0'.$mRo[12],-2,2).".".substr('00'.$mRo[13],-3,3);
	
	$gIDT = $mRo[0];
	
	$gUpb    = $Upb;
	$gRin17  = "";
	$gRin108 = $Rek;
	
	$gNmB  = $mRo[52];
	$ReGA  = substr('0000000'.$mRo[15],-7,7);
	
	$gMrk  = $mRo[18];
	$gTyp  = $mRo[19];
	$gUCC  = $mRo[20];
	$gBHN  = $mRo[21];
	$gPBR  = $mRo[23];
	$gRKA  = $mRo[24];
	$gMSN  = $mRo[25];
	$gPLS  = $mRo[26];
	$gBPK  = $mRo[27];
	
	$gKTR  = $mRo[33];
	$gSP2  = $mRo[35];
	$gTgl  = date_format($mRo[22],"Y-m-d");
	$gTgp  = date_format($mRo[37],"Y-m-d");
	
	$gTglM = "0000-00-00";
	$gMLK  = "12";
	$gAUS  = $mRo[28];
	$gHRG  = $mRo[30];
	
	imprtKib($gUpb,$gRin17,$gRin108,$gNmB,$ReGA,$gMrk,$gTyp,$gUCC,$gBHN,$gPBR,$gRKA,$gMSN,$gPLS,$gBPK,$gTglV,$gNom,$gGna,$gKTR,$gTgl,$gTgp,$gTglM,$gMLK,$gAUS,$gHRG,$gSP2,$gIDT,$iG);
	$iG++;
}

function imprtKib($gUpb,$gRin17,$gRin108,$gNmB,$ReGA,$gMrk,$gTyp,$gUCC,$gBHN,$gPBR,$gRKA,$gMSN,$gPLS,$gBPK,$gTglV,$gNom,$gGna,$gKTR,$gTgl,$gTgp,$gTglM,$gMLK,$gAUS,$gHRG,$gSP2,$gIDT,$iG)
{
	$CekK = fGlobal("IDT","ta_kib_108","IdTabelMaster",$gIDT,"=","","");
	if ($CekK=='')
	{
		$NewK = fGlobal("count_referensi","ta_kib_108_count_referensi","ref_crit","ALT","=","","");
		if ($NewK==0)
		{
			$NewK = fGlobal("IfNull(max(referensi),0)","ta_kib_108","referensi","ALT%","LIKE","","");
			$NewB = fGlobal("IfNull(max(referensi),0)","ta_kib_108_mutasi","referensi","ALT%","LIKE","","");
			$NewC = fGlobal("IfNull(max(referensi),0)","ta_kib_108_merger_his","referensi","ALT%","LIKE","","");
		
			$NewK = (int)substr($NewK,-11,11);
			$NewB = (int)substr($NewB,-11,11);
			$NewC = (int)substr($NewC,-11,11);
			if ($NewB > $NewK){$NewK = $NewB;}
			if ($NewC > $NewK){$NewK = $NewC;}
		}
		
		$NewK = $NewK + 1;

		$SQ="UPDATE ta_kib_108_count_referensi SET count_referensi='".$NewK."' WHERE ref_crit='ALT'";
		mysql_query($SQ);
		
		$NewRefKIB  = "ALT.".fMakeReferensi($NewK,11);
		$NewRefGrp  = "";
		
		$SQL = "INSERT INTO ta_kib_108 SET 
		Referensi='$NewRefKIB',
		Ref_Group='$NewRefGrp',
		Kd_UPB='$gUpb',
		Kd_Aset='$gRin17',
		Kd_Aset_108='$gRin108',
		Nm_Aset='".mysql_real_escape_string($gNmB)."',
		No_Register='$ReGA',
		Merk='".mysql_real_escape_string($gMrk)."',
		Type='".mysql_real_escape_string($gTyp)."',
		Ukuran_CC='".mysql_real_escape_string($gUCC)."',
		Bahan='$gBHN',
		Nomor_Pabrik='$gPBR',
		Nomor_Rangka='$gRKA',
		Nomor_Mesin='$gMSN',			
		Nomor_Polisi='$gPLS',
		Nomor_BPKB='$gBPK',
		No_SP2D='$gSP2',
		Penggunaan='".mysql_real_escape_string($gGna)."',
		Keterangan='".mysql_real_escape_string($gKTR)."',
		Tgl_Perolehan='$gTgl',
		Tgl_Pembukuan='$gTgp',
		Tgl_Mutasi='$gTglM',
		Kd_Pemilik='$gMLK',
		Asal_Usul='$gAUS',
		Harga='$gHRG',
		Post='Y',
		IdTabelMaster='".$gIDT."',
		Recorded=now(),
		Pencatat='$gPCT'";
		mysql_query($SQL);
		
		$SW = "INSERT INTO ta_kib_post_108 SET 
		Referensi='".$NewRefKIB."',
		Ref_Group='".$NewRefGrp."',
		Kd_UPB='".$gUpb."',
		Kd_Aset='".$gRin17."',
		Kd_Aset_108='".$gRin108."',
		No_Register='".$ReGA."',
		Crit='SLD',
		Tanggal='".$gTgl."',
		Tgl_Mutasi='".$gTglM."',
		Uraian='Perolehan Awal',
		DK='D',
		Debet='".$gHRG."',
		Kredit='0',
		Keterangan='',
		
		IdTabelHarga='-',
		
		Recorded=now(),
		Pencatat='$gPCT'";
		mysql_query($SW);
	}
}
?>
<script languange="javascript">
//$("#fUPB").focus();
B39.click();
</script>