<?
require "Connection.php";
require "FileFunction.php";

$data = array();
extract($_POST);
$data['kde3'] = substr($kde,0,5);
$data['nma3'] = fGlobal("Nm_Aset","ref_rek_aset108_3","Kd_Aset",$data['kde3'],"=","","");
$data['kde4'] = substr($kde,0,8);
$data['nma4'] = fGlobal("Nm_Aset","ref_rek_aset108_4","Kd_Aset",$data['kde4'],"=","","");
$data['kde5'] = substr($kde,0,11);
$data['nma5'] = fGlobal("Nm_Aset","ref_rek_aset108_5","Kd_Aset",$data['kde5'],"=","","");
$data['kde6'] = substr($kde,0,14);
$data['nma6'] = fGlobal("Nm_Aset","ref_rek_aset108_6","Kd_Aset",$data['kde6'],"=","","");

echo json_encode($data);
?>
