<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
require('Penghapusan_Usulan_Exec_Frm_Save_PH_All.php');

extract($_GET);

$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (P1.Ref_Aset LIKE '%$FnD%' OR P1.Nm_Aset LIKE '%$FnD%' OR P1.Kd_Aset LIKE '%$FnD%' OR P1.No_Register LIKE '%$FnD%')";
}

$SQE = "SELECT 
P1.IDT AS A0,
P1.referensi AS A1,
P1.kd_aset AS A2,
P1.ref_aset AS A3,
P1.ref_usulan AS A4,
P1.to_upb AS A5,
P1.kib_to AS A6,
P1.to_kd_aset AS A7,
P1.mutasi_tanggal AS A8,
P1.kd_upb AS A9,
P2.Jenis AS A10,
P1.Eksekusi AS A11,
P1.Verifikasi AS A12,
P1.No_Register AS A13 
FROM ta_usulan_verifikasi_rinci_108 P1 
LEFT JOIN ta_usulan_verifikasi_108 P2 ON P2.Referensi=P1.Referensi 
WHERE P1.Ref_Usulan='$RefU' $CrT ORDER BY P1.IDT LIMIT $PgE,500";

$RsE = mysql_query($SQE);
while ($nRo = mysql_fetch_array($RsE, MYSQL_BOTH))
{
	$tID = $nRo[0];
	$RfA = $nRo[3];
	$RfU = $nRo[4];
	$frUPB  = substr($nRo[9],0,11);
	$NoRG   = $nRo[13];
	
	if ($eMA=='Execute' && $nRo[11]=="Belum" && $nRo[12]=='Disetujui')
	{
		ExecutePH_All($NoRG,$frUPB,$RfA,$RfU,$tID,$UID);
	}
	else if ($eMA=='UnExecute' && $nRo[11]=="Sudah" && $nRo[12]=='Disetujui')
	{
		UnExecutePH_All($NoRG,$frUPB,$RfA,$RfU,$tID,$UID);
	}
	
}
?>
<script languange="javascript">
	showEXEC_RefR('','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>');
</script>