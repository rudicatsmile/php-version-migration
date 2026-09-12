<?php

require_once 'connect.php';

$idt = $_GET['idt'];

$query = "SELECT file_name  FROM ta_kib_108 WHERE IDT = '$idt' ORDER BY IDT";	
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);	
echo json_encode($data);



?>