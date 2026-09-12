<?php
require_once 'connect.php';

$userName      	= $_POST['userName'];
$message    	= $_POST['message'];
	
$Recorded = date("Y-m-d H:i:s");
	
$sql = "INSERT INTO ta_pesan 
		(pesan, userName, Recorded, Pencatat) 
		VALUES 
		('$message', '$userName', '$Recorded', '$userName'); 
		";
//echo $sql;exit;
$query = mysqli_query($conn,$sql);
$response=array(
	'status' => 1,
	'message' =>'Success'
);

header('Content-Type: application/json');
echo json_encode($response);

?>