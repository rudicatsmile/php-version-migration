<?php

require_once 'connect.php';

$code = $_GET['kode'];

$query = "SELECT * FROM ref_unit  WHERE Kd_Unit = '$code' ORDER BY IDT";	
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);	
echo json_encode($data);



?>