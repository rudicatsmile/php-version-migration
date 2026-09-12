<?php

include "../connect.php";

$code = $_POST['code'];

$sql = "DELETE FROM ta_pesan  WHERE idt='$code'";
$result = $conn->query($sql);
if($result) {
    echo json_encode(array("success"=>true));
} else {
    echo json_encode(array("success"=>false));    
}
