<?
require('Connection.php');
extract($_GET);
if ($gID)
{
	$nSQ="DELETE FROM ref_usulan_jenis_rinci WHERE IDT='$gID'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
}
?>

<script languange="javascript">
	RefreshDATA('<?=$IdL?>');
</script>