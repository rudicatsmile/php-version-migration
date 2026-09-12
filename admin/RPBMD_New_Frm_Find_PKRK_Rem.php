<?php
require('Connection.php');
extract($_GET);

if ($rIdT){
	$nSQ = "DELETE FROM ta_rpbmd_new_aset WHERE IDT='$rIdT'";
	$nRs = mysql_query($nSQ);
}
?>
<script languange="javascript">
	RefreshDATA('<?=$stLOCK?>','<?=$IdL?>');
</script>