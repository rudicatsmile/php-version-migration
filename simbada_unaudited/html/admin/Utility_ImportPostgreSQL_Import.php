<?
require('Connection.php');
require('FileFunction.php');
require('Connection_PostgreSQL.php');
extract($_GET);

$IdPostG = fGlobal("IdPostgreSQL","ref_upb","Kd_UPB",$gUpB,"=","","");

$x  = array();
$iG = 1;

$nSQ = "SELECT P1.id as A0, 
P1.nama_barang as A1, 
P1.letak_alamat as A2, 
P1.penggunaan as A3, 
P1.keterangan as A4, 
P2.kode_barang as A5,
P3.kode_barang_108 as A6,
P1.tahun as A7, 
P1.tanggal_sertifikat as A8, 
P1.nomor_sertifikat as A9, 
P4.hak_tanah as A10 
FROM tanah P1 
LEFT JOIN kode_barang P2 ON P2.id=P1.id_kode_barang 
LEFT JOIN kode_barang_108 P3 ON P3.id=P1.id_kode_barang_108 
LEFT JOIN hak_tanah P4 ON P4.id=P1.id_hak_tanah 
WHERE id_sub_skpd='".$IdPostG."' 
ORDER BY P1.tahun";
$nRs = pg_prepare($PgConn, "MyQuery", $nSQ);
$nRs = pg_execute($PgConn, "MyQuery", array());
while ($mRo = pg_fetch_array($nRs))
{
	$gIDT = $mRo[0];
	
	$Rek17   = substr($mRo[5],0,14);
	$Rek1108 = substr($mRo[6],0,18);
	
	$gUpb    = $gUpB;
	$gRin17  = $Rek17;
	$gRin108 = $Rek1108;
	$gNmB  = $mRo[1];
	$gLua  = 0;
	$gAlm  = $mRo[2];
	$gTglV = $mRo[8];
	if ($gTglV==''){$gTglV="0000-00-00";}
	$gNom  = $mRo[9];
	
	$gSer="Tidak Ada";
	if ($gNom!==''){$gSer="Ada";}
	
	$gHak  = $mRo[10];
	$gGna  = $mRo[3];
	$gKTR  = $mRo[4];
	$gTgl  = $mRo[7]."-12-31";
	$gTglM = "0000-00-00";
	$gMLK  = "12";
	$gAUS  = "APBD";
	$gHRG  = 0;
	
	imprtKib($gUpb,$gRin17,$gRin108,$gNmB,$gLua,$gAlm,$gHak,$gTglV,$gNom,$gGna,$gKTR,$gTgl,$gTglM,$gMLK,$gAUS,$gHRG,$gSer,$gIDT,$iG,$PgConn);
	$iG++;
}


function imprtKib($gUpb,$gRin17,$gRin108,$gNmB,$gLua,$gAlm,$gHak,$gTglV,$gNom,$gGna,$gKTR,$gTgl,$gTglM,$gMLK,$gAUS,$gHRG,$gSer,$gIDT,$iG,$PgConn)
{
	$CekK = fGlobal("IDT","ta_kib_108","IdTabelMaster","tnh-".$gIDT,"=","","");
	if ($CekK=='')
	{
		$NewK = fGlobal("IfNull(max(referensi),0)","ta_kib_108","referensi","TNH%","LIKE","","");
		$NewB = fGlobal("IfNull(max(referensi),0)","ta_kib_108_mutasi","referensi","TNH%","LIKE","","");
		$NewC = fGlobal("IfNull(max(referensi),0)","ta_kib_108_merger_his","referensi","TNH%","LIKE","","");
		
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
		$NewK = $NewK + 1;
		
		$NewRefKIB  = "TNH.".fMakeReferensi($NewK,11);
		$NewReGAset = substr($NewRefKIB,-7,7);
		$NewRefGrp  = "";
		
		$SQL = "INSERT INTO ta_kib_108 SET 
		Referensi='$NewRefKIB',
		Ref_Group='$NewRefGrp',
		Kd_UPB='$gUpb',
		Kd_Aset='$gRin17',
		Kd_Aset_108='$gRin108',
		Nm_Aset='".mysql_real_escape_string($gNmB)."',
		No_Register='$NewReGAset',
		Luas_M2='$gLua',
		Alamat='".mysql_real_escape_string($gAlm)."',
		Sertifikat_Tanggal='$gTglV',
		Sertifikat_Nomor='$gNom',
		Penggunaan='".mysql_real_escape_string($gGna)."',
		Keterangan='".mysql_real_escape_string($gKTR)."',
		Tgl_Perolehan='$gTgl',
		Tgl_Mutasi='$gTglM',
		Kd_Pemilik='$gMLK',
		Asal_Usul='$gAUS',
		Hak_Tanah='$gHak',
		Sertifikat='$gSer',
		Harga='$gHRG',
		Post='Y',
		IdTabelMaster='tnh-".$gIDT."',
		Recorded=now(),
		Pencatat='$gPCT'";
		$rst = mysql_query($SQL) or die(mysql_error());
		echo $iG.". ".$SQL."<br><br>";
		
		importPost($NewRefKIB,$NewRefGrp,$NewReGAset,$gTgl,$gTglM,$gUpb,$gRin17,$gRin108,$gIDT,$gPCT,$PgConn);
	}
}

function importPost($NewRefKIB,$NewRefGrp,$NewReGAset,$gTgl,$gTglM,$gUpb,$gRin17,$gRin108,$gIDT,$gPCT,$PgConn)
{
	$i=1;
	$SQ = "SELECT * FROM harga_tanah 
	WHERE id_tanah='".$gIDT."' ORDER BY id, tahun";
	$nR = pg_prepare($PgConn,"MyQuer".$gIDT, $SQ);
	$nR = pg_execute($PgConn,"MyQuer".$gIDT, array());
	while ($mR = pg_fetch_array($nR))
	{
		$gID = $mR['id'];
		$dt  = "SLD";
		$dk  = "D";
		$TmB = "TIDAK";
		
		if ($i>1){$dt="INV"; $TmB = "YA";}
		if ($mR['harga_berkurang']>0){$dk="K";}
		
		$SW = "INSERT INTO ta_kib_post_108 SET 
		Referensi='".$NewRefKIB."',
		Ref_Group='".$NewRefGrp."',
		Kd_UPB='".$gUpb."',
		Kd_Aset='".$gRin17."',
		Kd_Aset_108='".$gRin108."',
		No_Register='".$NewReGAset."',
		Crit='".$dt."',
		Tanggal='".$gTgl."',
		Tgl_Mutasi='".$gTglM."',
		Uraian='".$mR['catatan']."',
		DK='".$dk."',
		Debet='".$mR['harga_bertambah']."',
		Kredit='".$mR['harga_berkurang']."',
		Keterangan='',
		Tmbh_Ms_Manfaat='".$TmB."',
		
		IdTabelHarga='tnh-".$gID."',
		
		IdAsalUsul='".$mR['id_asal_usul']."',
		IdKontrak='".$mR['id_kontrak']."',
		IdBaSertaTerima='".$mR['id_ba_serah_terima']."',
		
		Recorded=now(),
		Pencatat='$gPCT'";
		$rw = mysql_query($SW) or die(mysql_error());
		
		if ($i==1)
		{
			$SW = "UPDATE ta_kib_108 SET Harga='".$mR['harga_bertambah']."' WHERE IdTabelMaster='tnh-".$gIDT."'";
			$rw = mysql_query($SW) or die(mysql_error());
		}
		$i++;
	}
}
?>
<script languange="javascript">
$("#fUPB").focus();
</script>