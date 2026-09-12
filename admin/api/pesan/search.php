<?php
include "../connect.php";

$query = $_POST['query'];

$sql = "SELECT * FROM ta_pesan
        WHERE
        code LIKE '%$query%' OR
        name LIKE '%$query%'
        ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $products = array();
    while ($row = $result->fetch_assoc()) {        
        $products[] = $row;
    }
    echo json_encode(array(
        "success" => true,
        "data" => $products
    ));
} else {
    echo json_encode(array("success" => false));
}