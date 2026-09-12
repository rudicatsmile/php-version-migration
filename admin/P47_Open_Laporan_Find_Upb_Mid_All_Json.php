<?php
require "Connection.php";
require "FileFunction.php";

$data = array();
extract($_POST);

$data['kdUnt'] = substr($kde,0,11);
$data['nmUnt'] = fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($kde,0,11),"=","","");

$data['kdSub'] = substr($kde,0,14);
$data['nmSub'] = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",substr($kde,0,14),"=","","");

echo json_encode($data);
?>
