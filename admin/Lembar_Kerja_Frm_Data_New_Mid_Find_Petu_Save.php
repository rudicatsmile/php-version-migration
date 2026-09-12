<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$SQ = "UPDATE tb_lembar_kerja_belum_tercatat SET $fld='".$gKd."' WHERE IDT='".$IdT."'";
$rs = mysql_query($SQ);
?>
<script languange="javascript">
NewAset('refr','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>');
</script>