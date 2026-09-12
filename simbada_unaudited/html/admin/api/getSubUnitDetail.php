<?php

require_once 'connect.php';

$code = $_GET['kode'];

$query = "SELECT * FROM ref_sub_unit  WHERE Kd_Sub = '$code' ORDER BY IDT";	
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);	
echo json_encode($data);



?>
