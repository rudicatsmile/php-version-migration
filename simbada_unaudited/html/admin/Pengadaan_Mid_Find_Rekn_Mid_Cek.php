<?
require('Connection.php');
require "FileFunction.php";

$data = array();
extract($_POST);

$data['CeK'] = "";
if ($IdT!='')
{
	$NoM = fGlobal("Nomor","ta_pengadaan","idt",$IdT,"=","","");
	$data['CeK'] = fGlobal("IDT","ta_kib_108_temp","No_Pengadaan",$NoM,"=","IDT DESC LIMIT 0,1","");
}
echo json_encode($data);
?>