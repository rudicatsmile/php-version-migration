<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$nSQ = "DELETE FROM ta_rkpbmd_rinci WHERE IDO='$rID'";
echo $nSQ;
$nRs = mysql_query($nSQ);
//$MsG="Remove item berhasi..!!";

?>
<script languange="javascript">
	P_EditItemAset('refr','<?=$mID?>','','<?=$IdL?>')
</script>