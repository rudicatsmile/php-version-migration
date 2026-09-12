<?php
 require_once 'connect.php';

 $kodeBar = $_POST['kodeBar'];
 
 $sql = "SELECT idt,kode_bar FROM ta_kib_108 WHERE kode_bar = '".$kodeBar."' AND file_name <> '' ORDER BY idt ";
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

    $sql2 = "SELECT idt,kode_bar FROM ta_kib_108 WHERE kode_bar = '".$kodeBar."' ORDER BY idt ";
    $result2 = mysqli_query($conn,$sql2);
    $count2 = mysqli_num_rows($result2);
    $data2 = mysqli_fetch_assoc($result2);
    if($count2 == 1){   
        while($row=mysqli_fetch_object($result2)){   
            $data2[]=$row;
        }
        $response=array(
            'status' => 2,
            'message' =>'Success2',
            'value' => $data2
        );
        
    }else{
        $response=array(
            'status' => 0,
            'message' =>'Error'
        );
    }
	
}

header('Content-Type: application/json');
echo json_encode($response);
 
 
?>