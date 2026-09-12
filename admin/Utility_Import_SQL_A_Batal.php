<?php
require('Connection.php');
require('FileFunction.php');
require('Connection_SQL.php');
extract($_GET);

$gUnL=$gUnT;
if ($gUnT=='25.08.13.03') 		#BADAN PENGELOLA PAJAK DAN RETRIBUSI DAERAH baru
{
	$gUnT='25.08.13.01';		#BADAN PENGELOLA PAJAK DAN RETRIBUSI lama
}
else if ($gUnT=='25.08.13.01') 	#BADAN PENGELOLAAN KEUANGAN DAN PENDAPATAN DAERAH baru
{
	$gUnT='25.08.04.04';		#BADAN PENGELOLAAN KEUANGAN DAN PENDAPATAN DAERAH lama
}
else if ($gUnT=='25.08.13.04') 	#PENGELOLA BARANG baru
{
	$gUnT='25.08.04.05';		#PENGELOLA BARANG lama
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
FROM ta_kib_a P1 
WHERE P1.Kd_Prov='".$kd_prv."' AND P1.Kd_Kab_Kota = '".$kd_kab."' AND P1.Kd_Bidang = '".$kd_bdg."' AND P1.Kd_Unit = '".$kd_unt."' AND P1.Kd_Sub LIKE '".$kd_sub."' AND P1.Kd_UPB LIKE '".$kd_upb."'  
AND P1.Kd_Hapus=$gHpS 
AND P1.Kd_Data=$gDtA 
ORDER BY P1.IDPemda
OFFSET (($PageNumber - 1) * $RowspPage) ROWS
FETCH NEXT $RowspPage ROWS ONLY";
$rst = sqlsrv_query($conn,$nSQ);
while($mRo = sqlsrv_fetch_array($rst))
{
	$gIDT = $mRo[0];
	imprtKib($gIDT,$conn);
	$iG++;
}

function imprtKib($gIDT,$conn)
{
	$SQ="DELETE FROM ta_kib_108 WHERE IdTabelMaster='".$gIDT."'";
	mysql_query($SQ);
	
	$SQ="DELETE FROM ta_kib_post_108 WHERE IdTabelMaster='".$gIDT."'";
	mysql_query($SQ);
}
?>
<script languange="javascript">
B39.click();
</script>