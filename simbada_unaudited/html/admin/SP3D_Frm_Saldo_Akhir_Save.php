<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

if ($IdT!=='')
{
	$nSQ = "SELECT Kd_UPB, KdSesi, KdJenis, Tahun 
	FROM ta_sp3d WHERE IDT='".$IdT."'";
	$nRs = mysql_query($nSQ);
	$mRo = mysql_fetch_array($nRs);
	$KdU = $mRo[0];
	$KdS = $mRo[1];
	$KdJ = $mRo[2];
	$ThN = $mRo[3];
	$fBan = fConvertToNumeric($fBan);
	$fBen = fConvertToNumeric($fBen);
	
	$rIDT = fGlobal("IDT","ta_sp3d_saldo_akhir","Kd_UPB:KdJenis:KdTahap:Tahun",$KdU.":".$KdJ.":".$KdS.":".$ThN,"=:=:=:=","","");
	
	$nSQ = "UPDATE ta_sp3d_saldo_akhir SET KasBank='".$fBan."', KasBendahara='".$fBen."' WHERE IDT='".$rIDT."'";
	$nRs = mysql_query($nSQ);
}
?>
<script type="text/javascript">
	editSALDO('refr','<?=$IdT?>','<?=$IdL?>');
</script>

