<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
#require('Invent_Usulan_Exec_Frm_Save_RB_All.php');
#require('Invent_Usulan_Exec_Frm_Save_PH_All.php');
require('Invent_Usulan_Exec_Frm_Save_MS_All.php');
extract($_GET);

$CrT="";
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
P1.Verifikasi AS A12 
FROM ta_usulan_verifikasi_rinci_108 P1 
LEFT JOIN ta_usulan_verifikasi_108 P2 ON P2.Referensi=P1.Referensi 
WHERE P1.Ref_Usulan='$RefU' $CrT ORDER BY P1.IDT LIMIT $PgE,500";
$RsE = mysql_query($SQE);
while ($nRo = mysql_fetch_array($RsE, MYSQL_BOTH))
{
	$tID = $nRo[0];
	$RfV = $nRo[1];
	$RfA = $nRo[3];
	$RfU = $nRo[4];
	
	$TbK = fNmHuruf((int)substr($nRo[2],0,2));
	$UpB = $nRo[5];
	
	$NewUpB = $UpB;
	$ToKiB  = $nRo[6];
	$ToAsT  = $nRo[7];
	$TglMts = $nRo[8];
	$frUPB  = substr($nRo[9],0,11);
	
	$UdTRCI = 'NO';
	$gJN = $nRo[10];
	if (($gJN=="RB" || $gJN=="PH" || $gJN=="MS") && $nRo[11]=="Belum" && $nRo[12]=='Disetujui')
	{
		if ($gJN=="RB"){
			#ExecuteRB_All($frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
		if ($gJN=="PH"){
			#ExecutePH_All($frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
		if ($gJN=="MS"){
			ExecuteMS_All($frUPB,$RfA,$RfU,$TbK,$tID,$UID);
		}
	}
}
?>
<script languange="javascript">
	//alert('proses berhasil, klik pagging untuk melihat hasilnya..');
	showEXEC_RefR('','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>');
</script>