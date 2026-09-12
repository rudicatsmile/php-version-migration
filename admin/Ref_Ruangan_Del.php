<?php
require('Connection.php');
extract($_GET);
if ($gID)
{
	$nSQ="DELETE FROM ref_ruangan WHERE IDT='$gID'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
}
?>

<script languange="javascript">
	RefreshDATA('<?=$IdL?>');
</script>