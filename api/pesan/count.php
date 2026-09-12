<?php
include "../connect.php";

$sql = "SELECT code FROM ta_pesan";
$result = $conn->query($sql);
echo json_encode(array(
    "data" => $result->num_rows,
));