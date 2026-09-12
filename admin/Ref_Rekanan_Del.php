<?php
require('Connection.php');
extract($_GET);
if ($IdT)
{
	$nSQ="DELETE FROM ta_rekanan WHERE IDT='$IdT'";
	mysql_query($nSQ);
}
?>

<script languange="javascript">
	RefreshDATA('<?=$IdL?>');
</script>