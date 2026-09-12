<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$nSQ = "DELETE FROM ta_sp3d_spj_rinci WHERE IDT='".$IdTR."'";
$nRs = mysql_query($nSQ);
?>
<script type="text/javascript">
	showASET('refr','<?=$rIdT?>','','<?=$IdL?>');
</script>

