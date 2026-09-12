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
<?php
$rIDT = $_GET['rIDT'];
$rCRT = $_GET['rCRT'];
$nSQL = str_replace("^", "'",$_GET['nSQL']);

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
$nSQL = str_replace(" ORDER BY "," AND lat <> '' ORDER BY ",$nSQL);
//echo $nSQL;
$query = str_replace("*"," count(*)AS tot_row ",$nSQL);

$rs = mysql_query($query) or die(mysql_error());
$fetch = mysql_fetch_assoc($rs);
$num_row = mysql_num_rows($rs);
if ($fetch['tot_row'] > 0){
	$tot_row = $fetch['tot_row'];
	$str_ket = " Terdapat $tot_row Titik Koordinat ";
}else{
	$tot_row = 0;
	$str_ket = "";
}
echo "<br>";
?>
<body>
<table align="center">
	<div align="center">		
			<?php echo $str_ket;?>
	</div>	
</table>
	
	<div style="height: 600px; background-color: rgba(255,0,0,0.1);">	  
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
			zoom: 10
		});
		
		map.addControl(
			new MapboxGeocoder({
				accessToken: mapboxgl.accessToken,
				mapboxgl: mapboxgl
			})
		);
			
		map.addControl(new mapboxgl.NavigationControl());
				
		<?php	
			
			$tampil = mysql_query($nSQL) or die(mysql_error());
			while($hasil = mysql_fetch_array($tampil)){ 
					
					//$Nm_Aset2 = substr($hasil['Nm_Aset'],0,20);
					$Nm_Aset2 = $hasil['Nm_Aset'];

					$lat = $hasil['lat'];
					$lng = $hasil['lng'];
			?> 
				    popup = new mapboxgl.Popup()
							  .setText('<?php echo $Nm_Aset2;?>')
							  .addTo(map);
							  
					marker = new mapboxgl.Marker()
					.setLngLat([<?php echo $lng;?>, <?php echo $lat;?>])
					.addTo(map)
					.setPopup(popup);


			<?php 
			} 
			?>
		
		
             
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
