<?
require('Connection.php');
extract($_GET);
$rDTA = explode(':',$rDTA);
$rIdT = $rDTA[0];
$rTbL = $rDTA[1];

if ($rIdT)
{
	$nSQ="UPDATE ta_kib_".$rTbL." SET Kd_Ruang='' WHERE IDT='$rIdT'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
}
?>

<script languange="javascript">
	RefreshDATA('<?=$IdL?>');
</script>