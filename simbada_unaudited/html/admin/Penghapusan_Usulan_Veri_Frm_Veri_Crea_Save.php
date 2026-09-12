<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$mHri = substr("0".$mHri,-2,2);
$mBln = substr("0".$mBln,-2,2);
$rTG = $mThn."-".$mBln."-".$mHri;

if ($ProT=='A') {$ProT="Belum";}
if ($ProT=='B') {$ProT="CekFisik";}
if ($ProT=='C') {$ProT="Verifikasi";}
if ($ProT=='D') {$ProT="Ditolak";}
if ($ProT=='E') {$ProT="Disetujui";}

$nSQ = "SELECT IDT FROM ta_usulan_verifikasi_rinci_108 WHERE referensi='".$Ref."' ORDER BY ref_usulan, ref_aset";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	
	$tID = $mRo[0];
	$SQ = "UPDATE ta_usulan_verifikasi_rinci_108 SET mutasi_tanggal='$rTG', verifikasi='".$ProT."' WHERE IDT='$tID'";
	$Rs = mysql_query($SQ);
}
?>
<script languange="javascript">
	//editFORM('refr','','<?=$tID?>','<?=$IdL?>');
	alert('Proses berhasil..!!');
	closeCLICK('exce','<?=$IdL?>');
</script>