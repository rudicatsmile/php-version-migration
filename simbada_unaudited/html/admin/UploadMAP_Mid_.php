<?
require "Connection.php";
$rIDT = $_GET['rIDT'];
$rCRT = $_GET['rCRT'];
$IdL  = $_GET['IdL'];

$nLat  = $_POST['nLat'];
$nLong = $_POST['nLong'];
$nLatLong = $_POST['nLatLong'];

if ($_POST['Simpan']=="Upload")
{	
	$nLatLong_ = "LatLng(".substr($nLat, 0, 9).", ".substr($nLong, 0, 10).")";
	$nSQL = "UPDATE ta_kib_108 SET lat='$nLat', lng='$nLong', lat_lng='$nLatLong'  WHERE IDT='".$rIDT."'";
	$nSQL = "UPDATE ta_kib_108 SET lat='$nLat', lng='$nLong', lat_lng='$nLatLong_' WHERE IDT='".$rIDT."'";
	
	$nRs = mysql_query($nSQL) or die(mysql_error());
	echo CloseWin($rIDT,$rCRT,$IdL);
}


function CloseWin($rIDT,$rCRT,$IdL)
{
	$URL="Form_Asset_".strtoupper($rCRT)."_Mid.php?rIDT=".$rIDT."&IdL=".$IdL;
	?>
	<script language='JavaScript'>
	this.window.open('<?=$URL?>','WinFormKIB_Mid');
	this.window.focus();
	this.window.document.clear();
	this.window.document.close();
	this.setTimeout('self.close()',1);
	</script>
	<?
}
?>
