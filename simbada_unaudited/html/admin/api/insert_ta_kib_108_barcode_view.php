<?php
require_once 'connect.php';

$idt      		= $_POST['idt'];
$referensi    	= $_POST['referensi'];
			  
$sql = " SELECT *,
		(SELECT Recorded_map FROM ta_kib_108_barcode WHERE kode_bar=ta_kib_108.kode_bar LIMIT 1) AS Recorded_map
		 FROM ta_kib_108 WHERE referensi = '$referensi';
		";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);

$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
$data = mysqli_fetch_assoc($result);
if($count == 1){  

	while($row=mysqli_fetch_object($result)){	
		$data[]=$row;
	}
	
	$Kd_UPB = $data['Kd_UPB'];	
	$Kd_Aset_108 = $data['Kd_Aset_108'];  
	$Nm_Aset = $data['Nm_Aset']; 
	$kode_bar = $data['kode_bar'];
	$Recorded = date("Y-m-d H:i:s");
	$Recorded_view = $data['Recorded_map'];
	$userName = 'ip number : ';	
		
		$sql = "
		INSERT INTO ta_kib_108_barcode_view 
		(referensi, Kd_UPB, Kd_Aset_108, Nm_Aset, kode_bar, Recorded, Recorded_view, userName) 
		VALUES 
		('$referensi', '$Kd_UPB', '$Kd_Aset_108', '$Nm_Aset', '$kode_bar', '$Recorded', '$Recorded_view', '$userName'); 
		";
	//echo $sql;exit;
	$query = mysqli_query($conn,$sql);
	
	$response=array(
		'status' => 1,
		'message' =>'Success'
	);
}else{
	$response=array(
		'status' => 0,
		'message' =>'Error'
	);
	
}



header('Content-Type: application/json');
echo json_encode($response);

?>
