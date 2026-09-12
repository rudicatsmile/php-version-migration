<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
if ($crt=='0' || $crt=='0all'){
	$ert = "Belum";
}
if ($crt=='1' || $crt=='1all'){
	$ert = "Disetujui";
}
if ($crt=='2' || $crt=='2all'){
	$ert = "Ditolak";
}

$prev='N';
if ($tID){
	$nSQ = "UPDATE ta_permohonan_repla_rek_aset_rinci SET Status='$ert', Pencatat='$UID', Recorded=now() WHERE IDT='$tID'";
	$nRs = mysql_query($nSQ);
}
else{
	$tRF  = fGlobal("Referensi","ta_permohonan_repla_rek_aset","IDT",$IdT,"=","","");
	if ($tRF){
		$nSQ = "UPDATE ta_permohonan_repla_rek_aset_rinci SET Status='$ert', Pencatat='$UID', Recorded=now() 
		WHERE Referensi='$tRF' AND CheckList='Y' AND Kd_Rekening_108<>''";
		$nRs = mysql_query($nSQ);
		$prev='Y';
	}
}
?>
<script languange="javascript">
	<? if ($prev=='Y'){?>
	showFORM('refr','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>');
	<? } ?>
</script>
