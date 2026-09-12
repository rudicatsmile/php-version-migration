<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

if ($CrT=='Img'){$TbL="tb_lembar_kerja_foto_denah";}
else {$TbL="tb_lembar_kerja_dokumen";}

$SQ = "DELETE FROM $TbL WHERE IDT='".$rIdT."'";
$rs = mysql_query($SQ);
?>
<script languange="javascript">
NewAset('refr','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>');
</script>