<?
require "Connection.php";
extract($_GET);
#$rIDT = $_GET['IdT'];
#$rCRT = $_GET['rCRT'];

$gLat = "-2.5815086";
$gLng = "115.3826478";
$gLatLng = "LatLng(-2.5815086, 115.3826478)";
$Nm_Aset = "";
$tmpGLat = "";
$tmpGLng = "";

$nSQ = "SELECT * FROM ta_kib_108 WHERE referensi='" . $ref . "' AND Kd_UPB='" . $upb . "' AND Ref_Group='" . $rfg . "' AND lat <> ''";
//echo $nSQ;
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH)) {
	$Nm_Aset = $mRo['Nm_Aset'];
	$gLat = $mRo['lat'];
	$gLng = $mRo['lng'];
	$gLatLng = $mRo['lat_lng'];

	$tmpGLat = $mRo['lat'];
	$tmpGLng = $mRo['lng'];

	if ($mRo['lat'] == '' || $mRo['lng'] == '') {
		$dt = fGlobal("lat:lng:lat_lng", "ta_kib_108_sensus_2023", "Referensi:Kd_UPB:Ref_Group", $ref . ":" . $upb . ":" . $rfg, "=:=:=", "", "");
		if ($dt) {
			$dt = explode(':', $dt);
			$gLat = $dt[0];
			$gLng = $dt[1];
			$gLatLng = $dt[2];
		}
	}
}
?>

<style type="text/css">
	#mapid-wrapper {
		height: 417px;
		background-color: rgba(0, 255, 0, 0.1);
	}

	#mapid {
		width: 100%;
		height: 100%;
		min-height: 417px;
	}

	.map-status {
		display: none;
		margin: 8px 0;
		padding: 8px 10px;
		background: #f6f7f8;
		border: 1px solid #c6cbd1;
		color: #333333;
		font-size: 11px;
	}

	.map-status-error {
		background: #ffe9e9;
		border-color: #d98f8f;
		color: #7a1f1f;
	}
</style>

<table align="center" style="width:800px">
	<div center>
		<form method="post" name="myfrmmap"
			action="<?= "UploadMAP_Mid_.php?rIDT=" . $rIDT . "&rCRT=" . $rCRT . "&IdL=" . $_GET['IdL'] ?>"
			enctype="multipart/form-data">
			<input type="hidden" id="Simpan" name="Simpan">
			<input type="hidden" id="Nm_Aset" name="Nm_Aset" value='<?= $Nm_Aset ?>'>
			<input type="hidden" id="nLat" name="nLat" value='<?= $gLat ?>'>
			<input type="hidden" id="nLong" name="nLong" value='<?= $gLng ?>'>
			<input type="hidden" id="nLatLong" name="nLatLong" value='<?= $gLatLng ?>'>
			<input type="text" id="dLat" name="dLat" value='<?= $tmpGLat ?>'>
			<input type="text" id="dLng" name="dLng" value='<?= $tmpGLng ?>'>
			<input type="button" style="height:25px;width:70px" value="Simpan"
				onclick="P_SaveDT('<?= $ref ?>','<?= $upb ?>','<?= $_GET['IdL'] ?>')">
		</form>
	</div>
</table>
<div id="mapid-status" class="map-status">Menyiapkan peta...</div>
<div id="mapid-wrapper">
	<div id="mapid"></div>
</div>

<script type="text/javascript">
	function P_SaveDT(ref, upb, IdL) {
		$(document).ready(function () {
			var tLat = $("#dLat").val();
			var tLng = $("#dLng").val();

			$("#mapsDiv2Cri").load('Lembar_Kerja_Frm_Data_LKI_Map_Mid_.php?tLat=' + tLat + '&tLng=' + tLng + '&IdL=' + IdL);
		});

		/*
		if (objfrmap.Nm_Aset.value=="")
		{
			window.alert('Silahkan pilih lokasi terlebih dahulu');
		}
		else
		{
			objfrmap.Simpan.value = "Upload";
			objfrmap.target = "_top";
			objfrmap.submit();
		}
		*/
	}

	(function () {
		var initConfig = {
			containerId: 'mapid',
			statusElementId: 'mapid-status',
			lat: '<?= $gLat ?>',
			lng: '<?= $gLng ?>',
			zoom: 15,
			accessToken: 'YOUR_MAPBOX_ACCESS_TOKEN',
			latFieldId: 'nLat',
			lngFieldId: 'nLong',
			latLngFieldId: 'nLatLong',
			displayLatFieldId: 'dLat',
			displayLngFieldId: 'dLng'
		};

		function startMapInit() {
			if (!window.LKIMapInit || typeof window.LKIMapInit.boot !== 'function') {
				var statusElement = document.getElementById('mapid-status');
				if (statusElement) {
					statusElement.style.display = 'block';
					statusElement.className = 'map-status map-status-error';
					statusElement.innerHTML = 'Helper inisialisasi peta tidak tersedia.';
				}
				return;
			}

			window.LKIMapInit.boot(initConfig);
		}

		if (window.LKIMapInit && typeof window.LKIMapInit.boot === 'function') {
			startMapInit();
			return;
		}

		var existingScript = document.querySelector ? document.querySelector('script[data-lki-map="bootstrap-helper"]') : null;
		if (existingScript) {
			if (typeof existingScript.addEventListener === 'function') {
				existingScript.addEventListener('load', startMapInit);
				existingScript.addEventListener('error', function () {
					var statusElement = document.getElementById('mapid-status');
					if (statusElement) {
						statusElement.style.display = 'block';
						statusElement.className = 'map-status map-status-error';
						statusElement.innerHTML = 'Gagal memuat helper peta.';
					}
				});
			} else {
				var statusElement = document.getElementById('mapid-status');
				existingScript.onload = startMapInit;
				existingScript.onerror = function () {
					if (statusElement) {
						statusElement.style.display = 'block';
						statusElement.className = 'map-status map-status-error';
						statusElement.innerHTML = 'Gagal memuat helper peta.';
					}
				};
			}
			return;
		}

		var helperScript = document.createElement('script');
		helperScript.src = 'js/lki-map-init.js';
		helperScript.async = true;
		helperScript.setAttribute('data-lki-map', 'bootstrap-helper');
		helperScript.onload = startMapInit;
		helperScript.onerror = function () {
			var statusElement = document.getElementById('mapid-status');
			if (statusElement) {
				statusElement.style.display = 'block';
				statusElement.className = 'map-status map-status-error';
				statusElement.innerHTML = 'Gagal memuat helper peta.';
			}
		};

		var headElement = document.getElementsByTagName('head')[0];
		if (!headElement) {
			var statusElement = document.getElementById('mapid-status');
			if (statusElement) {
				statusElement.style.display = 'block';
				statusElement.className = 'map-status map-status-error';
				statusElement.innerHTML = 'Tag head tidak ditemukan untuk memuat helper peta.';
			}
			return;
		}

		headElement.appendChild(helperScript);
	}());
</script>
