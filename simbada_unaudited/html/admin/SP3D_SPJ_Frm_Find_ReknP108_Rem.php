<?
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);
$sRef = fGlobal("Referensi","ta_sp3d_spj","IDT",$rIdT,"=","","");

$nSQ = "DELETE FROM ta_sp3d_spj_rinci WHERE Referensi_SPJ='".$sRef."'"; 
$nRs = mysql_query($nSQ);

$nSQ = "DELETE FROM ta_sp3d_spj WHERE IDT='".$rIdT."'"; 
$nRs = mysql_query($nSQ);

?>
<script type="text/javascript">
	//RefreshDATA('<?=$IdL?>','0');
	PilihDATA('<?=$fIdT?>','0','<?=$IdL?>');
</script>
