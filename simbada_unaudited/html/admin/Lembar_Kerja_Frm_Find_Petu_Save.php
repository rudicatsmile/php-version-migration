<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$SQ = "UPDATE tb_lembar_kerja SET $fld='".$gKd."' WHERE IDT='".$SnsIDT."'";
$rs = mysql_query($SQ);
?>
<script languange="javascript">
showLKI('refr','<?=$AsT?>','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>');
</script>