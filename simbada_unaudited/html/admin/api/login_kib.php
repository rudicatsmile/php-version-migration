<?php
 require_once 'connect.php';

 $username = $_POST['username'];
 $gPas = $_POST['password'];
 
 $password = base64_encode(base64_encode($gPas));
 $sql = "SELECT *,
	 (SELECT Nm_Unit FROM ref_unit WHERE Kd_Unit=LEFT(ta_user.Kode,11)) AS Nm_Unit,
	 (SELECT Nm_Sub FROM ref_sub_unit WHERE Kd_Sub=LEFT(ta_user.Kode,14)) AS Nm_Sub,
	 (SELECT Nm_UPB FROM ref_upb WHERE Kd_UPB=ta_user.Kode) AS Nm_UPB
 FROM ta_user WHERE User_ID = '".$username."' AND Password = '".$password."'";
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
 
 
 /*
 $count = mysqli_num_rows($result);
 if($count == 1){
    echo json_encode("Success");
 } 
 else{
    echo json_encode("Error");
 }
 *.
 
 /*

 
$query = "SELECT $fields FROM ta_kib_108  WHERE kode_bar = '$code'";	
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);	
echo json_encode($data);
 */
?>