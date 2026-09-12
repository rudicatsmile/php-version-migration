<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

if ($CrT=='Img')
{
	$SQ = "SELECT filename FROM tb_lembar_kerja_upload_img where IDT='".$rIdT."'";
	$rs = mysql_query($SQ);
	$mR = mysql_fetch_array($rs);
	$nName = $mR[0];
	if ($nName!="")
	{
		unlink("upload_img/".$nName);
	}
	
	$SQ = "DELETE FROM tb_lembar_kerja_upload_img WHERE IDT='".$rIdT."'";
	$rs = mysql_query($SQ);
	
	#$SQ = "DELETE FROM tb_lembar_kerja_foto_denah WHERE IDT='".$rIdT."'";
	#$rs = mysql_query($SQ);
}
else
{
	$SQ = "SELECT filename FROM tb_lembar_kerja_upload_pdf where IDT='".$rIdT."'";
	$rs = mysql_query($SQ);
	$mR = mysql_fetch_array($rs);
	$nName = $mR[0];
	if ($nName!="")
	{
		unlink("upload_pdf/".$nName);
	}
	
	$SQ = "DELETE FROM tb_lembar_kerja_upload_pdf WHERE IDT='".$rIdT."'";
	$rs = mysql_query($SQ);
	
	#$SQ = "DELETE FROM tb_lembar_kerja_dokumen WHERE IDT='".$rIdT."'";
	#$rs = mysql_query($SQ);
}
?>
<script languange="javascript">
showLKI('refr','<?=$AsT?>','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>');
</script>