<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$nSQ = "DELETE FROM ref_rek_90_$Lev WHERE IDT='".$IdT."'";
$nRs = mysql_query($nSQ);

?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>');
</script>

