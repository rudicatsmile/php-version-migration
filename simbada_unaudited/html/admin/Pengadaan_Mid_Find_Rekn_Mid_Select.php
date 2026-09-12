<?
require('Connection.php');
require "FileFunction.php";

$data = array();
extract($_POST);

if ($Kd!='')
{
	$data['Kd3'] = substr($Kd,0,5);
	$data['Nm3'] = fGlobal("Nm_Aset","ref_rek_aset108_3","Kd_Aset",$data['Kd3'],"=","","");
	$data['Kd4'] = substr($Kd,0,8);
	$data['Nm4'] = fGlobal("Nm_Aset","ref_rek_aset108_4","Kd_Aset",$data['Kd4'],"=","","");
	$data['Kd5'] = substr($Kd,0,11);
	$data['Nm5'] = fGlobal("Nm_Aset","ref_rek_aset108_5","Kd_Aset",$data['Kd5'],"=","","");
	$data['Kd6'] = substr($Kd,0,14);
	$data['Nm6'] = fGlobal("Nm_Aset","ref_rek_aset108_6","Kd_Aset",$data['Kd6'],"=","","");
	$data['Kd7'] = $Kd;
	$data['Nm7'] = $Nm;
}
$data['mss'] = $data['Nm3'];
echo json_encode($data);
?>