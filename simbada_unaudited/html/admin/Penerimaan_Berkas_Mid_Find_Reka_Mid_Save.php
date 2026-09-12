<?
require('Connection.php');
require "FileFunction.php";

$data = array();
extract($_POST);

if ($IdT!='')
{
	$SW = "UPDATE ta_penerimaan_berkas SET 
	IdRekanan='".$Kd."' WHERE IDT='".$IdT."'";
	$rs = mysql_query($SW);
	if ($rs){$Mss="proses berhasil...!!";}
}
$data['mess'] = $Mss;
echo json_encode($data);
?>