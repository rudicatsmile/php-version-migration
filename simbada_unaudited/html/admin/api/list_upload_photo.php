<?php 
/*
    $conn = new mysqli("localhost","root","","");
    $query       = "select * from aa_upload_image";
	$data=array();
	$result = mysqli_query($conn, $query);
	while($row=mysqli_fetch_object($result))
		  {	
			$data[]=$row;
		  }

    $response=array(
            'status' => 1,
            'message' =>'Get Data Successfully.',
            'value' => $data
        );
	header('Content-Type: application/json');
	echo json_encode($response);
	
	*/
	
	
	
	// $connection = new mysqli("localhost","root","","Simbada_data");
    require_once 'connect.php';

  
	$query = "select * from aa_upload_image";
	$result =  mysqli_query($conn, $query) or die
	("Error in Selecting " . mysqli_error($conn));
	$rows = array();
	while ($row = $result->fetch_assoc()) {
		$rows[] = $row;
	}
	echo json_encode($rows);
	
?>