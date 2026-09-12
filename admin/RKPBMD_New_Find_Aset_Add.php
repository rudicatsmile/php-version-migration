<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$rDTA = explode(':',$rDTA);
$rIdT = $rDTA[0];
$rTbL = $rDTA[1];

$nSQ = "UPDATE ta_kib_".$rTbL." SET Kd_Ruang='$gRUA' WHERE IDT = '$rIdT'";
$nRs = mysql_query($nSQ);
?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>');
</script>
