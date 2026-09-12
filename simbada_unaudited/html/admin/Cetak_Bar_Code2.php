<?php
extract($_GET);
require "Connection.php";
require "FileFunction.php";


// if($_GET['kode_kib']){
// 	//echo 'kode_kib';exit;
// 	//$kode_kib = 1.3.2.05.01.04.003
// 	$kode_kib = $_GET['kode_kib'];
// 	$kode_kib_slice = substr($kode_kib,0,5);
// 	$sql = "SELECT idt,Kd_UPB,Kd_Aset_108,kode_bar FROM ta_kib_108_barcode WHERE kode_bar <> '' AND kD_aset_108 LIKE '$kode_kib_slice%' ORDER BY kode_bar DESC";
// 	//echo $sql.'<p>--- '.$kode_kib;	

// 	$nRstGlo = mysql_query($sql) or die(mysql_error());
// 	$rowClient = mysql_fetch_assoc($nRstGlo);
// 	$tRowGlo = mysql_num_rows($nRstGlo);
// 	if ($tRowGlo > 0){

// 		//KIB-A-0000000002
// 		$kode_bar = $rowClient['kode_bar'];	
// 		$kode_bar_pieces = explode("-",$kode_bar);              
// 		$kib_value = intval($kode_bar_pieces[2]) + 1;
// 		$kib_value = substr("0000000000".$kib_value,-10,strlen("0000000000".$kib_value));

// 		$new_kode_bar = $kode_bar_pieces[0].'-'.$kode_bar_pieces[1].'-'.$kib_value;

					
// 	}else{
// 		$new_kode_bar = $kode.'0000000001';
// 	}
// 	$sql_insert = "INSERT INTO ta_kib_108_barcode (Kd_Aset_108, kode_bar,Recorded)
// 				VALUES ('$kode_kib', '$new_kode_bar', now())"; 
	
// 	$RsA = mysql_query($sql_insert) or die(mysql_error());

	

// }else{
	$DT = fGlobal("kd_aset_108:no_register:kd_upb:referensi:kode_bar:IdtabelMaster","ta_kib_108","IDT",$IDT,"=","","");
	if ($DT)
	{	
		$DT = explode(':',$DT);
		$kdA = $DT[0]; //Kd_Aset_108: 1.3.2.05.02.01.032
		$noR = $DT[1]; //no register
		$upB = $DT[2]; //kode upb: 24.04.13.01.01.003
		$ref = $DT[3]; //referensi 
		$qr  = $DT[4]; //kode_bar: KIB-B-0000030081
		$IdtabelMaster  = $DT[5]; //IDT

		//Jika Belum pernah di Photo
		//Jika field IdtabelMaster terisi, artinya sudah pernah di cetak melalui KIR. Kode QR ambil dari field IdtabelMaster
		
			if($_GET['kode_kib']){
				if($IdtabelMaster == '0'){
					//$kode_kib = 1.3.2.05.01.04.003
					$kode_kib = $_GET['kode_kib'];
					$kode_kib_slice = substr($kode_kib,0,5);
					$sql = "SELECT idt,Kd_UPB,Kd_Aset_108,kode_bar FROM ta_kib_108_barcode WHERE kode_bar <> '' AND kD_aset_108 LIKE '$kode_kib_slice%' ORDER BY kode_bar DESC";
				
					$nRstGlo = mysql_query($sql) or die(mysql_error());
					$rowClient = mysql_fetch_assoc($nRstGlo);
					$tRowGlo = mysql_num_rows($nRstGlo);
					if ($tRowGlo > 0){
				
						//KIB-A-0000000002
						$kode_bar = $rowClient['kode_bar'];	
						$kode_bar_pieces = explode("-",$kode_bar);              
						$kib_value = intval($kode_bar_pieces[2]) + 1;
						$kib_value = substr("0000000000".$kib_value,-10,strlen("0000000000".$kib_value));
				
						$new_kode_bar = $kode_bar_pieces[0].'-'.$kode_bar_pieces[1].'-'.$kib_value;
				
									
					}else{
						$new_kode_bar = $kode.'0000000001';
					}

					//Beri tanda bahwa baris ini sudah di cetak QR KIR
					$sql_update = "UPDATE ta_kib_108 SET IdtabelMaster = '".$new_kode_bar."' WHERE IDT = '".$_GET['IDT']."'"; 
					$RsB = mysql_query($sql_update) or die(mysql_error());	

					$sql_insert = "INSERT INTO ta_kib_108_barcode (Kd_Aset_108, kode_bar,Recorded)
								VALUES ('$kode_kib', '$new_kode_bar', now())"; 			
					$RsA = mysql_query($sql_insert) or die(mysql_error());	
					
					$qr  = $new_kode_bar;
				}else{
					$qr = $IdtabelMaster;
				}
			}
		
		$file = "https://simbada.hstkab.go.id/admin/simandor/temp/qrwithlogo".$qr.".png";

		//24.04.13.01.01.003 -> UPB
		//24.04.05.01		 -> Kode SKPD

		$Kd_Unit = substr($upB,0,11);
		$unit = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$Kd_Unit,"=","","");

		//Create QR Code
		include "simandor/phpqrcode/qrlib.php"; 

		$tempdir = "simandor/temp/";       
		$logopath="Images/logopemda.png";
		//isi qrcode jika di scan
		$codeContents = $qr; 

		//simpan file qrcode
		QRcode::png($codeContents, $tempdir.'qrwithlogo'.$codeContents.'.png', QR_ECLEVEL_H, 10,4);

		// ambil file qrcode
		$QR = imagecreatefrompng($tempdir.'qrwithlogo'.$codeContents.'.png');

		// memulai menggambar logo dalam file qrcode
		$logo = imagecreatefromstring(file_get_contents($logopath));
			
		imagecolortransparent($logo , imagecolorallocatealpha($logo , 0, 0, 0, 127));
		imagealphablending($logo , false);
		imagesavealpha($logo , true);

		$QR_width = imagesx($QR);
		$QR_height = imagesy($QR);

		$logo_width = imagesx($logo);
		$logo_height = imagesy($logo);

		// Scale logo to fit in the QR Code
		$logo_qr_width = $QR_width/4;
		$scale = $logo_width/$logo_qr_width;
		$logo_qr_height = $logo_height/$scale;

		imagecopyresampled($QR, $logo, $QR_width/0.6, $QR_height/0.8, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

		$file = $tempdir.'qrwithlogo'.$codeContents.'.png';
			
	}else{			
		
		$file = $_GET['file'];
		$noR  = '';
		$unit = '';		
		
	}





?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cetak Bar Kode</title>
    <link href="style.css" rel="stylesheet">
	<style>
			div.relative {
			  position: relative;
			  width: 389px;
			  height: 124px;
			  border: 3px solid #000;

			} 
			div.absolute-logo{
			  position: absolute;
			  top: 0px;
			  left: 0px;			 
			}

			div.absolute-title {
			  position: absolute;
			  top: 5px;
			  left: 20px;			 
			}

			div.absolute-code {
			  position: absolute;
			  top: 41px;
			  left:8px;		  
			  
			}

			div.absolute-logo2{
			  position: absolute;
			  top: 48px;
			  left: 110px;			 
			}

			div.absolute-hr{
			  position: absolute;
			  top: 37px;
			  left: 0px;
			  width: 397px;
			  border-top: solid 1px #000 !important;
			}
			
			.garis-horizontal {
				position: absolute;
				top: 106px;
				left: 0px;
				border-top: 1px solid black;
			}

			div.absolute-register {
			  position: absolute;
			  top: 43px;
			  left: 190px;	
			  font-size:11pt;	
			  font-family: Arial Narrow;	
			  font-weight: bold; 
			  line-height: 0.8;
			}

			.register-number {
				font-size:12pt;
			}

			.unit-name {
				font-size:10pt;
				line-height: 0.9;
			}
			hr {
				border-top: solid 1px #000 !important;
			}
	</style>
</head>
<body onload="window.print();"> 	

	<div class="relative">
	  	
  		<div class="absolute-title"><font face="Arial Narrow" size="5">&nbsp;&nbsp;&nbsp;Aset Pemerintah Kabupaten Hulu Sungai Tengah</font></div>
  		<!-- <div class="absolute-hr"><hr style="height:2px;border-width:2;color:black;background-color:black"></div> -->
  		<div class="absolute-hr"></div>
  		<div class="absolute-code"><?php echo "<img src='" . $file ."' align='center' width='106' height='80'>"?></div>
		<div class="absolute-logo2"><img src="Images/logopemda-bw3.png" align="right" width="63" height="70" /></div>
		<div class="absolute-register">
			<div class="register-number">No.Reg. : <?=$noR?></div>
			<hr>
			<div class="unit-name"><b>SKPD</b> &nbsp;&nbsp;: <?=$unit?></div>
		</div>
		
  	</div>
</body>
</html>
<!-- <script type="text/javascript">
	$("document").ready(function()
	{
       
       	window.history.back();


    });
</script> -->

