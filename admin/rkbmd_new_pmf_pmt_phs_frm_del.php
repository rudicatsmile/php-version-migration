<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$nSQ = "DELETE FROM ta_rkbmd_new_pmf_pmt_phs_rinci WHERE IDT='$rIdT'";
$nRs = mysql_query($nSQ);

?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>','<?=$PgE?>');
</script>
