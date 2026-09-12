<?
require('Connection.php');
extract($_GET);
if ($IdT)
{
	$nSQ="DELETE FROM ref_sumber_dana WHERE IDT='$IdT'";
	mysql_query($nSQ);
}
?>

<script languange="javascript">
	RefreshDATA('<?=$IdL?>');
</script>