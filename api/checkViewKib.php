<?php
 require_once 'connect.php';

 $kodeBar = $_POST['kodeBar'];
 
 $sql = "SELECT kode_bar FROM ta_kib_108 WHERE kode_bar = '".$kodeBar."'";
 $result = mysqli_query($conn,$sql);
 $count = mysqli_num_rows($result);
 $data = mysqli_fetch_assoc($result);
 if($count == 1){  	
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