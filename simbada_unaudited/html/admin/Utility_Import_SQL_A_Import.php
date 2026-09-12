<?
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
	
$nSQ = "SELECT P1.IDPemda as A0
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

,P1.Kd_Pemilik as A16
,P1.Tgl_Perolehan as A17
,P1.Luas_M2 as A18
,P1.Alamat as A19
,P1.Hak_Tanah as A20
,P1.Sertifikat_Tanggal as A21
,P1.Sertifikat_Nomor as A22
,P1.Penggunaan as A23
,P1.Asal_usul as A24
,P1.Harga as A25
,P1.Keterangan as A26
,P1.Tahun as A27
,P1.No_SP2D as A28
,P1.No_ID as A29
,P1.Tgl_Pembukuan as A30
,P1.Kd_Kecamatan as A31
,P1.Kd_Desa as A32
,P1.Invent as A33
,P1.No_SKGuna as A34
,P1.Kd_Penyusutan as A35
,P1.Kd_Data as A36
,P1.Log_User as A37
,P1.Log_entry as A38
,P1.Kd_Masalah as A39
,P1.Ket_Masalah as A40
,P1.Kd_KA as A41
,P1.No_SIPPT as A42
,P1.Dev_Id as A43
,P1.Kd_Hapus as A44
,P1.IDData as A45 
,P2.Nm_Aset5 as A46 
FROM ta_kib_a P1 
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
AND P1.Kd_Data=$gDtA 
ORDER BY P1.IDPemda
OFFSET (($PageNumber - 1) * $RowspPage) ROWS
FETCH NEXT $RowspPage ROWS ONLY";
$rst = sqlsrv_query($conn,$nSQ);
while($mRo = sqlsrv_fetch_array($rst))
{
	$Upb= $gUnL.".".substr('0'.$mRo[5],-2,2).".".substr('00'.$mRo[6],-3,3);
	$Rek= $mRo[7].".".$mRo[8].".".$mRo[9].".".substr('0'.$mRo[10],-2,2).".".substr('0'.$mRo[11],-2,2).".".substr('0'.$mRo[12],-2,2).".".substr('00'.$mRo[13],-3,3);
	
	$SQb = "SELECT harga FROM ta_fn_kib_a WHERE IDPemda='".$mRo[0]."' AND Tahun='2025'";
	$rsb = sqlsrv_query($conn,$SQb);
	$mRb = sqlsrv_fetch_array($rsb);
	
	$gIDT = $mRo[0];
	
	$gUpb    = $Upb;
	$gRin17  = "";
	$gRin108 = $Rek;
	
	$gNmB  = $mRo[46];
	$ReGA  = substr('0000000'.$mRo[15],-7,7);
	
	$gLua  = $mRo[18];
	$gAlm  = $mRo[19];
	$gHak  = $mRo[20];
	
	$gTglV = "";
	$gSerT = "Tidak Ada";
	if (!is_null($mRo[21]))
	{
		$gTglV = date_format($mRo[21],"Y-m-d");
		$gSerT = "Ada";
	}
	
	$gNomV = $mRo[22];
	
	$gGna  = $mRo[23];
	$gKTR  = $mRo[26];
	$gSP2  = $mRo[28];
	$gTgl  = date_format($mRo[17],"Y-m-d");
	$gTgp  = date_format($mRo[30],"Y-m-d");
	
	$gTglM = "0000-00-00";
	$gMLK  = "12";
	$gAUS  = $mRo[24];
	$gHRG  = $mRo[25];
	$gHRP  = $mRb[0];
	
	imprtKib($gUpb,$gRin17,$gRin108,$gNmB,$ReGA,$gLua,$gAlm,$gHak,$gSerT,$gTglV,$gNomV,$gGna,$gKTR,$gTgl,$gTgp,$gTglM,$gMLK,$gAUS,$gHRG,$gHRP,$gSP2,$gIDT,$iG);
	$iG++;
}

function imprtKib($gUpb,$gRin17,$gRin108,$gNmB,$ReGA,$gLua,$gAlm,$gHak,$gSerT,$gTglV,$gNomV,$gGna,$gKTR,$gTgl,$gTgp,$gTglM,$gMLK,$gAUS,$gHRG,$gHRP,$gSP2,$gIDT,$iG)
{
	$CekK = fGlobal("IDT","ta_kib_108","IdTabelMaster",$gIDT,"=","","");
	if ($CekK=='')
	{
		$NewK = fGlobal("count_referensi","ta_kib_108_count_referensi","ref_crit","TNH","=","","");
		if ($NewK==0)
		{
			$NewK = fGlobal("IfNull(max(referensi),0)","ta_kib_108","referensi","TNH%","LIKE","","");
			$NewB = fGlobal("IfNull(max(referensi),0)","ta_kib_108_mutasi","referensi","TNH%","LIKE","","");
			$NewC = fGlobal("IfNull(max(referensi),0)","ta_kib_108_merger_his","referensi","TNH%","LIKE","","");
		
			$NewK = (int)substr($NewK,-11,11);
			$NewB = (int)substr($NewB,-11,11);
			$NewC = (int)substr($NewC,-11,11);
			if ($NewB > $NewK){$NewK = $NewB;}
			if ($NewC > $NewK){$NewK = $NewC;}
		}
		
		$NewK = $NewK + 1;

		$SQ="UPDATE ta_kib_108_count_referensi SET count_referensi='".$NewK."' WHERE ref_crit='TNH'";
		mysql_query($SQ);
		
		$NewRefKIB  = "TNH.".fMakeReferensi($NewK,11);
		$NewRefGrp  = "";
		
		$SQL = "INSERT INTO ta_kib_108 SET 
		Referensi='$NewRefKIB',
		Ref_Group='$NewRefGrp',
		Kd_UPB='$gUpb',
		Kd_Aset='$gRin17',
		Kd_Aset_108='$gRin108',
		Nm_Aset='".mysql_real_escape_string($gNmB)."',
		No_Register='$ReGA',
		
		Luas_M2='$gLua',
		Alamat='".mysql_real_escape_string($gAlm)."',
		Hak_Tanah='".mysql_real_escape_string($gHak)."',
		
		Sertifikat='".$gSerT."',
		Sertifikat_Tanggal='".$gTglV."',
		Sertifikat_Nomor='".$gNomV."',
		
		No_SP2D='".$gSP2."',
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
		
		if ($gHRP==0){$gHRP=$gHRG;}
		
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
		Debet='".$gHRP."',
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