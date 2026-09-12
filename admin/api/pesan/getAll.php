<?php
include "../connect.php";

$sql = "SELECT * FROM ta_pesan ORDER BY idt";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $pesans = array();
    while ($row = $result->fetch_assoc()) {
        $pesans[] = $row;
    }
    echo json_encode(array(
        "success" => true,
        "data" => $pesans,
    ));
} else {
    echo json_encode(array("success" => false));
}