<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$nSQ = "DELETE FROM ta_usulan_rinci_file_108 WHERE IDT='$rIdT'";
$nRs = mysql_query($nSQ);

?>
<script type="text/javascript">
	showREF('<?=$CrT?>','<?=$gIdT?>','<?=$IdL?>');
</script>
