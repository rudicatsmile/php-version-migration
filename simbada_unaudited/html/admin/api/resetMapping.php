<?php

require_once 'connect.php';

$code = $_POST['kodeBar'];

$query_delete = "UPDATE ta_kib_108 SET kode_bar = '',file_name='',file_type='',file_size='',lat='',lng='',lat_lng=''  
                 WHERE kode_bar = '$code'";	
$result_delete = mysqli_query($conn, $query_delete);

$query_delete = "UPDATE ta_kib_108_barcode SET referensi = '',Kd_UPB='' WHERE kode_bar = '$code'";
$result_delete = mysqli_query($conn, $query_delete);

if($result_delete){
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
