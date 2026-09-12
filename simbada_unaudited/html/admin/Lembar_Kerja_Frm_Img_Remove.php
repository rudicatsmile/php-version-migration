<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

if ($CrT=='Img')
{
	$SQ = "DELETE FROM tb_lembar_kerja_foto_denah WHERE IDT='".$rIdT."'";
	$rs = mysql_query($SQ);
}
else
{
	$SQ = "DELETE FROM tb_lembar_kerja_dokumen WHERE IDT='".$rIdT."'";
	$rs = mysql_query($SQ);
}
?>
<script languange="javascript">
showLKI('refr','<?=$AsT?>','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>');
</script>