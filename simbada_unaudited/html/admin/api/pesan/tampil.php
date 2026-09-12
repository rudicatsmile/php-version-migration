<?php

include "../connect.php";

$code = $_POST['code'];

$sql = "UPDATE ta_pesan SET tampil='1'  WHERE   idt='$code'";
$result = $conn->query($sql);
if($result) {
    echo json_encode(array("success"=>true));
} else {
    echo json_encode(array("success"=>false));    
}
