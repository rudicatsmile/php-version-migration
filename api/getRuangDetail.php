<?php

require_once 'connect.php';

$Kd_Upb = $_GET['kodeUpb'];
$Kd_Ruang = $_GET['kodeRuang'];

$query = "SELECT *  FROM ref_ruangan WHERE Kd_Upb = '$Kd_Upb' AND Kd_Ruang = '001' ORDER BY IDT";	
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);	
echo json_encode($data);



?>