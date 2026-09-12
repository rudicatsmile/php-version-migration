<?
require('Connection.php');
extract($_GET);
if ($rIdT)
{
	$nSG = "DELETE FROM ta_sp3d_pendaftaran WHERE IDT='".$rIdT."'";
	$rg = mysql_query($nSG);
}
?>

<script type="text/javascript">
	alert('Proses berhasil...!!');
	RefreshDATA('<?=$IdL?>');
</script>