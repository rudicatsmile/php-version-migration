<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require "Connection.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Simbada Kab. Hulu Sungai Tengah</title>


	<!-- Map Box-->
	<link href="https://api.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.css" rel="stylesheet">
	<script src="https://api.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.js"></script>

	<style>
        /* ukuran peta */
        #mapid {
            height: 100%;
        }
        .jumbotron{
            height: 100%;
            border-radius: 0;
        }
        body{
            background-color: #ebe7e1;
        }
		
		
		
		
    </style>
	
	
	
</head>
<?
$rIDT = $_GET['rIDT'];
$rCRT = $_GET['rCRT'];

$nSQ = "SELECT * FROM ta_kib_108 where IDT='".$rIDT."' AND lat <> ''";
$nRs = mysql_query($nSQ) or die(mysql_error());
$mRo = mysql_fetch_assoc($nRs);
$tRo = mysql_num_rows($nRs);
if ($tRo > 0){
	$Nm_Aset = $mRo['Nm_Aset'];
	$gLat  = $mRo['lat'];
	$gLng  = $mRo['lng'];	
	$gLatLng  = $mRo['lat_lng'];	
	
	$tmpGLat  = $mRo['lat'];
	$tmpGLng  = $mRo['lng'];	
}else{
	//$gLat  = "-2.339609";
	//$gLng  = "115.459617";  
	//$gLatLng  = "LatLng(-2.339609, 115.459617)";

	$gLat    = "-2.5815086";
	$gLng    = "115.3826478";
	$gLatLng = "LatLng(-2.5815086, 115.3826478)";

	$Nm_Aset = '';
	$tmpGLat  = '';
	$tmpGLng  = '';
}

//echo $gLat.' : '.$gLng;
echo "<br>";
?>
<body>
<table align="center" style="width:800px">
	<div center>
		<form method="post" name="myfrm" action="<?="UploadMAP_Mid_.php?rIDT=".$rIDT."&rCRT=".$rCRT."&IdL=".$_GET['IdL'] ?>" enctype="multipart/form-data">

			<input type="hidden" name="Simpan">
			<input type="hidden" id="Nm_Aset" value='<?php echo $Nm_Aset;?>'>
			<input type="hidden" id="nLat" name="nLat"   value='<?php echo $gLat;?>'>
			<input type="hidden" id="nLong" name="nLong" value='<?php echo $gLng;?>'>
			<input type="hidden" id="nLatLong" name="nLatLong" value='<?php echo $gLatLng;?>'>
			<!--<input type="text" id="latlong" name="latlong">-->
			
			<input type="button" style="height:25px;width:70px" value="Simpan" onclick="P_Save()">
			<input type="text" id="dLat" name="dLat" value='<?php echo $tmpGLat;?>'>
			<input type="text" id="dLng" name="dLng" value='<?php echo $tmpGLng;?>'>
					
		</form>
	</div>
	
</table>
	
	<div style="height: 500px; background-color: rgba(255,0,0,0.1);">
	  
	  <div id="mapid"></div>
	</div>
				
	<!-- Load the `mapbox-gl-geocoder` plugin. -->
	<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
	<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" 
		type="text/css">

    	
	<script>
	
	//mapbox/satellite-streets-v11
		mapboxgl.accessToken = 'YOUR_MAPBOX_ACCESS_TOKEN';
		const map = new mapboxgl.Map({
			container: 'mapid',
			attribution: 'Pemerintah Kabupaten Hulu Sungai Tengah',
			style: 'mapbox://styles/mapbox/satellite-streets-v11',
			center: [<?php echo $gLng;?>, <?php echo $gLat;?>],
			zoom: 12
		});
		
			

		// Add the control to the map. -2.337242, 115.460216
		map.addControl(
			new MapboxGeocoder({
				accessToken: mapboxgl.accessToken,
				mapboxgl: mapboxgl
			})
		);
			
		map.addControl(new mapboxgl.NavigationControl());
		
		// Create a default Marker and add it to the map.
		const marker1 = new mapboxgl.Marker()
			.setLngLat([<?php echo $gLng;?>, <?php echo $gLat;?>])
			.addTo(map);
		/*	 
		// Create a default Marker, colored black, rotated 45 degrees.
		const marker2 = new mapboxgl.Marker({ color: 'black', rotation: 45 })
			.setLngLat([115.44292, -2.337036])
			.addTo(map);
		*/
			
		map.on('click', (e) => {
			
			/*			
				console.log(e);
				console.log(e.lngLat);
				console.log(e.lngLat.lng);
				console.log(e.lngLat.lat);
			*/
			
			document.getElementById('Nm_Aset').value = e.lngLat
			document.getElementById('nLatLong').value = e.lngLat
			document.getElementById('nLat').value = e.lngLat.lat 
            document.getElementById('nLong').value = e.lngLat.lng 
			  
			//document.getElementById("dLat").innerHTML = e.lngLat.lat 
			//document.getElementById("dLng").innerHTML = e.lngLat.lng 
			document.getElementById("dLat").value = e.lngLat.lat 
			document.getElementById("dLng").value = e.lngLat.lng 
			
			
		});
	</script>
	
	
	
	
	
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Save()
	{
		
		if (objfrm.Nm_Aset.value=="")
		{
			window.alert('Silahkan pilih lokasi terlebih dahulu');
		}
		else
		{
			//alert('ooo');
			objfrm.Simpan.value = "Upload";
			objfrm.target = "_top";
			objfrm.submit();
		}
	}
	
	function P_Dele()
	{
		var AN = confirm("Hapus foto objek aset..?!!");
		if (AN)
		{
			objfrm.Simpan.value = "Delete";
			objfrm.target = "_top";
			objfrm.submit();
		}
	}
</script>
