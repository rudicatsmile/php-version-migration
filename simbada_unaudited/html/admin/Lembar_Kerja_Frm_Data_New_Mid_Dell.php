<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$Ref = fGlobal("Referensi","tb_lembar_kerja_belum_tercatat","IDT",$IdT,"=","","");
$Upb = fGlobal("KdUPB","tb_lembar_kerja_belum_tercatat","IDT",$IdT,"=","","");

$SQ = "DELETE FROM tb_lembar_kerja_foto_denah WHERE Referensi='".$Ref."' AND KdUPB='".$Upb."'";
$rs = mysql_query($SQ);

$SQ = "DELETE FROM tb_lembar_kerja_dokumen WHERE Referensi='".$Ref."' AND KdUPB='".$Upb."'";
$rs = mysql_query($SQ);

$SQ = "DELETE FROM tb_lembar_kerja_belum_tercatat WHERE IDT='".$IdT."'";
$rs = mysql_query($SQ);

?>

<script languange="javascript">
BtnGO.click();
</script>