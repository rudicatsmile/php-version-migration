<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$nSQ = "DELETE FROM ref_keg_90_$Lev WHERE IDT='".$IdT."'";
$nRs = mysql_query($nSQ);

?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>');
</script>

