<?php

require_once 'connect.php';

$code = $_GET['kode'];

$query = "SELECT *  FROM ref_upb  WHERE Kd_Upb = '$code' ORDER BY IDT";	
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);	
echo json_encode($data);



?>