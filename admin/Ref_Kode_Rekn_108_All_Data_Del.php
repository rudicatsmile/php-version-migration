<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$nSQ = "DELETE FROM ref_rek_aset108_".($Lev+1)." WHERE IDT='".$IdT."'";
$nRs = mysql_query($nSQ);

?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>');
</script>

