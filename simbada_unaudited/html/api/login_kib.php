<?php
 require_once 'connect.php';

 //$db = mysqli_connect('localhost','proiso','ra11-19','sipanda-bmd');
 $username = $_POST['username'];
 $gPas = $_POST['password'];
 
 $password = base64_encode(base64_encode($gPas));
 $sql = "SELECT * FROM ta_user WHERE User_ID = '".$username."' AND Password = '".$password."'";
 $result = mysqli_query($conn,$sql);
 $count = mysqli_num_rows($result);
 if($count == 1){
    echo json_encode("Success");
 } 
 else{
    echo json_encode("Error");
 }
 
 /*
 user : creator
 password : 5116752011
 */
?>