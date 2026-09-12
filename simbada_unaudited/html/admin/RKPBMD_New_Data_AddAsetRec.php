<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

$gRf  = str_replace('**',' ',$gRf);

$gKd = "";
$gNm = "";
$gNI = 0;

if ($gRf){
	$tBL = CekRefToNmTbl($gRf);
	$DT  = fGlobal("Kd_Aset:Nm_Aset:Harga","ta_kib_".$tBL,"Referensi:Kd_Upb",$gRf.":".substr($gUPB,0,11)."%","=:LIKE","","");
	$DT = explode(":",$DT);
	$gKd = $DT[0];
	$gNm = $DT[1];
	$gNI = $DT[2];
}

#$gRef = fGlobal("Referensi","ta_rkpbmd","Kd_Upb:Kd_Kegiatan:Tahun",$gUPB.":".$gKEG.":".$gTHN,"=:=:=","","");
#if ($gRef=='')
#{
	$nSQL = "SELECT IFNULL(max(Referensi),0) AS LasRef FROM ta_rkpbmd WHERE Kd_Upb='".$gUPB."' AND Tahun='".$gTHN."'";
	$nRst = mysql_query($nSQL) or die(mysql_error());
	$nRow = mysql_fetch_assoc($nRst);
	$LastRe = $nRow['LasRef'];
	$NewRef  = ((int)substr($LastRe,24,3)) + 1;
	$NewRef  = $gUPB.".".$gTHN.".".fMakeReferensi($NewRef,3);
	
	$SQL = "INSERT INTO ta_rkpbmd SET 
	Referensi='$NewRef',
	Kd_Upb='$gUPB',
	Kd_Kegiatan='$gKEG',
	Tahun='$gTHN',
	Ref_Kib='$gRf',
	Kd_Aset='$gKd',
	Nm_Aset='$gNm',
	Deskripsi='-',
	Nilai='$gNI',
	Pencatat='$UID', Recorded=now()";
	$rst = mysql_query($SQL);
	
	$SQL = "INSERT INTO ta_rkpbmd_rinci SET 
	Referensi='$NewRef'";
	#$rst = mysql_query($SQL);
#}
#else{
#	$SQL = "INSERT INTO ta_rkpbmd SET 
#	Referensi='$gRef',
#	Kd_Upb='$gUPB',
#	Kd_Kegiatan='$gKEG',
#	Tahun='$gTHN',
#	Ref_Kib='$gRf',
#	Kd_Aset='$gKd',
#	Nm_Aset='$gNm',
#	Deskripsi='-',
#	Nilai='$gNI',
#	Pencatat='$UID', Recorded=now()";
#	$rst = mysql_query($SQL);
#}

/*
$nSQ = "INSERT INTO ta_rkbmd SET 
Kd_Upb='$gUPB',
Kd_Kegiatan='$gKEG',
Tahun='$gTHN',
Kd_Aset='$gKd',
Nm_Aset='$gNm',
Deskripsi='',
Merk_Type='',
Ukuran='',
Qty='0',
Satuan='',
Harga='0',
Jumlah='0',
Pencatat='$UID', Recorded=now()";
$nRs = mysql_query($nSQ);
*/

$MsG="Penambahan item aset berhasi..!!";
?>
<script languange="javascript">
	P_Next('<?=$MsG?>','<?=$IdL?>');
</script>