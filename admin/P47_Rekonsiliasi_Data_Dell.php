<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
if ($IdT)
{
	$nSQ = "DELETE FROM tb_rekonsiliasi WHERE IDT='$IdT'";
	$nRs = mysql_query($nSQ);
}
?>
<script languange="javascript">
	RefreshDATA('<?=$FrmG?>','<?=$IdL?>');
</script>