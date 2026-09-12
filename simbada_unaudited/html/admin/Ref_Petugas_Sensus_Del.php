<?
require('Connection.php');
extract($_GET);
if ($gID)
{
	$nSQ="DELETE FROM tb_lembar_kerja_petugas WHERE IDT='$gID'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
}
?>

<script languange="javascript">
	RefreshDATA('<?=$IdL?>');
</script>