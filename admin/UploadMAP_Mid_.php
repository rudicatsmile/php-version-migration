<?php
require "Connection.php";
$rIDT = $_GET['rIDT'];
$rCRT = $_GET['rCRT'];
$IdL  = $_GET['IdL'];

$nLat  = $_POST['nLat'];
$nLong = $_POST['nLong'];
$nLatLong = $_POST['nLatLong'];

if ($_POST['Simpan'] == "Upload") {
	$nLatLong_ = "LatLng(" . substr($nLat, 0, 9) . ", " . substr($nLong, 0, 10) . ")";
	$nSQL = "UPDATE ta_kib_108 SET lat='$nLat', lng='$nLong', lat_lng='$nLatLong'  WHERE IDT='" . $rIDT . "'";
	$nSQL = "UPDATE ta_kib_108 SET lat='$nLat', lng='$nLong', lat_lng='$nLatLong_' WHERE IDT='" . $rIDT . "'";

	$nRs = mysql_query($nSQL) or die(mysql_error());

	// Jika dari LKI form, update juga tb_lembar_kerja dan tutup popup
	if (isset($_GET['src']) && $_GET['src'] == 'lki') {
		$SnsIDT = $_GET['SnsIDT'];
		$nLatLongFormatted = "LatLng(" . $nLat . "," . $nLong . ")";
		$nSQL2 = "UPDATE tb_lembar_kerja SET TitikKoordinat='" . $nLatLongFormatted . "' WHERE IDT='" . $SnsIDT . "'";
		mysql_query($nSQL2);

		// Close popup and set value in parent/opener window
		echo '<script language="javascript">';
		echo 'try {';
		echo '  if (window.top.opener && window.top.opener.document.getElementById("TitikKoordinat")) {';
		echo '    window.top.opener.document.getElementById("TitikKoordinat").value = "' . $nLatLongFormatted . '";';
		echo '  }';
		echo '} catch(e) { console.log(e); }';
		echo 'try { window.top.close(); } catch(e) { window.close(); }';
		echo '</script>';
		exit;
	}

	echo CloseWin($rIDT, $rCRT, $IdL);
}


function CloseWin($rIDT, $rCRT, $IdL)
{
	$URL = "Form_Asset_" . strtoupper($rCRT) . "_Mid.php?rIDT=" . $rIDT . "&IdL=" . $IdL;
?>
	<script language='JavaScript'>
		this.window.open('<?= $URL ?>', 'WinFormKIB_Mid');
		this.window.focus();
		this.window.document.clear();
		this.window.document.close();
		this.setTimeout('self.close()', 1);
	</script>
<?php
}
?>