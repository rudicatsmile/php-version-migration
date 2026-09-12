<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$nSQ = "DELETE FROM ta_sp3d_spj_rinci_file WHERE IDT='$rIdT'";
$nRs = mysql_query($nSQ);

?>
<script type="text/javascript">
	//showREF('<?=$CrT?>','<?=$gIdT?>','<?=$IdL?>');
	showUPLOAD('refr','<?=$eIdT?>','','<?=$IdL?>');
</script>
