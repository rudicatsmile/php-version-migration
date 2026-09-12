<?php
include "../connect.php";

$code = $_POST['code'];

$sql = "SELECT * FROM ta_pesan WHERE idt='$code'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $stock = 0;
    while ($row = $result->fetch_assoc()) {
        $stock = (int)$row['stock'];
    }
    echo json_encode(array(
        "success" => true,
        "data" => $stock,
    ));
} else {
    echo json_encode(array("success" => false));
}