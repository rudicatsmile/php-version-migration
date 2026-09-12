<?
require('Connection.php');
require "FileFunction.php";

$data = array();
extract($_POST);

if ($IdT!='')
{
	
	$SW = "UPDATE ta_rkbmd_standar_kebutuhan_rinci SET 
	$CrT='".$gVL."' WHERE IDT='".$IdT."'";
	$rs = mysql_query($SW);
	if ($rs){$Mss="proses berhasil...!!";}
}
$data['mess'] = $Mss;
echo json_encode($data);
?>