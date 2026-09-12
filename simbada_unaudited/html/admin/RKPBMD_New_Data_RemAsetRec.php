<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
$nSQ = "DELETE FROM ta_rkpbmd WHERE IDO='$mID'";
$nRs = mysql_query($nSQ);
$MsG="Remove item berhasi..!!";
?>
<script languange="javascript">
	P_Next('<?=$MsG?>','<?=$IdL?>');
</script>