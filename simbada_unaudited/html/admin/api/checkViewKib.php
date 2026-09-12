<?php
 require_once 'connect.php';

 $kodeBar = $_POST['kodeBar'];
 
 $sql = "SELECT kode_bar FROM ta_kib_108 WHERE kode_bar = '".$kodeBar."'";
 $result = mysqli_query($conn,$sql);
 $count = mysqli_num_rows($result);
 $data = mysqli_fetch_assoc($result);
 if($count == 1){  	
 	while($row=mysqli_fetch_object($result)){	
		$data[]=$row;
	}
	$response=array(
        'status' => 1,
        'message' =>'Success',
        'value' => $data
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